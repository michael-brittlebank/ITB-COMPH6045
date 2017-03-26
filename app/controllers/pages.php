<?php

namespace Controllers;

use Interop\Container\ContainerInterface;
use \Services;

class Pages {

    protected $view;

    public function __construct(ContainerInterface $ci) {
        $this->view = $ci->view;
    }

    public function getHomepage ($request, $response) {
        $viewData['metaTitle'] = 'My Store';
        $viewData['globals'] = $request->getAttribute('globals');
        return $this->view->render($response, 'pages/homepage.twig', $viewData);
    }

    public function getContactPage ($request, $response) {
        $viewData['metaTitle'] = Services\Util::getMetaTitle('contact');
        $viewData['globals'] = $request->getAttribute('globals');
        return $this->view->render($response, 'pages/contact.twig', $viewData);
    }

    public function getAboutPage ($request, $response) {
        $viewData['metaTitle'] = Services\Util::getMetaTitle('about');
        $viewData['globals'] = $request->getAttribute('globals');
        return $this->view->render($response, 'pages/about.twig', $viewData);
    }
}