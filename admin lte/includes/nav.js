let member = parseJwt(sessionStorage.getItem('token'));
let category = [];
let resNav = await callXMLHttpRequest(`${apiPort.apiNav}`, {});
let user = member.username;
let stats = member.stats;
let count = resNav.count;
$(document).ready(function() {
    if (sessionStorage.getItem('category')) {
        let split_category = (sessionStorage.getItem('category')).split(',');
        for (let i = 0; i < split_category.length; i++) {
            if (split_category[i] != '') {
                category.push(split_category[i]);
            }
        }
    }
    let htm = `<header class="header-mobile d-block d-lg-none">
	<div class="header-mobile__bar">
		<div class="container-fluid">
			<div class="header-mobile-inner">
				<a class="logo" href="main">
					<img src="../source/images/logo_backend.png" style="width: auto; height: 72px;" alt="CoolAdmin">
				</a>
				<button class="hamburger hamburger--slider" type="button">
					<span class="hamburger-box">
						<span class="hamburger-inner"></span>
					</span>
				</button>
			</div>
		</div>
	</div>
	<nav class="navbar-mobile">
		<div class="container-fluid">
			<ul class="navbar-mobile__list list-unstyled">`;
    htm += `<li>
			<a href="main">
				<i class="fas fa-tachometer-alt"></i>หน้าแรก</a>
	  </li>`;
    if ((category.indexOf('จัดการสมาชิก') != -1) || (stats == 109 || stats == 99)) {
        htm += `<li>
		<a href="promotion">
			<i class="fas fa-table"></i>จัดการสมาชิก</a>
	</li>`;
    }
    if ((category.indexOf('โปรโมชั่น') != -1) || (stats == 109 || stats == 99)) {
        htm += `<li>
<a href="promotion">
	<i class="fas fa-table"></i>โปรโมชั่น</a>
</li>`;
    }
    if ((category.indexOf('ประวัติรับโปรโมชั่น') != -1) || (stats == 109 || stats == 99)) {
        htm += `<li>
<a href="promotion_history">
	<i class="fas fa-table"></i>ประวัติรับโปรโมชั่น</a>
</li>`;
    }
    if ((category.indexOf('ฝากเงิน') != -1) || (stats == 109 || stats == 99)) {
        htm += `<li>
<a href="Deposit">
	<i class="fas fa-plus"></i>ฝากเงิน</a>
</li>`;
    }
    if ((category.indexOf('ถอนเงิน') != -1) || (stats == 109 || stats == 99)) {
        htm += `<li>
<a href="withdraw">
	<i class="far fa-check-square"></i>ถอนเงิน<span class="ml-1 badge badge-danger" id="checknotifi4">${count}</span></a>
</li>`;
    }
    if ((category.indexOf('รายงานผล') != -1) || (stats == 109 || stats == 99)) {
        htm += `<li>
<a href="result">
	<i class="fas fa-history"></i>รายงานผล</a>
</li>`;
    }
    if ((category.indexOf('รายงานฝากเงิน') != -1) || (stats == 109 || stats == 99)) {
        htm += `<li>
<a href="report_deposit">
	<i class="fas fa-history"></i>รายงานฝากเงิน</a>
</li>`;
    }
    if ((category.indexOf('รายงานถอนเงิน') != -1) || (stats == 109 || stats == 99)) {
        htm += `<li>
<a href="report_withdraw">
	<i class="fas fa-history"></i>รายงานถอนเงิน</a>
</li>`;
    }
    if ((category.indexOf('รายงานการเงิน') != -1) || (stats == 109 || stats == 99)) {
        htm += `<li>
<a href="report_finance">
	<i class="fas fa-history"></i>รายงานการเงิน</a>
</li>`;
    }
    if ((stats == 109 || stats == 99)) {
        htm += `<li>
<a href="report_manual">
	<i class="fas fa-history"></i>รายงานแบบ Manual</a>
</li>`;
    }
    if ((category.indexOf('จัดการพนักงาน') != -1) || (stats == 109 || stats == 99)) {
        htm += `<li>
<a href="staff">
	<i class="fas fa-users"></i>จัดการพนักงาน</a>
</li>`;
    }
    if ((category.indexOf('ประวัติของพนักงาน') != -1) || (stats == 109 || stats == 99)) {
        htm += `<li>
<a href="staff_history">
	<i class="fas fa-desktop"></i>ประวัติการทำงานของพนักงาน</a>
</li>`;
    }
    if ((category.indexOf('ตั้งค่าวงล้อ') != -1) || (stats == 109 || stats == 99)) {
        htm += `<li>
<a href="setting_wheel">
	<i class="fas fa-bullseye"></i>ตั้งค่าวงล้อ</a>
</li>`;
    }
    if ((category.indexOf('รายงานการสุ่มวงล้อ') != -1) || (stats == 109 || stats == 99)) {
        htm += `<li>
<a href="report_wheelspin">
	<i class="fas fa-file-alt"></i>รายงานการสุ่มวงล้อ</a>
</li>`;
    }
    if ((category.indexOf('ตั้งค่าเป่ายิ้งฉุบ') != -1) || (stats == 109 || stats == 99)) {
        htm += `<li>
<a href="../setting_powyingshup">
	<i class="fas fa-bullseye"></i>ตั้งค่าเป่ายิ้งฉุบ</a>
</li>`;
    }
    if ((category.indexOf('รายงานการเล่นเป่ายิ้งฉุบ') != -1) || (stats == 109 || stats == 99)) {
        htm += `<li>
<a href="../report_wheelspin">
	<i class="fas fa-file-alt"></i>รายงานการเล่นเป่ายิ้งฉุบ</a>
</li>`;
    }
    htm += `</ul>
		</div>
	</nav>
</header>
<aside class="menu-sidebar d-none d-lg-block">
	<div class="logo">
		<a href="main">
			<img src="../source/images/logo_backend.png" alt="Cool Admin">
		</a>
	</div>
	<div class="menu-sidebar__content js-scrollbar1 ps">
		<nav class="navbar-sidebar">
			<ul class="list-unstyled navbar__list">`;
    htm += `<li>
			<a href="main">
				<i class="fas fa-tachometer-alt"></i>หน้าแรก</a>
	  </li>`;
    if ((category.indexOf('จัดการสมาชิก') != -1) || (stats == 109 || stats == 99)) {
        htm += `<li>
		<a href="promotion">
			<i class="fas fa-table"></i>จัดการสมาชิก</a>
	</li>`;
    }
    if ((category.indexOf('โปรโมชั่น') != -1) || (stats == 109 || stats == 99)) {
        htm += `<li>
<a href="promotion">
	<i class="fas fa-table"></i>โปรโมชั่น</a>
</li>`;
    }
    if ((category.indexOf('ประวัติรับโปรโมชั่น') != -1) || (stats == 109 || stats == 99)) {
        htm += `<li>
<a href="promotion_history">
	<i class="fas fa-table"></i>ประวัติรับโปรโมชั่น</a>
</li>`;
    }
    if ((category.indexOf('ฝากเงิน') != -1) || (stats == 109 || stats == 99)) {
        htm += `<li>
<a href="Deposit">
	<i class="fas fa-plus"></i>ฝากเงิน</a>
</li>`;
    }
    if ((category.indexOf('ถอนเงิน') != -1) || (stats == 109 || stats == 99)) {
        htm += `<li>
<a href="withdraw">
	<i class="far fa-check-square"></i>ถอนเงิน<span class="ml-1 badge badge-danger" id="checknotifi4">${count}</span></a>
</li>`;
    }
    if ((category.indexOf('รายงานผล') != -1) || (stats == 109 || stats == 99)) {
        htm += `<li>
<a href="result">
	<i class="fas fa-history"></i>รายงานผล</a>
</li>`;
    }
    if ((category.indexOf('รายงานฝากเงิน') != -1) || (stats == 109 || stats == 99)) {
        htm += `<li>
<a href="report_deposit">
	<i class="fas fa-history"></i>รายงานฝากเงิน</a>
</li>`;
    }
    if ((category.indexOf('รายงานถอนเงิน') != -1) || (stats == 109 || stats == 99)) {
        htm += `<li>
<a href="report_withdraw">
	<i class="fas fa-history"></i>รายงานถอนเงิน</a>
</li>`;
    }
    if ((category.indexOf('รายงานการเงิน') != -1) || (stats == 109 || stats == 99)) {
        htm += `<li>
<a href="report_finance">
	<i class="fas fa-history"></i>รายงานการเงิน</a>
</li>`;
    }
    if ((stats == 109 || stats == 99)) {
        htm += `<li>
<a href="report_manual">
	<i class="fas fa-history"></i>รายงานแบบ Manual</a>
</li>`;
    }
    if ((category.indexOf('จัดการพนักงาน') != -1) || (stats == 109 || stats == 99)) {
        htm += `<li>
<a href="staff">
	<i class="fas fa-users"></i>จัดการพนักงาน</a>
</li>`;
    }
    if ((category.indexOf('ประวัติของพนักงาน') != -1) || (stats == 109 || stats == 99)) {
        htm += `<li>
<a href="staff_history">
	<i class="fas fa-desktop"></i>ประวัติการทำงานของพนักงาน</a>
</li>`;
    }
    if ((category.indexOf('ตั้งค่าวงล้อ') != -1) || (stats == 109 || stats == 99)) {
        htm += `<li>
<a href="setting_wheel">
	<i class="fas fa-bullseye"></i>ตั้งค่าวงล้อ</a>
</li>`;
    }
    if ((category.indexOf('รายงานการสุ่มวงล้อ') != -1) || (stats == 109 || stats == 99)) {
        htm += `<li>
<a href="report_wheelspin">
	<i class="fas fa-file-alt"></i>รายงานการสุ่มวงล้อ</a>
</li>`;
    }
    if ((category.indexOf('ตั้งค่าเป่ายิ้งฉุบ') != -1) || (stats == 109 || stats == 99)) {
        htm += `<li>
<a href="../setting_powyingshup">
	<i class="fas fa-bullseye"></i>ตั้งค่าเป่ายิ้งฉุบ</a>
</li>`;
    }
    if ((category.indexOf('รายงานการเล่นเป่ายิ้งฉุบ') != -1) || (stats == 109 || stats == 99)) {
        htm += `<li>
<a href="../report_wheelspin">
	<i class="fas fa-file-alt"></i>รายงานการเล่นเป่ายิ้งฉุบ</a>
</li>`;
    }
    htm += `</ul>
		</nav>
		<div class="ps__rail-x" style="left: 0px; bottom: 0px;">
			<div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div>
		</div>
		<div class="ps__rail-y" style="top: 0px; right: 0px;">
			<div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 0px;"></div>
		</div>
	</div>
</aside>`;
    el('nav2').innerHTML = htm;

    let htm3 = ` <header class="header-desktop">
	<div class="section__content section__content--p30">
		<div class="container-fluid">
			<div class="header-wrap">
				<form class="form-header">
				</form>
				<div class="header-button">
				<div class="noti-wrap">
				<div class="noti__item js-item-menu">
						</div>
						<div class="noti__item js-item-menu">
						</div>
						<div class="noti__item js-item-menu">
						</div>
						<div class="noti__item js-item-menu">
						</div>
						<div class="noti__item js-item-menu" id="nav3-withdraw">
						</div>
					</div>
					<div class="account-wrap" id="nav3-image">
					</div>
				</div>
			</div>
		</div>
	</div>
</header>`;
    el('nav3').innerHTML = htm3;


    // setDataNav2();
    setDataNav3();

});


function setDataNav2() {
    if (sessionStorage.getItem('category')) {
        let split_category = (sessionStorage.getItem('category')).split(',');
        for (let i = 0; i < split_category.length; i++) {
            if (split_category[i] != '') {
                category.push(split_category[i]);
            }
        }
    }
    let htm = '';
    htm += `<li>
					<a href="main">
						<i class="fas fa-tachometer-alt"></i>หน้าแรก</a>
			  </li>`;
    if ((category.indexOf('จัดการสมาชิก') != -1) || (stats == 109 || stats == 99)) {
        htm += `<li>
                <a href="promotion">
                    <i class="fas fa-table"></i>จัดการสมาชิก</a>
            </li>`;
    }
    if ((category.indexOf('โปรโมชั่น') != -1) || (stats == 109 || stats == 99)) {
        htm += `<li>
        <a href="promotion">
            <i class="fas fa-table"></i>โปรโมชั่น</a>
    </li>`;
    }
    if ((category.indexOf('ประวัติรับโปรโมชั่น') != -1) || (stats == 109 || stats == 99)) {
        htm += `<li>
        <a href="promotion_history">
            <i class="fas fa-table"></i>ประวัติรับโปรโมชั่น</a>
    </li>`;
    }
    if ((category.indexOf('ฝากเงิน') != -1) || (stats == 109 || stats == 99)) {
        htm += `<li>
        <a href="Deposit">
            <i class="fas fa-plus"></i>ฝากเงิน</a>
    </li>`;
    }
    if ((category.indexOf('ถอนเงิน') != -1) || (stats == 109 || stats == 99)) {
        htm += `<li>
        <a href="withdraw">
            <i class="far fa-check-square"></i>ถอนเงิน<span class="ml-1 badge badge-danger" id="checknotifi4">${count}</span></a>
    </li>`;
    }
    if ((category.indexOf('รายงานผล') != -1) || (stats == 109 || stats == 99)) {
        htm += `<li>
        <a href="result">
            <i class="fas fa-history"></i>รายงานผล</a>
    </li>`;
    }
    if ((category.indexOf('รายงานฝากเงิน') != -1) || (stats == 109 || stats == 99)) {
        htm += `<li>
        <a href="report_deposit">
            <i class="fas fa-history"></i>รายงานฝากเงิน</a>
    </li>`;
    }
    if ((category.indexOf('รายงานถอนเงิน') != -1) || (stats == 109 || stats == 99)) {
        htm += `<li>
        <a href="report_withdraw">
            <i class="fas fa-history"></i>รายงานถอนเงิน</a>
    </li>`;
    }
    if ((category.indexOf('รายงานการเงิน') != -1) || (stats == 109 || stats == 99)) {
        htm += `<li>
        <a href="report_finance">
            <i class="fas fa-history"></i>รายงานการเงิน</a>
    </li>`;
    }
    if ((stats == 109 || stats == 99)) {
        htm += `<li>
        <a href="report_manual">
            <i class="fas fa-history"></i>รายงานแบบ Manual</a>
    </li>`;
    }
    if ((category.indexOf('จัดการพนักงาน') != -1) || (stats == 109 || stats == 99)) {
        htm += `<li>
        <a href="staff">
            <i class="fas fa-users"></i>จัดการพนักงาน</a>
    </li>`;
    }
    if ((category.indexOf('ประวัติของพนักงาน') != -1) || (stats == 109 || stats == 99)) {
        htm += `<li>
        <a href="staff_history">
            <i class="fas fa-desktop"></i>ประวัติการทำงานของพนักงาน</a>
    </li>`;
    }
    if ((category.indexOf('ตั้งค่าวงล้อ') != -1) || (stats == 109 || stats == 99)) {
        htm += `<li>
        <a href="setting_wheel">
            <i class="fas fa-bullseye"></i>ตั้งค่าวงล้อ</a>
    </li>`;
    }
    if ((category.indexOf('รายงานการสุ่มวงล้อ') != -1) || (stats == 109 || stats == 99)) {
        htm += `<li>
        <a href="report_wheelspin">
            <i class="fas fa-file-alt"></i>รายงานการสุ่มวงล้อ</a>
    </li>`;
    }
    if ((category.indexOf('ตั้งค่าเป่ายิ้งฉุบ') != -1) || (stats == 109 || stats == 99)) {
        htm += `<li>
        <a href="../setting_powyingshup">
            <i class="fas fa-bullseye"></i>ตั้งค่าเป่ายิ้งฉุบ</a>
    </li>`;
    }
    if ((category.indexOf('รายงานการเล่นเป่ายิ้งฉุบ') != -1) || (stats == 109 || stats == 99)) {
        htm += `<li>
        <a href="../report_wheelspin">
            <i class="fas fa-file-alt"></i>รายงานการเล่นเป่ายิ้งฉุบ</a>
    </li>`;
    }

    el('nav-mobile').innerHTML = htm;
    el('nav-pc').innerHTML = htm;

}

function setDataNav3() {
    let textadmins = '';
    if (member.stats == 109) {
        textadmins = '<font color="purple">Admin</font>';
    } else if (member.stats == 99) {
        textadmins = '<font color="green">Admin</font>';
    } else {
        textadmins = '<font color="red">พนักงาน</font>';
    }

    let htm_withdraw = '';
    if (member.stats == 109 || member.stats == 99) {
        htm_withdraw += `
		<a href="../withdraw">
		<i class="zmdi zmdi-notifications"></i>
		<span class="quantity" id="checknotifi">${count}</span>
		</a>
		</div>`;
    }
    el('nav3-withdraw').innerHTML = htm_withdraw;

    let htm_img = '';
    htm_img += `  <div class="account-item clearfix js-item-menu">
	<div class="image">`;
    if (member.stats == 109 || member.stats == 99) {
        htm_img += `<img src="https://cdn2.iconfinder.com/data/icons/banking-glyph-circle/614/981_-_Administration-512.png" alt="${member.username}">`;

    } else {
        htm_img += `<img src="../source/image/staff.png" alt="${member.username}">`;
    }
    htm_img += `  </div>
	<div class="content">
		<a class="js-acc-btn" href="#">${member.username}</a>
	</div>
	<div class="account-dropdown js-dropdown">
		<div class="info clearfix">
			<div class="image">
				<a href="#">`;
    if (member.stats == 109 || member.stats == 99) {
        htm_img += `<img src="https://cdn2.iconfinder.com/data/icons/banking-glyph-circle/614/981_-_Administration-512.png" alt="${member.username}">`;

    } else {
        htm_img += `<img src="../source/images/staff.png" alt="${member.username}">`;
    }
    htm_img += `  </a>
	</div>
	<div class="content">
		<h5 class="name">
			<a href="#">${member.username}</a>
		</h5>
		<span class="email">สถานะ : ${textadmins}</span>
	</div>
</div>`;
    if (member.stats == 109 || member.stats == 99) {
        htm_img += ` <div class="account-dropdown__body">
	<div class="account-dropdown__item">
		<a href="member">
			<i class="zmdi zmdi-account"></i>จัดการผู้ใช้งาน</a>
	</div>
	<div class="account-dropdown__item">
		<a href="main">
			<i class="zmdi zmdi-settings"></i>ตั้งค่าเว็บไซต์</a>
	</div>
	<div class="account-dropdown__item">
		<a href="withdraw">
			<i class="zmdi zmdi-money-box"></i>ถอนเงิน <span class="badge badge-danger" id="checknotifi3"><?= $count['count(*)'] ?></span></a>
	</div>

</div>`;
    }
    htm_img += `<div class="account-dropdown__footer">
<a href="logout">
	<i class="zmdi zmdi-power"></i>Logout</a>
</div>
</div>
</div>`;
    el('nav3-image').innerHTML = htm_img;
}

// setInterval(function() {
// 	$('.check-notifi-status').addClass('fa-spin')
// 	$.ajax({
// 		url: '../Api/notificationsadmin',
// 		method: 'get',
// 		success: function(data) {
// 			$('#checknotifi').html(data.count)
// 			$('#checknotifi2').html(data.count)
// 			$('#checknotifi3').html(data.count)
// 			$('#checknotifi4').html(data.count)
// 			$('#checknotifi5').html(data.count)
// 			$('.check-notifi-status').removeClass('fa-spin')

// 		}
// 	})
// }, 6000);