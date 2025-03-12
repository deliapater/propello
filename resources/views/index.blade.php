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
        @if($tasks->isNotEmpty())
        <div class="w-full flex pb-2 border-b border-gray-200">
            <div class="w-2/12 font-semibold">Name</div>
            <div class="w-2/12 font-semibold">Created At</div>
            <div class="w-4/12 font-semibold">Actions</div>
            <div class="w-4/12 font-semibold"></div>
        </div>
        @endif

        @foreach($tasks as $task)
        <x-partials.task-row :task="$task" />
        @endforeach
        <div class="w-full text-center pt-4 flex justify-center gap-2  space-x-2">
            <x-elements.link-button href="{{ route('tasks.create') }}">
                Add Task
            </x-elements.link-button>
            <x-elements.link-button href="{{ route('tags.index') }}">
                Manage Tags
            </x-elements.link-button>
        </div>
    </div>
</div>
@endsection