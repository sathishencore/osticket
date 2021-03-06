<?php if (!isset($_SERVER['HTTP_X_PJAX'])) { ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta http-equiv="cache-control" content="no-cache" />
    <meta http-equiv="pragma" content="no-cache" />
    <meta http-equiv="x-pjax-version" content="<?php echo GIT_VERSION; ?>">
    <title><?php echo ($ost && ($title=$ost->getPageTitle()))?$title:'osTicket :: Staff Control Panel'; ?></title>
    <!--[if IE]>
    <style type="text/css">
        .tip_shadow { display:block !important; }
    </style>
    <![endif]-->
    <script type="text/javascript" src="<?php echo ROOT_PATH; ?>js/jquery-1.8.3.min.js?4827655"></script>
    <script type="text/javascript" src="<?php echo ROOT_PATH; ?>js/jquery-ui-1.10.3.custom.min.js?4827655"></script>
    <script type="text/javascript" src="<?php echo ROOT_PATH; ?>js/jquery.pjax.js?4827655"></script>
    <script type="text/javascript" src="../js/jquery.multifile.js?4827655"></script>
    <script type="text/javascript" src="./js/tips.js?4827655"></script>
    <script type="text/javascript" src="<?php echo ROOT_PATH; ?>js/redactor.min.js?4827655"></script>
    <script type="text/javascript" src="<?php echo ROOT_PATH; ?>js/redactor-osticket.js?4827655"></script>
    <script type="text/javascript" src="<?php echo ROOT_PATH; ?>js/redactor-fonts.js?4827655"></script>
    <script type="text/javascript" src="./js/bootstrap-typeahead.js?4827655"></script>
    <script type="text/javascript" src="./js/scp.js?4827655"></script>
    <link rel="stylesheet" href="<?php echo ROOT_PATH ?>css/thread.css?4827655" media="all">
    <link rel="stylesheet" href="./css/scp.css?4827655" media="all">
    <link rel="stylesheet" href="<?php echo ROOT_PATH; ?>css/redactor.css?4827655" media="screen">
    <link rel="stylesheet" href="./css/typeahead.css?4827655" media="screen">
    <link type="text/css" href="<?php echo ROOT_PATH; ?>css/ui-lightness/jquery-ui-1.10.3.custom.min.css"
         rel="stylesheet" media="screen" />
     <link type="text/css" rel="stylesheet" href="<?php echo ROOT_PATH; ?>css/font-awesome.min.css?4827655">
    <!--[if IE 7]>
    <link rel="stylesheet" href="<?php echo ROOT_PATH; ?>css/font-awesome-ie7.min.css?4827655">
    <![endif]-->
    <link type="text/css" rel="stylesheet" href="./css/dropdown.css?4827655">
    <link type="text/css" rel="stylesheet" href="<?php echo ROOT_PATH; ?>css/loadingbar.css?4827655"/>
    <script type="text/javascript" src="./js/jquery.dropdown.js?4827655"></script>
    <?php
    if($ost && ($headers=$ost->getExtraHeaders())) {
        echo "\n\t".implode("\n\t", $headers)."\n";
    }
    ?>
</head>
<body>
<div id="container">
    <?php
    if($ost->getError())
        echo sprintf('<div id="error_bar">%s</div>', $ost->getError());
    elseif($ost->getWarning())
        echo sprintf('<div id="warning_bar">%s</div>', $ost->getWarning());
    elseif($ost->getNotice())
        echo sprintf('<div id="notice_bar">%s</div>', $ost->getNotice());
    ?>
    <div id="header">
        <a href="index.php" class="no-pjax" id="logo">osTicket - Customer Support System</a>
        <p id="info">Welcome, <strong><?php echo $thisstaff->getFirstName(); ?></strong>
           <?php
            if($thisstaff->isAdmin() && !defined('ADMINPAGE')) { ?>
            | <a href="admin.php" class="no-pjax">Admin Panel</a>
            <?php }else{ ?>
            | <a href="index.php" class="no-pjax">Staff Panel</a>
            <?php } ?>
            | <a href="profile.php">My Preferences</a>
            | <a href="logout.php?auth=<?php echo $ost->getLinkToken(); ?>" class="no-pjax">Log Out</a>
        </p>
    </div>
    <div id="pjax-container" class="<?php if ($_POST) echo 'no-pjax'; ?>">
<?php } else {
    if ($pjax = $ost->getExtraPjax()) { ?>
    <script type="text/javascript">
    <?php foreach (array_filter($pjax) as $s) echo $s.";"; ?>
    </script>
    <?php }
    foreach ($ost->getExtraHeaders() as $h) {
        if (strpos($h, '<script ') !== false)
            echo $h;
    } ?>
    <title><?php echo ($ost && ($title=$ost->getPageTitle()))?$title:'osTicket :: Staff Control Panel'; ?></title><?php
    header('X-PJAX-Version: ' . GIT_VERSION);
} # endif X_PJAX ?>
    <ul id="nav">
<?php include STAFFINC_DIR . "templates/navigation.tmpl.php"; ?>
    </ul>
    <ul id="sub_nav">
<?php include STAFFINC_DIR . "templates/sub-navigation.tmpl.php"; ?>
    </ul>
    <div id="content">
        <?php if($errors['err']) { ?>
            <div id="msg_error"><?php echo $errors['err']; ?></div>
        <?php }elseif($msg) { ?>
            <div id="msg_notice"><?php echo $msg; ?></div>
        <?php }elseif($warn) { ?>
            <div id="msg_warning"><?php echo $warn; ?></div>
        <?php } ?>
