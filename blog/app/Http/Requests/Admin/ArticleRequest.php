<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class ArticleRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title'        => ['required', 'string', 'max:255'],
            'slug'         => ['nullable', 'string', 'max:255'],
            'content'      => ['required', 'string'],

            'status'       => ['required', 'in:draft,published,archived'],
            'is_featured'  => ['nullable', 'boolean'],

            'image'        => ['nullable', 'image', 'max:2048'],
            'remove_image' => ['nullable', 'boolean'],

            'videos'       => ['nullable', 'array'],
            'videos.*'     => ['file', 'mimes:mp4,webm,ogg,avi,mov,wmv', 'max:512000'],

            'categories'   => ['required', 'array'],
            'categories.*' => ['exists:categories,id'],

            'tags'         => ['nullable'],
        ];
    }

    public function messages(): array
    {
         return [
            'title.required'        => __('articles.validation.title_required'),
            'title.max'             => __('articles.validation.title_max'),

            'content.required'      => __('articles.validation.content_required'),

            'status.required'       => __('articles.validation.status_required'),
            'status.in'             => __('articles.validation.status_invalid'),

            'image.image'           => __('articles.validation.image_invalid'),
            'image.max'             => __('articles.validation.image_max'),

            'videos.array'          => __('articles.validation.videos_array'),
            'videos.*.mimes'        => __('articles.validation.videos_mimes'),
            'videos.*.max'          => __('articles.validation.videos_max'),

            'categories.required'   => __('articles.validation.categories_required'),
            'categories.array'      => __('articles.validation.categories_array'),
            'categories.*.exists'   => __('articles.validation.categories_exists'),
        ];
    }
}
