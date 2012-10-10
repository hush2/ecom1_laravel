<?php

return array(

	/*
	|--------------------------------------------------------------------------
	| Database Query Logging
	|--------------------------------------------------------------------------
	|
	| By default, the SQL, bindings, and execution time are logged in an array
	| for you to review. They can be retrieved via the DB::profile() method.
	| However, in some situations, you may want to disable logging for
	| ultra high-volume database work. You can do so here.
	|
	*/

	'profile' => true,

	/*
	|--------------------------------------------------------------------------
	| PDO Fetch Style
	|--------------------------------------------------------------------------
	|
	| By default, database results will be returned as instances of the PHP
	| stdClass object; however, you may wish to retrieve records as arrays
	| instead of objects. Here you can control the PDO fetch style of the
	| database queries run by your application.
	|
	*/

	'fetch' => PDO::FETCH_CLASS,

	/*
	|--------------------------------------------------------------------------
	| Default Database Connection
	|--------------------------------------------------------------------------
	|
	| The name of your default database connection. This connection will used
	| as the default for all database operations unless a different name is
	| given when performing said operation. This connection name should be
	| listed in the array of connections below.
	|
	*/

	'default' => 'mysql',

	/*
	|--------------------------------------------------------------------------
	| Database Connections
	|--------------------------------------------------------------------------
	|
	| All of the database connections used by your application. Many of your
	| applications will no doubt only use one connection; however, you have
	| the freedom to specify as many connections as you can handle.
	|
	| All database work in Laravel is done through the PHP's PDO facilities,
	| so make sure you have the PDO drivers for your particlar database of
	| choice installed on your machine.
	|
	*/

	'connections' => array(

		'sqlite' => array(
			'driver'   => 'sqlite',
			'database' => 'application',
			'prefix'   => '',
		),

		'mysql' => array(
			'driver'   => 'mysql',
			'host'     => getenv('MYSQL_DB_HOST')  ?: 'localhost',
			'database' => getenv('MYSQL_DB_NAME')  ?: 'ecom1_laravel',
			'username' => getenv('MYSQL_USERNAME') ?: 'root',
			'password' => getenv('MYSQL_PASSWORD') ?: 'beer',
			'charset'  => 'utf8',
			'prefix'   => '',
		),
	),

);
