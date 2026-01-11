@extends('layouts.app')

@section('header')
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">Audit Logs</h2>
@endsection

@section('content')
    <div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
        <div class="bg-white shadow sm:rounded-lg p-6">
            <form method="GET" class="mb-4 flex gap-2 items-center">
                <input type="text" name="q" value="{{ request('q') }}" placeholder="Search action/meta" class="border p-2 rounded" />
                <input type="date" name="from" value="{{ request('from') }}" class="border p-2 rounded" />
                <input type="date" name="to" value="{{ request('to') }}" class="border p-2 rounded" />
                <input type="text" name="actor" value="{{ request('actor') }}" placeholder="Actor id" class="border p-2 rounded w-24" />
                <select name="action" class="border p-2 rounded">
                    <option value="">Any action</option>
                    @foreach(['update_role','delete_user','suspend_user','unsuspend_user','delete_facility','impersonate_start','impersonate_stop'] as $a)
                        <option value="{{ $a }}" @if(request('action')===$a) selected @endif>{{ $a }}</option>
                    @endforeach
                </select>
                <button class="px-3 py-2 bg-blue-600 text-white rounded">Filter</button>
                <a class="px-3 py-2 bg-gray-200 rounded" href="{{ route('audit-logs.export', request()->query()) }}">Export CSV</a>
            </form>
            <table class="w-full table-auto text-sm">
                <thead>
                    <tr class="text-left">
                        <th class="px-2 py-1">When</th>
                        <th class="px-2 py-1">Actor</th>
                        <th class="px-2 py-1">Action</th>
                        <th class="px-2 py-1">Target</th>
                        <th class="px-2 py-1">Meta</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($logs as $log)
                        <tr class="border-t">
                            <td class="px-2 py-2">{{ $log->created_at->toDateTimeString() }}</td>
                            <td class="px-2 py-2">{{ optional($log->user)->name ?? 'system' }}</td>
                            <td class="px-2 py-2">{{ $log->action }}</td>
                            <td class="px-2 py-2">{{ $log->target_type }} #{{ $log->target_id }}</td>
                            <td class="px-2 py-2"><pre class="whitespace-pre-wrap">{{ json_encode($log->meta) }}</pre></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="mt-4">{{ $logs->links() }}</div>
        </div>
    </div>
@endsection
