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
    public function registerRouter($router,$className){
        $router->get("check",$className."@load");
        $router->post("send",$className."@send");
        $router->post("handle",$className."@deal");
    }

}