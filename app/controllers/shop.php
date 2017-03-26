<?php

namespace Controllers;

use Interop\Container\ContainerInterface;
use \Services;

class Shop {

    protected $view;

    public function __construct(ContainerInterface $ci) {
        $this->view = $ci->view;
    }

    public function getShopPage ($request, $response, $args) {
        $viewData['metaTitle'] = Services\Util::getMetaTitle('shop');
        $viewData['globals'] = $request->getAttribute('globals');
        return $this->view->render($response, '/shop/page.twig', $viewData);
    }

    public function getProductPage ($request, $response, $args) {
        $viewData['metaTitle'] = Services\Util::getMetaTitle(strtolower($args['page']));
        $viewData['globals'] = $request->getAttribute('globals');
        return $this->view->render($response, '/shop/product.twig', $viewData);
    }
}