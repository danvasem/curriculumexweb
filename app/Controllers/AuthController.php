<?php

namespace App\Controllers;

use App\Models\User;
use Respect\Validation\Validator as v;
use Zend\Diactoros\Response\RedirectResponse;

class AuthController extends BaseController{

    public function getLogin($request){
        return $this->renderHTML('login.twig');
    }

    public function postLogin($request){
        $responseMessage ="";
        if($request->getMethod()=="POST")
        {
            $postData=$request->getParsedBody();
            $jobValidator = v::key('email', v::stringType()->notEmpty())->key('password',v::stringType()->notEmpty());
            
            try{

                $jobValidator->assert($postData);

                $user = User::where('email',$postData['email'])->first();
                if($user)
                {
                    if(\password_verify($postData['password'],$user->password)){
                        $_SESSION['userId']=$user->id;
                        return new RedirectResponse('/platzi/admin');
                    }
                    else{
                        $responseMessage="Password incorrecto!";
                    }
                }
                else
                {
                    $responseMessage="Usuario inválido!";
                }
            }
            catch(\Exception $e){
                $responseMessage=$e->getMessage();
            }
        }

        return $this->renderHTML('login.twig',[
            'responseMessage'=>$responseMessage
        ]);
    }

    public function getLogout(){
        unset($_SESSION['userId']);
        return new RedirectResponse('/platzi/login');
    }
}