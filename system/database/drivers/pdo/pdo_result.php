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
 * @since		Version 2.1.2
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
 * @since	Version 2.1.0
 * @filesource
 */
defined('BASEPATH') OR exit('No direct script access allowed');
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd

/**
 * PDO Result Class
 *
 * This class extends the parent result class: CI_DB_result
 *
<<<<<<< HEAD
 * @category	Database
 * @author		EllisLab Dev Team
 * @link		http://codeigniter.com/user_guide/database/
 */
class CI_DB_pdo_result extends CI_DB_result {

	public $num_rows;

=======
 * @package		CodeIgniter
 * @subpackage	Drivers
 * @category	Database
 * @author		EllisLab Dev Team
 * @link		https://codeigniter.com/user_guide/database/
 */
class CI_DB_pdo_result extends CI_DB_result {

>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
	/**
	 * Number of rows in the result set
	 *
	 * @return	int
	 */
	public function num_rows()
	{
		if (is_int($this->num_rows))
		{
			return $this->num_rows;
		}
<<<<<<< HEAD
		elseif (($this->num_rows = $this->result_id->rowCount()) > 0)
		{
			return $this->num_rows;
		}

		$this->num_rows = count($this->result_id->fetchAll());
		$this->result_id->execute();
		return $this->num_rows;
=======
		elseif (count($this->result_array) > 0)
		{
			return $this->num_rows = count($this->result_array);
		}
		elseif (count($this->result_object) > 0)
		{
			return $this->num_rows = count($this->result_object);
		}
		elseif (($num_rows = $this->result_id->rowCount()) > 0)
		{
			return $this->num_rows = $num_rows;
		}

		return $this->num_rows = count($this->result_array());
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
		return $this->result_id->columnCount();
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
		if ($this->db->db_debug)
		{
			return $this->db->display_error('db_unsuported_feature');
		}
		return FALSE;
=======
	 * @return	bool
	 */
	public function list_fields()
	{
		$field_names = array();
		for ($i = 0, $c = $this->num_fields(); $i < $c; $i++)
		{
			// Might trigger an E_WARNING due to not all subdrivers
			// supporting getColumnMeta()
			$field_names[$i] = @$this->result_id->getColumnMeta($i);
			$field_names[$i] = $field_names[$i]['name'];
		}

		return $field_names;
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
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
		$data = array();
	
		try
		{
			for($i = 0; $i < $this->num_fields(); $i++)
			{
				$data[] = $this->result_id->getColumnMeta($i);
			}
			
			return $data;
=======
	 * @return	array
	 */
	public function field_data()
	{
		try
		{
			$retval = array();

			for ($i = 0, $c = $this->num_fields(); $i < $c; $i++)
			{
				$field = $this->result_id->getColumnMeta($i);

				$retval[$i]			= new stdClass();
				$retval[$i]->name		= $field['name'];
				$retval[$i]->type		= $field['native_type'];
				$retval[$i]->max_length		= ($field['len'] > 0) ? $field['len'] : NULL;
				$retval[$i]->primary_key	= (int) ( ! empty($field['flags']) && in_array('primary_key', $field['flags'], TRUE));
			}

			return $retval;
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
		}
		catch (Exception $e)
		{
			if ($this->db->db_debug)
			{
<<<<<<< HEAD
				return $this->db->display_error('db_unsuported_feature');
			}
=======
				return $this->db->display_error('db_unsupported_feature');
			}

>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
			return FALSE;
		}
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
		if (is_object($this->result_id))
		{
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
		return FALSE;
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
		return $this->result_id->fetch(PDO::FETCH_ASSOC);
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
		return $this->result_id->fetchObject();
	}

}


/* End of file pdo_result.php */
/* Location: ./system/database/drivers/pdo/pdo_result.php */
=======
	 * @param	string	$class_name
	 * @return	object
	 */
	protected function _fetch_object($class_name = 'stdClass')
	{
		return $this->result_id->fetchObject($class_name);
	}

}
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
