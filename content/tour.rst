========
PHP Tour
========

Welcome
=======

Hello Earthling
---------------

Welcome to the tour of the PHP programming language.

This tour will guide you through PHP's syntax. From variables, functions,
classes, to types. We will cover it all.

On the side, you see a panel where you can enter PHP source code. Clicking on
"Run code" makes the code run, and show the output.

Try it out!

Now change ``Earthling`` to your name, and click "Run code" once more.

If you have done something wrong, you can always reset to the original code
with the "Reset code" button.

Try that out too!

Now you are ready for your first lesson. Click on "Next" to go there.

You can also use the navigation at the bottom of this page to skip to other
modules and lessons.

::

	<?php
	echo 'Hello Earthling';


Variables
=========

Assignment
----------

Let's first look how variables work. Variables can be used to store
information.

In PHP, all variables start with ``$``, and they are case-sensitive.

Variables do not need to be declared nor typed. You can assign any value to
it!

The ``echo`` keyword can be used to show the contents of a variable.

Each variable, can also contain values of different types, such as a
``string``, ``number`` (we call those integers or doubles), and ``boolean``,
and many more.

You can see that for the boolean ``true`` value, PHP shows ``1``. If you
change it to ``false``, PHP shows nothing. Try it out!

On the next page, we will look at some other ways of doing this.

::

	<?php
	$iAmAVariable = "this is my value";
	echo $iAmAVariable, "\n";

	$iAmAVariable = "this is a new value";
	echo $iAmAVariable, "\n";

	$anotherVariable = 42;
	$anotherVariable = 3.1415; // mmm, PIE
	echo $anotherVariable, "\n";

Display
-------

In the previous page we saw that you can use ``echo`` for displaying the value
of a variable. But there are other ways.

Although PHP has good debugging tools, in some cases (like here) you might
want to use the ``var_dump()`` function.

Run the code, and see what it outputs.

Instead of showing nothing, it also shows the type with the value.

Now try changing the value of the ``$myVariable`` variable to a whole range of
different things, such as ``"My mother is a hamster"``, or ``88.8``.

::

	<?php
	$myVariable = false;
	var_dump($myVariable);
