<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddProductRequest extends FormRequest
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
            'name' => ['required','string','max:40'],
            'price' => ['required','numeric','gt:selling_price'],
            'selling_price' => ['required','numeric'],
            'product_img' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ];
    }
}
