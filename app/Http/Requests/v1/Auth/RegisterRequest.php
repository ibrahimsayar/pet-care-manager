<?php

namespace App\Http\Requests\v1\Auth;

use App\Constants\GenderConstants;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use JetBrains\PhpStorm\ArrayShape;

class RegisterRequest extends FormRequest
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
            'name' => [
                'required',
                'string',
                'min:1',
                'max:255',
            ],
            'last_name' => [
                'required',
                'string',
                'min:1',
                'max:255',
            ],
            'email' => [
                'required',
                'email',
                'unique:users,email',
            ],
            'password' => [
                'required',
                'string',
                'min:10',
                'regex:/[a-z]/',
                'regex:/[A-Z]/',
                'regex:/[\d$^+*()\-!#%&\/:;<=>?@[\]^_`{|}~]/'
            ],
            'phone_number' => [
                'required',
                'string',
                'min:10',
                'max:25',
            ],
            'gender' => [
                'required',
                Rule::in(GenderConstants::GENDERS),
            ],
            'city_id' => [
                'required',
                'integer',
                'exists:cities,id',
            ],
            'district_id' => [
                'required',
                'integer',
                'exists:districts,id',
            ],
            'address' => [
                'required',
                'string',
                'min:1',
                'max:1000'
            ],
        ];
    }

    /**
     * @return array{email.unique: mixed, password.regex: mixed, gender.in: mixed, city_id.exists: mixed, districts_id.exists: mixed}
     */
    #[ArrayShape([
        'email.unique' => "mixed",
        'password.regex' => "mixed",
        'gender.in' => "mixed",
        'city_id.exists' => "mixed",
        'districts_id.exists' => "mixed"
    ])] public function messages(): array
    {
        return [
            'email.unique' => __('custom_validation.unique'),
            'password.regex' => __('custom_validation.password_regex'),
            'gender.in' => __('custom_validation.gender_in'),
            'city_id.exists' => __('custom_validation.city_exists'),
            'districts_id.exists' => __('custom_validation.district_exists'),
        ];
    }

    /**
     * @return void
     */
    public function prepareForValidation(): void
    {
        $this->merge([
            'phone_number' => substr(
                preg_replace('/[^0-9]/', '', $this->input('phone_number')), -10
            ),
        ]);
    }
}
