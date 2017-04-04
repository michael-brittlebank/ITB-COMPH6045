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
        $viewData['metaTitle'] = getenv('SITE_NAME');
        $viewData['globals'] = $request->getAttribute('globals');
        $viewData['preferences'] = $request->getAttribute('preferences');
        $viewData['user'] = $request->getAttribute('user');
        $viewData['products'] = Services\Util::prepareObjectArrayForView(Services\Products::getFeaturedProducts());
        return $this->view->render($response, 'pages/homepage.twig', $viewData);
    }

    public function getContactPage ($request, $response) {
        $viewData['metaTitle'] = Services\Util::getMetaTitle('contact');
        $viewData['globals'] = $request->getAttribute('globals');
        $viewData['preferences'] = $request->getAttribute('preferences');
        $viewData['user'] = $request->getAttribute('user');
        return $this->view->render($response, 'pages/contact.twig', $viewData);
    }

    public function getAboutPage ($request, $response) {
        $viewData['metaTitle'] = Services\Util::getMetaTitle('about');
        $viewData['globals'] = $request->getAttribute('globals');
        $viewData['preferences'] = $request->getAttribute('preferences');
        $viewData['user'] = $request->getAttribute('user');
        return $this->view->render($response, 'pages/about.twig', $viewData);
    }
}