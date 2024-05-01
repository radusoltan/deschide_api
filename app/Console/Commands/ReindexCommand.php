<?php

namespace App\Console\Commands;

use App\Models\Article;
use App\Models\Category;
use Elastic\Elasticsearch\Client;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class ReindexCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'search:reindex';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Indexes all articles to Elasticsearch';

    public function __construct(Client $elasticsearch)
    {
        parent::__construct();

        $this->elasticsearch = $elasticsearch;
    }

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Indexing all articles. This might take a while...');



            foreach (Article::cursor() as $article)
            {
                $elasticArticle = $this->elasticsearch->index([
                    'index' => $article->getSearchIndex(),
                    'type' => $article->getSearchType(),
                    'body' => $article->toSearchArray(),
                ]);
                $article->index_id = $elasticArticle->asObject()->_id;
                $article->save();
                $this->output->write('.');
            }


        $this->info("\nDone!");
    }
}
