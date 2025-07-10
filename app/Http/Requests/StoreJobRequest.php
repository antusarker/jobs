<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class StoreJobRequest extends FormRequest
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
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'location' => 'required|integer',
            'min_salary' => 'required|numeric|min:0',
            'max_salary' => 'required|numeric|gte:min_salary',
            'job_type' => 'required|integer',
            'experience_level' => 'required|integer',
            'expires_at' => 'nullable|date|after:today',
            'is_active' => 'required|boolean',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        $errors = $validator->errors()->all();

        $errorList = '<ul>';
        $errorList .= '<b>Note: All Star <span style="color:red">(*)</span> mark is Required !</b>';
        foreach ($errors as $error) {
            $errorList .= "<li>$error</li>";
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
