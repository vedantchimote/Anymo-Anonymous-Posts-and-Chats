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

    $itemId = isset($_POST['item_id']) ? $_POST['item_id'] : 0;

    $clientId = helper::clearInt($clientId);
    $accountId = helper::clearInt($accountId);

    $itemId = helper::clearInt($itemId);

    $result = array(
        "error" => true,
        "error_code" => ERROR_UNKNOWN
    );

    $auth = new auth($dbo);

    if (!$auth->authorize($accountId, $accessToken)) {

        api::printError(ERROR_ACCESS_TOKEN, "Error authorization.");
    }

    $items = new items($dbo);
    $items->setRequestFrom($accountId);

    $itemInfo = $items->info($itemId);

    if (!$itemInfo['error'] && $itemInfo['removeAt'] == 0) {

        $result = array(
            "error" => false,
            "error_code" => ERROR_SUCCESS,
            "itemId" => $itemId,
            "items" => array(),
            "comments" => array()
        );

        array_push($result['items'], $itemInfo);

        if ($itemInfo['allowComments'] != 0) {

            $comments = new comments($dbo, $COLORS_ARRAY, $ICONS_ARRAY);
            $comments->setRequestFrom($accountId);

            array_push($result['comments'], $comments->get($itemInfo['id'], 0, $itemInfo));

            unset($comments);
        }
    }

    echo json_encode($result);
    exit;
}
