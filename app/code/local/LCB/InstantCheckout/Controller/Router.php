<?php

/**
 * InstantCheckout
 *
 * @category   LCB
 * @package    LCB_InstantCheckout
 * @author     Silpion Tomasz Gregorczyk <tom@leftcurlybracket.com>
 */

class LCB_InstantCheckout_Controller_Router extends Mage_Core_Controller_Varien_Router_Standard {

    public function initControllerRouters($observer) {
        $front = $observer->getEvent()->getFront();
        $path = new LCB_InstantCheckout_Controller_Router();
        $front->addRouter('buy', $path);
    }

    public function match(Zend_Controller_Request_Http $request) {

        try {
            
            $path = $request->getPathInfo();
            $data = str_replace('/buy/', '', $path);
            $array = explode('/', $data);

            $sku = $array[0];

            if (isset($array[1])) {
                $coupon = $array[1];
            } else {
                $coupon = '';
            }

            if ($sku) {
                $product = Mage::getModel('catalog/product')->loadByAttribute('sku', $sku);

                if ($product && $product->getId()) {
                    $url = Mage::getUrl('instant', array('product' => $product->getId(), 'coupon' => $coupon));

                    Mage::app()->getFrontController()->getResponse()
                            ->setRedirect($url)
                            ->sendResponse();

                    exit;
                }
            }
            
            return false;

        } catch (Exception $e) {
            return false;
        }
    }

}
