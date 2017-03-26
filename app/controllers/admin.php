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
        $viewData['metaTitle'] = Services\Util::getAdminMetaTitle('dashboard');
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

    public function getEditProductPage ($request, $response) {
        $viewData['metaTitle'] = Services\Util::getAdminMetaTitle('edit product');
        $viewData['globals'] = $request->getAttribute('globals');
        $viewData['user'] = $request->getAttribute('user');
        return $this->view->render($response, '/admin/products/edit.twig', $viewData);
    }
}