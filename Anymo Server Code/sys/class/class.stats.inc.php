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

class stats extends db_connect
{
    private $requestFrom = 0;

    public function __construct($dbo = NULL)
    {
        parent::__construct($dbo);

    }

    public function getChatsCount()
    {
        $stmt = $this->db->prepare("SELECT count(*) FROM chats WHERE removeAt = 0");
        $stmt->execute();

        return $number_of_rows = $stmt->fetchColumn();
    }

    public function getChatsTotal()
    {
        $stmt = $this->db->prepare("SELECT count(*) FROM chats");
        $stmt->execute();

        return $number_of_rows = $stmt->fetchColumn();
    }

    public function getMessagesCount()
    {
        $stmt = $this->db->prepare("SELECT count(*) FROM messages WHERE removeAt = 0");
        $stmt->execute();

        return $number_of_rows = $stmt->fetchColumn();
    }

    public function getMessagesTotal()
    {
        $stmt = $this->db->prepare("SELECT count(*) FROM messages");
        $stmt->execute();

        return $number_of_rows = $stmt->fetchColumn();
    }

    public function getItemsCount()
    {
        $stmt = $this->db->prepare("SELECT count(*) FROM items WHERE removeAt = 0");
        $stmt->execute();

        return $number_of_rows = $stmt->fetchColumn();
    }

    public function getItemsTotal()
    {
        $stmt = $this->db->prepare("SELECT count(*) FROM items");
        $stmt->execute();

        return $number_of_rows = $stmt->fetchColumn();
    }

    public function getCommentsCount()
    {
        $stmt = $this->db->prepare("SELECT count(*) FROM item_comments WHERE removeAt = 0");
        $stmt->execute();

        return $number_of_rows = $stmt->fetchColumn();
    }

    public function getCommentsTotal()
    {
        $stmt = $this->db->prepare("SELECT count(*) FROM item_comments");
        $stmt->execute();

        return $number_of_rows = $stmt->fetchColumn();
    }

    public function getLikesCount()
    {
        $stmt = $this->db->prepare("SELECT count(*) FROM item_likes WHERE removeAt = 0");
        $stmt->execute();

        return $number_of_rows = $stmt->fetchColumn();
    }

    public function getLikesTotal()
    {
        $stmt = $this->db->prepare("SELECT count(*) FROM item_likes");
        $stmt->execute();

        return $number_of_rows = $stmt->fetchColumn();
    }

    public function getUserItemsCount($accountId)
    {
        $stmt = $this->db->prepare("SELECT count(*) FROM items WHERE removeAt = 0 AND fromUserId = (:accountId)");
        $stmt->bindParam(":accountId", $accountId, PDO::PARAM_INT);
        $stmt->execute();

        return $number_of_rows = $stmt->fetchColumn();
    }

    public function getUserItemsTotal($accountId)
    {
        $stmt = $this->db->prepare("SELECT count(*) FROM items WHERE fromUserId = (:accountId)");
        $stmt->bindParam(":accountId", $accountId, PDO::PARAM_INT);
        $stmt->execute();

        return $number_of_rows = $stmt->fetchColumn();
    }

    public function getUsersCount()
    {
        $stmt = $this->db->prepare("SELECT count(*) FROM users");
        $stmt->execute();

        return $number_of_rows = $stmt->fetchColumn();
    }

    public function getUsersCountByState($accountState)
    {
        $stmt = $this->db->prepare("SELECT count(*) FROM users WHERE state = (:state)");
        $stmt->bindParam(":state", $accountState, PDO::PARAM_INT);
        $stmt->execute();

        return $number_of_rows = $stmt->fetchColumn();
    }

    public function getAccountsCountByAdmob($value)
    {
        $stmt = $this->db->prepare("SELECT count(*) FROM users WHERE admob = (:admob)");
        $stmt->bindParam(":admob", $value, PDO::PARAM_INT);
        $stmt->execute();

        return $number_of_rows = $stmt->fetchColumn();
    }

    public function getAccounts($userId = 0)
    {
        if ($userId == 0) {

            $userId = 10000000;
            $userId++;
        }

        $users = array(
            "error" => false,
            "error_code" => ERROR_SUCCESS,
            "userId" => $userId,
            "users" => array()
        );

        $stmt = $this->db->prepare("SELECT id FROM users WHERE id < (:userId) ORDER BY id DESC LIMIT 20");
        $stmt->bindParam(':userId', $userId, PDO::PARAM_INT);

        if ($stmt->execute()) {

            while ($row = $stmt->fetch()) {

                $account = new account($this->db, $row['id']);

                $accountInfo = $account->get();

                array_push($users['users'], $accountInfo);

                $users['userId'] = $accountInfo['id'];

                unset($accountInfo);
            }
        }

        return $users;
    }

    public function searchAccounts($userId = 0, $query = "")
    {
        if ($userId == 0) {

            $userId = 10000000;
            $userId++;
        }

        $users = array(
            "error" => false,
            "error_code" => ERROR_SUCCESS,
            "userId" => $userId,
            "query" => $query,
            "users" => array()
        );

        $searchText = '%'.$query.'%';

        $stmt = $this->db->prepare("SELECT id FROM users WHERE id < (:userId) AND login LIKE (:query) OR email LIKE (:query) OR fullname LIKE (:query) OR otpPhone LIKE (:query) ORDER BY id DESC LIMIT 100");
        $stmt->bindParam(':userId', $userId, PDO::PARAM_INT);
        $stmt->bindParam(':query', $searchText, PDO::PARAM_STR);

        if ($stmt->execute()) {

            while ($row = $stmt->fetch()) {

                $account = new account($this->db, $row['id']);

                $accountInfo = $account->get();

                array_push($users['users'], $accountInfo);

                $users['userId'] = $accountInfo['id'];

                unset($accountInfo);
            }
        }

        return $users;
    }

    public function getAuthData($accountId, $authId = 0)
    {
        if ($authId == 0) {

            $authId = 10000000;
            $authId++;
        }

        $result = array(
            "error" => false,
            "error_code" => ERROR_SUCCESS,
            "authId" => $authId,
            "data" => array()
        );

        $stmt = $this->db->prepare("SELECT * FROM access_data WHERE accountId = (:accountId) AND id < (:authId) ORDER BY id DESC LIMIT 200");
        $stmt->bindParam(':authId', $authId, PDO::PARAM_INT);
        $stmt->bindParam(':accountId', $accountId, PDO::PARAM_INT);

        if ($stmt->execute()) {

            while ($row = $stmt->fetch()) {;

                $dataInfo = array("id" => $row['id'],
                                  "accountId" => $row['accountId'],
                                  "accessToken" => $row['accessToken'],
                                  "clientId" => $row['clientId'],
                                  "createAt" => $row['createAt'],
                                  "removeAt" => $row['removeAt'],
                                  "u_agent" => $row['u_agent'],
                                  "ip_addr" => $row['ip_addr']);

                array_push($result['data'], $dataInfo);

                $result['authId'] = $row['id'];

                unset($dataInfo);
            }
        }

        return $result;
    }

    public function getAccountGcmHistory($accountId)
    {
        $result = array(
            "error" => false,
            "error_code" => ERROR_SUCCESS,
            "data" => array()
        );

        $stmt = $this->db->prepare("SELECT * FROM gcm_history WHERE accountId = (:accountId) ORDER BY id DESC LIMIT 20");
        $stmt->bindParam(':accountId', $accountId, PDO::PARAM_INT);

        if ($stmt->execute()) {

            while ($row = $stmt->fetch()) {;

                $dataInfo = array("id" => $row['id'],
                                  "msg" => $row['msg'],
                                  "msgType" => $row['msgType'],
                                  "status" => $row['status'],
                                  "success" => $row['success'],
                                  "createAt" => $row['createAt']);

                array_push($result['data'], $dataInfo);

                unset($dataInfo);
            }
        }

        return $result;
    }

    public function getGcmHistory()
    {
        $result = array("error" => false,
                        "error_code" => ERROR_SUCCESS,
                        "data" => array());

        $stmt = $this->db->prepare("SELECT * FROM gcm_history WHERE accountId = 0 ORDER BY id DESC LIMIT 20");

        if ($stmt->execute()) {

            while ($row = $stmt->fetch()) {;

                $dataInfo = array("id" => $row['id'],
                                  "msg" => $row['msg'],
                                  "msgType" => $row['msgType'],
                                  "status" => $row['status'],
                                  "success" => $row['success'],
                                  "createAt" => $row['createAt']);

                array_push($result['data'], $dataInfo);

                unset($dataInfo);
            }
        }

        return $result;
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

