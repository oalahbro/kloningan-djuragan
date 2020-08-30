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
 * @copyright		Copyright (c) 2006 - 2014 EllisLab, Inc.
 * @copyright		Copyright (c) 2014 - 2015, British Columbia Institute of Technology (http://bcit.ca/)
 * @license		http://codeigniter.com/user_guide/license.html
 * @link		http://codeigniter.com
 * @since		Version 2.0
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
 * @since	Version 2.0.0
 * @filesource
 */
defined('BASEPATH') OR exit('No direct script access allowed');
<<<<<<< HEAD
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3

/**
 * CodeIgniter APC Caching Class
 *
 * @package		CodeIgniter
 * @subpackage	Libraries
 * @category	Core
 * @author		EllisLab Dev Team
 * @link
 */
class CI_Cache_apc extends CI_Driver {

	/**
<<<<<<< HEAD
<<<<<<< HEAD
	 * Get
	 *
	 * Look for a value in the cache.  If it exists, return the data
	 * if not, return FALSE
	 *
	 * @param 	string
	 * @return 	mixed		value that is stored/FALSE on failure
	 */
	public function get($id)
	{
		$data = apc_fetch($id);

		return (is_array($data)) ? $data[0] : FALSE;
=======
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	 * Class constructor
	 *
	 * Only present so that an error message is logged
	 * if APC is not available.
	 *
	 * @return	void
	 */
	public function __construct()
	{
		if ( ! $this->is_supported())
		{
			log_message('error', 'Cache: Failed to initialize APC; extension not loaded/enabled?');
		}
	}

	// ------------------------------------------------------------------------

	/**
	 * Get
	 *
	 * Look for a value in the cache. If it exists, return the data
	 * if not, return FALSE
	 *
	 * @param	string
	 * @return	mixed	value that is stored/FALSE on failure
	 */
	public function get($id)
	{
		$success = FALSE;
		$data = apc_fetch($id, $success);

		if ($success === TRUE)
		{
			return is_array($data)
				? unserialize($data[0])
				: $data;
		}

		return FALSE;
<<<<<<< HEAD
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	}

	// ------------------------------------------------------------------------

	/**
	 * Cache Save
	 *
<<<<<<< HEAD
<<<<<<< HEAD
	 * @param 	string		Unique Key
	 * @param 	mixed		Data to store
	 * @param 	int			Length of time (in seconds) to cache the data
	 *
	 * @return 	boolean		true on success/false on failure
	 */
	public function save($id, $data, $ttl = 60)
	{
		return apc_store($id, array($data, time(), $ttl), $ttl);
=======
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	 * @param	string	$id	Cache ID
	 * @param	mixed	$data	Data to store
	 * @param	int	$ttl	Length of time (in seconds) to cache the data
	 * @param	bool	$raw	Whether to store the raw value
	 * @return	bool	TRUE on success, FALSE on failure
	 */
	public function save($id, $data, $ttl = 60, $raw = FALSE)
	{
		$ttl = (int) $ttl;

		return apc_store(
			$id,
			($raw === TRUE ? $data : array(serialize($data), time(), $ttl)),
			$ttl
		);
<<<<<<< HEAD
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	}

	// ------------------------------------------------------------------------

	/**
	 * Delete from Cache
	 *
<<<<<<< HEAD
<<<<<<< HEAD
	 * @param 	mixed		unique identifier of the item in the cache
	 * @param 	boolean		true on success/false on failure
=======
	 * @param	mixed	unique identifier of the item in the cache
	 * @return	bool	true on success/false on failure
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
	 * @param	mixed	unique identifier of the item in the cache
	 * @return	bool	true on success/false on failure
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	 */
	public function delete($id)
	{
		return apc_delete($id);
	}

	// ------------------------------------------------------------------------

	/**
<<<<<<< HEAD
<<<<<<< HEAD
	 * Clean the cache
	 *
	 * @return 	boolean		false on failure/true on success
=======
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	 * Increment a raw value
	 *
	 * @param	string	$id	Cache ID
	 * @param	int	$offset	Step/value to add
	 * @return	mixed	New value on success or FALSE on failure
	 */
	public function increment($id, $offset = 1)
	{
		return apc_inc($id, $offset);
	}

	// ------------------------------------------------------------------------

	/**
	 * Decrement a raw value
	 *
	 * @param	string	$id	Cache ID
	 * @param	int	$offset	Step/value to reduce by
	 * @return	mixed	New value on success or FALSE on failure
	 */
	public function decrement($id, $offset = 1)
	{
		return apc_dec($id, $offset);
	}

	// ------------------------------------------------------------------------

	/**
	 * Clean the cache
	 *
	 * @return	bool	false on failure/true on success
<<<<<<< HEAD
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	 */
	public function clean()
	{
		return apc_clear_cache('user');
	}

	// ------------------------------------------------------------------------

	/**
	 * Cache Info
	 *
<<<<<<< HEAD
<<<<<<< HEAD
	 * @param 	string		user/filehits
	 * @return 	mixed		array on success, false on failure
	 */
	public function cache_info($type = NULL)
	{
		return apc_cache_info($type);
	}
=======
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	 * @param	string	user/filehits
	 * @return	mixed	array on success, false on failure
	 */
	 public function cache_info($type = NULL)
	 {
		 return apc_cache_info($type);
	 }
<<<<<<< HEAD
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3

	// ------------------------------------------------------------------------

	/**
	 * Get Cache Metadata
	 *
<<<<<<< HEAD
<<<<<<< HEAD
	 * @param 	mixed		key to get cache metadata on
	 * @return 	mixed		array on success/false on failure
	 */
	public function get_metadata($id)
	{
		$stored = apc_fetch($id);

		if (count($stored) !== 3)
=======
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	 * @param	mixed	key to get cache metadata on
	 * @return	mixed	array on success/false on failure
	 */
	public function get_metadata($id)
	{
		$success = FALSE;
		$stored = apc_fetch($id, $success);

		if ($success === FALSE OR count($stored) !== 3)
<<<<<<< HEAD
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
		{
			return FALSE;
		}

		list($data, $time, $ttl) = $stored;

		return array(
			'expire'	=> $time + $ttl,
			'mtime'		=> $time,
<<<<<<< HEAD
<<<<<<< HEAD
			'data'		=> $data
=======
			'data'		=> unserialize($data)
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
			'data'		=> unserialize($data)
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
		);
	}

	// ------------------------------------------------------------------------

	/**
	 * is_supported()
	 *
	 * Check to see if APC is available on this system, bail if it isn't.
<<<<<<< HEAD
<<<<<<< HEAD
	 */
	public function is_supported()
	{
		if ( ! extension_loaded('apc') OR ini_get('apc.enabled') != "1")
		{
			log_message('error', 'The APC PHP extension must be loaded to use APC Cache.');
			return FALSE;
		}

		return TRUE;
	}

}

/* End of file Cache_apc.php */
/* Location: ./system/libraries/Cache/drivers/Cache_apc.php */
=======
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	 *
	 * @return	bool
	 */
	public function is_supported()
	{
		return (extension_loaded('apc') && ini_get('apc.enabled'));
	}
}
<<<<<<< HEAD
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
