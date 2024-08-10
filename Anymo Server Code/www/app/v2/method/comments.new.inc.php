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

    $account_id = isset($_POST['account_id']) ? $_POST['account_id'] : 0;
    $accessToken = isset($_POST['access_token']) ? $_POST['access_token'] : '';

    $itemId = isset($_POST['item_id']) ? $_POST['item_id'] : 0;
    $commentText = isset($_POST['comment_text']) ? $_POST['comment_text'] : '';

    $area = isset($_POST['area']) ? $_POST['area'] : '';
    $country = isset($_POST['country']) ? $_POST['country'] : '';
    $city = isset($_POST['city']) ? $_POST['city'] : '';

    $replyToUserId = isset($_POST['replyToUserId']) ? $_POST['replyToUserId'] : 0;

    $itemType = isset($_POST['item_type']) ? $_POST['item_type'] : 0;

    $clientId = helper::clearInt($clientId);
    $account_id = helper::clearInt($account_id);

    $itemId = helper::clearInt($itemId);

    $commentText = helper::clearText($commentText);

    $commentText = preg_replace( "/[\r\n]+/", " ", $commentText); //replace all new lines to one new line
    $commentText  = preg_replace('/\s+/', ' ', $commentText);        //replace all white spaces to one space

    $commentText = helper::escapeText($commentText);

    $area = helper::clearText($area);
    $area = helper::escapeText($area);

    $country = helper::clearText($country);
    $country = helper::escapeText($country);

    $city = helper::clearText($city);
    $city = helper::escapeText($city);

    $replyToUserId = helper::clearInt($replyToUserId);
    $itemType = helper::clearInt($itemType);

    $result = array(
        "error" => true,
        "error_code" => ERROR_UNKNOWN
    );

    $auth = new auth($dbo);

    if (!$auth->authorize($account_id, $accessToken)) {

        api::printError(ERROR_ACCESS_TOKEN, "Error authorization.");
    }

    if (strlen($commentText) != 0) {

        $item = new items($dbo);
        $item->setRequestFrom($account_id);

        $itemInfo = $item->info($itemId);

        if ($itemInfo['allowComments'] == 0) {

            echo json_encode($result);
            exit;
        }

        if (OTP_VERIFICATION) {

            $account = new account($dbo, $account_id);
            $account_arr = $account->get();
            unset($account);

            // If account phone number not linked

            if ($account_arr['otpVerified'] != 1) {

                $settings = new settings($dbo);
                $settings_arr = $settings->get();
                unset($settings);

                // If have limits

                if ($settings_arr['limitComments']['intValue'] != 0) {

                    $spam = new spam($dbo);
                    $spam->setRequestFrom($account_id);
                    $comments_count = $spam->getItemCommentsCount();
                    unset($spam);

                    // If limits exceeded

                    if ($comments_count >= $settings_arr['limitComments']['intValue']) {

                        $result['error_code'] = ERROR_LIMIT_EXCEEDED;

                        echo json_encode($result);
                        exit;
                    }
                }
            }
        }

        $comments = new comments($dbo, $COLORS_ARRAY, $ICONS_ARRAY);
        $comments->setRequestFrom($account_id);

        $result = $comments->create($itemId, $commentText, $replyToUserId, $area, $country, $city, $itemInfo);
    }

    echo json_encode($result);
    exit;
}
