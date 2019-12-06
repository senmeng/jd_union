<?php

// namespace mengsen;

// use Util;
require("Util.php");

class TopClient
{
    public $appkey;
    public $secretKey;
    public $gatewayUrl = "https://router.jd.com/api";
    public $format = "json";
    public $connectTimeout;
    public $readTimeout;
    protected $signMethod = "md5";
    protected $apiVersion = "1.0";
    protected $sdkVersion = "top-sdk-php-20180326";

    public function __construct($appkey = "", $secretKey = "")
    {
        $this->appkey = $appkey;
        $this->secretKey = $secretKey;
    }

    public function getAppkey()
    {
        return $this->appkey;
    }

    public function setGatewayUrl($gatewayUrl)
    {
        $this->gatewayUrl = $gatewayUrl;
    }

    public function setFormat($format)
    {
        $this->format = $format;
    }

    // 请求
    public function execute($url, $param)
    {

        $data["app_key"] = $this->appkey;
        $data["v"] = $this->apiVersion;
        $data["format"] = $this->format;
        $data["sign_method"] = $this->signMethod;
        $data["timestamp"] = date('Y-m-d H:i:s');
        $data['method'] = $url;
        $data['param_json'] = json_encode($param);
        //生成签名
        $sign = Util::createSign($data, $this->secretKey);

        $strParam = Util::createStrParam($data);
        $strParam .= 'sign=' . $sign;
        $url = $this->gatewayUrl . '?' . $strParam;


        $result = file_get_contents($url);
        $result = json_decode($result, true);

        return $result;
    }
}
