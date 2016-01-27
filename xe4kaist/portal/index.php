<?php
define('__XE__', true);
require_once("config/config.inc.php");

$oContext = &Context::getInstance();
$oContext->init();

require_once("ksso.php");
require_once("sign.php");

ksso();
?>
