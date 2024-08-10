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

    $clientId = isset($_POST['clien_id']) ? $_POST['clien_id'] : 0;

    $accountId = isset($_POST['account_id']) ? $_POST['account_id'] : 0;
    $accessToken = isset($_POST['access_token']) ? $_POST['access_token'] : '';

    $itemId = isset($_POST['item_id']) ? $_POST['item_id'] : 0;
    $itemType = isset($_POST['item_type']) ? $_POST['item_type'] : 0;
    $abuseId = isset($_POST['abuse_id']) ? $_POST['abuse_id'] : 0;

    $clientId = helper::clearInt($clientId);
    $accountId = helper::clearInt($accountId);

    $itemId = helper::clearInt($itemId);
    $itemType = helper::clearInt($itemType);
    $abuseId = helper::clearInt($abuseId);

    $result = array(
        "error" => true,
        "error_code" => ERROR_UNKNOWN);

    $auth = new auth($dbo);

    $reports = new reports($dbo);
    $reports->setRequestFrom($accountId);

    $result = $reports->add($itemType, $itemId, $abuseId);

    echo json_encode($result);
    exit;
}
