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
	<link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin="">
	<link rel="dns-prefetch" href="//fonts.gstatic.com/">
	<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Kanit:wght@300;400;500;600;700&amp;display=swap" as="font" onload="this.onload=null;this.rel='stylesheet'">
	<noscript>
		<link href="https://fonts.googleapis.com/css2?family=Kanit:wght@300;400;500;600;700&display=swap" crossorigin rel="stylesheet">
	</noscript>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta name="robots" content="noodp">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
	<meta name="apple-mobile-web-app-title" content="<?= $webname; ?> สล็อตออนไลน์ สล็อต ยิงปลา เกมเยอะเล่นง่าย slot online">
	<title><?= $webname; ?> สล็อตออนไลน์ เล่นง่ายได้ไว ไม่ต้องโอนย้าย มีเกมส์ให้เลือกมากมายทั้งสล็อต เกมคาสิโน สกิลเกม ยิงปลา
		และ แทงบอล | <?= $webname; ?> สล็อตออนไลน์ เล่นง่ายได้ไว ไม่ต้องโอนย้าย มีเกมส์ให้เลือกมากมายทั้งสล็อต เกมคาสิโน สกิลเกม
		ยิงปลา และ แทงบอล</title>
	<meta name="description" content="<?= $webname; ?> สล็อตออนไลน์ เล่นง่ายได้ไว ไม่ต้องโอนย้าย มีเกมส์ให้เลือกมากมายทั้งสล็อต เกมคาสิโน สกิลเกม ยิงปลา และ แทงบอล">
	<meta name="keywords" content="slot, slot online, <?= $webname; ?>, game slot, gameslot, สล็อต, สล็อตออนไลน์, เกมสล็อต, ยิงปลา, เกมยิงปลา, joker, evoplay, simpleplay, playstar, kingmaker, habanero">
	<meta property="og:title" content="<?= $webname; ?> สล็อตออนไลน์ สล็อต ยิงปลา เกมเยอะเล่นง่าย slot online">
	<meta property="og:description" content="<?= $webname; ?> สล็อตออนไลน์ เล่นง่ายได้ไว ไม่ต้องโอนย้าย มีเกมส์ให้เลือกมากมายทั้งสล็อต เกมคาสิโน สกิลเกม ยิงปลา และ แทงบอล">
	<meta property="og:locale" content="th">
	<meta property="og:site_name" content="<?= $webname; ?> สล็อตออนไลน์ สล็อต ยิงปลา เกมเยอะเล่นง่าย slot online">
	<meta property="og:url" content="https://podthai.store/">
	<meta property="og:image" content="https://podthai.store/images/logo.png">
	<link rel="canonical" href="https://podthai.store">
	<link rel="apple-touch-icon" sizes="57x57" href="https://podthai.store/images/logo.png">
	<link rel="apple-touch-icon" sizes="60x60" href="https://podthai.store/images/logo.png">
	<link rel="apple-touch-icon" sizes="72x72" href="https://podthai.store/images/logo.png">
	<link rel="apple-touch-icon" sizes="76x76" href="https://podthai.store/images/logo.png">
	<link rel="apple-touch-icon" sizes="114x114" href="https://podthai.store/images/logo.png">
	<link rel="apple-touch-icon" sizes="120x120" href="https://podthai.store/images/logo.png">
	<link rel="apple-touch-icon" sizes="144x144" href="https://podthai.store/images/logo.png">
	<link rel="apple-touch-icon" sizes="152x152" href="https://podthai.store/images/logo.png">
	<link rel="apple-touch-icon" sizes="180x180" href="https://podthai.store/images/logo.png">
	<link rel="icon" type="image/png" sizes="192x192" href="https://podthai.store/images/logo.png">
	<link rel="icon" href="" as="style" onload="this.onload=null;this.rel='icon'">
	<noscript>
		<link rel="icon" href="" />
	</noscript>
	<meta name="msapplication-TileColor" content="#ffffff">
	<meta name="msapplication-TileImage" content="">
	<meta name="theme-color" content="#ffffff">
	<link rel="stylesheet" href="css/sweetalert2.min.css">
	<meta name="format-detection" content="telephone=no">
	<link rel="stylesheet" href="<?= $baseurl . $assets ?>assets/css/style.css">
	<script type="text/javascript" async="" src="https://www.google-analytics.com/analytics.js"></script>
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<script type="text/javascript" src="js/sweetalert2.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
	<script src="<?= $baseurl . $assets ?>/js/clipboard.min.js"></script>
	<script src="https://www.google.com/recaptcha/api.js"></script>
	<link rel="stylesheet" href="<?= $baseurl . $assets ?>assets/css/main.css"> <!-- superWheel -->
	<link rel="stylesheet" href="<?= $baseurl . $assets ?>assets/css/superwheel.css"> <!-- superWheel -->

	<style>
		.sidenav {
			height: 100%;
			width: 0;
			position: fixed;
			z-index: 1000;
			top: 0;
			left: 0;
			background-color: #fc7c0e;
			overflow-x: hidden;
			transition: 0.5s;
			padding-top: 60px;
			margin: 0 auto;
			text-shadow: 3px -2px #f83a00;
			box-shadow: 4px -1px 9px 0px #14141357;
		}

		.sidenav a {
			padding: 8px 8px 8px 8px;
			text-decoration: none;
			font-size: 25px;
			color: #fff;
			display: block;
			transition: 0.5s;
		}

		.sidenav a:hover {
			color: #fbba20;
			background-color: #f83a00;
		}

		.sidenav .closebtn {
			position: absolute;
			top: 0;
			right: 25px;
			font-size: 43px;
			margin-left: 50px;
		}

		@media screen and (max-height: 450px) {
			.sidenav {
				padding-top: 15px;
			}

			.sidenav a {
				font-size: 18px;
			}
		}

		.center {
			display: block;
			margin-left: auto;
			margin-right: auto;

		}

		.modal-open {
			padding-right: 0px !important;
		}
	</style>
</head>

<body>



	<nav class="x-header js-header-selector navbar navbar-expand-lg -anon">
		<div class="container-fluid -inner-container">
			<div class="d-none d-lg-block">

			</div>

			<div id="headerBrand">
				<a class="navbar-brand" href="/">
					<img class="-logo -default" src="images/logo.png" alt="EZ Slot">
					<img class="-logo -invert" src="images/logo.png" alt="EZ Slot">
				</a>
			</div>

			<div class="x-menu-list-sidebar">
				<div class="-inner-wrapper">
					<div class="-brand-heading">
						<a href="/" class="-logo-img js-theme-switcher-toggle" data-toggle="modal" data-target="#themeSwitcherModal">
							<img data-src="images/logo.png" src="images/default-loading-normal.png" alt="EZ Slot" class="-logo lazyload">
							<div class="-dropdown-ic">
								<i class="fas fa-angle-down"></i>
							</div>
						</a>
					</div>

				</div>
				<div class="-overlay"></div>
			</div>
			<div id="headerContent">
				<div class="d-flex">
					<?php
					if (!$user) { ?>
						<a href="#" target="_blank" class="btn -btn-play-demo d-lg-block d-none mr-3" data-toggle="modal" data-target="#RegisterModal">
							สมัครสมาชิก
						</a>

						<a href="#" class="-btn-header-login btn f-sm-6 f-7" data-toggle="modal" data-target="#loginModal" style="background:linear-gradient(180deg, #91f27f, #00b302);color:#FFF">
							เข้าสู่ระบบ
						</a>
					<?php } else { ?>
						<div id="headerContent">
							<ul class="navbar-nav ml-auto">
								<div class="x-logged x-top-firework">
									<div class="d-flex dropdown -logged-container">
										<div class=" px-3 px-lg-4 --profile" style="padding-top: 10px;">
											<div class="d-flex">
												<div class="mr-2 d-flex js-logged-sidebar">
													<div class="x-profile-image d-sm-inline-block d-none">
														<img class="img-fluid mb-1" src="images/profile_icon_level_021.png" alt="icon deposit white">
													</div>
													<div class="x-profile-image d-sm-none d-inline-block">
														<img class="img-fluid mb-1" src="images/profile_icon_level_021.png" alt="icon deposit white">
													</div>
												</div>
												<div class="d-flex flex-column m-auto --profile-detail">
													<div class="text-lg-left f-7 js-logged-sidebar d-sm-inline-block d-none" style="font-size: 1.2rem !important;"><?= $user ?></div>
													<div class="text-lg-left f-7 js-logged-sidebar d-sm-none d-inline-block" style="font-size: 1.2rem !important;"><?= $user ?></div>
													<br>
													<div class="text-primary -user-balance text-nowrap d-sm-inline-block d-none">
														<span>
															<span class="ufabet-credit">0.00</span>
														</span>
														<button type="button" class="btn btn-link p-0" id="btn-customer-balance-reload" onclick="window.location.reload();">
															<i class="check-credit-status2 fas fa-sync-alt text-white f-9"></i>
														</button>
													</div>

													<div class="text-primary -user-balance text-nowrap d-sm-none d-inline-block">
														<span>
															<span class="ufabet-credit">0.00</span>
														</span>
														<button type="button" class="btn btn-link p-0" id="btn-customer-balance-reload" onclick="window.location.reload();">
															<i class="check-credit-status2 fas fa-sync-alt text-white f-9"></i>
														</button>
													</div>
													<br>
													<div class="flex-column text-white js-logged-sidebar mt-1 d-sm-inline-block d-none" style="font-size: 14px; ">
														<a href="#" class=" btn-success" id="ufaprofile" data-toggle="modal" data-target="#memberModal" style="padding:3px;border-radius:5px"> ข้อมูลส่วนตัว</a>
													</div>
													<div class="d-sm-none d-inline-block">
														<a class="flex-column text-white js-logged-sidebar mt-1 d-sm-none d-inline-block" onclick="addClassshow()" style="font-size: 18px; ">
															<a href="#" class=" btn-success" id="ufaprofile" data-toggle="modal" data-target="#memberModal" style="padding:3px;border-radius:5px"> ข้อมูลส่วนตัว</a></a>
													</div>
												</div>
											</div>
										</div>
										<div class="--deposit d-none d-lg-block">
											<a href="#" class="text-white" id="ufadeposit" data-toggle="modal" data-target="#modal-deposit">
												<div class="d-flex flex-column justify-content-center h-100 px-3">
													<img class="img-fluid mt-2" src="images/ic_deposit_white2.png" alt="icon deposit white" width="35">
													<div class="f-7 mt-1">ฝากเงิน</div>
												</div>
											</a>
										</div>

										<div class="--withdraw d-none d-lg-block">
											<a href="#" class="text-white" id="ufawithdraw" data-toggle="modal" data-target="#modal-withdraw">
												<div class="d-flex flex-column justify-content-center  h-100 px-3">
													<img class="img-fluid mt-2" src="images/ic_withdraw_white2.png" alt="icon deposit white" width="35">
													<div class="f-7 mt-1">ถอนเงิน</div>
												</div>
											</a>
										</div>
										<div class="--wheelspin d-none d-lg-block">
											<a href="#" class="text-white" id="wheelspinufa">
												<div class="d-flex flex-column justify-content-center  h-100 px-3">
													<img class="img-fluid mt-2" src="images/icon_wheelspin.png" alt="icon wheelspin white" width="35">
													<div class="f-7 mt-1">วงล้อ</div>
												</div>
											</a>
										</div>
									</div>
								</div>
							</ul>
						</div>
					<?php  } ?>
				</div>
			</div>
		</div>
	</nav>

	<div class="x-cover x-index-cover-container">
		<div class="container-fluid h-100">
			<div class="row -contents-wrapper ">

				<div class="col-12 col-md-6 -left-content -default">
					<div class="x-index-image-cover-inner-container">
						<style type="text/css">
							.thelogoleft {
								margin-top: -50px;
							}

							.hidesmoketop {
								display: block;
							}

							@media (max-width: 767px) {
								.thelogoleft {
									margin-top: 50px;
								}
							}

							@media (max-width: 575px) {
								.hidesmoketop {
									display: none;
								}

								.thesubtitle01 {
									padding-top: 50px;
								}
							}
						</style>
						<img src="images/logo.png" class="-games-girls thelogoleft" alt="<?= $webname; ?> รูปผู้หญิงน่ารัก games cute girl image png">
					</div>
				</div>
				<div class="col-12 col-md-6 -right-content -default">
					<div>
						<h2 class="-title js-excited" style="margin-top: 10px;">
							<div class="js-item x-text-excited-fade-out x-text-excited-fade-in">NEWUFABET</div>
							<div class="d-flex justify-content-md-start justify-content-center">
								<div class="mr-2 js-item x-text-excited-fade-out x-text-excited-fade-in">โปรโมชั่นดีๆ แจกเครดิตฟรีทุกวัน</div>
								<div class="js-item x-text-excited-fade-out">

								</div>
							</div>
						</h2>
						<?php if ($user) { ?>
							<div class="-btn-wrapper x-btn-register d-none d-lg-inline-block d-lg-inline-block-1 animated fadeInUp" data-animatable="fadeInUp" data-delay="500">
								<a href="game" target="_blank" id="game_login_pc_1" class="btn -register-btn">
									<div class="-glow-container"></div>
									<span>เข้าเล่นเกมส์</span>
									<div class="x-sonar-rectangle-center-animation"></div>
								</a>
							</div>
						<?php  } ?>
						<h1 class="-sub-title thesubtitle01"><?= $webname; ?> สล็อตออนไลน์ ยิงปลา เกมคาสิโทย</h1>
					</div>

					<div class="-btn-wrapper x-btn-register d-none d-lg-inline-block animated fadeInUp" data-animatable="fadeInUp" data-delay="500">
						<?php if (!$user) { ?>
							<a href="#" class="btn -register-btn" data-toggle="modal" data-target="#RegisterModal">
								<div class="-glow-container"></div>
								<span>สมัครสมาชิก</span>
								<div class="x-sonar-rectangle-center-animation"></div>
							</a>

						<?php } else { ?>
							<a href="game" target="_blank" id="game_login_pc_2" class="btn -register-btn">
								<div class="-glow-container"></div>
								<span>เข้าเล่นเกมส์</span>
								<div class="x-sonar-rectangle-center-animation"></div>
							</a>
						<?php } ?>
					</div>
				</div>
				<div class="hidesmoketop">
					<img src="images/ez-slot-cloud.png" class="-cloud-cartoon-default-customize -item-1" alt="<?= $webname; ?> รูปก้อนเมฆ">
					<img src="images/ez-slot-cloud.png" class="-cloud-cartoon-default-customize -item-2" alt="<?= $webname; ?> รูปก้อนเมฆ">
				</div>

			</div>
		</div>

		<div class="-cover-foreground d-none d-md-block" style="background-image: url('images/ez-slot-cover-foreground.png')"></div>
		<div class="-cover-foreground -mini d-md-none" style="background-image: url('images/ez-slot-cover-foreground-mobile.png')"></div>
	</div>
	<div id="main__content" class="    x-homepage">
		<div class="x-index-content-main-container pb-4 -logged">
			<div class="-category-total-game">
				<nav class="nav-menu" id="navbarCategory">
					<ul class="-menu-parent navbar-nav flex-row">
						<?php if (!$user) { ?>
							<li class="-list-parent nav-item px-lg-2 -category-brand dropdown animated fadeInRight" data-animatable="fadeInRight" data-delay="100">
								<a href="#" class="-menu-btn btn-block nav-link" style="color:#fec649;">
									<div class=" -img-category">
									</div>
									<span class="-menu-text-main">ผู้ให้บริการ
									</span>
								</a>
							</li>
							<li class="-list-parent nav-item px-lg-2 -category-type animated fadeInRight" data-animatable="fadeInRight" data-delay="200">
								<a class="-menu-btn btn-block nav-link" href="#">
									<div class="-img-category"></div>
									<div class="-menu-text">
										<span class="-menu-text-main">เกมส์สล็อต</span>
									</div>
								</a>
							</li>
							<li class="-list-parent nav-item px-lg-2 -category-casino animated fadeInRight" data-animatable="fadeInRight" data-delay="300">
								<a class="-menu-btn btn-block nav-link" href="#">
									<div class="-img-category"></div>
									<div class="-menu-text">
										<span class="-menu-text-main">คาสิโนสด</span>
									</div>
								</a>
							</li>
							<li class="-list-parent nav-item px-lg-2 -category-sport animated fadeInRight" data-animatable="fadeInRight" data-delay="400">
								<a class="-menu-btn btn-block nav-link" href="#">
									<div class="-img-category"></div>
									<div class="-menu-text">
										<span class="-menu-text-main">สปอร์ต</span>
									</div>
								</a>
							</li>
							<li class="-list-parent nav-item px-lg-2 -category-skill-game animated fadeInRight" data-animatable="fadeInRight" data-delay="500">

								<a class="-menu-btn btn-block nav-link" href="#">
									<div class="-img-category"></div>
									<div class="-menu-text">
										<span class="-menu-text-main">สกิลเกมส์</span>
									</div>
								</a>
							</li>
							<li class="-list-parent nav-item px-lg-2 -category-fishing-game animated fadeInRight" data-animatable="fadeInRight" data-delay="600">

								<a class="-menu-btn btn-block nav-link" href="#">
									<div class="-img-category"></div>
									<div class="-menu-text">
										<span class="-menu-text-main">ยิงปลา</span>
									</div>
								</a>
							</li>

						<?php } else { ?>
							<li class="-list-parent nav-item px-lg-2 -category-casino animated fadeInRight" data-animatable="fadeInRight" data-delay="300">
								<a class="-menu-btn btn-block nav-link" href="#" onclick="setData_powyingshup()">
									<div class="-img-category"></div>
									<div class="-menu-text">
										<span class="-menu-text-main">เป่ายิ้งฉุบ</span>
									</div>
								</a>
							</li>
							<li class="-list-parent nav-item px-lg-2 -category-skill-game animated fadeInRight" data-animatable="fadeInRight" data-delay="500">

								<a class="-menu-btn btn-block nav-link" href="#" data-toggle="modal" data-target="#modal-promotion">
									<div class="-img-category"></div>
									<div class="-menu-text">
										<span class="-menu-text-main">รับเครดิตเล่น</span>
										<span class="-menu-text-main">เป่ายิ้งฉุบ</span>
									</div>
								</a>
							</li>
							<?php
							$data_pro_1 = $this->admin_model->get_promotions();
							if ($data_pro_1[0]['stats'] == 1) {
							?>
								<li class="-list-parent nav-item px-lg-2 -category-brand dropdown animated fadeInRight" data-animatable="fadeInRight" data-delay="100">
									<a href="#" class="-menu-btn btn-block nav-link" style="color:#fec649;" data-toggle="modal" data-target="#promotion_register">
										<div class=" -img-category">
										</div>
										<span class="-menu-text-main">โปรโมชั่น</span>
										<span class="-menu-text-main">สมัครใหม่</span>
									</a>
								</li>
							<?php } ?>
							<?php
							$data_pro_1 = $this->admin_model->get_promotions();
							if ($data_pro_1[1]['stats'] == 1) {
							?>
								<li class="-list-parent nav-item px-lg-2 -category-type animated fadeInRight" data-animatable="fadeInRight" data-delay="200">
									<a class="-menu-btn btn-block nav-link" href="#" data-toggle="modal" data-target="#promotion_newdate">
										<div class="-img-category"></div>
										<div class="-menu-text">
											<span class="-menu-text-main">โปรโมชั่น </span>
											<span class="-menu-text-main">ฝากแรกของวัน </span>

										</div>
									</a>
								</li>
							<?php } ?>
							<li class="-list-parent nav-item px-lg-2 -category-sport animated fadeInRight" data-animatable="fadeInRight" data-delay="400">
								<a class="-menu-btn btn-block nav-link" href="#" data-toggle="modal" data-target="#refFriendModal">
									<div class="-img-category"></div>
									<div class="-menu-text">
										<span class="-menu-text-main">แนะนำเพื่อน</span>
										<span class="-menu-text-main">รับโบนัส</span>
									</div>
								</a>
							</li>

							<li class="-list-parent nav-item px-lg-2 -category-fishing-game animated fadeInRight" data-animatable="fadeInRight" data-delay="600">

								<a class="-menu-btn btn-block nav-link" href="#" data-toggle="modal" data-target="#modal-history">
									<div class="-img-category"></div>
									<div class="-menu-text">
										<span class="-menu-text-main">ประวัติการ</span>
										<span class="-menu-text-main">ทำรายการ</span>
									</div>
								</a>
							</li>
							<li class="-list-parent nav-item px-lg-2 -category-logout animated fadeInRight" data-animatable="fadeInRight" data-delay="600">

								<a class="-menu-btn btn-block nav-link" href="#" onclick="logoutufa()">
									<div class="-img-category"></div>
									<div class="-menu-text">
										<span class="-menu-text-main">ออกจากระบบ</span>
									</div>
								</a>
							</li>
						<?php } ?>
					</ul>
				</nav>
			</div>
		</div>
	</div>
	<br><br>
	<style>
		.x-game-video-component {
			display: none;
		}
	</style>
	<div class="-provider-logo-top">
		<div class="x-slot-providers-logo-component -index-top ">
		</div>
	</div>
	</div>
	<div id="main__content" class="x-homepage" style="zoom:85%;">
		<div class="x-index-content-main-container pb-4 -logged">
			<div class="-popular-games-list-container animated fadeInUp" data-animatable="fadeInUp" data-delay="150">
				<h2 class="-game-title h5 d-lg-none">Popular Games</h2>
				<ul class="navbar-nav">
					<li class="nav-item d-none d-lg-inline-block">
						<div class="x-game-list-heading-macro -best -big">
							<div class="-inner-wrapper">
								<picture>
									<source type="image/webp" data-srcset="https://asset.cloudigame.co/build/admin/img/ez-wt-mg-slot/2101-vertical.webp" srcset="https://asset.cloudigame.co/build/admin/img/ez-wt-mg-slot/2101-vertical.webp">
									<source type="image/png" data-srcset="https://asset.cloudigame.co/build/admin/img/ez-wt-mg-slot/2101-vertical.png" srcset="https://asset.cloudigame.co/build/admin/img/ez-wt-mg-slot/2101-vertical.png">
									<img class="-cover-img lazyloaded" alt="wt-mg-slot cover image png" data-src="https://asset.cloudigame.co/build/admin/img/ez-wt-mg-slot/2101-vertical.png" src="https://asset.cloudigame.co/build/admin/img/ez-wt-mg-slot/2101-vertical.png">
								</picture>
								<div class="-overlay">
									<span class="-length">Popular Games</span>
									<h2 class="-title">All Games</h2>
									<a href="#" class="-seemore-btn">All games</a>
								</div>
							</div>
						</div>
					</li>

					<li class="nav-item -first">
						<div class="x-game-list-item-macro js-game-list-toggle -big " data-status="">
							<div class="-inner-wrapper">
								<div class="x-game-badge-component -hot -big animated fadeInUp" data-animatable="fadeInUp" data-delay="400">
									<span>Hot</span>
								</div>
								<picture>
									<source type="image/webp" data-srcset="https://asset.cloudigame.co/build/admin/img/ez-wt-joker/gkubyu4cjibrg-vertical.png?v=1" srcset="https://asset.cloudigame.co/build/admin/img/ez-wt-joker/gkubyu4cjibrg-vertical.png?v=1">
									<source type="image/png?v=1" data-srcset="https://asset.cloudigame.co/build/admin/img/ez-wt-joker/gkubyu4cjibrg-vertical.png?v=1" srcset="https://asset.cloudigame.co/build/admin/img/ez-wt-joker/gkubyu4cjibrg-vertical.png?v=1">
									<img class="-cover-img img-fluid lazyloaded" alt="wt-red-tiger cover image png" width="249" height="361" data-src="https://asset.cloudigame.co/build/admin/img/ez-wt-joker/gkubyu4cjibrg-vertical.png?v=1" src="https://asset.cloudigame.co/build/admin/img/ez-wt-joker/gkubyu4cjibrg-vertical.png?v=1">
								</picture>
								<div class="-overlay">
									<div class="-overlay-inner">
										<div class="-wrapper-container">

											<a href="https://www.eagaming.com/en/play-game?brandName=eagaming&amp;gameID=51&amp;locale=th&amp;redirectUrl=https://jokertm.com/test-slot/" class="-btn -btn-demo" target="_blank" rel="nofollow noopener">
												ทดลองเล่น
											</a>
										</div>
									</div>
								</div>
							</div>
							<div class="-title"></div>
						</div>
					</li>
					<li class="nav-item -first">
						<div class="x-game-list-item-macro js-game-list-toggle -big " data-status="">
							<div class="-inner-wrapper">
								<div class="x-game-badge-component -hot -big animated fadeInUp" data-animatable="fadeInUp" data-delay="400">
									<span>Hot</span>
								</div>
								<picture>
									<source type="image/webp" data-srcset="https://asset.cloudigame.co/build/admin/img/ez-wt-joker/dngdhamgc71gk-vertical.png?v=1" srcset="https://asset.cloudigame.co/build/admin/img/ez-wt-joker/dngdhamgc71gk-vertical.png?v=1">
									<source type="image/png?v=1" data-srcset="https://asset.cloudigame.co/build/admin/img/ez-wt-joker/dngdhamgc71gk-vertical.png?v=1" srcset="https://asset.cloudigame.co/build/admin/img/ez-wt-joker/dngdhamgc71gk-vertical.png?v=1">
									<img class="-cover-img img-fluid lazyloaded" alt="wt-red-tiger cover image png" width="249" height="361" data-src="https://asset.cloudigame.co/build/admin/img/ez-wt-joker/dngdhamgc71gk-vertical.png?v=1" src="https://asset.cloudigame.co/build/admin/img/ez-wt-joker/dngdhamgc71gk-vertical.png?v=1">
								</picture>
								<div class="-overlay">
									<div class="-overlay-inner">
										<div class="-wrapper-container">

											<a href="https://www.funkygames.io/demo?gameCode=602813&amp;lang=en" class="-btn -btn-demo" target="_blank" rel="nofollow noopener">
												ทดลองเล่น
											</a>
										</div>
									</div>
								</div>
							</div>
							<div class="-title"></div>
						</div>
					</li>
					<li class="nav-item -first">
						<div class="x-game-list-item-macro js-game-list-toggle -big " data-status="">
							<div class="-inner-wrapper">
								<div class="x-game-badge-component -hot -big animated fadeInUp" data-animatable="fadeInUp" data-delay="400">
									<span>Hot</span>
								</div>
								<picture>
									<source type="image/webp" data-srcset="https://asset.cloudigame.co/build/admin/img/ez-wt-joker/jbzd1cjsgh4dk-vertical.png?v=1" srcset="https://asset.cloudigame.co/build/admin/img/ez-wt-joker/jbzd1cjsgh4dk-vertical.png?v=1">
									<source type="image/png?v=1" data-srcset="https://asset.cloudigame.co/build/admin/img/ez-wt-joker/jbzd1cjsgh4dk-vertical.png?v=1" srcset="https://asset.cloudigame.co/build/admin/img/ez-wt-joker/jbzd1cjsgh4dk-vertical.png?v=1">
									<img class="-cover-img img-fluid lazyloaded" alt="wt-red-tiger cover image png" width="249" height="361" data-src="https://asset.cloudigame.co/build/admin/img/ez-wt-joker/jbzd1cjsgh4dk-vertical.png?v=1" src="https://asset.cloudigame.co/build/admin/img/ez-wt-joker/jbzd1cjsgh4dk-vertical.png?v=1">
								</picture>
								<div class="-overlay">
									<div class="-overlay-inner">
										<div class="-wrapper-container">

											<a href="https://app-test.insvr.com/games/?brandid=a9d542ac-c9bb-e311-93f6-80c16e0883f4&amp;brandgameid=e4cf8a58-53f1-41cb-95a3-076bdf5a5ede&amp;token=&amp;mode=fun&amp;locale=en&amp;lobbyurl=https://haba88.com/" class="-btn -btn-demo" target="_blank" rel="nofollow noopener">
												ทดลองเล่น
											</a>
										</div>
									</div>
								</div>
							</div>
							<div class="-title"></div>
						</div>
					</li>
					<li class="nav-item -first">
						<div class="x-game-list-item-macro js-game-list-toggle -big " data-status="">
							<div class="-inner-wrapper">
								<div class="x-game-badge-component -hot -big animated fadeInUp" data-animatable="fadeInUp" data-delay="400">
									<span>Hot</span>
								</div>
								<picture>
									<source type="image/webp" data-srcset="https://asset.cloudigame.co/build/admin/img/ez-wt-jili/102-vertical.png?v=1" srcset="https://asset.cloudigame.co/build/admin/img/ez-wt-jili/102-vertical.png?v=1">
									<source type="image/png?v=1" data-srcset="https://asset.cloudigame.co/build/admin/img/ez-wt-jili/102-vertical.png?v=1" srcset="https://asset.cloudigame.co/build/admin/img/ez-wt-jili/102-vertical.png?v=1">
									<img class="-cover-img img-fluid lazyloaded" alt="wt-red-tiger cover image png" width="249" height="361" data-src="https://asset.cloudigame.co/build/admin/img/ez-wt-jili/102-vertical.png?v=1" src="https://asset.cloudigame.co/build/admin/img/ez-wt-jili/102-vertical.png?v=1">
								</picture>
								<div class="-overlay">
									<div class="-overlay-inner">
										<div class="-wrapper-container">

											<a href="https://jiligames.com/plusplayer/PlusTrial/102" class="-btn -btn-demo" target="_blank" rel="nofollow noopener">
												ทดลองเล่น
											</a>
										</div>
									</div>
								</div>
							</div>
							<div class="-title"></div>
						</div>
					</li>
					<li class="nav-item -first">
						<div class="x-game-list-item-macro js-game-list-toggle -big " data-status="">
							<div class="-inner-wrapper">
								<div class="x-game-badge-component -hot -big animated fadeInUp" data-animatable="fadeInUp" data-delay="400">
									<span>Hot</span>
								</div>
								<picture>
									<source type="image/webp" data-srcset="https://asset.cloudigame.co/build/admin/img/ez-wt-joker/5m6k9j7rwspjs-vertical.png?v=1" srcset="https://asset.cloudigame.co/build/admin/img/ez-wt-joker/5m6k9j7rwspjs-vertical.png?v=1">
									<source type="image/png?v=1" data-srcset="https://asset.cloudigame.co/build/admin/img/ez-wt-joker/5m6k9j7rwspjs-vertical.png?v=1" srcset="https://asset.cloudigame.co/build/admin/img/ez-wt-joker/5m6k9j7rwspjs-vertical.png?v=1">
									<img class="-cover-img img-fluid lazyloaded" alt="wt-red-tiger cover image png" width="249" height="361" data-src="https://asset.cloudigame.co/build/admin/img/ez-wt-joker/5m6k9j7rwspjs-vertical.png?v=1" src="https://asset.cloudigame.co/build/admin/img/ez-wt-joker/5m6k9j7rwspjs-vertical.png?v=1">
								</picture>
								<div class="-overlay">
									<div class="-overlay-inner">
										<div class="-wrapper-container">

											<a href="http://www.gamingworld.net/en/play-game?redirectUrl=https://pgslot-game.com/slot-roma/&amp;gameID=66" class="-btn -btn-demo" target="_blank" rel="nofollow noopener">
												ทดลองเล่น
											</a>
										</div>
									</div>
								</div>
							</div>
							<div class="-title"></div>
						</div>
					</li>
					<li class="nav-item -first">
						<div class="x-game-list-item-macro js-game-list-toggle -big " data-status="">
							<div class="-inner-wrapper">
								<div class="x-game-badge-component -hot -big animated fadeInUp" data-animatable="fadeInUp" data-delay="400">
									<span>Hot</span>
								</div>
								<picture>
									<source type="image/webp" data-srcset="https://asset.cloudigame.co/build/admin/img/ez-wt-ps/PSS-ON-00121-vertical-animation.gif" srcset="https://asset.cloudigame.co/build/admin/img/ez-wt-ps/PSS-ON-00121-vertical-animation.gif">
									<source type="image/png?v=1" data-srcset="https://asset.cloudigame.co/build/admin/img/ez-wt-ps/PSS-ON-00121-vertical-animation.gif" srcset="https://asset.cloudigame.co/build/admin/img/ez-wt-ps/PSS-ON-00121-vertical-animation.gif">
									<img class="-cover-img img-fluid lazyloaded" alt="wt-red-tiger cover image png" width="249" height="361" data-src="https://asset.cloudigame.co/build/admin/img/ez-wt-ps/PSS-ON-00121-vertical-animation.gif" src="https://asset.cloudigame.co/build/admin/img/ez-wt-ps/PSS-ON-00121-vertical-animation.gif">
								</picture>
								<div class="-overlay">
									<div class="-overlay-inner">
										<div class="-wrapper-container">

											<a href="https://ezslot.bet/lobby/test?channelCode=wt-ps&amp;metadata%5Bgame_id%5D=PSS-ON-00121" class="-btn -btn-demo" target="_blank" rel="nofollow noopener">
												ทดลองเล่น
											</a>
										</div>
									</div>
								</div>
							</div>
							<div class="-title"></div>
						</div>
					</li>
				</ul>
			</div>


			<div class="-slot-games-list-container animated fadeInUp" data-animatable="fadeInUp" data-delay="150">
				<h2 class="-game-title h5 d-lg-none">Slot Games</h2>
				<ul class="navbar-nav">
					<li class="nav-item d-none d-lg-inline-block">
						<div class="x-game-list-heading-macro -slot -big">
							<div class="-inner-wrapper">
								<picture>
									<source type="image/webp" data-srcset="https://asset.cloudigame.co/build/admin/img/ez-wt-ygg-gaming/cover-wt-ygg-gaming-vertical.webp" srcset="https://asset.cloudigame.co/build/admin/img/ez-wt-ygg-gaming/cover-wt-ygg-gaming-vertical.webp">
									<source type="image/png" data-srcset="https://asset.cloudigame.co/build/admin/img/ez-wt-ygg-gaming/cover-wt-ygg-gaming-vertical.png" srcset="https://asset.cloudigame.co/build/admin/img/ez-wt-ygg-gaming/cover-wt-ygg-gaming-vertical.png">
									<img class="-cover-img lazyloaded" alt="wt-ygg-gaming cover image png" data-src="https://asset.cloudigame.co/build/admin/img/ez-wt-ygg-gaming/cover-wt-ygg-gaming-vertical.png" src="https://asset.cloudigame.co/build/admin/img/ez-wt-ygg-gaming/cover-wt-ygg-gaming-vertical.png">
								</picture>
								<div class="-overlay">
									<span class="-length">ผู้ให้บริการ</span>
									<h2 class="-title">Slot Games</h2>
									<a href="#" class="-seemore-btn">All games</a>
								</div>
							</div>
						</div>
					</li>
					<li class="nav-item -first">
						<div class="x-game-list-item-macro js-game-list-toggle -big -cannot-entry -untestable" data-status="-cannot-entry -untestable">
							<div class="-inner-wrapper">
								<picture>
									<source type="image/webp" data-srcset="https://asset.cloudigame.co/build/admin/img/ez-pg-soft/cover-pg-soft-vertical.webp" srcset="https://asset.cloudigame.co/build/admin/img/ez-pg-soft/cover-pg-soft-vertical.webp">
									<source type="image/png" data-srcset="https://asset.cloudigame.co/build/admin/img/ez-pg-soft/cover-pg-soft-vertical.png" srcset="https://asset.cloudigame.co/build/admin/img/ez-pg-soft/cover-pg-soft-vertical.png">
									<img class="-cover-img img-fluid lazyloaded" alt="pg-soft cover image png" width="249" height="361" data-src="https://asset.cloudigame.co/build/admin/img/ez-pg-soft/cover-pg-soft-vertical.png" src="https://asset.cloudigame.co/build/admin/img/ez-pg-soft/cover-pg-soft-vertical.png">
								</picture>
								<div class="-overlay">
									<div class="-overlay-inner">

									</div>
								</div>
							</div>
							<div class="-title">PG Soft</div>
						</div>
					</li>
					<li class="nav-item ">
						<div class="x-game-list-item-macro js-game-list-toggle -big -cannot-entry -untestable" data-status="-cannot-entry -untestable">
							<div class="-inner-wrapper">
								<picture>
									<source type="image/webp" data-srcset="https://asset.cloudigame.co/build/admin/img/ez-wt-jili/cover-wt-jili-vertical.webp" srcset="https://asset.cloudigame.co/build/admin/img/ez-wt-jili/cover-wt-jili-vertical.webp">
									<source type="image/png" data-srcset="https://asset.cloudigame.co/build/admin/img/ez-wt-jili/cover-wt-jili-vertical.png" srcset="https://asset.cloudigame.co/build/admin/img/ez-wt-jili/cover-wt-jili-vertical.png">
									<img class="-cover-img img-fluid lazyloaded" alt="wt-jili cover image png" width="249" height="361" data-src="https://asset.cloudigame.co/build/admin/img/ez-wt-jili/cover-wt-jili-vertical.png" src="https://asset.cloudigame.co/build/admin/img/ez-wt-jili/cover-wt-jili-vertical.png">
								</picture>
								<div class="-overlay">
									<div class="-overlay-inner">

									</div>
								</div>
							</div>
							<div class="-title">Jili</div>
						</div>
					</li>
					<li class="nav-item ">
						<div class="x-game-list-item-macro js-game-list-toggle -big " data-status="">
							<div class="-inner-wrapper">
								<picture>
									<source type="image/webp" data-srcset="https://asset.cloudigame.co/build/admin/img/ez-wt-mg-slot/cover-wt-mg-slot-vertical.webp" srcset="https://asset.cloudigame.co/build/admin/img/ez-wt-mg-slot/cover-wt-mg-slot-vertical.webp">
									<source type="image/png" data-srcset="https://asset.cloudigame.co/build/admin/img/ez-wt-mg-slot/cover-wt-mg-slot-vertical.png" srcset="https://asset.cloudigame.co/build/admin/img/ez-wt-mg-slot/cover-wt-mg-slot-vertical.png">
									<img class="-cover-img img-fluid lazyloaded" alt="wt-mg-slot cover image png" width="249" height="361" data-src="https://asset.cloudigame.co/build/admin/img/ez-wt-mg-slot/cover-wt-mg-slot-vertical.png" src="https://asset.cloudigame.co/build/admin/img/ez-wt-mg-slot/cover-wt-mg-slot-vertical.png">
								</picture>
								<div class="-overlay">
									<div class="-overlay-inner">
										<div class="-wrapper-container">
										</div>
									</div>
								</div>
							</div>
							<div class="-title">Micro Gaming</div>
						</div>
					</li>
					<li class="nav-item ">
						<div class="x-game-list-item-macro js-game-list-toggle -big " data-status="">
							<div class="-inner-wrapper">
								<picture>
									<source type="image/webp" data-srcset="https://asset.cloudigame.co/build/admin/img/ez-evo-play/cover-evo-play-vertical.webp" srcset="https://asset.cloudigame.co/build/admin/img/ez-evo-play/cover-evo-play-vertical.webp">
									<source type="image/png" data-srcset="https://asset.cloudigame.co/build/admin/img/ez-evo-play/cover-evo-play-vertical.png" srcset="https://asset.cloudigame.co/build/admin/img/ez-evo-play/cover-evo-play-vertical.png">
									<img class="-cover-img img-fluid lazyloaded" alt="evo-play cover image png" width="249" height="361" data-src="https://asset.cloudigame.co/build/admin/img/ez-evo-play/cover-evo-play-vertical.png" src="https://asset.cloudigame.co/build/admin/img/ez-evo-play/cover-evo-play-vertical.png">
								</picture>
								<div class="-overlay">
									<div class="-overlay-inner">
										<div class="-wrapper-container">
										</div>
									</div>
								</div>
							</div>
							<div class="-title">Evo Play</div>
						</div>
					</li>
					<li class="nav-item ">
						<div class="x-game-list-item-macro js-game-list-toggle -big " data-status="">
							<div class="-inner-wrapper">
								<picture>
									<source type="image/webp" data-srcset="https://asset.cloudigame.co/build/admin/img/ez-wt-kingmaker/cover-wt-kingmaker-vertical.webp" srcset="https://asset.cloudigame.co/build/admin/img/ez-wt-kingmaker/cover-wt-kingmaker-vertical.webp">
									<source type="image/png" data-srcset="https://asset.cloudigame.co/build/admin/img/ez-wt-kingmaker/cover-wt-kingmaker-vertical.png" srcset="https://asset.cloudigame.co/build/admin/img/ez-wt-kingmaker/cover-wt-kingmaker-vertical.png">
									<img class="-cover-img img-fluid lazyloaded" alt="wt-kingmaker cover image png" width="249" height="361" data-src="https://asset.cloudigame.co/build/admin/img/ez-wt-kingmaker/cover-wt-kingmaker-vertical.png" src="https://asset.cloudigame.co/build/admin/img/ez-wt-kingmaker/cover-wt-kingmaker-vertical.png">
								</picture>
								<div class="-overlay">
									<div class="-overlay-inner">

									</div>
								</div>
							</div>
							<div class="-title">Kingmaker</div>
						</div>
					</li>
					<li class="nav-item ">
						<div class="x-game-list-item-macro js-game-list-toggle -big -cannot-entry -untestable" data-status="-cannot-entry -untestable">
							<div class="-inner-wrapper">
								<picture>
									<source type="image/webp" data-srcset="https://asset.cloudigame.co/build/admin/img/ez-goldy/cover-goldy-vertical.webp" srcset="https://asset.cloudigame.co/build/admin/img/ez-goldy/cover-goldy-vertical.webp">
									<source type="image/png" data-srcset="https://asset.cloudigame.co/build/admin/img/ez-goldy/cover-goldy-vertical.png" srcset="https://asset.cloudigame.co/build/admin/img/ez-goldy/cover-goldy-vertical.png">
									<img class="-cover-img img-fluid lazyloaded" alt="goldy cover image png" width="249" height="361" data-src="https://asset.cloudigame.co/build/admin/img/ez-goldy/cover-goldy-vertical.png" src="https://asset.cloudigame.co/build/admin/img/ez-goldy/cover-goldy-vertical.png">
								</picture>
								<div class="-overlay">
									<div class="-overlay-inner">

									</div>
								</div>
							</div>
							<div class="-title">Goldy</div>
						</div>
					</li>
					<li class="nav-item ">
						<div class="x-game-list-item-macro js-game-list-toggle -big -cannot-entry -untestable" data-status="-cannot-entry -untestable">
							<div class="-inner-wrapper">
								<picture>
									<source type="image/webp" data-srcset="https://asset.cloudigame.co/build/admin/img/ez-wt-only-play/cover-wt-only-play-vertical.webp" srcset="https://asset.cloudigame.co/build/admin/img/ez-wt-only-play/cover-wt-only-play-vertical.webp">
									<source type="image/png" data-srcset="https://asset.cloudigame.co/build/admin/img/ez-wt-only-play/cover-wt-only-play-vertical.png" srcset="https://asset.cloudigame.co/build/admin/img/ez-wt-only-play/cover-wt-only-play-vertical.png">
									<img class="-cover-img img-fluid lazyloaded" alt="wt-only-play cover image png" width="249" height="361" data-src="https://asset.cloudigame.co/build/admin/img/ez-wt-only-play/cover-wt-only-play-vertical.png" src="https://asset.cloudigame.co/build/admin/img/ez-wt-only-play/cover-wt-only-play-vertical.png">
								</picture>
								<div class="-overlay">
									<div class="-overlay-inner">

									</div>
								</div>
							</div>
							<div class="-title">Onlyplay</div>
						</div>
					</li>
					<li class="nav-item ">
						<div class="x-game-list-item-macro js-game-list-toggle -big -cannot-entry -untestable" data-status="-cannot-entry -untestable">
							<div class="-inner-wrapper">
								<picture>
									<source type="image/webp" data-srcset="https://asset.cloudigame.co/build/admin/img/ez-wt-cq9/cover-wt-cq9-vertical.webp" srcset="https://asset.cloudigame.co/build/admin/img/ez-wt-cq9/cover-wt-cq9-vertical.webp">
									<source type="image/png" data-srcset="https://asset.cloudigame.co/build/admin/img/ez-wt-cq9/cover-wt-cq9-vertical.png" srcset="https://asset.cloudigame.co/build/admin/img/ez-wt-cq9/cover-wt-cq9-vertical.png">
									<img class="-cover-img img-fluid lazyloaded" alt="wt-cq9 cover image png" width="249" height="361" data-src="https://asset.cloudigame.co/build/admin/img/ez-wt-cq9/cover-wt-cq9-vertical.png" src="https://asset.cloudigame.co/build/admin/img/ez-wt-cq9/cover-wt-cq9-vertical.png">
								</picture>
								<div class="-overlay">
									<div class="-overlay-inner">

									</div>
								</div>
							</div>
							<div class="-title">CQ9</div>
						</div>
					</li>
					<li class="nav-item ">
						<div class="x-game-list-item-macro js-game-list-toggle -big -cannot-entry -untestable" data-status="-cannot-entry -untestable">
							<div class="-inner-wrapper">
								<picture>
									<source type="image/webp" data-srcset="https://asset.cloudigame.co/build/admin/img/ez-wt-joker/cover-wt-joker-vertical.webp" srcset="https://asset.cloudigame.co/build/admin/img/ez-wt-joker/cover-wt-joker-vertical.webp">
									<source type="image/png" data-srcset="https://asset.cloudigame.co/build/admin/img/ez-wt-joker/cover-wt-joker-vertical.png" srcset="https://asset.cloudigame.co/build/admin/img/ez-wt-joker/cover-wt-joker-vertical.png">
									<img class="-cover-img img-fluid ls-is-cached lazyloaded" alt="wt-joker cover image png" width="249" height="361" data-src="https://asset.cloudigame.co/build/admin/img/ez-wt-joker/cover-wt-joker-vertical.png" src="https://asset.cloudigame.co/build/admin/img/ez-wt-joker/cover-wt-joker-vertical.png">
								</picture>
								<div class="-overlay">
									<div class="-overlay-inner">

									</div>
								</div>
							</div>
							<div class="-title">Joker</div>
						</div>
					</li>
					<li class="nav-item ">
						<div class="x-game-list-item-macro js-game-list-toggle -big " data-status="">
							<div class="-inner-wrapper">
								<picture>
									<source type="image/webp" data-srcset="https://asset.cloudigame.co/build/admin/img/ez-wt-relax-gaming/cover-wt-relax-gaming-vertical.webp" srcset="https://asset.cloudigame.co/build/admin/img/ez-wt-relax-gaming/cover-wt-relax-gaming-vertical.webp">
									<source type="image/png" data-srcset="https://asset.cloudigame.co/build/admin/img/ez-wt-relax-gaming/cover-wt-relax-gaming-vertical.png" srcset="https://asset.cloudigame.co/build/admin/img/ez-wt-relax-gaming/cover-wt-relax-gaming-vertical.png">
									<img class="-cover-img img-fluid lazyloaded" alt="wt-relax-gaming cover image png" width="249" height="361" data-src="https://asset.cloudigame.co/build/admin/img/ez-wt-relax-gaming/cover-wt-relax-gaming-vertical.png" src="https://asset.cloudigame.co/build/admin/img/ez-wt-relax-gaming/cover-wt-relax-gaming-vertical.png">
								</picture>
								<div class="-overlay">
									<div class="-overlay-inner">

									</div>
								</div>
							</div>

						</div>
					</li>
				</ul>
			</div>
			<div class="-new-games-list-container animated fadeInUp" data-animatable="fadeInUp" data-delay="100">
				<h2 class="-game-title h5 d-lg-none">New<br class="d-none d-lg-block"> Games</h2>
				<ul class="navbar-nav">
					<li class="nav-item d-none d-lg-inline-block">
						<div class="x-game-list-heading-macro -new -normal">
							<div class="-inner-wrapper">
								<picture>
									<source type="image/webp" data-srcset="https://asset.cloudigame.co/build/admin/img/ez-wt-evo-play/1012-vertical.png?v=1" srcset="https://asset.cloudigame.co/build/admin/img/ez-wt-evo-play/1012-vertical.png?v=1">
									<source type="image/png" data-srcset="https://asset.cloudigame.co/build/admin/img/ez-wt-evo-play/1012-vertical.png?v=1" srcset="https://asset.cloudigame.co/build/admin/img/ez-wt-evo-play/1012-vertical.png?v=1">
									<img class="-cover-img lazyloaded" alt="wt-ps cover image png" data-src="https://asset.cloudigame.co/build/admin/img/ez-wt-evo-play/1012-vertical.png?v=1" src="https://asset.cloudigame.co/build/admin/img/ez-wt-evo-play/1012-vertical.png?v=1">
								</picture>
								<div class="-overlay">
									<span class="-length">แนะนำเกมใหม่</span>
									<h2 class="-title">New<br class="d-none d-lg-block"> Games</h2>
								</div>
							</div>
						</div>
						</lveri>
					<li class="nav-item -first">
						<div class="x-game-list-item-macro js-game-list-toggle -normal " data-status="">
							<div class="-inner-wrapper">
								<div class="x-game-badge-component -new -normal animated fadeInUp" data-animatable="fadeInUp" data-delay="400">
									<span>New</span>
								</div>
								<picture>
									<source type="image/webp" data-srcset="images/game/952-vertical.png" srcset="images/game/952-vertical.png">
									<source type="image/png" data-srcset="images/game/952-vertical.png" srcset="images/game/952-vertical.png">
									<img class="-cover-img img-fluid lazyloaded" alt="rich88 cover image png" width="216" height="216" data-src="images/game/952-vertical.png" src="images/game/952-vertical.png">
								</picture>
								<div class="-overlay">
									<div class="-overlay-inner">
										<div class="-wrapper-container">

											<a href="https://ezslot.bet/lobby/test?channelCode=wt-evo-play&amp;metadata%5Bgame_id%5D=952" class="-btn -btn-demo" target="_blank" rel="nofollow noopener">
												ทดลองเล่น
											</a>
										</div>
									</div>
								</div>
							</div>
						</div>
					</li>
					<li class="nav-item -first">
						<div class="x-game-list-item-macro js-game-list-toggle -normal " data-status="">
							<div class="-inner-wrapper">
								<div class="x-game-badge-component -new -normal animated fadeInUp" data-animatable="fadeInUp" data-delay="400">
									<span>New</span>
								</div>
								<picture>
									<source type="image/webp" data-srcset="images/game/985-vertical.png" srcset="images/game/985-vertical.png">
									<source type="image/png" data-srcset="images/game/985-vertical.png" srcset="images/game/985-vertical.png">
									<img class="-cover-img img-fluid lazyloaded" alt="rich88 cover image png" width="216" height="216" data-src="images/game/985-vertical.png" src="images/game/985-vertical.png">
								</picture>
								<div class="-overlay">
									<div class="-overlay-inner">
										<div class="-wrapper-container">

											<a href="https://ezslot.bet/lobby/test?channelCode=wt-evo-play&amp;metadata%5Bgame_id%5D=985" class="-btn -btn-demo" target="_blank" rel="nofollow noopener">
												ทดลองเล่น
											</a>
										</div>
									</div>
								</div>
							</div>
						</div>
					</li>
					<li class="nav-item -first">
						<div class="x-game-list-item-macro js-game-list-toggle -normal " data-status="">
							<div class="-inner-wrapper">
								<div class="x-game-badge-component -new -normal animated fadeInUp" data-animatable="fadeInUp" data-delay="400">
									<span>New</span>
								</div>
								<picture>
									<source type="image/webp" data-srcset="images/game/955-vertical.png" srcset="images/game/955-vertical.png">
									<source type="image/png" data-srcset="images/game/955-vertical.png" srcset="images/game/955-vertical.png">
									<img class="-cover-img img-fluid lazyloaded" alt="rich88 cover image png" width="216" height="216" data-src="images/game/955-vertical.png" src="images/game/955-vertical.png">
								</picture>
								<div class="-overlay">
									<div class="-overlay-inner">
										<div class="-wrapper-container">

											<a href="https://ezslot.bet/lobby/test?channelCode=wt-evo-play&amp;metadata%5Bgame_id%5D=955" class="-btn -btn-demo" target="_blank" rel="nofollow noopener">
												ทดลองเล่น
											</a>
										</div>
									</div>
								</div>
							</div>
						</div>
					</li>
					<li class="nav-item -first">
						<div class="x-game-list-item-macro js-game-list-toggle -normal " data-status="">
							<div class="-inner-wrapper">
								<div class="x-game-badge-component -new -normal animated fadeInUp" data-animatable="fadeInUp" data-delay="400">
									<span>New</span>
								</div>
								<picture>
									<source type="image/webp" data-srcset="images/game/958-vertical.png" srcset="images/game/958-vertical.png">
									<source type="image/png" data-srcset="images/game/958-vertical.png" srcset="images/game/958-vertical.png">
									<img class="-cover-img img-fluid lazyloaded" alt="rich88 cover image png" width="216" height="216" data-src="images/game/958-vertical.png" src="images/game/958-vertical.png">
								</picture>
								<div class="-overlay">
									<div class="-overlay-inner">
										<div class="-wrapper-container">

											<a href="https://ezslot.bet/lobby/test?channelCode=wt-evo-play&amp;metadata%5Bgame_id%5D=958" class="-btn -btn-demo" target="_blank" rel="nofollow noopener">
												ทดลองเล่น
											</a>
										</div>
									</div>
								</div>
							</div>
						</div>
					</li>
					<li class="nav-item -first">
						<div class="x-game-list-item-macro js-game-list-toggle -normal " data-status="">
							<div class="-inner-wrapper">
								<div class="x-game-badge-component -new -normal animated fadeInUp" data-animatable="fadeInUp" data-delay="400">
									<span>New</span>
								</div>
								<picture>
									<source type="image/webp" data-srcset="images/game/961-vertical.png" srcset="images/game/961-vertical.png">
									<source type="image/png" data-srcset="images/game/961-vertical.png" srcset="images/game/961-vertical.png">
									<img class="-cover-img img-fluid lazyloaded" alt="rich88 cover image png" width="216" height="216" data-src="images/game/961-vertical.png" src="images/game/961-vertical.png">
								</picture>
								<div class="-overlay">
									<div class="-overlay-inner">
										<div class="-wrapper-container">

											<a href="https://ezslot.bet/lobby/test?channelCode=wt-evo-play&amp;metadata%5Bgame_id%5D=961" class="-btn -btn-demo" target="_blank" rel="nofollow noopener">
												ทดลองเล่น
											</a>
										</div>
									</div>
								</div>
							</div>
						</div>
					</li>
					<li class="nav-item -first">
						<div class="x-game-list-item-macro js-game-list-toggle -normal " data-status="">
							<div class="-inner-wrapper">
								<div class="x-game-badge-component -new -normal animated fadeInUp" data-animatable="fadeInUp" data-delay="400">
									<span>New</span>
								</div>
								<picture>
									<source type="image/webp" data-srcset="images/game/5573-vertical.png" srcset="images/game/5573-vertical.png">
									<source type="image/png" data-srcset="images/game/5573-vertical.png" srcset="images/game/5573-vertical.png">
									<img class="-cover-img img-fluid lazyloaded" alt="rich88 cover image png" width="216" height="216" data-src="images/game/5573-vertical.png" src="images/game/5573-vertical.png">
								</picture>
								<div class="-overlay">
									<div class="-overlay-inner">
										<div class="-wrapper-container">
											<a href="https://ezslot.bet/lobby/test?channelCode=wt-evo-play&amp;metadata%5Bgame_id%5D=5573" class="-btn -btn-demo" target="_blank" rel="nofollow noopener">
												ทดลองเล่น
											</a>
										</div>
									</div>
								</div>
							</div>
						</div>
					</li>
					<li class="nav-item -first">
						<div class="x-game-list-item-macro js-game-list-toggle -normal " data-status="">
							<div class="-inner-wrapper">
								<div class="x-game-badge-component -new -normal animated fadeInUp" data-animatable="fadeInUp" data-delay="400">
									<span>New</span>
								</div>
								<picture>
									<source type="image/webp" data-srcset="images/game/5687-vertical.png" srcset="images/game/5687-vertical.png">
									<source type="image/png" data-srcset="images/game/5687-vertical.png" srcset="images/game/5687-vertical.png">
									<img class="-cover-img img-fluid lazyloaded" alt="rich88 cover image png" width="216" height="216" data-src="images/game/5687-vertical.png" src="images/game/5687-vertical.png">
								</picture>
								<div class="-overlay">
									<div class="-overlay-inner">
										<div class="-wrapper-container">
											<a href="https://ezcasino.bet/lobby/test?channelCode=wt-evo-play&amp;metadata%5Bgame_id%5D=5687" class="-btn -btn-demo" target="_blank" rel="nofollow noopener">
												ทดลองเล่น
											</a>
										</div>
									</div>
								</div>
							</div>
						</div>
					</li>
					<li class="nav-item -first">
						<div class="x-game-list-item-macro js-game-list-toggle -normal " data-status="">
							<div class="-inner-wrapper">
								<div class="x-game-badge-component -new -normal animated fadeInUp" data-animatable="fadeInUp" data-delay="400">
									<span>New</span>
								</div>
								<picture>
									<source type="image/webp" data-srcset="images/game/5643-vertical.png" srcset="images/game/5643-vertical.png">
									<source type="image/png" data-srcset="images/game/5643-vertical.png" srcset="images/game/5643-vertical.png">
									<img class="-cover-img img-fluid lazyloaded" alt="rich88 cover image png" width="216" height="216" data-src="images/game/5643-vertical.png" src="images/game/5643-vertical.png">
								</picture>
								<div class="-overlay">
									<div class="-overlay-inner">
										<div class="-wrapper-container">
											<a href="https://ezslot.bet/lobby/test?channelCode=wt-evo-play&amp;metadata%5Bgame_id%5D=5643" class="-btn -btn-demo" target="_blank" rel="nofollow noopener">
												ทดลองเล่น
											</a>
										</div>
									</div>
								</div>
							</div>
						</div>
					</li>
					<li class="nav-item -first">
						<div class="x-game-list-item-macro js-game-list-toggle -normal " data-status="">
							<div class="-inner-wrapper">
								<div class="x-game-badge-component -new -normal animated fadeInUp" data-animatable="fadeInUp" data-delay="400">
									<span>New</span>
								</div>
								<picture>
									<source type="image/webp" data-srcset="images/game/5585-vertical.png" srcset="images/game/5585-vertical.png">
									<source type="image/png" data-srcset="images/game/5585-vertical.png" srcset="images/game/5585-vertical.png">
									<img class="-cover-img img-fluid lazyloaded" alt="rich88 cover image png" width="216" height="216" data-src="images/game/5585-vertical.png" src="images/game/5585-vertical.png">
								</picture>
								<div class="-overlay">
									<div class="-overlay-inner">
										<div class="-wrapper-container">
											<a href="https://ezslot.bet/lobby/test?channelCode=wt-evo-play&amp;metadata%5Bgame_id%5D=5585" class="-btn -btn-demo" target="_blank" rel="nofollow noopener">
												ทดลองเล่น
											</a>
										</div>
									</div>
								</div>
							</div>
						</div>
					</li>
					<li class="nav-item -first">
						<div class="x-game-list-item-macro js-game-list-toggle -normal " data-status="">
							<div class="-inner-wrapper">
								<div class="x-game-badge-component -new -normal animated fadeInUp" data-animatable="fadeInUp" data-delay="400">
									<span>New</span>
								</div>
								<picture>
									<source type="image/webp" data-srcset="images/game/5489-vertical.png" srcset="images/game/5489-vertical.png">
									<source type="image/png" data-srcset="images/game/5489-vertical.png" srcset="images/game/5489-vertical.png">
									<img class="-cover-img img-fluid lazyloaded" alt="rich88 cover image png" width="216" height="216" data-src="images/game/5489-vertical.png" src="images/game/5489-vertical.png">
								</picture>
								<div class="-overlay">
									<div class="-overlay-inner">
										<div class="-wrapper-container">
											<a href="https://ezslot.bet/lobby/test?channelCode=wt-evo-play&amp;metadata%5Bgame_id%5D=5489" class="-btn -btn-demo" target="_blank" rel="nofollow noopener">
												ทดลองเล่น
											</a>
										</div>
									</div>
								</div>
							</div>
						</div>
					</li>
					<li class="nav-item -first">
						<div class="x-game-list-item-macro js-game-list-toggle -normal " data-status="">
							<div class="-inner-wrapper">
								<div class="x-game-badge-component -new -normal animated fadeInUp" data-animatable="fadeInUp" data-delay="400">
									<span>New</span>
								</div>
								<picture>
									<source type="image/webp" data-srcset="images/game/5523-vertical.png" srcset="images/game/5523-vertical.png">
									<source type="image/png" data-srcset="images/game/5523-vertical.png" srcset="images/game/5523-vertical.png">
									<img class="-cover-img img-fluid lazyloaded" alt="rich88 cover image png" width="216" height="216" data-src="images/game/5523-vertical.png" src="images/game/5523-vertical.png">
								</picture>
								<div class="-overlay">
									<div class="-overlay-inner">
										<div class="-wrapper-container">
											<a href="https://ezslot.bet/lobby/test?channelCode=wt-evo-play&amp;metadata%5Bgame_id%5D=5523" class="-btn -btn-demo" target="_blank" rel="nofollow noopener">
												ทดลองเล่น
											</a>
										</div>
									</div>
								</div>
							</div>
						</div>
					</li>
					<li class="nav-item -first">
						<div class="x-game-list-item-macro js-game-list-toggle -normal " data-status="">
							<div class="-inner-wrapper">
								<div class="x-game-badge-component -new -normal animated fadeInUp" data-animatable="fadeInUp" data-delay="400">
									<span>New</span>
								</div>
								<picture>
									<source type="image/webp" data-srcset="images/game/5491-vertical.png" srcset="images/game/5491-vertical.png">
									<source type="image/png" data-srcset="images/game/5491-vertical.png" srcset="images/game/5491-vertical.png">
									<img class="-cover-img img-fluid lazyloaded" alt="rich88 cover image png" width="216" height="216" data-src="images/game/5491-vertical.png" src="images/game/5491-vertical.png">
								</picture>
								<div class="-overlay">
									<div class="-overlay-inner">
										<div class="-wrapper-container">
											<a href="https://ezslot.bet/lobby/test?channelCode=wt-evo-play&amp;metadata%5Bgame_id%5D=5491" class="-btn -btn-demo" target="_blank" rel="nofollow noopener">
												ทดลองเล่น
											</a>
										</div>
									</div>
								</div>
							</div>
						</div>
					</li>
					<li class="nav-item -first">
						<div class="x-game-list-item-macro js-game-list-toggle -normal " data-status="">
							<div class="-inner-wrapper">
								<div class="x-game-badge-component -new -normal animated fadeInUp" data-animatable="fadeInUp" data-delay="400">
									<span>New</span>
								</div>
								<picture>
									<source type="image/webp" data-srcset="images/game/5344-vertical.png" srcset="images/game/5344-vertical.png">
									<source type="image/png" data-srcset="images/game/5344-vertical.png" srcset="images/game/5344-vertical.png">
									<img class="-cover-img img-fluid lazyloaded" alt="rich88 cover image png" width="216" height="216" data-src="images/game/5344-vertical.png" src="images/game/5344-vertical.png">
								</picture>
								<div class="-overlay">
									<div class="-overlay-inner">
										<div class="-wrapper-container">
											<a href="https://ezslot.bet/lobby/test?channelCode=wt-evo-play&amp;metadata%5Bgame_id%5D=5344" class="-btn -btn-demo" target="_blank" rel="nofollow noopener">
												ทดลองเล่น
											</a>
										</div>
									</div>
								</div>
							</div>

						</div>
					</li>
					<li class="nav-item -first">
						<div class="x-game-list-item-macro js-game-list-toggle -normal " data-status="">
							<div class="-inner-wrapper">
								<div class="x-game-badge-component -new -normal animated fadeInUp" data-animatable="fadeInUp" data-delay="400">
									<span>New</span>
								</div>
								<picture>
									<source type="image/webp" data-srcset="images/game/949-vertical.png" srcset="images/game/949-vertical.png">
									<source type="image/png" data-srcset="images/game/949-vertical.png" srcset="images/game/949-vertical.png">
									<img class="-cover-img img-fluid lazyloaded" alt="rich88 cover image png" width="216" height="216" data-src="images/game/949-vertical.png" src="images/game/949-vertical.png">
								</picture>
								<div class="-overlay">
									<div class="-overlay-inner">
										<div class="-wrapper-container">
											<a href="https://ezslot.bet/lobby/test?channelCode=wt-evo-play&amp;metadata%5Bgame_id%5D=949" class="-btn -btn-demo" target="_blank" rel="nofollow noopener">
												ทดลองเล่น
											</a>
										</div>
									</div>
								</div>
							</div>
						</div>
					</li>
					<li class="nav-item -first">
						<div class="x-game-list-item-macro js-game-list-toggle -normal " data-status="">
							<div class="-inner-wrapper">
								<div class="x-game-badge-component -new -normal animated fadeInUp" data-animatable="fadeInUp" data-delay="400">
									<span>New</span>
								</div>
								<picture>
									<source type="image/webp" data-srcset="images/game/964-vertical.png" srcset="images/game/964-vertical.png">
									<source type="image/png" data-srcset="images/game/964-vertical.png" srcset="images/game/964-vertical.png">
									<img class="-cover-img img-fluid lazyloaded" alt="rich88 cover image png" width="216" height="216" data-src="images/game/964-vertical.png" src="images/game/964-vertical.png">
								</picture>
								<div class="-overlay">
									<div class="-overlay-inner">
										<div class="-wrapper-container">
											<a href="https://ezslot.bet/lobby/test?channelCode=wt-evo-play&amp;metadata%5Bgame_id%5D=964" class="-btn -btn-demo" target="_blank" rel="nofollow noopener">
												ทดลองเล่น
											</a>
										</div>
									</div>
								</div>
							</div>
						</div>
					</li>

				</ul>
			</div>
			<div class="-games-splitter-zone-container -anon animated fadeInUp" data-animatable="fadeInUp" data-delay="250">
				<div class="-left-side">
					<div class="-live-casino-container animated fadeInUp" data-animatable="fadeInUp" data-delay="100">
						<h2 class="-game-title h5 d-lg-none">Live<br class="d-none d-lg-block"> Casino</h2>
						<ul class="navbar-nav">
							<li class="nav-item d-none d-lg-inline-block">
								<div class="x-game-list-heading-macro -live-casino -normal">
									<div class="-inner-wrapper">
										<picture>
											<source type="image/webp" data-srcset="https://asset.cloudigame.co/build/admin/img/wt-eg/ezs-wt-eg-square.webp" srcset="https://asset.cloudigame.co/build/admin/img/wt-eg/ezs-wt-eg-square.webp">
											<source type="image/png" data-srcset="https://asset.cloudigame.co/build/admin/img/wt-eg/ezs-wt-eg-square.png" srcset="https://asset.cloudigame.co/build/admin/img/wt-eg/ezs-wt-eg-square.png">
											<img class="-cover-img lazyloaded" alt="wt-eg cover image png" data-src="https://asset.cloudigame.co/build/admin/img/wt-eg/ezs-wt-eg-square.png" src="https://asset.cloudigame.co/build/admin/img/wt-eg/ezs-wt-eg-square.png">
										</picture>
										<div class="-overlay">
											<span class="-length">16 Games</span>
											<h2 class="-title">Live<br class="d-none d-lg-block"> Casino</h2>
											<a href="#" class="-seemore-btn">All games</a>
										</div>
									</div>
								</div>
							</li>
							<li class="nav-item -first">
								<div class="x-game-list-item-macro js-game-list-toggle -normal " data-status="">
									<div class="-inner-wrapper">
										<img data-src="https://asset.cloudigame.co/build/admin/img/sa-gaming/ezs-sa-gaming-square-animation.gif" src="https://asset.cloudigame.co/build/admin/img/sa-gaming/ezs-sa-gaming-square-animation.gif" class="-cover-img img-fluid lazyloaded" alt="sa-gaming cover image png" width="216" height="216">
										<div class="-overlay">
											<div class="-overlay-inner">
												<div class="-wrapper-container">
													<a href="https://ezslot.bet/lobby/test?channelCode=sa-gaming" class="-btn -btn-demo" target="_blank" rel="nofollow noopener">
														ทดลองเล่น
													</a>
												</div>
											</div>
										</div>
									</div>
									<div class="-title">Sa Gaming</div>
								</div>
							</li>
							<li class="nav-item ">
								<div class="x-game-list-item-macro js-game-list-toggle -normal " data-status="">
									<div class="-inner-wrapper">
										<picture>
											<source type="image/webp" data-srcset="https://asset.cloudigame.co/build/admin/img/wm/ezs-wm-square.webp" srcset="https://asset.cloudigame.co/build/admin/img/wm/ezs-wm-square.webp">
											<source type="image/png" data-srcset="https://asset.cloudigame.co/build/admin/img/wm/ezs-wm-square.png" srcset="https://asset.cloudigame.co/build/admin/img/wm/ezs-wm-square.png">
											<img class="-cover-img img-fluid ls-is-cached lazyloaded" alt="wm cover image png" width="216" height="216" data-src="https://asset.cloudigame.co/build/admin/img/wm/ezs-wm-square.png" src="https://asset.cloudigame.co/build/admin/img/wm/ezs-wm-square.png">
										</picture>
										<div class="-overlay">
											<div class="-overlay-inner">
												<div class="-wrapper-container">

													<a href="https://ezslot.bet/lobby/test?channelCode=wm" class="-btn -btn-demo" target="_blank" rel="nofollow noopener">
														ทดลองเล่น
													</a>
												</div>
											</div>
										</div>
									</div>
									<div class="-title">WM Casino</div>
								</div>
							</li>
							<li class="nav-item ">
								<div class="x-game-list-item-macro js-game-list-toggle -normal -cannot-entry -untestable" data-status="-cannot-entry -untestable">
									<div class="-inner-wrapper">
										<div class="x-game-badge-image -normal ">
											<img src="images/ez-slot-ic-master-key.png" class="-img" alt="badge game">
										</div>
										<picture>
											<source type="image/webp" data-srcset="https://asset.cloudigame.co/build/admin/img/wt-asia-gaming/ezs-wt-asia-gaming-square.webp" srcset="https://asset.cloudigame.co/build/admin/img/wt-asia-gaming/ezs-wt-asia-gaming-square.webp">
											<source type="image/png" data-srcset="https://asset.cloudigame.co/build/admin/img/wt-asia-gaming/ezs-wt-asia-gaming-square.png" srcset="https://asset.cloudigame.co/build/admin/img/wt-asia-gaming/ezs-wt-asia-gaming-square.png">
											<img class="-cover-img img-fluid ls-is-cached lazyloaded" alt="wt-asia-gaming cover image png" width="216" height="216" data-src="https://asset.cloudigame.co/build/admin/img/wt-asia-gaming/ezs-wt-asia-gaming-square.png" src="https://asset.cloudigame.co/build/admin/img/wt-asia-gaming/ezs-wt-asia-gaming-square.png">
										</picture>
										<div class="-overlay">
											<div class="-overlay-inner">
												<div class="-wrapper-container">

												</div>
											</div>
										</div>
									</div>
									<div class="-title">Asia Gaming</div>
								</div>
							</li>
							<li class="nav-item ">
								<div class="x-game-list-item-macro js-game-list-toggle -normal " data-status="">
									<div class="-inner-wrapper">
										<picture>
											<source type="image/webp" data-srcset="https://asset.cloudigame.co/build/admin/img/wt-pretty-gaming/ezs-wt-pretty-gaming-square.webp" srcset="https://asset.cloudigame.co/build/admin/img/wt-pretty-gaming/ezs-wt-pretty-gaming-square.webp">
											<source type="image/png" data-srcset="https://asset.cloudigame.co/build/admin/img/wt-pretty-gaming/ezs-wt-pretty-gaming-square.png" srcset="https://asset.cloudigame.co/build/admin/img/wt-pretty-gaming/ezs-wt-pretty-gaming-square.png">
											<img class="-cover-img img-fluid lazyloaded" alt="wt-pretty-gaming cover image png" width="216" height="216" data-src="https://asset.cloudigame.co/build/admin/img/wt-pretty-gaming/ezs-wt-pretty-gaming-square.png" src="https://asset.cloudigame.co/build/admin/img/wt-pretty-gaming/ezs-wt-pretty-gaming-square.png">
										</picture>
										<div class="-overlay">
											<div class="-overlay-inner">
												<div class="-wrapper-container">

													<a href="https://ezslot.bet/lobby/test?channelCode=wt-pretty-gaming" class="-btn -btn-demo" target="_blank" rel="nofollow noopener">
														ทดลองเล่น
													</a>
												</div>
											</div>
										</div>
									</div>
									<div class="-title">ez.casino.wt-pretty-gaming_title</div>
								</div>
							</li>
							<li class="nav-item ">
								<div class="x-game-list-item-macro js-game-list-toggle -normal " data-status="">
									<div class="-inner-wrapper">
										<img data-src="https://asset.cloudigame.co/build/admin/img/wt-aesexy/ezs-wt-aesexy-square-animation.gif" src="https://asset.cloudigame.co/build/admin/img/wt-aesexy/ezs-wt-aesexy-square-animation.gif" class="-cover-img img-fluid lazyloaded" alt="wt-aesexy cover image png" width="216" height="216">
										<div class="-overlay">
											<div class="-overlay-inner">
												<div class="-wrapper-container">

													<a href="https://ezslot.bet/lobby/test?channelCode=wt-aesexy" class="-btn -btn-demo" target="_blank" rel="nofollow noopener">
														ทดลองเล่น
													</a>
												</div>
											</div>
										</div>
									</div>
									<div class="-title">ez.casino.wt-aesexy_title</div>
								</div>
							</li>
						</ul>
					</div>
					<div class="-sports-container animated fadeInUp" data-animatable="fadeInUp" data-delay="100">
						<h2 class="-game-title h5 d-lg-none">Sport<br class="d-none d-lg-block"> Games</h2>
						<ul class="navbar-nav">
							<li class="nav-item d-none d-lg-inline-block">
								<div class="x-game-list-heading-macro -sport -normal">
									<div class="-inner-wrapper">
										<picture>
											<source type="image/webp" data-srcset="https://asset.cloudigame.co/build/admin/img/imsb/ezs-imsb-square.webp" srcset="https://asset.cloudigame.co/build/admin/img/imsb/ezs-imsb-square.webp">
											<source type="image/png" data-srcset="https://asset.cloudigame.co/build/admin/img/imsb/ezs-imsb-square.png" srcset="https://asset.cloudigame.co/build/admin/img/imsb/ezs-imsb-square.png">
											<img class="-cover-img lazyloaded" alt="imsb cover image png" data-src="https://asset.cloudigame.co/build/admin/img/imsb/ezs-imsb-square.png" src="https://asset.cloudigame.co/build/admin/img/imsb/ezs-imsb-square.png">
										</picture>
										<div class="-overlay">
											<span class="-length">4 Games</span>
											<h2 class="-title">Sport<br class="d-none d-lg-block"> Games</h2>
										</div>
									</div>
								</div>
							</li>
							<li class="nav-item -first">
								<div class="x-game-list-item-macro js-game-list-toggle -normal -cannot-entry -untestable" data-status="-cannot-entry -untestable">
									<div class="-inner-wrapper">
										<div class="x-game-badge-image -normal ">
											<img src="images/ez-slot-ic-master-key.png" class="-img" alt="badge game">
										</div>
										<picture>
											<source type="image/webp" data-srcset="https://asset.cloudigame.co/build/admin/img/pinnacle/ezs-pinnacle-square.webp" srcset="https://asset.cloudigame.co/build/admin/img/pinnacle/ezs-pinnacle-square.webp">
											<source type="image/png" data-srcset="https://asset.cloudigame.co/build/admin/img/pinnacle/ezs-pinnacle-square.png" srcset="https://asset.cloudigame.co/build/admin/img/pinnacle/ezs-pinnacle-square.png">
											<img class="-cover-img img-fluid lazyloaded" alt="pinnacle cover image png" width="216" height="216" data-src="https://asset.cloudigame.co/build/admin/img/pinnacle/ezs-pinnacle-square.png" src="https://asset.cloudigame.co/build/admin/img/pinnacle/ezs-pinnacle-square.png">
										</picture>
										<div class="-overlay">
											<div class="-overlay-inner">
												<div class="-wrapper-container">

												</div>
											</div>
										</div>
									</div>
									<div class="-title">Pinnacle</div>
								</div>
							</li>
							<li class="nav-item ">
								<div class="x-game-list-item-macro js-game-list-toggle -normal -cannot-entry -untestable" data-status="-cannot-entry -untestable">
									<div class="-inner-wrapper">
										<div class="x-game-badge-image -normal ">
											<img src="images/ez-slot-ic-master-key.png" class="-img" alt="badge game">
										</div>
										<picture>
											<source type="image/webp" data-srcset="https://asset.cloudigame.co/build/admin/img/imsb/ezs-imsb-square.webp" srcset="https://asset.cloudigame.co/build/admin/img/imsb/ezs-imsb-square.webp">
											<source type="image/png" data-srcset="https://asset.cloudigame.co/build/admin/img/imsb/ezs-imsb-square.png" srcset="https://asset.cloudigame.co/build/admin/img/imsb/ezs-imsb-square.png">
											<img class="-cover-img img-fluid lazyloaded" alt="imsb cover image png" width="216" height="216" data-src="https://asset.cloudigame.co/build/admin/img/imsb/ezs-imsb-square.png" src="https://asset.cloudigame.co/build/admin/img/imsb/ezs-imsb-square.png">
										</picture>
										<div class="-overlay">
											<div class="-overlay-inner">
												<div class="-wrapper-container">

												</div>
											</div>
										</div>
									</div>
									<div class="-title">IM Sportbook</div>
								</div>
							</li>
							<li class="nav-item ">
								<div class="x-game-list-item-macro js-game-list-toggle -normal -cannot-entry -untestable" data-status="-cannot-entry -untestable">
									<div class="-inner-wrapper">
										<div class="x-game-badge-image -normal ">
											<img src="images/ez-slot-ic-master-key.png" class="-img" alt="badge game">
										</div>
										<picture>
											<source type="image/webp" data-srcset="https://asset.cloudigame.co/build/admin/img/imesb/ezs-imesb-square.webp" srcset="https://asset.cloudigame.co/build/admin/img/imesb/ezs-imesb-square.webp">
											<source type="image/png" data-srcset="https://asset.cloudigame.co/build/admin/img/imesb/ezs-imesb-square.png" srcset="https://asset.cloudigame.co/build/admin/img/imesb/ezs-imesb-square.png">
											<img class="-cover-img img-fluid lazyloaded" alt="imesb cover image png" width="216" height="216" data-src="https://asset.cloudigame.co/build/admin/img/imesb/ezs-imesb-square.png" src="https://asset.cloudigame.co/build/admin/img/imesb/ezs-imesb-square.png">
										</picture>
										<div class="-overlay">
											<div class="-overlay-inner">
												<div class="-wrapper-container">

												</div>
											</div>
										</div>
									</div>
									<div class="-title">IM E-Sport</div>
								</div>
							</li>
							<li class="nav-item ">
								<div class="x-game-list-item-macro js-game-list-toggle -normal -cannot-entry -untestable" data-status="-cannot-entry -untestable">
									<div class="-inner-wrapper">
										<div class="x-game-badge-image -normal ">
											<img src="images/ez-slot-ic-master-key.png" class="-img" alt="badge game">
										</div>
										<picture>
											<source type="image/webp" data-srcset="https://asset.cloudigame.co/build/admin/img/wt-saba/ezs-wt-saba-square.webp" srcset="https://asset.cloudigame.co/build/admin/img/wt-saba/ezs-wt-saba-square.webp">
											<source type="image/png" data-srcset="https://asset.cloudigame.co/build/admin/img/wt-saba/ezs-wt-saba-square.png" srcset="https://asset.cloudigame.co/build/admin/img/wt-saba/ezs-wt-saba-square.png">
											<img class="-cover-img img-fluid lazyloaded" alt="wt-saba cover image png" width="216" height="216" data-src="https://asset.cloudigame.co/build/admin/img/wt-saba/ezs-wt-saba-square.png" src="https://asset.cloudigame.co/build/admin/img/wt-saba/ezs-wt-saba-square.png">
										</picture>
										<div class="-overlay">
											<div class="-overlay-inner">
												<div class="-wrapper-container">

												</div>
											</div>
										</div>
									</div>
									<div class="-title">Saba Sportbook</div>
								</div>
							</li>

						</ul>
					</div>
				</div>
				<div class="-right-side">
					<a href="/member/casinos" class="-button-wrapper animated fadeInUp" data-animatable="fadeInUp" data-delay="100">
						<h2 class="text-center">คาสิโนสดชั้นนำ</h2>
						<img data-src="images/ez-slot-girl-china.png" class="-china-girl lazyloaded" alt="Ezbet china girl image png" src="images/ez-slot-girl-china.png">
						<img data-src="images/ez-slot-dice-dual.png" class="-dice-dual lazyloaded" alt="Ezbet two dices image png" src="images/ez-slot-dice-dual.png">
					</a>
				</div>
			</div>
		</div>

		<?php if (!$user) { ?>
			<div id="account-actions" class="">
				<div class="x-button-actions" id="account-actions-mobile">
					<div class="d-flex -anon-menu-wrapper">
						<div class="-btn-container -left">
							<a href="https://line.me/R/ti/p/<?= $line ?>" class="btn btn-lg btn-plain-primary">
								<img src="images/ez-slot-menu-bottom-ic-promotion.png" alt=" โปรโมชั่นสล็อต โปรโมชั่นคาสิโน อันดับ 1" class="-icon img-fluid" width="90" height="90">
								<div class="-typo">ติดตามแอดมิน</div>
							</a>
						</div>
						<div class="-btn-container -center">

							<a href="#" data-toggle="modal" data-target="#RegisterModal" class="btn btn-lg btn-plain-lobby">
								<div class="-img-container">
									<img src="images/sud.png" alt="สมัครสมาชิกเว็บสล็อตออนไลน์ สมัครสมาชิกเว็บคาสิโนออนไลน์" class="-icon" width="109" height="150">
								</div>
								<div class="-typo">สมัครสมาชิก</div>
							</a>
						</div>
						<div class="-btn-container -right">
							<a class="btn btn-lg btn-plain-secondary" href="#loginModal" data-toggle="modal" data-target="#loginModal">
								<img src="images/ez-slot-menu-bottom-ic-event.png" alt="สล็อตออนไลน์ สิทธิพิเศษสล็อตออนไลน์ ดูหนังออนไลน์ฟรี ไม่มีโฆษณาคั่น" class="-icon img-fluid" width="90" height="90">
								<div class="-typo">เข้าสู่ระบบ</div>
							</a>
						</div>
					</div>
				</div>
			</div>
		<?php  } else { ?>
			<div id="account-actions" class="">
				<div class="x-button-actions" id="account-actions-mobile">
					<div class="d-flex -anon-menu-wrapper">
						<div class="-btn-container -left">
							<a href="#" class="btn btn-lg btn-plain-primary" id="wheelspinufa_mobile">
								<img src="images/icon_wheelspin.png" alt=" โปรโมชั่นสล็อต โปรโมชั่นคาสิโน อันดับ 1" class="-icon img-fluid" width="90" height="90">
								<div class="-typo">วงล้อ</div>
							</a>
						</div>
						<div class="-btn-container -center">

							<a href="#RegisterModal" data-toggle="modal" data-target="#modal-deposit" class="btn btn-lg btn-plain-lobby">
								<div class="-img-container">
									<img src="images/sud.png" alt="สมัครสมาชิกเว็บสล็อตออนไลน์ สมัครสมาชิกเว็บคาสิโนออนไลน์" class="-icon" width="109" height="150">
								</div>
								<div class="-typo">ฝากเงิน</div>
							</a>
						</div>
						<div class="-btn-container -right">
							<a class="btn btn-lg btn-plain-secondary" href="#loginModal" data-toggle="modal" data-target="#modal-withdraw" id="withdraw_mobile">
								<img src="images/ez-slot-menu-bottom-ic-event.png" alt="สล็อตออนไลน์ สิทธิพิเศษสล็อตออนไลน์ ดูหนังออนไลน์ฟรี ไม่มีโฆษณาคั่น" class="-icon img-fluid" width="90" height="90">
								<div class="-typo">ถอนเงิน</div>
							</a>
						</div>
					</div>
				</div>
			</div>
		<?php }  ?>
		<div class="x-modal modal" id="loginModal" tabindex="-1" data-loading-container=".js-modal-content" data-ajax-modal-always-reload="true" style="display: none;" aria-hidden="true">
			<div class="modal-dialog modal-dialog-centered -modal-size " role="document" style="padding-top: 60px;">
				<div class="modal-content -modal-content">
					<img src="" class="img-fluid d-lg-block d-none -border-top-modal" alt="">
					<button type="button" class="close f-1" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">×</span>
					</button>
					<div class="modal-header border-bottom-0 mt-3 pb-0 d-flex flex-column-reverse">
						<h3 class="m-auto  d-inline-block" style="color:#000">
							เข้าสู่ระบบ
							<hr class="x-hr-border-glow">
						</h3>
					</div>
					<div class="modal-body" style="top: 0px;">
						<div class="x-login-form">
							<div data-animatable="fadeInModal" data-offset="0" class="-animatable-container animated fadeInModal">
								<img src="images/registermascotgiant333.png" alt="">
								<form id="login-form" class="js-login-form x-header-login-form">

									<input name="modal_login" type="hidden" value="1">
									<div class="-x-input-icon mb-3 flex-column">
										<img src="images/ez-slot-ic_phone.png" class="-icon" alt="login" width="12">
										<input type="text" id="phone" name="phone" pattern="[0-9]*" autofocus="" class="form-control x-form-control" placeholder="เบอร์โทรศัพท์">
									</div>
									<div class="-x-input-icon flex-column">
										<img src="images/ez-slot-ic-lock-input.png" class="-icon" alt="password" width="13">
										<input id="password_m" type="password" class="form-control x-form-control" name="password_m" pattern="[a-zA-Z0-9.+#_,$-]+" placeholder="รหัสผ่าน">
									</div>
									<div class="x-reset-pw-text-container">
										<a href="https://line.me/R/ti/p/<?= $line ?>">
											<u>ลืมรหัสผ่าน</u>
										</a>
									</div>
									<div class=" text-center">
										<button type="submit" id='login_m' class="btn btn-primary -submit mt-2 f-5 f-lg-6">
											<span>เข้าสู่ระบบ</span>
										</button>
									</div>
								</form>
								<div class="text-center mt-2">
									<span class="x-text-with-link-component ">
										<label class="-text-message ">ลืมรหัสผ่าน</label>
										<a href="https://line.me/R/ti/p/<?= $line ?>" class="-link-message" onclick="reset_input_phone()">
											<span>--&gt; คลิก &lt;-- </span> </a> </span>
								</div>
								<div class="x-admin-contact ">
									<span class="x-text-with-link-component">
										<label class="-text-message ">พบปัญหา</label>
										<a href="https://line.me/R/ti/p/<?= $line ?>" target="_blank">
											<span id="contact-line">ติดต่อฝ่ายบริการลูกค้า</span>
										</a>
									</span>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>





		<!--###################################### Regiter ######################################-->

		<div class="x-modal modal" id="RegisterModal" tabindex="-1" data-loading-container=".js-modal-content" data-ajax-modal-always-reload="true" style="display: none;" aria-hidden="true">
			<div class="modal-dialog modal-dialog-centered -modal-size " role="document" style="padding-top: 60px;">
				<div class="modal-content -modal-content">
					<img src="" class="img-fluid d-lg-block d-none -border-top-modal" alt="">
					<button type="button" class="close f-1" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">×</span>
					</button>
					<div class="modal-header border-bottom-0 mt-3 pb-0 d-flex flex-column-reverse">
						<h3 class="m-auto  d-inline-block" style="color:#000">
							เบอร์โทรศัพท์
							<hr class="x-hr-border-glow">
						</h3>
					</div>
					<div class="modal-body" style="top: 0px;">
						<div class="x-login-form">
							<div data-animatable="fadeInModal" data-offset="0" class="-animatable-container animated fadeInModal">
								<img src="images/registermascotgiant333.png" alt="">
								<div class="-x-input-icon mb-3 flex-column">
									<img src="images/ez-slot-ic_phone.png" class="-icon" alt="login" width="12">
									<input type="text" id="phone_otp" name="phone_otp" inputmode="text" pattern="[0-9]*" autofocus="" class="form-control x-form-control" placeholder="เบอร์โทรศัพท์">
								</div>
								<div class=" text-center">
									<button type="submit" class="btn btn-primary -submit f-5 f-lg-6" onclick="check_phone()">
										<span> ถัดไป </span>
									</button>
								</div>
							</div>
						</div>
					</div>
					<img src="" class="img-fluid d-lg-block d-none -border-bottom-modal" alt="">
				</div>
			</div>
		</div>
		<!--###################################### Regiter ######################################-->

		<!--###################################### Bank ######################################-->

		<div class="x-modal modal" id="get_bank" tabindex="-1" data-loading-container=".js-modal-content" data-ajax-modal-always-reload="true" style="display: none;" aria-hidden="true">
			<div class="modal-dialog modal-dialog-centered -modal-size " role="document" style="padding-top: 60px;">
				<div class="modal-content -modal-content">
					<img src="" class="img-fluid d-lg-block d-none -border-top-modal" alt="">
					<button type="button" class="close f-1" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">×</span>
					</button>
					<div class="modal-header border-bottom-0 mt-3 pb-0 d-flex flex-column-reverse">
						<h3 class="m-auto  d-inline-block" style="color:#000">
							กรอก เลขบัญชีธนาคาร
							<hr class="x-hr-border-glow">
						</h3>
					</div>
					<div class="modal-body" style="top: 0px;">
						<div class="x-login-form">
							<div data-animatable="fadeInModal" data-offset="0" class="-animatable-container animated fadeInModal">
								<img src="images/registermascotgiant333.png" alt="">
								<div class="-x-input-icon mb-3 flex-column">
									<img src="images/ez-slot-ic_phone.png" class="-icon" alt="login" width="12">
									<input type="text" id="bank_number" name="bank_number" inputmode="text" pattern="[0-9]*" autofocus="" class="form-control x-form-control" placeholder="เลขบัญชีธนาคาร">
								</div>
								<select id="select" class="form-control x-form-control">

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
								<br>
								<div class=" text-center">
									<button type="submit" class="btn btn-primary -submit f-5 f-lg-6" onclick="get_name()">
										<span> ถัดไป </span>
									</button>
								</div>
							</div>
						</div>
					</div>
					<img src="" class="img-fluid d-lg-block d-none -border-bottom-modal" alt="">
				</div>
			</div>
		</div>
		<!--###################################### Bank ######################################-->



		<!--###################################### Regiter Modal ######################################-->

		<div class="x-modal modal" id="register_Modal" tabindex="-1" data-loading-container=".js-modal-content" data-ajax-modal-always-reload="true" style="display: none;" aria-hidden="true">
			<div class="modal-dialog modal-dialog-centered -modal-size " role="document" style="padding-top: 60px;">
				<div class="modal-content -modal-content">
					<img src="" class="img-fluid d-lg-block d-none -border-top-modal" alt="">
					<button type="button" class="close f-1" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">×</span>
					</button>
					<div class="modal-header border-bottom-0 mt-3 pb-0 d-flex flex-column-reverse">
						<h3 class="m-auto  d-inline-block" style="color:#000">
							สมัครสมาชิก
							<hr class="x-hr-border-glow">
						</h3>
					</div>
					<div class="modal-body" style="top: 0px;">
						<div class="x-login-form">
							<div data-animatable="fadeInModal" data-offset="0" class="-animatable-container animated fadeInModal">
								<img src="images/registermascotgiant333.png" alt="">
								<div class="-x-input-icon mb-3 flex-column">
									<img src="images/user.png" class="-icon" alt="login" width="20">
									<input type="text" id="fname" name="fname" class="form-control x-form-control" placeholder="ชื่อ">
								</div>
								<div class="-x-input-icon mb-3 flex-column">
									<img src="images/password.png" class="-icon" alt="login" width="20">
									<input type="password" id="r_password" name="r_password" placeholder="รหัสผ่าน" class="form-control x-form-control">
								</div>

								<div class="-x-input-icon mb-3 flex-column">
									<img src="images/password.png" class="-icon" alt="login" width="20">
									<input type="password" id="r_password2" name="r_password2" placeholder="ยืนยันรหัสผ่าน" class="form-control x-form-control">
								</div>

								<div class="-x-input-icon mb-3 flex-column">
									<img src="images/password.png" class="-icon" alt="login" width="20">
									<input type="text" id="line" name="line" placeholder="ไอดีไลน์" class="form-control x-form-control">
								</div>
								<div class="-x-input-icon mb-3 flex-column" style="display: none;">
									<img src="images/gift.png" class="-icon" alt="login" width="20">
									<select id="select_promotion" class="form-control">
										<option selected value="0">ไม่รับโปรโมชั่น</option>
										<?php $promotion = $this->admin_model->get_promotions();
										foreach ($promotion as $v) { ?>
											<option value="<?= $v['id'] ?>"> เติมเงินรับ <?= $v['percen'] ?>% ทำเทิร์น <?= $v['x'] ?> เท่า </option> <?php } ?>
									</select>
								</div>
								<div class=" text-center">
									<button type="submit" class="btn btn-primary -submit f-5 f-lg-6" onclick="register()">
										<span> ถัดไป </span>
									</button>
								</div>
							</div>
						</div>
					</div>
					<img src="" class="img-fluid d-lg-block d-none -border-bottom-modal" alt="">
				</div>
			</div>
		</div>
		<!--###################################### Regiter Modal ######################################-->



		<!-- โปรสมัครใหม่ -->
		<!--###################################### โปรสมัครใหม่ ######################################-->

		<div class="x-modal modal" id="promotion_register" tabindex="-1" data-loading-container=".js-modal-content" data-ajax-modal-always-reload="true" style="display: none;" aria-hidden="true">
			<div class="modal-dialog modal-dialog-centered -modal-size " role="document" style="padding-top: 60px;">
				<div class="modal-content -modal-content">
					<img src="" class="img-fluid d-lg-block d-none -border-top-modal" alt="">
					<button type="button" class="close f-1" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">×</span>
					</button>
					<div class="modal-header border-bottom-0 mt-3 pb-0 d-flex flex-column-reverse">
						<h3 class="m-auto  d-inline-block" style="color:#000">
							<?php
							$data_pro = $this->admin_model->get_promotions();

							echo $data_pro[0]['name'] ?>
							<hr class="x-hr-border-glow">
						</h3>
					</div>
					<div class="modal-body" style="top: 5px;">
						<div class="form-group mt-1 ml-2 mr-2 mb-2">
							<h4 style="color:blue">รายละเอียดโปรโมชั่น</h4>
							<img src="<?php echo $data_pro[0]['img_name'] ?>" class="img-fluid d-lg-block  " alt="">
							<textarea id="editor" rows="10" class="form-control" name="text_1"><?php echo $data_pro[0]['text'] ?></textarea>
							<br>
							<?php

							if ($u_pro['pro_id'] == 15) {

							?>
								<h2 class="text-center" style="color:red;">คุณรับโปรโมชั่นนี้ไปแล้ว จำนวน <span> <?php echo $u_pro['money'] ?></span> บาท </h2>
							<?php
							} else {
							?>
								<button id="pro_register" type="submit" class="btn btn-primary btn-lg btn-block mt-5" data-disable-on-click="">รับโปรโมชั่น</button>
							<?php
							}
							?>
						</div>
					</div>
					<img src="" class="img-fluid d-lg-block d-none -border-bottom-modal" alt="">
				</div>
			</div>
		</div>
		<!--###################################### โปรสมัครใหม่ ######################################-->

		<!-- โปรสมัครใหม่ -->

		<!-- ฝากแรกของวัน -->
		<!--###################################### ฝากแรกของวัน ######################################-->

		<div class="x-modal modal" id="promotion_newdate" tabindex="-1" data-loading-container=".js-modal-content" data-ajax-modal-always-reload="true" style="display: none;" aria-hidden="true">
			<div class="modal-dialog modal-dialog-centered -modal-size " role="document" style="padding-top: 60px;">
				<div class="modal-content -modal-content">
					<img src="" class="img-fluid d-lg-block d-none -border-top-modal" alt="">
					<button type="button" class="close f-1" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">×</span>
					</button>
					<div class="modal-header border-bottom-0 mt-3 pb-0 d-flex flex-column-reverse">
						<h3 class="m-auto  d-inline-block" style="color:#000">
							<?php
							$data_pro = $this->admin_model->get_promotions();

							echo $data_pro[1]['name'] ?>
							<hr class="x-hr-border-glow">
						</h3>
					</div>
					<div class="modal-body" style="top: 5px;">
						<div class="form-group mt-1 ml-2 mr-2 mb-2">
							<h4 style="color:blue">รายละเอียดโปรโมชั่น</h4>
							<img src="<?php echo $data_pro[1]['img_name'] ?>" class="img-fluid d-lg-block  " alt="">
							<textarea id="editor" rows="10" class="form-control" name="text_1"><?php echo $data_pro[1]['text'] ?></textarea>
							<br>
							<?php

							if ($u_pro_newDate['pro_id'] == 17) {

							?>
								<h2 class="text-center" style="color:red;">คุณรับโปรโมชั่นนี้ไปแล้ว จำนวน <span> <?php echo $u_pro_newDate['money'] ?></span> บาท </h2>
							<?php
							} else {
							?>
								<button id="pro_newdate" type="submit" class="btn btn-primary btn-lg btn-block mt-5" data-disable-on-click="">รับโปรโมชั่น</button>
							<?php
							}
							?>
						</div>
					</div>
					<img src="" class="img-fluid d-lg-block d-none -border-bottom-modal" alt="">
				</div>
			</div>
		</div>
		<!--###################################### ฝากแรกของวัน ######################################-->

		<!-- ฝากแรกของวัน -->

		<!-- ฝากทั้งวัน -->
		<!--###################################### ฝากทั้งวัน ######################################-->

		<div class="x-modal modal" id="promotion_alldate" tabindex="-1" data-loading-container=".js-modal-content" data-ajax-modal-always-reload="true" style="display: none;" aria-hidden="true">
			<div class="modal-dialog modal-dialog-centered -modal-size " role="document" style="padding-top: 60px;">
				<div class="modal-content -modal-content">
					<img src="" class="img-fluid d-lg-block d-none -border-top-modal" alt="">
					<button type="button" class="close f-1" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">×</span>
					</button>
					<div class="modal-header border-bottom-0 mt-3 pb-0 d-flex flex-column-reverse">
						<h3 class="m-auto  d-inline-block" style="color:#000">
							<?php
							$data_pro = $this->admin_model->get_promotions();

							echo $data_pro[2]['name'] ?>
							<hr class="x-hr-border-glow">
						</h3>
					</div>
					<div class="modal-body" style="top: 5px;">
						<div class="form-group mt-1 ml-2 mr-2 mb-2">
							<h4 style="color:blue">รายละเอียดโปรโมชั่น</h4>
							<img src="<?php echo $baseurl ?>uploads/<?php echo $data_pro[2]['img_name'] ?>" class="img-fluid d-lg-block  " alt="">
							<textarea id="editor" rows="10" class="form-control" name="text_1"><?php echo $data_pro[2]['text'] ?></textarea>
							<br>
							<?php

							if ($u_pro['pro_id'] == 18) {

							?>
								<h2 class="text-center" style="color:red;">คุณรับโปรโมชั่นนี้ไปแล้ว จำนวน <span> <?php echo $u_pro['money'] ?></span> บาท </h2>
							<?php
							} else {
							?>
								<button id="pro_alldate" type="submit" class="btn btn-primary btn-lg btn-block mt-5" data-disable-on-click="">รับโปรโมชั่น</button>
							<?php
							}
							?>
						</div>
					</div>
					<img src="" class="img-fluid d-lg-block d-none -border-bottom-modal" alt="">
				</div>
			</div>
		</div>
		<!--###################################### ฝากทั้งวัน ######################################-->

		<!-- ฝากทั้งวัน -->

		<!-- แนะนำเพื่อน -->
		<!--###################################### แนะนำเพื่อน ######################################-->

		<div class="x-modal modal" id="refModal" tabindex="-1" data-loading-container=".js-modal-content" data-ajax-modal-always-reload="true" style="display: none;" aria-hidden="true">
			<div class="modal-dialog modal-dialog-centered -modal-size " role="document" style="padding-top: 60px;">
				<div class="modal-content -modal-content" style="border: 2px solid #fdd741;">
					<img src="" class="img-fluid d-lg-block d-none -border-top-modal" alt="">
					<button type="button" class="close f-1" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">×</span>
					</button>
					<?php
					$dataaff_d = $seting['aff_m'];
					if (substr($dataaff_d, 0, 1) == '0') {
						$dataaff_d = substr($dataaff_d, 1);
					}
					if (stripos($dataaff_d, '.0') !== FALSE) {
						$dataaff_d = str_replace('.0', '', $dataaff_d);
					}
					if (substr($dataaff_d, 0, 1) == '.') {
						$dataaff_d = substr($dataaff_d, 1);
					}
					?>
					<div class="modal-header border-bottom-0 mt-3 pb-0 d-flex flex-column-reverse">
						<h4 class="m-auto  d-inline-block" style="color:#000">
							<i class="fas fa-users"></i> แนะนำเพื่อน รับโบนัส <?= $dataaff_d ? $dataaff_d : '0'; ?>% ของยอดเติม
							<hr class="x-hr-border-glow">
						</h4>
					</div>
					<div class="modal-body" style="top: 5px;">
						<div class="form-group mt-1 ml-2 mr-2 mb-2">
							<div class="form-group mt-1 ml-2 mr-2 mb-2">
								<input id="refURL22" type="text" class="form-control x-form-control text-center" placeholder="Link" value="<?= $baseurl ?>aff/<?= $info['id'] ?>" autocomplete="off" readonly>
							</div>
							<div style="text-align:center;padding:5px">
								<button class="btn btn-success" id="cp_btn" onclick="copyLinkaff()"> คัดลอก </button>
								<br>
								<p class='text-danger' style="padding-top:10px;"> เพียงเพื่อนเติมครั้งแรกขั้นต่ำ <?= $seting['aff_d']; ?> บาท จะได้รับ <?= $dataaff_d; ?>% ของยอดเติม </p>
							</div>
							<table class="table">
								<thead>
									<tr>
										<th scope="col" class="text-center" style="color:#000;">จำนวน</th>
										<th scope="col" class="text-center" style="color:#000;">ได้รับ</th>
										<th scope="col" class="text-center" style="color:#000;">วันที่ทำรายการ</th>
									</tr>
								</thead>
								<?php $aff = $this->user_model->aff($user);
								foreach ($aff as $v) {
								?>
									<tbody>
										<tr>
											<th style="color:#000;"> <?= $v['amout'] ?></th>
											<th style="color:#000;"><?= $v['amout_get'] ?></th>
											<th style="color:#000;"><?= $v['date'] ?></th>
										</tr>
									</tbody>
								<?php
								}
								?>

							</table>
						</div>
					</div>
					<img src="" class="img-fluid d-lg-block d-none -border-bottom-modal" alt="">
				</div>
			</div>
		</div>
		<!--###################################### แนะนำเพื่อน ######################################-->

		<!-- แนะนำเพื่อน -->




		<!-- ############################## ลิ้งรับทรัพย์  ################################# -->
		<div class="x-modal modal" id="refFriendModal" tabindex="-1" role="dialog" data-loading-container=".js-modal-content" data-ajax-modal-always-reload="true" style="display: none;" aria-hidden="true">
			<div class="modal-dialog modal-dialog modal-lg" role="document" style="margin-top: 131px;">
				<div class="modal-content -modal-content">
					<img src="" id="deposit" class="img-fluid d-lg-block d-none -border-top-modal" alt="">
					<button type="button" class="close f-1" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">×</span>
					</button>
					<div class="modal-body">
						<div class="x-login-form">
							<div data-animatable="fadeInModal" data-offset="0" class="-animatable-container animated fadeInModal">
								<?php
								$dataaff_d = $seting['aff_m'];
								// if (substr($dataaff_d, 0, 1) == '0') {
								//     $dataaff_d = substr($dataaff_d, 1);
								// } 
								if (stripos($dataaff_d, '.00') !== FALSE) {
									$dataaff_d = str_replace('.00', '.0', $dataaff_d);
								} else if (stripos($dataaff_d, '.0') !== FALSE) {
									$dataaff_d = str_replace('.0', '.', $dataaff_d);
								} else if (substr($dataaff_d, 0, 1) == '.') {
									$dataaff_d = substr($dataaff_d, 1);
								}
								?>
								<div class="text-center d-flex flex-column">
									<div class="m-auto ">
										<h3 class="m-auto d-inline-block" style="color:#000">
											แนะนำเพื่อน รับโบนัส <?= $dataaff_d ? $dataaff_d : '0'; ?>% ของยอดเดิมพัน
											<hr class="x-hr-border-glow">
										</h3>
										<div class="container">
										</div>
										<div class="form-group mt-1 ml-2 mr-2 mb-2">
											<input id="refURL22s" type="text" class="form-control x-form-control text-center" placeholder="Link" value="<?= $baseurl ?>ref/<?= $info['id'] ?>" autocomplete="off" readonly>
										</div>
										<button class="btn btn-success" id="cp_btn" onclick="copyLinkaffs()"> คัดลอก </button>
										<p class='text-danger'> เพียงเพื่อนมีการเล่น สามารถกดรับ <?= $dataaff_d; ?>% ของยอดเทิร์น ได้ทุกวัน </p>
										<?php $ref = $this->user_model->ref($info['id']); ?>

										<?php
										date_default_timezone_set('asia/bangkok');
										$date  = date('d-m-Y');
										$chk = $this->user_model->check_ref($user, $date);
										$dateaff =  date('d-m-Y', strtotime("-1 days"));
										foreach ($ref as $v) {
											date_default_timezone_set('asia/bangkok');
											$result = $this->user_model->history_ref($v['username'], $dateaff);
											$bonus += floatval($result[0]['turnover']);
										}
										?>
										<br>
										<div style="color:#000"> วันที่ <span class='text-info'><?= $dateaff ?> </span> ยอดโบนัส :<span> <?= ($bonus * $dataaff_d) / 100 ?> บาท</span></div>
										<div id="fff">
											<?php if (!$chk) {   ?>
												<button class="btn btn-info" style="padding: 5px;" onclick="receiveBonus(<?= ($bonus * $dataaff_d) / 100 ?>)"> รับโบนัส </button>
											<?php  } else {  ?>
												<button class="btn btn-light" style="padding: 2px;" disabled> รับโบนัสวันนี้ไปแล้ว </button>
											<?php   } ?>
										</div>
										<br>
										<table class="table text-white">
											<thead>
												<tr>
													<th scope="col" class="text-center" style="color:#000">จำนวน</th>
													<th scope="col" class="text-center" style="color:#000">ได้รับ</th>
													<th scope="col" class="text-center" style="color:#000">วันที่ทำรายการ</th>
												</tr>
											</thead>
											<?php $ref = $this->user_model->check_ref_all($user);
											foreach ($ref as $v) {
											?>
												<tbody>
													<tr>
														<th class="text-center" style="color:#000"><?= $v['bonus'] ?></th>
														<th class="text-center" style="color:#000"><?= $v['member_username'] ?></th>
														<th class="text-center" style="color:#000"><?= $v['date'] ?></th>
													</tr>
												</tbody>
											<?php
											}
											?>
										</table>
									</div>
								</div>
							</div>
						</div>
					</div>
					<img src="" class="img-fluid d-lg-block d-none -border-bottom-modal" alt="">
				</div>
			</div>
		</div>
		<!-- ############################## ลิ้งรับทรัพย์  ################################# -->



		<!-- ฝากต่อเนื่อง -->
		<!--###################################### ฝากต่อเนื่อง ######################################-->

		<div class="x-modal modal" id="modal-promotion" tabindex="-1" role="dialog" aria-hidden="true" data-loading-container=".js-modal-content" data-ajax-modal-always-reload="true">
			<div class="modal-dialog modal-dialog modal-lg" role="document" style="margin-top: 131px;">
				<div class="modal-content -modal-content">
					<img src="#" class="img-fluid d-lg-block d-none -border-top-modal" alt="">
					<button type="button" class="close f-1" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">×</span>
					</button>
					<div data-animatable="fadeInModal" data-offset="0" class="-animatable-container animated fadeInModal">
						<div class="modal-header border-bottom-0 mt-3 pb-0 d-flex flex-column-reverse">
							<h3 class="m-auto  d-inline-block" id="exampleModalCenterTitle" style="color:black">
								รับเครดิตเล่นเป่ายิ้งฉุบ ฝากสะสมติดต่อกัน <?= $setting_pow[0]['day'] ?> วัน
								ขั้นต่ำ <?= $setting_pow[0]['deposit'] ?> บาท
								<hr class="x-hr-border-glow">
							</h3>
						</div>
						<div class="modal-body">
							<div class="form-group mt-1 ml-2 mr-2 mb-2">
								<button id="promotion_revert" type="submit" class="btn btn-primary btn-lg btn-block" data-disable-on-click="">รับเครดิต</button>
								<!--<button type="submit" class="btn btn-primary btn-lg btn-block" disabled>จะเปิดบริการเร็วๆนี้</button>-->
								<br>
								<table class="table text-white">
									<thead>
										<tr>
											<th scope="col" class="text-center" style="color:blue;">ได้รับ</th>
											<th scope="col" class="text-center" style="color:blue;">ยอดสะสมการเล่น</th>
											<th scope="col" class="text-center" style="color:blue;">วันที่ทำรายการ</th>
										</tr>
									</thead>
									<tbody>
										<?php
										$result_pro = $this->user_model->ResultPromotion($user);
										foreach ($result_pro as $key => $value) {
										?>
											<tr>
												<td scope="row" class="text-center text-success" style="color:#000;"><?= $value['amount'] ?></td>
												<td scope="row" class="text-center text-warning" style="color:#000;"> <?= $value['balance'] ?> </td>
												<td scope="row" class="text-center" style="color:#000;"><?= $value['date'] ?></td>
											</tr>
										<?php
										}
										?>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!--###################################### ฝากต่อเนื่อง ######################################-->

		<!-- ฝากต่อเนื่อง -->


		<!-- ประวัติการทำรายการ -->
		<!--###################################### ประวัติการทำรายการ ######################################-->

		<div class="x-modal modal" id="modal-history" tabindex="-1" data-loading-container=".js-modal-content" data-ajax-modal-always-reload="true" style="display: none;" aria-hidden="true">
			<div class="modal-dialog modal-dialog-centered -modal-size " role="document" style="padding-top: 60px;">
				<div class="modal-content -modal-content" style="border: 2px solid #fdd741;">
					<img src="" class="img-fluid d-lg-block d-none -border-top-modal" alt="">
					<button type="button" class="close f-1" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">×</span>
					</button>
					<div class="modal-header border-bottom-0 mt-3 pb-0 d-flex flex-column-reverse">
						<h3 class="m-auto  d-inline-block" style="color:#000">
							ประวัติการทำรายการ
							<hr class="x-hr-border-glow">
						</h3>
					</div>
					<div class="modal-body" style="top: 5px;">
						<div class="form-group mt-1 ml-2 mr-2 mb-2">
							<table class="table text-white">
								<thead>
									<tr>
										<th scope="col" class="text-center" style="color:blue;">รายการ</th>
										<th scope="col" class="text-center" style="color:blue;">จำนวน</th>
										<th scope="col" class="text-center" style="color:blue;">สถานะ</th>
										<th scope="col" class="text-center" style="color:blue;">วันที่ทำรายการ</th>
									</tr>
								</thead>
								<tbody>
									<?php
									$trans = $this->bank_model->transection($user);
									foreach ($trans as $v) {
									?>
										<tr>
											<?php
											if ($v['type'] == 1) {
												echo '<td scope="row" class="text-center text-success"> ฝาก </td>';
											} else {
												echo '<td scope="row" class="text-center text-withdraw"> ถอน </td>';
											}
											?>
											<td scope="row" class="text-center" style="color:#000;"><?= $v['amount'] . ' บาท' ?></td>
											<?php
											if ($v['stats'] == 1) {
												echo '<td scope="row" class="text-center text-warning"> กำลังทำรายการ </td>';
											} else if ($v['stats'] == 2) {
												echo '<td scope="row" class="text-center text-withdraw"> ไม่สำเร็จ </td>';
											} else {
												echo '<td scope="row" class="text-center text-success"> สำเร็จ </td>';
											}
											?>
											<td scope="row" class="text-center" style="color:#000;"><?= $v['date'] ?></td>
										</tr>
									<?php
									}
									?>

								</tbody>

							</table>
						</div>
						<button type="button" class="btn btn-danger btn-lg btn-block btn-cancel -submit" data-dismiss="modal"><i class="fas fa-times-circle"></i> ปิด </button>
					</div>
					<img src="" class="img-fluid d-lg-block d-none -border-bottom-modal" alt="">
				</div>
			</div>
		</div>
		<!--###################################### ประวัติการทำรายการ ######################################-->

		<!-- ประวัติการทำรายการ -->


		<!-- สุ่มวงล้อ -->
		<!--###################################### สุ่มวงล้อ ######################################-->

		<div class="x-modal modal" id="wheelspin" tabindex="-1" data-loading-container=".js-modal-content" data-ajax-modal-always-reload="true" aria-hidden="true">
			<div class="modal-dialog modal-dialog-centered -modal-size " role="document" style="padding-top: 60px;">
				<div class="modal-content -modal-content" style="border: 2px solid #fdd741;">
					<img src="" class="img-fluid d-lg-block d-none -border-top-modal" alt="">
					<button type="button" class="close f-1" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">×</span>
					</button>
					<div class="modal-header border-bottom-0 mt-3 pb-0 d-flex flex-column-reverse">
						<h3 class="m-auto  d-inline-block" style="color:#000">
							วงล้อเสี่ยงโชค
							<hr class="x-hr-border-glow">
						</h3>
					</div>
					<div class="modal-body" style="top: 5px;">
						<div class="wheel-horizontal superWheel _0" style="font-size: 16px; width: 300px; height: 300px;margin-top: 0px;">
						</div>
						<p id="btn_wheelspin"></p>
						<br>
						<table class="table text-white">
							<thead>
								<tr>
									<th scope="col" class="text-center" style="color:blue;">จำนวนเครดิต</th>
									<th scope="col" class="text-center" style="color:blue;">วันที่ทำรายการ</th>
								</tr>
							</thead>
							<tbody id="transaction_wheel">
							</tbody>

						</table>
					</div>
					<img src="" class="img-fluid d-lg-block d-none -border-bottom-modal" alt="">
				</div>
			</div>
		</div>
		<!--###################################### สุ่มวงล้อ ######################################-->

		<!-- สุ่มวงล้อ -->

		<!--###################################### เป่ายิ้งฉุบ ######################################-->
		<style>
			.containers {
				display: flex;
			}

			.containers .section {
				width: 350px;
				margin: 20px 41px;
			}

			.section .info {
				color: #000;
				display: flex;
				align-items: center;
				justify-content: center;
				height: 50px;
			}

			.info span,
			.info h3 {
				font-size: 25px;
				font-weight: bold;
				margin: 0px 10px;
				color: black;
			}

			.show {
				display: flex;
				align-items: center;
				justify-content: center;
			}

			.show i {
				font-size: 100px;
				color: #fbbc21;
			}

			.selection {
				display: flex;
				align-items: center;
				justify-content: center;
				height: 100px;
			}

			.selection button {
				margin: 0 20px;
				padding: 25px;
				border-radius: 50%;
				border: none;
				outline: none;
				cursor: pointer;
				background: rgb(248 85 7);
				font-size: 33px;
				color: #fbbc21;
			}
		</style>
		<div class="x-modal modal" id="powyingshup" tabindex="-1" data-loading-container=".js-modal-content" data-ajax-modal-always-reload="true" aria-hidden="true">
			<div class="modal-dialog modal-dialog-centered -modal-size " role="document" style="padding-top: 60px;">
				<div class="modal-content -modal-content" style="border: 2px solid #fdd741;">
					<img src="" class="img-fluid d-lg-block d-none -border-top-modal" alt="">
					<button type="button" class="close f-1" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">×</span>
					</button>
					<div class="modal-header border-bottom-0 mt-3 pb-0 d-flex flex-column-reverse">
						<h3 class="m-auto  d-inline-block" style="color:#000">
							เป่ายิ้งฉุบ
							<hr class="x-hr-border-glow">
						</h3>
					</div>
					<div class="modal-body" style="top: 5px;padding:0px;overflow: auto;">
						<div class="text-center">
							<span style="color:orange;font-size:1.5rem;">เล่นได้อีก : </span><span style="color:green;font-size:1.5rem;" id="play_pow">Waiting...</span>
						</div>
						<div class="containers">
							<!--   The first section     -->
							<div class="section">
								<div class="info">
									<h3>You</h3>
								</div>
								<div class="show" style="padding: 25px;border-radius: 50%;border: none;outline: none;background: rgb(248 85 7);font-size: 33px;color: orange;">
									<i class="fas fa-hand-rock"></i>
								</div>
							</div>
							<!--   The second section     -->
							<div class="section">
								<div class="info">
									<h3>Computer</h3>
								</div>
								<div class="show computer" style="padding: 25px;border-radius: 50%;border: none;outline: none;background: rgb(248 85 7);font-size: 33px;color: orange;">
									<i class="fas fa-hand-scissors"></i>
								</div>
							</div>
						</div>
						<br>
						<h2 class="text-center" style="color: rgb(233, 33, 19);" id="demo2">เลือกเพื่อเล่น !</h2>
						<br>
						<!-- This selection div contains the buttons   -->
						<div class="selection text-center">
							<button class="fas fa-hand-rock" id="rock"></button>
							<button class="fas fa-hand-paper" id="paper"></button>
							<button class="fas fa-hand-scissors" id="scissors"></button>
						</div>
						<br>
						<table class="table text-white">
							<thead>
								<tr>
									<th scope="col" class="text-center" style="color:blue;">จำนวนเครดิต</th>
									<th scope="col" class="text-center" style="color:blue;">ผลการออก</th>
									<th scope="col" class="text-center" style="color:blue;">วันที่ทำรายการ</th>
								</tr>
							</thead>
							<tbody id="transaction_powyingshup">
							</tbody>

						</table>
					</div>
					<img src="" class="img-fluid d-lg-block d-none -border-bottom-modal" alt="">
				</div>
			</div>
		</div>
		<!--###################################### เป่ายิ้งฉุบ ######################################-->

		<!-- ฝากเงิน -->
		<!--###################################### ฝากเงิน ######################################-->

		<div class="x-modal modal" id="modal-deposit" tabindex="-1" role="dialog" data-loading-container=".js-modal-content" data-ajax-modal-always-reload="true" style="display: none;" aria-hidden="true">
			<div class="modal-dialog -modal-size -modal-big" role="document" style="padding-top: 60px;">
				<div class="modal-content -modal-content">
					<img src="" class="img-fluid d-lg-block d-none -border-top-modal" alt="">
					<button type="button" class="close f-1" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">×</span>
					</button>

					<div class="modal-body">
						<div class="x-pending ">
							<div class="d-lg-block d-none">
								<div class="row">
									<div class="col d-flex flex-column js-slide-left-content x-slide-left-content">
										<div class="js-content mx-auto text-center animated fadeInModal" data-animatable="fadeInModal" data-delay="1500">
											<h3 class="x-title-modal mx-auto text-center d-inline-block mt-3">
												ข้อมูลการโอน
												<hr class="x-hr-border-glow">
											</h3>
											<div class="text-center d-flex flex-column">
												<?php
												if ($bank_info['status_scb'] == 1) {
												?>
													<div class="mb-3">
														<div class="media m-auto d-inline-flex">
															<img src="https://podthai.store/image/scb2.png" alt="bank-bay" width="50px" class="rounded-circle mr-3">
															<div class="media-body text-left d-flex flex-column">
																<div class="d-flex flex-lg-column flex-row" style="margin-top:0px;">
																	<h1 class="text-primary"><?= $bank_info['accnum'] ?></h1>
																	<div class="f-5 d-lg-block d-none text-white"><span>
																			<?= $bank_info['name'] ?> </span>
																	</div>
																</div>
															</div>
														</div>
													</div>
												<?php } ?>
												<br>
												<?php
												if ($bank_info['status_ktb'] == 1) {
												?>
													<div class="mb-3">
														<div class="media m-auto d-inline-flex">
															<img src="https://[Domain]/image/ktb.png" alt="bank-bay" width="50px" class="rounded-circle mr-3">
															<div class="media-body text-left d-flex flex-column">
																<div class="d-flex flex-lg-column flex-row">
																	<h1 class="text-primary"><?= $bank_info['accnum_ktb'] ?></h1>
																	<div class="f-5 d-lg-block d-none text-white"><span>
																			<?= $bank_info['name_ktb'] ?> </span>
																	</div>
																</div>
															</div>
														</div>
													</div>
												<?php } ?>
												<div class="-danger-zone">
													<div class="-icon-wrapper">
														<img src="images/ic-alert.png" alt="Alert icon png" class="-img">
													</div>
													<span style="color:#000;">กรุณาใช้บัญชี <?= $info['bank'] ?>
														<br>เลขบัญชี <?= $info['accnum'] ?>
														<br>ชื่อ <?= $info['name'] ?>
														<br>โอนเข้ามาเท่านั้นนะคะ
													</span><br>
												</div>
											</div>
										</div>
									</div>
									<div class="col d-flex flex-column animated fadeInModal" data-animatable="fadeInModal">
										<h3 class="x-title-modal mx-auto text-center d-inline-block mt-3">
											ฝากเงิน
											<hr class="x-hr-border-glow">
										</h3>
										<div class="-deposit-preview text-center">
											<img src="images/ic_chip_deposit.png" class="img-fluid mb-3" alt="deposit" width="100">
											<hr class="border-dark w-85">
											<div class="my-3">
												<div class="-fake-input w-90 m-auto">
													<b><span id="font_pop">ขั้นต่ำ <?= $d_limit ?> บาท</span><span class=""></span></b>
												</div>
											</div>
											<div class="d-flex col-10 px-0 m-auto flex-column">
												<div class="f-5" style="color:#f22662;">เมื่อโอนเงินแล้ว กรุณารอ 10-30 วินาที</div>
											</div>
											<div class="my-3">
												<button type="button" id="copyaccnum1" class="btn btn-primary -submit text-center copy-account-number" onclick="Swal.fire({ icon: 'success',title: 'สำเร็จ',text: 'คัดลอกเลขบัญชีแล้ว ' + bank_number21})">
													คัดลอกเลขบัญชี
												</button>
											</div>
											<div class="x-admin-contact ">
												<span class="x-text-with-link-component">
													<label class="-text-message ">พบปัญหา</label>
													<a href="https://line.me/R/ti/p/<?= $line ?>" id="contact-line" target="_blank">
														<span id="contact-line">ติดต่อฝ่ายบริการลูกค้า</span>
													</a>
												</span>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="d-lg-none d-block h-100">
								<div class="col d-flex flex-column h-100 px-0">
									<div class="js-content -animatable-container m-auto text-center animated fadeInModal" data-animatable="fadeInModal" data-delay="0">
										<h3 class="x-title-modal mx-auto text-center d-inline-block mt-3">
											ฝากเงิน
											<hr class="x-hr-border-glow">
										</h3>
										<div class="text-center">
											<?php
											if ($bank_info['status_scb'] == 1) {
											?>
												<div class="mb-3">
													<div class="media m-auto d-inline-flex">
														<img src="https://podthai.store/image/scb2.png" alt="bank-bay" width="50px" class="rounded-circle mr-3">
														<div class="media-body text-left d-flex flex-column">
															<div class="d-flex flex-lg-column flex-row" style="margin-top:0px;">
																<b class="f-lg-4 f-5 mr-lg-0 mr-2 text-primary"> <?= $bank_info['accnum'] ?></b>
															</div>
															<div class="f-5 d-lg-none d-block text-white"><?= $bank_info['name'] ?></div>
														</div>
													</div>
												</div>
											<?php } ?>
											<br>
											<?php
											if ($bank_info['status_ktb'] == 1) {
											?>
												<div class="mb-3">
													<div class="media m-auto d-inline-flex">
														<img src="https://podthai.store/image/scb2.png" alt="bank-bay" width="50px" class="rounded-circle mr-3">
														<div class="media-body text-left d-flex flex-column">
															<div class="d-flex flex-lg-column flex-row">
																<b class="f-lg-4 f-5 mr-lg-0 mr-2 text-primary"> <?= $bank_info['accnum_ktb'] ?></b>
															</div>
															<div class="f-5 d-lg-none d-block text-white"><?= $bank_info['name_ktb'] ?></div>
														</div>
													</div>
												</div>
											<?php } ?>
										</div>
										<div class="col-12 m-auto d-flex">
											<div class="m-auto d-flex flex-row">
												<div class="f-5 mt-3 text-gray-lighter" style="color: #e32962;">เมื่อโอนเงินแล้ว กรุณารอ 10-30 วินาที</div>
											</div>
										</div>
										<div class="my-3">
											<div class="-fake-input w-90 m-auto">
												<span>ขั้นต่ำ <?= $d_limit ?> บาท</span><span class=""></span>
											</div>
										</div>
										<div class="-danger-zone">
											<div class="-icon-wrapper">
												<img src="images/ic-alert.png" alt="Alert icon png" class="-img">
											</div>
											<span style="color:#000;">กรุณาใช้เลขบัญชีที่สมัคร<br>โอนเข้ามาเท่านั้นนะคะ</span>
										</div>
									</div>
									<div>
										<button type="button" id="copyaccnum2" class="btn btn-block -submit btn-primary text-center m-auto js-user-confirm-deposit f-5 copy-account-number" onclick="Swal.fire({ icon: 'success',title: 'สำเร็จ',text: 'คัดลอกเลขบัญชีแล้ว ' + bank_number21})">
											คัดลอกเลขบัญชี
										</button>
									</div>
								</div>
							</div>
						</div>
					</div>
					<img src="images/border-modal.png" class="img-fluid d-lg-block d-none -border-bottom-modal" alt="">
				</div>
			</div>
		</div>
		<!--###################################### ฝากเงิน ######################################-->

		<!-- ฝากเงิน -->




		<?php if ($user) { ?>
			<!-- ถอนเงิน -->

			<!--###################################### ถอนเงิน ######################################-->

			<div class="x-modal modal" id="modal-withdraw" tabindex="-1" data-loading-container=".js-modal-content" data-ajax-modal-always-reload="true" style="display: none;" aria-hidden="true">
				<div class="modal-dialog modal-dialog-centered -modal-size " role="document" style="padding-top: 60px;">
					<div class="modal-content -modal-content">
						<img src="" class="img-fluid d-lg-block d-none -border-top-modal" alt="">
						<button type="button" class="close f-1" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">×</span>
						</button>
						<div class="modal-header border-bottom-0 mt-3 pb-0 d-flex flex-column-reverse">
							<h3 class="m-auto  d-inline-block" style="color:#000">
								ถอนเงิน
								<hr class="x-hr-border-glow">
							</h3>
						</div>
						<div class="modal-body" style="top: 5px;">
							<div class="form-group mt-1 ml-2 mr-2 mb-2">
								<div class="d-flex justify-content-center">
									<div class="media p-2">
										<div class="bank-box">
											<img src="images/bank2/<?= $info['bank'] ?>.jpg" width="50px" height="50px">
										</div>
										<div class="media-body ml-2">
											<div style="color:#000;"><strong><?= $info['name'] ?></strong></div>
											<div style="color:#000;"><?= $info['accnum'] ?></div>

										</div>
									</div>

								</div>
								<div>
									<p class="text-center mt-2" id='turnover'>
									</p>
								</div>
								<div class="m-auto">
								</div>
								<p class="text-center mt-2" style="color:#000;">
									จำนวนเงินที่ต้องการถอน (ถอนขั้นต่ำ <?= $w_limit ?> บาท)
								</p>
								<?php

								$pro = $this->user_model->Promotions($user);

								if ($pro['promotion_id'] == 0) { ?>
									<div class="text-center">
										<span class="text-center mt-2" style="color:#000;">โปรโมชั่นของคุณคือ : </span><span style="color:#f22662">คุณไม่ได้รับโปรโมชั่น</span>
									</div>
								<?php   } else {  ?>
									<div class="text-center">
										<span class="text-center mt-2" style="color:#000;">โปรโมชั่นของคุณคือ : </span><span style="color:#f22662"><?= $pro['pro_name'] . ' (' . $pro['percen'] . '%)' ?></span><br>
										<span class="text-center mt-2" style="color:#000;">จำนวนเทิร์น : </span><span style="color:#f22662"><?= $pro['x'] . ' เท่า' ?></span><br>
										<span class="text-center mt-2" style="color:#000;">เทิร์นของคุณคือ : </span><span style="color:#f22662" id="turnover_user"></span>
									</div>
								<?php       }

								?>
								<p class="text-center mt-2" style="color:#000;">
									** เมื่อกดปุ่มยืนยันแล้วกรุณารอ 30 วินาที **
								</p>
								<div class="form-group mt-1 ml-2 mr-2 mb-2">
									<input class="form-control" id='money_w' placeholder="ยอดเงินถอน" pattern="[0-9]+" autofocus name="amount" type="text" style="border:1px solid #2fc82b;">
								</div>
								<div class="d-flex justify-content-center mt-3 ml-2 mr-2">
									<button id="withdraw" class="btn btn-primary -submit" data-disable-on-click>ยืนยัน</button>
								</div>
							</div>
						</div>
						<img src="" class="img-fluid d-lg-block d-none -border-bottom-modal" alt="">
					</div>
				</div>
			</div>
			<!--###################################### ถอนเงิน ######################################-->

			<!-- ถอนเงิน -->
		<?php  } ?>

		<div class="x-modal modal " id="memberModal" tabindex="-1" role="dialog" aria-hidden="true" data-loading-container=".js-modal-content" data-ajax-modal-always-reload="true">
			<div class="modal-dialog -modal-size -modal-mobile" role="document">
				<div class="modal-content -modal-content">
					<button type="button" class="close f-1 " data-dismiss="modal" aria-label="Close">
						<i class="fas fa-times"></i>
					</button>
					<div class="modal-header -modal-header">
						<h3 class="x-title-modal">
							ข้อมูลส่วนตัว
						</h3>
					</div>
					<div class="modal-body -modal-body" style="position: unset;">
						<div class="x-login-form">
							<div data-animatable="fadeInModal" data-offset="0" class="-animatable-container animated fadeInModal">
								<div data-animatable="fadeInModal" data-offset="0" class="-animatable-container animated fadeInModal">
									<div>
										<img src="images/profile-icon-lerge-black.png" class="mx-auto d-block mb-2 mt-2" alt="giftbox-icon" width="50">
										<p class="text-center">
											Username : <strong><span class="text-danger"><?= $user ?></span></strong><br>
											เครดิต : <strong><span class="ufabet-credit">0.00</span></strong> บาท
										</p>
										<p class="text-center">
											<a href="#" id="changpasshola" class="link-support js-btn-change-pass" onclick="myFunction()" title="เปลี่ยนรหัสผ่าน">เปลี่ยนรหัสผ่าน</a> |
											<a href="#" id="logouthola" class="link-support" onclick="logoutufa()" title="Logout">ออกจากระบบ</a>
										</p>
										<div class="form-password">
										</div>
										<div id="panel" data-animatable="fadeInModal" data-offset="0" class="-animatable-container animated fadeInModal">
											<p class="mt-3 text-center">ข้อมูลบัญชี UFABET</p>
											<?php
											if ($ufa['username'] != '') {
											?>
												<div class="d-flex justify-content-center">
													<div>
														UFA ID: <?= $user_ufa ?> <a href="#" class="link-support copy-username" data-clipboard-text="<?= $bank_info['accnum'] ?>">[ คัดลอก ]</a>
													</div>

												</div>
											<?php
											} else {
											?>
												<div class="d-flex justify-content-center">
													<div>
														เติมเงินขั้นต่ำ <?= $d_limit ?> บาทเพื่อเปิดยูส
													</div>
												</div>
											<?php
											}
											?>
											<div class="d-flex justify-content-center">
												<div class="mt-3 media p-2">
													<div class="bank-box">
														<img src="images/bank2/<?= $info['bank'] ?>.jpg" width="70px" height="70px">
													</div><br>
													<div class="media-body ml-2">
														<div><strong><b>ข้อมูลบัญชี</b></strong></div>
														<div><strong><?= $info['name'] ?></strong></div>
														<div><?= $info['accnum'] ?></div>
													</div>
												</div>
											</div>
											<hr style="background: rgb(101, 101, 101);">
											<center>
											</center>
										</div>
									</div>
									<p class="text-center">*ต้องการเปลี่ยนบัญชี กรุณาติดต่อ <a id="contact-line" class="link-support" href="https://line.me/R/ti/p/<?= $line; ?>" title="ฝ่ายบริการลูกค้า" target="_blank">ฝ่ายบริการลูกค้า</a></p>
									<div class="d-flex justify-content-center mt-3 ml-2 mr-2">
										<button type="submit" class="btn btn-danger btn-lg btn-block btn-cancel" onclick="logoutufa()" title="ออกจากระบบ">ออกจากระบบ</button>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>



	</div>
	</div>

	<div class="x-modal modal -alert-modal animated fadeInRight" id="alertModal" tabindex="-1" role="dialog" aria-hidden="true" data-loading-container=".js-modal-content" data-ajax-modal-always-reload="true" data-animatable="fadeInRight" data-delay="700" data-dismiss-alert="true">
		<div class="modal-dialog -modal-size " role="document">
			<div class="modal-content -modal-content">
				<button type="button" class="close f-1 " data-dismiss="modal" aria-label="Close">
					<i class="fas fa-times"></i>
				</button>
				<div class="modal-body -modal-body">
					<div class="d-flex -alert-body">
						<div class="text-center mr-3 -alert-body-wrapper">
							<img src="images/ez-slot-ic-alert-success.png" alt="SUCCESS" class="-img-alert js-ic-success img-fluid">
							<img src="images/ez-slot-ic-alert-failed.png" alt="FAIL" class="-img-alert js-ic-fail img-fluid">
						</div>
						<div class="my-auto js-modal-content"></div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="x-modal modal " id="themeSwitcherModal" tabindex="-1" role="dialog" aria-hidden="true" data-loading-container=".js-modal-content" data-ajax-modal-always-reload="true">
		<div class="modal-dialog -modal-size modal-dialog-centered" role="document">
			<div class="modal-content -modal-content">
				<div class="modal-body -modal-body">
					<div class="x-theme-switcher">
						<ul class="nav">
							<li class="nav-item -ez-casino animated fadeInUp" data-animatable="fadeInUp" data-delay="100">
								<a href="" class="nav-link" rel="ugc,nofollow">
									<img src="images/casi.png" alt="EZ-Casino-ทางเข้าคาสิโนสดออนไลน์ logo png" class="-logo" width="50" height="50">
									<div class="-text"><?= $webname; ?></div>
								</a>
							</li>
							<li class="nav-item -ez-slot -active animated fadeInUp" data-animatable="fadeInUp" data-delay="100">
								<a href="/spin/spintowin" class="nav-link" rel="ugc,nofollow">
									<img src="images/game.png" alt="EZ-Slot-ทางเข้าสล็อตออนไลน์-เครดิตฟรี logo png" class="-logo" width="50" height="50">
									<div class="-text">วงล้อฟรี</div>
								</a>
							</li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="x-contact-us">
		<a href="https://line.me/R/ti/p/<?= $line ?>" class="-line-contact-button-container js-line-contact-hover" target="_blank" rel="noopener">
			<img src="images/ez-slot-ic-contact-line.png" class="-ic" alt="<?= $webname; ?> รูปโลโก้ Line png">
			<div class="-content-wrapper">
				<div class="-content-inside">
					<span>ฝ่ายบริการลูกค้า<br>ดูแลคุณ 24 ชั่วโมง</span>
				</div>
			</div>
		</a>
	</div>
	<script id="b-loading" type="text/template">
		<div class="x-dice-container py-5 m-auto d-flex">
<div id="dice" class="mx-auto">
    <div class="side front">
        <div class="dot center bg-danger"></div>
    </div>
    <div class="side front inner"></div>
    <div class="side top">
        <div class="dot dtop dleft"></div>
        <div class="dot dbottom dright"></div>
    </div>
    <div class="side top inner"></div>
    <div class="side right">
        <div class="dot dtop dleft"></div>
        <div class="dot center"></div>
        <div class="dot dbottom dright"></div>
    </div>
    <div class="side right inner"></div>
    <div class="side left">
        <div class="dot dtop dleft"></div>
        <div class="dot dtop dright"></div>
        <div class="dot dbottom dleft"></div>
        <div class="dot dbottom dright"></div>
    </div>
    <div class="side left inner"></div>
    <div class="side bottom">
        <div class="dot center"></div>
        <div class="dot dtop dleft"></div>
        <div class="dot dtop dright"></div>
        <div class="dot dbottom dleft"></div>
        <div class="dot dbottom dright"></div>
    </div>
    <div class="side bottom inner"></div>
    <div class="side back">
        <div class="dot dtop dleft"></div>
        <div class="dot dtop dright"></div>
        <div class="dot dbottom dleft"></div>
        <div class="dot dbottom dright"></div>
        <div class="dot center dleft"></div>
        <div class="dot center dright"></div>
    </div>
    <div class="side back inner"></div>
    <div class="side cover x"></div>
    <div class="side cover y"></div>
    <div class="side cover z"></div>
</div>
</div>
</script>
	<script id="loading" type="text/template">
		<div class="x-dice-container py-5 m-auto d-flex">
<div id="dice" class="mx-auto">
    <div class="side front">
        <div class="dot center bg-danger"></div>
    </div>
    <div class="side front inner"></div>
    <div class="side top">
        <div class="dot dtop dleft"></div>
        <div class="dot dbottom dright"></div>
    </div>
    <div class="side top inner"></div>
    <div class="side right">
        <div class="dot dtop dleft"></div>
        <div class="dot center"></div>
        <div class="dot dbottom dright"></div>
    </div>
    <div class="side right inner"></div>
    <div class="side left">
        <div class="dot dtop dleft"></div>
        <div class="dot dtop dright"></div>
        <div class="dot dbottom dleft"></div>
        <div class="dot dbottom dright"></div>
    </div>
    <div class="side left inner"></div>
    <div class="side bottom">
        <div class="dot center"></div>
        <div class="dot dtop dleft"></div>
        <div class="dot dtop dright"></div>
        <div class="dot dbottom dleft"></div>
        <div class="dot dbottom dright"></div>
    </div>
    <div class="side bottom inner"></div>
    <div class="side back">
        <div class="dot dtop dleft"></div>
        <div class="dot dtop dright"></div>
        <div class="dot dbottom dleft"></div>
        <div class="dot dbottom dright"></div>
        <div class="dot center dleft"></div>
        <div class="dot center dright"></div>
    </div>
    <div class="side back inner"></div>
    <div class="side cover x"></div>
    <div class="side cover y"></div>
    <div class="side cover z"></div>
</div>
</div>
</script>
	<style>
		.-status-game-container-wrapper {
			display: flex;
			flex-wrap: wrap;
			width: 100%;
			color: #472c59;
			padding-left: 0;
		}

		.-status-game-container-wrapper .-status-list {
			display: flex;
			width: calc(33.33333% - 20px);
			margin: 10px;
		}

		[data-animatable].animated {
			opacity: 1;
		}

		.-status-game-container-wrapper .-status-list .-status-img {
			width: 80px;
			margin: auto 10px auto 0;
		}

		.-status-game-container-wrapper .-status-list .-status-content {
			display: flex;
			flex-direction: column;
			justify-content: center;
			flex-grow: 1;
		}
	</style>
	<footer class="x-footer -logged">
		<div class="-inner-wrapper lazyload">
			<div class="container -image-wrapper">
				<img src="images/logo.png" alt="ez-bet" class="img-fluid -img">
				<h2 class="-text"> สกิลเกม เจ้าแรกในไทย</h2>
				<h3 class="-sub-text"><span class="-highlight"><?= $webname; ?></span> Slot Online FullHD รองรับ App iOS,
					Android สล็อต คาสิโน ยิงปลา และกีฬา ครบจบ เว็บเดียวจากค่ายดังทุกมุมโลก EzSlot.bet มีมากกว่า
					แต่ง่ายกว่า เกมเยอะ ภาพสวยใหม่ และ เป็นที่นิยม เรารวม สล็อตออนไลน์ และ เกมสล็อต มากที่สุดในไทย
					ด้วยระบบเติมถอนอัจฉริยะ เล่นง่าย รวดเร็ว ฝากถอนออโต้ เจ้าเดียวที่ใช้ได้จริง</h3>
			</div>
			<br>
			<br>
			<?php if (!$user) { ?>


				<div class="container -image-wrapper">
					<h2 class="-text">ขั้นตอนการสมัครสมาชิก <?= $webname; ?></h2>
					<div class="row -box-wrapper">
						<div class="col-md-4">
							<div class="-box">
								<div class="-content">
									<img src="images/ic_register.png" alt="icon png" class="-ic-register">
									<div class="-desc-wrap">
										<div class="-text">1. สมัครสมาชิก</div>
										<div class="-sub-text">กรอกเบอร์โทรศัพท์ของคุณให้ถูกต้อง</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-md-4">
							<div class="-box">
								<div class="-content">
									<img src="images/ic_otp.png" alt="icon png" class="-ic-otp">
									<div class="-desc-wrap">
										<div class="-text">2. ใส่เลขบัญชีธนาคารของคุณ</div>
										<div class="-sub-text">
											กรอกเลขบัญชีธนาคารของคุณให้ถูกต้องเพราะระบบจะตรวจสอบชื่อบัญชีของคุณ</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-md-4">
							<div class="-box">
								<div class="-content">
									<img src="images/ic_bank.png" alt="icon png" class="-ic-bank">
									<div class="-desc-wrap">
										<div class="-text">3. ใส่รหัสผ่านและไอดีไลน์ของคุณ</div>
										<div class="-sub-text">ตั้งรหัสผ่านและกรอกไอดีไลน์ของคุณ จากนั้น เข้าร่วมสนุกกับ
											<span class="text-info"><?= $webname; ?></span> ได้ทันที
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			<?php } ?>
			<div class="container">
				<div class="row x-footer-seo">
					<div class="col-12 -tags">
						<a href="/" class="btn btn-sm disabled">slot</a>
						<a href="/" class="btn btn-sm disabled">slot online</a>
						<a href="/" class="btn btn-sm disabled"><?= $webname; ?></a>
						<a href="/" class="btn btn-sm disabled">game slot</a>
						<a href="/" class="btn btn-sm disabled">gameslot</a>
						<a href="/" class="btn btn-sm disabled">สล็อต</a>
						<a href="/" class="btn btn-sm disabled">สล็อตออนไลน์</a>
						<a href="/" class="btn btn-sm disabled">เกมสล็อต</a>
						<a href="/" class="btn btn-sm disabled">ยิงปลา</a>
						<a href="/" class="btn btn-sm disabled">เกมยิงปลา</a>
						<a href="/" class="btn btn-sm disabled">joker</a>
						<a href="/" class="btn btn-sm disabled">evoplay</a>
						<a href="/" class="btn btn-sm disabled">simpleplay</a>
						<a href="/" class="btn btn-sm disabled">playstar</a>
						<a href="/" class="btn btn-sm disabled">kingmaker</a>
						<a href="/" class="btn btn-sm disabled">habanero</a>
					</div>
				</div>
			</div>
			<div class="container">
				<div class="x-contact-directly" data-animatable="fadeInUp" data-delay="100">
					<div class="-qr-wrapper -empty">
					</div>
				</div>
			</div>
			<div class="text-center mt-3 mt-lg-4">
			</div>
		</div>
		<div class="text-center -copy-right-container">
			<p class="mb-0 -copy-right-text">
				Copyright © 2021 All Rights Reserved . Server by <?= $webname; ?>
			</p>
		</div>
	</footer>
	<?php

	if ($user != '') {

	?>
		<script>
			function copyLinkaff() {

				var copyText = document.getElementById("refURL22");

				copyText.select();

				document.execCommand("copy");

				Swal.fire({

					icon: 'success',

					title: 'สำเร็จ',

					text: 'ก็อปปี้ลิ้ง : ' + copyText.value

				});

			};



			function logoutufa() {

				Swal.fire({

					icon: 'warning',

					title: 'ต้องการออกจากระบบ ?',

					showConfirmButton: false,

					html: '<br><br>' +

						'<a class="float-left btn btn-danger text-light" onclick="swal.close()"><i class="fas fa-times"></i> ยกเลิก</a>' +

						'<a href="api/logout" class="float-right btn btn-success text-light" title="Logout" title="ออกจากระบบ"><i class="fas fa-check"></i> ยืนยัน</a>',

				});

			}

			$('#withdraw_pro').click(() => {

				$.ajax({

					url: "apitopup/Calculate_turn",

					method: 'get',



					success: function(data) {



						if (data.stats == true) {





							dd = data.data.split('/')

							//html = '<div class="progress"> <div class="progress-bar" role="progressbar" aria-valuenow="'+ Number(dd [0])+'" aria-valuemin="0" aria-valuemax="'+ Number(dd [1])+'" style="width:'+ Number(dd [0])+'%">'+ Number(dd [0])+' </div> </div>'


							$('#turnover').html("ต้องทำ " + data.data)



						} else {



						}

					}

				})



			})


			$('#pro_register').click(() => {

				$("#pro_register").text("กำลังประมวลผล..."), $("#pro_register").prop("disabled", !0)

				$.ajax({

					url: "/apitopup/RegisterPromotion",
					method: 'post',
					data: {
						pro_id: 'register',
					},
					success: function(data) {

						if (data.stats == true) {
							//$("#promotion_revert").text("รับเงิน"), $("#promotion_revert").prop("disabled", 0)
							Swal.fire({
								icon: 'success',
								title: 'แจ้งเตือน',
								text: data.msg
							}).then((result) => {
								location.reload()
							})

						} else {
							Swal.fire({
								icon: 'error',
								title: 'เกิดข้อผิดพลาด',
								text: data.msg
							}).then((result) => {
								location.reload()
							})
						}
					}

				})



			})

			$('#pro_newdate').click(() => {

				$("#pro_newdate").text("กำลังประมวลผล..."), $("#pro_newdate").prop("disabled", !0)

				$.ajax({
					url: "/apitopup/newdate_promotion",
					method: 'post',
					data: {
						newdate: 'newdate',
					},
					success: function(data) {

						if (data.stats == true) {
							//$("#promotion_revert").text("รับเงิน"), $("#promotion_revert").prop("disabled", 0)
							Swal.fire({
								icon: 'success',
								title: 'แจ้งเตือน',
								text: data.msg
							}).then((result) => {
								location.reload()
							})

						} else {
							Swal.fire({
								icon: 'error',
								title: 'เกิดข้อผิดพลาด',
								text: data.msg
							}).then((result) => {
								location.reload()
							})
						}
					}

				})



			})
			$('#pro_alldate').click(() => {

				$("#pro_alldate").text("กำลังประมวลผล..."), $("#pro_alldate").prop("disabled", !0)

				$.ajax({
					url: "/apitopup/pro_alldate_promotion",
					method: 'post',
					data: {
						newdate: 'newdate',
					},
					success: function(data) {

						if (data.stats == true) {
							//$("#promotion_revert").text("รับเงิน"), $("#promotion_revert").prop("disabled", 0)
							Swal.fire({
								icon: 'success',
								title: 'แจ้งเตือน',
								text: data.msg
							}).then((result) => {
								location.reload()
							})

						} else {
							Swal.fire({
								icon: 'error',
								title: 'เกิดข้อผิดพลาด',
								text: data.msg
							}).then((result) => {
								location.reload()
							})
						}
					}
				})



			})


			$('#promotion_revert').click(() => {

				$("#promotion_revert").text("กำลังประมวลผล..."), $("#withdraw").prop("disabled", !0)

				$.ajax({

					url: "api/Promotion",

					method: 'post',

					data: {

						c: 1

					},

					success: function(data) {



						if (data.stats == true) {

							$("#promotion_revert").text("รับเงิน"), $("#promotion_revert").prop("disabled", 0)

							Swal.fire({

								icon: 'success',

								title: 'แจ้งเตือน',

								text: data.msg + " " + data.balance + " บาท"

							}).then((result) => {

								location.reload()

							})



						} else {

							Swal.fire({

								icon: 'error',

								title: 'เกิดข้อผิดพลาด',

								text: data.msg

							}).then((result) => {

								location.reload()

							})

						}

					}

				})



			})

			setInterval(function() {

				$.ajax({

					url: "api/alert_topup",

					method: 'get',

					success: function(data) {

						if (data.status == true) {

							Swal.fire(

								'เติมเงินสำเร็จ !!',

								data.amount + ' บาท',

								'success'

							).then((result) => {

								location.reload()

							})

							$.ajax({

								url: "api/update_alert",

								method: 'post',

								data: {

									id: data.id

								},

								success: function(data) {



								}

							})

						}

					}

				})

			}, 5000);

			setInterval(function() {
				$.ajax({
					url: "api/CheckLogin",
					method: 'get',
					success: function(data) {
						if (data.stats == false) {
							Swal.fire(
								'แจ้งเตือน !',
								'มีการเข้าสู่ระบบซ้อนกัน',
								'warning'
							).then((result) => {
								location.reload()
							})
							$.ajax({
								url: "api/logout",
								method: 'get',
								success: function(data) {}
							})
						}
					}
				})
			}, 10000);
		</script>

		<script>
			$('#ufadeposit').click(() => {
				setInterval(function() {
					$.ajax({
						url: 'apiufa/Balance',
						method: 'get',
						success: function(data) {
							var rr = JSON.parse(data);
							$('.ufabet-credit').html(rr.balance)
						}
					})
				}, 5000);
			})

			$('#ufawithdraw').click(() => {
				setInterval(function() {
					$.ajax({
						url: 'apiufa/Balance',
						method: 'get',
						success: function(data) {
							var rr = JSON.parse(data);
							$('.ufabet-credit').html(rr.balance)
						}
					})
				}, 5000);
			})

			$('body').on('click', '.check-credit', function() {
				$('.check-credit-status').addClass('fa-spin')
				$('.check-turnover-status').addClass('fa-spin')
				$.ajax({
					url: 'apiufa/Balance',
					method: 'get',
					success: function(data) {

						var rr = JSON.parse(data);
						$('.ufabet-credit').html(rr.balance)
						$('.check-credit-status').removeClass('fa-spin')
					}
				})
			})

			$('body').on('click', '.check-turnover', function() {
				$('.check-credit-status').addClass('fa-spin')
				$('.check-turnover-status').addClass('fa-spin')
				$.ajax({
					url: 'apiufa/Balance',
					method: 'get',
					success: function(data) {
						var rr = JSON.parse(data);
						$('.ufabet-credit').html(rr.balance)
						$('.check-credit-status').removeClass('fa-spin')
					}
				})
			})

			$('.check-credit-status2').addClass('fa-spin')
			$.ajax({
				url: 'apiufa/Balance',
				method: 'get',
				success: function(data) {
					var rr = JSON.parse(data);
					$('.ufabet-credit').html(rr.balance)
					$('.check-credit-status2').removeClass('fa-spin')
				}
			})
			$('body').on('click', '.js-change-password', function() {
				changpass($(this))
			})

			function changpass(thisObj) {
				var form = thisObj.closest('.form-password');
				var old_password = form.find('.js-old-password').val();
				var password = form.find('.js-new-password').val();
				var password_confirmation = form.find('.js-confirm-password').val();
				if (password != password_confirmation) {
					Swal.fire({
						icon: 'error',
						title: 'เกิดข้อผิดพลาด',
						text: 'รหัสผ่านไม่ตรงกัน'
					})
				} else if (old_password == "" || password == "" || password_confirmation == "") {
					Swal.fire({
						icon: 'error',
						title: 'เกิดข้อผิดพลาด',
						text: 'กรุณากรอกข้อมูลให้ครบถ้วน'
					})
				} else if (password.length < 8) {
					Swal.fire({
						icon: 'error',
						title: 'เกิดข้อผิดพลาด',
						text: 'รหัสผ่านใหม่น้อยกว่า 8 ตัว'
					})
				} else {
					$.ajax({
						url: 'api/chang_pass',
						method: 'post',
						data: {
							password: $(".js-old-password").val(),
							new_password: $(".js-new-password").val()
						},
						success: function(data) {
							if (data.stats == true) {
								Swal.fire({
									icon: 'success',
									title: 'สำเร็จ',
									text: data.msg
								}).then((result) => {
									window.location.reload();
								});
								var old_password = form.find('.js-old-password').val('')
								var password = form.find('.js-new-password').val('')
								var password_confirmation = form.find('.js-confirm-password').val('')
							} else {
								Swal.fire({
									icon: 'error',
									title: 'เกิดข้อผิดพลาด',
									text: data.msg
								});
							}
						}
					})
				}
			}
		</script>
		<script>
			$('#withdraw').click(() => {
				var money = $('#money_w').val();
				if (money == '') {
					Swal.fire({
						icon: 'error',
						title: 'เกิดข้อผิดพลาด',
						text: 'กรุณากรอกจำนวนเงิน'
					});
				} else if (money < <?= $w_limit ?>) {
					Swal.fire({
						icon: 'error',
						title: 'เกิดข้อผิดพลาด',
						text: 'ถอนเงินขั้นต่ำ <?= $w_limit ?> บาท'
					});
				} else {
					$.ajax({
						url: "Apitopup/Withdraw",
						method: 'post',
						data: {
							money: money
						},
						success: function(data) {
							if (data.status == true) {
								Swal.fire({
									title: 'แจ้งเตือน',
									text: 'ถอนเงินสำเร็จเงินจะเข้าภายใน 3 นาที',
									icon: 'success',
									showCancelButton: false,
									confirmButtonColor: '#3085d6',
									cancelButtonColor: '#d33',
									confirmButtonText: 'OK'
								}).then((result) => {
									window.location.reload();
								});
							} else if (data.status == false) {
								Swal.fire({
									icon: 'error',
									title: 'เกิดข้อผิดพลาด',
									text: data.msg,
									timer: 3000
								});
							}
						}
					})
				}
			})
		</script>
	<?php
	}

	?>


	<script async="" src="https://www.googletagmanager.com/gtag/js?id=UA-154557947-12"></script>
	<script>
		$('#test_api').click(() => {
			$("#test_api").text("กำลังประมวลผล..."), $("#test_api").prop("disabled", !0)
			$.ajax({
				url: '/register/registeradmin/create_user',
				method: 'post',
				data: {
					type: 1
				},
				success: function(data) {
					if (data.status2 == true) {
						Swal.fire({
							title: 'คุณทำรายการ สำเร็จ',
							text: data.msg,
							icon: 'success',
							showCancelButton: false,
							confirmButtonColor: '#3085d6',
							cancelButtonColor: '#d33',
							confirmButtonText: 'OK'
						}).then((result) => {
							window.location.reload();
						});
					} else if (data.status2 == false) {
						Swal.fire({
							icon: 'error',
							title: 'เกิดข้อผิดพลาด',
							text: data.msg,
						}).then((result) => {
							if (result.value) {
								window.location.reload();
							}
						});
					} else if (data.status2 == false) {
						Swal.fire({
							icon: 'error',
							title: 'เกิดข้อผิดพลาด',
							text: data.msg,

						}).then((result) => {
							if (result.value) {
								window.location.reload();
							}
						});
					}
				}
			})
		})
	</script>
	<script>
		$('#withdraw_bonus1').click(() => {
			$("#withdraw_bonus1").text("กำลังประมวลผล..."), $("#withdraw_bonus1").prop("disabled", !0)
			$.ajax({
				url: '/member/point_sell',
				method: 'post',
				data: {
					type: 1
				},
				success: function(data) {
					// alert(data);
					// console.log(data);
					//  console.log(data.status);
					// alert(data);
					if (data.status == true) {
						Swal.fire({
							title: 'คุณทำรายการ สำเร็จ',
							text: data.msg,
							icon: 'success',
							showCancelButton: false,
							confirmButtonColor: '#3085d6',
							cancelButtonColor: '#d33',
							confirmButtonText: 'OK'
						}).then((result) => {
							window.location.reload();
						});
					} else if (data.status == false) {
						Swal.fire({
							icon: 'error',
							title: 'เกิดข้อผิดพลาด',
							text: data.msg,
						}).then((result) => {
							if (result.value) {
								window.location.reload();
							}
						});
					} else if (data.status == false) {
						Swal.fire({
							icon: 'error',
							title: 'เกิดข้อผิดพลาด',
							text: data.msg,

						}).then((result) => {
							if (result.value) {
								window.location.reload();
							}
						});
					}
				}
			})
		})
	</script>
	<script async="" src="https://www.googletagmanager.com/gtag/js?id=UA-154557947-12"></script>
	<script>
		var IS_ANDROID = false;
		var IS_MOBILE = false;
	</script>
	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
	<link rel="dns-prefetch" href="//cdnjs.cloudflare.com">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/fontawesome.min.css" integrity="sha512-shT5e46zNSD6lt4dlJHb+7LoUko9QZXTGlmWWx0qjI9UhQrElRb+Q5DM7SVte9G9ZNmovz2qIaV7IWv0xQkBkw==" crossorigin="anonymous" onload="this.onload=null;this.rel='stylesheet'">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/solid.min.css" integrity="sha512-xIEmv/u9DeZZRfvRS06QVP2C97Hs5i0ePXDooLa5ZPla3jOgPT/w6CzoSMPuRiumP7A/xhnUBxRmgWWwU26ZeQ==" crossorigin="anonymous" onload="this.onload=null;this.rel='stylesheet'">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/regular.min.css" integrity="sha512-1yhsV5mlXC9Ve9GDpVWlM/tpG2JdCTMQGNJHvV5TEzAJycWtHfH0/HHSDzHFhFgqtFsm1yWyyHqssFERrYlenA==" crossorigin="anonymous" onload="this.onload=null;this.rel='stylesheet'">
	<noscript>
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/regular.min.css" integrity="sha512-1yhsV5mlXC9Ve9GDpVWlM/tpG2JdCTMQGNJHvV5TEzAJycWtHfH0/HHSDzHFhFgqtFsm1yWyyHqssFERrYlenA==" crossorigin="anonymous" />
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/solid.min.css" integrity="sha512-xIEmv/u9DeZZRfvRS06QVP2C97Hs5i0ePXDooLa5ZPla3jOgPT/w6CzoSMPuRiumP7A/xhnUBxRmgWWwU26ZeQ==" crossorigin="anonymous" />
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/fontawesome.min.css" integrity="sha512-shT5e46zNSD6lt4dlJHb+7LoUko9QZXTGlmWWx0qjI9UhQrElRb+Q5DM7SVte9G9ZNmovz2qIaV7IWv0xQkBkw==" crossorigin="anonymous" />
	</noscript>
	<script>
		function openNav() {
			document.getElementById("mySidenav").style.width = "300px";
		}

		function closeNav() {
			document.getElementById("mySidenav").style.width = "0";
		}
	</script>
	<script src="<?= $baseurl . $assets ?>/build/runtime.1ba6bf05.js"></script>
	<script src="<?= $baseurl . $assets ?>/build/0.9a86198d.js"></script>
	<script src="<?= $baseurl . $assets ?>/build/home.js?id=156122114"></script>
	<script src="<?= $baseurl . $assets ?>/build/3.02782841.js"></script>
	<script src="<?= $baseurl . $assets ?>/js/jquery.loadingModal.js"></script>
	<script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
	<script src="<?= $baseurl . $assets ?>/js/app.js?id=<?php echo time(); ?>"></script>
	<script src="<?= $baseurl . $assets ?>/js/ufa.js?id=<?php echo time(); ?>"></script>
	<script src="<?= $baseurl . $assets ?>/js/mobile.js?id=57ef7e4ff711266f2358"></script>
	<script src="<?= $baseurl . $assets ?>/js/select2.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
	<script src="<?= $baseurl . $assets ?>/js/jquery.loadingModal.js"></script>
	<script src="<?= $baseurl . $assets ?>/js/apiPort.js"></script>
	<script src="<?= $baseurl . $assets ?>/js/util.js"></script>
	<script src="<?= $baseurl . $assets ?>/js/statusTextRespone.js"></script>
	<script src="<?= $baseurl . $assets ?>/js/superwheel.js"></script> <!-- superWheel -->

	<script>
		function showModal() {
			$('body').loadingModal({
				text: 'กำลังทำรายการ...'
			});
			var delay = function(ms) {
				return new Promise(function(r) {
					setTimeout(r, ms)
				})
			};
			var time = 2000;
			delay(time)
		}

		$.ajax({
			url: 'Apiupdate',
			method: 'get',
			success: function(data) {
				if (data == true) {
					<?php
					$stats = $this->session->userdata('stats');
					if ($stats != 1) {
					?>
						showAlert();
					<?php
					}
					?>
				}
			}
		})
		$('#ufawithdraw').click(() => {

			$.ajax({
				url: 'Apitopup/check_turnover_user',
				method: 'get',
				success: function(data) {
					el('turnover_user') ? el('turnover_user').innerHTML = data.msg.turnover + ' บาท' : ''
				}
			})

		})

		$('#withdraw_mobile').click(() => {

			$.ajax({
				url: 'Apitopup/check_turnover_user',
				method: 'get',
				success: function(data) {
					el('turnover_user') ? el('turnover_user').innerHTML = data.msg.turnover + ' บาท' : ''
				}
			})

		})


		function showAlert() {
			var todayDate = new Date().toISOString().slice(0, 10);
			$.ajax({
				url: 'Apichecktime',
				method: 'get',
				success: function(data) {
					Swal.fire({
						imageUrl: 'https://i.ytimg.com/vi/UCQoJn_4yKg/maxresdefault.jpg',
						title: 'แจ้งเตือนปิดปรับปรุงระบบ',
						html: '<div>แจ้งเตือนปิดปรับปรุงระบบ ในวันที่ [ ' + todayDate + ' วันพุธ]</div>' +
							'<div class="mt-3">ตั้งแต่เวลา 11:00 AM ถึง ' + data.time + ' </div>' +
							'<div class="form-check mt-3">' +
							'<input class="form-check-input js-msg-alert" type="checkbox" value="" id="msg-deposit">' +
							'<label class="form-check-label" for="msg-deposit">' +
							'ไม่ต้องแสดงข้อความนี้อีก' +
							'</label>' +
							'</div>',
						confirmButtonText: 'ปิด'
					}).then((result) => {
						if (result.value && $('.js-msg-alert').is(':checked')) {
							$.get('api/hide_alert')
						}
					})
				}
			})
		}

		var hour = new Date().getHours();
		if (hour >= 23 || hour < 0) {
			Swal.fire(
				'แจ้งเตือน !',
				'ห้ามโอนเงินหรือถอนเงิน เวลา 23.00 - 24.00 ระบบจะไม่อัพยอด',
				'warning'
			)
		}
	</script>
	<script>
		var bank_number21 = parseInt(<?= $bank_info['accnum'] ?>);
		var clipboard4 = new ClipboardJS('.copy-account-number', {
			container: document.getElementById('modal-deposit'),
			text: function(trigger) {
				return '<?= $bank_info['accnum'] ?>';
			}
		});
		clipboard4.on('success', function(e) {
			$('.copy-account-number').text('คัดลอกสำเร็จ')
			setTimeout(function() {
				$('.copy-account-number').text('คัดลอกเลขบัญชี')
			}, 2000)
		});
		var clipboard5 = new ClipboardJS('.copy-accountktb-number', {
			container: document.getElementById('modal-deposit'),
			text: function(trigger) {
				return '<?= $bank_info['accnum_ktb'] ?>';
			}
		});
		clipboard5.on('success', function(e) {
			$('.copy-accountktb-number').text('[ คัดลอกสำเร็จ! ]')
			setTimeout(function() {
				$('.copy-accountktb-number').text('[ คัดลอก ]')
			}, 1000)
		});
		var clipboard3 = new ClipboardJS('.copy-aff', {
			text: function(trigger) {
				return '<?= base_url('aff/' . $info['id']) ?>';
			}
		});
		clipboard3.on('success', function(e) {
			$('.copy-aff').text('[ คัดลอกสำเร็จ! ]')
			setTimeout(function() {
				$('.copy-aff').text('[ คัดลอก ]')
			}, 1000)
		});
	</script>
	<?php if ($user) {  ?>
		<script>
			function setDataTransactionWheel() {
				$.ajax({
					url: 'apwheel/table/<?= $user ?>',
					method: 'get',
					success: function(data) {
						let result = data.data;
						let htm = '';
						for (let i = 0; i < result.length; i++) {
							htm += '<tr>';
							htm += '<td scope="row" class="text-center" style="color:#000;">' + result[i].credit + ' เครดิต</td>';
							htm += '<td scope="row" class="text-center" style="color:#000;">' + result[i].create_date + '</td>';
							htm += '</tr>';
						}
						document.getElementById('transaction_wheel').innerHTML = htm;
						if ($('.modal.show').length < 1) {
							showWheelModal();
						}
					}
				})
			}

			function getDataSpinCan() {
				$.ajax({
					url: 'apwheel/getrole/<?= $user ?>',
					method: 'get',
					success: function(data) {
						if (data.status) {
							document.getElementById('btn_wheelspin').innerHTML = '<button type="button" class="btn btn-primary btn-lg btn-block wheel-horizontal-spin-button">สุ่มวงล้อ</button>';
						} else {
							document.getElementById('btn_wheelspin').innerHTML = '<button type="button" class="btn btn-primary btn-lg btn-block" disabled>วันนี้สุ่มไปแล้ว รอพรุ่งนี้นะคะ</button>';
						}
					}
				})
			}

			function showWheelModal() {
				$('#wheelspin').modal({
					show: true
				});
			}
			$('#wheelspinufa').click(() => {
				<?php if ($setting_w['status'] == 1) { ?>
					setWheel();
					getDataSpinCan();
					setDataTransactionWheel();
				<?php  } else { ?>
					Swal.fire(
						'แจ้งเตือน !',
						'วงล้อยังไม่เปิดใช้บริการ',
						'warning'
					)
				<?php  } ?>
			})
			$('#wheelspinufa_mobile').click(() => {
				<?php if ($setting_w['status'] == 1) { ?>
					setWheel();
					getDataSpinCan();
					setDataTransactionWheel();
				<?php  } else { ?>
					Swal.fire(
						'แจ้งเตือน !',
						'วงล้อยังไม่เปิดใช้บริการ',
						'warning'
					)
				<?php  } ?>

			})

			var tick = new Audio('assets/sound/tick.mp3');
			$(document).on('click', '.wheel-horizontal-spin-button', function(e) {
				if (true) {
					$.ajax({
						url: 'apwheel/getrd/<?= $user ?>',
						method: 'get',
						success: async function(data) {
							await $('.wheel-horizontal').superWheel('start', 'value', data.data.num);
							$(this).prop('disabled', true);

						}
					})
				} else {
					Swal.fire(
						'แจ้งเตือน !',
						'คุณยังไม่ได้ Login!',
						'warning'
					)
				}
			});

			function setWheel() {
				let result = [];
				<?php
				$i = 0;
				foreach ($setting_w_type as $v) {  ?>
					result[<?php echo $i; ?>] = {};
					result[<?php echo $i; ?>] = {
						des: '<?php echo $v['description'] ?>',
						color: '<?php echo $v['color'] ?>',
						credit: '<?php echo $v['value'] ?>',
						value: <?php echo $i++; ?>
					};
				<?php  } ?>
				let slices = [];
				for (let i = 0; i < result.length; i++) {
					slices[i] = {};
					slices[i].background = result[i].color;
					slices[i].text = result[i].credit != 0 ? result[i].credit + ' เครดิต' : 'ไม่ได้เครดิต';
					slices[i].des = result[i].des;
					slices[i].value = result[i].value;
					slices[i].credit = result[i].credit;
				}
				$('.wheel-horizontal').superWheel({
					slices: slices,
					text: {
						color: '<?= $setting_w['text_color'] ?>',
						offset: 8,
						size: <?= $setting_w['text_size'] ?>,
						letterSpacing: 0,
						orientation: '<?= $setting_w['text_type'] ?>',
					},
					line: {
						width: 6,
						color: "<?= $setting_w['line_color'] ?>"
					},
					outer: {
						width: 12,
						color: "<?= $setting_w['outer_color'] ?>"
					},
					inner: {
						width: 2,
						color: "<?= $setting_w['inner_color'] ?>",
					},
					marker: {
						background: "#00BCD4"
					},
					center: {
						width: 30,
						background: '<?= $setting_w['center_color'] ?>',
						rotate: true,
						class: "",
						image: {
							url: "<?= $setting_w['center_img'] ?>",
							width: 45
						}
					},
					selector: "value"
				});

				$('.wheel-horizontal').superWheel('onStart', function(results) {
					$('.wheel-horizontal-spin-button').text('Spinning...');
				});

				$('.wheel-horizontal').superWheel('onStep', function(results) {
					if (typeof tick.currentTime !== 'undefined')
						tick.currentTime = 0;
					tick.play();
				});


				$('.wheel-horizontal').superWheel('onComplete', function(results) {
					let result = '';
					let title = '';
					let icon = '';
					if (results.credit != 0) {
						result = results.des;
						title = 'ยินดีด้วย!';
						icon = 'success';
					} else {
						result = results.des;
						title = 'เสียใจด้วย!';
						icon = 'error';
					}
					Swal.fire({
						type: '',
						icon: icon,
						title: title,
						html: result
					}).then((result) => {
						if (result) {
							document.getElementById('btn_wheelspin').innerHTML = '<button type="button" class="btn btn-primary btn-lg btn-block" disabled>วันนี้สุ่มไปแล้ว รอพรุ่งนี้นะคะ</button>';
							setDataTransactionWheel();
							$.ajax({
								url: 'apiufa/Balance',
								method: 'get',
								success: function(data) {
									var rr = JSON.parse(data);
									$('.ufabet-credit').html(rr.balance)
								}
							})
						}
					});
					$('.wheel-horizontal-spin-button:disabled').prop('disabled', false).text('Spin');
				});
			}
		</script>

		// <script>
			//     $('#game_login_pc_1').click(() => {
			//     $.ajax({
			//         url: 'api/game_notify',
			//         method: 'get',
			//         success: function(data) {
			//         }
			//     })
			// })
			// $('#game_login_pc_2').click(() => {
			//     $.ajax({
			//         url: 'api/game_notify',
			//         method: 'get',
			//         success: function(data) {
			//         }
			//     })
			// })
			// 
		</script>
		<script>
			function setData_powyingshup() {
				<?php if ($setting_pow[0]['status'] == 1) {   ?>
					setDataTransactionPowyingshup();
					$.ajax({
						url: 'appowyingshup/getrole/<?= $user ?>',
						method: 'get',
						success: function(data) {
							document.getElementById('play_pow').innerHTML = data.data[0].powyingshup + ' ครั้ง';
						}
					})
					showPowyingshupModal();
				<?php } else { ?>
					Swal.fire(
						'แจ้งเตือน !',
						'ระบบปิดปรับปรุงชั่วคราว',
						'error'
					)
				<?php } ?>
			}
			// Setting the scores and selecting our HTML elements.
			const buttons = document.querySelectorAll('.selection button');
			const showIcon = document.querySelector('.show i');
			const computerShowIcon = document.querySelector('.computer i');
			// The randomClass array below this contains the rock,paper, and scissor Icon from font-awesome.
			const randomClasses = ["fas fa-hand-rock", "fas fa-hand-paper", "fas fa-hand-scissors"];
			const text = document.getElementById('demo');
			const text2 = document.getElementById('demo2');

			// Game Functionality: Setting forEach function for the buttons.
			const game = () => {
				buttons.forEach(btn => {
					btn.addEventListener('click', (e) => {
						// Random rock paper scissor for the computer and the player
						document.getElementById('rock').disabled = true;
						document.getElementById('paper').disabled = true;
						document.getElementById('scissors').disabled = true;
						$.ajax({
							url: 'appowyingshup/checkrole/<?= $user ?>',
							method: 'get',
							success: function(data) {
								if (data.status) {

									let clickedBtn = e.target.className;
									showIcon.className = clickedBtn;
									let randomNum = Math.floor(Math.random() * randomClasses.length);
									computerShowIcon.className = randomClasses[randomNum];
									// Game Score.
									// If it's a Tie .
									if (showIcon.className === computerShowIcon.className) {
										alert_pow('คุณเสมอ ไม่ได้รับเครดิต', 'warning', 0);
									} else if (showIcon.className === randomClasses[0] && computerShowIcon.className === randomClasses[2]) {
										alert_pow('คุณชนะ ได้รับ ' + data.credit + ' บาท', 'success', 2);
									} else if (showIcon.className === randomClasses[0] && computerShowIcon.className === randomClasses[1]) {
										alert_pow('คุณแพ้ ไม่ได้รับเครดิต', 'error', 1);
									} else if (showIcon.className === randomClasses[1] && computerShowIcon.className === randomClasses[2]) {
										alert_pow('คุณแพ้ ไม่ได้รับเครดิต', 'error', 1);
									} else if (showIcon.className === randomClasses[1] && computerShowIcon.className === randomClasses[0]) {
										alert_pow('คุณชนะ ได้รับ ' + data.credit + ' บาท', 'success', 2);
									} else if (showIcon.className === randomClasses[2] && computerShowIcon.className === randomClasses[0]) {
										alert_pow('คุณแพ้ ไม่ได้รับเครดิต', 'error', 1);
									} else if (showIcon.className === randomClasses[2] && computerShowIcon.className === randomClasses[1]) {
										alert_pow('คุณชนะ ได้รับ ' + data.credit + ' บาท', 'success', 2);
									}
								} else {
									Swal.fire(
										'แจ้งเตือน !',
										'ไม่สามารถเล่นได้ จำนวนครั้งในการเล่นหมดแล้ว',
										'error'
									)
									document.getElementById('rock').disabled = false;
									document.getElementById('paper').disabled = false;
									document.getElementById('scissors').disabled = false;
								}
							}
						})
					});
				});
			}
			// Calling the function.
			game();
			// This function contains all the game logic.

			function alert_pow(msg, icon, type) {
				setTimeout(function() {
					Swal.fire(
						'แจ้งเตือน !',
						msg,
						icon
					)
				}, 500)
				$.ajax({
					url: 'appowyingshup/updateresult',
					method: 'post',
					data: {
						username: '<?= $user ?>',
						type: type
					},
					success: function(data) {
						setData_powyingshup();
						$.ajax({
							url: 'apiufa/Balance',
							method: 'get',
							success: function(data) {
								setDataTransactionPowyingshup();
								var rr = JSON.parse(data);
								$('.ufabet-credit').html(rr.balance)
							}
						})
						document.getElementById('rock').disabled = false;
						document.getElementById('paper').disabled = false;
						document.getElementById('scissors').disabled = false;
					}
				})
			}

			function setDataTransactionPowyingshup() {
				$.ajax({
					url: 'appowyingshup/table/<?= $user ?>',
					method: 'get',
					success: function(data) {
						let result = data.data;
						let htm = '';
						for (let i = 0; i < result.length; i++) {
							htm += '<tr>';
							if (result[i].result == 2) {
								htm += '<td scope="row" class="text-center" style="color:#000;">' + result[i].credit + ' เครดิต</td>';
								htm += '<td scope="row" class="text-center" style="color:green;"> ชนะ </td>';
							} else {
								htm += '<td scope="row" class="text-center" style="color:#000;">0 เครดิต</td>';
								if (result[i].result == 1) {
									htm += '<td scope="row" class="text-center" style="color:#f97d11;"> เสมอ </td>';
								} else {
									htm += '<td scope="row" class="text-center" style="color:red;"> แพ้ </td>';
								}

							}
							htm += '<td scope="row" class="text-center" style="color:#000;">' + result[i].date + '</td>';
							htm += '</tr>';
						}
						document.getElementById('transaction_powyingshup').innerHTML = htm;
					}
				})
			}

			function showPowyingshupModal() {
				$('#powyingshup').modal({
					show: true
				});
			}
		</script>
		<script>
			function receiveBonus(bonus) {
				document.getElementById('fff').innerHTML = '<button class="btn btn-info" style="padding: 2px;" disabled> กรุณารอสักครู่... </button>'
				$.ajax({
					url: 'api/bonusref',
					method: 'post',
					data: {
						usernameUFA: '<?= $user_ufa ?>',
						bonus: bonus,
					},
					success: function(data) {
						if (data.stats == true) {
							Swal.fire({
								icon: 'success',
								title: 'สำเร็จ',
								text: 'รับโบนัส จำนวน ' + data.msg.addcredit + ' บาท เรียบร้อยแล้ว'
							}).then((result) => {
								window.location.reload();
							});
						} else {
							Swal.fire({
								icon: 'error',
								title: 'ไม่สำเร็จ',
								text: 'เกิดข้อผิดพลาดในการรับเครดิต'
							}).then((result) => {
								window.location.reload();
							});
						}
					}
				})
			}
		</script>
	<?php } ?>

</body>

</html>