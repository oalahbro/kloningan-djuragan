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
 * Zip Compression Class
 *
 * This class is based on a library I found at Zend:
 * http://www.zend.com/codex.php?id=696&single=1
 *
 * The original library is a little rough around the edges so I
 * refactored it and added several additional methods -- Rick Ellis
 *
 * @package		CodeIgniter
 * @subpackage	Libraries
 * @category	Encryption
 * @author		EllisLab Dev Team
<<<<<<< HEAD
 * @link		http://codeigniter.com/user_guide/libraries/zip.html
 */
class CI_Zip  {

	var $zipdata	= '';
	var $directory	= '';
	var $entries	= 0;
	var $file_num	= 0;
	var $offset		= 0;
	var $now;

	/**
	 * Constructor
	 */
	public function __construct()
	{
		log_message('debug', "Zip Compression Class Initialized");

		$this->now = time();
=======
 * @link		https://codeigniter.com/user_guide/libraries/zip.html
 */
class CI_Zip {

	/**
	 * Zip data in string form
	 *
	 * @var string
	 */
	public $zipdata = '';

	/**
	 * Zip data for a directory in string form
	 *
	 * @var string
	 */
	public $directory = '';

	/**
	 * Number of files/folder in zip file
	 *
	 * @var int
	 */
	public $entries = 0;

	/**
	 * Number of files in zip
	 *
	 * @var int
	 */
	public $file_num = 0;

	/**
	 * relative offset of local header
	 *
	 * @var int
	 */
	public $offset = 0;

	/**
	 * Reference to time at init
	 *
	 * @var int
	 */
	public $now;

	/**
	 * The level of compression
	 *
	 * Ranges from 0 to 9, with 9 being the highest level.
	 *
	 * @var	int
	 */
	public $compression_level = 2;

	/**
	 * Initialize zip compression class
	 *
	 * @return	void
	 */
	public function __construct()
	{
		$this->now = time();
		log_message('info', 'Zip Compression Class Initialized');
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
	}

	// --------------------------------------------------------------------

	/**
	 * Add Directory
	 *
	 * Lets you add a virtual directory into which you can place files.
	 *
<<<<<<< HEAD
	 * @access	public
	 * @param	mixed	the directory name. Can be string or array
	 * @return	void
	 */
	function add_dir($directory)
	{
		foreach ((array)$directory as $dir)
		{
			if ( ! preg_match("|.+/$|", $dir))
=======
	 * @param	mixed	$directory	the directory name. Can be string or array
	 * @return	void
	 */
	public function add_dir($directory)
	{
		foreach ((array) $directory as $dir)
		{
			if ( ! preg_match('|.+/$|', $dir))
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
			{
				$dir .= '/';
			}

			$dir_time = $this->_get_mod_time($dir);
<<<<<<< HEAD

=======
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
			$this->_add_dir($dir, $dir_time['file_mtime'], $dir_time['file_mdate']);
		}
	}

	// --------------------------------------------------------------------

	/**
<<<<<<< HEAD
	 *	Get file/directory modification time
	 *
	 *	If this is a newly created file/dir, we will set the time to 'now'
	 *
	 *	@param string	path to file
	 *	@return array	filemtime/filemdate
	 */
	function _get_mod_time($dir)
	{
		// filemtime() will return false, but it does raise an error.
		$date = (@filemtime($dir)) ? filemtime($dir) : getdate($this->now);

		$time['file_mtime'] = ($date['hours'] << 11) + ($date['minutes'] << 5) + $date['seconds'] / 2;
		$time['file_mdate'] = (($date['year'] - 1980) << 9) + ($date['mon'] << 5) + $date['mday'];

		return $time;
=======
	 * Get file/directory modification time
	 *
	 * If this is a newly created file/dir, we will set the time to 'now'
	 *
	 * @param	string	$dir	path to file
	 * @return	array	filemtime/filemdate
	 */
	protected function _get_mod_time($dir)
	{
		// filemtime() may return false, but raises an error for non-existing files
		$date = file_exists($dir) ? getdate(filemtime($dir)) : getdate($this->now);

		return array(
			'file_mtime' => ($date['hours'] << 11) + ($date['minutes'] << 5) + $date['seconds'] / 2,
			'file_mdate' => (($date['year'] - 1980) << 9) + ($date['mon'] << 5) + $date['mday']
		);
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
	}

	// --------------------------------------------------------------------

	/**
	 * Add Directory
	 *
<<<<<<< HEAD
	 * @access	private
	 * @param	string	the directory name
	 * @return	void
	 */
	function _add_dir($dir, $file_mtime, $file_mdate)
	{
		$dir = str_replace("\\", "/", $dir);
=======
	 * @param	string	$dir	the directory name
	 * @param	int	$file_mtime
	 * @param	int	$file_mdate
	 * @return	void
	 */
	protected function _add_dir($dir, $file_mtime, $file_mdate)
	{
		$dir = str_replace('\\', '/', $dir);
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd

		$this->zipdata .=
			"\x50\x4b\x03\x04\x0a\x00\x00\x00\x00\x00"
			.pack('v', $file_mtime)
			.pack('v', $file_mdate)
			.pack('V', 0) // crc32
			.pack('V', 0) // compressed filesize
			.pack('V', 0) // uncompressed filesize
			.pack('v', strlen($dir)) // length of pathname
			.pack('v', 0) // extra field length
			.$dir
			// below is "data descriptor" segment
			.pack('V', 0) // crc32
			.pack('V', 0) // compressed filesize
			.pack('V', 0); // uncompressed filesize

		$this->directory .=
			"\x50\x4b\x01\x02\x00\x00\x0a\x00\x00\x00\x00\x00"
			.pack('v', $file_mtime)
			.pack('v', $file_mdate)
			.pack('V',0) // crc32
			.pack('V',0) // compressed filesize
			.pack('V',0) // uncompressed filesize
			.pack('v', strlen($dir)) // length of pathname
			.pack('v', 0) // extra field length
			.pack('v', 0) // file comment length
			.pack('v', 0) // disk number start
			.pack('v', 0) // internal file attributes
			.pack('V', 16) // external file attributes - 'directory' bit set
			.pack('V', $this->offset) // relative offset of local header
			.$dir;

		$this->offset = strlen($this->zipdata);
		$this->entries++;
	}

	// --------------------------------------------------------------------

	/**
	 * Add Data to Zip
	 *
	 * Lets you add files to the archive. If the path is included
<<<<<<< HEAD
	 * in the filename it will be placed within a directory.  Make
	 * sure you use add_dir() first to create the folder.
	 *
	 * @access	public
	 * @param	mixed
	 * @param	string
	 * @return	void
	 */
	function add_data($filepath, $data = NULL)
=======
	 * in the filename it will be placed within a directory. Make
	 * sure you use add_dir() first to create the folder.
	 *
	 * @param	mixed	$filepath	A single filepath or an array of file => data pairs
	 * @param	string	$data		Single file contents
	 * @return	void
	 */
	public function add_data($filepath, $data = NULL)
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
	{
		if (is_array($filepath))
		{
			foreach ($filepath as $path => $data)
			{
				$file_data = $this->_get_mod_time($path);
<<<<<<< HEAD

=======
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
				$this->_add_data($path, $data, $file_data['file_mtime'], $file_data['file_mdate']);
			}
		}
		else
		{
			$file_data = $this->_get_mod_time($filepath);
<<<<<<< HEAD

=======
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
			$this->_add_data($filepath, $data, $file_data['file_mtime'], $file_data['file_mdate']);
		}
	}

	// --------------------------------------------------------------------

	/**
	 * Add Data to Zip
	 *
<<<<<<< HEAD
	 * @access	private
	 * @param	string	the file name/path
	 * @param	string	the data to be encoded
	 * @return	void
	 */
	function _add_data($filepath, $data, $file_mtime, $file_mdate)
	{
		$filepath = str_replace("\\", "/", $filepath);

		$uncompressed_size = strlen($data);
		$crc32  = crc32($data);

		$gzdata = gzcompress($data);
		$gzdata = substr($gzdata, 2, -4);
=======
	 * @param	string	$filepath	the file name/path
	 * @param	string	$data	the data to be encoded
	 * @param	int	$file_mtime
	 * @param	int	$file_mdate
	 * @return	void
	 */
	protected function _add_data($filepath, $data, $file_mtime, $file_mdate)
	{
		$filepath = str_replace('\\', '/', $filepath);

		$uncompressed_size = strlen($data);
		$crc32  = crc32($data);
		$gzdata = substr(gzcompress($data, $this->compression_level), 2, -4);
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
		$compressed_size = strlen($gzdata);

		$this->zipdata .=
			"\x50\x4b\x03\x04\x14\x00\x00\x00\x08\x00"
			.pack('v', $file_mtime)
			.pack('v', $file_mdate)
			.pack('V', $crc32)
			.pack('V', $compressed_size)
			.pack('V', $uncompressed_size)
			.pack('v', strlen($filepath)) // length of filename
			.pack('v', 0) // extra field length
			.$filepath
			.$gzdata; // "file data" segment

		$this->directory .=
			"\x50\x4b\x01\x02\x00\x00\x14\x00\x00\x00\x08\x00"
			.pack('v', $file_mtime)
			.pack('v', $file_mdate)
			.pack('V', $crc32)
			.pack('V', $compressed_size)
			.pack('V', $uncompressed_size)
			.pack('v', strlen($filepath)) // length of filename
			.pack('v', 0) // extra field length
			.pack('v', 0) // file comment length
			.pack('v', 0) // disk number start
			.pack('v', 0) // internal file attributes
			.pack('V', 32) // external file attributes - 'archive' bit set
			.pack('V', $this->offset) // relative offset of local header
			.$filepath;

		$this->offset = strlen($this->zipdata);
		$this->entries++;
		$this->file_num++;
	}

	// --------------------------------------------------------------------

	/**
	 * Read the contents of a file and add it to the zip
	 *
<<<<<<< HEAD
	 * @access	public
	 * @return	bool
	 */
	function read_file($path, $preserve_filepath = FALSE)
	{
		if ( ! file_exists($path))
		{
			return FALSE;
		}

		if (FALSE !== ($data = file_get_contents($path)))
		{
			$name = str_replace("\\", "/", $path);

			if ($preserve_filepath === FALSE)
			{
				$name = preg_replace("|.*/(.+)|", "\\1", $name);
=======
	 * @param	string	$path
	 * @param	bool	$archive_filepath
	 * @return	bool
	 */
	public function read_file($path, $archive_filepath = FALSE)
	{
		if (file_exists($path) && FALSE !== ($data = file_get_contents($path)))
		{
			if (is_string($archive_filepath))
			{
				$name = str_replace('\\', '/', $archive_filepath);
			}
			else
			{
				$name = str_replace('\\', '/', $path);

				if ($archive_filepath === FALSE)
				{
					$name = preg_replace('|.*/(.+)|', '\\1', $name);
				}
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
			}

			$this->add_data($name, $data);
			return TRUE;
		}
<<<<<<< HEAD
=======

>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
		return FALSE;
	}

	// ------------------------------------------------------------------------

	/**
	 * Read a directory and add it to the zip.
	 *
	 * This function recursively reads a folder and everything it contains (including
<<<<<<< HEAD
	 * sub-folders) and creates a zip based on it.  Whatever directory structure
	 * is in the original file path will be recreated in the zip file.
	 *
	 * @access	public
	 * @param	string	path to source
	 * @return	bool
	 */
	function read_dir($path, $preserve_filepath = TRUE, $root_path = NULL)
	{
=======
	 * sub-folders) and creates a zip based on it. Whatever directory structure
	 * is in the original file path will be recreated in the zip file.
	 *
	 * @param	string	$path	path to source directory
	 * @param	bool	$preserve_filepath
	 * @param	string	$root_path
	 * @return	bool
	 */
	public function read_dir($path, $preserve_filepath = TRUE, $root_path = NULL)
	{
		$path = rtrim($path, '/\\').DIRECTORY_SEPARATOR;
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
		if ( ! $fp = @opendir($path))
		{
			return FALSE;
		}

		// Set the original directory root for child dir's to use as relative
		if ($root_path === NULL)
		{
<<<<<<< HEAD
			$root_path = dirname($path).'/';
=======
			$root_path = str_replace(array('\\', '/'), DIRECTORY_SEPARATOR, dirname($path)).DIRECTORY_SEPARATOR;
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
		}

		while (FALSE !== ($file = readdir($fp)))
		{
<<<<<<< HEAD
			if (substr($file, 0, 1) == '.')
=======
			if ($file[0] === '.')
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
			{
				continue;
			}

<<<<<<< HEAD
			if (@is_dir($path.$file))
			{
				$this->read_dir($path.$file."/", $preserve_filepath, $root_path);
			}
			else
			{
				if (FALSE !== ($data = file_get_contents($path.$file)))
				{
					$name = str_replace("\\", "/", $path);

					if ($preserve_filepath === FALSE)
					{
						$name = str_replace($root_path, '', $name);
					}

					$this->add_data($name.$file, $data);
				}
			}
		}

=======
			if (is_dir($path.$file))
			{
				$this->read_dir($path.$file.DIRECTORY_SEPARATOR, $preserve_filepath, $root_path);
			}
			elseif (FALSE !== ($data = file_get_contents($path.$file)))
			{
				$name = str_replace(array('\\', '/'), DIRECTORY_SEPARATOR, $path);
				if ($preserve_filepath === FALSE)
				{
					$name = str_replace($root_path, '', $name);
				}

				$this->add_data($name.$file, $data);
			}
		}

		closedir($fp);
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
		return TRUE;
	}

	// --------------------------------------------------------------------

	/**
	 * Get the Zip file
	 *
<<<<<<< HEAD
	 * @access	public
	 * @return	binary string
	 */
	function get_zip()
	{
		// Is there any data to return?
		if ($this->entries == 0)
=======
	 * @return	string	(binary encoded)
	 */
	public function get_zip()
	{
		// Is there any data to return?
		if ($this->entries === 0)
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
		{
			return FALSE;
		}

<<<<<<< HEAD
		$zip_data = $this->zipdata;
		$zip_data .= $this->directory."\x50\x4b\x05\x06\x00\x00\x00\x00";
		$zip_data .= pack('v', $this->entries); // total # of entries "on this disk"
		$zip_data .= pack('v', $this->entries); // total # of entries overall
		$zip_data .= pack('V', strlen($this->directory)); // size of central dir
		$zip_data .= pack('V', strlen($this->zipdata)); // offset to start of central dir
		$zip_data .= "\x00\x00"; // .zip file comment length

		return $zip_data;
=======
		return $this->zipdata
			.$this->directory."\x50\x4b\x05\x06\x00\x00\x00\x00"
			.pack('v', $this->entries) // total # of entries "on this disk"
			.pack('v', $this->entries) // total # of entries overall
			.pack('V', strlen($this->directory)) // size of central dir
			.pack('V', strlen($this->zipdata)) // offset to start of central dir
			."\x00\x00"; // .zip file comment length
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
	}

	// --------------------------------------------------------------------

	/**
	 * Write File to the specified directory
	 *
	 * Lets you write a file
	 *
<<<<<<< HEAD
	 * @access	public
	 * @param	string	the file name
	 * @return	bool
	 */
	function archive($filepath)
	{
		if ( ! ($fp = @fopen($filepath, FOPEN_WRITE_CREATE_DESTRUCTIVE)))
=======
	 * @param	string	$filepath	the file name
	 * @return	bool
	 */
	public function archive($filepath)
	{
		if ( ! ($fp = @fopen($filepath, 'w+b')))
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
		{
			return FALSE;
		}

		flock($fp, LOCK_EX);
<<<<<<< HEAD
		fwrite($fp, $this->get_zip());
		flock($fp, LOCK_UN);
		fclose($fp);

		return TRUE;
=======

		for ($result = $written = 0, $data = $this->get_zip(), $length = strlen($data); $written < $length; $written += $result)
		{
			if (($result = fwrite($fp, substr($data, $written))) === FALSE)
			{
				break;
			}
		}

		flock($fp, LOCK_UN);
		fclose($fp);

		return is_int($result);
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
	}

	// --------------------------------------------------------------------

	/**
	 * Download
	 *
<<<<<<< HEAD
	 * @access	public
	 * @param	string	the file name
	 * @param	string	the data to be encoded
	 * @return	bool
	 */
	function download($filename = 'backup.zip')
	{
		if ( ! preg_match("|.+?\.zip$|", $filename))
=======
	 * @param	string	$filename	the file name
	 * @return	void
	 */
	public function download($filename = 'backup.zip')
	{
		if ( ! preg_match('|.+?\.zip$|', $filename))
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
		{
			$filename .= '.zip';
		}

<<<<<<< HEAD
		$CI =& get_instance();
		$CI->load->helper('download');

		$get_zip = $this->get_zip();

=======
		get_instance()->load->helper('download');
		$get_zip = $this->get_zip();
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
		$zip_content =& $get_zip;

		force_download($filename, $zip_content);
	}

	// --------------------------------------------------------------------

	/**
	 * Initialize Data
	 *
<<<<<<< HEAD
	 * Lets you clear current zip data.  Useful if you need to create
	 * multiple zips with different data.
	 *
	 * @access	public
	 * @return	void
	 */
	function clear_data()
	{
		$this->zipdata		= '';
		$this->directory	= '';
		$this->entries		= 0;
		$this->file_num		= 0;
		$this->offset		= 0;
	}

}

/* End of file Zip.php */
/* Location: ./system/libraries/Zip.php */
=======
	 * Lets you clear current zip data. Useful if you need to create
	 * multiple zips with different data.
	 *
	 * @return	CI_Zip
	 */
	public function clear_data()
	{
		$this->zipdata = '';
		$this->directory = '';
		$this->entries = 0;
		$this->file_num = 0;
		$this->offset = 0;
		return $this;
	}

}
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
