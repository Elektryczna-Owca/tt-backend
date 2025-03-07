<?php

namespace App\Console\Commands;

use App\Models\Question;
use App\Models\Tag;
use App\Models\Topic;
use Illuminate\Console\Command;
use Illuminate\Support\Collection;

class ImportTopics extends Command
{
    const int NAME = 0;
    const int DESCRIPTION = 1;
    const int TAGS = 2;
    const int QUESTIONS = 3;

    const string CSV_SEPARATOR = ';';

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:topics-from-csv';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update topics from csv file';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Updating topics...');

        $file = fopen(app_path('Console/resources/topics.csv'), 'r');

        while (($line = fgetcsv($file, separator: self::CSV_SEPARATOR)) !== false) {
            $name = trim($line[self::NAME]);
            $description = trim($line[self::DESCRIPTION]);

            $topic = $this->createTopic($name, $description);

            $this->info('Topic ' . $name . ' created');
            $tags = $this->updateTags($line[self::TAGS]);

            $topic->tags()->sync($tags);

            $topic = $topic->refresh()->loadMissing('tags');
            $this->info('Tags ' . $tags->pluck('name') . ' updated');

            $this->updateQuestions($topic, $line[self::QUESTIONS]);
        }

        fclose($file);
    }

    private function createTopic(string $name, string $description): Topic
    {
        $topic = Topic::query()->where(Topic::NAME, $name)->first();

        if($topic) {
            $topic->setAttribute(Topic::DESCRIPTION, $description);
        } else {
            $topic = new Topic();
            $topic->setAttribute(Topic::NAME, $name);
            $topic->setAttribute(Topic::DESCRIPTION, $description);
        }

        $topic->save();

        return $topic;
    }

    /**
     * @param string $tags
     * @return Collection<Tag>
     */
    private function updateTags(string $tags): Collection
    {
        $tags = explode(',', $tags);
        $tagsCollection = collect();
        foreach($tags as $tag) {
            $tag = trim($tag);
            $tagModel = Tag::query()->where(Tag::NAME, $tag)->first();

            if(!$tagModel) {
                $tagModel = new Tag();
                $tagModel->setAttribute(Tag::NAME, $tag);
                $tagModel->save();
            }

            $tagsCollection->push($tagModel);
        }

        return $tagsCollection;
    }

    /** TODO: should I clear existing questions from topic */
    private function updateQuestions(Topic $topic, string $questions): void
    {
        $questions = explode(',', $questions);
        foreach($questions as $question) {
            $question = trim($question);
            $questionModel = Question::query()
                ->where(Question::TEXT, $question)
                ->where(Question::TOPIC_ID, $topic->getKey())
                ->first();

            if(!$questionModel) {
                $questionModel = new Question();
                $questionModel->setAttribute(Question::TEXT, $question);
                $questionModel->setAttribute(Question::TOPIC_ID, $topic->getKey());
                $questionModel->save();
            }
        }

    }

}
