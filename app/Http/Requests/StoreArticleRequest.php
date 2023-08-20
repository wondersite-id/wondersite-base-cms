<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreArticleRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'article_type_id' => 'required',
            'name' => 'required|max:255',
            'short_description' => 'required',
            'content' => 'required',
            'image' => 'image|max:2048',
            'published_at' => 'nullable',

            // seo
            'seo_title' => 'required',
            'seo_description' => 'required',
            'seo_robots' => 'nullable',
            'seo_canonical_url' => 'nullable|url',
        ];
    }
}
