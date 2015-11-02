<?php

/**
 * InstantCheckout
 *
 * @category   LCB
 * @package    LCB_InstantCheckout
 * @author     Silpion Tomasz Gregorczyk <tom@leftcurlybracket.com>
 */
class LCB_InstantCheckout_IndexController extends Mage_Core_Controller_Front_Action {

    public function IndexAction()
    {

        $id = Mage::app()->getRequest()->getParam('product');
        $coupon = Mage::app()->getRequest()->getParam('coupon');

        if ($id) {
            $product = Mage::getModel('catalog/product')->load($id);
            $url = Mage::helper('checkout/cart')->getAddUrl($product);

            if ($coupon) {
                Mage::getSingleton('checkout/cart')
                        ->getQuote()
                        ->setCouponCode(strlen($coupon) ? $coupon : '')
                        ->collectTotals()
                        ->save();
            }

            Mage::app()->getResponse()->setRedirect($url);
            return;
        }

        Mage::app()->getResponse()->setRedirect($this->getUrl('onepage'));
        return;
    }

}
