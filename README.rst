PHP Tour
========

Prerequisites
-------------

- PHP 8.4, and runnable as "php" on the command line
- Compose installed, and runnable as "composer" on the command line

Running the Tour
----------------

You can start the PHP built-in web server with the tour, with::

	make run

Updating Content
----------------

First set up the compiler::

	make setup

Edit the contents of `content/tour.rst`, and then run::

	make build
