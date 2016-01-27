<?php 
define('__XE__', true);
require_once("config/config.inc.php"); 

$oContext = &Context::getInstance();
$oContext->init();

if(Context::get('logged_info'))
{
	header("Location: /");
}
else 
{
	if(array_key_exists('SATHTOKEN', $_COOKIE))
	{
		if($_COOKIE['SATHTOKEN'])
		{
			setcookie("SATHTOKEN", "", time() - 3600, '/');	
		}
	} 
	echo('<script>location.href = "https://ksso.kaist.ac.kr/iamps/requestLogin.do";</script>');	
}
?>
