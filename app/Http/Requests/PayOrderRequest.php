<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class PayOrderRequest extends FormRequest
{

    protected $redirect = '/pay/create_pay_order';
    protected $stopOnFirstFailure = true;

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

            /**
     * Получить сообщения об ошибках для определенных правил валидации.
     *
     * @return array
     */

     public function messages()
     {
         return [
             'name.required' => 'Поле "Имя" должно быть заполнено',
             'price.required' => 'Поле "Цена" должно быть заполнено',
             'price.numeric' => 'Поле "Цена" должно быть числовым',
         ];
     }

     public function failedValidation(Validator $validator)
     {
         $errors = $validator->errors();
        throw new HttpResponseException(response()->json([
            'success' => false,
            'message' => 'Validation errors',
            'data' => $errors
        ], 422));
     }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            "name" => ['required'],
            "price" => ['required', 'numeric'],
            "type" => [],
            "status"  => [],
            "img" => [],
            "phone" => [],
            "email" => [],
            "start_data" => [],
        ];
    }
}
