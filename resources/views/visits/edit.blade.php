@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-3xl mx-auto">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-3xl font-bold">Edytuj wizytę</h1>
            <a href="{{ route('my-visits') }}" class="text-gray-600 hover:text-gray-800">
                ← Powrót do listy wizyt
            </a>
        </div>

        @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('visits.update', $visit->id) }}" method="POST" class="bg-white shadow-md rounded-lg p-6 space-y-6">
            @csrf
            @method('PUT')

            <div>
                <label for="specialist_id" class="block text-sm font-medium text-gray-700 mb-2">
                    Specjalista (opcjonalnie)
                </label>
                <select 
                    id="specialist_id" 
                    name="specialist_id"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                >
                    <option value="">Brak specjalisty</option>
                    @foreach($specialists as $specialist)
                        <option value="{{ $specialist->id }}" {{ old('specialist_id', $visit->specialist_id) == $specialist->id ? 'selected' : '' }}>
                            {{ $specialist->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label for="facility_id" class="block text-sm font-medium text-gray-700 mb-2">
                    Placówka (opcjonalnie)
                </label>
                <select 
                    id="facility_id" 
                    name="facility_id"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                >
                    <option value="">Brak placówki</option>
                    @foreach($facilities as $facility)
                        <option value="{{ $facility->id }}" {{ old('facility_id', $visit->facility_id) == $facility->id ? 'selected' : '' }}>
                            {{ $facility->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label for="visit_date" class="block text-sm font-medium text-gray-700 mb-2">
                    Data wizyty *
                </label>
                <input 
                    type="datetime-local" 
                    id="visit_date" 
                    name="visit_date"
                    value="{{ old('visit_date', $visit->visit_date->format('Y-m-d\TH:i')) }}"
                    required
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                >
            </div>

            <div>
                <label for="status" class="block text-sm font-medium text-gray-700 mb-2">
                    Status *
                </label>
                <select 
                    id="status" 
                    name="status"
                    required
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                >
                    <option value="scheduled" {{ old('status', $visit->status) == 'scheduled' ? 'selected' : '' }}>Zaplanowana</option>
                    <option value="completed" {{ old('status', $visit->status) == 'completed' ? 'selected' : '' }}>Zakończona</option>
                    <option value="cancelled" {{ old('status', $visit->status) == 'cancelled' ? 'selected' : '' }}>Anulowana</option>
                </select>
            </div>

            <div>
                <label for="notes" class="block text-sm font-medium text-gray-700 mb-2">
                    Notatki
                </label>
                <textarea 
                    id="notes" 
                    name="notes"
                    rows="4"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                    placeholder="Dodaj dodatkowe informacje o wizycie..."
                >{{ old('notes', $visit->notes) }}</textarea>
            </div>

            <div class="flex gap-4">
                <button 
                    type="submit" 
                    class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-6 rounded-lg transition duration-200"
                >
                    Zapisz zmiany
                </button>
                <a 
                    href="{{ route('my-visits') }}" 
                    class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-semibold py-2 px-6 rounded-lg transition duration-200"
                >
                    Anuluj
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
