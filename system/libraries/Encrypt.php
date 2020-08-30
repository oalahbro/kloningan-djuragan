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
 * CodeIgniter Encryption Class
 *
 * Provides two-way keyed encoding using Mcrypt
 *
 * @package		CodeIgniter
 * @subpackage	Libraries
 * @category	Libraries
 * @author		EllisLab Dev Team
<<<<<<< HEAD
<<<<<<< HEAD
 * @link		http://codeigniter.com/user_guide/libraries/encryption.html
 */
class CI_Encrypt {

	var $CI;
	var $encryption_key	= '';
	var $_hash_type	= 'sha1';
	var $_mcrypt_exists = FALSE;
	var $_mcrypt_cipher;
	var $_mcrypt_mode;

	/**
	 * Constructor
	 *
	 * Simply determines whether the mcrypt library exists.
	 *
	 */
	public function __construct()
	{
		$this->CI =& get_instance();
		$this->_mcrypt_exists = ( ! function_exists('mcrypt_encrypt')) ? FALSE : TRUE;

		if ($this->_mcrypt_exists === FALSE)
=======
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
 * @link		https://codeigniter.com/user_guide/libraries/encryption.html
 */
class CI_Encrypt {

	/**
	 * Reference to the user's encryption key
	 *
	 * @var string
	 */
	public $encryption_key		= '';

	/**
	 * Type of hash operation
	 *
	 * @var string
	 */
	protected $_hash_type		= 'sha1';

	/**
	 * Flag for the existence of mcrypt
	 *
	 * @var bool
	 */
	protected $_mcrypt_exists	= FALSE;

	/**
	 * Current cipher to be used with mcrypt
	 *
	 * @var string
	 */
	protected $_mcrypt_cipher;

	/**
	 * Method for encrypting/decrypting data
	 *
	 * @var int
	 */
	protected $_mcrypt_mode;

	/**
	 * Initialize Encryption class
	 *
	 * @return	void
	 */
	public function __construct()
	{
		if (($this->_mcrypt_exists = function_exists('mcrypt_encrypt')) === FALSE)
<<<<<<< HEAD
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
		{
			show_error('The Encrypt library requires the Mcrypt extension.');
		}

<<<<<<< HEAD
<<<<<<< HEAD
		log_message('debug', "Encrypt Class Initialized");
=======
		log_message('info', 'Encrypt Class Initialized');
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
		log_message('info', 'Encrypt Class Initialized');
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	}

	// --------------------------------------------------------------------

	/**
	 * Fetch the encryption key
	 *
	 * Returns it as MD5 in order to have an exact-length 128 bit key.
	 * Mcrypt is sensitive to keys that are not the correct length
	 *
<<<<<<< HEAD
<<<<<<< HEAD
	 * @access	public
	 * @param	string
	 * @return	string
	 */
	function get_key($key = '')
	{
		if ($key == '')
		{
			if ($this->encryption_key != '')
=======
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	 * @param	string
	 * @return	string
	 */
	public function get_key($key = '')
	{
		if ($key === '')
		{
			if ($this->encryption_key !== '')
<<<<<<< HEAD
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
			{
				return $this->encryption_key;
			}

<<<<<<< HEAD
<<<<<<< HEAD
			$CI =& get_instance();
			$key = $CI->config->item('encryption_key');

			if ($key == FALSE)
=======
			$key = config_item('encryption_key');

			if ( ! strlen($key))
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
			$key = config_item('encryption_key');

			if ( ! strlen($key))
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
			{
				show_error('In order to use the encryption class requires that you set an encryption key in your config file.');
			}
		}

		return md5($key);
	}

	// --------------------------------------------------------------------

	/**
	 * Set the encryption key
	 *
<<<<<<< HEAD
<<<<<<< HEAD
	 * @access	public
	 * @param	string
	 * @return	void
	 */
	function set_key($key = '')
	{
		$this->encryption_key = $key;
=======
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	 * @param	string
	 * @return	CI_Encrypt
	 */
	public function set_key($key = '')
	{
		$this->encryption_key = $key;
		return $this;
<<<<<<< HEAD
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	}

	// --------------------------------------------------------------------

	/**
	 * Encode
	 *
	 * Encodes the message string using bitwise XOR encoding.
	 * The key is combined with a random hash, and then it
	 * too gets converted using XOR. The whole thing is then run
	 * through mcrypt using the randomized key. The end result
	 * is a double-encrypted message string that is randomized
	 * with each call to this function, even if the supplied
	 * message and key are the same.
	 *
<<<<<<< HEAD
<<<<<<< HEAD
	 * @access	public
=======
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	 * @param	string	the string to encode
	 * @param	string	the key
	 * @return	string
	 */
<<<<<<< HEAD
<<<<<<< HEAD
	function encode($string, $key = '')
	{
		$key = $this->get_key($key);
		$enc = $this->mcrypt_encode($string, $key);

		return base64_encode($enc);
=======
	public function encode($string, $key = '')
	{
		return base64_encode($this->mcrypt_encode($string, $this->get_key($key)));
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
	public function encode($string, $key = '')
	{
		return base64_encode($this->mcrypt_encode($string, $this->get_key($key)));
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	}

	// --------------------------------------------------------------------

	/**
	 * Decode
	 *
	 * Reverses the above process
	 *
<<<<<<< HEAD
<<<<<<< HEAD
	 * @access	public
=======
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	 * @param	string
	 * @param	string
	 * @return	string
	 */
<<<<<<< HEAD
<<<<<<< HEAD
	function decode($string, $key = '')
	{
		$key = $this->get_key($key);

		if (preg_match('/[^a-zA-Z0-9\/\+=]/', $string))
		{
			return FALSE;
		}

		$dec = base64_decode($string);

		if (($dec = $this->mcrypt_decode($dec, $key)) === FALSE)
=======
	public function decode($string, $key = '')
	{
		if (preg_match('/[^a-zA-Z0-9\/\+=]/', $string) OR base64_encode(base64_decode($string)) !== $string)
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
	public function decode($string, $key = '')
	{
		if (preg_match('/[^a-zA-Z0-9\/\+=]/', $string) OR base64_encode(base64_decode($string)) !== $string)
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
		{
			return FALSE;
		}

<<<<<<< HEAD
<<<<<<< HEAD
		return $dec;
=======
		return $this->mcrypt_decode(base64_decode($string), $this->get_key($key));
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
		return $this->mcrypt_decode(base64_decode($string), $this->get_key($key));
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	}

	// --------------------------------------------------------------------

	/**
	 * Encode from Legacy
	 *
	 * Takes an encoded string from the original Encryption class algorithms and
	 * returns a newly encoded string using the improved method added in 2.0.0
	 * This allows for backwards compatibility and a method to transition to the
	 * new encryption algorithms.
	 *
<<<<<<< HEAD
<<<<<<< HEAD
	 * For more details, see http://codeigniter.com/user_guide/installation/upgrade_200.html#encryption
	 *
	 * @access	public
=======
	 * For more details, see https://codeigniter.com/user_guide/installation/upgrade_200.html#encryption
	 *
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
	 * For more details, see https://codeigniter.com/user_guide/installation/upgrade_200.html#encryption
	 *
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	 * @param	string
	 * @param	int		(mcrypt mode constant)
	 * @param	string
	 * @return	string
	 */
<<<<<<< HEAD
<<<<<<< HEAD
	function encode_from_legacy($string, $legacy_mode = MCRYPT_MODE_ECB, $key = '')
	{
=======
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	public function encode_from_legacy($string, $legacy_mode = MCRYPT_MODE_ECB, $key = '')
	{
		if (preg_match('/[^a-zA-Z0-9\/\+=]/', $string))
		{
			return FALSE;
		}

<<<<<<< HEAD
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
		// decode it first
		// set mode temporarily to what it was when string was encoded with the legacy
		// algorithm - typically MCRYPT_MODE_ECB
		$current_mode = $this->_get_mode();
		$this->set_mode($legacy_mode);

		$key = $this->get_key($key);
<<<<<<< HEAD
<<<<<<< HEAD

		if (preg_match('/[^a-zA-Z0-9\/\+=]/', $string))
		{
			return FALSE;
		}

		$dec = base64_decode($string);

		if (($dec = $this->mcrypt_decode($dec, $key)) === FALSE)
		{
=======
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
		$dec = base64_decode($string);
		if (($dec = $this->mcrypt_decode($dec, $key)) === FALSE)
		{
			$this->set_mode($current_mode);
<<<<<<< HEAD
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
			return FALSE;
		}

		$dec = $this->_xor_decode($dec, $key);

		// set the mcrypt mode back to what it should be, typically MCRYPT_MODE_CBC
		$this->set_mode($current_mode);

		// and re-encode
		return base64_encode($this->mcrypt_encode($dec, $key));
	}

	// --------------------------------------------------------------------

	/**
	 * XOR Decode
	 *
	 * Takes an encoded string and key as input and generates the
	 * plain-text original message
	 *
<<<<<<< HEAD
<<<<<<< HEAD
	 * @access	private
=======
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	 * @param	string
	 * @param	string
	 * @return	string
	 */
<<<<<<< HEAD
<<<<<<< HEAD
	function _xor_decode($string, $key)
=======
	protected function _xor_decode($string, $key)
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
	protected function _xor_decode($string, $key)
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	{
		$string = $this->_xor_merge($string, $key);

		$dec = '';
<<<<<<< HEAD
<<<<<<< HEAD
		for ($i = 0; $i < strlen($string); $i++)
		{
			$dec .= (substr($string, $i++, 1) ^ substr($string, $i, 1));
=======
		for ($i = 0, $l = strlen($string); $i < $l; $i++)
		{
			$dec .= ($string[$i++] ^ $string[$i]);
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
		for ($i = 0, $l = strlen($string); $i < $l; $i++)
		{
			$dec .= ($string[$i++] ^ $string[$i]);
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
		}

		return $dec;
	}

	// --------------------------------------------------------------------

	/**
	 * XOR key + string Combiner
	 *
	 * Takes a string and key as input and computes the difference using XOR
	 *
<<<<<<< HEAD
<<<<<<< HEAD
	 * @access	private
=======
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	 * @param	string
	 * @param	string
	 * @return	string
	 */
<<<<<<< HEAD
<<<<<<< HEAD
	function _xor_merge($string, $key)
	{
		$hash = $this->hash($key);
		$str = '';
		for ($i = 0; $i < strlen($string); $i++)
		{
			$str .= substr($string, $i, 1) ^ substr($hash, ($i % strlen($hash)), 1);
=======
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	protected function _xor_merge($string, $key)
	{
		$hash = $this->hash($key);
		$str = '';
		for ($i = 0, $ls = strlen($string), $lh = strlen($hash); $i < $ls; $i++)
		{
			$str .= $string[$i] ^ $hash[($i % $lh)];
<<<<<<< HEAD
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
		}

		return $str;
	}

	// --------------------------------------------------------------------

	/**
	 * Encrypt using Mcrypt
	 *
<<<<<<< HEAD
<<<<<<< HEAD
	 * @access	public
=======
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	 * @param	string
	 * @param	string
	 * @return	string
	 */
<<<<<<< HEAD
<<<<<<< HEAD
	function mcrypt_encode($data, $key)
=======
	public function mcrypt_encode($data, $key)
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
	public function mcrypt_encode($data, $key)
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	{
		$init_size = mcrypt_get_iv_size($this->_get_cipher(), $this->_get_mode());
		$init_vect = mcrypt_create_iv($init_size, MCRYPT_RAND);
		return $this->_add_cipher_noise($init_vect.mcrypt_encrypt($this->_get_cipher(), $key, $data, $this->_get_mode(), $init_vect), $key);
	}

	// --------------------------------------------------------------------

	/**
	 * Decrypt using Mcrypt
	 *
<<<<<<< HEAD
<<<<<<< HEAD
	 * @access	public
=======
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	 * @param	string
	 * @param	string
	 * @return	string
	 */
<<<<<<< HEAD
<<<<<<< HEAD
	function mcrypt_decode($data, $key)
=======
	public function mcrypt_decode($data, $key)
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
	public function mcrypt_decode($data, $key)
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	{
		$data = $this->_remove_cipher_noise($data, $key);
		$init_size = mcrypt_get_iv_size($this->_get_cipher(), $this->_get_mode());

		if ($init_size > strlen($data))
		{
			return FALSE;
		}

		$init_vect = substr($data, 0, $init_size);
		$data = substr($data, $init_size);
		return rtrim(mcrypt_decrypt($this->_get_cipher(), $key, $data, $this->_get_mode(), $init_vect), "\0");
	}

	// --------------------------------------------------------------------

	/**
	 * Adds permuted noise to the IV + encrypted data to protect
	 * against Man-in-the-middle attacks on CBC mode ciphers
	 * http://www.ciphersbyritter.com/GLOSSARY.HTM#IV
	 *
<<<<<<< HEAD
<<<<<<< HEAD
	 * Function description
	 *
	 * @access	private
=======
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	 * @param	string
	 * @param	string
	 * @return	string
	 */
<<<<<<< HEAD
<<<<<<< HEAD
	function _add_cipher_noise($data, $key)
	{
		$keyhash = $this->hash($key);
		$keylen = strlen($keyhash);
		$str = '';

		for ($i = 0, $j = 0, $len = strlen($data); $i < $len; ++$i, ++$j)
		{
			if ($j >= $keylen)
=======
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	protected function _add_cipher_noise($data, $key)
	{
		$key = $this->hash($key);
		$str = '';

		for ($i = 0, $j = 0, $ld = strlen($data), $lk = strlen($key); $i < $ld; ++$i, ++$j)
		{
			if ($j >= $lk)
<<<<<<< HEAD
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
			{
				$j = 0;
			}

<<<<<<< HEAD
<<<<<<< HEAD
			$str .= chr((ord($data[$i]) + ord($keyhash[$j])) % 256);
=======
			$str .= chr((ord($data[$i]) + ord($key[$j])) % 256);
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
			$str .= chr((ord($data[$i]) + ord($key[$j])) % 256);
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
		}

		return $str;
	}

	// --------------------------------------------------------------------

	/**
	 * Removes permuted noise from the IV + encrypted data, reversing
	 * _add_cipher_noise()
	 *
	 * Function description
	 *
<<<<<<< HEAD
<<<<<<< HEAD
	 * @access	public
	 * @param	type
	 * @return	type
	 */
	function _remove_cipher_noise($data, $key)
	{
		$keyhash = $this->hash($key);
		$keylen = strlen($keyhash);
		$str = '';

		for ($i = 0, $j = 0, $len = strlen($data); $i < $len; ++$i, ++$j)
		{
			if ($j >= $keylen)
=======
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	 * @param	string	$data
	 * @param	string	$key
	 * @return	string
	 */
	protected function _remove_cipher_noise($data, $key)
	{
		$key = $this->hash($key);
		$str = '';

		for ($i = 0, $j = 0, $ld = strlen($data), $lk = strlen($key); $i < $ld; ++$i, ++$j)
		{
			if ($j >= $lk)
<<<<<<< HEAD
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
			{
				$j = 0;
			}

<<<<<<< HEAD
<<<<<<< HEAD
			$temp = ord($data[$i]) - ord($keyhash[$j]);

			if ($temp < 0)
			{
				$temp = $temp + 256;
=======
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
			$temp = ord($data[$i]) - ord($key[$j]);

			if ($temp < 0)
			{
				$temp += 256;
<<<<<<< HEAD
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
			}

			$str .= chr($temp);
		}

		return $str;
	}

	// --------------------------------------------------------------------

	/**
	 * Set the Mcrypt Cipher
	 *
<<<<<<< HEAD
<<<<<<< HEAD
	 * @access	public
	 * @param	constant
	 * @return	string
	 */
	function set_cipher($cipher)
	{
		$this->_mcrypt_cipher = $cipher;
=======
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	 * @param	int
	 * @return	CI_Encrypt
	 */
	public function set_cipher($cipher)
	{
		$this->_mcrypt_cipher = $cipher;
		return $this;
<<<<<<< HEAD
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	}

	// --------------------------------------------------------------------

	/**
	 * Set the Mcrypt Mode
	 *
<<<<<<< HEAD
<<<<<<< HEAD
	 * @access	public
	 * @param	constant
	 * @return	string
	 */
	function set_mode($mode)
	{
		$this->_mcrypt_mode = $mode;
=======
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	 * @param	int
	 * @return	CI_Encrypt
	 */
	public function set_mode($mode)
	{
		$this->_mcrypt_mode = $mode;
		return $this;
<<<<<<< HEAD
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	}

	// --------------------------------------------------------------------

	/**
	 * Get Mcrypt cipher Value
	 *
<<<<<<< HEAD
<<<<<<< HEAD
	 * @access	private
	 * @return	string
	 */
	function _get_cipher()
	{
		if ($this->_mcrypt_cipher == '')
		{
			$this->_mcrypt_cipher = MCRYPT_RIJNDAEL_256;
=======
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	 * @return	int
	 */
	protected function _get_cipher()
	{
		if ($this->_mcrypt_cipher === NULL)
		{
			return $this->_mcrypt_cipher = MCRYPT_RIJNDAEL_256;
<<<<<<< HEAD
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
		}

		return $this->_mcrypt_cipher;
	}

	// --------------------------------------------------------------------

	/**
	 * Get Mcrypt Mode Value
	 *
<<<<<<< HEAD
<<<<<<< HEAD
	 * @access	private
	 * @return	string
	 */
	function _get_mode()
	{
		if ($this->_mcrypt_mode == '')
		{
			$this->_mcrypt_mode = MCRYPT_MODE_CBC;
=======
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	 * @return	int
	 */
	protected function _get_mode()
	{
		if ($this->_mcrypt_mode === NULL)
		{
			return $this->_mcrypt_mode = MCRYPT_MODE_CBC;
<<<<<<< HEAD
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
		}

		return $this->_mcrypt_mode;
	}

	// --------------------------------------------------------------------

	/**
	 * Set the Hash type
	 *
<<<<<<< HEAD
<<<<<<< HEAD
	 * @access	public
	 * @param	string
	 * @return	string
	 */
	function set_hash($type = 'sha1')
	{
		$this->_hash_type = ($type != 'sha1' AND $type != 'md5') ? 'sha1' : $type;
=======
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	 * @param	string
	 * @return	void
	 */
	public function set_hash($type = 'sha1')
	{
		$this->_hash_type = in_array($type, hash_algos()) ? $type : 'sha1';
<<<<<<< HEAD
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	}

	// --------------------------------------------------------------------

	/**
	 * Hash encode a string
	 *
<<<<<<< HEAD
<<<<<<< HEAD
	 * @access	public
	 * @param	string
	 * @return	string
	 */
	function hash($str)
	{
		return ($this->_hash_type == 'sha1') ? $this->sha1($str) : md5($str);
	}

	// --------------------------------------------------------------------

	/**
	 * Generate an SHA1 Hash
	 *
	 * @access	public
	 * @param	string
	 * @return	string
	 */
	function sha1($str)
	{
		if ( ! function_exists('sha1'))
		{
			if ( ! function_exists('mhash'))
			{
				require_once(BASEPATH.'libraries/Sha1.php');
				$SH = new CI_SHA;
				return $SH->generate($str);
			}
			else
			{
				return bin2hex(mhash(MHASH_SHA1, $str));
			}
		}
		else
		{
			return sha1($str);
		}
	}

}

// END CI_Encrypt class

/* End of file Encrypt.php */
/* Location: ./system/libraries/Encrypt.php */
=======
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	 * @param	string
	 * @return	string
	 */
	public function hash($str)
	{
		return hash($this->_hash_type, $str);
	}

}
<<<<<<< HEAD
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
