<?php

defined('DS') ? null : define('DS', DIRECTORY_SEPARATOR);

defined('SITE_ROOT') ? null : define('SITE_ROOT', DS.'home'.DS.'chris'.DS.'workspace'.DS.'host'.DS.'snbdb'.DS.'smartnews');
defined('LIB_PATH') ? null :define('LIB_PATH', SITE_ROOT.DS.'lib'.DS.'db');



require_once(LIB_PATH.DS.'config.php');
require_once(LIB_PATH.DS.'database.php');

?>
