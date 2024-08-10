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


    $page_id = "update";

    include_once("../sys/core/initialize.inc.php");

    $update = new update($dbo);

    //

    $settings = new settings($dbo);

    $settings->createValue("defaultAllowMessages", 1); //Default off

    $settings->createValue("interstitialAdAfterNewItem", 1);
    $settings->createValue("interstitialAdAfterNewLike", 5);

    $settings->createValue("admobAdAfterItem", 1);
    $settings->createValue("allowGoogleAuth", 1);

    // Limits per hour

    $settings->createValue("limitItems", 10);
    $settings->createValue("limitChats", 5);
    $settings->createValue("limitLikes", 40);
    $settings->createValue("limitComments", 40);

    //

    $settings->createValue("pinnedItemId", 0);

    unset($settings);

    // Add standard stickers

    $stickers = new sticker($dbo);

    if ($stickers->db_getMaxId() < 1) {

        for ($i = 1; $i < 28; $i++) {

            $stickers->db_add(APP_URL."/stickers/".$i.".png");
        }
    }

    unset($stickers);

    $css_files = array("main.css", "my.css");
    $page_title = APP_TITLE;

    include_once("../html/common/header.inc.php");
?>

<body class="remind-page has-bottom-footer">

    <?php

        include_once("../html/common/topbar.inc.php");
    ?>

    <div class="wrap content-page">
        <div class="main-column">
            <div class="main-content">

                <div class="standard-page">

                    <div class="success-container" style="margin-top: 15px;">
                        <ul>
                            <b>Success!</b>
                            <br>
                            Your MySQL version:
                                <?php

                                    if (function_exists('mysql_get_client_info')) {

                                        print mysql_get_client_info();

                                    } else {

                                        echo $dbo->query('select version()')->fetchColumn();
                                    }
                                ?>
                            <br>
                            Database refactoring success!
                        </ul>
                    </div>

                </div>

            </div>
        </div>

    </div>

    <?php

        include_once("../html/common/footer.inc.php");
    ?>

</body>
</html>