@props([
    'task' => null,
])

<div class="w-full flex py-2 border-b border-gray-100 items-center min-h-[50px]" x-data="{ showTagInput: false }">
    <div class="w-2/12 flex items-center {{ $task?->complete ? 'line-through' : '' }}">
        {{ $task?->name }}
    </div>

    <div class="w-2/12 flex items-center">
        {{ $task?->created_at->format('jS M Y') }}
    </div>

    <div class="w-4/12 flex items-center justify-start space-x-2 min-h-[50px]">
        <div x-show="!showTagInput" class="flex space-x-2">
            <x-elements.link-button class="w-[110px]" href="{{ route('tasks.complete', ['task' => $task]) }}">
                {{ $task?->complete ? 'Pending' : 'Complete' }}
            </x-elements.link-button>
            <x-elements.link-button class="w-[110px]" href="{{ route('tasks.edit', ['task' => $task]) }}">
                Edit
            </x-elements.link-button>
            <x-elements.link-button-danger class="w-[110px]" href="{{ route('tasks.destroy', ['task' => $task]) }}">
                Delete
            </x-elements.link-button-danger>
        </div>
    </div>

    <div class="w-5/12 flex justify-end items-center min-h-[50px]">

        <div x-show="!showTagInput" style="display: none;">
        @if($task->tags->isNotEmpty())
            @foreach($task->tags as $tag)
                <div class="group relarive inline-flex items-center">
                    <span class="inline-block bg-gray-200 text-gray-700 px-2 py-1 rounded-full text-xs mr-2">
                        {{ $tag->name }}
                        <x-elements.remove-tag href="{{ route('tasks.tags.remove', ['task' => $task, 'tag' => $tag]) }}">
                            x
                        </x-elements.remove-tag>
                    </span>
                </div>
            @endforeach
        @endif
            <x-elements.link-button
                type="button"
                x-on:click="showTagInput = true">
                + Add Tags
            </x-elements.link-button>
        </div>

        <div x-show="showTagInput" style="display: none;">
            <form method="POST" action="{{ route('tasks.tags.store', ['task' => $task]) }}" class="flex items-center space-x-2">
                @csrf
                <x-forms.text-input
                    type="text"
                    name="tag_name"
                    placeholder="Enter tag name"
                    class="text-sm"
                    @keydown.escape="showTagInput = false" />
                <x-elements.primary-button type="submit">
                    Add
                </x-elements.primary-button>
                <button 
                    type="button" 
                    x-on:click="showTagInput = false"
                    class="inline-flex items-center px-4 py-2 bg-gray-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-400 focus:bg-gray-400 active:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition ease-in-out duration-150">
                    Cancel
                </button>
            </form>
        </div>
    </div>
</div>