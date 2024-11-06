<html class="h-100" lang="en-US">
<?php
$bank_info = $this->admin_model->bank();
$seting    = $this->admin_model->result_setting();

$theme = $this->admin_model->result_theme($seting['theme']);
$assets = $theme->value;

$webname   = $seting['name_web'];
$line      = $seting['line'];
$d_limit   = $seting['d_limit'];
$w_limit   = $seting['w_limit'];
$baseurl   = base_url();

$popupbanner = (object) [
	(object) [
		'img_url' => $baseurl . $assets.'/popup/1.jpeg'
	],
	(object) [
		'img_url' => $baseurl . $assets.'/popup/1.jpeg'
	],
	(object) [
		'img_url' => $baseurl . $assets.'/popup/ca1.png'
	]
];


?>

<head>
    <?php
    $user = $this->session->userdata('user');
    $info = $this->user_model->getdata_user($user);
    if ($user) {
        $ufa = $this->user_model->user_ufa($user);
        $user_ufa =  $ufa['username'];
        $pass_ufa =  $ufa['password'];
        $color = $this->user_model->get_bank_color($user);
        $ufa   = $this->user_model->user_ufa($user);
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

    <style type="text/css" data-tippy-stylesheet="">
        .tippy-iOS {
            cursor: pointer !important;
            -webkit-tap-highlight-color: transparent
        }

        .tippy-popper {
            transition-timing-function: cubic-bezier(.165, .84, .44, 1);
            max-width: calc(100% - 8px);
            pointer-events: none;
            outline: 0
        }

        .tippy-popper[x-placement^=top] .tippy-backdrop {
            border-radius: 40% 40% 0 0
        }

        .tippy-popper[x-placement^=top] .tippy-roundarrow {
            bottom: -7px;
            bottom: -6.5px;
            -webkit-transform-origin: 50% 0;
            transform-origin: 50% 0;
            margin: 0 3px
        }

        .tippy-popper[x-placement^=top] .tippy-roundarrow svg {
            position: absolute;
            left: 0;
            -webkit-transform: rotate(180deg);
            transform: rotate(180deg)
        }

        .tippy-popper[x-placement^=top] .tippy-arrow {
            border-top: 8px solid #333;
            border-right: 8px solid transparent;
            border-left: 8px solid transparent;
            bottom: -7px;
            margin: 0 3px;
            -webkit-transform-origin: 50% 0;
            transform-origin: 50% 0
        }

        .tippy-popper[x-placement^=top] .tippy-backdrop {
            -webkit-transform-origin: 0 25%;
            transform-origin: 0 25%
        }

        .tippy-popper[x-placement^=top] .tippy-backdrop[data-state=visible] {
            -webkit-transform: scale(1) translate(-50%, -55%);
            transform: scale(1) translate(-50%, -55%)
        }

        .tippy-popper[x-placement^=top] .tippy-backdrop[data-state=hidden] {
            -webkit-transform: scale(.2) translate(-50%, -45%);
            transform: scale(.2) translate(-50%, -45%);
            opacity: 0
        }

        .tippy-popper[x-placement^=top] [data-animation=shift-toward][data-state=visible] {
            -webkit-transform: translateY(-10px);
            transform: translateY(-10px)
        }

        .tippy-popper[x-placement^=top] [data-animation=shift-toward][data-state=hidden] {
            opacity: 0;
            -webkit-transform: translateY(-20px);
            transform: translateY(-20px)
        }

        .tippy-popper[x-placement^=top] [data-animation=perspective] {
            -webkit-transform-origin: bottom;
            transform-origin: bottom
        }

        .tippy-popper[x-placement^=top] [data-animation=perspective][data-state=visible] {
            -webkit-transform: perspective(700px) translateY(-10px) rotateX(0);
            transform: perspective(700px) translateY(-10px) rotateX(0)
        }

        .tippy-popper[x-placement^=top] [data-animation=perspective][data-state=hidden] {
            opacity: 0;
            -webkit-transform: perspective(700px) translateY(0) rotateX(60deg);
            transform: perspective(700px) translateY(0) rotateX(60deg)
        }

        .tippy-popper[x-placement^=top] [data-animation=fade][data-state=visible] {
            -webkit-transform: translateY(-10px);
            transform: translateY(-10px)
        }

        .tippy-popper[x-placement^=top] [data-animation=fade][data-state=hidden] {
            opacity: 0;
            -webkit-transform: translateY(-10px);
            transform: translateY(-10px)
        }

        .tippy-popper[x-placement^=top] [data-animation=shift-away][data-state=visible] {
            -webkit-transform: translateY(-10px);
            transform: translateY(-10px)
        }

        .tippy-popper[x-placement^=top] [data-animation=shift-away][data-state=hidden] {
            opacity: 0;
            -webkit-transform: translateY(0);
            transform: translateY(0)
        }

        .tippy-popper[x-placement^=top] [data-animation=scale] {
            -webkit-transform-origin: bottom;
            transform-origin: bottom
        }

        .tippy-popper[x-placement^=top] [data-animation=scale][data-state=visible] {
            -webkit-transform: translateY(-10px) scale(1);
            transform: translateY(-10px) scale(1)
        }

        .tippy-popper[x-placement^=top] [data-animation=scale][data-state=hidden] {
            opacity: 0;
            -webkit-transform: translateY(-10px) scale(.5);
            transform: translateY(-10px) scale(.5)
        }

        .tippy-popper[x-placement^=bottom] .tippy-backdrop {
            border-radius: 0 0 30% 30%
        }

        .tippy-popper[x-placement^=bottom] .tippy-roundarrow {
            top: -7px;
            -webkit-transform-origin: 50% 100%;
            transform-origin: 50% 100%;
            margin: 0 3px
        }

        .tippy-popper[x-placement^=bottom] .tippy-roundarrow svg {
            position: absolute;
            left: 0;
            -webkit-transform: rotate(0);
            transform: rotate(0)
        }

        .tippy-popper[x-placement^=bottom] .tippy-arrow {
            border-bottom: 8px solid #333;
            border-right: 8px solid transparent;
            border-left: 8px solid transparent;
            top: -7px;
            margin: 0 3px;
            -webkit-transform-origin: 50% 100%;
            transform-origin: 50% 100%
        }

        .tippy-popper[x-placement^=bottom] .tippy-backdrop {
            -webkit-transform-origin: 0 -50%;
            transform-origin: 0 -50%
        }

        .tippy-popper[x-placement^=bottom] .tippy-backdrop[data-state=visible] {
            -webkit-transform: scale(1) translate(-50%, -45%);
            transform: scale(1) translate(-50%, -45%)
        }

        .tippy-popper[x-placement^=bottom] .tippy-backdrop[data-state=hidden] {
            -webkit-transform: scale(.2) translate(-50%);
            transform: scale(.2) translate(-50%);
            opacity: 0
        }

        .tippy-popper[x-placement^=bottom] [data-animation=shift-toward][data-state=visible] {
            -webkit-transform: translateY(10px);
            transform: translateY(10px)
        }

        .tippy-popper[x-placement^=bottom] [data-animation=shift-toward][data-state=hidden] {
            opacity: 0;
            -webkit-transform: translateY(20px);
            transform: translateY(20px)
        }

        .tippy-popper[x-placement^=bottom] [data-animation=perspective] {
            -webkit-transform-origin: top;
            transform-origin: top
        }

        .tippy-popper[x-placement^=bottom] [data-animation=perspective][data-state=visible] {
            -webkit-transform: perspective(700px) translateY(10px) rotateX(0);
            transform: perspective(700px) translateY(10px) rotateX(0)
        }

        .tippy-popper[x-placement^=bottom] [data-animation=perspective][data-state=hidden] {
            opacity: 0;
            -webkit-transform: perspective(700px) translateY(0) rotateX(-60deg);
            transform: perspective(700px) translateY(0) rotateX(-60deg)
        }

        .tippy-popper[x-placement^=bottom] [data-animation=fade][data-state=visible] {
            -webkit-transform: translateY(10px);
            transform: translateY(10px)
        }

        .tippy-popper[x-placement^=bottom] [data-animation=fade][data-state=hidden] {
            opacity: 0;
            -webkit-transform: translateY(10px);
            transform: translateY(10px)
        }

        .tippy-popper[x-placement^=bottom] [data-animation=shift-away][data-state=visible] {
            -webkit-transform: translateY(10px);
            transform: translateY(10px)
        }

        .tippy-popper[x-placement^=bottom] [data-animation=shift-away][data-state=hidden] {
            opacity: 0;
            -webkit-transform: translateY(0);
            transform: translateY(0)
        }

        .tippy-popper[x-placement^=bottom] [data-animation=scale] {
            -webkit-transform-origin: top;
            transform-origin: top
        }

        .tippy-popper[x-placement^=bottom] [data-animation=scale][data-state=visible] {
            -webkit-transform: translateY(10px) scale(1);
            transform: translateY(10px) scale(1)
        }

        .tippy-popper[x-placement^=bottom] [data-animation=scale][data-state=hidden] {
            opacity: 0;
            -webkit-transform: translateY(10px) scale(.5);
            transform: translateY(10px) scale(.5)
        }

        .tippy-popper[x-placement^=left] .tippy-backdrop {
            border-radius: 50% 0 0 50%
        }

        .tippy-popper[x-placement^=left] .tippy-roundarrow {
            right: -12px;
            -webkit-transform-origin: 33.33333333% 50%;
            transform-origin: 33.33333333% 50%;
            margin: 3px 0
        }

        .tippy-popper[x-placement^=left] .tippy-roundarrow svg {
            position: absolute;
            left: 0;
            -webkit-transform: rotate(90deg);
            transform: rotate(90deg)
        }

        .tippy-popper[x-placement^=left] .tippy-arrow {
            border-left: 8px solid #333;
            border-top: 8px solid transparent;
            border-bottom: 8px solid transparent;
            right: -7px;
            margin: 3px 0;
            -webkit-transform-origin: 0 50%;
            transform-origin: 0 50%
        }

        .tippy-popper[x-placement^=left] .tippy-backdrop {
            -webkit-transform-origin: 50% 0;
            transform-origin: 50% 0
        }

        .tippy-popper[x-placement^=left] .tippy-backdrop[data-state=visible] {
            -webkit-transform: scale(1) translate(-50%, -50%);
            transform: scale(1) translate(-50%, -50%)
        }

        .tippy-popper[x-placement^=left] .tippy-backdrop[data-state=hidden] {
            -webkit-transform: scale(.2) translate(-75%, -50%);
            transform: scale(.2) translate(-75%, -50%);
            opacity: 0
        }

        .tippy-popper[x-placement^=left] [data-animation=shift-toward][data-state=visible] {
            -webkit-transform: translateX(-10px);
            transform: translateX(-10px)
        }

        .tippy-popper[x-placement^=left] [data-animation=shift-toward][data-state=hidden] {
            opacity: 0;
            -webkit-transform: translateX(-20px);
            transform: translateX(-20px)
        }

        .tippy-popper[x-placement^=left] [data-animation=perspective] {
            -webkit-transform-origin: right;
            transform-origin: right
        }

        .tippy-popper[x-placement^=left] [data-animation=perspective][data-state=visible] {
            -webkit-transform: perspective(700px) translateX(-10px) rotateY(0);
            transform: perspective(700px) translateX(-10px) rotateY(0)
        }

        .tippy-popper[x-placement^=left] [data-animation=perspective][data-state=hidden] {
            opacity: 0;
            -webkit-transform: perspective(700px) translateX(0) rotateY(-60deg);
            transform: perspective(700px) translateX(0) rotateY(-60deg)
        }

        .tippy-popper[x-placement^=left] [data-animation=fade][data-state=visible] {
            -webkit-transform: translateX(-10px);
            transform: translateX(-10px)
        }

        .tippy-popper[x-placement^=left] [data-animation=fade][data-state=hidden] {
            opacity: 0;
            -webkit-transform: translateX(-10px);
            transform: translateX(-10px)
        }

        .tippy-popper[x-placement^=left] [data-animation=shift-away][data-state=visible] {
            -webkit-transform: translateX(-10px);
            transform: translateX(-10px)
        }

        .tippy-popper[x-placement^=left] [data-animation=shift-away][data-state=hidden] {
            opacity: 0;
            -webkit-transform: translateX(0);
            transform: translateX(0)
        }

        .tippy-popper[x-placement^=left] [data-animation=scale] {
            -webkit-transform-origin: right;
            transform-origin: right
        }

        .tippy-popper[x-placement^=left] [data-animation=scale][data-state=visible] {
            -webkit-transform: translateX(-10px) scale(1);
            transform: translateX(-10px) scale(1)
        }

        .tippy-popper[x-placement^=left] [data-animation=scale][data-state=hidden] {
            opacity: 0;
            -webkit-transform: translateX(-10px) scale(.5);
            transform: translateX(-10px) scale(.5)
        }

        .tippy-popper[x-placement^=right] .tippy-backdrop {
            border-radius: 0 50% 50% 0
        }

        .tippy-popper[x-placement^=right] .tippy-roundarrow {
            left: -12px;
            -webkit-transform-origin: 66.66666666% 50%;
            transform-origin: 66.66666666% 50%;
            margin: 3px 0
        }

        .tippy-popper[x-placement^=right] .tippy-roundarrow svg {
            position: absolute;
            left: 0;
            -webkit-transform: rotate(-90deg);
            transform: rotate(-90deg)
        }

        .tippy-popper[x-placement^=right] .tippy-arrow {
            border-right: 8px solid #333;
            border-top: 8px solid transparent;
            border-bottom: 8px solid transparent;
            left: -7px;
            margin: 3px 0;
            -webkit-transform-origin: 100% 50%;
            transform-origin: 100% 50%
        }

        .tippy-popper[x-placement^=right] .tippy-backdrop {
            -webkit-transform-origin: -50% 0;
            transform-origin: -50% 0
        }

        .tippy-popper[x-placement^=right] .tippy-backdrop[data-state=visible] {
            -webkit-transform: scale(1) translate(-50%, -50%);
            transform: scale(1) translate(-50%, -50%)
        }

        .tippy-popper[x-placement^=right] .tippy-backdrop[data-state=hidden] {
            -webkit-transform: scale(.2) translate(-25%, -50%);
            transform: scale(.2) translate(-25%, -50%);
            opacity: 0
        }

        .tippy-popper[x-placement^=right] [data-animation=shift-toward][data-state=visible] {
            -webkit-transform: translateX(10px);
            transform: translateX(10px)
        }

        .tippy-popper[x-placement^=right] [data-animation=shift-toward][data-state=hidden] {
            opacity: 0;
            -webkit-transform: translateX(20px);
            transform: translateX(20px)
        }

        .tippy-popper[x-placement^=right] [data-animation=perspective] {
            -webkit-transform-origin: left;
            transform-origin: left
        }

        .tippy-popper[x-placement^=right] [data-animation=perspective][data-state=visible] {
            -webkit-transform: perspective(700px) translateX(10px) rotateY(0);
            transform: perspective(700px) translateX(10px) rotateY(0)
        }

        .tippy-popper[x-placement^=right] [data-animation=perspective][data-state=hidden] {
            opacity: 0;
            -webkit-transform: perspective(700px) translateX(0) rotateY(60deg);
            transform: perspective(700px) translateX(0) rotateY(60deg)
        }

        .tippy-popper[x-placement^=right] [data-animation=fade][data-state=visible] {
            -webkit-transform: translateX(10px);
            transform: translateX(10px)
        }

        .tippy-popper[x-placement^=right] [data-animation=fade][data-state=hidden] {
            opacity: 0;
            -webkit-transform: translateX(10px);
            transform: translateX(10px)
        }

        .tippy-popper[x-placement^=right] [data-animation=shift-away][data-state=visible] {
            -webkit-transform: translateX(10px);
            transform: translateX(10px)
        }

        .tippy-popper[x-placement^=right] [data-animation=shift-away][data-state=hidden] {
            opacity: 0;
            -webkit-transform: translateX(0);
            transform: translateX(0)
        }

        .tippy-popper[x-placement^=right] [data-animation=scale] {
            -webkit-transform-origin: left;
            transform-origin: left
        }

        .tippy-popper[x-placement^=right] [data-animation=scale][data-state=visible] {
            -webkit-transform: translateX(10px) scale(1);
            transform: translateX(10px) scale(1)
        }

        .tippy-popper[x-placement^=right] [data-animation=scale][data-state=hidden] {
            opacity: 0;
            -webkit-transform: translateX(10px) scale(.5);
            transform: translateX(10px) scale(.5)
        }

        .tippy-tooltip {
            position: relative;
            color: #fff;
            border-radius: .25rem;
            font-size: .875rem;
            padding: .3125rem .5625rem;
            line-height: 1.4;
            text-align: center;
            background-color: #333
        }

        .tippy-tooltip[data-size=small] {
            padding: .1875rem .375rem;
            font-size: .75rem
        }

        .tippy-tooltip[data-size=large] {
            padding: .375rem .75rem;
            font-size: 1rem
        }

        .tippy-tooltip[data-animatefill] {
            overflow: hidden;
            background-color: transparent
        }

        .tippy-tooltip[data-interactive],
        .tippy-tooltip[data-interactive] .tippy-roundarrow path {
            pointer-events: auto
        }

        .tippy-tooltip[data-inertia][data-state=visible] {
            transition-timing-function: cubic-bezier(.54, 1.5, .38, 1.11)
        }

        .tippy-tooltip[data-inertia][data-state=hidden] {
            transition-timing-function: ease
        }

        .tippy-arrow,
        .tippy-roundarrow {
            position: absolute;
            width: 0;
            height: 0
        }

        .tippy-roundarrow {
            width: 18px;
            height: 7px;
            fill: #333;
            pointer-events: none
        }

        .tippy-backdrop {
            position: absolute;
            background-color: #333;
            border-radius: 50%;
            width: calc(110% + 2rem);
            left: 50%;
            top: 50%;
            z-index: -1;
            transition: all cubic-bezier(.46, .1, .52, .98);
            -webkit-backface-visibility: hidden;
            backface-visibility: hidden
        }

        .tippy-backdrop:after {
            content: "";
            float: left;
            padding-top: 100%
        }

        .tippy-backdrop+.tippy-content {
            transition-property: opacity;
            will-change: opacity
        }

        .tippy-backdrop+.tippy-content[data-state=visible] {
            opacity: 1
        }

        .tippy-backdrop+.tippy-content[data-state=hidden] {
            opacity: 0
        }
        .center-popup {
  display: flex !important;
  justify-content: center;
  align-items: center;
}
    </style>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">

    <!-- This site is optimized with the Yoast SEO plugin v16.8 - https://yoast.com/wordpress/plugins/seo/ -->
    <title><?= $webname ?> คาสิโนออนไลน์ แทงบอลออนไลน์ เกมส์บาคาร่าออนไลน์ ฝาก-ถอน 30 วินาที ทุกที่ทุกเวลาตลอด 24ชม.</title>
    <link rel="stylesheet" href="assets/css/ce31477cc2b40bc0c6fb3ac9904f4b69.css" media="all">
    <meta name="description" content="เว็บพนันออนไลน์  UFABET เล่นพนัน ผ่านมือถือ เว็บแทงไก่ชน ฝากถอนออโต้ สมัคร รับเครดิตฟรี ถ่ายทอดสด เล่นไก่ ตลอด 24 ชั่วโมง">
    <link rel="canonical" href="https://themebets.com/theme/ae/">
    <meta property="og:locale" content="en_US">
    <meta property="og:type" content="website">
    <meta property="og:title" content="หน้าหลัก - ufacv9.com">
    <meta property="og:description" content="เว็บพนันออนไลน์  UFABET เล่นพนัน ผ่านมือถือ เว็บแทงไก่ชน ฝากถอนออโต้ สมัคร รับเครดิตฟรี ถ่ายทอดสด เล่นไก่ ตลอด 24 ชั่วโมง">
    <meta property="og:url" content="https://themebets.com/theme/ae/">
    <meta property="og:site_name" content="ufacv9.com">
    <meta property="article:modified_time" content="2021-08-16T16:47:51+00:00">
    <meta property="og:image" content="images/1-1024x375.jpg">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:label1" content="Est. reading time">
    <meta name="twitter:data1" content="3 minutes">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
    <link rel="stylesheet" href="css/jquery.loadingModal.css">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css">
    
    <!-- / Yoast SEO plugin. -->




    <style type="text/css">
        img.wp-smiley,
        img.emoji {
            display: inline !important;
            border: none !important;
            box-shadow: none !important;
            height: 1em !important;
            width: 1em !important;
            margin: 0 .07em !important;
            vertical-align: -0.1em !important;
            background: none !important;
            padding: 0 !important;
        }
    </style>


    <style id="kk-star-ratings-inline-css" type="text/css">
        .kk-star-ratings .kksr-stars .kksr-star {
            margin-right: 4px;
        }

        [dir="rtl"] .kk-star-ratings .kksr-stars .kksr-star {
            margin-left: 4px;
            margin-right: 0;
        }
    </style>
    <link rel="stylesheet" href="/assets/css/superwheeladmin.css"> <!-- superWheel -->

</head>

<body class="d-flex flex-column h-100">


    <!-- Side Bar Menu Right-------------------------------------------    -->
    <div class="x-web-list-sidebar">
        <div class="-inner-wrapper">

            <div class="pl-2 pt-4 pb-3 logosidebar">
                <a href="https://ufacv9.com/" class="custom-logo-link" aria-current="page"><img width="640" height="306" src="images/logo.png" class="custom-logo" alt="ufacv9.com" srcset="images/logo.png 640w, images/logo.png 300w" sizes="(max-width: 640px) 100vw, 640px"></a>
            </div>
            <hr class="-hr">
        </div>
        <div class="-overlay"></div>
    </div>
    <!-- Side Bar Menu Right-------------------------------------------    -->



    <nav class="x-header navbar bg-transparent navbar-expand-lg -anon">
        <div class="container align-items-center position-relative">
            <div id="headerBrand">
                <div class="navbar-brand navlogoimg">
                    <a href="#" class="custom-logo-link" aria-current="page"><img width="640" height="306" src="images/logo.png" class="custom-logo" alt="ufacv9.com" srcset="images/logo.png 640w, images/batch_Logo3-copy-300x143.png 300w" sizes="(max-width: 640px) 100vw, 640px"></a>
                </div>
            </div>
            <div id="headerContent">
                <div class="navbar-nav">
                    <?php if (!$user) { ?>
                        <div class="d-flex">
                            <button class="btn btn-primary mt-lg-3 mr-lg-3">
                                <div class="-text-container">
                                    <div class="textwidget"><a href="#" data-toggle="modal" data-target="#loginModal">เข้าสู่ระบบ</a></div>
                                </div>
                            </button><button class="btn btn-primary mt-lg-3 mr-lg-3">
                                <div class="-text-container">
                                    <div class="textwidget"><a href="#" data-toggle="modal" data-target="#RegisterModal">สมัครสมาชิก</a></div>
                                </div>
                            </button>
                        </div>
                    <?php } else {  ?>
                        <div class="d-flex">
                            <span class="btn btn-primary mt-lg-3" style="margin-right: 0.3rem !important;">
                                <div class="-text-container">
                                    <div class="textwidget">
                                        <span>
                                            <span><?= $user ?></span>
                                            <br>
                                            <span class="ufabet-credit">0.00</span>
                                        </span>
                                        <button type="button" class="btn btn-link p-0" id="btn-customer-balance-reload" onclick="window.location.reload();">
                                            &nbsp;&nbsp;<i class="check-credit-status2 fas fa-sync-alt text-white f-9"></i>
                                        </button>
                                    </div>
                                </div>
                        </div>
                        </span>
                        <a href="#" data-toggle="modal" data-target="#modal-deposit">
                            <button class="btn btn-primary mt-lg-3" style="margin-right: 0.3rem !important;" id="deposit_pc">
                                <div class="-text-container">
                                    <div class="textwidget"><a href="#" data-toggle="modal" data-target="#modal-deposit">ฝากเงิน </a></div>
                                </div>
                            </button>
                        </a>
                        <a href="#" data-toggle="modal" data-target="#modal-withdraw">
                            <button class="btn btn-primary mt-lg-3" style="margin-right: 0.3rem !important;" id="withdraw_pc">
                                <div class="-text-container">
                                    <div class="textwidget"> <a href="#" data-toggle="modal" data-target="#modal-withdraw">ถอนเงิน </a></div>
                                </div>
                            </button>
                        </a>
                        <a href="#" id="wheelspinufa">
                            <button class="btn btn-primary mt-lg-3" style="margin-right: 0.3rem !important;" id="wheelspin_pc">
                                <div class="-text-container">
                                    <div class="textwidget"> <a href="#" id="wheelspinufa">วงล้อ</a></div>
                                </div>
                            </button>
                        </a>
                </div>
            <?php } ?>
            </div>
        </div>
        </div>
    </nav>
    <div id="main__content" class="">
        <section class="x-index-top-container">

            <div class="container -container-wrapper">
                <div class="row -top-row-wrapper">
                    <div class="col-12 col-lg-6 col-xl-7 -top-row-left-wrapper">

                        <div class="-banner-img"><img width="700" height="452" src="images/index-top-banner.png" class="image wp-image-716  attachment-full size-full" alt="" loading="lazy" style="max-width: 100%; height: auto;" srcset="images/index-top-banner.png 700w, images/index-top-banner-300x194.png 300w" sizes="(max-width: 700px) 100vw, 700px"></div>
                    </div>
                    <div class="col-12 col-lg-6 col-xl-5 -top-row-right-wrapper">

                        <div class="-logo-img">
                            <a href="https://ufacv9.com/" class="custom-logo-link" aria-current="page"><img width="640" height="306" src="images/logo.png" class="custom-logo" alt="ufacv9.com" srcset="images/logo.png 640w, images/batch_Logo3-copy-300x143.png 300w" sizes="(max-width: 640px) 100vw, 640px"></a>
                        </div>
                        <div class="-title">
                            <div class="textwidget">เซ็กซี่บาคาร่าออนไลน์ คาสิโนสดที่นิยมมากที่สุด Sexy Gaming สู่ ufacv9 ตื่นเต้นสดใหม่ยิ่งขึ้น</div>
                        </div>
                        <div class="btn -btn -btn-image-primary">
                            <div class="-fake-bg-wrapper">
                                <img src="images/btn-base-glow.png" class="-fake-bg-glow" alt="ufacv9 Casino รูปปุ่มแสงสมัครสมาชิก">
                            </div>
                            <div class="-real-content-wrapper">
                                <div class="-bg-img">
                                    <?php if (!$user) { ?>
                                        <div class="-btn-text"><a href="#" data-toggle="modal" data-target="#RegisterModal">สมัครสมาชิก</a></div><a href="/"><img width="500" height="160" src="images/btn-primary-bg.png" class="image wp-image-719  attachment-full size-full" alt="" loading="lazy" style="max-width: 100%; height: auto;" srcset="images/btn-primary-bg.png 500w, images/btn-primary-bg.png 300w" sizes="(max-width: 500px) 100vw, 500px"></a>
                                    <?php  } else { ?>
                                        <div class="-btn-text">
                                        <a href="game" target="_blank">ทางเข้าเล่น</
                                        a>
                                        </div>
                                        <a href="game" target="_blank">
                                            <img width="500" height="160" src="images/btn-primary-bg.png" class="image wp-image-719  attachment-full size-full" alt="" loading="lazy" style="max-width: 100%; height: auto;" srcset="images/btn-primary-bg.png 500w, images/btn-primary-bg.png 300w" sizes="(max-width: 500px) 100vw, 500px"/>
                                        </a>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php if (!$user) { ?>
                    <div class="row -bottom-row-wrapper">
                        <div class="col-12 -col-wrapper">

                            <div class="x-service-wrapper -index">
                                <div class="row -service-inner-wrapper">
                                    <div class="col-11 col-sm-9 col-md-4 col-lg-3 text-center -box d-flex align-items-start d-md-block -box">
                                        <div class="-fake-bg"></div>
                                        <div class="-ic-wrapper">
                                            <div class="-tabsection2"><img width="150" height="150" src="images/ic-only-one-user-150x150.png" class="image wp-image-735  attachment-thumbnail size-thumbnail" alt="" loading="lazy" style="max-width: 100%; height: auto;" srcset="images/ic-only-one-user-150x150.png 150w, images/ic-only-one-user.png 280w" sizes="(max-width: 150px) 100vw, 150px"> </div>
                                        </div>
                                        <div class="text-left text-md-center">
                                            <div class="d-block sec2text text-light pb-4"><span class="-title-h2">เปิดบริการ 24 ชั่วโมง</span>
                                                <div class="textwidget">เล่นได้ทุกที่ ทุกเวลา ทั้งผ่านคอมพิวเตอร์ และโทรศัพท์มือถือ</div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-11 col-sm-9 col-md-4 col-lg-3 text-center -box d-flex align-items-start d-md-block -box">
                                        <div class="-fake-bg"></div>
                                        <div class="-ic-wrapper">
                                            <div class="-tabsection2"><img width="150" height="150" src="images/ic-pay-high-150x150.png" class="image wp-image-736  attachment-thumbnail size-thumbnail" alt="" loading="lazy" style="max-width: 100%; height: auto;" srcset="images/ic-pay-high-150x150.png 150w, images/ic-pay-high.png 280w" sizes="(max-width: 150px) 100vw, 150px"> </div>
                                        </div>
                                        <div class="text-left text-md-center">
                                            <div class="d-block sec2text text-light pb-4"><span class="-title-h2">ระบบฝากถอนอัตโนมัติ</span>
                                                <div class="textwidget">ทำรายการ ฝาก-ถอน แบบโอโต้ ตลอด 24 ชั่วโมง</div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-11 col-sm-9 col-md-4 col-lg-3 text-center -box d-flex align-items-start d-md-block -box">
                                        <div class="-fake-bg"></div>
                                        <div class="-ic-wrapper">
                                            <div class="-tabsection2"><img width="150" height="150" src="images/ic-consistency-150x150.png" class="image wp-image-734  attachment-thumbnail size-thumbnail" alt="" loading="lazy" style="max-width: 100%; height: auto;" srcset="images/ic-consistency-150x150.png 150w, images/ic-consistency.png 280w" sizes="(max-width: 150px) 100vw, 150px"> </div>
                                        </div>
                                        <div class="text-left text-md-center">
                                            <div class="d-block sec2text text-light pb-4"><span class="-title-h2">รองรับทุกการใช้งาน</span>
                                                <div class="textwidget">รองรับทั้งระบบ IOS (ไอโอเอส) และ Android (แอนดรอยด์)</div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </section>
        <style>
            .x-index-tab-container {
                position: relative;
                z-index: 1
            }

            .x-index-tab-container .tab-content .x-tab-index .-bg {
                height: 350px;
                background-size: cover !important;
                background-repeat: no-repeat !important;
                background-position: 50% !important
            }

            .x-index-tab-container .tab-content .x-tab-index .-notice-box {
                position: relative;
                margin-top: 6rem;
                border: 1px solid #003891;
                border-radius: 20px
            }

            .x-index-tab-container .tab-content .x-tab-index .-notice-box .-title {
                position: absolute;
                top: -25px;
                left: 0;
                right: 0;
                margin-left: auto;
                margin-right: auto;
                width: 200px;
                text-align: center
            }

            .x-index-tab-container .tab-content .x-tab-index .-notice-box .-title img {
                width: 160px
            }

            .x-index-tab-container .tab-content .x-tab-index .-notice-box .-mobile-index {
                -webkit-animation: x-floating 6s ease-in-out infinite;
                animation: x-floating 6s ease-in-out infinite;
                position: relative;
                z-index: -2
            }

            .x-index-tab-container .tab-content .x-tab-index .-bottom {
                height: auto;
                background-size: cover !important;
                background-repeat: no-repeat !important;
                background-position: 50% !important
            }

            .x-index-tab-container .tab-content .x-tab-index .-bottom .-scanner {
                width: 80%;
                margin-left: 20%;
                padding: 1.75rem 1rem;
                color: #003891;
                border: 1px solid #003891
            }

            .x-index-tab-container .tab-content .x-tab-index .-bottom .-scanner .-logo {
                width: 100px;
                height: 100px
            }

            .x-index-tab-container .tab-content .x-tab-index .-bottom .-streaming {
                position: relative;
                width: 70%;
                margin-left: 10%
            }

            .x-index-tab-container .tab-content .x-tab-index .-bottom .-streaming .-image {
                width: 100%
            }

            .x-index-tab-container .tab-content .x-tab-index .-bottom .-streaming .-text {
                position: absolute;
                top: 15px;
                left: 230px
            }

            .x-index-tab-container .tab-content .x-tab-index .-bottom .-streaming .-text .-text-detail {
                margin-top: -18px
            }

            @media (max-width:991.98px) {
                .x-index-tab-container .tab-content .x-tab-index .-bg {
                    height: 300px
                }

                .x-index-tab-container .tab-content .x-tab-index .-bottom .-scanner {
                    width: 50%;
                    margin-left: auto;
                    margin-right: auto
                }

                .x-index-tab-container .tab-content .x-tab-index .-bottom .-streaming {
                    width: 80%
                }

                .x-index-tab-container .tab-content .x-tab-index .-bottom .-streaming .-text {
                    top: 30px;
                    left: 300px
                }
            }

            @media (max-width:767.98px) {
                .x-index-tab-container .tab-content .x-tab-index .-bg {
                    height: 200px
                }

                .x-index-tab-container .tab-content .x-tab-index .-notice-box {
                    margin-top: 3rem
                }

                .x-index-tab-container .tab-content .x-tab-index .-bottom .-scanner {
                    width: 100%
                }

                .x-index-tab-container .tab-content .x-tab-index .-bottom .-scanner .-logo {
                    width: 80px;
                    height: 80px
                }

                .x-index-tab-container .tab-content .x-tab-index .-bottom .-streaming .-text {
                    top: 0;
                    left: 0;
                    right: 0
                }

                .x-index-tab-container .tab-content .x-tab-index .-bottom .-streaming .-text .-text-detail {
                    margin-top: -10px
                }
            }

            .x-index-tab-container .tab-content .x-tab-manual {
                position: relative
            }

            .x-index-tab-container .tab-content .x-tab-manual .-bg {
                position: absolute;
                z-index: 2;
                width: 100%;
                height: 300px;
                background: linear-gradient(90deg, #0a1614, #1b3e32)
            }

            .x-index-tab-container .tab-content .x-tab-manual .-container-wrapper {
                position: relative;
                z-index: 3
            }

            .x-index-tab-container .tab-content .x-tab-manual .-container-wrapper .-tabs {
                border-bottom: none
            }

            .x-index-tab-container .tab-content .x-tab-manual .-container-wrapper .-tabs .nav-item {
                min-width: 120px;
                text-align: center
            }

            .x-index-tab-container .tab-content .x-tab-manual .-container-wrapper .-tabs .nav-item .nav-link {
                border-radius: 0;
                color: #003891;
                background-color: rgba(0, 0, 0, .8);
                line-height: 100%;
                padding-top: 15px
            }

            .x-index-tab-container .tab-content .x-tab-manual .-container-wrapper .-tabs .nav-item .nav-link.active {
                border: none;
                color: #000;
                background-color: #003891
            }

            .x-index-tab-container .tab-content .x-tab-manual .-container-wrapper .-tabs .nav-item:hover .nav-link {
                border: none
            }

            .x-index-tab-container .tab-content .x-tab-manual .-container-wrapper .-tabs .nav-item:first-child .nav-link {
                border-top-left-radius: 25px;
                border-bottom-left-radius: 25px
            }

            .x-index-tab-container .tab-content .x-tab-manual .-container-wrapper .-tabs .nav-item:last-child .nav-link {
                border-top-right-radius: 25px;
                border-bottom-right-radius: 25px
            }

            @media (max-width:991.98px) {
                .x-index-tab-container .tab-content .x-tab-manual .-container-wrapper .-tabs .nav-item {
                    width: 33%;
                    min-width: 0
                }

                .x-index-tab-container .tab-content .x-tab-manual .-container-wrapper .-tabs .nav-item .nav-link {
                    padding-left: 10px;
                    padding-right: 10px;
                    font-size: 1.1rem
                }
            }

            .x-index-tab-container .tab-content .x-tab-manual .-container-wrapper .tab-content .x-video-container .-video-outer-wrapper {
                width: 500px;
                border: 1px solid #7e7e7e;
                text-align: center;
                margin-left: auto;
                margin-right: auto;
                background-color: #000
            }

            .x-index-tab-container .tab-content .x-tab-manual .-container-wrapper .tab-content .x-video-container .-video-outer-wrapper:focus {
                outline: none
            }

            .x-index-tab-container .tab-content .x-tab-manual .-container-wrapper .tab-content .x-video-container .-video-outer-wrapper .-video-wrapper video {
                width: 100%
            }

            .x-index-tab-container .tab-content .x-tab-manual .-container-wrapper .tab-content .x-video-container .-video-outer-wrapper .-video-wrapper video:focus {
                outline: none
            }

            @media (max-width:991.98px) {
                .x-index-tab-container .tab-content .x-tab-manual .-container-wrapper .tab-content .x-video-container .-video-outer-wrapper {
                    width: 100%
                }
            }

            .x-index-tab-container .tab-content .x-tab-manual .-container-wrapper .-services .-box a {
                text-decoration: none !important;
                color: #d2d2d2
            }

            .x-index-tab-container .tab-content .x-tab-manual .-container-wrapper .-services .-box .-icon-wrapper .-ic-wrapper {
                height: 100px;
                display: flex;
                justify-content: center;
                align-items: flex-end
            }

            .x-index-tab-container .tab-content .x-tab-manual .-container-wrapper .-services .-box .-icon-wrapper .-ic-wrapper .-ic-bank,
            .x-index-tab-container .tab-content .x-tab-manual .-container-wrapper .-services .-box .-icon-wrapper .-ic-wrapper .-ic-otp,
            .x-index-tab-container .tab-content .x-tab-manual .-container-wrapper .-services .-box .-icon-wrapper .-ic-wrapper .-ic-register {
                width: 100px
            }

            .x-index-tab-container .tab-content .x-tab-manual .-container-wrapper .-services .-box .-icon-wrapper .-ic-wrapper .-ic {
                width: 120px;
                margin-bottom: 1rem
            }

            .x-index-tab-container .tab-content .x-tab-manual .-container-wrapper .-services .-box .-index {
                height: 100%;
                font-size: 4rem;
                padding-right: .5rem;
                margin-right: .5rem;
                color: #fff;
                line-height: 1;
                border-right: 4px solid #003891
            }

            .x-index-tab-container .tab-content .x-tab-manual .-container-wrapper .-services .-box .-detail h3 {
                font-size: 1.75rem
            }

            @media (max-width:767.98px) {
                .x-index-tab-container .tab-content .x-tab-manual .-container-wrapper .-services .-box .-icon-wrapper {
                    display: none !important
                }
            }

            .nav-tabs {
                border-bottom: 1px solid #dee2e6
            }

            .nav-tabs .nav-item {
                margin-bottom: -1px
            }

            .nav-tabs .nav-link {
                border: 1px solid transparent;
                border-top-left-radius: 2px;
                border-top-right-radius: 2px
            }

            .nav-tabs .nav-link:focus,
            .nav-tabs .nav-link:hover {
                border-color: #e9ecef #e9ecef #dee2e6
            }

            .nav-tabs .nav-link.disabled {
                color: #6c757d;
                background-color: transparent;
                border-color: transparent
            }

            .nav-tabs .nav-item.show .nav-link,
            .nav-tabs .nav-link.active {
                color: #495057;
                border-color: #dee2e6 #dee2e6 #000
            }

            .nav-tabs .dropdown-menu {
                margin-top: -1px;
                border-top-left-radius: 0;
                border-top-right-radius: 0
            }

            .x-index-tab-container .x-tab {
                border-bottom: none;
            }

            .pb-3,
            .py-3 {
                padding-bottom: 1rem !important;
            }

            .x-index-tab-container .x-tab .-line-glow {
                display: none
            }

            @media (max-width:991.98px) {
                .x-index-tab-container .x-tab .-line-glow {
                    display: block;
                    position: absolute;
                    top: 0;
                    left: 50%;
                    -webkit-transform: translateX(-50%);
                    transform: translateX(-50%);
                    width: 80%
                }
            }

            @media (max-width:767.98px) {
                .x-index-tab-container .x-tab .-line-glow {
                    width: 95%
                }
            }

            .nav {
                display: flex;
                flex-wrap: wrap;
                padding-left: 0;
                margin-bottom: 0;
                list-style: none;
            }

            .x-index-tab-container .x-tab .nav-item:hover,
            .x-index-tab-container .x-tab .nav-item:hover .nav-link {
                background: transparent
            }

            .x-index-tab-container .x-tab .nav-item:hover .nav-link span {
                color: #fff !important;
                text-shadow: -5px -5px 10px rgba(253, 215, 65, .5), -5px 5px 10px rgba(253, 215, 65, .5), 5px -5px 10px rgba(253, 215, 65, .5), 5px 5px 10px rgba(253, 215, 65, .5), -10px -10px 20px rgba(253, 215, 65, .5), -10px 10px 20px rgba(253, 215, 65, .5), 10px -10px 20px rgba(253, 215, 65, .5), 10px 10px 20px rgba(253, 215, 65, .5)
            }

            .x-index-tab-container .x-tab .nav-item:hover .nav-link .x-hr-border-glow {
                display: none
            }

            .x-index-tab-container .x-tab .nav-item .nav-link {
                margin-top: 10px;
                background: transparent
            }

            .x-index-tab-container .x-tab .nav-item .nav-link.active,
            .x-index-tab-container .x-tab .nav-item .nav-link:hover {
                background: transparent
            }

            .x-index-tab-container .x-tab .nav-item .nav-link.active span,
            .x-index-tab-container .x-tab .nav-item .nav-link:hover span {
                color: #fff !important;
                text-shadow: -5px -5px 10px rgba(253, 215, 65, .5), -5px 5px 10px rgba(253, 215, 65, .5), 5px -5px 10px rgba(253, 215, 65, .5), 5px 5px 10px rgba(253, 215, 65, .5), -10px -10px 20px rgba(253, 215, 65, .5), -10px 10px 20px rgba(253, 215, 65, .5), 10px -10px 20px rgba(253, 215, 65, .5), 10px 10px 20px rgba(253, 215, 65, .5)
            }

            .x-index-tab-container .x-tab .nav-item .nav-link.active .x-hr-border-glow,
            .x-index-tab-container .x-tab .nav-item .nav-link:hover .x-hr-border-glow {
                display: none
            }

            .x-index-tab-container .x-tab .nav-item .nav-link .-ic {
                height: 50px;
                transition: all .6s
            }

            .x-index-tab-container .x-tab .nav-item .nav-link.active {
                border: none;
            }

            @media (max-width:767.98px) {
                .x-index-tab-container .x-tab .nav-item .nav-link .-ic {
                    height: 40px;
                    margin-bottom: 30px;
                }

                .x-index-tab-container .x-tab .nav-item .nav-link span {
                    font-size: 1.1rem
                }
            }

            .x-intro-promotion {
                padding-bottom: 2rem
            }

            .x-intro-promotion .-slick-content .x-promotion-content a {
                color: #eebf13
            }

            .x-intro-promotion .x-alert-info {
                color: #e3a414
            }

            .x-pending .-deposit-preview img {
                width: 200px;
            }

            .w-85 {
                width: 85%;
            }

            .border-dark {
                border-color: #343a40 !important;
            }

            hr {
                margin-top: 1rem;
                margin-bottom: 1rem;
                border: 0;
                border-top: 1px solid rgba(0, 0, 0, .1);
            }
        </style>
        <section>
            <div class="x-index-tab-container">
                <div class="tab-content intabbg">
                    <div class="tab-pane active " id="tab-content-index">
                        <div class="x-tab-index lazyloaded">
                            <?php if ($user) { ?>
                                <section class="-section-wrapper-2">
                                    <div class="-line-separate-container">
                                        <img src="images/line-glow-red.png" class="-red-line" alt="ufacv9 Casino รูปภาพเส้นสีเรืองแสง" width="480" height="104">
                                    </div>
                                    <div class="x-index-tab-container">
                                        <div class="container">
                                            <ul class="nav nav-tabs x-tab py-3">
                                                <img src="build/web/ufacoder/img/line-long-glow.png" alt="Line long glow png" class="-line-glow">
                                                <li class="nav-item  -index js-tab-scrolled" id="tab-index">
                                                    <a href="#" class="nav-link active" data-toggle="modal" data-target="#modal-userinfo">
                                                        <img src="build/web/ufacoder/img/user.png" alt="logo_index" class="-ic"><br>
                                                        <br>

                                                        <span class="d-sm-none d-inline-block mt-2 text-gray-lighter">ข้อมูลบัญชี</span>
                                                        <span class="d-sm-inline-block d-none mt-2 text-gray-lighter">ข้อมูลบัญชี</span>
                                                        <hr class="x-hr-border-glow mb-0">
                                                    </a>
                                                </li>
                                                <li class="nav-item  -index js-tab-scrolled" id="tab-promotion">
                                                    <a href="#" class="nav-link active" data-toggle="modal" data-target="#modal-promotion_register">
                                                        <img src="build/web/ufacoder/img/box-main.png" alt="logo_promotion" class="-ic"><br>
                                                        <br>

                                                        <span class="d-sm-none d-inline-block mt-2 text-gray-lighter">โปรโมชั่นสมาชิกใหม่</span>
                                                        <span class="d-sm-inline-block d-none mt-2 text-gray-lighter">โปรโมชั่นสมาชิกใหม่</span>
                                                        <hr class="x-hr-border-glow mb-0">
                                                    </a>
                                                </li>
                                                <li class="nav-item   -manual js-tab-scrolled" id="tab-manual">
                                                    <a href="#" class="nav-link active" data-toggle="modal" data-target="#modal-promotion_newdate">
                                                        <img src="build/web/ufacoder/img/box-main.png" alt="logo_manual" class="-ic"><br>
                                                        <br>

                                                        <span class="d-sm-none d-inline-block mt-2 text-gray-lighter">ฝากแรกของวัน</span>
                                                        <span class="d-sm-inline-block d-none mt-2 text-gray-lighter">ฝากแรกของวัน</span>
                                                        <hr class="x-hr-border-glow mb-0">
                                                    </a>
                                                </li>
                                                <li class="nav-item   -event js-tab-scrolled" id="tab-event">
                                                    <a href="#" class="nav-link active" data-toggle="modal" data-target="#refFriendModal">
                                                        <img src="build/web/ufacoder/img/box-up.png" alt="logo_event" class="-ic"><br>
                                                        <br>

                                                        <span class="d-sm-inline-block d-none mt-2 text-gray-lighter">แนะนำเพื่อนรับโบนัส</span>
                                                        <span class="d-sm-none d-inline-block mt-2 text-gray-lighter">แนะนำเพื่อนรับโบนัส</span>
                                                        <hr class="x-hr-border-glow mb-0">
                                                    </a>
                                                </li>
                                                <li class="nav-item   -event js-tab-scrolled" id="tab-event">
                                                    <a href="#" class="nav-link active" data-toggle="modal" data-target="#modal-promotion">
                                                        <img src="build/web/ufacoder/img/box-up.png" alt="logo_event" class="-ic"><br>
                                                        <br>

                                                        <span class="d-sm-inline-block d-none mt-2 text-gray-lighter">ฝากต่อเนื่อง</span>
                                                        <span class="d-sm-none d-inline-block mt-2 text-gray-lighter">ฝากต่อเนื่อง</span>
                                                        <hr class="x-hr-border-glow mb-0">
                                                    </a>
                                                </li>
                                                <li class="nav-item   -event js-tab-scrolled" id="tab-event">
                                                    <a href="#" class="nav-link active" data-toggle="modal" data-target="#modal-history">
                                                        <img src="build/web/ufacoder/img/tab_event.png" alt="logo_event" class="-ic"><br>
                                                        <br>

                                                        <span class="d-sm-inline-block d-none mt-2 text-gray-lighter">ประวัติการทำรายการ</span>
                                                        <span class="d-sm-none d-inline-block mt-2 text-gray-lighter">ประวัติการทำรายการ</span>
                                                        <hr class="x-hr-border-glow mb-0">
                                                    </a>
                                                </li>
                                                <li class="nav-item   -event js-tab-scrolled" id="tab-event">
                                                    <a href="#" class="nav-link active" onclick="setData_powyingshup()">
                                                        <img src="images/powyingshup.png" alt="logo_event" class="-ic"><br>
                                                        <br>

                                                        <span class="d-sm-inline-block d-none mt-2 text-gray-lighter">เป่ายิ้งฉุบ</span>
                                                        <span class="d-sm-none d-inline-block mt-2 text-gray-lighter">เป่ายิ้งฉุบ</span>
                                                        <hr class="x-hr-border-glow mb-0">
                                                    </a>
                                                </li>
                                                <li class="nav-item   -event js-tab-scrolled" id="tab-event">
                                                    <a href="game2" class="nav-link active" onclick="login_send_notify()">
                                                        <img src="build/web/ufacoder/img/box-sign-1.png" alt="logo_event" class="-ic"><br>
                                                        <br>

                                                        <span class="d-sm-inline-block d-none mt-2 text-gray-lighter">ทางเข้าเล่นสำรอง</span>
                                                        <span class="d-sm-none d-inline-block mt-2 text-gray-lighter">ทางเข้าเล่นสำรอง</span>
                                                        <hr class="x-hr-border-glow mb-0">
                                                    </a>
                                                </li>
                                                <li class="nav-item   -event js-tab-scrolled" id="tab-event">
                                                    <a href="#" class="nav-link active" onclick="logoutufa()">
                                                        <img src="images/logout.png" alt="logo_event" class="-ic"><br>
                                                        <br>

                                                        <span class="d-sm-inline-block d-none mt-2 text-gray-lighter">ออกจากระบบ</span>
                                                        <span class="d-sm-none d-inline-block mt-2 text-gray-lighter">ออกจากระบบ</span>
                                                        <hr class="x-hr-border-glow mb-0">
                                                    </a>
                                                </li>

                                            </ul>
                                        </div>
                                    </div>
                                </section>

                            <?php } ?>
                            <section class="-section-wrapper-1">
                                <div class="container">
                                    <div class="row -row-wrapper">
                                        <div class="col-12 col-lg-7 -left-container">
                                            <div class="-box-wrapper">
                                                <div class="-description">
                                                    <div class="-title cutcolor">ufacv9</div>
                                                    <div class="textwidget">ให้บริการความสนุกไม่รู้จบ 24 ชม. ไปกับดีลเลอร์ “DEALER” สาวสวย สุดเซ็กซี่ คอยแจกไพ่ ให้คุณได้ลุ้นทุกเกมส์เดิมพัน สบายตา สบายใจ ด้วย สาวๆ น่ารัก สุดเซ็กซี่ มาใส่บิกินี่ แต่ละสีแต่ละวันสีสด มาแจกไพ่ ท่านจะได้รับประสบการณ์ใหม่ในการเดิมพัน</div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 col-lg-5 -right-container">
                                            <div class="-banner-img"><img width="700" height="583" src="images/tab-index-banner-1.png" class="image wp-image-748  attachment-full size-full" alt="" loading="lazy" style="max-width: 100%; height: auto;" srcset="images/tab-index-banner-1.png 700w, images/tab-index-banner-1-300x250.png 300w" sizes="(max-width: 700px) 100vw, 700px"></div>
                                        </div>
                                    </div>
                                </div>
                            </section>
                            <section class="-section-wrapper-2">
                                <div class="-line-separate-container">
                                    <img src="images/line-glow-red.png" class="-red-line" alt="ufacv9 Casino รูปภาพเส้นสีเรืองแสง" width="480" height="104">
                                </div>
                                <div class="container">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="-heading-wrapper">
                                                <div class="-sub-title">
                                                    <div class="-title">ufacv9.com คาสิโน สำหรับทุกคน</div>
                                                    <div class="textwidget">
                                                        <div class="-sub-title">PLATFORM ADVANTAGE</div>
                                                    </div>
                                                </div>
                                            </div>
                                            <ul class="navbar-nav">
                                                <li class="nav-item -hilo">
                                                    <div class="-item-title">AE ไฮโล Hi-Low วางสูงต่ำที่ ufacv9 casino</div><img width="300" height="300" src="images/tab-index-hilo-300x300.png" class="image wp-image-753  attachment-medium size-medium" alt="" loading="lazy" style="max-width: 100%; height: auto;" srcset="images/tab-index-hilo-300x300.png 300w, images/tab-index-hilo-150x150.png 150w, images/tab-index-hilo.png 500w" sizes="(max-width: 300px) 100vw, 300px">
                                                </li>
                                                <li class="nav-item -hilo">
                                                    <div class="-item-title">รูเล็ต เล่นน้อยได้มาก ให้สาวๆ ufacv9 พาคุณรวย</div><img width="300" height="300" src="images/tab-index-rouelete-300x300.png" class="image wp-image-754  attachment-medium size-medium" alt="" loading="lazy" style="max-width: 100%; height: auto;" srcset="images/tab-index-rouelete-300x300.png 300w, images/tab-index-rouelete-150x150.png 150w, images/tab-index-rouelete.png 500w" sizes="(max-width: 300px) 100vw, 300px">
                                                </li>
                                                <li class="nav-item -hilo">
                                                    <div class="-item-title">เออี เซ็กซี่ บาคาร่าออนไลน์ เล่นเว็บตรง ufacv9 ที่นี่</div><img width="300" height="300" src="images/tab-index-baccarat-300x300.png" class="image wp-image-751  attachment-medium size-medium" alt="" loading="lazy" style="max-width: 100%; height: auto;" srcset="images/tab-index-baccarat-300x300.png 300w, images/tab-index-baccarat-150x150.png 150w, images/tab-index-baccarat.png 500w" sizes="(max-width: 300px) 100vw, 300px">
                                                </li>
                                                <li class="nav-item -hilo">
                                                    <div class="-item-title">AE เสือมังกร ลุ้นไว สนุก นิยมมากใน ufacv9 casino</div><img width="300" height="300" src="images/tab-index-dragontiger-300x300.png" class="image wp-image-752  attachment-medium size-medium" alt="" loading="lazy" style="max-width: 100%; height: auto;" srcset="images/tab-index-dragontiger-300x300.png 300w, images/tab-index-dragontiger-150x150.png 150w, images/tab-index-dragontiger.png 500w" sizes="(max-width: 300px) 100vw, 300px">
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </section>
                            <!-- SectionContent -->
                            <div class="container">
                                <div class="mt-3 CTHomePage py-3 px-2 px-md-4">
                                    <div class="HeaderContent">
                                        <div class="textwidget">หน้าหาสาระ</div>
                                    </div>
                                    <p>Last modified August 16th, 2021 at 11:47 pm</p>
                                    <figure class="wp-block-image size-large"><img loading="lazy" width="1024" height="375" src="images/1-1024x375.jpg" alt="" class="wp-image-811" srcset="images/1-1024x375.jpg 1024w, images/1-300x110.jpg 300w, images/1-768x281.jpg 768w, images/1.jpg 1400w" sizes="(max-width: 1024px) 100vw, 1024px"></figure>


                                    <h2> เว็บแทงไก่ชน เล่นพนัน ผ่านมือถือ ถ่ายทอดสด สมัคร UFABET</h2>
                                    <p>เว็บเดิมพันออนไลน์ <strong></strong> UFABET ที่เปิดให้บริการมาอย่างยาวนาน และเป็นเว็บเดิมพันออนไลน์ที่คนไทยส่วนใหญ่นิยมกัน <strong>เล่นพนัน ยูฟ่าเบท ผ่านมือถือ</strong> ก่อนอื่นต้องบอกเลยว่าการเล่นไก่ชนนั้น เป็นการละเล่นที่อยู่คู่คนไทยมาอย่างยาวนาน การเล่นแต่ละครั้งนั้นจะมีกางวางเดิมพันทุกครั้ง นั่นก็ถือว่าเป็นพนันอย่างหนึ่ง จนปัจจุบันได้พัฒนากลายมาเป็นพนันไก่ชนออนไลน์นั่นเอง ต่อไปนี้ไม่ต้องไปเล่นไก่ชนตามบ่อนอีกแล้ว เพียงแค่เข้า<strong> เว็บแทงไก่ชน</strong> คุณสามารถแทงไก่ชนได้ตามที่คุณต้องการ การแทงไก่นั้น สามารถทำกำไรให้คุณได้อย่างมหาศาล เพียงแค่คุณมีเงินลงทุน ไม่มากก็น้อย คุณก็สามารถทำกำไร แต่ทว่าคุณจะต้องมีการบริหารจัดการเงินให้ดีทุกครั้งในการเดิมพัน ซึ่งการบริหารจัดการเงินก่อนลงทุนนั้น จะทำให้คุณได้รับผลตอบแทนกลับไปอย่างมาก บอกเลยว่าเว็บไซต์ของเรา มีเทคนิคการแทงไก่ วิธีการเล่น ให้สมาชิกทุกท่านได้ศึกษาเทคนิคก่อนวางเดิมพัน ก่อนจะเป็นเซียนไก่ชน คุณจะต้องศึกษา ลองวางเดิมพัน เพื่อความชำนาญในการแทงไก่ สามารถดูการแข่งขัน ถ่ายทอดสดออนไลน์ ผ่านเว็บไซต์ของเราได้ตลอด 24 ชั่วโมง ไม่ต้องเดินทางไปบ่อนให้เสียเวลา เพียงแค่คุณสมัครสมาชิกกับเรา คุณก็สามารถเดิมพันไก่ชนได้ตลอดเวลา <strong>สมัครเครดิตฟรี </strong>และท่านจะได้รับสิทธิประโยชน์ดี ๆ อีกมากมาย เว็บไซต์เราเปิดให้บริการเต็มรูปแบบ ครบวงจร นอกจากจะมีแทงไก่ชนแล้ว ยังมีแทงบอลออนไลน์ คาสิโนออนไลน์ มวยออนไลน์ และสล็อตออนไลน์ ด้วยระบบฝากถอนออโต้ รวดเร็วทันใจ ภายใน 3 นาที <strong>รองรับทรูวอลเล็ต True Wallet</strong> เว็บตรง เล่นตรงกับบริษัทแม่ UFABET ไม่ผ่านเอเยนต์ สมัครเลยวันนี้!</p>

                                </div>
                            </div>
                            <!-- SectionContent -->
                            <section class="-section-wrapper-3">
                                <div class="container">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="-banner-img img-fluid"><img width="900" height="450" src="images/tab-index-banner-2.png" class="image wp-image-756  attachment-full size-full" alt="" loading="lazy" style="max-width: 100%; height: auto;" srcset="images/tab-index-banner-2.png 900w, images/tab-index-banner-2-300x150.png 300w, images/tab-index-banner-2-768x384.png 768w" sizes="(max-width: 900px) 100vw, 900px"></div>
                                        </div>
                                        <div class="col-12">
                                            <div class="-description">
                                                <div class="textwidget">เว็บอันดับหนึ่ง ufacv9 ที่รวมสาวสวยมากมายให้ท่านได้ตื่นตาตื่นใจ บาคาร่าออนไลน์ที่ เย้ายวนใจที่สุดในตอนนี้ หรือ ที่รู้จักกันว่า Sexy Baccarat, Sexy Gaming, เออี เซ็กซี่ หรือ เซ็กซี่เกมส์ เออี</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </section>
                        </div>

                    </div>
                </div>
            </div>
        </section>

    </div>
    <script id="b-loading" type="text/template"></script>
    <script id="loading" type="text/template"></script>
    <footer class="x-footer py-3 mt-auto ">
        <div class="-inner-wrapper py-1">
            <div class="-tags-wrapper">
                <div class="container">
                    <div class="row x-footer-seo">


                    </div>
                </div>
            </div>
            <div class="footercontain">
                <div class="disfooterct">
                    <div class="infootergrid pt-3">
                        <div class="mx-auto">
                            <h2 class="widgettitle">ufacv9.com</h2>
                            <img width="300" height="143" src="images/logo.png" class="image wp-image-781  attachment-medium size-medium" alt="" loading="lazy" style="max-width: 100%; height: auto;" srcset="images/logo.png 300w, images/logo.png 640w" sizes="(max-width: 300px) 100vw, 300px">
                        </div>
                    </div>
                    <div class="infootergrid pt-3">
                        <div class="mx-auto">
                            <h2 class="widgettitle">คาสิโนออนไลน์</h2>
                            <div class="textwidget"><strong>เว็บคาสิโน UFABET</strong> เว็บคาิโนอันดับ 1 ของไทย ที่เปิดให้บริการมายาวนานนับ 1 ปี การันตีความสนุกด้วยการรีวิวจากสมาชิก เป็นเว็บที่ให้บริการดี ดูแลสมาชิกทุกท่านให้อยู่ในระดับ VIP ทุกท่าน ซึ่งเว็บเราเปิดให้บริการ</div>
                        </div>
                    </div>
                    <div class="infootergrid pt-3"></div>
                </div>
            </div>

        </div>
    </footer>



    <div class="footermobile">
        <hr class="x-hr-border-glow my-0 mb-1">
        <table class="w-100 text-center">
            <tbody>
                <tr>
                    <?php if (!$user) { ?>
                        <td>
                            <h5><a href="#" data-toggle="modal" data-target="#loginModal">เข้าสู่ระบบ</a></h5><a href="#" data-toggle="modal" data-target="#loginModal"><img width="50" height="50" src="images/ic-menu-login.png" class="image wp-image-796  attachment-full size-full" alt="" loading="lazy" style="max-width: 100%; height: auto;"></a>
                        </td>
                        <td>
                            <h5><a href="#" data-toggle="modal" data-target="#RegisterModal">สมัครสมาชิก</a></h5><a href="#" data-toggle="modal" data-target="#RegisterModal"><img width="50" height="50" src="images/ic-menu-register.png" class="image wp-image-797  attachment-full size-full" alt="" loading="lazy" style="max-width: 100%; height: auto;"></a>
                        </td>
                        <td>
                            <h5><a href="https://line.me/R/ti/p/<?= $line ?>">ติดต่อเรา</a></h5><a href="/"><img width="150" height="150" src="images//Line-1-1.png" class="image wp-image-603  attachment-full size-full" alt="" loading="lazy" style="max-width: 100%; height: auto;"></a>
                        </td>
                    <?php  } else { ?>
                        <td>
                            <h5><a href="#" id="wheelspinufa_2">วงล้อฟรี</a></h5><a href="#" id="wheelspinufa_1"><img width="50" height="50" src="images/icon_wheelspin.png" class="image wp-image-796  attachment-full size-full" alt="" loading="lazy" style="max-width: 100%; height: auto;"></a>
                        </td>
                        <td>
                            <h5><a href="#" data-toggle="modal" data-target="#modal-deposit">ฝากเงิน</a></h5><a href="#" data-toggle="modal" data-target="#modal-deposit"><img width="50" height="50" src="build/web/ufacoder/img/ic_deposit_white2.png" class="image wp-image-797  attachment-full size-full" alt="" loading="lazy" style="max-width: 100%; height: auto;"></a>
                        </td>
                        <td>
                            <h5><a href="#" data-toggle="modal" data-target="#modal-withdraw">ถอนเงิน</a></h5><a href="#" data-toggle="modal" data-target="#modal-withdraw"><img width="150" height="150" src="build/web/ufacoder/img/ic_withdraw_white2.png" class="image wp-image-603  attachment-full size-full" alt="" loading="lazy" style="max-width: 100%; height: auto;"></a>
                        </td>
                    <?php } ?>
                </tr>
            </tbody>
        </table>
    </div>




    <div class="x-wrapper-right-container ">
        <div class="x-contact-us-v2">
            <div class="-link-item -img" aria-label="Contact us LINE image png"><a href="https://line.me/R/ti/p/<?= $line ?>"><img width="225" height="300" src="images/contact-us-1-225x300.png" class="image wp-image-803  attachment-medium size-medium" alt="" loading="lazy" style="max-width: 100%; height: auto;" srcset="images/contact-us-1-225x300.png 225w, images/contact-us-1.png 360w" sizes="(max-width: 225px) 100vw, 225px"></a></div>
        </div>
    </div>
    <!-- Swiper -->




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
                                        <img src="images/register-icon2.png" class="mx-auto d-block register-icon" width="100px" height="100px" alt="register-icon" style="padding: 20px;margin-top: 50px;">
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

    <?php
    if ($user) {
    ?>
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
                                                            <img src="https://ufacv9.com/image/scb2.png" alt="bank-bay" width="50px" class="rounded-circle mr-3">
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
                                                            <img src="https://ufacv9.com/image/ktb.png" alt="bank-bay" width="50px" class="rounded-circle mr-3">
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
                                            <br>
                                            <br>
                                            <br>
                                            <br>
                                            <br>
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
                                                        <img src="https://ufacv9.com/image/scb2.png" alt="bank-bay" width="50px" class="rounded-circle mr-3">
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
                                                        <img src="https://betugame.com/image/scb2.png" alt="bank-bay" width="50px" class="rounded-circle mr-3">
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
                                        <br>
                                        <br>
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
                                        <div class="card card-body bg-dark">
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
                                        </div>
                                    </center>
                                    <p class="text-success">*ไม่ต้องแจ้งโอนเครดิตจะเข้าอัตโนมัติ ต้องโอนจากบัญชีที่สมัครเท่านั้น หากยังไม่ได้รับเครดิตหรือมีปัญหาสงสัย กรุณาเลือกที่เมนูติดต่อเจ้าหน้าที่ 24 ชม. ขอบพระคุณค่ะ</p>
                                    <center>
                                        <h1>
                                            <p class="text-danger">*ห้ามโอนเวลา 23.00 - 00.00 ระบบจะไม่อัพยอด*</p>
                                        </h1>
                                        <button type="button" class="btn btn-danger btn-lg btn-block btn-cancel" data-dismiss="modal"><i class="fas fa-times-circle" style="font-size: 25px;"></i> ปิด </button>
                                    </center>
                                </div>
                            </div>
                        </div>
                    </div>
                    <form id="logout-form" action="api/logout" method="GET" style="display: none;">
                    </form>
                </div>
            </div>
        </div>



        <div class="x-modal modal" id="modal-promotion" tabindex="-1" role="dialog" aria-hidden="true" data-loading-container=".js-modal-content" data-ajax-modal-always-reload="true">
            <div class="modal-dialog modal-dialog modal-lg" role="document" style="">
                <div class="modal-content -modal-content">
                    <img src="build/web/ufacoder/img/border-modal.png" class="img-fluid d-lg-block d-none -border-top-modal" alt="">
                    <button type="button" class="close f-1" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                    <div data-animatable="fadeInModal" data-offset="0" class="-animatable-container animated fadeInModal">
                        <div class="modal-header border-bottom-0 mt-3 pb-0 d-flex flex-column-reverse">
                            <h3 class="m-auto text-white d-inline-block" id="exampleModalCenterTitle">
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
                                            <th scope="col" class="text-center">ได้รับ</th>
                                            <th scope="col" class="text-center">ยอดเติมสะสม</th>
                                            <th scope="col" class="text-center">วันที่ทำรายการ</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $result_pro = $this->user_model->ResultPromotion($user);
                                        foreach ($result_pro as $key => $value) {
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
                                <button id="withdraw" type="submit" class="btn btn-primary -submit" data-disable-on-click>ยืนยัน</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="x-modal modal" id="modal-promotion_register" tabindex="-1" role="dialog" aria-hidden="true" data-loading-container=".js-modal-content" data-ajax-modal-always-reload="true">
            <div class="modal-dialog modal-dialog modal-lg" role="document" style="">
                <div class="modal-content -modal-content">
                    <img src="build/web/ufacoder/img/border-modal.png" class="img-fluid d-lg-block d-none -border-top-modal" alt="">
                    <button type="button" class="close f-1" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                    <div data-animatable="fadeInModal" data-offset="0" class="-animatable-container animated fadeInModal">
                        <div class="modal-header border-bottom-0 mt-3 pb-0 d-flex flex-column-reverse">
                            <h3 class="m-auto text-white d-inline-block" id="exampleModalCenterTitle">
                                <?php
                                $data_pro = $this->admin_model->get_promotions();
                                echo $data_pro[0]['name'] ?>
                                <hr class="x-hr-border-glow">
                            </h3>
                        </div>
                        <div class="modal-body">
                            <div class="form-group mt-1 ml-2 mr-2 mb-2">
                                <h4>รายละเอียดโปรโมชั่น</h4>
                                <img src="<?php echo $data_pro[0]['img_name'] ?>" class="img-fluid d-lg-block d-none " alt="">
                                <textarea id="editor" rows="15" class="form-control" name="text_1"><?php echo $data_pro[0]['text'] ?></textarea>
                                <br>
                                <?php
                                if ($u_pro['pro_id'] == 15) {
                                ?>
                                    <h2 class="text-center" style="color:red;">คุณรับโปรโมชั่นนี้ไปแล้ว จำนวน <span> <?php echo $u_pro['money'] ?></span> บาท </h2>
                                <?php
                                } else {
                                ?>
                                    <button id="pro_register" type="submit" class="btn btn-primary btn-lg btn-block mt-5" data-disable-on-click="">รับเงิน</button>
                                <?php
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="x-modal modal" id="modal-promotion_newdate" tabindex="-1" role="dialog" aria-hidden="true" data-loading-container=".js-modal-content" data-ajax-modal-always-reload="true">
            <div class="modal-dialog modal-dialog modal-lg" role="document" style="">
                <div class="modal-content -modal-content">
                    <img src="build/web/ufacoder/img/border-modal.png" class="img-fluid d-lg-block d-none -border-top-modal" alt="">
                    <button type="button" class="close f-1" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                    <div data-animatable="fadeInModal" data-offset="0" class="-animatable-container animated fadeInModal">
                        <div class="modal-header border-bottom-0 mt-3 pb-0 d-flex flex-column-reverse">
                            <h3 class="m-auto text-white d-inline-block" id="exampleModalCenterTitle">
                                <?php
                                $data_pro_1 = $this->admin_model->get_promotions();
                                echo $data_pro_1[1]['name'] ?>
                                <hr class="x-hr-border-glow">
                            </h3>
                        </div>
                        <div class="modal-body">
                            <div class="form-group mt-1 ml-2 mr-2 mb-2">
                                <h4>รายละเอียดโปรโมชั่น</h4>
                                <img src="<?php echo $data_pro_1[1]['img_name'] ?>" class="img-fluid d-lg-block d-none " alt="">
                                <br>
                                <textarea id="editor" rows="15" class="form-control" name="text_1"><?php echo $data_pro_1[1]['text'] ?></textarea>
                                <br>
                                <?php
                                if ($u_pro_newDate['pro_id'] == 17) {
                                ?>
                                    <h2 class="text-center" style="color:red;">คุณรับโปรโมชั่นนี้ไปแล้ว จำนวน <span> <?php echo $u_pro_newDate['money'] ?></span> บาท </h2>
                                <?php
                                } else {
                                ?>
                                    <button id="pro_newdate" type="submit" class="btn btn-primary btn-lg btn-block mt-5" data-disable-on-click="">รับเงิน</button>
                                <?php
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="x-modal modal" id="modal-promotion_alldate" tabindex="-1" role="dialog" aria-hidden="true" data-loading-container=".js-modal-content" data-ajax-modal-always-reload="true">
            <div class="modal-dialog modal-dialog modal-lg" role="document" style="">
                <div class="modal-content -modal-content">
                    <img src="build/web/ufacoder/img/border-modal.png" class="img-fluid d-lg-block d-none -border-top-modal" alt="">
                    <button type="button" class="close f-1" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                    <div data-animatable="fadeInModal" data-offset="0" class="-animatable-container animated fadeInModal">
                        <div class="modal-header border-bottom-0 mt-3 pb-0 d-flex flex-column-reverse">
                            <h3 class="m-auto text-white d-inline-block" id="exampleModalCenterTitle">
                                <?php
                                $data_pro_1 = $this->admin_model->get_promotions();
                                echo $data_pro_1[2]['name'] ?>
                                <hr class="x-hr-border-glow">
                            </h3>
                        </div>
                        <div class="modal-body">
                            <div class="form-group mt-1 ml-2 mr-2 mb-2">
                                <h4>รายละเอียดโปรโมชั่น</h4>
                                <img src="<?php echo $data_pro_1[2]['img_name'] ?>" class="img-fluid d-lg-block d-none " alt="">
                                <br>
                                <textarea id="editor" rows="15" class="form-control" name="text_1"><?php echo $data_pro_1[2]['text'] ?></textarea>
                                <br>
                                <?php
                                if ($u_pro['pro_id'] == 18) {
                                ?>
                                    <h2 class="text-center" style="color:red;">คุณรับโปรโมชั่นนี้ไปแล้ว จำนวน <span> <?php echo $u_pro['money'] ?></span> บาท </h2>
                                <?php
                                } else {
                                ?>
                                    <button id="pro_alldate" type="submit" class="btn btn-primary btn-lg btn-block mt-5" data-disable-on-click="">รับเงิน</button>
                                <?php
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
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
                                }else if (stripos($dataaff_d, '.0') !== FALSE) {
                                    $dataaff_d = str_replace('.0', '.', $dataaff_d);
                                }else if (substr($dataaff_d, 0, 1) == '.') {
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


        <div class="x-modal modal" id="refModal" tabindex="-1" role="dialog" data-loading-container=".js-modal-content" data-ajax-modal-always-reload="true" style="display: none;" aria-hidden="true">
            <div class="modal-dialog modal-dialog modal-lg" role="document" style="">
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
                                            <i class="fas fa-users" style="font-size:25px;"></i>แนะนำเพื่อน รับโบนัส <?= $dataaff_d ? $dataaff_d : '0'; ?>% ของยอดเติม
                                            <hr class="x-hr-border-glow">
                                        </h3>
                                        <div class="container">
                                        </div>
                                        <!-- 
                    <?= base_url() ?>aff/<?= $info['id'] ?><
                    -->
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
                                <button type="button" class="btn btn-danger btn-lg btn-block btn-cancel -submit" data-dismiss="modal"><i class="fas fa-times-circle" style="font-size: 25px;"></i> ปิด </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- สุ่มวงล้อ -->
        <!--###################################### สุ่มวงล้อ ######################################-->

        <div class="x-modal modal" id="wheelspin" tabindex="-1" data-loading-container=".js-modal-content" data-ajax-modal-always-reload="true" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered -modal-size " role="document" style="padding-top: 60px;background-image: 0 !important;background: 0 !important;">
                <div class="modal-content -modal-content" style="border: 2px solid #fdd741;">
                    <img src="" class="img-fluid d-lg-block d-none -border-top-modal" alt="">
                    <button type="button" class="close f-1" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                    <div class="modal-header border-bottom-0 mt-3 pb-0 d-flex flex-column-reverse">
                        <h3 class="m-auto  d-inline-block" style="color:#fff">
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
                                    <th scope="col" class="text-center" style="color:#e1bd4f;">จำนวนเครดิต</th>
                                    <th scope="col" class="text-center" style="color:#e1bd4f;">วันที่ทำรายการ</th>
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
                color: white;
            }

            .show {
                display: flex;
                align-items: center;
                justify-content: center;
            }

            .show i {
                font-size: 100px;
                color: #fdd741;
            }

            .shows i {
                font-size: 25px;
                color: #fdd741;
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
                background: rgb(15 11 6);
                font-size: 33px;
                color: #fdd741;
            }
        </style>
        <div class="x-modal modal" id="powyingshup" tabindex="-1" data-loading-container=".js-modal-content" data-ajax-modal-always-reload="true" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered -modal-size " role="document" style="padding-top: 60px;background-image: 0 !important;background: 0 !important;">
                <div class="modal-content -modal-content" style="border: 2px solid #fdd741;">
                    <img src="" class="img-fluid d-lg-block d-none -border-top-modal" alt="">
                    <button type="button" class="close f-1" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                    <div class="modal-header border-bottom-0 mt-3 pb-0 d-flex flex-column-reverse">
                        <h3 class="m-auto  d-inline-block" style="color:#fff">
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
                                <div class="show" style="padding: 25px;border-radius: 50%;border: none;outline: none;background: rgb(15 11 6);font-size: 33px;color: orange;">
                                    <i class="fas fa-hand-rock"></i>
                                </div>
                            </div>
                            <!--   The second section     -->
                            <div class="section">
                                <div class="info">
                                    <h3>Computer</h3>
                                </div>
                                <div class="show computer" style="padding: 25px;border-radius: 50%;border: none;outline: none;background: rgb(15 11 6);font-size: 33px;color: orange;">
                                    <i class="fas fa-hand-scissors"></i>
                                </div>
                            </div>
                        </div>
                        <br>
                        <h2 class="text-center" style="color: rgb(233, 33, 19);" id="">เลือกเพื่อเล่น !</h2>
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
                                    <th scope="col" class="text-center" style="color:white;">จำนวนเครดิต</th>
                                    <th scope="col" class="text-center" style="color:white;">ผลการออก</th>
                                    <th scope="col" class="text-center" style="color:white;">วันที่ทำรายการ</th>
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

    <?php
    }
    ?>

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



    <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="build/runtime.1ba6bf05.js"></script>
    <script src="build/0.9a86198d.js"></script>
    <script src="build/home.js?id=156122114"></script>
    <script src="build/3.02782841.js"></script>
    <script src="js/jquery.loadingModal.js"></script>
    <script src="js/superwheel.js"></script> <!-- superWheel -->
    <script src="js/clipboard.min.js"></script>
    <link rel="manifest" href="build/web/ufacoder/img/manifest.js">
    <!-- <script src="js/app.js?id=<?php echo time(); ?>"></script> -->
    <script src="js/ufa.js?id=<?php echo time(); ?>"></script>
    <script src="js/mobile.js?id=57ef7e4ff711266f2358"></script>
    <script src="js/select2.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script src="js/jquery.loadingModal.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
    <script>
        var IS_ANDROID = false;
    </script>
    <script>
        function myFunction() {
            var x = document.getElementById('panel');
            if (x.style.display === 'none') {
                x.style.display = 'block';
            } else {
                x.style.display = 'none';
            }
        }

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
    <script>
        var bank_number21 = parseInt(<?= $bank_info['accnum'] ?>);
        var affid = parseInt(<?= $info['id']?>);
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
        var clipboard3 = new ClipboardJS('#refURL22s', {
            text: function(trigger) {
                return '<?= base_url('aff/' . $info['id']) ?>';
            }
        });
        clipboard3.on('success', function(e) {
            $('#refURL22s').text('[ คัดลอกสำเร็จ! ]')
            setTimeout(function() {
                $('#refURL22s').text('[ คัดลอก ]')
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
                            htm += '<td scope="row" class="text-center" style="color:#fff;">' + result[i].credit + ' เครดิต</td>';
                            htm += '<td scope="row" class="text-center" style="color:#fff;">' + result[i].create_date + '</td>';
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
                            if(data.credit){
                               document.getElementById('btn_wheelspin').innerHTML = '<button type="button" class="btn btn-primary btn-lg btn-block wheel-horizontal-spin-button" style="background: linear-gradient(180deg, rgb(60, 56, 32), rgb(133, 118, 0));color: #fff;border: 1 px solid #f1c40f;">สุ่มวงล้อ</button>'; 
                            }else{
                                document.getElementById('btn_wheelspin').innerHTML = `<button type="button" class="btn btn-primary btn-lg btn-block" style="background: linear-gradient(180deg, rgb(60, 56, 32), rgb(133, 118, 0));color: #fff;border: 1 px solid #f1c40f;" disabled>ต้องมียอดเงินขั้นต่ำ ${data.lowcredit} ถึงหมุนฟรีได้</button>`;
                            }
                            
                        } else {
                            document.getElementById('btn_wheelspin').innerHTML = '<button type="button" class="btn btn-primary btn-lg btn-block" style="background: linear-gradient(180deg, rgb(60, 56, 32), rgb(133, 118, 0));color: #fff;border: 1 px solid #f1c40f;" disabled>วันนี้สุ่มไปแล้ว รอพรุ่งนี้นะคะ</button>';
                        }
                    }
                })
            }

            function showWheelModal() {
                $('#wheelspin').modal({
                    show: true
                });
            }

            $('#wheelspin_pc').click(() => {
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
            $('#wheelspinufa_1').click(() => {
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

            $('#wheelspinufa_2').click(() => {
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
    <?php } ?>
    <?php
    if ($user) {
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
            
            function copyLinkaffs() {
                var copyText = document.getElementById("refURL22s");
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
                            dd = data.data.split('/');
                            $('#turnover').html("ต้องทำ " + data.data)
                        } else {}
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
                                text: data.msg + " " + data.balance + " รอบ"
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
                                success: function(data) {}
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
    <?php } ?>

    <?php

    if ($ufa['username'] != '') {
    ?>
        <script>
            $('#withdraw').click(() => {
                $('#withdraw').attr("disabled", true);
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
                                $('#withdraw').removeAttr("disabled");
                            }
                        }
                    })
                }
            })
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
    <?php
    }
    ?>

    <script>
        $(document).ready(function() {
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
    </script>

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

        // function showAlert() {
        //     var todayDate = new Date().toISOString().slice(0, 10);
        //     $.ajax({
        //         url: 'Apichecktime',
        //         method: 'get',
        //         success: function(data) {
        //             Swal.fire({
        //                 imageUrl: 'https://i.ytimg.com/vi/UCQoJn_4yKg/maxresdefault.jpg',
        //                 title: 'แจ้งเตือนปิดปรับปรุงระบบ',
        //                 html: '<div>แจ้งเตือนปิดปรับปรุงระบบ ในวันที่ [ ' + todayDate + ' วันพุธ]</div>' +
        //                     '<div class="mt-3">ตั้งแต่เวลา 11:00 AM ถึง ' + data.time + ' </div>' +
        //                     '<div class="form-check mt-3">' +
        //                     '<input class="form-check-input js-msg-alert" type="checkbox" value="" id="msg-deposit">' +
        //                     '<label class="form-check-label" for="msg-deposit">' +
        //                     'ไม่ต้องแสดงข้อความนี้อีก' +
        //                     '</label>' +
        //                     '</div>',
        //                 confirmButtonText: 'ปิด'
        //             }).then((result) => {
        //                 if (result.value && $('.js-msg-alert').is(':checked')) {
        //                     $.get('api/hide_alert')
        //                 }
        //             })
        //         }
        //     })
        // }

        // var hour = new Date().getHours();
        // let htm = '';
        // if (document.documentElement.clientWidth <= 992) {
        //     htm = `<span><font color="red">ยกเลิกใช้บัญชีฝาก ขวัญเรือน เหลืองวันทา<br><br><br><br></font></span>`;
        //         `<span>ไห้ลูกค้าฝากเข้าเล่น ที่บันชี SCB <br><br><br><br>
        //         นายอลงกรณ์ คูณโชคชัย 4095628396 เท่านั้น</span>`;
        // } else {
        //     `<span><font color="red">ยกเลิกใช้บัญชีฝาก ขวัญเรือน เหลืองวันทา<br><br><br><br></font></span>`;
        //       `<span>ไห้ลูกค้าฝากเข้าเล่น ที่บันชี SCB <br><br>
        //         นายอลงกรณ์ คูณโชคชัย 4095628396 เท่านั้น</span>`;
        // };
        // Swal.fire(
        //     'แจ้งเตือน !',
        //     document.documentElement.clientWidth <= 992 ? `<span>ยกเลิกใช้บัญชีฝาก ขวัญเรือน เหลืองวันทา<br><br><br><br>
        //         ไห้ลูกค้าฝากเข้าเล่น ที่บันชี SCB <br><br><br><br>
        //         นายอลงกรณ์ คูณโชคชัย 4095628396 เท่านั้น</span>` : `<span>ยกเลิกใช้บัญชีฝาก ขวัญเรือน เหลืองวันทา<br>
        //         ไห้ลูกค้าฝากเข้าเล่น ที่บันชี SCB <br>
        //         นายอลงกรณ์ คูณโชคชัย 4095628396 เท่านั้น</span>`,
        //     'warning'
        // );
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
                            htm += '<td scope="row" class="text-center" style="color:#fff;">' + result[i].credit + ' เครดิต</td>';
                            htm += '<td scope="row" class="text-center" style="color:green;"> ชนะ </td>';
                        } else {
                            htm += '<td scope="row" class="text-center" style="color:#fff;">0 เครดิต</td>';
                            if (result[i].result == 1) {
                                htm += '<td scope="row" class="text-center" style="color:yellow;"> เสมอ </td>';
                            } else {
                                htm += '<td scope="row" class="text-center" style="color:red;"> แพ้ </td>';
                            }

                        }
                        htm += '<td scope="row" class="text-center" style="color:#fff;">' + result[i].date + '</td>';
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
		$(document).ready(function() {

			var owl = $('.owl-carousel');
            owl.owlCarousel({
                autoHeight:true,
                dots: false,
                items:1,
                loop:true,
                autoplay:true,
                autoplayTimeout:5000,
                autoplayHoverPause:true
            });
		});
	</script>
    <!-- This website is like a Rocket, isn't it? Performance optimized by WP Rocket. Learn more: https://wp-rocket.me - Debug: cached@1643721713 -->
</body>

</html>