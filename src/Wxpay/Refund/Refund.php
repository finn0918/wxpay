<?php namespace Wxpay\Refund;

use Wxpay\lib\Common;

class Refund
{
    use Common;

    const API_REFUND = 'https://api.mch.weixin.qq.com/secapi/pay/refund';

    const OUT_TRADE_NO = 'out_trade_no';

    public $wxpay_config  = [

    ];

    public function __construct($config)
    {
        $this->wxpay_config = $this->wxpay_config = array_merge($this->wxpay_config, $config);
    }

    /**
     * 申请退款
     *
     * @param $orderNo
     * @param $refundNo
     * @param $totalFee
     * @param null $refundFee
     * @param null $opUserId
     * @param $type
     * @return mixed
     */
    public function refund(
        $orderNo,
        $refundNo,
        $totalFee,
        $refundFee = null,
        $opUserId = null,
        $type = self::OUT_TRADE_NO
    ) {
        $params = [
            $type => $orderNo,
            'out_refund_no' => $refundNo,
            'total_fee' => $totalFee,
            'refund_fee' => $refundFee ?: $totalFee,
            'refund_fee_type' => 'CNY', //默认是人民币
            'op_user_id' => $opUserId ?: $this->wxpay_config['mchid'],
        ];
        return $this->request(self::API_REFUND, $params);
    }


    /**
     * 真正发起一个退款请求
     *
     * @param $api
     * @param array $params
     * @return mixed
     */
    protected function request($api, array $params)
    {
        $params['appid'] = $this->wxpay_config['appid'];
        $params['mch_id'] = $this->wxpay_config['mchid'];
        $params['nonce_str'] = uniqid();
        $params = array_filter($params);
        $params['sign'] = $this->getSign($params);
        $xml = $this->arrayToXml($params);
        $response = $this->postXmlSSLCurl($xml,$api);
        $response = $this->xmlToArray($response);
        return $response;
    }

}