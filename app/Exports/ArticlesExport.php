<?php

namespace App\Exports;
use App\Http\Resources\ArticleResource;
use App\Models\Article;
use Maatwebsite\Excel\Concerns\FromCollection;
class ArticlesExport implements FromCollection {
    public function collection() {
        return Article::all();
    }
}
