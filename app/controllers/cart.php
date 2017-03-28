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
        $cart = Services\Session::getSessionCart();
        $cartProducts = Services\Util::prepareObjectArrayForView(Services\Products::getProductsInCart($cart));
        $cartTotal = 0;
        $shippingTotal = 15.00;
        foreach ($cartProducts as $product){
            $cartTotal += $product['quantity']*$product['price'];
        }
        $viewData['cart'] = array(
            'products'=>$cartProducts,
            'subtotal'=>number_format($cartTotal, 2),
            'shippingTotal'=>number_format($shippingTotal, 2),
            'total'=>number_format($cartTotal+$shippingTotal, 2)
        );
        $viewData['metaTitle'] = Services\Util::getMetaTitle('cart');
        $viewData['globals'] = $request->getAttribute('globals');
        $viewData['user'] = $request->getAttribute('user');
        return $this->view->render($response, '/shop/cart.twig', $viewData);
    }

    public function getCheckoutPage ($request, $response) {
        $viewData['metaTitle'] = Services\Util::getMetaTitle('checkout');
        $viewData['globals'] = $request->getAttribute('globals');
        $viewData['user'] = $request->getAttribute('user');
        return $this->view->render($response, '/shop/checkout.twig', $viewData);
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

    public function submitUpdateCart($request, $response) {
        $parsedBody = $request->getParsedBody();
        if (!Services\Util::bodyParserIsValid($parsedBody, array('id','quantity'))){
            $status = 400;
            return $response->withJson(Services\Util::createResponse($status), $status);
        } else {
            if (Services\Cart::updateCart($parsedBody['id'], $parsedBody['quantity'])) {
                return $response->withJson(Services\Util::createResponse(200), 200);
            } else {
                return $response->withJson(Services\Util::createResponse(401), 401);
            }
        }
    }
}