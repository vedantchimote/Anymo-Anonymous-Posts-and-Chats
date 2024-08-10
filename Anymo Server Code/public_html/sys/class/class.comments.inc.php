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

class comments extends db_connect
{

	private $requestFrom = 0;
    private $language = 'en';
    private $table = 'item_comments';
    private $itemType = ITEM_TYPE_POST;

    private $COLORS_ARRAY = array();
    private $ICONS_ARRAY = array();

	public function __construct($dbo = NULL, $COLORS_ARRAY = array(), $ICONS_ARRAY = array())
    {
		parent::__construct($dbo);

		$this->COLORS_ARRAY = $COLORS_ARRAY;
        $this->ICONS_ARRAY = $ICONS_ARRAY;
	}

    public function myActiveCommentsCount()
    {
        $stmt = $this->db->prepare("SELECT count(*) FROM item_comments WHERE fromUserId = (:fromUserId) AND removeAt = 0");
        $stmt->bindParam(":fromUserId", $this->requestFrom, PDO::PARAM_INT);
        $stmt->execute();

        return $number_of_rows = $stmt->fetchColumn();
    }

    public function count($itemId)
    {
        $sql = "SELECT count(*) FROM $this->table WHERE itemId = (:itemId) AND removeAt = 0";

        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(":itemId", $itemId, PDO::PARAM_INT);
        $stmt->execute();

        return $number_of_rows = $stmt->fetchColumn();
    }

    public function create($itemId, $text, $replyToUserId = 0, $area = "", $country = "", $city = "", $itemInfo = array())
    {
        $result = array(
            "error" => true,
            "error_code" => ERROR_UNKNOWN
        );

        if (strlen($text) == 0) {

            return $result;
        }

        $colorId = 0;
        $iconId = 0;

        if ($this->getRequestFrom() != $itemInfo['fromUserId']) {

            $response = $this->searchMyComment($itemInfo['id']);

            if (!$response['error']) {

                // found my previous comment for this item

                $colorId = $response['colorId'];
                $iconId = $response['iconId'];

            } else {

                // generate new color and icon

                $uniq = false;

                $colorId = rand(0, count($this->COLORS_ARRAY) - 1);
                $iconId = rand(0, count($this->ICONS_ARRAY) - 1);

                while (!$uniq) {

                    $response = $this->searchTheSameComment($itemInfo['id'], $colorId, $iconId);

                    if ($response['error']) {

                        // generated uniq

                        $uniq = true;

                    } else {

                        // need generate new

                        $uniq = false;

                        $colorId = rand(0, count($this->COLORS_ARRAY) - 1);
                        $iconId = rand(0, count($this->ICONS_ARRAY) - 1);
                    }
                }

            }
        }

        $currentTime = time();
        $ip_addr = helper::ip_addr();
        $u_agent = helper::u_agent();

        $sql = "INSERT INTO $this->table (fromUserId, replyToUserId, itemId, itemFromUserId, colorId, iconId, comment, area, country, city, createAt, ip_addr, u_agent) value (:fromUserId, :replyToUserId, :itemId, :itemFromUserId, :colorId, :iconId, :comment, :area, :country, :city, :createAt, :ip_addr, :u_agent)";

        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(":fromUserId", $this->requestFrom, PDO::PARAM_INT);
        $stmt->bindParam(":replyToUserId", $replyToUserId, PDO::PARAM_INT);
        $stmt->bindParam(":itemId", $itemInfo['id'], PDO::PARAM_INT);
        $stmt->bindParam(":itemFromUserId", $itemInfo['fromUserId'], PDO::PARAM_INT);
        $stmt->bindParam(":colorId", $colorId, PDO::PARAM_INT);
        $stmt->bindParam(":iconId", $iconId, PDO::PARAM_INT);
        $stmt->bindParam(":comment", $text, PDO::PARAM_STR);
        $stmt->bindParam(":area", $area, PDO::PARAM_STR);
        $stmt->bindParam(":country", $country, PDO::PARAM_STR);
        $stmt->bindParam(":city", $city, PDO::PARAM_STR);
        $stmt->bindParam(":createAt", $currentTime, PDO::PARAM_INT);
        $stmt->bindParam(":ip_addr", $ip_addr, PDO::PARAM_STR);
        $stmt->bindParam(":u_agent", $u_agent, PDO::PARAM_STR);

        if ($stmt->execute()) {

            $result = array(
                "error" => false,
                "error_code" => ERROR_SUCCESS,
                "commentId" => $this->db->lastInsertId(),
                "comment" => $this->info($this->db->lastInsertId())
            );

            $item = new items($this->db);
            $item->setRequestFrom($this->getRequestFrom());
            $itemInfo = $item->info($itemId);

            $gcm_notify_comment = GCM_NOTIFY_COMMENT;
            $gcm_notify_comment_reply = GCM_NOTIFY_COMMENT_REPLY;
            $notify_type_comment = NOTIFY_TYPE_COMMENT;
            $notify_type_comment_reply = NOTIFY_TYPE_COMMENT_REPLY;

            if (($this->getRequestFrom() != $itemInfo['fromUserId']) && ($replyToUserId != $itemInfo['fromUserId'])) {

                $fcm = new fcm($this->db);
                $fcm->setRequestFrom($this->getRequestFrom());
                $fcm->setRequestTo($itemInfo['fromUserId']);
                $fcm->setType($gcm_notify_comment);
                $fcm->setTitle("You have a new comment.");
                $fcm->setItemId($itemId);
                $fcm->prepare();
                $fcm->send();
                unset($fcm);
            }

            if ($replyToUserId != $this->getRequestFrom() && $replyToUserId != 0) {

                $fcm = new fcm($this->db);
                $fcm->setRequestFrom($this->getRequestFrom());
                $fcm->setRequestTo($replyToUserId);
                $fcm->setType($gcm_notify_comment_reply);
                $fcm->setTitle("You have a new reply to comment.");
                $fcm->setItemId($itemId);
                $fcm->prepare();
                $fcm->send();
                unset($fcm);
            }

            $item->updateCounters($itemId);
        }

        unset($item);

        return $result;
    }

    public function searchMyComment($itemId) {

        $result = array(
            "error" => true,
            "error_code" => ERROR_UNKNOWN,
            "colorId" => 0,
            "iconId" => 0
        );

        $sql = "SELECT * FROM $this->table WHERE fromUserId = (:fromUserId) AND itemId = (:itemId) LIMIT 1";

        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(":fromUserId", $this->requestFrom, PDO::PARAM_INT);
        $stmt->bindParam(":itemId", $itemId, PDO::PARAM_INT);

        if ($stmt->execute()) {

            if ($stmt->rowCount() > 0) {

                $row = $stmt->fetch();

                $result = array(
                    "error" => false,
                    "error_code" => ERROR_UNKNOWN,
                    "colorId" => $row['colorId'],
                    "iconId" => $row['iconId']
                );
            }
        }

        return $result;
    }

    public function searchTheSameComment($itemId, $colorId, $iconId) {

        $result = array(
            "error" => true,
            "error_code" => ERROR_UNKNOWN
        );

        $sql = "SELECT * FROM $this->table WHERE  itemId = (:itemId) AND colorId = (:colorId) AND iconId = (:iconId) LIMIT 1";

        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(":itemId", $itemId, PDO::PARAM_INT);
        $stmt->bindParam(":colorId", $colorId, PDO::PARAM_INT);
        $stmt->bindParam(":iconId", $iconId, PDO::PARAM_INT);

        if ($stmt->execute()) {

            if ($stmt->rowCount() > 0) {

                $result = array(
                    "error" => false,
                    "error_code" => ERROR_UNKNOWN
                );
            }
        }

        return $result;
    }

    public function removeByAccountId($accountId)
    {

        $result = array(
            "error" => true,
            "error_code" => ERROR_UNKNOWN
        );

        $stmt = $this->db->prepare("SELECT id FROM item_comments WHERE fromUserId = (:fromUserId) AND removeAt = 0");
        $stmt->bindParam(':fromUserId', $accountId, PDO::PARAM_INT);

        if ($stmt->execute()) {

            while ($row = $stmt->fetch()) {

                $this->remove($row['id']);
            }

            $result = array(
                "error" => false,
                "error_code" => ERROR_SUCCESS
            );
        }

        return $result;
    }

    public function remove($commentId)
    {
        $result = array(
            "error" => true,
            "error_code" => ERROR_UNKNOWN
        );

        $commentInfo = $this->info($commentId);

        if ($commentInfo['error']) {

            return $result;
        }

        $currentTime = time();

        $sql = "UPDATE $this->table SET removeAt = (:removeAt) WHERE id = (:commentId)";

        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(":commentId", $commentId, PDO::PARAM_INT);
        $stmt->bindParam(":removeAt", $currentTime, PDO::PARAM_INT);

        if ($stmt->execute()) {

            $item = new items($this->db);
            $item->setRequestFrom($this->getRequestFrom());

            $item->updateCounters($commentInfo['itemId']);

            unset($item);

            $result = array(
                "error" => false,
                "error_code" => ERROR_SUCCESS
            );
        }

        return $result;
    }

    public function info($commentId)
    {
        $result = array(
            "error" => true,
            "error_code" => ERROR_UNKNOWN
        );

        $sql = "SELECT * FROM $this->table WHERE id = (:commentId) LIMIT 1";

        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(":commentId", $commentId, PDO::PARAM_INT);

        if ($stmt->execute()) {

            if ($stmt->rowCount() > 0) {

                $row = $stmt->fetch();

                $result = $this->quickInfo($row);
            }
        }

        return $result;
    }

    public function quickInfo($row)
    {
        $time = new language($this->db, $this->language);

        $result = array(
            "error" => false,
            "error_code" => ERROR_SUCCESS,
            "id" => $row['id'],
            "comment" => htmlspecialchars_decode(stripslashes($row['comment'])),
            "fromUserId" => $row['fromUserId'],
            "replyToUserId" => $row['replyToUserId'],
            "itemId" => $row['itemId'],
            "itemFromUserId" => $row['itemFromUserId'],
            "itemType" => ITEM_TYPE_POST,
            "area" => htmlspecialchars_decode(stripslashes($row['area'])),
            "country" => htmlspecialchars_decode(stripslashes($row['country'])),
            "city" => htmlspecialchars_decode(stripslashes($row['city'])),
            "createAt" => $row['createAt'],
            "notifyId" => $row['notifyId'],
            "timeAgo" => $time->timeAgo($row['createAt'])
        );

        $result['color'] = $this->COLORS_ARRAY[$row['colorId']]['color'];
        $result['colorName'] = $this->COLORS_ARRAY[$row['colorId']]['name'];
        $result['icon'] = $this->ICONS_ARRAY[$row['iconId']]['name'];
        $result['iconUrl'] = $this->ICONS_ARRAY[$row['iconId']]['url'];

        return $result;
    }

    public function get($itemId, $commentId = 0, $itemInfo = array())
    {
        if ($commentId == 0) {

            $commentId = 100000;
        }

        $comments = array(
            "error" => false,
            "error_code" => ERROR_SUCCESS,
            "commentId" => $commentId,
            "itemId" => $itemId,
            "comments" => array()
        );

        $sql = "SELECT * FROM $this->table WHERE itemId = (:itemId) AND id < (:commentId) AND removeAt = 0 ORDER BY id DESC LIMIT 70";

        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':itemId', $itemId, PDO::PARAM_INT);
        $stmt->bindParam(':commentId', $commentId, PDO::PARAM_INT);

        if ($stmt->execute()) {

            while ($row = $stmt->fetch()) {

                $commentInfo = $this->quickInfo($row);

                array_push($comments['comments'], $commentInfo);

                $comments['commentId'] = $commentInfo['id'];

                unset($commentInfo);
            }
        }

        return $comments;
    }

    public function flow($itemId)
    {
        if ($itemId == 0) {

            $itemId = 100000;
        }

        $result = array(
            "error" => false,
            "error_code" => ERROR_SUCCESS,
            "itemId" => $itemId,
            "items" => array()
        );

        $sql = "SELECT * FROM $this->table WHERE id < (:itemId) AND removeAt = 0 ORDER BY id DESC LIMIT 20";

        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':itemId', $itemId, PDO::PARAM_INT);

        if ($stmt->execute()) {

            while ($row = $stmt->fetch()) {

                $itemInfo = $this->quickInfo($row);

                array_push($result['items'], $itemInfo);

                $result['itemId'] = $itemInfo['id'];

                unset($itemInfo);
            }
        }

        return $result;
    }

    public function wall($itemId)
    {
        if ($itemId == 0) {

            $itemId = 10000000;
            $itemId++;
        }

        $result = array(
            "error" => false,
            "error_code" => ERROR_SUCCESS,
            "itemId" => $itemId,
            "items" => array()
        );

        $stmt = $this->db->prepare("SELECT * FROM item_comments WHERE id < (:itemId) AND fromUserId = (:fromUserId) AND removeAt = 0 ORDER BY id DESC LIMIT 20");
        $stmt->bindParam(':itemId', $itemId, PDO::PARAM_INT);
        $stmt->bindParam(':fromUserId', $this->requestFrom, PDO::PARAM_INT);

        if ($stmt->execute()) {

            while ($row = $stmt->fetch()) {

                $itemInfo = $this->quickInfo($row);

                array_push($result['items'], $itemInfo);

                $result['itemId'] = $itemInfo['id'];

                unset($itemInfo);
            }
        }

        return $result;
    }

    public function setLanguage($language)
    {
        $this->language = $language;
    }

    public function getLanguage()
    {
        return $this->language;
    }

    public function setRequestFrom($requestFrom)
    {
        $this->requestFrom = $requestFrom;
    }

    public function getRequestFrom()
    {
        return $this->requestFrom;
    }
}
