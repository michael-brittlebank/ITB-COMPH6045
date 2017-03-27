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
        $pageLimit = 10;
        $page = $request->getQueryParam('page');
        if(is_null($page)){
            $page = 1;
        }
        $viewData['metaTitle'] = Services\Util::getAdminMetaTitle('dashboard');
        $viewData['products'] = Services\Util::prepareObjectArrayForView(Services\Products::getProducts($pageLimit,$page));
        $viewData['productCount'] = Services\Products::getProductCount();
        $viewData['pageLimit'] = $pageLimit;
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
        if (!isset($parsedBody['title']) || !isset($parsedBody['price']) || !isset($parsedBody['url'])){
            $status = 400;
            return $response->withJson(Services\Util::createResponse($status), $status);
        } else {
            if (Services\Products::createNewProduct($parsedBody['title'],$parsedBody['price'],$parsedBody['url'])){
                return $response->withJson(Services\Util::createResponse(200), 200);
            } else {
                return $response->withJson(Services\Util::createResponse(401), 401);
            }
        }
    }

    public function getEditProductPage ($request, $response, $args) {
        $productId = $args['productId'];
        $product = Services\Products::getProductById($productId);
        $viewData['metaTitle'] = Services\Util::getAdminMetaTitle('edit product');
        $viewData['globals'] = $request->getAttribute('globals');
        $viewData['user'] = $request->getAttribute('user');
        if(!is_null($product)){
            $viewData['product'] = $product->toString();
            return $this->view->render($response, '/admin/products/edit.twig', $viewData);   
        } else {
            throw new \Slim\Exception\NotFoundException($request, $response);
        }
    }
    
    public static function submitEditProduct($request, $response){
        $parsedBody = $request->getParsedBody();
        if (!isset($parsedBody['title']) || !isset($parsedBody['price']) || !isset($parsedBody['url'])){
            $status = 400;
            return $response->withJson(Services\Util::createResponse($status), $status);
        } else {
            if (Services\Products::updateProduct($parsedBody['title'],$parsedBody['price'],$parsedBody['url'])){
                return $response->withJson(Services\Util::createResponse(200), 200);
            } else {
                return $response->withJson(Services\Util::createResponse(401), 401);
            }
        }
    }
}