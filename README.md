# Automatically parse Page Number and Page Size to Laravels Pagaintor

---

## Installation

You can install the package via composer:

```bash
composer require lioneagle/lioneagle-paginator
```

You can publish and run the migrations with:

You can publish the config file with:

```bash
php artisan vendor:publish --provider="Lioneagle\LioneaglePaginator\LioneaglePaginatorServiceProvider" --tag="lioneagle-paginator-config"
```

## Usage

```php
class UserController extends Controller
{
    public function index()
    {
        $users = User::paginator();

        return UserResource($users);
    }
}
```

Now a request formatted as below (when using the default config) will return a paginated response as expected;

```
/users?page[number]=5&page[size]=50
```

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](.github/CONTRIBUTING.md) for details.

## Credits

-   [James Mooring](https://github.com/lioneaglesolutions)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
