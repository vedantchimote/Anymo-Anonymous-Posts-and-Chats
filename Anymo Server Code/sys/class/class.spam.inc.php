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

class spam extends db_connect
{
	private $requestFrom = 0;
    private $language = 'en';

	public function __construct($dbo = NULL)
    {
		parent::__construct($dbo);
	}

	// Get created chats count

    public function getChatsCount()
    {
        $testTime = time() - 3600 * 24; // 24 hour

        $stmt = $this->db->prepare("SELECT count(*) FROM chats WHERE fromUserId = (:userId) AND createAt > (:testTime)");
        $stmt->bindParam(":userId", $this->requestFrom, PDO::PARAM_INT);
        $stmt->bindParam(":testTime", $testTime, PDO::PARAM_INT);
        $stmt->execute();

        return $number_of_rows = $stmt->fetchColumn();
    }

    // Get item likes count

    public function getItemLikesCount()
    {
        $testTime = time() - 3600 * 24; // 24 hour

        $stmt = $this->db->prepare("SELECT count(*) FROM item_likes WHERE fromUserId = (:userId) AND createAt > (:testTime) AND removeAt = 0");
        $stmt->bindParam(":userId", $this->requestFrom, PDO::PARAM_INT);
        $stmt->bindParam(":testTime", $testTime, PDO::PARAM_INT);
        $stmt->execute();

        return $number_of_rows = $stmt->fetchColumn();
    }

    // Get created items count

    public function getItemsCount()
    {
        $testTime = time() - 3600 * 24; // 24 hour

        $stmt = $this->db->prepare("SELECT count(*) FROM items WHERE fromUserId = (:userId) AND createAt > (:testTime)");
        $stmt->bindParam(":userId", $this->requestFrom, PDO::PARAM_INT);
        $stmt->bindParam(":testTime", $testTime, PDO::PARAM_INT);
        $stmt->execute();

        return $number_of_rows = $stmt->fetchColumn();
    }

    // Get user send friend requests count

    public function getSendReportsCount($ip_addr)
    {
        $testTime = time() - 3600 * 24; // 24 hour

        $stmt = $this->db->prepare("SELECT count(*) FROM reports WHERE ip_addr = (:ip_addr) AND createAt > (:testTime)");
        $stmt->bindParam(":ip_addr", $ip_addr, PDO::PARAM_INT);
        $stmt->bindParam(":testTime", $testTime, PDO::PARAM_INT);
        $stmt->execute();

        return $number_of_rows = $stmt->fetchColumn();
    }

    // Get created item comments count

    public function getItemCommentsCount()
    {
        $testTime = time() - 3600 * 24; // 24 hour

        $stmt = $this->db->prepare("SELECT count(*) FROM item_comments WHERE fromUserId = (:profileId) AND createAt > (:testTime)");
        $stmt->bindParam(":profileId", $this->requestFrom, PDO::PARAM_INT);
        $stmt->bindParam(":testTime", $testTime, PDO::PARAM_INT);
        $stmt->execute();

        return $number_of_rows = $stmt->fetchColumn();
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
