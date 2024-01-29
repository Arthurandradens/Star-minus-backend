<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MovieRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'url' => 'required|url',
            'type' => 'required|string|max:6',
            'movie_id' => 'required|integer'
        ];
    }

    public function validate()
    {
        return [
            'movie' => [
                'name' => request()->name,
                'url' => request()->url,
                'type' => request()->type,
                'movie_id' => request()->movie_id
//               'name' => $request->input('name'),
//               'url' => $request->input('url'),
//               'type' => $request->input('type'),
//               'movie_id' => $request->input('movie_id'),
            ]
        ];
    }
}
