<?php

namespace App\Services\Topic;

use App\Models\Topic;

readonly class StoreTopicDTO
{

    public function __construct(
        public string $name,
        public string $description
    ) {
    }
}
