<?php namespace Config;

use CodeIgniter\Events\Events;
<<<<<<< HEAD
<<<<<<< HEAD
use CodeIgniter\Exceptions\FrameworkException;
=======
>>>>>>> a3f02c4b0f4736440cdd0afc6ed9b10879e6dbef
=======
use CodeIgniter\Exceptions\FrameworkException;
>>>>>>> 545025698c6c7be18bd842f8bcc798818ed0db11

/*
 * --------------------------------------------------------------------
 * Application Events
 * --------------------------------------------------------------------
 * Events allow you to tap into the execution of the program without
 * modifying or extending core files. This file provides a central
 * location to define your events, though they can always be added
 * at run-time, also, if needed.
 *
 * You create code that can execute by subscribing to events with
 * the 'on()' method. This accepts any form of callable, including
 * Closures, that will be executed when the event is triggered.
 *
 * Example:
 *      Events::on('create', [$myInstance, 'myMethod']);
 */

Events::on('pre_system', function () {
	if (ENVIRONMENT !== 'testing')
	{
<<<<<<< HEAD
<<<<<<< HEAD
=======
>>>>>>> 545025698c6c7be18bd842f8bcc798818ed0db11
		if (ini_get('zlib.output_compression'))
		{
			throw FrameworkException::forEnabledZlibOutputCompression();
		}

		while (ob_get_level() > 0)
		{
			ob_end_flush();
		}

		ob_start(function ($buffer) {
<<<<<<< HEAD
=======
		while (\ob_get_level() > 0)
		{
			\ob_end_flush();
		}

		\ob_start(function ($buffer) {
>>>>>>> a3f02c4b0f4736440cdd0afc6ed9b10879e6dbef
=======
>>>>>>> 545025698c6c7be18bd842f8bcc798818ed0db11
			return $buffer;
		});
	}

	/*
	 * --------------------------------------------------------------------
	 * Debug Toolbar Listeners.
	 * --------------------------------------------------------------------
	 * If you delete, they will no longer be collected.
	 */
	if (ENVIRONMENT !== 'production')
	{
		Events::on('DBQuery', 'CodeIgniter\Debug\Toolbar\Collectors\Database::collect');
		Services::toolbar()->respond();
	}
});
