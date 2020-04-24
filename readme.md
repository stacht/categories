# Laravel Categories

**Statch Categories** is a polymorphic Laravel package, for category management. You can categorize any eloquent model with ease, and utilize the power of **Nested Sets**

Take a look at [contributing.md](contributing.md) to see a to do list.

## Installation

Via Composer

``` bash
$ composer require statch/categories
```

Publish configuration

```bash
$ php artisan vendor:publish --provider="Statch\Categories\CategoriesServiceProvider" --tag="config"
```

Publish migration

```bash
$ php artisan vendor:publish --provider="Statch\Categories\CategoriesServiceProvider" --tag="migrations"
```



## Usage

To add categories support to your eloquent models simply use `\Statch\Categories\Traits\Categorizable` trait.

### Manage your categories

Your categories are just normal [eloquent](https://laravel.com/docs/master/eloquent) models, so you can deal with it like so.

### Manage your categorizable model

The API is intutive and very straightfoward, so let's give it a quick look:

```php
// Get instance of your model
$post = new \App\Models\Post::find();

// Get attached categories collection
$post->categories;

// Get attached categories query builder
$post->categories();
```

You can attach categories in various ways:

```php
use Statch\Categories\Models\Category;

// Single category id
$post->attachCategories(1);

// Multiple category IDs array
$post->attachCategories([1, 2, 5]);

// Multiple category IDs collection
$post->attachCategories(collect([1, 2, 5]));

// Single category model instance
$categoryInstance = Category::first();
$post->attachCategories($categoryInstance);

// Single category slug
$post->attachCategories('test-category');

// Multiple category slugs array
$post->attachCategories(['first-category', 'second-category']);

// Multiple category slugs collection
$post->attachCategories(collect(['first-category', 'second-category']));

// Multiple category model instances
$categoryInstances = Category::whereIn('id', [1, 2, 5])->get();
$post->attachCategories($categoryInstances);
```

> **Notes:**
>
> - The `attachCategories()` method attach the given categories to the model without touching the currently attached categories, while there's the `syncCategories()` method that can detach any records that's not in the given items, this method takes a second optional boolean parameter that's set detaching flag to `true` or `false`.
> - To detach model categories you can use the `detachCategories()` method, which uses **exactly** the same signature as the `attachCategories()` method, with additional feature of detaching all currently attached categories by passing null or nothing to that method as follows: `$post->detachCategories();`.

And as you may have expected, you can check if categories attached:

```php
use Statch\Categories\Models\Category;

// Single category id
$post->hasAnyCategories(1);

// Multiple category IDs array
$post->hasAnyCategories([1, 2, 5]);

// Multiple category IDs collection
$post->hasAnyCategories(collect([1, 2, 5]));

// Single category model instance
$categoryInstance = Category::first();
$post->hasAnyCategories($categoryInstance);

// Single category slug
$post->hasAnyCategories('test-category');

// Multiple category slugs array
$post->hasAnyCategories(['first-category', 'second-category']);

// Multiple category slugs collection
$post->hasAnyCategories(collect(['first-category', 'second-category']));

// Multiple category model instances
$categoryInstances = Category::whereIn('id', [1, 2, 5])->get();
$post->hasAnyCategories($categoryInstances);
```

> **Notes:**
>
> - The `hasAnyCategories()` method check if **ANY** of the given categories are attached to the model. It returns boolean `true` or `false` as a result.
> - Similarly the `hasAllCategories()` method uses **exactly** the same signature as the `hasAnyCategories()`method, but it behaves differently and performs a strict comparison to check if **ALL** of the given categories are attached.

###

## Extending

If you need to EXTEND the existing `Category` model note that:

- Your `Category` model needs to extend the `Statch\Categories\Models\Category` model

If you need to REPLACE the existing `Category` model  you need to keep the following things in mind:

- Your `Category` model needs to implement the `Statch\Categories\Contracts\Category` contract

In BOTH cases, whether extending or replacing, you will need to specify your new model in the configuration. To do this you must update the `models` value in the configuration file after publishing the configuration with this command:

```
php artisan vendor:publish --provider="Statch\Categories\CategoriesServiceProvider" --tag="config"
```



## Change log

Please see the [changelog](changelog.md) for more information on what has changed recently.

## Testing

``` bash
$ composer test
```

## Contributing

Please see [contributing.md](contributing.md) for details and a todolist.

## Security

If you discover any security related issues, please email corrado.striuli@gmail.com instead of using the issue tracker.

## Credits

- [Corrado Striuli][link-author]
- [All Contributors][link-contributors]

## License

MIT. Please see the [license file](license.md) for more information.

[link-author]: https://bitbucket.com/statch
[link-contributors]: ../../contributors
