# Hyperf API 基础模板

开箱即用的 Hyperf API 基础结构。
> 自己用的哈，仅供参考，不提供咨询解答服务。
> 
# Requirements
 - PHP >= 7.4
 - Swoole PHP extension >= 4.5，and Disabled `Short Name`
 - OpenSSL PHP extension
 - JSON PHP extension
 - PDO PHP extension （If you need to use MySQL Client）
 - Redis PHP extension （If you need to use Redis Client）
 - Protobuf PHP extension （If you need to use gRPC Server of Client）

# Installation using Composer

The easiest way to create a new Hyperf project is to use Composer. If you don't have it already installed, then please install as per the documentation.

To create your new Hyperf project:

```bash
$ composer create-project larva/hyperf-skeleton path/to/install
```

Once installed, you can run the server immediately using the command below.

```bash
$ cd path/to/install
$ php bin/hyperf.php start
```

This will start the cli-server on port `9501`, and bind it to all network interfaces. You can then visit the site at `http://localhost:9501/`

which will bring up Hyperf default home page.
