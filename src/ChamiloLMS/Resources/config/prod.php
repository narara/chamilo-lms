<?php

$app['debug'] = false;

$app['app.title'] = '';
$app['jquery_ui_theme'] = 'smoothness';

// Cache
$app['cache.path'] = api_get_path(SYS_ARCHIVE_PATH);

$app['cache.paths'] = new stdClass();

//Monolog
$app['cache.paths']->folders[] = $app['log.path'] = api_get_path(SYS_PATH_APP).'logs';

//Twig cache
$app['cache.paths']->folders[] = $app['twig.cache.path'] = $app['cache.path'].'twig';

// Http cache
$app['cache.paths']->folders[] = $app['http_cache.cache_dir'] = $app['cache.path'].'http';

// Doctrine ORM
$app['cache.paths']->folders[] = $app['db.orm.proxies_dir'] = $app['cache.path'].'proxies_dir';

//Profiler
$app['cache.paths']->folders[] = $app['profiler.cache_dir'] = $app['cache.path'].'profiler';

//HTMLPurifier
$app['cache.paths']->folders[] = $app['htmlpurifier.serializer'] = $app['cache.path'].'serializer';

//PCLZIP temp dir
define('PCLZIP_TEMPORARY_DIR', $app['cache.path'].'pclzip');
$app['cache.paths']->folders[] = PCLZIP_TEMPORARY_DIR;

//MPDF libs
define("_MPDF_TEMP_PATH", $app['cache.path'].'/mpdf');
define("_JPGRAPH_PATH", $app['cache.path'].'/mpdf');
define("_MPDF_TTFONTDATAPATH", $app['cache.path'].'/mpdf');

$app['cache.paths']->folders[] = _MPDF_TEMP_PATH;

//QR code
define('QR_CACHE_DIR', $app['cache.path'].'qr');
define('QR_LOG_DIR', $app['cache.path'].'qr');
$app['cache.paths']->folders[] = QR_CACHE_DIR;

//Chamilo temp class
$app['cache.paths']->folders[] = $app['cache.path'].'temp';

// Assetic
/*
$app['assetic.path_to_cache']   = $app['cache.path'] . DIRECTORY_SEPARATOR . 'assetic' ;
$app['assetic.path_to_web']     = api_get_path(SYS_PATH) . 'web'; //Location where to dump all generated files
$app['assetic.input.path_to_assets'] = $app['assetic.path_to_web'].$app['app.theme'];

$css_path = api_get_path(SYS_PATH) . 'web/css/';

$app['assetic.input.path_to_css'] = array(
    $css_path.'bootstrap.css',
    $css_path.'base.css',
    $css_path.'base_chamilo.css',
    $css_path.$app['app.theme'].'/default.css',
    $css_path.'bootstrap-responsive.css',
    $css_path.'responsive.css',
//  api_get_path(LIBRARY_PATH).'javascript/thickbox.css',
//  api_get_path(LIBRARY_PATH).'javascript/chosen/chosen.css',
    $css_path.$app['app.theme'].'/learnpath.css',
    $css_path.$app['app.theme'].'/scorm.css',
    api_get_path(LIBRARY_PATH).'javascript/chat/css/chat.css',
    api_get_path(LIBRARY_PATH).'javascript/jquery-ui/'.$app['jquery_ui_theme'].'/jquery-ui-custom.css',
    api_get_path(LIBRARY_PATH).'javascript/jquery-ui/default.css',
    //api_get_path(LIBRARY_PATH).'javascript/bxslider/bx_styles/bx_styles.css',
);

$app['assetic.output.path_to_css'] = 'css/'.$app['app.theme'].'/style.css';

$app['assetic.input.path_to_js'] = array(
    api_get_path(LIBRARY_PATH).'javascript/modernizr.js',
    api_get_path(LIBRARY_PATH).'javascript/jquery.min.js',
    //api_get_path(LIBRARY_PATH).'javascript/chosen/chosen.jquery.min.js',
    api_get_path(LIBRARY_PATH).'javascript/jquery-ui/'.$app['jquery_ui_theme'].'/jquery-ui-custom.min.js',
    //api_get_path(LIBRARY_PATH).'javascript/thickbox.js',
    api_get_path(LIBRARY_PATH).'javascript/bootstrap/bootstrap.js',
    //api_get_path(LIBRARY_PATH).'javascript/bxslider/jquery.bxSlider.min.js',
);

$app['assetic.output.path_to_js'] = 'js/script.js';
$app['assetic.filter.yui_compressor.path'] = '/usr/share/yui-compressor/yui-compressor.jar';


//Create directories?
if (!is_dir($app['assetic.path_to_web'])) {
    //mkdir($app['assetic.path_to_web'], api_get_permissions_for_new_directories());
}

if (!is_dir($app['assetic.path_to_web'].'/css')) {
    //mkdir($app['assetic.path_to_web'].'/css', api_get_permissions_for_new_directories());
}

if (!is_dir($app['assetic.path_to_web'].'/js')) {
    //mkdir($app['assetic.path_to_web'].'/js', api_get_permissions_for_new_directories());
}
 *
 */

foreach($app['cache.paths']->folders as $folder) {
    if (!is_dir($folder)) {
        @mkdir($folder, api_get_permissions_for_new_directories());
    }
}

//Monolog log file
$app['chamilo.log'] = $app['log.path'].'/chamilo.log';

if (is_file($app['chamilo.log']) && !is_writable($app['chamilo.log'])) {
    unlink($app['chamilo.log']);
}