<?php

namespace App\Console\Commands;

use App\Http\Resources\ArticleResource;
use App\Models\Article;
use App\Models\ArticleTranslation;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class PublishSubmittedArticles extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'publish:articles';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $translations = ArticleTranslation::where('status','S')->get();

        $now = Carbon::now();

        foreach ($translations as $translation) {

            $publish_at = Carbon::parse($translation->publish_at);

            if($now->hour === $publish_at->hour && $now->minute === $publish_at->minute) {

                $translation->update([
                   'status' => 'P',
                   'published_at' => $now,
                   "publish_at" => null,
                ]);
            }


        }

    }
}
