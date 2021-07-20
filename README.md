# Automatically parse Page Number and Page Size to Laravels Pagaintor

[![Latest Version on Packagist](https://img.shields.io/packagist/v/lioneagle/lioneagle-paginator.svg?style=flat-square)](https://packagist.org/packages/lioneagle/lioneagle-paginator)
[![GitHub Tests Action Status](https://img.shields.io/github/workflow/status/lioneagle/lioneagle-paginator/run-tests?label=tests)](https://github.com/lioneagle/lioneagle-paginator/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/workflow/status/lioneagle/lioneagle-paginator/Check%20&%20fix%20styling?label=code%20style)](https://github.com/lioneagle/lioneagle-paginator/actions?query=workflow%3A"Check+%26+fix+styling"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/lioneagle/lioneagle-paginator.svg?style=flat-square)](https://packagist.org/packages/lioneagle/lioneagle-paginator)

---

This repo can be used to scaffold a Laravel package. Follow these steps to get started:

1. Press the "Use template" button at the top of this repo to create a new repo with the contents of this lioneagle-paginator
2. Run "./configure-lioneagle-paginator.sh" to run a script that will replace all placeholders throughout all the files
3. Remove this block of text.
4. Have fun creating your package.
5. If you need help creating a package, consider picking up our <a href="https://laravelpackage.training">Laravel Package Training</a> video course.

---

This is where your description should go. Limit it to a paragraph or two. Consider adding a small example.

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
