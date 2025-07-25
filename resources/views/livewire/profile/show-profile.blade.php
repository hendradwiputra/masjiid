@extends('livewire.layouts.content')

@section('content')
    
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 py-6">
        <div class="bg-white border border-gray-200 rounded-2xl">
            <div class="flex flex-col lg:flex-row lg:items-start lg:justify-between">
                <div class="px-5 py-4 space-y-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-10">
                        Detail lokasi
                    </h3>
                    <div class="grid grid-cols-1">
                        <p class="text-xs text-gray-600 ">
                            Logo
                        </p>
                        <img src="{{ 'storage/images/logo/'.$logo }}" alt="logo masjid" class="w-24 h-24 object-cover rounded-md border border-gray-200 mt-2">
                    </div>
                    <div class="grid grid-cols-1">
                        <p class="text-xs text-gray-600 ">
                            Nama lokasi
                        </p>
                        <p class="text-md font-medium text-gray-800">
                            {{ $name ?? '-' }}
                        </p>
                    </div>
                    <div class="grid grid-cols-1">
                        <p class="text-xs text-gray-600 ">
                            Alamat
                        </p>
                        <p class="text-md font-medium text-gray-800 leading-tight">
                            {{ $address ?? '-' }}
                        </p>
                    </div>
                    <div class="grid grid-cols-1">
                        <p class="text-xs text-gray-600 ">
                            Keterangan
                        </p>
                        <p class="text-md font-medium text-gray-800 leading-tight">
                            {{ $description ?? '-'}}
                        </p>
                    </div>
                    <div class="grid grid-cols-1">
                        <p class="text-xs text-gray-600 ">
                            Nomor telepon
                        </p>
                        <p class="text-md font-medium text-gray-800">
                            {{ $contact_no ?? '-'}}
                        </p>
                    </div>
                </div>
                <div class="px-5 py-4">
                    <button class="flex items-center justify-center bg-blue-500 text-white text-sm px-6 py-2 gap-1 rounded-full w-full hover:bg-blue-600">
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        width="16"
                        height="16"
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="#ffffff"
                        stroke-width="1.25"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        >
                        <path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1" />
                        <path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z" />
                        <path d="M16 5l3 3" />
                    </svg>
                    Edit
                </button> 
                </div>
                               
            </div>
            
            
        </div>
    </div>


@endsection