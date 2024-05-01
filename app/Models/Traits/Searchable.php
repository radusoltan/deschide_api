<?php

namespace App\Models\Traits;

trait Searchable {

    public function getSearchType() {
        return '_doc';
    }

    public function getSearchIndex() {
        return $this->getTable();
    }

    public function getId() {
        return $this->id;
    }

    abstract public function toSearchArray();

}
