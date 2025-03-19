<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTaskTagRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user()->can('update', $this->route('task'));
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'tags' => 'array',
            'tags.*' => 'exists:tags,id',
        ];
    }

    protected function passedValidation()
    {
        if (!empty($this->validated('tags'))) {
            $userTagIds = $this->user()->tags()->pluck('id')->toArray();
            $invalidTags = array_diff($this->validated('tags'), $userTagIds);

            if (!empty($invalidTags)) {
                $this->failedValidation(
                    \Illuminate\Support\Facades\Validator::make(
                        [], 
                        [], 
                        ['tags' => 'Invalid tags selected.']
                    )
                );
            }
        }
    }
}
