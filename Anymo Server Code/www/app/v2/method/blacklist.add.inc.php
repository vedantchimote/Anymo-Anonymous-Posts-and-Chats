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

    $profileId = isset($_POST['profile_id']) ? $_POST['profile_id'] : 0;
    $reason = isset($_POST['reason']) ? $_POST['reason'] : '';

    $accountId = helper::clearInt($accountId);

    $profileId = helper::clearInt($profileId);

    $reason = preg_replace( "/[\r\n]+/", " ", $reason); //replace all new lines to one new line
    $reason  = preg_replace('/\s+/', ' ', $reason);        //replace all white spaces to one space

    $reason = helper::escapeText($reason);

    $result = array(
        "error" => true,
        "error_code" => ERROR_UNKNOWN
    );

    $auth = new auth($dbo);

    if (!$auth->authorize($accountId, $accessToken)) {

        api::printError(ERROR_ACCESS_TOKEN, "Error authorization.");
    }

    if (strlen($reason) == 0) {

        echo json_encode($result);
        exit;
    }

    $blacklist = new blacklist($dbo);
    $blacklist->setRequestFrom($accountId);

    if (!$blacklist->isExists($profileId)) {

        $result = $blacklist->add($profileId, $reason);
    }

    unset($blacklist);

    echo json_encode($result);
    exit;
}
