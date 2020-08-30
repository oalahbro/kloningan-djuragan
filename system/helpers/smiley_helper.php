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
 * CodeIgniter Smiley Helpers
 *
 * @package		CodeIgniter
 * @subpackage	Helpers
 * @category	Helpers
 * @author		EllisLab Dev Team
<<<<<<< HEAD
<<<<<<< HEAD
 * @link		http://codeigniter.com/user_guide/helpers/smiley_helper.html
=======
 * @link		https://codeigniter.com/user_guide/helpers/smiley_helper.html
 * @deprecated	3.0.0	This helper is too specific for CI.
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
 * @link		https://codeigniter.com/user_guide/helpers/smiley_helper.html
 * @deprecated	3.0.0	This helper is too specific for CI.
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
 */

// ------------------------------------------------------------------------

<<<<<<< HEAD
<<<<<<< HEAD
/**
 * Smiley Javascript
 *
 * Returns the javascript required for the smiley insertion.  Optionally takes
 * an array of aliases to loosely couple the smiley array to the view.
 *
 * @access	public
 * @param	mixed	alias name or array of alias->field_id pairs
 * @param	string	field_id if alias name was passed in
 * @return	array
 */
if ( ! function_exists('smiley_js'))
{
	function smiley_js($alias = '', $field_id = '', $inline = TRUE)
	{
		static $do_setup = TRUE;

		$r = '';

		if ($alias != '' && ! is_array($alias))
=======
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
if ( ! function_exists('smiley_js'))
{
	/**
	 * Smiley Javascript
	 *
	 * Returns the javascript required for the smiley insertion.  Optionally takes
	 * an array of aliases to loosely couple the smiley array to the view.
	 *
	 * @param	mixed	alias name or array of alias->field_id pairs
	 * @param	string	field_id if alias name was passed in
	 * @param	bool
	 * @return	array
	 */
	function smiley_js($alias = '', $field_id = '', $inline = TRUE)
	{
		static $do_setup = TRUE;
		$r = '';

		if ($alias !== '' && ! is_array($alias))
<<<<<<< HEAD
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
		{
			$alias = array($alias => $field_id);
		}

		if ($do_setup === TRUE)
		{
<<<<<<< HEAD
<<<<<<< HEAD
				$do_setup = FALSE;

				$m = array();

				if (is_array($alias))
				{
					foreach ($alias as $name => $id)
					{
						$m[] = '"'.$name.'" : "'.$id.'"';
					}
				}

				$m = '{'.implode(',', $m).'}';

				$r .= <<<EOF
				var smiley_map = {$m};

				function insert_smiley(smiley, field_id) {
					var el = document.getElementById(field_id), newStart;

					if ( ! el && smiley_map[field_id]) {
						el = document.getElementById(smiley_map[field_id]);

						if ( ! el)
							return false;
					}

					el.focus();
					smiley = " " + smiley;

					if ('selectionStart' in el) {
						newStart = el.selectionStart + smiley.length;

						el.value = el.value.substr(0, el.selectionStart) +
										smiley +
										el.value.substr(el.selectionEnd, el.value.length);
						el.setSelectionRange(newStart, newStart);
					}
					else if (document.selection) {
						document.selection.createRange().text = smiley;
					}
				}
EOF;
		}
		else
		{
			if (is_array($alias))
			{
				foreach ($alias as $name => $id)
				{
					$r .= 'smiley_map["'.$name.'"] = "'.$id.'";'."\n";
				}
			}
		}

		if ($inline)
		{
			return '<script type="text/javascript" charset="utf-8">/*<![CDATA[ */'.$r.'// ]]></script>';
		}
		else
		{
			return $r;
		}
=======
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
			$do_setup = FALSE;
			$m = array();

			if (is_array($alias))
			{
				foreach ($alias as $name => $id)
				{
					$m[] = '"'.$name.'" : "'.$id.'"';
				}
			}

			$m = '{'.implode(',', $m).'}';

			$r .= <<<EOF
			var smiley_map = {$m};

			function insert_smiley(smiley, field_id) {
				var el = document.getElementById(field_id), newStart;

				if ( ! el && smiley_map[field_id]) {
					el = document.getElementById(smiley_map[field_id]);

					if ( ! el)
						return false;
				}

				el.focus();
				smiley = " " + smiley;

				if ('selectionStart' in el) {
					newStart = el.selectionStart + smiley.length;

					el.value = el.value.substr(0, el.selectionStart) +
									smiley +
									el.value.substr(el.selectionEnd, el.value.length);
					el.setSelectionRange(newStart, newStart);
				}
				else if (document.selection) {
					document.selection.createRange().text = smiley;
				}
			}
EOF;
		}
		elseif (is_array($alias))
		{
			foreach ($alias as $name => $id)
			{
				$r .= 'smiley_map["'.$name.'"] = "'.$id."\";\n";
			}
		}

		return ($inline)
			? '<script type="text/javascript" charset="utf-8">/*<![CDATA[ */'.$r.'// ]]></script>'
			: $r;
<<<<<<< HEAD
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	}
}

// ------------------------------------------------------------------------

<<<<<<< HEAD
<<<<<<< HEAD
/**
 * Get Clickable Smileys
 *
 * Returns an array of image tag links that can be clicked to be inserted
 * into a form field.
 *
 * @access	public
 * @param	string	the URL to the folder containing the smiley images
 * @return	array
 */
if ( ! function_exists('get_clickable_smileys'))
{
	function get_clickable_smileys($image_url, $alias = '', $smileys = NULL)
	{
		// For backward compatibility with js_insert_smiley

=======
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
if ( ! function_exists('get_clickable_smileys'))
{
	/**
	 * Get Clickable Smileys
	 *
	 * Returns an array of image tag links that can be clicked to be inserted
	 * into a form field.
	 *
	 * @param	string	the URL to the folder containing the smiley images
	 * @param	array
	 * @return	array
	 */
	function get_clickable_smileys($image_url, $alias = '')
	{
		// For backward compatibility with js_insert_smiley
<<<<<<< HEAD
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
		if (is_array($alias))
		{
			$smileys = $alias;
		}
<<<<<<< HEAD
<<<<<<< HEAD

		if ( ! is_array($smileys))
		{
			if (FALSE === ($smileys = _get_smiley_array()))
			{
				return $smileys;
			}
=======
		elseif (FALSE === ($smileys = _get_smiley_array()))
		{
			return FALSE;
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
		elseif (FALSE === ($smileys = _get_smiley_array()))
		{
			return FALSE;
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
		}

		// Add a trailing slash to the file path if needed
		$image_url = rtrim($image_url, '/').'/';

		$used = array();
		foreach ($smileys as $key => $val)
		{
			// Keep duplicates from being used, which can happen if the
<<<<<<< HEAD
<<<<<<< HEAD
			// mapping array contains multiple identical replacements.  For example:
=======
			// mapping array contains multiple identical replacements. For example:
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
			// mapping array contains multiple identical replacements. For example:
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
			// :-) and :) might be replaced with the same image so both smileys
			// will be in the array.
			if (isset($used[$smileys[$key][0]]))
			{
				continue;
			}

<<<<<<< HEAD
<<<<<<< HEAD
			$link[] = "<a href=\"javascript:void(0);\" onclick=\"insert_smiley('".$key."', '".$alias."')\"><img src=\"".$image_url.$smileys[$key][0]."\" width=\"".$smileys[$key][1]."\" height=\"".$smileys[$key][2]."\" alt=\"".$smileys[$key][3]."\" style=\"border:0;\" /></a>";

=======
			$link[] = '<a href="javascript:void(0);" onclick="insert_smiley(\''.$key.'\', \''.$alias.'\')"><img src="'.$image_url.$smileys[$key][0].'" alt="'.$smileys[$key][3].'" style="width: '.$smileys[$key][1].'; height: '.$smileys[$key][2].'; border: 0;" /></a>';
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
			$link[] = '<a href="javascript:void(0);" onclick="insert_smiley(\''.$key.'\', \''.$alias.'\')"><img src="'.$image_url.$smileys[$key][0].'" alt="'.$smileys[$key][3].'" style="width: '.$smileys[$key][1].'; height: '.$smileys[$key][2].'; border: 0;" /></a>';
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
			$used[$smileys[$key][0]] = TRUE;
		}

		return $link;
	}
}

// ------------------------------------------------------------------------

<<<<<<< HEAD
<<<<<<< HEAD
/**
 * Parse Smileys
 *
 * Takes a string as input and swaps any contained smileys for the actual image
 *
 * @access	public
 * @param	string	the text to be parsed
 * @param	string	the URL to the folder containing the smiley images
 * @return	string
 */
if ( ! function_exists('parse_smileys'))
{
	function parse_smileys($str = '', $image_url = '', $smileys = NULL)
	{
		if ($image_url == '')
=======
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
if ( ! function_exists('parse_smileys'))
{
	/**
	 * Parse Smileys
	 *
	 * Takes a string as input and swaps any contained smileys for the actual image
	 *
	 * @param	string	the text to be parsed
	 * @param	string	the URL to the folder containing the smiley images
	 * @param	array
	 * @return	string
	 */
	function parse_smileys($str = '', $image_url = '', $smileys = NULL)
	{
		if ($image_url === '' OR ( ! is_array($smileys) && FALSE === ($smileys = _get_smiley_array())))
<<<<<<< HEAD
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
		{
			return $str;
		}

<<<<<<< HEAD
<<<<<<< HEAD
		if ( ! is_array($smileys))
		{
			if (FALSE === ($smileys = _get_smiley_array()))
			{
				return $str;
			}
		}

		// Add a trailing slash to the file path if needed
		$image_url = preg_replace("/(.+?)\/*$/", "\\1/",  $image_url);

		foreach ($smileys as $key => $val)
		{
			$str = str_replace($key, "<img src=\"".$image_url.$smileys[$key][0]."\" width=\"".$smileys[$key][1]."\" height=\"".$smileys[$key][2]."\" alt=\"".$smileys[$key][3]."\" style=\"border:0;\" />", $str);
=======
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
		// Add a trailing slash to the file path if needed
		$image_url = rtrim($image_url, '/').'/';

		foreach ($smileys as $key => $val)
		{
			$str = str_replace($key, '<img src="'.$image_url.$smileys[$key][0].'" alt="'.$smileys[$key][3].'" style="width: '.$smileys[$key][1].'; height: '.$smileys[$key][2].'; border: 0;" />', $str);
<<<<<<< HEAD
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
		}

		return $str;
	}
}

// ------------------------------------------------------------------------

<<<<<<< HEAD
<<<<<<< HEAD
/**
 * Get Smiley Array
 *
 * Fetches the config/smiley.php file
 *
 * @access	private
 * @return	mixed
 */
if ( ! function_exists('_get_smiley_array'))
{
	function _get_smiley_array()
	{
		if (defined('ENVIRONMENT') AND file_exists(APPPATH.'config/'.ENVIRONMENT.'/smileys.php'))
		{
		    include(APPPATH.'config/'.ENVIRONMENT.'/smileys.php');
		}
		elseif (file_exists(APPPATH.'config/smileys.php'))
		{
			include(APPPATH.'config/smileys.php');
		}
		
		if (isset($smileys) AND is_array($smileys))
		{
			return $smileys;
		}

		return FALSE;
	}
}

// ------------------------------------------------------------------------

/**
 * JS Insert Smiley
 *
 * Generates the javascript function needed to insert smileys into a form field
 *
 * DEPRECATED as of version 1.7.2, use smiley_js instead
 *
 * @access	public
 * @param	string	form name
 * @param	string	field name
 * @return	string
 */
if ( ! function_exists('js_insert_smiley'))
{
	function js_insert_smiley($form_name = '', $form_field = '')
	{
		return <<<EOF
<script type="text/javascript">
	function insert_smiley(smiley)
	{
		document.{$form_name}.{$form_field}.value += " " + smiley;
	}
</script>
EOF;
	}
}


/* End of file smiley_helper.php */
/* Location: ./system/helpers/smiley_helper.php */
=======
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
if ( ! function_exists('_get_smiley_array'))
{
	/**
	 * Get Smiley Array
	 *
	 * Fetches the config/smiley.php file
	 *
	 * @return	mixed
	 */
	function _get_smiley_array()
	{
		static $_smileys;

		if ( ! is_array($_smileys))
		{
			if (file_exists(APPPATH.'config/smileys.php'))
			{
				include(APPPATH.'config/smileys.php');
			}

			if (file_exists(APPPATH.'config/'.ENVIRONMENT.'/smileys.php'))
			{
				include(APPPATH.'config/'.ENVIRONMENT.'/smileys.php');
			}

			if (empty($smileys) OR ! is_array($smileys))
			{
				$_smileys = array();
				return FALSE;
			}

			$_smileys = $smileys;
		}

		return $_smileys;
	}
}
<<<<<<< HEAD
>>>>>>> 1e7ce1cbbbe40fba202b66d016202e02057623bd
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
