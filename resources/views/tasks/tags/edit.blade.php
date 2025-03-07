@extends('layouts.app')

@section('content')
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 text-gray-900">
            <h2 class="text-2xl font-bold mb-4">Edit Task Tags</h2>
            <p class="mb-4 text-gray-600">Task: {{ $task->name }}</p>

            <form method="POST" action="{{ route('tasks.tags.update', $task) }}" class="space-y-4">
                @csrf
                
                <div class="space-y-2">
                    @foreach($availableTags as $tag)
                        <div class="flex items-center">
                            <input type="checkbox" 
                                   id="tag-{{ $tag->id }}"
                                   name="tags[]" 
                                   value="{{ $tag->id }}"
                                   {{ in_array($tag->id, $selectedTags) ? 'checked' : '' }}
                                   class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                            <label for="tag-{{ $tag->id }}" class="ml-2">{{ $tag->name }}</label>
                        </div>
                    @endforeach
                </div>

                <div class="flex justify-end space-x-2">
                    <x-elements.link-button href="{{ route('tasks.home') }}">
                        Cancel
                    </x-elements.link-button>
                    <x-elements.link-button type="submit">
                        Update Tags
                    </x-elements.link-button>
                </div>
            </form>
        </div>
    </div>
@endsection