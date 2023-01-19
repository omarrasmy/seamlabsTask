<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EducationLevelUpdateRequest extends FormRequest
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
//        try{
//            if($this->request->has('title'))
//                $this->request->set('title',json_decode($this->request->get('title'),TRUE));
//            if($this->request->has('description'))
//                $this->request->set('description',json_decode($this->request->get('description'),TRUE));
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
            'title'=>['sometimes','array'],
            'title.ar'=>['required_with:title','string'],
            'title.en'=>['required_with:title','string'],
            'description'=>['sometimes','array'],
            'description.ar'=>['required_with:description','string'],
            'description.en'=>['required_with:description','string'],
        ];
    }
    public function messages()
    {
        return [

        ];
    }
}
