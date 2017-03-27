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
            if(Services\Authentication::startUserSession($parsedBody['email'],$parsedBody['password'])){
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

    public function submitLogout ($request, $response) {
        Services\Authentication::endUserSession();
        return $response->withRedirect('/');
    }
}