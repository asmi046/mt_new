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
             'phone.required' => 'Поле "Телефон" должно быть заполнено',
             'email.required' => 'Поле "e-mail" должно быть заполнено',
             'clients.*.fio.required' => 'Поле "ФИО" должно быть заполнено',
             'clients.*.dr.required' => 'Поле "Дата рождения" должно быть заполнено',
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
            "phone" => "required|string",
            "email" => "required|string",
            "clients.*.fio"  => "required|string",
            "clients.*.dr"  => "required|string",
            "clients.*.document_type" => "required|string",
            "clients.*.document_number" => "required|string",
        ];
    }
}
