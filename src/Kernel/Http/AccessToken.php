<?php

namespace DingTalk\Kernel\Http;

use DingTalk\Kernel\Concerns\InteractsWithCache;
use DingTalk\Kernel\Exceptions\InvalidCredentialsException;

class AccessToken
{
    use InteractsWithCache;


    protected $app;


    public function __construct($app)
    {
        $this->app = $app;
    }

    /**
     * 获取 AccessToken
     */
    public function getToken()
    {
        return $this->get()['access_token'];
    }

    /**
     * 获取钉钉 AccessToken
     */
    public function get()
    {
        $cache = $this->getCache()->get($this->cacheFor());
        if (!empty($cache["access_token"])) {
            return $cache;
        }
        return $this->refresh();
    }

    /**
     * 缓存 Key
     *
     * @return string
     */
    protected function cacheFor()
    {
        return sprintf('access_token.%s', $this->app['config']->get('dingtalk_appkey'));
    }

    /**
     * 刷新钉钉 AccessToken
     */
    public function refresh()
    {
        $value = (new Client($this->app))->httpGet("gettoken", [
            'appkey' => $this->app['config']->get('dingtalk_appkey'),
            'appsecret' => $this->app['config']->get('dingtalk_appsecret'),
        ]);

        if ($value['errcode'] != 0) {
            throw new InvalidCredentialsException(json_encode($value));
        }
        $this->getCache()->set($this->cacheFor(), $value, $value['expires_in']);
        return $value;
    }
}
