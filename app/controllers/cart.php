<?php

namespace Controllers;

use Interop\Container\ContainerInterface;
use \Services;

class Cart {

    protected $view;

    public function __construct(ContainerInterface $ci) {
        $this->view = $ci->view;
    }

    public function getCartPage ($request, $response) {
        $viewData['metaTitle'] = Services\Util::getMetaTitle('cart');
        $viewData['globals'] = $request->getAttribute('globals');
        $viewData['user'] = $request->getAttribute('user');
        return $this->view->render($response, '/checkout/cart.twig', $viewData);
    }

    public function getCheckoutPage ($request, $response) {
        $viewData['metaTitle'] = Services\Util::getMetaTitle('checkout');
        $viewData['globals'] = $request->getAttribute('globals');
        $viewData['user'] = $request->getAttribute('user');
        return $this->view->render($response, '/checkout/page.twig', $viewData);
    }
    
    public function submitAddToCart($request, $response) {
        $parsedBody = $request->getParsedBody();
        if (!Services\Util::bodyParserIsValid($parsedBody, array('id'))) {
            $status = 400;
            return $response->withJson(Services\Util::createResponse($status), $status);
        } else {
            if (Services\Cart::addToCart($parsedBody['id'])) {
                return $response->withJson(Services\Util::createResponse(200), 200);
            } else {
                return $response->withJson(Services\Util::createResponse(401), 401);
            }
        }
    }

    public function submitRemoveFromCart($request, $response) {
        $parsedBody = $request->getParsedBody();
        if (!Services\Util::bodyParserIsValid($parsedBody, array('id'))){
            $status = 400;
            return $response->withJson(Services\Util::createResponse($status), $status);
        } else {
            if (Services\Cart::removeFromCart($parsedBody['id'])) {
                return $response->withJson(Services\Util::createResponse(200), 200);
            } else {
                return $response->withJson(Services\Util::createResponse(401), 401);
            }
        }
    }
}