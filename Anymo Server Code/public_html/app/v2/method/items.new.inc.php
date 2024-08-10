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

    $client_id = isset($_POST['client_id']) ? $_POST['client_id'] : 0;

    $account_id = isset($_POST['account_id']) ? $_POST['account_id'] : 0;
    $access_token = isset($_POST['access_token']) ? $_POST['access_token'] : '';

    $allow_comments = isset($_POST['allow_comments']) ? $_POST['allow_comments'] : 1;
    $allow_messages = isset($_POST['allow_messages']) ? $_POST['allow_messages'] : 1;

    $text = isset($_POST['text']) ? $_POST['text'] : '';
    $text_color = isset($_POST['text_color']) ? $_POST['text_color'] : '';
    $bg_color = isset($_POST['bg_color']) ? $_POST['bg_color'] : '';

    $img_blur = isset($_POST['img_blur']) ? $_POST['img_blur'] : 0;
    $img_alpha = isset($_POST['img_alpha']) ? $_POST['img_alpha'] : 90;

    $area = isset($_POST['area']) ? $_POST['area'] : '';
    $country = isset($_POST['country']) ? $_POST['country'] : '';
    $city = isset($_POST['city']) ? $_POST['city'] : '';

    $lat = isset($_POST['lat']) ? $_POST['lat'] : '0.000000';
    $lng = isset($_POST['lng']) ? $_POST['lng'] : '0.000000';

    $img_url = isset($_POST['img_url']) ? $_POST['img_url'] : '';

    $allow_comments = helper::clearInt($allow_comments);
    $allow_messages = helper::clearInt($allow_messages);

    $client_id = helper::clearInt($client_id);
    $account_id = helper::clearInt($account_id);

    $img_blur = helper::clearInt($img_blur);
    $img_alpha = helper::clearInt($img_alpha);

    $text = preg_replace( "/[\r\n]+/", "<br>", $text); //replace all new lines to one new line
    $text  = preg_replace('/\s+/', ' ', $text);        //replace all white spaces to one space

    $text = helper::escapeText($text);

    $img_url = helper::clearText($img_url);
    $img_url = helper::escapeText($img_url);

    $area = helper::clearText($area);
    $area = helper::escapeText($area);

    $country = helper::clearText($country);
    $country = helper::escapeText($country);

    $city = helper::clearText($city);
    $city = helper::escapeText($city);

    $lat = helper::clearText($lat);
    $lat = helper::escapeText($lat);

    $lng = helper::clearText($lng);
    $lng = helper::escapeText($lng);

    if (strpos($img_url, APP_URL."/".POST_PHOTO_PATH) === false) {

        $img_url = "";
    }

    $result = array(
        "error" => true,
        "error_code" => ERROR_UNKNOWN
    );

    $auth = new auth($dbo);

    if (!$auth->authorize($account_id, $access_token)) {

        api::printError(ERROR_ACCESS_TOKEN, "Error authorization.");
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

            if ($settings_arr['limitItems']['intValue'] != 0) {

                $spam = new spam($dbo);
                $spam->setRequestFrom($account_id);
                $items_count = $spam->getItemsCount();
                unset($spam);

                // If limits exceeded

                if ($items_count >= $settings_arr['limitItems']['intValue']) {

                    $result['error_code'] = ERROR_LIMIT_EXCEEDED;

                    echo json_encode($result);
                    exit;
                }
            }
        }
    }

    $items = new items($dbo);
    $items->setRequestFrom($account_id);

    $result = $items->add($text, $text_color, $bg_color, $img_blur, $img_alpha, $img_url, $area, $country, $city, $lat, $lng, $allow_comments, $allow_messages);

    echo json_encode($result);
    exit;
}
