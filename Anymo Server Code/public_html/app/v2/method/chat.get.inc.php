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

    $profileId = isset($_POST['profile_id']) ? $_POST['profile_id'] : 0;

    $chatFromUserId = isset($_POST['chat_from_user_id']) ? $_POST['chat_from_user_id'] : 0;
    $chatToUserId = isset($_POST['chat_to_user_id']) ? $_POST['chat_to_user_id'] : 0;

    $chatId = isset($_POST['chat_id']) ? $_POST['chat_id'] : 0;
    $msgId = isset($_POST['msg_id']) ? $_POST['msg_id'] : 0;

    $itemId = isset($_POST['item_id']) ? $_POST['item_id'] : 0;

    $clientId = helper::clearInt($clientId);
    $accountId = helper::clearInt($accountId);

    $profileId = helper::clearInt($profileId);

    $chatFromUserId = helper::clearInt($chatFromUserId);
    $chatToUserId = helper::clearInt($chatToUserId);

    $chatId = helper::clearInt($chatId);
    $msgId = helper::clearInt($msgId);

    $itemId = helper::clearInt($itemId);

    $result = array(
        "error" => true,
        "error_code" => ERROR_UNKNOWN
    );

    $auth = new auth($dbo);

    if (!$auth->authorize($accountId, $accessToken)) {

        api::printError(ERROR_ACCESS_TOKEN, "Error authorization.");
    }

    $msg = new msg($dbo, $COLORS_ARRAY, $CHAT_ICONS_ARRAY);
    $msg->setRequestFrom($accountId);

    if ($chatId == 0) {

        $chatId = $msg->getChatId($accountId, $profileId, $itemId);
    }

    if ($chatId != 0) {

        $response = $msg->get($chatId, $msgId, $chatFromUserId, $chatToUserId);

        if ($response['chatFromUserId'] == $accountId || $response['chatToUserId'] == $accountId) {

            echo json_encode($response);

        } else {

            echo json_encode($result);
        }

    } else {

        echo json_encode($result);
    }


    exit;
}
