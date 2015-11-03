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
        $params = '';

        if ($id) {
            $product = Mage::getModel('catalog/product')->load($id);
            $url = Mage::helper('checkout/cart')->getAddUrl($product);

            if ($coupon) {
                $params .= "coupon/$coupon/";
            }

            if (Mage::getStoreConfig('instantcheckout/general/redirect') == "checkout") {
                $params .= "gtc/1/";
            }

            Mage::app()->getResponse()->setRedirect($url . $params);
            return;
        }

        Mage::app()->getResponse()->setRedirect($this->getUrl('onepage'));
        return;
    }

}
