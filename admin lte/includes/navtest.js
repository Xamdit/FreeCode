let member_nav = parseJwt(sessionStorage.getItem('token'));
let category = [];
let resNav = callXMLHttpRequest(`${apiPort.apiNav}`, {});
let user = member_nav.username;
let stats = member_nav.stats;
let count = resNav.count;
let sound = new Audio('../../assets/ringtones/withdraw.mp3');
document.getElementsByTagName('title')[0].innerHTML = 'Backend System .::.  By  Bevennes';
$(document).ready(function() {

    // let timerInterval
    // Swal.fire({
    //     title: 'Loading...',
    //     html: '<b></b> milliseconds.',
    //     timer: 2500,
    //     timerProgressBar: true,
    //     didOpen: () => {
    //         Swal.showLoading()
    //         const b = Swal.getHtmlContainer().querySelector('b')
    //         console.log();
    //         timerInterval = setInterval(() => {
    //             b.textContent = Swal.getTimerLeft()
    //             if(b.textContent == 'Token not Found'){
    //                 console.log(true);
    //             }
    //         }, 100)
    //     },
    //     willClose: () => {
    //         clearInterval(timerInterval)
    //     }
    // }).then((result) => {
    //     /* Read more about handling dismissals below */
    //     if (result.dismiss === Swal.DismissReason.timer) {

    //     }
    // })
    setDataNav();

    // el('nav-bar').innerHTML = htm;

    if (member_nav.stats == 109 || member_nav.stats == 99) {
        el('nav-img').src = 'https://cdn2.iconfinder.com/data/icons/banking-glyph-circle/614/981_-_Administration-512.png';
    } else {
        el('nav-img').src = '../../source/images/staff.png';
    }
    let textadmins = '';
    if (member_nav.stats == 109) {
        textadmins = '<font color="pink">Programmer</font>';
    } else if (member_nav.stats == 99) {
        textadmins = '<font color="green">Admin</font>';
    } else {
        textadmins = '<font color="red">พนักงาน</font>';
    }
    el('nav-username').innerHTML = `<span onclick="changepass(${member_nav.id})">${member_nav.username} ( ${textadmins} )</span>`;

});

function setDataNav() {
    if (sessionStorage.getItem('category')) {
        let split_category = (sessionStorage.getItem('category')).split(',');
        for (let i = 0; i < split_category.length; i++) {
            if (split_category[i] != '') {
                category.push(split_category[i]);
            }
        }
    }

    let htm = `<li class="nav-item">
			<a href="../dashboard" class="nav-link">
				<i class="nav-icon fas fa-tachometer-alt"></i><p>หน้าแรก</p></a>
	  </li>`;


    htm += `<li class="nav-item">
    <a href="#" class="nav-link">
    <i class="nav-icon fas fa-users"></i>
    <p>
    สมาชิก
    <i class="right fas fa-angle-left"></i>
    </p>
    </a>
    <ul class="nav nav-treeview">`;
    if ((category.indexOf('จัดการสมาชิก') != -1) || (stats == 109 || stats == 99)) {
        htm += `<li class="nav-item">
		<a href="../members" class="nav-link">
			<i class="nav-icon far fa-circle"></i><p>จัดการสมาชิก</p></a>
	</li>`;
    }
    if ((category.indexOf('จัดการพนักงาน') != -1) || (stats == 109 || stats == 99)) {
        htm += `<li class="nav-item">
<a href="../staff" class="nav-link">
	<i class="nav-icon far fa-circle"></i><p>จัดการพนักงาน</p></a>
</li>`;
    }
    htm += `</li>
    </ul>`;
    if ((category.indexOf('โปรโมชั่น') != -1) || (stats == 109 || stats == 99)) {
        htm += `<li class="nav-item">
<a href="../promotion" class="nav-link">
	<i class="nav-icon fas fa-table"></i><p>โปรโมชั่น</p></a>
</li>`;
    }
    if ((category.indexOf('ประวัติรับโปรโมชั่น') != -1) || (stats == 109 || stats == 99)) {
        htm += `<li class="nav-item">
<a href="../promotion_history" class="nav-link">
	<i class="nav-icon fas fa-table"></i><p>ประวัติรับโปรโมชั่น</p></a>
</li>`;
    }
    if ((category.indexOf('ฝากเงิน') != -1) || (stats == 109 || stats == 99)) {
        htm += `<li class="nav-item">
<a href="../deposit" class="nav-link">
	<i class="nav-icon fas fa-plus"></i><p>ฝากเงิน</p></a>
</li>`;
    }
    if ((category.indexOf('ถอนเงิน') != -1) || (stats == 109 || stats == 99)) {
        htm += `<li class="nav-item">
<a href="../withdraw" class="nav-link">
	<i class="nav-icon far fa-check-square"></i><p>ถอนเงิน<span class="ml-1 badge badge-danger" id="checknotifi4">${count}</span></p></a>
</li>`;
    }
    htm += `<li class="nav-item">
<a href="#" class="nav-link">
<i class="nav-icon fas fa-history"></i>
<p>
รายงาน
<i class="right fas fa-angle-left"></i>
</p>
</a>
<ul class="nav nav-treeview">`;
    if ((category.indexOf('รายงานผล') != -1) || (stats == 109 || stats == 99)) {
        htm += `<li class="nav-item">
<a href="../result" class="nav-link">
	<i class="nav-icon far fa-circle"></i><p>รายงานผล</p></a>
</li>`;
    }
    if ((category.indexOf('รายงานฝากเงิน') != -1) || (stats == 109 || stats == 99)) {
        htm += `<li class="nav-item">
<a href="../report_deposit" class="nav-link">
	<i class="nav-icon far fa-circle"></i><p>รายงานฝากเงิน</p></a>
</li>`;
    }
    if ((category.indexOf('รายงานถอนเงิน') != -1) || (stats == 109 || stats == 99)) {
        htm += `<li class="nav-item">
<a href="../report_withdraw" class="nav-link">
	<i class="nav-icon far fa-circle"></i><p>รายงานถอนเงิน</p></a>
</li>`;
    }
    if ((category.indexOf('รายงานการเงิน') != -1) || (stats == 109 || stats == 99)) {
        htm += `<li class="nav-item">
<a href="../report_finance" class="nav-link">
	<i class="nav-icon far fa-circle"></i><p>รายงานการเงิน</p></a>
</li>`;
    }
    if ((category.indexOf('รายงานยอดเทิร์น') != -1) || (stats == 109 || stats == 99)) {
        htm += `<li class="nav-item">
<a href="../report_turnover" class="nav-link">
	<i class="nav-icon far fa-circle"></i><p>รายงานยอดเทิร์น</p></a>
</li>`;
    }
    if ((stats == 109 || stats == 99)) {
        htm += `<li class="nav-item">
<a href="../report_manual" class="nav-link">
	<i class="nav-icon far fa-circle"></i><p>รายงานแบบ Manual</p></a>
</li>`;
    }
    htm += `</li>
    </ul>`;
    if ((category.indexOf('ประวัติของพนักงาน') != -1) || (stats == 109 || stats == 99)) {
        htm += `<li class="nav-item">
<a href="../staff_history" class="nav-link">
	<i class="nav-icon fas fa-desktop"></i><p>ประวัติการทำงานของพนักงาน</p></a>
</li>`;
    }
    htm += `<li class="nav-item">
    <a href="#" class="nav-link">
    <i class="nav-icon fas fa-bullseye"></i>
    <p>
    ตั้งค่าเกมส์
    <i class="right fas fa-angle-left"></i>
    </p>
    </a>
    <ul class="nav nav-treeview">`;
    if ((category.indexOf('ตั้งค่าวงล้อ') != -1) || (stats == 109 || stats == 99)) {
        htm += `<li class="nav-item">
<a href="../setting_wheel" class="nav-link">
	<i class="nav-icon far fa-circle"></i><p>ตั้งค่าวงล้อ</p></a>
</li>`;
    }
    if ((category.indexOf('ตั้งค่าเป่ายิ้งฉุบ') != -1) || (stats == 109 || stats == 99)) {
        htm += `<li class="nav-item">
<a href="../setting_powyingshup" class="nav-link">
	<i class="nav-icon far fa-circle"></i><p>ตั้งค่าเป่ายิ้งฉุบ</p></a>
</li>`;
    }
    htm += `</li>
    </ul>`;

    htm += `<li class="nav-item">
    <a href="#" class="nav-link">
    <i class="nav-icon fas fa-file-alt"></i>
    <p>
    รายงานการเล่น
    <i class="right fas fa-angle-left"></i>
    </p>
    </a>
    <ul class="nav nav-treeview">`;
    if ((category.indexOf('รายงานการสุ่มวงล้อ') != -1) || (stats == 109 || stats == 99)) {
        htm += `<li class="nav-item">
<a href="../report_wheelspin" class="nav-link"> 
	<i class="nav-icon far fa-circle"></i><p>รายงานการสุ่มวงล้อ</p></a>
</li>`;
    }
    if ((category.indexOf('รายงานการเล่นเป่ายิ้งฉุบ') != -1) || (stats == 109 || stats == 99)) {
        htm += `<li class="nav-item">
<a href="../report_powyingshup" class="nav-link">
	<i class="nav-icon far fa-circle"></i><p>รายงานการเล่นเป่ายิ้งฉุบ</p></a>
</li>`;
    }
    htm += `</li>
    </ul>`;
    if ((stats == 109 || stats == 99)) {
        htm += `<li class="nav-item">
    <a href="../alliance" class="nav-link">
        <i class="nav-icon fas fa-tachometer-alt"></i><p>ระบบพันธมิตร</p></a>
</li>`;
    }
    htm += `
    <li class="nav-header">ผู้ใช้งาน</li>
    <li class="nav-item">
    <a href="#" class="nav-link" onclick="logout()">
        <i class="nav-icon far fa-solid fa-right-from-bracket"></i><p>ออกจากระบบ</p></a>
    </li>`;
    el('nav-bar').innerHTML = htm;
}


setInterval(function() {
    $('.check-notifi-status').addClass('fa-spin')
    resNav = callXMLHttpRequest(`${apiPort.apiNav}`, {});
    if (resNav.statusCodeText == textRespone.ok.CodeText) {
        if (count < resNav.count) {
            sound.play();
        }
        count = resNav.count;
        el('checknotifi4').innerHTML = count;
    } else {
        sessionStorage.removeItem('token');
        sessionStorage.removeItem('category');
        window.location.href = '../../auth_login/login.html';
    }

}, 6000);



function logout() {

    Swal.fire({
        title: 'แจ้งเตือน',
        text: "คุณต้องการที่จะออกจากระบบหรือไม่ ?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#28a745',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Logout'
    }).then((result) => {
        if (result.isConfirmed) {
            Swal.fire(
                'แจ้งเตือน',
                'ออกจากระบบเรียบร้อยแล้ว',
                'success'
            ).then((result) => {
                if (result.value) {
                    sessionStorage.removeItem('token');
                    sessionStorage.removeItem('category');
                    window.location.href = '../../auth_login/login.html';
                }
            });
        }
    })
}


async function changepass(id) {
    Swal.fire({
            title: 'ใส่รหัสผ่านใหม่ที่ต้องการ',
            input: 'text',
            inputAttributes: {
                autocapitalize: 'off'
            },
            showCancelButton: true,
            confirmButtonText: 'ยืนยัน',
            showLoaderOnConfirm: true,
            preConfirm: async(newpass) => {
                return await callXMLHttpRequest(`${apiPort.apiChangePass}`, { id: id, newpass: newpass });
            },
            allowOutsideClick: () => !Swal.isLoading()
        }).then((result) => {
            console.log(result);
            if (result.isConfirmed && result.value.statusCode === 200) {
                Swal.fire(
                    'แจ้งเตือน',
                    `${result.value.data}`,
                    'success'
                ).then(() => {
                    sessionStorage.removeItem('token');
                    sessionStorage.removeItem('category');
                    window.location.href = '../../auth_login/login.html';
                })
            }
        })
        // let res = await callXMLHttpRequest(`${apiPort.apiChangePass}`, { id: id, newpass: newpass });
}