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
 * @copyright   	Copyright (c) 2008 - 2014, EllisLab, Inc.
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
 * @since	Version 1.4.1
 * @filesource
 */
defined('BASEPATH') OR exit('No direct script access allowed');
<<<<<<< HEAD
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3

/**
 * oci8 Database Adapter Class
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
 * @subpackage  Drivers
 * @category	Database
 * @author		EllisLab Dev Team
<<<<<<< HEAD
<<<<<<< HEAD
 * @link		http://codeigniter.com/user_guide/database/
=======
 * @link		https://codeigniter.com/user_guide/database/
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
 * @link		https://codeigniter.com/user_guide/database/
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
 */

/**
 * oci8 Database Adapter Class
 *
 * This is a modification of the DB_driver class to
 * permit access to oracle databases
 *
 * @author	  Kelly McArdle
<<<<<<< HEAD
<<<<<<< HEAD
 *
 */

class CI_DB_oci8_driver extends CI_DB {

	var $dbdriver = 'oci8';

	// The character used for excaping
	var $_escape_char = '"';

	// clause and character used for LIKE escape sequences
	var $_like_escape_str = " escape '%s' ";
	var $_like_escape_chr = '!';

	/**
	 * The syntax to count rows is slightly different across different
	 * database engines, so this string appears in each driver and is
	 * used for the count_all() and count_all_results() functions.
	 */
	var $_count_string = "SELECT COUNT(1) AS ";
	var $_random_keyword = ' ASC'; // not currently supported

	// Set "auto commit" by default
	var $_commit = OCI_COMMIT_ON_SUCCESS;

	// need to track statement id and cursor id
	var $stmt_id;
	var $curs_id;

	// if we use a limit, we will add a field that will
	// throw off num_fields later
	var $limit_used;

	/**
	 * Non-persistent database connection
	 *
	 * @access  private called by the base class
	 * @return  resource
	 */
	public function db_connect()
	{
		return @oci_connect($this->username, $this->password, $this->hostname, $this->char_set);
	}
=======
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
 */
class CI_DB_oci8_driver extends CI_DB {

	/**
	 * Database driver
	 *
	 * @var	string
	 */
	public $dbdriver = 'oci8';

	/**
	 * Statement ID
	 *
	 * @var	resource
	 */
	public $stmt_id;

	/**
	 * Cursor ID
	 *
	 * @var	resource
	 */
	public $curs_id;

	/**
	 * Commit mode flag
	 *
	 * @var	int
	 */
	public $commit_mode = OCI_COMMIT_ON_SUCCESS;

	/**
	 * Limit used flag
	 *
	 * If we use LIMIT, we'll add a field that will
	 * throw off num_fields later.
	 *
	 * @var	bool
	 */
	public $limit_used;
<<<<<<< HEAD
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd

	// --------------------------------------------------------------------

	/**
<<<<<<< HEAD
	 * Persistent database connection
	 *
	 * @access  private called by the base class
	 * @return  resource
	 */
	public function db_pconnect()
	{
		return @oci_pconnect($this->username, $this->password, $this->hostname, $this->char_set);
	}
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3

	// --------------------------------------------------------------------

	/**
<<<<<<< HEAD
	 * Reconnect
	 *
	 * Keep / reestablish the db connection if no queries have been
	 * sent for a length of time exceeding the server's idle timeout
	 *
	 * @access	public
	 * @return	void
	 */
	public function reconnect()
	{
		// not implemented in oracle
		return;
	}

	// --------------------------------------------------------------------

	/**
	 * Select the database
	 *
	 * @access  private called by the base class
	 * @return  resource
	 */
	public function db_select()
	{
		// Not in Oracle - schemas are actually usernames
		return TRUE;
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
	public function db_set_charset($charset, $collation)
	{
		// @todo - add support if needed
		return TRUE;
	}
=======
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	 * Reset $stmt_id flag
	 *
	 * Used by stored_procedure() to prevent _execute() from
	 * re-setting the statement ID.
	 */
	protected $_reset_stmt_id = TRUE;

	/**
	 * List of reserved identifiers
	 *
	 * Identifiers that must NOT be escaped.
	 *
	 * @var	string[]
	 */
	protected $_reserved_identifiers = array('*', 'rownum');

	/**
	 * ORDER BY random keyword
	 *
	 * @var	array
	 */
	protected $_random_keyword = array('ASC', 'ASC'); // not currently supported

	/**
	 * COUNT string
	 *
	 * @used-by	CI_DB_driver::count_all()
	 * @used-by	CI_DB_query_builder::count_all_results()
	 *
	 * @var	string
	 */
	protected $_count_string = 'SELECT COUNT(1) AS ';
<<<<<<< HEAD
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3

	// --------------------------------------------------------------------

	/**
<<<<<<< HEAD
<<<<<<< HEAD
	 * Version number query string
	 *
	 * @access  protected
	 * @return  string
	 */
	protected function _version()
	{
		return oci_server_version($this->conn_id);
=======
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	 * Class constructor
	 *
	 * @param	array	$params
	 * @return	void
	 */
	public function __construct($params)
	{
		parent::__construct($params);

		$valid_dsns = array(
			'tns'	=> '/^\(DESCRIPTION=(\(.+\)){2,}\)$/', // TNS
			// Easy Connect string (Oracle 10g+)
			'ec'	=> '/^(\/\/)?[a-z0-9.:_-]+(:[1-9][0-9]{0,4})?(\/[a-z0-9$_]+)?(:[^\/])?(\/[a-z0-9$_]+)?$/i',
			'in'	=> '/^[a-z0-9$_]+$/i' // Instance name (defined in tnsnames.ora)
		);

		/* Space characters don't have any effect when actually
		 * connecting, but can be a hassle while validating the DSN.
		 */
		$this->dsn = str_replace(array("\n", "\r", "\t", ' '), '', $this->dsn);

		if ($this->dsn !== '')
		{
			foreach ($valid_dsns as $regexp)
			{
				if (preg_match($regexp, $this->dsn))
				{
					return;
				}
			}
		}

		// Legacy support for TNS in the hostname configuration field
		$this->hostname = str_replace(array("\n", "\r", "\t", ' '), '', $this->hostname);
		if (preg_match($valid_dsns['tns'], $this->hostname))
		{
			$this->dsn = $this->hostname;
			return;
		}
		elseif ($this->hostname !== '' && strpos($this->hostname, '/') === FALSE && strpos($this->hostname, ':') === FALSE
			&& (( ! empty($this->port) && ctype_digit($this->port)) OR $this->database !== ''))
		{
			/* If the hostname field isn't empty, doesn't contain
			 * ':' and/or '/' and if port and/or database aren't
			 * empty, then the hostname field is most likely indeed
			 * just a hostname. Therefore we'll try and build an
			 * Easy Connect string from these 3 settings, assuming
			 * that the database field is a service name.
			 */
			$this->dsn = $this->hostname
				.(( ! empty($this->port) && ctype_digit($this->port)) ? ':'.$this->port : '')
				.($this->database !== '' ? '/'.ltrim($this->database, '/') : '');

			if (preg_match($valid_dsns['ec'], $this->dsn))
			{
				return;
			}
		}

		/* At this point, we can only try and validate the hostname and
		 * database fields separately as DSNs.
		 */
		if (preg_match($valid_dsns['ec'], $this->hostname) OR preg_match($valid_dsns['in'], $this->hostname))
		{
			$this->dsn = $this->hostname;
			return;
		}

		$this->database = str_replace(array("\n", "\r", "\t", ' '), '', $this->database);
		foreach ($valid_dsns as $regexp)
		{
			if (preg_match($regexp, $this->database))
			{
				return;
			}
		}

		/* Well - OK, an empty string should work as well.
		 * PHP will try to use environment variables to
		 * determine which Oracle instance to connect to.
		 */
		$this->dsn = '';
<<<<<<< HEAD
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	}

	// --------------------------------------------------------------------

	/**
<<<<<<< HEAD
<<<<<<< HEAD
	 * Execute the query
	 *
	 * @access  protected  called by the base class
	 * @param   string  an SQL query
	 * @return  resource
	 */
	protected function _execute($sql)
	{
		// oracle must parse the query before it is run. All of the actions with
		// the query are based on the statement id returned by ociparse
		$this->stmt_id = FALSE;
		$this->_set_stmt_id($sql);
		oci_set_prefetch($this->stmt_id, 1000);
		return @oci_execute($this->stmt_id, $this->_commit);
	}

	/**
	 * Generate a statement ID
	 *
	 * @access  private
	 * @param   string  an SQL query
	 * @return  none
	 */
	private function _set_stmt_id($sql)
	{
		if ( ! is_resource($this->stmt_id))
		{
			$this->stmt_id = oci_parse($this->conn_id, $this->_prep_query($sql));
		}
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
		$func = ($persistent === TRUE) ? 'oci_pconnect' : 'oci_connect';
		return empty($this->char_set)
			? $func($this->username, $this->password, $this->dsn)
			: $func($this->username, $this->password, $this->dsn, $this->char_set);
	}

	// --------------------------------------------------------------------

	/**
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

		if ( ! $this->conn_id OR ($version_string = oci_server_version($this->conn_id)) === FALSE)
		{
			return FALSE;
		}
		elseif (preg_match('#Release\s(\d+(?:\.\d+)+)#', $version_string, $match))
		{
			return $this->data_cache['version'] = $match[1];
		}

		return FALSE;
<<<<<<< HEAD
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	}

	// --------------------------------------------------------------------

	/**
<<<<<<< HEAD
<<<<<<< HEAD
	 * Prep the query
	 *
	 * If needed, each database adapter can prep the query string
	 *
	 * @access  private called by execute()
	 * @param   string  an SQL query
	 * @return  string
	 */
	private function _prep_query($sql)
	{
		return $sql;
=======
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	 * Execute the query
	 *
	 * @param	string	$sql	an SQL query
	 * @return	resource
	 */
	protected function _execute($sql)
	{
		/* Oracle must parse the query before it is run. All of the actions with
		 * the query are based on the statement id returned by oci_parse().
		 */
		if ($this->_reset_stmt_id === TRUE)
		{
			$this->stmt_id = oci_parse($this->conn_id, $sql);
		}

		oci_set_prefetch($this->stmt_id, 1000);
		return oci_execute($this->stmt_id, $this->commit_mode);
<<<<<<< HEAD
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	}

	// --------------------------------------------------------------------

	/**
<<<<<<< HEAD
<<<<<<< HEAD
	 * getCursor.  Returns a cursor from the datbase
	 *
	 * @access  public
	 * @return  cursor id
	 */
	public function get_cursor()
	{
		$this->curs_id = oci_new_cursor($this->conn_id);
		return $this->curs_id;
=======
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	 * Get cursor. Returns a cursor from the database
	 *
	 * @return	resource
	 */
	public function get_cursor()
	{
		return $this->curs_id = oci_new_cursor($this->conn_id);
<<<<<<< HEAD
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	}

	// --------------------------------------------------------------------

	/**
	 * Stored Procedure.  Executes a stored procedure
	 *
<<<<<<< HEAD
<<<<<<< HEAD
	 * @access  public
	 * @param   package	 package stored procedure is in
	 * @param   procedure   stored procedure to execute
	 * @param   params	  array of parameters
	 * @return  array
	 *
	 * params array keys
	 *
	 * KEY	  OPTIONAL	NOTES
	 * name		no		the name of the parameter should be in :<param_name> format
	 * value	no		the value of the parameter.  If this is an OUT or IN OUT parameter,
	 *					this should be a reference to a variable
	 * type		yes		the type of the parameter
	 * length	yes		the max size of the parameter
	 */
	public function stored_procedure($package, $procedure, $params)
	{
		if ($package == '' OR $procedure == '' OR ! is_array($params))
		{
			if ($this->db_debug)
			{
				log_message('error', 'Invalid query: '.$package.'.'.$procedure);
				return $this->display_error('db_invalid_query');
			}
			return FALSE;
		}

		// build the query string
		$sql = "begin $package.$procedure(";
=======
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	 * @param	string	package name in which the stored procedure is in
	 * @param	string	stored procedure name to execute
	 * @param	array	parameters
	 * @return	mixed
	 *
	 * params array keys
	 *
	 * KEY      OPTIONAL  NOTES
	 * name     no        the name of the parameter should be in :<param_name> format
	 * value    no        the value of the parameter.  If this is an OUT or IN OUT parameter,
	 *                    this should be a reference to a variable
	 * type     yes       the type of the parameter
	 * length   yes       the max size of the parameter
	 */
	public function stored_procedure($package, $procedure, array $params)
	{
		if ($package === '' OR $procedure === '')
		{
			log_message('error', 'Invalid query: '.$package.'.'.$procedure);
			return ($this->db_debug) ? $this->display_error('db_invalid_query') : FALSE;
		}

		// Build the query string
		$sql = 'BEGIN '.$package.'.'.$procedure.'(';
<<<<<<< HEAD
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3

		$have_cursor = FALSE;
		foreach ($params as $param)
		{
<<<<<<< HEAD
<<<<<<< HEAD
			$sql .= $param['name'] . ",";

			if (array_key_exists('type', $param) && ($param['type'] === OCI_B_CURSOR))
=======
			$sql .= $param['name'].',';

			if (isset($param['type']) && $param['type'] === OCI_B_CURSOR)
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
			$sql .= $param['name'].',';

			if (isset($param['type']) && $param['type'] === OCI_B_CURSOR)
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
			{
				$have_cursor = TRUE;
			}
		}
<<<<<<< HEAD
<<<<<<< HEAD
		$sql = trim($sql, ",") . "); end;";

		$this->stmt_id = FALSE;
		$this->_set_stmt_id($sql);
		$this->_bind_params($params);
		$this->query($sql, FALSE, $have_cursor);
=======
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
		$sql = trim($sql, ',').'); END;';

		$this->_reset_stmt_id = FALSE;
		$this->stmt_id = oci_parse($this->conn_id, $sql);
		$this->_bind_params($params);
		$result = $this->query($sql, FALSE, $have_cursor);
		$this->_reset_stmt_id = TRUE;
		return $result;
<<<<<<< HEAD
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	}

	// --------------------------------------------------------------------

	/**
	 * Bind parameters
	 *
<<<<<<< HEAD
<<<<<<< HEAD
	 * @access  private
	 * @return  none
	 */
	private function _bind_params($params)
=======
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	 * @param	array	$params
	 * @return	void
	 */
	protected function _bind_params($params)
<<<<<<< HEAD
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	{
		if ( ! is_array($params) OR ! is_resource($this->stmt_id))
		{
			return;
		}

		foreach ($params as $param)
		{
			foreach (array('name', 'value', 'type', 'length') as $val)
			{
				if ( ! isset($param[$val]))
				{
					$param[$val] = '';
				}
			}

			oci_bind_by_name($this->stmt_id, $param['name'], $param['value'], $param['length'], $param['type']);
		}
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
	public function trans_begin($test_mode = FALSE)
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

		$this->_commit = OCI_DEFAULT;
=======
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	 * @return	bool
	 */
	protected function _trans_begin()
	{
<<<<<<< HEAD
		$this->commit_mode = is_php('5.3.2') ? OCI_NO_AUTO_COMMIT : OCI_DEFAULT;
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
		$this->commit_mode = OCI_NO_AUTO_COMMIT;
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
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
	public function trans_commit()
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

		$ret = oci_commit($this->conn_id);
		$this->_commit = OCI_COMMIT_ON_SUCCESS;
		return $ret;
=======
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	 * @return	bool
	 */
	protected function _trans_commit()
	{
		$this->commit_mode = OCI_COMMIT_ON_SUCCESS;

		return oci_commit($this->conn_id);
<<<<<<< HEAD
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
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
	public function trans_rollback()
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

		$ret = oci_rollback($this->conn_id);
		$this->_commit = OCI_COMMIT_ON_SUCCESS;
		return $ret;
	}

	// --------------------------------------------------------------------

	/**
	 * Escape String
	 *
	 * @access  public
	 * @param   string
	 * @param	bool	whether or not the string will be used in a LIKE condition
	 * @return  string
	 */
	public function escape_str($str, $like = FALSE)
	{
		if (is_array($str))
		{
			foreach ($str as $key => $val)
			{
				$str[$key] = $this->escape_str($val, $like);
			}

			return $str;
		}

		$str = remove_invisible_characters($str);

		// escape LIKE condition wildcards
		if ($like === TRUE)
		{
			$str = str_replace(	array('%', '_', $this->_like_escape_chr),
								array($this->_like_escape_chr.'%', $this->_like_escape_chr.'_', $this->_like_escape_chr.$this->_like_escape_chr),
								$str);
		}

		return $str;
=======
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	 * @return	bool
	 */
	protected function _trans_rollback()
	{
		$this->commit_mode = OCI_COMMIT_ON_SUCCESS;
		return oci_rollback($this->conn_id);
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
	 * @access  public
	 * @return  integer
	 */
	public function affected_rows()
	{
		return @oci_num_rows($this->stmt_id);
=======
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	 * @return	int
	 */
	public function affected_rows()
	{
		return oci_num_rows($this->stmt_id);
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
	 * @access  public
	 * @return  integer
=======
	 * @return	int
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
	 * @return	int
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	 */
	public function insert_id()
	{
		// not supported in oracle
		return $this->display_error('db_unsupported_function');
	}

	// --------------------------------------------------------------------

	/**
<<<<<<< HEAD
<<<<<<< HEAD
	 * "Count All" query
	 *
	 * Generates a platform-specific query string that counts all records in
	 * the specified database
	 *
	 * @access  public
	 * @param   string
	 * @return  string
	 */
	public function count_all($table = '')
	{
		if ($table == '')
		{
			return 0;
		}

		$query = $this->query($this->_count_string . $this->_protect_identifiers('numrows') . " FROM " . $this->_protect_identifiers($table, TRUE, NULL, FALSE));

		if ($query == FALSE)
		{
			return 0;
		}

		$row = $query->row();
		$this->_reset_select();
		return (int) $row->numrows;
	}

	// --------------------------------------------------------------------

	/**
=======
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	 * Show table query
	 *
	 * Generates a platform-specific query string so that the table names can be fetched
	 *
<<<<<<< HEAD
<<<<<<< HEAD
	 * @access	protected
	 * @param	boolean
=======
	 * @param	bool	$prefix_limit
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
	 * @param	bool	$prefix_limit
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	 * @return	string
	 */
	protected function _list_tables($prefix_limit = FALSE)
	{
<<<<<<< HEAD
<<<<<<< HEAD
		$sql = "SELECT TABLE_NAME FROM ALL_TABLES";

		if ($prefix_limit !== FALSE AND $this->dbprefix != '')
		{
			$sql .= " WHERE TABLE_NAME LIKE '".$this->escape_like_str($this->dbprefix)."%' ".sprintf($this->_like_escape_str, $this->_like_escape_chr);
=======
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
		$sql = 'SELECT "TABLE_NAME" FROM "ALL_TABLES"';

		if ($prefix_limit !== FALSE && $this->dbprefix !== '')
		{
			return $sql.' WHERE "TABLE_NAME" LIKE \''.$this->escape_like_str($this->dbprefix)."%' "
				.sprintf($this->_like_escape_str, $this->_like_escape_chr);
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
	 * @access  protected
	 * @param   string  the table name
	 * @return  string
	 */
	protected function _list_columns($table = '')
	{
		return "SELECT COLUMN_NAME FROM all_tab_columns WHERE table_name = '$table'";
	}

	// --------------------------------------------------------------------

	/**
	 * Field data query
	 *
	 * Generates a platform-specific query so that the column data can be retrieved
	 *
	 * @access  public
	 * @param   string  the table name
	 * @return  object
	 */
	protected function _field_data($table)
	{
		return "SELECT * FROM ".$table." where rownum = 1";
	}

	// --------------------------------------------------------------------

	/**
	 * The error message string
	 *
	 * @access  protected
	 * @return  string
	 */
	protected function _error_message()
	{
		// If the error was during connection, no conn_id should be passed
		$error = is_resource($this->conn_id) ? oci_error($this->conn_id) : oci_error();
		return $error['message'];
=======
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	 * @param	string	$table
	 * @return	string
	 */
	protected function _list_columns($table = '')
	{
		if (strpos($table, '.') !== FALSE)
		{
			sscanf($table, '%[^.].%s', $owner, $table);
		}
		else
		{
			$owner = $this->username;
		}

		return 'SELECT COLUMN_NAME FROM ALL_TAB_COLUMNS
			WHERE UPPER(OWNER) = '.$this->escape(strtoupper($owner)).'
				AND UPPER(TABLE_NAME) = '.$this->escape(strtoupper($table));
<<<<<<< HEAD
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
	}

	// --------------------------------------------------------------------

	/**
<<<<<<< HEAD
	 * The error message number
	 *
	 * @access  protected
	 * @return  integer
	 */
	protected function _error_number()
	{
		// Same as _error_message()
		$error = is_resource($this->conn_id) ? oci_error($this->conn_id) : oci_error();
		return $error['code'];
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	}

	// --------------------------------------------------------------------

	/**
<<<<<<< HEAD
	 * Escape the SQL Identifiers
	 *
	 * This function escapes column and table names
	 *
	 * @access	protected
	 * @param	string
	 * @return	string
	 */
	protected function _escape_identifiers($item)
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
=======
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	 * Returns an object with field data
	 *
	 * @param	string	$table
	 * @return	array
	 */
	public function field_data($table)
	{
		if (strpos($table, '.') !== FALSE)
		{
			sscanf($table, '%[^.].%s', $owner, $table);
		}
		else
		{
			$owner = $this->username;
		}

		$sql = 'SELECT COLUMN_NAME, DATA_TYPE, CHAR_LENGTH, DATA_PRECISION, DATA_LENGTH, DATA_DEFAULT, NULLABLE
			FROM ALL_TAB_COLUMNS
			WHERE UPPER(OWNER) = '.$this->escape(strtoupper($owner)).'
				AND UPPER(TABLE_NAME) = '.$this->escape(strtoupper($table));

		if (($query = $this->query($sql)) === FALSE)
		{
			return FALSE;
		}
		$query = $query->result_object();

		$retval = array();
		for ($i = 0, $c = count($query); $i < $c; $i++)
		{
			$retval[$i]			= new stdClass();
			$retval[$i]->name		= $query[$i]->COLUMN_NAME;
			$retval[$i]->type		= $query[$i]->DATA_TYPE;

			$length = ($query[$i]->CHAR_LENGTH > 0)
				? $query[$i]->CHAR_LENGTH : $query[$i]->DATA_PRECISION;
			if ($length === NULL)
			{
				$length = $query[$i]->DATA_LENGTH;
			}
			$retval[$i]->max_length		= $length;

			$default = $query[$i]->DATA_DEFAULT;
			if ($default === NULL && $query[$i]->NULLABLE === 'N')
			{
				$default = '';
			}
			$retval[$i]->default = $default;
		}

		return $retval;
<<<<<<< HEAD
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
	}

	// --------------------------------------------------------------------

	/**
<<<<<<< HEAD
	 * From Tables
	 *
	 * This function implicitly groups FROM tables so there is no confusion
	 * about operator precedence in harmony with SQL standards
	 *
	 * @access	protected
	 * @param	type
	 * @return	type
	 */
	protected function _from_tables($tables)
	{
		if ( ! is_array($tables))
		{
			$tables = array($tables);
		}

		return implode(', ', $tables);
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	}

	// --------------------------------------------------------------------

	/**
<<<<<<< HEAD
	 * Insert statement
	 *
	 * Generates a platform-specific insert string from the supplied data
	 *
	 * @access  public
	 * @param   string  the table name
	 * @param   array   the insert keys
	 * @param   array   the insert values
	 * @return  string
	 */
	protected function _insert($table, $keys, $values)
	{
		return "INSERT INTO ".$table." (".implode(', ', $keys).") VALUES (".implode(', ', $values).")";
=======
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	 * Error
	 *
	 * Returns an array containing code and message of the last
	 * database error that has occured.
	 *
	 * @return	array
	 */
	public function error()
	{
		// oci_error() returns an array that already contains
		// 'code' and 'message' keys, but it can return false
		// if there was no error ....
		if (is_resource($this->curs_id))
		{
			$error = oci_error($this->curs_id);
		}
		elseif (is_resource($this->stmt_id))
		{
			$error = oci_error($this->stmt_id);
		}
		elseif (is_resource($this->conn_id))
		{
			$error = oci_error($this->conn_id);
		}
		else
		{
			$error = oci_error();
		}

		return is_array($error)
			? $error
			: array('code' => '', 'message' => '');
<<<<<<< HEAD
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	}

	// --------------------------------------------------------------------

	/**
<<<<<<< HEAD
<<<<<<< HEAD
	 * Insert_batch statement
	 *
	 * Generates a platform-specific insert string from the supplied data
	 *
	 * @access      protected
	 * @param       string  the table name
	 * @param       array   the insert keys
	 * @param       array   the insert values
	 * @return      string
=======
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	 * Insert batch statement
	 *
	 * Generates a platform-specific insert string from the supplied data
	 *
	 * @param	string	$table	Table name
	 * @param	array	$keys	INSERT keys
	 * @param 	array	$values	INSERT values
	 * @return	string
<<<<<<< HEAD
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	 */
	protected function _insert_batch($table, $keys, $values)
	{
		$keys = implode(', ', $keys);
		$sql = "INSERT ALL\n";

		for ($i = 0, $c = count($values); $i < $c; $i++)
		{
<<<<<<< HEAD
<<<<<<< HEAD
			$sql .= '	INTO ' . $table . ' (' . $keys . ') VALUES ' . $values[$i] . "\n";
		}

		$sql .= 'SELECT * FROM dual';

		return $sql;
	}

	// --------------------------------------------------------------------

	/**
	 * Update statement
	 *
	 * Generates a platform-specific update string from the supplied data
	 *
	 * @access	protected
	 * @param	string	the table name
	 * @param	array	the update data
	 * @param	array	the where clause
	 * @param	array	the orderby clause
	 * @param	array	the limit clause
	 * @return	string
	 */
	protected function _update($table, $values, $where, $orderby = array(), $limit = FALSE)
	{
		foreach ($values as $key => $val)
		{
			$valstr[] = $key." = ".$val;
		}

		$limit = ( ! $limit) ? '' : ' LIMIT '.$limit;

		$orderby = (count($orderby) >= 1)?' ORDER BY '.implode(", ", $orderby):'';

		$sql = "UPDATE ".$table." SET ".implode(', ', $valstr);

		$sql .= ($where != '' AND count($where) >=1) ? " WHERE ".implode(" ", $where) : '';

		$sql .= $orderby.$limit;

		return $sql;
=======
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
			$sql .= '	INTO '.$table.' ('.$keys.') VALUES '.$values[$i]."\n";
		}

		return $sql.'SELECT * FROM dual';
<<<<<<< HEAD
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	}

	// --------------------------------------------------------------------

	/**
	 * Truncate statement
	 *
	 * Generates a platform-specific truncate string from the supplied data
<<<<<<< HEAD
<<<<<<< HEAD
	 * If the database does not support the truncate() command
	 * This function maps to "DELETE FROM table"
	 *
	 * @access	protected
	 * @param	string	the table name
=======
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	 *
	 * If the database does not support the TRUNCATE statement,
	 * then this method maps to 'DELETE FROM table'
	 *
	 * @param	string	$table
<<<<<<< HEAD
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	 * @return	string
	 */
	protected function _truncate($table)
	{
<<<<<<< HEAD
<<<<<<< HEAD
		return "TRUNCATE TABLE ".$table;
=======
		return 'TRUNCATE TABLE '.$table;
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
		return 'TRUNCATE TABLE '.$table;
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	}

	// --------------------------------------------------------------------

	/**
	 * Delete statement
	 *
	 * Generates a platform-specific delete string from the supplied data
	 *
<<<<<<< HEAD
<<<<<<< HEAD
	 * @access	protected
	 * @param	string	the table name
	 * @param	array	the where clause
	 * @param	string	the limit clause
	 * @return	string
	 */
	protected function _delete($table, $where = array(), $like = array(), $limit = FALSE)
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
=======
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	 * @param	string	$table
	 * @return	string
	 */
	protected function _delete($table)
	{
		if ($this->qb_limit)
		{
			$this->where('rownum <= ',$this->qb_limit, FALSE);
			$this->qb_limit = FALSE;
		}

		return parent::_delete($table);
<<<<<<< HEAD
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	}

	// --------------------------------------------------------------------

	/**
<<<<<<< HEAD
<<<<<<< HEAD
	 * Limit string
	 *
	 * Generates a platform-specific LIMIT clause
	 *
	 * @access  protected
	 * @param   string  the sql query string
	 * @param   integer the number of rows to limit the query to
	 * @param   integer the offset value
	 * @return  string
	 */
	protected function _limit($sql, $limit, $offset)
	{
		$limit = $offset + $limit;
		$newsql = "SELECT * FROM (select inner_query.*, rownum rnum FROM ($sql) inner_query WHERE rownum < $limit)";

		if ($offset != 0)
		{
			$newsql .= " WHERE rnum >= $offset";
		}

		// remember that we used limits
		$this->limit_used = TRUE;

		return $newsql;
=======
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	 * LIMIT
	 *
	 * Generates a platform-specific LIMIT clause
	 *
	 * @param	string	$sql	SQL Query
	 * @return	string
	 */
	protected function _limit($sql)
	{
		if (version_compare($this->version(), '12.1', '>='))
		{
			// OFFSET-FETCH can be used only with the ORDER BY clause
			empty($this->qb_orderby) && $sql .= ' ORDER BY 1';

			return $sql.' OFFSET '.(int) $this->qb_offset.' ROWS FETCH NEXT '.$this->qb_limit.' ROWS ONLY';
		}

		$this->limit_used = TRUE;
		return 'SELECT * FROM (SELECT inner_query.*, rownum rnum FROM ('.$sql.') inner_query WHERE rownum < '.($this->qb_offset + $this->qb_limit + 1).')'
			.($this->qb_offset ? ' WHERE rnum >= '.($this->qb_offset + 1) : '');
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
	 * @access  protected
	 * @param   resource
	 * @return  void
	 */
	protected function _close($conn_id)
	{
		@oci_close($conn_id);
	}


}



/* End of file oci8_driver.php */
/* Location: ./system/database/drivers/oci8/oci8_driver.php */
=======
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	 * @return	void
	 */
	protected function _close()
	{
		oci_close($this->conn_id);
	}

}
<<<<<<< HEAD
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
