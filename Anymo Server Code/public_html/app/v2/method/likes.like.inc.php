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

    $accountId = isset($_POST['account_id']) ? $_POST['account_id'] : 0;
    $accessToken = isset($_POST['access_token']) ? $_POST['access_token'] : '';

    $itemId = isset($_POST['item_id']) ? $_POST['item_id'] : 0;
    $itemType = isset($_POST['item_type']) ? $_POST['item_type'] : 0;

    $accountId = helper::clearInt($accountId);

    $accessToken = helper::clearText($accessToken);
    $accessToken = helper::escapeText($accessToken);

    $itemId = helper::clearInt($itemId);
    $itemType = helper::clearInt($itemType);

    $result = array(
        "error" => true,
        "error_code" => ERROR_UNKNOWN
    );

    $auth = new auth($dbo);

    if (!$auth->authorize($accountId, $accessToken)) {

        api::printError(ERROR_ACCESS_TOKEN, "Error authorization.");
    }

    if (OTP_VERIFICATION) {

        $account = new account($dbo, $accountId);
        $account_arr = $account->get();
        unset($account);

        // If account phone number not linked

        if ($account_arr['otpVerified'] != 1) {

            $settings = new settings($dbo);
            $settings_arr = $settings->get();
            unset($settings);

            // If have limits

            if ($settings_arr['limitLikes']['intValue'] != 0) {

                $spam = new spam($dbo);
                $spam->setRequestFrom($accountId);
                $likes_count = $spam->getItemLikesCount();
                unset($spam);

                // If limits exceeded

                if ($likes_count >= $settings_arr['limitLikes']['intValue']) {

                    $result['error_code'] = ERROR_LIMIT_EXCEEDED;

                    echo json_encode($result);
                    exit;
                }
            }
        }
    }

    $items = new items($dbo);
    $items->setRequestFrom($accountId);

    $result = $items->like($itemId);

    echo json_encode($result);
    exit;
}
