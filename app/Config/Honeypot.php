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

=======
>>>>>>> a3f02c4b0f4736440cdd0afc6ed9b10879e6dbef
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

	/**
	 * Honeypot container
	 *
	 * @var string
	 */
	public $container = '<div style="display:none">{template}</div>';
=======
>>>>>>> a3f02c4b0f4736440cdd0afc6ed9b10879e6dbef
}
