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

class auth extends db_connect
{
    private $auth_valid_sec = 0;

    public function __construct($dbo)
    {
        parent::__construct($dbo);

        $this->auth_valid_sec = 7 * 24 * 3600; // 7 days
    }

    public function authorize($accountId, $accessToken)
    {
        $accountId = helper::clearInt($accountId);

        $accessToken = helper::clearText($accessToken);
        $accessToken = helper::escapeText($accessToken);

        $stmt = $this->db->prepare("SELECT id FROM access_data WHERE accountId = (:accountId) AND accessToken = (:accessToken) AND removeAt = 0 LIMIT 1");
        $stmt->bindParam(":accountId", $accountId, PDO::PARAM_INT);
        $stmt->bindParam(":accessToken", $accessToken, PDO::PARAM_STR);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {

            return true;
        }

        return false;
    }

    public function remove($accountId, $accessToken)
    {
        $accountId = helper::clearInt($accountId);

        $accessToken = helper::clearText($accessToken);
        $accessToken = helper::escapeText($accessToken);

        $currentTime = time(); //current time

        $stmt = $this->db->prepare("UPDATE access_data SET removeAt = (:removeAt) WHERE accountId = (:accountId) AND accessToken = (:accessToken)");
        $stmt->bindParam(":accountId", $accountId, PDO::PARAM_INT);
        $stmt->bindParam(":accessToken", $accessToken, PDO::PARAM_STR);
        $stmt->bindParam(":removeAt", $currentTime, PDO::PARAM_INT);

        if ($stmt->execute()) {

            return true;
        }

        return false;
    }

    public function removeAll($accountId)
    {
        $accountId = helper::clearInt($accountId);

        $currentTime = time(); //current time

        $stmt = $this->db->prepare("UPDATE access_data SET removeAt = (:removeAt) WHERE accountId = (:accountId)");
        $stmt->bindParam(":accountId", $accountId, PDO::PARAM_INT);
        $stmt->bindParam(":removeAt", $currentTime, PDO::PARAM_INT);

        if ($stmt->execute()) {

            return true;
        }

        return false;
    }

    public function getAuthorizationId($accountId, $accessToken)
    {
        $accountId = helper::clearInt($accountId);

        $accessToken = helper::clearText($accessToken);
        $accessToken = helper::escapeText($accessToken);

        $stmt = $this->db->prepare("SELECT id FROM access_data WHERE accountId = (:accountId) AND accessToken = (:accessToken) AND removeAt = 0 LIMIT 1");
        $stmt->bindParam(":accountId", $accountId, PDO::PARAM_INT);
        $stmt->bindParam(":accessToken", $accessToken, PDO::PARAM_STR);
        $stmt->execute();

        if ($stmt->execute()) {

            if ($stmt->rowCount() > 0) {

                $row = $stmt->fetch();

                return $row['id'];
            }
        }

        return 0;
    }

    public function updateAuthorizationId($auth_id, $fcm_regId = "")
    {
        $stmt = $this->db->prepare("UPDATE access_data SET fcm_regId = (:fcm_regId) WHERE id = (:id)");
        $stmt->bindParam(":id", $auth_id, PDO::PARAM_INT);
        $stmt->bindParam(":fcm_regId", $fcm_regId, PDO::PARAM_STR);
        $stmt->execute();
    }

    public function create($accountId, $clientId = 0, $app_type = 0, $fcm_regId = "", $lang = "")
    {
        $result = array(
            "error" => true,
            "error_code" => ERROR_UNKNOWN
        );

        $currentTime = time();	// Current time

        $u_agent = helper::u_agent();
        $ip_addr = helper::ip_addr();

        $accessToken = md5(uniqid(rand(), true));

        $stmt = $this->db->prepare("INSERT INTO access_data (accountId, accessToken, fcm_regId, appType, clientId, lang, createAt, u_agent, ip_addr) value (:accountId, :accessToken, :fcm_regId, :appType, :clientId, :lang, :createAt, :u_agent, :ip_addr)");
        $stmt->bindParam(":accountId", $accountId, PDO::PARAM_INT);
        $stmt->bindParam(":accessToken", $accessToken, PDO::PARAM_STR);
        $stmt->bindParam(":fcm_regId", $fcm_regId, PDO::PARAM_STR);
        $stmt->bindParam(":appType", $app_type, PDO::PARAM_INT);
        $stmt->bindParam(":clientId", $clientId, PDO::PARAM_INT);
        $stmt->bindParam(":lang", $lang, PDO::PARAM_STR);
        $stmt->bindParam(":createAt", $currentTime, PDO::PARAM_INT);
        $stmt->bindParam(":u_agent", $u_agent, PDO::PARAM_STR);
        $stmt->bindParam(":ip_addr", $ip_addr, PDO::PARAM_STR);

        if ($stmt->execute()) {

            $result = array(
                'error'=> false,
                'error_code' => ERROR_SUCCESS,
                'accessToken' => $accessToken,
                'accountId' => $accountId);
        }

        return $result;
    }

    static function isSession()
    {
        if (isset($_SESSION) && isset($_SESSION['user_id'])) {

            return true;

        } else {

            return false;
        }
    }

    static function getCurrentUserId()
    {
        if (isset($_SESSION) && isset($_SESSION['user_id'])) {

            return $_SESSION['user_id'];

        } else {

            return 0;
        }
    }

    static function newAuthenticityToken()
    {

        $authenticity_token = md5(uniqid(rand(), true));

        if (isset($_SESSION)) {

            $_SESSION['authenticity_token'] = $authenticity_token;
        }
    }

    static function getAuthenticityToken()
    {
        if (isset($_SESSION) && isset($_SESSION['authenticity_token'])) {

            return $_SESSION['authenticity_token'];

        } else {

            return NULL;
        }
    }
}
