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
    $messageText = isset($_POST['message_text']) ? $_POST['message_text'] : "";
    $messageImg = isset($_POST['message_img']) ? $_POST['message_img'] : "";

    $listId = isset($_POST['list_id']) ? $_POST['list_id'] : 0;
    $itemId = isset($_POST['item_id']) ? $_POST['item_id'] : 0;

    $stickerId = isset($_POST['sticker_id']) ? $_POST['sticker_id'] : 0;
    $stickerImgUrl = isset($_POST['sticker_img_url']) ? $_POST['sticker_img_url'] : "";

    $stickerId = helper::clearInt($stickerId);

    $stickerImgUrl = helper::clearText($stickerImgUrl);
    $stickerImgUrl = helper::escapeText($stickerImgUrl);

    $clientId = helper::clearInt($clientId);
    $accountId = helper::clearInt($accountId);

    $profileId = helper::clearInt($profileId);

    $chatFromUserId = helper::clearInt($chatFromUserId);
    $chatToUserId = helper::clearInt($chatToUserId);

    $chatId = helper::clearInt($chatId);

    $listId = helper::clearInt($listId);
    $itemId = helper::clearInt($itemId);

    $messageText = helper::clearText($messageText);

    $messageText = preg_replace( "/[\r\n]+/", "<br>", $messageText); //replace all new lines to one new line
    $messageText  = preg_replace('/\s+/', ' ', $messageText);        //replace all white spaces to one space

    $messageText = helper::escapeText($messageText);

    $messageImg = helper::clearText($messageImg);
    $messageImg = helper::escapeText($messageImg);

    if (strpos($messageImg, APP_URL."/".CHAT_IMAGE_PATH) === false) {

        $messageImg = "";
    }

    $result = array(
        "error" => true,
        "error_code" => ERROR_UNKNOWN
    );

    $auth = new auth($dbo);

    if (!$auth->authorize($accountId, $accessToken)) {

        api::printError(ERROR_ACCESS_TOKEN, "Error authorization.");
    }

    if ($profileId == $accountId) {

        echo json_encode($result);
        exit;
    }

    $account = new account($dbo, $profileId);

    $accountInfo = $account->get();

    if ($accountInfo['state'] != ACCOUNT_STATE_ENABLED) {

        echo json_encode($result);
        exit;
    }

    if ($accountInfo['allowMessages'] == 0) {

        echo json_encode($result);
        exit;
    }

    $blacklist = new blacklist($dbo);
    $blacklist->setRequestFrom($profileId);

    if ($blacklist->isExists($accountId)) {

        echo json_encode($result);
        exit;
    }

    unset($blacklist);

    if (OTP_VERIFICATION) {

        if ($chatId == 0) {

            $account = new account($dbo, $accountId);
            $account_arr = $account->get();
            unset($account);

            // If account phone number not linked

            if ($account_arr['otpVerified'] != 1) {

                $settings = new settings($dbo);
                $settings_arr = $settings->get();
                unset($settings);

                // If have limits

                if ($settings_arr['limitChats']['intValue'] != 0) {

                    $spam = new spam($dbo);
                    $spam->setRequestFrom($accountId);
                    $chats_count = $spam->getChatsCount();
                    unset($spam);

                    // If limits exceeded

                    if ($chats_count >= $settings_arr['limitChats']['intValue']) {

                        $result['error_code'] = ERROR_LIMIT_EXCEEDED;

                        echo json_encode($result);
                        exit;
                    }
                }
            }
        }
    }

    $messages = new msg($dbo, $COLORS_ARRAY, $CHAT_ICONS_ARRAY);
    $messages->setRequestFrom($accountId);

    $result = $messages->create($profileId, $chatId, $itemId, $messageText, $messageImg, $chatFromUserId, $chatToUserId, $listId, $stickerId, $stickerImgUrl);

    echo json_encode($result);
    exit;
}
