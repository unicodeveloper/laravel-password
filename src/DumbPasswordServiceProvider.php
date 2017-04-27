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
use Illuminate\Support\Facades\Cache;
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
        Validator::extend('dumbpwd', function ($attribute, $value, $parameters, $validator) {
            $path = realpath(__DIR__ . '/../resources/config/passwordlist.txt');
            $cache_key = md5_file($path);
            $data = Cache::rememberForever('dumbpwd_list_' . $cache_key, function () use ($path) {
                return collect(explode("\n", file_get_contents($path)));
            });
            return !$data->contains($value);
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
