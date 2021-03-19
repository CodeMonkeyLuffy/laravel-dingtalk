<?php

namespace DingTalk\Kernel\Http;

class Client
{
    const BASE_URI = "https://oapi.dingtalk.com/";

    protected $app;

    protected $config;


    public function __construct($app)
    {
        $this->app = $app;
        $this->config = $this->app['config'];
    }

    /**
     * 授权请求
     */
    public function httpAuthGet(string $url, array $query = [])
    {
        $query["access_token"] = $this->app["access_token"]->getToken();
        $client = new \GuzzleHttp\Client();
        $req = $client->get(self::BASE_URI . $url, [
            "query" => $query
        ]);
        return json_decode($req->getBody()->getContents(), true);
    }

    /**
     * @param string $url
     * @param array $query
     * @return mixed
     */
    public function httpGet(string $url, array $query = [])
    {
        $client = new \GuzzleHttp\Client();
        $req = $client->get(self::BASE_URI . $url, [
            "query" => $query
        ]);
        return json_decode($req->getBody()->getContents(), true);
    }

    public function httpAuthPost(string $url, array $data = [])
    {
        $access_token = $this->app["access_token"]->getToken();
        $client = new \GuzzleHttp\Client();
        $req = $client->post(self::BASE_URI . $url . "?access_token=" . $access_token, [
            "json" => $data
        ]);
        return json_decode($req->getBody()->getContents(), true);
    }

    /**
     * post请求
     * @param string $url
     * @param array $data
     * @return mixed
     */
    public function httpPost(string $url, array $data = [])
    {
        $client = new \GuzzleHttp\Client();
        $req = $client->post(self::BASE_URI . $url, [
            "json" => $data
        ]);
        return json_decode($req->getBody()->getContents(), true);
    }

}
