<?php

/*
  |--------------------------------------------------------------------------
  | ERROR DISPLAY
  |--------------------------------------------------------------------------
  | In development, we want to show as many errors as possible to help
  | make sure they don't make it to production. And save us hours of
  | painful debugging.
 */
error_reporting(-1);
ini_set('display_errors', '1');

/*
  |--------------------------------------------------------------------------
  | DEBUG BACKTRACES
  |--------------------------------------------------------------------------
  | If true, this constant will tell the error screens to display debug
  | backtraces along with the other error information. If you would
  | prefer to not see this, set this value to false.
 */
defined('SHOW_DEBUG_BACKTRACE') || define('SHOW_DEBUG_BACKTRACE', true);

/*
  |--------------------------------------------------------------------------
  | DEBUG MODE
  |--------------------------------------------------------------------------
  | Debug mode is an experimental flag that can allow changes throughout
  | the system. It's not widely used currently, and may not survive
  | release of the framework.
 */

<<<<<<< HEAD
<<<<<<< HEAD
defined('CI_DEBUG') || define('CI_DEBUG', true);
=======
defined('CI_DEBUG') || define('CI_DEBUG', 1);
>>>>>>> a3f02c4b0f4736440cdd0afc6ed9b10879e6dbef
=======
defined('CI_DEBUG') || define('CI_DEBUG', true);
>>>>>>> 545025698c6c7be18bd842f8bcc798818ed0db11
