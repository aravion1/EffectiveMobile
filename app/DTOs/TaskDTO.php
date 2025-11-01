<?php

namespace App\DTOs;

final readonly class TaskDTO
{
    public function __construct(
        public string  $title,
        public string  $status,
        public ?string $description = null,
        public ?int $id = null,
    )
    {

    }
}