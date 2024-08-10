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

    if (!admin::isSession()) {

        header("Location: /admin/login");
        exit;
    }

    $stats = new stats($dbo);
    $admin = new admin($dbo);

    $itemId = 0;
    $itemInfo = array();

    if (isset($_GET['id'])) {

        $itemId = isset($_GET['id']) ? $_GET['id'] : 0;
        $accessToken = isset($_GET['access_token']) ? $_GET['access_token'] : 0;
        $act = isset($_GET['act']) ? $_GET['act'] : '';

        $itemId = helper::clearInt($itemId);

        $items = new items($dbo);
        $itemInfo = $items->info($itemId);

        if ($itemInfo['error']) {

            header("Location: /admin/main");
            exit;
        }

        if ($itemInfo['removeAt'] != 0) {

            header("Location: /admin/main");
            exit;
        }

    } else {

        header("Location: /admin/main");
        exit;
    }

    $page_id = "item";

    $css_files = array("mytheme.css");
    $page_title = "Item Info | Admin Panel";

    include_once("../html/common/admin_header.inc.php");
?>

<body class="fix-header fix-sidebar card-no-border">

    <div id="main-wrapper">

        <?php

            include_once("../html/common/admin_topbar.inc.php");
        ?>

        <?php

            include_once("../html/common/admin_sidebar.inc.php");
        ?>

        <div class="page-wrapper">

            <div class="container-fluid">

                <div class="row page-titles">
                    <div class="col-md-5 col-8 align-self-center">
                        <h3 class="text-themecolor">Dashboard</h3>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/admin/main">Home</a></li>
                            <li class="breadcrumb-item active">Item Info</li>
                        </ol>
                    </div>
                </div>

                <?php

                    include_once("../html/common/admin_banner.inc.php");
                ?>

                <?php

                    if ($itemInfo['removeAt'] == 0) {

                        ?>

                        <div class="card col-12 col-lg-6 blog-widget w-100" data-id="<?php echo $itemInfo['id']; ?>">
                            <div class="card-body">

                                <?php

                                if (strlen($itemInfo['imgUrl']) != 0) {

                                    ?>
                                    <div class="blog-image">
                                        <img src="<?php echo $itemInfo['imgUrl']; ?>" alt="img" class="img-fluid blog-img-height w-100">
                                    </div>
                                    <?php
                                }
                                ?>

                                <label
                                        style="
                                                display: block;
                                                padding: 30px;
                                                border-radius: 5px;
                                                font-weight: 600;
                                                font-size: 100%;
                                                background-color: <?php echo $itemInfo['bgColor']; ?>;
                                                color: <?php echo $itemInfo['textColor']; ?>;"
                                        class="text-center"><?php echo $itemInfo['post']; ?></label>

                                <p class="my-3">
                                    <span class="sl-date"><i class="ti-calendar"></i> <?php echo $itemInfo['timeAgo']; ?></span>
                                    <br>
                                    <?php

                                    $location = $itemInfo['country'];

                                    if (strlen($itemInfo['area']) != 0) {

                                        if (strlen($itemInfo['country']) != 0) {

                                            $location = $location.", ".$itemInfo['area'];

                                        } else {

                                            $location = $itemInfo['area'];
                                        }
                                    }

                                    if (strlen($itemInfo['city']) != 0) {

                                        if (strlen($location) != 0) {

                                            $location = $location.", ".$itemInfo['city'];

                                        } else {

                                            $location = $itemInfo['city'];
                                        }
                                    }
                                    ?>
                                    <span class="sl-date"><i class="ti-location-pin"></i> <?php echo $location; ?></span>
                                </p>

                                <div class="d-flex align-items-center">

                                    <div class="read">
                                        <a class="link" href="/admin/profile?id=<?php echo $itemInfo['fromUserId']; ?>">Item Author Account</a>
                                        <a class="link ml-2" href="javascript: void(0)" onclick="Items.remove('<?php echo $itemInfo['id']; ?>', '<?php echo admin::getAccessToken(); ?>', 'remove'); return false;">Delete Item</a>
                                        <a class="link ml-2" href="javascript: void(0)" onclick="Items.remove('<?php echo $itemInfo['id']; ?>', '<?php echo admin::getAccessToken(); ?>', 'remove_all_by_ip'); return false;">Delete All Items from this Ip</a>
                                    </div>

                                </div>
                            </div>
                        </div>

                        <?php

                    } else {

                        ?>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="card text-center">
                                        <div class="card-body">
                                            <h4 class="card-title">List is empty.</h4>
                                            <p class="card-text">This means that there is no data to display :)</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php
                    }
                ?>

            </div> <!-- End Container fluid  -->

            <?php

                include_once("../html/common/admin_footer.inc.php");
            ?>

            <script type="text/javascript">

                window.Items || ( window.Items = {} );

                Items.remove = function (offset, accessToken, action) {

                    $.ajax({
                        type: 'GET',
                        url: '/admin/stream_items',
                        data: 'itemId=' + offset + "&access_token=" + accessToken + "&act=" + action,
                        timeout: 30000,
                        success: function(response){

                            $('div.card[data-id=' + offset + ']').remove();
                        },
                        error: function(xhr, type){

                        }
                    });
                };

            </script>

        </div> <!-- End Page wrapper  -->
    </div> <!-- End Wrapper -->

</body>

</html>