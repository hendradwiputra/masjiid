@props([
'headers' => [],
'rows' => [],
'actions' => [],
'emptyMessage' => 'Tidak ada data',
'searchable' => false,
'perPage' => 10,
'perPageOptions' => [5, 10, 25, 50, 100],
'sortField' => 'id',
'sortDirection' => 'asc',
'bulkActions' => [],
'wireKey' => null,
])

@php
$wirePrefix = $wireKey ? $wireKey . '.' : '';
@endphp

<div>
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-4">
        <div class="flex items-center space-x-2">
            @if($searchable)
            <div class="relative">
                <input type="text" wire:model.live="{{ $wirePrefix }}search" placeholder="Search..."
                    class="w-64 border border-gray-200 rounded-md px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
            @endif
        </div>

        <div class="flex items-center space-x-2 mt-2 sm:mt-0">
            <select wire:model.live="{{ $wirePrefix }}perPage"
                class="border border-gray-200 rounded-md px-2 py-2 text-sm">
                @foreach($perPageOptions as $option)
                <option value="{{ $option }}">{{ $option }} per page</option>
                @endforeach
            </select>

            {{ $slot ?? '' }}
        </div>
    </div>

    @if(count($bulkActions) > 0 && isset($this->selectedRows) && count($this->selectedRows) > 0)
    <div class="bg-gray-50 p-3 rounded-lg mb-4 flex items-center justify-between">
        <span class="text-sm text-gray-600 tracking-wide">{{ count($this->selectedRows) }} baris dipilih.</span>
        <div class="flex space-x-2">
            @foreach($bulkActions as $action)
            <x-button wire:click="{{ $action['action'] }}" variant="{{ $action['variant'] ?? 'secondary' }}" size="sm"
                icon="trash">
                {{ $action['label'] }}
            </x-button>
            @endforeach
        </div>
    </div>
    @endif

    <div class="overflow-x-auto bg-white rounded-lg shadow">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    @if(count($bulkActions) > 0)
                    <th class="px-6 py-4 text-left">
                        <input type="checkbox" wire:model.live="{{ $wirePrefix }}selectAll" class="rounded">
                    </th>
                    @endif

                    @foreach($headers as $header)
                    <th scope="col"
                        class="px-6 py-3 text-left text-xs font-medium text-gray-800 uppercase tracking-wider cursor-pointer hover:text-gray-700"
                        wire:click="sortBy('{{ $header['field'] }}')">
                        <div class="flex items-center space-x-1">
                            <span>{{ $header['label'] }}</span>
                            @if($sortField === $header['field'])
                            <span class="text-gray-400">
                                {!! $sortDirection === 'asc' ? '↑' : '↓' !!}
                            </span>
                            @endif
                        </div>
                    </th>
                    @endforeach

                    @if(count($actions) > 0)
                    <th scope="col"
                        class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Aksi
                    </th>
                    @endif
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($rows as $row)
                <tr class="hover:bg-gray-50 transition-colors duration-150">
                    @if(count($bulkActions) > 0)
                    <td class="px-6 py-4 whitespace-nowrap">
                        <input type="checkbox" wire:model.live="{{ $wirePrefix }}selectedRows"
                            value="{{ $row['id'] ?? $row->id ?? '' }}" class="rounded">
                    </td>
                    @endif

                    @foreach($headers as $header)
                    <td class="px-6 py-4 whitespace-nowrap text-sm {{ $header['class'] ?? 'text-gray-900' }}">
                        @if(isset($header['render']))
                        @php
                        $value = data_get($row, $header['field']);
                        @endphp
                        {!! $header['render']($value, $row) !!}
                        @else
                        {{ data_get($row, $header['field']) }}
                        @endif
                    </td>
                    @endforeach

                    @if(count($actions) > 0)
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="flex justify-end space-x-2">
                            @foreach($actions as $action)
                            @if($action['type'] === 'edit')
                            <a href="{{ isset($action['route']) ? route($action['route'], $row['id'] ?? $row->id) : '#' }}"
                                wire:navigate>
                                <x-heroicon-o-pencil-square
                                    class="w-5 h-5 cursor-pointer hover:text-blue-600 transition-colors" />
                            </a>
                            @endif
                            @endforeach
                        </div>
                    </td>
                    @endif
                </tr>
                @empty
                <tr>
                    <td colspan="{{ count($headers) + (count($bulkActions) > 0 ? 1 : 0) + (count($actions) > 0 ? 1 : 0) }}"
                        class="px-6 py-4 text-center text-sm text-gray-500">
                        {{ $emptyMessage }}
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if(method_exists($rows, 'links'))
    <div class="mt-4">
        {{ $rows->links() }}
    </div>
    @endif
</div>