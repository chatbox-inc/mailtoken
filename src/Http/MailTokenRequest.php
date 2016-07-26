<?php
/**
 * Created by PhpStorm.
 * User: mkkn
 * Date: 2016/07/17
 * Time: 22:22
 */

namespace Chatbox\Mailtoken\Http;

use Illuminate\Http\Request;
use Illuminate\Contracts\Validation\Factory;
use Illuminate\Validation\ValidationException;

class MailTokenRequest
{
    protected $request;

    protected $validator;

    public function __construct(Request $request,Factory $validator)
    {
        $this->request = $request;
        $this->validator = $validator;
    }

    protected function validate($data,$rule,array $message=[],array $customAttributes=[]){
        $validator = $this->validator->make($data,$rule,$message,$customAttributes);
        if($validator->passes()){
            return $data;
        }else{
            throw new ValidationException($validator);
        }
    }

    public function request():Request{
        return $this->request;
    }

    public function mailaddress(){
        $rules = [
            "email"=>["required","email"],
            "data" => ["array"]
        ];
        $passed = $this->validate([
            "email" => $this->request->get("email"),
            "data" => $this->request->get("data",[])
        ],$rules);
        $email = array_get($passed,"email");
        $data = array_get($passed,"data",[]);
        if($email){
            return [$email,$data];
        }else{
            throw new \Exception("email must be non-empty string");
        }
    }

    public function token(){
        $rules = [
            "token"=>["required"]
        ];
        $passed = $this->validate([
            "token" => $this->request->header("X-MAILTOKEN")
        ],$rules);
        $token = array_get($passed,"token");
        if($token){
            return $token;
        }else{
            throw new \Exception("email must be non-empty string");
        }
    }


}