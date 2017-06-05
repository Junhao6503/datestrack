# 货期查询网站

## Intro

此网站用于追踪购买货期，请在公司内网连接SD_1F路由器后访问[货期查询表](http://192.168.3.21)

## Prerequisites

你需要有一台安装了php7.0, sqlite3/MySql, Nginx/Apache环境的Linux机器。
在此版本中，将以Nginx+PhP+sqlite3为环境。

### 安装Nginx
```bash
sudo apt-get install nginx
```
### 安装php7.0和sqlite
```bash
sudo apt-get install php7.0
sudo apt-get install php7.0-fpm
sudo apt-get install php7.0-sqlite
```
```bash
sudo apt-get install sqlite3
```

### 启动Nginx
```bash
sudo /etc/init.d/nginx start
```

### 修改nginx的配置文件
```bash
sudo nano /etc/nginx/sites-available/default
```
找到root行，修改目录，建议修改为：（此为在Orangepi上第一版本Nginx根目录）
```
/var/www
```

找到listen行, 修改如下：
```
listen 80; ## listen for ipv4
```
找到php的定义段，将这些行的注释去掉 ，修改后内容如下
```
location ~ \.php$ {
　fastcgi_pass unix:/var/run/php5-fpm.sock;
　fastcgi_index index.php;
　include fastcgi_params;
}
```
重新加载nginx的配置
```bash
sudo /etc/init.d/nginx reload
```
## 使用

### 第一次使用

下载或克隆这个repo到Linux机器，并把其中文件放入Nginx root目录下（/var/www）。
运行php编译器检查是否报错
```bash
php -f index.php
php -f mech_page.php
```
之后运行
```bash
ls /var/www
```
查看是否有`Test.db`数据库文件，如果`Test.db`文件存在，请运行`chmod 777 Test.db`更改数据库权限至全用户可读写，或把root目录文件夹切换为全用户可读写。

打开浏览器，在地址栏输入Linux机器的固定ip访问网页。

##关于sqlite

用户可以随时运行`sqlite3 /var/www` 查看数据库情况。
默认表名字为`COMPANY`

进入sqlite3之后运行
```
.schema COMPANY;
```
查看数据库中的表的完整信息。

运行
```
.header on
.mode column
select * from COMPANY;
```
查看表中数据

### 默认表的详细信息
默认的表有11列。
1.ID：主键   
2.NAME：产品名称   
3.DEPARTMENT：部门   
4.AMOUNT：采购数量   
5.PURCHASE_DATE:购买日期   
6.EXPECT_DATE：预计到货日期   
7.ACTUAL_DATE：实际到货日期   
8:BRAND：厂家   
9.MAIL_DATE：发货日期   
10.DELETE_F：删除旗标   
11.comment：注释（未用）   

