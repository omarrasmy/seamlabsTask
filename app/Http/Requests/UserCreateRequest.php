<?php

namespace App\Http\Requests;

use App\Rules\WeakPasswordRule;
use Illuminate\Foundation\Http\FormRequest;

class UserCreateRequest extends FormRequest
{

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
            return true;
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
    public function rules()
    {
        return  [
            'name'     => [
                'required',
                'string',
                'max:255',
            ],
            'email'    => [
                'required',
                'string',
                'email',
                'max:255',
                'unique:users,email',
            ],
            'password' => [
                'required',
                'string',
                'min:8',
                'confirmed'
            ],
            'phone'   =>[
                'required','string','regex:/(01)[0-9]{9}/'
            ],
            'date_of_birth'=>[
                'required',
                'date'
            ],
            'locale'   => [
                'nullable',
                'string',
                'in:en_US,pt_BR',
            ]
        ];
    }
    public function messages()
    {
        return [

        ];
    }
}
