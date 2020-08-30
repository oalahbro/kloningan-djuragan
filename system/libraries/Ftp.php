<<<<<<< HEAD
<<<<<<< HEAD
<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * CodeIgniter
 *
 * An open source application development framework for PHP 5.1.6 or newer
 *
 * @package		CodeIgniter
 * @author		EllisLab Dev Team
 * @copyright		Copyright (c) 2008 - 2014, EllisLab, Inc.
 * @copyright		Copyright (c) 2014 - 2015, British Columbia Institute of Technology (http://bcit.ca/)
 * @license		http://codeigniter.com/user_guide/license.html
 * @link		http://codeigniter.com
 * @since		Version 1.0
 * @filesource
 */

// ------------------------------------------------------------------------
=======
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
<?php
/**
 * CodeIgniter
 *
 * An open source application development framework for PHP
 *
 * This content is released under the MIT License (MIT)
 *
 * Copyright (c) 2014 - 2016, British Columbia Institute of Technology
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 *
 * @package	CodeIgniter
 * @author	EllisLab Dev Team
 * @copyright	Copyright (c) 2008 - 2014, EllisLab, Inc. (https://ellislab.com/)
 * @copyright	Copyright (c) 2014 - 2016, British Columbia Institute of Technology (http://bcit.ca/)
 * @license	http://opensource.org/licenses/MIT	MIT License
 * @link	https://codeigniter.com
 * @since	Version 1.0.0
 * @filesource
 */
defined('BASEPATH') OR exit('No direct script access allowed');
<<<<<<< HEAD
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3

/**
 * FTP Class
 *
 * @package		CodeIgniter
 * @subpackage	Libraries
 * @category	Libraries
 * @author		EllisLab Dev Team
<<<<<<< HEAD
<<<<<<< HEAD
 * @link		http://codeigniter.com/user_guide/libraries/ftp.html
 */
class CI_FTP {

	var $hostname	= '';
	var $username	= '';
	var $password	= '';
	var $port		= 21;
	var $passive	= TRUE;
	var $debug		= FALSE;
	var $conn_id	= FALSE;


	/**
	 * Constructor - Sets Preferences
	 *
	 * The constructor can be passed an array of config values
	 */
	public function __construct($config = array())
	{
		if (count($config) > 0)
		{
			$this->initialize($config);
		}

		log_message('debug', "FTP Class Initialized");
=======
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
 * @link		https://codeigniter.com/user_guide/libraries/ftp.html
 */
class CI_FTP {

	/**
	 * FTP Server hostname
	 *
	 * @var	string
	 */
	public $hostname = '';

	/**
	 * FTP Username
	 *
	 * @var	string
	 */
	public $username = '';

	/**
	 * FTP Password
	 *
	 * @var	string
	 */
	public $password = '';

	/**
	 * FTP Server port
	 *
	 * @var	int
	 */
	public $port = 21;

	/**
	 * Passive mode flag
	 *
	 * @var	bool
	 */
	public $passive = TRUE;

	/**
	 * Debug flag
	 *
	 * Specifies whether to display error messages.
	 *
	 * @var	bool
	 */
	public $debug = FALSE;

	// --------------------------------------------------------------------

	/**
	 * Connection ID
	 *
	 * @var	resource
	 */
	protected $conn_id;

	// --------------------------------------------------------------------

	/**
	 * Constructor
	 *
	 * @param	array	$config
	 * @return	void
	 */
	public function __construct($config = array())
	{
		empty($config) OR $this->initialize($config);
		log_message('info', 'FTP Class Initialized');
<<<<<<< HEAD
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	}

	// --------------------------------------------------------------------

	/**
	 * Initialize preferences
	 *
<<<<<<< HEAD
<<<<<<< HEAD
	 * @access	public
	 * @param	array
	 * @return	void
	 */
	function initialize($config = array())
=======
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	 * @param	array	$config
	 * @return	void
	 */
	public function initialize($config = array())
<<<<<<< HEAD
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	{
		foreach ($config as $key => $val)
		{
			if (isset($this->$key))
			{
				$this->$key = $val;
			}
		}

		// Prep the hostname
		$this->hostname = preg_replace('|.+?://|', '', $this->hostname);
	}

	// --------------------------------------------------------------------

	/**
	 * FTP Connect
	 *
<<<<<<< HEAD
<<<<<<< HEAD
	 * @access	public
	 * @param	array	 the connection values
	 * @return	bool
	 */
	function connect($config = array())
=======
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	 * @param	array	 $config	Connection values
	 * @return	bool
	 */
	public function connect($config = array())
<<<<<<< HEAD
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	{
		if (count($config) > 0)
		{
			$this->initialize($config);
		}

		if (FALSE === ($this->conn_id = @ftp_connect($this->hostname, $this->port)))
		{
<<<<<<< HEAD
<<<<<<< HEAD
			if ($this->debug == TRUE)
			{
				$this->_error('ftp_unable_to_connect');
			}
=======
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
			if ($this->debug === TRUE)
			{
				$this->_error('ftp_unable_to_connect');
			}

<<<<<<< HEAD
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
			return FALSE;
		}

		if ( ! $this->_login())
		{
<<<<<<< HEAD
<<<<<<< HEAD
			if ($this->debug == TRUE)
			{
				$this->_error('ftp_unable_to_login');
			}
=======
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
			if ($this->debug === TRUE)
			{
				$this->_error('ftp_unable_to_login');
			}

<<<<<<< HEAD
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
			return FALSE;
		}

		// Set passive mode if needed
<<<<<<< HEAD
<<<<<<< HEAD
		if ($this->passive == TRUE)
=======
		if ($this->passive === TRUE)
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
		if ($this->passive === TRUE)
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
		{
			ftp_pasv($this->conn_id, TRUE);
		}

		return TRUE;
	}

	// --------------------------------------------------------------------

	/**
	 * FTP Login
	 *
<<<<<<< HEAD
<<<<<<< HEAD
	 * @access	private
	 * @return	bool
	 */
	function _login()
=======
	 * @return	bool
	 */
	protected function _login()
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
	 * @return	bool
	 */
	protected function _login()
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	{
		return @ftp_login($this->conn_id, $this->username, $this->password);
	}

	// --------------------------------------------------------------------

	/**
	 * Validates the connection ID
	 *
<<<<<<< HEAD
<<<<<<< HEAD
	 * @access	private
	 * @return	bool
	 */
	function _is_conn()
	{
		if ( ! is_resource($this->conn_id))
		{
			if ($this->debug == TRUE)
			{
				$this->_error('ftp_no_connection');
			}
			return FALSE;
		}
=======
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	 * @return	bool
	 */
	protected function _is_conn()
	{
		if ( ! is_resource($this->conn_id))
		{
			if ($this->debug === TRUE)
			{
				$this->_error('ftp_no_connection');
			}

			return FALSE;
		}

<<<<<<< HEAD
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
		return TRUE;
	}

	// --------------------------------------------------------------------

<<<<<<< HEAD
<<<<<<< HEAD

=======
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	/**
	 * Change directory
	 *
	 * The second parameter lets us momentarily turn off debugging so that
	 * this function can be used to test for the existence of a folder
<<<<<<< HEAD
<<<<<<< HEAD
	 * without throwing an error.  There's no FTP equivalent to is_dir()
	 * so we do it by trying to change to a particular directory.
	 * Internally, this parameter is only used by the "mirror" function below.
	 *
	 * @access	public
	 * @param	string
	 * @param	bool
	 * @return	bool
	 */
	function changedir($path = '', $supress_debug = FALSE)
	{
		if ($path == '' OR ! $this->_is_conn())
=======
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	 * without throwing an error. There's no FTP equivalent to is_dir()
	 * so we do it by trying to change to a particular directory.
	 * Internally, this parameter is only used by the "mirror" function below.
	 *
	 * @param	string	$path
	 * @param	bool	$suppress_debug
	 * @return	bool
	 */
	public function changedir($path, $suppress_debug = FALSE)
	{
		if ( ! $this->_is_conn())
<<<<<<< HEAD
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
		{
			return FALSE;
		}

		$result = @ftp_chdir($this->conn_id, $path);

		if ($result === FALSE)
		{
<<<<<<< HEAD
<<<<<<< HEAD
			if ($this->debug == TRUE AND $supress_debug == FALSE)
			{
				$this->_error('ftp_unable_to_changedir');
			}
=======
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
			if ($this->debug === TRUE && $suppress_debug === FALSE)
			{
				$this->_error('ftp_unable_to_changedir');
			}

<<<<<<< HEAD
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
			return FALSE;
		}

		return TRUE;
	}

	// --------------------------------------------------------------------

	/**
	 * Create a directory
	 *
<<<<<<< HEAD
<<<<<<< HEAD
	 * @access	public
	 * @param	string
	 * @return	bool
	 */
	function mkdir($path = '', $permissions = NULL)
	{
		if ($path == '' OR ! $this->_is_conn())
=======
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	 * @param	string	$path
	 * @param	int	$permissions
	 * @return	bool
	 */
	public function mkdir($path, $permissions = NULL)
	{
		if ($path === '' OR ! $this->_is_conn())
<<<<<<< HEAD
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
		{
			return FALSE;
		}

		$result = @ftp_mkdir($this->conn_id, $path);

		if ($result === FALSE)
		{
<<<<<<< HEAD
<<<<<<< HEAD
			if ($this->debug == TRUE)
			{
				$this->_error('ftp_unable_to_makdir');
			}
=======
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
			if ($this->debug === TRUE)
			{
				$this->_error('ftp_unable_to_mkdir');
			}

<<<<<<< HEAD
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
			return FALSE;
		}

		// Set file permissions if needed
<<<<<<< HEAD
<<<<<<< HEAD
		if ( ! is_null($permissions))
		{
			$this->chmod($path, (int)$permissions);
=======
		if ($permissions !== NULL)
		{
			$this->chmod($path, (int) $permissions);
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
		if ($permissions !== NULL)
		{
			$this->chmod($path, (int) $permissions);
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
		}

		return TRUE;
	}

	// --------------------------------------------------------------------

	/**
	 * Upload a file to the server
	 *
<<<<<<< HEAD
<<<<<<< HEAD
	 * @access	public
	 * @param	string
	 * @param	string
	 * @param	string
	 * @return	bool
	 */
	function upload($locpath, $rempath, $mode = 'auto', $permissions = NULL)
=======
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	 * @param	string	$locpath
	 * @param	string	$rempath
	 * @param	string	$mode
	 * @param	int	$permissions
	 * @return	bool
	 */
	public function upload($locpath, $rempath, $mode = 'auto', $permissions = NULL)
<<<<<<< HEAD
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	{
		if ( ! $this->_is_conn())
		{
			return FALSE;
		}

		if ( ! file_exists($locpath))
		{
			$this->_error('ftp_no_source_file');
			return FALSE;
		}

		// Set the mode if not specified
<<<<<<< HEAD
<<<<<<< HEAD
		if ($mode == 'auto')
=======
		if ($mode === 'auto')
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
		if ($mode === 'auto')
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
		{
			// Get the file extension so we can set the upload type
			$ext = $this->_getext($locpath);
			$mode = $this->_settype($ext);
		}

<<<<<<< HEAD
<<<<<<< HEAD
		$mode = ($mode == 'ascii') ? FTP_ASCII : FTP_BINARY;
=======
		$mode = ($mode === 'ascii') ? FTP_ASCII : FTP_BINARY;
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
		$mode = ($mode === 'ascii') ? FTP_ASCII : FTP_BINARY;
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3

		$result = @ftp_put($this->conn_id, $rempath, $locpath, $mode);

		if ($result === FALSE)
		{
<<<<<<< HEAD
<<<<<<< HEAD
			if ($this->debug == TRUE)
			{
				$this->_error('ftp_unable_to_upload');
			}
=======
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
			if ($this->debug === TRUE)
			{
				$this->_error('ftp_unable_to_upload');
			}

<<<<<<< HEAD
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
			return FALSE;
		}

		// Set file permissions if needed
<<<<<<< HEAD
<<<<<<< HEAD
		if ( ! is_null($permissions))
		{
			$this->chmod($rempath, (int)$permissions);
=======
		if ($permissions !== NULL)
		{
			$this->chmod($rempath, (int) $permissions);
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
		if ($permissions !== NULL)
		{
			$this->chmod($rempath, (int) $permissions);
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
		}

		return TRUE;
	}

	// --------------------------------------------------------------------

	/**
	 * Download a file from a remote server to the local server
	 *
<<<<<<< HEAD
<<<<<<< HEAD
	 * @access	public
	 * @param	string
	 * @param	string
	 * @param	string
	 * @return	bool
	 */
	function download($rempath, $locpath, $mode = 'auto')
=======
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	 * @param	string	$rempath
	 * @param	string	$locpath
	 * @param	string	$mode
	 * @return	bool
	 */
	public function download($rempath, $locpath, $mode = 'auto')
<<<<<<< HEAD
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	{
		if ( ! $this->_is_conn())
		{
			return FALSE;
		}

		// Set the mode if not specified
<<<<<<< HEAD
<<<<<<< HEAD
		if ($mode == 'auto')
=======
		if ($mode === 'auto')
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
		if ($mode === 'auto')
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
		{
			// Get the file extension so we can set the upload type
			$ext = $this->_getext($rempath);
			$mode = $this->_settype($ext);
		}

<<<<<<< HEAD
<<<<<<< HEAD
		$mode = ($mode == 'ascii') ? FTP_ASCII : FTP_BINARY;
=======
		$mode = ($mode === 'ascii') ? FTP_ASCII : FTP_BINARY;
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
		$mode = ($mode === 'ascii') ? FTP_ASCII : FTP_BINARY;
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3

		$result = @ftp_get($this->conn_id, $locpath, $rempath, $mode);

		if ($result === FALSE)
		{
<<<<<<< HEAD
<<<<<<< HEAD
			if ($this->debug == TRUE)
			{
				$this->_error('ftp_unable_to_download');
			}
=======
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
			if ($this->debug === TRUE)
			{
				$this->_error('ftp_unable_to_download');
			}

<<<<<<< HEAD
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
			return FALSE;
		}

		return TRUE;
	}

	// --------------------------------------------------------------------

	/**
	 * Rename (or move) a file
	 *
<<<<<<< HEAD
<<<<<<< HEAD
	 * @access	public
	 * @param	string
	 * @param	string
	 * @param	bool
	 * @return	bool
	 */
	function rename($old_file, $new_file, $move = FALSE)
=======
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	 * @param	string	$old_file
	 * @param	string	$new_file
	 * @param	bool	$move
	 * @return	bool
	 */
	public function rename($old_file, $new_file, $move = FALSE)
<<<<<<< HEAD
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	{
		if ( ! $this->_is_conn())
		{
			return FALSE;
		}

		$result = @ftp_rename($this->conn_id, $old_file, $new_file);

		if ($result === FALSE)
		{
<<<<<<< HEAD
<<<<<<< HEAD
			if ($this->debug == TRUE)
			{
				$msg = ($move == FALSE) ? 'ftp_unable_to_rename' : 'ftp_unable_to_move';

				$this->_error($msg);
			}
=======
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
			if ($this->debug === TRUE)
			{
				$this->_error('ftp_unable_to_'.($move === FALSE ? 'rename' : 'move'));
			}

<<<<<<< HEAD
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
			return FALSE;
		}

		return TRUE;
	}

	// --------------------------------------------------------------------

	/**
	 * Move a file
	 *
<<<<<<< HEAD
<<<<<<< HEAD
	 * @access	public
	 * @param	string
	 * @param	string
	 * @return	bool
	 */
	function move($old_file, $new_file)
=======
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	 * @param	string	$old_file
	 * @param	string	$new_file
	 * @return	bool
	 */
	public function move($old_file, $new_file)
<<<<<<< HEAD
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	{
		return $this->rename($old_file, $new_file, TRUE);
	}

	// --------------------------------------------------------------------

	/**
	 * Rename (or move) a file
	 *
<<<<<<< HEAD
<<<<<<< HEAD
	 * @access	public
	 * @param	string
	 * @return	bool
	 */
	function delete_file($filepath)
=======
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	 * @param	string	$filepath
	 * @return	bool
	 */
	public function delete_file($filepath)
<<<<<<< HEAD
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	{
		if ( ! $this->_is_conn())
		{
			return FALSE;
		}

		$result = @ftp_delete($this->conn_id, $filepath);

		if ($result === FALSE)
		{
<<<<<<< HEAD
<<<<<<< HEAD
			if ($this->debug == TRUE)
			{
				$this->_error('ftp_unable_to_delete');
			}
=======
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
			if ($this->debug === TRUE)
			{
				$this->_error('ftp_unable_to_delete');
			}

<<<<<<< HEAD
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
			return FALSE;
		}

		return TRUE;
	}

	// --------------------------------------------------------------------

	/**
	 * Delete a folder and recursively delete everything (including sub-folders)
<<<<<<< HEAD
<<<<<<< HEAD
	 * containted within it.
	 *
	 * @access	public
	 * @param	string
	 * @return	bool
	 */
	function delete_dir($filepath)
=======
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	 * contained within it.
	 *
	 * @param	string	$filepath
	 * @return	bool
	 */
	public function delete_dir($filepath)
<<<<<<< HEAD
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	{
		if ( ! $this->_is_conn())
		{
			return FALSE;
		}

		// Add a trailing slash to the file path if needed
<<<<<<< HEAD
<<<<<<< HEAD
		$filepath = preg_replace("/(.+?)\/*$/", "\\1/",  $filepath);

		$list = $this->list_files($filepath);

		if ($list !== FALSE AND count($list) > 0)
		{
			foreach ($list as $item)
			{
				// If we can't delete the item it's probaly a folder so
				// we'll recursively call delete_dir()
				if ( ! @ftp_delete($this->conn_id, $item))
				{
					$this->delete_dir($item);
=======
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
		$filepath = preg_replace('/(.+?)\/*$/', '\\1/', $filepath);

		$list = $this->list_files($filepath);
		if ( ! empty($list))
		{
			for ($i = 0, $c = count($list); $i < $c; $i++)
			{
				// If we can't delete the item it's probaly a directory,
				// so we'll recursively call delete_dir()
				if ( ! preg_match('#/\.\.?$#', $list[$i]) && ! @ftp_delete($this->conn_id, $list[$i]))
				{
					$this->delete_dir($filepath.$list[$i]);
<<<<<<< HEAD
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
				}
			}
		}

<<<<<<< HEAD
<<<<<<< HEAD
		$result = @ftp_rmdir($this->conn_id, $filepath);

		if ($result === FALSE)
		{
			if ($this->debug == TRUE)
			{
				$this->_error('ftp_unable_to_delete');
			}
=======
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
		if (@ftp_rmdir($this->conn_id, $filepath) === FALSE)
		{
			if ($this->debug === TRUE)
			{
				$this->_error('ftp_unable_to_delete');
			}

<<<<<<< HEAD
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
			return FALSE;
		}

		return TRUE;
	}

	// --------------------------------------------------------------------

	/**
	 * Set file permissions
	 *
<<<<<<< HEAD
<<<<<<< HEAD
	 * @access	public
	 * @param	string	the file path
	 * @param	string	the permissions
	 * @return	bool
	 */
	function chmod($path, $perm)
=======
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	 * @param	string	$path	File path
	 * @param	int	$perm	Permissions
	 * @return	bool
	 */
	public function chmod($path, $perm)
<<<<<<< HEAD
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	{
		if ( ! $this->_is_conn())
		{
			return FALSE;
		}

<<<<<<< HEAD
<<<<<<< HEAD
		if ( ! function_exists('ftp_chmod'))
		{
			if ($this->debug == TRUE)
			{
				$this->_error('ftp_unable_to_chmod');
			}
			return FALSE;
		}

		$result = @ftp_chmod($this->conn_id, $perm, $path);

		if ($result === FALSE)
		{
			if ($this->debug == TRUE)
			{
				$this->_error('ftp_unable_to_chmod');
			}
=======
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
		if (@ftp_chmod($this->conn_id, $perm, $path) === FALSE)
		{
			if ($this->debug === TRUE)
			{
				$this->_error('ftp_unable_to_chmod');
			}

<<<<<<< HEAD
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
			return FALSE;
		}

		return TRUE;
	}

	// --------------------------------------------------------------------

	/**
	 * FTP List files in the specified directory
	 *
<<<<<<< HEAD
<<<<<<< HEAD
	 * @access	public
	 * @return	array
	 */
	function list_files($path = '.')
	{
		if ( ! $this->_is_conn())
		{
			return FALSE;
		}

		return ftp_nlist($this->conn_id, $path);
=======
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	 * @param	string	$path
	 * @return	array
	 */
	public function list_files($path = '.')
	{
		return $this->_is_conn()
			? ftp_nlist($this->conn_id, $path)
			: FALSE;
<<<<<<< HEAD
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	}

	// ------------------------------------------------------------------------

	/**
	 * Read a directory and recreate it remotely
	 *
<<<<<<< HEAD
<<<<<<< HEAD
	 * This function recursively reads a folder and everything it contains (including
	 * sub-folders) and creates a mirror via FTP based on it.  Whatever the directory structure
	 * of the original file path will be recreated on the server.
	 *
	 * @access	public
	 * @param	string	path to source with trailing slash
	 * @param	string	path to destination - include the base folder with trailing slash
	 * @return	bool
	 */
	function mirror($locpath, $rempath)
=======
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	 * This function recursively reads a folder and everything it contains
	 * (including sub-folders) and creates a mirror via FTP based on it.
	 * Whatever the directory structure of the original file path will be
	 * recreated on the server.
	 *
	 * @param	string	$locpath	Path to source with trailing slash
	 * @param	string	$rempath	Path to destination - include the base folder with trailing slash
	 * @return	bool
	 */
	public function mirror($locpath, $rempath)
<<<<<<< HEAD
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	{
		if ( ! $this->_is_conn())
		{
			return FALSE;
		}

		// Open the local file path
		if ($fp = @opendir($locpath))
		{
<<<<<<< HEAD
<<<<<<< HEAD
			// Attempt to open the remote file path.
			if ( ! $this->changedir($rempath, TRUE))
			{
				// If it doesn't exist we'll attempt to create the direcotory
				if ( ! $this->mkdir($rempath) OR ! $this->changedir($rempath))
				{
					return FALSE;
				}
=======
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
			// Attempt to open the remote file path and try to create it, if it doesn't exist
			if ( ! $this->changedir($rempath, TRUE) && ( ! $this->mkdir($rempath) OR ! $this->changedir($rempath)))
			{
				return FALSE;
<<<<<<< HEAD
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
			}

			// Recursively read the local directory
			while (FALSE !== ($file = readdir($fp)))
			{
<<<<<<< HEAD
<<<<<<< HEAD
				if (@is_dir($locpath.$file) && substr($file, 0, 1) != '.')
				{
					$this->mirror($locpath.$file."/", $rempath.$file."/");
				}
				elseif (substr($file, 0, 1) != ".")
=======
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
				if (is_dir($locpath.$file) && $file[0] !== '.')
				{
					$this->mirror($locpath.$file.'/', $rempath.$file.'/');
				}
				elseif ($file[0] !== '.')
<<<<<<< HEAD
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
				{
					// Get the file extension so we can se the upload type
					$ext = $this->_getext($file);
					$mode = $this->_settype($ext);

					$this->upload($locpath.$file, $rempath.$file, $mode);
				}
			}
<<<<<<< HEAD
<<<<<<< HEAD
=======

>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======

>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
			return TRUE;
		}

		return FALSE;
	}

<<<<<<< HEAD
<<<<<<< HEAD

=======
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	// --------------------------------------------------------------------

	/**
	 * Extract the file extension
	 *
<<<<<<< HEAD
<<<<<<< HEAD
	 * @access	private
	 * @param	string
	 * @return	string
	 */
	function _getext($filename)
	{
		if (FALSE === strpos($filename, '.'))
		{
			return 'txt';
		}

		$x = explode('.', $filename);
		return end($x);
	}


=======
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	 * @param	string	$filename
	 * @return	string
	 */
	protected function _getext($filename)
	{
		return (($dot = strrpos($filename, '.')) === FALSE)
			? 'txt'
			: substr($filename, $dot + 1);
	}

<<<<<<< HEAD
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	// --------------------------------------------------------------------

	/**
	 * Set the upload type
	 *
<<<<<<< HEAD
<<<<<<< HEAD
	 * @access	private
	 * @param	string
	 * @return	string
	 */
	function _settype($ext)
	{
		$text_types = array(
							'txt',
							'text',
							'php',
							'phps',
							'php4',
							'js',
							'css',
							'htm',
							'html',
							'phtml',
							'shtml',
							'log',
							'xml'
							);


		return (in_array($ext, $text_types)) ? 'ascii' : 'binary';
=======
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	 * @param	string	$ext	Filename extension
	 * @return	string
	 */
	protected function _settype($ext)
	{
		return in_array($ext, array('txt', 'text', 'php', 'phps', 'php4', 'js', 'css', 'htm', 'html', 'phtml', 'shtml', 'log', 'xml'), TRUE)
			? 'ascii'
			: 'binary';
<<<<<<< HEAD
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	}

	// ------------------------------------------------------------------------

	/**
	 * Close the connection
	 *
<<<<<<< HEAD
<<<<<<< HEAD
	 * @access	public
	 * @param	string	path to source
	 * @param	string	path to destination
	 * @return	bool
	 */
	function close()
	{
		if ( ! $this->_is_conn())
		{
			return FALSE;
		}

		@ftp_close($this->conn_id);
=======
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	 * @return	bool
	 */
	public function close()
	{
		return $this->_is_conn()
			? @ftp_close($this->conn_id)
			: FALSE;
<<<<<<< HEAD
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	}

	// ------------------------------------------------------------------------

	/**
	 * Display error message
	 *
<<<<<<< HEAD
<<<<<<< HEAD
	 * @access	private
	 * @param	string
	 * @return	bool
	 */
	function _error($line)
=======
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	 * @param	string	$line
	 * @return	void
	 */
	protected function _error($line)
<<<<<<< HEAD
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	{
		$CI =& get_instance();
		$CI->lang->load('ftp');
		show_error($CI->lang->line($line));
	}

<<<<<<< HEAD
<<<<<<< HEAD

}
// END FTP Class

/* End of file Ftp.php */
/* Location: ./system/libraries/Ftp.php */
=======
}
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
}
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
