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
    $reports = new reports($dbo);

    if (isset($_GET['act'])) {

        $act = isset($_GET['act']) ? $_GET['act'] : '';
        $itemId = isset($_GET['itemId']) ? $_GET['itemId'] : 0;
        $token = isset($_GET['access_token']) ? $_GET['access_token'] : '';

        $itemId = helper::clearInt($itemId);

        if (admin::getAccessToken() === $token && !APP_DEMO) {

            switch ($act) {

                case "clear" : {

                    $reports->clear(REPORT_TYPE_ITEM);

                    header("Location: /admin/stream_items_reports");
                    break;
                }

                case "remove" : {

                    $reports->delete($itemId);

                    exit;

                    break;
                }

                default: {

                    header("Location: /admin/stream_items_reports");
                    exit;
                }
            }
        }

        header("Location: /admin/main");
        exit;
    }

    $page_id = "stream_items_reports";

    $css_files = array("mytheme.css");
    $page_title = "Items Reports | Admin Panel";

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
                            <li class="breadcrumb-item active">Items Reports</li>
                        </ol>
                    </div>
                </div>

                <?php

                    include_once("../html/common/admin_banner.inc.php");
                ?>

                <?php

                    $reports = new reports($dbo);

                    $result = $reports->getItems(0, REPORT_TYPE_ITEM);

                    $inbox_loaded = count($result['items']);

                    if ($inbox_loaded != 0) {

                        ?>

                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-body">
                                        <a href="/admin/stream_items_reports?act=clear&access_token=<?php echo admin::getAccessToken(); ?>" style="float: right">
                                            <button type="button" class="btn waves-effect waves-light btn-info">Delete all reports</button>
                                        </a>

                                        <div class="d-flex no-block">
                                            <h4 class="card-title">Items Reports (Latest reports)</h4>
                                        </div>

                                        <div class="table-responsive m-t-20">

                                            <table class="table stylish-table">

                                                <thead>
                                                <tr>
                                                    <th>Report from</th>
                                                    <th>To Item</th>
                                                    <th>Reason</th>
                                                    <th>Date</th>
                                                    <th>Action</th>
                                                </tr>
                                                </thead>

                                                <tbody>
                                                    <?php

                                                        foreach ($result['items'] as $key => $value) {

                                                            draw($value);
                                                        }

                                                    ?>
                                                </tbody>

                                            </table>
                                        </div>
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

                window.Reports || ( window.Reports = {} );

                Reports.remove = function (offset, accessToken, action) {

                    $.ajax({
                        type: 'GET',
                        url: '/admin/stream_items_reports?itemId=' + offset + '&access_token=' + accessToken + "&act=" + action,
                        data: 'itemId=' + offset + "&access_token=" + accessToken + "&act=" + action,
                        timeout: 30000,
                        success: function(response){

                            $('tr.data-item[data-id=' + offset + ']').remove();
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

<?php

    function draw($item)
    {
        ?>

            <tr class="data-item" data-id="<?php echo $item['id']; ?>">
                <td style="width:50px;">

                    <?php

                        if ($item['fromUserId'] != 0 && !empty($item['owner'])) {

                            $email = $item['owner']['email'];

                            if (APP_DEMO && strlen($email) > 8) {

                                $email = "*****".substr($email, -8);
                            }

                            ?>
                                <h6><a href="/admin/profile?id=<?php echo $item['fromUserId']; ?>"><i class="ti-user"></i> <?php echo $email; ?></a></h6>
                            <?php

                        } else {

                            ?>
                                <h6>-</h6>
                            <?php
                        }
                    ?>

                </td>
                <td>
                    <h6><a href="/admin/item?id=<?php echo $item['itemId']; ?>"><i class="ti-comment"></i> View item</a></h6>
                </td>
                <td>
                    <?php

                        switch ($item['abuseId']) {

                            case 0: {

                                echo "<span class=\"label label-success\">This is spam.</span>";

                                break;
                            }

                            case 1: {

                                echo "<span class=\"label label-info\">Hate Speech or violence.</span>";

                                break;
                            }

                            case 2: {

                                echo "<span class=\"label label-danger\">Nudity or Pornography.</span>";

                                break;
                            }

                            default: {

                                echo "<span class=\"label label-warning\">Piracy.</span>";

                                break;
                            }
                        }
                    ?>
                </td>
                <td><?php echo $item['date']; ?></td>
                <td>
                    <a href="javascript:void(0)" onclick="Reports.remove('<?php echo $item['id']; ?>', '<?php echo admin::getAccessToken(); ?>', 'remove'); return false;" class="text-inverse"><i class="ti-trash"></i> Delete</a>
                </td>
            </tr>

        <?php
    }