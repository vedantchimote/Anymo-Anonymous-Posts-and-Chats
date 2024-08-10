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

    $result = array(
        "error" => false,
        "error_code" => ERROR_SUCCESS
    );

    //

    $settings = new settings($dbo);

    $config = $settings->get();

    $arr = array();

    $arr = $config['interstitialAdAfterNewItem'];
    $result['interstitialAdAfterNewItem'] = $arr['intValue'];

    $arr = $config['interstitialAdAfterNewLike'];
    $result['interstitialAdAfterNewLike'] = $arr['intValue'];

    $arr = $config['admobAdAfterItem'];
    $result['admobAdAfterItem'] = $arr['intValue'];

    $arr = $config['allowGoogleAuth'];
    $result['allowGoogleAuth'] = $arr['intValue'];

    $result['allowOtpVerification'] = 1;

    if (!OTP_VERIFICATION) {

        $result['allowOtpVerification'] = 0;
    }

    //

    if ($accountId != 0) {

        $auth = new auth($dbo);

        if ($auth->authorize($accountId, $accessToken)) {

            $account = new account($dbo, $accountId);
            $accountInfo = $account->get();
            unset($account);

            $messages_count = 0;
            $notifications_count = 0;

            // Get new messages count

            if (APP_MESSAGES_COUNTERS) {

                $msg = new msg($dbo);
                $msg->setRequestFrom($accountId);

                $messages_count = $msg->getNewMessagesCount();

                unset($msg);
            }

            //

            $result['messagesCount'] = $messages_count;
            $result['notificationsCount'] = $notifications_count;
        }
    }

    //

    echo json_encode($result);
    exit;
}
