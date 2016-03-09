# A ShortURL tool / 短网址工具
### Powered by Junorz.com && Laravel


一个使用Laravel框架写的短网址工具，对于拥有短域名的人来说也许是个不错的选择。

## Installation / 安装步骤
1.git clone https://github.com/junorz/shorturl.git  
2.切换到程序根目录下，使用composer安装依赖包  
```
composer install
```
3.为程序生成一个密钥  
```
cp .env.example .env
php artisan key:generate
```
4.切换到database目录下生成数据库  
```
cd database
sqlite3 database.sqlite
.quit
```
5.回到程序根目录，迁移数据表  
```
cd ..
php artisan migrate
```
6.更改权限，比如运行nginx的是www用户的话可以这样写   
```
chown -R www:www ./*
```


## Demo / 演示
http://s.junorz.com


## License / 开源协议

This software licensed under the [MIT license](http://opensource.org/licenses/MIT).
