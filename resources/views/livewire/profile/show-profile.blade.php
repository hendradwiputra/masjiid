@extends('livewire.layouts.content')

@section('content')
    

<!-- Cards grid -->
                <div class="mt-8 grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3">
                    <!-- Card 1 -->
                    <div class="bg-white rounded-lg shadow p-6">
                        <h3 class="text-lg font-medium text-gray-900">Total Users</h3>
                        <p class="mt-2 text-3xl font-bold text-primary-600">1,234</p>
                        <p class="mt-1 text-sm text-gray-500">12% increase from last month</p>
                    </div>
                    
                    <!-- Card 2 -->
                    <div class="bg-white rounded-lg shadow p-6">
                        <h3 class="text-lg font-medium text-gray-900">Revenue</h3>
                        <p class="mt-2 text-3xl font-bold text-primary-600">$24,567</p>
                        <p class="mt-1 text-sm text-gray-500">8% increase from last month</p>
                    </div>
                    
                    <!-- Card 3 -->
                    <div class="bg-white rounded-lg shadow p-6">
                        <h3 class="text-lg font-medium text-gray-900">Active Projects</h3>
                        <p class="mt-2 text-3xl font-bold text-primary-600">42</p>
                        <p class="mt-1 text-sm text-gray-500">3 new projects this week</p>
                    </div>
                </div>

@endsection