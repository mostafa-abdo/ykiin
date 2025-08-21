<?php


namespace App\Helpers;


class DonationHelpers
{
    public static function get_donation_charge($donation_amount,$symbol = false,$custom_tip = null)
    {
        if ($donation_amount && $donation_amount <1){
            return 0;
        }
        $allow_user_to_add_custom_tip_in_donation = get_static_option('allow_user_to_add_custom_tip_in_donation');
        $donation_charge_button_on = get_static_option('donation_charge_active_deactive_button');
        $charge_amount_type = get_static_option('charge_amount_type');
        $charge_amount = get_static_option('charge_amount');
        $donation_charge_form = get_static_option('donation_charge_form');
        $return_amount = 0;
        if ($donation_charge_form === 'campaign_owner'){
            return $return_amount;
        }

        if (!empty($allow_user_to_add_custom_tip_in_donation)){
            if (!is_null($custom_tip)){
                return $symbol ? amount_with_currency_symbol($custom_tip) : $custom_tip;
            }
        }

        if (!empty($donation_charge_button_on) && $charge_amount_type === 'percentage'){
            $return_amount = (int) $donation_amount * $charge_amount / 100;
        }elseif(!empty($donation_charge_button_on) && $charge_amount_type === 'fixed'){
            $return_amount = $charge_amount;
        }

        return $symbol ? amount_with_currency_symbol($return_amount) : $return_amount;

    }


    public static function get_transaction_fee($donationAmount,$symbol = false)
    {
        // Early return if donation amount is zero or less than 1
        if (!$donationAmount || $donationAmount < 1) {
            return $symbol ? amount_with_currency_symbol(0) : 0;
        }

        $chargeType = get_static_option('transaction_minimum_charge_amount_type');
        $minimumCharge = get_static_option('transaction_minimum_charge_amount');

        // Calculate transaction amount based on type
        $transactionFee = 0;
        if ($minimumCharge) {
            $transactionFee = $chargeType === 'percentage'
                ? ($minimumCharge / 100) * $donationAmount
                : $minimumCharge;
        }

        return $symbol ? amount_with_currency_symbol($transactionFee) : $transactionFee;
    }

    public static function get_donation_total($amount,$symbol = false,$custom_tip = null){
        if(get_static_option('enable_disable_decimal_point') == 'yes'){
            $donation_charge = self::get_donation_charge($amount, false, $custom_tip);
            $transaction_fee = self::get_transaction_fee($amount, false);
            // Round to preserve decimal values calculate
            $return_amount = round($amount + $donation_charge + $transaction_fee, 2);
        }else{
            $return_amount = (int) $amount + (int) self::get_donation_charge($amount,false,$custom_tip) + (int) self::get_transaction_fee($amount,false);
        }

        return $symbol ? amount_with_currency_symbol($return_amount) : $return_amount;
    }

    public static function get_donation_charge_for_campaign_owner($donation_amount,$symbol = false)
    {
        if ($donation_amount && $donation_amount <1){
            return 0;
        }
        $donation_charge_button_on = get_static_option('donation_charge_active_deactive_button');
        $charge_amount_type = get_static_option('charge_amount_type');
        $charge_amount = get_static_option('charge_amount');
        $donation_charge_form = get_static_option('donation_charge_form');
        $return_amount = 0;
        if ($donation_charge_form === 'user'){
            return $return_amount;
        }

        if (!empty($donation_charge_button_on) && $charge_amount_type === 'percentage'){
            $return_amount = (int) $donation_amount * $charge_amount / 100;
        }elseif(!empty($donation_charge_button_on) && $charge_amount_type === 'fixed'){
            $return_amount = $charge_amount;
        }

        return $symbol ? amount_with_currency_symbol($return_amount) : $return_amount;
    }
}