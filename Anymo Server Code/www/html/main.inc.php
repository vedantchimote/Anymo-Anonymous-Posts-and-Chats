<?php



if (!defined("APP_SIGNATURE")) {

    header("Location: /");
    exit;
}

?>

<!DOCTYPE html>

<html class="js sizes customelements history pointerevents postmessage webgl websockets cssanimations csscolumns csscolumns-width csscolumns-span csscolumns-fill csscolumns-gap csscolumns-rule csscolumns-rulecolor csscolumns-rulestyle csscolumns-rulewidth csscolumns-breakbefore csscolumns-breakafter csscolumns-breakinside flexbox picture srcset webworkers" lang="zxx">

<head>

    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title><?php echo APP_TITLE; ?></title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/x-icon" href="/img/favicon.png">

    <link rel="stylesheet" href="/css/bootstrap.css">
    <link rel="stylesheet" href="/css/landing.css">
</head>

<body style="overflow: visible;">

<main>

    <div class="available-app-area">
        <div class="container">
            <div class="row d-flex justify-content-between">

                <div class="col-xl-6 col-lg-6">
                    <div class="app-caption">
                        <div class="section-tittle section-tittle3">

                            <p class="text-center ">
                                <img src="/img/logo.png" style="width: 320px" alt="">
                            </p>

                            <p class="text-center">The Anymo application makes it possible to publish text and graphic information anonymously. Users can post anonymously, write anonymously comments, and create anonymous chats.</p>

                            <p class="text-center">The post feed is based on device geolocation to make it easier for users to find anonymous posts in their region.</p>

                            <p class="text-center">When creating posts, you can select the background color, text, add images and set their transparency. This makes it possible to create unique and beautiful posts!</p>

                            <p class="text-center">For the convenience and protection of users, there are filters for the search feed: users can prohibit the display of posts with pictures or posts with complaints</p>

                            <div class="app-img d-block d-lg-none position-static mb-5" style="width: auto;">
                                <img src="/img/google_pixel.png" alt="">
                            </div>

                            

                        </div>
                    </div>
                </div>

                <div class="col-xl-6 col-lg-6" style="display: flex; align-items: center; justify-content: center;">
                    <div class="app-img d-none d-lg-block" style="width: 280px;">
                        <img src="/img/google_pixel.png" alt="">
                    </div>
                </div>

            </div>

            <div class="row">

                <?php

                    include_once("../html/common/footer.inc.php");
                ?>

            </div>

        </div>

    </div>


</main>


</body>
</html>