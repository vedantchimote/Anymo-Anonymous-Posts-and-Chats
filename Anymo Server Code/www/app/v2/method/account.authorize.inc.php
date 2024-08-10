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

    $clientId = helper::clearInt($clientId);
    $accountId = helper::clearInt($accountId);

    $accessToken = helper::clearText($accessToken);
    $accessToken = helper::escapeText($accessToken);

    if ($clientId != CLIENT_ID) {

        api::printError(ERROR_UNKNOWN, "Error client Id.");
    }

    $result = array("error" => true);

    $auth = new auth($dbo);

    if (!$auth->authorize($accountId, $accessToken)) {

        api::printError(ERROR_ACCESS_TOKEN, "Error authorization.");
    }

    $account = new account($dbo, $accountId);
    $account->setLastActive();

    $result = array(
        "error" => false,
        "error_code" => ERROR_SUCCESS,
        "accessToken" => $accessToken,
        "accountId" => $accountId,
        "account" => array()
    );

    array_push($result['account'], $account->get());

    echo json_encode($result);
    exit;
}
