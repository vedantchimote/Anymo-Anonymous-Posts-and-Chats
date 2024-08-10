<?php

/*!
 * https://raccoonsquare.com
 * raccoonsquare@gmail.com
 *
 * Copyright 2012-2022 Demyanchuk Dmitry (raccoonsquare@gmail.com)
 */

if (!defined("APP_SIGNATURE")) {

    header("Location: /");
    exit;
}

class items extends db_connect
{
	private $requestFrom = 0;
    private $language = 'en';

	public function __construct($dbo)
    {
		parent::__construct($dbo);
	}

    public function count()
    {
        $stmt = $this->db->prepare("SELECT count(*) FROM items WHERE fromUserId = (:fromUserId) AND removeAt = 0");
        $stmt->bindParam(":fromUserId", $this->requestFrom, PDO::PARAM_INT);
        $stmt->execute();

        return $number_of_rows = $stmt->fetchColumn();
    }

    public function add($text = "", $text_color = "", $bg_color = "", $img_blur = 0, $img_alpha = 90, $img_url = "", $area = "", $country = "", $city = "", $lat = "0.00000", $lng = "0.00000", $allow_comments = 1, $allow_messages = 1)
    {

        $result = array(
            "error" => true,
            "error_code" => ERROR_UNKNOWN
        );

        $ip_addr = helper::ip_addr();

        $stoplist = new stoplist($this->db);

        if ($stoplist->isExists($ip_addr)) {

            return $result;
        }

        unset($stoplist);

        $account = new account($this->db, $this->getRequestFrom());
        $account->setLastActive();
        unset($account);

        if (strlen($text) == 0) {

            return $result;
        }

        $currentTime = time();
        $u_agent = helper::u_agent();

        $device_type = 0;

        if (strpos($u_agent, "Android") !== false) {

            $device_type = 1;

        } else if (strpos($u_agent, "Darwin") !== false) {

            $device_type = 2;
        }

        $stmt = $this->db->prepare("INSERT INTO items (fromUserId, post, textColor, bgColor, imgBlur, imgAlpha, area, country, city, imgUrl, allowComments, allowMessages, lat, lng, deviceType, createAt, ip_addr, u_agent) value (:fromUserId, :post, :textColor, :bgColor, :imgBlur, :imgAlpha, :area, :country, :city, :imgUrl, :allowComments, :allowMessages, :lat, :lng, :deviceType, :createAt, :ip_addr, :u_agent)");
        $stmt->bindParam(":fromUserId", $this->requestFrom, PDO::PARAM_INT);
        $stmt->bindParam(":post", $text, PDO::PARAM_STR);
        $stmt->bindParam(":textColor", $text_color, PDO::PARAM_STR);
        $stmt->bindParam(":bgColor", $bg_color, PDO::PARAM_STR);
        $stmt->bindParam(":imgBlur", $img_blur, PDO::PARAM_INT);
        $stmt->bindParam(":imgAlpha", $img_alpha, PDO::PARAM_INT);
        $stmt->bindParam(":area", $area, PDO::PARAM_STR);
        $stmt->bindParam(":country", $country, PDO::PARAM_STR);
        $stmt->bindParam(":city", $city, PDO::PARAM_STR);
        $stmt->bindParam(":imgUrl", $img_url, PDO::PARAM_STR);
        $stmt->bindParam(":allowComments", $allow_comments, PDO::PARAM_INT);
        $stmt->bindParam(":allowMessages", $allow_messages, PDO::PARAM_INT);
        $stmt->bindParam(":lat", $lat, PDO::PARAM_STR);
        $stmt->bindParam(":lng", $lng, PDO::PARAM_STR);
        $stmt->bindParam(":deviceType", $device_type, PDO::PARAM_INT);
        $stmt->bindParam(":createAt", $currentTime, PDO::PARAM_INT);
        $stmt->bindParam(":ip_addr", $ip_addr, PDO::PARAM_STR);
        $stmt->bindParam(":u_agent", $u_agent, PDO::PARAM_STR);

        if ($stmt->execute()) {

            $result = array(
                "error" => false,
                "error_code" => ERROR_SUCCESS,
                "itemId" => $this->db->lastInsertId(),
                "item" => $this->info($this->db->lastInsertId())
            );

            $account = new account($this->db, $this->getRequestFrom());
            $account->updateCounters();
            unset($account);

            $this->follow($result['itemId']);
        }

        return $result;
    }

    public function removeByIp($ip_addr)
    {

        $result = array(
            "error" => true,
            "error_code" => ERROR_UNKNOWN,
            "count" => 0
        );

        $stmt = $this->db->prepare("SELECT id FROM items WHERE ip_addr = (:ip_addr) AND removeAt = 0");
        $stmt->bindParam(':ip_addr', $ip_addr, PDO::PARAM_STR);

        if ($stmt->execute()) {

            while ($row = $stmt->fetch()) {

                $this->remove($row['id']);
            }

            $result = array(
                "error" => false,
                "error_code" => ERROR_SUCCESS,
                "count" => $stmt->rowCount()
            );
        }

        return $result;
    }

    public function removeByAccountId($accountId)
    {

        $result = array(
            "error" => true,
            "error_code" => ERROR_UNKNOWN
        );

        $stmt = $this->db->prepare("SELECT id FROM items WHERE fromUserId = (:fromUserId) AND removeAt = 0");
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

    public function remove($itemId)
    {
        $result = array(
            "error" => true,
            "error_code" => ERROR_SUCCESS
        );

        $currentTime = time();

        $stmt = $this->db->prepare("UPDATE items SET removeAt = (:removeAt) WHERE id = (:itemId)");
        $stmt->bindParam(":itemId", $itemId, PDO::PARAM_INT);
        $stmt->bindParam(":removeAt", $currentTime, PDO::PARAM_INT);

        if ($stmt->execute()) {

            //remove all reports

            $reports = new reports($this->db);
            $reports->remove(REPORT_TYPE_ITEM, $itemId);
            unset($reports);

            //remove all comments

            $stmt3 = $this->db->prepare("UPDATE item_comments SET removeAt = (:removeAt) WHERE itemId = (:itemId) AND removeAt = 0");
            $stmt3->bindParam(":removeAt", $currentTime, PDO::PARAM_INT);
            $stmt3->bindParam(":itemId", $itemId, PDO::PARAM_INT);
            $stmt3->execute();

            //remove all likes

            $stmt4 = $this->db->prepare("UPDATE item_likes SET removeAt = (:removeAt) WHERE itemId = (:itemId) AND removeAt = 0");
            $stmt4->bindParam(":itemId", $itemId, PDO::PARAM_INT);
            $stmt4->bindParam(":removeAt", $currentTime, PDO::PARAM_INT);
            $stmt4->execute();

            // remove all item followers

            $stmt = $this->db->prepare("UPDATE item_followers SET removeAt = (:removeAt) WHERE itemId = (:itemId) AND removeAt = 0");
            $stmt->bindParam(":itemId", $itemId, PDO::PARAM_INT);
            $stmt->bindParam(":removeAt", $currentTime, PDO::PARAM_INT);
            $stmt->execute();

            //

            $result = array(
                "error" => false,
                "error_code" => ERROR_SUCCESS
            );
        }

        return $result;
    }

    public function restore($itemId)
    {
        $result = array(
            "error" => true,
            "error_code" => ERROR_SUCCESS
        );

        $stmt = $this->db->prepare("UPDATE items SET removeAt = 0 WHERE id = (:itemId)");
        $stmt->bindParam(":itemId", $itemId, PDO::PARAM_INT);

        if ($stmt->execute()) {

            $result = array(
                "error" => false,
                "error_code" => ERROR_SUCCESS
            );
        }

        return $result;
    }

    public function quikInfo($row)
    {
        $result = array(
            "error" => false,
            "error_code" => ERROR_UNKNOWN
        );

        $time = new language($this->db, $this->language);

        $like = false;
        $follow = false;

        if ($this->getRequestFrom() != 0) {

            if ($this->is_follow($row['id'])) {

                $follow = true;
            }

            if ($this->is_like($row['id'])) {

                $like = true;
            }
        }

        $result = array(
            "error" => false,
            "error_code" => ERROR_SUCCESS,
            "id" => $row['id'],
            "deviceType" => $row['deviceType'],
            "fromUserId" => $row['fromUserId'],
            "textColor" => $row['textColor'],
            "bgColor" => $row['bgColor'],
            "imgBlur" => $row['imgBlur'],
            "imgAlpha" => $row['imgAlpha'],
            "post" => htmlspecialchars_decode(stripslashes($row['post'])),
            "area" => htmlspecialchars_decode(stripslashes($row['area'])),
            "country" => htmlspecialchars_decode(stripslashes($row['country'])),
            "city" => htmlspecialchars_decode(stripslashes($row['city'])),
            "previewVideoImgUrl" => $row['previewVideoImgUrl'],
            "videoUrl" => $row['videoUrl'],
            "lat" => $row['lat'],
            "lng" => $row['lng'],
            "imgUrl" => $row['imgUrl'],
            "allowComments" => $row['allowComments'],
            "allowMessages" => $row['allowMessages'],
            "rating" => $row['rating'],
            "commentsCount" => $row['commentsCount'],
            "likesCount" => $row['likesCount'],
            "viewsCount" => $row['viewsCount'],
            "reportsCount" => $row['reportsCount'],
            "like" => $like,
            "follow" => $follow,
            "moderateAt" => $row['moderateAt'],
            "createAt" => $row['createAt'],
            "date" => date("Y-m-d H:i:s", $row['createAt']),
            "timeAgo" => $time->timeAgo($row['createAt']),
            "removeAt" => $row['removeAt'],
            "ip_addr" => $row['ip_addr']
        );

        return $result;
    }

    public function info($itemId)
    {
        $result = array(
            "error" => true,
            "error_code" => ERROR_UNKNOWN
        );

        $stmt = $this->db->prepare("SELECT * FROM items WHERE id = (:itemId) LIMIT 1");
        $stmt->bindParam(":itemId", $itemId, PDO::PARAM_INT);

        if ($stmt->execute()) {

            if ($stmt->rowCount() > 0) {

                $result = $this->quikInfo($stmt->fetch());
            }
        }

        return $result;
    }

    public function follow($item_id)
    {
        $result = array(
            "error" => false,
            "error_code" => ERROR_SUCCESS,
            "follow" => false
        );

        $currentTime = time();

        $itemInfo = $this->info($item_id);

        if ($itemInfo['removeAt'] != 0 || $itemInfo['error']) {

            return $result;
        }

        if ($itemInfo['follow']) {

            $stmt = $this->db->prepare("UPDATE item_followers SET removeAt = (:removeAt) WHERE itemId = (:itemId) AND userId = (:userId) AND removeAt = 0");
            $stmt->bindParam(":itemId", $item_id, PDO::PARAM_INT);
            $stmt->bindParam(":userId", $this->requestFrom, PDO::PARAM_INT);
            $stmt->bindParam(":removeAt", $currentTime, PDO::PARAM_INT);
            $stmt->execute();

            $result = array(
                "error" => false,
                "error_code" => ERROR_SUCCESS,
                "follow" => false
            );

        } else {

            $stmt = $this->db->prepare("INSERT INTO item_followers (userId, itemId, createAt) value (:userId, :itemId, :createAt)");
            $stmt->bindParam(":userId", $this->requestFrom, PDO::PARAM_INT);
            $stmt->bindParam(":itemId", $item_id, PDO::PARAM_INT);
            $stmt->bindParam(":createAt", $currentTime, PDO::PARAM_INT);
            $stmt->execute();

            $result = array(
                "error" => false,
                "error_code" => ERROR_SUCCESS,
                "follow" => true
            );
        }

        return $result;
    }

    public function is_follow($item_id)
    {

        $stmt = $this->db->prepare("SELECT id FROM item_followers WHERE userId = (:userId) AND itemId = (:itemId) AND removeAt = 0 LIMIT 1");
        $stmt->bindParam(":userId", $this->requestFrom, PDO::PARAM_INT);
        $stmt->bindParam(":itemId", $item_id, PDO::PARAM_INT);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {

            return true;
        }

        return false;
    }

    public function like($item_id)
    {
        $result = array(
            "error" => true,
            "error_code" => ERROR_UNKNOWN
        );

        $currentTime = time();

        $itemInfo = $this->info($item_id);

        if ($itemInfo['removeAt'] != 0 || $itemInfo['error']) {

            return $result;
        }

        if ($itemInfo['like']) {

            $stmt = $this->db->prepare("UPDATE item_likes SET removeAt = (:removeAt) WHERE itemId = (:itemId) AND fromUserId = (:fromUserId) AND removeAt = 0");
            $stmt->bindParam(":fromUserId", $this->requestFrom, PDO::PARAM_INT);
            $stmt->bindParam(":itemId", $item_id, PDO::PARAM_INT);
            $stmt->bindParam(":removeAt", $currentTime, PDO::PARAM_INT);
            $stmt->execute();

            $itemInfo['likesCount'] = $itemInfo['likesCount'] - 1;
            $itemInfo['like'] = false;

        } else {

            $ip_addr = helper::ip_addr();

            $stmt = $this->db->prepare("INSERT INTO item_likes (fromUserId, itemId, createAt, ip_addr) value (:fromUserId, :itemId, :createAt, :ip_addr)");
            $stmt->bindParam(":fromUserId", $this->requestFrom, PDO::PARAM_INT);
            $stmt->bindParam(":itemId", $item_id, PDO::PARAM_INT);
            $stmt->bindParam(":createAt", $currentTime, PDO::PARAM_INT);
            $stmt->bindParam(":ip_addr", $ip_addr, PDO::PARAM_STR);
            $stmt->execute();

            if ($itemInfo['fromUserId'] != $this->getRequestFrom()) {

                $items = new items($this->db);
                $items->setRequestFrom($itemInfo['fromUserId']);

                if ($items->is_follow($item_id)) {

                    $fcm = new fcm($this->db);
                    $fcm->setRequestFrom($this->getRequestFrom());
                    $fcm->setRequestTo($itemInfo['fromUserId']);
                    $fcm->setType(GCM_NOTIFY_LIKE);
                    $fcm->setTitle("You have new like");
                    $fcm->setItemId($item_id);
                    $fcm->prepare();
                    $fcm->send();
                    unset($fcm);
                }

                unset($items);
            }

            $itemInfo['likesCount'] = $itemInfo['likesCount'] + 1;
            $itemInfo['like'] = true;
        }

        $this->updateCounters($item_id);

        $result = array(
            "error" => false,
            "error_code" => ERROR_SUCCESS,
            "likesCount" => $itemInfo['likesCount'],
            "commentsCount" => $itemInfo['commentsCount'],
            "reportsCount" => $itemInfo['reportsCount'],
            "like" => $itemInfo['like']
        );

        return $result;
    }

    public function is_like($item_id)
    {
        $stmt = $this->db->prepare("SELECT id FROM item_likes WHERE fromUserId = (:fromUserId) AND itemId = (:itemId) AND removeAt = 0 LIMIT 1");
        $stmt->bindParam(":fromUserId", $this->requestFrom, PDO::PARAM_INT);
        $stmt->bindParam(":itemId", $item_id, PDO::PARAM_INT);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {

            return true;
        }

        return false;
    }

    public function getLikesCount($item_id)
    {
        $stmt = $this->db->prepare("SELECT count(*) FROM item_likes WHERE itemId = (:itemId) AND removeAt = 0");
        $stmt->bindParam(":itemId", $item_id, PDO::PARAM_INT);
        $stmt->execute();

        return $number_of_rows = $stmt->fetchColumn();
    }

    public function getCommentsCount($item_id)
    {
        $stmt = $this->db->prepare("SELECT count(*) FROM item_comments WHERE itemId = (:itemId) AND removeAt = 0");
        $stmt->bindParam(":itemId", $item_id, PDO::PARAM_INT);
        $stmt->execute();

        return $number_of_rows = $stmt->fetchColumn();
    }

    public function getReportsCount($item_id)
    {
        $stmt = $this->db->prepare("SELECT count(*) FROM reports WHERE itemId = (:itemId) AND removeAt = 0");
        $stmt->bindParam(":itemId", $item_id, PDO::PARAM_INT);
        $stmt->execute();

        return $number_of_rows = $stmt->fetchColumn();
    }

    public function updateCounters($item_id)
    {
        $result = array(
            "error" => true,
            "error_code" => ERROR_UNKNOWN
        );

        $reportsCount = $this->getReportsCount($item_id);
        $likesCount = $this->getLikesCount($item_id);
        $commentsCount = $this->getCommentsCount($item_id);

        $stmt = $this->db->prepare("UPDATE items SET likesCount = (:likesCount), commentsCount = (:commentsCount), reportsCount = (:reportsCount) WHERE id = (:itemId)");
        $stmt->bindParam(":itemId", $item_id, PDO::PARAM_INT);
        $stmt->bindParam(":likesCount", $likesCount, PDO::PARAM_INT);
        $stmt->bindParam(":commentsCount", $commentsCount, PDO::PARAM_INT);
        $stmt->bindParam(":reportsCount", $reportsCount, PDO::PARAM_INT);

        if ($stmt->execute()) {

            $result = array(
                'error' => false,
                'error_code' => ERROR_SUCCESS
            );
        }

        return $result;
    }

    public function flow($queryText = '', $itemId = 0, $image = 0, $reports = 0, $distance = 3000, $lat = "", $lng = "")
    {
        $originQuery = $queryText;

        $tmpItemId = $itemId;

        if ($itemId == 0) {

            $itemId = 90000000;
            $itemId++;
        }

        $result = array(
            "error" => false,
            "error_code" => ERROR_SUCCESS,
            "itemId" => $itemId,
            "query" => $originQuery,
            "items" => array()
        );

        $origLat = $lat;
        $origLng = $lng;
        $dist = $distance; // This is the maximum distance (in miles) away from $origLat, $origLon in which to search

        $endSql = " having distance < {$dist} ORDER BY id DESC LIMIT 20";
//        $endSql = "  ORDER BY id DESC LIMIT 20";

        $imageSql = "";

        if ($image > 0) {

            $imageSql = " AND imgUrl = ''";
        }

        $reportsSql = "";

        if ($reports > 0) {

            $reportsSql = " AND reportsCount < 10";
        }

        $queryText = "%".$queryText."%";

        $sql = "SELECT *, 3956 * 2 * ASIN(SQRT( POWER(SIN(($origLat - lat)*pi()/180/2),2) + COS($origLat*pi()/180 )* COS(lat*pi()/180) * POWER(SIN(($origLng-lng)*pi()/180/2),2)))
                    as distance FROM items WHERE removeAt = 0 AND post LIKE '{$queryText}' AND id < {$itemId}".$imageSql.$reportsSql.$endSql;
        $stmt = $this->db->prepare($sql);

        if ($stmt->execute()) {

            // if have pinned item

            $settings = new settings($this->db);

            $pinnedItemId = $settings->getIntValue("pinnedItemId");

            if ($pinnedItemId != 0 && $tmpItemId == 0) {

                $items = new items($this->db);
                $items->setRequestFrom($this->getRequestFrom());
                $itemInfo = $this->info($pinnedItemId);
                $itemInfo['distance'] = round($this->getDistance($lat, $lng, $itemInfo['lat'], $itemInfo['lng']), 1);
                $itemInfo['pinned'] = true;
                unset($items);

                array_push($result['items'], $itemInfo);

                $result['itemId'] = $itemInfo['id'];
            }

            unset($settings);

            //

            if ($stmt->rowCount() > 0) {

                while ($row = $stmt->fetch()) {

                    $items = new items($this->db);
                    $items->setRequestFrom($this->getRequestFrom());
                    $itemInfo = $this->quikInfo($row);
                    $itemInfo['distance'] = round($this->getDistance($lat, $lng, $itemInfo['lat'], $itemInfo['lng']), 1);
                    $itemInfo['pinned'] = false;
                    unset($items);

                    array_push($result['items'], $itemInfo);

                    $result['itemId'] = $row['id'];
                }
            }
        }

        return $result;
    }

    public function getDistance($fromLat, $fromLng, $toLat, $toLng) {

        $latFrom = deg2rad($fromLat);
        $lonFrom = deg2rad($fromLng);
        $latTo = deg2rad($toLat);
        $lonTo = deg2rad($toLng);

        $delta = $lonTo - $lonFrom;

        $alpha = pow(cos($latTo) * sin($delta), 2) + pow(cos($latFrom) * sin($latTo) - sin($latFrom) * cos($latTo) * cos($delta), 2);
        $beta = sin($latFrom) * sin($latTo) + cos($latFrom) * cos($latTo) * cos($delta);

        $angle = atan2(sqrt($alpha), $beta);

        return ($angle * 6371000) / 1000;
    }

    public function getFavorites($itemId = 0)
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

        $stmt = $this->db->prepare("SELECT id, itemId FROM item_likes WHERE removeAt = 0 AND id < (:itemId) AND fromUserId = (:fromUserId) ORDER BY id DESC LIMIT 20");
        $stmt->bindParam(':fromUserId', $this->requestFrom, PDO::PARAM_INT);
        $stmt->bindParam(':itemId', $itemId, PDO::PARAM_INT);

        if ($stmt->execute()) {

            if ($stmt->rowCount() > 0) {

                while ($row = $stmt->fetch()) {

                    $item = new items($this->db);
                    $item->setRequestFrom($this->getRequestFrom());
                    $itemInfo = $item->info($row['itemId']);
                    unset($item);

                    array_push($result['items'], $itemInfo);

                    $result['itemId'] = $row['id'];

                    unset($itemInfo);
                }
            }
        }

        return $result;
    }

    public function wall($itemId = 0)
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

        $stmt = $this->db->prepare("SELECT * FROM items WHERE removeAt = 0 AND id < (:itemId) AND fromUserId = (:fromUserId) ORDER BY id DESC LIMIT 20");
        $stmt->bindParam(':fromUserId', $this->requestFrom, PDO::PARAM_INT);
        $stmt->bindParam(':itemId', $itemId, PDO::PARAM_INT);

        if ($stmt->execute()) {

            if ($stmt->rowCount() > 0) {

                while ($row = $stmt->fetch()) {

                    $itemInfo = $this->quikInfo($row);

                    array_push($result['items'], $itemInfo);

                    $result['itemId'] = $row['id'];

                    unset($itemInfo);
                }
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
