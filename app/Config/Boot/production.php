<?php

/*
  |--------------------------------------------------------------------------
  | ERROR DISPLAY
  |--------------------------------------------------------------------------
  | Don't show ANY in production environments. Instead, let the system catch
  | it and display a generic error message.
 */
ini_set('display_errors', '0');
error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED & ~E_STRICT & ~E_USER_NOTICE & ~E_USER_DEPRECATED);

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
defined('CI_DEBUG') || define('CI_DEBUG', false);
=======
defined('CI_DEBUG') || define('CI_DEBUG', 0);
>>>>>>> a3f02c4b0f4736440cdd0afc6ed9b10879e6dbef
=======
defined('CI_DEBUG') || define('CI_DEBUG', false);
>>>>>>> 545025698c6c7be18bd842f8bcc798818ed0db11
