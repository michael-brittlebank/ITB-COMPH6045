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
        $pageName = 'page';
        $fileName = '/admin/'.$pageName.'.twig';
        $viewData['metaTitle'] = Services\Util::getMetaTitle('admin');
        $viewData['pageTitle'] = Services\Util::getPageTitle('admin');
        $viewData['activePage'] = $pageName;
        return $this->view->render($response, $fileName, array_merge($viewData, Services\Util::getGlobalVariables()));
    }

    public function getNewProductPage ($request, $response) {
        $pageName = 'new';
        $fileName = '/admin/products/'.$pageName.'.twig';
        $viewData['metaTitle'] = Services\Util::getMetaTitle('admin');
        $viewData['pageTitle'] = Services\Util::getPageTitle('admin');
        $viewData['activePage'] = $pageName;
        return $this->view->render($response, $fileName, array_merge($viewData, Services\Util::getGlobalVariables()));
    }

    public function getEditProductPage ($request, $response) {
        $pageName = 'edit';
        $fileName = '/admin/products/'.$pageName.'.twig';
        $viewData['metaTitle'] = Services\Util::getMetaTitle('admin');
        $viewData['pageTitle'] = Services\Util::getPageTitle('admin');
        $viewData['activePage'] = $pageName;
        return $this->view->render($response, $fileName, array_merge($viewData, Services\Util::getGlobalVariables()));
    }
}