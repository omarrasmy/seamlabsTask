<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Spatie\Permission\Exceptions\UnauthorizedException;

class PartOneTaskThreeRequest extends FormRequest
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
        return [
            'numbers'=>['required','array','max:10000','min:1'],
            'numbers.*'=>['integer','max:10000','min:0']
        ];
    }
    public function messages()
    {
        return [

        ];
    }
}
