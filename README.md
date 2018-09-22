# framework-demo

针对asbamboo/framework开发的demo


安装
-----
	
	composer create-project asbamboo/framework-demo asbamboo-demo --prefer-source -s dev

WEB TEST RUN[linux]
-------------------------
	
	cd ./asbamboo-demo/public && php -S 127.0.0.1:8000

CONSOLE TEST RUN[linux]
-------------------------------

	./asbamboo-demo/bin/console

	

它的功能：
-------------------------------

1. 需要通过命令行创建管理员。

2. 管理员通过后台，管理一般用户和文章。

3. 一般用户只能看所有文章和编辑自己发布的文章。

4. 匿名用户只能浏览文章列表
	