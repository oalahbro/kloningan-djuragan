<?php namespace Config;

class Validation
{
	//--------------------------------------------------------------------
	// Setup
	//--------------------------------------------------------------------

	/**
	 * Stores the classes that contain the
	 * rules that are available.
	 *
	 * @var array
	 */
	public $ruleSets = [
		\CodeIgniter\Validation\Rules::class,
		\CodeIgniter\Validation\FormatRules::class,
		\CodeIgniter\Validation\FileRules::class,
		\CodeIgniter\Validation\CreditCardRules::class,
	];

	/**
	 * Specifies the views that are used to display the
	 * errors.
	 *
	 * @var array
	 */
	public $templates = [
		'list'   => 'CodeIgniter\Validation\Views\list',
		'single' => 'CodeIgniter\Validation\Views\single',
	];

	//--------------------------------------------------------------------
	// Rules
	//--------------------------------------------------------------------

	public $signin = [
		'username'     => 'required',
		'password'     => 'required'
	];

	public $signup = [
		'username' 	=> 'required|min_length[3]|max_length[100]|is_unique[user.username]|alpha_dash',
		'password' 	=> 'required|min_length[6]',
		'nama' 		=> 'required|min_length[3]|max_length[50]',
		'email'		=> 'required|valid_email|max_length[100]|is_unique[user.email]',
	];
}
