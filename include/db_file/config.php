<?php
	
session_start();

define('DTS_WS','http://localhost/');
define('DTS_WS_SITE',DTS_WS.'online-shoping/');

define('DTS_FS',$_SERVER['DOCUMENT_ROOT']);
define('DTS_FS_SITE',DTS_FS.'online-shoping/');



// Admin Assets

//Upload Path
define('DTS_WS_SITE_ADMIN', DTS_WS_SITE . 'admin/');
define('DTS_WS_SITE_ADMIN_ASSETS',DTS_WS_SITE_ADMIN.'assets/');
define('DTS_WS_SITE_ADMIN_UPLOAD_IMG',DTS_WS_SITE_ADMIN_ASSETS.'upload_img/');




// Customer PATH

define('DTS_WS_SITE_ASSETS',DTS_WS_SITE.'assets/');

//Images Path
define('DTS_WS_SITE_IMG',DTS_WS_SITE_ASSETS.'img/');
define('DTS_WS_SITE_IMG_TSHIRT_FOLDER',DTS_WS_SITE_IMG.'tshirt/');
define('DTS_WS_SITE_IMG_JEENS_FOLDER',DTS_WS_SITE_IMG.'jeens/');

//Css Path
define('DTS_WS_SITE_CSS',DTS_WS_SITE.'css/');

define('DTS_FS_SITE_ASSETS',DTS_FS_SITE.'assets/');
define('DTS_FS_SITE_CSS',DTS_FS_SITE.'css/');


// FS Path All 

// Admin upload Path

define('DTS_FS_SITE_ADMIN', DTS_FS_SITE . 'admin/');
define('DTS_FS_SITE_ADMIN_ASSETS', DTS_FS_SITE_ADMIN . 'assets/');
define('DTS_FS_SITE_ADMIN_UPLOAD', DTS_FS_SITE_ADMIN_ASSETS . 'upload_img/');


?>