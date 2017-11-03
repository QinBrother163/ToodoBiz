定时服务 与 后台服务
-
* 定时任务
`su apache`
`crontab -e`编辑任务列表添加   
`* * * * * php /toodo/work.release/ToodoBiz/artisan schedule:run >> /dev/null 2>&1`  

* 后台服务
编辑 `vi /etc/supervisord.conf` 添加后台监控程序
如果php命令出错，php命令用全路径
```
[program:tdbiz-worker]
process_name=%(program_name)s_%(process_num)02d
command=php /toodo/work.release/ToodoBiz/artisan queue:work --sleep=3 --tries=3
autostart=true
autorestart=true
user=apache
numprocs=4
redirect_stderr=true
stdout_logfile=/toodo/work.release/ToodoBiz/storage/logs/worker.log
```
* `supervisorctl reload`
* `supervisorctl start tdbiz-worker`


已有项目部署
-
* `php artisan down`
* `git pull`
* `php artisan clear-compiled`
* `php artisan optimize`
* `php artisan up`


新项目部署
-
安装依赖项
* `git clone -b master git@code.aliyun.com:toodo/ToodoService.git`
* `composer install --optimize-autoloader --no-dev`
* `composer dump-autoload --optimize`
* `php artisan clear-compiled`
* `php artisan optimiz`

生成应用密匙
* `cp .env.example .env`
* `php artisan key:generate`

创建mysql数据库 toodo_service
* `cd database & sh createdb.sh & cd ..`
* `php artisan migrate`
导入初始数据信息
* `cd database & sh importdb.sh & cd ..`

p
环境搭建
-
+ 安装node 我的版本是v6.10.0，上 https://nodejs.org/en/ 下载v6.10.x稳定版
+ 配置淘宝cnpm https://npm.taobao.org/
  `npm install -g cnpm --registry=https://registry.npm.taobao.org`

命令提示
-
+ `cnpm install --no-bin-links` Windows下安装依赖，重点是**no bin links**
+ `cnpm run dev`  生成开发版本代码
+ `cnpm run prod` 生成部署版本代码

目录结构
-
+ **node_modules** #npm安装的库，只有非人类才关注它
+ **public** #生产输出文件夹，服务器部署的就是它
+ **resources** #程序员工作的地方

* 分辨率
  + 模拟 640×480
  + 标清 720×576
  + 高清 1280×720
  + 全高清 1920×1080