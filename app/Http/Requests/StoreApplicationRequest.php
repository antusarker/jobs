<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class StoreApplicationRequest extends FormRequest
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
            'cover_letter' => 'nullable|string',
            'resume_path' => 'required|file|mimes:pdf|max:2048'
        ];
    }

    public function messages(): array
    {
        return [
            'resume_path.required' => 'Resume is required.',
            'resume_path.mimes' => 'Only PDF format is allowed.',
            'resume_path.max' => 'File size must not exceed 2MB.',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        $errorList = '<ul>';
        foreach ($validator->errors()->all() as $error) {
            $errorList .= '<li>' . $error . '</li>';
        }
        $errorList .= '</ul>';

        throw new HttpResponseException(
            redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->with('flash_message', $errorList)
                ->with('status_color', 'warning')
        );
    }
}
