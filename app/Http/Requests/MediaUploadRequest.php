<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MediaUploadRequest extends FormRequest
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
            'model_type' => ['sometimes', 'required', 'string', 'max:191'],
            'model_id' => ['sometimes', 'required', 'numeric'],
            'file' => ['file', 'max:5000']
        ];
    }
}
