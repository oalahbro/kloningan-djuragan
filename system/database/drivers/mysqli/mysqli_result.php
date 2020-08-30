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
 * @since	Version 1.3.0
 * @filesource
 */
defined('BASEPATH') OR exit('No direct script access allowed');
<<<<<<< HEAD
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3

/**
 * MySQLi Result Class
 *
 * This class extends the parent result class: CI_DB_result
 *
<<<<<<< HEAD
<<<<<<< HEAD
 * @category	Database
 * @author		EllisLab Dev Team
 * @link		http://codeigniter.com/user_guide/database/
=======
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
 * @package		CodeIgniter
 * @subpackage	Drivers
 * @category	Database
 * @author		EllisLab Dev Team
 * @link		https://codeigniter.com/user_guide/database/
<<<<<<< HEAD
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
 */
class CI_DB_mysqli_result extends CI_DB_result {

	/**
	 * Number of rows in the result set
	 *
<<<<<<< HEAD
<<<<<<< HEAD
	 * @access	public
	 * @return	integer
	 */
	function num_rows()
	{
		return @mysqli_num_rows($this->result_id);
=======
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	 * @return	int
	 */
	public function num_rows()
	{
		return is_int($this->num_rows)
			? $this->num_rows
			: $this->num_rows = $this->result_id->num_rows;
<<<<<<< HEAD
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	}

	// --------------------------------------------------------------------

	/**
	 * Number of fields in the result set
	 *
<<<<<<< HEAD
<<<<<<< HEAD
	 * @access	public
	 * @return	integer
	 */
	function num_fields()
	{
		return @mysqli_num_fields($this->result_id);
=======
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	 * @return	int
	 */
	public function num_fields()
	{
		return $this->result_id->field_count;
<<<<<<< HEAD
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	}

	// --------------------------------------------------------------------

	/**
	 * Fetch Field Names
	 *
	 * Generates an array of column names
	 *
<<<<<<< HEAD
<<<<<<< HEAD
	 * @access	public
	 * @return	array
	 */
	function list_fields()
	{
		$field_names = array();
		while ($field = mysqli_fetch_field($this->result_id))
=======
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	 * @return	array
	 */
	public function list_fields()
	{
		$field_names = array();
		$this->result_id->field_seek(0);
		while ($field = $this->result_id->fetch_field())
<<<<<<< HEAD
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
		{
			$field_names[] = $field->name;
		}

		return $field_names;
	}

	// --------------------------------------------------------------------

	/**
	 * Field data
	 *
	 * Generates an array of objects containing field meta-data
	 *
<<<<<<< HEAD
<<<<<<< HEAD
	 * @access	public
	 * @return	array
	 */
	function field_data()
	{
		$retval = array();
		while ($field = mysqli_fetch_object($this->result_id))
		{
			preg_match('/([a-zA-Z]+)(\(\d+\))?/', $field->Type, $matches);

			$type = (array_key_exists(1, $matches)) ? $matches[1] : NULL;
			$length = (array_key_exists(2, $matches)) ? preg_replace('/[^\d]/', '', $matches[2]) : NULL;

			$F				= new stdClass();
			$F->name		= $field->Field;
			$F->type		= $type;
			$F->default		= $field->Default;
			$F->max_length	= $length;
			$F->primary_key = ( $field->Key == 'PRI' ? 1 : 0 );

			$retval[] = $F;
=======
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	 * @return	array
	 */
	public function field_data()
	{
		$retval = array();
		$field_data = $this->result_id->fetch_fields();
		for ($i = 0, $c = count($field_data); $i < $c; $i++)
		{
			$retval[$i]			= new stdClass();
			$retval[$i]->name		= $field_data[$i]->name;
			$retval[$i]->type		= $field_data[$i]->type;
			$retval[$i]->max_length		= $field_data[$i]->max_length;
			$retval[$i]->primary_key	= (int) ($field_data[$i]->flags & 2);
			$retval[$i]->default		= $field_data[$i]->def;
<<<<<<< HEAD
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
		}

		return $retval;
	}
<<<<<<< HEAD
<<<<<<< HEAD
	
=======

>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======

>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	// --------------------------------------------------------------------

	/**
	 * Free the result
	 *
<<<<<<< HEAD
<<<<<<< HEAD
	 * @return	null
	 */
	function free_result()
	{
		if (is_object($this->result_id))
		{
			mysqli_free_result($this->result_id);
=======
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	 * @return	void
	 */
	public function free_result()
	{
		if (is_object($this->result_id))
		{
			$this->result_id->free();
<<<<<<< HEAD
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
			$this->result_id = FALSE;
		}
	}

	// --------------------------------------------------------------------

	/**
	 * Data Seek
	 *
<<<<<<< HEAD
<<<<<<< HEAD
	 * Moves the internal pointer to the desired offset.  We call
	 * this internally before fetching results to make sure the
	 * result set starts at zero
	 *
	 * @access	private
	 * @return	array
	 */
	function _data_seek($n = 0)
	{
		return mysqli_data_seek($this->result_id, $n);
=======
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	 * Moves the internal pointer to the desired offset. We call
	 * this internally before fetching results to make sure the
	 * result set starts at zero.
	 *
	 * @param	int	$n
	 * @return	bool
	 */
	public function data_seek($n = 0)
	{
		return $this->result_id->data_seek($n);
<<<<<<< HEAD
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	}

	// --------------------------------------------------------------------

	/**
	 * Result - associative array
	 *
	 * Returns the result set as an array
	 *
<<<<<<< HEAD
<<<<<<< HEAD
	 * @access	private
	 * @return	array
	 */
	function _fetch_assoc()
	{
		return mysqli_fetch_assoc($this->result_id);
=======
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	 * @return	array
	 */
	protected function _fetch_assoc()
	{
		return $this->result_id->fetch_assoc();
<<<<<<< HEAD
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	}

	// --------------------------------------------------------------------

	/**
	 * Result - object
	 *
	 * Returns the result set as an object
	 *
<<<<<<< HEAD
<<<<<<< HEAD
	 * @access	private
	 * @return	object
	 */
	function _fetch_object()
	{
		return mysqli_fetch_object($this->result_id);
	}

}


/* End of file mysqli_result.php */
/* Location: ./system/database/drivers/mysqli/mysqli_result.php */
=======
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	 * @param	string	$class_name
	 * @return	object
	 */
	protected function _fetch_object($class_name = 'stdClass')
	{
		return $this->result_id->fetch_object($class_name);
	}

}
<<<<<<< HEAD
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
