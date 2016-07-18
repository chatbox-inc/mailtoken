<?php
/**
 * Created by PhpStorm.
 * User: mkkn
 * Date: 2016/07/18
 * Time: 15:00
 */

namespace App;


use Chatbox\Mailtoken\RegisterControllerTrait;
use Chatbox\Token\TokenService;
use Illuminate\Support\ServiceProvider;
use Chatbox\Token\TokenServiceInterface;
use Chatbox\Token\Storage\Mock\ArrayStorage;

class SampleServiceProvider extends ServiceProvider
{
    use RegisterControllerTrait;

    public function register()
    {
        $this->app->singleton(TokenServiceInterface::class,function(){
            $array = new ArrayStorage();
            return new TokenService($array);
        });
        $this->registerRouter($this->app,SampleController::class);
    }


}