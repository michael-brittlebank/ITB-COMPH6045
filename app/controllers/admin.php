<?php

namespace Controllers;

use Interop\Container\ContainerInterface;
use \Services;

class Admin {

    protected $view;

    public function __construct(ContainerInterface $ci) {
        $this->view = $ci->view;
    }

    public function getDashboardPage ($request, $response) {
        $page = $request->getQueryParam('page');
        if(is_null($page)){
            $page = 1;
        }
        $viewData['metaTitle'] = Services\Util::getAdminMetaTitle('dashboard');
        $viewData['products'] = Services\Products::getProducts(20,$page);
        $viewData['productCount'] = Services\Products::getProductCount();
        $viewData['currentPage'] = $page;
        $viewData['globals'] = $request->getAttribute('globals');
        $viewData['user'] = $request->getAttribute('user');
        return $this->view->render($response, '/admin/page.twig', $viewData);
    }

    public function getNewProductPage ($request, $response) {
        $viewData['metaTitle'] = Services\Util::getAdminMetaTitle('new product');
        $viewData['globals'] = $request->getAttribute('globals');
        $viewData['user'] = $request->getAttribute('user');
        return $this->view->render($response, '/admin/products/new.twig', $viewData);
    }
    
    public function submitNewProduct ($request, $response) {
        $parsedBody = $request->getParsedBody();
        if (!isset($parsedBody['title']) || !isset($parsedBody['price'])){
            $status = 400;
            return $response->withJson(Services\Util::createResponse($status), $status);
        } else {
            if (Services\Products::createNewProduct($parsedBody['title'],$parsedBody['price'])){
                return $response->withJson(Services\Util::createResponse(200), 200);
            } else {
                return $response->withJson(Services\Util::createResponse(401), 401);
            }
        }
    }

    public function getEditProductPage ($request, $response) {
        $viewData['metaTitle'] = Services\Util::getAdminMetaTitle('edit product');
        $viewData['globals'] = $request->getAttribute('globals');
        $viewData['user'] = $request->getAttribute('user');
        return $this->view->render($response, '/admin/products/edit.twig', $viewData);
    }
}