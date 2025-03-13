@props([
'task' => null,
])

<div class="w-full flex py-2 border-b border-gray-100 items-center">
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
            <span class="inline-block bg-gray-200 text-gray-700 px-2 py-1 rounded-full text-xs mr-2 mb-2">
                {{ $tag->name }}
                <a href="{{ route('tasks.tags.remove', ['task' => $task, 'tag' => $tag]) }}"
                    class="ml-1 text-gray-500 hover:text-red-500"
                    title="Remove Tag">
                    x
                </a>
            </span>
        </div>
        @endforeach
        @endif
        <x-elements.link-button href="{{ route('tasks.tags.edit', ['task' => $task]) }}">
            + Add Tags
        </x-elements.link-button>
    </div>
</div>