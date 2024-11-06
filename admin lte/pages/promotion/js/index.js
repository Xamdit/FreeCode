$(document).ready(async function() {
    setData();
    hideLoader();
});

async function setData() {
    let resPromotion = await callXMLHttpRequest(`${apiPort.apiQueryePromotion}`, {});
    if (resPromotion.statusCodeText == textRespone.ok.CodeText) {
        for (let i = 0; i < resPromotion.data.length; i++) {
            el('url_img_' + (i + 1)).value = resPromotion.data[i].img_name;
            el('img_' + (i + 1)).src = resPromotion.data[i].img_name;
            el('name_' + (i + 1)).value = resPromotion.data[i].name;
            el('id_pro_' + (i + 1)).value = resPromotion.data[i].id;
            el('percen_' + (i + 1)).value = resPromotion.data[i].percen;
            el('x_' + (i + 1)).value = resPromotion.data[i].x;
            el('limit_' + (i + 1)).value = resPromotion.data[i].limit_d;
            el('text_' + (i + 1)).value = resPromotion.data[i].text;
            // el('turn_' + (i + 1)).value = resPromotion.data[i].turn;
            el('stats_' + (i + 1)).value = resPromotion.data[i].stats;
        }


    } else if (resPromotion.statusCodeText == "401") {
        Swal.fire({
            title: 'แจ้งเตือน',
            text: resPromotion.description,
            icon: 'error',
            showCancelButton: false,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'OK'
        }).then((result) => {
            if (result.value) {
                sessionStorage.removeItem('token');
                sessionStorage.removeItem('category');
                window.location.href = '../../auth_login/login.html';
            }
        });
    }

}

function uploadPic(id) {
    let img = el('url_img_' + id).value
    el('display_image_' + id).src = img;
    el('display_image_' + id).style.display = 'block';
}

async function updatePromotion(id) {
    let url_img = el('url_img_' + id).value;
    let name = el('name_' + id).value;
    let id_pro = el('id_pro_' + id).value;
    let percen = el('percen_' + id).value;
    let x = el('x_' + id).value;
    let limit = el('limit_' + id).value;
    let text = el('text_' + id).value;
    let turn = 0;
    let stats = el('stats_' + id).value;

    let data = {
        url_img: url_img,
        name: name,
        id_pro: id_pro,
        percen: percen,
        x: x,
        limit: limit,
        text: text,
        turn: turn,
        stats: stats
    };

    let resPromotion = await callXMLHttpRequest(`${apiPort.apiUpdatePromotion}`, data);
    if (resPromotion.statusCodeText == textRespone.ok.CodeText) {
        Swal.fire({
            title: 'แจ้งเตือน',
            text: 'อัพเดตโปรโมชั่่น ' + name + ' เรียบร้อยแล้ว',
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

    } else if (resPromotion.statusCodeText == "401") {
        Swal.fire({
            title: 'แจ้งเตือน',
            text: resPromotion.description,
            icon: 'error',
            showCancelButton: false,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'OK'
        }).then((result) => {
            if (result.value) {
                sessionStorage.removeItem('token');
                sessionStorage.removeItem('category');
                window.location.href = '../../auth_login/login.html';
            }
        });
    } else {
        Swal.fire({
            title: 'แจ้งเตือน',
            text: resPromotion.description,
            icon: 'error',
            showCancelButton: false,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'OK'
        })
    }




}