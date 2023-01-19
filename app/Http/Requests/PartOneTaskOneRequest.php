<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationData;
use Spatie\Permission\Exceptions\UnauthorizedException;

class PartOneTaskOneRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if(!$this->request->has('start_number') || !$this->request->has('end_number'))
            throw new UnauthorizedException(403,"you must send start_number and end_number as a parameters");
            return true;
    }

    public function validationData()
    {
//        try{
            $this->request->set('start_number',(int)$this->request->get('start_number'));
            $this->request->set('end_number',(int)$this->request->get('description'));
//        }catch (\Throwable|\Exception  $e){
////            dd($e->getMessage());
//        }
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
            'start_number'=>['required','integer'],
            'end_number'=>['required','integer','gt:start_number','max:10000000000'],

        ];
    }
    public function messages()
    {
        return [

        ];
    }
}
