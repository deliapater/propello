@extends('layouts.app')

@section('content')
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 text-gray-900">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-2xl font-bold">Tags</h2>
                <x-elements.link-button href="{{ route('tags.create') }}">
                    Create New Tag
                </x-elements.link-button>
            </div>

            @if($tags->isEmpty())
                <p class="text-gray-500">No tags created yet.</p>
            @else
                <div class="space-y-2">
                    @foreach($tags as $tag)
                        <div class="flex items-center justify-between py-2 border-b">
                            <span class="text-lg">{{ $tag->name }}</span>
                            <div class="space-x-2">
                                <x-elements.link-button href="{{ route('tags.edit', $tag) }}">
                                    Edit
                                </x-elements.link-button>
                                <form class="inline" method="POST" action="{{ route('tags.destroy', $tag) }}">
                                    @csrf
                                    @method('DELETE')
                                    <x-elements.link-button-danger type="submit" 
                                        onclick="return confirm('Are you sure you want to delete this tag?')">
                                        Delete
                                    </x-elements.link-button-danger>
                                </form>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
@endsection