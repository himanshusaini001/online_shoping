<?php
	
session_start();

define('DTS_WS','http://localhost/');
define('DTS_WS_SITE',DTS_WS.'online-shoping/');

define('DTS_FS',$_SERVER['DOCUMENT_ROOT']);
define('DTS_FS_SITE',DTS_FS.'/online-shoping/');



define('DTS_WS_SITE_ASSETS',DTS_WS_SITE.'assets/');
define('DTS_WS_SITE_CSS',DTS_WS_SITE.'css/');
define('DTS_WS_SITE_IMG',DTS_WS_SITE_ASSETS.'img/');

define('DTS_FS_SITE_ASSETS',DTS_FS_SITE.'assets/');
define('DTS_FS_SITE_CSS',DTS_FS_SITE.'css/');


?>