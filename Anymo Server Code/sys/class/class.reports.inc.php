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

class reports extends db_connect
{
	private $requestFrom = 0;
    private $itemsInRequest = 50;
    private $tableName = "reports";

	public function __construct($dbo = NULL)
    {
		parent::__construct($dbo);
	}

    public function add($itemType, $itemId, $abuseId, $description = "")
    {
        $result = array(
            "error" => true,
            "error_code" => ERROR_UNKNOWN
        );

        $toUseId = 0;

        $create_at = time();
        $u_agent = helper::u_agent();
        $ip_addr = helper::ip_addr();

        $spam = new spam($this->db);

        if ($spam->getSendReportsCount($ip_addr) > 15) {

            return $result;
        }

        $stmt = $this->db->prepare("SELECT id FROM reports WHERE ip_addr = (:ip_addr) AND itemId = (:itemId) AND removeAt = 0 LIMIT 1");
        $stmt->bindParam(":itemId", $itemId, PDO::PARAM_INT);
        $stmt->bindParam(":ip_addr", $ip_addr, PDO::PARAM_STR);
        $stmt->execute();

        if ($stmt->rowCount() == 0) {

            $stmt = $this->db->prepare("INSERT INTO reports (itemType, fromUserId, toUserId, itemId, abuseId, description, createAt, u_agent, ip_addr) value (:itemType, :fromUserId, :toUserId, :itemId, :abuseId, :description, :createAt, :u_agent, :ip_addr)");
            $stmt->bindParam(":itemType", $itemType, PDO::PARAM_INT);
            $stmt->bindParam(":fromUserId", $this->requestFrom, PDO::PARAM_INT);
            $stmt->bindParam(":toUserId", $toUseId, PDO::PARAM_INT);
            $stmt->bindParam(":itemId", $itemId, PDO::PARAM_INT);
            $stmt->bindParam(":abuseId", $abuseId, PDO::PARAM_INT);
            $stmt->bindParam(":description", $description, PDO::PARAM_STR);
            $stmt->bindParam(":createAt", $create_at, PDO::PARAM_INT);
            $stmt->bindParam(":u_agent", $u_agent, PDO::PARAM_STR);
            $stmt->bindParam(":ip_addr", $ip_addr, PDO::PARAM_STR);

            if ($stmt->execute()) {

                $result = array(
                    "error" => false,
                    "error_code" => ERROR_SUCCESS
                );

                if ($itemType == ITEM_TYPE_POST) {

                    $item = new items($this->db);
                    $item->updateCounters($itemId);
                    unset($itemId);
                }
            }
        }

        return $result;
    }

    public function delete($itemId)
    {
        $result = array(
            "error" => true,
            "error_code" => ERROR_UNKNOWN
        );

        $remove_at = time();

        $stmt = $this->db->prepare("UPDATE reports SET removeAt = (:removeAt) WHERE id = (:itemId) AND removeAt = 0");
        $stmt->bindParam(":removeAt", $remove_at, PDO::PARAM_INT);
        $stmt->bindParam(":itemId", $itemId, PDO::PARAM_INT);

        if ($stmt->execute()) {

            $result = array(
                "error" => false,
                "error_code" => ERROR_SUCCESS
            );
        }

        return $result;
    }

    public function remove($itemType, $itemId)
    {
        $result = array(
            "error" => true,
            "error_code" => ERROR_UNKNOWN
        );

        $remove_at = time();

        $stmt = $this->db->prepare("UPDATE reports SET removeAt = (:removeAt) WHERE itemType = (:itemType) AND itemId = (:itemId) AND removeAt = 0");
        $stmt->bindParam(":removeAt", $remove_at, PDO::PARAM_INT);
        $stmt->bindParam(":itemType", $itemType, PDO::PARAM_INT);
        $stmt->bindParam(":itemId", $itemId, PDO::PARAM_INT);

        if ($stmt->execute()) {

            $result = array(
                "error" => false,
                "error_code" => ERROR_SUCCESS
            );
        }

        return $result;
    }

    public function clear($itemType)
    {
        $result = array(
            "error" => true,
            "error_code" => ERROR_UNKNOWN
        );

        $remove_at = time();

        $stmt = $this->db->prepare("UPDATE reports SET removeAt = (:removeAt) WHERE itemType = (:itemType) AND removeAt = 0");
        $stmt->bindParam(":removeAt", $remove_at, PDO::PARAM_INT);
        $stmt->bindParam(":itemType", $itemType, PDO::PARAM_INT);

        if ($stmt->execute()) {

            $result = array(
                "error" => false,
                "error_code" => ERROR_SUCCESS
            );
        }

        return $result;
    }

    // Get items list

    public function getItems($pageId = 0, $itemType = -1, $itemId = -1)
    {
        $itemsCount = 0;

        if ($pageId == 0) $itemsCount = $this->getItemsCount($itemType, $itemId);

        $result = array(
            "error" => false,
            "error_code" => ERROR_SUCCESS,
            "pageId" => $pageId,
            "itemsCount" => $itemsCount,
            "items" => array()
        );

        if ($pageId == 0) {

            $limitSql = " LIMIT 0, {$this->itemsInRequest}";

        } else {

            $offset = $pageId * $this->itemsInRequest;
            $count  = $this->itemsInRequest;

            $limitSql = " LIMIT {$offset}, {$count}";
        }

        $itemIdSql = "";

        if ($itemId != -1) {

            $itemIdSql = " AND itemId = $itemId";
        }

        $itemTypeSql = "";

        if ($itemType != -1) {

            $itemTypeSql = " AND itemType = $itemType";
        }

        $sql = "SELECT * FROM $this->tableName WHERE removeAt = 0".$itemIdSql.$itemTypeSql." ORDER BY id DESC $limitSql";

        $stmt = $this->db->prepare($sql);

        if ($stmt->execute()) {

            if ($stmt->rowCount() > 0) {

                while ($row = $stmt->fetch()) {

                    array_push($result['items'], $this->quickInfo($row));
                }
            }
        }

        return $result;
    }

    // Get items count

    public function getItemsCount($itemType = -1, $itemId = -1)
    {
        $itemIdSql = "";

        if ($itemId != -1) {

            $itemIdSql = " AND itemId = $itemId";
        }

        $itemTypeSql = "";

        if ($itemType != -1) {

            $itemTypeSql = " AND itemType = $itemType";
        }

        $sql = "SELECT count(*) FROM $this->tableName WHERE removeAt = 0".$itemIdSql.$itemTypeSql;
        $stmt = $this->db->prepare($sql);

        $stmt->execute();

        return $number_of_rows = $stmt->fetchColumn();
    }

    // Get item info

    public function quickInfo($row)
    {
        $time = new language($this->db, "en");

        $result = array(
            "error" => false,
            "error_code" => ERROR_SUCCESS,
            "id" => $row['id'],
            "itemType" => $row['itemType'],
            "fromUserId" => $row['fromUserId'],
            "toUserId" => $row['toUserId'],
            "itemId" => $row['itemId'],
            "abuseId" => $row['abuseId'],
            "description" => htmlspecialchars_decode(stripslashes($row['description'])),
            "createAt" => $row['createAt'],
            "removeAt" => $row['removeAt'],
            "date" => date("Y-m-d H:i:s", $row['createAt']),
            "timeAgo" => $time->timeAgo($row['createAt']),
            "u_agent" => $row['u_agent'],
            "ip_addr" => $row['ip_addr'],
            "owner" => array(),
            "item" => array()
        );

        if ($row['fromUserId'] != 0) {

            $account = new account($this->db, $row['fromUserId']);
            $result['owner'] = $account->get();
            unset($account);
        }

        switch ($row['itemType']) {

            case REPORT_TYPE_ITEM: {

                $item = new items($this->db);
                $result['item'] = $item->info($row['itemId']);
                unset($item);

                break;
            }

            default: {

                $account = new account($this->db, $row['itemId']);
                $result['item'] = $account->get();
                unset($account);

                break;
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

