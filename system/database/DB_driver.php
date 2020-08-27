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
 * Database Driver Class
 *
 * This is the platform-independent base DB implementation class.
 * This class will not be called directly. Rather, the adapter
 * class for the specific database will extend and instantiate it.
 *
 * @package		CodeIgniter
 * @subpackage	Drivers
 * @category	Database
 * @author		EllisLab Dev Team
<<<<<<< HEAD
 * @link		http://codeigniter.com/user_guide/database/
 */
class CI_DB_driver {

	var $username;
	var $password;
	var $hostname;
	var $database;
	var $dbdriver		= 'mysql';
	var $dbprefix		= '';
	var $char_set		= 'utf8';
	var $dbcollat		= 'utf8_general_ci';
	var $autoinit		= TRUE; // Whether to automatically initialize the DB
	var $swap_pre		= '';
	var $port			= '';
	var $pconnect		= FALSE;
	var $conn_id		= FALSE;
	var $result_id		= FALSE;
	var $db_debug		= FALSE;
	var $benchmark		= 0;
	var $query_count	= 0;
	var $bind_marker	= '?';
	var $save_queries	= TRUE;
	var $queries		= array();
	var $query_times	= array();
	var $data_cache		= array();
	var $trans_enabled	= TRUE;
	var $trans_strict	= TRUE;
	var $_trans_depth	= 0;
	var $_trans_status	= TRUE; // Used with transactions to determine if a rollback should occur
	var $cache_on		= FALSE;
	var $cachedir		= '';
	var $cache_autodel	= FALSE;
	var $CACHE; // The cache class object

	// Private variables
	var $_protect_identifiers	= TRUE;
	var $_reserved_identifiers	= array('*'); // Identifiers that should NOT be escaped

	// These are use with Oracle
	var $stmt_id;
	var $curs_id;
	var $limit_used;



	/**
	 * Constructor.  Accepts one parameter containing the database
	 * connection settings.
	 *
	 * @param array
	 */
	function __construct($params)
=======
 * @link		https://codeigniter.com/user_guide/database/
 */
abstract class CI_DB_driver {

	/**
	 * Data Source Name / Connect string
	 *
	 * @var	string
	 */
	public $dsn;

	/**
	 * Username
	 *
	 * @var	string
	 */
	public $username;

	/**
	 * Password
	 *
	 * @var	string
	 */
	public $password;

	/**
	 * Hostname
	 *
	 * @var	string
	 */
	public $hostname;

	/**
	 * Database name
	 *
	 * @var	string
	 */
	public $database;

	/**
	 * Database driver
	 *
	 * @var	string
	 */
	public $dbdriver		= 'mysqli';

	/**
	 * Sub-driver
	 *
	 * @used-by	CI_DB_pdo_driver
	 * @var	string
	 */
	public $subdriver;

	/**
	 * Table prefix
	 *
	 * @var	string
	 */
	public $dbprefix		= '';

	/**
	 * Character set
	 *
	 * @var	string
	 */
	public $char_set		= 'utf8';

	/**
	 * Collation
	 *
	 * @var	string
	 */
	public $dbcollat		= 'utf8_general_ci';

	/**
	 * Encryption flag/data
	 *
	 * @var	mixed
	 */
	public $encrypt			= FALSE;

	/**
	 * Swap Prefix
	 *
	 * @var	string
	 */
	public $swap_pre		= '';

	/**
	 * Database port
	 *
	 * @var	int
	 */
	public $port			= '';

	/**
	 * Persistent connection flag
	 *
	 * @var	bool
	 */
	public $pconnect		= FALSE;

	/**
	 * Connection ID
	 *
	 * @var	object|resource
	 */
	public $conn_id			= FALSE;

	/**
	 * Result ID
	 *
	 * @var	object|resource
	 */
	public $result_id		= FALSE;

	/**
	 * Debug flag
	 *
	 * Whether to display error messages.
	 *
	 * @var	bool
	 */
	public $db_debug		= FALSE;

	/**
	 * Benchmark time
	 *
	 * @var	int
	 */
	public $benchmark		= 0;

	/**
	 * Executed queries count
	 *
	 * @var	int
	 */
	public $query_count		= 0;

	/**
	 * Bind marker
	 *
	 * Character used to identify values in a prepared statement.
	 *
	 * @var	string
	 */
	public $bind_marker		= '?';

	/**
	 * Save queries flag
	 *
	 * Whether to keep an in-memory history of queries for debugging purposes.
	 *
	 * @var	bool
	 */
	public $save_queries		= TRUE;

	/**
	 * Queries list
	 *
	 * @see	CI_DB_driver::$save_queries
	 * @var	string[]
	 */
	public $queries			= array();

	/**
	 * Query times
	 *
	 * A list of times that queries took to execute.
	 *
	 * @var	array
	 */
	public $query_times		= array();

	/**
	 * Data cache
	 *
	 * An internal generic value cache.
	 *
	 * @var	array
	 */
	public $data_cache		= array();

	/**
	 * Transaction enabled flag
	 *
	 * @var	bool
	 */
	public $trans_enabled		= TRUE;

	/**
	 * Strict transaction mode flag
	 *
	 * @var	bool
	 */
	public $trans_strict		= TRUE;

	/**
	 * Transaction depth level
	 *
	 * @var	int
	 */
	protected $_trans_depth		= 0;

	/**
	 * Transaction status flag
	 *
	 * Used with transactions to determine if a rollback should occur.
	 *
	 * @var	bool
	 */
	protected $_trans_status	= TRUE;

	/**
	 * Transaction failure flag
	 *
	 * Used with transactions to determine if a transaction has failed.
	 *
	 * @var	bool
	 */
	protected $_trans_failure	= FALSE;

	/**
	 * Cache On flag
	 *
	 * @var	bool
	 */
	public $cache_on		= FALSE;

	/**
	 * Cache directory path
	 *
	 * @var	bool
	 */
	public $cachedir		= '';

	/**
	 * Cache auto-delete flag
	 *
	 * @var	bool
	 */
	public $cache_autodel		= FALSE;

	/**
	 * DB Cache object
	 *
	 * @see	CI_DB_cache
	 * @var	object
	 */
	public $CACHE;

	/**
	 * Protect identifiers flag
	 *
	 * @var	bool
	 */
	protected $_protect_identifiers		= TRUE;

	/**
	 * List of reserved identifiers
	 *
	 * Identifiers that must NOT be escaped.
	 *
	 * @var	string[]
	 */
	protected $_reserved_identifiers	= array('*');

	/**
	 * Identifier escape character
	 *
	 * @var	string
	 */
	protected $_escape_char = '"';

	/**
	 * ESCAPE statement string
	 *
	 * @var	string
	 */
	protected $_like_escape_str = " ESCAPE '%s' ";

	/**
	 * ESCAPE character
	 *
	 * @var	string
	 */
	protected $_like_escape_chr = '!';

	/**
	 * ORDER BY random keyword
	 *
	 * @var	array
	 */
	protected $_random_keyword = array('RAND()', 'RAND(%d)');

	/**
	 * COUNT string
	 *
	 * @used-by	CI_DB_driver::count_all()
	 * @used-by	CI_DB_query_builder::count_all_results()
	 *
	 * @var	string
	 */
	protected $_count_string = 'SELECT COUNT(*) AS ';

	// --------------------------------------------------------------------

	/**
	 * Class constructor
	 *
	 * @param	array	$params
	 * @return	void
	 */
	public function __construct($params)
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
	{
		if (is_array($params))
		{
			foreach ($params as $key => $val)
			{
				$this->$key = $val;
			}
		}

<<<<<<< HEAD
		log_message('debug', 'Database Driver Class Initialized');
=======
		log_message('info', 'Database Driver Class Initialized');
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
	}

	// --------------------------------------------------------------------

	/**
	 * Initialize Database Settings
	 *
<<<<<<< HEAD
	 * @access	private Called by the constructor
	 * @param	mixed
	 * @return	void
	 */
	function initialize()
	{
		// If an existing connection resource is available
		// there is no need to connect and select the database
		if (is_resource($this->conn_id) OR is_object($this->conn_id))
=======
	 * @return	bool
	 */
	public function initialize()
	{
		/* If an established connection is available, then there's
		 * no need to connect and select the database.
		 *
		 * Depending on the database driver, conn_id can be either
		 * boolean TRUE, a resource or an object.
		 */
		if ($this->conn_id)
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
		{
			return TRUE;
		}

		// ----------------------------------------------------------------

		// Connect to the database and set the connection ID
<<<<<<< HEAD
		$this->conn_id = ($this->pconnect == FALSE) ? $this->db_connect() : $this->db_pconnect();

		// No connection resource?  Throw an error
		if ( ! $this->conn_id)
		{
			log_message('error', 'Unable to connect to the database');

			if ($this->db_debug)
			{
				$this->display_error('db_unable_to_connect');
			}
			return FALSE;
		}

		// ----------------------------------------------------------------

		// Select the DB... assuming a database name is specified in the config file
		if ($this->database != '')
		{
			if ( ! $this->db_select())
			{
				log_message('error', 'Unable to select database: '.$this->database);

				if ($this->db_debug)
				{
					$this->display_error('db_unable_to_select', $this->database);
				}
				return FALSE;
			}
			else
			{
				// We've selected the DB. Now we set the character set
				if ( ! $this->db_set_charset($this->char_set, $this->dbcollat))
				{
					return FALSE;
				}

				return TRUE;
			}
		}

=======
		$this->conn_id = $this->db_connect($this->pconnect);

		// No connection resource? Check if there is a failover else throw an error
		if ( ! $this->conn_id)
		{
			// Check if there is a failover set
			if ( ! empty($this->failover) && is_array($this->failover))
			{
				// Go over all the failovers
				foreach ($this->failover as $failover)
				{
					// Replace the current settings with those of the failover
					foreach ($failover as $key => $val)
					{
						$this->$key = $val;
					}

					// Try to connect
					$this->conn_id = $this->db_connect($this->pconnect);

					// If a connection is made break the foreach loop
					if ($this->conn_id)
					{
						break;
					}
				}
			}

			// We still don't have a connection?
			if ( ! $this->conn_id)
			{
				log_message('error', 'Unable to connect to the database');

				if ($this->db_debug)
				{
					$this->display_error('db_unable_to_connect');
				}

				return FALSE;
			}
		}

		// Now we set the character set and that's all
		return $this->db_set_charset($this->char_set);
	}

	// --------------------------------------------------------------------

	/**
	 * DB connect
	 *
	 * This is just a dummy method that all drivers will override.
	 *
	 * @return	mixed
	 */
	public function db_connect()
	{
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
		return TRUE;
	}

	// --------------------------------------------------------------------

	/**
<<<<<<< HEAD
	 * Set client character set
	 *
	 * @access	public
	 * @param	string
	 * @param	string
	 * @return	resource
	 */
	function db_set_charset($charset, $collation)
	{
		if ( ! $this->_db_set_charset($this->char_set, $this->dbcollat))
		{
			log_message('error', 'Unable to set database connection charset: '.$this->char_set);

			if ($this->db_debug)
			{
				$this->display_error('db_unable_to_set_charset', $this->char_set);
=======
	 * Persistent database connection
	 *
	 * @return	mixed
	 */
	public function db_pconnect()
	{
		return $this->db_connect(TRUE);
	}

	// --------------------------------------------------------------------

	/**
	 * Reconnect
	 *
	 * Keep / reestablish the db connection if no queries have been
	 * sent for a length of time exceeding the server's idle timeout.
	 *
	 * This is just a dummy method to allow drivers without such
	 * functionality to not declare it, while others will override it.
	 *
	 * @return	void
	 */
	public function reconnect()
	{
	}

	// --------------------------------------------------------------------

	/**
	 * Select database
	 *
	 * This is just a dummy method to allow drivers without such
	 * functionality to not declare it, while others will override it.
	 *
	 * @return	bool
	 */
	public function db_select()
	{
		return TRUE;
	}

	// --------------------------------------------------------------------

	/**
	 * Last error
	 *
	 * @return	array
	 */
	public function error()
	{
		return array('code' => NULL, 'message' => NULL);
	}

	// --------------------------------------------------------------------

	/**
	 * Set client character set
	 *
	 * @param	string
	 * @return	bool
	 */
	public function db_set_charset($charset)
	{
		if (method_exists($this, '_db_set_charset') && ! $this->_db_set_charset($charset))
		{
			log_message('error', 'Unable to set database connection charset: '.$charset);

			if ($this->db_debug)
			{
				$this->display_error('db_unable_to_set_charset', $charset);
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
			}

			return FALSE;
		}

		return TRUE;
	}

	// --------------------------------------------------------------------

	/**
	 * The name of the platform in use (mysql, mssql, etc...)
	 *
<<<<<<< HEAD
	 * @access	public
	 * @return	string
	 */
	function platform()
=======
	 * @return	string
	 */
	public function platform()
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
	{
		return $this->dbdriver;
	}

	// --------------------------------------------------------------------

	/**
<<<<<<< HEAD
	 * Database Version Number.  Returns a string containing the
	 * version of the database being used
	 *
	 * @access	public
	 * @return	string
	 */
	function version()
	{
		if (FALSE === ($sql = $this->_version()))
		{
			if ($this->db_debug)
			{
				return $this->display_error('db_unsupported_function');
			}
			return FALSE;
		}

		// Some DBs have functions that return the version, and don't run special
		// SQL queries per se. In these instances, just return the result.
		$driver_version_exceptions = array('oci8', 'sqlite', 'cubrid');

		if (in_array($this->dbdriver, $driver_version_exceptions))
		{
			return $sql;
		}
		else
		{
			$query = $this->query($sql);
			return $query->row('ver');
		}
=======
	 * Database version number
	 *
	 * Returns a string containing the version of the database being used.
	 * Most drivers will override this method.
	 *
	 * @return	string
	 */
	public function version()
	{
		if (isset($this->data_cache['version']))
		{
			return $this->data_cache['version'];
		}

		if (FALSE === ($sql = $this->_version()))
		{
			return ($this->db_debug) ? $this->display_error('db_unsupported_function') : FALSE;
		}

		$query = $this->query($sql)->row();
		return $this->data_cache['version'] = $query->ver;
	}

	// --------------------------------------------------------------------

	/**
	 * Version number query string
	 *
	 * @return	string
	 */
	protected function _version()
	{
		return 'SELECT VERSION() AS ver';
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
	}

	// --------------------------------------------------------------------

	/**
	 * Execute the query
	 *
	 * Accepts an SQL string as input and returns a result object upon
<<<<<<< HEAD
	 * successful execution of a "read" type query.  Returns boolean TRUE
=======
	 * successful execution of a "read" type query. Returns boolean TRUE
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
	 * upon successful execution of a "write" type query. Returns boolean
	 * FALSE upon failure, and if the $db_debug variable is set to TRUE
	 * will raise an error.
	 *
<<<<<<< HEAD
	 * @access	public
	 * @param	string	An SQL query string
	 * @param	array	An array of binding data
	 * @return	mixed
	 */
	function query($sql, $binds = FALSE, $return_object = TRUE)
	{
		if ($sql == '')
		{
			if ($this->db_debug)
			{
				log_message('error', 'Invalid query: '.$sql);
				return $this->display_error('db_invalid_query');
			}
			return FALSE;
		}

		// Verify table prefix and replace if necessary
		if ( ($this->dbprefix != '' AND $this->swap_pre != '') AND ($this->dbprefix != $this->swap_pre) )
		{
			$sql = preg_replace("/(\W)".$this->swap_pre."(\S+?)/", "\\1".$this->dbprefix."\\2", $sql);
=======
	 * @param	string	$sql
	 * @param	array	$binds = FALSE		An array of binding data
	 * @param	bool	$return_object = NULL
	 * @return	mixed
	 */
	public function query($sql, $binds = FALSE, $return_object = NULL)
	{
		if ($sql === '')
		{
			log_message('error', 'Invalid query: '.$sql);
			return ($this->db_debug) ? $this->display_error('db_invalid_query') : FALSE;
		}
		elseif ( ! is_bool($return_object))
		{
			$return_object = ! $this->is_write_type($sql);
		}

		// Verify table prefix and replace if necessary
		if ($this->dbprefix !== '' && $this->swap_pre !== '' && $this->dbprefix !== $this->swap_pre)
		{
			$sql = preg_replace('/(\W)'.$this->swap_pre.'(\S+?)/', '\\1'.$this->dbprefix.'\\2', $sql);
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
		}

		// Compile binds if needed
		if ($binds !== FALSE)
		{
			$sql = $this->compile_binds($sql, $binds);
		}

<<<<<<< HEAD
		// Is query caching enabled?  If the query is a "read type"
		// we will load the caching class and return the previously
		// cached query if it exists
		if ($this->cache_on == TRUE AND stristr($sql, 'SELECT'))
		{
			if ($this->_cache_init())
			{
				$this->load_rdriver();
				if (FALSE !== ($cache = $this->CACHE->read($sql)))
				{
					return $cache;
				}
			}
		}

		// Save the  query for debugging
		if ($this->save_queries == TRUE)
=======
		// Is query caching enabled? If the query is a "read type"
		// we will load the caching class and return the previously
		// cached query if it exists
		if ($this->cache_on === TRUE && $return_object === TRUE && $this->_cache_init())
		{
			$this->load_rdriver();
			if (FALSE !== ($cache = $this->CACHE->read($sql)))
			{
				return $cache;
			}
		}

		// Save the query for debugging
		if ($this->save_queries === TRUE)
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
		{
			$this->queries[] = $sql;
		}

		// Start the Query Timer
<<<<<<< HEAD
		$time_start = list($sm, $ss) = explode(' ', microtime());
=======
		$time_start = microtime(TRUE);
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd

		// Run the Query
		if (FALSE === ($this->result_id = $this->simple_query($sql)))
		{
<<<<<<< HEAD
			if ($this->save_queries == TRUE)
=======
			if ($this->save_queries === TRUE)
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
			{
				$this->query_times[] = 0;
			}

			// This will trigger a rollback if transactions are being used
<<<<<<< HEAD
			$this->_trans_status = FALSE;

			if ($this->db_debug)
			{
				// grab the error number and message now, as we might run some
				// additional queries before displaying the error
				$error_no = $this->_error_number();
				$error_msg = $this->_error_message();

				// We call this function in order to roll-back queries
				// if transactions are enabled.  If we don't call this here
				// the error message will trigger an exit, causing the
				// transactions to remain in limbo.
				$this->trans_complete();

				// Log and display errors
				log_message('error', 'Query error: '.$error_msg);
				return $this->display_error(
										array(
												'Error Number: '.$error_no,
												$error_msg,
												$sql
											)
										);
=======
			if ($this->_trans_depth !== 0)
			{
				$this->_trans_status = FALSE;
			}

			// Grab the error now, as we might run some additional queries before displaying the error
			$error = $this->error();

			// Log errors
			log_message('error', 'Query error: '.$error['message'].' - Invalid query: '.$sql);

			if ($this->db_debug)
			{
				// We call this function in order to roll-back queries
				// if transactions are enabled. If we don't call this here
				// the error message will trigger an exit, causing the
				// transactions to remain in limbo.
				while ($this->_trans_depth !== 0)
				{
					$trans_depth = $this->_trans_depth;
					$this->trans_complete();
					if ($trans_depth === $this->_trans_depth)
					{
						log_message('error', 'Database: Failure during an automated transaction commit/rollback!');
						break;
					}
				}

				// Display errors
				return $this->display_error(array('Error Number: '.$error['code'], $error['message'], $sql));
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
			}

			return FALSE;
		}

		// Stop and aggregate the query time results
<<<<<<< HEAD
		$time_end = list($em, $es) = explode(' ', microtime());
		$this->benchmark += ($em + $es) - ($sm + $ss);

		if ($this->save_queries == TRUE)
		{
			$this->query_times[] = ($em + $es) - ($sm + $ss);
=======
		$time_end = microtime(TRUE);
		$this->benchmark += $time_end - $time_start;

		if ($this->save_queries === TRUE)
		{
			$this->query_times[] = $time_end - $time_start;
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
		}

		// Increment the query counter
		$this->query_count++;

<<<<<<< HEAD
		// Was the query a "write" type?
		// If so we'll simply return true
		if ($this->is_write_type($sql) === TRUE)
		{
			// If caching is enabled we'll auto-cleanup any
			// existing files related to this particular URI
			if ($this->cache_on == TRUE AND $this->cache_autodel == TRUE AND $this->_cache_init())
=======
		// Will we have a result object instantiated? If not - we'll simply return TRUE
		if ($return_object !== TRUE)
		{
			// If caching is enabled we'll auto-cleanup any existing files related to this particular URI
			if ($this->cache_on === TRUE && $this->cache_autodel === TRUE && $this->_cache_init())
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
			{
				$this->CACHE->delete();
			}

			return TRUE;
		}

<<<<<<< HEAD
		// Return TRUE if we don't need to create a result object
		// Currently only the Oracle driver uses this when stored
		// procedures are used
		if ($return_object !== TRUE)
		{
			return TRUE;
		}

		// Load and instantiate the result driver

		$driver			= $this->load_rdriver();
		$RES			= new $driver();
		$RES->conn_id	= $this->conn_id;
		$RES->result_id	= $this->result_id;

		if ($this->dbdriver == 'oci8')
		{
			$RES->stmt_id		= $this->stmt_id;
			$RES->curs_id		= NULL;
			$RES->limit_used	= $this->limit_used;
			$this->stmt_id		= FALSE;
		}

		// oci8 vars must be set before calling this
		$RES->num_rows	= $RES->num_rows();

		// Is query caching enabled?  If so, we'll serialize the
		// result object and save it to a cache file.
		if ($this->cache_on == TRUE AND $this->_cache_init())
=======
		// Load and instantiate the result driver
		$driver		= $this->load_rdriver();
		$RES		= new $driver($this);

		// Is query caching enabled? If so, we'll serialize the
		// result object and save it to a cache file.
		if ($this->cache_on === TRUE && $this->_cache_init())
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
		{
			// We'll create a new instance of the result object
			// only without the platform specific driver since
			// we can't use it with cached data (the query result
			// resource ID won't be any good once we've cached the
			// result object, so we'll have to compile the data
			// and save it)
<<<<<<< HEAD
			$CR = new CI_DB_result();
			$CR->num_rows		= $RES->num_rows();
			$CR->result_object	= $RES->result_object();
			$CR->result_array	= $RES->result_array();
=======
			$CR = new CI_DB_result($this);
			$CR->result_object	= $RES->result_object();
			$CR->result_array	= $RES->result_array();
			$CR->num_rows		= $RES->num_rows();
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd

			// Reset these since cached objects can not utilize resource IDs.
			$CR->conn_id		= NULL;
			$CR->result_id		= NULL;

			$this->CACHE->write($sql, $CR);
		}

		return $RES;
	}

	// --------------------------------------------------------------------

	/**
	 * Load the result drivers
	 *
<<<<<<< HEAD
	 * @access	public
	 * @return	string	the name of the result class
	 */
	function load_rdriver()
	{
		$driver = 'CI_DB_'.$this->dbdriver.'_result';

		if ( ! class_exists($driver))
		{
			include_once(BASEPATH.'database/DB_result.php');
			include_once(BASEPATH.'database/drivers/'.$this->dbdriver.'/'.$this->dbdriver.'_result.php');
=======
	 * @return	string	the name of the result class
	 */
	public function load_rdriver()
	{
		$driver = 'CI_DB_'.$this->dbdriver.'_result';

		if ( ! class_exists($driver, FALSE))
		{
			require_once(BASEPATH.'database/DB_result.php');
			require_once(BASEPATH.'database/drivers/'.$this->dbdriver.'/'.$this->dbdriver.'_result.php');
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
		}

		return $driver;
	}

	// --------------------------------------------------------------------

	/**
	 * Simple Query
<<<<<<< HEAD
	 * This is a simplified version of the query() function.  Internally
	 * we only use it when running transaction commands since they do
	 * not require all the features of the main query() function.
	 *
	 * @access	public
	 * @param	string	the sql query
	 * @return	mixed
	 */
	function simple_query($sql)
	{
		if ( ! $this->conn_id)
		{
			$this->initialize();
=======
	 * This is a simplified version of the query() function. Internally
	 * we only use it when running transaction commands since they do
	 * not require all the features of the main query() function.
	 *
	 * @param	string	the sql query
	 * @return	mixed
	 */
	public function simple_query($sql)
	{
		if ( ! $this->conn_id)
		{
			if ( ! $this->initialize())
			{
				return FALSE;
			}
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
		}

		return $this->_execute($sql);
	}

	// --------------------------------------------------------------------

	/**
	 * Disable Transactions
	 * This permits transactions to be disabled at run-time.
	 *
<<<<<<< HEAD
	 * @access	public
	 * @return	void
	 */
	function trans_off()
=======
	 * @return	void
	 */
	public function trans_off()
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
	{
		$this->trans_enabled = FALSE;
	}

	// --------------------------------------------------------------------

	/**
	 * Enable/disable Transaction Strict Mode
<<<<<<< HEAD
	 * When strict mode is enabled, if you are running multiple groups of
	 * transactions, if one group fails all groups will be rolled back.
	 * If strict mode is disabled, each group is treated autonomously, meaning
	 * a failure of one group will not affect any others
	 *
	 * @access	public
	 * @return	void
	 */
	function trans_strict($mode = TRUE)
=======
	 *
	 * When strict mode is enabled, if you are running multiple groups of
	 * transactions, if one group fails all subsequent groups will be
	 * rolled back.
	 *
	 * If strict mode is disabled, each group is treated autonomously,
	 * meaning a failure of one group will not affect any others
	 *
	 * @param	bool	$mode = TRUE
	 * @return	void
	 */
	public function trans_strict($mode = TRUE)
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
	{
		$this->trans_strict = is_bool($mode) ? $mode : TRUE;
	}

	// --------------------------------------------------------------------

	/**
	 * Start Transaction
	 *
<<<<<<< HEAD
	 * @access	public
	 * @return	void
	 */
	function trans_start($test_mode = FALSE)
=======
	 * @param	bool	$test_mode = FALSE
	 * @return	bool
	 */
	public function trans_start($test_mode = FALSE)
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
	{
		if ( ! $this->trans_enabled)
		{
			return FALSE;
		}

<<<<<<< HEAD
		// When transactions are nested we only begin/commit/rollback the outermost ones
		if ($this->_trans_depth > 0)
		{
			$this->_trans_depth += 1;
			return;
		}

		$this->trans_begin($test_mode);
=======
		return $this->trans_begin($test_mode);
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
	}

	// --------------------------------------------------------------------

	/**
	 * Complete Transaction
	 *
<<<<<<< HEAD
	 * @access	public
	 * @return	bool
	 */
	function trans_complete()
=======
	 * @return	bool
	 */
	public function trans_complete()
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
	{
		if ( ! $this->trans_enabled)
		{
			return FALSE;
		}

<<<<<<< HEAD
		// When transactions are nested we only begin/commit/rollback the outermost ones
		if ($this->_trans_depth > 1)
		{
			$this->_trans_depth -= 1;
			return TRUE;
		}

		// The query() function will set this flag to FALSE in the event that a query failed
		if ($this->_trans_status === FALSE)
=======
		// The query() function will set this flag to FALSE in the event that a query failed
		if ($this->_trans_status === FALSE OR $this->_trans_failure === TRUE)
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
		{
			$this->trans_rollback();

			// If we are NOT running in strict mode, we will reset
<<<<<<< HEAD
			// the _trans_status flag so that subsequent groups of transactions
			// will be permitted.
=======
			// the _trans_status flag so that subsequent groups of
			// transactions will be permitted.
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
			if ($this->trans_strict === FALSE)
			{
				$this->_trans_status = TRUE;
			}

			log_message('debug', 'DB Transaction Failure');
			return FALSE;
		}

<<<<<<< HEAD
		$this->trans_commit();
		return TRUE;
=======
		return $this->trans_commit();
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
	}

	// --------------------------------------------------------------------

	/**
	 * Lets you retrieve the transaction flag to determine if it has failed
	 *
<<<<<<< HEAD
	 * @access	public
	 * @return	bool
	 */
	function trans_status()
=======
	 * @return	bool
	 */
	public function trans_status()
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
	{
		return $this->_trans_status;
	}

	// --------------------------------------------------------------------

	/**
<<<<<<< HEAD
	 * Compile Bindings
	 *
	 * @access	public
=======
	 * Begin Transaction
	 *
	 * @param	bool	$test_mode
	 * @return	bool
	 */
	public function trans_begin($test_mode = FALSE)
	{
		if ( ! $this->trans_enabled)
		{
			return FALSE;
		}
		// When transactions are nested we only begin/commit/rollback the outermost ones
		elseif ($this->_trans_depth > 0)
		{
			$this->_trans_depth++;
			return TRUE;
		}

		// Reset the transaction failure flag.
		// If the $test_mode flag is set to TRUE transactions will be rolled back
		// even if the queries produce a successful result.
		$this->_trans_failure = ($test_mode === TRUE);

		if ($this->_trans_begin())
		{
			$this->_trans_depth++;
			return TRUE;
		}

		return FALSE;
	}

	// --------------------------------------------------------------------

	/**
	 * Commit Transaction
	 *
	 * @return	bool
	 */
	public function trans_commit()
	{
		if ( ! $this->trans_enabled OR $this->_trans_depth === 0)
		{
			return FALSE;
		}
		// When transactions are nested we only begin/commit/rollback the outermost ones
		elseif ($this->_trans_depth > 1 OR $this->_trans_commit())
		{
			$this->_trans_depth--;
			return TRUE;
		}

		return FALSE;
	}

	// --------------------------------------------------------------------

	/**
	 * Rollback Transaction
	 *
	 * @return	bool
	 */
	public function trans_rollback()
	{
		if ( ! $this->trans_enabled OR $this->_trans_depth === 0)
		{
			return FALSE;
		}
		// When transactions are nested we only begin/commit/rollback the outermost ones
		elseif ($this->_trans_depth > 1 OR $this->_trans_rollback())
		{
			$this->_trans_depth--;
			return TRUE;
		}

		return FALSE;
	}

	// --------------------------------------------------------------------

	/**
	 * Compile Bindings
	 *
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
	 * @param	string	the sql statement
	 * @param	array	an array of bind data
	 * @return	string
	 */
<<<<<<< HEAD
	function compile_binds($sql, $binds)
	{
		if (strpos($sql, $this->bind_marker) === FALSE)
		{
			return $sql;
		}

		if ( ! is_array($binds))
		{
			$binds = array($binds);
		}

		// Get the sql segments around the bind markers
		$segments = explode($this->bind_marker, $sql);

		// The count of bind should be 1 less then the count of segments
		// If there are more bind arguments trim it down
		if (count($binds) >= count($segments)) {
			$binds = array_slice($binds, 0, count($segments)-1);
		}

		// Construct the binded query
		$result = $segments[0];
		$i = 0;
		foreach ($binds as $bind)
		{
			$result .= $this->escape($bind);
			$result .= $segments[++$i];
		}

		return $result;
=======
	public function compile_binds($sql, $binds)
	{
		if (empty($binds) OR empty($this->bind_marker) OR strpos($sql, $this->bind_marker) === FALSE)
		{
			return $sql;
		}
		elseif ( ! is_array($binds))
		{
			$binds = array($binds);
			$bind_count = 1;
		}
		else
		{
			// Make sure we're using numeric keys
			$binds = array_values($binds);
			$bind_count = count($binds);
		}

		// We'll need the marker length later
		$ml = strlen($this->bind_marker);

		// Make sure not to replace a chunk inside a string that happens to match the bind marker
		if ($c = preg_match_all("/'[^']*'/i", $sql, $matches))
		{
			$c = preg_match_all('/'.preg_quote($this->bind_marker, '/').'/i',
				str_replace($matches[0],
					str_replace($this->bind_marker, str_repeat(' ', $ml), $matches[0]),
					$sql, $c),
				$matches, PREG_OFFSET_CAPTURE);

			// Bind values' count must match the count of markers in the query
			if ($bind_count !== $c)
			{
				return $sql;
			}
		}
		elseif (($c = preg_match_all('/'.preg_quote($this->bind_marker, '/').'/i', $sql, $matches, PREG_OFFSET_CAPTURE)) !== $bind_count)
		{
			return $sql;
		}

		do
		{
			$c--;
			$escaped_value = $this->escape($binds[$c]);
			if (is_array($escaped_value))
			{
				$escaped_value = '('.implode(',', $escaped_value).')';
			}
			$sql = substr_replace($sql, $escaped_value, $matches[0][$c][1], $ml);
		}
		while ($c !== 0);

		return $sql;
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
	}

	// --------------------------------------------------------------------

	/**
	 * Determines if a query is a "write" type.
	 *
<<<<<<< HEAD
	 * @access	public
	 * @param	string	An SQL query string
	 * @return	boolean
	 */
	function is_write_type($sql)
	{
		if ( ! preg_match('/^\s*"?(SET|INSERT|UPDATE|DELETE|REPLACE|CREATE|DROP|TRUNCATE|LOAD DATA|COPY|ALTER|GRANT|REVOKE|LOCK|UNLOCK)\s+/i', $sql))
		{
			return FALSE;
		}
		return TRUE;
=======
	 * @param	string	An SQL query string
	 * @return	bool
	 */
	public function is_write_type($sql)
	{
		return (bool) preg_match('/^\s*"?(SET|INSERT|UPDATE|DELETE|REPLACE|CREATE|DROP|TRUNCATE|LOAD|COPY|ALTER|RENAME|GRANT|REVOKE|LOCK|UNLOCK|REINDEX)\s/i', $sql);
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
	}

	// --------------------------------------------------------------------

	/**
	 * Calculate the aggregate query elapsed time
	 *
<<<<<<< HEAD
	 * @access	public
	 * @param	integer	The number of decimal places
	 * @return	integer
	 */
	function elapsed_time($decimals = 6)
=======
	 * @param	int	The number of decimal places
	 * @return	string
	 */
	public function elapsed_time($decimals = 6)
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
	{
		return number_format($this->benchmark, $decimals);
	}

	// --------------------------------------------------------------------

	/**
	 * Returns the total number of queries
	 *
<<<<<<< HEAD
	 * @access	public
	 * @return	integer
	 */
	function total_queries()
=======
	 * @return	int
	 */
	public function total_queries()
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
	{
		return $this->query_count;
	}

	// --------------------------------------------------------------------

	/**
	 * Returns the last query that was executed
	 *
<<<<<<< HEAD
	 * @access	public
	 * @return	void
	 */
	function last_query()
=======
	 * @return	string
	 */
	public function last_query()
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
	{
		return end($this->queries);
	}

	// --------------------------------------------------------------------

	/**
	 * "Smart" Escape String
	 *
	 * Escapes data based on type
	 * Sets boolean and null types
	 *
<<<<<<< HEAD
	 * @access	public
	 * @param	string
	 * @return	mixed
	 */
	function escape($str)
	{
		if (is_string($str))
		{
			$str = "'".$this->escape_str($str)."'";
		}
		elseif (is_bool($str))
		{
			$str = ($str === FALSE) ? 0 : 1;
		}
		elseif (is_null($str))
		{
			$str = 'NULL';
=======
	 * @param	string
	 * @return	mixed
	 */
	public function escape($str)
	{
		if (is_array($str))
		{
			$str = array_map(array(&$this, 'escape'), $str);
			return $str;
		}
		elseif (is_string($str) OR (is_object($str) && method_exists($str, '__toString')))
		{
			return "'".$this->escape_str($str)."'";
		}
		elseif (is_bool($str))
		{
			return ($str === FALSE) ? 0 : 1;
		}
		elseif ($str === NULL)
		{
			return 'NULL';
		}

		return $str;
	}

	// --------------------------------------------------------------------

	/**
	 * Escape String
	 *
	 * @param	string|string[]	$str	Input string
	 * @param	bool	$like	Whether or not the string will be used in a LIKE condition
	 * @return	string
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

		$str = $this->_escape_str($str);

		// escape LIKE condition wildcards
		if ($like === TRUE)
		{
			return str_replace(
				array($this->_like_escape_chr, '%', '_'),
				array($this->_like_escape_chr.$this->_like_escape_chr, $this->_like_escape_chr.'%', $this->_like_escape_chr.'_'),
				$str
			);
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
		}

		return $str;
	}

	// --------------------------------------------------------------------

	/**
	 * Escape LIKE String
	 *
	 * Calls the individual driver for platform
	 * specific escaping for LIKE conditions
	 *
<<<<<<< HEAD
	 * @access	public
	 * @param	string
	 * @return	mixed
	 */
	function escape_like_str($str)
=======
	 * @param	string|string[]
	 * @return	mixed
	 */
	public function escape_like_str($str)
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
	{
		return $this->escape_str($str, TRUE);
	}

	// --------------------------------------------------------------------

	/**
<<<<<<< HEAD
	 * Primary
	 *
	 * Retrieves the primary key.  It assumes that the row in the first
	 * position is the primary key
	 *
	 * @access	public
	 * @param	string	the table name
	 * @return	string
	 */
	function primary($table = '')
	{
		$fields = $this->list_fields($table);

		if ( ! is_array($fields))
		{
			return FALSE;
		}

		return current($fields);
=======
	 * Platform-dependant string escape
	 *
	 * @param	string
	 * @return	string
	 */
	protected function _escape_str($str)
	{
		return str_replace("'", "''", remove_invisible_characters($str));
	}

	// --------------------------------------------------------------------

	/**
	 * Primary
	 *
	 * Retrieves the primary key. It assumes that the row in the first
	 * position is the primary key
	 *
	 * @param	string	$table	Table name
	 * @return	string
	 */
	public function primary($table)
	{
		$fields = $this->list_fields($table);
		return is_array($fields) ? current($fields) : FALSE;
	}

	// --------------------------------------------------------------------

	/**
	 * "Count All" query
	 *
	 * Generates a platform-specific query string that counts all records in
	 * the specified database
	 *
	 * @param	string
	 * @return	int
	 */
	public function count_all($table = '')
	{
		if ($table === '')
		{
			return 0;
		}

		$query = $this->query($this->_count_string.$this->escape_identifiers('numrows').' FROM '.$this->protect_identifiers($table, TRUE, NULL, FALSE));
		if ($query->num_rows() === 0)
		{
			return 0;
		}

		$query = $query->row();
		$this->_reset_select();
		return (int) $query->numrows;
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
	}

	// --------------------------------------------------------------------

	/**
	 * Returns an array of table names
	 *
<<<<<<< HEAD
	 * @access	public
	 * @return	array
	 */
	function list_tables($constrain_by_prefix = FALSE)
=======
	 * @param	string	$constrain_by_prefix = FALSE
	 * @return	array
	 */
	public function list_tables($constrain_by_prefix = FALSE)
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
	{
		// Is there a cached result?
		if (isset($this->data_cache['table_names']))
		{
			return $this->data_cache['table_names'];
		}

		if (FALSE === ($sql = $this->_list_tables($constrain_by_prefix)))
		{
<<<<<<< HEAD
			if ($this->db_debug)
			{
				return $this->display_error('db_unsupported_function');
			}
			return FALSE;
		}

		$retval = array();
		$query = $this->query($sql);

		if ($query->num_rows() > 0)
		{
			foreach ($query->result_array() as $row)
			{
				if (isset($row['TABLE_NAME']))
				{
					$retval[] = $row['TABLE_NAME'];
				}
				else
				{
					$retval[] = array_shift($row);
				}
			}
		}

		$this->data_cache['table_names'] = $retval;
=======
			return ($this->db_debug) ? $this->display_error('db_unsupported_function') : FALSE;
		}

		$this->data_cache['table_names'] = array();
		$query = $this->query($sql);

		foreach ($query->result_array() as $row)
		{
			// Do we know from which column to get the table name?
			if ( ! isset($key))
			{
				if (isset($row['table_name']))
				{
					$key = 'table_name';
				}
				elseif (isset($row['TABLE_NAME']))
				{
					$key = 'TABLE_NAME';
				}
				else
				{
					/* We have no other choice but to just get the first element's key.
					 * Due to array_shift() accepting its argument by reference, if
					 * E_STRICT is on, this would trigger a warning. So we'll have to
					 * assign it first.
					 */
					$key = array_keys($row);
					$key = array_shift($key);
				}
			}

			$this->data_cache['table_names'][] = $row[$key];
		}

>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
		return $this->data_cache['table_names'];
	}

	// --------------------------------------------------------------------

	/**
	 * Determine if a particular table exists
<<<<<<< HEAD
	 * @access	public
	 * @return	boolean
	 */
	function table_exists($table_name)
	{
		return ( ! in_array($this->_protect_identifiers($table_name, TRUE, FALSE, FALSE), $this->list_tables())) ? FALSE : TRUE;
=======
	 *
	 * @param	string	$table_name
	 * @return	bool
	 */
	public function table_exists($table_name)
	{
		return in_array($this->protect_identifiers($table_name, TRUE, FALSE, FALSE), $this->list_tables());
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
	}

	// --------------------------------------------------------------------

	/**
<<<<<<< HEAD
	 * Fetch MySQL Field Names
	 *
	 * @access	public
	 * @param	string	the table name
	 * @return	array
	 */
	function list_fields($table = '')
=======
	 * Fetch Field Names
	 *
	 * @param	string	$table	Table name
	 * @return	array
	 */
	public function list_fields($table)
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
	{
		// Is there a cached result?
		if (isset($this->data_cache['field_names'][$table]))
		{
			return $this->data_cache['field_names'][$table];
		}

<<<<<<< HEAD
		if ($table == '')
		{
			if ($this->db_debug)
			{
				return $this->display_error('db_field_param_missing');
			}
			return FALSE;
		}

		if (FALSE === ($sql = $this->_list_columns($table)))
		{
			if ($this->db_debug)
			{
				return $this->display_error('db_unsupported_function');
			}
			return FALSE;
		}

		$query = $this->query($sql);

		$retval = array();
		foreach ($query->result_array() as $row)
		{
			if (isset($row['COLUMN_NAME']))
			{
				$retval[] = $row['COLUMN_NAME'];
			}
			else
			{
				$retval[] = current($row);
			}
		}

		$this->data_cache['field_names'][$table] = $retval;
=======
		if (FALSE === ($sql = $this->_list_columns($table)))
		{
			return ($this->db_debug) ? $this->display_error('db_unsupported_function') : FALSE;
		}

		$query = $this->query($sql);
		$this->data_cache['field_names'][$table] = array();

		foreach ($query->result_array() as $row)
		{
			// Do we know from where to get the column's name?
			if ( ! isset($key))
			{
				if (isset($row['column_name']))
				{
					$key = 'column_name';
				}
				elseif (isset($row['COLUMN_NAME']))
				{
					$key = 'COLUMN_NAME';
				}
				else
				{
					// We have no other choice but to just get the first element's key.
					$key = key($row);
				}
			}

			$this->data_cache['field_names'][$table][] = $row[$key];
		}

>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
		return $this->data_cache['field_names'][$table];
	}

	// --------------------------------------------------------------------

	/**
	 * Determine if a particular field exists
<<<<<<< HEAD
	 * @access	public
	 * @param	string
	 * @param	string
	 * @return	boolean
	 */
	function field_exists($field_name, $table_name)
	{
		return ( ! in_array($field_name, $this->list_fields($table_name))) ? FALSE : TRUE;
=======
	 *
	 * @param	string
	 * @param	string
	 * @return	bool
	 */
	public function field_exists($field_name, $table_name)
	{
		return in_array($field_name, $this->list_fields($table_name));
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
	}

	// --------------------------------------------------------------------

	/**
	 * Returns an object with field data
	 *
<<<<<<< HEAD
	 * @access	public
	 * @param	string	the table name
	 * @return	object
	 */
	function field_data($table = '')
	{
		if ($table == '')
		{
			if ($this->db_debug)
			{
				return $this->display_error('db_field_param_missing');
			}
			return FALSE;
		}

		$query = $this->query($this->_field_data($this->_protect_identifiers($table, TRUE, NULL, FALSE)));

		return $query->field_data();
=======
	 * @param	string	$table	the table name
	 * @return	array
	 */
	public function field_data($table)
	{
		$query = $this->query($this->_field_data($this->protect_identifiers($table, TRUE, NULL, FALSE)));
		return ($query) ? $query->field_data() : FALSE;
	}

	// --------------------------------------------------------------------

	/**
	 * Escape the SQL Identifiers
	 *
	 * This function escapes column and table names
	 *
	 * @param	mixed
	 * @return	mixed
	 */
	public function escape_identifiers($item)
	{
		if ($this->_escape_char === '' OR empty($item) OR in_array($item, $this->_reserved_identifiers))
		{
			return $item;
		}
		elseif (is_array($item))
		{
			foreach ($item as $key => $value)
			{
				$item[$key] = $this->escape_identifiers($value);
			}

			return $item;
		}
		// Avoid breaking functions and literal values inside queries
		elseif (ctype_digit($item) OR $item[0] === "'" OR ($this->_escape_char !== '"' && $item[0] === '"') OR strpos($item, '(') !== FALSE)
		{
			return $item;
		}

		static $preg_ec = array();

		if (empty($preg_ec))
		{
			if (is_array($this->_escape_char))
			{
				$preg_ec = array(
					preg_quote($this->_escape_char[0], '/'),
					preg_quote($this->_escape_char[1], '/'),
					$this->_escape_char[0],
					$this->_escape_char[1]
				);
			}
			else
			{
				$preg_ec[0] = $preg_ec[1] = preg_quote($this->_escape_char, '/');
				$preg_ec[2] = $preg_ec[3] = $this->_escape_char;
			}
		}

		foreach ($this->_reserved_identifiers as $id)
		{
			if (strpos($item, '.'.$id) !== FALSE)
			{
				return preg_replace('/'.$preg_ec[0].'?([^'.$preg_ec[1].'\.]+)'.$preg_ec[1].'?\./i', $preg_ec[2].'$1'.$preg_ec[3].'.', $item);
			}
		}

		return preg_replace('/'.$preg_ec[0].'?([^'.$preg_ec[1].'\.]+)'.$preg_ec[1].'?(\.)?/i', $preg_ec[2].'$1'.$preg_ec[3].'$2', $item);
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
	}

	// --------------------------------------------------------------------

	/**
	 * Generate an insert string
	 *
<<<<<<< HEAD
	 * @access	public
=======
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
	 * @param	string	the table upon which the query will be performed
	 * @param	array	an associative array data of key/values
	 * @return	string
	 */
<<<<<<< HEAD
	function insert_string($table, $data)
	{
		$fields = array();
		$values = array();

		foreach ($data as $key => $val)
		{
			$fields[] = $this->_escape_identifiers($key);
			$values[] = $this->escape($val);
		}

		return $this->_insert($this->_protect_identifiers($table, TRUE, NULL, FALSE), $fields, $values);
=======
	public function insert_string($table, $data)
	{
		$fields = $values = array();

		foreach ($data as $key => $val)
		{
			$fields[] = $this->escape_identifiers($key);
			$values[] = $this->escape($val);
		}

		return $this->_insert($this->protect_identifiers($table, TRUE, NULL, FALSE), $fields, $values);
	}

	// --------------------------------------------------------------------

	/**
	 * Insert statement
	 *
	 * Generates a platform-specific insert string from the supplied data
	 *
	 * @param	string	the table name
	 * @param	array	the insert keys
	 * @param	array	the insert values
	 * @return	string
	 */
	protected function _insert($table, $keys, $values)
	{
		return 'INSERT INTO '.$table.' ('.implode(', ', $keys).') VALUES ('.implode(', ', $values).')';
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
	}

	// --------------------------------------------------------------------

	/**
	 * Generate an update string
	 *
<<<<<<< HEAD
	 * @access	public
=======
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
	 * @param	string	the table upon which the query will be performed
	 * @param	array	an associative array data of key/values
	 * @param	mixed	the "where" statement
	 * @return	string
	 */
<<<<<<< HEAD
	function update_string($table, $data, $where)
	{
		if ($where == '')
		{
			return false;
		}

		$fields = array();
		foreach ($data as $key => $val)
		{
			$fields[$this->_protect_identifiers($key)] = $this->escape($val);
		}

		if ( ! is_array($where))
		{
			$dest = array($where);
		}
		else
		{
			$dest = array();
			foreach ($where as $key => $val)
			{
				$prefix = (count($dest) == 0) ? '' : ' AND ';

				if ($val !== '')
				{
					if ( ! $this->_has_operator($key))
					{
						$key .= ' =';
					}

					$val = ' '.$this->escape($val);
				}

				$dest[] = $prefix.$key.$val;
			}
		}

		return $this->_update($this->_protect_identifiers($table, TRUE, NULL, FALSE), $fields, $dest);
=======
	public function update_string($table, $data, $where)
	{
		if (empty($where))
		{
			return FALSE;
		}

		$this->where($where);

		$fields = array();
		foreach ($data as $key => $val)
		{
			$fields[$this->protect_identifiers($key)] = $this->escape($val);
		}

		$sql = $this->_update($this->protect_identifiers($table, TRUE, NULL, FALSE), $fields);
		$this->_reset_write();
		return $sql;
	}

	// --------------------------------------------------------------------

	/**
	 * Update statement
	 *
	 * Generates a platform-specific update string from the supplied data
	 *
	 * @param	string	the table name
	 * @param	array	the update data
	 * @return	string
	 */
	protected function _update($table, $values)
	{
		foreach ($values as $key => $val)
		{
			$valstr[] = $key.' = '.$val;
		}

		return 'UPDATE '.$table.' SET '.implode(', ', $valstr)
			.$this->_compile_wh('qb_where')
			.$this->_compile_order_by()
			.($this->qb_limit ? ' LIMIT '.$this->qb_limit : '');
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
	}

	// --------------------------------------------------------------------

	/**
	 * Tests whether the string has an SQL operator
	 *
<<<<<<< HEAD
	 * @access	private
	 * @param	string
	 * @return	bool
	 */
	function _has_operator($str)
	{
		$str = trim($str);
		if ( ! preg_match("/(\s|<|>|!|=|is null|is not null)/i", $str))
		{
			return FALSE;
		}

		return TRUE;
=======
	 * @param	string
	 * @return	bool
	 */
	protected function _has_operator($str)
	{
		return (bool) preg_match('/(<|>|!|=|\sIS NULL|\sIS NOT NULL|\sEXISTS|\sBETWEEN|\sLIKE|\sIN\s*\(|\s)/i', trim($str));
	}

	// --------------------------------------------------------------------

	/**
	 * Returns the SQL string operator
	 *
	 * @param	string
	 * @return	string
	 */
	protected function _get_operator($str)
	{
		static $_operators;

		if (empty($_operators))
		{
			$_les = ($this->_like_escape_str !== '')
				? '\s+'.preg_quote(trim(sprintf($this->_like_escape_str, $this->_like_escape_chr)), '/')
				: '';
			$_operators = array(
				'\s*(?:<|>|!)?=\s*',             // =, <=, >=, !=
				'\s*<>?\s*',                     // <, <>
				'\s*>\s*',                       // >
				'\s+IS NULL',                    // IS NULL
				'\s+IS NOT NULL',                // IS NOT NULL
				'\s+EXISTS\s*\(.*\)',        // EXISTS(sql)
				'\s+NOT EXISTS\s*\(.*\)',    // NOT EXISTS(sql)
				'\s+BETWEEN\s+',                 // BETWEEN value AND value
				'\s+IN\s*\(.*\)',            // IN(list)
				'\s+NOT IN\s*\(.*\)',        // NOT IN (list)
				'\s+LIKE\s+\S.*('.$_les.')?',    // LIKE 'expr'[ ESCAPE '%s']
				'\s+NOT LIKE\s+\S.*('.$_les.')?' // NOT LIKE 'expr'[ ESCAPE '%s']
			);

		}

		return preg_match('/'.implode('|', $_operators).'/i', $str, $match)
			? $match[0] : FALSE;
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
	}

	// --------------------------------------------------------------------

	/**
	 * Enables a native PHP function to be run, using a platform agnostic wrapper.
	 *
<<<<<<< HEAD
	 * @access	public
	 * @param	string	the function name
	 * @param	mixed	any parameters needed by the function
	 * @return	mixed
	 */
	function call_function($function)
	{
		$driver = ($this->dbdriver == 'postgre') ? 'pg_' : $this->dbdriver.'_';
=======
	 * @param	string	$function	Function name
	 * @return	mixed
	 */
	public function call_function($function)
	{
		$driver = ($this->dbdriver === 'postgre') ? 'pg_' : $this->dbdriver.'_';
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd

		if (FALSE === strpos($driver, $function))
		{
			$function = $driver.$function;
		}

		if ( ! function_exists($function))
		{
<<<<<<< HEAD
			if ($this->db_debug)
			{
				return $this->display_error('db_unsupported_function');
			}
			return FALSE;
		}
		else
		{
			$args = (func_num_args() > 1) ? array_splice(func_get_args(), 1) : null;
			if (is_null($args))
			{
				return call_user_func($function);
			}
			else
			{
				return call_user_func_array($function, $args);
			}
		}
=======
			return ($this->db_debug) ? $this->display_error('db_unsupported_function') : FALSE;
		}

		return (func_num_args() > 1)
			? call_user_func_array($function, array_slice(func_get_args(), 1))
			: call_user_func($function);
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
	}

	// --------------------------------------------------------------------

	/**
	 * Set Cache Directory Path
	 *
<<<<<<< HEAD
	 * @access	public
	 * @param	string	the path to the cache directory
	 * @return	void
	 */
	function cache_set_path($path = '')
=======
	 * @param	string	the path to the cache directory
	 * @return	void
	 */
	public function cache_set_path($path = '')
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
	{
		$this->cachedir = $path;
	}

	// --------------------------------------------------------------------

	/**
	 * Enable Query Caching
	 *
<<<<<<< HEAD
	 * @access	public
	 * @return	void
	 */
	function cache_on()
	{
		$this->cache_on = TRUE;
		return TRUE;
=======
	 * @return	bool	cache_on value
	 */
	public function cache_on()
	{
		return $this->cache_on = TRUE;
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
	}

	// --------------------------------------------------------------------

	/**
	 * Disable Query Caching
	 *
<<<<<<< HEAD
	 * @access	public
	 * @return	void
	 */
	function cache_off()
	{
		$this->cache_on = FALSE;
		return FALSE;
	}


=======
	 * @return	bool	cache_on value
	 */
	public function cache_off()
	{
		return $this->cache_on = FALSE;
	}

>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
	// --------------------------------------------------------------------

	/**
	 * Delete the cache files associated with a particular URI
	 *
<<<<<<< HEAD
	 * @access	public
	 * @return	void
	 */
	function cache_delete($segment_one = '', $segment_two = '')
	{
		if ( ! $this->_cache_init())
		{
			return FALSE;
		}
		return $this->CACHE->delete($segment_one, $segment_two);
=======
	 * @param	string	$segment_one = ''
	 * @param	string	$segment_two = ''
	 * @return	bool
	 */
	public function cache_delete($segment_one = '', $segment_two = '')
	{
		return $this->_cache_init()
			? $this->CACHE->delete($segment_one, $segment_two)
			: FALSE;
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
	}

	// --------------------------------------------------------------------

	/**
	 * Delete All cache files
	 *
<<<<<<< HEAD
	 * @access	public
	 * @return	void
	 */
	function cache_delete_all()
	{
		if ( ! $this->_cache_init())
		{
			return FALSE;
		}

		return $this->CACHE->delete_all();
=======
	 * @return	bool
	 */
	public function cache_delete_all()
	{
		return $this->_cache_init()
			? $this->CACHE->delete_all()
			: FALSE;
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
	}

	// --------------------------------------------------------------------

	/**
	 * Initialize the Cache Class
	 *
<<<<<<< HEAD
	 * @access	private
	 * @return	void
	 */
	function _cache_init()
	{
		if (is_object($this->CACHE) AND class_exists('CI_DB_Cache'))
		{
			return TRUE;
		}

		if ( ! class_exists('CI_DB_Cache'))
		{
			if ( ! @include(BASEPATH.'database/DB_cache.php'))
			{
				return $this->cache_off();
			}
=======
	 * @return	bool
	 */
	protected function _cache_init()
	{
		if ( ! class_exists('CI_DB_Cache', FALSE))
		{
			require_once(BASEPATH.'database/DB_cache.php');
		}
		elseif (is_object($this->CACHE))
		{
			return TRUE;
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
		}

		$this->CACHE = new CI_DB_Cache($this); // pass db object to support multiple db connections and returned db objects
		return TRUE;
	}

	// --------------------------------------------------------------------

	/**
	 * Close DB Connection
	 *
<<<<<<< HEAD
	 * @access	public
	 * @return	void
	 */
	function close()
	{
		if (is_resource($this->conn_id) OR is_object($this->conn_id))
		{
			$this->_close($this->conn_id);
		}
=======
	 * @return	void
	 */
	public function close()
	{
		if ($this->conn_id)
		{
			$this->_close();
			$this->conn_id = FALSE;
		}
	}

	// --------------------------------------------------------------------

	/**
	 * Close DB Connection
	 *
	 * This method would be overridden by most of the drivers.
	 *
	 * @return	void
	 */
	protected function _close()
	{
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
		$this->conn_id = FALSE;
	}

	// --------------------------------------------------------------------

	/**
	 * Display an error message
	 *
<<<<<<< HEAD
	 * @access	public
	 * @param	string	the error message
	 * @param	string	any "swap" values
	 * @param	boolean	whether to localize the message
	 * @return	string	sends the application/error_db.php template
	 */
	function display_error($error = '', $swap = '', $native = FALSE)
=======
	 * @param	string	the error message
	 * @param	string	any "swap" values
	 * @param	bool	whether to localize the message
	 * @return	string	sends the application/views/errors/error_db.php template
	 */
	public function display_error($error = '', $swap = '', $native = FALSE)
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
	{
		$LANG =& load_class('Lang', 'core');
		$LANG->load('db');

		$heading = $LANG->line('db_error_heading');

<<<<<<< HEAD
		if ($native == TRUE)
		{
			$message = $error;
		}
		else
		{
			$message = ( ! is_array($error)) ? array(str_replace('%s', $swap, $LANG->line($error))) : $error;
=======
		if ($native === TRUE)
		{
			$message = (array) $error;
		}
		else
		{
			$message = is_array($error) ? $error : array(str_replace('%s', $swap, $LANG->line($error)));
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
		}

		// Find the most likely culprit of the error by going through
		// the backtrace until the source file is no longer in the
		// database folder.
<<<<<<< HEAD

		$trace = debug_backtrace();

		foreach ($trace as $call)
		{
			if (isset($call['file']) && strpos($call['file'], BASEPATH.'database') === FALSE)
			{
				// Found it - use a relative path for safety
				$message[] = 'Filename: '.str_replace(array(BASEPATH, APPPATH), '', $call['file']);
				$message[] = 'Line Number: '.$call['line'];

				break;
=======
		$trace = debug_backtrace();
		foreach ($trace as $call)
		{
			if (isset($call['file'], $call['class']))
			{
				// We'll need this on Windows, as APPPATH and BASEPATH will always use forward slashes
				if (DIRECTORY_SEPARATOR !== '/')
				{
					$call['file'] = str_replace('\\', '/', $call['file']);
				}

				if (strpos($call['file'], BASEPATH.'database') === FALSE && strpos($call['class'], 'Loader') === FALSE)
				{
					// Found it - use a relative path for safety
					$message[] = 'Filename: '.str_replace(array(APPPATH, BASEPATH), '', $call['file']);
					$message[] = 'Line Number: '.$call['line'];
					break;
				}
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
			}
		}

		$error =& load_class('Exceptions', 'core');
		echo $error->show_error($heading, $message, 'error_db');
<<<<<<< HEAD
		exit;
	}

	// --------------------------------------------------------------------

	/**
	 * Protect Identifiers
	 *
	 * This function adds backticks if appropriate based on db type
	 *
	 * @access	private
	 * @param	mixed	the item to escape
	 * @return	mixed	the item with backticks
	 */
	function protect_identifiers($item, $prefix_single = FALSE)
	{
		return $this->_protect_identifiers($item, $prefix_single);
=======
		exit(8); // EXIT_DATABASE
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
	}

	// --------------------------------------------------------------------

	/**
	 * Protect Identifiers
	 *
<<<<<<< HEAD
	 * This function is used extensively by the Active Record class, and by
	 * a couple functions in this class.
	 * It takes a column or table name (optionally with an alias) and inserts
	 * the table prefix onto it.  Some logic is necessary in order to deal with
	 * column names that include the path.  Consider a query like this:
	 *
	 * SELECT * FROM hostname.database.table.column AS c FROM hostname.database.table
=======
	 * This function is used extensively by the Query Builder class, and by
	 * a couple functions in this class.
	 * It takes a column or table name (optionally with an alias) and inserts
	 * the table prefix onto it. Some logic is necessary in order to deal with
	 * column names that include the path. Consider a query like this:
	 *
	 * SELECT hostname.database.table.column AS c FROM hostname.database.table
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
	 *
	 * Or a query with aliasing:
	 *
	 * SELECT m.member_id, m.member_name FROM members AS m
	 *
	 * Since the column name can include up to four segments (host, DB, table, column)
	 * or also have an alias prefix, we need to do a bit of work to figure this out and
	 * insert the table prefix (if it exists) in the proper position, and escape only
	 * the correct identifiers.
	 *
<<<<<<< HEAD
	 * @access	private
=======
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
	 * @param	string
	 * @param	bool
	 * @param	mixed
	 * @param	bool
	 * @return	string
	 */
<<<<<<< HEAD
	function _protect_identifiers($item, $prefix_single = FALSE, $protect_identifiers = NULL, $field_exists = TRUE)
=======
	public function protect_identifiers($item, $prefix_single = FALSE, $protect_identifiers = NULL, $field_exists = TRUE)
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
	{
		if ( ! is_bool($protect_identifiers))
		{
			$protect_identifiers = $this->_protect_identifiers;
		}

		if (is_array($item))
		{
			$escaped_array = array();
<<<<<<< HEAD

			foreach ($item as $k => $v)
			{
				$escaped_array[$this->_protect_identifiers($k)] = $this->_protect_identifiers($v);
=======
			foreach ($item as $k => $v)
			{
				$escaped_array[$this->protect_identifiers($k)] = $this->protect_identifiers($v, $prefix_single, $protect_identifiers, $field_exists);
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
			}

			return $escaped_array;
		}

<<<<<<< HEAD
		// Convert tabs or multiple spaces into single spaces
		$item = preg_replace('/[\t ]+/', ' ', $item);

		// If the item has an alias declaration we remove it and set it aside.
		// Basically we remove everything to the right of the first space
		if (strpos($item, ' ') !== FALSE)
		{
			$alias = strstr($item, ' ');
			$item = substr($item, 0, - strlen($alias));
		}
		else
		{
			$alias = '';
		}

		// This is basically a bug fix for queries that use MAX, MIN, etc.
		// If a parenthesis is found we know that we do not need to
		// escape the data or add a prefix.  There's probably a more graceful
		// way to deal with this, but I'm not thinking of it -- Rick
		if (strpos($item, '(') !== FALSE)
		{
			return $item.$alias;
=======
		// This is basically a bug fix for queries that use MAX, MIN, etc.
		// If a parenthesis is found we know that we do not need to
		// escape the data or add a prefix. There's probably a more graceful
		// way to deal with this, but I'm not thinking of it -- Rick
		//
		// Added exception for single quotes as well, we don't want to alter
		// literal strings. -- Narf
		if (strcspn($item, "()'") !== strlen($item))
		{
			return $item;
		}

		// Convert tabs or multiple spaces into single spaces
		$item = preg_replace('/\s+/', ' ', trim($item));

		// If the item has an alias declaration we remove it and set it aside.
		// Note: strripos() is used in order to support spaces in table names
		if ($offset = strripos($item, ' AS '))
		{
			$alias = ($protect_identifiers)
				? substr($item, $offset, 4).$this->escape_identifiers(substr($item, $offset + 4))
				: substr($item, $offset);
			$item = substr($item, 0, $offset);
		}
		elseif ($offset = strrpos($item, ' '))
		{
			$alias = ($protect_identifiers)
				? ' '.$this->escape_identifiers(substr($item, $offset + 1))
				: substr($item, $offset);
			$item = substr($item, 0, $offset);
		}
		else
		{
			$alias = '';
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
		}

		// Break the string apart if it contains periods, then insert the table prefix
		// in the correct location, assuming the period doesn't indicate that we're dealing
		// with an alias. While we're at it, we will escape the components
		if (strpos($item, '.') !== FALSE)
		{
<<<<<<< HEAD
			$parts	= explode('.', $item);

			// Does the first segment of the exploded item match
			// one of the aliases previously identified?  If so,
			// we have nothing more to do other than escape the item
			if (in_array($parts[0], $this->ar_aliased_tables))
=======
			$parts = explode('.', $item);

			// Does the first segment of the exploded item match
			// one of the aliases previously identified? If so,
			// we have nothing more to do other than escape the item
			//
			// NOTE: The ! empty() condition prevents this method
			//       from breaking when QB isn't enabled.
			if ( ! empty($this->qb_aliased_tables) && in_array($parts[0], $this->qb_aliased_tables))
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
			{
				if ($protect_identifiers === TRUE)
				{
					foreach ($parts as $key => $val)
					{
						if ( ! in_array($val, $this->_reserved_identifiers))
						{
<<<<<<< HEAD
							$parts[$key] = $this->_escape_identifiers($val);
=======
							$parts[$key] = $this->escape_identifiers($val);
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
						}
					}

					$item = implode('.', $parts);
				}
<<<<<<< HEAD
				return $item.$alias;
			}

			// Is there a table prefix defined in the config file?  If not, no need to do anything
			if ($this->dbprefix != '')
=======

				return $item.$alias;
			}

			// Is there a table prefix defined in the config file? If not, no need to do anything
			if ($this->dbprefix !== '')
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
			{
				// We now add the table prefix based on some logic.
				// Do we have 4 segments (hostname.database.table.column)?
				// If so, we add the table prefix to the column name in the 3rd segment.
				if (isset($parts[3]))
				{
					$i = 2;
				}
				// Do we have 3 segments (database.table.column)?
				// If so, we add the table prefix to the column name in 2nd position
				elseif (isset($parts[2]))
				{
					$i = 1;
				}
				// Do we have 2 segments (table.column)?
				// If so, we add the table prefix to the column name in 1st segment
				else
				{
					$i = 0;
				}

				// This flag is set when the supplied $item does not contain a field name.
				// This can happen when this function is being called from a JOIN.
<<<<<<< HEAD
				if ($field_exists == FALSE)
=======
				if ($field_exists === FALSE)
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
				{
					$i++;
				}

				// Verify table prefix and replace if necessary
<<<<<<< HEAD
				if ($this->swap_pre != '' && strncmp($parts[$i], $this->swap_pre, strlen($this->swap_pre)) === 0)
				{
					$parts[$i] = preg_replace("/^".$this->swap_pre."(\S+?)/", $this->dbprefix."\\1", $parts[$i]);
				}

				// We only add the table prefix if it does not already exist
				if (substr($parts[$i], 0, strlen($this->dbprefix)) != $this->dbprefix)
=======
				if ($this->swap_pre !== '' && strpos($parts[$i], $this->swap_pre) === 0)
				{
					$parts[$i] = preg_replace('/^'.$this->swap_pre.'(\S+?)/', $this->dbprefix.'\\1', $parts[$i]);
				}
				// We only add the table prefix if it does not already exist
				elseif (strpos($parts[$i], $this->dbprefix) !== 0)
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
				{
					$parts[$i] = $this->dbprefix.$parts[$i];
				}

				// Put the parts back together
				$item = implode('.', $parts);
			}

			if ($protect_identifiers === TRUE)
			{
<<<<<<< HEAD
				$item = $this->_escape_identifiers($item);
=======
				$item = $this->escape_identifiers($item);
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
			}

			return $item.$alias;
		}

<<<<<<< HEAD
		// Is there a table prefix?  If not, no need to insert it
		if ($this->dbprefix != '')
		{
			// Verify table prefix and replace if necessary
			if ($this->swap_pre != '' && strncmp($item, $this->swap_pre, strlen($this->swap_pre)) === 0)
			{
				$item = preg_replace("/^".$this->swap_pre."(\S+?)/", $this->dbprefix."\\1", $item);
			}

			// Do we prefix an item with no segments?
			if ($prefix_single == TRUE AND substr($item, 0, strlen($this->dbprefix)) != $this->dbprefix)
=======
		// Is there a table prefix? If not, no need to insert it
		if ($this->dbprefix !== '')
		{
			// Verify table prefix and replace if necessary
			if ($this->swap_pre !== '' && strpos($item, $this->swap_pre) === 0)
			{
				$item = preg_replace('/^'.$this->swap_pre.'(\S+?)/', $this->dbprefix.'\\1', $item);
			}
			// Do we prefix an item with no segments?
			elseif ($prefix_single === TRUE && strpos($item, $this->dbprefix) !== 0)
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
			{
				$item = $this->dbprefix.$item;
			}
		}

<<<<<<< HEAD
		if ($protect_identifiers === TRUE AND ! in_array($item, $this->_reserved_identifiers))
		{
			$item = $this->_escape_identifiers($item);
=======
		if ($protect_identifiers === TRUE && ! in_array($item, $this->_reserved_identifiers))
		{
			$item = $this->escape_identifiers($item);
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
		}

		return $item.$alias;
	}

	// --------------------------------------------------------------------

	/**
<<<<<<< HEAD
	 * Dummy method that allows Active Record class to be disabled
	 *
	 * This function is used extensively by every db driver.
=======
	 * Dummy method that allows Query Builder class to be disabled
	 * and keep count_all() working.
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
	 *
	 * @return	void
	 */
	protected function _reset_select()
	{
	}

}
<<<<<<< HEAD

/* End of file DB_driver.php */
/* Location: ./system/database/DB_driver.php */
=======
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
