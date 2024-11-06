<?php
$bank_info = $this->admin_model->bank();
$seting    = $this->admin_model->result_setting();

$theme = $this->admin_model->result_theme($seting['theme']);
$assets = $theme->value;
// echo '<pre>';
// print_r($assets);die;
$webname   = $seting['name_web'];
$line      = $seting['line'];
$d_limit   = $seting['d_limit'];
$w_limit   = $seting['w_limit'];
$baseurl   = base_url();

$user = $this->session->userdata('user');
$info = $this->user_model->getdata_user($user);
if ($user) {
    $ufa = $this->user_model->user_ufa($user);
    $user_ufa =  $ufa['username'];
    $pass_ufa =  $ufa['password'];
    $color = $this->user_model->get_bank_color($user);
    $ufa   = $this->user_model->user_ufa($user);
    // print_r($ufa);die;
    $setting_w = $this->admin_model->setting_w();
    $setting_w_type = $this->admin_model->setting_w_type();
    $setting_pow = $this->admin_model->setting_powyingshup();
    if ($ufa['username'] != '') {
        $user_ufa = $ufa['username'];
        $pass_ufa = $ufa['password'];
    }
    $u_pro = $this->user_model->user_pro($user);
    $start_date = date('Y-m-d') . ' 00:00:00';
    $end_date   = date('Y-m-d H:i:s');
    $u_pro_newDate = $this->user_model->user_pro_newDate($user, $start_date, $end_date);
}
    
?>
<!DOCTYPE html>
<html lang="th" class="x-windows-os x-chrome-browser">

<head>
    <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>
    <link rel="dns-prefetch" href="fonts.gstatic.com/">
    <link rel="preload" href="https://fonts.googleapis.com/css2?family=Kanit:wght@400;500;600;700&display=swap" as="style" onload="this.onload=null;this.rel='stylesheet'" />
    <noscript>
		<link href="https://fonts.googleapis.com/css2?family=Kanit:wght@400;500;600;700&display=swap" crossorigin
			rel="stylesheet">
	</noscript>


    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="robots" content="noodp">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">





    <meta name="apple-mobile-web-app-title" content="UFABET แทงบอลออนไลน์ เว็บพนัน แทงบอล ยูฟ่า ufa podthai.store">
    <title>UFABET แทงบอลออนไลน์ เว็บพนัน แทงบอล ยูฟ่า ufa podthai.store</title>

    <meta name="description" content="อัพเดทใหญ่สะเทือนวงการ New UFABET เปิดแล้ว! เว็บแทงบอลออนไลน์ เว็บพนัน แทงบอล เว็บพนัน ยูฟ่า อันดับหนึ่งของไทย กีฬาหลากหลาย ราคาดีที่สุด พร้อมคาสิโน แ...">
    <meta name="keywords" content="ufabet, UFABET, ufa, แทงบอลออนไลน์, เว็บพนัน, แทงบอล, ยูฟ่า, ยูฟ่าเบท">

    <meta property="og:title" content="UFABET แทงบอลออนไลน์ เว็บพนัน แทงบอล ยูฟ่า ufa podthai.store">
    <meta property="og:description" content="อัพเดทใหญ่สะเทือนวงการ New UFABET เปิดแล้ว! เว็บแทงบอลออนไลน์ เว็บพนัน แทงบอล เว็บพนัน ยูฟ่า อันดับหนึ่งของไทย กีฬาหลากหลาย ราคาดีที่สุด พร้อมคาสิโน แ...">
    <meta property="og:locale" content="th">

    <meta property="og:site_name" content="UFABET">

    <meta property="og:url" content="<?= $baseurl ?>">
    <meta property="og:image" content="<?= $baseurl ?>media/cache/metadata_image/202008/meta_seo/d452ce4d0e40af77932108884b9517c1.jpeg">

    <link rel="canonical" href="<?= $baseurl ?>" />

    <meta name="twitter:site" content="@twitter">
    <meta name="twitter:card" content="summary">
    <meta name="twitter:title" content="UFABET แทงบอลออนไลน์ เว็บพนัน แทงบอล ยูฟ่า ufa podthai.store">
    <meta name="twitter:description" content="อัพเดทใหญ่สะเทือนวงการ New UFABET เปิดแล้ว! เว็บแทงบอลออนไลน์ เว็บพนัน แทงบอล เว็บพนัน ยูฟ่า อันดับหนึ่งของไทย กีฬาหลากหลาย ราคาดีที่สุด พร้อมคาสิโน แ...">
    <meta name="twitter:image" content="<?= $baseurl ?>media/cache/metadata_image/202008/meta_seo/d452ce4d0e40af77932108884b9517c1.jpeg">

    <link rel="apple-touch-icon" sizes="57x57" href="<?= $baseurl.$assets?>build/web/assets/img/apple-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="<?= $baseurl.$assets?>build/web/assets/img/apple-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="<?= $baseurl.$assets?>build/web/assets/img/apple-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="<?= $baseurl.$assets?>build/web/assets/img/apple-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="<?= $baseurl.$assets?>build/web/assets/img/apple-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="<?= $baseurl.$assets?>build/web/assets/img/apple-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="<?= $baseurl.$assets?>build/web/assets/img/apple-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="<?= $baseurl.$assets?>build/web/assets/img/apple-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="<?= $baseurl.$assets?>build/web/assets/img/apple-icon-180x180.png">
    <link rel="preload" as="fetch" href="<?= $baseurl.$assets?>build/web/assets/img/manifest.json">
    <link rel="preload" href="<?= $baseurl.$assets?>build/web/assets/img/favicon-32x32.png" as="style" onload="this.onload=null;this.rel='icon'" />
    <noscript>
		<link rel="icon" href="<?= $baseurl.$assets?>build/web/assets/img/favicon-32x32.png">
	</noscript>
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="<?= $baseurl.$assets?>build/web/assets/img/ms-icon-144x144.png">
    <meta name="theme-color" content="#ffffff">


    <meta name="format-detection" content="telephone=no">
    <link rel="preconnect" href="www.google-analytics.com" crossorigin>
    <link rel="dns-prefetch" href="www.google-analytics.com">
    <link rel="dns-prefetch" href="www.googletagmanager.com">
<link rel="stylesheet" href="<?= $baseurl.$assets?>build/web/assets/style.1d4a002a.css">
    <link rel="stylesheet" href="<?= $baseurl.$assets?>build/web/assets/style.0a3000c6.css">

    <script type="text/javascript">
        window['gif64'] = 'data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7';
        window['Bonn'] = {
            boots: [],
            inits: []
        };
    </script>
    <script type="application/ld+json">
        {
            "@context": "http://schema.org",
            "@type": "WebPage",
            "image": [
                "<?= $baseurl.$assets?>build/web/assets/img/meta-1x1.jpg",
                "<?= $baseurl.$assets?>build/web/assets/img/meta-4x3.jpg",
                "<?= $baseurl.$assets?>build/web/assets/img/meta-16x9.jpg"
            ],
            "name": "UFABET บาคาร่า เสือมังกร คาสิโนออนไลน์ ได้เงินจริง แอพบาคาร่า",
            "url": "<?= $baseurl ?>"
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@sweetalert2/theme-bootstrap-4/bootstrap-4.css">

    <style>
        input[type="text"][disabled] {
            background-color: #767676;
        }
        
        select[disabled] {
            background-color: #767676 !important;
        }
    </style>
    <style>
        .system {
            --grid-layout-gap: 1rem;
            --grid-column-count: 9;
            --grid-item--min-width: 100px;
            --gap-count: calc(var(--grid-column-count) - 1);
            --total-gap-width: calc(var(--gap-count) * var(--grid-layout-gap));
            --grid-item--max-width: calc((100% - var(--total-gap-width)) / var(--grid-column-count));
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(max(var(--grid-item--min-width), var(--grid-item--max-width)), 1fr));
            grid-gap: var(--grid-layout-gap);
            border: 2px solid #d8d7cd;
            border-radius: 15px;
            background: #000;
        }
        
        .-system {
            background-color: transparent;
            border: none;
            transition: transform .3s;
        }
        
        .-system:hover {
            transform: scale(1.15);
            filter: drop-shadow(0 0 0.9rem rgba(255, 222, 33, 0.6));
        }
        
        .img-system {
            width: 100px;
            height: 100px;
        }
        
        
        .x-transfer-website .x-header .x-logged .-logged-container {
            background-image: url(<?= $baseurl.$assets?>media/img/bg-logged.png);
            background-repeat: no-repeat;
            background-position: 50%;
            background-size: cover;
            height: 80px;
            border-top-right-radius: 0;
            border-top-left-radius: 0;
        }
        
        .dropdown-content>.x-profile-dropdown-menu {
            background-image: url(<?= $baseurl.$assets?>media/img/bf-logeg-2.jpg);
            background-repeat: no-repeat;
            background-size: cover;
        }
        
        #account-actions #account-actions-mobile .btn .-ic-bg-img,
        #account-actions #account-actions-mobile .vex.vex-theme-plain .vex-content .vex-dialog-buttons .vex-dialog-button .-ic-bg-img,
        .vex.vex-theme-plain .vex-content .vex-dialog-buttons #account-actions #account-actions-mobile .vex-dialog-button .-ic-bg-img {
            width: 38px;
            height: 38px;
            background-image: url(<?= $baseurl.$assets?>/build/images/ic-btn-actions-mobile.d76b8780.png);
            background-size: 120px;
            background-repeat: no-repeat
        }
        /*style="--radius: 100%;"*/
    </style>
</head>

<body class="x-transfer-website">


    <nav class="x-header bg-transparent navbar-expand-lg -anon">
        <div class="-header-inner-wrapper navbar">
            <div class="container align-items-center px-sm-3 px-0 position-relative">
                <div id="headerBrand">
                    <a class="navbar-brand" href="">

                        <img class="-logo" src="<?= $baseurl.$assets?>media/logo/logo.png?v=2" alt="UFABET logo image png" width="387" height="123">
                    </a>

                    <div class="d-none d-lg-block">

                    </div>
                </div>

                <div id="headerContent">
                    <?php if(!$user): ?>
                    <div class="d-flex">
                        <a href="javascript:void(0);" class="btn -login-btn" data-toggle="modal" data-target="#loginModal">
                            <picture>
                                <img src="<?= $baseurl.$assets?>build/web/assets/img/button-bg-gold-new.webp" class="-bg-new-img"
                                    alt="1UFABET button gold background image png" width="250" height="96">
                            </picture>
                            <span class="-text">เข้าสู่ระบบ</span>
                        </a>
                    </div>
                    <?php else: ?>
                    <div class="x-logged">
                        <div class="d-flex dropdown -logged-container">
                            <div class="py-3 px-3 px-lg-4 --profile">
                                <div class="d-flex">
                                    <div class="mr-1 mr-md-2 d-flex js-logged-sidebar">

                                    </div>
                                    <div class="d-flex flex-column m-auto --profile-detail">
                                        <!--<div class="text-center f-7 -text-deisplay-name js-logged-sidebar bh-logged-name">-->
                                        <!--    <?= $user?></div>-->

                                        <div class="text-primary -user-balance text-nowrap js-user-balance ">
                                            <span id="customer-balance" class="js-customer-balance">
												<span class="-transfer-welcome px-3">ยินดีต้อนรับ  <span class="-text-deisplay-name"><?= $user?></span></span>
												
                                            <div class="-transfer-default-balance pr-3">
                                                <button type="button" id="btn-customer-balance-reload" class="btn btn-link -reload-btn px-2 py-0">
												<i class="fas fa-sync"></i>
											</button><span class="ufabet-credit"><?= $ufa['credit']?></span></div>

                                            </span>
                                        </div>
                                    </div>
                                </div>

                                <div class="dropdown-content">
                                    <div class="x-profile-dropdown-menu px-3">
                                        <ul class="navbar-nav">
                                            <li class="nav-item">
                                                <a href="#account" class="nav-link js-close-sidebar" data-toggle="modal" data-target="#accountModal">

                                                    <div class="-link-image-container">
                                                        <img class="-ic img-fluid lazyloaded" alt="บัญชีผู้ใช้" width="24" height="24" src="<?= $baseurl.$assets?>media/img/user.png">
                                                        <span>บัญชีผู้ใช้</span>
                                                    </div>

                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a href="#billHistory" class="nav-link js-close-sidebar js-account-approve-aware" data-toggle="modal" data-target="#historyModal">

                                                    <div class="-link-image-container">
                                                        <img class="-ic img-fluid lazyloaded" alt="ประวัติ" width="24" height="24" src="<?= $baseurl.$assets?>media/img/ic-logged-bill-history.png">
                                                        <span>ประวัติ</span>
                                                    </div>

                                                </a>
                                            </li>

                                            <li class="nav-item js-close-sidebar">
                                                <a href="api/logout" class="nav-link js-require-confirm" data-title="ต้องการออกจากระบบ ?">

                                                    <div class="-link-image-container">
                                                        <img class="-ic img-fluid lazyloaded" alt="ออกจากระบบ" width="24" height="24" src="<?= $baseurl.$assets?>media/img/logout.png">
                                                        <span>ออกจากระบบ</span>
                                                    </div>

                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                            <div class="--deposit d-none d-lg-block">
                                <a href="#deposit" class="text-white js-account-approve-aware" data-toggle="modal" data-target="#depositModal">
                                    <div class="d-flex flex-column justify-content-center h-100 px-3">
                                        <img class="img-fluid mt-2" src="<?= $baseurl.$assets?>media/img/ic_deposit_white.png" alt="icon deposit white" width="35">
                                        <div class="f-7 mt-1">ฝากเงิน</div>
                                    </div>
                                </a>
                            </div>

                            <div class="--withdraw d-none d-lg-block">
                                <a href="#withdraw" class="text-white js-account-approve-aware" data-toggle="modal" data-target="#withdrawModal">
                                    <div class="d-flex flex-column justify-content-center  h-100 px-3">
                                        <img class="img-fluid mt-2" src="<?= $baseurl.$assets?>media/img/ic_withdraw_white.png" alt="icon deposit white" width="35">
                                        <div class="f-7 mt-1">ถอนเงิน</div>
                                    </div>
                                </a>
                            </div>

                            <div class="--button-dropdown-container text-center d-none d-lg-block px-3">
                                <a href="javascript:void(0);" onclick="showWheelModal()" class="text-white js-account-approve-aware">
                                    <img class="img-fluid mt-2" src="./images/icon_wheelspin.png" alt="icon deposit white" width="39">
                                        <div class="f-7 mt-1">วงล้อ</div>
                                </a>
                            </div>
                        </div>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <div class="d-lg-none">
            <ul class="x-header-menu-container navbar-nav container">
            </ul>
        </div>
    </nav>
    <section>
        <div id="account-actions">
            <div class="x-button-actions" id="account-actions-mobile">
                <div class="d-flex">
                    <a href="javascript:void(0);" data-toggle="modal" data-target="#depositModal" class="btn btn-lg btn-plain-primary js-account-approve-aware">
                        <div class="-ic-bg-img -deposit"></div>
                        <span class="-typo">ฝากเงิน</span>
                    </a>
                    <a href="javascript:void(0);" data-toggle="modal" data-target="#withdrawModal" class="btn btn-lg btn-plain-secondary js-account-approve-aware">
                        <div class="-ic-bg-img -withdraw"></div>
                        <span class="-typo">ถอนเงิน</span>
                    </a>
                    <a href="javascript:void(0);" class="btn btn-lg btn-plain-secondary js-account-approve-aware">
                        <img class="img-fluid" src="./images/icon_wheelspin.png" alt="icon deposit white" width="38">
                                        <span class="-typo">วงล้อ</span>
                    </a>
                </div>
            </div>
        </div>
    </section>
    <div id="main__content" class="">
        <section class="x-index-top-container">
            <div class="container -inner-wrapper">
                <div class="row">
                    <div class="col-12 col-md-9 col-lg-6 mx-auto -left-container">
                        <div class="-single">


                            <picture>
                                <img alt="ส่วนลด 5 %" class="img-fluid -slick-item x-image-block-bl-J7qS9" width="600" height="570" src="<?= $baseurl.$assets?>media/logo/logo_slide.webp">
                            </picture>
                        </div>

                    </div>
                    <div class="col-12 col-lg-6 -right-container" data-animatable="fadeInUp" data-delay="100">
                        <img src="<?= $baseurl.$assets?>media/logo/logo.png?v=2" class="-logo-img" alt="UFABET logo image png" width="387" height="123">
                        <div class="-contents-wrapper container">
                            <strong class="-title h1"> <span>อัพเดทครั้งใหญ่ สะเทือนวงการ</span>
							</strong>


                            <div data-slickable="{&quot;arrows&quot;:false,&quot;slidesToShow&quot;:1,&quot;fade&quot;:true,&quot;infinite&quot;:true,&quot;autoplay&quot;:true,&quot;draggable&quot;:false,&quot;autoplaySpeed&quot;:4000,&quot;pauseOnHover&quot;:false}" class="-single">
                                <h1 class="-text-title -slick-item">
                                    <div class="-title">
                                        <span class="-highlight">
											<span class="-new">UFABET</span>
                                        </span>
                                        <span>ยูฟ่าเบท เว็บพนัน ufa อันดับหนึ่งในไทย</span>
                                    </div>
                                    <div class="-sub-title">
                                        อัพเดทครั้งใหญ่ สะเทือนวงการ สัมผัสความง่าย เร็ว สะดวก เพื่อแทงบอล พร้อมความปลอดภัย หากคุณรัก ยูฟ่า เล่นเว็บตรงกันดีกว่า คุ้นเคย และ มั่นคง
                                    </div>
                                </h1>
                                <h2 class="-text-title -slick-item">
                                    <div class="-title">
                                        <span class="-highlight">
											<span class="-new">New</span> UFABET</span>
                                        </span>
                                        <span>เปิดแล้ว</span>
                                    </div>
                                    <div class="-sub-title">
                                        สัมผัสความง่าย เร็ว สะดวก พร้อมความปลอดภัยกว่าที่เคย หากคุณรักยูฟา เล่นเว็บตรงกันดีกว่า คุ้นเคย และ มั่นคง
                                    </div>
                                </h2>
                                <h2 class="-text-title -slick-item">
                                    <div class="-title">
                                        <span class="-highlight">
											<span class="-new">ปรากฏการณ์ใหม่</span>
                                        </span>
                                        <span>แห่งการเดิมพัน</span>
                                    </div>
                                    <div class="-sub-title">
                                        เจ้าแรกที่กล้าให้ คอมมิชชั่นเต็มและราคาน้ำดีสุด มาตราฐานเว็บตรง UFABET ลูกค้าต้องมาก่อน
                                    </div>
                                </h2>
                            </div>

                        </div>
                        <div class="-btn-actions">
                            <?php if(!$user): ?>
                            <button type="button" class="btn -register-btn" data-toggle="modal" data-target="#registerModal">
								<div class="-glow-container"></div>
								<picture>
									<source type="image/webp" srcset="<?= $baseurl.$assets?>build/web/assets/img/button-card.webp">
									<source type="image/png" srcset="<?= $baseurl.$assets?>build/web/assets/img/button-card.png">
									<img src="<?= $baseurl.$assets?>build/web/assets/img/button-card.png" class="-card img-fluid"
										alt="UFABET button card image png" width="111" height="121">
								</picture>

								<picture>
									<source type="image/webp" srcset="<?= $baseurl.$assets?>build/web/assets/img/button-ball.webp">
									<source type="image/png" srcset="<?= $baseurl.$assets?>build/web/assets/img/button-ball.png">
									<img src="<?= $baseurl.$assets?>build/web/assets/img/button-ball.png" class="-ball img-fluid"
										alt="UFABET button ball image png" width="134" height="130">
								</picture>

								<picture>
									<source type="image/webp" srcset="<?= $baseurl.$assets?>build/web/assets/img/button-dice.webp">
									<source type="image/png" srcset="<?= $baseurl.$assets?>build/web/assets/img/button-dice.png">
									<img src="<?= $baseurl.$assets?>build/web/assets/img/button-dice.png" class="-dice img-fluid"
										alt="UFABET button dice image png" width="103" height="92">
								</picture>

								<picture>
									<source type="image/webp" srcset="<?= $baseurl.$assets?>build/web/assets/img/button-awesome-bg.webp">
									<source type="image/png" srcset="<?= $baseurl.$assets?>build/web/assets/img/button-awesome-bg.png">
									<img src="<?= $baseurl.$assets?>build/web/assets/img/button-awesome-bg.png" class="-button-bg"
										alt="UFABET button awesome bg image png" width="300" height="77">
								</picture>
								<span class="-text">สมัครสมาชิก</span>
							</button>
							<?php else:?>
							    <!--ทางเข้าเล่นสำรอง-->
							     <a href="game" target="_blank" class="btn -register-btn">
								<div class="-glow-container"></div>
								<picture>
									<source type="image/webp" srcset="<?= $baseurl.$assets?>build/web/assets/img/button-card.webp">
									<source type="image/png" srcset="<?= $baseurl.$assets?>build/web/assets/img/button-card.png">
									<img src="<?= $baseurl.$assets?>build/web/assets/img/button-card.png" class="-card img-fluid"
										alt="UFABET button card image png" width="111" height="121">
								</picture>

								<picture>
									<source type="image/webp" srcset="<?= $baseurl.$assets?>build/web/assets/img/button-ball.webp">
									<source type="image/png" srcset="<?= $baseurl.$assets?>build/web/assets/img/button-ball.png">
									<img src="<?= $baseurl.$assets?>build/web/assets/img/button-ball.png" class="-ball img-fluid"
										alt="UFABET button ball image png" width="134" height="130">
								</picture>

								<picture>
									<source type="image/webp" srcset="<?= $baseurl.$assets?>build/web/assets/img/button-dice.webp">
									<source type="image/png" srcset="<?= $baseurl.$assets?>build/web/assets/img/button-dice.png">
									<img src="<?= $baseurl.$assets?>build/web/assets/img/button-dice.png" class="-dice img-fluid"
										alt="UFABET button dice image png" width="103" height="92">
								</picture>

								<picture>
									<source type="image/webp" srcset="<?= $baseurl.$assets?>build/web/assets/img/button-awesome-bg.webp">
									<source type="image/png" srcset="<?= $baseurl.$assets?>build/web/assets/img/button-awesome-bg.png">
									<img src="<?= $baseurl.$assets?>build/web/assets/img/button-awesome-bg.png" class="-button-bg"
										alt="UFABET button awesome bg image png" width="300" height="77">
								</picture>
								<span class="-text">ทางเข้าเล่น</span>
							</a>
							<?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>

            <?php if($user): ?>
            <div class="-system-users">
                <div class="container system my-3 p-3">
                    <div class="card -system">
                        <div class="card-body p-0 text-center">
                            <a href="javascript:void(0);">
                                <img src="<?= $baseurl.$assets?>media/img/user.png" class="img-system my-2" alt="">
                                <p>ข้อมูลบัญชี</p>
                            </a>
                        </div>
                    </div>
                    <div class="card -system">
                        <div class="card-body p-0 text-center">
                            <a href="javascript:void(0);">
                                <img src="<?= $baseurl.$assets?>media/img/box-main.png" class="img-system my-2" alt="">
                                <p>โปรโมชั่นสมาชิกใหม่</p>
                            </a>
                        </div>
                    </div>
                    <div class="card -system">
                        <div class="card-body p-0 text-center">
                            <a href="javascript:void(0);">
                                <img src="<?= $baseurl.$assets?>media/img/box-main.png" class="img-system my-2" alt="">
                                <p>ฝากแรกของวัน</p>
                            </a>
                        </div>
                    </div>
                    <div class="card -system">
                        <div class="card-body p-0 text-center">
                            <a href="javascript:void(0);">
                                <img src="<?= $baseurl.$assets?>media/img/box-up.png" class="img-system my-2" alt="">
                                <p>แนะนำเพื่อนรับโบนัส</p>
                            </a>
                        </div>
                    </div>
                    <div class="card -system">
                        <div class="card-body p-0 text-center">
                            <a href="javascript:void(0);">
                                <img src="<?= $baseurl.$assets?>media/img/box-up.png" class="img-system my-2" alt="">
                                <p>ฝากต่อเนื่อง</p>
                            </a>
                        </div>
                    </div>
                    <div class="card -system">
                        <div class="card-body p-0 text-center">
                            <a href="javascript:void(0);">
                                <img src="<?= $baseurl.$assets?>media/img/tab_event.png" class="img-system my-2" alt="">
                                <p>ประวัติการทำรายการ</p>
                            </a>
                        </div>
                    </div>
                    <div class="card -system">
                        <div class="card-body p-0 text-center">
                            <a href="javascript:void(0);" onclick="setData_powyingshup()">
                                <img src="<?= $baseurl.$assets?>media/img/powyingshup.png" class="img-system my-2" alt="">
                                <p>เป่ายิ้งฉุบ</p>
                            </a>
                        </div>
                    </div>
                    <div class="card -system">
                        <div class="card-body p-0 text-center">
                            <a href="javascript:void(0);">
                                <img src="<?= $baseurl.$assets?>media/img/box-sign-1.png" class="img-system my-2" alt="">
                                <p>ทางเข้าเล่นสำรอง</p>
                            </a>
                        </div>
                    </div>
                    <div class="card -system">
                        <div class="card-body p-0 text-center">
                            <a href="api/logout">
                                <img src="<?= $baseurl.$assets?>media/img/logout.png" class="img-system my-2" alt="">
                                <p>ออกจากระบบ</p>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <?php endif; ?>
            <div class="-games-container">
                <div class="container">
                    <div class="row -row-inner-wrapper">
                        <div class="col-6 col-lg-3 -col-wrapper" data-animatable="fadeInUp" data-delay="200">
                            <div class="-box-wrapper">
                                <div class="-icon-wrapper">
                                    <picture>
                                        <source type="image/webp" srcset="<?= $baseurl.$assets?>build/web/assets/img/ic_index_sport.webp">
                                        <source type="image/png" srcset="<?= $baseurl.$assets?>build/web/assets/img/ic_index_sport.png">
                                        <img alt="UFABET game icon image png" class="-icon lazyload img-fluid -sport" width="120" height="120" src="<?= $baseurl.$assets?>build/web/assets/img/ic_index_sport.png">
                                    </picture>
                                </div>
                                <div class="-title">SPORT BETTING</div>
                                <h2 class="-sub-title">แทงบอลออนไลน์ ยูฟ่าเบท</h2>
                                <p class="-content">เว็บบอล เจ้าแรกยอดนิยมในไทย เล่นง่าย ราคาดี มีให้เล่นทุกลีก UFABET
                                </p>
                            </div>
                        </div>
                        <div class="col-6 col-lg-3 -col-wrapper" data-animatable="fadeInUp" data-delay="400">
                            <div class="-box-wrapper">
                                <div class="-icon-wrapper">


                                    <picture>
                                        <source type="image/webp" srcset="<?= $baseurl.$assets?>build/web/assets/img/ic_index_live_casino.webp">
                                        <source type="image/png" srcset="<?= $baseurl.$assets?>build/web/assets/img/ic_index_live_casino.png">
                                        <img alt="UFABET game icon image png" class="-icon lazyload img-fluid -live_casino" width="120" height="120" src="<?= $baseurl.$assets?>build/web/assets/img/ic_index_live_casino.png">
                                    </picture>
                                </div>
                                <div class="-title">LIVE CASINO</div>
                                <h2 class="-sub-title">คาสิโนออนไลน์ คาสิโนสด ufabet</h2>
                                <p class="-content">เว็บพนัน ufa ที่ครอบคลุม นิยมที่สุด กับค่ายคาสิโน ชั้นนำมากมาย</p>
                                
                            </div>
                        </div>
                        <div class="col-6 col-lg-3 -col-wrapper" data-animatable="fadeInUp" data-delay="600">
                            <div class="-box-wrapper">
                                <div class="-icon-wrapper">


                                    <picture>
                                        <source type="image/webp" srcset="<?= $baseurl.$assets?>build/web/assets/img/ic_index_slot.webp">
                                        <source type="image/png" srcset="<?= $baseurl.$assets?>build/web/assets/img/ic_index_slot.png">
                                        <img alt="UFABET game icon image png" class="-icon lazyload img-fluid -slot" width="120" height="120" src="<?= $baseurl.$assets?>build/web/assets/img/ic_index_slot.png">
                                    </picture>
                                </div>
                                <div class="-title">SLOT</div>
                                <h2 class="-sub-title">สล็อต และ เกมคาสิโน ufa.bet</h2>
                                <p class="-content">สล็อตออนไลน์ ภาพสวย ไม่หลุด เล่นได้ทั้งคอมมือถือ Jackpot เท่าไหร่ก็จ่าย
                                </p>
                                
                            </div>
                        </div>
                        <div class="col-6 col-lg-3 -col-wrapper" data-animatable="fadeInUp" data-delay="800">
                            <div class="-box-wrapper">
                                <div class="-icon-wrapper">


                                    <picture>
                                        <source type="image/webp" srcset="<?= $baseurl.$assets?>build/web/assets/img/ic_index_lotto.webp">
                                        <source type="image/png" srcset="<?= $baseurl.$assets?>build/web/assets/img/ic_index_lotto.png">
                                        <img alt="UFABET game icon image png" class="-icon lazyload img-fluid -lotto" width="120" height="120" src="<?= $baseurl.$assets?>build/web/assets/img/ic_index_lotto.png">
                                    </picture>
                                </div>
                                <div class="-title">LOTTO</div>
                                <h2 class="-sub-title">หวยออนไลน์ กับ ufabet</h2>
                                <p class="-content">เจ้าแรกที่นำหวย เข้าสู่เว็บพนันออนไลน์ คู่คนไทย ทั้งหวยทั้งยูฟ่า ไม่มีอั้น!
                                </p>
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="x-index-middle-container lazyload" data-bgset="<?= $baseurl.$assets?>build/web/assets/img/middle-index-bg.jpg?v=2">
            <div class="-middle-container">
                <div class="container">
                    <div class="row mb-lg-4">
                        <div class="col-12 col-lg-6 -left-container-top">
                            <img src="<?= $baseurl.$assets?>media/logo/logo.png?v=2" class="-logo" alt="UFABET logo image png" width="387" height="123">
                        </div>
                        <div class="col-12 col-lg-6 -right-container-top">


                            <div data-slickable="{&quot;arrows&quot;:false,&quot;slidesToShow&quot;:1,&quot;fade&quot;:true,&quot;infinite&quot;:true,&quot;autoplay&quot;:true,&quot;draggable&quot;:false,&quot;autoplaySpeed&quot;:4000,&quot;pauseOnHover&quot;:false}" class="-single">
                                <h3 class="-text-title -slick-item">ฝาก-ถอน ออโต้ โปรแรงสุดในไทย<br>อัพเกรดใหม่ New UFABET ระบบไวกว่าเดิม</h3>
                            </div>

                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 col-lg-6 -left-container">
                            <img data-src="<?= $baseurl.$assets?>build/web/assets/img/index-lower-mobile.png?v=1" class="-mobile-img lazyload" alt="UFABET mobile image png" data-animatable="fadeInUp" data-delay="200" width="500" height="549">
                            <div class="-shield-container">
                                <img src="<?= $baseurl.$assets?>build/web/assets/img/index-lower-dust.png" class="-dust-img" alt="UFABET shield image png" data-animatable="fadeInLeft" data-delay="600">
                                <img src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7" data-src="<?= $baseurl.$assets?>build/web/assets/img/index-lower-shield.gif?v=1" class="-shield-img lazyload" alt="UFABET shield image png" data-animatable="fadeInLeft" data-delay="600">
                            </div>
                        </div>
                        <div class="col-12 col-lg-6 -right-container">
                            <div class="-text-lists-wrapper">
                                <ul class="navbar-nav">
                                    <li class="nav-item" data-animatable="fadeInLeft" data-delay="600">
                                        <img data-src="<?= $baseurl.$assets?>build/web/assets/img/ic-check-index.png" class="-icon-img lazyload" alt="UFABET check icon image png" width="34" height="32">
                                        <span>สมัครง่าย ไม่ต้องแอดไลน์</span>
                                    </li>
                                    <li class="nav-item" data-animatable="fadeInLeft" data-delay="800">
                                        <img data-src="<?= $baseurl.$assets?>build/web/assets/img/ic-check-index.png" class="-icon-img lazyload" alt="UFABET check icon image png" width="34" height="32">
                                        <span>ล็อคอินด้วยเบอร์โทรศัพท์ไม่ต้องจำยูส</span>
                                    </li>
                                    <li class="nav-item" data-animatable="fadeInLeft" data-delay="1000">
                                        <img data-src="<?= $baseurl.$assets?>build/web/assets/img/ic-check-index.png" class="-icon-img lazyload" alt="UFABET check icon image png" width="34" height="32">
                                        <span>อยู่ในระบบตลอด ไม่ต้องล็อคอินทุกครั้งที่เล่น</span>
                                    </li>
                                    <li class="nav-item" data-animatable="fadeInLeft" data-delay="1200">
                                        <img data-src="<?= $baseurl.$assets?>build/web/assets/img/ic-check-index.png" class="-icon-img lazyload" alt="UFABET check icon image png" width="34" height="32">
                                        <span>การันตีการ ฝาก-ถอน ออโต้เจ้าแรก ที่ใช้ได้จริง</span>
                                    </li>
                                    <li class="nav-item" data-animatable="fadeInLeft" data-delay="1400">
                                        <img data-src="<?= $baseurl.$assets?>build/web/assets/img/ic-check-index.png" class="-icon-img lazyload" alt="UFABET check icon image png" width="34" height="32">
                                        <span>ปรับไม้การเดิมพันคาสิโนได้ด้วยตัวเองสูงสุดถึง 200,000/ไม้</span>
                                    </li>
                                    <li class="nav-item" data-animatable="fadeInLeft" data-delay="1600">
                                        <img data-src="<?= $baseurl.$assets?>build/web/assets/img/ic-check-index.png" class="-icon-img lazyload" alt="UFABET check icon image png" width="34" height="32">
                                        <span>ฝ่ายบริการเป็นกันเองและดูแลอย่างมืออาชีพ 24 ชั่วโมง</span>
                                    </li>
                                    <li class="nav-item" data-animatable="fadeInLeft" data-delay="1800">
                                        <img data-src="<?= $baseurl.$assets?>build/web/assets/img/ic-check-index.png" class="-icon-img lazyload" alt="UFABET check icon image png" width="34" height="32">
                                        <span>เล่นหนักไม่ต้องกังวล ถอนได้ไม่อั้น ไม่จำกัดสูงสุดต่อวัน</span>
                                    </li>
                                </ul>
                            </div>
                            <div class="-lobby-logo-wrapper">
                                <ul class="navbar-nav">
                                    <li class="nav-item" data-animatable="fadeInUp" data-delay="100">
                                        <img data-src="https://asset.cloudigame.co/build/admin/img/lobby_main/ufa-logo-circle-notext.png?v=1" class="-casino-logo lazyload" alt="ufa logo png" width="100" height="100">
                                        <div class="-text-title">UFA</div>
                                    </li>
                                    <li class="nav-item" data-animatable="fadeInUp" data-delay="200">
                                        <img data-src="https://asset.cloudigame.co/build/admin/img/lobby_main/sexy-bac-02-logo-circle-notext.png?v=1" class="-casino-logo lazyload" alt="sexy-bac-02 logo png" width="100" height="100">
                                        <div class="-text-title">เซ็กซี่ บาคาร่า</div>
                                    </li>
                                    <li class="nav-item" data-animatable="fadeInUp" data-delay="300">
                                        <img data-src="https://asset.cloudigame.co/build/admin/img/lobby_main/sa-gaming-02-logo-circle-notext.png?v=1" class="-casino-logo lazyload" alt="sa-gaming-02 logo png" width="100" height="100">
                                        <div class="-text-title">SA บาคาร่า</div>
                                    </li>
                                    <li class="nav-item" data-animatable="fadeInUp" data-delay="400">
                                        <img data-src="https://asset.cloudigame.co/build/admin/img/lobby_main/joker-logo-circle-notext.png?v=1" class="-casino-logo lazyload" alt="joker logo png" width="100" height="100">
                                        <div class="-text-title">สลอตโจ๊กเกอร์</div>
                                    </li>
                                    <li class="nav-item" data-animatable="fadeInUp" data-delay="500">
                                        <img data-src="https://asset.cloudigame.co/build/admin/img/lobby_main/gd-casino-logo-circle-notext.png?v=1" class="-casino-logo lazyload" alt="gd-casino logo png" width="100" height="100">
                                        <div class="-text-title">GD คาสิโน</div>
                                    </li>
                                    <li class="nav-item" data-animatable="fadeInUp" data-delay="600">
                                        <img data-src="https://asset.cloudigame.co/build/admin/img/lobby_main/muay-step-logo-circle-notext.png?v=1" class="-casino-logo lazyload" alt="muay-step logo png" width="100" height="100">
                                        <div class="-text-title">มวยสเตป</div>
                                    </li>
                                    <li class="nav-item" data-animatable="fadeInUp" data-delay="700">
                                        <img data-src="https://asset.cloudigame.co/build/admin/img/lobby_main/lotto-logo-circle-notext.png?v=1" class="-casino-logo lazyload" alt="lotto logo png" width="100" height="100">
                                        <div class="-text-title">หวยรายวัน</div>
                                    </li>
                                    <li class="nav-item" data-animatable="fadeInUp" data-delay="800">
                                        <img data-src="https://asset.cloudigame.co/build/admin/img/lobby_main/fishing-logo-circle-notext.png?v=1" class="-casino-logo lazyload" alt="fishing logo png" width="100" height="100">
                                        <div class="-text-title">ยิงปลา</div>
                                    </li>
                                    <li class="nav-item" data-animatable="fadeInUp" data-delay="900">
                                        <img data-src="https://asset.cloudigame.co/build/admin/img/lobby_main/kai-chon-logo-circle-notext.png?v=1" class="-casino-logo lazyload" alt="kai-chon logo png" width="100" height="100">
                                        <div class="-text-title">ไก่ชน</div>
                                    </li>
                                    <li class="nav-item" data-animatable="fadeInUp" data-delay="1000">
                                        <img data-src="https://asset.cloudigame.co/build/admin/img/lobby_main/kingmaker-logo-circle-notext.png?v=1" class="-casino-logo lazyload" alt="kingmaker logo png" width="100" height="100">
                                        <div class="-text-title">เกมส์ไฮโล</div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section>

        </section>



        <div class="x-modal modal " id="alertModal" tabindex="-1" role="dialog" aria-hidden="true" data-loading-container=".js-modal-content" data-ajax-modal-always-reload="true">
            <div class="modal-dialog -modal-size " role="document">
                <div class="modal-content -modal-content">
                    <button type="button" class="close f-1" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
                    <div class="modal-header border-bottom-0 mt-3 pb-0 d-flex flex-column-reverse">
                        <h3 class="x-title-modal font-weight-normal d-inline-block m-auto text-white">
                            <span>แจ้งเตือน</span>
                            <hr class="x-hr-border-glow">
                        </h3>
                    </div>
                    <div class="modal-body">
                        <div class="text-center mb-3">
                            <img data-src="<?= $baseurl.$assets?>build/web/assets/img/ic_check.png" alt="SUCCESS" class="js-ic-success -img img-fluid lazyload">
                            <img data-src="<?= $baseurl.$assets?>build/web/assets/img/ic_cross.png" alt="FAIL" class="js-ic-fail -img img-fluid lazyload">
                        </div>

                        <div class="js-modal-content text-primary text-center f-4">

                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="x-modal modal " id="loginModal" tabindex="-1" role="dialog" aria-hidden="true" data-loading-container=".js-modal-content" data-ajax-modal-always-reload="true">
            <div class="modal-dialog -modal-size " role="document">
                <div class="modal-content -modal-content">
                    <button type="button" class="close f-1" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
                    <div class="modal-header border-bottom-0 mt-3 pb-0 d-flex flex-column-reverse">
                        <h3 class="m-auto text-white d-inline-block">
                            เข้าสู่ระบบ
                            <hr class="x-hr-border-glow">
                        </h3>
                    </div>
                    <div class="modal-body">
                        <div class="x-login-form">
                            <div data-animatable="fadeInModal" data-offset="0" class="-animatable-container">

                                <div class="-x-input-icon mb-3 flex-column">
                                    <img data-src="<?= $baseurl.$assets?>build/web/assets/img/ic_phone.png" class="-icon lazyload" alt="login" width="12">
                                    <input type="text" inputmode='text' id="username" name="username" pattern="[0-9]*" autofocus class="form-control x-form-control" placeholder="เบอร์โทรศัพท์">
                                </div>
                                <div class="-x-input-icon flex-column">
                                    <img data-src="<?= $baseurl.$assets?>build/web/assets/img/ic_lock_input.png" class="-icon lazyload" alt="password" width="13">
                                    <input type="password" id="password" name="password" class="form-control x-form-control" placeholder="รหัสผ่าน">
                                </div>

                                <div class="text-center">
                                    <button id="btn-login" type="button" class="btn btn-primary -submit my-lg-3 my-0 f-5 f-lg-6">
										<span class="-text-btn">เข้าสู่ระบบ</span>
									</button>
                                </div>


                                <div class="x-admin-contact ">
                                    <span class="x-text-with-link-component">
										<label class="-text-message ">พบปัญหา</label>
										<a href="https://lin.ee/Qrz1n6c" class="-link-message " target="_blank"
											rel="noopener">
											<span>ติดต่อฝ่ายบริการลูกค้า</span>
                                    </a>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>



        <div class="x-modal modal " id="registerModal" tabindex="-1" role="dialog" aria-hidden="true" data-loading-container=".modal-body" data-ajax-modal-always-reload="true" data-ajax-modal-always-reload="true">
            <div class="modal-dialog -modal-size " role="document">
                <div class="modal-content -modal-content">
                    <button type="button" class="close f-1 " data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
                    <div class="modal-body">
                        <div class="x-form-register mt-0">
                            <div class="row -animatable-container">
                                <div class="col order-1 text-center mx-auto js-slide-term-and-condition-content x-slide-left-content x-slide-left-content-term -hide">
                                    <h3 class="x-title-modal  mx-auto text-center d-inline-block text-white mt-3">
                                        Term and condition
                                        <hr class="x-hr-border-glow">
                                    </h3>

                                    <div class="-term-and-condition-content js-term-and-condition px-3">
                                        <div class="x-term-and-condition">
                                            <div class="-block-content-term-and-condition -register-modal -real-content">
                                                <h1 class="f-4">ข้อตกลงในการใช้งาน</h1>
                                                <ul class="list-unstyled -detail">
                                                    <li>สมาชิกจะต้องมีอายุไม่ต่ำกว่า 18 ปีบริบูรณ์ในการเป็นสมาชิก 1ufabet โดยทางสมาชิกอาจต้องยืนยันตัวตนอายุของท่านกับเจ้าหน้าที่เซอร์วิสหากจำเป็น
                                                    </li>
                                                    <li>สมาชิกต้องกรอกข้อมูลจริงให้สมบูรณ์และสามารถติดต่อได้ เพื่อเปิดบัญชี UFABET (บริษัทจำกัดคนละบัญชีเท่านั้น)
                                                    </li>
                                                    <li>ชื่อ-นามสกุล กับ ชื่อในข้อมูลธนาคารที่ให้สำหรับการฝาก/ถอน ต้องตรงกัน (บริษัทอนุมัติเฉพาะรายการที่ข้อมูลตรงกับข้อมูลสมาชิกเท่านั้น หากมีข้อผิดพลาดจากสมาชิกบริษัทจะไม่รับผิดชอบใดๆ)
                                                    </li>
                                                    <li>ทุกข้อเสนอจำกัดสำหรับหนึ่ง บุคคล, ชื่อ หรือ สกุล , ที่อยุ่ , อีเมล์ , เบอร์โทรศัพท์, บัญชีธนาคาร , IP แอดเดรส เดียวเท่านั้น (บริษัทมีระบบตรวจสอบ การใช้ข้อมูล การเข้าใช้ ที่ซ้ำซ้อนกัน)</li>
                                                    <li>สมาชิกที่ต้องการเปลี่ยนแปลงข้อมูล จะต้องไม่ติดกิจกรรมใดๆ และเคยฝากเงินแล้วเท่านั้น
                                                    </li>
                                                    <li>สมาชิกต้องวางเดิมพัน จึงจะสามารถถอนเงินได้ ( ไม่สามารถฝาก และถอนเงินทันทีโดยที่ไม่วางเดิมพัน )</li>
                                                    <li>ในกรณีตรวจพบว่าสมาชิก ฝาก/ถอน ผิดปกติเพื่อก่อกวน เอาเปรียบบริษัท หรือคาดว่าเป็นมิจฉาชีพ ทีมงานขอสงวนสิทธิ์ในการระงับยูสเซอร์ตรวจสอบ และตัดสิน
                                                    </li>
                                                    <li>ในกรณีตรวจพบว่าท่านสมาชิกมีการละเมิดข้อกำหนดเงื่อนไข หรือมีการกระทำผิดกติกาในการเข้าร่วมโปรโมชั่นเพื่อให้ได้มาซึ่งเครดิต, โบนัสพิเศษ, เทิร์นโอเวอร์ ในทางทุจจริต ทางเราขอสงวนสิทธิ์ในการระงับใช้บัญชีนั้นๆ
                                                        ทันที และเครดิตที่ได้มาไม่สามารถถอนได้
                                                    </li>
                                                    <li>บริษัทขอสงวนสิทธิ์ในการแก้ไขหรือ ยกเลิกโปรโมชั่นสำหรับท่านสมาชิก ได้โดยอัพเดทหน้าเว็บไซต์ และไม่ต้องแจ้งให้ทราบล่วงหน้า</li>
                                                    <li>บริษัทขอสงวนสิทธิ์โดยใช้ดุลยพินิจแต่เพียงผู้เดียวในการทำให้เงินรางวัลเป็นโมฆะและริบยอดเงินใดก็ตามในบัญชีการเดิมพันของคุณ ในการสิ้นสุดข้อตกลงและ/หรือระงับการให้บริการ/ปิดการใช้งานบัญชี
                                                    </li>
                                                    <li>หากเราระบุได้ว่าคุณมีบัญชีกับเรามากกว่าหนึ่งบัญชี</li>
                                                    <li>หากคุณกำลังละเมิดข้อกำหนดใดๆ ของข้อตกลงนี้</li>
                                                    <li>หาก บริษัททราบว่าคุณได้วางเดิมพันกับเว็บไซต์วางเดิมพันออนไลน์หรือใช้บริการใดก็ตามและถูกสงสัยว่าได้ฉ้อโกง สมรู้ร่วมคิด หรือกิจกรรมที่ไม่เหมาะสมหรือมิชอบด้วยกฎหมาย</li>
                                                    <li>หาก คุณไม่สามารถจัดเตรียมข้อมูลการยืนยันตัวตนตามที่ร้องขอ</li>
                                                    <li>หากบริษัท ไม่สามารถทำการตรวจสอบ หรือข้อมูลที่ท่านให้มานั้นไม่ถูกต้อง, ข้อมูลเท็จ หรือข้อมูลไม่สมบูรณ์ ทางเราขอสงวนสิทธิ์ที่จะทำการปฏิเสธโดยไม่มีการแจ้งให้ทราบล่วงหน้า หรือไม่รับผิดชอบใดๆในบัญชีของท่าน
                                                    </li>
                                                    <li>หาก คุณฝากเงินด้วยเงินที่ได้มาด้วยการทุจริตหรือมิชอบด้วยกฎหมายหรือได้มาอย่างไม่ถูกต้อง
                                                    </li>
                                                    <li>หากบริษัท สงสัยว่าบัญชีของท่านมีความเกี่ยวข้องกับการฉ้อโกงหรือการกระทำที่เป็นทุจริต
                                                    </li>
                                                    <li>หากบริษัท สงสัยว่าท่าน หรือสมรู้ร่วมคิดกับบุคคลอื่นๆ เพื่อที่จะทำการอย่างใดอย่างหนึ่ง หรือพยายามฉ้อโกงทางเว็บ</li>
                                                    <li>หากบริษัท ได้รับแจ้งว่าท่านได้มีการปลอม หรือแทรกแซง หรือดำเนินการขั้นตอนเพื่อทำการปกปิดหรือแทรกแซงในทางใด ๆ ในเรื่องของ IP ในอุปกรณ์ที่ใช้ในการเข้าถึงเว็บไซต์ เช่น Virtual Private Network "VPN"
                                                    </li>
                                                    <li>หากคุณได้มีการใช้โปรแกรม VPN หรือวิธีการใดๆ ที่พยายามจะปลอมแปลง หรือซ่อนตัวตนที่แท้จริงของท่าน หรือการตรวจสอบตามขอบเขตอำนาจด้านการพนัน
                                                    </li>
                                                </ul>

                                                <h2 class="f-6">**บริษัท UFABET เป็นผู้ตัดสินเพียงผู้เดียวและคำตัดสินใจถือเป็นที่สิ้นสุด**
                                                </h2>
                                            </div>

                                            <div class="text-center d-lg-none">
                                                <a href="#close-term-and-condition" class="js-get-term-and-condition btn -submit btn-primary my-0 my-lg-3 f-5 f-lg-6">
                                                    <span>ย้อนกลับ</span>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div data-animatable="fadeInRegister" data-offset="0" class="col-lg order-lg-2 -form order-0">
                                    <div class="text-center d-flex flex-column">
                                        <h3 class="x-title-modal  mx-auto text-center d-inline-block text-white mt-3">
                                            สมัครสมาชิก
                                            <hr class="x-hr-border-glow">
                                        </h3>


                                        <div class="x-step-register">
                                            <div class="d-block">
                                                <div class="col-7 m-auto row px-0">
                                                    <div class="col-auto px-0 my-auto">
                                                        <div class="-step-box-outer m-auto step-active">
                                                            <div class="--step-box-inner text-center f-9">
                                                                1
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="-border">
                                                        <hr>
                                                    </div>
                                                    <div class="col-auto px-0 my-auto">
                                                        <div class="-step-box-outer m-auto ">
                                                            <div class="--step-box-inner text-center f-9">
                                                                2
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="-border">
                                                        <hr>
                                                    </div>
                                                    <div class="col-auto px-0 my-auto">
                                                        <div class="-step-box-outer m-auto ">
                                                            <div class="--step-box-inner text-center f-9">
                                                                3
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="-border">
                                                        <hr>
                                                    </div>
                                                    <div class="col-auto px-0 my-auto">
                                                        <div class="-step-box-outer m-auto ">
                                                            <div class="--step-box-inner text-center f-9">
                                                                4
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="text-center">
                                            <img src="<?= $baseurl.$assets?>build/web/assets/img/ic_register.png" alt="สมัครสมาชิก" class="img-fluid -ic-register my-3" width="100">
                                        </div>

                                        <div class="-x-input-icon mb-3 flex-column text-center">
                                            <img src="<?= $baseurl.$assets?>build/web/assets/img/ic_phone.png" class="-icon" alt="" width="12">

                                            <input type="text" id="phoneNumber" name="phoneNumber" required="required" pattern="[0-9]*" class="x-form-control form-control" placeholder="กรุณากรอกเบอร์โทรศัพท์" autocomplete="off" inputmode="tel" />
                                        </div>

                                        <div class="d-flex flex-column m-auto -term-and-condition-check-box ">
                                            <div class="x-checkbox-primary d-flex justify-content-center mt-3">
                                                <div class="form-check"> <input type="checkbox" id="request_otp_termAndCondition" name="request_otp[termAndCondition]" class="x-form-control js-term-check-box form-check-input" value="1" />
                                                    <label class="form-check-label" for="request_otp_termAndCondition">
													</label>
                                                </div>

                                                <span class="x-text-with-link-component">
													<label class="-text-message mt-1"
														for=request_otp_termAndCondition>ยอมรับเงื่อนไข</label>
													<a href="#term-and-condition"
														class="-link-message js-get-term-and-condition" target="_self">
														<span>Term and condition</span>
                                                </a>
                                                </span>
                                            </div>
                                        </div>

                                        <div class="text-center">
                                            <button type="button" id="checkphone" class="btn -submit js-submit-accept-term btn-primary my-lg-3 mt-0 f-5 f-lg-6">
												<span class="-text-btn">ยืนยัน</span>
											</button>
                                        </div>


                                        <div class="x-admin-contact ">
                                            <span class="x-text-with-link-component">
												<label class="-text-message ">พบปัญหา</label>
												<a href="https://lin.ee/Qrz1n6c" class="-link-message " target="_blank"
													rel="noopener">
													<span>ติดต่อฝ่ายบริการลูกค้า</span>
                                            </a>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="x-modal modal " id="bankCheck" tabindex="-1" role="dialog" aria-hidden="true" data-loading-container=".modal-body" data-ajax-modal-always-reload="true" data-ajax-modal-always-reload="true">
            <div class="modal-dialog -modal-size " role="document">
                <div class="modal-content -modal-content">
                    <button type="button" class="close f-1 " data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
                    <div class="modal-body">
                        <div class="x-form-register mt-0">
                            <div class="row -animatable-container">
                                <div data-animatable="fadeInRegister" data-offset="0" class="col-lg order-lg-2 -form order-0">
                                    <div class="text-center d-flex flex-column">
                                        <h3 class="x-title-modal  mx-auto text-center d-inline-block text-white mt-3">
                                            สมัครสมาชิก
                                            <hr class="x-hr-border-glow">
                                        </h3>
                                        <div class="x-step-register">
                                            <div class="d-block">
                                                <div class="col-7 m-auto row px-0">
                                                    <div class="col-auto px-0 my-auto">
                                                        <div class="-step-box-outer m-auto step-active">
                                                            <div class="--step-box-inner text-center f-9">
                                                                1
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="-border">
                                                        <hr>
                                                    </div>
                                                    <div class="col-auto px-0 my-auto">
                                                        <div class="-step-box-outer m-auto step-active">
                                                            <div class="--step-box-inner text-center f-9">
                                                                2
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="-border">
                                                        <hr>
                                                    </div>
                                                    <div class="col-auto px-0 my-auto">
                                                        <div class="-step-box-outer m-auto ">
                                                            <div class="--step-box-inner text-center f-9">
                                                                3
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="-border">
                                                        <hr>
                                                    </div>
                                                    <div class="col-auto px-0 my-auto">
                                                        <div class="-step-box-outer m-auto ">
                                                            <div class="--step-box-inner text-center f-9">
                                                                4
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="-x-input-icon mb-3 flex-column text-center">
                                            <!-- <i class="fa fa-bandcamp -icon" aria-hidden="true"></i> -->
                                            <i class="fas fa-user-alt -icon mt-1"></i>
                                            <input type="text" id="berconfirm" name="berconfirm" required="required" pattern="[0-9]*" class="x-form-control form-control text-black" placeholder="เบอร์โทรศัพท์" autocomplete="off" disabled />
                                        </div>
                                        <div id="div-acc" class="-x-input-icon mb-3 flex-column text-center d-none">
                                            <!-- <i class="fa fa-bandcamp -icon" aria-hidden="true"></i> -->
                                            <i class="fas fa-user-alt -icon mt-1"></i>
                                            <input type="text" id="accname" name="berconfirm" required="required" pattern="[0-9]*" class="x-form-control form-control text-black" placeholder="ชื่อบัญชี" autocomplete="off" disabled />
                                        </div>
                                        <div class="-x-input-icon mb-3 flex-column text-center">
                                            <!-- <i class="fa fa-bandcamp -icon" aria-hidden="true"></i> -->
                                            <i class="fas fa-user-alt -icon mt-1"></i>
                                            <input type="text" id="bank_acc" name="bank_acc" required="required" class="x-form-control form-control" placeholder="กรุณากรอกเลขบัญชีธนาคาร" autocomplete="off" />
                                        </div>
                                        <div id="div-pass" class="-x-input-icon mb-3 flex-column text-center d-none">
                                            <!-- <i class="fa fa-bandcamp -icon" aria-hidden="true"></i> -->
                                            <i class="fas fa-user-alt -icon mt-1"></i>
                                            <input type="text" id="pass" name="pass" required="required" class="x-form-control form-control" placeholder="รหัสผ่าน" autocomplete="off" />
                                        </div>
                                        <div id="div-pass-con" class="-x-input-icon mb-3 flex-column text-center d-none">
                                            <!-- <i class="fa fa-bandcamp -icon" aria-hidden="true"></i> -->
                                            <i class="fas fa-user-alt -icon mt-1"></i>
                                            <input type="text" id="passcon" name="passcon" required="required" class="x-form-control form-control" placeholder="ยืนยันรหัสผ่าน" autocomplete="off" />
                                        </div>
                                        <div id="div-line" class="-x-input-icon mb-3 flex-column text-center d-none">
                                            <!-- <i class="fa fa-bandcamp -icon" aria-hidden="true"></i> -->
                                            <i class="fas fa-user-alt -icon mt-1"></i>
                                            <input type="text" id="line" name="line" required="required" class="x-form-control form-control" placeholder="ไอดีไลน์" autocomplete="off" />
                                        </div>
                                        <div id="div-bank-type" class="-x-input-icon mb-3 flex-column text-center">
                                            <!-- <img src="<?= $baseurl.$assets?>build/web/assets/img/ic_phone.png" class="-icon" alt="" width="12"> -->
                                            <!-- <img src="<?= $baseurl.$assets?>build/web/assets/img/ic_phone.png" class="-icon" alt="" width="12"> -->
                                            <i class="fa fa-university -icon mt-1" aria-hidden="true"></i>
                                            <select id="bank_type" class="form-control">
												<option selected>เลือก ธนาคาร</option>
												<option value="scb">ไทยพาณิชย์</option>
												<option value="bbl">กรุงเทพ</option>
												<option value="kbank">กสิกรไทย</option>
												<option value="ktb">กรุงไทย</option>
												<option value="tmb">ทหารไทย</option>
												<option value="bay">กรุงศรีฯ</option>
												<option value="gsb">ออมสิน</option>
												<option value="tbank">ธนชาติ</option>
												<option value="tisco">ทิสโก้</option>
												<option value="uob">ยูโอบี</option>
												<option value="citi">ซิตี้แบงก์</option>
												<option value="deut">ดอยช์แบงก์</option>
												<option value="tcd">ไทยเครดิต</option>
												<option value="lhb">แลนด์แอนด์เฮ้าส์</option>
												<option value="baac">เพื่อการเกษตรและสหกรณ์การเกษตร</option>
											</select>
                                        </div>

                                        <div class="text-center">
                                            <button type="button" id="checkbank" class="btn -submit btn-primary my-lg-3 mt-0 f-5 f-lg-6">
												<span class="-text-btn">ยืนยัน</span>
											</button>
                                            <button type="button" id="sendregis" class="btn -submit btn-primary my-lg-3 mt-0 f-5 f-lg-6 d-none">
												<span class="-text-btn">สมัครสมาชิก</span>
											</button>
                                        </div>




                                        <div class="x-admin-contact ">
                                            <span class="x-text-with-link-component">
												<label class="-text-message ">พบปัญหา</label>
												<a href="https://lin.ee/Qrz1n6c" class="-link-message " target="_blank"
													rel="noopener">
													<span>ติดต่อฝ่ายบริการลูกค้า</span>
                                            </a>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="x-modal modal " id="resetPasswordModal" tabindex="-1" role="dialog" aria-hidden="true" data-loading-container=".modal-body" data-ajax-modal-always-reload="true" data-ajax-modal="_ajax_/reset-password" data-container="#resetPasswordModal">
            <div class="modal-dialog -modal-size " role="document">
                <div class="modal-content -modal-content">
                    <button type="button" class="close f-1" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
                    <div class="modal-header border-bottom-0 mt-3 pb-0 d-flex flex-column-reverse">
                        <h3 class="x-title-modal font-weight-normal d-inline-block m-auto text-white">
                            <span></span>
                            <hr class="x-hr-border-glow">
                        </h3>
                    </div>
                    <div class="modal-body">
                        <div class="js-modal-content">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="x-contact-us">

            <div class="-contact-inner-wrapper">


                <div>
                    <div class="-text-support-container d-md-block d-none">
                        <div>บริการตลอด</div>
                        <div>
                            <img data-src="<?= $baseurl.$assets?>build/web/assets/img/ic-contact-us.png" alt="Ufabet support 24 hours" class="img-fluid -ic lazyload" width="24" height="21"> 24 ชม.
                        </div>
                    </div>

                    <a class="js-contact-us-toggle -toggle -toggle-desktop" href="https://line.me/R/ti/p/<?= urlencode($line)?>" rel="noopener" target="_blank">
                        <img src="<?= $baseurl.$assets?>build/web/assets/img/support.png" alt="Ufabet support 24 hours" class="img-fluid" width="75" height="74">
                    </a>
                </div>

                <a class="js-contact-us-toggle -toggle -toggle-mobile" href="https://lin.ee/Qrz1n6c" rel="noopener" target="_blank">
                    <picture>
                        <source type="image/webp" srcset="<?= $baseurl.$assets?>build/web/assets/img/support-mobile.webp">
                        <source type="image/png" srcset="<?= $baseurl.$assets?>build/web/assets/img/support-mobile.png">
                        <img src="<?= $baseurl.$assets?>build/web/assets/img/support-mobile.png" alt="Ufabet support 24 hours" class="img-fluid" width="70" height="78">
                    </picture>
                </a>
            </div>
        </div>


        <script id="b-loading" type="text/template">
        </script>

        <script id="loading" type="text/template">
        </script>
        
        <?php //include viewPath('game/powyingshup');?>
        



        <footer class="x-footer -anon">

            <div class="-mobile-application-container lazyload" data-bgset="<?= $baseurl.$assets?>build/web/assets/img/index-bottom-bg.jpg">
                <div class="container -container-inner-wrapper">
                    <h3 class="-pre-title">
                        <span class="-normal-text -highlight">
							UFABET All New
							<img data-src="<?= $baseurl.$assets?>build/web/assets/img/pre-footer-line-light.png"
								class="-line-light lazyload" alt="1UFABET All new footer line image">
						</span>
                        <span>ใหม่หมดต้อง</span>
                        <a href="https://podthai.store" class="-highlight">
							podthai.store
							<img data-src="<?= $baseurl.$assets?>build/web/assets/img/pre-footer-line-light.png"
								class="-line-light lazyload" alt="1UFABET All new footer line image">
						</a><br class="d-none d-md-block">
                        <span class="-normal-text ml-1">
							ตอกย้ำความเป็น ยูฟ่าเบท อันดับหนึ่งในไทย
						</span>
                    </h3>
                </div>
            </div>

            <div class="-inner-wrapper">


                <div class="-tags-wrapper">
                    <div class="container">
                        <div class="row x-footer-seo">
                            <div class="col-12 mb-3 d-block d-lg-none">

                            </div>
                            <div class="col-12 -tags">
                                <a href="javascript:void(0);" class="btn btn-sm">ufabet</a>
                                <a href="javascript:void(0);" class="btn btn-sm">ufabetcasino</a>
                                <a href="javascript:void(0);" class="btn btn-sm">ufabet casino</a>
                                <a href="javascript:void(0);" class="btn btn-sm">casino ufabet</a>
                                <a href="javascript:void(0);" class="btn btn-sm">ufabet คาสิโน</a>
                                <a href="javascript:void(0);" class="btn btn-sm">ufabet บาคาร่า</a>
                                <a href="javascript:void(0);" class="btn btn-sm">คาสิโน ufabet</a>
                                <a href="javascript:void(0);" class="btn btn-sm">บาคาร่า ufabet</a>
                                <a href="javascript:void(0);" class="btn btn-sm">ออนไลน์</a>
                                <a href="javascript:void(0);" class="btn btn-sm">ufabet บาคาร่าออนไลน์</a>
                                <a href="javascript:void(0);" class="btn btn-sm">ufabet เสือมังกร</a>
                                <a href="javascript:void(0);" class="btn btn-sm">ufabet ไฮโล﻿</a>
                                <a href="javascript:void(0);" class="btn btn-sm">ufabet live casino</a>
                                <a href="javascript:void(0);" class="btn btn-sm">ufabet app</a>
                                <a href="javascript:void(0);" class="btn btn-sm">สมัครบาคาร่า</a>
                                <a href="javascript:void(0);" class="btn btn-sm">สมัครบาคาร่าฟรี</a>
                                <a href="javascript:void(0);" class="btn btn-sm">สมัครบาคาร่ามือถือ</a>
                                <a href="javascript:void(0);" class="btn btn-sm">สมัครบาคาร่า ฟรีเครดิต</a>
                                <a href="javascript:void(0);" class="btn btn-sm">สมัครบาคาร่าฟรีเครดิต</a>
                                <a href="javascript:void(0);" class="btn btn-sm">สมัครบาคาร่าเว็บไหนดี</a>
                                <a href="javascript:void(0);" class="btn btn-sm">สมัครบาคาร่า888</a>
                                <a href="javascript:void(0);" class="btn btn-sm">สมัครบาคาร่า royal</a>
                                <a href="javascript:void(0);" class="btn btn-sm">สมัครบาคาร่าสด</a>
                                <a href="javascript:void(0);" class="btn btn-sm">สมัครบาคาร่าได้เครดิตฟรี</a>
                                <a href="javascript:void(0);" class="btn btn-sm">สมัครบาคาร่ายังไง</a>
                                <a href="javascript:void(0);" class="btn btn-sm">สมัครบาคาร่า เครดิตฟรี</a>
                                <a href="javascript:void(0);" class="btn btn-sm">สมัครบาคาร่าออนไลน์</a>
                                <a href="javascript:void(0);" class="btn btn-sm">สมัครบาคาร่าปอยเปต</a>
                                <a href="javascript:void(0);" class="btn btn-sm">game baccarat</a>
                                <a href="javascript:void(0);" class="btn btn-sm">UFABET</a>
                                <a href="javascript:void(0);" class="btn btn-sm">ufa</a>
                                <a href="javascript:void(0);" class="btn btn-sm">แทงบอลออนไลน์</a>
                                <a href="javascript:void(0);" class="btn btn-sm">เว็บพนัน</a>
                                <a href="javascript:void(0);" class="btn btn-sm">แทงบอล</a>
                                <a href="javascript:void(0);" class="btn btn-sm">ยูฟ่า</a>
                                <a href="javascript:void(0);" class="btn btn-sm">ยูฟ่าเบท</a>

                            </div>
                        </div>

                    </div>
                </div>

                <div class="x-footer-bank-logo">
                    <div class="container">
                        <div class="-wrapper">
                            <div class="-ic -ic-1 lazyload" data-bgset="<?= $baseurl.$assets?>build/web/assets/img/ic-bank-logo.png"></div>
                            <div class="-ic -ic-2 lazyload" data-bgset="<?= $baseurl.$assets?>build/web/assets/img/ic-bank-logo.png"></div>
                            <div class="-ic -ic-3 lazyload" data-bgset="<?= $baseurl.$assets?>build/web/assets/img/ic-bank-logo.png"></div>
                            <div class="-ic -ic-4 lazyload" data-bgset="<?= $baseurl.$assets?>build/web/assets/img/ic-bank-logo.png"></div>
                            <div class="-ic -ic-5 lazyload" data-bgset="<?= $baseurl.$assets?>build/web/assets/img/ic-bank-logo.png"></div>
                            <div class="-ic -ic-6 lazyload" data-bgset="<?= $baseurl.$assets?>build/web/assets/img/ic-bank-logo.png"></div>
                            <div class="-ic -ic-7 lazyload" data-bgset="<?= $baseurl.$assets?>build/web/assets/img/ic-bank-logo.png"></div>
                            <div class="-ic -ic-8 lazyload" data-bgset="<?= $baseurl.$assets?>build/web/assets/img/ic-bank-logo.png"></div>
                            <div class="-ic -ic-9 lazyload" data-bgset="<?= $baseurl.$assets?>build/web/assets/img/ic-bank-logo.png"></div>
                            <div class="-ic -ic-10 lazyload" data-bgset="<?= $baseurl.$assets?>build/web/assets/img/ic-bank-logo.png"></div>
                            <div class="-ic -ic-11 lazyload" data-bgset="<?= $baseurl.$assets?>build/web/assets/img/ic-bank-logo.png"></div>
                            <div class="-ic -ic-12 lazyload" data-bgset="<?= $baseurl.$assets?>build/web/assets/img/ic-bank-logo.png"></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="-copyright-wrapper">

                <p class="mb-0">
                    Copyright © 2021 1UFABET. All Rights Reserved.
                </p>
            </div>
        </footer>

        <!-- Global site tag (gtag.js) - Google Analytics -->
        <script rel="preload" as="script" defer src="https://www.googletagmanager.com/gtag/js?id=UA-154557947-11"></script>
        <script>
            window.dataLayer = window.dataLayer || [];

            function gtag() {
                dataLayer.push(arguments);
            }
            gtag('js', new Date());

            gtag('config', 'UA-154557947-11');
        </script>
    </div>

    <script>
    </script>

    <script>
        Bonn.boots.push(function() {
            setTimeout(function() {
                $('#bankInfoModal').modal('show');
            }, 500);
        });
    </script>

    <script>
        var IS_ANDROID = false;
        var IS_TRANSFER_WEBSITE = true;
    </script>

    <script src="build/runtime.1ba6bf05.js"></script>
    <script src="<?= $baseurl.$assets?>build/web/assets/app.1dd07fb0.js"></script>

    <link rel="dns-prefetch" href="cdnjs.cloudflare.com">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/regular.min.css" integrity="sha512-Nqct4Jg8iYwFRs/C34hjAF5og5HONE2mrrUV1JZUswB+YU7vYSPyIjGMq+EAQYDmOsMuO9VIhKpRUa7GjRKVlg==" crossorigin="anonymous" referrerpolicy="no-referrer"
        onload="this.onload=null;this.rel='stylesheet'" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/solid.min.css" integrity="sha512-jQqzj2vHVxA/yCojT8pVZjKGOe9UmoYvnOuM/2sQ110vxiajBU+4WkyRs1ODMmd4AfntwUEV4J+VfM6DkfjLRg==" crossorigin="anonymous" referrerpolicy="no-referrer"
        onload="this.onload=null;this.rel='stylesheet'" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/fontawesome.min.css" integrity="sha512-OdEXQYCOldjqUEsuMKsZRj93Ht23QRlhIb8E/X0sbwZhme8eUw6g8q7AdxGJKakcBbv7+/PX0Gc2btf7Ru8cZA==" crossorigin="anonymous" referrerpolicy="no-referrer"
        onload="this.onload=null;this.rel='stylesheet'" />


    <noscript>
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/regular.min.css"
			integrity="sha512-Nqct4Jg8iYwFRs/C34hjAF5og5HONE2mrrUV1JZUswB+YU7vYSPyIjGMq+EAQYDmOsMuO9VIhKpRUa7GjRKVlg=="
			crossorigin="anonymous" referrerpolicy="no-referrer" />
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/solid.min.css"
			integrity="sha512-jQqzj2vHVxA/yCojT8pVZjKGOe9UmoYvnOuM/2sQ110vxiajBU+4WkyRs1ODMmd4AfntwUEV4J+VfM6DkfjLRg=="
			crossorigin="anonymous" referrerpolicy="no-referrer" />
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/fontawesome.min.css"
			integrity="sha512-OdEXQYCOldjqUEsuMKsZRj93Ht23QRlhIb8E/X0sbwZhme8eUw6g8q7AdxGJKakcBbv7+/PX0Gc2btf7Ru8cZA=="
			crossorigin="anonymous" referrerpolicy="no-referrer" />
	</noscript>
	
	<!--<script src="<?= $baseurl.$assets?>build/js/powyingshup.js"></script>-->
<script src="js/superwheel.js"></script> <!-- superWheel -->
<?php include viewPath('game/wheel');?>
    <script>
        $(document).ready(function() {
            
            $("#checkphone").click(function() {
                let phone = $('#phoneNumber').val();
                $.post("/api/ajax/checkphone", {
                        phone: phone,
                    },
                    function(data) {
                        if (!data.status) {
                            Swal.fire({
                                icon: 'error',
                                title: data.title,
                                text: data.msg
                            });
                        } else {
                            $('#registerModal').modal('hide');
                            $('#bankCheck').modal();
                            $('#berconfirm').val(phone);
                        }
                    });
            });

            $("#checkbank").click(function() {

                $.post("/api/ajax/checkbank", {
                        acc: $('#bank_acc').val(),
                        bank: $('#bank_type').val(),
                    },
                    function(data) {
                        if (!data.status) {
                            Swal.fire({
                                icon: 'error',
                                title: data.title,
                                text: data.msg
                            });
                        } else {
                            $("#bank_type").attr('disabled', 'disabled');
                            $("#div-bank-type").hide();
                            $("#bank_acc").attr('disabled', 'disabled');
                            $('#div-acc').removeClass('d-none');
                            $('#accname').val(data.data.msg);
                            $('#div-pass').removeClass('d-none');
                            $('#div-pass-con').removeClass('d-none');
                            $('#div-line').removeClass('d-none');
                            $('#checkbank').hide();
                            $('#sendregis').removeClass('d-none');
                        }
                    });
            });

            $("#sendregis").click(function() {

                let pass = $('#pass').val();
                let passcon = $('#passcon').val();
                let phone = $('#berconfirm').val();
                let line = $('#line').val();
                let acc = $('#bank_acc').val();
                let accname = $('#accname').val();
                let bank_type = $('#bank_type').val();
                if (line == '' || pass == '' || passcon == '' || phone == '' || acc == '' || bank_type == '') {
                    Swal.fire({
                        icon: 'error',
                        title: 'กรุณากรอกให้ครบทุกช่อง',
                    });
                    return
                }

                if (pass.length < 6) {
                    Swal.fire({
                        icon: 'error',
                        title: 'รหัสผ่านควรมี 6 ตัวขึ้นไป',
                    });
                    return
                }

                if (pass != passcon) {
                    Swal.fire({
                        icon: 'error',
                        title: 'รหัสผ่านไม่ตรงกัน',
                    });
                    return
                }

                $.post("/api/register", {
                        username: phone,
                        password: pass,
                        fname: accname,
                        line: line,
                        bank_number: acc,
                        bank_name: bank_type,
                        promotion: 0,
                    },
                    function(data) {
                        if (!data.status) {
                            Swal.fire({
                                icon: 'error',
                                title: data.msg,
                            });
                        } else {
                            Swal.fire({
                                icon: 'success',
                                title: data.msg,
                            }).then(function() {
                                window.location.reload();
                            });
                        }
                    });
            });

            $("#btn-login").click(function() {

                let username = $('#username').val();
                let password = $('#password').val();

                $.post("/api/login", {
                        username: username,
                        password: password,
                    },
                    function(data) {
                        if (!data.status) {
                            Swal.fire({
                                icon: 'error',
                                title: data.msg,
                            });
                        } else {
                            Swal.fire({
                                icon: 'success',
                                title: data.msg,
                            }).then(function() {
                                window.location.reload();
                            });
                            // window.location.reload();
                        }
                    });
            });
            
            $("#btn-customer-balance-reload").click(function() {

                $.ajax({
                    url: 'apiufa/Balance',
                    method: 'get',
                    success: function(data) {
                        var rr = JSON.parse(data);
                        $('.ufabet-credit').html(rr.balance)
                    }
                });
            });

        });
    </script>

</body>

</html>