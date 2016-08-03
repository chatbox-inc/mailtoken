<?php
/**
 * Created by PhpStorm.
 * User: mkkn
 * Date: 2016/07/17
 * Time: 22:21
 */

namespace Chatbox\Mailtoken\Http;

use Chatbox\Token\Token;
use Chatbox\Token\TokenServiceInterface;
use Illuminate\Http\Exception\HttpResponseException;

abstract class MailTokenController
{
    protected $token;
    protected $request;

    public function __construct(
        TokenServiceInterface $token,
        MailTokenRequest $request)
    {
        $this->token = $token;
        $this->request = $request;
    }

    public function send(){
        try{
            list($mail,$data) = $this->request->mailaddress();
            $data["email"] = $mail;
            $token = $this->token->save($data);
            $this->sendmail($mail,$data,$token);
            return $this->handleToken($token);
        }catch(\Exception $e){
            return $this->handleError($e);
        }
    }

    public function load(){
        try{
            $token = $this->request->token();
            $token = $this->token->load($token);
            return $this->handleToken($token);
        }catch(\Exception $e){
            return $this->handleError($e);
        }
    }

    public function deal(){
        try{
            $token = $this->request->token();
            $token = $this->token->load($token);
            return $this->handle($token);
        }catch(\Exception $e){
            return $this->handleError($e);
        }
    }

    abstract protected function sendmail($email,array $data,Token $token);

    abstract protected function handle(Token $token);

    abstract protected function handleToken(Token $token);

    abstract protected function handleError(\Exception $e);

}

class InvalidMailTokenException extends HttpResponseException{}