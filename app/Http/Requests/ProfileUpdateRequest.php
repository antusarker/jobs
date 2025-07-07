<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfileUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'string',
                'lowercase',
                'email',
                'max:255',
                Rule::unique(User::class)->ignore($this->user()->id),
            ],
            'expected_salary' => [
                Rule::requiredIf($this->user()->role_id === 3),
                'numeric',
                'min:0',
            ],
            'location' => 'required|integer',
            'phone' => ['nullable', 'string', 'max:20'],
            'website' => ['nullable', 'string'],
            'linkedin' => ['nullable', 'string']
        ];
    }
}
