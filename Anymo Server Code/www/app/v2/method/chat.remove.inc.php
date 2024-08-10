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

    $profileId = isset($_POST['profile_id']) ? $_POST['profile_id'] : '';

    $chatId = isset($_POST['chat_id']) ? $_POST['chat_id'] : 0;
    $itemId = isset($_POST['item_id']) ? $_POST['item_id'] : 0;

    $clientId = helper::clearInt($clientId);
    $accountId = helper::clearInt($accountId);

    $profileId = helper::clearInt($profileId);

    $chatId = helper::clearInt($chatId);
    $itemId = helper::clearInt($itemId);

    $result = array(
        "error" => true,
        "error_code" => ERROR_UNKNOWN
    );

    $auth = new auth($dbo);

    if (!$auth->authorize($accountId, $accessToken)) {

        api::printError(ERROR_ACCESS_TOKEN, "Error authorization.");
    }

    $messages = new msg($dbo);
    $messages->setRequestFrom($accountId);

    $verifyId = $messages->getChatId($accountId, $profileId, $itemId);

    if ($chatId == $verifyId) {

        $result = $messages->removeChat($chatId);
    }

    echo json_encode($result);
    exit;
}
