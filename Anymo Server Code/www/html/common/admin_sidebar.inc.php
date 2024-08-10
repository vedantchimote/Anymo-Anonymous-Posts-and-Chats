<?php



if (!defined("APP_SIGNATURE")) {

    header("Location: /");
    exit;
}

?>

<aside class="left-sidebar">

    <div class="scroll-sidebar"> <!-- Sidebar scroll-->

        <nav class="sidebar-nav"> <!-- Sidebar navigation-->

            <ul id="sidebarnav">

                <li class="nav-small-cap">General</li>

                <li>
                    <a class="waves-effect waves-dark <?php if (isset($page_id) && $page_id === "main") { echo "active";} ?>" href="/admin/main" aria-expanded="false">
                        <i class="ti-dashboard"></i>
                        <span class="hide-menu">Dashboard</span>
                    </a>
                </li>
                <!--<li>-->
                <!--    <a class="waves-effect waves-dark <?php if (isset($page_id) && $page_id === "admob") { echo "active";} ?>" href="/admin/admob" aria-expanded="false">-->
                <!--        <i class="ti-layout-media-center"></i>-->
                <!--        <span class="hide-menu">Ads & Interstitial</span>-->
                <!--    </a>-->
                <!--</li>-->
                <li>
                    <a class="waves-effect waves-dark <?php if (isset($page_id) && $page_id === "fcm") { echo "active";} ?>" href="/admin/fcm" aria-expanded="false">
                        <i class="ti-bell"></i>
                        <span class="hide-menu">Push Notifications</span>
                    </a>
                </li>
                <li>
                    <a class="waves-effect waves-dark <?php if (isset($page_id) && $page_id === "users") { echo "active";} ?>" href="/admin/users" aria-expanded="false">
                        <i class=" ti-search"></i>
                        <span class="hide-menu">Search Accounts</span>
                    </a>
                </li>

                <li class="nav-devider"></li>

                <li class="nav-small-cap">Stream</li>

                <li>
                    <a class="waves-effect waves-dark <?php if (isset($page_id) && $page_id === "stream_items") { echo "active";} ?>" href="/admin/stream_items" aria-expanded="false">
                        <i class="ti-menu"></i>
                        <span class="hide-menu">Secrets</span>
                    </a>
                </li>

                <li>
                    <a class="waves-effect waves-dark <?php if (isset($page_id) && $page_id === "stream_comments") { echo "active";} ?>" href="/admin/stream_comments" aria-expanded="false">
                        <i class="ti-comment"></i>
                        <span class="hide-menu">Comments</span>
                    </a>
                </li>

                <li>
                    <a class="waves-effect waves-dark <?php if (isset($page_id) && $page_id === "stream_messages") { echo "active";} ?>" href="/admin/stream_messages" aria-expanded="false">
                        <i class="ti-email"></i>
                        <span class="hide-menu">Messages</span>
                    </a>
                </li>

                <li>
                    <a class="waves-effect waves-dark <?php if (isset($page_id) && $page_id === "stream_items_reports") { echo "active";} ?>" href="/admin/stream_items_reports" aria-expanded="false">
                        <i class="ti-alert"></i>
                        <span class="hide-menu">Reports</span>
                    </a>
                </li>

                <li class="nav-devider"></li>

                <li class="nav-small-cap">Settings and Others</li>

                <li>
                    <a class="waves-effect waves-dark <?php if (isset($page_id) && $page_id === "app") { echo "active";} ?>" href="/admin/app" aria-expanded="false">
                        <i class="ti-mobile"></i>
                        <span class="hide-menu">App Settings</span>
                    </a>
                </li>

                <li>
                    <a class="waves-effect waves-dark <?php if (isset($page_id) && $page_id === "support") { echo "active";} ?>" href="/admin/support" aria-expanded="false">
                        <i class="ti-help-alt"></i>
                        <span class="hide-menu">Support</span>
                    </a>
                </li>

                <li>
                    <a class="waves-effect waves-dark <?php if (isset($page_id) && $page_id === "settings") { echo "active";} ?>" href="/admin/settings" aria-expanded="false">
                        <i class="ti-settings"></i>
                        <span class="hide-menu">Settings</span>
                    </a>
                </li>
                <li>
                    <a class="waves-effect waves-dark" href="/admin/logout/?access_token=<?php echo admin::getAccessToken(); ?>&continue=/" aria-expanded="false">
                        <i class="ti-power-off"></i>
                        <span class="hide-menu">Logout</span>
                    </a>
                </li>
            </ul>
        </nav> <!-- End Sidebar navigation -->
    </div> <!-- End Sidebar scroll-->
</aside>