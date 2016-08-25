<?php namespace Wxpay;

use Wxpay\JsApi\JsApi;
use Wxpay\Refund\Refund;

class Wxpay
{

    public $config;

    public function __construct($config)
    {
        $this->config = $config;
    }

    public function instance($type)
    {
        switch ($type) {
            case 'jsApi':
                return new JsApi($this->config);
                break;
            case 'refund':
                return new Refund($this->config);
                break;
            default:
                return false;
                break;
        }
    }
}
