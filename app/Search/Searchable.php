<?php

namespace App\Search;

use App\Observers\ElasticSearchObserver;
use Elastic\Elasticsearch\Client;

trait Searchable {

    public static function bootSearchable()
    {
        if (config('services.search.enabled')) {
            static::observe(ElasticsearchObserver::class);
        }
    }

    public function elasticsearchIndex(Client $elasticsearchClient)
    {
        $elasticsearchClient->index([
            'index' => $this->getTable(),
            'type' => '_doc',
            'id' => $this->getKey(),
            'body' => $this->toSearchArray(),
        ]);
    }

    public function elasticsearchDelete(Client $elasticsearchClient)
    {
        $elasticsearchClient->delete([
            'index' => $this->getTable(),
            'type' => '_doc',
            'id' => $this->getKey(),
        ]);
    }

    public function elasticsearchMget(Client $elasticsearchClient, $ids) {
        $elasticsearchClient->mget([
            'body' => ['ids' => $ids]
        ]);
    }

    public function elasticsearchGet(Client $elasticsearchClient) {
        $elasticsearchClient->get([
            "index" => $this->getTable,
            "id" => $this->index_id
        ]);
    }

    abstract public function toSearchArray();

}
