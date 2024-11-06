async function login() {
    let str = document.getElementById('username').value;
    // let saveuser = el('saveuser');
    let res = str.toUpperCase();
    let username = res;
    let password = document.getElementById('password').value;
    // data.username = username;
    // data.password = password;

    if (username) {
        if (password) {
            // let result = await callXMLHttpRequest(`${apiPort.ipPort}/login`, data);
            let result = {
                codeText: 200,
                token: 'eeeeeeeeeeeeeeeeeeeeeeeeeeee'
            };
            if (result.codeText == 200) {
                // let token = parseJwt(result.token);
                sessionStorage.setItem('token', result.token);
                toastr.success('เข้าสู่ระบบเรียบร้อย');
                setTimeout(() => {
                    location.href = 'pages/dashboard/'
                }, 800)
            } else {
                toastr.error('ไม่สามารถเข้าสู่ระบบได้');
            }
        } else {
            toastr.error('กรุณาใส่ Password ด้วยค่ะ');
        }
    } else {
        toastr.error('กรุณาใส่ Username ด้วยค่ะ');
    }


}