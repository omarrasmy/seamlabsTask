<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Spatie\Permission\Exceptions\UnauthorizedException;

class PartOneTaskTwoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if(!$this->request->has('input_string'))
            throw new UnauthorizedException(403,"you must send input_string as a parameter");
        return true;
    }

    public function validationData()
    {
        $this->request->set('input_string',(int)$this->request->get('input_string'));
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
            'input_string'=>['required','alpha']
        ];
    }
    public function messages()
    {
        return [

        ];
    }
}
