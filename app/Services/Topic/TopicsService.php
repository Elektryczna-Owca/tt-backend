<?php

namespace App\Services\Topic;

use App\Models\Topic;

class TopicsService
{

    public function storeTopic(StoreTopicDTO $storeTopicDTO): Topic
    {
        $topic = new Topic();
        $topic->setAttribute(Topic::NAME, $storeTopicDTO->name);
        $topic->setAttribute(Topic::DESCRIPTION, $storeTopicDTO->description);

        $topic->save();

        return $topic->fresh();
    }
}
