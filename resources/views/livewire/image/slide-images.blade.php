<x-layouts.content>
    @include('livewire.session-message')

    <div class="flex items-center">
        <img src="{{ asset('storage/images/icon/point.png') }}" class="h-5" alt="Point Icon">
        <h1 class="text-xl font-semibold text-gray-800 mb-6 mt-6">Slide Gambar</h1>
    </div>

    <div class="space-y-6">
        <div class="border border-gray-200 rounded-2xl shadow-2xl">
            <div class="px-5 py-5 rounded-t-2xl">
                <div class="flex justify-end">
                    <button wire:click="resetForm"
                        class="flex items-center px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                        Tambah Slide
                    </button>
                </div>
            </div>

            <div class="p-5">
                @if ($slide_images->isEmpty())
                <div class="flex items-center justify-center">
                    <svg class="h-7 w-7 mr-2" viewBox="0 0 24 24" fill="none" stroke="#ff3b30" stroke-width="1.25"
                        stroke-linecap="round" stroke-linejoin="round">
                        <path d="M12 3c7.2 0 9 1.8 9 9s-1.8 9 -9 9s-9 -1.8 -9 -9s1.8 -9 9 -9z" />
                        <path d="M12 8v4" />
                        <path d="M12 16h.01" />
                    </svg>
                    <p class="text-base text-gray-600 font-semibold">Belum ada slide gambar.</p>
                </div>
                @else
                <table class="w-full table-auto">
                    <thead class="text-sm text-gray-700">
                        <tr class="bg-gray-100 border-t border-gray-200">
                            <th class="px-4 py-2 text-left">Status</th>
                            <th class="px-4 py-2 text-left">Slide</th>
                            <th class="px-4 py-2 text-left"></th>
                        </tr>
                    </thead>
                    <tbody class="text-sm">
                        @foreach ($slide_images as $slide)
                        <tr class="border-t border-gray-200">
                            <td class="px-4 py-2">
                                @if ($slide->status === 'Aktif')
                                <span
                                    class="inline-flex items-center rounded-md bg-green-50 px-2 py-1 text-xs font-medium text-green-700 ring-1 ring-inset ring-green-600/20">Aktif</span>
                                @elseif ($slide->status === 'Berakhir')
                                <span
                                    class="inline-flex items-center rounded-md bg-red-50 px-2 py-1 text-xs font-medium text-red-700 ring-1 ring-inset ring-red-600/20">Berakhir</span>
                                @else
                                <span
                                    class="inline-flex items-center rounded-md bg-amber-50 px-2 py-1 text-xs font-medium text-amber-700 ring-1 ring-inset ring-amber-600/20">Nonaktif</span>
                                @endif
                            </td>
                            <td class="px-4 py-2">
                                <div class="flex items-center space-x-3">
                                    @if($slide->image)
                                    <img src="{{ asset('storage/' . $slide->image->image_name) }}" alt="Slide Image"
                                        class="h-16 w-16 bg-stone-400 object-cover rounded">
                                    @else
                                    <span class="text-gray-400">Gambar tidak ditemukan</span>
                                    @endif
                                    <div>
                                        <p class="text-base font-semibold">{{ $slide->title }}</p>
                                        <p class="text-sm">{{ Str::limit($slide->content, 100) }}</p>
                                        <p class="text-xs italic font-semibold text-gray-400">{{ $slide->author }}</p>
                                        <p class="text-sm font-medium">Tanggal publikasi : {{
                                            $slide->start_date->format('d M Y') }}
                                            - {{
                                            $slide->end_date->format('d M
                                            Y') }}</p>
                                        <p class="text-sm font-medium"> Status Slide :
                                            <span
                                                class="inline-block px-2 py-1 text-xs font-medium rounded {{ $slide->status_id == 1 ? 'bg-green-50 text-green-700 ring-1 ring-inset ring-green-600/20' : 'bg-red-50 text-red-700 ring-1 ring-inset ring-red-600/20' }}">
                                                {{ $slide->status_id == 1 ? 'Aktif' : 'Nonaktif' }}
                                            </span>
                                        </p>
                                    </div>
                                </div>
                            </td>

                            <td class="px-4 py-2">
                                <div class="inline-flex rounded-md shadow-sm" role="group">
                                    <button wire:click="edit({{ $slide->id }})" type="button"
                                        class="px-2 py-2 text-sm font-medium text-gray-900 bg-white border-t border-b border-gray-200 rounded-l-lg hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-2 focus:ring-blue-700 focus:text-blue-700">
                                        <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                            stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1" />
                                            <path
                                                d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z" />
                                            <path d="M16 5l3 3" />
                                        </svg>
                                    </button>
                                    <button wire:click="confirmDelete({{ $slide->id }})" type="button"
                                        class="px-2 py-2 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-r-lg hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-2 focus:ring-blue-700 focus:text-blue-700">
                                        <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                            stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M4 7l16 0" />
                                            <path d="M10 11l0 6" />
                                            <path d="M14 11l0 6" />
                                            <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" />
                                            <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" />
                                        </svg>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="mt-4">
                    {{ $slide_images->links() }}
                </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    @include('livewire.delete-modal')

</x-layouts.content>