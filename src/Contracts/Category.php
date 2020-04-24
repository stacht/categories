<?php

namespace Stacht\Categories\Contracts;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

interface Category
{
    public function entries(string $class): MorphToMany;
}
