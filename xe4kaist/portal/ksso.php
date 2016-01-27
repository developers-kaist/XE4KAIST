<?php
function ksso()
{
    $soapUser = '';
    $soapPassword = '';
    
    $publicKeyStr = '';

    $cookieValue = $_COOKIE['SATHTOKEN'];
    
    $soap = new SoapClient('https://iam.kaist.ac.kr/iamps/services/singlauth?wsdl');
    $result = $soap->verification(array('cookieValue' => $cookieValue, 'publicKeyStr' => $publicKeyStr, 'adminVO' => array('adminId' => $soapUser, 'password' => $soapPassword)));
    
    setcookie("SATHTOKEN", "", time() - 3600, '/');

    return sign($result->return); 
}
?>
