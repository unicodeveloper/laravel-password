# laravel-password

[![Latest Stable Version](https://poser.pugx.org/unicodeveloper/laravel-password/v/stable.svg)](https://packagist.org/packages/unicodeveloper/laravel-password)
[![License](https://poser.pugx.org/unicodeveloper/laravel-password/license.svg)](LICENSE.md)
[![Quality Score](https://img.shields.io/scrutinizer/g/unicodeveloper/laravel-password.svg?style=flat-square)](https://scrutinizer-ci.com/g/unicodeveloper/laravel-password)
[![Total Downloads](https://img.shields.io/packagist/dt/unicodeveloper/laravel-password.svg?style=flat-square)](https://packagist.org/packages/unicodeveloper/laravel-password)

> #### Guard your users from security problems by preventing them from having dumb passwords

### Introduction

This package can be used to verify **the user provided password is
not one of the top 10,000 worst passwords** as analyzed by a respectable IT security analyst. Read
about all [ here](https://xato.net/10-000-top-passwords-6d6380716fe0#.473dkcjfm),
[here(wired)](http://www.wired.com/2013/12/web-semantics-the-ten-thousand-worst-passwords/) or
[here(telegram)](http://www.telegraph.co.uk/technology/internet-security/10303159/Most-common-and-hackable-passwords-on-the-internet.html)


## Installation

[PHP](https://php.net) 5.5+ or [HHVM](http://hhvm.com) 3.3+, and [Composer](https://getcomposer.org) are required.

To get the latest version of Laravel Password, simply add the following line to the require block of your `composer.json` file.

```
"unicodeveloper/laravel-password": "1.0.*"
```

You'll then need to run `composer install` or `composer update` to download it and have the autoloader updated.

- If you're on Laravel 5.5 or above, that's all you need to do! Check out the usage examples below.
- If you're on Laravel < 5.5, you'll need to register the service provider. Open up `config/app.php` and add the following to the `providers` array:

```php
Unicodeveloper\DumbPassword\DumbPasswordServiceProvider::class
```

## Usage

Use the rule `dumbpwd` in your validation like so:

```php
/**
 * Get a validator for an incoming registration request.
 *
 * @param  array  $data
 * @return \Illuminate\Contracts\Validation\Validator
 */
protected function validator(array $data)
{
    return Validator::make($data, [
        'name' => 'required|max:255',
        'email' => 'required|email|max:255|unique:users',
        'password' => 'required|min:6|dumbpwd|confirmed',
    ]);
}
```

Error shows on the page like so:

<img width="1093" alt="screen shot 2016-07-02 at 2 12 14 pm" src="https://cloud.githubusercontent.com/assets/2946769/16540503/103e0390-405f-11e6-9c4c-5d02dc1ce7ec.png">

<img width="1095" alt="screen shot 2016-07-02 at 1 22 45 pm" src="https://cloud.githubusercontent.com/assets/2946769/16540468/c6bd71f2-405d-11e6-8f34-d3a9b1b27e77.png">

By default, the error message returned is `This password is just too common. Please try another!`.

You can customize the error message by opening `resources/lang/en/validation.php` and adding to the array like so:

```php
  'dumbpwd' => 'You are using a dumb password abeg',
```

## Change log

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please feel free to fork this package and contribute by submitting a pull request to enhance the functionalities.

## Inspiration

* [Eugene Mutai](https://github.com/kn9ts/dumb-passwords)

## How can I thank you?

Why not star the github repo? I'd love the attention! Why not share the link for this repository on Twitter or HackerNews? Spread the word!

Don't forget to [follow me on twitter](https://twitter.com/unicodeveloper)!

Thanks!
Prosper Otemuyiwa.

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
