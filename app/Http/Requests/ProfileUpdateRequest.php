<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

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
            'job_skill' => 'required|integer',
            'phone' => ['nullable', 'string', 'max:20'],
            'website' => ['nullable', 'string'],
            'linkedin' => ['nullable', 'string']
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
