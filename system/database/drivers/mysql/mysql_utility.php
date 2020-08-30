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
 * MySQL Utility Class
 *
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
class CI_DB_mysql_utility extends CI_DB_utility {

	/**
<<<<<<< HEAD
<<<<<<< HEAD
	 * List databases
	 *
	 * @access	private
	 * @return	bool
	 */
	function _list_databases()
	{
		return "SHOW DATABASES";
	}

	// --------------------------------------------------------------------

	/**
	 * Optimize table query
	 *
	 * Generates a platform-specific query so that a table can be optimized
	 *
	 * @access	private
	 * @param	string	the table name
	 * @return	object
	 */
	function _optimize_table($table)
	{
		return "OPTIMIZE TABLE ".$this->db->_escape_identifiers($table);
	}

	// --------------------------------------------------------------------

	/**
	 * Repair table query
	 *
	 * Generates a platform-specific query so that a table can be repaired
	 *
	 * @access	private
	 * @param	string	the table name
	 * @return	object
	 */
	function _repair_table($table)
	{
		return "REPAIR TABLE ".$this->db->_escape_identifiers($table);
	}

	// --------------------------------------------------------------------
	/**
	 * MySQL Export
	 *
	 * @access	private
	 * @param	array	Preferences
	 * @return	mixed
	 */
	function _backup($params = array())
	{
		if (count($params) == 0)
=======
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	 * List databases statement
	 *
	 * @var	string
	 */
	protected $_list_databases	= 'SHOW DATABASES';

	/**
	 * OPTIMIZE TABLE statement
	 *
	 * @var	string
	 */
	protected $_optimize_table	= 'OPTIMIZE TABLE %s';

	/**
	 * REPAIR TABLE statement
	 *
	 * @var	string
	 */
	protected $_repair_table	= 'REPAIR TABLE %s';

	// --------------------------------------------------------------------

	/**
	 * Export
	 *
	 * @param	array	$params	Preferences
	 * @return	mixed
	 */
	protected function _backup($params = array())
	{
		if (count($params) === 0)
<<<<<<< HEAD
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
		{
			return FALSE;
		}

		// Extract the prefs for simplicity
		extract($params);

		// Build the output
		$output = '';
<<<<<<< HEAD
<<<<<<< HEAD
		foreach ((array)$tables as $table)
		{
			// Is the table in the "ignore" list?
			if (in_array($table, (array)$ignore, TRUE))
=======
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3

		// Do we need to include a statement to disable foreign key checks?
		if ($foreign_key_checks === FALSE)
		{
			$output .= 'SET foreign_key_checks = 0;'.$newline;
		}

		foreach ( (array) $tables as $table)
		{
			// Is the table in the "ignore" list?
			if (in_array($table, (array) $ignore, TRUE))
<<<<<<< HEAD
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
			{
				continue;
			}

			// Get the table schema
<<<<<<< HEAD
<<<<<<< HEAD
			$query = $this->db->query("SHOW CREATE TABLE `".$this->db->database.'`.`'.$table.'`');
=======
			$query = $this->db->query('SHOW CREATE TABLE '.$this->db->escape_identifiers($this->db->database.'.'.$table));
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
			$query = $this->db->query('SHOW CREATE TABLE '.$this->db->escape_identifiers($this->db->database.'.'.$table));
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3

			// No result means the table name was invalid
			if ($query === FALSE)
			{
				continue;
			}

			// Write out the table schema
			$output .= '#'.$newline.'# TABLE STRUCTURE FOR: '.$table.$newline.'#'.$newline.$newline;

<<<<<<< HEAD
<<<<<<< HEAD
			if ($add_drop == TRUE)
			{
				$output .= 'DROP TABLE IF EXISTS '.$table.';'.$newline.$newline;
=======
			if ($add_drop === TRUE)
			{
				$output .= 'DROP TABLE IF EXISTS '.$this->db->protect_identifiers($table).';'.$newline.$newline;
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
			if ($add_drop === TRUE)
			{
				$output .= 'DROP TABLE IF EXISTS '.$this->db->protect_identifiers($table).';'.$newline.$newline;
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
			}

			$i = 0;
			$result = $query->result_array();
			foreach ($result[0] as $val)
			{
				if ($i++ % 2)
				{
					$output .= $val.';'.$newline.$newline;
				}
			}

			// If inserts are not needed we're done...
<<<<<<< HEAD
<<<<<<< HEAD
			if ($add_insert == FALSE)
=======
			if ($add_insert === FALSE)
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
			if ($add_insert === FALSE)
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
			{
				continue;
			}

			// Grab all the data from the current table
<<<<<<< HEAD
<<<<<<< HEAD
			$query = $this->db->query("SELECT * FROM $table");

			if ($query->num_rows() == 0)
=======
			$query = $this->db->query('SELECT * FROM '.$this->db->protect_identifiers($table));

			if ($query->num_rows() === 0)
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
			$query = $this->db->query('SELECT * FROM '.$this->db->protect_identifiers($table));

			if ($query->num_rows() === 0)
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
			{
				continue;
			}

			// Fetch the field names and determine if the field is an
<<<<<<< HEAD
<<<<<<< HEAD
			// integer type.  We use this info to decide whether to
=======
			// integer type. We use this info to decide whether to
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
			// integer type. We use this info to decide whether to
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
			// surround the data with quotes or not

			$i = 0;
			$field_str = '';
			$is_int = array();
			while ($field = mysql_fetch_field($query->result_id))
			{
				// Most versions of MySQL store timestamp as a string
<<<<<<< HEAD
<<<<<<< HEAD
				$is_int[$i] = (in_array(
										strtolower(mysql_field_type($query->result_id, $i)),
										array('tinyint', 'smallint', 'mediumint', 'int', 'bigint'), //, 'timestamp'),
										TRUE)
										) ? TRUE : FALSE;

				// Create a string of field names
				$field_str .= '`'.$field->name.'`, ';
=======
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
				$is_int[$i] = in_array(strtolower(mysql_field_type($query->result_id, $i)),
							array('tinyint', 'smallint', 'mediumint', 'int', 'bigint'), //, 'timestamp'),
							TRUE);

				// Create a string of field names
				$field_str .= $this->db->escape_identifiers($field->name).', ';
<<<<<<< HEAD
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
				$i++;
			}

			// Trim off the end comma
<<<<<<< HEAD
<<<<<<< HEAD
			$field_str = preg_replace( "/, $/" , "" , $field_str);

=======
			$field_str = preg_replace('/, $/' , '', $field_str);
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
			$field_str = preg_replace('/, $/' , '', $field_str);
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3

			// Build the insert string
			foreach ($query->result_array() as $row)
			{
				$val_str = '';

				$i = 0;
				foreach ($row as $v)
				{
					// Is the value NULL?
					if ($v === NULL)
					{
						$val_str .= 'NULL';
					}
					else
					{
						// Escape the data if it's not an integer
<<<<<<< HEAD
<<<<<<< HEAD
						if ($is_int[$i] == FALSE)
						{
							$val_str .= $this->db->escape($v);
						}
						else
						{
							$val_str .= $v;
						}
=======
						$val_str .= ($is_int[$i] === FALSE) ? $this->db->escape($v) : $v;
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
						$val_str .= ($is_int[$i] === FALSE) ? $this->db->escape($v) : $v;
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
					}

					// Append a comma
					$val_str .= ', ';
					$i++;
				}

				// Remove the comma at the end of the string
<<<<<<< HEAD
<<<<<<< HEAD
				$val_str = preg_replace( "/, $/" , "" , $val_str);

				// Build the INSERT string
				$output .= 'INSERT INTO '.$table.' ('.$field_str.') VALUES ('.$val_str.');'.$newline;
=======
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
				$val_str = preg_replace('/, $/' , '', $val_str);

				// Build the INSERT string
				$output .= 'INSERT INTO '.$this->db->protect_identifiers($table).' ('.$field_str.') VALUES ('.$val_str.');'.$newline;
<<<<<<< HEAD
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
			}

			$output .= $newline.$newline;
		}

<<<<<<< HEAD
<<<<<<< HEAD
		return $output;
	}
}

/* End of file mysql_utility.php */
/* Location: ./system/database/drivers/mysql/mysql_utility.php */
=======
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
		// Do we need to include a statement to re-enable foreign key checks?
		if ($foreign_key_checks === FALSE)
		{
			$output .= 'SET foreign_key_checks = 1;'.$newline;
		}

		return $output;
	}

}
<<<<<<< HEAD
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
