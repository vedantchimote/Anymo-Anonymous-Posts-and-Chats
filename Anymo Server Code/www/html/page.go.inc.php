<?php

    /*!
     * https://raccoonsquare.com
     * raccoonsquare@gmail.com
     *
     * Copyright 2012-2021 Demyanchuk Dmitry (raccoonsquare@gmail.com)
     */

    if (!defined("APP_SIGNATURE")) {

        header("Location: /");
        exit;
    }

    $error = false;
    $error_msg = "";

    if (isset($_GET['to'])) {

        $url = (isset($_GET['to'])) ? $_GET['to'] : '';

        $url = helper::clearText($url);
        $url = helper::escapeText($url);

        if (!filter_var($url, FILTER_VALIDATE_URL)) {

            header("Location: /");
            exit;

        } else {

            // add url to db if need

            header("Location: ".$url);
            exit;
        }

    } else {

        header("Location: /");
        exit;
    }
