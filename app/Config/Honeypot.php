<?php namespace Config;

use CodeIgniter\Config\BaseConfig;

class Honeypot extends BaseConfig
{

	/**
	 * Makes Honeypot visible or not to human
	 *
	 * @var boolean
	 */
	public $hidden = true;
<<<<<<< HEAD
<<<<<<< HEAD

=======
>>>>>>> a3f02c4b0f4736440cdd0afc6ed9b10879e6dbef
=======

>>>>>>> 545025698c6c7be18bd842f8bcc798818ed0db11
	/**
	 * Honeypot Label Content
	 *
	 * @var string
	 */
	public $label = 'Fill This Field';

	/**
	 * Honeypot Field Name
	 *
	 * @var string
	 */
	public $name = 'honeypot';

	/**
	 * Honeypot HTML Template
	 *
	 * @var string
	 */
	public $template = '<label>{label}</label><input type="text" name="{name}" value=""/>';
<<<<<<< HEAD
<<<<<<< HEAD
=======
>>>>>>> 545025698c6c7be18bd842f8bcc798818ed0db11

	/**
	 * Honeypot container
	 *
	 * @var string
	 */
	public $container = '<div style="display:none">{template}</div>';
<<<<<<< HEAD
=======
>>>>>>> a3f02c4b0f4736440cdd0afc6ed9b10879e6dbef
=======
>>>>>>> 545025698c6c7be18bd842f8bcc798818ed0db11
}
