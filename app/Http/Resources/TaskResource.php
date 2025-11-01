<?php

namespace App\Http\Resources;

use App\DTOs\TaskDTO;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @OA\Schema(
 *     title="TaskResource",
 *     description="Задача",
 *     type="object",
 *     @OA\Property (property="id", type="integer", example="1"),
 *     @OA\Property (property="title", type="string", example="string"),
 *     @OA\Property (property="description", type="string", example="string"),
 *     @OA\Property (property="status", type="string", example="NEW", enum={"NEW", "COMPLETED", "CLOSED"}),
 * )
 */
class TaskResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        if (!($this->resource instanceof TaskDTO)) {
            throw new \Exception('Resource must be an instance of TaskDTO', 500);
        }

        return [
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
            'status' => $this->status
        ];
    }
}
