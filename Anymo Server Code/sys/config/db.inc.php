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

$C = array();
$B = array();

$B['APP_DEMO'] = false;                                     //true = enable demo version mode (only Admin panel)

$B['OTP_VERIFICATION'] = true;                              //false = dont use otp verification

$B['EMOJI_SUPPORT'] = false;                                //Set to true if you mysql version > 5.5.3, // Emoji support

$B['APP_MESSAGES_COUNTERS'] = true;                         //true = show new messages counters

$B['APP_USE_CLIENT_SECRET'] = true;                         //true = protection against bot registration using hash generation is enabled

// Additional information. It does not affect the work applications and website

$C['COMPANY_URL'] = "http://raccoonsquare.com/";
$B['APP_SUPPORT_EMAIL'] = "raccoonsquare@gmail.com";
$B['APP_AUTHOR_PAGE'] = "qascript";
$B['APP_PATH'] = "app";
$B['APP_VERSION'] = "1";
$B['APP_AUTHOR'] = "Demyanchuk Dmitry";
$B['APP_VENDOR'] = "raccoonsquare.com";

// Paths to folders for storing images and videos. Do not change!

$B['POST_PHOTO_PATH'] = "post/";                        //don`t edit this option
$B['TEMP_PATH'] = "tmp/";                               //don`t edit this option
$B['CHAT_IMAGE_PATH'] = "chat_images/";                 //don`t edit this option

// Data for the title of the website and copyright

$B['APP_NAME'] = "Anonymo";                   //
$B['APP_TITLE'] = "Anonymo";                  //
$B['APP_YEAR'] = "2021";                      // Year in footer

// Link to GOOGLE Play App in main page
$B['GOOGLE_PLAY_LINK'] = "https://play.google.com/store/apps/details?id=com.raccoonsquare.anonymo";

// Your domain (host) and url! See comments! Carefully!

$B['APP_HOST'] = "ioptimus.me";                 //edit to your domain, example (WARNING - without http://, https:// and www): yourdomain.com
$B['APP_URL'] = "https://ioptimus.me";           //edit to your domain url, example (WARNING - with http:// or https://): https://yourdomain.com

// Client ID. For more information, see the documentation, FAQ section
$B['CLIENT_ID'] = 1;   //Client ID | For identify mobile application | Example: 12567 (see documentation. section: faq)

// Client Secret. For generate hashes
$B['CLIENT_SECRET'] = "f*Hk86&_Hrfv7cjnf-I=yT"; // Characters. Must be the same in the app config (Constants.java or/and Constants.swift) and in this config (db.inc.php) | Example: f*Hk86&_Hrfv7cjnf-I=yT

// Google OAuth client |
$B['GOOGLE_CLIENT_ID'] = "35345345345345-f0dideclf8u84kglcrcodki5ctaua7c4.apps.googleusercontent.com";
$B['GOOGLE_CLIENT_SECRET'] = "-6jteSA345QPEUrE435xq8fFyu5-Er";

// Google settings | For sending FCM (Firebase Cloud Messages) | https://raccoonsquare.com/help/how_to_create_fcm_android/
$B['GOOGLE_API_KEY'] = "AAADxv7rOAk:APA93451bECaGh2Ct0NWz3uiMh345k5BiMvnygD_5L2evv2t1M-KIy4HJ4JII4IPf0n3-k3EMyf6GbTIbDwqSGbcaRCSlMeo5-uTZatrY";
$B['GOOGLE_SENDER_ID'] = "345345345345345";

$B['FIREBASE_API_KEY'] = $B['GOOGLE_API_KEY'];
$B['FIREBASE_SENDER_ID'] = $B['GOOGLE_SENDER_ID'];
$B['FIREBASE_PROJECT_ID'] = "anonymo-bq45f";

// Recaptcha settings | Create you keys for reCAPTCHA v3 | https://www.google.com/recaptcha/admin/create

$B['RECAPTCHA_SITE_KEY'] = "6LdLd0gdAsdAAAAEzgg-Yf1hxdNtp5sdn6dsE7DnNTzC";
$B['RECAPTCHA_SECRET_KEY'] = "6LdLd0asdgdAAAAAasdIFgubEdt5rD6S3f_xH9dTVju-FMH";

// SMTP Settings | For password recovery | Data for SMTP can ask your hosting provider |

$B['SMTP_HOST'] = 'yourdomain.com';                     //SMTP host | Specify main and backup SMTP servers
$B['SMTP_AUTH'] = true;                                     //SMTP auth (Enable SMTP authentication)
$B['SMTP_SECURE'] = 'tls';                                  //SMTP secure (Enable TLS encryption, `ssl` also accepted)
$B['SMTP_PORT'] = 587;                                      //SMTP port (TCP port to connect to)
$B['SMTP_EMAIL'] = 'support@yourdomain.com';                     //SMTP email
$B['SMTP_USERNAME'] = 'support@yourdomain.com';                  //SMTP username
$B['SMTP_PASSWORD'] = 'youpassword';                      //SMTP password

//Please edit database data

$C['DB_HOST'] = "localhost";                                //localhost or your db host
$C['DB_USER'] = "ktlbtfpn_root";                             //your db user
$C['DB_PASS'] = "MnqdDMiAs;#-";                         //your db password
$C['DB_NAME'] = "ktlbtfpn_anonymous";           //your db name

// Languages. For more information see documentation, section: Adding a new language (WEB SITE)

$LANGS = array();
$LANGS['English'] = "en";
//$LANGS['Русский'] = "ru";

