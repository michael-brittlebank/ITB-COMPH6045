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
        return $this->view->render($response, '/admin/dashboard.twig', $viewData);
    }

    public function getNewProductPage ($request, $response) {
        $viewData['metaTitle'] = Services\Util::getAdminMetaTitle('new product');
        $viewData['globals'] = $request->getAttribute('globals');
        $viewData['user'] = $request->getAttribute('user');
        return $this->view->render($response, '/admin/new.twig', $viewData);
    }
    
    public function submitNewProduct ($request, $response) {
        $parsedBody = $request->getParsedBody();
        if (!Services\Util::bodyParserIsValid($parsedBody, array('title','price','url'))){
            return $response->withJson(Services\Util::createResponse(400), 400);
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
            $viewData['categories'] = Services\Util::prepareObjectArrayForView(Services\Products::getCategories());
            return $this->view->render($response, '/admin/edit.twig', $viewData);
        } else {
            throw new \Slim\Exception\NotFoundException($request, $response);
        }
    }
    
    public static function submitEditProduct($request, $response){
        $parsedBody = $request->getParsedBody();
        if (!Services\Util::bodyParserIsValid($parsedBody, array('title','price','url','id','category'))){
            return $response->withJson(Services\Util::createResponse(400), 400);
        } else {
            if (Services\Products::updateProduct($parsedBody['title'],$parsedBody['price'],$parsedBody['url'],$parsedBody['category'],$parsedBody['id'])){
                return $response->withJson(Services\Util::createResponse(200), 200);
            } else {
                return $response->withJson(Services\Util::createResponse(401), 401);
            }
        }
    }

    public static function submitDeleteProduct($request, $response){
        $parsedBody = $request->getParsedBody();
        if (!Services\Util::bodyParserIsValid($parsedBody, array('id'))){
            return $response->withJson(Services\Util::createResponse(400), 400);
        } else {
            if (Services\Products::deleteProduct($parsedBody['id'])){
                return $response->withJson(Services\Util::createResponse(200), 200);
            } else {
                return $response->withJson(Services\Util::createResponse(401), 401);
            }
        }
    }
}