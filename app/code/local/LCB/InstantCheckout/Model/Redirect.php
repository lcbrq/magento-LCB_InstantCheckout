<?php

/**
 * InstantCheckout
 *
 * @category   LCB
 * @package    LCB_InstantCheckout
 * @author     Silpion Tomasz Gregorczyk <tom@leftcurlybracket.com>
 */
class LCB_InstantCheckout_Model_Redirect {

    const REDIRECT_CART = 'cart';
    const REDIRECT_CHECKOUT = 'checkout';

    public function toOptionArray()
    {
        return array(
            array('value' => self::REDIRECT_CART, 'label' => Mage::helper('instantcheckout')->__('Redirect to the cart')),
            array('value' => self::REDIRECT_CHECKOUT, 'label' => Mage::helper('instantcheckout')->__('Redirect to the checkout'))
        );
    }

}
