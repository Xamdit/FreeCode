$(document).on('submit', function(e) {
    e.preventDefault();
    var username = $("#phone").val();
    var password = $("#password_m").val();
    login(username, password);
})

function check_phone() {
    var phone = $("#phone_otp").val();
    var regExp = /^0[0-9]{9}$/i;
    if (phone.length == 10) {
        if (regExp.test(phone)) {
            $("#RegisterModal").modal('hide');
            $("#get_bank").modal('show');

        } else {
            Swal.fire({
                icon: 'error',
                title: 'เกิดข้อผิดพลาด',
                text: 'เบอร์ไม่ถูกต้อง'
            })
        }
    } else {
        Swal.fire({
            icon: 'error',
            title: 'เกิดข้อผิดพลาด',
            text: 'กรุณากรอก เบอร์มือถือ 10 หลัก'
        })
    }

}

function get_name() {
    var e = document.getElementById("select");
    var bank_name = e.options[e.selectedIndex].value; //ธนาคาร
    var bank_number = $("#bank_number").val();
    localStorage.setItem("bank_name", bank_name);


    if (bank_number == "") {
        Swal.fire({
            icon: 'error',
            title: 'เกิดข้อผิดพลาด',
            text: 'กรุณากรอก เลขบัญชี'
        })
        return false
    } else if (bank_name == "เลือก ธนาคาร") {
        Swal.fire({
            icon: 'error',
            title: 'เกิดข้อผิดพลาด',
            text: 'กรุณาเลือก ธนาคาร'
        })
        return false
    }


    showModal()
    $.ajax({
        url: 'https://ufacv9.com/api/check_bank',
        type: 'POST',
        data: {
            bank_name: bank_name,
            bank_number: bank_number
        },

        success: function(obj) {

            if (obj != "") {

                var msg = obj.msg
                var status = obj.status
                if (status == 200) {
                    document.getElementById("fname").value = obj.name;
                    document.getElementById("fname").disabled = true;
                    $('#get_bank').modal('hide');
                    $('#register_Modal').modal('show');
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'เกิดข้อผิดพลาด',
                        text: msg

                    })
                    $('body').loadingModal('hide');
                    $('body').loadingModal('destroy');


                }

            }

            $('body').loadingModal('hide');
            $('body').loadingModal('destroy');


        }


    });


}

function register() {
    var phone = $("#phone_otp").val();
    var fname = $("#fname").val();
    var password = $("#r_password").val();
    var password2 = $("#r_password2").val();
    var bank_number = $("#bank_number").val();
    var line = $("#line").val();
    // var username=$("#username").val();
    var bank_name = localStorage.getItem("bank_name");
    var ref = localStorage.getItem("ref");

    // var eng = /^([a-zA-Z])+$/;

    // if (!(eng.test(document.all.username.value)))
    // {
    //   Swal.fire({
    //     icon: 'error',
    //     title: 'เกิดข้อผิดพลาด',
    //     text:'กรุณากรอกเป็นภาษาอังกฤษด้วย'
    //   })

    //   document.all.username.select();

    //   return false;
    // }



    var e = document.getElementById("select_promotion");
    var promotion = e.options[e.selectedIndex].value; //ธนาคาร
    if (phone == "") {
        Swal.fire({
            icon: 'error',
            title: 'เกิดข้อผิดพลาด',
            text: 'กรุณากรอก username'
        })
        return false
    } else if (password == "") {
        Swal.fire({
            icon: 'error',
            title: 'เกิดข้อผิดพลาด',
            text: 'กรุณากรอก password'
        })
        return false
    } else if (line == "") {
        Swal.fire({
            icon: 'error',
            title: 'เกิดข้อผิดพลาด',
            text: 'กรุณากรอก ไอดีไลน์'
        })
        return false
    } else if (line.length <= 4) {
        Swal.fire({
            icon: 'error',
            title: 'เกิดข้อผิดพลาด',
            text: 'กรุณากรอกไอดีไลน์ที่ถูกต้อง'

        })
        return false

    } else if (password != password2) {
        Swal.fire({
            icon: 'error',
            title: 'เกิดข้อผิดพลาด',
            text: 'รหัสผ่านไม่ตรงกัน'

        })
        return false

    } else if (password.length < 7) {
        Swal.fire({
            icon: 'error',
            title: 'เกิดข้อผิดพลาด',
            text: 'ความยาว password 8-15 ตัวเท่านั้น'

        })
        return false

    } else if (password == '' || password2 == '') {
        Swal.fire({
            icon: 'error',
            title: 'เกิดข้อผิดพลาด',
            text: 'กรุณาใส่รหัสให้ครบถ้วน'

        })
        return false
    }


    showModal()
    $.ajax({
        url: 'api/register',
        type: 'POST',
        data: {
            fname: fname,
            password: password,
            password2: password2,
            bank_number: bank_number,
            bank_name: bank_name,
            promotion: promotion,
            username: phone,
            line: line,
            ref: ref
        },

        success: function(obj) {

            if (obj != "") {

                var msg = obj.msg
                var status = obj.status
                if (status) {
                    $('body').loadingModal('hide');
                    $('body').loadingModal('destroy');
                    $('#confirm_otpModal').modal('hide');
                    $('#register_Modal').modal('show');
                    Swal.fire({
                        title: 'แจ้งเตือน',
                        text: 'สมัครสมาชิกสำเร็จ',
                        icon: 'success',
                        showCancelButton: false,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'OK'
                    }).then((result) => {
                        if (result.value) {
                            window.location.reload();
                        }
                    });

                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'เกิดข้อผิดพลาด',
                        text: msg

                    })
                    $('body').loadingModal('hide');
                    $('body').loadingModal('destroy');


                }

            }

            $('body').loadingModal('hide');
            $('body').loadingModal('destroy');


        }


    });


}


function login(username, password) {


    // grecaptcha

    //   .execute(re_sitekey, {

    //     action: "homepage",

    //   })

    //   .then(function (token) {

    if (username == "") {

        Swal.fire({
            icon: 'error',
            title: 'เกิดข้อผิดพลาด',
            text: 'กรุณากรอก เบอร์โทรศัพท์'

        })
        return false

    } else if (password == "") {
        Swal.fire({
            icon: 'error',
            title: 'เกิดข้อผิดพลาด',
            text: 'กรุณากรอก รหัสผ่าน'

        })
        return false

    } else {

        $.ajax({

            url: "api/login",

            method: "post",

            data: {

                username: username,

                password: password,

                token: ""

            },

            success: function(data) {

                if (data.status == true) {

                    Swal.fire({
                        title: 'แจ้งเตือน',
                        text: data.msg,
                        icon: 'success',
                        showCancelButton: false,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'OK'
                    }).then((result) => {
                        if (result.value) {
                            window.location.reload();
                        }
                    });

                } else {

                    Swal.fire({
                        icon: 'error',
                        title: 'เกิดข้อผิดพลาด',
                        text: data.msg

                    })

                }

            },

        });

    }


}