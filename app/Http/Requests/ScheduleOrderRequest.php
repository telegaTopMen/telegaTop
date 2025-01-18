<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class ScheduleOrderRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255', // Название кампании
            'channels' => 'required|array',     // Массив каналов
            'channels.*.link' => 'required|string',        // Ссылка на канал
            'channels.*.service_id' => 'required|integer', // ID сервиса
            'channels.*.orders' => 'required|array',       // Массив заказов для лесенки
            'channels.*.orders.*.hour' => 'required|integer|min:0', // Через сколько часов
            'channels.*.orders.*.quantity' => 'required|integer|min:1' // Количество подписчиков
        ];
    }
}
