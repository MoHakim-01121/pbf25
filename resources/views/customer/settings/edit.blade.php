@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        <!-- Sidebar -->
        <div class="md:col-span-1">
            <div class="bg-white shadow-sm rounded-lg p-6">
                <div class="flex items-center space-x-4">
                    <div class="relative">
                        @if(Auth::user()->profile_photo_path)
                            <img src="{{ asset('storage/' . Auth::user()->profile_photo_path) }}" 
                                 alt="{{ Auth::user()->name }}" 
                                 class="h-20 w-20 rounded-full object-cover border-2 border-gray-200">
                        @else
                            <div class="h-20 w-20 rounded-full bg-gray-900 flex items-center justify-center text-white text-2xl font-bold">
                                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                            </div>
                        @endif
                        <div class="absolute bottom-0 right-0 h-4 w-4 rounded-full border-2 border-white bg-green-400"></div>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold text-gray-900">{{ Auth::user()->name }}</h3>
                        <p class="text-sm text-gray-500">{{ Auth::user()->email }}</p>
                    </div>
                </div>
                <div class="mt-6 border-t border-gray-100 pt-6">
                    <nav class="space-y-2">
                        <a href="{{ route('profile.edit') }}" 
                           class="flex items-center px-3 py-2 text-sm font-medium rounded-lg {{ request()->routeIs('profile.edit') ? 'text-gray-900 bg-gray-50' : 'text-gray-600 hover:text-gray-900 hover:bg-gray-50' }}">
                            <i class="fas fa-user w-5 h-5 mr-3"></i>
                            Profile Information
                        </a>
                        <a href="{{ route('profile.settings') }}" 
                           class="flex items-center px-3 py-2 text-sm font-medium rounded-lg {{ request()->routeIs('profile.settings') ? 'text-gray-900 bg-gray-50' : 'text-gray-600 hover:text-gray-900 hover:bg-gray-50' }}">
                            <i class="fas fa-cog w-5 h-5 mr-3"></i>
                            Account Settings
                        </a>
                    </nav>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="md:col-span-2 space-y-6">
            <!-- Notifications Settings -->
            <div class="bg-white shadow-sm rounded-lg">
                <div class="p-6">
                    <h4 class="text-lg font-medium text-gray-900">Notifications</h4>
                    <p class="mt-1 text-sm text-gray-500">Manage how you receive notifications about your account activity.</p>

                    @if (session('success'))
                        <div class="mt-4 p-4 bg-green-50 border border-green-200 rounded-lg">
                            <div class="flex">
                                <div class="flex-shrink-0">
                                    <i class="fas fa-check-circle text-green-400"></i>
                                </div>
                                <div class="ml-3">
                                    <p class="text-sm font-medium text-green-800">
                                        {{ session('success') }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    @endif

                    <form action="{{ route('profile.settings.update') }}" method="POST" class="mt-6">
                        @csrf
                        @method('PUT')

                        <div class="space-y-6">
                            <!-- Email Notifications -->
                            <div class="flex items-start">
                                <div class="flex items-center h-5">
                                    <input type="checkbox" 
                                           name="email_notifications" 
                                           id="email_notifications"
                                           value="1"
                                           {{ old('email_notifications', $user->settings->email_notifications ?? true) ? 'checked' : '' }}
                                           class="h-4 w-4 rounded border-gray-300 text-gray-900 focus:ring-gray-500">
                                </div>
                                <div class="ml-3">
                                    <label for="email_notifications" class="text-sm font-medium text-gray-900">Email Notifications</label>
                                    <p class="text-xs text-gray-500">Receive email notifications about your orders, account updates, and promotions.</p>
                                </div>
                            </div>

                            <!-- Order Updates -->
                            <div class="flex items-start">
                                <div class="flex items-center h-5">
                                    <input type="checkbox" 
                                           name="order_updates" 
                                           id="order_updates"
                                           value="1"
                                           {{ old('order_updates', $user->settings->order_updates ?? true) ? 'checked' : '' }}
                                           class="h-4 w-4 rounded border-gray-300 text-gray-900 focus:ring-gray-500">
                                </div>
                                <div class="ml-3">
                                    <label for="order_updates" class="text-sm font-medium text-gray-900">Order Updates</label>
                                    <p class="text-xs text-gray-500">Get notified about your order status changes and delivery updates.</p>
                                </div>
                            </div>

                            <!-- Marketing Updates -->
                            <div class="flex items-start">
                                <div class="flex items-center h-5">
                                    <input type="checkbox" 
                                           name="marketing_updates" 
                                           id="marketing_updates"
                                           value="1"
                                           {{ old('marketing_updates', $user->settings->marketing_updates ?? false) ? 'checked' : '' }}
                                           class="h-4 w-4 rounded border-gray-300 text-gray-900 focus:ring-gray-500">
                                </div>
                                <div class="ml-3">
                                    <label for="marketing_updates" class="text-sm font-medium text-gray-900">Marketing Updates</label>
                                    <p class="text-xs text-gray-500">Stay updated with our latest products, promotions, and special offers.</p>
                                </div>
                            </div>
                        </div>

                        <div class="mt-6 border-t border-gray-100 pt-6">
                            <h4 class="text-lg font-medium text-gray-900">Language & Region</h4>
                            <p class="mt-1 text-sm text-gray-500">Choose your preferred language and timezone settings.</p>

                            <div class="mt-6 space-y-6">
                                <!-- Language -->
                                <div>
                                    <label for="language" class="block text-sm font-medium text-gray-900">Language</label>
                                    <select name="language" 
                                            id="language" 
                                            class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:ring-gray-900 focus:border-gray-900">
                                        <option value="en" {{ old('language', $user->settings->language ?? 'en') == 'en' ? 'selected' : '' }}>English</option>
                                        <option value="id" {{ old('language', $user->settings->language ?? 'en') == 'id' ? 'selected' : '' }}>Indonesia</option>
                                    </select>
                                </div>

                                <!-- Timezone -->
                                <div>
                                    <label for="timezone" class="block text-sm font-medium text-gray-900">Timezone</label>
                                    <select name="timezone" 
                                            id="timezone" 
                                            class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:ring-gray-900 focus:border-gray-900">
                                        <option value="Asia/Jakarta" {{ old('timezone', $user->settings->timezone ?? 'Asia/Jakarta') == 'Asia/Jakarta' ? 'selected' : '' }}>Asia/Jakarta (WIB)</option>
                                        <option value="Asia/Makassar" {{ old('timezone', $user->settings->timezone ?? 'Asia/Jakarta') == 'Asia/Makassar' ? 'selected' : '' }}>Asia/Makassar (WITA)</option>
                                        <option value="Asia/Jayapura" {{ old('timezone', $user->settings->timezone ?? 'Asia/Jakarta') == 'Asia/Jayapura' ? 'selected' : '' }}>Asia/Jayapura (WIT)</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="mt-6 flex justify-end">
                            <button type="submit"
                                    class="px-4 py-2 text-sm font-medium text-white bg-gray-900 rounded-lg hover:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-900 transition-colors">
                                Save Changes
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 