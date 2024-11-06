$(document).ready(function() {
    let ip = getIPaddress();
    callLogin(ip);

    if (sessionStorage.getItem('token')) {
        window.location.href = '../pages/dashboard';
    }
    //add keypress for put enter and run the function
    $("#username").keypress(function(event) {
        if (event.keyCode == 13) {
            $("#login").click();
        }
    });

    $("#password").keypress(function(event) {
        if (event.keyCode == 13) {
            $("#login").click();
        }
    });

    $("#secert").keypress(function(event) {
        if (event.keyCode == 13) {
            $("#login").click();
        }
    });

    //--------------------------------------------------
    $('#login').click(async function(e) {
        // let str = el('username').value;
        // let res = str.toLowerCase();

        let username = el('username').value;
        let password = el('password').value;
        let secert = el('secert').value;
        let data = {
            username: username,
            password: password,
            ip: getIPaddress(),
            secert: secert
        };
        let resLogin = await callXMLHttpRequest(`${apiPort.apiLogin}`, data);
        if (resLogin.statusCodeText == textRespone.ok.CodeText) {
            let token = parseJwt(resLogin.token);
            if (token.stats == 99 || token.stats == 109 || token.stats == 0) {
                sessionStorage.setItem('token', resLogin.token);
                if (resLogin.category) {
                    sessionStorage.setItem('category', resLogin.category);
                }
                Swal.fire({
                    title: 'แจ้งเตือน',
                    text: resLogin.description,
                    icon: 'success',
                    showCancelButton: false,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'OK'
                }).then((result) => {
                    if (result.value) {
                        window.location.href = '../pages/dashboard'
                    }
                });
            } else {
                Swal.fire({
                    title: 'แจ้งเตือน',
                    text: 'ไม่ได้รับสิทธิ์เข้าถึง',
                    icon: 'error',
                    showCancelButton: false,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'OK'
                }).then((result) => {
                    if (result.value) {
                        el('username').value = '';
                        el('password').value = '';
                        el('secert').value = '';
                    }
                });
            }
        } else {
            Swal.fire({
                title: 'แจ้งเตือน',
                text: resLogin.description,
                icon: 'error',
                showCancelButton: false,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'OK'
            }).then((result) => {
                if (result.value) {
                    el('username').value = '';
                    el('password').value = '';
                    el('secert').value = '';
                }
            });
        }
    });
});

async function callLogin(ip) {
    await callXMLHttpRequest(`${apiPort.apiCreateSite}`, ip);
}