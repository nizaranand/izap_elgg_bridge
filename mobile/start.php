<?php
/**
 * Elgg Mobile
 * A Mobile Client For Elgg
 *
 * @package Elgg
 * @subpackage Core
 * @author kramnorth (Mark Harding)
 * @link http://kramnorth.com
 *
 */

	function mobile_init(){
		
		//elgg_extend_view('page/elements/head','mobile/metatags');
		
		mobile_detect();
						
		elgg_extend_view('css/elgg','mobile/css');
		
		//set our default index page
		
		if(elgg_get_viewtype() == "mobile"){
		elgg_register_plugin_hook_handler('index', 'system','main_handler');
		}
		

    }
	
function main_handler($hook, $type, $return, $params) {
	if ($return == true) {
		// another hook has already replaced the front page
		return $return;
	}
	
	if(!include_once(dirname(__FILE__) . '/pages/main.php')){
		return false;
	}
	
	return true;
}
	
if($_SESSION['isMobile']){
	elgg_set_viewtype('mobile');
}

function mobile_detect(){
	$useragent= strtolower ( $_SERVER['HTTP_USER_AGENT'] );	
	//detect if there is a mobile device
	if(preg_match('/phone|iphone|itouch|ipod|symbian|android|htc_|htc-|palmos|blackberry|opera mini|iemobile|windows ce|nokia|fennec|hiptop|kindle|mot |mot-|webos\/|samsung|sonyericsson|^sie-|nintendo/',$useragent)||preg_match('/mobile|pda;|avantgo|eudoraweb|minimo|netfront|brew|teleca|lg;|lge |wap;| wap /',$useragent && !strstr($useragent,'ipad'))){
		$mobile =  true;
	} else {
		$mobile = false;
	}

	//if there is a mobile device
	if($mobile == true){
		
		if($_SESSION['view_desktop']){
			elgg_extend_view('page/elements/head','mobile/desktop');
		} else {
			elgg_set_viewtype('mobile');
		}
	}
}


elgg_register_viewtype_fallback('mobile');
elgg_register_event_handler('init','system','mobile_init');
elgg_register_action("mobile/login",$CONFIG->pluginspath . "mobile/actions/login.php",'public');
		

?>
