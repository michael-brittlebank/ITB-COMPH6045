<?php

namespace Controllers;

use Interop\Container\ContainerInterface;
use \Services;

class User {

    protected $view;

    public function __construct(ContainerInterface $ci) {
        $this->view = $ci->view;
    }

    public function getLoginPage ($request, $response) {
        $viewData['metaTitle'] = Services\Util::getMetaTitle('login');
        $viewData['globals'] = $request->getAttribute('globals');
        $viewData['user'] = $request->getAttribute('user');
        return $this->view->render($response, '/user/login.twig', $viewData);
    }

    public function submitLogin ($request, $response) {
        $parsedBody = $request->getParsedBody();
        if (!Services\Util::bodyParserIsValid($parsedBody, array('email','password'))){
            return $response->withJson(Services\Util::createResponse(400), 400);
        } else {
            if(Services\Session::startUserSession($parsedBody['email'],$parsedBody['password'])){
                return $response->withJson(Services\Util::createResponse(200), 200);
            } else {
                return $response->withJson(Services\Util::createResponse(401), 401);
            }
        }
    }

    public function getRegisterPage ($request, $response) {
        $viewData['metaTitle'] = Services\Util::getMetaTitle('register');
        $viewData['globals'] = $request->getAttribute('globals');
        $viewData['user'] = $request->getAttribute('user');
        return $this->view->render($response, '/user/register.twig', $viewData);
    }

    public function submitUserRegistration($request, $response) {
        $parsedBody = $request->getParsedBody();
        if (!Services\Util::bodyParserIsValid($parsedBody, array('email','password','firstName','lastName'))){
            return $response->withJson(Services\Util::createResponse(400), 400);
        } else {
            if(Services\Users::createNewUser($parsedBody['firstName'],$parsedBody['lastName'],$parsedBody['email'],$parsedBody['password'])){
                if (Services\Session::startUserSession($parsedBody['email'],$parsedBody['password'])){
                    return $response->withJson(Services\Util::createResponse(200), 200);
                } else {
                    return $response->withJson(Services\Util::createResponse(401), 401);
                }
            } else {
                //user already exists
                return $response->withJson(Services\Util::createResponse(400), 400);
            }
        }
    }

    public function getProfilePage ($request, $response) {
        $cart = Services\Session::getSessionCart();
        $cartProducts = Services\Util::prepareObjectArrayForView(Services\Products::getProductsInCart($cart));
        $viewData['cart'] = array(
            'products'=>$cartProducts
        );
        $viewData['metaTitle'] = Services\Util::getMetaTitle('profile');
        $viewData['globals'] = $request->getAttribute('globals');
        $viewData['user'] = $request->getAttribute('user');
        return $this->view->render($response, '/user/profile.twig', $viewData);
    }

    public static function submitUpdatePassword ($request, $response) {
        $parsedBody = $request->getParsedBody();
        if (!Services\Util::bodyParserIsValid($parsedBody, array('password','id'))){
            return $response->withJson(Services\Util::createResponse(400), 400);
        } else {
            $sessionUser = Services\Session::getSessionUser();
            if ($sessionUser->isCurrentUser($parsedBody['id'])){
                $result = Services\Users::updateUserPassword($parsedBody['password'],$sessionUser->getSalt(),$parsedBody['id']);
                //update session user
                $user = Services\Users::getUserByEmail($sessionUser->getEmail());
                Services\Session::setSessionUser($user);
                if($result === 1) {
                    return $response->withJson(Services\Util::createResponse(200), 200);
                } else if($result === 0){
                    return $response->withJson(Services\Util::createResponse(204), 204);
                } else {
                    return $response->withJson(Services\Util::createResponse(401), 401);
                }
            } else {
                //cannot edit other user's profiles
                return $response->withJson(Services\Util::createResponse(401), 401);
            }
        }
    }


    public function getEditProfilePage ($request, $response) {
        $viewData['metaTitle'] = Services\Util::getMetaTitle('profile');
        $viewData['globals'] = $request->getAttribute('globals');
        $viewData['user'] = $request->getAttribute('user');
        return $this->view->render($response, '/user/profile-edit.twig', $viewData);
    }

    public function submitEditProfile ($request, $response) {
        $parsedBody = $request->getParsedBody();
        if (!Services\Util::bodyParserIsValid($parsedBody, array('email','firstName','lastName','id'))){
            return $response->withJson(Services\Util::createResponse(400), 400);
        } else {
            if (Services\Session::getSessionUser()->isCurrentUser($parsedBody['id'])){
                $result = Services\Users::updateUser($parsedBody['firstName'],$parsedBody['lastName'],$parsedBody['email'],$parsedBody['id']);
                $user = Services\Users::getUserByEmail($parsedBody['email']);
                Services\Session::setSessionUser($user);
                if($result === 1) {
                    return $response->withJson(Services\Util::createResponse(200), 200);
                } else if($result === 0){
                    return $response->withJson(Services\Util::createResponse(204), 204);
                } else {
                    return $response->withJson(Services\Util::createResponse(401), 401);
                }
            } else {
                //cannot edit other user's profiles
                return $response->withJson(Services\Util::createResponse(401), 401);
            }
        }
    }

    public function submitLogout ($request, $response) {
        Services\Session::endUserSession();
        return $response->withRedirect('/');
    }
}