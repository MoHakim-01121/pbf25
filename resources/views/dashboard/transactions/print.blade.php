<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice #{{ $order->order_number }}</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: Arial, sans-serif;
            font-size: 14px;
            line-height: 1.4;
            color: #333;
        }
        
        .invoice-container {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            background: white;
        }
        
        .invoice-header {
            display: flex;
            justify-content: space-between;
            align-items: start;
            margin-bottom: 30px;
            padding-bottom: 20px;
            border-bottom: 2px solid #333;
        }
        
        .company-info h1 {
            font-size: 28px;
            font-weight: bold;
            color: #111827;
            margin-bottom: 5px;
        }
        
        .company-info p {
            color: #666;
            margin: 2px 0;
        }
        
        .invoice-info {
            text-align: right;
        }
        
        .invoice-info h2 {
            font-size: 24px;
            margin-bottom: 10px;
        }
        
        .customer-info {
            display: flex;
            justify-content: space-between;
            margin-bottom: 30px;
        }
        
        .bill-to, .order-info {
            flex: 1;
        }
        
        .bill-to h3, .order-info h3 {
            font-size: 16px;
            margin-bottom: 10px;
            color: #333;
            border-bottom: 1px solid #ddd;
            padding-bottom: 5px;
        }
        
        .items-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 30px;
        }
        
        .items-table th {
            background: #f8f9fa;
            padding: 12px;
            text-align: left;
            border: 1px solid #ddd;
            font-weight: bold;
        }
        
        .items-table td {
            padding: 12px;
            border: 1px solid #ddd;
        }
        
        .items-table .text-right {
            text-align: right;
        }
        
        .items-table .text-center {
            text-align: center;
        }
        
        .total-section {
            margin-left: auto;
            width: 300px;
        }
        
        .total-row {
            display: flex;
            justify-content: space-between;
            padding: 8px 0;
            border-bottom: 1px solid #eee;
        }
        
        .total-row.final {
            border-bottom: 2px solid #333;
            font-weight: bold;
            font-size: 16px;
            margin-top: 10px;
            padding-top: 10px;
        }
        
        .footer {
            margin-top: 40px;
            padding-top: 20px;
            border-top: 1px solid #ddd;
            text-align: center;
            color: #666;
            font-size: 12px;
        }
        
        .status-badge {
            display: inline-block;
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: bold;
            text-transform: uppercase;
        }
        
        .status-pending { background: #fef3c7; color: #92400e; }
        .status-processing { background: #dbeafe; color: #1e40af; }
        .status-shipped { background: #e9d5ff; color: #7c3aed; }
        .status-completed { background: #d1fae5; color: #065f46; }
        .status-cancelled { background: #fee2e2; color: #991b1b; }
        
        @media print {
            .invoice-container {
                margin: 0;
                padding: 0;
                box-shadow: none;
            }
            
            body {
                background: white;
            }
        }
    </style>
</head>
<body>
    <div class="invoice-container">
        <!-- Header -->
        <div class="invoice-header">
            <div class="company-info">
                <h1>KopiKita</h1>
                <p>Alamat Toko Anda</p>
                <p>Kota, Provinsi 12345</p>
                <p>Telepon: (021) 1234-5678</p>
                <p>Email: info@kopikita.com</p>
            </div>
            <div class="invoice-info">
                <h2>INVOICE</h2>
                <p><strong>No: #{{ $order->order_number }}</strong></p>
                <p>Tanggal: {{ $order->created_at->format('d M Y') }}</p>
                <p>Waktu: {{ $order->created_at->format('H:i') }}</p>
            </div>
        </div>

        <!-- Customer & Order Info -->
        <div class="customer-info">
            <div class="bill-to">
                <h3>Bill To:</h3>
                <p><strong>{{ $order->customer->name }}</strong></p>
                <p>{{ $order->customer->email }}</p>
                @if($order->customer->phone)
                <p>{{ $order->customer->phone }}</p>
                @endif
                @if($order->customer->address)
                <p>{{ $order->customer->address }}</p>
                @endif
            </div>
            <div class="order-info">
                <h3>Order Info:</h3>
                <p><strong>Status:</strong> 
                    <span class="status-badge status-{{ $order->status }}">
                        {{ ucfirst($order->status) }}
                    </span>
                </p>
                <p><strong>Total Items:</strong> {{ $order->orderItems->sum('quantity') }}</p>
                <p><strong>Order Date:</strong> {{ $order->created_at->format('d M Y H:i') }}</p>
            </div>
        </div>

        <!-- Items Table -->
        <table class="items-table">
            <thead>
                <tr>
                    <th width="50%">Product</th>
                    <th width="15%" class="text-center">Qty</th>
                    <th width="17.5%" class="text-right">Unit Price</th>
                    <th width="17.5%" class="text-right">Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach($order->orderItems as $item)
                <tr>
                    <td>
                        <strong>{{ $item->product->name }}</strong>
                        @if($item->product->description)
                        <br><small style="color: #666;">{{ Str::limit($item->product->description, 100) }}</small>
                        @endif
                    </td>
                    <td class="text-center">{{ $item->quantity }}</td>
                    <td class="text-right">Rp {{ number_format($item->price, 0, ',', '.') }}</td>
                    <td class="text-right">Rp {{ number_format($item->price * $item->quantity, 0, ',', '.') }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Total Section -->
        <div class="total-section">
            <div class="total-row">
                <span>Subtotal:</span>
                <span>Rp {{ number_format($order->orderItems->sum(function($item) { return $item->price * $item->quantity; }), 0, ',', '.') }}</span>
            </div>
            <div class="total-row">
                <span>Tax (0%):</span>
                <span>Rp 0</span>
            </div>
            <div class="total-row">
                <span>Shipping:</span>
                <span>Rp 0</span>
            </div>
            <div class="total-row final">
                <span>TOTAL:</span>
                <span>Rp {{ number_format($order->total_amount, 0, ',', '.') }}</span>
            </div>
        </div>

        <!-- Footer -->
        <div class="footer">
            <p>Terima kasih telah berbelanja di KopiKita!</p>
            <p>Untuk pertanyaan atau bantuan, silakan hubungi kami di info@kopikita.com</p>
        </div>
    </div>

    <script>
        // Auto print when page loads
        window.onload = function() {
            window.print();
        }
    </script>
</body>
</html>