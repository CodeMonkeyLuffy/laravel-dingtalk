<?php

namespace DingTalk;

use DingTalk\Kernel\Support\Collection;
use Pimple\Container;


/**
 * @property \DingTalk\User\Client $user
 * @property \DingTalk\Attendance\Client $attendance
 * @property \DingTalk\Department\Client $department
 * @property \DingTalk\Message\Client $message
 * @property \DingTalk\Kernel\Http\AccessToken $access_token
 */
class DingTalk extends Container
{
    /**
     * @var array
     */
    protected $providers = [
        User\ServiceProvider::class,
        Attendance\ServiceProvider::class,
        Department\ServiceProvider::class,
        Message\ServiceProvider::class,
        Kernel\Providers\ClientServiceProvider::class,
        Kernel\Providers\LoggerServiceProvider::class,
        Kernel\Providers\AccessTokenServiceProvider::class,
    ];

    /**
     * Application constructor.
     *
     * @param array $config
     * @param array $values
     */
    public function __construct($config = [], array $values = [])
    {
        parent::__construct($values);

        if (count($config) < 1) {
            $config = config("dingtalk");
        }

        $this['config'] = function () use ($config) {
            return new Collection($config);
        };

        foreach ($this->providers as $provider) {
            $this->register(new $provider());
        }
    }

    /**
     * @param $name
     *
     * @return mixed
     */
    public function __get($name)
    {
        return $this[$name];
    }
}
