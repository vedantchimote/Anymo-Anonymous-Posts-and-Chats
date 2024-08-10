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

    $number = isset($_POST['number']) ? $_POST['number'] : '';

    $number = helper::clearText($number);

    $result = array(
        "error" => true,
        "error_code" => ERROR_UNKNOWN
    );

    if (!$helper->isPhoneNumberExists($number)) {

        $result = array(
            "error" => false,
            "error_code" => ERROR_SUCCESS
        );
    }

    echo json_encode($result);
    exit;
}
