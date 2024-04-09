<?php

namespace App\Services;

use App\Models\Article;
use Illuminate\Support\Facades\Auth;

class ArticleService {

    public function lockArticle(Article $article) {
        $article->is_locked = true;
        $article->locked_by_user = Auth::user()->id;
        $article->save();
    }

    public function unlockArticle(Article $article) {
        $article->is_locked = false;
        $article->locked_by_user = null;
        $article->save();
    }

}
