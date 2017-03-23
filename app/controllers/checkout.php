<?php

namespace Controllers;

use Interop\Container\ContainerInterface;
use \Services;

class Checkout {

    protected $view;

    public function __construct(ContainerInterface $ci) {
        $this->view = $ci->view;
    }

    public function getCartPage ($request, $response, $args) {
        $pageName = 'cart';
        $fileName = '/checkout/'.$pageName.'.twig';
        $viewData['metaTitle'] = Services\Util::getMetaTitle($pageName);
        $viewData['pageTitle'] = Services\Util::getPageTitle($pageName);
        $viewData['activePage'] = $pageName;
        return $this->view->render($response, $fileName, array_merge($viewData, Services\Util::getGlobalVariables()));
    }

    public function getCheckoutPage ($request, $response, $args) {
        $pageName = 'checkout';
        $fileName = '/checkout/page.twig';
        $viewData['metaTitle'] = Services\Util::getMetaTitle($pageName);
        $viewData['pageTitle'] = Services\Util::getPageTitle($pageName);
        $viewData['activePage'] = 'shop';
        return $this->view->render($response, $fileName, array_merge($viewData, Services\Util::getGlobalVariables()));
    }
}