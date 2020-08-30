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
 * @copyright		Copyright (c) 2006 - 2014, EllisLab, Inc.
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
 * @since	Version 3.0.0
 * @filesource
 */
defined('BASEPATH') OR exit('No direct script access allowed');
<<<<<<< HEAD
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3

/**
 * Migration Class
 *
 * All migrations should implement this, forces up() and down() and gives
 * access to the CI super-global.
 *
 * @package		CodeIgniter
 * @subpackage	Libraries
 * @category	Libraries
 * @author		Reactor Engineers
 * @link
 */
class CI_Migration {

<<<<<<< HEAD
<<<<<<< HEAD
	protected $_migration_enabled = FALSE;
	protected $_migration_path = NULL;
	protected $_migration_version = 0;

	protected $_error_string = '';

	public function __construct($config = array())
	{
		# Only run this constructor on main library load
		if (get_parent_class($this) !== FALSE)
=======
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	/**
	 * Whether the library is enabled
	 *
	 * @var bool
	 */
	protected $_migration_enabled = FALSE;

	/**
	 * Migration numbering type
	 *
	 * @var	bool
	 */
	protected $_migration_type = 'sequential';

	/**
	 * Path to migration classes
	 *
	 * @var string
	 */
	protected $_migration_path = NULL;

	/**
	 * Current migration version
	 *
	 * @var mixed
	 */
	protected $_migration_version = 0;

	/**
	 * Database table with migration info
	 *
	 * @var string
	 */
	protected $_migration_table = 'migrations';

	/**
	 * Whether to automatically run migrations
	 *
	 * @var	bool
	 */
	protected $_migration_auto_latest = FALSE;

	/**
	 * Migration basename regex
	 *
	 * @var string
	 */
	protected $_migration_regex;

	/**
	 * Error message
	 *
	 * @var string
	 */
	protected $_error_string = '';

	/**
	 * Initialize Migration Class
	 *
	 * @param	array	$config
	 * @return	void
	 */
	public function __construct($config = array())
	{
		// Only run this constructor on main library load
		if ( ! in_array(get_class($this), array('CI_Migration', config_item('subclass_prefix').'Migration'), TRUE))
<<<<<<< HEAD
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
		{
			return;
		}

		foreach ($config as $key => $val)
		{
<<<<<<< HEAD
<<<<<<< HEAD
			$this->{'_' . $key} = $val;
		}

		log_message('debug', 'Migrations class initialized');
=======
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
			$this->{'_'.$key} = $val;
		}

		log_message('info', 'Migrations Class Initialized');
<<<<<<< HEAD
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3

		// Are they trying to use migrations while it is disabled?
		if ($this->_migration_enabled !== TRUE)
		{
			show_error('Migrations has been loaded but is disabled or set up incorrectly.');
		}

		// If not set, set it
<<<<<<< HEAD
<<<<<<< HEAD
		$this->_migration_path == '' AND $this->_migration_path = APPPATH . 'migrations/';
=======
		$this->_migration_path !== '' OR $this->_migration_path = APPPATH.'migrations/';
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
		$this->_migration_path !== '' OR $this->_migration_path = APPPATH.'migrations/';
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3

		// Add trailing slash if not set
		$this->_migration_path = rtrim($this->_migration_path, '/').'/';

		// Load migration language
		$this->lang->load('migration');

		// They'll probably be using dbforge
		$this->load->dbforge();

<<<<<<< HEAD
<<<<<<< HEAD
		// If the migrations table is missing, make it
		if ( ! $this->db->table_exists('migrations'))
		{
			$this->dbforge->add_field(array(
				'version' => array('type' => 'INT', 'constraint' => 3),
			));

			$this->dbforge->create_table('migrations', TRUE);

			$this->db->insert('migrations', array('version' => 0));
=======
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
		// Make sure the migration table name was set.
		if (empty($this->_migration_table))
		{
			show_error('Migrations configuration file (migration.php) must have "migration_table" set.');
		}

		// Migration basename regex
		$this->_migration_regex = ($this->_migration_type === 'timestamp')
			? '/^\d{14}_(\w+)$/'
			: '/^\d{3}_(\w+)$/';

		// Make sure a valid migration numbering type was set.
		if ( ! in_array($this->_migration_type, array('sequential', 'timestamp')))
		{
			show_error('An invalid migration numbering type was specified: '.$this->_migration_type);
		}

		// If the migrations table is missing, make it
		if ( ! $this->db->table_exists($this->_migration_table))
		{
			$this->dbforge->add_field(array(
				'version' => array('type' => 'BIGINT', 'constraint' => 20),
			));

			$this->dbforge->create_table($this->_migration_table, TRUE);

			$this->db->insert($this->_migration_table, array('version' => 0));
		}

		// Do we auto migrate to the latest migration?
		if ($this->_migration_auto_latest === TRUE && ! $this->latest())
		{
			show_error($this->error_string());
<<<<<<< HEAD
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
		}
	}

	// --------------------------------------------------------------------

	/**
	 * Migrate to a schema version
	 *
	 * Calls each migration step required to get to the schema version of
	 * choice
	 *
<<<<<<< HEAD
<<<<<<< HEAD
	 * @param	int	Target schema version
	 * @return	mixed	TRUE if already latest, FALSE if failed, int if upgraded
	 */
	public function version($target_version)
	{
		$start = $current_version = $this->_get_version();
		$stop = $target_version;

		if ($target_version > $current_version)
		{
			// Moving Up
			++$start;
			++$stop;
			$step = 1;
		}
		else
		{
			// Moving Down
			$step = -1;
		}

		$method = ($step === 1) ? 'up' : 'down';
		$migrations = array();

		// We now prepare to actually DO the migrations
		// But first let's make sure that everything is the way it should be
		for ($i = $start; $i != $stop; $i += $step)
		{
			$f = glob(sprintf($this->_migration_path . '%03d_*.php', $i));

			// Only one migration per step is permitted
			if (count($f) > 1)
			{
				$this->_error_string = sprintf($this->lang->line('migration_multiple_version'), $i);
				return FALSE;
			}

			// Migration step not found
			if (count($f) == 0)
			{
				// If trying to migrate up to a version greater than the last
				// existing one, migrate to the last one.
				if ($step == 1)
				{
					break;
				}

				// If trying to migrate down but we're missing a step,
				// something must definitely be wrong.
				$this->_error_string = sprintf($this->lang->line('migration_not_found'), $i);
				return FALSE;
			}

			$file = basename($f[0]);
			$name = basename($f[0], '.php');

			// Filename validations
			if (preg_match('/^\d{3}_(\w+)$/', $name, $match))
			{
				$match[1] = strtolower($match[1]);

				// Cannot repeat a migration at different steps
				if (in_array($match[1], $migrations))
				{
					$this->_error_string = sprintf($this->lang->line('migration_multiple_version'), $match[1]);
					return FALSE;
				}

				include $f[0];
				$class = 'Migration_' . ucfirst($match[1]);

				if ( ! class_exists($class))
				{
					$this->_error_string = sprintf($this->lang->line('migration_class_doesnt_exist'), $class);
					return FALSE;
				}

				if ( ! is_callable(array($class, $method)))
				{
					$this->_error_string = sprintf($this->lang->line('migration_missing_'.$method.'_method'), $class);
					return FALSE;
				}

				$migrations[] = $match[1];
			}
			else
			{
				$this->_error_string = sprintf($this->lang->line('migration_invalid_filename'), $file);
				return FALSE;
			}
		}

		log_message('debug', 'Current migration: ' . $current_version);

		$version = $i + ($step == 1 ? -1 : 0);

		// If there is nothing to do so quit
		if ($migrations === array())
		{
			return TRUE;
		}

		log_message('debug', 'Migrating from ' . $method . ' to version ' . $version);

		// Loop through the migrations
		foreach ($migrations AS $migration)
		{
			// Run the migration class
			$class = 'Migration_' . ucfirst(strtolower($migration));
			call_user_func(array(new $class, $method));

			$current_version += $step;
=======
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	 * @param	string	$target_version	Target schema version
	 * @return	mixed	TRUE if no migrations are found, current version string on success, FALSE on failure
	 */
	public function version($target_version)
	{
		// Note: We use strings, so that timestamp versions work on 32-bit systems
		$current_version = $this->_get_version();

		if ($this->_migration_type === 'sequential')
		{
			$target_version = sprintf('%03d', $target_version);
		}
		else
		{
			$target_version = (string) $target_version;
		}

		$migrations = $this->find_migrations();

		if ($target_version > 0 && ! isset($migrations[$target_version]))
		{
			$this->_error_string = sprintf($this->lang->line('migration_not_found'), $target_version);
			return FALSE;
		}

		if ($target_version > $current_version)
		{
			$method = 'up';
		}
		elseif ($target_version < $current_version)
		{
			$method = 'down';
			// We need this so that migrations are applied in reverse order
			krsort($migrations);
		}
		else
		{
			// Well, there's nothing to migrate then ...
			return TRUE;
		}

		// Validate all available migrations within our target range.
		//
		// Unfortunately, we'll have to use another loop to run them
		// in order to avoid leaving the procedure in a broken state.
		//
		// See https://github.com/bcit-ci/CodeIgniter/issues/4539
		$pending = array();
		foreach ($migrations as $number => $file)
		{
			// Ignore versions out of our range.
			//
			// Because we've previously sorted the $migrations array depending on the direction,
			// we can safely break the loop once we reach $target_version ...
			if ($method === 'up')
			{
				if ($number <= $current_version)
				{
					continue;
				}
				elseif ($number > $target_version)
				{
					break;
				}
			}
			else
			{
				if ($number > $current_version)
				{
					continue;
				}
				elseif ($number <= $target_version)
				{
					break;
				}
			}

			// Check for sequence gaps
			if ($this->_migration_type === 'sequential')
			{
				if (isset($previous) && abs($number - $previous) > 1)
				{
					$this->_error_string = sprintf($this->lang->line('migration_sequence_gap'), $number);
					return FALSE;
				}

				$previous = $number;
			}

			include_once($file);
			$class = 'Migration_'.ucfirst(strtolower($this->_get_migration_name(basename($file, '.php'))));

			// Validate the migration file structure
			if ( ! class_exists($class, FALSE))
			{
				$this->_error_string = sprintf($this->lang->line('migration_class_doesnt_exist'), $class);
				return FALSE;
			}
<<<<<<< HEAD
			// method_exists() returns true for non-public methods,
			// while is_callable() can't be used without instantiating.
			// Only get_class_methods() satisfies both conditions.
			elseif ( ! in_array($method, array_map('strtolower', get_class_methods($class))))
=======
			elseif ( ! is_callable(array($class, $method)))
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
			{
				$this->_error_string = sprintf($this->lang->line('migration_missing_'.$method.'_method'), $class);
				return FALSE;
			}

			$pending[$number] = array($class, $method);
		}

		// Now just run the necessary migrations
		foreach ($pending as $number => $migration)
		{
			log_message('debug', 'Migrating '.$method.' from version '.$current_version.' to version '.$number);

			$migration[0] = new $migration[0];
			call_user_func($migration);
			$current_version = $number;
			$this->_update_version($current_version);
		}

		// This is necessary when moving down, since the the last migration applied
		// will be the down() method for the next migration up from the target
		if ($current_version <> $target_version)
		{
			$current_version = $target_version;
<<<<<<< HEAD
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
			$this->_update_version($current_version);
		}

		log_message('debug', 'Finished migrating to '.$current_version);
<<<<<<< HEAD
<<<<<<< HEAD

=======
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
		return $current_version;
	}

	// --------------------------------------------------------------------

	/**
<<<<<<< HEAD
<<<<<<< HEAD
	 * Set's the schema to the latest migration
	 *
	 * @return	mixed	true if already latest, false if failed, int if upgraded
	 */
	public function latest()
	{
		if ( ! $migrations = $this->find_migrations())
		{
			$this->_error_string = $this->lang->line('migration_none_found');
			return false;
=======
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	 * Sets the schema to the latest migration
	 *
	 * @return	mixed	Current version string on success, FALSE on failure
	 */
	public function latest()
	{
		$migrations = $this->find_migrations();

		if (empty($migrations))
		{
			$this->_error_string = $this->lang->line('migration_none_found');
			return FALSE;
<<<<<<< HEAD
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
		}

		$last_migration = basename(end($migrations));

		// Calculate the last migration step from existing migration
<<<<<<< HEAD
<<<<<<< HEAD
		// filenames and procceed to the standard version migration
		return $this->version((int) substr($last_migration, 0, 3));
=======
		// filenames and proceed to the standard version migration
		return $this->version($this->_get_migration_number($last_migration));
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
		// filenames and proceed to the standard version migration
		return $this->version($this->_get_migration_number($last_migration));
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	}

	// --------------------------------------------------------------------

	/**
<<<<<<< HEAD
<<<<<<< HEAD
	 * Set's the schema to the migration version set in config
	 *
	 * @return	mixed	true if already current, false if failed, int if upgraded
=======
	 * Sets the schema to the migration version set in config
	 *
	 * @return	mixed	TRUE if no migrations are found, current version string on success, FALSE on failure
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
	 * Sets the schema to the migration version set in config
	 *
	 * @return	mixed	TRUE if no migrations are found, current version string on success, FALSE on failure
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	 */
	public function current()
	{
		return $this->version($this->_migration_version);
	}

	// --------------------------------------------------------------------

	/**
	 * Error string
	 *
	 * @return	string	Error message returned as a string
	 */
	public function error_string()
	{
		return $this->_error_string;
	}

	// --------------------------------------------------------------------

	/**
<<<<<<< HEAD
<<<<<<< HEAD
	 * Set's the schema to the latest migration
	 *
	 * @return	mixed	true if already latest, false if failed, int if upgraded
	 */
	protected function find_migrations()
	{
		// Load all *_*.php files in the migrations path
		$files = glob($this->_migration_path . '*_*.php');
		$file_count = count($files);

		for ($i = 0; $i < $file_count; $i++)
		{
			// Mark wrongly formatted files as false for later filtering
			$name = basename($files[$i], '.php');
			if ( ! preg_match('/^\d{3}_(\w+)$/', $name))
			{
				$files[$i] = FALSE;
			}
		}

		sort($files);
		return $files;
=======
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	 * Retrieves list of available migration scripts
	 *
	 * @return	array	list of migration file paths sorted by version
	 */
	public function find_migrations()
	{
		$migrations = array();

		// Load all *_*.php files in the migrations path
		foreach (glob($this->_migration_path.'*_*.php') as $file)
		{
			$name = basename($file, '.php');

			// Filter out non-migration files
			if (preg_match($this->_migration_regex, $name))
			{
				$number = $this->_get_migration_number($name);

				// There cannot be duplicate migration numbers
				if (isset($migrations[$number]))
				{
					$this->_error_string = sprintf($this->lang->line('migration_multiple_version'), $number);
					show_error($this->_error_string);
				}

				$migrations[$number] = $file;
			}
		}

		ksort($migrations);
		return $migrations;
	}

	// --------------------------------------------------------------------

	/**
	 * Extracts the migration number from a filename
	 *
	 * @param	string	$migration
	 * @return	string	Numeric portion of a migration filename
	 */
	protected function _get_migration_number($migration)
	{
		return sscanf($migration, '%[0-9]+', $number)
			? $number : '0';
	}

	// --------------------------------------------------------------------

	/**
	 * Extracts the migration class name from a filename
	 *
	 * @param	string	$migration
	 * @return	string	text portion of a migration filename
	 */
	protected function _get_migration_name($migration)
	{
		$parts = explode('_', $migration);
		array_shift($parts);
		return implode('_', $parts);
<<<<<<< HEAD
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	}

	// --------------------------------------------------------------------

	/**
	 * Retrieves current schema version
	 *
<<<<<<< HEAD
<<<<<<< HEAD
	 * @return	int	Current Migration
	 */
	protected function _get_version()
	{
		$row = $this->db->get('migrations')->row();
		return $row ? $row->version : 0;
=======
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	 * @return	string	Current migration version
	 */
	protected function _get_version()
	{
		$row = $this->db->select('version')->get($this->_migration_table)->row();
		return $row ? $row->version : '0';
<<<<<<< HEAD
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	}

	// --------------------------------------------------------------------

	/**
	 * Stores the current schema version
	 *
<<<<<<< HEAD
<<<<<<< HEAD
	 * @param	int	Migration reached
	 * @return	bool
	 */
	protected function _update_version($migrations)
	{
		return $this->db->update('migrations', array(
			'version' => $migrations
=======
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	 * @param	string	$migration	Migration reached
	 * @return	void
	 */
	protected function _update_version($migration)
	{
		$this->db->update($this->_migration_table, array(
			'version' => $migration
<<<<<<< HEAD
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
		));
	}

	// --------------------------------------------------------------------

	/**
	 * Enable the use of CI super-global
	 *
<<<<<<< HEAD
<<<<<<< HEAD
	 * @param	mixed	$var
=======
	 * @param	string	$var
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
	 * @param	string	$var
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	 * @return	mixed
	 */
	public function __get($var)
	{
		return get_instance()->$var;
	}

}
<<<<<<< HEAD
<<<<<<< HEAD

/* End of file Migration.php */
/* Location: ./system/libraries/Migration.php */
=======
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
