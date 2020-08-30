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
 * Form Validation Class
 *
 * @package		CodeIgniter
 * @subpackage	Libraries
 * @category	Validation
 * @author		EllisLab Dev Team
<<<<<<< HEAD
<<<<<<< HEAD
 * @link		http://codeigniter.com/user_guide/libraries/form_validation.html
 */
class CI_Form_validation {

	protected $CI;
	protected $_field_data			= array();
	protected $_config_rules		= array();
	protected $_error_array			= array();
	protected $_error_messages		= array();
	protected $_error_prefix		= '<p>';
	protected $_error_suffix		= '</p>';
	protected $error_string			= '';
	protected $_safe_form_data		= FALSE;

	/**
	 * Constructor
=======
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
 * @link		https://codeigniter.com/user_guide/libraries/form_validation.html
 */
class CI_Form_validation {

	/**
	 * Reference to the CodeIgniter instance
	 *
	 * @var object
	 */
	protected $CI;

	/**
	 * Validation data for the current form submission
	 *
	 * @var array
	 */
	protected $_field_data		= array();

	/**
	 * Validation rules for the current form
	 *
	 * @var array
	 */
	protected $_config_rules	= array();

	/**
	 * Array of validation errors
	 *
	 * @var array
	 */
	protected $_error_array		= array();

	/**
	 * Array of custom error messages
	 *
	 * @var array
	 */
	protected $_error_messages	= array();

	/**
	 * Start tag for error wrapping
	 *
	 * @var string
	 */
	protected $_error_prefix	= '<p>';

	/**
	 * End tag for error wrapping
	 *
	 * @var string
	 */
	protected $_error_suffix	= '</p>';

	/**
	 * Custom error message
	 *
	 * @var string
	 */
	protected $error_string		= '';

	/**
	 * Whether the form data has been validated as safe
	 *
	 * @var bool
	 */
	protected $_safe_form_data	= FALSE;

	/**
	 * Custom data to validate
	 *
	 * @var array
	 */
	public $validation_data	= array();

	/**
	 * Initialize Form_Validation class
	 *
	 * @param	array	$rules
	 * @return	void
<<<<<<< HEAD
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	 */
	public function __construct($rules = array())
	{
		$this->CI =& get_instance();

<<<<<<< HEAD
<<<<<<< HEAD
=======
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
		// applies delimiters set in config file.
		if (isset($rules['error_prefix']))
		{
			$this->_error_prefix = $rules['error_prefix'];
			unset($rules['error_prefix']);
		}
		if (isset($rules['error_suffix']))
		{
			$this->_error_suffix = $rules['error_suffix'];
			unset($rules['error_suffix']);
		}

<<<<<<< HEAD
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
		// Validation rules can be stored in a config file.
		$this->_config_rules = $rules;

		// Automatically load the form helper
		$this->CI->load->helper('form');

<<<<<<< HEAD
<<<<<<< HEAD
		// Set the character encoding in MB.
		if (function_exists('mb_internal_encoding'))
		{
			mb_internal_encoding($this->CI->config->item('charset'));
		}

		log_message('debug', "Form Validation Class Initialized");
=======
		log_message('info', 'Form Validation Class Initialized');
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
		log_message('info', 'Form Validation Class Initialized');
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	}

	// --------------------------------------------------------------------

	/**
	 * Set Rules
	 *
	 * This function takes an array of field names and validation
<<<<<<< HEAD
<<<<<<< HEAD
	 * rules as input, validates the info, and stores it
	 *
	 * @access	public
	 * @param	mixed
	 * @param	string
	 * @return	void
	 */
	public function set_rules($field, $label = '', $rules = '')
	{
		// No reason to set rules if we have no POST data
		if (count($_POST) == 0)
=======
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	 * rules as input, any custom error messages, validates the info,
	 * and stores it
	 *
	 * @param	mixed	$field
	 * @param	string	$label
	 * @param	mixed	$rules
	 * @param	array	$errors
	 * @return	CI_Form_validation
	 */
	public function set_rules($field, $label = '', $rules = array(), $errors = array())
	{
		// No reason to set rules if we have no POST data
		// or a validation array has not been specified
		if ($this->CI->input->method() !== 'post' && empty($this->validation_data))
<<<<<<< HEAD
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
		{
			return $this;
		}

<<<<<<< HEAD
<<<<<<< HEAD
		// If an array was passed via the first parameter instead of indidual string
=======
		// If an array was passed via the first parameter instead of individual string
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
		// If an array was passed via the first parameter instead of individual string
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
		// values we cycle through it and recursively call this function.
		if (is_array($field))
		{
			foreach ($field as $row)
			{
				// Houston, we have a problem...
<<<<<<< HEAD
<<<<<<< HEAD
				if ( ! isset($row['field']) OR ! isset($row['rules']))
=======
				if ( ! isset($row['field'], $row['rules']))
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
				if ( ! isset($row['field'], $row['rules']))
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
				{
					continue;
				}

				// If the field label wasn't passed we use the field name
<<<<<<< HEAD
<<<<<<< HEAD
				$label = ( ! isset($row['label'])) ? $row['field'] : $row['label'];

				// Here we go!
				$this->set_rules($row['field'], $label, $row['rules']);
			}
			return $this;
		}

		// No fields? Nothing to do...
		if ( ! is_string($field) OR  ! is_string($rules) OR $field == '')
		{
			return $this;
		}

		// If the field label wasn't passed we use the field name
		$label = ($label == '') ? $field : $label;

		// Is the field name an array?  We test for the existence of a bracket "[" in
		// the field name to determine this.  If it is an array, we break it apart
		// into its components so that we can fetch the corresponding POST data later
		if (strpos($field, '[') !== FALSE AND preg_match_all('/\[(.*?)\]/', $field, $matches))
		{
			// Note: Due to a bug in current() that affects some versions
			// of PHP we can not pass function call directly into it
			$x = explode('[', $field);
			$indexes[] = current($x);

			for ($i = 0; $i < count($matches['0']); $i++)
			{
				if ($matches['1'][$i] != '')
				{
					$indexes[] = $matches['1'][$i];
				}
			}

			$is_array = TRUE;
		}
		else
		{
			$indexes	= array();
			$is_array	= FALSE;
=======
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
				$label = isset($row['label']) ? $row['label'] : $row['field'];

				// Add the custom error message array
				$errors = (isset($row['errors']) && is_array($row['errors'])) ? $row['errors'] : array();

				// Here we go!
				$this->set_rules($row['field'], $label, $row['rules'], $errors);
			}

			return $this;
		}

		// No fields or no rules? Nothing to do...
		if ( ! is_string($field) OR $field === '' OR empty($rules))
		{
			return $this;
		}
		elseif ( ! is_array($rules))
		{
			// BC: Convert pipe-separated rules string to an array
			if ( ! is_string($rules))
			{
				return $this;
			}

			$rules = preg_split('/\|(?![^\[]*\])/', $rules);
		}

		// If the field label wasn't passed we use the field name
		$label = ($label === '') ? $field : $label;

		$indexes = array();

		// Is the field name an array? If it is an array, we break it apart
		// into its components so that we can fetch the corresponding POST data later
		if (($is_array = (bool) preg_match_all('/\[(.*?)\]/', $field, $matches)) === TRUE)
		{
			sscanf($field, '%[^[][', $indexes[0]);

			for ($i = 0, $c = count($matches[0]); $i < $c; $i++)
			{
				if ($matches[1][$i] !== '')
				{
					$indexes[] = $matches[1][$i];
				}
			}
<<<<<<< HEAD
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
		}

		// Build our master array
		$this->_field_data[$field] = array(
<<<<<<< HEAD
<<<<<<< HEAD
			'field'				=> $field,
			'label'				=> $label,
			'rules'				=> $rules,
			'is_array'			=> $is_array,
			'keys'				=> $indexes,
			'postdata'			=> NULL,
			'error'				=> ''
=======
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
			'field'		=> $field,
			'label'		=> $label,
			'rules'		=> $rules,
			'errors'	=> $errors,
			'is_array'	=> $is_array,
			'keys'		=> $indexes,
			'postdata'	=> NULL,
			'error'		=> ''
<<<<<<< HEAD
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
		);

		return $this;
	}

	// --------------------------------------------------------------------

	/**
<<<<<<< HEAD
<<<<<<< HEAD
	 * Set Error Message
	 *
	 * Lets users set their own error messages on the fly.  Note:  The key
	 * name has to match the  function name that it corresponds to.
	 *
	 * @access	public
	 * @param	string
	 * @param	string
	 * @return	string
=======
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	 * By default, form validation uses the $_POST array to validate
	 *
	 * If an array is set through this method, then this array will
	 * be used instead of the $_POST array
	 *
	 * Note that if you are validating multiple arrays, then the
	 * reset_validation() function should be called after validating
	 * each array due to the limitations of CI's singleton
	 *
	 * @param	array	$data
	 * @return	CI_Form_validation
	 */
	public function set_data(array $data)
	{
		if ( ! empty($data))
		{
			$this->validation_data = $data;
		}

		return $this;
	}

	// --------------------------------------------------------------------

	/**
	 * Set Error Message
	 *
	 * Lets users set their own error messages on the fly. Note:
	 * The key name has to match the function name that it corresponds to.
	 *
	 * @param	array
	 * @param	string
	 * @return	CI_Form_validation
<<<<<<< HEAD
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	 */
	public function set_message($lang, $val = '')
	{
		if ( ! is_array($lang))
		{
			$lang = array($lang => $val);
		}

		$this->_error_messages = array_merge($this->_error_messages, $lang);
<<<<<<< HEAD
<<<<<<< HEAD

=======
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
		return $this;
	}

	// --------------------------------------------------------------------

	/**
	 * Set The Error Delimiter
	 *
	 * Permits a prefix/suffix to be added to each error message
	 *
<<<<<<< HEAD
<<<<<<< HEAD
	 * @access	public
	 * @param	string
	 * @param	string
	 * @return	void
=======
	 * @param	string
	 * @param	string
	 * @return	CI_Form_validation
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
	 * @param	string
	 * @param	string
	 * @return	CI_Form_validation
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	 */
	public function set_error_delimiters($prefix = '<p>', $suffix = '</p>')
	{
		$this->_error_prefix = $prefix;
		$this->_error_suffix = $suffix;
<<<<<<< HEAD
<<<<<<< HEAD

=======
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
		return $this;
	}

	// --------------------------------------------------------------------

	/**
	 * Get Error Message
	 *
	 * Gets the error message associated with a particular field
	 *
<<<<<<< HEAD
<<<<<<< HEAD
	 * @access	public
	 * @param	string	the field name
	 * @return	void
	 */
	public function error($field = '', $prefix = '', $suffix = '')
	{
		if ( ! isset($this->_field_data[$field]['error']) OR $this->_field_data[$field]['error'] == '')
=======
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	 * @param	string	$field	Field name
	 * @param	string	$prefix	HTML start tag
	 * @param 	string	$suffix	HTML end tag
	 * @return	string
	 */
	public function error($field, $prefix = '', $suffix = '')
	{
		if (empty($this->_field_data[$field]['error']))
<<<<<<< HEAD
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
		{
			return '';
		}

<<<<<<< HEAD
<<<<<<< HEAD
		if ($prefix == '')
=======
		if ($prefix === '')
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
		if ($prefix === '')
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
		{
			$prefix = $this->_error_prefix;
		}

<<<<<<< HEAD
<<<<<<< HEAD
		if ($suffix == '')
=======
		if ($suffix === '')
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
		if ($suffix === '')
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
		{
			$suffix = $this->_error_suffix;
		}

		return $prefix.$this->_field_data[$field]['error'].$suffix;
	}

	// --------------------------------------------------------------------

	/**
<<<<<<< HEAD
<<<<<<< HEAD
=======
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	 * Get Array of Error Messages
	 *
	 * Returns the error messages as an array
	 *
	 * @return	array
	 */
	public function error_array()
	{
		return $this->_error_array;
	}

	// --------------------------------------------------------------------

	/**
<<<<<<< HEAD
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	 * Error String
	 *
	 * Returns the error messages as a string, wrapped in the error delimiters
	 *
<<<<<<< HEAD
<<<<<<< HEAD
	 * @access	public
	 * @param	string
	 * @param	string
	 * @return	str
	 */
	public function error_string($prefix = '', $suffix = '')
	{
		// No errrors, validation passes!
=======
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	 * @param	string
	 * @param	string
	 * @return	string
	 */
	public function error_string($prefix = '', $suffix = '')
	{
		// No errors, validation passes!
<<<<<<< HEAD
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
		if (count($this->_error_array) === 0)
		{
			return '';
		}

<<<<<<< HEAD
<<<<<<< HEAD
		if ($prefix == '')
=======
		if ($prefix === '')
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
		if ($prefix === '')
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
		{
			$prefix = $this->_error_prefix;
		}

<<<<<<< HEAD
<<<<<<< HEAD
		if ($suffix == '')
=======
		if ($suffix === '')
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
		if ($suffix === '')
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
		{
			$suffix = $this->_error_suffix;
		}

		// Generate the error string
		$str = '';
		foreach ($this->_error_array as $val)
		{
<<<<<<< HEAD
<<<<<<< HEAD
			if ($val != '')
=======
			if ($val !== '')
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
			if ($val !== '')
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
			{
				$str .= $prefix.$val.$suffix."\n";
			}
		}

		return $str;
	}

	// --------------------------------------------------------------------

	/**
	 * Run the Validator
	 *
	 * This function does all the work.
	 *
<<<<<<< HEAD
<<<<<<< HEAD
	 * @access	public
=======
	 * @param	string	$group
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
	 * @param	string	$group
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	 * @return	bool
	 */
	public function run($group = '')
	{
<<<<<<< HEAD
<<<<<<< HEAD
		// Do we even have any data to process?  Mm?
		if (count($_POST) == 0)
		{
			return FALSE;
		}

		// Does the _field_data array containing the validation rules exist?
		// If not, we look to see if they were assigned via a config file
		if (count($this->_field_data) == 0)
		{
			// No validation rules?  We're done...
			if (count($this->_config_rules) == 0)
=======
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
		$validation_array = empty($this->validation_data)
			? $_POST
			: $this->validation_data;

		// Does the _field_data array containing the validation rules exist?
		// If not, we look to see if they were assigned via a config file
		if (count($this->_field_data) === 0)
		{
			// No validation rules?  We're done...
			if (count($this->_config_rules) === 0)
<<<<<<< HEAD
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
			{
				return FALSE;
			}

<<<<<<< HEAD
<<<<<<< HEAD
			// Is there a validation rule for the particular URI being accessed?
			$uri = ($group == '') ? trim($this->CI->uri->ruri_string(), '/') : $group;

			if ($uri != '' AND isset($this->_config_rules[$uri]))
			{
				$this->set_rules($this->_config_rules[$uri]);
			}
			else
			{
				$this->set_rules($this->_config_rules);
			}

			// We're we able to set the rules correctly?
			if (count($this->_field_data) == 0)
			{
				log_message('debug', "Unable to find validation rules");
=======
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
			if (empty($group))
			{
				// Is there a validation rule for the particular URI being accessed?
				$group = trim($this->CI->uri->ruri_string(), '/');
				isset($this->_config_rules[$group]) OR $group = $this->CI->router->class.'/'.$this->CI->router->method;
			}

			$this->set_rules(isset($this->_config_rules[$group]) ? $this->_config_rules[$group] : $this->_config_rules);

			// Were we able to set the rules correctly?
			if (count($this->_field_data) === 0)
			{
				log_message('debug', 'Unable to find validation rules');
<<<<<<< HEAD
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
				return FALSE;
			}
		}

		// Load the language file containing error messages
		$this->CI->lang->load('form_validation');

<<<<<<< HEAD
<<<<<<< HEAD
		// Cycle through the rules for each field, match the
		// corresponding $_POST item and test for errors
		foreach ($this->_field_data as $field => $row)
		{
			// Fetch the data from the corresponding $_POST array and cache it in the _field_data array.
			// Depending on whether the field name is an array or a string will determine where we get it from.

			if ($row['is_array'] == TRUE)
			{
				$this->_field_data[$field]['postdata'] = $this->_reduce_array($_POST, $row['keys']);
			}
			else
			{
				if (isset($_POST[$field]) AND $_POST[$field] != "")
				{
					$this->_field_data[$field]['postdata'] = $_POST[$field];
				}
			}

			$this->_execute($row, explode('|', $row['rules']), $this->_field_data[$field]['postdata']);
=======
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
		// Cycle through the rules for each field and match the corresponding $validation_data item
		foreach ($this->_field_data as $field => &$row)
		{
			// Fetch the data from the validation_data array item and cache it in the _field_data array.
			// Depending on whether the field name is an array or a string will determine where we get it from.
			if ($row['is_array'] === TRUE)
			{
				$this->_field_data[$field]['postdata'] = $this->_reduce_array($validation_array, $row['keys']);
			}
			elseif (isset($validation_array[$field]))
			{
				$this->_field_data[$field]['postdata'] = $validation_array[$field];
			}
		}

		// Execute validation rules
		// Note: A second foreach (for now) is required in order to avoid false-positives
		//	 for rules like 'matches', which correlate to other validation fields.
		foreach ($this->_field_data as $field => &$row)
		{
			// Don't try to validate if we have no rules set
			if (empty($row['rules']))
			{
				continue;
			}

			$this->_execute($row, $row['rules'], $row['postdata']);
<<<<<<< HEAD
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
		}

		// Did we end up with any errors?
		$total_errors = count($this->_error_array);
<<<<<<< HEAD
<<<<<<< HEAD

=======
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
		if ($total_errors > 0)
		{
			$this->_safe_form_data = TRUE;
		}

		// Now we need to re-set the POST data with the new, processed data
<<<<<<< HEAD
<<<<<<< HEAD
		$this->_reset_post_array();

		// No errors, validation passes!
		if ($total_errors == 0)
		{
			return TRUE;
		}

		// Validation fails
		return FALSE;
=======
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
		empty($this->validation_data) && $this->_reset_post_array();

		return ($total_errors === 0);
	}

	// --------------------------------------------------------------------

	/**
	 * Prepare rules
	 *
	 * Re-orders the provided rules in order of importance, so that
	 * they can easily be executed later without weird checks ...
	 *
	 * "Callbacks" are given the highest priority (always called),
	 * followed by 'required' (called if callbacks didn't fail),
	 * and then every next rule depends on the previous one passing.
	 *
	 * @param	array	$rules
	 * @return	array
	 */
	protected function _prepare_rules($rules)
	{
		$new_rules = array();
		$callbacks = array();

		foreach ($rules as &$rule)
		{
			// Let 'required' always be the first (non-callback) rule
			if ($rule === 'required')
			{
				array_unshift($new_rules, 'required');
			}
			// 'isset' is a kind of a weird alias for 'required' ...
			elseif ($rule === 'isset' && (empty($new_rules) OR $new_rules[0] !== 'required'))
			{
				array_unshift($new_rules, 'isset');
			}
			// The old/classic 'callback_'-prefixed rules
			elseif (is_string($rule) && strncmp('callback_', $rule, 9) === 0)
			{
				$callbacks[] = $rule;
			}
			// Proper callables
			elseif (is_callable($rule))
			{
				$callbacks[] = $rule;
			}
			// "Named" callables; i.e. array('name' => $callable)
			elseif (is_array($rule) && isset($rule[0], $rule[1]) && is_callable($rule[1]))
			{
				$callbacks[] = $rule;
			}
			// Everything else goes at the end of the queue
			else
			{
				$new_rules[] = $rule;
			}
		}

		return array_merge($callbacks, $new_rules);
<<<<<<< HEAD
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	}

	// --------------------------------------------------------------------

	/**
	 * Traverse a multidimensional $_POST array index until the data is found
	 *
<<<<<<< HEAD
<<<<<<< HEAD
	 * @access	private
	 * @param	array
	 * @param	array
	 * @param	integer
=======
	 * @param	array
	 * @param	array
	 * @param	int
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
	 * @param	array
	 * @param	array
	 * @param	int
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	 * @return	mixed
	 */
	protected function _reduce_array($array, $keys, $i = 0)
	{
<<<<<<< HEAD
<<<<<<< HEAD
		if (is_array($array))
		{
			if (isset($keys[$i]))
			{
				if (isset($array[$keys[$i]]))
				{
					$array = $this->_reduce_array($array[$keys[$i]], $keys, ($i+1));
				}
				else
				{
					return NULL;
				}
			}
			else
			{
				return $array;
			}
		}

		return $array;
=======
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
		if (is_array($array) && isset($keys[$i]))
		{
			return isset($array[$keys[$i]]) ? $this->_reduce_array($array[$keys[$i]], $keys, ($i+1)) : NULL;
		}

		// NULL must be returned for empty fields
		return ($array === '') ? NULL : $array;
<<<<<<< HEAD
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	}

	// --------------------------------------------------------------------

	/**
	 * Re-populate the _POST array with our finalized and processed data
	 *
<<<<<<< HEAD
<<<<<<< HEAD
	 * @access	private
	 * @return	null
=======
	 * @return	void
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
	 * @return	void
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	 */
	protected function _reset_post_array()
	{
		foreach ($this->_field_data as $field => $row)
		{
<<<<<<< HEAD
<<<<<<< HEAD
			if ( ! is_null($row['postdata']))
			{
				if ($row['is_array'] == FALSE)
				{
					if (isset($_POST[$row['field']]))
					{
						$_POST[$row['field']] = $this->prep_for_form($row['postdata']);
					}
=======
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
			if ($row['postdata'] !== NULL)
			{
				if ($row['is_array'] === FALSE)
				{
					isset($_POST[$field]) && $_POST[$field] = $row['postdata'];
<<<<<<< HEAD
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
				}
				else
				{
					// start with a reference
					$post_ref =& $_POST;

					// before we assign values, make a reference to the right POST key
<<<<<<< HEAD
<<<<<<< HEAD
					if (count($row['keys']) == 1)
=======
					if (count($row['keys']) === 1)
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
					if (count($row['keys']) === 1)
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
					{
						$post_ref =& $post_ref[current($row['keys'])];
					}
					else
					{
						foreach ($row['keys'] as $val)
						{
							$post_ref =& $post_ref[$val];
						}
					}

<<<<<<< HEAD
<<<<<<< HEAD
					if (is_array($row['postdata']))
					{
						$array = array();
						foreach ($row['postdata'] as $k => $v)
						{
							$array[$k] = $this->prep_for_form($v);
						}

						$post_ref = $array;
					}
					else
					{
						$post_ref = $this->prep_for_form($row['postdata']);
					}
=======
					$post_ref = $row['postdata'];
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
					$post_ref = $row['postdata'];
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
				}
			}
		}
	}

	// --------------------------------------------------------------------

	/**
	 * Executes the Validation routines
	 *
<<<<<<< HEAD
<<<<<<< HEAD
	 * @access	private
	 * @param	array
	 * @param	array
	 * @param	mixed
	 * @param	integer
=======
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	 * @param	array
	 * @param	array
	 * @param	mixed
	 * @param	int
<<<<<<< HEAD
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	 * @return	mixed
	 */
	protected function _execute($row, $rules, $postdata = NULL, $cycles = 0)
	{
		// If the $_POST data is an array we will run a recursive call
<<<<<<< HEAD
<<<<<<< HEAD
		if (is_array($postdata))
		{
			foreach ($postdata as $key => $val)
			{
				$this->_execute($row, $rules, $val, $cycles);
				$cycles++;
=======
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
		//
		// Note: We MUST check if the array is empty or not!
		//       Otherwise empty arrays will always pass validation.
		if (is_array($postdata) && ! empty($postdata))
		{
			foreach ($postdata as $key => $val)
			{
				$this->_execute($row, $rules, $val, $key);
<<<<<<< HEAD
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
			}

			return;
		}

<<<<<<< HEAD
		// --------------------------------------------------------------------

		// If the field is blank, but NOT required, no further tests are necessary
		$callback = FALSE;
		if ( ! in_array('required', $rules) AND is_null($postdata))
		{
			// Before we bail out, does the rule contain a callback?
			if (preg_match("/(callback_\w+(\[.*?\])?)/", implode(' ', $rules), $match))
			{
				$callback = TRUE;
				$rules = (array('1' => $match[1]));
			}
			else
			{
				return;
			}
		}

		// --------------------------------------------------------------------

		// Isset Test. Typically this rule will only apply to checkboxes.
		if (is_null($postdata) AND $callback == FALSE)
		{
			if (in_array('isset', $rules, TRUE) OR in_array('required', $rules))
			{
				// Set the message type
				$type = (in_array('required', $rules)) ? 'required' : 'isset';

				if ( ! isset($this->_error_messages[$type]))
				{
					if (FALSE === ($line = $this->CI->lang->line($type)))
					{
						$line = 'The field was not set';
					}
				}
				else
				{
					$line = $this->_error_messages[$type];
				}

				// Build the error message
				$message = sprintf($line, $this->_translate_fieldname($row['label']));

				// Save the error message
				$this->_field_data[$row['field']]['error'] = $message;

				if ( ! isset($this->_error_array[$row['field']]))
				{
					$this->_error_array[$row['field']] = $message;
				}
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
			}

			return;
		}

<<<<<<< HEAD
		// --------------------------------------------------------------------

		// Cycle through each rule and run it
		foreach ($rules As $rule)
=======
		$rules = $this->_prepare_rules($rules);
		foreach ($rules as $rule)
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
		$rules = $this->_prepare_rules($rules);
		foreach ($rules as $rule)
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
		{
			$_in_array = FALSE;

			// We set the $postdata variable with the current data in our master array so that
			// each cycle of the loop is dealing with the processed data from the last cycle
<<<<<<< HEAD
<<<<<<< HEAD
			if ($row['is_array'] == TRUE AND is_array($this->_field_data[$row['field']]['postdata']))
=======
			if ($row['is_array'] === TRUE && is_array($this->_field_data[$row['field']]['postdata']))
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
			if ($row['is_array'] === TRUE && is_array($this->_field_data[$row['field']]['postdata']))
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
			{
				// We shouldn't need this safety, but just in case there isn't an array index
				// associated with this cycle we'll bail out
				if ( ! isset($this->_field_data[$row['field']]['postdata'][$cycles]))
				{
					continue;
				}

				$postdata = $this->_field_data[$row['field']]['postdata'][$cycles];
				$_in_array = TRUE;
			}
			else
			{
<<<<<<< HEAD
<<<<<<< HEAD
				$postdata = $this->_field_data[$row['field']]['postdata'];
			}

			// --------------------------------------------------------------------

			// Is the rule a callback?
			$callback = FALSE;
			if (substr($rule, 0, 9) == 'callback_')
			{
				$rule = substr($rule, 9);
				$callback = TRUE;
=======
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
				// If we get an array field, but it's not expected - then it is most likely
				// somebody messing with the form on the client side, so we'll just consider
				// it an empty field
				$postdata = is_array($this->_field_data[$row['field']]['postdata'])
					? NULL
					: $this->_field_data[$row['field']]['postdata'];
			}

			// Is the rule a callback?
			$callback = $callable = FALSE;
			if (is_string($rule))
			{
				if (strpos($rule, 'callback_') === 0)
				{
					$rule = substr($rule, 9);
					$callback = TRUE;
				}
			}
			elseif (is_callable($rule))
			{
				$callable = TRUE;
			}
			elseif (is_array($rule) && isset($rule[0], $rule[1]) && is_callable($rule[1]))
			{
				// We have a "named" callable, so save the name
				$callable = $rule[0];
				$rule = $rule[1];
<<<<<<< HEAD
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
			}

			// Strip the parameter (if exists) from the rule
			// Rules can contain a parameter: max_length[5]
			$param = FALSE;
<<<<<<< HEAD
<<<<<<< HEAD
			if (preg_match("/(.*?)\[(.*)\]/", $rule, $match))
			{
				$rule	= $match[1];
				$param	= $match[2];
			}

			// Call the function that corresponds to the rule
			if ($callback === TRUE)
			{
				if ( ! method_exists($this->CI, $rule))
				{
					continue;
				}

				// Run the function and grab the result
				$result = $this->CI->$rule($postdata, $param);

				// Re-assign the result to the master data array
				if ($_in_array == TRUE)
				{
					$this->_field_data[$row['field']]['postdata'][$cycles] = (is_bool($result)) ? $postdata : $result;
				}
				else
				{
					$this->_field_data[$row['field']]['postdata'] = (is_bool($result)) ? $postdata : $result;
				}

				// If the field isn't required and we just processed a callback we'll move on...
				if ( ! in_array('required', $rules, TRUE) AND $result !== FALSE)
				{
					continue;
				}
			}
			else
			{
				if ( ! method_exists($this, $rule))
				{
					// If our own wrapper function doesn't exist we see if a native PHP function does.
					// Users can use any native PHP function call that has one param.
					if (function_exists($rule))
					{
						$result = $rule($postdata);

						if ($_in_array == TRUE)
						{
							$this->_field_data[$row['field']]['postdata'][$cycles] = (is_bool($result)) ? $postdata : $result;
						}
						else
						{
							$this->_field_data[$row['field']]['postdata'] = (is_bool($result)) ? $postdata : $result;
						}
					}
					else
					{
						log_message('debug', "Unable to find validation rule: ".$rule);
					}

					continue;
				}

				$result = $this->$rule($postdata, $param);

				if ($_in_array == TRUE)
				{
					$this->_field_data[$row['field']]['postdata'][$cycles] = (is_bool($result)) ? $postdata : $result;
				}
				else
				{
					$this->_field_data[$row['field']]['postdata'] = (is_bool($result)) ? $postdata : $result;
				}
			}

			// Did the rule test negatively?  If so, grab the error.
			if ($result === FALSE)
			{
				if ( ! isset($this->_error_messages[$rule]))
				{
					if (FALSE === ($line = $this->CI->lang->line($rule)))
					{
						$line = 'Unable to access an error message corresponding to your field name.';
					}
				}
				else
				{
					$line = $this->_error_messages[$rule];
				}

				// Is the parameter we are inserting into the error message the name
				// of another field?  If so we need to grab its "field label"
				if (isset($this->_field_data[$param]) AND isset($this->_field_data[$param]['label']))
=======
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
			if ( ! $callable && preg_match('/(.*?)\[(.*)\]/', $rule, $match))
			{
				$rule = $match[1];
				$param = $match[2];
			}

			// Ignore empty, non-required inputs with a few exceptions ...
			if (
				($postdata === NULL OR $postdata === '')
				&& $callback === FALSE
				&& $callable === FALSE
				&& ! in_array($rule, array('required', 'isset', 'matches'), TRUE)
			)
			{
				continue;
			}

			// Call the function that corresponds to the rule
			if ($callback OR $callable !== FALSE)
			{
				if ($callback)
				{
					if ( ! method_exists($this->CI, $rule))
					{
						log_message('debug', 'Unable to find callback validation rule: '.$rule);
						$result = FALSE;
					}
					else
					{
						// Run the function and grab the result
						$result = $this->CI->$rule($postdata, $param);
					}
				}
				else
				{
					$result = is_array($rule)
						? $rule[0]->{$rule[1]}($postdata)
						: $rule($postdata);

					// Is $callable set to a rule name?
					if ($callable !== FALSE)
					{
						$rule = $callable;
					}
				}

				// Re-assign the result to the master data array
				if ($_in_array === TRUE)
				{
					$this->_field_data[$row['field']]['postdata'][$cycles] = is_bool($result) ? $postdata : $result;
				}
				else
				{
					$this->_field_data[$row['field']]['postdata'] = is_bool($result) ? $postdata : $result;
				}
			}
			elseif ( ! method_exists($this, $rule))
			{
				// If our own wrapper function doesn't exist we see if a native PHP function does.
				// Users can use any native PHP function call that has one param.
				if (function_exists($rule))
				{
					// Native PHP functions issue warnings if you pass them more parameters than they use
					$result = ($param !== FALSE) ? $rule($postdata, $param) : $rule($postdata);

					if ($_in_array === TRUE)
					{
						$this->_field_data[$row['field']]['postdata'][$cycles] = is_bool($result) ? $postdata : $result;
					}
					else
					{
						$this->_field_data[$row['field']]['postdata'] = is_bool($result) ? $postdata : $result;
					}
				}
				else
				{
					log_message('debug', 'Unable to find validation rule: '.$rule);
					$result = FALSE;
				}
			}
			else
			{
				$result = $this->$rule($postdata, $param);

				if ($_in_array === TRUE)
				{
					$this->_field_data[$row['field']]['postdata'][$cycles] = is_bool($result) ? $postdata : $result;
				}
				else
				{
					$this->_field_data[$row['field']]['postdata'] = is_bool($result) ? $postdata : $result;
				}
			}

			// Did the rule test negatively? If so, grab the error.
			if ($result === FALSE)
			{
				// Callable rules might not have named error messages
				if ( ! is_string($rule))
				{
					$line = $this->CI->lang->line('form_validation_error_message_not_set').'(Anonymous function)';
				}
				else
				{
					$line = $this->_get_error_message($rule, $row['field']);
				}

				// Is the parameter we are inserting into the error message the name
				// of another field? If so we need to grab its "field label"
				if (isset($this->_field_data[$param], $this->_field_data[$param]['label']))
<<<<<<< HEAD
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
				{
					$param = $this->_translate_fieldname($this->_field_data[$param]['label']);
				}

				// Build the error message
<<<<<<< HEAD
<<<<<<< HEAD
				$message = sprintf($line, $this->_translate_fieldname($row['label']), $param);
=======
				$message = $this->_build_error_msg($line, $this->_translate_fieldname($row['label']), $param);
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
				$message = $this->_build_error_msg($line, $this->_translate_fieldname($row['label']), $param);
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3

				// Save the error message
				$this->_field_data[$row['field']]['error'] = $message;

				if ( ! isset($this->_error_array[$row['field']]))
				{
					$this->_error_array[$row['field']] = $message;
				}

				return;
			}
		}
	}

	// --------------------------------------------------------------------

	/**
<<<<<<< HEAD
<<<<<<< HEAD
	 * Translate a field name
	 *
	 * @access	private
=======
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	 * Get the error message for the rule
	 *
	 * @param 	string $rule 	The rule name
	 * @param 	string $field	The field name
	 * @return 	string
	 */
	protected function _get_error_message($rule, $field)
	{
		// check if a custom message is defined through validation config row.
		if (isset($this->_field_data[$field]['errors'][$rule]))
		{
			return $this->_field_data[$field]['errors'][$rule];
		}
		// check if a custom message has been set using the set_message() function
		elseif (isset($this->_error_messages[$rule]))
		{
			return $this->_error_messages[$rule];
		}
		elseif (FALSE !== ($line = $this->CI->lang->line('form_validation_'.$rule)))
		{
			return $line;
		}
		// DEPRECATED support for non-prefixed keys, lang file again
		elseif (FALSE !== ($line = $this->CI->lang->line($rule, FALSE)))
		{
			return $line;
		}

		return $this->CI->lang->line('form_validation_error_message_not_set').'('.$rule.')';
	}

	// --------------------------------------------------------------------

	/**
	 * Translate a field name
	 *
<<<<<<< HEAD
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	 * @param	string	the field name
	 * @return	string
	 */
	protected function _translate_fieldname($fieldname)
	{
<<<<<<< HEAD
<<<<<<< HEAD
		// Do we need to translate the field name?
		// We look for the prefix lang: to determine this
		if (substr($fieldname, 0, 5) == 'lang:')
		{
			// Grab the variable
			$line = substr($fieldname, 5);

			// Were we able to translate the field name?  If not we use $line
			if (FALSE === ($fieldname = $this->CI->lang->line($line)))
			{
				return $line;
			}
=======
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
		// Do we need to translate the field name? We look for the prefix 'lang:' to determine this
		// If we find one, but there's no translation for the string - just return it
		if (sscanf($fieldname, 'lang:%s', $line) === 1 && FALSE === ($fieldname = $this->CI->lang->line($line, FALSE)))
		{
			return $line;
<<<<<<< HEAD
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
		}

		return $fieldname;
	}

	// --------------------------------------------------------------------

	/**
<<<<<<< HEAD
<<<<<<< HEAD
=======
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	 * Build an error message using the field and param.
	 *
	 * @param	string	The error message line
	 * @param	string	A field's human name
	 * @param	mixed	A rule's optional parameter
	 * @return	string
	 */
	protected function _build_error_msg($line, $field = '', $param = '')
	{
		// Check for %s in the string for legacy support.
		if (strpos($line, '%s') !== FALSE)
		{
			return sprintf($line, $field, $param);
		}

		return str_replace(array('{field}', '{param}'), array($field, $param), $line);
	}

	// --------------------------------------------------------------------

	/**
	 * Checks if the rule is present within the validator
	 *
	 * Permits you to check if a rule is present within the validator
	 *
	 * @param	string	the field name
	 * @return	bool
	 */
	public function has_rule($field)
	{
		return isset($this->_field_data[$field]);
	}

	// --------------------------------------------------------------------

	/**
<<<<<<< HEAD
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	 * Get the value from a form
	 *
	 * Permits you to repopulate a form field with the value it was submitted
	 * with, or, if that value doesn't exist, with the default
	 *
<<<<<<< HEAD
<<<<<<< HEAD
	 * @access	public
	 * @param	string	the field name
	 * @param	string
	 * @return	void
	 */
	public function set_value($field = '', $default = '')
	{
		if ( ! isset($this->_field_data[$field]))
=======
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	 * @param	string	the field name
	 * @param	string
	 * @return	string
	 */
	public function set_value($field = '', $default = '')
	{
		if ( ! isset($this->_field_data[$field], $this->_field_data[$field]['postdata']))
<<<<<<< HEAD
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
		{
			return $default;
		}

		// If the data is an array output them one at a time.
<<<<<<< HEAD
<<<<<<< HEAD
		//     E.g: form_input('name[]', set_value('name[]');
=======
		//	E.g: form_input('name[]', set_value('name[]');
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
		//	E.g: form_input('name[]', set_value('name[]');
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
		if (is_array($this->_field_data[$field]['postdata']))
		{
			return array_shift($this->_field_data[$field]['postdata']);
		}

		return $this->_field_data[$field]['postdata'];
	}

	// --------------------------------------------------------------------

	/**
	 * Set Select
	 *
	 * Enables pull-down lists to be set to the value the user
	 * selected in the event of an error
	 *
<<<<<<< HEAD
<<<<<<< HEAD
	 * @access	public
	 * @param	string
	 * @param	string
=======
	 * @param	string
	 * @param	string
	 * @param	bool
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
	 * @param	string
	 * @param	string
	 * @param	bool
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	 * @return	string
	 */
	public function set_select($field = '', $value = '', $default = FALSE)
	{
<<<<<<< HEAD
<<<<<<< HEAD
		if ( ! isset($this->_field_data[$field]) OR ! isset($this->_field_data[$field]['postdata']))
		{
			if ($default === TRUE AND count($this->_field_data) === 0)
			{
				return ' selected="selected"';
			}
			return '';
		}

		$field = $this->_field_data[$field]['postdata'];

		if (is_array($field))
		{
			if ( ! in_array($value, $field))
			{
				return '';
			}
		}
		else
		{
			if (($field == '' OR $value == '') OR ($field != $value))
			{
				return '';
			}
=======
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
		if ( ! isset($this->_field_data[$field], $this->_field_data[$field]['postdata']))
		{
			return ($default === TRUE && count($this->_field_data) === 0) ? ' selected="selected"' : '';
		}

		$field = $this->_field_data[$field]['postdata'];
		$value = (string) $value;
		if (is_array($field))
		{
			// Note: in_array('', array(0)) returns TRUE, do not use it
			foreach ($field as &$v)
			{
				if ($value === $v)
				{
					return ' selected="selected"';
				}
			}

			return '';
		}
		elseif (($field === '' OR $value === '') OR ($field !== $value))
		{
			return '';
<<<<<<< HEAD
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
		}

		return ' selected="selected"';
	}

	// --------------------------------------------------------------------

	/**
	 * Set Radio
	 *
	 * Enables radio buttons to be set to the value the user
	 * selected in the event of an error
	 *
<<<<<<< HEAD
<<<<<<< HEAD
	 * @access	public
	 * @param	string
	 * @param	string
=======
	 * @param	string
	 * @param	string
	 * @param	bool
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
	 * @param	string
	 * @param	string
	 * @param	bool
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	 * @return	string
	 */
	public function set_radio($field = '', $value = '', $default = FALSE)
	{
<<<<<<< HEAD
<<<<<<< HEAD
		if ( ! isset($this->_field_data[$field]) OR ! isset($this->_field_data[$field]['postdata']))
		{
			if ($default === TRUE AND count($this->_field_data) === 0)
			{
				return ' checked="checked"';
			}
			return '';
		}

		$field = $this->_field_data[$field]['postdata'];

		if (is_array($field))
		{
			if ( ! in_array($value, $field))
			{
				return '';
			}
		}
		else
		{
			if (($field == '' OR $value == '') OR ($field != $value))
			{
				return '';
			}
=======
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
		if ( ! isset($this->_field_data[$field], $this->_field_data[$field]['postdata']))
		{
			return ($default === TRUE && count($this->_field_data) === 0) ? ' checked="checked"' : '';
		}

		$field = $this->_field_data[$field]['postdata'];
		$value = (string) $value;
		if (is_array($field))
		{
			// Note: in_array('', array(0)) returns TRUE, do not use it
			foreach ($field as &$v)
			{
				if ($value === $v)
				{
					return ' checked="checked"';
				}
			}

			return '';
		}
		elseif (($field === '' OR $value === '') OR ($field !== $value))
		{
			return '';
<<<<<<< HEAD
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
		}

		return ' checked="checked"';
	}

	// --------------------------------------------------------------------

	/**
	 * Set Checkbox
	 *
	 * Enables checkboxes to be set to the value the user
	 * selected in the event of an error
	 *
<<<<<<< HEAD
<<<<<<< HEAD
	 * @access	public
	 * @param	string
	 * @param	string
=======
	 * @param	string
	 * @param	string
	 * @param	bool
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
	 * @param	string
	 * @param	string
	 * @param	bool
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	 * @return	string
	 */
	public function set_checkbox($field = '', $value = '', $default = FALSE)
	{
<<<<<<< HEAD
<<<<<<< HEAD
		if ( ! isset($this->_field_data[$field]) OR ! isset($this->_field_data[$field]['postdata']))
		{
			if ($default === TRUE AND count($this->_field_data) === 0)
			{
				return ' checked="checked"';
			}
			return '';
		}

		$field = $this->_field_data[$field]['postdata'];

		if (is_array($field))
		{
			if ( ! in_array($value, $field))
			{
				return '';
			}
		}
		else
		{
			if (($field == '' OR $value == '') OR ($field != $value))
			{
				return '';
			}
		}

		return ' checked="checked"';
=======
		// Logic is exactly the same as for radio fields
		return $this->set_radio($field, $value, $default);
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
		// Logic is exactly the same as for radio fields
		return $this->set_radio($field, $value, $default);
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	}

	// --------------------------------------------------------------------

	/**
	 * Required
	 *
<<<<<<< HEAD
<<<<<<< HEAD
	 * @access	public
=======
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	 * @param	string
	 * @return	bool
	 */
	public function required($str)
	{
<<<<<<< HEAD
<<<<<<< HEAD
		if ( ! is_array($str))
		{
			return (trim($str) == '') ? FALSE : TRUE;
		}
		else
		{
			return ( ! empty($str));
		}
=======
		return is_array($str)
			? (empty($str) === FALSE)
			: (trim($str) !== '');
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
		return is_array($str)
			? (empty($str) === FALSE)
			: (trim($str) !== '');
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	}

	// --------------------------------------------------------------------

	/**
	 * Performs a Regular Expression match test.
	 *
<<<<<<< HEAD
<<<<<<< HEAD
	 * @access	public
	 * @param	string
	 * @param	regex
=======
	 * @param	string
	 * @param	string	regex
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
	 * @param	string
	 * @param	string	regex
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	 * @return	bool
	 */
	public function regex_match($str, $regex)
	{
<<<<<<< HEAD
<<<<<<< HEAD
		if ( ! preg_match($regex, $str))
		{
			return FALSE;
		}

		return  TRUE;
=======
		return (bool) preg_match($regex, $str);
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
		return (bool) preg_match($regex, $str);
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	}

	// --------------------------------------------------------------------

	/**
	 * Match one field to another
	 *
<<<<<<< HEAD
<<<<<<< HEAD
	 * @access	public
	 * @param	string
	 * @param	field
=======
	 * @param	string	$str	string to compare against
	 * @param	string	$field
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
	 * @param	string	$str	string to compare against
	 * @param	string	$field
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	 * @return	bool
	 */
	public function matches($str, $field)
	{
<<<<<<< HEAD
<<<<<<< HEAD
		if ( ! isset($_POST[$field]))
		{
			return FALSE;
		}

		$field = $_POST[$field];

		return ($str !== $field) ? FALSE : TRUE;
	}
	
	// --------------------------------------------------------------------

	/**
	 * Match one field to another
	 *
	 * @access	public
	 * @param	string
	 * @param	field
=======
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
		return isset($this->_field_data[$field], $this->_field_data[$field]['postdata'])
			? ($str === $this->_field_data[$field]['postdata'])
			: FALSE;
	}

	// --------------------------------------------------------------------

	/**
	 * Differs from another field
	 *
	 * @param	string
	 * @param	string	field
	 * @return	bool
	 */
	public function differs($str, $field)
	{
		return ! (isset($this->_field_data[$field]) && $this->_field_data[$field]['postdata'] === $str);
	}

	// --------------------------------------------------------------------

	/**
	 * Is Unique
	 *
	 * Check if the input value doesn't already exist
	 * in the specified database field.
	 *
	 * @param	string	$str
	 * @param	string	$field
<<<<<<< HEAD
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	 * @return	bool
	 */
	public function is_unique($str, $field)
	{
<<<<<<< HEAD
<<<<<<< HEAD
		list($table, $field)=explode('.', $field);
		$query = $this->CI->db->limit(1)->get_where($table, array($field => $str));
		
		return $query->num_rows() === 0;
    }
=======
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
		sscanf($field, '%[^.].%[^.]', $table, $field);
		return isset($this->CI->db)
			? ($this->CI->db->limit(1)->get_where($table, array($field => $str))->num_rows() === 0)
			: FALSE;
	}
<<<<<<< HEAD
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3

	// --------------------------------------------------------------------

	/**
	 * Minimum Length
	 *
<<<<<<< HEAD
<<<<<<< HEAD
	 * @access	public
	 * @param	string
	 * @param	value
=======
	 * @param	string
	 * @param	string
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
	 * @param	string
	 * @param	string
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	 * @return	bool
	 */
	public function min_length($str, $val)
	{
<<<<<<< HEAD
<<<<<<< HEAD
		if (preg_match("/[^0-9]/", $val))
=======
		if ( ! is_numeric($val))
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
		if ( ! is_numeric($val))
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
		{
			return FALSE;
		}

<<<<<<< HEAD
<<<<<<< HEAD
		if (function_exists('mb_strlen'))
		{
			return (mb_strlen($str) < $val) ? FALSE : TRUE;
		}

		return (strlen($str) < $val) ? FALSE : TRUE;
=======
		return ($val <= mb_strlen($str));
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
		return ($val <= mb_strlen($str));
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	}

	// --------------------------------------------------------------------

	/**
	 * Max Length
	 *
<<<<<<< HEAD
<<<<<<< HEAD
	 * @access	public
	 * @param	string
	 * @param	value
=======
	 * @param	string
	 * @param	string
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
	 * @param	string
	 * @param	string
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	 * @return	bool
	 */
	public function max_length($str, $val)
	{
<<<<<<< HEAD
<<<<<<< HEAD
		if (preg_match("/[^0-9]/", $val))
=======
		if ( ! is_numeric($val))
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
		if ( ! is_numeric($val))
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
		{
			return FALSE;
		}

<<<<<<< HEAD
<<<<<<< HEAD
		if (function_exists('mb_strlen'))
		{
			return (mb_strlen($str) > $val) ? FALSE : TRUE;
		}

		return (strlen($str) > $val) ? FALSE : TRUE;
=======
		return ($val >= mb_strlen($str));
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
		return ($val >= mb_strlen($str));
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	}

	// --------------------------------------------------------------------

	/**
	 * Exact Length
	 *
<<<<<<< HEAD
<<<<<<< HEAD
	 * @access	public
	 * @param	string
	 * @param	value
=======
	 * @param	string
	 * @param	string
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
	 * @param	string
	 * @param	string
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	 * @return	bool
	 */
	public function exact_length($str, $val)
	{
<<<<<<< HEAD
<<<<<<< HEAD
		if (preg_match("/[^0-9]/", $val))
		{
			return FALSE;
		}

		if (function_exists('mb_strlen'))
		{
			return (mb_strlen($str) != $val) ? FALSE : TRUE;
		}

		return (strlen($str) != $val) ? FALSE : TRUE;
=======
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
		if ( ! is_numeric($val))
		{
			return FALSE;
		}

		return (mb_strlen($str) === (int) $val);
	}

	// --------------------------------------------------------------------

	/**
	 * Valid URL
	 *
	 * @param	string	$str
	 * @return	bool
	 */
	public function valid_url($str)
	{
		if (empty($str))
		{
			return FALSE;
		}
		elseif (preg_match('/^(?:([^:]*)\:)?\/\/(.+)$/', $str, $matches))
		{
			if (empty($matches[2]))
			{
				return FALSE;
			}
<<<<<<< HEAD
			elseif ( ! in_array($matches[1], array('http', 'https'), TRUE))
=======
			elseif ( ! in_array(strtolower($matches[1]), array('http', 'https'), TRUE))
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
			{
				return FALSE;
			}

			$str = $matches[2];
		}

		// PHP 7 accepts IPv6 addresses within square brackets as hostnames,
		// but it appears that the PR that came in with https://bugs.php.net/bug.php?id=68039
		// was never merged into a PHP 5 branch ... https://3v4l.org/8PsSN
		if (preg_match('/^\[([^\]]+)\]/', $str, $matches) && ! is_php('7') && filter_var($matches[1], FILTER_VALIDATE_IP, FILTER_FLAG_IPV6) !== FALSE)
		{
			$str = 'ipv6.host'.substr($str, strlen($matches[1]) + 2);
		}

<<<<<<< HEAD
		$str = 'http://'.$str;

		// There's a bug affecting PHP 5.2.13, 5.3.2 that considers the
		// underscore to be a valid hostname character instead of a dash.
		// Reference: https://bugs.php.net/bug.php?id=51192
		if (version_compare(PHP_VERSION, '5.2.13', '==') OR version_compare(PHP_VERSION, '5.3.2', '=='))
		{
			sscanf($str, 'http://%[^/]', $host);
			$str = substr_replace($str, strtr($host, array('_' => '-', '-' => '_')), 7, strlen($host));
		}

		return (filter_var($str, FILTER_VALIDATE_URL) !== FALSE);
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
		return (filter_var('http://'.$str, FILTER_VALIDATE_URL) !== FALSE);
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	}

	// --------------------------------------------------------------------

	/**
	 * Valid Email
	 *
<<<<<<< HEAD
<<<<<<< HEAD
	 * @access	public
=======
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	 * @param	string
	 * @return	bool
	 */
	public function valid_email($str)
	{
<<<<<<< HEAD
<<<<<<< HEAD
		return ( ! preg_match("/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix", $str)) ? FALSE : TRUE;
=======
		if (function_exists('idn_to_ascii') && $atpos = strpos($str, '@'))
		{
			$str = substr($str, 0, ++$atpos).idn_to_ascii(substr($str, $atpos));
		}

		return (bool) filter_var($str, FILTER_VALIDATE_EMAIL);
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
		if (function_exists('idn_to_ascii') && sscanf($str, '%[^@]@%s', $name, $domain) === 2)
		{
			$str = $name.'@'.idn_to_ascii($domain);
		}

		return (bool) filter_var($str, FILTER_VALIDATE_EMAIL);
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	}

	// --------------------------------------------------------------------

	/**
	 * Valid Emails
	 *
<<<<<<< HEAD
<<<<<<< HEAD
	 * @access	public
=======
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	 * @param	string
	 * @return	bool
	 */
	public function valid_emails($str)
	{
		if (strpos($str, ',') === FALSE)
		{
			return $this->valid_email(trim($str));
		}

		foreach (explode(',', $str) as $email)
		{
<<<<<<< HEAD
<<<<<<< HEAD
			if (trim($email) != '' && $this->valid_email(trim($email)) === FALSE)
=======
			if (trim($email) !== '' && $this->valid_email(trim($email)) === FALSE)
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
			if (trim($email) !== '' && $this->valid_email(trim($email)) === FALSE)
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
			{
				return FALSE;
			}
		}

		return TRUE;
	}

	// --------------------------------------------------------------------

	/**
	 * Validate IP Address
	 *
<<<<<<< HEAD
<<<<<<< HEAD
	 * @access	public
	 * @param	string
	 * @param	string "ipv4" or "ipv6" to validate a specific ip format
	 * @return	string
=======
	 * @param	string
	 * @param	string	'ipv4' or 'ipv6' to validate a specific IP format
	 * @return	bool
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
	 * @param	string
	 * @param	string	'ipv4' or 'ipv6' to validate a specific IP format
	 * @return	bool
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	 */
	public function valid_ip($ip, $which = '')
	{
		return $this->CI->input->valid_ip($ip, $which);
	}

	// --------------------------------------------------------------------

	/**
	 * Alpha
	 *
<<<<<<< HEAD
<<<<<<< HEAD
	 * @access	public
=======
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	 * @param	string
	 * @return	bool
	 */
	public function alpha($str)
	{
<<<<<<< HEAD
<<<<<<< HEAD
		return ( ! preg_match("/^([a-z])+$/i", $str)) ? FALSE : TRUE;
=======
		return ctype_alpha($str);
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
		return ctype_alpha($str);
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	}

	// --------------------------------------------------------------------

	/**
	 * Alpha-numeric
	 *
<<<<<<< HEAD
<<<<<<< HEAD
	 * @access	public
=======
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	 * @param	string
	 * @return	bool
	 */
	public function alpha_numeric($str)
	{
<<<<<<< HEAD
<<<<<<< HEAD
		return ( ! preg_match("/^([a-z0-9])+$/i", $str)) ? FALSE : TRUE;
=======
		return ctype_alnum((string) $str);
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
		return ctype_alnum((string) $str);
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	}

	// --------------------------------------------------------------------

	/**
<<<<<<< HEAD
<<<<<<< HEAD
	 * Alpha-numeric with underscores and dashes
	 *
	 * @access	public
	 * @param	string
	 * @return	bool
	 */
	public function alpha_dash($str)
	{
		return ( ! preg_match("/^([-a-z0-9_-])+$/i", $str)) ? FALSE : TRUE;
=======
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	 * Alpha-numeric w/ spaces
	 *
	 * @param	string
	 * @return	bool
	 */
	public function alpha_numeric_spaces($str)
	{
		return (bool) preg_match('/^[A-Z0-9 ]+$/i', $str);
<<<<<<< HEAD
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	}

	// --------------------------------------------------------------------

	/**
<<<<<<< HEAD
<<<<<<< HEAD
	 * Numeric
	 *
	 * @access	public
	 * @param	string
	 * @return	bool
	 */
	public function numeric($str)
	{
		return (bool)preg_match( '/^[\-+]?[0-9]*\.?[0-9]+$/', $str);

=======
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	 * Alpha-numeric with underscores and dashes
	 *
	 * @param	string
	 * @return	bool
	 */
	public function alpha_dash($str)
	{
		return (bool) preg_match('/^[a-z0-9_-]+$/i', $str);
<<<<<<< HEAD
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	}

	// --------------------------------------------------------------------

	/**
<<<<<<< HEAD
<<<<<<< HEAD
	 * Is Numeric
	 *
	 * @access	public
	 * @param	string
	 * @return	bool
	 */
	public function is_numeric($str)
	{
		return ( ! is_numeric($str)) ? FALSE : TRUE;
=======
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	 * Numeric
	 *
	 * @param	string
	 * @return	bool
	 */
	public function numeric($str)
	{
		return (bool) preg_match('/^[\-+]?[0-9]*\.?[0-9]+$/', $str);

<<<<<<< HEAD
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	}

	// --------------------------------------------------------------------

	/**
	 * Integer
	 *
<<<<<<< HEAD
<<<<<<< HEAD
	 * @access	public
=======
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	 * @param	string
	 * @return	bool
	 */
	public function integer($str)
	{
		return (bool) preg_match('/^[\-+]?[0-9]+$/', $str);
	}

	// --------------------------------------------------------------------

	/**
	 * Decimal number
	 *
<<<<<<< HEAD
<<<<<<< HEAD
	 * @access	public
=======
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	 * @param	string
	 * @return	bool
	 */
	public function decimal($str)
	{
		return (bool) preg_match('/^[\-+]?[0-9]+\.[0-9]+$/', $str);
	}

	// --------------------------------------------------------------------

	/**
<<<<<<< HEAD
<<<<<<< HEAD
	 * Greather than
	 *
	 * @access	public
	 * @param	string
=======
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	 * Greater than
	 *
	 * @param	string
	 * @param	int
<<<<<<< HEAD
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	 * @return	bool
	 */
	public function greater_than($str, $min)
	{
<<<<<<< HEAD
<<<<<<< HEAD
		if ( ! is_numeric($str))
		{
			return FALSE;
		}
		return $str > $min;
=======
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
		return is_numeric($str) ? ($str > $min) : FALSE;
	}

	// --------------------------------------------------------------------

	/**
	 * Equal to or Greater than
	 *
	 * @param	string
	 * @param	int
	 * @return	bool
	 */
	public function greater_than_equal_to($str, $min)
	{
		return is_numeric($str) ? ($str >= $min) : FALSE;
<<<<<<< HEAD
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	}

	// --------------------------------------------------------------------

	/**
	 * Less than
	 *
<<<<<<< HEAD
<<<<<<< HEAD
	 * @access	public
	 * @param	string
=======
	 * @param	string
	 * @param	int
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
	 * @param	string
	 * @param	int
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	 * @return	bool
	 */
	public function less_than($str, $max)
	{
<<<<<<< HEAD
<<<<<<< HEAD
		if ( ! is_numeric($str))
		{
			return FALSE;
		}
		return $str < $max;
=======
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
		return is_numeric($str) ? ($str < $max) : FALSE;
	}

	// --------------------------------------------------------------------

	/**
	 * Equal to or Less than
	 *
	 * @param	string
	 * @param	int
	 * @return	bool
	 */
	public function less_than_equal_to($str, $max)
	{
		return is_numeric($str) ? ($str <= $max) : FALSE;
	}

	// --------------------------------------------------------------------

	/**
	 * Value should be within an array of values
	 *
	 * @param	string
	 * @param	string
	 * @return	bool
	 */
	public function in_list($value, $list)
	{
		return in_array($value, explode(',', $list), TRUE);
<<<<<<< HEAD
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	}

	// --------------------------------------------------------------------

	/**
	 * Is a Natural number  (0,1,2,3, etc.)
	 *
<<<<<<< HEAD
<<<<<<< HEAD
	 * @access	public
=======
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	 * @param	string
	 * @return	bool
	 */
	public function is_natural($str)
	{
<<<<<<< HEAD
<<<<<<< HEAD
		return (bool) preg_match( '/^[0-9]+$/', $str);
=======
		return ctype_digit((string) $str);
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
		return ctype_digit((string) $str);
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	}

	// --------------------------------------------------------------------

	/**
	 * Is a Natural number, but not a zero  (1,2,3, etc.)
	 *
<<<<<<< HEAD
<<<<<<< HEAD
	 * @access	public
=======
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	 * @param	string
	 * @return	bool
	 */
	public function is_natural_no_zero($str)
	{
<<<<<<< HEAD
<<<<<<< HEAD
		if ( ! preg_match( '/^[0-9]+$/', $str))
		{
			return FALSE;
		}

		if ($str == 0)
		{
			return FALSE;
		}

		return TRUE;
=======
		return ($str != 0 && ctype_digit((string) $str));
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
		return ($str != 0 && ctype_digit((string) $str));
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	}

	// --------------------------------------------------------------------

	/**
	 * Valid Base64
	 *
	 * Tests a string for characters outside of the Base64 alphabet
	 * as defined by RFC 2045 http://www.faqs.org/rfcs/rfc2045
	 *
<<<<<<< HEAD
<<<<<<< HEAD
	 * @access	public
=======
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	 * @param	string
	 * @return	bool
	 */
	public function valid_base64($str)
	{
<<<<<<< HEAD
<<<<<<< HEAD
		return (bool) ! preg_match('/[^a-zA-Z0-9\/\+=]/', $str);
=======
		return (base64_encode(base64_decode($str)) === $str);
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
		return (base64_encode(base64_decode($str)) === $str);
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	}

	// --------------------------------------------------------------------

	/**
	 * Prep data for form
	 *
	 * This function allows HTML to be safely shown in a form.
	 * Special characters are converted.
	 *
<<<<<<< HEAD
<<<<<<< HEAD
	 * @access	public
	 * @param	string
	 * @return	string
	 */
	public function prep_for_form($data = '')
	{
=======
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	 * @deprecated	3.0.6	Not used anywhere within the framework and pretty much useless
	 * @param	mixed	$data	Input data
	 * @return	mixed
	 */
	public function prep_for_form($data)
	{
		if ($this->_safe_form_data === FALSE OR empty($data))
		{
			return $data;
		}

<<<<<<< HEAD
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
		if (is_array($data))
		{
			foreach ($data as $key => $val)
			{
				$data[$key] = $this->prep_for_form($val);
			}

			return $data;
		}

<<<<<<< HEAD
<<<<<<< HEAD
		if ($this->_safe_form_data == FALSE OR $data === '')
		{
			return $data;
		}

		return str_replace(array("'", '"', '<', '>'), array("&#39;", "&quot;", '&lt;', '&gt;'), stripslashes($data));
=======
		return str_replace(array("'", '"', '<', '>'), array('&#39;', '&quot;', '&lt;', '&gt;'), stripslashes($data));
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
		return str_replace(array("'", '"', '<', '>'), array('&#39;', '&quot;', '&lt;', '&gt;'), stripslashes($data));
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	}

	// --------------------------------------------------------------------

	/**
	 * Prep URL
	 *
<<<<<<< HEAD
<<<<<<< HEAD
	 * @access	public
=======
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	 * @param	string
	 * @return	string
	 */
	public function prep_url($str = '')
	{
<<<<<<< HEAD
<<<<<<< HEAD
		if ($str == 'http://' OR $str == '')
=======
		if ($str === 'http://' OR $str === '')
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
		if ($str === 'http://' OR $str === '')
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
		{
			return '';
		}

<<<<<<< HEAD
<<<<<<< HEAD
		if (substr($str, 0, 7) != 'http://' && substr($str, 0, 8) != 'https://')
		{
			$str = 'http://'.$str;
=======
		if (strpos($str, 'http://') !== 0 && strpos($str, 'https://') !== 0)
		{
			return 'http://'.$str;
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
		if (strpos($str, 'http://') !== 0 && strpos($str, 'https://') !== 0)
		{
			return 'http://'.$str;
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
		}

		return $str;
	}

	// --------------------------------------------------------------------

	/**
	 * Strip Image Tags
	 *
<<<<<<< HEAD
<<<<<<< HEAD
	 * @access	public
=======
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	 * @param	string
	 * @return	string
	 */
	public function strip_image_tags($str)
	{
<<<<<<< HEAD
<<<<<<< HEAD
		return $this->CI->input->strip_image_tags($str);
=======
		return $this->CI->security->strip_image_tags($str);
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
		return $this->CI->security->strip_image_tags($str);
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	}

	// --------------------------------------------------------------------

	/**
<<<<<<< HEAD
<<<<<<< HEAD
	 * XSS Clean
	 *
	 * @access	public
	 * @param	string
	 * @return	string
	 */
	public function xss_clean($str)
	{
		return $this->CI->security->xss_clean($str);
=======
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	 * Convert PHP tags to entities
	 *
	 * @param	string
	 * @return	string
	 */
	public function encode_php_tags($str)
	{
		return str_replace(array('<?', '?>'), array('&lt;?', '?&gt;'), $str);
<<<<<<< HEAD
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	}

	// --------------------------------------------------------------------

	/**
<<<<<<< HEAD
<<<<<<< HEAD
	 * Convert PHP tags to entities
	 *
	 * @access	public
	 * @param	string
	 * @return	string
	 */
	public function encode_php_tags($str)
	{
		return str_replace(array('<?php', '<?PHP', '<?', '?>'),  array('&lt;?php', '&lt;?PHP', '&lt;?', '?&gt;'), $str);
	}

}
// END Form Validation Class

/* End of file Form_validation.php */
/* Location: ./system/libraries/Form_validation.php */
=======
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	 * Reset validation vars
	 *
	 * Prevents subsequent validation routines from being affected by the
	 * results of any previous validation routine due to the CI singleton.
	 *
	 * @return	CI_Form_validation
	 */
	public function reset_validation()
	{
		$this->_field_data = array();
		$this->_error_array = array();
		$this->_error_messages = array();
		$this->error_string = '';
		return $this;
	}

}
<<<<<<< HEAD
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
