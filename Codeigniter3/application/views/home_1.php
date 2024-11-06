<!doctype html>

<html lang="en">

<?php



$bank_info = $this->admin_model->bank();

$seting    = $this->admin_model->result_setting();

$webname   = $seting['name_web'];

$line      = $seting['line'];

$d_limit   = $seting['d_limit'];

$w_limit   = $seting['w_limit'];

$baseurl   = base_url();

$data_pro = $this->admin_model->get_promotions();

?>



<head>

	<?php

	$user = $this->session->userdata('user');

	$info = $this->user_model->getdata_user($user);

	if ($user) {



		$color = $this->user_model->get_bank_color($user);

		$ufa   = $this->user_model->user_ufa($user);

		if ($ufa['username'] != '') {



			$user_ufa = $ufa['username'];

			$pass_ufa = $ufa['password'];
		}
	}

	?>



	<meta charset="utf-8">

	<meta http-equiv="X-UA-Compatible" content="IE=edge">

	<!--  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"> -->

	<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">

	<title><?= $webname ?> คาสิโนออนไลน์ แทงบอลออนไลน์ เกมส์บาคาร่าออนไลน์ ฝาก-ถอน 30 วินาที ทุกที่ทุกเวลาตลอด 24ชม.</title>

	<link rel="canonical" href="https://xn--2-zwf7d5cvbn2h.com" />

	<meta property="og:title" content="<?= $webname ?> คาสิโนออนไลน์ แทงบอลออนไลน์ เกมส์บาคาร่าออนไลน์ ฝาก-ถอน 30 วินาที ทุกที่ทุกเวลาตลอด 24ชม." />

	<meta property="og:type" content="ufa36s" />

	<meta property="og:url" content="https://ufa36s.com" />

	<meta property="og:image" content="https://ufa36s.com/image/f3.png" />

	<meta property="og:site_name" content="https://ufa36s.com" />

	<meta property="og:description" content="<?= $webname ?> ตัวแทนตรงจาก UFABET แทงบอลออนไลน์ คาสิโนออนไลน์ บาคาร่า บอล เสือมังกร ไฮโล รูเล็ต สล็อต slot กำถั่ว คาสิโนสด live casino ระบบฝากถอน AUTO 30วินาที ดีที่สุดในไทย" />

	<meta name="twitter:title" content="คาสิโน UFABET | <?= $webname ?> คาสิโนออนไลน์ แทงบอลออนไลน์ เกมส์บาคาร่าออนไลน์ ฝาก-ถอน 30 วินาที">

	<meta name="twitter:description" content="<?= $webname ?> ตัวแทนตรงจาก UFABET แทงบอลออนไลน์ คาสิโนออนไลน์ บาคาร่า บอล เสือมังกร ไฮโล รูเล็ต สล็อต slot กำถั่ว คาสิโนสด live casino ระบบฝากถอน AUTO 30วินาที ดีที่สุดในไทย">

	<meta name="twitter:creator" content="คาสิโนออนไลน์">

	<meta name="twitter:image" content="https://sp99.com/images/website.png">

	<meta name="description" content="<?= $webname ?> ตัวแทนตรงจาก UFABET แทงบอลออนไลน์ คาสิโนออนไลน์ บาคาร่า บอล เสือมังกร ไฮโล รูเล็ต สล็อต slot กำถั่ว คาสิโนสด live casino ระบบฝากถอน AUTO 30วินาที ดีที่สุดในไทย" />

	<meta name="keywords" content="sagame, <?= $webname ?>, คาสิโนออนไลน์, บาคาร่าออนไลน์, บาคาร่า, คาสิโนสด, คาสิโนออนไลน์, sagaming, เสือสังกร, ไฺฮโล, รูเล็ต, สล็อตออนไลน์, เกมส์สล็อตออนไลน์, สล็อต, เกมสล็อต ,กำถั่ว , slot ออนไลน์, slot online, live คาสิโน,  คาสิโน auto ฝากถอน, เล่นคาสิโนออนไลน์, casino sagame, casino sagaming" />

	<!-- Boostrap New -->

	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css">

	<meta http-equiv="X-UA-Compatible" content="IE=edge">

	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

	<link rel="apple-touch-icon" sizes="57x57" href="build/web/ufacoder/img/apple-icon-57x57.png">

	<link rel="apple-touch-icon" sizes="60x60" href="build/web/ufacoder/img/apple-icon-60x60.png">

	<link rel="apple-touch-icon" sizes="72x72" href="build/web/ufacoder/img/apple-icon-72x72.png">

	<link rel="apple-touch-icon" sizes="76x76" href="build/web/ufacoder/img/apple-icon-76x76.png">

	<link rel="apple-touch-icon" sizes="114x114" href="build/web/ufacoder/img/apple-icon-114x114.png">

	<link rel="apple-touch-icon" sizes="120x120" href="build/web/ufacoder/img/apple-icon-120x120.png">

	<link rel="apple-touch-icon" sizes="144x144" href="build/web/ufacoder/img/apple-icon-144x144.png">

	<link rel="apple-touch-icon" sizes="152x152" href="build/web/ufacoder/img/apple-icon-152x152.png">

	<link rel="apple-touch-icon" sizes="180x180" href="build/web/ufacoder/img/apple-icon-180x180.png">

	<link rel="manifest" href="build/web/ufacoder/img/manifest.js">

	<meta name="msapplication-TileColor" content="#ffffff">

	<meta name="msapplication-TileImage" content="/build/web/ufacoder/img/ms-icon-144x144.png">

	<meta name="theme-color" content="#ffffff">

	<meta name="format-detection" content="telephone=no">

	<link rel="stylesheet" href="css/v5-8-1/all.css">

	<!-- <link rel="stylesheet" href="build/web/ufacoder/style.806eb46c.css?id=<?php echo (rand(999999, 999999999999)); ?>"> -->
	<link rel="stylesheet" href="build/web/ufacoder/gold-style.806eb46c.css?id=<?php echo (rand(999999, 999999999999)); ?>">

	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>

	<link rel="stylesheet" href="css/jquery.loadingModal.css">

	<link rel="stylesheet" href="css/styles.css">

	<link rel="stylesheet" href="css/fake.css">

	<link rel="stylesheet" href="css/snow.css?id=456xzca56sdsa4564a11">

	<script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>

	<link rel="stylesheet" href="css/font-awesome.min.css">





	<!-- Success Boostrap New -->

	<!-- Fonts -->

	<!-- <link href="https://fonts.googleapis.com/css?family=Prompt:400,700&display=swap" rel="stylesheet">



    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">



    <link rel="stylesheet" href="css/app.css?id=1c1a79b80a518abb0aacf1">

    <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>

    <script src="js/clipboard.min.js"></script>

    <link rel="stylesheet" href="css/sweetalert2.min.css">

    <link href="css/select2.min.css" rel="stylesheet" />

    <link href="css/select2-bootstrap.css" rel="stylesheet" />

    <script src="js/sweetalert2.min.js"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css"> -->

	<script src="js/clipboard.min.js"></script>
	<script src="https://www.google.com/recaptcha/api.js"></script>

	<script>
		var re_sitekey = "6Lf3sJYaAAAAACMM7j6xoM6gVRH9CGSvEFP-oUeG";
	</script>

	<script src="https://www.google.com/recaptcha/api.js?render=6Lf3sJYaAAAAACMM7j6xoM6gVRH9CGSvEFP-oUeG"></script>

	<style type="text/css">
		.select2-dropdown {

			background-color: #333;

		}



		.select2-search {

			position: absolute;

			opacity: 0;

			z-index: -1;

		}



		.grecaptcha-badge {

			opacity: 0 !important;

		}



		.text-withdraw {

			color: #dc3545 !important;

		}



		.bghead {

			background-color: #000;

			background-image: url(images/bghead.jpg);

			background-position: top;

			background-repeat: no-repeat;

			background-size: 100%;

		}



		#footbg {

			background-color: #000;

			background-position: bottom;

			background-image: url(images/footbg.jpg);

			background-repeat: no-repeat;

			background-size: 100%;

		}



		#tab-content-promotion {

			padding-bottom: 2rem
		}



		#tab-content-manual {

			padding-bottom: 2rem
		}



		#tab-content-event {

			padding-bottom: 2rem
		}



		@-webkit-keyframes bounceInLeft {



			from,

			60%,

			75%,

			90%,

			to {

				-webkit-animation-timing-function: cubic-bezier(0.215, 0.61, 0.355, 1);

				animation-timing-function: cubic-bezier(0.215, 0.61, 0.355, 1);

			}



			0% {

				opacity: 0;

				-webkit-transform: translate3d(-3000px, 0, 0);

				transform: translate3d(-3000px, 0, 0);

			}



			60% {

				opacity: 1;

				-webkit-transform: translate3d(25px, 0, 0);

				transform: translate3d(25px, 0, 0);

			}



			75% {

				-webkit-transform: translate3d(-10px, 0, 0);

				transform: translate3d(-10px, 0, 0);

			}



			90% {

				-webkit-transform: translate3d(5px, 0, 0);

				transform: translate3d(5px, 0, 0);

			}



			to {

				-webkit-transform: translate3d(0, 0, 0);

				transform: translate3d(0, 0, 0);

			}

		}



		@keyframes bounceInLeft {



			from,

			60%,

			75%,

			90%,

			to {

				-webkit-animation-timing-function: cubic-bezier(0.215, 0.61, 0.355, 1);

				animation-timing-function: cubic-bezier(0.215, 0.61, 0.355, 1);

			}



			0% {

				opacity: 0;

				-webkit-transform: translate3d(-3000px, 0, 0);

				transform: translate3d(-3000px, 0, 0);

			}



			60% {

				opacity: 1;

				-webkit-transform: translate3d(25px, 0, 0);

				transform: translate3d(25px, 0, 0);

			}



			75% {

				-webkit-transform: translate3d(-10px, 0, 0);

				transform: translate3d(-10px, 0, 0);

			}



			90% {

				-webkit-transform: translate3d(5px, 0, 0);

				transform: translate3d(5px, 0, 0);

			}



			to {

				-webkit-transform: translate3d(0, 0, 0);

				transform: translate3d(0, 0, 0);

			}

		}



		.bounceInLeft {

			-webkit-animation-name: bounceInLeft;

			animation-name: bounceInLeft;

		}





		@keyframes fadeInUp2 {

			from {

				opacity: 0;

				-webkit-transform: translate3d(0, 100%, 0);

				transform: translate3d(0, 100%, 0);

			}



			to {

				opacity: 1;

				-webkit-transform: translate3d(0, 0, 0);

				transform: translate3d(0, 0, 0);

			}

		}



		.fadeInUp2 {

			-webkit-animation-name: fadeInUp;

			animation-name: fadeInUp;

		}



		@-webkit-keyframes fadeInDown {

			from {

				opacity: 0;

				-webkit-transform: translate3d(0, -100%, 0);

				transform: translate3d(0, -100%, 0);

			}



			to {

				opacity: 1;

				-webkit-transform: translate3d(0, 0, 0);

				transform: translate3d(0, 0, 0);

			}

		}



		@keyframes fadeInDown {

			from {

				opacity: 0;

				-webkit-transform: translate3d(0, -100%, 0);

				transform: translate3d(0, -100%, 0);

			}



			to {

				opacity: 1;

				-webkit-transform: translate3d(0, 0, 0);

				transform: translate3d(0, 0, 0);

			}

		}



		.fadeInDown {

			-webkit-animation-name: fadeInDown;

			animation-name: fadeInDown;

		}



		@-webkit-keyframes bounceInRight {



			from,

			60%,

			75%,

			90%,

			to {

				-webkit-animation-timing-function: cubic-bezier(0.215, 0.61, 0.355, 1);

				animation-timing-function: cubic-bezier(0.215, 0.61, 0.355, 1);

			}



			from {

				opacity: 0;

				-webkit-transform: translate3d(3000px, 0, 0);

				transform: translate3d(3000px, 0, 0);

			}



			60% {

				opacity: 1;

				-webkit-transform: translate3d(-25px, 0, 0);

				transform: translate3d(-25px, 0, 0);

			}



			75% {

				-webkit-transform: translate3d(10px, 0, 0);

				transform: translate3d(10px, 0, 0);

			}



			90% {

				-webkit-transform: translate3d(-5px, 0, 0);

				transform: translate3d(-5px, 0, 0);

			}



			to {

				-webkit-transform: translate3d(0, 0, 0);

				transform: translate3d(0, 0, 0);

			}

		}



		@keyframes bounceInRight {



			from,

			60%,

			75%,

			90%,

			to {

				-webkit-animation-timing-function: cubic-bezier(0.215, 0.61, 0.355, 1);

				animation-timing-function: cubic-bezier(0.215, 0.61, 0.355, 1);

			}



			from {

				opacity: 0;

				-webkit-transform: translate3d(3000px, 0, 0);

				transform: translate3d(3000px, 0, 0);

			}



			60% {

				opacity: 1;

				-webkit-transform: translate3d(-25px, 0, 0);

				transform: translate3d(-25px, 0, 0);

			}



			75% {

				-webkit-transform: translate3d(10px, 0, 0);

				transform: translate3d(10px, 0, 0);

			}



			90% {

				-webkit-transform: translate3d(-5px, 0, 0);

				transform: translate3d(-5px, 0, 0);

			}



			to {

				-webkit-transform: translate3d(0, 0, 0);

				transform: translate3d(0, 0, 0);

			}

		}



		.bounceInRight {

			-webkit-animation-name: bounceInRight;

			animation-name: bounceInRight;

		}



		.animatedtext {

			-webkit-animation-name: x-box-main;

			animation-name: x-box-main;

			-webkit-animation-duration: 3s;

			animation-duration: 3s;

			-webkit-animation-iteration-count: infinite;

			animation-iteration-count: infinite;

		}



		.animatedtext2 {

			-webkit-animation-name: x-box-main;

			animation-name: x-box-main;

			-webkit-animation-duration: 2s;

			animation-duration: 2s;

			-webkit-animation-iteration-count: infinite;

			animation-iteration-count: infinite;

		}



		.animatedtext3 {

			-webkit-animation-name: x-box-up;

			animation-name: x-box-up;

			-webkit-animation-duration: 3.5s;

			animation-duration: 3.5s;

			-webkit-animation-iteration-count: infinite;

			animation-iteration-count: infinite;

		}



		.animatedtext4 {

			-webkit-animation-name: x-box-main;

			animation-name: x-box-main;

			-webkit-animation-duration: 3.5s;

			animation-duration: 3.5s;

			-webkit-animation-delay: .7s;

			animation-delay: .7s;

			-webkit-animation-iteration-count: infinite;

			animation-iteration-count: infinite;

		}



		.bottomleft {

			position: absolute;

			bottom: 8px;

			left: 16px;

			font-size: 18px;

		}



		@media (max-width: 991.98px) {

			.beamer_defaultBeamerSelector {

				max-height: unset;

			}

		}



		.beamer_defaultBeamerSelector {

			padding: .12rem;

			position: fixed;

			top: 75%;

			left: 5px;

			z-index: 2;

			overflow: unset;

			border: 2px solid #fff;

			border-radius: 50%;

			bottom: unset;

			box-shadow: 0 0 10px 0 hsla(0, 0%, 100%, .8);

			margin-right: 7px;

		}



		#contact-line {

			color: #ab0078;

		}



		#changpasshola {

			color: #e8aa00;

		}



		#logouthola {

			color: #d94a4b;

		}



		#copyaccnum1,

		#copyaccnum2,

		#withdraw,

		#login_m {

			background: rgb(150, 150, 150);

			color: #fff;

		}
	</style>

	<script>
		function myFunction() {

			var x = document.getElementById('panel');

			if (x.style.display === 'none') {



				x.style.display = 'block';

			} else {

				x.style.display = 'none';



			}

		}
	</script>

	<!--  <script type="text/javascript">



    window.onload = function() {



        document.addEventListener("contextmenu", function(e){



            e.preventDefault();



        }, false);



        document.addEventListener("keydown", function(e) {



            //document.onkeydown = function(e) {



            // "F12" key



            if (event.keyCode == 123) {



                disabledEvent(e);



            }



        }, false);



        function disabledEvent(e){



            if (e.stopPropagation){



                e.stopPropagation();



            } else if (window.event){



                window.event.cancelBubble = true;



            }



            e.preventDefault();



            return false;



        }



    };



    </script>



    <script type="text/javascript">



        let div = document.createElement('div');



        let loop = setInterval(() => {



            console.log(div);



            console.clear();



        });



        Object.defineProperty(div, "id", {



            get: () => {



                clearInterval(loop);



                window.location = "api/logout";



            }



        });



    </script> -->

</head>



<body>



	<div class="snowflakes" aria-hidden="true">

		<div class="snowflake">

			<img width="20" height="20" src="/imgs/snow/star.png">

		</div>

		<!--<div class="snowflake">-->

		<!--<img width="20" height="20" src="/imgs/snow/snowflakes_1.png">-->

		<!--</div>-->

		<div class="snowflake">

			<img width="20" height="20" src="/imgs/snow/star.png">

		</div>

		<!--<div class="snowflake">-->

		<!--<img width="20" height="20" src="/imgs/snow/snowflakes_3.png">-->

		<!--</div>-->

		<div class="snowflake">

			<img width="40" height="40" src="/imgs/snow/star.png">

		</div>

		<!--<div class="snowflake">-->

		<!--<img width="20" height="20" src="/imgs/snow/snowflakes_5.png">-->

		<!--</div>-->

		<div class="snowflake">

			<img width="20" height="20" src="/imgs/snow/star.png">

		</div>

		<!--<div class="snowflake">-->

		<!--<img width="20" height="20" src="/imgs/snow/snowflakes_7.png">-->

		<!--</div>-->

		<div class="snowflake">

			<img width="40" height="40" src="/imgs/snow/star.png">

		</div>

		<!--<div class="snowflake">-->

		<!--<img width="20" height="20" src="/imgs/snow/snowflakes_9.png">-->

		<!--</div>-->

		<div class="snowflake">

			<img width="20" height="20" src="/imgs/snow/star.png">

		</div>

		<!--<div class="snowflake">-->

		<!--<img width="20" height="20" src="/imgs/snow/snowflakes_4.png">-->

		<!--</div>-->

		<div class="snowflake">

			<img width="40" height="40" src="/imgs/snow/star.png">

		</div>

		<!--<div class="snowflake">-->

		<!--<img width="20" height="20" src="/imgs/snow/snowflakes_7.png">-->

		<!--</div>-->

		<div class="snowflake">

			<img width="20" height="20" src="/imgs/snow/star.png">

		</div>



		<?php

		if (!$user) {

		?>

			<nav class="x-header navbar bg-transparent navbar-expand-lg -anon">

				<div class="container align-items-center">

					<div id="headerBrand">

						<a class="navbar-brand">

							<img class="-logo mt-1 mt-md-0" src="image/f3.png" alt="">

						</a>

					</div>



					<div id="headerContent">

						<ul class="navbar-nav ml-auto">

							<div class="d-flex">

								<!-- <a href="" target="_blank" class="btn btn-primary d-lg-block d-none mt-3 mr-3">



						</a> -->



								<button type="button" class="-header-login-btn btn btn-primary px-4 px-lg-5 mt-lg-3" style="border: 2px solid #FDD741;box-shadow: 0 0 10px #FDD741;" data-toggle="modal" data-target="#loginModal">
									เข้าสู่ระบบ
								</button>

							</div>

						</ul>

					</div>

				</div>

			</nav>

		<?php

		} else {

		?>

			<nav class="x-header navbar bg-transparent navbar-expand -logged py-0">

				<div class="container align-items-center">

					<div id="headerBrand">

						<a class="navbar-brand">

							<img class="-logo mt-1 mt-md-0" src="image/f3.png" alt="">

						</a>

					</div>



					<div id="headerContent">

						<ul class="navbar-nav ml-auto">



							<script>
								function addClassshow() {

									var v = document.getElementById("mobliemenu");

									var v2 = document.getElementById("overlayshow");

									v.classList.add("show");

									v2.classList.add("show");

								}



								function removeClassshow2() {

									var v = document.getElementById("mobliemenu");

									var v2 = document.getElementById("overlayshow");

									v.classList.remove("show");

									v2.classList.remove("show");

								}
							</script>



							<div class="x-logged">

								<div class="d-flex dropdown -logged-container">



									<div class="py-3 px-3 px-lg-4 --profile">



										<!--       <div class="d-flex">

                                <div class="mr-2 d-flex js-logged-sidebar">

                                    <div class="x-profile-image">

                                        <img class="img-fluid mb-1" src="build/web/ufacoder/img/profile_icon_level_021.png" alt="icon deposit white">

                                    </div>

                                </div>

                                

                                <div class="d-flex flex-column m-auto --profile-detail">

                                    <div class="text-lg-right f-7 js-logged-sidebar"><?= $user ?></div>

                                    <div class="text-primary -user-balance text-nowrap">

                                        <span>

                                        <span class="ufabet-credit">0.00</span>

                                        </span>

                                        <button type="button" class="btn btn-link p-0" id="btn-customer-balance-reload" onclick="window.location.reload();">

                                        <i class="fas fa-sync-alt text-white f-9"></i>

                                        </button>

                                    </div>

                                    <div class="flex-column text-white js-logged-sidebar mt-1 d-sm-inline-block d-none" style="font-size: 18px; "><i class="fas fa-bars"></i>

                                เมนูสมาชิก</div>

                                <div class="d-sm-none d-inline-block">

                                <a class="flex-column text-white js-logged-sidebar mt-1 d-sm-none d-inline-block" onclick="addClassshow()" style="font-size: 18px; "><i class="fas fa-bars"></i>

                                เมนูสมาชิก</a></div>

                                </div>



                        </div> -->

										<div class="d-flex">

											<div class="mr-2 d-flex js-logged-sidebar">

												<div class="x-profile-image d-sm-inline-block d-none">

													<img class="img-fluid mb-1" src="build/web/ufacoder/img/profile_icon_level_021.png" alt="icon deposit white">

												</div>

												<div class="x-profile-image d-sm-none d-inline-block" onclick="addClassshow()">

													<img class="img-fluid mb-1" src="build/web/ufacoder/img/profile_icon_level_021.png" alt="icon deposit white">

												</div>

											</div>



											<div class="d-flex flex-column m-auto --profile-detail">

												<div class="text-lg-right f-7 js-logged-sidebar d-sm-inline-block d-none"><?= $user ?></div>

												<div class="text-lg-right f-7 js-logged-sidebar d-sm-none d-inline-block" onclick="addClassshow()"><?= $user ?></div>

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

												<div class="flex-column text-white js-logged-sidebar mt-1 d-sm-inline-block d-none" style="font-size: 18px; "><i class="fas fa-bars"></i>

													เมนูสมาชิก</div>

												<div class="d-sm-none d-inline-block">

													<a class="flex-column text-white js-logged-sidebar mt-1 d-sm-none d-inline-block" onclick="addClassshow()" style="font-size: 18px; "><i class="fas fa-bars"></i>

														เมนูสมาชิก</a>

												</div>

											</div>



										</div>

										<div class="dropdown-content">

											<div class="x-profile-dropdown-menu px-3">

												<ul class="navbar-nav">

													<li class="nav-item">

														<a href="#" class="nav-link js-close-sidebar" data-toggle="modal" data-target="#modal-userinfo">

															<i class="fas fa-address-card mr-3 f-9"></i>ข้อมูลบัญชี

														</a>

													</li>

													<!--     <li class="nav-item">

                                            <a href="#promotionModal-active" class="nav-link js-close-sidebar" data-toggle="modal" data-target="#promotionModal">

                                                <i class="fas fa-history mr-3 f-9"></i>ประวัติโปรโมชั่นของคุณ

                                            </a>

                                        </li> -->

													<li class="nav-item">

														<a href="#refModal-active" class="nav-link js-close-sidebar" data-toggle="modal" data-target="#refModal">

															<i class="fas fa-user-friends  mr-3 f-9"></i> แนะนำเพื่อน รับโบนัส

														</a>

													</li>

													<li class="nav-item">

														<a href="#modal-promotion" class="nav-link js-close-sidebar" data-toggle="modal" data-target="#modal-promotion">

															<i class="fas fa-bullhorn  mr-3 f-9"></i> โปรฝากต่อเนื่อง
														</a>



													</li>
													<li class="nav-item">

														<a href="#modal-promotion_register" class="nav-link js-close-sidebar" data-toggle="modal" data-target="#modal-promotion_register">

															<i class="fas fa-bullhorn  mr-3 f-9"></i> โปร สมัครสมาชิกใหม่
														</a>



													</li>
													<li class="nav-item">

														<a href="#modal-promotion_datenew" class="nav-link js-close-sidebar" data-toggle="modal" data-target="#modal-promotion_datenew">

															<i class="fas fa-bullhorn  mr-3 f-9"></i> โปร ฝากแรกของวัน
														</a>



													</li>
													<li class="nav-item">

														<a href="#" class="nav-link js-close-sidebar" data-toggle="modal" data-target="#modal-history">

															<i class="fas fa-history mr-3 f-9"></i>ประวัติการทำรายการ

														</a>

													</li>

													<!--  <li class="nav-item">

                                            <a href="#promotionModal-active" class="nav-link js-close-sidebar" data-toggle="modal" data-target="#promotionModal">

                                                <i class="fas fa-user-friends  mr-3 f-9"></i> โปรโมชั่น ที่คุณได้รับ

                                            </a>

                                        </li> -->

													<!--     <li class="nav-item">

                                            <a href="#promotion-active" class="nav-link js-close-sidebar" data-toggle="modal" data-target="#joinPromotionModal">

                                                <i class="fas fa-gift mr-3 f-9"></i>ย้าย เครดิตเข้าเล่น

                                            </a>

                                        </li> -->



													<li class="nav-item js-close-sidebar">

														<a href="#" class="nav-link js-require-confirm" onclick="logoutufa()" title="Logout" title="ออกจากระบบ"><i class="fas fa-sign-out-alt mr-3 f-9"></i>ออกจากระบบ</a>

														<!--   <a href="#" class="nav-link js-require-confirm" onclick="event.preventDefault();

                                            document.getElementById('logout-form').submit();" title="Logout" title="ออกจากระบบ"><i class="fas fa-sign-out-alt mr-3 f-9"></i>ออกจากระบบ</a> -->

													</li>

												</ul>

											</div>

										</div>

									</div>







									<div class="--deposit d-none d-lg-block">

										<a href="#" class="text-white" id="ufadeposit" data-toggle="modal" data-target="#modal-deposit">

											<div class="d-flex flex-column justify-content-center h-100 px-3">

												<img class="img-fluid mt-2" src="build/web/ufacoder/img/ic_deposit_white2.png" alt="icon deposit white" width="35">

												<div class="f-7 mt-1">ฝากเงิน</div>

											</div>

										</a>

									</div>



									<div class="--withdraw d-none d-lg-block">

										<a href="#" class="text-white" id="ufawithdraw" data-toggle="modal" data-target="#modal-withdraw">

											<div class="d-flex flex-column justify-content-center  h-100 px-3">

												<img class="img-fluid mt-2" src="build/web/ufacoder/img/ic_withdraw_white2.png" alt="icon deposit white" width="35">

												<div class="f-7 mt-1">ถอนเงิน</div>

											</div>

										</a>

									</div>

								</div>

							</div>

						</ul>

					</div>

				</div>

			</nav>

		<?php

		}

		?>

		<div id="main__content" class="x-main-content-container">

			<!-- <div id="main__content" class="bghead"> -->

			<section class="x-index-top-container">

				<div class="-bg-container">

					<img src="build/web/ufacoder/img/bg-allcasino-1.png" alt="icon chip" class="-bg-1">

					<img src="build/web/ufacoder/img/bg-allcasino-2.png" alt="icon chip" class="-bg-2">

					<img src="build/web/ufacoder/img/bg-allcasino-3.png" alt="icon chip" class="-bg-3">

				</div>

				<div class="x-contact-us 1">

					<div class="-line-container">

						<a href="https://line.me/R/ti/p/<?= $line ?>" target="_blank">

							<img src="build/web/ufacoder/img/ic_line.png" alt="ติดต่อเรา" class="-img-default">

							<img src="build/web/ufacoder/img/ic_line_hover.png" alt="ติดต่อเรา" class="-img-hover">

						</a>

					</div>

					<div class="-line-detail-container">

						<a href="https://line.me/R/ti/p/<?= $line ?>" target="_blank">

							Line : https://line.me/R/ti/p/<?= $line ?> </a>

					</div>

				</div>

				<div class="container -inner-wrapper">

					<div>

						<div class="-title animated fadeInUp" data-animatable="fadeInUp" data-delay="500">

							<img src="build/web/ufacoder/img/logo.gif" alt="All Casino logo" class="-logo-title">

						</div>

						<div style="margin-bottom: 1rem;">

							<h2 data-animatable="fadeInUp" data-delay="500" class="text-white mt-2 mb-0 h5 -sub-title text-center font-weight-normal animated fadeInUp">ระบบออโต้ ฝาก-ถอน 30วิ มีแอดมินดูแล 24 ชม.</h2>

						</div>

					</div>



					<?php

					if (!$user) {

					?>

						<div class="row mt-3 -btn-actions justify-content-center animated fadeInUp" data-animatable="fadeInUp" data-delay="700">

							<div class="col-7 col-sm-5 col-lg-3">

								<!-- <button type="button" class="btn btn-primary btn-block -register-button bounceInLeft animated" data-toggle="modal" data-target="#RegisterModal">สมัครสมาชิก

								</button> -->

								<a href="#" data-toggle="modal" data-target="#RegisterModal" class="-btn -register-btn">
									<div class="-fake-bg"></div>
									<img src="./build/web/sa-allbet2/img/btn-register-bg.png" class="-bg-img" width="320" height="95" alt="Allbet button image background png">
									<span class="-text">สมัครสมาชิก</span>
								</a>

							</div>

						</div>



					<?php

					} else {

					?>

						<?php

						if ($ufa['username'] != '') {

						?>

							<div class="row mt-3 -btn-actions justify-content-center animated fadeInUp" data-animatable="fadeInUp" data-delay="700">



								<div class="col-7 col-sm-5 col-lg-3">

									<a href="game" target="_blank" class="btn btn-primary btn-block -demo-top-button">

										<img src="./build/web/ufacoder/img/ic-blackjack.png" alt="UFA Exclusive blackjack png" class="-icon-blackjack">

										ทางเข้า คาสิโน UFA

									</a>

								</div>

							</div>

						<?php

						} else {

						?>

							<div class="row mt-3 -btn-actions justify-content-center animated fadeInUp" data-animatable="fadeInUp" data-delay="700">



								<div class="col-7 col-sm-5 col-lg-3">

									<a href="#" class="btn btn-primary btn-block -demo-top-button" onclick="Swal.fire({ icon: 'error',title: 'เกิดข้อผิดพลาด',text: 'กรุณาฝากเงินเพื่อเปิดยูส ก่อนเข้าเล่น'})">

										<img src="build/web/ufacoder/img/ic-blackjack2.png" alt="UFA Exclusive blackjack png" class="-icon-blackjack">

										ทางเข้า คาสิโน UFA

									</a>

								</div>

							</div>

						<?php

						}

						?>

						<div style="padding-top: 6rem; text-align: center;">

							<div class="x-service-wrapper">

								<div class="container mb-5">

									<div class="row m-auto justify-content-center">

										<div class="col-11 col-sm-9 col-md-4 mb-lg-0 mb-2 text-center -box d-flex align-items-start d-md-block -box">

											<a href="#0" class="d-flex flex-md-column flex-row" data-toggle="modal" data-target="#modal-deposit">

												<div class="-ic-wrapper">

													<img src="build/web/ufacoder/img/ic_deposit_withdraw2.png" alt="icon register" class="-ic-register">

												</div>

												<div class="text-left text-md-center">

													<h3 class="text-gray-lighter"><span class="d-inline-block d-md-none">1.</span> ฝาก - ถอน เร็ว</h3>

													<hr class="x-hr-border-glow">



													<span class="d-none d-lg-block text-muted-lighter f-5">รวดเร็วทันใจ <br> สนุกได้ทุกเวลา</span>

													<span class="d-block d-lg-none text-muted-lighter f-5">รวดเร็วทันใจ สนุกได้ทุกเวลา</span>

												</div>

											</a>

										</div>

										<div class="col-11 col-sm-9 col-md-4 mb-lg-0 mb-2 text-center -box d-flex align-items-start d-md-block -box">

											<a href="http://line.me/ti/p/~<?= $line ?>" id="contact-line" target="_blank" class="d-flex flex-md-column flex-row">

												<div class="-ic-wrapper">

													<img src="build/web/ufacoder/img/ic_service_24_72.png" alt="icon register" class="-ic-otp">

												</div>

												<div class="text-left text-md-center">

													<h3 class="text-gray-lighter"><span class="d-inline-block d-md-none">2.</span> บริการลูกค้า</h3>

													<hr class="x-hr-border-glow">



													<span class="d-none d-lg-block text-muted-lighter f-5">บริการด้วยใจ <br> พร้อมดูแล 24 ชั่วโมง</span>

													<span class="d-block d-lg-none text-muted-lighter f-5">บริการด้วยใจ พร้อมดูแล 24 ชั่วโมง</span>

												</div>

											</a>

										</div><a href="http://line.me/ti/p/~<?= $line ?>" id="contact-line" target="_blank" class="d-flex flex-md-column flex-row">

										</a>

										<div class="col-12 col-sm-12 col-md-4 mb-lg-0 mb-2 text-center -box d-flex align-items-start d-md-block -box">

											<a id="yt-linl" class="d-flex flex-md-column flex-row" href="https://www.youtube.com/embed/GI6oru9pesw?autoplay=1">

												<div class="-ic-wrapper">

													<img src="build/web/ufacoder/img/ic_consistency2.png" alt="icon register" class="-ic-bank">

												</div>

												<div class="text-left text-md-center">

													<h3 class="text-gray-lighter"><span class="d-inline-block d-md-none">3.</span> ความมั่นคง</h3>

													<hr class="x-hr-border-glow">



													<span class="d-none d-lg-block text-muted-lighter f-5">เท่าไหร่ก็จ่าย <br> ไม่มีลิมิตต่อวัน</span>

													<span class="d-block d-lg-none text-muted-lighter f-5">เท่าไหร่ก็จ่าย ไม่มีลิมิตต่อวัน</span>

												</div>

											</a>

										</div>

									</div>

								</div>

							</div>

						</div>

					<?php

					}

					?>



					<?php

					if (!$user) {

					?>



						<div id="vd" class="row mt-5 justify-content-center animated fadeInUp" data-animatable="fadeInUp" data-delay="700" style="width: 580; height: 326px;">

							<iframe width="580" height="326" src="https://www.youtube.com/embed/GI6oru9pesw?autoplay=1" frameborder="0" allow=" autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen=""></iframe>

						</div>

					<?php

					}

					?>

			</section>

			<section>

				<div class="x-index-tab-container">

					<div class="container">

						<ul class="nav nav-tabs x-tab py-3">

							<img src="build/web/ufacoder/img/line-long-glow.png" alt="Line long glow png" class="-line-glow">



							<li class="nav-item  active -index js-tab-scrolled" id="tab-index">

								<a data-toggle="tab" href="#tab-content-index" class="nav-link active">

									<img src="build/web/ufacoder/img/tab_index.png" alt="logo_index" class="-ic"><br>

									<span class="d-sm-none d-inline-block mt-2 text-gray-lighter">ufa36s</span>

									<span class="d-sm-inline-block d-none mt-2 text-gray-lighter">ufa36s</span>

									<hr class="x-hr-border-glow mb-0">

								</a>

							</li>



							<li class="nav-item   -promotion js-tab-scrolled" id="tab-promotion">

								<a data-toggle="tab" href="#tab-content-promotion" class="nav-link ">

									<img src="build/web/ufacoder/img/tab_promotion.png" alt="logo_promotion" class="-ic"><br>

									<span class="d-sm-none d-inline-block mt-2 text-gray-lighter">โปรโมชั่น</span>

									<span class="d-sm-inline-block d-none mt-2 text-gray-lighter">โปรโมชั่น</span>

									<hr class="x-hr-border-glow mb-0">

								</a>

							</li>



							<li class="nav-item   -manual js-tab-scrolled" id="tab-manual">

								<a data-toggle="tab" href="#tab-content-manual" class="nav-link ">

									<img src="build/web/ufacoder/img/tab_manual.png" alt="logo_manual" class="-ic"><br>

									<span class="d-sm-none d-inline-block mt-2 text-gray-lighter">แนะนำ</span>

									<span class="d-sm-inline-block d-none mt-2 text-gray-lighter">แนะนำการใช้งาน</span>

									<hr class="x-hr-border-glow mb-0">

								</a>

							</li>

							<li class="nav-item   -event js-tab-scrolled" id="tab-event">

								<a data-toggle="tab" href="#tab-content-event" class="nav-link ">

									<img src="build/web/ufacoder/img/tab_event.png" alt="logo_event" class="-ic"><br>


									<span class="d-sm-inline-block d-none mt-2 text-gray-lighter">กิจกรรม</span>
									<span class="d-sm-none d-inline-block mt-2 text-gray-lighter">กิจกรรม</span>


									<hr class="x-hr-border-glow mb-0">

								</a>

							</li>

						</ul>

					</div>



					<div class="tab-content">

						<div class="tab-pane active" id="tab-content-index">

							<div class="x-tab-index">

								<div class="container">

									<div class="row">

										<div class="col-lg-6 -description">

											<div class="-logo-wrapper">



											</div>

											<h3>คาสิโนออนไลน์ที่ให้บริการ Casino Online ยอดนิยมครบจบที่สุดในไทย</h3>

											<p>มีให้ท่านหลายแบรนด์ ทั้ง SA Gaming, Sexy Gaming, Dream Casino และ AG Casino, คาสิโนสดมากมาย เกมสล็อต และ เดิมพันกีฬา รวบรวมผู้ให้บริการระดับโลกมาอยู่ในมือของท่าน แบบ All-In-One ให้ท่านได้สนุก ครบ จบ ในที่เดียว ภายใต้การดูแลบริการตลอด 24 ชั่วโมง</p>

										</div>

										<div class="col-lg-6 text-center position-relative">

											<div class="-bg-lighting-gift">

												<img src="build/web/ufacoder/img/bg_lighting_gift.png" alt="" class="img-fluid ">

											</div>

											<div class="-snippet-container">

												<img src="build/web/ufacoder/img/box-up.png" alt="" class="-banner -box-up">

												<img src="build/web/ufacoder/img/box-main.png" alt="" class="-banner -box-main">

												<img src="build/web/ufacoder/img/box-coin-1.png" alt="" class="-banner -box-coin-1">

												<img src="build/web/ufacoder/img/box-coin-2.png" alt="" class="-banner -box-coin-2">

												<img src="build/web/ufacoder/img/box-sign-1.png" alt="" class="-banner -box-sign-1">

												<img src="build/web/ufacoder/img/box-sign-2.png" alt="" class="-banner -box-sign-2">

											</div>

										</div>

									</div>

								</div>





								<div class="-middle-wrapper">

									<div class="container">

										<h2 class="-title">ขั้นตอนการสมัครสมาชิก ufa36s</h2>

										<div class="row -box-wrapper">

											<div class="col-md-4">

												<div class="-box">

													<div class="-content">

														<img src="build/web/ufacoder/img/ic_register.png" alt="icon png" class="-ic-register">

														<div class="-desc-wrap">

															<div class="-title">1. สมัครสมาชิก</div>

															<div class="-description">กรอกเบอร์โทรศัพท์ของคุณให้ถูกต้อง</div>

														</div>

													</div>

												</div>

											</div>

											<div class="col-md-4">

												<div class="-box">

													<div class="-content">

														<img src="build/web/ufacoder/img/ic_otp.png" alt="icon png" class="-ic-otp">

														<div class="-desc-wrap">

															<div class="-title">2. ใส่เลขบัญชีธนาคารของคุณ</div>

															<div class="-description">กรอกเลขบัญชีธนาคารของคุณให้ถูกต้องเพราะระบบจะตรวจสอบชื่อบัญชีของคุณ</div>

														</div>

													</div>

												</div>

											</div>

											<div class="col-md-4">

												<div class="-box">

													<div class="-content">

														<img src="build/web/ufacoder/img/ic_bank.png" alt="icon png" class="-ic-bank">

														<div class="-desc-wrap">

															<div class="-title">3. ใส่รหัสผ่านและไอดีไลน์ของคุณ</div>

															<div class="-description">ตั้งรหัสผ่านและกรอกไอดีไลน์ของคุณ จากนั้น เข้าร่วมสนุกกับ <span class="text-warning">ufa36s</span> ได้ทันที</div>

														</div>

													</div>

												</div>

											</div>

										</div>

									</div>

								</div>

								<div class="-before-bottom-wrapper">

									<div class="container-fluid px-0 -middle-content-bg-outer" style="background-image: url('build/web/ufacoder/img/bg_index_middle_content5.png')">

										<div class="container">

											<div class="-middle-header text-center col-md-8 col-sm-10 m-auto">

												<h2 class="-title">Play Smart, Play ufa36s</h2>

												<div class="-sub-title">เปิดประสบการณ์สนุกไปอีกขั้น กับคาสิโนออนไลน์ที่เหนือระดับ ทางเลือกของคนยุคใหม่ ที่จะทำให้คุณบอกลาเว็ปแบบเดิมๆ เพลิดเพลินไปกับการเดิมพันได้อย่างมั่นใจ เล่นทั้งที เล่นเว็บตรง CASINO ตัวจริงต้อง ออลล์คาสิโนเท่านั้น</div>

											</div>

											<div class="row -middle-content text-center">

												<div class="col-md-4 col-10 -middle-content-bg-inner">

													<img class="img-fluid -img-element -item-1 animatedtext3" src="build/web/ufacoder/img/index_middle_element_01.png" alt="image png">

													<div class="-content"> บริการคาสิโนสดและสล็อตชั้นนำการันตี รวดเร็ว มั่นคง ปลอดภัย เท่าไหร่ก็จ่าย</div>

												</div>

												<div class="col-md-4 col-10 -middle-content-bg-inner">

													<img class="img-fluid -img-element -item-2 animatedtext4" src="build/web/ufacoder/img/index_middle_element_02.png" alt="image png">

													<div class="-content">โปรโมชั่นดี พร้อมฝ่ายบริการมืออาชีพคอยดูแลทักได้ตลอด 24ชั่วโมง โปรดีๆ เครดิตฟรี มีทุกวัน!</div>

												</div>

												<div class="col-md-4 col-10 -middle-content-bg-inner">

													<img class="img-fluid -img-element -item-3 animatedtext2" src="build/web/ufacoder/img/index_middle_element_03.png" alt="image png">

													<div class="-content">ให้ความสำคัญกับความปลอดภัย และ ความเป็นส่วนตัวของท่านให้คุณสบายใจ มีเวลาไปชนะมากขึ้นกับเกมส์คาสิโนของเรา</div>

												</div>

											</div>

										</div>

									</div>

								</div>



							</div>

						</div>



						<div class="tab-pane" id="tab-content-promotion">

							<div class="container text-center py-3">

								<h3 class="text-white">โปรโมชั่น</h3>

								<!--<img width="300" src="/image/0001.jpg" data-toggle="collapse" data-target="#demo2">-->
								<!--<div class="row text-center pt-2">-->
								<!--	<div class="col-sm-12">-->
								<!--		<button type="button" class="btn btn-success" data-toggle="collapse" data-target="#demo2">รายละเอียด</button>-->
								<!--	</div>-->
								<!--</div>-->


								<!--<div id="demo2" class="collapse">-->
								<!--	<h2>👉โปรสมาชิกใหม่🎉</h2>-->
								<!--	<h3>...เงื่อนไข...</h3>-->
								<!--	<h4>👉1.แจ้งพนักงานเพื่อรับโปรสมาชิกใหม่</4>-->
								<!--		<h4>👉2.โปรนี้เล่นได้ เฉพาะ คาสิโน และ สล๊อต</h2>-->
								<!--			<h4>👉3.สามารถขอรับสิทธิได้ 1 ครั้ง</h2>-->
								<!--				<h4>👉4.ทำเทริน์โอเวอร์ 15 เท่า</h2>-->
								<!--</div>-->

								<!--<img width="300" src="/image/0002.jpg" data-toggle="collapse" data-target="#demo">-->
								<!--<div class="row text-center pt-2">-->
								<!--	<div class="col-sm-12">-->
								<!--		<button type="button" class="btn btn-success" data-toggle="collapse" data-target="#demo">รายละเอียด</button>-->
								<!--	</div>-->
								<!--</div>-->


								<!--<div id="demo" class="collapse">-->
								<!--	<h2>👉โปรโมชั่นเดือนเกิด🎉</h2>-->
								<!--	<h3>...เงื่อนไข...</h3>-->
								<!--	<h4>👉1.แสดงบัตรที่ชื่อตรงกับยูสที่สมัคร</4>-->
								<!--		<h4>👉2.เดือนเกิดของสมาชิกต้องตรงกับเดือนนั้นๆ</h2>-->
								<!--			<h4>👉3.สามารถขอรับสิทธิได้ 1 ครั้ง วันไหนก็ได้ของเดือนเกิด</h2>-->
								<!--				<h4>โดยแจ้งที่เจ้าหน้าที่ ขอรับโปรเดือนเกิด...</h2>-->
								<!--					<h4>👉4.ต้องเคยฝากมาเล่นกับทางเว็ปรวมแล้วอย่างน้อย 300-</h2>-->
								<!--</div>-->

								<!--<img width="300" src="/image/0003.jpg" data-toggle="collapse" data-target="#demo1">-->
								<!--<div class="row text-center pt-2">-->
								<!--	<div class="col-sm-12">-->
								<!--		<button type="button" class="btn btn-success" data-toggle="collapse" data-target="#demo1">รายละเอียด</button>-->
								<!--	</div>-->
								<!--</div>-->

								<!--<div id="demo1" class="collapse">-->
								<!--	<h2>👉โปรโมชั่นคืนยอดเสีย🎉</h2>-->
								<!--	<h3>...เงื่อนไข...</h3>-->
								<!--	<h4>👉1.รับโบนัสคืนยอดเสียได้มากถึง 5%</h4>-->
								<!--	<h4>👉2.ยอดโบนัสนี้สมาชิก-->
								<!--		สามารถถอนออกหรือเล่นได้ทันที-->
								<!--		โดยไม่ต้องทำเทรินใดๆ</h4>-->
								<!--	<h4>👉3.🔴รับโบนัสคืนยอดเสียได้สูงสุดที่ 1000-🔴</h4>-->
								<!--	<h4>👉4.ยอดเสียจะคืนทุกสิ้นเดือนของเดือนนั้นๆ</h4>-->

								<!--</div>-->




							</div>

						</div>

						<!-- เริ่มแนะนำการใช้งาน -->

						<div class="tab-pane" id="tab-content-manual">

							<div class="x-tab-manual">

								<div class="container -container-wrapper">

									<ul class="nav nav-tabs -tabs d-flex justify-content-center">

										<li class="nav-item  active -register" id="tab-register">

											<a data-toggle="tab" href="#tab-content-register" class="nav-link active">

												วิธีการสมัคร

											</a>

										</li>

										<li class="nav-item   -deposit" id="tab-deposit">

											<a data-toggle="tab" href="#tab-content-deposit" class="nav-link">

												วิธีการฝากเงิน

											</a>

										</li>

										<li class="nav-item   -withdraw" id="tab-withdraw">

											<a data-toggle="tab" href="#tab-content-withdraw" class="nav-link">

												วิธีการถอนเงิน

											</a>

										</li>

									</ul>

									<div class="tab-content text-center mt-4 ">

										<div class="tab-pane x-video-container active" id="tab-content-register">

											<div class="x-service-wrapper mt-5 pt-lg-5">

												<div class="row justify-content-center">

													<div class="col-11 col-sm-9 col-md-4 -manual text-center -box d-flex align-items-start d-md-block -box">

														<a href="#0" class="d-flex flex-md-column flex-row" data-toggle="modal" data-target="#RegisterModal">

															<div>

																<img src="build/web/sa-allbet2/img/ic_register_phone.png" alt="service icon" class="-ic-register" width="100" height="100">

															</div>

															<div class="text-left text-md-center">

																<h3 class="text-gray-lighter"><span class="d-inline-block d-md-none"></span>สมัครสมาชิก</h3>

																<hr class="x-hr-border-glow">

																<span class="d-none d-lg-block text-muted-lighter f-5">กรอกเบอร์โทรศัพท์มือถือ ของคุณให้ถูกต้อง</span>

																<span class="d-block d-lg-none text-muted-lighter f-5">กรอกเบอร์โทรศัพท์มือถือ ของคุณให้ถูกต้อง</span>

															</div>

														</a>

													</div>

													<div class="col-11 col-sm-9 col-md-4 -manual text-center -box d-flex align-items-start d-md-block -box">

														<div>

															<img src="build/web/sa-allbet2/img/ic_register_otp.png" alt="service icon" class="-ic-otp" width="100" height="100">

														</div>

														<div class="text-left text-md-center">

															<h3 class="text-gray-lighter"><span class="d-inline-block d-md-none"></span>กรอกเลขบัญชีธนาคาร</h3>

															<hr class="x-hr-border-glow">

															<span class="d-none d-lg-block text-muted-lighter f-5">กรอกเลข บัญชีธนาคาร เพื่อยืนยันตัวตน</span>

															<span class="d-block d-lg-none text-muted-lighter f-5">กรอกเลข บัญชีธนาคาร เพื่อยืนยันตัวตน</span>

														</div>

													</div>

													<div class="col-11 col-sm-9 col-md-4 -manual text-center -box d-flex align-items-start d-md-block -box">

														<div>

															<img src="build/web/sa-allbet2/img/ic_register_password.png" alt="service icon" class="-ic-bank" width="100" height="100">

														</div>

														<div class="text-left text-md-center">

															<h3 class="text-gray-lighter"><span class="d-inline-block d-md-none"></span>กรอกรหัสผ่าน</h3>

															<hr class="x-hr-border-glow">

															<span class="d-none d-lg-block text-muted-lighter f-5">กรอกรหัสผ่านของคุณพร้อมชื่อให้ถูกต้อง พร้อมเข้าร่วมกับ ufa36s ได้ทันที !</span>

															<span class="d-block d-lg-none text-muted-lighter f-5">กรอกรหัสผ่านของคุณพร้อมชื่อให้ถูกต้อง พร้อมเข้าร่วมกับ ufa36s ได้ทันที !</span>

														</div>

													</div>

												</div>

												<!-- <div id="vd" class="row mt-5 justify-content-center animated fadeInUp" data-animatable="fadeInUp" data-delay="700" style="width: 580; height: 326px;">

                                                    <iframe width="580" height="326" src="https://www.youtube.com/embed/D0wDnEG4Jpg" frameborder="0" allowfullscreen=""></iframe>

                                                </div> -->

												<div data-coin-hunt-lazy="#tab-manual" data-url="/_ajax_/coin-hunting/lazy/manual_tab"></div>

											</div>

										</div>

										<div class="tab-pane x-video-container" id="tab-content-deposit">

											<div class="x-service-wrapper mt-5 pt-lg-5">

												<div class="row justify-content-center">

													<div class="col-11 col-sm-9 col-md-4 -manual text-center -box d-flex align-items-start d-md-block -box">

														<a href="#0" class="d-flex flex-md-column flex-row" data-toggle="modal" data-target="#depositModal">

															<div>

																<img src="build/web/sa-allbet2/img/ic_step_deposit.png" alt="service icon" class="-ic" width="100" height="100">

															</div>

															<div class="text-left text-md-center">

																<h3 class="text-gray-lighter"><span class="d-inline-block d-md-none"></span>กด "ฝากเงิน"</h3>

																<hr class="x-hr-border-glow">

																<span class="d-none d-lg-block text-muted-lighter f-5">กดไปที่เมนนูฝากเงิน<br class="d-none d-lg-block">เพื่อทำการฝาก</span>

																<span class="d-block d-lg-none text-muted-lighter f-5">กดไปที่เมนนูฝากเงิน<br class="d-none d-lg-block">เพื่อทำการฝาก</span>

															</div>

														</a>

													</div>

													<div class="col-11 col-sm-9 col-md-4 -manual text-center -box d-flex align-items-start d-md-block -box">

														<div>

															<img src="build/web/sa-allbet2/img/ic_step_deposit_add.png" alt="service icon" class="-ic" width="100" height="100">

														</div>

														<div class="text-left text-md-center">

															<h3 class="text-gray-lighter"><span class="d-inline-block d-md-none"></span>โอนเงิน</h3>

															<hr class="x-hr-border-glow">

															<span class="d-none d-lg-block text-muted-lighter f-5">จากนั้น กด "คัดลอกเลขบัญชี"<br class="d-none d-lg-block">เพื่อฝากยอดเงิน</span>

															<span class="d-block d-lg-none text-muted-lighter f-5">จากนั้น กด "คัดลอกเลขบัญชี"<br class="d-none d-lg-block">เพื่อฝากยอดเงิน</span>

														</div>

													</div>

													<div class="col-11 col-sm-9 col-md-4 -manual text-center -box d-flex align-items-start d-md-block -box">

														<div>

															<img src="build/web/sa-allbet2/img/ic_step_deposit_done.png" alt="service icon" class="-ic" width="100" height="100">

														</div>

														<div class="text-left text-md-center">

															<h3 class="text-gray-lighter"><span class="d-inline-block d-md-none"></span>กด"โอนแล้ว"</h3>

															<hr class="x-hr-border-glow">

															<span class="d-none d-lg-block text-muted-lighter f-5">จากนั้นให้คุณรอ 30 วินาที<br class="d-none d-lg-block">เพื่อให้ระบบตรวจสอบยอดเงิน และพร้อมเข้าเล่นทันที</span>

															<span class="d-block d-lg-none text-muted-lighter f-5">จากนั้นให้คุณรอ 30 วินาที<br class="d-none d-lg-block">เพื่อให้ระบบตรวจสอบยอดเงิน และพร้อมเข้าเล่นทันที</span>

														</div>

													</div>

												</div>

												<div id="vd" class="row mt-5 justify-content-center animated fadeInUp" data-animatable="fadeInUp" data-delay="700" style="width: 580; height: 326px;">

													<iframe width="580" height="326" src="https://www.youtube.com/embed/GI6oru9pesw" frameborder="0" allowfullscreen=""></iframe>

												</div>

												<div data-coin-hunt-lazy="#tab-manual" data-url="/_ajax_/coin-hunting/lazy/manual_tab"></div>

											</div>

										</div>

										<div class="tab-pane  x-video-container" id="tab-content-withdraw">

											<div class="x-service-wrapper mt-5 pt-lg-5">

												<div class="row justify-content-center">

													<div class="col-11 col-sm-9 col-md-4 -manual text-center -box d-flex align-items-start d-md-block -box">

														<a href="#0" class="d-flex flex-md-column flex-row" data-toggle="modal" data-target="#withdrawModal">

															<div>

																<img src="build/web/sa-allbet2/img/ic_step_withdraw.png" alt="service icon" class="-ic" width="100" height="100">

															</div>

															<div class="text-left text-md-center">

																<h3 class="text-gray-lighter"><span class="d-inline-block d-md-none"></span>กด "ถอนเงิน"</h3>

																<hr class="x-hr-border-glow">

																<span class="d-none d-lg-block text-muted-lighter f-5">กด "ถอนเงิน"</span>

																<span class="d-block d-lg-none text-muted-lighter f-5">กด "ถอนเงิน"</span>

															</div>

														</a>

													</div>

													<div class="col-11 col-sm-9 col-md-4 -manual text-center -box d-flex align-items-start d-md-block -box">

														<div>

															<img src="build/web/sa-allbet2/img/ic_step_withdraw_done.png" alt="service icon" class="-ic" width="100" height="100">

														</div>

														<div class="text-left text-md-center">

															<h3 class="text-gray-lighter"><span class="d-inline-block d-md-none"></span>กรอกจำนวนเงิน</h3>

															<hr class="x-hr-border-glow">

															<span class="d-none d-lg-block text-muted-lighter f-5">กรอกจำนวนเงินที่ต้องการถอน</span>

															<span class="d-block d-lg-none text-muted-lighter f-5">กรอกจำนวนเงินที่ต้องการถอน</span>

														</div>

													</div>

													<!--</div>-->

													<!--<div id="vd" class="row mt-5 justify-content-center animated fadeInUp" data-animatable="fadeInUp" data-delay="700" style="width: 580; height: 326px;">-->

													<!--    <iframe width="580" height="326" src="https://www.youtube.com/embed/oLcx5Nw34mk" frameborder="0" allowfullscreen=""></iframe>-->

													<!--</div>-->

													<div data-coin-hunt-lazy="#tab-manual" data-url="/_ajax_/coin-hunting/lazy/manual_tab"></div>

												</div>


											</div>

										</div>

										<!-- จบแนะนำการใช้งาน -->

										<!-- เริ่มทางเข้าเล่นคาสิโน -->

										<div class="x-tab-index">

											<div class="-bottom-wrapper" style="background-image: url('build/web/ufacoder/img/bg_index_lobby4.png')">

												<div class="container">

													<div class="-lobby-header text-center">

														<a>ทางเข้าเล่นคาสิโน</a>

														<div>All CAINO ตัวจริง SA Gaming ︱Sexy Gaming︱WM Casino︱DG Casino︱AG Casino</div>

													</div>

													<div class="-lobby-logo-section">

														<ul class="-nav-container-casino">

															<li class="-nav-item">

																<img src="build/admin/img/lobby_main/sa-gaming-logo-circle.png" class="-logo" alt="sa-gaming logo png">

															</li>

															<li class="-nav-item">

																<img src="build/admin/img/lobby_main/wm-logo-circle.png" class="-logo" alt="wm logo png">

															</li>

															<li class="-nav-item">

																<img src="build/admin/img/lobby_main/bbin-logo-circle.png" class="-logo" alt="bbin logo png">

															</li>

															<li class="-nav-item">

																<img src="build/admin/img/lobby_main/sexy-bac-logo-circle.png" class="-logo" alt="sexy-bac logo png">

															</li>

															<li class="-nav-item">

																<img src="build/admin/img/lobby_main/netent-live-logo-circle.png" class="-logo" alt="netent-live logo png">

															</li>

															<li class="-nav-item">

																<img src="build/admin/img/lobby_main/dream-gaming-logo-circle.png" class="-logo" alt="dream-gaming logo png">

															</li>

															<li class="-nav-item">

																<img src="build/admin/img/lobby_main/asia-gaming-logo-circle.png" class="-logo" alt="asia-gaming logo png">

															</li>

														</ul>

														<ul class="-nav-container-slot">

															<li class="-nav-item">

																<img src="build/admin/img/lobby_main/skill-game-cover-vertical.png" class="-logo" alt="skill-game logo png">

																<img src="build/admin/img/lobby_main/skill-game-logo-horizontal.png" class="-logo mt-2" alt="skill-game logo png">

															</li>

															<li class="-nav-item">

																<img src="build/admin/img/lobby_main/evo-play-cover-vertical.png" class="-logo" alt="evo-play logo png">

																<img src="build/admin/img/lobby_main/evo-play-logo-horizontal.png" class="-logo mt-2" alt="evo-play logo png">

															</li>

															<li class="-nav-item">

																<img src="build/admin/img/lobby_main/netent-slot-cover-vertical.png" class="-logo" alt="netent-slot logo png">

																<img src="build/admin/img/lobby_main/netent-slot-logo-horizontal.png" class="-logo mt-2" alt="netent-slot logo png">

															</li>

															<li class="-nav-item">

																<img src="build/admin/img/lobby_main/sp-cover-vertical.png" class="-logo" alt="sp logo png">

																<img src="build/admin/img/lobby_main/sp-logo-horizontal.png" class="-logo mt-2" alt="sp logo png">

															</li>

															<li class="-nav-item">

																<img src="build/admin/img/lobby_main/habanero-cover-vertical.png" class="-logo" alt="habanero logo png">

																<img src="build/admin/img/lobby_main/habanero-logo-horizontal.png" class="-logo mt-2" alt="habanero logo png">

															</li>

															<li class="-nav-item">

																<img src="build/admin/img/lobby_main/joker-cover-vertical.png" class="-logo" alt="joker logo png">

																<img src="build/admin/img/lobby_main/joker-logo-horizontal.png" class="-logo mt-2" alt="joker logo png">

															</li>

															<li class="-nav-item">

																<img src="build/admin/img/lobby_main/ps-cover-vertical.png" class="-logo" alt="ps logo png">

																<img src="build/admin/img/lobby_main/ps-logo-horizontal.png" class="-logo mt-2" alt="ps logo png">

															</li>

														</ul>

														<ul class="-nav-container-other">

															<li class="-nav-item">

																<img src="build/admin/img/lobby_main/pinnacle-cover-vertical.png" class="-logo" alt="pinnacle logo png">

																<img src="build/admin/img/lobby_main/pinnacle-logo-horizontal.png" class="-logo mt-2" alt="pinnacle logo png">

															</li>

															<li class="-nav-item">

																<img src="build/admin/img/lobby_main/imsb-cover-vertical.png" class="-logo" alt="imsb logo png">

																<img src="build/admin/img/lobby_main/imsb-logo-horizontal.png" class="-logo mt-2" alt="imsb logo png">

															</li>

														</ul>

													</div>

												</div>

											</div>

										</div>

										<!-- จบทางเข้าเล่นคาสิโน -->

									</div>

								</div>

							</div>

						</div>

						<div class="tab-pane " id="tab-content-event">

							<div class="container text-center py-3">

								<h3 class="text-white">กิจกรรม</h3>

								<span class="text-white">ยังไม่มีข้อมูลในส่วนนี้</span>

							</div>

						</div>

			</section>

		</div>

		<?php

		if ($user) {

		?>

			<div class="x-logged-sidebar-mobile">

				<div class="-inner-wrapper" id="mobliemenu">

					<div class="-heading d-flex align-items-center justify-content-between p-3">

						<img src="/image/f3.png" alt="Sa Gaming logo">

						<a onclick="removeClassshow2();">

							<i class="fas fa-times text-primary js-close-sidebar"></i></a>

					</div>



					<div class="px-3">

						<div class="x-profile-dropdown-menu px-3">

							<ul class="navbar-nav">

								<li class="nav-item">

									<a href="#modal-userinfo" class="nav-link js-close-sidebar" onclick="removeClassshow2();" data-toggle="modal" data-target="#modal-userinfo">



										<i class="fas fa-address-card mr-3 f-7"></i>
										<span>ข้อมูลบัญชี</span>



									</a>

								</li>

								<li class="nav-item">

									<a href="#modal-deposit" class="nav-link js-close-sidebar" id="ufadeposit" onclick="removeClassshow2();" data-toggle="modal" data-target="#modal-deposit">



										<i class="fas fa-credit-card mr-3 f-8"></i>



										<span>ฝากเงิน</span>



									</a>

								</li>

								<li class="nav-item">

									<a href="#modal-withdraw" class="nav-link js-close-sidebar" id="ufawithdraw" onclick="removeClassshow2();" data-toggle="modal" data-target="#modal-withdraw">



										<i class="fas fa-bank mr-3 f-7"></i>



										<span>ถอนเงิน</span>



									</a>

								</li>

								<li class="nav-item">

									<a href="#refModal" class="nav-link js-close-sidebar" onclick="removeClassshow2();" data-toggle="modal" data-target="#refModal">



										<i class="fas fa-user-plus  mr-3 f-8"></i>



										<span>แนะนำเพื่อน รับโบนัส</span>



									</a>

								</li>
								<li class="nav-item">

									<a href="#modal-promotion_register" class="nav-link js-close-sidebar" onclick="removeClassshow2();" data-toggle="modal" data-target="#modal-promotion_register">



									
										<i class="fab fa-affiliatetheme mr-3 f-8"></i>


										
										<span>โปรโมชั่น สมัครสมาชิก ครั้งแรก</span>


									</a>

								</li>
								<li class="nav-item">

									<a href="#modal-promotion_datenew" class="nav-link js-close-sidebar" onclick="removeClassshow2();" data-toggle="modal" data-target="#modal-promotion_datenew">



										
										<i class="fas fa-air-freshener mr-3 f-8"></i>


										

										<span>โปรโมชั่น ฝากครั้งแรกของวัน</span>

									</a>

								</li>
								<li class="nav-item">

									<a href="#modal-promotion" class="nav-link js-close-sidebar" onclick="removeClassshow2();" data-toggle="modal" data-target="#modal-promotion">



										<i class="fas fa-bullhorn  mr-3 f-8"></i>


										<span>โปรฝากต่อเนื่อง</span>



									</a>

								</li>

								<li class="nav-item">

									<a href="#modal-history" class="nav-link js-close-sidebar" onclick="removeClassshow2();" data-toggle="modal" data-target="#modal-history">



										<i class="fas fa-history mr-3 f-6"></i>



										<span>ประวัติการทำรายการ</span>



									</a>

								</li>







								<li class="nav-item js-close-sidebar">

									<!-- <a href="#" class="nav-link js-require-confirm" onclick="event.preventDefault();

                                            document.getElementById('logout-form').submit();" title="Logout" title="ออกจากระบบ"><i class="fas fa-sign-out-alt mr-4 f-7"></i>ออกจากระบบ</a> -->

									<a href="#" class="nav-link js-require-confirm" onclick="logoutufa()" title="Logout" title="ออกจากระบบ"><i class="fas fa-sign-out-alt mr-4 f-7"></i>ออกจากระบบ</a>

								</li>

							</ul>

						</div>

					</div>

				</div>



				<div class="-overlay js-close-sidebar" id="overlayshow" onclick="removeClassshow2();"></div>

			</div>

		<?php

		}

		?>

		<div class="x-modal modal" id="alertModal" tabindex="-1" role="dialog" aria-hidden="true" data-loading-container=".js-modal-content" data-ajax-modal-always-reload="true">

			<div class="modal-dialog modal-dialog-centered -modal-size " role="document">

				<div class="modal-content -modal-content">

					<img src="build/web/ufacoder/img/border-modal.png" class="img-fluid d-lg-block d-none -border-top-modal" alt="">

					<button type="button" class="close f-1" data-dismiss="modal" aria-label="Close">

						<span aria-hidden="true">×</span>

					</button>

					<div class="modal-header border-bottom-0 mt-3 pb-0 d-flex flex-column-reverse">

						<h3 class="x-title-modal font-weight-normal d-inline-block m-auto text-white">

							<span>แจ้งเตือน</span>

							<hr class="x-hr-border-glow">

						</h3>

					</div>

					<div class="modal-body">

						<div class="text-center mb-3">

							<img src="build/web/ufacoder/img/ic_check.png" alt="SUCCESS" width="90px" class="js-ic-success img-fluid">

							<img src="build/web/ufacoder/img/ic_cross.png" alt="FAIL" width="90px" class="js-ic-fail img-fluid">

						</div>

						<div class="js-modal-content text-primary text-center f-4">

						</div>

					</div>

					<img src="build/web/ufacoder/img/border-modal.png" class="img-fluid d-lg-block d-none -border-bottom-modal" alt="">

				</div>

			</div>

		</div>





		<div class="x-modal modal" id="get_bank" tabindex="-1" role="dialog" aria-hidden="true" data-loading-container=".js-modal-content" data-ajax-modal-always-reload="true">

			<div class="modal-dialog modal-dialog-centered -modal-size" role="document">

				<div class="modal-content -modal-content">

					<img src="build/web/ufacoder/img/border-modal.png" class="img-fluid d-lg-block d-none -border-top-modal" alt="">

					<button type="button" class="close f-1" data-dismiss="modal" aria-label="Close">

						<span aria-hidden="true">&times;</span>

					</button>

					<div class="modal-header border-bottom-0 mt-3 pb-0 d-flex flex-column-reverse">

						<h3 class="m-auto text-white d-inline-block">

							กรอก เลขบัญชีธนาคาร

							<hr class="x-hr-border-glow">

						</h3>

					</div>

					<div class="modal-body">

						<div class="x-login-form">

							<div data-animatable="fadeInModal" data-offset="0" class="-animatable-container animated fadeInModal">



								<div class="-x-input-icon mb-3 flex-column">

									<img src="build/web/ufacoder/img/phone.png" class="-icon" alt="login" width="20">

									<input type="text" id="bank_number" name="bank_number" class="form-control x-form-control" placeholder="เลขบัญชีธนาคาร">

								</div>

								<select id="select" class="form-control">

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

									<!--   <option value="cimb">ซีไอเอ็มบีไทย</option>

                        <option value="ghb">อาคารสงเคราะห์</option>

                        <option value="hsbc">ฮ่องกงและเซี่ยงไฮ้</option>

                        <option value="icbc">ไอซีบีซี</option>

                        <option value="isbt">อิสลามแห่งประเทศไทย</option>

                        <option value="kkp">เกียรตินาคิน</option>

                        <option value="mizuho">มิซูโฮ</option>

                        <option value="scbt">สแตนดาร์ดชาร์เตอร์ด</option>

                        <option value="smbc">ซูมิโตโม</option> -->

									<option value="tcd">ไทยเครดิต</option>

									<option value="lhb">แลนด์แอนด์เฮ้าส์</option>

									<option value="baac">เพื่อการเกษตรและสหกรณ์การเกษตร</option>

								</select>





								<div class="text-center">

									<button type="button" style="background:rgb(150,150,150); color:#fff;" class="btn btn-primary -submit my-lg-3 my-0 f-5 f-lg-6" id="get_name" onclick="get_name()">

										<span>ถัดไป</span>

									</button>

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

					<img src="build/web/ufacoder/img/border-modal.png" class="img-fluid d-lg-block d-none -border-bottom-modal" alt="">

				</div>

			</div>

		</div>







		<div class="x-modal modal" id="loginModal" tabindex="-1" role="dialog" aria-hidden="true" data-loading-container=".js-modal-content" data-ajax-modal-always-reload="true">

			<div class="modal-dialog modal-dialog-centered -modal-size " role="document">

				<div class="modal-content -modal-content">

					<img src="build/web/ufacoder/img/border-modal.png" class="img-fluid d-lg-block d-none -border-top-modal" alt="">

					<button type="button" class="close f-1" data-dismiss="modal" aria-label="Close">

						<span aria-hidden="true">×</span>

					</button>

					<div class="modal-header border-bottom-0 mt-3 pb-0 d-flex flex-column-reverse">

						<h3 class="m-auto text-white d-inline-block">

							เข้าสู่ระบบ

							<hr class="x-hr-border-glow">

						</h3>

					</div>

					<div class="modal-body">

						<div class="x-login-form">

							<div data-animatable="fadeInModal" data-offset="0" class="-animatable-container animated fadeInModal">

								<form id="login-form" class="js-login-form x-header-login-form">

									<input name="modal_login" type="hidden" value="1">



									<div class="-x-input-icon mb-3 flex-column">

										<img src="build/web/ufacoder/img/ic_phone.png" class="-icon" alt="login" width="12">

										<input type="text" id="phone" name="phone" pattern="[0-9]*" autofocus="" class="form-control x-form-control" placeholder="เบอร์โทรศัพท์">

									</div>



									<div class="-x-input-icon flex-column">

										<img src="build/web/ufacoder/img/ic_lock_input.png" class="-icon" alt="password" width="13">

										<input id="password_m" type="password" class="form-control x-form-control" name="password_m" pattern="[a-zA-Z0-9.+#_,$-]+" placeholder="รหัสผ่าน">



									</div>



									<div class="d-flex justify-content-center form-group mt-3 ">

										<button type="submit" id='login_m' class="btn btn-primary -submit mt-2 f-5 f-lg-6">เข้าสู่ระบบ</button>

									</div>

								</form>





								<!-- <p class="text-center">

                            <a href="#" class="text-white reset-password-link">ลืมรหัสผ่าน?</a>

                        </p> -->

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

					<img src="build/web/ufacoder/img/border-modal.png" class="img-fluid d-lg-block d-none -border-bottom-modal" alt="">

				</div>

			</div>

		</div>





		<div class="x-modal modal" id="register_Modal" tabindex="-1" role="dialog" aria-hidden="true" data-loading-container=".js-modal-content" data-ajax-modal-always-reload="true">

			<div class="modal-dialog modal-dialog-centered  -modal-size" role="document">

				<div class="modal-content -modal-content">

					<img src="build/web/ufacoder/img/border-modal.png" class="img-fluid d-lg-block d-none -border-top-modal" alt="">

					<button type="button" class="close f-1" data-dismiss="modal" aria-label="Close">

						<span aria-hidden="true">&times;</span>

					</button>

					<div class="modal-header border-bottom-0 mt-3 pb-0 d-flex flex-column-reverse">

						<h3 class="m-auto text-white d-inline-block">

							สมัครสมาชิก

							<hr class="x-hr-border-glow">

						</h3>

					</div>

					<div class="modal-body">

						<div class="x-login-form">

							<div data-animatable="fadeInModal" data-offset="0" class="-animatable-container animated fadeInModal">

								<div class="-x-input-icon mb-3 flex-column">

									<img src="build/web/ufacoder/img/user.png" class="-icon" alt="login" width="20">

									<input type="text" id="fname" name="fname" class="form-control x-form-control" placeholder="ชื่อ">

								</div>



								<!-- <div class="-x-input-icon mb-3 flex-column">

						<img src="build/web/ufacoder/img/user.png" class="-icon" alt="login" width="20">

						<input type="text"

						id="username"

						name="username"

						class="form-control x-form-control" placeholder="ชื่อผู้ใช้">

					</div> -->



								<div class="-x-input-icon mb-3 flex-column">

									<img src="build/web/ufacoder/img/password.png" class="-icon" alt="login" width="20">

									<input type="password" id="r_password" name="r_password" placeholder="รหัสผ่าน" class="form-control x-form-control">

								</div>



								<div class="-x-input-icon mb-3 flex-column">

									<img src="build/web/ufacoder/img/password.png" class="-icon" alt="login" width="20">

									<input type="password" id="r_password2" name="r_password2" placeholder="ยืนยันรหัสผ่าน" class="form-control x-form-control">

								</div>



								<div class="-x-input-icon mb-3 flex-column">

									<img src="build/web/ufacoder/img/password.png" class="-icon" alt="login" width="20">

									<input type="text" id="line" name="line" placeholder="ไอดีไลน์" class="form-control x-form-control">

								</div>





								<div class="-x-input-icon mb-3 flex-column" style="display: none;">

									<img src="build/web/ufacoder/img/gift.png" class="-icon" alt="login" width="20">

									<select id="select_promotion" class="form-control">



										<option selected value="0">ไม่รับโปรโมชั่น</option>



										<?php $promotion = $this->admin_model->get_promotions();

										foreach ($promotion as $v) { ?>

											<option value="<?= $v['id'] ?>"> เติมเงินรับ <?= $v['percen'] ?>% ทำเทิร์น <?= $v['x'] ?> เท่า </option> <?php } ?>



									</select>









								</div>



								<div class="text-center">

									<button type="button" style="background:rgb(150,150,150); color:#fff;" class="btn btn-primary -submit my-lg-3 my-0 f-5 f-lg-6" onclick="register()">

										<span>ยืนยัน</span>

									</button>

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

					<img src="build/web/ufacoder/img/border-modal.png" class="img-fluid d-lg-block d-none -border-bottom-modal" alt="">

				</div>

			</div>

		</div>





		<div class="x-modal modal" id="RegisterModal" tabindex="-1" role="dialog" aria-hidden="true" data-loading-container=".js-modal-content" data-ajax-modal-always-reload="true">

			<div class="modal-dialog modal-dialog-centered  -modal-size " role="document" style="min-height: 100px;">

				<div class="modal-content -modal-content">

					<img src="build/web/ufacoder/img/border-modal.png" class="img-fluid d-lg-block d-none -border-top-modal" alt="">

					<button type="button" class="close f-1" data-dismiss="modal" aria-label="Close">

						<span aria-hidden="true">×</span>

					</button>

					<div class="modal-header border-bottom-0 mt-3 pb-0 d-flex flex-column-reverse">

						<h3 class="m-auto text-white d-inline-block">

							กรอก เบอร์มือถือ

							<hr class="x-hr-border-glow">

						</h3>

					</div>

					<div class="modal-body">

						<div class="x-login-form">

							<div data-animatable="fadeInModal" data-offset="0" class="-animatable-container animated fadeInModal">





								<div id='form'>



									<div class="box-content-100" id='box'>



										<div class="box-content-desc ">

											<!-- add images -->

											<img src="images/register-icon2.png" class="mx-auto d-block register-icon" width="100px" height="100px" alt="register-icon">

											<p class="text-center mt-2" id="alert">

												เบอร์โทรศัพท์มือถือ

											</p>

											<!-- end-add images -->

											<div class="form-group mt-1 mb-2">



												<div class="-x-input-icon mb-3 flex-column">

													<img src="build/web/ufacoder/img/phone.png" class="-icon" alt="login" width="20">

													<input type="text" id="phone_otp" name="phone_otp" class="form-control x-form-control" placeholder="เบอร์มือถือ">

												</div>



											</div>



											<div class="d-flex justify-content-center mt-3">

												<button type="submit" style="background:rgb(150,150,150); color:#fff;" class="btn btn-primary btn-block -submit" onclick="check_phone()">ถัดไป</button>

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

					<img src="build/web/ufacoder/img/border-modal.png" class="img-fluid d-lg-block d-none -border-bottom-modal" alt="">

				</div>

			</div>

		</div>





		<script id="b-loading" type="text/template">

		</script>

		<script id="loading" type="text/template">

		</script>

		<footer class="x-footer py-3" style="background-color: #352a13;">

			<div class="-inner-wrapper pt-4">

				<div class="x-footer-bank-logo">

					<div class="container">

						<div class="-wrapper">

							<div class="-ic -ic-1" style="background: url('build/web/ufacoder/img/ic-bank-logo.png')"></div>

							<div class="-ic -ic-2" style="background: url('build/web/ufacoder/img/ic-bank-logo.png')"></div>

							<div class="-ic -ic-3" style="background: url('build/web/ufacoder/img/ic-bank-logo.png')"></div>

							<div class="-ic -ic-4" style="background: url('build/web/ufacoder/img/ic-bank-logo.png')"></div>

							<div class="-ic -ic-5" style="background: url('build/web/ufacoder/img/ic-bank-logo.png')"></div>

							<div class="-ic -ic-6" style="background: url('build/web/ufacoder/img/ic-bank-logo.png')"></div>

							<div class="-ic -ic-7" style="background: url('build/web/ufacoder/img/ic-bank-logo.png')"></div>

							<div class="-ic -ic-8" style="background: url('build/web/ufacoder/img/ic-bank-logo.png')"></div>

							<div class="-ic -ic-9" style="background: url('build/web/ufacoder/img/ic-bank-logo.png')"></div>

							<div class="-ic -ic-10" style="background: url('build/web/ufacoder/img/ic-bank-logo.png')"></div>

							<div class="-ic -ic-11" style="background: url('build/web/ufacoder/img/ic-bank-logo.png')"></div>

							<div class="-ic -ic-12" style="background: url('build/web/ufacoder/img/ic-bank-logo.png')"></div>

						</div>

					</div>

				</div>

				<div class="text-center mt-4">

					<div>

						<a href="#" class="text-warning">Term and condition</a>

					</div>

					<p class="mb-0">

						Copyright © 2020 ufa36s. All Rights Reserved.

					</p>

				</div>

			</div>

		</footer>

	</div>

	<script>
		var IS_ANDROID = false;
	</script>





	<!--	//	https://gist.github.com/ohiosveryown/93015ccc1f43437db6169dbfb18196fa // -->

	<script src="build/runtime.1ba6bf05.js"></script>

	<script src="build/0.9a86198d.js"></script>

	<script src="build/home.js?id=156122114"></script>

	<script src="build/3.02782841.js"></script>

	<!--	<script src="build/web/ufacoder/app.0e2313e3.js?id=1561221142"></script> -->

	<script src="js/jquery.loadingModal.js"></script>

	<?php



	if ($user) {

	?>

		<!--       <div class="nav-menu-m d-md-none d-lg-none">

            <div class="row">

                <dic class="col pr-0">

                    <div class="btn-deposit-m" data-toggle="modal" data-target="#modal-deposit">



                        <div>

                            <i class="fas fa-plus fa-lg"></i>

                        </div>

                        ฝากเงิน

                    </div>

                </dic>

                <dic class="col pr-0 pl-0">

                    <?php

					if ($ufa['username'] != '') {

					?>

                        <a href="game" class="btn-play-link" target="_blank">

                            <div class="btn-play-m">

                                <div>

                                    <i class="fas fa-futbol fa-lg"></i>

                                </div>

                                เข้าเล่น

                            </div>

                        </a>

                    <?php

					} else {



					?>

                        <a href="#" class="btn-play-link">

                            <div class="btn-play-m">

                                <div></div>

                                    <i class="fas fa-futbol fa-lg"></i>

                                </div>

                                เข้าเล่น

                            </div>

                        </a>



                    <?php

					}

					?>

                </dic>

                <dic class="col pl-0">

                    <div class="btn-withdraw-m" data-toggle="modal" data-target="#modal-withdraw">

                        <div>

                            <i class="fas fa-minus fa-lg"></i>

                        </div>

                        ถอนเงิน

                    </div>

                </dic>

            </div>

        </div> -->



		<!--  Modal -->



		<div class="x-modal modal" id="modal-deposit" tabindex="-1" role="dialog" data-loading-container=".js-modal-content" data-ajax-modal-always-reload="true" style="display: none;" aria-hidden="true">



			<div class="modal-dialog -modal-size -modal-big" role="document" style="margin-top: 203.922px;">

				<div class="modal-content -modal-content">

					<img src="build/web/ufacoder/img/border-modal.png" id="deposit" class="img-fluid d-lg-block d-none -border-top-modal" alt="">

					<button type="button" class="close f-1" data-dismiss="modal" aria-label="Close">

						<span aria-hidden="true">×</span>

					</button>

					<div class="modal-body">

						<div class="x-pending ">

							<div class="d-lg-block d-none">

								<div class="row">

									<div class="col d-flex flex-column js-slide-left-content x-slide-left-content">

										<div class="js-content mx-auto text-center animated fadeInModal" data-animatable="fadeInModal" data-delay="1500">

											<h3 class="x-title-modal mx-auto text-center d-inline-block text-white mt-3">

												ข้อมูลการโอน

												<hr class="x-hr-border-glow">

											</h3>



											<div class="text-center d-flex flex-column">



												<?php

												if ($bank_info['status_scb'] == 1) {

												?>

													<div class="mb-3">

														<div class="media m-auto d-inline-flex">

															<img src="https://ufa36s.com/image/scb2.png" alt="bank-bay" width="50px" class="rounded-circle mr-3">

															<div class="media-body text-left d-flex flex-column">

																<div class="d-flex flex-lg-column flex-row">



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

															<img src="https://ufa36s.com/image/ktb.png" alt="bank-bay" width="50px" class="rounded-circle mr-3">

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

												<!--      <div class="d-flex col-10 px-0 m-auto flex-column">

                                        <div class="f-5 text-gray-lighter"><i class="fas fa-exclamation"></i> <span id="notify"></span></div>

                                    </div> -->



												<div class="-danger-zone">

													<div class="-icon-wrapper">

														<img src="build/web/ufacoder/img/ic-alert.png" alt="Alert icon png" class="-img">

													</div>

													<span>กรุณาใช้บัญชี <?= $info['bank'] ?>

														<br>เลขบัญชี <?= $info['accnum'] ?>

														<br>ชื่อ <?= $info['name'] ?>

														<br>โอนเข้ามาเท่านั้นนะคะ

													</span><br>

												</div>

											</div>

										</div>

									</div>

									<div class="col d-flex flex-column animated fadeInModal" data-animatable="fadeInModal">

										<h3 class="x-title-modal mx-auto text-center d-inline-block text-white mt-3">

											ฝากเงิน

											<hr class="x-hr-border-glow">

										</h3>



										<div class="-deposit-preview text-center">

											<img src="build/web/ufacoder/img/ic_chip_deposit.png" class="img-fluid mb-3" alt="deposit" width="100">



											<hr class="border-dark w-85">





											<div class="my-3">

												<div class="-fake-input w-90 m-auto">

													<i class="fas fa-arrow-left" aria-hidden="true"></i>

													<b><span id="font_pop">ขั้นต่ำ <?= $d_limit ?> บาท</span><span class=""></span></b>

												</div>

											</div>

											<div class="d-flex col-10 px-0 m-auto flex-column">

												<div class="f-5 text-gray-lighter">เมื่อโอนเงินแล้ว กรุณารอ 10-30 วินาที</div>

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

										<h3 class="x-title-modal mx-auto text-center d-inline-block text-white mt-3">

											ฝากเงิน

											<hr class="x-hr-border-glow">

										</h3>



										<div class="text-center">

											<?php

											if ($bank_info['status_scb'] == 1) {

											?>

												<div class="mb-3">

													<div class="media m-auto d-inline-flex">

														<img src="https://ufa36s.com/image/scb2.png" alt="bank-bay" width="50px" class="rounded-circle mr-3">

														<div class="media-body text-left d-flex flex-column">

															<div class="d-flex flex-lg-column flex-row">

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

														<img src="https://ufa36s.com/image/scb2.png" alt="bank-bay" width="50px" class="rounded-circle mr-3">

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



										<!--        <div class="d-flex col-10 px-0 m-auto flex-column">

                                <div class="f-5 text-gray-lighter"><i class="fas fa-exclamation"></i> <span id="notify1"></span></div>

                            </div> -->



										<div class="col-12 m-auto d-flex">

											<div class="m-auto d-flex flex-row">

												<div class="f-5 mt-3 text-gray-lighter">เมื่อโอนเงินแล้ว กรุณารอ 10-30 วินาที</div>

											</div>

										</div>





										<div class="my-3">

											<div class="-fake-input w-90 m-auto">

												<span>ขั้นต่ำ <?= $d_limit ?> บาท</span><span class=""></span>

											</div>

										</div>



										<div class="-danger-zone">

											<div class="-icon-wrapper">

												<img src="build/web/ufacoder/img/ic-alert.png" alt="Alert icon png" class="-img">

											</div>

											<span>กรุณาใช้เลขบัญชีที่สมัคร<br>โอนเข้ามาเท่านั้นนะคะ</span>

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

					<img src="build/web/ufacoder/img/border-modal.png" class="img-fluid d-lg-block d-none -border-bottom-modal" alt="">

				</div>

			</div>

		</div>



		<div class="x-modal modal" id="modal-deposit2" tabindex="-1" role="dialog" aria-hidden="true" data-loading-container=".js-modal-content" data-ajax-modal-always-reload="true">

			<div class="modal-dialog modal-dialog-centered -modal-size " role="document">

				<div class="modal-content -modal-content">

					<img src="build/web/ufacoder/img/border-modal.png" class="img-fluid d-lg-block d-none -border-top-modal" alt="">

					<button type="button" class="close f-1" data-dismiss="modal" aria-label="Close">

						<span aria-hidden="true">×</span>

					</button>

					<div class="modal-header border-bottom-0 mt-3 pb-0 d-flex flex-column-reverse">

						<h3 class="m-auto text-white d-inline-block" id="exampleModalCenterTitle">

							ฝากเงิน

							<hr class="x-hr-border-glow">

						</h3>

					</div>

					<div class="modal-body" id='form_topup'>



						<div class="x-login-form">

							<div data-animatable="fadeInModal" data-offset="0" class="-animatable-container animated fadeInModal">

								<?php

								if ($bank_info['status_scb'] == 1) {

								?>

									<div class="d-flex justify-content-center" data-need-ping="">

										<div class="media p-2">

											<div><img src="https://www.safetymaster.in.th/wp-content/uploads/2017/04/bank_21.png" width="70" height="80" /></div>

											<div class="media-body ml-2">

												<div>

													<strong>ชื่อบัญชี : <?= $bank_info['name'] ?></strong>

												</div>

												<div>เลขบัญชี : <?= $bank_info['accnum'] ?></div>

												<div><a href="#" class="link-support copy-account-number" data-clipboard-text="<?= $bank_info['accnum'] ?>">[ คัดลอก ]</a></div>

											</div>

										</div>

									</div>

								<?php



								} ?>

								<br>

								<?php

								if ($bank_info['status_ktb'] == 1) {

								?>



									<div class="d-flex justify-content-center" data-need-ping="">

										<div class="media p-2">

											<div><img src="https://f.ptcdn.info/132/053/000/ouwyyvdzoS7lL7050LN-o.png" width="70" height="70" /></div>

											<div class="media-body ml-2">

												<div>

													<strong>ชื่อบัญชี : <?= $bank_info['name_ktb'] ?></strong>

												</div>

												<div>เลขบัญชี : <?= $bank_info['accnum_ktb'] ?></div>

												<div><a href="#" class="link-support copy-accountktb-number" data-clipboard-text="<?= $bank_info['accnum_ktb'] ?>">[ คัดลอก ]</a></div>

											</div>

										</div>

									</div>

								<?php



								} ?>



								<div class="form-group mt-1 ml-2 mr-2 mb-2">

									<center>

										<h1>

											<p class="text-danger">เติมขั้นต่ำ <?= $d_limit ?> บาท </p>

										</h1>



										<!-- <div class="card card-body bg-dark">



                                        <h1>โปรปัจุบัน </h1>

                                        <p>

                                            <?php

											$pro = $this->user_model->Promotions($user);

											if ($pro['promotion_id'] == 0) {

												echo 'คุณไม่ได้รับโปรโมชั่น';
											} else {

												echo 'เติมเงินรับ ' . $pro['percen'] . "% <br>";

												echo 'ทำเทิร์น ' . $pro['x'] . " เท่า";
											}

											?>

                                        </p>



                                    </div> -->

									</center>

									<p class="text-success">*ไม่ต้องแจ้งโอนเครดิตจะเข้าอัตโนมัติ ต้องโอนจากบัญชีที่สมัครเท่านั้น หากยังไม่ได้รับเครดิตหรือมีปัญหาสงสัย กรุณาเลือกที่เมนูติดต่อเจ้าหน้าที่ 24 ชม. ขอบพระคุณค่ะ</p>

									<center>

										<h1>

											<p class="text-danger">*ห้ามโอนเวลา 23.00 - 00.00 ระบบจะไม่อัพยอด*</p>

										</h1>

										<button type="button" class="btn btn-danger btn-lg btn-block btn-cancel" data-dismiss="modal"><i class="fas fa-times-circle"></i> ปิด </button>

									</center>

								</div>

							</div>

						</div>







					</div>











					<style>
						.bank-box-deposit {

							background-color: #4e2e7f;

						}
					</style>



					<style>
						.popover-body {

							font-family: Prompt, sans-serif;

							color: #fff;

						}



						.popover {

							background-color: rgba(0, 0, 0, 1);

							max-width: 330px;

						}



						.bs-popover-bottom>.arrow::after,

						.bs-popover-auto[x-placement^="bottom"]>.arrow::after {

							border-bottom-color: rgba(0, 0, 0, 1);

						}
					</style>

					<form id="logout-form" action="api/logout" method="GET" style="display: none;">



					</form>

				</div>

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

			</div>

		</div>

		</div>

		<!-- <div style=' z-index: 2; position: fixed; bottom: 15%; right: 0; padding: 8px; overflow: hidden; background: hsla(0,0%,100%,.2); border-top-left-radius: 24px; border-bottom-left-radius: 24px; '>

             <div>

                <a data-toggle="modal" data-target="#modal-deposit">

                    <img height="70" width="70" src="images/gift.png" alt="รับของขวัญ" class="-img-default">

                </a>

            </div>



            <div>



                <a href="https://line.me/R/ti/p/<?= $line ?>" target="_blank" rel="noopener">

                    <img height="70" width="70" src="images/ic_line.png" alt="ติดต่อเรา">



                </a>

            </div>

        </div> -->



		<!-- Modal -->

		<div class="x-modal modal" id="modal-promotion" tabindex="-1" role="dialog" aria-hidden="true" data-loading-container=".js-modal-content" data-ajax-modal-always-reload="true">

			<div class="modal-dialog modal-dialog modal-lg" role="document" style="margin-top: 131px;">

				<div class="modal-content -modal-content">

					<img src="build/web/ufacoder/img/border-modal.png" class="img-fluid d-lg-block d-none -border-top-modal" alt="">

					<button type="button" class="close f-1" data-dismiss="modal" aria-label="Close">

						<span aria-hidden="true">×</span>

					</button>

					<div data-animatable="fadeInModal" data-offset="0" class="-animatable-container animated fadeInModal">

						<div class="modal-header border-bottom-0 mt-3 pb-0 d-flex flex-column-reverse">

							<h3 class="m-auto text-white d-inline-block" id="exampleModalCenterTitle">

								รับเงินเติมสะสมติดต่อกัน 3 วัน

								<hr class="x-hr-border-glow">

							</h3>

						</div>



						<div class="modal-body">

							<div class="form-group mt-1 ml-2 mr-2 mb-2">

								<button id="promotion_revert" type="submit" class="btn btn-primary btn-lg btn-block" data-disable-on-click="">รับเงิน</button>

								<br>

								<table class="table text-white">

									<thead>

										<tr>

											<th scope="col" class="text-center">ได้รับ</th>

											<th scope="col" class="text-center">ยอดเติมสะสม</th>

											<th scope="col" class="text-center">วันที่ทำรายการ</th>



										</tr>

									</thead>

									<tbody>

										<?php

										$result_pro = $this->user_model->ResultPromotion($user);



										foreach ($result_pro as $key => $value) {

											# code...



										?>

											<tr>

												<td scope="row" class="text-center text-success"><?= $value['amount'] ?></td>

												<td scope="row" class="text-center text-warning"> <?= $value['balance'] ?> </td>

												<td scope="row" class="text-center"><?= $value['date'] ?></td>





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

		<!-- Modal -->


		<!-- โปรสมัครใหม่ -->

		<div class="x-modal modal" id="modal-promotion_register" tabindex="-1" role="dialog" aria-hidden="true" data-loading-container=".js-modal-content" data-ajax-modal-always-reload="true">

			<div class="modal-dialog modal-dialog modal-lg" role="document" style="margin-top: 131px;">

				<div class="modal-content -modal-content">

					<img src="build/web/ufacoder/img/border-modal.png" class="img-fluid d-lg-block d-none -border-top-modal" alt="">

					<button type="button" class="close f-1" data-dismiss="modal" aria-label="Close">

						<span aria-hidden="true">×</span>

					</button>

					<div data-animatable="fadeInModal" data-offset="0" class="-animatable-container animated fadeInModal">

						<div class="modal-header border-bottom-0 mt-3 pb-0 d-flex flex-column-reverse">

							<h3 class="m-auto text-white d-inline-block" id="exampleModalCenterTitle">

								<?php echo $data_pro[0]['name'] ?>

								<hr class="x-hr-border-glow">

							</h3>

						</div>



						<div class="modal-body">

							<div class="form-group mt-1 ml-2 mr-2 mb-2">

								<h4>รายละเอียดโปรโมชั่น</h4>


								<textarea id="editor" rows="15" class="form-control" name="text_1"><?php echo $data_pro[0]['text'] ?></textarea>

								<button id="pro_register" type="submit" class="btn btn-primary btn-lg btn-block mt-5" data-disable-on-click="">รับเงิน</button>

								<br>

								<?php

								$pro_log = $this->admin_model->get_prolog($info['username']);

								if ($pro_log != null) {
								?>
									<table class="table text-white">

										<thead>

											<tr>

												<th scope="col" class="text-center">จำนวน</th>



												<th scope="col" class="text-center">วันที่ทำรายการ</th>



											</tr>

										</thead>

										<?php $aff = $this->user_model->aff($user);



										foreach ($pro_log as $v) {





										?>

											<tbody>

												<tr>



													<th class="text-center" style="color: green;"><?= $v['money'] ?></th>

													<th class="text-center" style="color: green;"><?= $v['date_time'] ?></th>

												</tr>

											</tbody>

										<?php



										}

										?>

									</table>

								<?php
								} else {
								?>

								<?php

								}



								?>







							</div>

						</div>

					</div>

				</div>

			</div>

		</div>
		<!-- จบ โปรสมัครใหม่ -->

		<!-- โปรฝากแรกของวัน -->
		<div class="x-modal modal" id="modal-promotion_datenew" tabindex="-1" role="dialog" aria-hidden="true" data-loading-container=".js-modal-content" data-ajax-modal-always-reload="true">

			<div class="modal-dialog modal-dialog modal-lg" role="document" style="margin-top: 131px;">

				<div class="modal-content -modal-content">

					<img src="build/web/ufacoder/img/border-modal.png" class="img-fluid d-lg-block d-none -border-top-modal" alt="">

					<button type="button" class="close f-1" data-dismiss="modal" aria-label="Close">

						<span aria-hidden="true">×</span>

					</button>

					<div data-animatable="fadeInModal" data-offset="0" class="-animatable-container animated fadeInModal">

						<div class="modal-header border-bottom-0 mt-3 pb-0 d-flex flex-column-reverse">

							<h3 class="m-auto text-white d-inline-block" id="exampleModalCenterTitle">

								<?php echo $data_pro[1]['name'] ?>

								<hr class="x-hr-border-glow">

							</h3>

						</div>



						<div class="modal-body">

							<div class="form-group mt-1 ml-2 mr-2 mb-2">

								<h4>รายละเอียดโปรโมชั่น</h4>


								<textarea id="editor" rows="15" class="form-control" name="text_1"><?php echo $data_pro[1]['text'] ?></textarea>

								<button id="pro_register" type="submit" class="btn btn-primary btn-lg btn-block mt-5" data-disable-on-click="">รับเงิน</button>

								<br>

								<?php

								$pro_log = $this->admin_model->get_prolog($info['username']);

								if ($pro_log != null) {
								?>
									<table class="table text-white">

										<thead>

											<tr>

												<th scope="col" class="text-center">จำนวน</th>



												<th scope="col" class="text-center">วันที่ทำรายการ</th>



											</tr>

										</thead>

										<?php $aff = $this->user_model->aff($user);



										foreach ($pro_log as $v) {





										?>

											<tbody>

												<tr>



													<th class="text-center" style="color: green;"><?= $v['money'] ?></th>

													<th class="text-center" style="color: green;"><?= $v['date_time'] ?></th>

												</tr>

											</tbody>

										<?php



										}

										?>

									</table>

								<?php
								} else {
								?>

								<?php

								}



								?>







							</div>

						</div>

					</div>

				</div>

			</div>

		</div>
		<!-- จบฝากแรก -->
		<div class="x-button-actions" id="account-actions-mobile">

			<div class="d-flex">

				<a href="#" id="ufadeposit" data-toggle="modal" data-target="#modal-deposit" class="btn btn-lg btn-plain-primary">

					<img src="build/web/ufacoder/img/ic_deposit_white2.png" alt="UFA Exclusive ฝากเงิน" class="-icon img-fluid">

					<span class="-typo">ฝากเงิน</span>

				</a>

				<a href="#" id="ufawithdraw" data-toggle="modal" data-target="#modal-withdraw" class="btn btn-lg btn-plain-secondary">

					<img src="build/web/ufacoder/img/ic_withdraw_white2.png" alt="UFA Exclusive ถอนเงิน" class="-icon img-fluid">

					<span class="-typo">ถอนเงิน</span>

				</a>

				<!--<a href="#" class="btn btn-lg btn-plain-lobby" data-toggle="modal" data-target="#refModal">-->

				<!--    <img src="build/web/ufacoder/img/ic_dice2.png" alt="UFA Exclusive เข้าเล่น Lobby" class="-icon img-fluid">-->

				<!--    <span class="-typo">โปรโมชั่น</span>-->

				<!--</a>-->

			</div>

		</div>

		<div class="x-modal modal" id="modal-withdraw" tabindex="-1" role="dialog" aria-hidden="true" data-loading-container=".js-modal-content" data-ajax-modal-always-reload="true">

			<div class="modal-dialog modal-dialog-centered -modal-size " role="document">

				<div class="modal-content -modal-content">

					<img src="build/web/ufacoder/img/border-modal.png" class="img-fluid d-lg-block d-none -border-top-modal" alt="">

					<button type="button" class="close f-1" data-dismiss="modal" aria-label="Close">

						<span aria-hidden="true">×</span>

					</button>

					<div class="modal-header border-bottom-0 mt-3 pb-0 d-flex flex-column-reverse">

						<h3 class="m-auto text-white d-inline-block" id="exampleModalCenterTitle">

							ถอนเงิน

							<hr class="x-hr-border-glow">

						</h3>

					</div>

					<div class="modal-body">

						<div data-animatable="fadeInModal" data-offset="0" class="-animatable-container animated fadeInModal">

							<div class="d-flex justify-content-center">

								<div class="media p-2">

									<div class="bank-box">

										<img src="images/bank2/<?= $info['bank'] ?>.jpg" width="50px" height="50px">

									</div>

									<div class="media-body ml-2">

										<div><strong><?= $info['name'] ?></strong></div>

										<div><?= $info['accnum'] ?></div>

									</div>

								</div>

							</div>

							<div>

								<p class="text-center mt-2" id='turnover'>



								</p>

							</div>

							<div class="m-auto ">

								<!--   <br>

                            <img src="build/web/ufacoder/img/ic_chip_deposit.png" class="img-fluid mb-3 -ic-deposit" alt="deposit" width="100%"> -->

							</div>

							<p class="text-center mt-2">

								จำนวนเงินที่ต้องการถอน (ถอนขั้นต่ำ <?= $w_limit ?> บาท)

							</p>

							<p class="text-center mt-2">

								** เมื่อกดปุ่มยืนยันแล้วกรุณารอ 30 วินาที **

							</p>







							<div class="form-group mt-1 ml-2 mr-2 mb-2">

								<input class="form-control" id='money_w' placeholder="ยอดเงินถอน" pattern="[0-9]+" autofocus name="amount" type="text">







							</div>



							<div class="d-flex justify-content-center mt-3 ml-2 mr-2">

								<!-- <button id="withdraw" type="submit" class="btn btn-primary btn-lg btn-block" data-disable-on-click>ยืนยัน</button> -->

								<button id="withdraw" type="submit" class="btn btn-primary -submit" data-disable-on-click>ยืนยัน</button>

							</div>

							<!--   <div class="d-flex justify-content-center mt-2 ml-2 mr-2 mb-2">

                            <a href="./" class="btn btn-danger btn-lg btn-block btn-cancel">ยกเลิก</a> 

                            <button type="button" class="btn btn-danger btn-lg btn-block btn-cancel" data-dismiss="modal"><i class="fas fa-times-circle"></i> ปิด </button>

                        </div> -->

						</div>

					</div>

				</div>

			</div>

		</div>

		<div class="x-modal modal" id="refModal" tabindex="-1" role="dialog" data-loading-container=".js-modal-content" data-ajax-modal-always-reload="true" style="display: none;" aria-hidden="true">

			<div class="modal-dialog modal-dialog modal-lg" role="document" style="margin-top: 131px;">

				<div class="modal-content -modal-content">

					<img src="build/web/ufacoder/img/border-modal.png" id="deposit" class="img-fluid d-lg-block d-none -border-top-modal" alt="">

					<button type="button" class="close f-1" data-dismiss="modal" aria-label="Close">

						<span aria-hidden="true">×</span>

					</button>



					<div class="modal-body">

						<div class="x-login-form">

							<div data-animatable="fadeInModal" data-offset="0" class="-animatable-container animated fadeInModal">

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

								<div class="text-center d-flex flex-column">

									<div class="m-auto ">

										<h3 class="m-auto text-white d-inline-block">

											<i class="fas fa-users"></i>แนะนำเพื่อน รับโบนัส <?= $dataaff_d; ?>0% ของยอดเติม

											<hr class="x-hr-border-glow">

										</h3>

										<div class="container">

											<!--   <div class="row">

                                  <img src="./image/20200831_214836.gif" class="banner-promotion" style="width: 100%">

                              </div> -->

										</div>

										<!-- <div class="alert alert-info mt-4" role="alert">

                      <span id="url">อยู่ระหว่างปรับปรุง</span> 

                     <span id="refURL"><?= base_url() ?>aff/<?= $info['id'] ?></span>

                    </div> -->

										<div class="form-group mt-1 ml-2 mr-2 mb-2">

											<input id="refURL22" type="text" class="form-control x-form-control text-center" placeholder="Link" value="<?= $baseurl ?>aff/<?= $info['id'] ?>" autocomplete="off" readonly>

										</div>

										<button class="btn btn-success" id="cp_btn" onclick="copyLinkaff()"> คัดลอก </button>

										<p class='text-danger'> เพียงเพื่อนเติมครั้งแรกขั้นต่ำ <?= $seting['aff_d']; ?> บาท จะได้รับ <?= $dataaff_d; ?>% ของยอดเติม </p>

										<table class="table text-white">

											<thead>

												<tr>

													<th scope="col" class="text-center">จำนวน</th>

													<th scope="col" class="text-center">ได้รับ</th>

													<th scope="col" class="text-center">วันที่ทำรายการ</th>



												</tr>

											</thead>

											<?php $aff = $this->user_model->aff($user);



											foreach ($aff as $v) {





											?>

												<tbody>

													<tr>

														<th> <?= $v['amout'] ?></th>

														<th><?= $v['amout_get'] ?></th>

														<th><?= $v['date'] ?></th>

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

					<img src="build/web/ufacoder/img/border-modal.png" class="img-fluid d-lg-block d-none -border-bottom-modal" alt="">

				</div>

			</div>

		</div>

		<!--  <div class="x-modal modal" id="modal-afflink" tabindex="-1" role="dialog" data-loading-container=".js-modal-content" data-ajax-modal-always-reload="true" style="display: none;" aria-hidden="true">

<div class="modal-dialog -modal-size -modal-big" role="document" style="margin-top: 240px;">

    <div class="modal-content -modal-content">

		<img src="build/web/ufacoder/img/border-modal.png" class="img-fluid d-lg-block d-none -border-top-modal" alt="">

		<button type="button" class="close f-1" data-dismiss="modal" aria-label="Close">

			<span aria-hidden="true">×</span>

		</button>

                    <div class="modal-body">

                    <div data-animatable="fadeInModal" data-offset="0" class="-animatable-container animated fadeInModal">

                                                            <div class="modal-body">

            <div class="x-login-form">

              <div data-animatable="fadeInModal" data-offset="0" class="-animatable-container animated fadeInModal">

                <div class="text-center d-flex flex-column">

                  <div class="m-auto ">

                    <h3 class="m-auto text-white d-inline-block">

                      <i class="fas fa-users"></i>แนะนำ เพื่อนรับโบนัส 1% จากยอดเทินโอเวอร์

                      <hr class="x-hr-border-glow">

                    </h3>

                    <div class="container">

                    </div>

                    <div class="alert alert-info mt-4" role="alert">

                      <span id="refURL"><?= $baseurl ?>aff/<?= $info['id'] ?></span>

                    </div>

                    <button class="btn btn-success" id="cp_btn" onclick="copyLink()"> คัดลอก </button>



                    <p class='text-danger'> เพียงเพื่อนเติมครั้งแรกขั้นต่ำ <?= $seting['aff_d']; ?> บาท จะได้รับ <?= $seting['aff_m']; ?> ของยอดเติม </p>

                                                            <table class="table text-white">

                                                                <thead>

                                                                    <tr>

                                                                        <th scope="col" class="text-center">จำนวน</th>

                                                                        <th scope="col" class="text-center">ได้รับ</th>

                                                                        <th scope="col" class="text-center">วันที่ทำรายการ</th>



                                                                    </tr>

                                                                </thead>

                                                                <?php $aff = $this->user_model->aff($user);



																foreach ($aff as $v) {





																?>

                                                                    <tbody>

                                                                        <tr>

                                                                            <th> <?= $v['amout'] ?></th>

                                                                            <th><?= $v['amout_get'] ?></th>

                                                                            <th><?= $v['date'] ?></th>

                                                                        </tr>

                                                                    </tbody>

                                                                <?php



																}

																?>

                                                            </table>

                    </table>

                  </div>

                </div>

              </div>

            </div>

          </div>

                                                </div>

                                            </div>

                    </div>

                    </div>

                </div> -->

		</div>

		</div>



		<div class="x-modal modal" id="modal-history" tabindex="-1" role="dialog" aria-hidden="true" data-loading-container=".js-modal-content" data-ajax-modal-always-reload="true">

			<div class="modal-dialog modal-dialog-centered -modal-size " role="document">

				<div class="modal-content -modal-content">

					<img src="build/web/ufacoder/img/border-modal.png" class="img-fluid d-lg-block d-none -border-top-modal" alt="">

					<button type="button" class="close f-1" data-dismiss="modal" aria-label="Close">

						<span aria-hidden="true">×</span>

					</button>

					<div class="modal-header border-bottom-0 mt-3 pb-0 d-flex flex-column-reverse">

						<h3 class="m-auto text-white d-inline-block" id="exampleModalCenterTitle">

							ประวัติการทำรายการ

							<hr class="x-hr-border-glow">

						</h3>

					</div>

					<div class="modal-body">

						<div data-animatable="fadeInModal" data-offset="0" class="-animatable-container animated fadeInModal">

							<table class="table text-white">

								<thead>

									<tr>

										<th scope="col" class="text-center">รายการ</th>

										<th scope="col" class="text-center">จำนวน</th>

										<th scope="col" class="text-center">สถานะ</th>

										<th scope="col" class="text-center">วันที่ทำรายการ</th>



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





											<td scope="row" class="text-center"><?= $v['amount'] ?></td>

											<?php

											if ($v['stats'] == 1) {

												echo '<td scope="row" class="text-center text-warning"> กำลังทำรายการ </td>';
											} else if ($v['stats'] == 2) {

												echo '<td scope="row" class="text-center text-withdraw"> ไม่สำเร็จ </td>';
											} else {

												echo '<td scope="row" class="text-center text-success"> สำเร็จ </td>';
											}



											?>

											<td scope="row" class="text-center"><?= $v['date'] ?></td>





										</tr>

									<?php

									}

									?>

								</tbody>

							</table>

							<div class="d-flex justify-content-center mt-2 ml-2 mr-2 mb-2">

								<!-- <a href="./" class="btn btn-danger btn-lg btn-block btn-cancel">ยกเลิก</a> -->

								<button type="button" class="btn btn-danger btn-lg btn-block btn-cancel -submit" data-dismiss="modal"><i class="fas fa-times-circle"></i> ปิด </button>

							</div>

						</div>

					</div>

				</div>

			</div>

		</div>



		<div class="x-modal modal" id="modal-userinfo" tabindex="-1" role="dialog" aria-hidden="true" data-loading-container=".js-modal-content" data-ajax-modal-always-reload="true">

			<div class="modal-dialog modal-dialog-centered -modal-size " role="document">

				<div class="modal-content -modal-content">

					<img src="build/web/ufacoder/img/border-modal.png" class="img-fluid d-lg-block d-none -border-top-modal" alt="">

					<button type="button" class="close f-1" data-dismiss="modal" aria-label="Close">

						<span aria-hidden="true">×</span>

					</button>

					<div class="modal-header border-bottom-0 mt-3 pb-0 d-flex flex-column-reverse">

						<h3 class="m-auto text-white d-inline-block" id="exampleModalCenterTitle">

							ข้อมูลส่วนตัว

							<hr class="x-hr-border-glow">

						</h3>

					</div>

					<div class="modal-body">

						<div data-animatable="fadeInModal" data-offset="0" class="-animatable-container animated fadeInModal">

							<div>

								<img src="images/profile-icon-lerge.png" class="mx-auto d-block mb-2 mt-2" alt="giftbox-icon" width="50">

								<p class="text-center">

									Username : <strong><span class="text-danger"><?= $user ?></span></strong><br>

									เครดิต : <strong><span class="ufabet-credit">0.00</span></strong> บาท

								</p>

								<p class="text-center">

									<a href="#" id="changpasshola" class="link-support js-btn-change-pass" onclick="myFunction()" title="เปลี่ยนรหัสผ่าน">เปลี่ยนรหัสผ่าน</a> |

									<!-- <a href="#" class="link-support" onclick="event.preventDefault();

                                            document.getElementById('logout-form').submit();" title="Logout" title="ออกจากระบบ">ออกจากระบบ</a>-->

									<a href="#" id="logouthola" class="link-support" onclick="logoutufa()" title="Logout" title="ออกจากระบบ">ออกจากระบบ</a>

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

												UFA ID: <?= $user_ufa ?> <a href="#" class="link-support copy-username">[ คัดลอก ]</a>

												<!-- <br> Password: <? //= $pass_ufa 
																	?> <a href="#" class="link-support copy-password">[ คัดลอก ]</a> -->

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

										<!--  <div class="card card-body bg-dark">



                                        <h1>โปรปัจุบัน </h1>



                                        <p>

                                            <?php

											$pro = $this->user_model->Promotions($user);

											if ($pro['promotion_id'] == 0) {

												echo 'คุณไม่ได้รับโปรโมชั่น';
											} else {

												echo 'เติมเงินรับ ' . $pro['percen'] . "% <br>";

												echo 'ทำเทิร์น ' . $pro['x'] . " เท่า";
											}

											?>

                                        </p> -->



								</div>

							</div>

							</center>

							<p class="text-center">*ต้องการเปลี่ยนบัญชี กรุณาติดต่อ <a id="contact-line" class="link-support" href="https://line.me/R/ti/p/<?= $line ?>" title="ฝ่ายบริการลูกค้า" target="_blank">ฝ่ายบริการลูกค้า</a></p>

							<div class="d-flex justify-content-center mt-3 ml-2 mr-2">

								<button type="submit" class="btn btn-danger btn-lg btn-block btn-cancel" onclick="logoutufa()" title="ออกจากระบบ">ออกจากระบบ</button>

							</div>

						</div>

					</div>

				</div>

			</div>

		</div>

		</div>

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

							console.log(dd);

							$('#turnover').html("ต้องทำ " + data.data)



						} else {



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

								success: function(data) {



								}

							})

						}

					}

				})



			}, 10000);
		</script>

		<script>
			$('#withdraw').click(() => {



				var money = $('#money_w').val();



				console.log(money);



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

					// $("#withdraw").text("กำลังประมวลผล..."), $("#withdraw").prop("disabled", !0)

					$.ajax({

						url: "Apitopup/Withdraw",

						method: 'post',

						data: {

							money: money

						},

						success: function(data) {



							console.log(data);

							if (data.stats == true) {

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

							} else if (data.stats == false) {

								Swal.fire({

									icon: 'error',

									title: 'เกิดข้อผิดพลาด',

									text: data.msg,

									timer: 3000

								}).then((result) => {

									if (result.value) {

										window.location.reload();

									}

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

	<?php

	if (@$ufa['username'] != '') {

	?>

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


			$('#pro_register').click(() => {

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



			function changpass(thisObj) {

				var form = thisObj.closest('.form-password');

				var old_password = form.find('.js-old-password').val();

				var password = form.find('.js-new-password').val();

				var password_confirmation = form.find('.js-confirm-password').val();

				console.log(old_password);

				console.log(password);

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

	<?php

	}

	?>

	<script>
		$(document).ready(function() {

			grecaptcha.ready(function() {

				grecaptcha.execute('6Lf3sJYaAAAAACMM7j6xoM6gVRH9CGSvEFP-oUeG', {
					action: 'homepage'
				}).then(function(token) {

					toastr.options = {

						"closeButton": false,

						"debug": false,

						"newestOnTop": false,

						"progressBar": false,

						"positionClass": "toast-top-right",

						"preventDuplicates": false,

						"onclick": null,

						"showDuration": "300",

						"hideDuration": "1000",

						"timeOut": "5000",

						"extendedTimeOut": "1000",

						"showEasing": "swing",

						"hideEasing": "linear",

						"showMethod": "fadeIn",

						"hideMethod": "fadeOut"

					}

					$("input[type=text][pattern]").on('input', function() {

						if (!this.checkValidity())

							this.value = this.value.slice(0, -1);

					});

					$("input[type=password][pattern]").on('input', function() {

						if (!this.checkValidity())

							this.value = this.value.slice(0, -1);

					});

					$('#confirm').click(() => {



						var phone = $('#username').val();

						if (phone == '' || phone.length != 10) {

							toastr["error"]("กรอกข้อมูลให้ครบถ้วน", "ระบบ")

						} else if (phone.substr(0, 2) != '08' && phone.substr(0, 2) != '06' && phone.substr(0, 2) != '09') {

							toastr["error"]("เบอร์โทรศัพท์ผิดพลาด", "ระบบ")

						} else {



							$.ajax({

								url: 'api/checkuser',

								method: 'post',

								data: {

									username: phone

								},

								success: function(data) {

									if (data.status == true) {

										toastr["success"]("ตั้งรหัสผ่าน", "ระบบ")

										$('#box').remove();

										input = $('<div class="box-content-100" id="box1" style="height: 100%;"> <div class="box-content-head-100 text-center mb-1"> <h3 class="p-2">สมัครสมาชิก</h3> <div class="box-content-desc p-2"> <img src="images/password-icon.png" class="mx-auto d-block register-icon" alt="register-icon"> <p class="text-center mt-2"> ตั้งรหัสผ่าน </p> <div class="form-group mt-1 ml-2 mr-2 mb-2"> <input class="form-control" placeholder="ตั้งรหัสผ่าน"  pattern="[a-zA-Z0#_-9.+_#,$-]+" id="password_1" type="password"> </div> <div class="form-group mt-1 ml-2 mr-2 mb-2"> <input class="form-control" placeholder="พิมพ์รหัสผ่านอีกครั้ง"  pattern="[a-zA-Z0-9.+_#,$-]+" id="password_2" type="password" value=""> </div> <p class="text-center"> <i>ต้องเป็นตัวอักษรภาษาอังกฤษผสมตัวเลข<br>ความยาว 8-15 ตัวเท่านั้น</i> </p> <div class="d-flex justify-content-center mt-3 ml-2 mr-2"> <button type="submit" id="confirm2" class="btn btn-primary btn-lg btn-block" data-disable-on-click="">ยืนยัน</button> </div> </div> </div>')

										$('#form').append(input);

										$("input[type=password][pattern]").on('input', function() {

											if (!this.checkValidity())

												this.value = this.value.slice(0, -1);

										});



										$('#confirm2').click(() => {

											var password = $('#password_1').val();

											var password2 = $('#password_2').val();

											if (password != password2) {

												toastr["error"]("รหัสผ่านไม่ตรงกัน", "ระบบ")

											} else if (password.length < 7) {

												toastr["error"]("ความยาว 8-15 ตัวเท่านั้น", "ระบบ")

											} else if (password == '' || password2 == '') {

												toastr["error"]("กรุณาใส่รหัสให้ครบถ้วน", "ระบบ")

											} else {



												input = $(`<div class="box-content-100" id="box3"> <div class="box-content-head-100 text-center mb-1" id="popover_bank" data-container="body" data-toggle="popover" data-placement="left" data-content="กรอกข้อมูลให้ถูกต้องและครบถ้วนมิฉะนั้นท่านจะไม่สามารถถอนเงินได้" data-original-title="" title="" aria-describedby="popover62814"> <h3 class="p-2">กรุณาเลือกธนาคาร</h3> </div> <div class="box-content-desc p-2"> <div class="form-group mt-1 ml-2 mr-2 mb-2"> <div class="divVariante variante_1 col-xs-12"> <div class="row p-2"> <div class="col d-flex justify-content-center p-1 variante-radio"> <input type="radio" name="bank" value="bbl" id="bbl"> <label for="bbl" title="Bangkok Bank" style="background-image:url('images/bank/bbl.svg');background-repeat: no-repeat; background-size: 80%; background-color: #1e4598;"> <i class="fa fa-check" aria-hidden="true"></i> </label> </div> <div class="col d-flex justify-content-center p-1 variante-radio"> <input type="radio" name="bank" value="scb" id="scb"> <label for="scb" title="Siam Commercial Bank" style="background-image:url('images/bank/scb.svg');background-repeat: no-repeat; background-size: 80%; background-color: #4e2e7f;"> <i class="fa fa-check" aria-hidden="true"></i> </label> </div> <div class="col d-flex justify-content-center p-1 variante-radio"> <input type="radio" name="bank" value="kbank" id="kbank"> <label for="kbank" title="Kasikornbank" style="background-image:url('images/bank/kbank.svg');background-repeat: no-repeat; background-size: 80%; background-color: #138f2d;"> <i class="fa fa-check" aria-hidden="true"></i> </label> </div> <div class="col d-flex justify-content-center p-1 variante-radio"> <input type="radio" name="bank" value="bay" id="bay"> <label for="bay" title="Bank of Ayudhya (Krungsri)" style="background-image:url('images/bank/bay.svg');background-repeat: no-repeat; background-size: 80%; background-color: #fec43b;"> <i class="fa fa-check" aria-hidden="true"></i> </label> </div> <div class="col d-flex justify-content-center p-1 variante-radio"> <input type="radio" name="bank" value="ktb" id="ktb"> <label for="ktb" title="Krungthai Bank" style="background-image:url('images/bank/ktb.svg');background-repeat: no-repeat; background-size: 80%; background-color: #1ba5e1;"> <i class="fa fa-check" aria-hidden="true"></i> </label> </div> <div class="col d-flex justify-content-center p-1 variante-radio"> <input type="radio" name="bank" value="tmb" id="tmb"> <label for="tmb" title="TMB Bank" style="background-image:url('images/bank/tmb.svg');background-repeat: no-repeat; background-size: 80%; background-color: #1279be;"> <i class="fa fa-check" aria-hidden="true"></i> </label> </div> <div class="col d-flex justify-content-center p-1 variante-radio"> <input type="radio" name="bank" value="tbank" id="tbank"> <label for="tbank" title="Thanachart Bank" style="background-image:url('images/bank/tbank.svg');background-repeat: no-repeat; background-size: 80%; background-color: #fc4f1f;"> <i class="fa fa-check" aria-hidden="true"></i> </label> </div> <div class="col d-flex justify-content-center p-1 variante-radio"> <input type="radio" name="bank" value="gsb" id="gsb"> <label for="gsb" title="Government Savings Bank" style="background-image:url('images/bank/gsb.svg');background-repeat: no-repeat; background-size: 80%; background-color: #eb198d;"> <i class="fa fa-check" aria-hidden="true"></i> </label> </div> <div class="col d-flex justify-content-center p-1 variante-radio"> <input type="radio" name="bank" value="baac" id="baac"> <label for="baac" title="Bank for Agriculture and Agricultural Cooperatives" style="background-image:url('images/bank/baac.svg');background-repeat: no-repeat; background-size: 80%; background-color: #4b9b1d;"> <i class="fa fa-check" aria-hidden="true"></i> </label> </div> <div class="col d-flex justify-content-center p-1 variante-radio"> <input type="radio" name="bank" value="uob" id="uob"> <label for="uob" title="United Overseas Bank (Thai)" style="background-image:url('images/bank/uob.svg');background-repeat: no-repeat; background-size: 80%; background-color: #0b3979;"> <i class="fa fa-check" aria-hidden="true"></i> </label> </div> <div class="col d-flex justify-content-center p-1 variante-radio"> <input type="radio" name="bank" value="tisco" id="tisco"> <label for="tisco" title="Tisco Bank" style="background-image:url('images/bank/tisco.svg');background-repeat: no-repeat; background-size: 80%; background-color: #12549f;"> <i class="fa fa-check" aria-hidden="true"></i> </label> </div> <div class="col d-flex justify-content-center p-1 variante-radio"> <input type="radio" name="bank" value="cimb" id="cimb"> <label for="cimb" title="CIMB Thai Bank" style="background-image:url('images/bank/cimb.svg');background-repeat: no-repeat; background-size: 80%; background-color: #7e2f36;"> <i class="fa fa-check" aria-hidden="true"></i> </label> </div> <div class="col d-flex justify-content-center p-1 variante-radio"> <input type="radio" name="bank" value="lhb" id="lhb"> <label for="lhb" title="Land and Houses Bank" style="background-image:url('images/bank/lhb.svg');background-repeat: no-repeat; background-size: 80%; background-color: #6d6e71;"> <i class="fa fa-check" aria-hidden="true"></i> </label> </div> </div> </div> </div> <div class="form-group mt-1 ml-2 mr-2 mb-2"> <input class="form-control" placeholder="กรุณากรอกเลขที่บัญชี" pattern="[0-9]+" maxlength="12" autofocus="" id="account_number" type="text"> </div> <div class="form-group mt-1 ml-2 mr-2 mb-2"> <input class="form-control" placeholder="กรุณากรอกชื่อบัญชี (ชื่อ-นามสกุล)" id="name" type="text"> </div> <p class="text-center"> <i class="text-center">ชื่อบัญชีต้องเป็นภาษาไทยเท่านั้น</i> </p> <div class="form-group mt-1 ml-2 mr-2 mb-2"> <input class="form-control" placeholder="ไลน์ไอดี" id="line" type="text"> </div> <p class="text-center"> <i class="text-center">ถ้าไม่มีให้กรอกเป็นเบอร์โทร</i> </p> <div class="form-group mt-1 ml-2 mr-2 mb-2"> <label>โปรโมชั่น</label> <select id='promotion' class="form-control"> <option value="0" selected> ไม่รับโปรโมชั่น </option> <?php $promotion = $this->admin_model->get_promotions();

																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																														foreach ($promotion as $v) { ?> <option value="<?= $v['id'] ?>"> เติมเงินรับ <?= $v['percen'] ?>% ทำเทิร์น  <?= $v['x'] ?> เท่า </option> <?php } ?> </select> </div> <div class="d-flex justify-content-center form-group mt-3 ml-2 mr-2"> <button type="submit" class="btn btn-primary btn-lg btn-block" id="confirm3">ยืนยัน</button> </div> </div> </div>`)

												$('#form').append(input);

												$('#box1').remove();

												$('#confirm3').click(() => {

													var account_number = $('#account_number').val();

													var name = $('#name').val();

													var line = $('#line').val();

													var bank = $("input[name='bank']:checked").val();

													var promotion = $('select[id=promotion]').find('option:selected').val();

													//var bank = document.getElementsByName('bank').value;

													if (bank == null || name == '' || line == '' || bank == '') {

														toastr["error"]("กรุณาใส่ข้อมูลให้ครบถ้วน", "ระบบ")

													} else {

														$.ajax({

															url: 'api/register',

															method: 'post',

															data: {

																username: phone,

																password: password,

																account_number: account_number,

																name: name,

																line: line,

																bank: bank,

																token: token,

																promotion: promotion

															},

															success: function(data) {

																if (data.status == false) {

																	toastr["error"](data.msg, "ระบบ")



																} else if (data.status == false && data.status == 'Bot') {

																	setTimeout(function() {

																		location.reload();

																	}, 3000);

																} else {

																	$("#confirm3").text("กำลังประมวลผล..."), $("#confirm3").prop("disabled", !0)

																	toastr["success"](data.msg, "ระบบ")

																	setTimeout(function() {

																		location.reload();

																	}, 3000);



																}



															}



														})

													}



												})

											}

										})

									} else {



										toastr["error"]("ชื่อผู้ใช้งานซ้ำ", "ระบบ")

									}



								}



							})



						}

					})

				});

			});



		});
	</script>

	<script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>

	<script src="js/app.js?id=<?php echo time(); ?>"></script>

	<script src="js/ufa.js?id=<?php echo time(); ?>"></script>

	<script src="js/mobile.js?id=57ef7e4ff711266f2358"></script>

	<script src="js/select2.min.js"></script>

	<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

	<script src="js/jquery.loadingModal.js"></script>

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



		function showAlert() {

			var todayDate = new Date().toISOString().slice(0, 10);

			$.ajax({

				url: 'Apichecktime',

				method: 'get',

				success: function(data) {

					Swal.fire({

						imageUrl: 'https://i.ytimg.com/vi/UCQoJn_4yKg/maxresdefault.jpg',

						//      icon: 'error',

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

</body>



</html>