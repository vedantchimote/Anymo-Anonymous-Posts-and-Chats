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

    $page_id = "main";

    $css_files = array("mytheme.css");
    $page_title = "Dashboard";

    include_once("../html/common/admin_header.inc.php");
?>

<body class="fix-header fix-sidebar card-no-border">
    <!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== -->

    <!-- ============================================================== -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <div id="main-wrapper">

        <?php

            include_once("../html/common/admin_topbar.inc.php");
        ?>

        <?php

            include_once("../html/common/admin_sidebar.inc.php");
        ?>

        <div class="page-wrapper"> <!-- Page wrapper  -->

            <div class="container-fluid"> <!-- Container fluid  -->

                <div class="row page-titles">
                    <div class="col-md-5 col-8 align-self-center">
                        <h3 class="text-themecolor">Dashboard</h3>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                            <li class="breadcrumb-item active">Dashboard</li>
                        </ol>
                    </div>
                </div>

                <div class="row">
                    <!-- Column -->
                    <div class="col-lg-3 col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex flex-row">
                                    <div class="round round-lg align-self-center round-info">
                                        <i class="ti-user"></i>
                                    </div>
                                    <div class="m-l-10 align-self-center">
                                        <h3 class="m-b-0 font-light"><?php echo $stats->getUsersCount(); ?></h3>
                                        <h5 class="text-muted m-b-0">Total Users</h5></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Column -->
                    <!-- Column -->
                    <div class="col-lg-3 col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex flex-row">
                                    <div class="round round-lg align-self-center round-danger"><i class="ti-layout-list-post"></i></div>
                                    <div class="m-l-10 align-self-center">
                                        <h3 class="m-b-0 font-lgiht"><?php echo $stats->getItemsTotal(); ?></h3>
                                        <h5 class="text-muted m-b-0">Total Secrets</h5></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Column -->
                    <!-- Column -->
                    <div class="col-lg-3 col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex flex-row">
                                    <div class="round round-lg align-self-center round-warning">
                                        <i class="ti-comment-alt"></i>
                                    </div>
                                    <div class="m-l-10 align-self-center">
                                        <h3 class="m-b-0 font-lgiht"><?php echo $stats->getCommentsTotal(); ?></h3>
                                        <h5 class="text-muted m-b-0">Total Comments</h5></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Column -->
                    <!-- Column -->
                    <div class="col-lg-3 col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex flex-row">
                                    <div class="round round-lg align-self-center round-primary"><i class="ti-comments"></i></div>
                                    <div class="m-l-10 align-self-center">
                                        <h3 class="m-b-0 font-lgiht"><?php echo $stats->getMessagesTotal(); ?></h3>
                                        <h5 class="text-muted m-b-0">Total Messages</h5></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Column -->
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title m-b-0">Full Statistics</h4>
                            </div>
                            <div class="card-body collapse show">
                                <div class="table-responsive">
                                    <table class="table product-overview">
                                        <thead>
                                        <tr>
                                            <th class="text-left">Name</th>
                                            <th>Count</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td class="text-left">Accounts</td>
                                            <td><?php echo $stats->getUsersCount(); ?></td>
                                        </tr>
                                        <tr>
                                            <td class="text-left">Active accounts</td>
                                            <td><?php echo $stats->getUsersCountByState(ACCOUNT_STATE_ENABLED); ?></td>
                                        </tr>
                                        <tr>
                                            <td class="text-left">Blocked accounts</td>
                                            <td><?php echo $stats->getUsersCountByState(ACCOUNT_STATE_BLOCKED); ?></td>
                                        </tr>
                                        <tr>
                                            <td class="text-left">Total comments</td>
                                            <td><?php echo $stats->getCommentsTotal(); ?></td>
                                        </tr>
                                        <tr>
                                            <td class="text-left">Total active comments (not removed)</td>
                                            <td><?php echo $stats->getCommentsCount(); ?></td>
                                        </tr>
                                        <tr>
                                            <td class="text-left">Total likes</td>
                                            <td><?php echo $stats->getLikesTotal(); ?></td>
                                        </tr>
                                        <tr>
                                            <td class="text-left">Total active likes (not removed)</td>
                                            <td><?php echo $stats->getLikesCount(); ?></td>
                                        </tr>
                                        <tr>
                                            <td class="text-left">Total posts</td>
                                            <td><?php echo $stats->getItemsTotal(); ?></td>
                                        </tr>
                                        <tr>
                                            <td class="text-left">Total active posts (not removed)</td>
                                            <td><?php echo $stats->getItemsCount(); ?></td>
                                        </tr>
                                        <tr>
                                            <td class="text-left">Total chats</td>
                                            <td><?php echo $stats->getChatsTotal(); ?></td>
                                        </tr>
                                        <tr>
                                            <td class="text-left">Total active chats (not removed)</td>
                                            <td><?php echo $stats->getChatsCount(); ?></td>
                                        </tr>
                                        <tr>
                                            <td class="text-left">Total messages</td>
                                            <td><?php echo $stats->getMessagesTotal(); ?></td>
                                        </tr>
                                        <tr>
                                            <td class="text-left">Total active messages (not removed)</td>
                                            <td><?php echo $stats->getMessagesCount(); ?></td>
                                        </tr>
                                        </tbody>

                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <?php

                    $result = $stats->getAccounts(0);

                    $inbox_loaded = count($result['users']);

                    if ($inbox_loaded != 0) {

                        ?>

                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="d-flex no-block">
                                            <h4 class="card-title">The recently registered users</h4>
                                        </div>
                                        <div class="table-responsive m-t-20">
                                            <table class="table stylish-table">
                                                <thead>
                                                <tr>
                                                    <th>Email</th>
                                                    <th>Account state</th>
                                                    <th>Google</th>
                                                    <th>OTP</th>
                                                    <th>Phone number</th>
                                                    <th>Sign up date</th>
                                                    <th>Ip address</th>
                                                    <th>Action</th>
                                                </tr>
                                                </thead>
                                                <tbody>

                                                <?php

                                                    foreach ($result['users'] as $key => $value) {

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

                    }
                ?>


            </div> <!-- End Container fluid  -->

            <?php

                include_once("../html/common/admin_footer.inc.php");
            ?>

        </div> <!-- End Page wrapper  -->

    </div> <!-- End Main Wrapper -->

</body>

</html>

<?php

    function draw($user)
    {
        ?>
            <tr>
                <td>
                    <?php

                        $email = $user['email'];

                        if (APP_DEMO && strlen($email) > 8) {

                            $email = "*****".substr($email, -8);
                        }
                    ?>
                    <h6><?php echo $email; ?></h6>
                </td>
                <td>
                    <h6><?php if ($user['state'] == 0) {echo "Enabled";} else {echo "Blocked";} ?></h6>
                </td>
                <td>
                    <h6><?php if (strlen($user['gl_id']) == 0) {echo "Not connected to google.";} else {echo "Account linked to google.";} ?></h6>
                </td>
                <td>
                    <h6><?php if ($user['otpVerified'] == 0) {echo "Not phone number linked.";} else {echo "Linked to phone number.";} ?></h6>
                </td>
                <td>
                    <?php
                        if (!APP_DEMO) {

                            if (strlen($user['otpPhone'])) {

                                $otpPhone = $user['otpPhone'];

                                if (APP_DEMO && strlen($otpPhone) > 6) {

                                    $otpPhone = "*****".substr($otpPhone, -6);
                                }

                                echo $otpPhone;

                            } else {

                                echo "-";
                            }

                        } else {

                            echo "It is not available in the demo version";
                        }
                    ?>
                </td>
                <td><?php echo date("Y-m-d H:i:s", $user['signUpAt']); ?></td>
                <td><?php if (!APP_DEMO) {echo $user['ip_addr'];} else {echo "It is not available in the demo version";} ?></td>
                <td><a href="/admin/profile?id=<?php echo $user['id']; ?>">Go to account</a></td>
            </tr>

        <?php
    }