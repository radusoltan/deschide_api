<?php

namespace App\Search;

interface SearchRepository {

    public function search(string $query);

}
