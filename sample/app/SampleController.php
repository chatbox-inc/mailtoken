<?php
namespace App;
use Chatbox\Mailtoken\Http\MailTokenController;
use Chatbox\Token\Token;

/**
 * Created by PhpStorm.
 * User: mkkn
 * Date: 2016/07/18
 * Time: 14:38
 */
class SampleController extends MailTokenController
{
    protected function sendmail($email, array $data)
    {
        return null;
    }

    protected function handle(Token $token)
    {
        $this->token->delete($token->key);
        return [
            "key" => $token->key,
            "value" => $token->value,
            "created_at" => $token->createdAt,
        ];
    }

    protected function handleToken(Token $token)
    {
        return [
            "key" => $token->key,
            "value" => $token->value,
            "created_at" => $token->createdAt,
        ];
    }

    protected function handleError(\Exception $e)
    {
        throw $e;
    }
}