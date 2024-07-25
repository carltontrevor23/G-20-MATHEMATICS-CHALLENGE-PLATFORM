<?php

namespace App\Imports\Concerns;

use Illuminate\Database\Eloquent\Model;

interface ToModel
{
    /**
     * @param array $row
     * 
     * @return Model|null
     */
    public function model (array $row);
}