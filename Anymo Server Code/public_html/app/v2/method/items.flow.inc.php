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

    $clientId = isset($_POST['client_id']) ? $_POST['client_id'] : 0;

    $accountId = isset($_POST['account_id']) ? $_POST['account_id'] : 0;
    $accessToken = isset($_POST['access_token']) ? $_POST['access_token'] : '';

    $itemId = isset($_POST['item_id']) ? $_POST['item_id'] : 0;

    $image = isset($_POST['image']) ? $_POST['image'] : 0;
    $reports = isset($_POST['reports']) ? $_POST['reports'] : 0;
    $distance = isset($_POST['distance']) ? $_POST['distance'] : 3000;

    $lat = isset($_POST['lat']) ? $_POST['lat'] : '0.000000';
    $lng = isset($_POST['lng']) ? $_POST['lng'] : '0.000000';

    $clientId = helper::clearInt($clientId);
    $accountId = helper::clearInt($accountId);

    $itemId = helper::clearInt($itemId);

    $image = helper::clearInt($image);
    $reports = helper::clearInt($reports);
    $distance = helper::clearInt($distance);

    $result = array(
        "error" => true,
        "error_code" => ERROR_UNKNOWN
    );

    $items = new items($dbo);
    $items->setRequestFrom($accountId);

    $result = $items->flow("", $itemId, $image, $reports, $distance, $lat, $lng);

    echo json_encode($result);
    exit;
}
