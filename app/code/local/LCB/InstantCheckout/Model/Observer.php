<?php

/**
 * InstantCheckout
 *
 * @category   LCB
 * @package    LCB_InstantCheckout
 * @author     Silpion Tomasz Gregorczyk <tom@leftcurlybracket.com>
 */
class LCB_InstantCheckout_Model_Observer {

    public function addToCartComplete(Varien_Event_Observer $observer)
    {
        $request = $observer->getRequest();
        if ($request->getParam('coupon')) {
            $coupon = $request->getParam('coupon');
            Mage::getSingleton('checkout/cart')
                    ->getQuote()
                    ->setCouponCode(strlen($coupon) ? $coupon : '')
                    ->collectTotals()
                    ->save();
        }

        if ($request->getParam('gtc')) {
            $response = $observer->getResponse();
            $response->setRedirect(Mage::getUrl('checkout/onepage'));
            Mage::getSingleton('checkout/session')->setNoCartRedirect(true);
        }
    }

}
