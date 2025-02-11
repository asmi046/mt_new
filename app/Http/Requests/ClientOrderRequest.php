<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class ClientOrderRequest extends FormRequest
{
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
             'uuid.required' => 'Платеж неопределен',
             'clients.*.fio.required' => 'Поле "Имя" должно быть заполнено',
             'clients.*.phone.required' => 'Поле "Телефон" должно быть заполнено',
             'clients.*.document_type.required' => 'Поле "Тип документа" должно быть заполнено',
             'clients.*.document_number.required' => 'Поле "Номер документа" должно быть заполнено',
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
            "uuid" => "required|string",
            "clients.*.fio" => "required|string",
            "clients.*.phone"  => "required|string",
            "clients.*.email" => [],
            "clients.*.document_type" => "required|string",
            "clients.*.document_number" => "required|string",
        ];
    }
}
