<h1 align="center"> weather </h1>

<p align="center"> 基于 高德开放平台 的 PHP 天气信息组件。</p>

[![Tests](https://github.com/Ctlynl/weather/actions/workflows/tests.yml/badge.svg)](https://github.com/Ctlynl/weather/actions/workflows/tests.yml)

## 安装

```shell
$ composer require ctlynl/weather:v2.0 -vvv
```

## 配置
###### 在使用本扩展之前，你需要去 高德开放平台 注册账号，然后创建应用，获取应用的 API Key

## 使用

```shell
use Overtrue\Weather\Weather;

$key = 'xxxxxxxxxxxxxxxxxxxxxxxxxxx';

$weather = new Weather($key);
```

### 参数说明
```shell
1、$city - 城市名，比如：“深圳”；
3、$format - 输出的数据格式，默认为 json 格式，当 output 设置为 “xml” 时，输出的为 XML 格式的数据。
```

#### 获取实时天气
```shell
$response = $weather->getLiveWeather('深圳');
```

#### 获取近期天气预报
```shell
$response = $weather->getForecastsWeather('深圳');
```

#### 获取 XML 格式返回值（默认json）
```shell
$response = $weather->getLiveWeather('深圳', 'xml');
```

## LICENSE MIT