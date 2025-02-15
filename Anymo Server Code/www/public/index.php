<?php

/*!
	 * https://raccoonsquare.com
	 * raccoonsquare@gmail.com
	 *
	 * Copyright 2012-2021 Demyanchuk Dmitry (raccoonsquare@gmail.com)
	 */

session_start();

error_reporting(E_ALL);

define("APP_SIGNATURE", "raccoonsquare"); // Add signature constant to protect include modules

include_once("../sys/core/init.inc.php");

$page_id = '';


if (!empty($_GET)) {

    if (!isset($_GET['q'])) {

        include_once("../html/main.inc.php");
        exit;
    }

    $request = htmlentities($_GET['q'], ENT_QUOTES);
    $request = helper::escapeText($request);
    $request = explode('/', trim($request, '/'));

    $cnt = count($request);

	switch ($cnt) {

		case 0: {

			include_once("../html/main.inc.php");
			exit;
		}

		case 1: {

			if (file_exists("../html/page.".$request[0].".inc.php")) {

				include_once("../html/page.".$request[0].".inc.php");
				exit;

			}  else if ($helper->isLoginExists($request[0])) {

				include_once("../html/profile.inc.php");
				exit;

			} else {

				include_once("../html/error.inc.php");
				exit;
			}
		}

		case 2: {

			if (file_exists( "../html/".$request[0]."/page.".$request[1].".inc.php")) {

				include_once("../html/" . $request[0] . "/page." . $request[1] . ".inc.php");
				exit;

			} else if (file_exists("../html/app/".$request[1].".php")) {

                include_once("../html/app/" . $request[1] . ".php");
                exit;

            } else if ($helper->isLoginExists($request[0])) {

                if (file_exists("../html/profile/page." . $request[1] . ".inc.php")) {

                    include_once("../html/profile/page." . $request[1] . ".inc.php");
                    exit;

                } else {

                    include_once("../html/error.inc.php");
                    exit;
                }

			} else {

				include_once("../html/error.inc.php");
				exit;
			}
		}

		case 3: {

			switch ($request[1]) {

                case 'market': {

                    if ($helper->isLoginExists($request[0])) {

                        include_once("../html/market/page.show.inc.php");
                        exit;
                    }

                    break;
                }

				case 'post': {

                    if ($helper->isLoginExists($request[0])) {

                        include_once("../html/posts/page.show.inc.php");
                        exit;
                    }

                    break;
				}

                case 'image': {

                    if ($helper->isLoginExists($request[0])) {

                        include_once("../html/images/page.show.inc.php");
                        exit;
                    }

                    break;
                }

                default: {

                    if (file_exists("../html/".$request[0]."/".$request[1]."/page.".$request[2].".inc.php")) {

                        include_once("../html/".$request[0]."/".$request[1]."/page.".$request[2].".inc.php");
                        exit;

                    } else {

                        include_once("../html/error.inc.php");
                        exit;
                    }

                    break;
                }
			}
		}

		case 4: {

            switch ($request[0]) {

                case 'api': {

                    if (file_exists("../app/".$request[1]."/method/".$request[3].".inc.php")) {

                        include_once("../sys/config/api.inc.php");

                        include_once("../app/".$request[1]."/method/".$request[3].".inc.php");
                        exit;

                    } else if (file_exists("../html/".$request[0]."/".$request[1]."/".$request[2]."/page.".$request[3].".inc.php")) {

                        include_once("../html/".$request[0]."/".$request[1]."/".$request[2]."/page.".$request[3].".inc.php");
                        exit;

                    } else {

                        include_once("../html/error.inc.php");
                        exit;
                    }

                    break;
                }

                default: {

                    if ($helper->isLoginExists($request[0])) {

                        switch ($request[1]) {

                            case 'post' : {

                                if (file_exists("../html/posts/page.".$request[3].".inc.php")) {

                                    include_once("../html/posts/page.".$request[3].".inc.php");
                                    exit;

                                } else {

                                    include_once("../html/error.inc.php");
                                    exit;
                                }

                                break;
                            }

                            case 'image' : {

                                if (file_exists("../html/images/page.".$request[3].".inc.php")) {

                                    include_once("../html/images/page.".$request[3].".inc.php");
                                    exit;

                                } else {

                                    include_once("../html/error.inc.php");
                                    exit;
                                }

                                break;
                            }

                            case 'photo' : {

                                if (file_exists("../html/photo/page.".$request[3].".inc.php")) {

                                    include_once("../html/photo/page.".$request[3].".inc.php");
                                    exit;

                                } else {

                                    include_once("../html/error.inc.php");
                                    exit;
                                }

                                break;
                            }

                            default: {

                                include_once("../html/error.inc.php");
                                exit;
                            }
                        }

                    } else {

                        if ( file_exists("../html/".$request[0]."/".$request[1]."/".$request[2]."/page.".$request[3].".inc.php") ) {

                            include_once("../html/".$request[0]."/".$request[1]."/".$request[2]."/page.".$request[3].".inc.php");
                            exit;

                        } else {

                            include_once("../html/error.inc.php");
                            exit;
                        }
                    }

                    break;
                }
            }
		}

		default: {

			include_once("../html/error.inc.php");
			exit;
		}
	}

} else {

	$request = array();
	include_once("../html/main.inc.php");
	exit;
}
