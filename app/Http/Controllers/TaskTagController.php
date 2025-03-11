<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\Tag;
use Illuminate\Http\Request;

class TaskTagController extends Controller
{
    public function edit(Task $task)
    {
        $this->authorize('update', $task);

        $availableTags = auth()->user()->tags()->orderBy('name')->get();
        $selectedTags = $task->tags->pluck('id')->toArray();

        return view('tasks.tags.edit', compact('task', 'availableTags', 'selectedTags'));
    }

    public function update(Request $request, Task $task)
    {
        $this->authorize('update', $task);

        $validated = $request->validate([
            'tags' => 'array',
            'tags.*' => 'exists:tags,id',
        ]);

        // if (!empty($validated['tags'])) {
        //     $userTagIds = auth()->user()->tags()->pluck('id')->toArray();
        //     $invalidTags = array_diff($validated['tags'], $userTagIds);

        //     if (!empty($invalidTags)) {
        //         return back()->withErrors(['tags' => 'Invalid tags selected.']);
        //     }
        // }

        $task->tags()->sync($validated['tags'] ?? []);

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