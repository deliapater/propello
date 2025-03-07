@extends('layouts.app')

@section('content')
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 text-gray-900">
            <h2 class="text-lg font-medium mb-4">Create New Tag</h2>
            <form method="POST" action="{{ route('tags.store') }}">
                @csrf
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700">Tag Name</label>
                    <input type="text" name="name" id="name" value="{{ old('name') }}" class="mt-1 block w-full rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
                    @error('name')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                
                <div class="flex justify-end space-x-2">
                    <x-elements.link-button href="{{ route('tags.index') }}">Cancel</x-elements.link-button>
                    <x-elements.link-button type="submit">Create Tag</x-elements.link-button>
                </div>
            </form>
        </div>
    </div>
@endsection