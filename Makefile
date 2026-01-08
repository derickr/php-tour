setup: content/vendor/autoload.php

content/vendor/autoload.php: content/composer.lock
	cd content && composer install

build: pages/index.php

pages/index.php: content/tour.rst
	cd content && php compile.php

run:
	cd public && php -S localhost:7777
