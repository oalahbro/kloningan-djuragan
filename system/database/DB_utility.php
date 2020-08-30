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
 * Database Utility Class
 *
 * @category	Database
 * @author		EllisLab Dev Team
<<<<<<< HEAD
<<<<<<< HEAD
 * @link		http://codeigniter.com/user_guide/database/
 */
class CI_DB_utility extends CI_DB_forge {

	var $db;
	var $data_cache		= array();

	/**
	 * Constructor
	 *
	 * Grabs the CI super object instance so we can access it.
	 *
	 */
	function __construct()
	{
		// Assign the main database object to $this->db
		$CI =& get_instance();
		$this->db =& $CI->db;

		log_message('debug', "Database Utility Class Initialized");
=======
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
 * @link		https://codeigniter.com/user_guide/database/
 */
abstract class CI_DB_utility {

	/**
	 * Database object
	 *
	 * @var	object
	 */
	protected $db;

	// --------------------------------------------------------------------

	/**
	 * List databases statement
	 *
	 * @var	string
	 */
	protected $_list_databases		= FALSE;

	/**
	 * OPTIMIZE TABLE statement
	 *
	 * @var	string
	 */
	protected $_optimize_table	= FALSE;

	/**
	 * REPAIR TABLE statement
	 *
	 * @var	string
	 */
	protected $_repair_table	= FALSE;

	// --------------------------------------------------------------------

	/**
	 * Class constructor
	 *
	 * @param	object	&$db	Database object
	 * @return	void
	 */
	public function __construct(&$db)
	{
		$this->db =& $db;
		log_message('info', 'Database Utility Class Initialized');
<<<<<<< HEAD
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	}

	// --------------------------------------------------------------------

	/**
	 * List databases
	 *
<<<<<<< HEAD
<<<<<<< HEAD
	 * @access	public
	 * @return	bool
	 */
	function list_databases()
	{
		// Is there a cached result?
		if (isset($this->data_cache['db_names']))
		{
			return $this->data_cache['db_names'];
		}

		$query = $this->db->query($this->_list_databases());
		$dbs = array();
		if ($query->num_rows() > 0)
		{
			foreach ($query->result_array() as $row)
			{
				$dbs[] = current($row);
			}
		}

		$this->data_cache['db_names'] = $dbs;
		return $this->data_cache['db_names'];
=======
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	 * @return	array
	 */
	public function list_databases()
	{
		// Is there a cached result?
		if (isset($this->db->data_cache['db_names']))
		{
			return $this->db->data_cache['db_names'];
		}
		elseif ($this->_list_databases === FALSE)
		{
			return ($this->db->db_debug) ? $this->db->display_error('db_unsupported_feature') : FALSE;
		}

		$this->db->data_cache['db_names'] = array();

		$query = $this->db->query($this->_list_databases);
		if ($query === FALSE)
		{
			return $this->db->data_cache['db_names'];
		}

		for ($i = 0, $query = $query->result_array(), $c = count($query); $i < $c; $i++)
		{
			$this->db->data_cache['db_names'][] = current($query[$i]);
		}

		return $this->db->data_cache['db_names'];
<<<<<<< HEAD
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	}

	// --------------------------------------------------------------------

	/**
	 * Determine if a particular database exists
	 *
<<<<<<< HEAD
<<<<<<< HEAD
	 * @access	public
	 * @param	string
	 * @return	boolean
	 */
	function database_exists($database_name)
	{
		// Some databases won't have access to the list_databases() function, so
		// this is intended to allow them to override with their own functions as
		// defined in $driver_utility.php
		if (method_exists($this, '_database_exists'))
		{
			return $this->_database_exists($database_name);
		}
		else
		{
			return ( ! in_array($database_name, $this->list_databases())) ? FALSE : TRUE;
		}
	}


=======
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	 * @param	string	$database_name
	 * @return	bool
	 */
	public function database_exists($database_name)
	{
		return in_array($database_name, $this->list_databases());
	}

<<<<<<< HEAD
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	// --------------------------------------------------------------------

	/**
	 * Optimize Table
	 *
<<<<<<< HEAD
<<<<<<< HEAD
	 * @access	public
	 * @param	string	the table name
	 * @return	bool
	 */
	function optimize_table($table_name)
	{
		$sql = $this->_optimize_table($table_name);

		if (is_bool($sql))
		{
				show_error('db_must_use_set');
		}

		$query = $this->db->query($sql);
		$res = $query->result_array();

		// Note: Due to a bug in current() that affects some versions
		// of PHP we can not pass function call directly into it
		return current($res);
=======
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	 * @param	string	$table_name
	 * @return	mixed
	 */
	public function optimize_table($table_name)
	{
		if ($this->_optimize_table === FALSE)
		{
			return ($this->db->db_debug) ? $this->db->display_error('db_unsupported_feature') : FALSE;
		}

		$query = $this->db->query(sprintf($this->_optimize_table, $this->db->escape_identifiers($table_name)));
		if ($query !== FALSE)
		{
			$query = $query->result_array();
			return current($query);
		}

		return FALSE;
<<<<<<< HEAD
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	}

	// --------------------------------------------------------------------

	/**
	 * Optimize Database
	 *
<<<<<<< HEAD
<<<<<<< HEAD
	 * @access	public
	 * @return	array
	 */
	function optimize_database()
	{
		$result = array();
		foreach ($this->db->list_tables() as $table_name)
		{
			$sql = $this->_optimize_table($table_name);

			if (is_bool($sql))
			{
				return $sql;
			}

			$query = $this->db->query($sql);

			// Build the result array...
			// Note: Due to a bug in current() that affects some versions
			// of PHP we can not pass function call directly into it
			$res = $query->result_array();
=======
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	 * @return	mixed
	 */
	public function optimize_database()
	{
		if ($this->_optimize_table === FALSE)
		{
			return ($this->db->db_debug) ? $this->db->display_error('db_unsupported_feature') : FALSE;
		}

		$result = array();
		foreach ($this->db->list_tables() as $table_name)
		{
			$res = $this->db->query(sprintf($this->_optimize_table, $this->db->escape_identifiers($table_name)));
			if (is_bool($res))
			{
				return $res;
			}

			// Build the result array...
			$res = $res->result_array();
<<<<<<< HEAD
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
			$res = current($res);
			$key = str_replace($this->db->database.'.', '', current($res));
			$keys = array_keys($res);
			unset($res[$keys[0]]);

			$result[$key] = $res;
		}

		return $result;
	}

	// --------------------------------------------------------------------

	/**
	 * Repair Table
	 *
<<<<<<< HEAD
<<<<<<< HEAD
	 * @access	public
	 * @param	string	the table name
	 * @return	bool
	 */
	function repair_table($table_name)
	{
		$sql = $this->_repair_table($table_name);

		if (is_bool($sql))
		{
			return $sql;
		}

		$query = $this->db->query($sql);

		// Note: Due to a bug in current() that affects some versions
		// of PHP we can not pass function call directly into it
		$res = $query->result_array();
		return current($res);
=======
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	 * @param	string	$table_name
	 * @return	mixed
	 */
	public function repair_table($table_name)
	{
		if ($this->_repair_table === FALSE)
		{
			return ($this->db->db_debug) ? $this->db->display_error('db_unsupported_feature') : FALSE;
		}

		$query = $this->db->query(sprintf($this->_repair_table, $this->db->escape_identifiers($table_name)));
		if (is_bool($query))
		{
			return $query;
		}

		$query = $query->result_array();
		return current($query);
<<<<<<< HEAD
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	}

	// --------------------------------------------------------------------

	/**
	 * Generate CSV from a query result object
	 *
<<<<<<< HEAD
<<<<<<< HEAD
	 * @access	public
	 * @param	object	The query result object
	 * @param	string	The delimiter - comma by default
	 * @param	string	The newline character - \n by default
	 * @param	string	The enclosure - double quote by default
	 * @return	string
	 */
	function csv_from_result($query, $delim = ",", $newline = "\n", $enclosure = '"')
=======
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	 * @param	object	$query		Query result object
	 * @param	string	$delim		Delimiter (default: ,)
	 * @param	string	$newline	Newline character (default: \n)
	 * @param	string	$enclosure	Enclosure (default: ")
	 * @return	string
	 */
	public function csv_from_result($query, $delim = ',', $newline = "\n", $enclosure = '"')
<<<<<<< HEAD
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	{
		if ( ! is_object($query) OR ! method_exists($query, 'list_fields'))
		{
			show_error('You must submit a valid result object');
		}

		$out = '';
<<<<<<< HEAD
<<<<<<< HEAD

=======
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
		// First generate the headings from the table column names
		foreach ($query->list_fields() as $name)
		{
			$out .= $enclosure.str_replace($enclosure, $enclosure.$enclosure, $name).$enclosure.$delim;
		}

<<<<<<< HEAD
<<<<<<< HEAD
		$out = rtrim($out);
		$out .= $newline;

		// Next blast through the result array and build out the rows
		foreach ($query->result_array() as $row)
		{
			foreach ($row as $item)
			{
				$out .= $enclosure.str_replace($enclosure, $enclosure.$enclosure, $item).$enclosure.$delim;
			}
			$out = rtrim($out);
			$out .= $newline;
=======
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
		$out = substr($out, 0, -strlen($delim)).$newline;

		// Next blast through the result array and build out the rows
		while ($row = $query->unbuffered_row('array'))
		{
			$line = array();
			foreach ($row as $item)
			{
				$line[] = $enclosure.str_replace($enclosure, $enclosure.$enclosure, $item).$enclosure;
			}
			$out .= implode($delim, $line).$newline;
<<<<<<< HEAD
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
		}

		return $out;
	}

	// --------------------------------------------------------------------

	/**
	 * Generate XML data from a query result object
	 *
<<<<<<< HEAD
<<<<<<< HEAD
	 * @access	public
	 * @param	object	The query result object
	 * @param	array	Any preferences
	 * @return	string
	 */
	function xml_from_result($query, $params = array())
=======
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	 * @param	object	$query	Query result object
	 * @param	array	$params	Any preferences
	 * @return	string
	 */
	public function xml_from_result($query, $params = array())
<<<<<<< HEAD
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	{
		if ( ! is_object($query) OR ! method_exists($query, 'list_fields'))
		{
			show_error('You must submit a valid result object');
		}

		// Set our default values
		foreach (array('root' => 'root', 'element' => 'element', 'newline' => "\n", 'tab' => "\t") as $key => $val)
		{
			if ( ! isset($params[$key]))
			{
				$params[$key] = $val;
			}
		}

		// Create variables for convenience
		extract($params);

		// Load the xml helper
<<<<<<< HEAD
<<<<<<< HEAD
		$CI =& get_instance();
		$CI->load->helper('xml');

		// Generate the result
		$xml = "<{$root}>".$newline;
		foreach ($query->result_array() as $row)
		{
			$xml .= $tab."<{$element}>".$newline;

			foreach ($row as $key => $val)
			{
				$xml .= $tab.$tab."<{$key}>".xml_convert($val)."</{$key}>".$newline;
			}
			$xml .= $tab."</{$element}>".$newline;
		}
		$xml .= "</$root>".$newline;

		return $xml;
=======
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
		get_instance()->load->helper('xml');

		// Generate the result
		$xml = '<'.$root.'>'.$newline;
		while ($row = $query->unbuffered_row())
		{
			$xml .= $tab.'<'.$element.'>'.$newline;
			foreach ($row as $key => $val)
			{
				$xml .= $tab.$tab.'<'.$key.'>'.xml_convert($val).'</'.$key.'>'.$newline;
			}
			$xml .= $tab.'</'.$element.'>'.$newline;
		}

		return $xml.'</'.$root.'>'.$newline;
<<<<<<< HEAD
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	}

	// --------------------------------------------------------------------

	/**
	 * Database Backup
	 *
<<<<<<< HEAD
<<<<<<< HEAD
	 * @access	public
	 * @return	void
	 */
	function backup($params = array())
=======
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	 * @param	array	$params
	 * @return	string
	 */
	public function backup($params = array())
<<<<<<< HEAD
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	{
		// If the parameters have not been submitted as an
		// array then we know that it is simply the table
		// name, which is a valid short cut.
		if (is_string($params))
		{
			$params = array('tables' => $params);
		}

<<<<<<< HEAD
<<<<<<< HEAD
		// ------------------------------------------------------

		// Set up our default preferences
		$prefs = array(
							'tables'		=> array(),
							'ignore'		=> array(),
							'filename'		=> '',
							'format'		=> 'gzip', // gzip, zip, txt
							'add_drop'		=> TRUE,
							'add_insert'	=> TRUE,
							'newline'		=> "\n"
						);
=======
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
		// Set up our default preferences
		$prefs = array(
			'tables'		=> array(),
			'ignore'		=> array(),
			'filename'		=> '',
			'format'		=> 'gzip', // gzip, zip, txt
			'add_drop'		=> TRUE,
			'add_insert'		=> TRUE,
			'newline'		=> "\n",
			'foreign_key_checks'	=> TRUE
		);
<<<<<<< HEAD
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3

		// Did the user submit any preferences? If so set them....
		if (count($params) > 0)
		{
			foreach ($prefs as $key => $val)
			{
				if (isset($params[$key]))
				{
					$prefs[$key] = $params[$key];
				}
			}
		}

<<<<<<< HEAD
<<<<<<< HEAD
		// ------------------------------------------------------

		// Are we backing up a complete database or individual tables?
		// If no table names were submitted we'll fetch the entire table list
		if (count($prefs['tables']) == 0)
=======
		// Are we backing up a complete database or individual tables?
		// If no table names were submitted we'll fetch the entire table list
		if (count($prefs['tables']) === 0)
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
		// Are we backing up a complete database or individual tables?
		// If no table names were submitted we'll fetch the entire table list
		if (count($prefs['tables']) === 0)
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
		{
			$prefs['tables'] = $this->db->list_tables();
		}

<<<<<<< HEAD
<<<<<<< HEAD
		// ------------------------------------------------------

=======
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
		// Validate the format
		if ( ! in_array($prefs['format'], array('gzip', 'zip', 'txt'), TRUE))
		{
			$prefs['format'] = 'txt';
		}

<<<<<<< HEAD
<<<<<<< HEAD
		// ------------------------------------------------------

		// Is the encoder supported?  If not, we'll either issue an
		// error or use plain text depending on the debug settings
		if (($prefs['format'] == 'gzip' AND ! @function_exists('gzencode'))
		OR ($prefs['format'] == 'zip'  AND ! @function_exists('gzcompress')))
		{
			if ($this->db->db_debug)
			{
				return $this->db->display_error('db_unsuported_compression');
=======
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
		// Is the encoder supported? If not, we'll either issue an
		// error or use plain text depending on the debug settings
		if (($prefs['format'] === 'gzip' && ! function_exists('gzencode'))
			OR ($prefs['format'] === 'zip' && ! function_exists('gzcompress')))
		{
			if ($this->db->db_debug)
			{
				return $this->db->display_error('db_unsupported_compression');
<<<<<<< HEAD
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
			}

			$prefs['format'] = 'txt';
		}

<<<<<<< HEAD
<<<<<<< HEAD
		// ------------------------------------------------------

		// Set the filename if not provided - Only needed with Zip files
		if ($prefs['filename'] == '' AND $prefs['format'] == 'zip')
		{
			$prefs['filename'] = (count($prefs['tables']) == 1) ? $prefs['tables'] : $this->db->database;
			$prefs['filename'] .= '_'.date('Y-m-d_H-i', time());
		}

		// ------------------------------------------------------

		// Was a Gzip file requested?
		if ($prefs['format'] == 'gzip')
		{
			return gzencode($this->_backup($prefs));
		}

		// ------------------------------------------------------

		// Was a text file requested?
		if ($prefs['format'] == 'txt')
		{
			return $this->_backup($prefs);
		}

		// ------------------------------------------------------

		// Was a Zip file requested?
		if ($prefs['format'] == 'zip')
		{
			// If they included the .zip file extension we'll remove it
			if (preg_match("|.+?\.zip$|", $prefs['filename']))
			{
				$prefs['filename'] = str_replace('.zip', '', $prefs['filename']);
			}

			// Tack on the ".sql" file extension if needed
			if ( ! preg_match("|.+?\.sql$|", $prefs['filename']))
			{
				$prefs['filename'] .= '.sql';
			}

			// Load the Zip class and output it

=======
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
		// Was a Zip file requested?
		if ($prefs['format'] === 'zip')
		{
			// Set the filename if not provided (only needed with Zip files)
			if ($prefs['filename'] === '')
			{
				$prefs['filename'] = (count($prefs['tables']) === 1 ? $prefs['tables'] : $this->db->database)
							.date('Y-m-d_H-i', time()).'.sql';
			}
			else
			{
				// If they included the .zip file extension we'll remove it
				if (preg_match('|.+?\.zip$|', $prefs['filename']))
				{
					$prefs['filename'] = str_replace('.zip', '', $prefs['filename']);
				}

				// Tack on the ".sql" file extension if needed
				if ( ! preg_match('|.+?\.sql$|', $prefs['filename']))
				{
					$prefs['filename'] .= '.sql';
				}
			}

			// Load the Zip class and output it
<<<<<<< HEAD
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
			$CI =& get_instance();
			$CI->load->library('zip');
			$CI->zip->add_data($prefs['filename'], $this->_backup($prefs));
			return $CI->zip->get_zip();
		}
<<<<<<< HEAD
<<<<<<< HEAD

	}

}


/* End of file DB_utility.php */
/* Location: ./system/database/DB_utility.php */
=======
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
		elseif ($prefs['format'] === 'txt') // Was a text file requested?
		{
			return $this->_backup($prefs);
		}
		elseif ($prefs['format'] === 'gzip') // Was a Gzip file requested?
		{
			return gzencode($this->_backup($prefs));
		}

		return;
	}

}
<<<<<<< HEAD
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
