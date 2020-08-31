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
<<<<<<< HEAD
<<<<<<< HEAD
=======
=======
>>>>>>> 545025698c6c7be18bd842f8bcc798818ed0db11

	public $signin = [
		'username'     => 'required',
		'password'     => 'required'
	];

	public $signup = [
		'username' 	=> 'required|min_length[3]|max_length[100]|is_unique[user.username]|alpha_dash',
		'password' 	=> 'required|min_length[6]',
		'nama' 		=> 'required|min_length[3]|max_length[50]',
		'email'		=> 'required|valid_email|max_length[100]|is_unique[user.email]'
	];

	public $addBank = [
<<<<<<< HEAD
		'nama_bank'	=> 'required|in_list[bri,bni,bca,mandiri]',
=======
		'nama_bank'	=> 'required|in_list[bri,bni,bca,mandiri,edc]',
>>>>>>> 545025698c6c7be18bd842f8bcc798818ed0db11
		'nomor_rekening' => 'required|max_length[50]|alpha_dash',
		'atas_nama'	=> 'required|max_length[50]|alpha_space'
	];

	public $addJuragan = [
		'nama_juragan' => 'required|min_length[3]|max_length[60]|is_unique[juragan.nama_juragan]',
		'bank' 	=> 'required'
	];

	public $editJuragan = [
		'id' 		=> 'required|integer',
		'nama_juragan' => 'required|min_length[3]|max_length[60]',
		'bank' 	=> 'required'
	];

	public $addPengguna = [
		'username' 	=> 'required|min_length[3]|max_length[100]|is_unique[user.username]|alpha_dash',
		'password' 	=> 'required|min_length[6]',
		'nama' 		=> 'required|min_length[3]|max_length[50]',
		'email'		=> 'required|valid_email|max_length[100]|is_unique[user.email]',
		'level' 	=> 'required|in_list[superadmin,admin,cs,viewer,reseller]',
		'status' 	=> 'required|in_list[pending,inactive,active,blocked]',
<<<<<<< HEAD
		// 'juragan' 	=> 'required',
	];

	public $editPengguna = [
		// 'username' 	=> 'required|min_length[3]|max_length[100]|is_unique[user.username,id,{id}]|alpha_dash',
		// 'password' 	=> 'min_length[6]',
=======
	];

	public $editPengguna = [
>>>>>>> 545025698c6c7be18bd842f8bcc798818ed0db11
		'nama' 		=> 'required|min_length[3]|max_length[50]',
		'email'		=> 'required|valid_email|max_length[100]|is_unique[user.email,id,{id}]',
		'level' 	=> 'required|in_list[superadmin,admin,cs,viewer,reseller]',
		'status' 	=> 'required|in_list[pending,inactive,active,blocked]',
<<<<<<< HEAD
		// 'juragan' 	=> 'required',
	];
>>>>>>> a3f02c4b0f4736440cdd0afc6ed9b10879e6dbef
=======
	];

	public $addInvoice = [
		'juragan' 		=> 'required',
		'pengguna'		=> 'required',
		'asal_orderan' 	=> 'required',
		'tanggal_order'	=> 'required',
		'pelanggan' 	=> 'required',
		'juragan' 		=> 'required',
		// 'keterangan' => 'required',
		'produk' 		=> 'required'
		// 'biaya' 		=> 'required'
	];

	public $simpanProgress = [
		'id_invoice' 	=> 'required',
		'status'		=> 'required',
		'stat' 			=> 'required'
		// 'keterangan' 	=> 'required'
	];
>>>>>>> 545025698c6c7be18bd842f8bcc798818ed0db11
}
