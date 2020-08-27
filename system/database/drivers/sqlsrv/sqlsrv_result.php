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
 * @since	Version 2.0.3
 * @filesource
 */
defined('BASEPATH') OR exit('No direct script access allowed');
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd

/**
 * SQLSRV Result Class
 *
 * This class extends the parent result class: CI_DB_result
 *
 * @category	Database
 * @author		EllisLab Dev Team
<<<<<<< HEAD
 * @link		http://codeigniter.com/user_guide/database/
=======
 * @link		https://codeigniter.com/user_guide/database/
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
 */
class CI_DB_sqlsrv_result extends CI_DB_result {

	/**
<<<<<<< HEAD
	 * Number of rows in the result set
	 *
	 * @access	public
	 * @return	integer
	 */
	function num_rows()
	{
		return @sqlsrv_num_rows($this->result_id);
=======
	 * Scrollable flag
	 *
	 * @var	mixed
	 */
	public $scrollable;

	// --------------------------------------------------------------------

	/**
	 * Constructor
	 *
	 * @param	object	$driver_object
	 * @return	void
	 */
	public function __construct(&$driver_object)
	{
		parent::__construct($driver_object);

		$this->scrollable = $driver_object->scrollable;
	}

	// --------------------------------------------------------------------

	/**
	 * Number of rows in the result set
	 *
	 * @return	int
	 */
	public function num_rows()
	{
		// sqlsrv_num_rows() doesn't work with the FORWARD and DYNAMIC cursors (FALSE is the same as FORWARD)
		if ( ! in_array($this->scrollable, array(FALSE, SQLSRV_CURSOR_FORWARD, SQLSRV_CURSOR_DYNAMIC), TRUE))
		{
			return parent::num_rows();
		}

		return is_int($this->num_rows)
			? $this->num_rows
			: $this->num_rows = sqlsrv_num_rows($this->result_id);
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
	}

	// --------------------------------------------------------------------

	/**
	 * Number of fields in the result set
	 *
<<<<<<< HEAD
	 * @access	public
	 * @return	integer
	 */
	function num_fields()
=======
	 * @return	int
	 */
	public function num_fields()
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
	{
		return @sqlsrv_num_fields($this->result_id);
	}

	// --------------------------------------------------------------------

	/**
	 * Fetch Field Names
	 *
	 * Generates an array of column names
	 *
<<<<<<< HEAD
	 * @access	public
	 * @return	array
	 */
	function list_fields()
	{
		$field_names = array();
		foreach(sqlsrv_field_metadata($this->result_id) as $offset => $field)
		{
			$field_names[] = $field['Name'];
		}
		
=======
	 * @return	array
	 */
	public function list_fields()
	{
		$field_names = array();
		foreach (sqlsrv_field_metadata($this->result_id) as $offset => $field)
		{
			$field_names[] = $field['Name'];
		}

>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
		return $field_names;
	}

	// --------------------------------------------------------------------

	/**
	 * Field data
	 *
	 * Generates an array of objects containing field meta-data
	 *
<<<<<<< HEAD
	 * @access	public
	 * @return	array
	 */
	function field_data()
	{
		$retval = array();
		foreach(sqlsrv_field_metadata($this->result_id) as $offset => $field)
		{
			$F 				= new stdClass();
			$F->name 		= $field['Name'];
			$F->type 		= $field['Type'];
			$F->max_length	= $field['Size'];
			$F->primary_key = 0;
			$F->default		= '';
			
			$retval[] = $F;
		}
		
=======
	 * @return	array
	 */
	public function field_data()
	{
		$retval = array();
		foreach (sqlsrv_field_metadata($this->result_id) as $i => $field)
		{
			$retval[$i]		= new stdClass();
			$retval[$i]->name	= $field['Name'];
			$retval[$i]->type	= $field['Type'];
			$retval[$i]->max_length	= $field['Size'];
		}

>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
		return $retval;
	}

	// --------------------------------------------------------------------

	/**
	 * Free the result
	 *
<<<<<<< HEAD
	 * @return	null
	 */
	function free_result()
=======
	 * @return	void
	 */
	public function free_result()
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
	{
		if (is_resource($this->result_id))
		{
			sqlsrv_free_stmt($this->result_id);
			$this->result_id = FALSE;
		}
	}

	// --------------------------------------------------------------------

	/**
<<<<<<< HEAD
	 * Data Seek
	 *
	 * Moves the internal pointer to the desired offset.  We call
	 * this internally before fetching results to make sure the
	 * result set starts at zero
	 *
	 * @access	private
	 * @return	array
	 */
	function _data_seek($n = 0)
	{
		// Not implemented
	}

	// --------------------------------------------------------------------

	/**
=======
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
	 * Result - associative array
	 *
	 * Returns the result set as an array
	 *
<<<<<<< HEAD
	 * @access	private
	 * @return	array
	 */
	function _fetch_assoc()
=======
	 * @return	array
	 */
	protected function _fetch_assoc()
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
	{
		return sqlsrv_fetch_array($this->result_id, SQLSRV_FETCH_ASSOC);
	}

	// --------------------------------------------------------------------

	/**
	 * Result - object
	 *
	 * Returns the result set as an object
	 *
<<<<<<< HEAD
	 * @access	private
	 * @return	object
	 */
	function _fetch_object()
	{
		return sqlsrv_fetch_object($this->result_id);
	}

}


/* End of file mssql_result.php */
/* Location: ./system/database/drivers/mssql/mssql_result.php */
=======
	 * @param	string	$class_name
	 * @return	object
	 */
	protected function _fetch_object($class_name = 'stdClass')
	{
		return sqlsrv_fetch_object($this->result_id, $class_name);
	}

}
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
