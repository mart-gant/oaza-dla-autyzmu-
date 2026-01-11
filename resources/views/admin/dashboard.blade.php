@extends('layouts.app')

@section('content')
    <div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
        <h1 class="text-2xl font-semibold text-gray-900">Admin Dashboard</h1>

        <div class="mt-6 grid grid-cols-1 md:grid-cols-3 gap-4">
            <div class="p-4 bg-white shadow sm:rounded-lg">Total users: {{ \App\Models\User::count() }}</div>
            <div class="p-4 bg-white shadow sm:rounded-lg">Total facilities: {{ \App\Models\Facility::count() }}</div>
            <div class="p-4 bg-white shadow sm:rounded-lg">Total specialists: {{ \App\Models\User::where('is_specialist', true)->count() }}</div>
        </div>
    </div>
@endsection
