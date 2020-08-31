<?php namespace Config;

<<<<<<< HEAD
use CodeIgniter\Config\BaseConfig;

=======
>>>>>>> a3f02c4b0f4736440cdd0afc6ed9b10879e6dbef
/**
 * Setup how the exception handler works.
 *
 * @package Config
 */
<<<<<<< HEAD
class Exceptions extends BaseConfig
=======

class Exceptions
>>>>>>> a3f02c4b0f4736440cdd0afc6ed9b10879e6dbef
{
	/*
	 |--------------------------------------------------------------------------
	 | LOG EXCEPTIONS?
	 |--------------------------------------------------------------------------
	 | If true, then exceptions will be logged
	 | through Services::Log.
	 |
	 | Default: true
	 */
	public $log = true;

	/*
	 |--------------------------------------------------------------------------
	 | DO NOT LOG STATUS CODES
	 |--------------------------------------------------------------------------
	 | Any status codes here will NOT be logged if logging is turned on.
	 | By default, only 404 (Page Not Found) exceptions are ignored.
	 */
	public $ignoreCodes = [ 404 ];

	/*
	|--------------------------------------------------------------------------
	| Error Views Path
	|--------------------------------------------------------------------------
	| This is the path to the directory that contains the 'cli' and 'html'
	| directories that hold the views used to generate errors.
	|
	| Default: APPPATH.'Views/errors'
	*/
	public $errorViewPath = APPPATH . 'Views/errors';
}
