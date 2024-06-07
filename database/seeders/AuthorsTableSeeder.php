<?php

namespace Database\Seeders;

use App\Models\Author;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class AuthorsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        app()->setLocale('ro');
        dump(app()->getLocale());
        $data = json_decode(file_get_contents(base_path('data/authors.json')));

        foreach ($data->authors as $old_author) {
            [$firstName, $lastName] = explode(' ', $old_author->name);
            $path = parse_url($old_author->link, PHP_URL_PATH);
            // Explode the path into segments
            $segments = explode('/', trim($path, '/'));

            app()->setLocale('ro');
//            $author = Author::where("old_number", $segments[2])->first();
            Author::create([
                'first_name' => $firstName,
                "last_name" => $lastName,
                "full_name" => $firstName . ' ' . $lastName,
                'slug' => Str::slug($firstName . ' ' . $lastName),
                'old_number' => $segments[2],
            ]);
        }
    }
}
