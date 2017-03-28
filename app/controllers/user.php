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
            $status = 400;
            return $response->withJson(Services\Util::createResponse($status), $status);
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

    public function getProfilePage ($request, $response) {
        $viewData['metaTitle'] = Services\Util::getMetaTitle('profile');
        $viewData['globals'] = $request->getAttribute('globals');
        $viewData['user'] = $request->getAttribute('user');
        return $this->view->render($response, '/user/profile.twig', $viewData);
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
            $status = 400;
            return $response->withJson(Services\Util::createResponse($status), $status);
        } else {
            if (Services\Session::getSessionUser()->isCurrentUser($parsedBody['id'])){
                $result = Services\Users::updateUser($parsedBody['firstName'],$parsedBody['lastName'],$parsedBody['email'],$parsedBody['id']);
                $user = Services\Users::getUserByEmail($parsedBody['email']);
                Services\Session::setSessionUser($user);
                Services\Session::setSessionExpiry();
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