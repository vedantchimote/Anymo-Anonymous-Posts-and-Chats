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

    $page_id = "about";

    $css_files = array("main.css", "my.css");
    $page_title = $LANG['page-about'];

    include_once("../html/common/header.inc.php");

    ?>

<body class="about has-bottom-footer">


    <?php
        include_once("../html/common/topbar.inc.php");
    ?>


    <div class="wrap content-page">

        <div class="main-column">

            <div class="main-content">

                <section class="standard-page">
                    <h1><?php echo $LANG['page-about']; ?></h1>
                    <p><?php echo APP_TITLE." ".APP_VERSION." (web version) © ".APP_YEAR; ?></p>
                </section>

                <section class="standard-page">
                    <h1>About Example Section title</h1>

                    <h3>About Example sub-title</h3>

                    <p>About Example text. About Example text. About Example text. About Example text. About Example text.</p>

                </section>

            </div>

        </div>

    </div>

    <?php

        include_once("../html/common/footer.inc.php");
    ?>


</body
</html>