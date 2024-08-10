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

class msg extends db_connect
{

	private $requestFrom = 0;
    private $language = 'en';

    // add spam words to this array list

    private $SPAM_LIST_ARRAY = array(
        "069sex",
        "069sex.com",
        "sex.com",
        "321𝓼𝓮𝔁𝓹𝓸𝓵𝓪𝓷𝓭",
        "𝔀𝔀𝔀.006𝓭𝓪𝓽.𝓬𝓸𝓶",
        "I will fulfill your seхual desires");

    private $COLORS_ARRAY = array();
    private $ICONS_ARRAY = array();

	public function __construct($dbo = NULL, $COLORS_ARRAY = array(), $ICONS_ARRAY = array())
    {
		parent::__construct($dbo);

        $this->COLORS_ARRAY = $COLORS_ARRAY;
        $this->ICONS_ARRAY = $ICONS_ARRAY;
	}

    public function myActiveChatsCount()
    {
        $stmt = $this->db->prepare("SELECT count(*) FROM chats WHERE (fromUserId = (:userId) OR toUserId = (:userId)) AND removeAt = 0");
        $stmt->bindParam(":userId", $this->requestFrom, PDO::PARAM_INT);
        $stmt->execute();

        return $number_of_rows = $stmt->fetchColumn();
    }

    public function myActiveMessagesCount()
    {
        $stmt = $this->db->prepare("SELECT count(*) FROM messages WHERE fromUserId = (:fromUserId) AND removeAt = 0");
        $stmt->bindParam(":fromUserId", $this->requestFrom, PDO::PARAM_INT);
        $stmt->execute();

        return $number_of_rows = $stmt->fetchColumn();
    }

    public function messagesCountByChat($chatId)
    {
        $stmt = $this->db->prepare("SELECT count(*) FROM messages WHERE chatId = (:chatId) AND removeAt = 0");
        $stmt->bindParam(":chatId", $chatId, PDO::PARAM_INT);
        $stmt->execute();

        return $number_of_rows = $stmt->fetchColumn();
    }

    public function createChat($fromUserId, $toUserId, $itemId)
    {
        $colorId = rand(0, count($this->COLORS_ARRAY) - 1);
        $iconId = rand(0, count($this->ICONS_ARRAY) - 1);

        $chatId = 0;

        $currentTime = time();

        $stmt = $this->db->prepare("INSERT INTO chats (fromUserId, toUserId, itemId, colorId, iconId, fromUserId_lastView, createAt) value (:fromUserId, :toUserId, :itemId, :colorId, :iconId, :fromUserId_lastView, :createAt)");
        $stmt->bindParam(":fromUserId", $fromUserId, PDO::PARAM_INT);
        $stmt->bindParam(":toUserId", $toUserId, PDO::PARAM_INT);
        $stmt->bindParam(":fromUserId_lastView", $currentTime, PDO::PARAM_INT);
        $stmt->bindParam(":itemId", $itemId, PDO::PARAM_INT);
        $stmt->bindParam(":colorId", $colorId, PDO::PARAM_INT);
        $stmt->bindParam(":iconId", $iconId, PDO::PARAM_INT);
        $stmt->bindParam(":createAt", $currentTime, PDO::PARAM_INT);

        if ($stmt->execute()) {

            $chatId = $this->db->lastInsertId();
        }

        return $chatId;
    }

    public function getChatId($fromUserId, $toUserId, $itemId) {

        $chatId = 0;

        $stmt = $this->db->prepare("SELECT id FROM chats WHERE removeAt = 0 AND itemId = (:itemId) AND ((fromUserId = (:fromUserId) AND toUserId = (:toUserId)) OR (fromUserId = (:toUserId) AND toUserId = (:fromUserId))) LIMIT 1");
        $stmt->bindParam(":itemId", $itemId, PDO::PARAM_INT);
        $stmt->bindParam(":fromUserId", $fromUserId, PDO::PARAM_INT);
        $stmt->bindParam(":toUserId", $toUserId, PDO::PARAM_INT);

        if ($stmt->execute()) {

            if ($stmt->rowCount() > 0) {

                $row = $stmt->fetch();

                $chatId = $row['id'];
            }
        }

        return $chatId;
    }

    public function create($toUserId, $chatId, $itemId,  $message = "", $imgUrl = "", $chatFromUserId = 0, $chatToUserId = 0, $listId = 0, $stickerId = 0, $stickerImgUrl = "")
    {
        $result = array(
            "error" => true,
            "error_code" => ERROR_UNKNOWN
        );

        //$message = mb_convert_encoding($message, 'ISO-8859-5', 'UTF-8');

        if (strlen($imgUrl) == 0 && strlen($message) == 0 && strlen($stickerImgUrl) == 0) {

            return $result;
        }

        if (strlen($stickerImgUrl) > 0) {

            $imgUrl = $stickerImgUrl;
        }

        if (strlen($imgUrl) != 0 && strpos($imgUrl, APP_HOST) === false) {

            return $result;
        }

        if ($this->checkSpam($message, $this->SPAM_LIST_ARRAY)) {

            return $result;
        }

        if ($chatId == 0) {

            $chatId = $this->getChatId($this->getRequestFrom(), $toUserId, $itemId);

            if ($chatId == 0) {

                $chatId = $this->createChat($this->getRequestFrom(), $toUserId, $itemId);

                $chatInfo = $this->chatInfo($chatId);
            }
        }

        $result['chatId'] = $chatId;

        $currentTime = time();
        $ip_addr = helper::ip_addr();
        $u_agent = helper::u_agent();

        $stmt = $this->db->prepare("INSERT INTO messages (chatId, fromUserId, toUserId, message, imgUrl, stickerId, stickerImgUrl, createAt, ip_addr, u_agent) value (:chatId, :fromUserId, :toUserId, :message, :imgUrl, :stickerId, :stickerImgUrl, :createAt, :ip_addr, :u_agent)");
        $stmt->bindParam(":chatId", $chatId, PDO::PARAM_INT);
        $stmt->bindParam(":fromUserId", $this->requestFrom, PDO::PARAM_INT);
        $stmt->bindParam(":toUserId", $toUserId, PDO::PARAM_INT);
        $stmt->bindParam(":message", $message, PDO::PARAM_STR);
        $stmt->bindParam(":imgUrl", $imgUrl, PDO::PARAM_STR);
        $stmt->bindParam(":stickerId", $stickerId, PDO::PARAM_INT);
        $stmt->bindParam(":stickerImgUrl", $stickerImgUrl, PDO::PARAM_STR);
        $stmt->bindParam(":createAt", $currentTime, PDO::PARAM_INT);
        $stmt->bindParam(":ip_addr", $ip_addr, PDO::PARAM_STR);
        $stmt->bindParam(":u_agent", $u_agent, PDO::PARAM_STR);

        if ($stmt->execute()) {

            $msgId = $this->db->lastInsertId();

            $result = array(
                "error" => false,
                "error_code" => ERROR_SUCCESS,
                "chatId" => $chatId,
                "listId" => $listId,
                "msgId" => $msgId,
                "message" => array()
            );

            if (isset($chatInfo)) {

                $result['color'] = $chatInfo['color'];
                $result['colorName'] = $chatInfo['colorName'];
                $result['icon'] = $chatInfo['icon'];
                $result['iconUrl'] = $chatInfo['iconUrl'];
                $result['blocked'] = $chatInfo['blocked'];
            }

            $time = new language($this->db, $this->language);

            $msgInfo = array(
                "error" => false,
                "error_code" => ERROR_SUCCESS,
                "id" => $msgId,
                "fromUserId" => $this->requestFrom,
                "message" => htmlspecialchars_decode(stripslashes($message)),
                "imgUrl" => $imgUrl,
                "stickerId" => $stickerId,
                "stickerImgUrl" => $stickerImgUrl,
                "createAt" => $currentTime,
                "seenAt" => 0,
                "date" => date("Y-m-d H:i:s", $currentTime),
                "timeAgo" => $time->timeAgo($currentTime),
                "removeAt" => 0
            );

            $result['message'] = $msgInfo;

            $fcm = new fcm($this->db);
            $fcm->setRequestFrom($this->getRequestFrom());
            $fcm->setRequestTo($toUserId);
            $fcm->setType(GCM_NOTIFY_MESSAGE);
            $fcm->setTitle("You have new message");
            $fcm->setItemId($chatId);
            $fcm->setMessage($msgInfo);
            $fcm->prepare();
            $fcm->send();
            unset($fcm);

            // Update Chat Data

            if ($chatFromUserId != 0 && $chatToUserId != 0) {

                $profileId = $chatFromUserId;

                if ($profileId == $this->getRequestFrom()) {

                    $this->setLastMessageInChat_FromId($chatId, $currentTime, $msgInfo['message'], $msgInfo['imgUrl'], $msgInfo['stickerImgUrl']);

                } else {

                    $this->setLastMessageInChat_ToId($chatId, $currentTime, $msgInfo['message'], $msgInfo['imgUrl'], $msgInfo['stickerImgUrl']);
                }


            } else {

                $chatInfo = $this->chatInfo($chatId);

                $profileId = $chatInfo['fromUserId'];

                if ($profileId == $this->getRequestFrom()) {

                    $this->setLastMessageInChat_FromId($chatId, $currentTime, $msgInfo['message'], $msgInfo['imgUrl'], $msgInfo['stickerImgUrl']);

                } else {

                    $this->setLastMessageInChat_ToId($chatId, $currentTime, $msgInfo['message'], $msgInfo['imgUrl'], $msgInfo['stickerImgUrl']);
                }
            }
        }

        return $result;
    }

    private function checkSpam($str, array $arr)
    {
        foreach($arr as $a) {

            if (stripos($str, $a) !== false) return true;
        }

        return false;
    }

    public function setLastMessageInChat_FromId($chatId, $time, $message, $image, $sticker = "") {

        if (strlen($image) > 0 && strlen($message) == 0) {

            $message = "Image";
        }

        if (strlen($sticker) > 0) {

            $message = "Sticker";
        }

        $stmt = $this->db->prepare("UPDATE chats SET message = (:message), messageCreateAt = (:messageCreateAt), fromUserId_lastView = (:fromUserId_lastView) WHERE id = (:chatId)");
        $stmt->bindParam(":messageCreateAt", $time, PDO::PARAM_INT);
        $stmt->bindParam(":message", $message, PDO::PARAM_STR);
        $stmt->bindParam(':chatId', $chatId, PDO::PARAM_INT);
        $stmt->bindParam(":fromUserId_lastView", $time, PDO::PARAM_INT);
        $stmt->execute();
    }

    public function setLastMessageInChat_ToId($chatId, $time, $message, $image, $sticker = "") {

        if (strlen($image) > 0 && strlen($message) == 0) {

            $message = "Image";
        }

        if (strlen($sticker) > 0) {

            $message = "Sticker";
        }

        $stmt = $this->db->prepare("UPDATE chats SET message = (:message), messageCreateAt = (:messageCreateAt), toUserId_lastView = (:toUserId_lastView) WHERE id = (:chatId)");
        $stmt->bindParam(":messageCreateAt", $time, PDO::PARAM_INT);
        $stmt->bindParam(":message", $message, PDO::PARAM_STR);
        $stmt->bindParam(':chatId', $chatId, PDO::PARAM_INT);
        $stmt->bindParam(":toUserId_lastView", $time, PDO::PARAM_INT);
        $stmt->execute();
    }

    public function setChatLastView_FromId($chatId) {

        $result = array("error" => true,
                        "error_code" => ERROR_UNKNOWN);

        $currentTime = time();

        $stmt = $this->db->prepare("UPDATE chats SET fromUserId_lastView = (:fromUserId_lastView) WHERE id = (:chatId)");
        $stmt->bindParam(":chatId", $chatId, PDO::PARAM_INT);
        $stmt->bindParam(":fromUserId_lastView", $currentTime, PDO::PARAM_INT);

        if ($stmt->execute()) {

            $result = array("error" => false,
                            "error_code" => ERROR_SUCCESS);
        }

        return $result;
    }

    public function setChatLastView_ToId($chatId) {

        $result = array("error" => true,
                        "error_code" => ERROR_UNKNOWN);

        $currentTime = time();

        $stmt = $this->db->prepare("UPDATE chats SET toUserId_lastView = (:toUserId_lastView) WHERE id = (:chatId)");
        $stmt->bindParam(":chatId", $chatId, PDO::PARAM_INT);
        $stmt->bindParam(":toUserId_lastView", $currentTime, PDO::PARAM_INT);

        if ($stmt->execute()) {

            $result = array("error" => false,
                            "error_code" => ERROR_SUCCESS);
        }

        return $result;
    }

    public function removeChatsByAccountId($accountId)
    {

        $result = array(
            "error" => true,
            "error_code" => ERROR_UNKNOWN
        );

        $stmt = $this->db->prepare("SELECT id FROM chats WHERE fromUserId = (:fromUserId) AND removeAt = 0");
        $stmt->bindParam(':fromUserId', $accountId, PDO::PARAM_INT);

        if ($stmt->execute()) {

            while ($row = $stmt->fetch()) {

                $this->removeChat($row['id']);
            }

            $result = array(
                "error" => false,
                "error_code" => ERROR_SUCCESS
            );
        }

        return $result;
    }

    public function removeChat($chatId) {

        $result = array(
            "error" => true,
            "error_code" => ERROR_UNKNOWN
        );

        $currentTime = time();

        $stmt = $this->db->prepare("UPDATE chats SET removeAt = (:removeAt) WHERE id = (:chatId)");
        $stmt->bindParam(":chatId", $chatId, PDO::PARAM_INT);
        $stmt->bindParam(":removeAt", $currentTime, PDO::PARAM_INT);

        if ($stmt->execute()) {

            $stmt2 = $this->db->prepare("UPDATE messages SET removeAt = (:removeAt) WHERE chatId = (:chatId)");
            $stmt2->bindParam(":chatId", $chatId, PDO::PARAM_INT);
            $stmt2->bindParam(":removeAt", $currentTime, PDO::PARAM_INT);
            $stmt2->execute();

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
            "error_code" => ERROR_UNKNOWN
        );

        $currentTime = time();

        $stmt = $this->db->prepare("UPDATE messages SET removeAt = (:removeAt) WHERE id = (:itemId)");
        $stmt->bindParam(":itemId", $itemId, PDO::PARAM_INT);
        $stmt->bindParam(":removeAt", $currentTime, PDO::PARAM_INT);

        if ($stmt->execute()) {

            $result = array(
                "error" => false,
                "error_code" => ERROR_SUCCESS
            );
        }

        return $result;
    }

    public function getNewMessagesInChat($chatId, $fromUserId, $fromUserId_lastView, $toUserId_lastView) {

        $profileId = $fromUserId;

        if ($profileId == $this->getRequestFrom()) {

            $stmt = $this->db->prepare("SELECT count(*) FROM messages WHERE chatId = (:chatId) AND fromUserId <> (:fromUserId) AND createAt > (:fromUserId_lastView) AND removeAt = 0");
            $stmt->bindParam(':chatId', $chatId, PDO::PARAM_INT);
            $stmt->bindParam(':fromUserId', $this->requestFrom, PDO::PARAM_INT);
            $stmt->bindParam(':fromUserId_lastView', $fromUserId_lastView, PDO::PARAM_INT);

        } else {

            $stmt = $this->db->prepare("SELECT count(*) FROM messages WHERE chatId = (:chatId) AND fromUserId <> (:fromUserId) AND createAt > (:toUserId_lastView) AND removeAt = 0");
            $stmt->bindParam(':chatId', $chatId, PDO::PARAM_INT);
            $stmt->bindParam(':fromUserId', $this->requestFrom, PDO::PARAM_INT);
            $stmt->bindParam(':toUserId_lastView', $toUserId_lastView, PDO::PARAM_INT);
        }

        if ($stmt->execute()) {

            return $number_of_rows = $stmt->fetchColumn();
        }

        return 0;
    }

    public function chatInfo($chatId)
    {
        $result = array(
            "error" => true,
            "error_code" => ERROR_UNKNOWN
        );

        $stmt = $this->db->prepare("SELECT * FROM chats WHERE id = (:chatId) LIMIT 1");
        $stmt->bindParam(":chatId", $chatId, PDO::PARAM_INT);

        if ($stmt->execute()) {

            if ($stmt->rowCount() > 0) {

                $row = $stmt->fetch();

                $time = new language($this->db, $this->language);

                $new_messages_count = 0;

                if (APP_MESSAGES_COUNTERS) {

                    $new_messages_count = $this->getNewMessagesInChat($chatId, $row['fromUserId'], $row['fromUserId_lastView'], $row['toUserId_lastView']);
                }

                $blocked = false;
                $blockedId = $row['fromUserId'];

                if ($this->getRequestFrom() == $row['fromUserId']) {

                    $blockedId = $row['toUserId'];
                }

                $blacklist = new blacklist($this->db);
                $blacklist->setRequestFrom($this->getRequestFrom());

                if ($blacklist->isExists($blockedId)) {

                    $blocked = true;
                }

                unset($blacklist);

                $result = array(
                    "error" => false,
                    "error_code" => ERROR_SUCCESS,
                    "blocked" => $blocked,
                    "id" => $row['id'],
                    "fromUserId" => $row['fromUserId'],
                    "toUserId" => $row['toUserId'],
                    "color" => $this->COLORS_ARRAY[$row['colorId']]['color'],
                    "colorName" => $this->COLORS_ARRAY[$row['colorId']]['name'],
                    "icon" => $this->ICONS_ARRAY[$row['iconId']]['name'],
                    "iconUrl" => $this->ICONS_ARRAY[$row['iconId']]['url'],
                    "fromUserId_lastView" => $row['fromUserId_lastView'],
                    "toUserId_lastView" => $row['toUserId_lastView'],
                    "lastMessage" => $row['message'],
                    "lastMessageAgo" => $time->timeAgo($row['messageCreateAt']),
                    "lastMessageCreateAt" => $row['messageCreateAt'],
                    "newMessagesCount" => $new_messages_count,
                    "createAt" => $row['createAt'],
                    "date" => date("Y-m-d H:i:s", $row['createAt']),
                    "timeAgo" => $time->timeAgo($row['createAt']),
                    "removeAt" => $row['removeAt']
                );
            }
        }

        return $result;
    }

    public function chatInfoShort($chatId)
    {
        $result = array("error" => true,
                        "error_code" => ERROR_UNKNOWN);

        $stmt = $this->db->prepare("SELECT * FROM chats WHERE id = (:chatId) LIMIT 1");
        $stmt->bindParam(":chatId", $chatId, PDO::PARAM_INT);

        if ($stmt->execute()) {

            if ($stmt->rowCount() > 0) {

                $row = $stmt->fetch();

                $result = array("error" => false,
                    "error_code" => ERROR_SUCCESS,
                    "id" => $row['id'],
                    "fromUserId" => $row['fromUserId'],
                    "toUserId" => $row['toUserId'],
                    "fromUserId_lastView" => $row['fromUserId_lastView'],
                    "toUserId_lastView" => $row['toUserId_lastView'],
                    "createAt" => $row['createAt'],
                    "removeAt" => $row['removeAt']);

                unset($profileInfo);
            }
        }

        return $result;
    }

    public function info($msgId)
    {
        $result = array("error" => true,
                        "error_code" => ERROR_UNKNOWN);

        $stmt = $this->db->prepare("SELECT * FROM messages WHERE id = (:msgId) LIMIT 1");
        $stmt->bindParam(":msgId", $msgId, PDO::PARAM_INT);

        if ($stmt->execute()) {

            if ($stmt->rowCount() > 0) {

                $row = $stmt->fetch();

                $time = new language($this->db, $this->language);

                $profile = new account($this->db, $row['fromUserId']);
                $profileInfo = $profile->get();
                unset($profile);

                $result = array("error" => false,
                                "error_code" => ERROR_SUCCESS,
                                "id" => $row['id'],
                                "fromUserId" => $row['fromUserId'],
                                "fromUserState" => $profileInfo['state'],
                                "fromUserVerify" => $profileInfo['verified'],
                                "fromUserUsername" => $profileInfo['username'],
                                "fromUserFullname" => $profileInfo['fullname'],
                                "fromUserPhotoUrl" => $profileInfo['lowPhotoUrl'],
                                "message" => htmlspecialchars_decode(stripslashes($row['message'])),
                                "imgUrl" => $row['imgUrl'],
                                "stickerId" => $row['stickerId'],
                                "stickerImgUrl" => $row['stickerImgUrl'],
                                "seenAt" => $row['seenAt'],
                                "createAt" => $row['createAt'],
                                "date" => date("Y-m-d H:i:s", $row['createAt']),
                                "timeAgo" => $time->timeAgo($row['createAt']),
                                "removeAt" => $row['removeAt']);
            }
        }

        return $result;
    }

    public function getDialogs_new($messageCreateAt = 0)
    {
        if ($messageCreateAt == 0) {

            $messageCreateAt = time() + 10;
        }

        $chats = array(
            "error" => false,
            "error_code" => ERROR_SUCCESS,
            "messageCreateAt" => $messageCreateAt,
            "items" => array()
        );

        $stmt = $this->db->prepare("SELECT * FROM chats WHERE (fromUserId = (:userId) OR toUserId = (:userId)) AND messageCreateAt < (:messageCreateAt) AND removeAt = 0 ORDER BY messageCreateAt DESC LIMIT 20");
        $stmt->bindParam(':messageCreateAt', $messageCreateAt, PDO::PARAM_INT);
        $stmt->bindParam(':userId', $this->requestFrom, PDO::PARAM_INT);

        if ($stmt->execute()) {

            while ($row = $stmt->fetch()) {

                $time = new language($this->db, $this->language);

                $profileId = $row['fromUserId'];

                $new_messages_count = 0;

                if (APP_MESSAGES_COUNTERS) {

                    $new_messages_count = $this->getNewMessagesInChat($row['id'], $row['fromUserId'], $row['fromUserId_lastView'], $row['toUserId_lastView']);
                }

                $chatInfo = array(
                    "error" => false,
                    "error_code" => ERROR_SUCCESS,
                    "id" => $row['id'],
                    "itemId" => $row['itemId'],
                    "color" => $this->COLORS_ARRAY[$row['colorId']]['color'],
                    "colorName" => $this->COLORS_ARRAY[$row['colorId']]['name'],
                    "icon" => $this->ICONS_ARRAY[$row['iconId']]['name'],
                    "iconUrl" => $this->ICONS_ARRAY[$row['iconId']]['url'],
                    "fromUserId" => $row['fromUserId'],
                    "toUserId" => $row['toUserId'],
                    "fromUserId_lastView" => $row['fromUserId_lastView'],
                    "toUserId_lastView" => $row['toUserId_lastView'],
                    "lastMessage" => $row['message'],
                    "lastMessageAgo" => $time->timeAgo($row['messageCreateAt']),
                    "lastMessageCreateAt" => $row['messageCreateAt'],
                    "newMessagesCount" => $new_messages_count,
                    "createAt" => $row['createAt'],
                    "date" => date("Y-m-d H:i:s", $row['createAt']),
                    "timeAgo" => $time->timeAgo($row['createAt']),
                    "removeAt" => $row['removeAt']
                );

                array_push($chats['items'], $chatInfo);

                $chats['messageCreateAt'] = $chatInfo['lastMessageCreateAt'];

                unset($chatInfo);
            }
        }

        return $chats;
    }

    public function getNewMessagesCount()
    {
        $count = 0;

        $stmt = $this->db->prepare("SELECT id, fromUserId, fromUserId_lastView, toUserId_lastView FROM chats WHERE (fromUserId = (:userId) OR toUserId = (:userId)) AND removeAt = 0");
        $stmt->bindParam(':userId', $this->requestFrom, PDO::PARAM_INT);

        if ($stmt->execute()) {

            while ($row = $stmt->fetch()) {

                $new_messages = $this->getNewMessagesInChat($row['id'], $row['fromUserId'], $row['fromUserId_lastView'], $row['toUserId_lastView']);

                if ($new_messages != 0) {

                    $count++;
                }
            }
        }

        return $count;
    }

    public function getPreviousMessages($chatId, $msgId = 0)
    {
        $messages = array("error" => false,
                          "error_code" => ERROR_SUCCESS,
                          "chatId" => $chatId,
                          "msgId" => $msgId,
                          "messages" => array());

        $stmt = $this->db->prepare("SELECT * FROM messages WHERE chatId = (:chatId) AND id < (:msgId) AND removeAt = 0 ORDER BY id DESC LIMIT 20");
        $stmt->bindParam(':chatId', $chatId, PDO::PARAM_INT);
        $stmt->bindParam(':msgId', $msgId, PDO::PARAM_INT);

        if ($stmt->execute()) {

            while ($row = $stmt->fetch()) {

                $time = new language($this->db, $this->language);

                $msgInfo = array("error" => false,
                                 "error_code" => ERROR_SUCCESS,
                                 "id" => $row['id'],
                                 "fromUserId" => $row['fromUserId'],
                                 "message" => htmlspecialchars_decode(stripslashes($row['message'])),
                                 "imgUrl" => $row['imgUrl'],
                                 "stickerId" => $row['stickerId'],
                                 "stickerImgUrl" => $row['stickerImgUrl'],
                                 "seenAt" => $row['seenAt'],
                                 "createAt" => $row['createAt'],
                                 "date" => date("Y-m-d H:i:s", $row['createAt']),
                                 "timeAgo" => $time->timeAgo($row['createAt']),
                                 "removeAt" => $row['removeAt']);

                array_push($messages['messages'], $msgInfo);

                $messages['msgId'] = $msgInfo['id'];

                unset($msgInfo);
            }
        }

        return $messages;
    }

    public function getNextMessages($chatId, $msgId = 0)
    {
        $messages = array("error" => false,
                          "error_code" => ERROR_SUCCESS,
                          "chatId" => $chatId,
                          "msgId" => $msgId,
                          "messages" => array());

        $stmt = $this->db->prepare("SELECT * FROM messages WHERE chatId = (:chatId) AND id > (:msgId) AND removeAt = 0 ORDER BY id ASC");
        $stmt->bindParam(':chatId', $chatId, PDO::PARAM_INT);
        $stmt->bindParam(':msgId', $msgId, PDO::PARAM_INT);

        if ($stmt->execute()) {

            while ($row = $stmt->fetch()) {

                $time = new language($this->db, $this->language);

                $profile = new account($this->db, $row['fromUserId']);
                $profileInfo = $profile->get();
                unset($profile);

                $msgInfo = array("error" => false,
                                 "error_code" => ERROR_SUCCESS,
                                 "id" => $row['id'],
                                 "fromUserId" => $row['fromUserId'],
                                 "fromUserState" => $profileInfo['state'],     //$profileInfo['state'],
                                 "fromUserVerify" => $profileInfo['verified'],     //$profileInfo['verify'],
                                 "fromUserUsername" => $profileInfo['username'], //$profileInfo['username']
                                 "fromUserFullname" => $profileInfo['fullname'], //$profileInfo['fullname']
                                 "fromUserPhotoUrl" => $profileInfo['lowPhotoUrl'], //$profileInfo['lowPhotoUrl']
                                 "message" => htmlspecialchars_decode(stripslashes($row['message'])),
                                 "imgUrl" => $row['imgUrl'],
                                 "stickerId" => $row['stickerId'],
                                 "stickerImgUrl" => $row['stickerImgUrl'],
                                 "createAt" => $row['createAt'],
                                 "seenAt" => $row['seenAt'],
                                 "date" => date("Y-m-d H:i:s", $row['createAt']),
                                 "timeAgo" => $time->timeAgo($row['createAt']),
                                 "removeAt" => $row['removeAt']);

                array_push($messages['messages'], $msgInfo);

                $messages['msgId'] = $msgInfo['id'];

                unset($msgInfo);
            }
        }

        return $messages;
    }

    public function setSeen($chatId, $fromUser) {

        $result = array("error" => true,
                        "error_code" => ERROR_UNKNOWN);

        $currentTime = time();

        $stmt = $this->db->prepare("UPDATE messages SET seenAt = (:seenAt) WHERE chatId = (:chatId) AND fromUserId = (:fromUserId) AND removeAt = 0 AND seenAt = 0");
        $stmt->bindParam(":seenAt", $currentTime, PDO::PARAM_INT);
        $stmt->bindParam(":chatId", $chatId, PDO::PARAM_INT);
        $stmt->bindParam(":fromUserId", $fromUser, PDO::PARAM_INT);

        if ($stmt->execute()) {

            $result = array("error" => false,
                            "error_code" => ERROR_SUCCESS);
        }

        return $result;
    }

    public function get($chatId, $msgId = 0, $chatFromUserId = 0, $chatToUserId = 0)
    {
        if ($msgId == 0) {

            $msgId = 1000000;
            $msgId++;
        }

        $chatInfo = $this->chatInfo($chatId);

        $chatFromUserId = $chatInfo['fromUserId'];
        $chatToUserId = $chatInfo['toUserId'];

        $messages = array(
            "error" => false,
            "error_code" => ERROR_SUCCESS,
            "blocked" => $chatInfo['blocked'],
            "chatId" => $chatId,
            "messagesCount" => $this->messagesCountByChat($chatId),
            "msgId" => $msgId,
            "chatFromUserId" => $chatFromUserId,
            "chatToUserId" => $chatToUserId,
            "color" => $chatInfo['color'],
            "colorName" => $chatInfo['colorName'],
            "icon" => $chatInfo['icon'],
            "iconUrl" => $chatInfo['iconUrl'],
            "newMessagesCount" => 0,
            "messages" => array()
        );

        $stmt = $this->db->prepare("SELECT * FROM messages WHERE chatId = (:chatId) AND id < (:msgId) AND removeAt = 0 ORDER BY id DESC LIMIT 20");
        $stmt->bindParam(':chatId', $chatId, PDO::PARAM_INT);
        $stmt->bindParam(':msgId', $msgId, PDO::PARAM_INT);

        if ($stmt->execute()) {

            while ($row = $stmt->fetch()) {

                $time = new language($this->db, $this->language);

                $msgInfo = array(
                    "error" => false,
                    "error_code" => ERROR_SUCCESS,
                    "id" => $row['id'],
                    "fromUserId" => $row['fromUserId'],
                    "message" => htmlspecialchars_decode(stripslashes($row['message'])),
                    "imgUrl" => $row['imgUrl'],
                    "stickerId" => $row['stickerId'],
                    "stickerImgUrl" => $row['stickerImgUrl'],
                    "seenAt" => $row['seenAt'],
                    "createAt" => $row['createAt'],
                    "date" => date("Y-m-d H:i:s", $row['createAt']),
                    "timeAgo" => $time->timeAgo($row['createAt']),
                    "removeAt" => $row['removeAt']
                );

                array_push($messages['messages'], $msgInfo);

                $messages['msgId'] = $msgInfo['id'];

                unset($msgInfo);
            }
        }

        return $messages;
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

        $stmt = $this->db->prepare("SELECT * FROM messages WHERE id < (:itemId) AND fromUserId = (:fromUserId) AND removeAt = 0 ORDER BY id DESC LIMIT 20");
        $stmt->bindParam(':itemId', $itemId, PDO::PARAM_INT);
        $stmt->bindParam(':fromUserId', $this->requestFrom, PDO::PARAM_INT);

        if ($stmt->execute()) {

            while ($row = $stmt->fetch()) {

                $time = new language($this->db, $this->language);

                $itemInfo = array(
                    "error" => false,
                    "error_code" => ERROR_SUCCESS,
                    "id" => $row['id'],
                    "fromUserId" => $row['fromUserId'],
                    "message" => htmlspecialchars_decode(stripslashes($row['message'])),
                    "imgUrl" => $row['imgUrl'],
                    "stickerId" => $row['stickerId'],
                    "stickerImgUrl" => $row['stickerImgUrl'],
                    "seenAt" => $row['seenAt'],
                    "createAt" => $row['createAt'],
                    "date" => date("Y-m-d H:i:s", $row['createAt']),
                    "timeAgo" => $time->timeAgo($row['createAt']),
                    "removeAt" => $row['removeAt']
                );

                array_push($result['items'], $itemInfo);

                $result['itemId'] = $itemInfo['id'];

                unset($itemInfo);
            }
        }

        return $result;
    }

    public function getStream($itemId = 0)
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

        $stmt = $this->db->prepare("SELECT * FROM messages WHERE id < (:itemId) AND removeAt = 0 ORDER BY id DESC LIMIT 20");
        $stmt->bindParam(':itemId', $itemId, PDO::PARAM_INT);

        if ($stmt->execute()) {

            if ($stmt->rowCount() > 0) {

                while ($row = $stmt->fetch()) {

                    $time = new language($this->db, $this->language);

                    $itemInfo = array(
                        "error" => false,
                        "error_code" => ERROR_SUCCESS,
                        "id" => $row['id'],
                        "fromUserId" => $row['fromUserId'],
                        "message" => htmlspecialchars_decode(stripslashes($row['message'])),
                        "imgUrl" => $row['imgUrl'],
                        "stickerId" => $row['stickerId'],
                        "stickerImgUrl" => $row['stickerImgUrl'],
                        "seenAt" => $row['seenAt'],
                        "createAt" => $row['createAt'],
                        "date" => date("Y-m-d H:i:s", $row['createAt']),
                        "timeAgo" => $time->timeAgo($row['createAt']),
                        "removeAt" => $row['removeAt']
                    );

                    array_push($result['items'], $itemInfo);

                    $result['itemId'] = $itemInfo['id'];

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
