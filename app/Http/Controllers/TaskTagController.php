<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\Tag;
use App\Http\Requests\UpdateTaskTagRequest;
use App\Http\Requests\StoreTaskTagRequest;

class TaskTagController extends Controller
{
    public function store(StoreTaskTagRequest $request, Task $task)
    {
        $tag = Tag::firstOrCreate([
            'name' => $request->tag_name,
            'user_id' => auth()->id()
        ]);

        if (!$task->tags->contains($tag->id)) {
            $task->tags()->attach($tag->id);
        }

        return back()->with('success', 'Tag added successfully');
    }

    public function edit(Task $task)
    {
        $this->authorize('update', $task);

        $availableTags = auth()->user()->tags()->orderBy('name')->get();
        $selectedTags = $task->tags->pluck('id')->toArray();

        return view('tasks.tags.edit', compact('task', 'availableTags', 'selectedTags'));
    }

    public function update(UpdateTaskTagRequest $request, Task $task)
    {
        $task->tags()->sync($request->validated('tags') ?? []);

        return redirect()->route('tasks.home')->with('success', 'Tags updated successfully');
    }

    public function remove(Task $task, Tag $tag)
    {
        $this->authorize('update', $task);

        if ($tag->user_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }

        $task->tags()->detach($tag);

        return back()->with('success', 'Tag removed from task.');
    }
}
