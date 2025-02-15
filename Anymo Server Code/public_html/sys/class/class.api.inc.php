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

class api extends db_connect
{
    public function __construct($dbo = NULL)
    {
        parent::__construct($dbo);
    }

    static function printError($error_code, $error_description = "unknown")
    {
        $result = array(
            "error" => true,
            "error_code" => $error_code,
            "error_description" => $error_description
        );

        echo json_encode($result);
        exit;
    }
}
