#!/bin/bash

https="https"
if [ "$1" == "$https" ]; then
	cp .htaccess-https .htaccess
else
	cp .htaccess-http .htaccess
fi

wget https://getcomposer.org/composer.phar
php composer.phar update
rm composer.phar*
