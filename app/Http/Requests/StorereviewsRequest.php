<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorereviewsRequest extends FormRequest
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
            'hotel_id' => 'required|integer|exists:hotels,id',
            'rating' => 'required|integer|min:1|max:5',
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string|max:1000',
        ];
    }
}
