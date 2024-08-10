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

    $hash = isset($_POST['hash']) ? $_POST['hash'] : '';

    $app_type = isset($_POST['app_type']) ? $_POST['app_type'] : 0; // 0 = APP_TYPE_UNKNOWN
    $fcm_regId = isset($_POST['fcm_regId']) ? $_POST['fcm_regId'] : '';
    $lang = isset($_POST['lang']) ? $_POST['lang'] : '';

    $oauth_id = isset($_POST['oauth_id']) ? $_POST['oauth_id'] : '';
    $oauth_type = isset($_POST['oauth_type']) ? $_POST['oauth_type'] : 0;

    $password = isset($_POST['password']) ? $_POST['password'] : '';
    $email = isset($_POST['email']) ? $_POST['email'] : '';
    $referrer = isset($_POST['referrer']) ? $_POST['referrer'] : 0;

    $language = isset($_POST['language']) ? $_POST['language'] : '';

    $client_id = helper::clearInt($client_id);

    $referrer = helper::clearInt($referrer);

    $password = helper::clearText($password);
    $email = helper::clearText($email);
    $language = helper::clearText($language);

    $password = helper::escapeText($password);
    $email = helper::escapeText($email);
    $language = helper::escapeText($language);

    $oauth_id = helper::escapeText($oauth_id);
    $oauth_id = helper::clearText($oauth_id);

    $oauth_type = helper::clearInt($oauth_type);
    $app_type = helper::clearInt($app_type);

    $fcm_regId = helper::clearText($fcm_regId);
    $fcm_regId = helper::escapeText($fcm_regId);

    $lang = helper::clearText($lang);
    $lang = helper::escapeText($lang);

    if ($client_id != CLIENT_ID) {

        api::printError(ERROR_UNKNOWN, "Error client Id.");
    }

    if (APP_USE_CLIENT_SECRET) {

        if ($hash !== md5(md5($email).CLIENT_SECRET)) {

            api::printError(ERROR_CLIENT_SECRET, "Error hash.");
        }
    }

    $result = array(
        "error" => true,
        "error_code" => ERROR_UNKNOWN
    );

    $account = new account($dbo);
    $result = $account->signup($email, $password, $language);
    unset($account);

    if (!$result['error']) {

        if (!$result['error']) {

            $auth = new auth($dbo);
            $result = $auth->create($result['accountId'], $client_id, $app_type, $fcm_regId, $lang);

            if (!$result['error']) {

                $account = new account($dbo, $result['accountId']);

                //

                if (strlen($oauth_id) != 0) {

                    $helper = new helper($dbo);

                    switch ($oauth_type) {

                        case OAUTH_TYPE_FACEBOOK: {

                            if ($helper->getUserIdByFacebook($oauth_id) == 0) {

                                $account->setFacebookId($oauth_id);
                            }

                            break;
                        }

                        case OAUTH_TYPE_GOOGLE: {

                            if ($helper->getUserIdByGoogle($oauth_id) == 0) {

                                $account->setGoogleFirebaseId($oauth_id);
                            }

                            break;
                        }

                        default: {

                            break;
                        }
                    }
                }

                //

                $result['account'] = array();

                array_push($result['account'], $account->get());
            }
        }
    }

    echo json_encode($result);
    exit;
}
