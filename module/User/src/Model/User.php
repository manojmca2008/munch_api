<?php
namespace User\Model;

class User {
    public $id;
    public $user_name;
    public $first_name;
    public $last_name;
    public $email;
    public $password;
    public $mobile;
    public $phone;
    public $display_pic_url;
    public $user_source;
    public $accept_toc;
    public $newsletter_subscribtion;
    public $created_at;
    public $update_at;
    public $points;
    public $billing_address;
    public $shipping_address;
    public $status;
    public $display_pic_url_normal;
    public $display_pic_url_large;
    public $delivery_instructions;
    public $takeout_instructions;
    public $order_msg_status = 0;
    public $session_token;
    public $last_login;
    public $access_token;

    public function exchangeArray(array $data) {
        $this->email = !empty($data['email']) ? $data['email'] : null;
        $this->first_name = !empty($data['first_name']) ? $data['first_name'] : null;
        $this->last_name = !empty($data['last_name']) ? $data['last_name'] : null;
        $this->mobile = !empty($data['mobile']) ? $data['mobile'] : null;
    }

    public function getArrayCopy() {
        return [
            'email'  => $this->email,
            'mobile'     => $this->mobile,
        ];
    }

}