@props([
    'task'  => null,
])

<div class="w-full flex py-2 border-b border-gray-100 items-center">
    <div class="w-5/12 flex items-center {{ $task?->complete ? 'line-through' : '' }}">
        {{ $task?->name }}
    </div>

    <div class="w-2/12 flex items-center">
        {{ $task?->created_at->format('jS M Y') }}
    </div>

    <div class="w-6/12 flex items-center justify-start space-x-2">
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

    <div class="flex flex-wrap items-center">
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
            <a href="{{ route('tasks.tags.edit', ['task' => $task]) }}" 
               class="text-blue-700 hover:text-blue-500 text-xs ml-2">
                Edit Tags
            </a>
        @else
            <a href="{{ route('tasks.tags.edit', ['task' => $task]) }}" 
               class="text-blue-500 hover:text-blue-700 text-xs">
                Add Tags
            </a>
        @endif
    </div>
</div>