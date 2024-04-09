<?php

namespace App\Search;

use App\Http\Resources\ArticleCollection;
use App\Models\Article;
use App\Search\SearchRepository;

class EloquentRepository implements SearchRepository {

  public function search(string $term) {
    return Article::whereTranslationLike('title', 'like', "%$term%")
        ->get();
  }
//select * from `articles` where exists
// (select * from `article_translations` where `articles`.`id` = `article_translations`.`article_id` and `locale` = ?) and `body` like ? or `lead` like ? or `title` like ?
}
