<?php

 

    if (!admin::isSession()) {

        header("Location: /admin/login");
        exit;
    }

    // Administrator info

    $admin = new admin($dbo);
    $admin->setId(admin::getCurrentAdminId());

    //

    $stats = new stats($dbo);
    $settings = new settings($dbo);

    $defaultAdmobAdAfterItem = 1;
    $defaultInterstitialAdAfterNewItem = 1;
    $defaultInterstitialAdAfterNewLike = 5;

    if (!empty($_POST)) {

        $authToken = isset($_POST['authenticity_token']) ? $_POST['authenticity_token'] : '';

        $defaultAdmobAdAfterItem = isset($_POST['defaultAdmobAdAfterItem']) ? $_POST['defaultAdmobAdAfterItem'] : 1;
        $defaultInterstitialAdAfterNewItem = isset($_POST['defaultInterstitialAdAfterNewItem']) ? $_POST['defaultInterstitialAdAfterNewItem'] : 1;
        $defaultInterstitialAdAfterNewLike = isset($_POST['defaultInterstitialAdAfterNewLike']) ? $_POST['defaultInterstitialAdAfterNewLike'] : 1;

        if ($authToken === helper::getAuthenticityToken() && !APP_DEMO) {

            $defaultAdmobAdAfterItem = helper::clearInt($defaultAdmobAdAfterItem);
            $defaultInterstitialAdAfterNewItem = helper::clearInt($defaultInterstitialAdAfterNewItem);
            $defaultInterstitialAdAfterNewLike = helper::clearInt($defaultInterstitialAdAfterNewLike);

            $settings->setValue("admobAdAfterItem", $defaultAdmobAdAfterItem);
            $settings->setValue("interstitialAdAfterNewItem", $defaultInterstitialAdAfterNewItem);
            $settings->setValue("interstitialAdAfterNewLike", $defaultInterstitialAdAfterNewLike);
        }
    }

    $config = $settings->get();

    $arr = array();

    $arr = $config['admobAdAfterItem'];
    $defaultAdmobAdAfterItem = $arr['intValue'];

    $arr = $config['interstitialAdAfterNewItem'];
    $defaultInterstitialAdAfterNewItem = $arr['intValue'];

    $arr = $config['interstitialAdAfterNewLike'];
    $defaultInterstitialAdAfterNewLike = $arr['intValue'];

    $page_id = "admob";

    $error = false;
    $error_message = '';

    helper::newAuthenticityToken();

    $css_files = array("mytheme.css");
    $page_title = "Admob Ad and Interstitial Settings";

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
                        </ol>
                    </div>
                </div>

                <?php

                    include_once("../html/common/admin_banner.inc.php");
                ?>

                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                               
                                <form action="/admin/admob" method="post">

                                    <input type="hidden" name="authenticity_token" value="<?php echo helper::getAuthenticityToken(); ?>">

                                    <div class="form-group">
                                        <label for="defaultAdmobAdAfterItem" class="active">After how many items in list show Ad Native (0 = do not show)</label>
                                        <input class="form-control" id="defaultAdmobAdAfterItem" type="number" size="4" name="defaultAdmobAdAfterItem" value="<?php echo $defaultAdmobAdAfterItem; ?>">
                                    </div>

                                    <div class="form-group">
                                        <label for="defaultInterstitialAdAfterNewItem" class="active">Show Interstitial ads after how many new items have been created (0 = do not show)</label>
                                        <input class="form-control" id="defaultInterstitialAdAfterNewItem" type="number" size="4" name="defaultInterstitialAdAfterNewItem" value="<?php echo $defaultInterstitialAdAfterNewItem; ?>">
                                    </div>

                                    <div class="form-group">
                                        <label for="defaultInterstitialAdAfterNewLike" class="active">Show Interstitial ads after how many likes (0 = do not show)</label>
                                        <input class="form-control" id="defaultInterstitialAdAfterNewLike" type="number" size="4" name="defaultInterstitialAdAfterNewLike" value="<?php echo $defaultInterstitialAdAfterNewLike; ?>">
                                    </div>

                                    <div class="form-group">
                                        <div class="col-xs-12">
                                            <button class="btn btn-info text-uppercase waves-effect waves-light" type="submit">Save</button>
                                        </div>
                                    </div>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>



            </div> <!-- End Container fluid  -->

            <?php

                include_once("../html/common/admin_footer.inc.php");
            ?>

        </div> <!-- End Page wrapper  -->
    </div> <!-- End Wrapper -->

</body>

</html>