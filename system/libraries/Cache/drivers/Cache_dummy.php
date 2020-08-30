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
 * @since	Version 2.0
 * @filesource
 */
defined('BASEPATH') OR exit('No direct script access allowed');
<<<<<<< HEAD
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3

/**
 * CodeIgniter Dummy Caching Class
 *
 * @package		CodeIgniter
 * @subpackage	Libraries
 * @category	Core
 * @author		EllisLab Dev Team
 * @link
 */
class CI_Cache_dummy extends CI_Driver {

	/**
	 * Get
	 *
	 * Since this is the dummy class, it's always going to return FALSE.
	 *
<<<<<<< HEAD
<<<<<<< HEAD
	 * @param 	string
	 * @return 	Boolean		FALSE
=======
	 * @param	string
	 * @return	bool	FALSE
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
	 * @param	string
	 * @return	bool	FALSE
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	 */
	public function get($id)
	{
		return FALSE;
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
	 * @return 	boolean		TRUE, Simulating success
	 */
	public function save($id, $data, $ttl = 60)
=======
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	 * @param	string	Unique Key
	 * @param	mixed	Data to store
	 * @param	int	Length of time (in seconds) to cache the data
	 * @param	bool	Whether to store the raw value
	 * @return	bool	TRUE, Simulating success
	 */
	public function save($id, $data, $ttl = 60, $raw = FALSE)
<<<<<<< HEAD
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	{
		return TRUE;
	}

	// ------------------------------------------------------------------------

	/**
	 * Delete from Cache
	 *
<<<<<<< HEAD
<<<<<<< HEAD
	 * @param 	mixed		unique identifier of the item in the cache
	 * @param 	boolean		TRUE, simulating success
=======
	 * @param	mixed	unique identifier of the item in the cache
	 * @return	bool	TRUE, simulating success
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
	 * @param	mixed	unique identifier of the item in the cache
	 * @return	bool	TRUE, simulating success
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	 */
	public function delete($id)
	{
		return TRUE;
	}

	// ------------------------------------------------------------------------

	/**
<<<<<<< HEAD
<<<<<<< HEAD
	 * Clean the cache
	 *
	 * @return 	boolean		TRUE, simulating success
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
		return TRUE;
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
		return TRUE;
	}

	// ------------------------------------------------------------------------

	/**
	 * Clean the cache
	 *
	 * @return	bool	TRUE, simulating success
<<<<<<< HEAD
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	 */
	public function clean()
	{
		return TRUE;
	}

	// ------------------------------------------------------------------------

	/**
	 * Cache Info
	 *
<<<<<<< HEAD
<<<<<<< HEAD
	 * @param 	string		user/filehits
	 * @return 	boolean		FALSE
=======
	 * @param	string	user/filehits
	 * @return	bool	FALSE
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
	 * @param	string	user/filehits
	 * @return	bool	FALSE
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	 */
	 public function cache_info($type = NULL)
	 {
		 return FALSE;
	 }

	// ------------------------------------------------------------------------

	/**
	 * Get Cache Metadata
	 *
<<<<<<< HEAD
<<<<<<< HEAD
	 * @param 	mixed		key to get cache metadata on
	 * @return 	boolean		FALSE
=======
	 * @param	mixed	key to get cache metadata on
	 * @return	bool	FALSE
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
	 * @param	mixed	key to get cache metadata on
	 * @return	bool	FALSE
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	 */
	public function get_metadata($id)
	{
		return FALSE;
	}

	// ------------------------------------------------------------------------

	/**
	 * Is this caching driver supported on the system?
	 * Of course this one is.
	 *
<<<<<<< HEAD
<<<<<<< HEAD
	 * @return TRUE;
=======
	 * @return	bool	TRUE
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
	 * @return	bool	TRUE
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	 */
	public function is_supported()
	{
		return TRUE;
	}

}
<<<<<<< HEAD
<<<<<<< HEAD

/* End of file Cache_dummy.php */
/* Location: ./system/libraries/Cache/drivers/Cache_dummy.php */
=======
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
