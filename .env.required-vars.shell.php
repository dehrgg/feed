<?php

// These variables are required by app.php, and should be defined in an environment file such as .env.php
// The actual .env.php files are excluded from the repository, so this serves as a shell to indicate which
// values are required.
return array(

	'DATABASE_INFO' => array(
			'driver'    => 'mysql',
			'host'      => '',	// ************************************
			'database'  => '',	//	Database configuration is required
			'username'  => '',	//	
			'password'  => '',	// ************************************
			'charset'   => 'utf8',
			'collation' => 'utf8_unicode_ci',
			'prefix'    => '',
		),
	'URL_ROOT' => '',		// Points to the root of the application installation
	'PARENT_ROOT'  => '',	// Points to the root of the website hosting this application, not the app itself.
	'DEBUG_ON' => true,		// enable debugging for the application
	'ENCRYPTION_KEY' => ''  // a random, 32 character string
);

?>