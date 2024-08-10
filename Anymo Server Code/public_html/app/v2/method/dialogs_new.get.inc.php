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

    $messageCreateAt = isset($_POST['message_create_at']) ? $_POST['message_create_at'] : 0;

    $clientId = helper::clearInt($clientId);
    $accountId = helper::clearInt($accountId);

    $messageCreateAt = helper::clearInt($messageCreateAt);

    $result = array(
        "error" => true,
        "error_code" => ERROR_UNKNOWN
    );

    $auth = new auth($dbo);

    if (!$auth->authorize($accountId, $accessToken)) {

        api::printError(ERROR_ACCESS_TOKEN, "Error authorization.");
    }

    $messages = new msg($dbo, $COLORS_ARRAY, $CHAT_ICONS_ARRAY);
    $messages->setRequestFrom($accountId);

    $result = $messages->getDialogs_new($messageCreateAt);

    echo json_encode($result);
    exit;
}
