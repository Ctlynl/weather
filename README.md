<h1 align="center"> weather </h1>

<p align="center"> 基于 高德开放平台 的 PHP 天气信息组件。</p>


## 安装

```shell
$ composer require ctlynl/weather -vvv
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
2、$type - 返回内容类型：base: 返回实况天气 / all: 返回预报天气；
3、$format - 输出的数据格式，默认为 json 格式，当 output 设置为 “xml” 时，输出的为 XML 格式的数据。
```

#### 获取实时天气
```shell
$response = $weather->getWeather('深圳', 'base');
```

#### 获取近期天气预报
```shell
$response = $weather->getWeather('深圳', 'all');
```

#### 获取 XML 格式返回值（默认json）
```shell
$response = $weather->getWeather('深圳', 'all', 'xml');
```

## LICENSE MIT