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
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd

/**
 * File Uploading Class
 *
 * @package		CodeIgniter
 * @subpackage	Libraries
 * @category	Uploads
 * @author		EllisLab Dev Team
<<<<<<< HEAD
 * @link		http://codeigniter.com/user_guide/libraries/file_uploading.html
 */
class CI_Upload {

	public $max_size				= 0;
	public $max_width				= 0;
	public $max_height				= 0;
	public $max_filename			= 0;
	public $allowed_types			= "";
	public $file_temp				= "";
	public $file_name				= "";
	public $orig_name				= "";
	public $file_type				= "";
	public $file_size				= "";
	public $file_ext				= "";
	public $upload_path				= "";
	public $overwrite				= FALSE;
	public $encrypt_name			= FALSE;
	public $is_image				= FALSE;
	public $image_width				= '';
	public $image_height			= '';
	public $image_type				= '';
	public $image_size_str			= '';
	public $error_msg				= array();
	public $mimes					= array();
	public $remove_spaces			= TRUE;
	public $xss_clean				= FALSE;
	public $temp_prefix				= "temp_file_";
	public $client_name				= '';

	protected $_file_name_override	= '';
=======
 * @link		https://codeigniter.com/user_guide/libraries/file_uploading.html
 */
class CI_Upload {

	/**
	 * Maximum file size
	 *
	 * @var	int
	 */
	public $max_size = 0;

	/**
	 * Maximum image width
	 *
	 * @var	int
	 */
	public $max_width = 0;

	/**
	 * Maximum image height
	 *
	 * @var	int
	 */
	public $max_height = 0;

	/**
	 * Minimum image width
	 *
	 * @var	int
	 */
	public $min_width = 0;

	/**
	 * Minimum image height
	 *
	 * @var	int
	 */
	public $min_height = 0;

	/**
	 * Maximum filename length
	 *
	 * @var	int
	 */
	public $max_filename = 0;

	/**
	 * Maximum duplicate filename increment ID
	 *
	 * @var	int
	 */
	public $max_filename_increment = 100;

	/**
	 * Allowed file types
	 *
	 * @var	string
	 */
	public $allowed_types = '';

	/**
	 * Temporary filename
	 *
	 * @var	string
	 */
	public $file_temp = '';

	/**
	 * Filename
	 *
	 * @var	string
	 */
	public $file_name = '';

	/**
	 * Original filename
	 *
	 * @var	string
	 */
	public $orig_name = '';

	/**
	 * File type
	 *
	 * @var	string
	 */
	public $file_type = '';

	/**
	 * File size
	 *
	 * @var	int
	 */
	public $file_size = NULL;

	/**
	 * Filename extension
	 *
	 * @var	string
	 */
	public $file_ext = '';

	/**
	 * Force filename extension to lowercase
	 *
	 * @var	string
	 */
	public $file_ext_tolower = FALSE;

	/**
	 * Upload path
	 *
	 * @var	string
	 */
	public $upload_path = '';

	/**
	 * Overwrite flag
	 *
	 * @var	bool
	 */
	public $overwrite = FALSE;

	/**
	 * Obfuscate filename flag
	 *
	 * @var	bool
	 */
	public $encrypt_name = FALSE;

	/**
	 * Is image flag
	 *
	 * @var	bool
	 */
	public $is_image = FALSE;

	/**
	 * Image width
	 *
	 * @var	int
	 */
	public $image_width = NULL;

	/**
	 * Image height
	 *
	 * @var	int
	 */
	public $image_height = NULL;

	/**
	 * Image type
	 *
	 * @var	string
	 */
	public $image_type = '';

	/**
	 * Image size string
	 *
	 * @var	string
	 */
	public $image_size_str = '';

	/**
	 * Error messages list
	 *
	 * @var	array
	 */
	public $error_msg = array();

	/**
	 * Remove spaces flag
	 *
	 * @var	bool
	 */
	public $remove_spaces = TRUE;

	/**
	 * MIME detection flag
	 *
	 * @var	bool
	 */
	public $detect_mime = TRUE;

	/**
	 * XSS filter flag
	 *
	 * @var	bool
	 */
	public $xss_clean = FALSE;

	/**
	 * Apache mod_mime fix flag
	 *
	 * @var	bool
	 */
	public $mod_mime_fix = TRUE;

	/**
	 * Temporary filename prefix
	 *
	 * @var	string
	 */
	public $temp_prefix = 'temp_file_';

	/**
	 * Filename sent by the client
	 *
	 * @var	bool
	 */
	public $client_name = '';

	// --------------------------------------------------------------------

	/**
	 * Filename override
	 *
	 * @var	string
	 */
	protected $_file_name_override = '';

	/**
	 * MIME types list
	 *
	 * @var	array
	 */
	protected $_mimes = array();

	/**
	 * CI Singleton
	 *
	 * @var	object
	 */
	protected $_CI;

	// --------------------------------------------------------------------
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd

	/**
	 * Constructor
	 *
<<<<<<< HEAD
	 * @access	public
	 */
	public function __construct($props = array())
	{
		if (count($props) > 0)
		{
			$this->initialize($props);
		}

		log_message('debug', "Upload Class Initialized");
=======
	 * @param	array	$config
	 * @return	void
	 */
	public function __construct($config = array())
	{
		empty($config) OR $this->initialize($config, FALSE);

		$this->_mimes =& get_mimes();
		$this->_CI =& get_instance();

		log_message('info', 'Upload Class Initialized');
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
	}

	// --------------------------------------------------------------------

	/**
	 * Initialize preferences
	 *
<<<<<<< HEAD
	 * @param	array
	 * @return	void
	 */
	public function initialize($config = array())
	{
		$defaults = array(
							'max_size'			=> 0,
							'max_width'			=> 0,
							'max_height'		=> 0,
							'max_filename'		=> 0,
							'allowed_types'		=> "",
							'file_temp'			=> "",
							'file_name'			=> "",
							'orig_name'			=> "",
							'file_type'			=> "",
							'file_size'			=> "",
							'file_ext'			=> "",
							'upload_path'		=> "",
							'overwrite'			=> FALSE,
							'encrypt_name'		=> FALSE,
							'is_image'			=> FALSE,
							'image_width'		=> '',
							'image_height'		=> '',
							'image_type'		=> '',
							'image_size_str'	=> '',
							'error_msg'			=> array(),
							'mimes'				=> array(),
							'remove_spaces'		=> TRUE,
							'xss_clean'			=> FALSE,
							'temp_prefix'		=> "temp_file_",
							'client_name'		=> ''
						);


		foreach ($defaults as $key => $val)
		{
			if (isset($config[$key]))
			{
				$method = 'set_'.$key;
				if (method_exists($this, $method))
				{
					$this->$method($config[$key]);
				}
				else
				{
					$this->$key = $config[$key];
				}
			}
			else
			{
				$this->$key = $val;
=======
	 * @param	array	$config
	 * @param	bool	$reset
	 * @return	CI_Upload
	 */
	public function initialize(array $config = array(), $reset = TRUE)
	{
		$reflection = new ReflectionClass($this);

		if ($reset === TRUE)
		{
			$defaults = $reflection->getDefaultProperties();
			foreach (array_keys($defaults) as $key)
			{
				if ($key[0] === '_')
				{
					continue;
				}

				if (isset($config[$key]))
				{
					if ($reflection->hasMethod('set_'.$key))
					{
						$this->{'set_'.$key}($config[$key]);
					}
					else
					{
						$this->$key = $config[$key];
					}
				}
				else
				{
					$this->$key = $defaults[$key];
				}
			}
		}
		else
		{
			foreach ($config as $key => &$value)
			{
				if ($key[0] !== '_' && $reflection->hasProperty($key))
				{
					if ($reflection->hasMethod('set_'.$key))
					{
						$this->{'set_'.$key}($value);
					}
					else
					{
						$this->$key = $value;
					}
				}
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
			}
		}

		// if a file_name was provided in the config, use it instead of the user input
		// supplied file name for all uploads until initialized again
		$this->_file_name_override = $this->file_name;
<<<<<<< HEAD
=======
		return $this;
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
	}

	// --------------------------------------------------------------------

	/**
	 * Perform the file upload
	 *
<<<<<<< HEAD
=======
	 * @param	string	$field
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
	 * @return	bool
	 */
	public function do_upload($field = 'userfile')
	{
<<<<<<< HEAD

	// Is $_FILES[$field] set? If not, no reason to continue.
		if ( ! isset($_FILES[$field]))
		{
			$this->set_error('upload_no_file_selected');
=======
		// Is $_FILES[$field] set? If not, no reason to continue.
		if (isset($_FILES[$field]))
		{
			$_file = $_FILES[$field];
		}
		// Does the field name contain array notation?
		elseif (($c = preg_match_all('/(?:^[^\[]+)|\[[^]]*\]/', $field, $matches)) > 1)
		{
			$_file = $_FILES;
			for ($i = 0; $i < $c; $i++)
			{
				// We can't track numeric iterations, only full field names are accepted
				if (($field = trim($matches[0][$i], '[]')) === '' OR ! isset($_file[$field]))
				{
					$_file = NULL;
					break;
				}

				$_file = $_file[$field];
			}
		}

		if ( ! isset($_file))
		{
			$this->set_error('upload_no_file_selected', 'debug');
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
			return FALSE;
		}

		// Is the upload path valid?
		if ( ! $this->validate_upload_path())
		{
			// errors will already be set by validate_upload_path() so just return FALSE
			return FALSE;
		}

		// Was the file able to be uploaded? If not, determine the reason why.
<<<<<<< HEAD
		if ( ! is_uploaded_file($_FILES[$field]['tmp_name']))
		{
			$error = ( ! isset($_FILES[$field]['error'])) ? 4 : $_FILES[$field]['error'];

			switch($error)
			{
				case 1:	// UPLOAD_ERR_INI_SIZE
					$this->set_error('upload_file_exceeds_limit');
					break;
				case 2: // UPLOAD_ERR_FORM_SIZE
					$this->set_error('upload_file_exceeds_form_limit');
					break;
				case 3: // UPLOAD_ERR_PARTIAL
					$this->set_error('upload_file_partial');
					break;
				case 4: // UPLOAD_ERR_NO_FILE
					$this->set_error('upload_no_file_selected');
					break;
				case 6: // UPLOAD_ERR_NO_TMP_DIR
					$this->set_error('upload_no_temp_directory');
					break;
				case 7: // UPLOAD_ERR_CANT_WRITE
					$this->set_error('upload_unable_to_write_file');
					break;
				case 8: // UPLOAD_ERR_EXTENSION
					$this->set_error('upload_stopped_by_extension');
					break;
				default :   $this->set_error('upload_no_file_selected');
=======
		if ( ! is_uploaded_file($_file['tmp_name']))
		{
			$error = isset($_file['error']) ? $_file['error'] : 4;

			switch ($error)
			{
				case UPLOAD_ERR_INI_SIZE:
					$this->set_error('upload_file_exceeds_limit', 'info');
					break;
				case UPLOAD_ERR_FORM_SIZE:
					$this->set_error('upload_file_exceeds_form_limit', 'info');
					break;
				case UPLOAD_ERR_PARTIAL:
					$this->set_error('upload_file_partial', 'debug');
					break;
				case UPLOAD_ERR_NO_FILE:
					$this->set_error('upload_no_file_selected', 'debug');
					break;
				case UPLOAD_ERR_NO_TMP_DIR:
					$this->set_error('upload_no_temp_directory', 'error');
					break;
				case UPLOAD_ERR_CANT_WRITE:
					$this->set_error('upload_unable_to_write_file', 'error');
					break;
				case UPLOAD_ERR_EXTENSION:
					$this->set_error('upload_stopped_by_extension', 'debug');
					break;
				default:
					$this->set_error('upload_no_file_selected', 'debug');
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
					break;
			}

			return FALSE;
		}

<<<<<<< HEAD

		// Set the uploaded data as class variables
		$this->file_temp = $_FILES[$field]['tmp_name'];
		$this->file_size = $_FILES[$field]['size'];
		$this->_file_mime_type($_FILES[$field]);
		$this->file_type = preg_replace("/^(.+?);.*$/", "\\1", $this->file_type);
		$this->file_type = strtolower(trim(stripslashes($this->file_type), '"'));
		$this->file_name = $this->_prep_filename($_FILES[$field]['name']);
=======
		// Set the uploaded data as class variables
		$this->file_temp = $_file['tmp_name'];
		$this->file_size = $_file['size'];

		// Skip MIME type detection?
		if ($this->detect_mime !== FALSE)
		{
			$this->_file_mime_type($_file);
		}

		$this->file_type = preg_replace('/^(.+?);.*$/', '\\1', $this->file_type);
		$this->file_type = strtolower(trim(stripslashes($this->file_type), '"'));
		$this->file_name = $this->_prep_filename($_file['name']);
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
		$this->file_ext	 = $this->get_extension($this->file_name);
		$this->client_name = $this->file_name;

		// Is the file type allowed to be uploaded?
		if ( ! $this->is_allowed_filetype())
		{
<<<<<<< HEAD
			$this->set_error('upload_invalid_filetype');
=======
			$this->set_error('upload_invalid_filetype', 'debug');
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
			return FALSE;
		}

		// if we're overriding, let's now make sure the new name and type is allowed
<<<<<<< HEAD
		if ($this->_file_name_override != '')
=======
		if ($this->_file_name_override !== '')
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
		{
			$this->file_name = $this->_prep_filename($this->_file_name_override);

			// If no extension was provided in the file_name config item, use the uploaded one
			if (strpos($this->_file_name_override, '.') === FALSE)
			{
				$this->file_name .= $this->file_ext;
			}
<<<<<<< HEAD

			// An extension was provided, lets have it!
			else
			{
				$this->file_ext	 = $this->get_extension($this->_file_name_override);
=======
			else
			{
				// An extension was provided, let's have it!
				$this->file_ext	= $this->get_extension($this->_file_name_override);
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
			}

			if ( ! $this->is_allowed_filetype(TRUE))
			{
<<<<<<< HEAD
				$this->set_error('upload_invalid_filetype');
=======
				$this->set_error('upload_invalid_filetype', 'debug');
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
				return FALSE;
			}
		}

		// Convert the file size to kilobytes
		if ($this->file_size > 0)
		{
			$this->file_size = round($this->file_size/1024, 2);
		}

		// Is the file size within the allowed maximum?
		if ( ! $this->is_allowed_filesize())
		{
<<<<<<< HEAD
			$this->set_error('upload_invalid_filesize');
=======
			$this->set_error('upload_invalid_filesize', 'info');
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
			return FALSE;
		}

		// Are the image dimensions within the allowed size?
<<<<<<< HEAD
		// Note: This can fail if the server has an open_basdir restriction.
		if ( ! $this->is_allowed_dimensions())
		{
			$this->set_error('upload_invalid_dimensions');
=======
		// Note: This can fail if the server has an open_basedir restriction.
		if ( ! $this->is_allowed_dimensions())
		{
			$this->set_error('upload_invalid_dimensions', 'info');
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
			return FALSE;
		}

		// Sanitize the file name for security
<<<<<<< HEAD
		$CI =& get_instance();
		$this->file_name = $CI->security->sanitize_filename($this->file_name);
=======
		$this->file_name = $this->_CI->security->sanitize_filename($this->file_name);
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd

		// Truncate the file name if it's too long
		if ($this->max_filename > 0)
		{
			$this->file_name = $this->limit_filename_length($this->file_name, $this->max_filename);
		}

		// Remove white spaces in the name
<<<<<<< HEAD
		if ($this->remove_spaces == TRUE)
		{
			$this->file_name = preg_replace("/\s+/", "_", $this->file_name);
=======
		if ($this->remove_spaces === TRUE)
		{
			$this->file_name = preg_replace('/\s+/', '_', $this->file_name);
		}

		if ($this->file_ext_tolower && ($ext_length = strlen($this->file_ext)))
		{
			// file_ext was previously lower-cased by a get_extension() call
			$this->file_name = substr($this->file_name, 0, -$ext_length).$this->file_ext;
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
		}

		/*
		 * Validate the file name
		 * This function appends an number onto the end of
		 * the file if one with the same name already exists.
		 * If it returns false there was a problem.
		 */
		$this->orig_name = $this->file_name;
<<<<<<< HEAD

		if ($this->overwrite == FALSE)
		{
			$this->file_name = $this->set_filename($this->upload_path, $this->file_name);

			if ($this->file_name === FALSE)
			{
				return FALSE;
			}
=======
		if (FALSE === ($this->file_name = $this->set_filename($this->upload_path, $this->file_name)))
		{
			return FALSE;
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
		}

		/*
		 * Run the file through the XSS hacking filter
		 * This helps prevent malicious code from being
<<<<<<< HEAD
		 * embedded within a file.  Scripts can easily
		 * be disguised as images or other file types.
		 */
		if ($this->xss_clean)
		{
			if ($this->do_xss_clean() === FALSE)
			{
				$this->set_error('upload_unable_to_write_file');
				return FALSE;
			}
=======
		 * embedded within a file. Scripts can easily
		 * be disguised as images or other file types.
		 */
		if ($this->xss_clean && $this->do_xss_clean() === FALSE)
		{
			$this->set_error('upload_unable_to_write_file', 'error');
			return FALSE;
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
		}

		/*
		 * Move the file to the final destination
		 * To deal with different server configurations
<<<<<<< HEAD
		 * we'll attempt to use copy() first.  If that fails
		 * we'll use move_uploaded_file().  One of the two should
=======
		 * we'll attempt to use copy() first. If that fails
		 * we'll use move_uploaded_file(). One of the two should
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
		 * reliably work in most environments
		 */
		if ( ! @copy($this->file_temp, $this->upload_path.$this->file_name))
		{
			if ( ! @move_uploaded_file($this->file_temp, $this->upload_path.$this->file_name))
			{
<<<<<<< HEAD
				$this->set_error('upload_destination_error');
=======
				$this->set_error('upload_destination_error', 'error');
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
				return FALSE;
			}
		}

		/*
		 * Set the finalized image dimensions
		 * This sets the image width/height (assuming the
<<<<<<< HEAD
		 * file was an image).  We use this information
=======
		 * file was an image). We use this information
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
		 * in the "data" function.
		 */
		$this->set_image_properties($this->upload_path.$this->file_name);

		return TRUE;
	}

	// --------------------------------------------------------------------

	/**
	 * Finalized Data Array
	 *
	 * Returns an associative array containing all of the information
	 * related to the upload, allowing the developer easy access in one array.
	 *
<<<<<<< HEAD
	 * @return	array
	 */
	public function data()
	{
		return array (
						'file_name'			=> $this->file_name,
						'file_type'			=> $this->file_type,
						'file_path'			=> $this->upload_path,
						'full_path'			=> $this->upload_path.$this->file_name,
						'raw_name'			=> str_replace($this->file_ext, '', $this->file_name),
						'orig_name'			=> $this->orig_name,
						'client_name'		=> $this->client_name,
						'file_ext'			=> $this->file_ext,
						'file_size'			=> $this->file_size,
						'is_image'			=> $this->is_image(),
						'image_width'		=> $this->image_width,
						'image_height'		=> $this->image_height,
						'image_type'		=> $this->image_type,
						'image_size_str'	=> $this->image_size_str,
					);
=======
	 * @param	string	$index
	 * @return	mixed
	 */
	public function data($index = NULL)
	{
		$data = array(
				'file_name'		=> $this->file_name,
				'file_type'		=> $this->file_type,
				'file_path'		=> $this->upload_path,
				'full_path'		=> $this->upload_path.$this->file_name,
				'raw_name'		=> substr($this->file_name, 0, -strlen($this->file_ext)),
				'orig_name'		=> $this->orig_name,
				'client_name'		=> $this->client_name,
				'file_ext'		=> $this->file_ext,
				'file_size'		=> $this->file_size,
				'is_image'		=> $this->is_image(),
				'image_width'		=> $this->image_width,
				'image_height'		=> $this->image_height,
				'image_type'		=> $this->image_type,
				'image_size_str'	=> $this->image_size_str,
			);

		if ( ! empty($index))
		{
			return isset($data[$index]) ? $data[$index] : NULL;
		}

		return $data;
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
	}

	// --------------------------------------------------------------------

	/**
	 * Set Upload Path
	 *
<<<<<<< HEAD
	 * @param	string
	 * @return	void
=======
	 * @param	string	$path
	 * @return	CI_Upload
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
	 */
	public function set_upload_path($path)
	{
		// Make sure it has a trailing slash
		$this->upload_path = rtrim($path, '/').'/';
<<<<<<< HEAD
=======
		return $this;
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
	}

	// --------------------------------------------------------------------

	/**
	 * Set the file name
	 *
	 * This function takes a filename/path as input and looks for the
	 * existence of a file with the same name. If found, it will append a
	 * number to the end of the filename to avoid overwriting a pre-existing file.
	 *
<<<<<<< HEAD
	 * @param	string
	 * @param	string
=======
	 * @param	string	$path
	 * @param	string	$filename
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
	 * @return	string
	 */
	public function set_filename($path, $filename)
	{
<<<<<<< HEAD
		if ($this->encrypt_name == TRUE)
		{
			mt_srand();
			$filename = md5(uniqid(mt_rand())).$this->file_ext;
		}

		if ( ! file_exists($path.$filename))
=======
		if ($this->encrypt_name === TRUE)
		{
			$filename = md5(uniqid(mt_rand())).$this->file_ext;
		}

		if ($this->overwrite === TRUE OR ! file_exists($path.$filename))
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
		{
			return $filename;
		}

		$filename = str_replace($this->file_ext, '', $filename);

		$new_filename = '';
<<<<<<< HEAD
		for ($i = 1; $i < 100; $i++)
=======
		for ($i = 1; $i < $this->max_filename_increment; $i++)
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
		{
			if ( ! file_exists($path.$filename.$i.$this->file_ext))
			{
				$new_filename = $filename.$i.$this->file_ext;
				break;
			}
		}

<<<<<<< HEAD
		if ($new_filename == '')
		{
			$this->set_error('upload_bad_filename');
=======
		if ($new_filename === '')
		{
			$this->set_error('upload_bad_filename', 'debug');
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
			return FALSE;
		}
		else
		{
			return $new_filename;
		}
	}

	// --------------------------------------------------------------------

	/**
	 * Set Maximum File Size
	 *
<<<<<<< HEAD
	 * @param	integer
	 * @return	void
	 */
	public function set_max_filesize($n)
	{
		$this->max_size = ((int) $n < 0) ? 0: (int) $n;
=======
	 * @param	int	$n
	 * @return	CI_Upload
	 */
	public function set_max_filesize($n)
	{
		$this->max_size = ($n < 0) ? 0 : (int) $n;
		return $this;
	}

	// --------------------------------------------------------------------

	/**
	 * Set Maximum File Size
	 *
	 * An internal alias to set_max_filesize() to help with configuration
	 * as initialize() will look for a set_<property_name>() method ...
	 *
	 * @param	int	$n
	 * @return	CI_Upload
	 */
	protected function set_max_size($n)
	{
		return $this->set_max_filesize($n);
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
	}

	// --------------------------------------------------------------------

	/**
	 * Set Maximum File Name Length
	 *
<<<<<<< HEAD
	 * @param	integer
	 * @return	void
	 */
	public function set_max_filename($n)
	{
		$this->max_filename = ((int) $n < 0) ? 0: (int) $n;
=======
	 * @param	int	$n
	 * @return	CI_Upload
	 */
	public function set_max_filename($n)
	{
		$this->max_filename = ($n < 0) ? 0 : (int) $n;
		return $this;
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
	}

	// --------------------------------------------------------------------

	/**
	 * Set Maximum Image Width
	 *
<<<<<<< HEAD
	 * @param	integer
	 * @return	void
	 */
	public function set_max_width($n)
	{
		$this->max_width = ((int) $n < 0) ? 0: (int) $n;
=======
	 * @param	int	$n
	 * @return	CI_Upload
	 */
	public function set_max_width($n)
	{
		$this->max_width = ($n < 0) ? 0 : (int) $n;
		return $this;
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
	}

	// --------------------------------------------------------------------

	/**
	 * Set Maximum Image Height
	 *
<<<<<<< HEAD
	 * @param	integer
	 * @return	void
	 */
	public function set_max_height($n)
	{
		$this->max_height = ((int) $n < 0) ? 0: (int) $n;
=======
	 * @param	int	$n
	 * @return	CI_Upload
	 */
	public function set_max_height($n)
	{
		$this->max_height = ($n < 0) ? 0 : (int) $n;
		return $this;
	}

	// --------------------------------------------------------------------

	/**
	 * Set minimum image width
	 *
	 * @param	int	$n
	 * @return	CI_Upload
	 */
	public function set_min_width($n)
	{
		$this->min_width = ($n < 0) ? 0 : (int) $n;
		return $this;
	}

	// --------------------------------------------------------------------

	/**
	 * Set minimum image height
	 *
	 * @param	int	$n
	 * @return	CI_Upload
	 */
	public function set_min_height($n)
	{
		$this->min_height = ($n < 0) ? 0 : (int) $n;
		return $this;
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
	}

	// --------------------------------------------------------------------

	/**
	 * Set Allowed File Types
	 *
<<<<<<< HEAD
	 * @param	string
	 * @return	void
	 */
	public function set_allowed_types($types)
	{
		if ( ! is_array($types) && $types == '*')
		{
			$this->allowed_types = '*';
			return;
		}
		$this->allowed_types = explode('|', $types);
=======
	 * @param	mixed	$types
	 * @return	CI_Upload
	 */
	public function set_allowed_types($types)
	{
		$this->allowed_types = (is_array($types) OR $types === '*')
			? $types
			: explode('|', $types);
		return $this;
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
	}

	// --------------------------------------------------------------------

	/**
	 * Set Image Properties
	 *
	 * Uses GD to determine the width/height/type of image
	 *
<<<<<<< HEAD
	 * @param	string
	 * @return	void
	 */
	public function set_image_properties($path = '')
	{
		if ( ! $this->is_image())
		{
			return;
		}

		if (function_exists('getimagesize'))
=======
	 * @param	string	$path
	 * @return	CI_Upload
	 */
	public function set_image_properties($path = '')
	{
		if ($this->is_image() && function_exists('getimagesize'))
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
		{
			if (FALSE !== ($D = @getimagesize($path)))
			{
				$types = array(1 => 'gif', 2 => 'jpeg', 3 => 'png');

<<<<<<< HEAD
				$this->image_width		= $D['0'];
				$this->image_height		= $D['1'];
				$this->image_type		= ( ! isset($types[$D['2']])) ? 'unknown' : $types[$D['2']];
				$this->image_size_str	= $D['3'];  // string containing height and width
			}
		}
=======
				$this->image_width	= $D[0];
				$this->image_height	= $D[1];
				$this->image_type	= isset($types[$D[2]]) ? $types[$D[2]] : 'unknown';
				$this->image_size_str	= $D[3]; // string containing height and width
			}
		}

		return $this;
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
	}

	// --------------------------------------------------------------------

	/**
	 * Set XSS Clean
	 *
	 * Enables the XSS flag so that the file that was uploaded
	 * will be run through the XSS filter.
	 *
<<<<<<< HEAD
	 * @param	bool
	 * @return	void
	 */
	public function set_xss_clean($flag = FALSE)
	{
		$this->xss_clean = ($flag == TRUE) ? TRUE : FALSE;
=======
	 * @param	bool	$flag
	 * @return	CI_Upload
	 */
	public function set_xss_clean($flag = FALSE)
	{
		$this->xss_clean = ($flag === TRUE);
		return $this;
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
	}

	// --------------------------------------------------------------------

	/**
	 * Validate the image
	 *
	 * @return	bool
	 */
	public function is_image()
	{
		// IE will sometimes return odd mime-types during upload, so here we just standardize all
		// jpegs or pngs to the same file type.

		$png_mimes  = array('image/x-png');
		$jpeg_mimes = array('image/jpg', 'image/jpe', 'image/jpeg', 'image/pjpeg');

		if (in_array($this->file_type, $png_mimes))
		{
			$this->file_type = 'image/png';
		}
<<<<<<< HEAD

		if (in_array($this->file_type, $jpeg_mimes))
=======
		elseif (in_array($this->file_type, $jpeg_mimes))
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
		{
			$this->file_type = 'image/jpeg';
		}

<<<<<<< HEAD
		$img_mimes = array(
							'image/gif',
							'image/jpeg',
							'image/png',
						);

		return (in_array($this->file_type, $img_mimes, TRUE)) ? TRUE : FALSE;
=======
		$img_mimes = array('image/gif',	'image/jpeg', 'image/png');

		return in_array($this->file_type, $img_mimes, TRUE);
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
	}

	// --------------------------------------------------------------------

	/**
	 * Verify that the filetype is allowed
	 *
<<<<<<< HEAD
=======
	 * @param	bool	$ignore_mime
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
	 * @return	bool
	 */
	public function is_allowed_filetype($ignore_mime = FALSE)
	{
<<<<<<< HEAD
		if ($this->allowed_types == '*')
=======
		if ($this->allowed_types === '*')
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
		{
			return TRUE;
		}

<<<<<<< HEAD
		if (count($this->allowed_types) == 0 OR ! is_array($this->allowed_types))
		{
			$this->set_error('upload_no_file_types');
=======
		if (empty($this->allowed_types) OR ! is_array($this->allowed_types))
		{
			$this->set_error('upload_no_file_types', 'debug');
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
			return FALSE;
		}

		$ext = strtolower(ltrim($this->file_ext, '.'));

<<<<<<< HEAD
		if ( ! in_array($ext, $this->allowed_types))
=======
		if ( ! in_array($ext, $this->allowed_types, TRUE))
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
		{
			return FALSE;
		}

		// Images get some additional checks
<<<<<<< HEAD
		$image_types = array('gif', 'jpg', 'jpeg', 'png', 'jpe');

		if (in_array($ext, $image_types))
		{
			if (getimagesize($this->file_temp) === FALSE)
			{
				return FALSE;
			}
=======
		if (in_array($ext, array('gif', 'jpg', 'jpeg', 'jpe', 'png'), TRUE) && @getimagesize($this->file_temp) === FALSE)
		{
			return FALSE;
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
		}

		if ($ignore_mime === TRUE)
		{
			return TRUE;
		}

<<<<<<< HEAD
		$mime = $this->mimes_types($ext);

		if (is_array($mime))
		{
			if (in_array($this->file_type, $mime, TRUE))
			{
				return TRUE;
			}
		}
		elseif ($mime == $this->file_type)
		{
				return TRUE;
=======
		if (isset($this->_mimes[$ext]))
		{
			return is_array($this->_mimes[$ext])
				? in_array($this->file_type, $this->_mimes[$ext], TRUE)
				: ($this->_mimes[$ext] === $this->file_type);
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
		}

		return FALSE;
	}

	// --------------------------------------------------------------------

	/**
	 * Verify that the file is within the allowed size
	 *
	 * @return	bool
	 */
	public function is_allowed_filesize()
	{
<<<<<<< HEAD
		if ($this->max_size != 0  AND  $this->file_size > $this->max_size)
		{
			return FALSE;
		}
		else
		{
			return TRUE;
		}
=======
		return ($this->max_size === 0 OR $this->max_size > $this->file_size);
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
	}

	// --------------------------------------------------------------------

	/**
	 * Verify that the image is within the allowed width/height
	 *
	 * @return	bool
	 */
	public function is_allowed_dimensions()
	{
		if ( ! $this->is_image())
		{
			return TRUE;
		}

		if (function_exists('getimagesize'))
		{
			$D = @getimagesize($this->file_temp);

<<<<<<< HEAD
			if ($this->max_width > 0 AND $D['0'] > $this->max_width)
=======
			if ($this->max_width > 0 && $D[0] > $this->max_width)
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
			{
				return FALSE;
			}

<<<<<<< HEAD
			if ($this->max_height > 0 AND $D['1'] > $this->max_height)
=======
			if ($this->max_height > 0 && $D[1] > $this->max_height)
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
			{
				return FALSE;
			}

<<<<<<< HEAD
			return TRUE;
=======
			if ($this->min_width > 0 && $D[0] < $this->min_width)
			{
				return FALSE;
			}

			if ($this->min_height > 0 && $D[1] < $this->min_height)
			{
				return FALSE;
			}
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
		}

		return TRUE;
	}

	// --------------------------------------------------------------------

	/**
	 * Validate Upload Path
	 *
	 * Verifies that it is a valid upload path with proper permissions.
	 *
<<<<<<< HEAD
	 *
=======
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
	 * @return	bool
	 */
	public function validate_upload_path()
	{
<<<<<<< HEAD
		if ($this->upload_path == '')
		{
			$this->set_error('upload_no_filepath');
			return FALSE;
		}

		if (function_exists('realpath') AND @realpath($this->upload_path) !== FALSE)
		{
			$this->upload_path = str_replace("\\", "/", realpath($this->upload_path));
		}

		if ( ! @is_dir($this->upload_path))
		{
			$this->set_error('upload_no_filepath');
=======
		if ($this->upload_path === '')
		{
			$this->set_error('upload_no_filepath', 'error');
			return FALSE;
		}

		if (realpath($this->upload_path) !== FALSE)
		{
			$this->upload_path = str_replace('\\', '/', realpath($this->upload_path));
		}

		if ( ! is_dir($this->upload_path))
		{
			$this->set_error('upload_no_filepath', 'error');
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
			return FALSE;
		}

		if ( ! is_really_writable($this->upload_path))
		{
<<<<<<< HEAD
			$this->set_error('upload_not_writable');
			return FALSE;
		}

		$this->upload_path = preg_replace("/(.+?)\/*$/", "\\1/",  $this->upload_path);
=======
			$this->set_error('upload_not_writable', 'error');
			return FALSE;
		}

		$this->upload_path = preg_replace('/(.+?)\/*$/', '\\1/',  $this->upload_path);
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
		return TRUE;
	}

	// --------------------------------------------------------------------

	/**
	 * Extract the file extension
	 *
<<<<<<< HEAD
	 * @param	string
=======
	 * @param	string	$filename
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
	 * @return	string
	 */
	public function get_extension($filename)
	{
		$x = explode('.', $filename);
<<<<<<< HEAD
		return '.'.end($x);
	}

	// --------------------------------------------------------------------

	/**
	 * Clean the file name for security
	 *
	 * @deprecated	2.2.1	Alias for CI_Security::sanitize_filename()
	 * @param	string	$filename
	 * @return	string
	 */
	public function clean_file_name($filename)
	{
		$CI =& get_instance();
		return $CI->security->sanitize_filename($filename);
=======

		if (count($x) === 1)
		{
			return '';
		}

		$ext = ($this->file_ext_tolower) ? strtolower(end($x)) : end($x);
		return '.'.$ext;
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
	}

	// --------------------------------------------------------------------

	/**
	 * Limit the File Name Length
	 *
<<<<<<< HEAD
	 * @param	string
=======
	 * @param	string	$filename
	 * @param	int	$length
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
	 * @return	string
	 */
	public function limit_filename_length($filename, $length)
	{
		if (strlen($filename) < $length)
		{
			return $filename;
		}

		$ext = '';
		if (strpos($filename, '.') !== FALSE)
		{
			$parts		= explode('.', $filename);
			$ext		= '.'.array_pop($parts);
			$filename	= implode('.', $parts);
		}

		return substr($filename, 0, ($length - strlen($ext))).$ext;
	}

	// --------------------------------------------------------------------

	/**
	 * Runs the file through the XSS clean function
	 *
	 * This prevents people from embedding malicious code in their files.
	 * I'm not sure that it won't negatively affect certain files in unexpected ways,
	 * but so far I haven't found that it causes trouble.
	 *
<<<<<<< HEAD
	 * @return	void
=======
	 * @return	string
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
	 */
	public function do_xss_clean()
	{
		$file = $this->file_temp;

		if (filesize($file) == 0)
		{
			return FALSE;
		}

<<<<<<< HEAD
		if (function_exists('memory_get_usage') && memory_get_usage() && ini_get('memory_limit') != '')
		{
			$current = ini_get('memory_limit') * 1024 * 1024;

			// There was a bug/behavioural change in PHP 5.2, where numbers over one million get output
			// into scientific notation.  number_format() ensures this number is an integer
			// http://bugs.php.net/bug.php?id=43053

			$new_memory = number_format(ceil(filesize($file) + $current), 0, '.', '');

			ini_set('memory_limit', $new_memory); // When an integer is used, the value is measured in bytes. - PHP.net
=======
		if (memory_get_usage() && ($memory_limit = ini_get('memory_limit')))
		{
			$memory_limit *= 1024 * 1024;

			// There was a bug/behavioural change in PHP 5.2, where numbers over one million get output
			// into scientific notation. number_format() ensures this number is an integer
			// http://bugs.php.net/bug.php?id=43053

			$memory_limit = number_format(ceil(filesize($file) + $memory_limit), 0, '.', '');

			ini_set('memory_limit', $memory_limit); // When an integer is used, the value is measured in bytes. - PHP.net
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
		}

		// If the file being uploaded is an image, then we should have no problem with XSS attacks (in theory), but
		// IE can be fooled into mime-type detecting a malformed image as an html file, thus executing an XSS attack on anyone
<<<<<<< HEAD
		// using IE who looks at the image.  It does this by inspecting the first 255 bytes of an image.  To get around this
		// CI will itself look at the first 255 bytes of an image to determine its relative safety.  This can save a lot of
=======
		// using IE who looks at the image. It does this by inspecting the first 255 bytes of an image. To get around this
		// CI will itself look at the first 255 bytes of an image to determine its relative safety. This can save a lot of
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
		// processor power and time if it is actually a clean image, as it will be in nearly all instances _except_ an
		// attempted XSS attack.

		if (function_exists('getimagesize') && @getimagesize($file) !== FALSE)
		{
			if (($file = @fopen($file, 'rb')) === FALSE) // "b" to force binary
			{
				return FALSE; // Couldn't open the file, return FALSE
			}

			$opening_bytes = fread($file, 256);
			fclose($file);

			// These are known to throw IE into mime-type detection chaos
			// <a, <body, <head, <html, <img, <plaintext, <pre, <script, <table, <title
			// title is basically just in SVG, but we filter it anyhow

<<<<<<< HEAD
			if ( ! preg_match('/<(a|body|head|html|img|plaintext|pre|script|table|title)[\s>]/i', $opening_bytes))
			{
				return TRUE; // its an image, no "triggers" detected in the first 256 bytes, we're good
			}
			else
			{
				return FALSE;
			}
=======
			// if it's an image or no "triggers" detected in the first 256 bytes - we're good
			return ! preg_match('/<(a|body|head|html|img|plaintext|pre|script|table|title)[\s>]/i', $opening_bytes);
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
		}

		if (($data = @file_get_contents($file)) === FALSE)
		{
			return FALSE;
		}

<<<<<<< HEAD
		$CI =& get_instance();
		return $CI->security->xss_clean($data, TRUE);
=======
		return $this->_CI->security->xss_clean($data, TRUE);
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
	}

	// --------------------------------------------------------------------

	/**
	 * Set an error message
	 *
<<<<<<< HEAD
	 * @param	string
	 * @return	void
	 */
	public function set_error($msg)
	{
		$CI =& get_instance();
		$CI->lang->load('upload');

		if (is_array($msg))
		{
			foreach ($msg as $val)
			{
				$msg = ($CI->lang->line($val) == FALSE) ? $val : $CI->lang->line($val);
				$this->error_msg[] = $msg;
				log_message('error', $msg);
			}
		}
		else
		{
			$msg = ($CI->lang->line($msg) == FALSE) ? $msg : $CI->lang->line($msg);
			$this->error_msg[] = $msg;
			log_message('error', $msg);
		}
=======
	 * @param	string	$msg
	 * @return	CI_Upload
	 */
	public function set_error($msg, $log_level = 'error')
	{
		$this->_CI->lang->load('upload');

		is_array($msg) OR $msg = array($msg);
		foreach ($msg as $val)
		{
			$msg = ($this->_CI->lang->line($val) === FALSE) ? $val : $this->_CI->lang->line($val);
			$this->error_msg[] = $msg;
			log_message($log_level, $msg);
		}

		return $this;
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
	}

	// --------------------------------------------------------------------

	/**
	 * Display the error message
	 *
<<<<<<< HEAD
	 * @param	string
	 * @param	string
=======
	 * @param	string	$open
	 * @param	string	$close
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
	 * @return	string
	 */
	public function display_errors($open = '<p>', $close = '</p>')
	{
<<<<<<< HEAD
		$str = '';
		foreach ($this->error_msg as $val)
		{
			$str .= $open.$val.$close;
		}

		return $str;
	}

	// --------------------------------------------------------------------

	/**
	 * List of Mime Types
	 *
	 * This is a list of mime types.  We use it to validate
	 * the "allowed types" set by the developer
	 *
	 * @param	string
	 * @return	string
	 */
	public function mimes_types($mime)
	{
		global $mimes;

		if (count($this->mimes) == 0)
		{
			if (defined('ENVIRONMENT') AND is_file(APPPATH.'config/'.ENVIRONMENT.'/mimes.php'))
			{
				include(APPPATH.'config/'.ENVIRONMENT.'/mimes.php');
			}
			elseif (is_file(APPPATH.'config/mimes.php'))
			{
				include(APPPATH.'config//mimes.php');
			}
			else
			{
				return FALSE;
			}

			$this->mimes = $mimes;
			unset($mimes);
		}

		return ( ! isset($this->mimes[$mime])) ? FALSE : $this->mimes[$mime];
=======
		return (count($this->error_msg) > 0) ? $open.implode($close.$open, $this->error_msg).$close : '';
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
	}

	// --------------------------------------------------------------------

	/**
	 * Prep Filename
	 *
<<<<<<< HEAD
	 * Prevents possible script execution from Apache's handling of files multiple extensions
	 * http://httpd.apache.org/docs/1.3/mod/mod_mime.html#multipleext
	 *
	 * @param	string
=======
	 * Prevents possible script execution from Apache's handling
	 * of files' multiple extensions.
	 *
	 * @link	http://httpd.apache.org/docs/1.3/mod/mod_mime.html#multipleext
	 *
	 * @param	string	$filename
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
	 * @return	string
	 */
	protected function _prep_filename($filename)
	{
<<<<<<< HEAD
		if (strpos($filename, '.') === FALSE OR $this->allowed_types == '*')
=======
		if ($this->mod_mime_fix === FALSE OR $this->allowed_types === '*' OR ($ext_pos = strrpos($filename, '.')) === FALSE)
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
		{
			return $filename;
		}

<<<<<<< HEAD
		$parts		= explode('.', $filename);
		$ext		= array_pop($parts);
		$filename	= array_shift($parts);

		foreach ($parts as $part)
		{
			if ( ! in_array(strtolower($part), $this->allowed_types) OR $this->mimes_types(strtolower($part)) === FALSE)
			{
				$filename .= '.'.$part.'_';
			}
			else
			{
				$filename .= '.'.$part;
			}
		}

		$filename .= '.'.$ext;

		return $filename;
=======
		$ext = substr($filename, $ext_pos);
		$filename = substr($filename, 0, $ext_pos);
		return str_replace('.', '_', $filename).$ext;
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
	}

	// --------------------------------------------------------------------

	/**
	 * File MIME type
	 *
	 * Detects the (actual) MIME type of the uploaded file, if possible.
	 * The input array is expected to be $_FILES[$field]
	 *
<<<<<<< HEAD
	 * @param	array
=======
	 * @param	array	$file
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
	 * @return	void
	 */
	protected function _file_mime_type($file)
	{
		// We'll need this to validate the MIME info string (e.g. text/plain; charset=us-ascii)
		$regexp = '/^([a-z\-]+\/[a-z0-9\-\.\+]+)(;\s.+)?$/';

		/* Fileinfo extension - most reliable method
		 *
		 * Unfortunately, prior to PHP 5.3 - it's only available as a PECL extension and the
		 * more convenient FILEINFO_MIME_TYPE flag doesn't exist.
		 */
		if (function_exists('finfo_file'))
		{
<<<<<<< HEAD
			$finfo = finfo_open(FILEINFO_MIME);
=======
			$finfo = @finfo_open(FILEINFO_MIME);
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
			if (is_resource($finfo)) // It is possible that a FALSE value is returned, if there is no magic MIME database file found on the system
			{
				$mime = @finfo_file($finfo, $file['tmp_name']);
				finfo_close($finfo);

				/* According to the comments section of the PHP manual page,
				 * it is possible that this function returns an empty string
				 * for some files (e.g. if they don't exist in the magic MIME database)
				 */
				if (is_string($mime) && preg_match($regexp, $mime, $matches))
				{
					$this->file_type = $matches[1];
					return;
				}
			}
		}

		/* This is an ugly hack, but UNIX-type systems provide a "native" way to detect the file type,
		 * which is still more secure than depending on the value of $_FILES[$field]['type'], and as it
<<<<<<< HEAD
		 * was reported in issue #750 (https://github.com/bcit-ci/CodeIgniter/issues/750) - it's better
=======
		 * was reported in issue #750 (https://github.com/EllisLab/CodeIgniter/issues/750) - it's better
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
		 * than mime_content_type() as well, hence the attempts to try calling the command line with
		 * three different functions.
		 *
		 * Notes:
		 *	- the DIRECTORY_SEPARATOR comparison ensures that we're not on a Windows system
		 *	- many system admins would disable the exec(), shell_exec(), popen() and similar functions
<<<<<<< HEAD
		 *	  due to security concerns, hence the function_exists() checks
		 */
		if (DIRECTORY_SEPARATOR !== '\\')
		{
			$cmd = 'file --brief --mime ' . escapeshellarg($file['tmp_name']) . ' 2>&1';

			if (function_exists('exec'))
			{
				/* This might look confusing, as $mime is being populated with all of the output when set in the second parameter.
				 * However, we only neeed the last line, which is the actual return value of exec(), and as such - it overwrites
=======
		 *	  due to security concerns, hence the function_usable() checks
		 */
		if (DIRECTORY_SEPARATOR !== '\\')
		{
			$cmd = function_exists('escapeshellarg')
				? 'file --brief --mime '.escapeshellarg($file['tmp_name']).' 2>&1'
				: 'file --brief --mime '.$file['tmp_name'].' 2>&1';

			if (function_usable('exec'))
			{
				/* This might look confusing, as $mime is being populated with all of the output when set in the second parameter.
				 * However, we only need the last line, which is the actual return value of exec(), and as such - it overwrites
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
				 * anything that could already be set for $mime previously. This effectively makes the second parameter a dummy
				 * value, which is only put to allow us to get the return status code.
				 */
				$mime = @exec($cmd, $mime, $return_status);
				if ($return_status === 0 && is_string($mime) && preg_match($regexp, $mime, $matches))
				{
					$this->file_type = $matches[1];
					return;
				}
			}

<<<<<<< HEAD
			if ( (bool) @ini_get('safe_mode') === FALSE && function_exists('shell_exec'))
=======
			if ( ! ini_get('safe_mode') && function_usable('shell_exec'))
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
			{
				$mime = @shell_exec($cmd);
				if (strlen($mime) > 0)
				{
					$mime = explode("\n", trim($mime));
					if (preg_match($regexp, $mime[(count($mime) - 1)], $matches))
					{
						$this->file_type = $matches[1];
						return;
					}
				}
			}

<<<<<<< HEAD
			if (function_exists('popen'))
=======
			if (function_usable('popen'))
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
			{
				$proc = @popen($cmd, 'r');
				if (is_resource($proc))
				{
					$mime = @fread($proc, 512);
					@pclose($proc);
					if ($mime !== FALSE)
					{
						$mime = explode("\n", trim($mime));
						if (preg_match($regexp, $mime[(count($mime) - 1)], $matches))
						{
							$this->file_type = $matches[1];
							return;
						}
					}
				}
			}
		}

		// Fall back to the deprecated mime_content_type(), if available (still better than $_FILES[$field]['type'])
		if (function_exists('mime_content_type'))
		{
			$this->file_type = @mime_content_type($file['tmp_name']);
			if (strlen($this->file_type) > 0) // It's possible that mime_content_type() returns FALSE or an empty string
			{
				return;
			}
		}

		$this->file_type = $file['type'];
	}

<<<<<<< HEAD
	// --------------------------------------------------------------------

}
// END Upload Class

/* End of file Upload.php */
/* Location: ./system/libraries/Upload.php */
=======
}
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
