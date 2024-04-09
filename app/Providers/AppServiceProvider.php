<?php

namespace App\Providers;

use App\Search\ElasticSearchRepository;
use App\Search\EloquentRepository;
use App\Services\ArticleService;
use App\Services\ImageService;
use Elastic\Elasticsearch\Client;
use Elastic\Elasticsearch\ClientBuilder;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {

        $this->app->bind(ElasticSearchRepository::class, function ($app){

            if (! config('services.elasticsearch.enabled')) {
                return new EloquentRepository();
            }

            return new ElasticSearchRepository(
                $app->make(Client::class)
            );

        });

        $this->bindSearchClient();
        $this->app->bind(ArticleService::class, function (){
            return new ArticleService();
        });
        $this->app->bind(ImageService::class, function (){
            return new ImageService();
        });
    }

    private function bindSearchClient(){
        $this->app->bind(Client::class, function ($app){

            return ClientBuilder::create()
                ->setHosts($app['config']->get('services.search.hosts'))
                ->setApiKey(env("ELASTICSEARCH_API_KEY"))
                ->setSSLVerification(false)
                ->build();
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
    }
}
