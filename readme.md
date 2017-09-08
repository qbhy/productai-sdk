# productai-laravel
码隆科技 ProductAI Laravel SDK

## 安装
1. 下载
```bash
composer require 96qbhy/productai-laravel
```

2. 添加服务提供者
```php
'providers' => [
    ...
    Qbhy\ProductAI\ProductAIServiceProvider::class,
]
```

3. 发布配置文件
```bash
php artisan vendor:publish --provider="Qbhy\ProductAI\ProductAIServiceProvider"
```

## 使用
```php
<?php

namespace App\Http\Controllers;

use Qbhy\ProductAI;

class AliPayController extends Controller
{

    public function example(ProductAI $api)
    {
        $api->search(file_get_contents(__DIR__.'/test.png'));
        // $api->addImage(...);
    }

}

```

[https://github.com/96qbhy/productai-laravel](https://github.com/96qbhy/productai-laravel)  
96qbhy@gmail.com



