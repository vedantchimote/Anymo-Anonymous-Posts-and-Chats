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

class update extends db_connect
{
    public function __construct($dbo = NULL)
    {
        parent::__construct($dbo);

        // off all pdo errors when column in table exists

        $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_SILENT);
    }
    // For version 1.5 | Emoji support

    function setChatEmojiSupport()
    {
        $stmt = $this->db->prepare("ALTER TABLE messages charset = utf8mb4, MODIFY COLUMN message VARCHAR(800) CHARACTER SET utf8mb4");
        $stmt->execute();
    }

    function setCommentsEmojiSupport()
    {
        $stmt = $this->db->prepare("ALTER TABLE item_comments charset = utf8mb4, MODIFY COLUMN comment VARCHAR(800) CHARACTER SET utf8mb4");
        $stmt->execute();
    }

    function setPostsEmojiSupport()
    {
        $stmt = $this->db->prepare("ALTER TABLE items charset = utf8mb4, MODIFY COLUMN post VARCHAR(800) CHARACTER SET utf8mb4");
        $stmt->execute();
    }

    function setDialogsEmojiSupport()
    {
        $stmt = $this->db->prepare("ALTER TABLE chats charset = utf8mb4, MODIFY COLUMN message VARCHAR(800) CHARACTER SET utf8mb4");
        $stmt->execute();
    }
}
