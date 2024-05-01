<?php

namespace App\Console\Commands;

use App\Http\Resources\ArticleResource;
use App\Models\Article;
use App\Models\ArticleTranslation;
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

        Log::info(json_encode($translations));
    }
}
