<?php

use App\Models\Article;
use App\Models\Category;
use App\Models\User;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('radu', function (){

    $user = User::find(1);
    $categories = [
        [
            'ro' => [
                'title' => 'Politic',
                'slug' => Str::slug('Politic'),
                'old_number' => 1
            ],
            'ru' => [
                'title' => 'Политика',
                'slug' => Str::slug('Политика')
            ],
            'en' => [
                'title' => 'Political',
                'slug' => Str::slug('Political')
            ]
        ],
        [
            'ro' => [
                'title' => 'Social',
                'slug' => Str::slug('Social'),
                'old_number' => 2
            ],
            'ru' => [
                'title' => 'Общество',
                'slug' => Str::slug('Общество')
            ],
            'en' => [
                'title' => 'Social',
                'slug' => Str::slug('Social')
            ]
        ],
        [
            'ro' => [
                'title' => 'Economic',
                'slug' => Str::slug('Economic'),
                'old_number' => 3

            ],
            'ru' => [
                'title' => 'Экономика',
                'slug' => Str::slug('Экономика')
            ],
            'en' => [
                'title' => 'Financial',
                'slug' => Str::slug('Financial')
            ]
        ],
        [
            'ro' => [
                'title' => 'Cultura',
                'slug' => Str::slug('Cultura'),
                'old_number' => 7
            ],
            'ru' => [
                'title' => 'Культура',
                'slug' => Str::slug('Культура')
            ],
            'en' => [
                'title' => 'Cultural',
                'slug' => Str::slug('Cultural')
            ]
        ],
        [
            'ro' => [
                'title' => 'Sport',
                'slug' => Str::slug('Sport'),
                'old_number' => 8

            ],
            'ru' => [
                'title' => 'Спорт',
                'slug' => Str::slug('Спорт')
            ],
            'en' => [
                'title' => 'Sport',
                'slug' => Str::slug('Sport')
            ]
        ],
        [
            'ro' => [
                'title' => 'Externe',
                'slug' => Str::slug('Externe'),
                'old_number' => 4
            ],
            'ru' => [
                'title' => 'B мире',
                'slug' => Str::slug('B мире')
            ],
            'en' => [
                'title' => 'International',
                'slug' => Str::slug('International')
            ]
        ],
        [
            'ro' => [
                'title' => 'Editorial',
                'slug' => Str::slug('Editorial'),
                'old_number' => 5
            ],
            'ru' => [
                'title' => 'мнения',
                'slug' => Str::slug('мнения')
            ],
            'en' => [
                'title' => 'Editorials',
                'slug' => Str::slug('Editorials'),
            ]
        ],
        [
            'ro' => [
                'title' => 'Investigații',
                'slug' => Str::slug('Investigații'),
                'old_number' => 6
            ],
            'ru' => [
                'title' => 'Pасследования',
                'slug' => Str::slug('Pасследования')
            ],
            'en' => [
                'title' => 'Investigations',
                'slug' => Str::slug('Investigations')
            ]
        ],
        [
            'ro' => [
                'title' => 'Anti-Fake',
                'slug' => Str::slug('Anti-Fake'),
                'old_number' => 26
            ],
            'ru' => [
                'title' => 'Anti-Fake',
                'slug' => Str::slug('Anti-Fake')
            ],
            'en' => [
                'title' => 'Anti-Fake',
                'slug' => Str::slug('Anti-Fake')
            ]
        ],

    ];

//    dump(json_encode($categories, JSON_PRETTY_PRINT));
    $catData = file_get_contents(base_path('database/JsonData/categories.json'));

    $items = json_decode($catData);

    foreach ($items as $item) {
        app()->setLocale('ro');

        if($item->language==='ro'){
            \App\Models\Category::create([
                'title' => ucfirst($item->title),
                'slug' => \Illuminate\Support\Str::slug($item->title),
                'old_number' => $item->number,
            ]);
        } else {
            $category = Category::where('old_number',$item->number)->first();
            app()->setLocale($item->language);
            $category->update([
                'title' => ucfirst($item->title),
                'slug' => \Illuminate\Support\Str::slug($item->title),
            ]);
        }

    }


    return new \App\Http\Resources\ArticleCollection(
        Article::translatedIn('ro')
            ->whereTranslationLike('title','%nunc%')
            ->get()
    );
});
