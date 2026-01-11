@extends('layouts.app')

@section('header')
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">Facilities</h2>
@endsection

@section('content')
    <div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
        <div class="bg-white shadow sm:rounded-lg p-6">
            <table class="w-full">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>City</th>
                        <th>Owner</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($facilities as $facility)
                        <tr>
                            <td>{{ $facility->name }}</td>
                            <td>{{ $facility->city }}</td>
                            <td>{{ optional($facility->owner)->name }}</td>
                            <td>
                                <form method="POST" action="{{ route('admin.facilities.destroy', $facility) }}" style="display:inline">@csrf @method('DELETE')<button>Delete</button></form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            {{ $facilities->links() }}
        </div>
    </div>
@endsection
