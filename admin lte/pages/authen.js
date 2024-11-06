// let member = parseJwt(sessionStorage.getItem('token'));
async function showLoader() {
    $(".loader").fadeIn();
}

async function hideLoader() {
    $(".loader").fadeOut("slow");
}

showLoader();

// let member = sessionStorage.getItem('token');
// $(document).ready(async function() {
//     if (!member) {
//         window.location.href = '../../auth_login/login.html';
//     }
// });