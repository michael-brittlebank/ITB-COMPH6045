<?php

namespace Controllers;

use Interop\Container\ContainerInterface;
use \Services;

class Shop {

    protected $view;

    public function __construct(ContainerInterface $ci) {
        $this->view = $ci->view;
    }

    public function getShopPage ($request, $response) {
        $pageLimit = 12;
        $page = $request->getQueryParam('page');
        if(is_null($page)){
            $page = 1;
        }
        $viewData['metaTitle'] = Services\Util::getAdminMetaTitle('dashboard');
        $viewData['products'] = Services\Util::prepareObjectArrayForView(Services\Products::getProducts($pageLimit,$page));
        $viewData['productCount'] = Services\Products::getProductCount();
        $viewData['pageLimit'] = $pageLimit;
        $viewData['currentPage'] = $page;
        $viewData['metaTitle'] = Services\Util::getMetaTitle('shop');
        $viewData['globals'] = $request->getAttribute('globals');
        $viewData['user'] = $request->getAttribute('user');
        return $this->view->render($response, '/shop/page.twig', $viewData);
    }

    public function getProductPage ($request, $response, $args) {
        $productUrlKey = strtolower($args['productUrlKey']);
        $product = Services\Products::getProductByUrlKey($productUrlKey);
        $viewData['globals'] = $request->getAttribute('globals');
        $viewData['user'] = $request->getAttribute('user');
        if(!is_null($product)){
            $viewData['product'] = $product->toString();
            $viewData['metaTitle'] = Services\Util::getMetaTitle($product->getTitle());
            return $this->view->render($response, '/shop/product.twig', $viewData);
        } else {
            throw new \Slim\Exception\NotFoundException($request, $response);
        }
    }
}