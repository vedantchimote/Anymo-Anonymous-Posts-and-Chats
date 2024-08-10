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

    $accountInfo = array();

    if (isset($_GET['id'])) {

        $accountId = isset($_GET['id']) ? $_GET['id'] : 0;

        $account = new account($dbo, $accountId);
        $accountInfo = $account->get();

    } else {

        header("Location: /admin/main");
        exit;
    }

    if ($accountInfo['error']) {

        header("Location: /admin/main");
        exit;
    }

    $stats = new stats($dbo);

    $items = new items($dbo);
    $items->setRequestFrom($accountInfo['id']);

    $inbox_all = 100000;
    $inbox_loaded = 0;

    if (!empty($_POST)) {

        $itemId = isset($_POST['itemId']) ? $_POST['itemId'] : 0;
        $loaded = isset($_POST['loaded']) ? $_POST['loaded'] : 0;

        $itemId = helper::clearInt($itemId);
        $loaded = helper::clearInt($loaded);

        $result = $items->wall($itemId);

        $inbox_loaded = count($result['items']);

        $result['inbox_loaded'] = $inbox_loaded + $loaded;
        $result['inbox_all'] = $inbox_all;

        if ($inbox_loaded != 0) {

            ob_start();

            foreach ($result['items'] as $key => $value) {

                draw($value);
            }

            $result['html'] = ob_get_clean();

            if ($result['inbox_loaded'] < $inbox_all) {

                ob_start();

                ?>

                    <a href="javascript:void(0)" onclick="Items.moreItems('<?php echo $result['itemId']; ?>'); return false;">
                        <button type="button" class="btn  btn-info footable-show">View More</button>
                    </a>

                <?php

                $result['html2'] = ob_get_clean();
            }
        }

        echo json_encode($result);
        exit;
    }

    $page_id = "user_items";

    $css_files = array("mytheme.css");
    $page_title = "Account items | Admin Panel";

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
                            <li class="breadcrumb-item active">Account items</li>
                        </ol>
                    </div>
                </div>

                <?php

                    include_once("../html/common/admin_banner.inc.php");
                ?>

                <?php

                    $result = $items->wall(0);

                    $inbox_loaded = count($result['items']);

                    if ($inbox_loaded != 0) {

                        ?>

                        <div class="row">
                            <div class="col-md-12">

                                <div class="card">
                                    <div class="card-header">
                                        <h4 class="card-title m-b-0">User Items</h4>
                                    </div>

                                    <div class="tab-content">
                                        <div class="tab-pane active">
                                            <div class="card-block">
                                                <div class="items-content">

                                                    <?php

                                                    foreach ($result['items'] as $key => $value) {

                                                        draw($value);
                                                    }

                                                    ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <?php

                                        if ($inbox_all > 20) {

                                            ?>

                                            <div class="card-body more-items loading-more-container">
                                                <a href="javascript:void(0)" onclick="Items.moreItems('<?php echo $result['itemId']; ?>'); return false;">
                                                    <button type="button" class="btn  btn-info footable-show">View More</button>
                                                </a>
                                            </div>

                                            <?php
                                        }
                                    ?>

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

            var inbox_all = <?php echo $inbox_all; ?>;
            var inbox_loaded = <?php echo $inbox_loaded; ?>;

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

            Items.moreItems = function (offset) {

                $('div.loading-more-container').hide();

                $.ajax({
                    type: 'POST',
                    url: '/admin/profile_items?id=' + <?php echo $accountInfo['id'] ?>,
                    data: 'itemId=' + offset + "&loaded=" + inbox_loaded,
                    dataType: 'json',
                    timeout: 30000,
                    success: function(response) {

                        if (response.hasOwnProperty('html2')){

                            $("div.loading-more-container").html("").append(response.html2).show();
                        }

                        if (response.hasOwnProperty('html')){

                            $("tbody.data-table").append(response.html);
                        }

                        inbox_loaded = response.inbox_loaded;
                        inbox_all = response.inbox_all;
                    },
                    error: function(xhr, type){

                        $('div.loading-more-container').show();
                    }
                });
            };

        </script>

        </div> <!-- End Page wrapper  -->
    </div> <!-- End Wrapper -->

</body>

</html>

<?php

    function draw($item)
    {
        ?>

        <div class="card col-12 col-lg-6 blog-widget w-100" data-id="<?php echo $item['id']; ?>">
            <div class="card-body">

                <?php

                if (strlen($item['imgUrl']) != 0) {

                    ?>
                    <div class="blog-image">
                        <img src="<?php echo $item['imgUrl']; ?>" alt="img" class="img-fluid blog-img-height w-100">
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
                                background-color: <?php echo $item['bgColor']; ?>;
                                color: <?php echo $item['textColor']; ?>;"
                        class="text-center"><?php echo $item['post']; ?></label>

                <p class="my-3">
                    <span class="sl-date"><i class="ti-calendar"></i> <?php echo $item['timeAgo']; ?></span>
                    <br>
                    <?php

                    $location = $item['country'];

                    if (strlen($item['area']) != 0) {

                        if (strlen($item['country']) != 0) {

                            $location = $location.", ".$item['area'];

                        } else {

                            $location = $item['area'];
                        }
                    }

                    if (strlen($item['city']) != 0) {

                        if (strlen($location) != 0) {

                            $location = $location.", ".$item['city'];

                        } else {

                            $location = $item['city'];
                        }
                    }
                    ?>
                    <span class="sl-date"><i class="ti-location-pin"></i> <?php echo $location; ?></span>
                </p>

                <div class="d-flex align-items-center">

                    <div class="read">
                        <a class="link" href="/admin/profile?id=<?php echo $item['fromUserId']; ?>">Item Author Account</a>
                        <a class="link ml-2" href="javascript: void(0)" onclick="Items.remove('<?php echo $item['id']; ?>', '<?php echo admin::getAccessToken(); ?>', 'remove'); return false;">Delete Item</a>
                        <a class="link ml-2" href="javascript: void(0)" onclick="Items.remove('<?php echo $item['id']; ?>', '<?php echo admin::getAccessToken(); ?>', 'remove_all_by_ip'); return false;">Delete All Items from this Ip</a>
                    </div>

                </div>
            </div>
        </div>

        <?php
    }