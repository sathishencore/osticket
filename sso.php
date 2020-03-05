<?php
/*********************************************************************
sso.php

User login via app.encoress.com

************************************************************************/
ini_set('display_errors',1);
require_once('client.inc.php');
if(!defined('INCLUDE_DIR')) die('Fatal Error');
define('CLIENTINC_DIR',INCLUDE_DIR.'client/');
define('OSTCLIENTINC',TRUE); //make includes happy
session_start();


require_once(INCLUDE_DIR.'class.client.php');
require_once(INCLUDE_DIR.'class.ticket.php');

define('AUTH_KEY','encwfefrgtegedfsegretreertretret');
define('AUDIENCE','015f481acfe402c9bae435389efbb6914929bf8c');
define('ISSUER','onelogin.encoress.com');


$thisdir=str_replace('\\', '/', dirname(__FILE__)).'/';



require_once $thisdir."vendor/autoload.php";

if(isset($_COOKIE['idToken'])){

    $token = $_COOKIE['idToken'];

    if(empty($token))
        return redirect('https://app.encoress.com/login');
    $validateToken = (new \Lcobucci\JWT\Parser())->parse((string)$token); // Parses from a string
    $userName = $validateToken->getClaim('sub'); // Retrieves the token claims


    $validationData = new \Lcobucci\JWT\ValidationData();
    $validationData->setIssuer(ISSUER);
    //$validationData->setAudience(env('AUDIENCE'));
    $validationData->setId(AUTH_KEY);
    $validationData->setCurrentTime(time());

    if($validateToken->validate($validationData)){

        $email = $userName . "@encoress.com";
        $query = "select user_id from ".USER_EMAIL_TABLE." where address=".db_input($email);
        $res = db_query($query);

        while($rows = db_fetch_row($res)){
            $userId = ($rows[0]);
        }
        if(!isset($userId))
            Http::redirect('login.php');

        if (!($user = User::lookup($userId)))
            Http::redirect('login.php');
        elseif (!$user->getAccount())
            Http::redirect('login.php');


	$_SESSION['_auth']['user']['id'] = $user->getId();
	$_SESSION['_auth']['user']['key'] = 'ldap.client:'.$user->getId();

        $session = new ClientSession(new EndUser($user));
        $session->setAuthKey($user->getId());
        $session->refreshSession(true);
       
        Http::redirect('tickets.php');
    }else{
        Http::redirect('login.php');
    }
}
?>
