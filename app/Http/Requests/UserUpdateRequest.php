<?php

namespace App\Http\Requests;

use App\Rules\CurrentPasswordRule;

class UserUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        $id = $this->segment(2) === 'me' ? $this->user()->id : $this->segment(3);
        return $this->user()->can('users.update') || $id === $this->user()->id;
    }
    public function validationData()
    {

        return $this->all();
    }
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        $ignoreId = $this->segment(2) === 'me' ? $this->user()->id : $this->segment(3);
        return [
            'email'              => [
                'email',
                'max:250',
                'unique:users,email,' . $ignoreId,
                'sometimes'
            ],
            'name'               => [
                'string',
                'max:250',
                'sometimes'
            ],
            'anti_phishing_code' => [
                'nullable',
                'alpha_dash',
                'min:4',
                'max:20',
                'sometimes'
            ],
            'password'         => [
                'sometimes',
                'confirmed',
                'min:8',
            ],
            'phone'   =>[
                'sometimes',
                'string',
                'regex:/(01)[0-9]{9}/'
            ],
            'date_of_birth'=>[
                'sometimes',
                'date'
            ],
        ];
    }
}
