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
    $settings = new settings($dbo);
    $admin = new admin($dbo);

    $allowGoogleAuthorization = 1;
    $allowMultiAccountsFunction = 1;

    $defaultAllowMessages = 0;

    if (!empty($_POST)) {

        $authToken = isset($_POST['authenticity_token']) ? $_POST['authenticity_token'] : '';

        $allowGoogleAuthorization_checkbox = isset($_POST['allowGoogleAuth']) ? $_POST['allowGoogleAuth'] : '';
        $allowMultiAccountsFunction_checkbox = isset($_POST['allowMultiAccountsFunction']) ? $_POST['allowMultiAccountsFunction'] : '';

        $defaultAllowMessages_checkbox = isset($_POST['defaultAllowMessages']) ? $_POST['defaultAllowMessages'] : '';

        if ($authToken === helper::getAuthenticityToken() && !APP_DEMO) {

            if ($allowGoogleAuthorization_checkbox === "on") {

                $allowGoogleAuthorization = 1;

            } else {

                $allowGoogleAuthorization = 0;
            }

            if ($allowMultiAccountsFunction_checkbox === "on") {

                $allowMultiAccountsFunction = 1;

            } else {

                $allowMultiAccountsFunction = 0;
            }

            if ($defaultAllowMessages_checkbox === "on") {

                $defaultAllowMessages = 1;

            } else {

                $defaultAllowMessages = 0;
            }

            $settings->setValue("allowGoogleAuth", $allowGoogleAuthorization);
            $settings->setValue("allowMultiAccountsFunction", $allowMultiAccountsFunction);
            $settings->setValue("defaultAllowMessages", $defaultAllowMessages);
        }
    }

    $config = $settings->get();

    $arr = array();

    $arr = $config['allowGoogleAuth'];
    $allowGoogleAuthorization = $arr['intValue'];

    $arr = $config['allowMultiAccountsFunction'];
    $allowMultiAccountsFunction = $arr['intValue'];

    $arr = $config['defaultAllowMessages'];
    $defaultAllowMessages = $arr['intValue'];

    $page_id = "app";

    $error = false;
    $error_message = '';

    helper::newAuthenticityToken();

    $css_files = array("mytheme.css");
    $page_title = "App Settings";

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
                            <li class="breadcrumb-item active">App Settings</li>
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
                                <h4 class="card-title">App Settings</h4>
                                <h6 class="card-subtitle">Change application settings</h6>

                                <form action="/admin/app" method="post">

                                    <input type="hidden" name="authenticity_token" value="<?php echo helper::getAuthenticityToken(); ?>">

                                    <div class="form-group">

                                        <p>
                                            <input type="checkbox" name="allowGoogleAuth" id="allowGoogleAuth" <?php if ($allowGoogleAuthorization == 1) echo "checked=\"checked\"";  ?> />
                                            <label for="allowGoogleAuth">Allow registration/authorization via Google</label>
                                        </p>

                                        <p>
                                            <input type="checkbox" name="allowMultiAccountsFunction" id="allowMultiAccountsFunction" <?php if ($allowMultiAccountsFunction == 1) echo "checked=\"checked\"";  ?> />
                                            <label for="allowMultiAccountsFunction">Enable creation of multi-accounts</label>
                                        </p>

                                        <p>
                                            <input type="checkbox" name="defaultAllowMessages" id="defaultAllowMessages" <?php if ($defaultAllowMessages == 1) echo "checked=\"checked\"";  ?> />
                                            <label for="defaultAllowMessages">Allow private messages from all users by default (activating this option can increase the flow of spam in messages, each user can change this option in the settings of his account)</label>
                                        </p>
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