<?php
namespace Chatbox\Mailtoken;
/**
 * Created by PhpStorm.
 * User: mkkn
 * Date: 2016/07/18
 * Time: 1:24
 */
trait RegisterControllerTrait
{
    public function registerRouter($router,$className,$prefix=""){
        $router->get($prefix."check",$className."@load");
        $router->post($prefix."send",$className."@send");
        $router->post($prefix."handle",$className."@deal");
    }

}