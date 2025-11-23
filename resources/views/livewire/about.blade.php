<x-layouts.content>

    <!-- Header Section -->
    <div class="flex items-center">
        <img src="{{ 'storage/images/icon/point.png' }}" class="h-5" alt="logo">
        <h1 class="text-xl font-semibold text-gray-800 mb-6 mt-6">Tentang Aplikasi Masjiid</h1>
    </div>

    <!-- Main Content Card -->
    <div class="max-w-2xl mb-6">
        <div class="bg-white border border-gray-200 rounded-2xl shadow-sm overflow-hidden">

            <!-- Contact Information -->
            <div class="p-6">
                <h2 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                    <svg class="w-5 h-5 text-blue-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                    </svg>
                    Contact
                </h2>

                <p class="text-gray-600 mb-5">
                    Jika Anda mengalami masalah atau memiliki pertanyaan tentang aplikasi ini, hubungi saya di:
                </p>

                <div class="space-y-4">
                    <!-- Email -->
                    <a class="flex items-center p-3 rounded-lg border border-gray-200 hover:border-blue-300 hover:bg-blue-50 transition-all group"
                        href="mailto:hendra.doank@gmail.com">
                        <div
                            class="flex items-center justify-center w-10 h-10 bg-red-50 rounded-lg mr-3 group-hover:bg-red-100 transition-colors">
                            <svg class="w-5 h-5 text-red-500" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="1.5">
                                <path
                                    d="M3 7a2 2 0 0 1 2 -2h14a2 2 0 0 1 2 2v10a2 2 0 0 1 -2 2h-14a2 2 0 0 1 -2 -2v-10z" />
                                <path d="M3 7l9 6l9 -6" />
                            </svg>
                        </div>
                        <div>
                            <p class="font-medium text-gray-900 group-hover:text-blue-600 transition-colors">Email</p>
                            <p class="text-gray-600 text-sm">hendra.doank@gmail.com</p>
                        </div>
                    </a>

                    <!-- WhatsApp -->
                    <a class="flex items-center p-3 rounded-lg border border-gray-200 hover:border-green-300 hover:bg-green-50 transition-all group"
                        href="https://wa.me/62811607781">
                        <div
                            class="flex items-center justify-center w-10 h-10 bg-green-50 rounded-lg mr-3 group-hover:bg-green-100 transition-colors">
                            <svg class="w-5 h-5 text-green-500" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="1.5">
                                <path d="M3 21l1.65 -3.8a9 9 0 1 1 3.4 2.9l-5.05 .9" />
                                <path
                                    d="M9 10a.5 .5 0 0 0 1 0v-1a.5 .5 0 0 0 -1 0v1a5 5 0 0 0 5 5h1a.5 .5 0 0 0 0 -1h-1a.5 .5 0 0 0 0 1" />
                            </svg>
                        </div>
                        <div>
                            <p class="font-medium text-gray-900 group-hover:text-green-600 transition-colors">WhatsApp
                            </p>
                            <p class="text-gray-600 text-sm">+62 811 6077 81</p>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="max-w-2xl">
        <div class="bg-white border border-gray-200 rounded-2xl shadow-sm overflow-hidden">
            <!-- Development Information -->
            <div class="p-6 border-b border-gray-100">
                <h2 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                    <svg class="w-5 h-5 text-blue-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4" />
                    </svg>
                    Technical Information
                </h2>

                <div class="space-y-4">
                    <!-- Development Stack -->
                    <div class="flex flex-col sm:flex-row">
                        <dt class="min-w-40 text-gray-600 font-medium mb-1 sm:mb-0">Development:</dt>
                        <dd class="flex-1">
                            <div class="flex flex-wrap gap-2">
                                <span
                                    class="inline-flex items-center px-3 py-1 rounded-full text-sm bg-red-50 text-red-700">
                                    <svg class="w-4 h-4 mr-1" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                        stroke-width="1.5">
                                        <path
                                            d="M3 17l8 5l7 -4v-8l-4 -2.5l4 -2.5l4 2.5v4l-11 6.5l-4 -2.5v-7.5l-4 -2.5z" />
                                        <path d="M11 18v4" />
                                        <path d="M7 15.5l7 -4" />
                                        <path d="M14 7.5v4" />
                                        <path d="M14 11.5l4 2.5" />
                                        <path d="M11 13v-7.5l-4 -2.5l-4 2.5" />
                                        <path d="M7 8l4 -2.5" />
                                        <path d="M18 10l4 -2.5" />
                                    </svg>
                                    Laravel 12
                                </span>
                                <span
                                    class="inline-flex items-center px-3 py-1 rounded-full text-sm bg-pink-50 text-purple-700">
                                    <svg class="w-4 h-4 mr-1" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                        stroke-width="1.5">
                                        <path
                                            d="M20.982 18.777c-.372 .548 -.652 1.223 -1.406 1.223c-1.269 0 -1.337 -1.913 -2.607 -1.913c-1.27 0 -1.2 1.913 -2.47 1.913c-1.268 0 -1.337 -1.913 -2.607 -1.913c-1.269 0 -1.2 1.913 -2.47 1.913c-1.268 0 -1.337 -1.913 -2.607 -1.913c-1.27 0 -1.2 1.913 -2.47 1.913c-.398 0 -.679 -.189 -.915 -.448a10.414 10.414 0 0 1 -1.43 -5.29c0 -5.669 4.477 -10.262 10 -10.262c5.524 0 10 4.594 10 10.261c0 1.62 -.366 3.152 -1.018 4.516z" />
                                        <path
                                            d="M20.982 18.777c-.372 .548 -.652 1.223 -1.406 1.223c-1.269 0 -1.337 -1.913 -2.607 -1.913c-1.27 0 -1.2 1.913 -2.47 1.913c-1.268 0 -1.337 -1.913 -2.607 -1.913c-1.269 0 -1.2 1.913 -2.47 1.913c-1.268 0 -1.337 -1.913 -2.607 -1.913c-1.27 0 -1.2 1.913 -2.47 1.913c-.398 0 -.679 -.189 -.915 -.448a10.414 10.414 0 0 1 -1.43 -5.29c0 -5.669 4.477 -10.262 10 -10.262c5.524 0 10 4.594 10 10.261c0 1.62 -.366 3.152 -1.018 4.516z" />
                                        <path
                                            d="M11.5 16c3.167 0 4.5 -1.748 4.5 -4.231c0 -2.484 -2.014 -4.769 -4.5 -4.769c-2.485 0 -4.5 2.286 -4.5 4.769s1.333 4.231 4.5 4.231z" />
                                        <path d="M10 11a1 1 0 1 0 0 -2a1 1 0 0 0 0 2z" />
                                    </svg>
                                    Livewire 3
                                </span>
                                <span
                                    class="inline-flex items-center px-3 py-1 rounded-full text-sm bg-blue-50 text-blue-700">
                                    <svg class="w-4 h-4 mr-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="1.5">
                                        <path
                                            d="M11.667 6c-2.49 0 -4.044 1.222 -4.667 3.667c.933 -1.223 2.023 -1.68 3.267 -1.375c.71 .174 1.217 .68 1.778 1.24c.916 .912 2 1.968 4.288 1.968c2.49 0 4.044 -1.222 4.667 -3.667c-.933 1.223 -2.023 1.68 -3.267 1.375c-.71 -.174 -1.217 -.68 -1.778 -1.24c-.916 -.912 -1.975 -1.968 -4.288 -1.968zm-4 6.5c-2.49 0 -4.044 1.222 -4.667 3.667c.933 -1.223 2.023 -1.68 3.267 -1.375c.71 .174 1.217 .68 1.778 1.24c.916 .912 1.975 1.968 4.288 1.968c2.49 0 4.044 -1.222 4.667 -3.667c-.933 1.223 -2.023 1.68 -3.267 1.375c-.71 -.174 -1.217 -.68 -1.778 -1.24c-.916 -.912 -1.975 -1.968 -4.288 -1.968z" />
                                    </svg>
                                    Tailwind 4.1
                                </span>
                            </div>
                        </dd>
                    </div>

                    <!-- License -->
                    <div class="flex flex-col sm:flex-row">
                        <dt class="min-w-40 text-gray-600 font-medium mb-1 sm:mb-0">Lisensi:</dt>
                        <dd class="flex-1">
                            <span
                                class="inline-flex items-center px-3 py-1 rounded-full text-sm bg-green-50 text-green-700">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                                </svg>
                                Gratis
                            </span>
                        </dd>
                    </div>

                    <!-- Source Code -->
                    <div class="flex flex-col sm:flex-row">
                        <dt class="min-w-40 text-gray-600 font-medium mb-1 sm:mb-0">Kode Sumber:</dt>
                        <dd class="flex-1">
                            <a class="inline-flex items-center text-gray-800 hover:text-blue-600 transition-colors"
                                href="https://github.com/hendradwiputra/masjiid">
                                <svg class="w-5 h-5 mr-2" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                    stroke-width="1.5">
                                    <path
                                        d="M9 19c-4.3 1.4 -4.3 -2.5 -6 -3m12 5v-3.5c0 -1 .1 -1.4 -.5 -2c2.8 -.3 5.5 -1.4 5.5 -6a4.6 4.6 0 0 0 -1.3 -3.2a4.2 4.2 0 0 0 -.1 -3.2s-1.1 -.3 -3.5 1.3a12.3 12.3 0 0 0 -6.2 0c-2.4 -1.6 -3.5 -1.3 -3.5 -1.3a4.2 4.2 0 0 0 -.1 3.2a4.6 4.6 0 0 0 -1.3 3.2c0 4.6 2.7 5.7 5.5 6c-.6 .6 -.6 1.2 -.5 2v3.5" />
                                </svg>
                                github.com/hendradwiputra/masjiid
                            </a>
                        </dd>
                    </div>

                    <!-- Compact Version History -->
                    <div class="flex flex-col sm:flex-row">
                        <dt class="min-w-40 text-gray-600 font-medium mb-2 sm:mb-0">Versi & Riwayat:</dt>
                        <dd class="flex-1">
                            <div class="flex items-center gap-2 mb-2">
                                <span
                                    class="inline-flex items-center px-2.5 py-1 rounded-full text-sm bg-blue-50 text-blue-700 border border-blue-200">
                                    v{{ $currentVersion }} (Current)
                                </span>
                            </div>

                            <div class="space-y-2 max-h-40 overflow-y-auto pr-2">
                                @foreach($versionHistory as $version)
                                <div class="flex items-start gap-3 p-2 rounded-lg hover:bg-gray-50 transition-colors">
                                    <div class="flex-shrink-0 w-2 h-2 mt-2 bg-gray-300 rounded-full"></div>
                                    <div class="flex-1 min-w-0">
                                        <div class="flex items-center gap-2 mb-1">
                                            <span class="text-sm font-medium text-gray-900">v{{ $version['version']
                                                }}</span>
                                            <span class="text-xs text-gray-500">{{ $version['date'] }}</span>
                                        </div>
                                        <p class="text-sm text-gray-600 line-clamp-2">{{ $version['title'] }}</p>
                                        @if(!empty($version['changes']))
                                        <div class="mt-1 flex flex-wrap gap-1">
                                            @foreach(array_slice($version['changes'], 0, 2) as $change)
                                            <span
                                                class="inline-block px-2 py-0.5 bg-green-50 text-green-700 text-xs rounded">
                                                {{ $change }}
                                            </span>
                                            @endforeach
                                            @if(count($version['changes']) > 2)
                                            <span
                                                class="inline-block px-2 py-0.5 bg-gray-50 text-gray-600 text-xs rounded">
                                                +{{ count($version['changes']) - 2 }} more
                                            </span>
                                            @endif
                                        </div>
                                        @endif
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </dd>
                    </div>
                </div>
            </div>
        </div>

        <!-- Footer Note -->
        <div class="mt-6 text-center">
            <p class="text-sm text-gray-500">
                Made with ❤️ for our masjiid
            </p>
        </div>
    </div>

</x-layouts.content>