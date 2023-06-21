<?php

/*
 * This file is part of the ctlynl/weather.
 *
 * (c) ctlynl <i@ctlynl.me>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Ctlynl\Weather;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Ctlynl\Weather\Exceptions\InvalidArgumentException;
use Ctlynl\Weather\Exceptions\HttpException;

/**
 * 获取天气类
 * Class Weather.
 */
class Weather
{
    /**
     * key.
     */
    protected string $key;

    /**
     * GuzzleHttp 配置参数.
     */
    protected array $guzzleOptions = [];

    /**
     * Weather constructor.
     */
    public function __construct(string $key)
    {
        $this->key = $key;
    }

    public function getHttpClient(): Client
    {
        return new Client($this->guzzleOptions);
    }

    public function setGuzzleOptions(array $options)
    {
        $this->guzzleOptions = $options;
    }

    /**
     * 获取实时天气.
     *
     * @throws InvalidArgumentException
     * @throws GuzzleException
     * @throws HttpException
     */
    public function getLiveWeather($city, $format = 'json')
    {
        return $this->getWeather($city, 'base', $format);
    }

    /**
     * 获取天气预报.
     *
     * @throws InvalidArgumentException
     * @throws GuzzleException
     * @throws HttpException
     */
    public function getForecastsWeather($city, $format = 'json')
    {
        return $this->getWeather($city, 'all', $format);
    }

    /**
     * 获取天气接口.
     *
     * @return mixed|string|array
     *
     * @throws GuzzleException
     * @throws HttpException
     * @throws InvalidArgumentException
     */
    public function getWeather($city, string $type = 'base', string $format = 'json')
    {
        $url = 'https://restapi.amap.com/v3/weather/weatherInfo';

        if (!\in_array(\strtolower($format), ['xml', 'json'])) {
            throw new InvalidArgumentException('Invalid response format: '.$format);
        }

        if (!\in_array(\strtolower($type), ['base', 'all'])) {
            throw new InvalidArgumentException('Invalid type value(base/all): '.$type);
        }

        $query = array_filter([
            'key' => $this->key,
            'city' => $city,
            'output' => $format,
            'extensions' => $type,
        ]);

        try {
            $response = $this->getHttpClient()->get($url, [
                'query' => $query,
            ])->getBody()->getContents();

            return 'json' === $format ? \json_decode($response, true) : $response;
        } catch (\Exception $e) {
            throw new HttpException($e->getMessage(), $e->getCode(), $e);
        }
    }
}
