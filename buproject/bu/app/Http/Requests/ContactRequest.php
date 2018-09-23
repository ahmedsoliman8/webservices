<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }


    public function rules()
    {
        return [
            'contact_name' => 'required|min:5|max:100' ,
            'contact_email' => 'required|min:5|max:100',
            'contact_message' => 'required|min:5',
            'contact_type' =>'required|integer'

        ];
    }
}
