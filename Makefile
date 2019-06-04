clear:
	rm -rf ./temp/cache

server:
	php -S localhost:8000 -t www

resetDb:
	mysql -uroot -p oidococina < oidococina.sql
