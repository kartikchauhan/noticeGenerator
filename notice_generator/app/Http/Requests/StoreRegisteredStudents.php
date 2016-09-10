<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class StoreRegisteredStudents extends Request
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

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required',
            'student_no' => 'required|unique:students|max:8',
            'email' => 'required|email|max:255|unique:students',
            'course' => 'required',
            'branch' => 'required',
            'year' => 'required',
            'section' => 'required',
            'password' => 'required|min:6|confirmed',
        ];
    }
}
