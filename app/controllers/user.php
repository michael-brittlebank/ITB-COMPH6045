<?php

namespace Controllers;

use Interop\Container\ContainerInterface;
use \Services;

class User {

    protected $view;
    
    public function __construct(ContainerInterface $ci) {
        $this->view = $ci->view;
    }

    public function getLoginPage ($request, $response, $args) {
        $pageName = 'login';
        $fileName = '/user/'.$pageName.'.twig';
        $viewData['metaTitle'] = Services\Util::getMetaTitle($pageName);
        $viewData['pageTitle'] = Services\Util::getPageTitle($pageName);
        $viewData['activePage'] = $pageName;
        return $this->view->render($response, $fileName, array_merge($viewData, Services\Util::getGlobalVariables()));
    }

    public function submitLogin ($request, $response, $args) {
        $parsedBody = $request->getParsedBody();
        if (!isset($parsedBody['email']) || !isset($parsedBody['password'])){
            $status = 400;
            return $response->withJson(Services\Util::createResponse($status), $status);
        } else {
            $userSession = Services\Authentication::startUserSession($parsedBody['email'],$parsedBody['password']);
            return $response->withJson($userSession, $userSession['status']);
        }
    }

    public function getRegisterPage ($request, $response, $args) {
        $pageName = 'register';
        $fileName = '/user/' . $pageName . '.twig';
        $viewData['metaTitle'] = Services\Util::getMetaTitle($pageName);
        $viewData['pageTitle'] = Services\Util::getPageTitle($pageName);
        $viewData['activePage'] = $pageName;
        return $this->view->render($response, $fileName, array_merge($viewData, Services\Util::getGlobalVariables()));
    }

    public function getProfilePage ($request, $response, $args) {
        $pageName = 'profile';
        $fileName = '/user/'.$pageName.'.twig';
        $viewData['metaTitle'] = Services\Util::getMetaTitle($pageName);
        $viewData['pageTitle'] = Services\Util::getPageTitle($pageName);
        $viewData['activePage'] = $pageName;
        return $this->view->render($response, $fileName, array_merge($viewData, Services\Util::getGlobalVariables()));
    }

    public function submitLogout ($request, $response, $args) {
        Services\Authentication::endUserSession();
        return $response->withRedirect('/');
    }
}