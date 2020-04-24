<?php

namespace Statch\Categories\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Kalnoy\Nestedset\NestedSet;
use Kalnoy\Nestedset\NodeTrait;
use Statch\Categories\Contracts\Category as CategoryContract;

// use Rinvex\Categories\Builders\EloquentBuilder;

class Category extends Model implements CategoryContract
{
    use NodeTrait;

    protected $fillable = [
        'slug',
        'name',
        'description',
        NestedSet::LFT,
        NestedSet::RGT,
        NestedSet::PARENT_ID,
    ];

    /**
     * Create a new Eloquent model instance.
     *
     * @param array $attributes
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->setTable(config('statch-categories.tables.categories'));
    }

    public static function rules()
    {
        return [
            'name' => 'required|string|max:150',
            'description' => 'nullable|string|max:10000',
            'slug' => 'required|alpha_dash|max:150|unique:'.config('statch-categories.tables.categories').',slug',
            NestedSet::LFT => 'sometimes|required|integer',
            NestedSet::RGT => 'sometimes|required|integer',
            NestedSet::PARENT_ID => 'nullable|integer',
        ];
    }

    /**
     * Get all attached models of the given class to the category.
     *
     * @param string $class
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphToMany
     */
    public function entries(string $class): MorphToMany
    {
        return $this->morphedByMany($class, 'categorizable', config('statch-categories.tables.categorizables'), 'category_id', 'categorizable_id');
    }

    // public function newEloquentBuilder($query)
    // {
    //     return new EloquentBuilder($query);
    // }
}
