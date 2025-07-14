<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form action="{{ route('admin.settings.update') }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="space-y-12">
                            <!-- Site Information -->
                            <div>
                                <h2 class="text-base font-semibold leading-7 text-gray-900">Site Information</h2>
                                <p class="mt-1 text-sm leading-6 text-gray-600">
                                    Basic information about your store.
                                </p>

                                <div class="mt-6 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                                    <div class="sm:col-span-4">
                                        <label for="site_name" class="block text-sm font-medium text-gray-700">
                                            Site Name
                                        </label>
                                        <input type="text" 
                                               name="site_name" 
                                               id="site_name"
                                               value="{{ old('site_name', $settings['site_name'] ?? '') }}"
                                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                        @error('site_name')
                                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div class="col-span-full">
                                        <label for="site_description" class="block text-sm font-medium text-gray-700">
                                            Site Description
                                        </label>
                                        <textarea name="site_description" 
                                                  id="site_description" 
                                                  rows="3"
                                                  class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">{{ old('site_description', $settings['site_description'] ?? '') }}</textarea>
                                        @error('site_description')
                                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <!-- Contact Information -->
                            <div>
                                <h2 class="text-base font-semibold leading-7 text-gray-900">Contact Information</h2>
                                <p class="mt-1 text-sm leading-6 text-gray-600">
                                    How customers can reach your store.
                                </p>

                                <div class="mt-6 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                                    <div class="sm:col-span-3">
                                        <label for="contact_email" class="block text-sm font-medium text-gray-700">
                                            Contact Email
                                        </label>
                                        <input type="email" 
                                               name="contact_email" 
                                               id="contact_email"
                                               value="{{ old('contact_email', $settings['contact_email'] ?? '') }}"
                                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                        @error('contact_email')
                                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div class="sm:col-span-3">
                                        <label for="contact_phone" class="block text-sm font-medium text-gray-700">
                                            Contact Phone
                                        </label>
                                        <input type="text" 
                                               name="contact_phone" 
                                               id="contact_phone"
                                               value="{{ old('contact_phone', $settings['contact_phone'] ?? '') }}"
                                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                        @error('contact_phone')
                                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div class="col-span-full">
                                        <label for="address" class="block text-sm font-medium text-gray-700">
                                            Store Address
                                        </label>
                                        <textarea name="address" 
                                                  id="address" 
                                                  rows="3"
                                                  class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">{{ old('address', $settings['address'] ?? '') }}</textarea>
                                        @error('address')
                                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <!-- Social Media -->
                            <div>
                                <h2 class="text-base font-semibold leading-7 text-gray-900">Social Media</h2>
                                <p class="mt-1 text-sm leading-6 text-gray-600">
                                    Your store's social media presence.
                                </p>

                                <div class="mt-6 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                                    <div class="sm:col-span-3">
                                        <label for="social_media[facebook]" class="block text-sm font-medium text-gray-700">
                                            Facebook
                                        </label>
                                        <div class="mt-1 flex rounded-md shadow-sm">
                                            <span class="inline-flex items-center px-3 rounded-l-md border border-r-0 border-gray-300 bg-gray-50 text-gray-500 sm:text-sm">
                                                facebook.com/
                                            </span>
                                            <input type="text" 
                                                   name="social_media[facebook]" 
                                                   id="social_media[facebook]"
                                                   value="{{ old('social_media.facebook', $settings['social_media']['facebook'] ?? '') }}"
                                                   class="flex-1 block w-full rounded-none rounded-r-md border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                        </div>
                                    </div>

                                    <div class="sm:col-span-3">
                                        <label for="social_media[instagram]" class="block text-sm font-medium text-gray-700">
                                            Instagram
                                        </label>
                                        <div class="mt-1 flex rounded-md shadow-sm">
                                            <span class="inline-flex items-center px-3 rounded-l-md border border-r-0 border-gray-300 bg-gray-50 text-gray-500 sm:text-sm">
                                                instagram.com/
                                            </span>
                                            <input type="text" 
                                                   name="social_media[instagram]" 
                                                   id="social_media[instagram]"
                                                   value="{{ old('social_media.instagram', $settings['social_media']['instagram'] ?? '') }}"
                                                   class="flex-1 block w-full rounded-none rounded-r-md border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Maintenance Mode -->
                            <div>
                                <h2 class="text-base font-semibold leading-7 text-gray-900">Maintenance Mode</h2>
                                <p class="mt-1 text-sm leading-6 text-gray-600">
                                    Enable maintenance mode when you need to take your store offline temporarily.
                                </p>

                                <div class="mt-6">
                                    <div class="flex items-center">
                                        <input type="checkbox" 
                                               name="maintenance_mode" 
                                               id="maintenance_mode"
                                               value="1"
                                               {{ old('maintenance_mode', $settings['maintenance_mode'] ?? '') ? 'checked' : '' }}
                                               class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
                                        <label for="maintenance_mode" class="ml-2 block text-sm text-gray-700">
                                            Enable Maintenance Mode
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="mt-6 flex items-center justify-end gap-x-6">
                            <button type="button" class="text-sm font-semibold leading-6 text-gray-900">
                                Cancel
                            </button>
                            <button type="submit" class="inline-flex justify-center rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                                Save Changes
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout> 