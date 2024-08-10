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
    $query = '';
    $result = array();
    $result['users'] = array();

    $stats = new stats($dbo);
    $settings = new settings($dbo);
    $admin = new admin($dbo);

    if (isset($_GET['query'])) {

        $query = isset($_GET['query']) ? $_GET['query'] : '';

        $query = helper::clearText($query);
        $query = helper::escapeText($query);

        if (strlen($query) > 2) {

            $result = $stats->searchAccounts(0, $query);
        }
    }

    helper::newAuthenticityToken();

    $page_id = "users";

    $css_files = array("mytheme.css");
    $page_title = "Search Accounts | Admin Panel";

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
                            <li class="breadcrumb-item active">Search Accounts</li>
                        </ol>
                    </div>
                </div>

                <?php

                    include_once("../html/common/admin_banner.inc.php");
                ?>

                <div class="row">
                    <div class="col-sm-12">
                        <div class="card card-body">
                            <h4 class="card-title">Search Accounts</h4>
                            <h6 class="card-subtitle">Find accounts by email or phone. Minimum of 3 characters.</h6>
                            <div class="row">


                                <div class="col-sm-12 col-xs-12">
                                    <form class="input-form" method="get" action="/admin/users">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="input-group">
                                                    <input type="text" class="form-control" id="query" name="query" value="<?php echo stripslashes($query); ?>" placeholder="Find accounts by email or phone...">
                                                    <div class="input-group-append">
                                                        <button type="submit" class="btn btn-info" type="button">Search</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <br>

                                        <!-- form-group -->
                                    </form>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

                <?php

                    if (count($result['users']) > 0) {

                        ?>

                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-body">

                                        <div class="d-flex no-block">
                                            <h4 class="card-title">Search Accounts</h4>
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

                    } else {

                        if (strlen($query) < 3) {

                            ?>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="card text-center">
                                        <div class="card-body">
                                            <h4 class="card-title">List is empty.</h4>
                                            <p class="card-text">Enter in the search box username, communities, full name or email. Minimum of 3 characters.</p>
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
                                            <h4 class="card-title">Matches found: 0</h4>
                                            <p class="card-text">This means that there is no data to display :)</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <?php
                        }
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