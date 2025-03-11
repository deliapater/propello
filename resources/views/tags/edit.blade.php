@extends('layouts.app')

@section('content')
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 text-gray-900">
            <h2 class="text-2xl font-bold mb-4">Edit Tag</h2>
            
            <form method="POST" action="{{ route('tags.update', $tag) }}" class="space-y-4">
                @csrf
                @method('PUT')
                
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700">Tag Name</label>
                    <input type="text" 
                           name="name" 
                           id="name"
                           value="{{ old('name', $tag->name) }}"
                           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                           required>
                    @error('name')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex justify-end space-x-2">
                    <x-elements.link-button href="{{ route('tags.index') }}">
                        Cancel
                    </x-elements.link-button>
                    <x-elements.primary-button type="submit">
                        Update Tag
                    </x-elements.primary-button>
                </div>
            </form>
        </div>
    </div>
@endsection