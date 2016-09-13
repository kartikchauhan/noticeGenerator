<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class CreateNotice extends Request
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
        $rules = [
            'courses' => 'required',
            'branches' => 'required',
            'years' => 'required',
            'sections' => 'required',
            'subject' => 'required',  
            'files' => 'required|array|min:1',
        ];

        $files = $this->file('files');

        if(!empty($files))
        {
            foreach($files as $key => $file)
            {
                $rules[sprintf('files.%d', $key)] = 'required|mimes:pdf,png,jpeg,jpg,doc,docx';
            }
        }

        return $rules;
    }
}
