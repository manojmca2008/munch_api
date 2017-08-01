<?php
namespace User\Model;

class UserOrder {
    public $id;
    public $user_id;
    public $restaurant_id;
    public $fname;
    public $lname;
    public $state_code;
    public $phone;
    public $apt_suite;
    public $city;
    public $order_amount;
    public $deal_discount;
    public $order_type;
    public $created_at;
    public $updated_at;
    public $user_comments;
    public $restaurants_comments;
    public $special_checks;
    public $zipcode;
    public $payment_status;
    public $status;
    public $delivery_time;
    public $tax;
    public $tip_amount;
    public $tip_percent;
    public $delivery_charge;
    public $delivery_address;
    public $frozen_status;
    public $user_sess_id;
    public $stripes_token;
    public $card_number;
    public $name_on_card;
    public $card_type;
    public $expired_on;
    public $billing_zip;
    public $payment_receipt;
    public $order_type1;
    public $order_type2;
    public $email;
    public $miles_away;
    public $stripe_card_id;
    public $user_card_id;
    public $total_amount;
    public $new_order = 1;
    public $approved_by = 0;
    public $is_read = 0;
    public $crm_update_at = '';
    public $host_name;
    public $is_deleted = 0;
    public $crm_comments = '';
    public $is_reviewed = 0;
    public $review_id;
    public $stripe_charge_id;
    protected $_primary_key = 'id';
    public $promocode_discount;
    public $deal_id;
    public $deal_title;
    public $order_pass_through = 0;
    public $encrypt_card_number = NULL;
    public $user_ip = NULL;
    public $address = NULL;
    public $longitude = 0;
    public $latitude = 0;
    public $city_id = 0;
    public $pay_via_point;
    public $pay_via_card;
    public $redeem_point;
    public $cod=0;

    public function exchangeArray(array $data) {
        $this->email = !empty($data['email']) ? $data['email'] : null;
        $this->fname = !empty($data['fname']) ? $data['fname'] : null;
        $this->lname = !empty($data['lname']) ? $data['lname'] : null;
        $this->phone = !empty($data['phone']) ? $data['phone'] : null;
    }

    public function getArrayCopy() {
        return [
            'email'  => $this->email,
            'phone'     => $this->phone,
        ];
    }

}