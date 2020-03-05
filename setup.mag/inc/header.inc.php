<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
    "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
    <title><?php echo $wizard['title']; ?></title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="stylesheet" href="css/wizard.css?4827655">
    <script type="text/javascript" src="../js/jquery-1.8.3.min.js?4827655"></script>
    <script type="text/javascript" src="js/tips.js?4827655"></script>
    <script type="text/javascript" src="js/setup.js?4827655"></script>
</head>
<body>
    <div id="wizard">
        <div id="header">
            <img id="logo" src="./images/<?php echo $wizard['logo']?$wizard['logo']:'logo.png'; ?>" width="280" height="72" alt="osTicket">
            <ul>
                <li class="info"><?php echo $wizard['tagline']; ?></li>
                <li>
                   <?php
                   foreach($wizard['menu'] as $k=>$v)
                    echo sprintf('<a target="_blank" href="%s">%s</a> &mdash; ',$v,$k);
                   ?>
                    <a target="_blank" href="http://osticket.com/contact-us">Contact Us</a>
                </li>
            </ul>
        </div>
        <div id="content">
