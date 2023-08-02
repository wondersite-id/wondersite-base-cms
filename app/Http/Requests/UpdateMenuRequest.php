<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateMenuRequest extends FormRequest
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
            'parent_id' => '',
            'name' => 'required|max:255',
            'type' => Rule::in(['header', 'footer']),
            'sequence_number' => 'integer|min:1',
            'url' => 'required',
            'published_at' => '',
            'is_open_in_new_tab' => '',
        ];
    }
}