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
 * MySQL Forge Class
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
class CI_DB_mysql_forge extends CI_DB_forge {

	/**
<<<<<<< HEAD
<<<<<<< HEAD
	 * Create database
	 *
	 * @access	private
	 * @param	string	the database name
	 * @return	bool
	 */
	function _create_database($name)
	{
		return "CREATE DATABASE ".$name;
	}

	// --------------------------------------------------------------------

	/**
	 * Drop database
	 *
	 * @access	private
	 * @param	string	the database name
	 * @return	bool
	 */
	function _drop_database($name)
	{
		return "DROP DATABASE ".$name;
	}
=======
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	 * CREATE DATABASE statement
	 *
	 * @var	string
	 */
	protected $_create_database	= 'CREATE DATABASE %s CHARACTER SET %s COLLATE %s';

	/**
	 * CREATE TABLE keys flag
	 *
	 * Whether table keys are created from within the
	 * CREATE TABLE statement.
	 *
	 * @var	bool
	 */
	protected $_create_table_keys	= TRUE;

	/**
	 * UNSIGNED support
	 *
	 * @var	array
	 */
	protected $_unsigned		= array(
		'TINYINT',
		'SMALLINT',
		'MEDIUMINT',
		'INT',
		'INTEGER',
		'BIGINT',
		'REAL',
		'DOUBLE',
		'DOUBLE PRECISION',
		'FLOAT',
		'DECIMAL',
		'NUMERIC'
	);

	/**
	 * NULL value representation in CREATE/ALTER TABLE statements
	 *
	 * @var	string
	 */
	protected $_null = 'NULL';
<<<<<<< HEAD
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3

	// --------------------------------------------------------------------

	/**
<<<<<<< HEAD
<<<<<<< HEAD
	 * Process Fields
	 *
	 * @access	private
	 * @param	mixed	the fields
	 * @return	string
	 */
	function _process_fields($fields)
	{
		$current_field_count = 0;
		$sql = '';

		foreach ($fields as $field=>$attributes)
		{
			// Numeric field names aren't allowed in databases, so if the key is
			// numeric, we know it was assigned by PHP and the developer manually
			// entered the field information, so we'll simply add it to the list
			if (is_numeric($field))
			{
				$sql .= "\n\t$attributes";
			}
			else
			{
				$attributes = array_change_key_case($attributes, CASE_UPPER);

				$sql .= "\n\t".$this->db->_protect_identifiers($field);

				if (array_key_exists('NAME', $attributes))
				{
					$sql .= ' '.$this->db->_protect_identifiers($attributes['NAME']).' ';
				}

				if (array_key_exists('TYPE', $attributes))
				{
					$sql .=  ' '.$attributes['TYPE'];

					if (array_key_exists('CONSTRAINT', $attributes))
					{
						switch ($attributes['TYPE'])
						{
							case 'decimal':
							case 'float':
							case 'numeric':
								$sql .= '('.implode(',', $attributes['CONSTRAINT']).')';
							break;

							case 'enum':
							case 'set':
								$sql .= '("'.implode('","', $attributes['CONSTRAINT']).'")';
							break;

							default:
								$sql .= '('.$attributes['CONSTRAINT'].')';
						}
					}
				}

				if (array_key_exists('UNSIGNED', $attributes) && $attributes['UNSIGNED'] === TRUE)
				{
					$sql .= ' UNSIGNED';
				}

				if (array_key_exists('DEFAULT', $attributes))
				{
					$sql .= ' DEFAULT \''.$attributes['DEFAULT'].'\'';
				}

				if (array_key_exists('NULL', $attributes) && $attributes['NULL'] === TRUE)
				{
					$sql .= ' NULL';
				}
				else
				{
					$sql .= ' NOT NULL';
				}

				if (array_key_exists('AUTO_INCREMENT', $attributes) && $attributes['AUTO_INCREMENT'] === TRUE)
				{
					$sql .= ' AUTO_INCREMENT';
				}
			}

			// don't add a comma on the end of the last field
			if (++$current_field_count < count($fields))
			{
				$sql .= ',';
			}
=======
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	 * CREATE TABLE attributes
	 *
	 * @param	array	$attributes	Associative array of table attributes
	 * @return	string
	 */
	protected function _create_table_attr($attributes)
	{
		$sql = '';

		foreach (array_keys($attributes) as $key)
		{
			if (is_string($key))
			{
				$sql .= ' '.strtoupper($key).' = '.$attributes[$key];
			}
		}

		if ( ! empty($this->db->char_set) && ! strpos($sql, 'CHARACTER SET') && ! strpos($sql, 'CHARSET'))
		{
			$sql .= ' DEFAULT CHARACTER SET = '.$this->db->char_set;
		}

		if ( ! empty($this->db->dbcollat) && ! strpos($sql, 'COLLATE'))
		{
			$sql .= ' COLLATE = '.$this->db->dbcollat;
<<<<<<< HEAD
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
		}

		return $sql;
	}

	// --------------------------------------------------------------------

	/**
<<<<<<< HEAD
<<<<<<< HEAD
	 * Create Table
	 *
	 * @access	private
	 * @param	string	the table name
	 * @param	mixed	the fields
	 * @param	mixed	primary key(s)
	 * @param	mixed	key(s)
	 * @param	boolean	should 'IF NOT EXISTS' be added to the SQL
	 * @return	bool
	 */
	function _create_table($table, $fields, $primary_keys, $keys, $if_not_exists)
	{
		$sql = 'CREATE TABLE ';

		if ($if_not_exists === TRUE)
		{
			$sql .= 'IF NOT EXISTS ';
		}

		$sql .= $this->db->_escape_identifiers($table)." (";

		$sql .= $this->_process_fields($fields);

		if (count($primary_keys) > 0)
		{
			$key_name = $this->db->_protect_identifiers(implode('_', $primary_keys));
			$primary_keys = $this->db->_protect_identifiers($primary_keys);
			$sql .= ",\n\tPRIMARY KEY ".$key_name." (" . implode(', ', $primary_keys) . ")";
		}

		if (is_array($keys) && count($keys) > 0)
		{
			foreach ($keys as $key)
			{
				if (is_array($key))
				{
					$key_name = $this->db->_protect_identifiers(implode('_', $key));
					$key = $this->db->_protect_identifiers($key);
				}
				else
				{
					$key_name = $this->db->_protect_identifiers($key);
					$key = array($key_name);
				}

				$sql .= ",\n\tKEY {$key_name} (" . implode(', ', $key) . ")";
			}
		}

		$sql .= "\n) DEFAULT CHARACTER SET {$this->db->char_set} COLLATE {$this->db->dbcollat};";

		return $sql;
=======
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	 * ALTER TABLE
	 *
	 * @param	string	$alter_type	ALTER type
	 * @param	string	$table		Table name
	 * @param	mixed	$field		Column definition
	 * @return	string|string[]
	 */
	protected function _alter_table($alter_type, $table, $field)
	{
		if ($alter_type === 'DROP')
		{
			return parent::_alter_table($alter_type, $table, $field);
		}

		$sql = 'ALTER TABLE '.$this->db->escape_identifiers($table);
		for ($i = 0, $c = count($field); $i < $c; $i++)
		{
			if ($field[$i]['_literal'] !== FALSE)
			{
				$field[$i] = ($alter_type === 'ADD')
						? "\n\tADD ".$field[$i]['_literal']
						: "\n\tMODIFY ".$field[$i]['_literal'];
			}
			else
			{
				if ($alter_type === 'ADD')
				{
					$field[$i]['_literal'] = "\n\tADD ";
				}
				else
				{
					$field[$i]['_literal'] = empty($field[$i]['new_name']) ? "\n\tMODIFY " : "\n\tCHANGE ";
				}

				$field[$i] = $field[$i]['_literal'].$this->_process_column($field[$i]);
			}
		}

		return array($sql.implode(',', $field));
<<<<<<< HEAD
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	}

	// --------------------------------------------------------------------

	/**
<<<<<<< HEAD
<<<<<<< HEAD
	 * Drop Table
	 *
	 * @access	private
	 * @return	string
	 */
	function _drop_table($table)
	{
		return "DROP TABLE IF EXISTS ".$this->db->_escape_identifiers($table);
=======
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	 * Process column
	 *
	 * @param	array	$field
	 * @return	string
	 */
	protected function _process_column($field)
	{
		$extra_clause = isset($field['after'])
			? ' AFTER '.$this->db->escape_identifiers($field['after']) : '';

		if (empty($extra_clause) && isset($field['first']) && $field['first'] === TRUE)
		{
			$extra_clause = ' FIRST';
		}


		return $this->db->escape_identifiers($field['name'])
			.(empty($field['new_name']) ? '' : ' '.$this->db->escape_identifiers($field['new_name']))
			.' '.$field['type'].$field['length']
			.$field['unsigned']
			.$field['null']
			.$field['default']
			.$field['auto_increment']
			.$field['unique']
			.(empty($field['comment']) ? '' : ' COMMENT '.$field['comment'])
			.$extra_clause;
<<<<<<< HEAD
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
	}

	// --------------------------------------------------------------------

	/**
<<<<<<< HEAD
	 * Alter table query
	 *
	 * Generates a platform-specific query so that a table can be altered
	 * Called by add_column(), drop_column(), and column_alter(),
	 *
	 * @access	private
	 * @param	string	the ALTER type (ADD, DROP, CHANGE)
	 * @param	string	the column name
	 * @param	array	fields
	 * @param	string	the field after which we should add the new field
	 * @return	object
	 */
	function _alter_table($alter_type, $table, $fields, $after_field = '')
	{
		$sql = 'ALTER TABLE '.$this->db->_protect_identifiers($table)." $alter_type ";

		// DROP has everything it needs now.
		if ($alter_type == 'DROP')
		{
			return $sql.$this->db->_protect_identifiers($fields);
		}

		$sql .= $this->_process_fields($fields);

		if ($after_field != '')
		{
			$sql .= ' AFTER ' . $this->db->_protect_identifiers($after_field);
		}

		return $sql;
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	}

	// --------------------------------------------------------------------

	/**
<<<<<<< HEAD
	 * Rename a table
	 *
	 * Generates a platform-specific query so that a table can be renamed
	 *
	 * @access	private
	 * @param	string	the old table name
	 * @param	string	the new table name
	 * @return	string
	 */
	function _rename_table($table_name, $new_table_name)
	{
		$sql = 'ALTER TABLE '.$this->db->_protect_identifiers($table_name)." RENAME TO ".$this->db->_protect_identifiers($new_table_name);
=======
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	 * Process indexes
	 *
	 * @param	string	$table	(ignored)
	 * @return	string
	 */
	protected function _process_indexes($table)
	{
		$sql = '';

		for ($i = 0, $c = count($this->keys); $i < $c; $i++)
		{
			if (is_array($this->keys[$i]))
			{
				for ($i2 = 0, $c2 = count($this->keys[$i]); $i2 < $c2; $i2++)
				{
					if ( ! isset($this->fields[$this->keys[$i][$i2]]))
					{
						unset($this->keys[$i][$i2]);
						continue;
					}
				}
			}
			elseif ( ! isset($this->fields[$this->keys[$i]]))
			{
				unset($this->keys[$i]);
				continue;
			}

			is_array($this->keys[$i]) OR $this->keys[$i] = array($this->keys[$i]);

			$sql .= ",\n\tKEY ".$this->db->escape_identifiers(implode('_', $this->keys[$i]))
				.' ('.implode(', ', $this->db->escape_identifiers($this->keys[$i])).')';
		}

		$this->keys = array();

<<<<<<< HEAD
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
		return $sql;
	}

}
<<<<<<< HEAD
<<<<<<< HEAD

/* End of file mysql_forge.php */
/* Location: ./system/database/drivers/mysql/mysql_forge.php */
=======
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
