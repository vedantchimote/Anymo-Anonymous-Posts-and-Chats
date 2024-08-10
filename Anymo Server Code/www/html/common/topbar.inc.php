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


    ?>

    <div id="backdrop" class="sn-backdrop" style="opacity: 0;"></div>

    <div id="sidenav" class="sn-sidenav" style="transform: translate3d(-380px, 0px, 0px);">

        <div class="top-header" id="sn-topbar">
            <div class="container">

                <div class="d-flex">

                    <div class="burger-icon d-block menu-toggle">
                        <div class="burger-container">
                            <span class="burger-bun-top"></span>
                            <span class="burger-filling"></span>
                            <span class="burger-bun-bot"></span>
                        </div>
                    </div>

                    <a class="logo" href="/">
                        <img class="header-brand-img" src="/img/logo.png" alt="<?php echo APP_NAME; ?>" title="<?php echo APP_TITLE; ?>">
                    </a>
                </div>
            </div>
        </div>

        <div class="sidenav-content">

        </div>

    </div>

    <div class="top-header not-authorized">
        <div class="container">

            <div class="d-flex">

                <div class="burger-icon d-block d-lg-none menu-toggle hidden">
                    <div class="burger-container">
                        <span class="burger-bun-top"></span>
                        <span class="burger-filling"></span>
                        <span class="burger-bun-bot"></span>
                    </div>
                </div>

                <a class="logo" href="/">
                    <img class="header-brand-img" src="/img/logo.png" alt="<?php echo APP_NAME; ?>>" title="<?php echo APP_TITLE; ?>">
                </a>


                <div class="d-flex align-items-center order-lg-2 ml-auto">

                    <!--                    -->

                </div>

            </div>
        </div>
    </div>

    <?php

    if (!isset($_COOKIE['privacy'])) {

        if (isset($page_id) && $page_id != 'main') {

            ?>
            <div class="header-message gone">
                <div class="wrap">
                    <p class="message"><?php echo $LANG['label-cookie-message']; ?> <a href="/terms"><?php echo $LANG['page-terms']; ?></a></p>
                </div>

                <button class="close-message-button close-privacy-message">×</button>
            </div>
            <?php
        }
    }
?>