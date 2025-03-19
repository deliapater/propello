@props([
'task' => null,
])

<div class="w-full flex py-2 border-b border-gray-100 items-center" x-data="{ showTagInput: false }" x-init="console.log('Alpine initialized', showTagInput)">
    <div class="w-2/12 flex items-center {{ $task?->complete ? 'line-through' : '' }}">
        {{ $task?->name }}
    </div>

    <div class="w-2/12 flex items-center">
        {{ $task?->created_at->format('jS M Y') }}
    </div>

    <div class="w-4/12 flex items-center justify-start space-x-2 min-h-[50px]">
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

    <div class="w-5/12 flex justify-end">
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

        <div x-show="!showTagInput" style="display: none;">
            <x-elements.link-button
                type="button"
                class="text-blue-500 hover:text-blue-700 cursor-pointer"
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
                <button type="button" class="bg-gray-500 text-white px-4 py-2 rounded" @click.prevent="showTagInput = false">
                    Cancel
                </button>
            </form>
        </div>
    </div>
</div>