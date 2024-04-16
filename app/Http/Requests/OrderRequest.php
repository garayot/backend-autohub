<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrderRequest extends FormRequest
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
    // OrdersRequest.php  

    public function rules()
    {
        return [
            'customer_ID' => 'required|exists:users,id',
            'car_ID' => 'required|exists:units,car_ID',
            'date' => 'required|date',
            'status' => 'required|in:complete,incomplete',
            
        ];
    }
}
