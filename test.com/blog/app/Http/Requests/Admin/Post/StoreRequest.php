<?php

namespace App\Http\Requests\Admin\Post;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required|string',
            'content' => 'required|string',
            'preview_image' => 'required|file',
            'main_image' => 'required|file',
            'category_id' => 'required|integer|exists:categories,id',
            'tag_ids' => 'nullable|array',
            'tag_ids.*' => 'nullable|integer|exists:tags,id'
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'The title field is required.',
            'title.string' => 'Enter the correct string',
            'content.required' => 'The content field is required.',
            'content.string' => 'Enter the correct string',
            'preview_image.required' => 'The preview image field is required.',
            'preview_image.file' => 'Send image.',
            'main_image.required' => 'The main image field is required.',
            'main_image.file' => 'Send image.',
            'category_id.required'=> 'The category field is required.',
            'category_id.integer'=> 'Enter the number.',
            'category_id.exists'=> 'This category is not in the database.',
            'tag_ids.array' => 'An array is needed'
        ];
    }
}
