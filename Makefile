clear:
	rm -rf ./temp/cache

server:
	php -S localhost:8000 -t www
