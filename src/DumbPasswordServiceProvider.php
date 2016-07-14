<?php

/*
 * This file is part of the Laravel Password package.
 *
 * (c) Prosper Otemuyiwa <prosperotemuyiwa@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Unicodeveloper\DumbPassword;

use Illuminate\Support\ServiceProvider;
use Validator;

class DumbPasswordServiceProvider extends ServiceProvider
{

    /*
    * Indicates if loading of the provider is deferred.
    *
    * @var bool
    */
    protected $defer = false;

    /**
     * default error message
     *
     * @var string
     */
    protected $message = 'This password is just too common. Please try another!';

    /**
    * Publishes all the config file this package needs to function
    */
    public function boot()
    {
        $path = realpath(__DIR__.'/../resources/config/passwordlist.txt');
        $data = $this->generateDictionary($path);

       Validator::extend('dumbpwd', function($attribute, $value, $parameters, $validator) use ($data) {
            return !array_key_exists($value, $data);
       }, $this->message);
    }

    /**
    * Register the application services.
    */
    public function register()
    {

    }

    /**
    * Get the services provided by the provider
    * @return array
    */
    public function provides()
    {
        return ['laravel-password'];
    }

    /**
     * Generates a dictionary from the file referenced by the path specified
     *
     * @param $path
     *
     * @return array
     */
    private function generateDictionary($path)
    {
        $dictionary = [];

        $handle = fopen($path, "r");
        if ($handle) {
            while (($line = fgets($handle)) !== false) {
                $dictionary[trim($line)] = true;
            }

            fclose($handle);
        }

        return $dictionary;
    }
}
