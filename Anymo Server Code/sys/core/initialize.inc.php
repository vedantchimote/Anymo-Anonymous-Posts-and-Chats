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

	try {

		$sth = $dbo->prepare("CREATE TABLE IF NOT EXISTS users (
								  id INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
								  state INT(10) UNSIGNED DEFAULT 0,
								  surname VARCHAR(75) NOT NULL DEFAULT '',
								  fullname VARCHAR(150) NOT NULL DEFAULT '',
								  salt CHAR(3) NOT NULL DEFAULT '',
								  passw VARCHAR(32) NOT NULL DEFAULT '',
								  login VARCHAR(50) NOT NULL DEFAULT '',
								  email VARCHAR(64) NOT NULL DEFAULT '',
								  emailVerified SMALLINT(6) UNSIGNED DEFAULT 0,
								  lang CHAR(10) DEFAULT 'en',
								  language CHAR(10) DEFAULT 'en',
								  bYear SMALLINT(6) UNSIGNED DEFAULT 2000,
								  bMonth SMALLINT(6) UNSIGNED DEFAULT 0,
								  bDay SMALLINT(6) UNSIGNED DEFAULT 1,
								  status VARCHAR(500) NOT NULL DEFAULT '',
								  country VARCHAR(30) NOT NULL DEFAULT '',
								  country_id INT(10) UNSIGNED DEFAULT 0,
								  city VARCHAR(50) NOT NULL DEFAULT '',
								  city_id INT(10) UNSIGNED DEFAULT 0,
								  vk_page VARCHAR(150) NOT NULL DEFAULT '',
								  fb_page VARCHAR(150) NOT NULL DEFAULT '',
								  tw_page VARCHAR(150) NOT NULL DEFAULT '',
								  my_page VARCHAR(150) NOT NULL DEFAULT '',
								  phone VARCHAR(30) NOT NULL DEFAULT '',
								  verified SMALLINT(6) UNSIGNED DEFAULT 0,
								  otpPhone VARCHAR(30) NOT NULL DEFAULT '',
								  otpVerified SMALLINT(6) UNSIGNED DEFAULT 0,
								  admob_ad_banner SMALLINT(6) UNSIGNED DEFAULT 0,
								  admob_interstitial SMALLINT(6) UNSIGNED DEFAULT 0,
								  vk_id varchar(40) NOT NULL DEFAULT '',
								  fb_id varchar(40)	NOT NULL DEFAULT '',
								  gl_id varchar(40) NOT NULL DEFAULT '',
								  tw_id varchar(40) NOT NULL DEFAULT '',
								  items_count INT(11) UNSIGNED DEFAULT 0,
								  likes_count INT(11) UNSIGNED DEFAULT 0,
								  comments_count INT(11) UNSIGNED DEFAULT 0,
								  rating INT(11) UNSIGNED DEFAULT 0,
								  balance INT(11) UNSIGNED DEFAULT 0,
								  sex SMALLINT(6) UNSIGNED DEFAULT 0,
								  age SMALLINT(6) UNSIGNED DEFAULT 18,
								  last_notify_view INT(10) UNSIGNED DEFAULT 0,
								  last_authorize INT(10) UNSIGNED DEFAULT 0,
								  allowComments SMALLINT(6) UNSIGNED DEFAULT 1,
								  allowMessages SMALLINT(6) UNSIGNED DEFAULT 1,
								  lowPhotoUrl VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT '',
								  originPhotoUrl VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT '',
								  normalPhotoUrl VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT '',
								  bigPhotoUrl VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT '',
								  originCoverUrl VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT '',
								  normalCoverUrl VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT '',
								  photoModerateAt int(11) UNSIGNED DEFAULT 0,
								  photoModerateUrl VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT '',
								  photoPostModerateAt int(11) UNSIGNED DEFAULT 0,
								  coverModerateAt int(11) UNSIGNED DEFAULT 0,
								  coverModerateUrl VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT '',
								  coverPostModerateAt int(11) UNSIGNED DEFAULT 0,
								  lat float(10,6) DEFAULT 0,
								  lng float(10,6) DEFAULT 0,
								  ip_addr CHAR(32) NOT NULL DEFAULT '',
								  createAt INT(10) UNSIGNED DEFAULT 0,
  								PRIMARY KEY  (id), UNIQUE KEY (email)) ENGINE=MyISAM CHARACTER SET utf8 COLLATE utf8_unicode_ci");
		$sth->execute();

		$sth = $dbo->prepare("CREATE TABLE IF NOT EXISTS settings (
								  id INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
								  name VARCHAR(150) NOT NULL DEFAULT '',
								  intValue INT(10) UNSIGNED DEFAULT 0,
								  textValue CHAR(32) NOT NULL DEFAULT '',
  								PRIMARY KEY  (id), UNIQUE KEY (name)) ENGINE=MyISAM CHARACTER SET utf8 COLLATE utf8_unicode_ci");
		$sth->execute();

		$sth = $dbo->prepare("CREATE TABLE IF NOT EXISTS admins (
								id int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
								username VARCHAR(50) NOT NULL DEFAULT '',
                                salt CHAR(3) NOT NULL DEFAULT '',
                                password VARCHAR(32) NOT NULL DEFAULT '',
                                fullname VARCHAR(150) NOT NULL DEFAULT '',
                                createAt int(11) UNSIGNED DEFAULT 0,
								u_agent varchar(300) DEFAULT '',
								ip_addr CHAR(32) NOT NULL DEFAULT '',
								PRIMARY KEY  (id)) ENGINE=MyISAM CHARACTER SET utf8 COLLATE utf8_unicode_ci");
		$sth->execute();

		$sth = $dbo->prepare("CREATE TABLE IF NOT EXISTS chats (
								id INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
								fromUserId INT(11) UNSIGNED DEFAULT 0,
								toUserId INT(11) UNSIGNED DEFAULT 0,
								fromUserId_lastView INT(11) UNSIGNED DEFAULT 0,
								toUserId_lastView INT(11) UNSIGNED DEFAULT 0,
								itemType int(11) UNSIGNED DEFAULT 0,
								itemId int(11) UNSIGNED DEFAULT 0,
								colorId int(11) UNSIGNED DEFAULT 0,
								iconId int(11) UNSIGNED DEFAULT 0,
								message varchar(800) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT '',
								messageCreateAt INT(11) UNSIGNED DEFAULT 0,
								updateAt INT(11) UNSIGNED DEFAULT 0,
								createAt INT(11) UNSIGNED DEFAULT 0,
								removeAt INT(11) UNSIGNED DEFAULT 0,
								PRIMARY KEY (id)) ENGINE=MyISAM CHARACTER SET utf8 COLLATE utf8_unicode_ci");
		$sth->execute();

		$sth = $dbo->prepare("CREATE TABLE IF NOT EXISTS messages (
								id int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
								chatId int(11) UNSIGNED DEFAULT 0,
								fromUserId int(11) UNSIGNED DEFAULT 0,
								toUserId int(11) UNSIGNED DEFAULT 0,
								message varchar(800) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT '',
								imgUrl VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT '',
								stickerId int(11) UNSIGNED DEFAULT 0,
								stickerImgUrl VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT '',
								createAt int(11) UNSIGNED DEFAULT 0,
								removeAt int(11) UNSIGNED DEFAULT 0,
								seenAt INT(11) UNSIGNED DEFAULT 0,
								seenFromUserId int(11) UNSIGNED DEFAULT 0,
								seenToUserId int(11) UNSIGNED DEFAULT 0,
								u_agent varchar(300) DEFAULT '',
								ip_addr CHAR(32) NOT NULL DEFAULT '',
								PRIMARY KEY  (id)) ENGINE=MyISAM CHARACTER SET utf8 COLLATE utf8_general_ci");
		$sth->execute();

        $sth = $dbo->prepare("CREATE TABLE IF NOT EXISTS items (
								id int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
								fromUserId int(11) UNSIGNED DEFAULT 0,
								textColor VARCHAR(20) NOT NULL DEFAULT '',
								bgColor VARCHAR(20) NOT NULL DEFAULT '',
								imgBlur int(11) UNSIGNED DEFAULT 0,
								imgAlpha int(11) UNSIGNED DEFAULT 90,
								likesCount int(11) UNSIGNED DEFAULT 0,
								commentsCount int(11) UNSIGNED DEFAULT 0,
								reportsCount int(11) UNSIGNED DEFAULT 0,
								viewsCount int(11) UNSIGNED DEFAULT 0,
								deviceType int(11) UNSIGNED DEFAULT 0,
								rating int(11) UNSIGNED DEFAULT 0,
								allowComments int(11) UNSIGNED DEFAULT 1,
								allowMessages int(11) UNSIGNED DEFAULT 1,
								post varchar(800) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT '',
								previewImgUrl VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT '',
								imgUrl VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT '',
								previewGifUrl VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT '',
								gifUrl VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT '',
								previewVideoImgUrl VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT '',
								videoUrl VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT '',
								area VARCHAR(150) NOT NULL DEFAULT '',
								country VARCHAR(150) NOT NULL DEFAULT '',
								city VARCHAR(150) NOT NULL DEFAULT '',
								u_agent varchar(300) DEFAULT '',
								createAt int(11) UNSIGNED DEFAULT 0,
								removeAt int(11) UNSIGNED DEFAULT 0,
								moderateAt int(11) UNSIGNED DEFAULT 0,
								needToModerate int(11) UNSIGNED DEFAULT 0,
								lat float(10,6),
								lng float(10,6),
								ip_addr CHAR(32) NOT NULL DEFAULT '',
								PRIMARY KEY  (id)) ENGINE=MyISAM CHARACTER SET utf8 COLLATE utf8_unicode_ci");
        $sth->execute();

		$sth = $dbo->prepare("CREATE TABLE IF NOT EXISTS item_comments (
								id int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
								fromUserId int(11) UNSIGNED DEFAULT 0,
								replyToUserId int(11) UNSIGNED DEFAULT 0,
								likesCount int(11) UNSIGNED DEFAULT 0,
								itemId int(11) UNSIGNED DEFAULT 0,
								itemFromUserId int(11) UNSIGNED DEFAULT 0,
								colorId int(11) UNSIGNED DEFAULT 0,
								iconId int(11) UNSIGNED DEFAULT 0,
                                comment varchar(800) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT '',
                                commentOriginImgUrl VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT '',
                                commentNormalImgUrl VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT '',
                                area VARCHAR(150) NOT NULL DEFAULT '',
								country VARCHAR(150) NOT NULL DEFAULT '',
								city VARCHAR(150) NOT NULL DEFAULT '',
                                createAt int(11) UNSIGNED DEFAULT 0,
                                removeAt int(11) UNSIGNED DEFAULT 0,
                                notifyId int(11) UNSIGNED DEFAULT 0,
								u_agent varchar(300) DEFAULT '',
								ip_addr CHAR(32) NOT NULL DEFAULT '',
								PRIMARY KEY  (id)) ENGINE=MyISAM CHARACTER SET utf8 COLLATE utf8_general_ci");
		$sth->execute();

        $sth = $dbo->prepare("CREATE TABLE IF NOT EXISTS support (
								id int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
								clientId int(11) UNSIGNED DEFAULT 0,
                                accountId int(11) UNSIGNED DEFAULT 0,
                                email varchar(64) DEFAULT '',
                                subject varchar(180) DEFAULT '',
                                text varchar(400) DEFAULT '',
                                reply varchar(400) DEFAULT '',
                                replyAt int(11) UNSIGNED DEFAULT 0,
                                replyFrom int(11) UNSIGNED DEFAULT 0,
                                removeAt int(11) UNSIGNED DEFAULT 0,
                                createAt int(11) UNSIGNED DEFAULT 0,
								u_agent varchar(300) DEFAULT '',
								ip_addr CHAR(32) NOT NULL DEFAULT '',
								PRIMARY KEY  (id)) ENGINE=MyISAM CHARACTER SET utf8 COLLATE utf8_unicode_ci");
        $sth->execute();

        $sth = $dbo->prepare("CREATE TABLE IF NOT EXISTS item_likes (
								id int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
								fromUserId int(11) UNSIGNED DEFAULT 0,
								itemId int(11) UNSIGNED DEFAULT 0,
								createAt int(11) UNSIGNED DEFAULT 0,
								removeAt int(11) UNSIGNED DEFAULT 0,
								ip_addr CHAR(32) NOT NULL DEFAULT '',
								PRIMARY KEY  (id)) ENGINE=MyISAM CHARACTER SET utf8 COLLATE utf8_unicode_ci");
        $sth->execute();

		$sth = $dbo->prepare("CREATE TABLE IF NOT EXISTS comment_likes (
								id int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
								fromUserId int(11) UNSIGNED DEFAULT 0,
								itemId int(11) UNSIGNED DEFAULT 0,
								createAt int(11) UNSIGNED DEFAULT 0,
								removeAt int(11) UNSIGNED DEFAULT 0,
								ip_addr CHAR(32) NOT NULL DEFAULT '',
								PRIMARY KEY  (id)) ENGINE=MyISAM CHARACTER SET utf8 COLLATE utf8_unicode_ci");
		$sth->execute();

        $sth = $dbo->prepare("CREATE TABLE IF NOT EXISTS notifications (
								id int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
								notifyToId int(11) UNSIGNED NOT NULL DEFAULT 0,
								notifyFromId int(11) UNSIGNED NOT NULL DEFAULT 0,
								notifyType int(11) UNSIGNED NOT NULL DEFAULT 0,
								postId int(11) UNSIGNED NOT NULL DEFAULT 0,
								createAt int(10) UNSIGNED DEFAULT 0,
								removeAt int(10) UNSIGNED DEFAULT 0,
								PRIMARY KEY  (id)) ENGINE=MyISAM CHARACTER SET utf8 COLLATE utf8_unicode_ci");
        $sth->execute();

		$sth = $dbo->prepare("CREATE TABLE IF NOT EXISTS access_data (
								id int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
								accountId int(11) UNSIGNED NOT NULL,
								accessToken varchar(32) DEFAULT '',
								fcm_regId varchar(255) DEFAULT '',
								appType int(10) UNSIGNED DEFAULT 0,
								clientId int(11) UNSIGNED DEFAULT 0,
								lang CHAR(10) DEFAULT 'en',
								createAt int(10) UNSIGNED DEFAULT 0,
								removeAt int(10) UNSIGNED DEFAULT 0,
								u_agent varchar(300) DEFAULT '',
								ip_addr CHAR(32) NOT NULL DEFAULT '',
								PRIMARY KEY  (id)) ENGINE=MyISAM CHARACTER SET utf8 COLLATE utf8_unicode_ci");
		$sth->execute();

        $sth = $dbo->prepare("CREATE TABLE IF NOT EXISTS restore_data (
								id int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
								accountId int(11) UNSIGNED NOT NULL,
								hash varchar(32) DEFAULT '',
								email VARCHAR(64) NOT NULL DEFAULT '',
								clientId int(11) UNSIGNED DEFAULT 0,
								lang CHAR(10) DEFAULT 'en',
								createAt int(10) UNSIGNED DEFAULT 0,
								removeAt int(10) UNSIGNED DEFAULT 0,
								u_agent varchar(300) DEFAULT '',
								ip_addr CHAR(32) NOT NULL DEFAULT '',
								PRIMARY KEY  (id)) ENGINE=MyISAM CHARACTER SET utf8 COLLATE utf8_unicode_ci");
        $sth->execute();

        $sth = $dbo->prepare("CREATE TABLE IF NOT EXISTS item_followers (
								id INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
								userId INT(11) UNSIGNED DEFAULT 0,
								itemId INT(11) UNSIGNED DEFAULT 0,
								followType INT(11) UNSIGNED DEFAULT 0,
								createAt int(10) UNSIGNED DEFAULT 0,
								removeAt int(10) UNSIGNED DEFAULT 0,
								PRIMARY KEY (id)) ENGINE=MyISAM CHARACTER SET utf8 COLLATE utf8_unicode_ci");
        $sth->execute();

        $sth = $dbo->prepare("CREATE TABLE IF NOT EXISTS profile_blacklist (
								id INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
								blockedByUserId INT(11) UNSIGNED DEFAULT 0,
								blockedUserId INT(11) UNSIGNED DEFAULT 0,
								reason varchar(400) DEFAULT '',
								createAt INT(11) UNSIGNED DEFAULT 0,
								removeAt INT(11) UNSIGNED DEFAULT 0,
								u_agent varchar(300) DEFAULT '',
								ip_addr CHAR(32) NOT NULL DEFAULT '',
								PRIMARY KEY (id)) ENGINE=MyISAM CHARACTER SET utf8 COLLATE utf8_unicode_ci");
        $sth->execute();

		$sth = $dbo->prepare("CREATE TABLE IF NOT EXISTS gcm_history (
								  id INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
								  msg VARCHAR(150) NOT NULL DEFAULT '',
								  msgType INT(10) UNSIGNED DEFAULT 0,
								  accountId int(11) UNSIGNED DEFAULT 0,
								  status INT(10) UNSIGNED DEFAULT 0,
								  success INT(10) UNSIGNED DEFAULT 0,
								  createAt int(10) UNSIGNED DEFAULT 0,
  								PRIMARY KEY  (id)) ENGINE=MyISAM CHARACTER SET utf8 COLLATE utf8_unicode_ci");
		$sth->execute();

        $sth = $dbo->prepare("CREATE TABLE IF NOT EXISTS reports (
								id INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
								itemType INT(11) UNSIGNED DEFAULT 0,
								fromUserId INT(11) UNSIGNED DEFAULT 0,
								toUserId INT(11) UNSIGNED DEFAULT 0,
								itemId INT(11) UNSIGNED DEFAULT 0,
								abuseId INT(11) UNSIGNED DEFAULT 0,
								description varchar(300) DEFAULT '',
								createAt INT(11) UNSIGNED DEFAULT 0,
								removeAt int(10) UNSIGNED DEFAULT 0,
								u_agent varchar(300) DEFAULT '',
								ip_addr CHAR(32) NOT NULL DEFAULT '',
								PRIMARY KEY  (id)) ENGINE=MyISAM CHARACTER SET utf8 COLLATE utf8_unicode_ci");
        $sth->execute();

		$sth = $dbo->prepare("CREATE TABLE IF NOT EXISTS stickers_data (
								id INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
								cost INT(11) UNSIGNED DEFAULT 0,
								category INT(11) UNSIGNED DEFAULT 0,
								imgUrl VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT '',
								createAt INT(11) UNSIGNED DEFAULT 0,
								removeAt INT(11) UNSIGNED DEFAULT 0,
								PRIMARY KEY (id)) ENGINE=MyISAM CHARACTER SET utf8 COLLATE utf8_general_ci");
		$sth->execute();

		$sth = $dbo->prepare("CREATE TABLE IF NOT EXISTS stoplist (
								id INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
								byAdminId INT(11) UNSIGNED DEFAULT 0,
								reason varchar(400) DEFAULT '',
								createAt INT(11) UNSIGNED DEFAULT 0,
								removeAt INT(11) UNSIGNED DEFAULT 0,
								ip_addr CHAR(32) NOT NULL DEFAULT '',
								PRIMARY KEY (id)) ENGINE=MyISAM CHARACTER SET utf8 COLLATE utf8_general_ci");
		$sth->execute();

	} catch (Exception $e) {

		die ($e->getMessage());
	}
