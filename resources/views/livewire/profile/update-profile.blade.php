@extends('livewire.layouts.content')

@section('content')

@if (session()->has('message'))
<div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
    <span class="block sm:inline">{{ session('message') }}</span>
</div>
@endif

<form wire:submit.prevent="update">
    <div class="flex items-center">
        <img src="{{ 'storage/images/icon/point.png' }}" class="h-5" alt="logo">
        <h1 class="text-xl font-semibold text-gray-800 mb-6 mt-6">Pengaturan Awal</h1>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div class="space-y-6">
            <div class="border border-gray-200 rounded-2xl">
                <div class="px-4 py-5 bg-gray-100 rounded-t-2xl">
                    <h3 class="text-base font-bold">
                        Konfigurasi dasar
                    </h3>
                </div>
                <div class="border-t border-gray-200 p-5 space-y-6">
                    <div>
                        <label for="name" class="block text-sm font-medium mb-2">Nama Masjid</label>
                        <input wire:model="name" type="text"
                            class="text-sm lg:text-base mt-1 px-2 py-3 block w-full rounded-md border border-gray-300 shadow-sm focus:border-sky-500 focus:outline-none focus:ring-sky-500">
                        @error('name') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>
                    <div>
                        <label for="address" class="block text-sm font-medium mb-2">Alamat</label>
                        <textarea wire:model="address"
                            class="text-sm lg:text-base mt-1 px-2 py-3 block w-full rounded-md border border-gray-300 shadow-sm focus:border-sky-500 focus:outline-none"
                            rows="3"></textarea>
                        @error('address') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>
                    <div>
                        <label for="description" class="block text-sm font-medium mb-2">Informasi tambahan</label>
                        <textarea wire:model="description"
                            class="text-sm lg:text-base mt-1 px-2 py-3 block w-full rounded-md border border-gray-300 shadow-sm focus:border-sky-500 focus:outline-none"
                            rows="3"></textarea>
                        @error('description') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>
                    <div>
                        <label for="contact_no" class="block text-sm font-medium mb-2">Nomor telepon</label>
                        <input wire:model="contact_no" type="text"
                            class="text-sm lg:text-base mt-1 px-2 py-3 block w-full rounded-md border border-gray-300 shadow-sm focus:border-sky-500 focus:outline-none focus:ring-sky-500">
                        @error('contact_no') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>
                </div>
            </div>
        </div>

        <div class="space-y-6">
            <div class="border border-gray-200 rounded-2xl">
                <div class="px-4 py-5 bg-gray-100 rounded-t-2xl">
                    <h3 class="text-base font-bold">
                        Logo
                    </h3>
                </div>
                <div class="border-t border-gray-200 p-5 ">
                    <div>
                        <label for="logo" class="block text-sm font-medium mb-2">Logo saat ini</label>
                        @if($logo)
                        <img src="{{ $this->logoUrl }}" alt="logo"
                            class="h-20 object-cover border-1 border-gray-300 mb-2">
                        @else
                        <img src="{{ asset('storage/images/logo/mosque.png') }}" alt="default logo"
                            class="h-20 object-cover border-1 border-gray-300 mb-2">
                        @endif
                        <input type="file" wire:model="newLogo"
                            class="file:mr-4 file:rounded-full file:border-0 file:bg-violet-50 file:px-4 file:py-2 file:text-sm file:font-semibold file:text-violet-700 hover:file:bg-violet-100 dark:file:bg-violet-600 dark:file:text-violet-100 dark:hover:file:bg-violet-500">
                        @error('newLogo') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        @if($newLogo)
                        <div class="mt-2">
                            <span class="text-sm font-medium">Logo baru</span>
                            <img src="{{ $newLogo->temporaryUrl() }}"
                                class="h-20 object-cover border-1 border-gray-300 mt-1">
                        </div>
                        @endif
                    </div>
                </div>
            </div>
            <div class="border border-gray-200 rounded-2xl">
                <div class="px-4 py-5 bg-gray-100 rounded-t-2xl">
                    <h3 class="text-base font-bold">
                        Default Theme
                    </h3>
                </div>
                <div class="border-t border-gray-200 p-5 space-y-6">
                    <div>
                        <label for="selected_theme" class="block text-sm font-medium mb-2">Pilih tema</label>
                        <select wire:model="selected_theme"
                            class="text-sm lg:text-base bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            <option value="">Pilih tema</option>
                            @for($i = 1; $i <= 4; $i++) <option value="theme{{ $i }}">Theme{{ $i }}</option>
                                @endfor
                        </select>
                        @error('selected_theme') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>
                    <div>
                        <label for="preview_theme" class="block text-sm font-medium mb-2">Preview</label>

                    </div>
                </div>
            </div>
        </div>

    </div>

    <div class="px-2 py-2 mt-1 border border-gray-200 bg-gray-100 rounded-b-2xl">
        <div class="flex justify-end ">
            <button type="submit"
                class="flex text-center border border-transparent bg-blue-500 hover:bg-blue-600 py-2 px-4 text-base font-medium text-white shadow-sm hover:bg-opacity-75 focus:outline-none focus:ring-2 focus:ring-sky-400 focus:ring-offset-2">
                Simpan
            </button>
        </div>
    </div>
</form>

@endsection