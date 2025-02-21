<?php

namespace App\Services\Topic;

use App\Models\Topic;
use Illuminate\Database\Eloquent\Collection;

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

    /**
     * @return Collection<Topic>
     */
    public function getAll(): Collection
    {
        return Topic::query()
            ->get();
    }

    public function loadRelations(Topic $topic, array $relations = ['tags', 'questions']): Topic
    {
        return $topic->loadMissing($relations);
    }
}
