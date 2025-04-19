<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        $post = $this->route('post');
        return auth()->check() && (!$post || $post->user_id === auth()->id());    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title'   => 'required|min:5|string|max:100|regex:/^[\pL\s]+$/u',
            'content' => 'required|string|min:5',
            'image'   => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ];
    }
    public function messages(): array
    {
        return [
            'title.required' => 'The post title is required.',
            'title.min' => 'The title must be at least 5 characters.',
            'title.max' => 'The title must not exceed 100 characters.',
            'title.regex' => 'The title may only contain letters and spaces.',
            'content.required' => 'The post content is required.',
            'image.image' => 'The file must be an image.',
            'image.mimes' => 'The image must be a file of type: jpg, jpeg, png.',
            'image.max' => 'The image size must not exceed 2MB.',
        ];
    }

}
