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
        $pageName = 'shop';
        $fileName = '/shop/page.twig';
        $viewData['metaTitle'] = Services\Util::getMetaTitle($pageName);
        $viewData['pageTitle'] = Services\Util::getPageTitle($pageName);
        $viewData['activePage'] = $pageName;
        return $this->view->render($response, $fileName, array_merge($viewData, Services\Util::getGlobalVariables()));
    }

    public function getProductPage ($request, $response, $args) {
        $pageName = strtolower($args['page']);
        $fileName = '/shop/product.twig';
        $viewData['metaTitle'] = Services\Util::getMetaTitle($pageName);
        $viewData['pageTitle'] = Services\Util::getPageTitle($pageName);
        $viewData['activePage'] = 'shop';
        return $this->view->render($response, $fileName, array_merge($viewData, Services\Util::getGlobalVariables()));
    }
}