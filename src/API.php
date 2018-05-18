<?php
/**
 * User: qbhy
 * Date: 2018/5/17
 * Time: 下午4:09
 */

namespace Qbhy\ProductAI;


use GuzzleHttp\Client;

class API
{
    /** @var \Qbhy\ProductAI\ProductAI */
    protected $app;

    /** @var \GuzzleHttp\Client */
    protected $httpClient;

    const VERSION = '0.4.0';

    public function __construct(ProductAI $app)
    {
        $this->app = $app;

        $this->httpClient = new Client([
            'timeout' => 30.0,
            'verify'  => __DIR__ . '/ca.pem',
            'headers' => [
                [
                    'x-ca-version'     => 1,
                    'x-ca-accesskeyid' => $this->app->config->get('access_key_id'),
                    'user-agent'       => "ProductAI-SDK-PHP/{$this->version()} (+https://www.productai.cn)",
                    'accept-language'  => $this->app->config->get('language'),
                ]
            ],
        ]);
    }

    public static function version()
    {
        return static::VERSION;
    }

    public function request()
    {
        
    }

}