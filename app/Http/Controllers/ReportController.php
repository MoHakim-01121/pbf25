<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        try {
            $period = $request->get('period', 'this_month');
            $startDate = $this->getStartDate($period);
            $endDate = now();

            // Sales Analytics
            $salesAnalytics = Order::where('status', 'completed')
                ->whereBetween('created_at', [$startDate, $endDate])
                ->select(
                    DB::raw('COUNT(*) as total_orders'),
                    DB::raw('COALESCE(SUM(total_amount), 0) as total_revenue'),
                    DB::raw('CASE WHEN COUNT(*) > 0 THEN COALESCE(AVG(total_amount), 0) ELSE 0 END as average_order_value'),
                    DB::raw('COUNT(DISTINCT user_id) as unique_customers'),
                    DB::raw('CASE WHEN COUNT(DISTINCT user_id) > 0 THEN COALESCE(SUM(total_amount), 0) / COUNT(DISTINCT user_id) ELSE 0 END as revenue_per_customer')
                )
                ->first() ?? new \stdClass();

            // Growth Metrics (compared to previous period)
            $previousPeriodDates = $this->getPreviousPeriodDates($period, $startDate);
            
            $previousPeriodMetrics = Order::where('status', 'completed')
                ->whereBetween('created_at', [$previousPeriodDates['start'], $previousPeriodDates['end']])
                ->select(
                    DB::raw('COUNT(*) as total_orders'),
                    DB::raw('COALESCE(SUM(total_amount), 0) as total_revenue'),
                    DB::raw('COUNT(DISTINCT user_id) as unique_customers')
                )
                ->first() ?? new \stdClass();

            // Initialize growth metrics with safe defaults
            $growthMetrics = [
                'orders_growth' => 0,
                'revenue_growth' => 0,
                'customers_growth' => 0
            ];

            // Only calculate growth if we have valid previous period data
            if ($previousPeriodMetrics) {
                $growthMetrics = [
                    'orders_growth' => $this->calculateGrowthSafely(
                        $salesAnalytics->total_orders ?? 0, 
                        $previousPeriodMetrics->total_orders ?? 0
                    ),
                    'revenue_growth' => $this->calculateGrowthSafely(
                        $salesAnalytics->total_revenue ?? 0, 
                        $previousPeriodMetrics->total_revenue ?? 0
                    ),
                    'customers_growth' => $this->calculateGrowthSafely(
                        $salesAnalytics->unique_customers ?? 0, 
                        $previousPeriodMetrics->unique_customers ?? 0
                    )
                ];
            }

            // Customer Retention Analysis with safe defaults
            $retentionQuery = DB::select("
                WITH CustomerPurchases AS (
                    SELECT 
                        user_id,
                        COUNT(*) as purchase_count,
                        MIN(created_at) as first_purchase,
                        MAX(created_at) as last_purchase,
                        DATEDIFF(MAX(created_at), MIN(created_at)) as customer_lifetime_days
                    FROM orders
                    WHERE status = 'completed'
                    GROUP BY user_id
                )
                SELECT
                    COUNT(*) as total_customers,
                    SUM(CASE WHEN purchase_count > 1 THEN 1 ELSE 0 END) as returning_customers,
                    CASE 
                        WHEN COUNT(*) > 0 THEN COALESCE(AVG(purchase_count), 0)
                        ELSE 0 
                    END as average_purchases_per_customer,
                    CASE 
                        WHEN COUNT(*) > 0 THEN COALESCE(AVG(customer_lifetime_days), 0)
                        ELSE 0 
                    END as average_customer_lifetime_days
                FROM CustomerPurchases
            ");

            $retentionAnalysis = !empty($retentionQuery) ? (array) $retentionQuery[0] : [
                'total_customers' => 0,
                'returning_customers' => 0,
                'average_purchases_per_customer' => 0,
                'average_customer_lifetime_days' => 0
            ];

            // Product Performance Analytics with safe defaults
            $productAnalytics = DB::select("
                WITH ProductMetrics AS (
                    SELECT 
                        p.id,
                        p.name,
                        COUNT(DISTINCT o.id) as order_count,
                        COALESCE(SUM(oi.quantity), 0) as units_sold,
                        COALESCE(SUM(oi.quantity * oi.price), 0) as revenue,
                        COUNT(DISTINCT o.user_id) as unique_buyers
                    FROM products p
                    LEFT JOIN order_items oi ON p.id = oi.product_id
                    LEFT JOIN orders o ON oi.order_id = o.id AND o.status = 'completed'
                    WHERE o.created_at BETWEEN ? AND ?
                    GROUP BY p.id, p.name
                )
                SELECT 
                    *,
                    CASE 
                        WHEN units_sold > 0 THEN revenue / units_sold
                        ELSE 0 
                    END as average_selling_price,
                    CASE 
                        WHEN order_count > 0 THEN revenue / order_count
                        ELSE 0 
                    END as revenue_per_order,
                    CASE 
                        WHEN unique_buyers > 0 THEN CAST(units_sold AS FLOAT) / unique_buyers
                        ELSE 0 
                    END as units_per_customer
                FROM ProductMetrics
                ORDER BY revenue DESC
                LIMIT 10
            ", [$startDate, $endDate]) ?: [];

            // Sales Distribution Analysis with safe defaults
            $byDayOfWeek = DB::select("
                SELECT 
                    DAYNAME(created_at) as day_name,
                    COUNT(*) as order_count,
                    COALESCE(SUM(total_amount), 0) as total_revenue,
                    CASE 
                        WHEN COUNT(*) > 0 THEN COALESCE(AVG(total_amount), 0)
                        ELSE 0 
                    END as average_order_value
                FROM orders
                WHERE status = 'completed'
                AND created_at BETWEEN ? AND ?
                GROUP BY day_name
                ORDER BY FIELD(day_name, 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday')
            ", [$startDate, $endDate]) ?: [];

            $byHour = DB::select("
                SELECT 
                    HOUR(created_at) as hour_of_day,
                    COUNT(*) as order_count,
                    COALESCE(SUM(total_amount), 0) as total_revenue
                FROM orders
                WHERE status = 'completed'
                AND created_at BETWEEN ? AND ?
                GROUP BY hour_of_day
                ORDER BY hour_of_day
            ", [$startDate, $endDate]) ?: [];

            $salesDistribution = [
                'by_day_of_week' => $byDayOfWeek,
                'by_hour' => $byHour
            ];

            return view('dashboard.reports.index', compact(
                'period',
                'salesAnalytics',
                'growthMetrics',
                'retentionAnalysis',
                'productAnalytics',
                'salesDistribution'
            ));

        } catch (\Exception $e) {
            \Log::error('Report generation error: ' . $e->getMessage(), [
                'period' => $period ?? 'unknown',
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return view('dashboard.reports.index', [
                'period' => $period ?? 'this_month',
                'salesAnalytics' => new \stdClass(),
                'growthMetrics' => [
                    'orders_growth' => 0,
                    'revenue_growth' => 0,
                    'customers_growth' => 0
                ],
                'retentionAnalysis' => [
                    'total_customers' => 0,
                    'returning_customers' => 0,
                    'average_purchases_per_customer' => 0,
                    'average_customer_lifetime_days' => 0
                ],
                'productAnalytics' => [],
                'salesDistribution' => [
                    'by_day_of_week' => [],
                    'by_hour' => []
                ]
            ])->with('error', 'Terjadi kesalahan saat menghasilkan laporan. Tim kami sedang menyelidiki masalah ini.');
        }
    }

    private function calculateGrowthSafely($current, $previous)
    {
        $current = floatval($current);
        $previous = floatval($previous);
        
        if ($previous <= 0) {
            return $current > 0 ? 100 : 0;
        }
        
        return (($current - $previous) / $previous) * 100;
    }

    private function getStartDate($period)
    {
        return match($period) {
            'today' => now()->startOfDay(),
            'yesterday' => now()->subDay()->startOfDay(),
            'this_week' => now()->startOfWeek(),
            'last_week' => now()->subWeek()->startOfWeek(),
            'this_month' => now()->startOfMonth(),
            'last_month' => now()->subMonth()->startOfMonth(),
            'this_year' => now()->startOfYear(),
            'last_year' => now()->subYear()->startOfYear(),
            default => now()->startOfMonth(),
        };
    }

    private function getPreviousPeriodDates($period, $currentStartDate)
    {
        $start = null;
        $end = (clone $currentStartDate)->subSecond();

        switch($period) {
            case 'today':
                $start = (clone $currentStartDate)->subDay();
                break;
            case 'this_week':
                $start = (clone $currentStartDate)->subWeek();
                break;
            case 'this_month':
                $start = (clone $currentStartDate)->subMonth();
                break;
            case 'this_year':
                $start = (clone $currentStartDate)->subYear();
                break;
            case 'last_week':
                $start = (clone $currentStartDate)->subWeek();
                $end = (clone $start)->addWeek()->subSecond();
                break;
            case 'last_month':
                $start = (clone $currentStartDate)->subMonth();
                $end = (clone $start)->addMonth()->subSecond();
                break;
            case 'last_year':
                $start = (clone $currentStartDate)->subYear();
                $end = (clone $start)->addYear()->subSecond();
                break;
            default:
                $start = (clone $currentStartDate)->subMonth();
        }

        return [
            'start' => $start,
            'end' => $end
        ];
    }

    public function export(Request $request)
    {
        // TODO: Implement export functionality
        return back()->with('error', 'Export functionality is coming soon.');
    }
}
