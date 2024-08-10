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

    $error = false;
    $error_message = '';

    $stats = new stats($dbo);
    $admin = new admin($dbo);

    $accountInfo = array();

    if (isset($_GET['id'])) {

        $accountId = isset($_GET['id']) ? $_GET['id'] : 0;
        $accessToken = isset($_GET['access_token']) ? $_GET['access_token'] : 0;
        $act = isset($_GET['act']) ? $_GET['act'] : '';

        $accountId = helper::clearInt($accountId);

        $account = new account($dbo, $accountId);
        $accountInfo = $account->get();

        $messages = new msg($dbo);
        $messages->setRequestFrom($accountId);

        $comments = new comments($dbo);
        $comments->setRequestFrom($accountId);

        if ($accessToken === admin::getAccessToken() && !APP_DEMO) {

            switch ($act) {

                case "disconnect": {

                    $account->setGoogleFirebaseId('');

                    header("Location: /admin/profile?id=".$accountInfo['id']);
                    break;
                }

                case "close": {

                    $auth->removeAll($accountId);

                    header("Location: /admin/profile?id=".$accountInfo['id']);
                    break;
                }

                case "block": {

                    $auth->removeAll($accountId);
                    $account->setState(ACCOUNT_STATE_BLOCKED);

                    $items = new items($dbo);
                    $items->setRequestFrom($accountInfo['id']);
                    $items->removeByAccountId($accountInfo['id']);
                    unset($items);

                    $comments = new comments($dbo);
                    $comments->setRequestFrom($accountInfo['id']);
                    $comments->removeByAccountId($accountInfo['id']);
                    unset($comments);

                    $messages = new msg($dbo);
                    $messages->setRequestFrom($accountInfo['id']);
                    $messages->removeChatsByAccountId($accountInfo['id']);
                    unset($messages);

                    header("Location: /admin/profile?id=".$accountInfo['id']);
                    break;
                }

                case "unblock": {

                    $account->setState(ACCOUNT_STATE_ENABLED);

                    header("Location: /admin/profile?id=".$accountInfo['id']);
                    break;
                }

                default: {

                    if (!empty($_POST)) {

                        $authToken = isset($_POST['authenticity_token']) ? $_POST['authenticity_token'] : '';
                        $otpPhone = isset($_POST['otpPhone']) ? $_POST['otpPhone'] : '';
                        $email = isset($_POST['email']) ? $_POST['email'] : '';

                        $otpPhone = helper::clearText($otpPhone);
                        $otpPhone = helper::escapeText($otpPhone);

                        $email = helper::clearText($email);
                        $email = helper::escapeText($email);

                        if ($authToken === helper::getAuthenticityToken()) {

                            if (strlen($otpPhone) != 0) {

                                $account->updateOtpVerification($otpPhone, 1);

                            } else {

                                $account->updateOtpVerification($otpPhone, 0);
                            }

                            $account->setEmail($email);
                        }
                    }

                    header("Location: /admin/profile/?id=".$accountInfo['id']);
                    exit;
                }
            }
        }

    } else {

        header("Location: /admin/main");
        exit;
    }

    if ($accountInfo['error']) {

        header("Location: /admin/main");
        exit;
    }

    if (APP_DEMO) {

        if (strlen($accountInfo['otpPhone']) > 6) {

            $accountInfo['otpPhone'] = "*****".substr($accountInfo['otpPhone'], -6);
        }

        if (strlen($accountInfo['email']) > 8) {

            $accountInfo['email'] = "*****".substr($accountInfo['email'], -8);
        }
    }

    $page_id = "account";

    helper::newAuthenticityToken();

    $css_files = array("mytheme.css");
    $page_title = "Account Info | Admin Panel";

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
                            <li class="breadcrumb-item active">Account Info</li>
                        </ol>
                    </div>
                </div>

                <?php

                    include_once("../html/common/admin_banner.inc.php");
                ?>


                <div class="row">

                    <div class="col-lg-8">

                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Account Info</h4>
                                <h6 class="card-subtitle">
                                    <a href="/admin/personal_gcm?id=<?php echo $accountInfo['id']; ?>">
                                        <button class="btn waves-effect waves-light btn-info">Send Personal FCM Message</button>
                                    </a>
                                </h6>
                                <div class="table-responsive">
                                    <table class="table color-table info-table">
                                        <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Value/Count</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <th class="text-left">Name</th>
                                            <th>Value/Count</th>
                                            <th>Action</th>
                                        </tr>
                                        <tr>
                                            <td class="text-left">Email:</td>
                                            <td><?php echo $accountInfo['email']; ?></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td class="text-left">Phone Number:</td>
                                            <td><?php echo $accountInfo['otpPhone']; ?></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td class="text-left">Google account:</td>
                                            <td><?php if (strlen($accountInfo['gl_id']) == 0) {echo "Not connected to Google.";} else {echo "Connected to Google.";} ?></td>
                                            <td><?php if (strlen($accountInfo['gl_id']) == 0) {echo "";} else {echo "<a href=\"/admin/profile?id={$accountInfo['id']}&access_token=".admin::getAccessToken()."&act=disconnect\">Remove connection</a>";} ?></td>
                                        </tr>
                                        <tr>
                                            <td class="text-left">SignUp Ip address:</td>
                                            <td><?php if (!APP_DEMO) {echo $accountInfo['ip_addr'];} else {echo "It is not available in the demo version";} ?></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td class="text-left">SignUp Date:</td>
                                            <td><?php echo date("Y-m-d H:i:s", $accountInfo['signUpAt']); ?></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td class="text-left">Account state:</td>
                                            <td>
                                                <?php

                                                if ($accountInfo['state'] == ACCOUNT_STATE_ENABLED) {

                                                    echo "<span>Account is active</span>";

                                                } else {

                                                    echo "<span>Account is blocked</span>";
                                                }
                                                ?>
                                            </td>
                                            <td>
                                                <?php

                                                if ($accountInfo['state'] == ACCOUNT_STATE_ENABLED) {

                                                    ?>
                                                        <a class="" href="/admin/profile?id=<?php echo $accountInfo['id']; ?>&access_token=<?php echo admin::getAccessToken(); ?>&act=block">Block account</a>
                                                    <?php

                                                } else {

                                                    ?>
                                                        <a class="" href="/admin/profile?id=<?php echo $accountInfo['id']; ?>&access_token=<?php echo admin::getAccessToken(); ?>&act=unblock">Unblock account</a>
                                                    <?php
                                                }
                                                ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="text-left">Total user items:</td>
                                            <td><?php echo $stats->getUserItemsTotal($accountInfo['id']); ?></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td class="text-left">User active items (not removed):</td>
                                            <td>
                                                <?php
                                                $active_items = $stats->getUserItemsCount($accountInfo['id']);
                                                echo $active_items;
                                                ?>
                                            </td>
                                            <td>
                                                <?php
                                                if ($active_items > 0) {

                                                    ?>
                                                        <a href="/admin/profile_items?id=<?php echo $accountInfo['id']; ?>" >View</a></td>
                                                    <?php
                                                }
                                            ?>
                                        </tr>
                                        <tr>
                                            <td class="text-left">User active messages (not removed):</td>
                                            <td>
                                                <?php

                                                    $active_messages = $messages->myActiveMessagesCount();

                                                    echo $active_messages;
                                                ?>
                                            </td>
                                            <td>
                                                <?php

                                                    if ($active_messages > 0) {

                                                        ?>
                                                            <a href="/admin/profile_messages?id=<?php echo $accountInfo['id']; ?>" >View</a></td>
                                                        <?php
                                                    }
                                            ?>
                                        </tr>

                                        <tr>
                                            <td class="text-left">User active comments (not removed):</td>
                                            <td>
                                                <?php

                                                    $active_comments = $comments->myActiveCommentsCount();

                                                    echo $active_comments;
                                                ?>
                                            </td>
                                            <td>
                                                <?php

                                                if ($active_comments > 0) {

                                                    ?>
                                                        <a href="/admin/profile_comments?id=<?php echo $accountInfo['id']; ?>" >View</a></td>
                                                    <?php
                                                }
                                            ?>
                                        </tr>

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Edit Profile</h4>

                                <form class="form-material m-t-40" method="post" action="/admin/profile?id=<?php echo $accountInfo['id']; ?>&access_token=<?php echo admin::getAccessToken(); ?>">

                                    <input type="hidden" name="authenticity_token" value="<?php echo helper::getAuthenticityToken(); ?>">

                                    <div class="form-group">
                                        <label class="col-md-12">Email</label>
                                        <div class="col-md-12">
                                            <input placeholder="Email" id="email" type="text" name="email" maxlength="255" value="<?php echo $accountInfo['email']; ?>" class="form-control form-control-line">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-12">Phone (OTP)</label>
                                        <div class="col-md-12">
                                            <input placeholder="Phone Number" id="otpPhone" type="text" name="otpPhone" maxlength="255" value="<?php echo $accountInfo['otpPhone']; ?>" class="form-control form-control-line">
                                        </div>
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

                <?php
                    $result = $stats->getAuthData($accountInfo['id'], 0);

                    $inbox_loaded = count($result['data']);

                    if ($inbox_loaded != 0) {

                        ?>

                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title">Authorizations</h4>
                                        <h6 class="card-subtitle">
                                            <a href="/admin/profile?id=<?php echo $accountInfo['id']; ?>&access_token=<?php echo admin::getAccessToken(); ?>&act=close">
                                                <button class="btn waves-effect waves-light btn-info">Close all authorizations</button>
                                            </a>
                                        </h6>
                                        <div class="table-responsive">

                                            <table class="table color-table info-table">

                                                <thead>
                                                    <tr>
                                                        <th class="text-left">Id</th>
                                                        <th>Access token</th>
                                                        <th>Client Id</th>
                                                        <th>Create At</th>
                                                        <th>Close At</th>
                                                        <th>User agent</th>
                                                        <th>Ip address</th>
                                                    </tr>
                                                </thead>

                                                <tbody>
                                                    <?php

                                                        foreach ($result['data'] as $key => $value) {

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

        </div> <!-- End Page wrapper  -->
    </div> <!-- End Wrapper -->

</body>

</html>

<?php

    function draw($authObj)
    {
        ?>

        <tr>
            <td class="text-left"><?php echo $authObj['id']; ?></td>
            <td><?php echo $authObj['accessToken']; ?></td>
            <td><?php echo $authObj['clientId']; ?></td>
            <td><?php echo date("Y-m-d H:i:s", $authObj['createAt']); ?></td>
            <td><?php if ($authObj['removeAt'] == 0) {echo "-";} else {echo date("Y-m-d H:i:s", $authObj['removeAt']);} ?></td>
            <td><?php echo $authObj['u_agent']; ?></td>
            <td><?php if (!APP_DEMO) {echo $authObj['ip_addr'];} else {echo "It is not available in the demo version";} ?></td>
        </tr>

        <?php
    }
