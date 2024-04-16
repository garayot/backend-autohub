<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UnitsRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    // UnitsRequest.php

    public function rules()
    {
        return [
            'make' => 'required|string|max:255',
            'model_name' => 'required|string|max:255',
            'model_year' => 'required|integer|digits:4',
            'type' => 'required|string|max:255',
            'color' => 'required|string|max:255',
            'price' => 'required|numeric',
            'description' => 'nullable|string',
            'image1' => 'required|image|mimes:jpeg,png,jpg,gif',
            'image2' => 'nullable|image|mimes:jpeg,png,jpg,gif',
            'image3' => 'nullable|image|mimes:jpeg,png,jpg,gif',
        ];
    }
}
