<?php namespace Config;

use CodeIgniter\Config\BaseConfig;

class Images extends BaseConfig
{
	/**
	 * Default handler used if no other handler is specified.
	 *
	 * @var string
	 */
	public $defaultHandler = 'gd';

	/**
	 * The path to the image library.
	 * Required for ImageMagick, GraphicsMagick, or NetPBM.
	 *
	 * @var string
	 */
	public $libraryPath = '/usr/local/bin/convert';

	/**
	 * The available handler classes.
	 *
<<<<<<< HEAD
<<<<<<< HEAD
	 * @var \CodeIgniter\Images\Handlers\BaseHandler[]
=======
	 * @var array
>>>>>>> a3f02c4b0f4736440cdd0afc6ed9b10879e6dbef
=======
	 * @var \CodeIgniter\Images\Handlers\BaseHandler[]
>>>>>>> 545025698c6c7be18bd842f8bcc798818ed0db11
	 */
	public $handlers = [
		'gd'      => \CodeIgniter\Images\Handlers\GDHandler::class,
		'imagick' => \CodeIgniter\Images\Handlers\ImageMagickHandler::class,
	];
}
