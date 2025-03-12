@extends('layouts.app')

@section('content')
@if(session('success'))
<div x-data="{ show: true }"
    x-show="show"
    x-init="setTimeout(() => show = false, 3000)"
    class="fixed bottom-5 right-5 bg-green-600 text-black px-6 py-3 rounded shadow-lg">
    {{ session('success') }}
</div>
@endif
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
                                <event-button text="Delete" name="open-modal" value="confirm-tag-deletion-{{ $tag->id }}" class="danger"></event-button>

                                <form-modal name="confirm-tag-deletion-{{ $tag->id }}" action="{{ route('tags.destroy', $tag) }}">
                                    @csrf
                                    @method('delete')

                                    <h2 class="text-lg font-medium text-gray-900">
                                        {{ __('Are you sure you want to delete this tag?') }}
                                    </h2>

                                    <p class="mt-1 text-sm text-gray-600">
                                        {{ __('Once deleted, this tag will be removed from all tasks.') }}
                                    </p>
                                </form-modal>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
@endsection