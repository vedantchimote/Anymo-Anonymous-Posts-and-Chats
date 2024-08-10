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

if (!empty($_POST)) {

    $username = isset($_POST['username']) ? $_POST['username'] : '';

    $username = helper::clearText($username);

    $result = array(
        "error" => true
    );

    if (!$helper->isLoginExists($username)) {

        $result = array(
            "error" => false
        );
    }

    echo json_encode($result);
    exit;
}
