<!DOCTYPE html>
<html lang="<?php echo $LANG['lang-code']; ?>">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title><?php echo $page_title; ?></title>
    <meta name="google-site-verification" content="" />
    <meta name='yandex-verification' content='' />
    <meta name="msvalidate.01" content="" />
    <meta property="og:site_name" content="<?php echo APP_TITLE; ?>">
    <meta property="og:title" content="<?php echo $page_title; ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Open+Sans" />

    <meta charset="utf-8">
    <meta name="description" content="">
    <link href="/img/favicon.png" rel="shortcut icon" type="image/x-icon">
    <?php
        foreach($css_files as $css): ?>
        <link rel="stylesheet" href="/css/<?php echo $css."?x=5"; ?>" type="text/css" media="screen">
    <?php
        endforeach;
    ?>

    <link rel="stylesheet" href="/css/icofont.css" type="text/css" media="screen">
    <link rel="stylesheet" href="/css/fontawesome.css" type="text/css" media="screen">
    <link rel="stylesheet" href="/css/bootstrap-grid.css" type="text/css" media="screen">
    <link rel="stylesheet" href="/css/bootstrap.css" type="text/css" media="screen">
    <link rel="stylesheet" href="/css/bootstrap-slider.css" type="text/css" media="screen">
    <link rel="stylesheet" href="/css/main.css?x3" type="text/css" media="screen">
    <link rel="stylesheet" href="/css/new.css?x3" type="text/css" media="screen">
    <link rel="stylesheet" href="/css/my.css?x3" type="text/css" media="screen">

        <?php

            if (isset($page_id) && $page_id === "signup" || isset($page_id) && $page_id === "main" || isset($page_id) && $page_id === "support" || isset($page_id) && $page_id === "restore") {

                ?>
                    <script src="https://www.google.com/recaptcha/api.js?render=<?php echo RECAPTCHA_SITE_KEY; ?>"></script>
                    <script src="https://apis.google.com/js/platform.js" async defer></script>
                <?php
            }
        ?>
</head>