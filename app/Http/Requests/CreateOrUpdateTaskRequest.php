<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @OA\Schema(
 *     title="CreateOrUpdateRequest",
 *     description="Модель данных для создания или обновления задач",
 *     type="object",
 *     @OA\Property (property="title", type="string", example="string"),
 *     @OA\Property (property="description", type="string", example="string"),
 *     @OA\Property (property="status", type="string", example="NEW", enum={"NEW", "COMPLETED", "CLOSED"}),
 * )
 */
class CreateOrUpdateTaskRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'title' => 'required|string|min:1|max:100',
            'description' => 'string|min:1|max:200',
            'status' => 'required|string|in:NEW,COMPLETED,CLOSED'
        ];
    }
}
