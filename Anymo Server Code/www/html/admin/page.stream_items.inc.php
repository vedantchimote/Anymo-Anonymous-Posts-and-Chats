<?php

    /*!
     * https://raccoonsquare.com
     * raccoonsquare@gmail.com
     *
     * Copyright 2012-2022 Demyanchuk Dmitry (raccoonsquare@gmail.com)
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
	$items = new items($dbo);
    $settings = new settings($dbo);

	if (isset($_GET['itemId'])) {

		$act = isset($_GET['act']) ? $_GET['act'] : "";
		$itemId = isset($_GET['itemId']) ? $_GET['itemId'] : 0;
		$accessToken = isset($_GET['access_token']) ? $_GET['access_token'] : 0;

		$itemId = helper::clearInt($itemId);

		if ($accessToken === admin::getAccessToken() && !APP_DEMO) {

			switch ($act) {

				case "remove": {

                    $items->remove($itemId);

					break;
				}

				case "remove_all_by_ip": {

					$itemInfo = $items->info($itemId);
                    $items->removeByIp($itemInfo['ip_addr']);

					break;
				}

                case "pin": {

                    $settings->setValue("pinnedItemId", $itemId);

                    break;
                }

                case "unpin": {

                    $settings->setValue("pinnedItemId", 0);

                    break;
                }

				default: {

					break;
				}
			}
		}

		exit;
	}

	$inbox_all = 1000000;
	$inbox_loaded = 0;

	if (!empty($_POST)) {

		$itemId = isset($_POST['itemId']) ? $_POST['itemId'] : 0;
		$loaded = isset($_POST['loaded']) ? $_POST['loaded'] : 0;

		$itemId = helper::clearInt($itemId);
		$loaded = helper::clearInt($loaded);

		$result = $items->flow("", $itemId, 0, 0, 1000000, 0.0, 0.0);

		$inbox_loaded = count($result['items']);

		$result['inbox_loaded'] = $inbox_loaded + $loaded;
		$result['inbox_all'] = $inbox_all;

		if ($inbox_loaded != 0) {

			ob_start();

			foreach ($result['items'] as $key => $value) {

				draw($value);
			}

			$result['html'] = ob_get_clean();

			if ($inbox_loaded >= 20) {

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

	$page_id = "stream_items";

	$css_files = array("mytheme.css");
	$page_title = "Stream | Admin Panel";

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
							<li class="breadcrumb-item active">Stream</li>
						</ol>
					</div>
				</div>

				<?php

					include_once("../html/common/admin_banner.inc.php");
				?>

				<?php

					$result = $items->flow("", 0, 0, 0, 100000, 0.0, 0.0);

					$inbox_loaded = count($result['items']);

					if ($inbox_loaded != 0) {

						?>

						<div class="col-lg-12 ">
							<div class="card">
                                <div class="card-block">
                                    <h3 class="card-title">Items Stream</h3>
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

										if ($inbox_loaded >= 20) {

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

			Items.moreItems = function (offset) {

				$('div.loading-more-container').hide();

				$.ajax({
					type: 'POST',
					url: '/admin/stream_items',
					data: 'itemId=' + offset + "&loaded=" + inbox_loaded,
					dataType: 'json',
					timeout: 30000,
					success: function(response){

						if (response.hasOwnProperty('html2')){

							$("div.loading-more-container").html("").append(response.html2).show();
						}

						if (response.hasOwnProperty('html')){

							$("div.items-content").append(response.html);
						}

						inbox_loaded = response.inbox_loaded;
						inbox_all = response.inbox_all;
					},
					error: function(xhr, type){

						$('div.loading-more-container').show();
					}
				});
			};

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

            Items.pin = function (offset, accessToken, action) {

                $.ajax({
                    type: 'GET',
                    url: '/admin/stream_items',
                    data: 'itemId=' + offset + "&access_token=" + accessToken + "&act=" + action,
                    timeout: 30000,
                    success: function(response) {

                        $('div.card[data-id=' + offset + ']').find('a.pin-item').remove();
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

                    <?php

                        if ($item['pinned']) {

                            ?>
                                <span class="sl-date"><i class="ti-pin"></i>Pinned</span>
                                <br>
                            <?php
                        }
                    ?>

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

                        <?php

                            if ($item['pinned']) {

                                ?>
                                    <a class="link ml-2 pin-item" href="javascript: void(0)" onclick="Items.pin('<?php echo $item['id']; ?>', '<?php echo admin::getAccessToken(); ?>', 'unpin'); return false;">UnPin Item</a>
                                <?php

                            } else {

                                ?>
                                    <a class="link ml-2 pin-item" href="javascript: void(0)" onclick="Items.pin('<?php echo $item['id']; ?>', '<?php echo admin::getAccessToken(); ?>', 'pin'); return false;">Pin Item</a>
                                <?php
                            }
                        ?>

                    </div>

                </div>
            </div>
        </div>

		<?php
	}