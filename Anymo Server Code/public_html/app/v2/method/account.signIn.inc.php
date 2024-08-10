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

    $email = isset($_POST['email']) ? $_POST['email'] : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';

    $app_type = isset($_POST['app_type']) ? $_POST['app_type'] : 0; // 0 = APP_TYPE_UNKNOWN
    $fcm_regId = isset($_POST['fcm_regId']) ? $_POST['fcm_regId'] : '';
    $lang = isset($_POST['lang']) ? $_POST['lang'] : '';

    $client_id = helper::clearInt($client_id);

    $email = helper::clearText($email);
    $password = helper::clearText($password);

    $email = helper::escapeText($email);
    $password = helper::escapeText($password);

    $app_type = helper::clearInt($app_type);

    $lang = helper::clearText($lang);
    $lang = helper::escapeText($lang);

    $fcm_regId = helper::clearText($fcm_regId);
    $fcm_regId = helper::escapeText($fcm_regId);

    if ($client_id != CLIENT_ID) {

        api::printError(ERROR_UNKNOWN, "Error client Id.");
    }

    $access_data = array();

    $account = new account($dbo);
    $access_data = $account->signin($email, $password);

    unset($account);

    if (!$access_data["error"]) {

        $account = new account($dbo, $access_data['accountId']);

        switch ($account->getState()) {

            case ACCOUNT_STATE_BLOCKED: {

                break;
            }

            case ACCOUNT_STATE_DISABLED: {

                break;
            }

            default: {

                $auth = new auth($dbo);
                $access_data = $auth->create($access_data['accountId'], $client_id, $app_type, $fcm_regId, $lang);

                if (!$access_data['error']) {

                    $account->setState(ACCOUNT_STATE_ENABLED);
                    $account->setLastActive();
                    $access_data['account'] = array();

                    array_push($access_data['account'], $account->get());
                }

                break;
            }
        }
    }

    echo json_encode($access_data);
    exit;
}
