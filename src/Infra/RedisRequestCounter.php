<?php

namespace App\Infra;

use Redis;

class RedisRequestCounter implements RequestCounterInterface
{
    const STORAGE_KEY = 'requests.count';

    /**
     * @var Redis
     */
    private $client;

    /**
     * @var string
     */
    private $host;

    /**
     * @var int
     */
    private $port;

    /**
     * @var float
     */
    private $timeout;

    public function __construct(string $host,  int $port = 6379, float $timeout = 0.5)
    {
        $this->client = new Redis();
        $this->host = $host;
        $this->port = $port;
        $this->timeout = $timeout;
    }


    /**
     * returns current value after count increase
     *
     * @return int
     */
    public function increase(): int
    {
        return $this->connect()->incr(self::STORAGE_KEY);
    }

    public function getCurrentCount(): int
    {
        return $this->connect()->get(self::STORAGE_KEY);
    }

    private function connect(): Redis
    {
        if (!$this->client->isConnected()) {
            $this->client->connect($this->host, $this->port, $this->timeout);
        }

        return $this->client;
    }
}