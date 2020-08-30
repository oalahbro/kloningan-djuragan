<<<<<<< HEAD
<<<<<<< HEAD
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
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
 * @since		Version 2.0.2
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
 * @since	Version 2.1.0
 * @filesource
 */
defined('BASEPATH') OR exit('No direct script access allowed');
<<<<<<< HEAD
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3

/**
 * CUBRID Database Adapter Class
 *
 * Note: _DB is an extender class that the app controller
<<<<<<< HEAD
<<<<<<< HEAD
 * creates dynamically based on whether the active record
=======
 * creates dynamically based on whether the query builder
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
 * creates dynamically based on whether the query builder
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
 * class is being used or not.
 *
 * @package		CodeIgniter
 * @subpackage	Drivers
 * @category	Database
 * @author		Esen Sagynov
<<<<<<< HEAD
<<<<<<< HEAD
 * @link		http://codeigniter.com/user_guide/database/
 */
class CI_DB_cubrid_driver extends CI_DB {

	// Default CUBRID Broker port. Will be used unless user
	// explicitly specifies another one.
	const DEFAULT_PORT = 33000;

	var $dbdriver = 'cubrid';

	// The character used for escaping - no need in CUBRID
	var	$_escape_char = '';

	// clause and character used for LIKE escape sequences - not used in CUBRID
	var $_like_escape_str = '';
	var $_like_escape_chr = '';

	/**
	 * The syntax to count rows is slightly different across different
	 * database engines, so this string appears in each driver and is
	 * used for the count_all() and count_all_results() functions.
	 */
	var $_count_string = 'SELECT COUNT(*) AS ';
	var $_random_keyword = ' RAND()'; // database specific random keyword

	/**
	 * Non-persistent database connection
	 *
	 * @access	private called by the base class
	 * @return	resource
	 */
	function db_connect()
	{
		// If no port is defined by the user, use the default value
		if ($this->port == '')
		{
			$this->port = self::DEFAULT_PORT;
		}

		$conn = cubrid_connect($this->hostname, $this->port, $this->database, $this->username, $this->password);

		if ($conn)
		{
			// Check if a user wants to run queries in dry, i.e. run the
			// queries but not commit them.
			if (isset($this->auto_commit) && ! $this->auto_commit)
			{
				cubrid_set_autocommit($conn, CUBRID_AUTOCOMMIT_FALSE);
			}
			else
			{
				cubrid_set_autocommit($conn, CUBRID_AUTOCOMMIT_TRUE);
				$this->auto_commit = TRUE;
			}
		}

		return $conn;
=======
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
 * @link		https://codeigniter.com/user_guide/database/
 */
class CI_DB_cubrid_driver extends CI_DB {

	/**
	 * Database driver
	 *
	 * @var	string
	 */
	public $dbdriver = 'cubrid';

	/**
	 * Auto-commit flag
	 *
	 * @var	bool
	 */
	public $auto_commit = TRUE;

	// --------------------------------------------------------------------

	/**
	 * Identifier escape character
	 *
	 * @var	string
	 */
	protected $_escape_char = '`';

	/**
	 * ORDER BY random keyword
	 *
	 * @var	array
	 */
	protected $_random_keyword = array('RANDOM()', 'RANDOM(%d)');

	// --------------------------------------------------------------------

	/**
	 * Class constructor
	 *
	 * @param	array	$params
	 * @return	void
	 */
	public function __construct($params)
	{
		parent::__construct($params);

		if (preg_match('/^CUBRID:[^:]+(:[0-9][1-9]{0,4})?:[^:]+:[^:]*:[^:]*:(\?.+)?$/', $this->dsn, $matches))
		{
			if (stripos($matches[2], 'autocommit=off') !== FALSE)
			{
				$this->auto_commit = FALSE;
			}
		}
		else
		{
			// If no port is defined by the user, use the default value
			empty($this->port) OR $this->port = 33000;
		}
<<<<<<< HEAD
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	}

	// --------------------------------------------------------------------

	/**
<<<<<<< HEAD
<<<<<<< HEAD
	 * Persistent database connection
	 * In CUBRID persistent DB connection is supported natively in CUBRID
	 * engine which can be configured in the CUBRID Broker configuration
	 * file by setting the CCI_PCONNECT parameter to ON. In that case, all
	 * connections established between the client application and the
	 * server will become persistent. This is calling the same
	 * @cubrid_connect function will establish persisten connection
	 * considering that the CCI_PCONNECT is ON.
	 *
	 * @access	private called by the base class
	 * @return	resource
	 */
	function db_pconnect()
	{
		return $this->db_connect();
=======
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	 * Non-persistent database connection
	 *
	 * @param	bool	$persistent
	 * @return	resource
	 */
	public function db_connect($persistent = FALSE)
	{
		if (preg_match('/^CUBRID:[^:]+(:[0-9][1-9]{0,4})?:[^:]+:([^:]*):([^:]*):(\?.+)?$/', $this->dsn, $matches))
		{
			$func = ($persistent !== TRUE) ? 'cubrid_connect_with_url' : 'cubrid_pconnect_with_url';
			return ($matches[2] === '' && $matches[3] === '' && $this->username !== '' && $this->password !== '')
				? $func($this->dsn, $this->username, $this->password)
				: $func($this->dsn);
		}

		$func = ($persistent !== TRUE) ? 'cubrid_connect' : 'cubrid_pconnect';
		return ($this->username !== '')
			? $func($this->hostname, $this->port, $this->database, $this->username, $this->password)
			: $func($this->hostname, $this->port, $this->database);
<<<<<<< HEAD
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	}

	// --------------------------------------------------------------------

	/**
	 * Reconnect
	 *
	 * Keep / reestablish the db connection if no queries have been
	 * sent for a length of time exceeding the server's idle timeout
	 *
<<<<<<< HEAD
<<<<<<< HEAD
	 * @access	public
	 * @return	void
	 */
	function reconnect()
=======
	 * @return	void
	 */
	public function reconnect()
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
	 * @return	void
	 */
	public function reconnect()
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	{
		if (cubrid_ping($this->conn_id) === FALSE)
		{
			$this->conn_id = FALSE;
		}
	}

	// --------------------------------------------------------------------

	/**
<<<<<<< HEAD
<<<<<<< HEAD
	 * Select the database
	 *
	 * @access	private called by the base class
	 * @return	resource
	 */
	function db_select()
	{
		// In CUBRID there is no need to select a database as the database
		// is chosen at the connection time.
		// So, to determine if the database is "selected", all we have to
		// do is ping the server and return that value.
		return cubrid_ping($this->conn_id);
	}

	// --------------------------------------------------------------------

	/**
	 * Set client character set
	 *
	 * @access	public
	 * @param	string
	 * @param	string
	 * @return	resource
	 */
	function db_set_charset($charset, $collation)
	{
		// In CUBRID, there is no need to set charset or collation.
		// This is why returning true will allow the application continue
		// its normal process.
		return TRUE;
	}

	// --------------------------------------------------------------------

	/**
	 * Version number query string
	 *
	 * @access	public
	 * @return	string
	 */
	function _version()
	{
		// To obtain the CUBRID Server version, no need to run the SQL query.
		// CUBRID PHP API provides a function to determin this value.
		// This is why we also need to add 'cubrid' value to the list of
		// $driver_version_exceptions array in DB_driver class in
		// version() function.
		return cubrid_get_server_info($this->conn_id);
=======
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	 * Database version number
	 *
	 * @return	string
	 */
	public function version()
	{
		if (isset($this->data_cache['version']))
		{
			return $this->data_cache['version'];
		}

		return ( ! $this->conn_id OR ($version = cubrid_get_server_info($this->conn_id)) === FALSE)
			? FALSE
			: $this->data_cache['version'] = $version;
<<<<<<< HEAD
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	}

	// --------------------------------------------------------------------

	/**
	 * Execute the query
	 *
<<<<<<< HEAD
<<<<<<< HEAD
	 * @access	private called by the base class
	 * @param	string	an SQL query
	 * @return	resource
	 */
	function _execute($sql)
	{
		$sql = $this->_prep_query($sql);
		return @cubrid_query($sql, $this->conn_id);
	}

	// --------------------------------------------------------------------

	/**
	 * Prep the query
	 *
	 * If needed, each database adapter can prep the query string
	 *
	 * @access	private called by execute()
	 * @param	string	an SQL query
	 * @return	string
	 */
	function _prep_query($sql)
	{
		// No need to prepare
		return $sql;
=======
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	 * @param	string	$sql	an SQL query
	 * @return	resource
	 */
	protected function _execute($sql)
	{
		return cubrid_query($sql, $this->conn_id);
<<<<<<< HEAD
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	}

	// --------------------------------------------------------------------

	/**
	 * Begin Transaction
	 *
<<<<<<< HEAD
<<<<<<< HEAD
	 * @access	public
	 * @return	bool
	 */
	function trans_begin($test_mode = FALSE)
	{
		if ( ! $this->trans_enabled)
		{
			return TRUE;
		}

		// When transactions are nested we only begin/commit/rollback the outermost ones
		if ($this->_trans_depth > 0)
		{
			return TRUE;
		}

		// Reset the transaction failure flag.
		// If the $test_mode flag is set to TRUE transactions will be rolled back
		// even if the queries produce a successful result.
		$this->_trans_failure = ($test_mode === TRUE) ? TRUE : FALSE;

		if (cubrid_get_autocommit($this->conn_id))
		{
			cubrid_set_autocommit($this->conn_id, CUBRID_AUTOCOMMIT_FALSE);
=======
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	 * @return	bool
	 */
	protected function _trans_begin()
	{
		if (($autocommit = cubrid_get_autocommit($this->conn_id)) === NULL)
		{
			return FALSE;
		}
		elseif ($autocommit === TRUE)
		{
			return cubrid_set_autocommit($this->conn_id, CUBRID_AUTOCOMMIT_FALSE);
<<<<<<< HEAD
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
		}

		return TRUE;
	}

	// --------------------------------------------------------------------

	/**
	 * Commit Transaction
	 *
<<<<<<< HEAD
<<<<<<< HEAD
	 * @access	public
	 * @return	bool
	 */
	function trans_commit()
	{
		if ( ! $this->trans_enabled)
		{
			return TRUE;
		}

		// When transactions are nested we only begin/commit/rollback the outermost ones
		if ($this->_trans_depth > 0)
		{
			return TRUE;
		}

		cubrid_commit($this->conn_id);

		if ($this->auto_commit && ! cubrid_get_autocommit($this->conn_id))
		{
			cubrid_set_autocommit($this->conn_id, CUBRID_AUTOCOMMIT_TRUE);
=======
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	 * @return	bool
	 */
	protected function _trans_commit()
	{
		if ( ! cubrid_commit($this->conn_id))
		{
			return FALSE;
		}

		if ($this->auto_commit && ! cubrid_get_autocommit($this->conn_id))
		{
			return cubrid_set_autocommit($this->conn_id, CUBRID_AUTOCOMMIT_TRUE);
<<<<<<< HEAD
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
		}

		return TRUE;
	}

	// --------------------------------------------------------------------

	/**
	 * Rollback Transaction
	 *
<<<<<<< HEAD
<<<<<<< HEAD
	 * @access	public
	 * @return	bool
	 */
	function trans_rollback()
	{
		if ( ! $this->trans_enabled)
		{
			return TRUE;
		}

		// When transactions are nested we only begin/commit/rollback the outermost ones
		if ($this->_trans_depth > 0)
		{
			return TRUE;
		}

		cubrid_rollback($this->conn_id);

=======
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	 * @return	bool
	 */
	protected function _trans_rollback()
	{
		if ( ! cubrid_rollback($this->conn_id))
		{
			return FALSE;
		}

<<<<<<< HEAD
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
		if ($this->auto_commit && ! cubrid_get_autocommit($this->conn_id))
		{
			cubrid_set_autocommit($this->conn_id, CUBRID_AUTOCOMMIT_TRUE);
		}

		return TRUE;
	}

	// --------------------------------------------------------------------

	/**
<<<<<<< HEAD
<<<<<<< HEAD
	 * Escape String
	 *
	 * @access	public
	 * @param	string
	 * @param	bool	whether or not the string will be used in a LIKE condition
	 * @return	string
	 */
	function escape_str($str, $like = FALSE)
	{
		if (is_array($str))
		{
			foreach ($str as $key => $val)
			{
				$str[$key] = $this->escape_str($val, $like);
			}

			return $str;
		}

		if (function_exists('cubrid_real_escape_string') AND is_resource($this->conn_id))
		{
			$str = cubrid_real_escape_string($str, $this->conn_id);
		}
		else
		{
			$str = addslashes($str);
		}

		// escape LIKE condition wildcards
		if ($like === TRUE)
		{
			$str = str_replace(array('%', '_'), array('\\%', '\\_'), $str);
		}

		return $str;
=======
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	 * Platform-dependant string escape
	 *
	 * @param	string
	 * @return	string
	 */
	protected function _escape_str($str)
	{
		return cubrid_real_escape_string($str, $this->conn_id);
<<<<<<< HEAD
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	}

	// --------------------------------------------------------------------

	/**
	 * Affected Rows
	 *
<<<<<<< HEAD
<<<<<<< HEAD
	 * @access	public
	 * @return	integer
	 */
	function affected_rows()
	{
		return @cubrid_affected_rows($this->conn_id);
=======
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	 * @return	int
	 */
	public function affected_rows()
	{
		return cubrid_affected_rows();
<<<<<<< HEAD
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	}

	// --------------------------------------------------------------------

	/**
	 * Insert ID
	 *
<<<<<<< HEAD
<<<<<<< HEAD
	 * @access	public
	 * @return	integer
	 */
	function insert_id()
	{
		return @cubrid_insert_id($this->conn_id);
	}

	// --------------------------------------------------------------------

	/**
	 * "Count All" query
	 *
	 * Generates a platform-specific query string that counts all records in
	 * the specified table
	 *
	 * @access	public
	 * @param	string
	 * @return	string
	 */
	function count_all($table = '')
	{
		if ($table == '')
		{
			return 0;
		}
		
		$query = $this->query($this->_count_string . $this->_protect_identifiers('numrows') . " FROM " . $this->_protect_identifiers($table, TRUE, NULL, FALSE));

		if ($query->num_rows() == 0)
		{
			return 0;
		}

		$row = $query->row();
		$this->_reset_select();
		return (int) $row->numrows;
=======
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	 * @return	int
	 */
	public function insert_id()
	{
		return cubrid_insert_id($this->conn_id);
<<<<<<< HEAD
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	}

	// --------------------------------------------------------------------

	/**
	 * List table query
	 *
	 * Generates a platform-specific query string so that the table names can be fetched
	 *
<<<<<<< HEAD
<<<<<<< HEAD
	 * @access	private
	 * @param	boolean
	 * @return	string
	 */
	function _list_tables($prefix_limit = FALSE)
	{
		$sql = "SHOW TABLES";

		if ($prefix_limit !== FALSE AND $this->dbprefix != '')
		{
			$sql .= " LIKE '".$this->escape_like_str($this->dbprefix)."%'";
=======
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	 * @param	bool	$prefix_limit
	 * @return	string
	 */
	protected function _list_tables($prefix_limit = FALSE)
	{
		$sql = 'SHOW TABLES';

		if ($prefix_limit !== FALSE && $this->dbprefix !== '')
		{
			return $sql." LIKE '".$this->escape_like_str($this->dbprefix)."%'";
<<<<<<< HEAD
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
		}

		return $sql;
	}

	// --------------------------------------------------------------------

	/**
	 * Show column query
	 *
	 * Generates a platform-specific query string so that the column names can be fetched
	 *
<<<<<<< HEAD
<<<<<<< HEAD
	 * @access	public
	 * @param	string	the table name
	 * @return	string
	 */
	function _list_columns($table = '')
	{
		return "SHOW COLUMNS FROM ".$this->_protect_identifiers($table, TRUE, NULL, FALSE);
	}

	// --------------------------------------------------------------------

	/**
	 * Field data query
	 *
	 * Generates a platform-specific query so that the column data can be retrieved
	 *
	 * @access	public
	 * @param	string	the table name
	 * @return	object
	 */
	function _field_data($table)
	{
		return "SELECT * FROM ".$table." LIMIT 1";
	}

	// --------------------------------------------------------------------

	/**
	 * The error message string
	 *
	 * @access	private
	 * @return	string
	 */
	function _error_message()
	{
		return cubrid_error($this->conn_id);
=======
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	 * @param	string	$table
	 * @return	string
	 */
	protected function _list_columns($table = '')
	{
		return 'SHOW COLUMNS FROM '.$this->protect_identifiers($table, TRUE, NULL, FALSE);
<<<<<<< HEAD
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
	}

	// --------------------------------------------------------------------

	/**
<<<<<<< HEAD
	 * The error message number
	 *
	 * @access	private
	 * @return	integer
	 */
	function _error_number()
	{
		return cubrid_errno($this->conn_id);
	}

	// --------------------------------------------------------------------

	/**
	 * Escape the SQL Identifiers
	 *
	 * This function escapes column and table names
	 *
	 * @access	private
	 * @param	string
	 * @return	string
	 */
	function _escape_identifiers($item)
	{
		if ($this->_escape_char == '')
		{
			return $item;
		}

		foreach ($this->_reserved_identifiers as $id)
		{
			if (strpos($item, '.'.$id) !== FALSE)
			{
				$str = $this->_escape_char. str_replace('.', $this->_escape_char.'.', $item);

				// remove duplicates if the user already included the escape
				return preg_replace('/['.$this->_escape_char.']+/', $this->_escape_char, $str);
			}
		}

		if (strpos($item, '.') !== FALSE)
		{
			$str = $this->_escape_char.str_replace('.', $this->_escape_char.'.'.$this->_escape_char, $item).$this->_escape_char;
		}
		else
		{
			$str = $this->_escape_char.$item.$this->_escape_char;
		}

		// remove duplicates if the user already included the escape
		return preg_replace('/['.$this->_escape_char.']+/', $this->_escape_char, $str);
	}

	// --------------------------------------------------------------------

	/**
	 * From Tables
	 *
	 * This function implicitly groups FROM tables so there is no confusion
	 * about operator precedence in harmony with SQL standards
	 *
	 * @access	public
	 * @param	type
	 * @return	type
	 */
	function _from_tables($tables)
	{
		if ( ! is_array($tables))
		{
			$tables = array($tables);
		}

		return '('.implode(', ', $tables).')';
	}

	// --------------------------------------------------------------------

	/**
	 * Insert statement
	 *
	 * Generates a platform-specific insert string from the supplied data
	 *
	 * @access	public
	 * @param	string	the table name
	 * @param	array	the insert keys
	 * @param	array	the insert values
	 * @return	string
	 */
	function _insert($table, $keys, $values)
	{
		return "INSERT INTO ".$table." (\"".implode('", "', $keys)."\") VALUES (".implode(', ', $values).")";
	}

	// --------------------------------------------------------------------


	/**
	 * Replace statement
	 *
	 * Generates a platform-specific replace string from the supplied data
	 *
	 * @access	public
	 * @param	string	the table name
	 * @param	array	the insert keys
	 * @param	array	the insert values
	 * @return	string
	 */
	function _replace($table, $keys, $values)
	{
		return "REPLACE INTO ".$table." (\"".implode('", "', $keys)."\") VALUES (".implode(', ', $values).")";
	}

	// --------------------------------------------------------------------

	/**
	 * Insert_batch statement
	 *
	 * Generates a platform-specific insert string from the supplied data
	 *
	 * @access	public
	 * @param	string	the table name
	 * @param	array	the insert keys
	 * @param	array	the insert values
	 * @return	string
	 */
	function _insert_batch($table, $keys, $values)
	{
		return "INSERT INTO ".$table." (\"".implode('", "', $keys)."\") VALUES ".implode(', ', $values);
	}

	// --------------------------------------------------------------------


	/**
	 * Update statement
	 *
	 * Generates a platform-specific update string from the supplied data
	 *
	 * @access	public
	 * @param	string	the table name
	 * @param	array	the update data
	 * @param	array	the where clause
	 * @param	array	the orderby clause
	 * @param	array	the limit clause
	 * @return	string
	 */
	function _update($table, $values, $where, $orderby = array(), $limit = FALSE)
	{
		foreach ($values as $key => $val)
		{
			$valstr[] = sprintf('"%s" = %s', $key, $val);
		}

		$limit = ( ! $limit) ? '' : ' LIMIT '.$limit;

		$orderby = (count($orderby) >= 1)?' ORDER BY '.implode(", ", $orderby):'';

		$sql = "UPDATE ".$table." SET ".implode(', ', $valstr);

		$sql .= ($where != '' AND count($where) >=1) ? " WHERE ".implode(" ", $where) : '';

		$sql .= $orderby.$limit;

		return $sql;
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	}

	// --------------------------------------------------------------------

<<<<<<< HEAD

	/**
	 * Update_Batch statement
	 *
	 * Generates a platform-specific batch update string from the supplied data
	 *
	 * @access	public
	 * @param	string	the table name
	 * @param	array	the update data
	 * @param	array	the where clause
	 * @return	string
	 */
	function _update_batch($table, $values, $index, $where = NULL)
	{
		$ids = array();
		$where = ($where != '' AND count($where) >=1) ? implode(" ", $where).' AND ' : '';

		foreach ($values as $key => $val)
		{
			$ids[] = $val[$index];

			foreach (array_keys($val) as $field)
			{
				if ($field != $index)
				{
					$final[$field][] = 'WHEN '.$index.' = '.$val[$index].' THEN '.$val[$field];
				}
			}
		}

		$sql = "UPDATE ".$table." SET ";
		$cases = '';

		foreach ($final as $k => $v)
		{
			$cases .= $k.' = CASE '."\n";
			foreach ($v as $row)
			{
				$cases .= $row."\n";
			}

			$cases .= 'ELSE '.$k.' END, ';
		}

		$sql .= substr($cases, 0, -2);

		$sql .= ' WHERE '.$where.$index.' IN ('.implode(',', $ids).')';

		return $sql;
=======
=======
	/**
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	 * Returns an object with field data
	 *
	 * @param	string	$table
	 * @return	array
	 */
	public function field_data($table)
	{
		if (($query = $this->query('SHOW COLUMNS FROM '.$this->protect_identifiers($table, TRUE, NULL, FALSE))) === FALSE)
		{
			return FALSE;
		}
		$query = $query->result_object();

		$retval = array();
		for ($i = 0, $c = count($query); $i < $c; $i++)
		{
			$retval[$i]			= new stdClass();
			$retval[$i]->name		= $query[$i]->Field;

			sscanf($query[$i]->Type, '%[a-z](%d)',
				$retval[$i]->type,
				$retval[$i]->max_length
			);

			$retval[$i]->default		= $query[$i]->Default;
			$retval[$i]->primary_key	= (int) ($query[$i]->Key === 'PRI');
		}

		return $retval;
<<<<<<< HEAD
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	}

	// --------------------------------------------------------------------

<<<<<<< HEAD
<<<<<<< HEAD

	/**
	 * Truncate statement
	 *
	 * Generates a platform-specific truncate string from the supplied data
	 * If the database does not support the truncate() command
	 * This function maps to "DELETE FROM table"
	 *
	 * @access	public
	 * @param	string	the table name
	 * @return	string
	 */
	function _truncate($table)
	{
		return "TRUNCATE ".$table;
=======
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	/**
	 * Error
	 *
	 * Returns an array containing code and message of the last
	 * database error that has occured.
	 *
	 * @return	array
	 */
	public function error()
	{
		return array('code' => cubrid_errno($this->conn_id), 'message' => cubrid_error($this->conn_id));
<<<<<<< HEAD
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	}

	// --------------------------------------------------------------------

	/**
<<<<<<< HEAD
<<<<<<< HEAD
	 * Delete statement
	 *
	 * Generates a platform-specific delete string from the supplied data
	 *
	 * @access	public
	 * @param	string	the table name
	 * @param	array	the where clause
	 * @param	string	the limit clause
	 * @return	string
	 */
	function _delete($table, $where = array(), $like = array(), $limit = FALSE)
	{
		$conditions = '';

		if (count($where) > 0 OR count($like) > 0)
		{
			$conditions = "\nWHERE ";
			$conditions .= implode("\n", $this->ar_where);

			if (count($where) > 0 && count($like) > 0)
			{
				$conditions .= " AND ";
			}
			$conditions .= implode("\n", $like);
		}

		$limit = ( ! $limit) ? '' : ' LIMIT '.$limit;

		return "DELETE FROM ".$table.$conditions.$limit;
	}

	// --------------------------------------------------------------------

	/**
	 * Limit string
	 *
	 * Generates a platform-specific LIMIT clause
	 *
	 * @access	public
	 * @param	string	the sql query string
	 * @param	integer	the number of rows to limit the query to
	 * @param	integer	the offset value
	 * @return	string
	 */
	function _limit($sql, $limit, $offset)
	{
		if ($offset == 0)
		{
			$offset = '';
		}
		else
		{
			$offset .= ", ";
		}

		return $sql."LIMIT ".$offset.$limit;
=======
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	 * FROM tables
	 *
	 * Groups tables in FROM clauses if needed, so there is no confusion
	 * about operator precedence.
	 *
	 * @return	string
	 */
	protected function _from_tables()
	{
		if ( ! empty($this->qb_join) && count($this->qb_from) > 1)
		{
			return '('.implode(', ', $this->qb_from).')';
		}

		return implode(', ', $this->qb_from);
<<<<<<< HEAD
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	}

	// --------------------------------------------------------------------

	/**
	 * Close DB Connection
	 *
<<<<<<< HEAD
<<<<<<< HEAD
	 * @access	public
	 * @param	resource
	 * @return	void
	 */
	function _close($conn_id)
	{
		@cubrid_close($conn_id);
	}

}


/* End of file cubrid_driver.php */
/* Location: ./system/database/drivers/cubrid/cubrid_driver.php */
=======
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	 * @return	void
	 */
	protected function _close()
	{
		cubrid_close($this->conn_id);
	}

}
<<<<<<< HEAD
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
