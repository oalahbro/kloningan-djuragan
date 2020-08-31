<?php
namespace Config;

use CodeIgniter\Config\BaseConfig;

/**
 * Encryption configuration.
 *
 * These are the settings used for encryption, if you don't pass a parameter
 * array to the encrypter for creation/initialization.
 */
class Encryption extends BaseConfig
{
	/*
	  |--------------------------------------------------------------------------
	  | Encryption Key Starter
	  |--------------------------------------------------------------------------
	  |
	  | If you use the Encryption class you must set an encryption key (seed).
	  | You need to ensure it is long enough for the cipher and mode you plan to use.
	  | See the user guide for more info.
	 */

<<<<<<< HEAD
<<<<<<< HEAD
	public $key = '';
=======
	public $key = '2cc1cc44135953e130fff7558533305e';
>>>>>>> a3f02c4b0f4736440cdd0afc6ed9b10879e6dbef
=======
	public $key = '2cc1cc44135953e130fff7558533305e';
>>>>>>> 545025698c6c7be18bd842f8bcc798818ed0db11

	/*
	  |--------------------------------------------------------------------------
	  | Encryption driver to use
	  |--------------------------------------------------------------------------
	  |
	  | One of the supported drivers, eg 'OpenSSL' or 'Sodium'.
	  | The default driver, if you don't specify one, is 'OpenSSL'.
	 */
	public $driver = 'OpenSSL';

}
