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
    protected $defer = true;
    
    /**
     * Default error message.
     *
     * @var string
     */
    protected $message = 'This password is just too common. Please try another!';

    /**
     * Publishes all the config file this package needs to function.
     */
    public function boot()
    {
        $path = realpath(__DIR__.'/../resources/config/passwordlist.txt');
        $dumbPasswords = collect(explode("\n", file_get_contents($path)));
        $data = $dumbPasswords->flip();

        Validator::extend('dumbpwd', function ($attribute, $value, $parameters, $validator) use ($data) {
            return !$data->has($value);
        }, $this->message);
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        //
    }

    /**
     * Get the services provided by the provider.
     * 
     * @return array
     */
    public function provides()
    {
        return ['laravel-password'];
    }
}
