/**###########################################################################################################################
#                                                           README                                                           #
############################################################################################################################*/
/**
 * PLEASE READ MESSAGE BELOW BEFORE YOU EDIT CODE.
 * IF YOU DON'T UNDERSTAND SOME OR MORE CODE PLEASE CONTACT ME BEFORE YOUR EDITTING. MOSCOW DEV.
 */

/**###########################################################################################################################
#                                                          Edit Log                                                          #
############################################################################################################################*/

/**###########################################################################################################################
#                                                  Initail Html Component                                                    #
############################################################################################################################*/
(function() {
    web_title(function(res1) {
        if (!sessionStorage.getItem('token')) {
            header(function(res2) {
                page_head(function(res3) {
                    side_nav(function(res4) {
                        footer(function(res5) {
                            menu(function(res) {

                                $('#page_name').text($('#' + $('[path="..' + window.location.pathname + '"]').attr('id')).text())
                                if ($('#' + $('[path="..' + window.location.pathname + '"]').attr('id')).attr('lv') === 'level_1') {
                                    $('#level_1').text($('#' + $('[path="..' + window.location.pathname + '"]').attr('id')).text())
                                    $('#' + $('[path="..' + window.location.pathname + '"]').attr('id')).parent().parent().addClass('active-sub active')
                                    $('#' + $('[path="..' + window.location.pathname + '"]').attr('id')).parent().addClass('collape in')
                                    $('#' + $('[path="..' + window.location.pathname + '"]').attr('id')).addClass('active-link')
                                    $("body").append('<script src="../source/js/nifty.min.js"></script>');
                                } else if ($('#' + $('[path="..' + window.location.pathname + '"]').attr('id')).attr('lv') === 'level_2') {
                                    $('#level_1').text($('#' + $('#' + $('[path="..' + window.location.pathname + '"]').attr('id')).parent().parent().attr('id')).find('.menu-title').text())
                                    $('#level_2').removeClass('hide');
                                    $('#level_2').text($('#' + $('[path="..' + window.location.pathname + '"]').attr('id')).text())
                                    $('#' + $('[path="..' + window.location.pathname + '"]').attr('id')).parent().parent().addClass('active-sub active')
                                    $('#' + $('[path="..' + window.location.pathname + '"]').attr('id')).parent().addClass('collape in')
                                    $('#' + $('[path="..' + window.location.pathname + '"]').attr('id')).addClass('active-link')
                                    $("body").append('<script src="../source/js/nifty.min.js"></script>');
                                } else {
                                    $('#page_name').text(localStorage.getItem('lv2'))
                                    $('#level_1').text(localStorage.getItem('lv1'));
                                    $('#level_2').removeClass('hide');
                                    $('#level_2').text(localStorage.getItem('lv2'));
                                    $('#' + localStorage.getItem('pathname')).parent().parent().addClass('active-sub active')
                                    $('#' + localStorage.getItem('pathname')).parent().addClass('collape in')
                                    $('#' + localStorage.getItem('pathname')).addClass('active-link')
                                    $("body").append('<script src="../source/js/nifty.min.js"></script>');

                                }
                            });
                        });
                    });
                });
            });
        } else {
            logout();
        }
    });
})();

function web_title(callback) {
    $('title').text('BEP - Back End Platform');
    callback(true)
}

function header(callback) {
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && xhr.status == 200) {
            document.getElementById('header').innerHTML = xhr.responseText;
            callback(true);
        }
    }
    xhr.open('GET', '../source/html/header.html', true);
    xhr.send();
}

function page_head(callback) {
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && xhr.status == 200) {
            document.getElementById('page-head').innerHTML = xhr.responseText;
            callback(true);
        }
    }
    xhr.open('GET', '../source/html/page_head.html', true);
    xhr.send();
}

function side_nav(callback) {
    if (sessionStorage.getItem('token')) {
        var staffData = getStaffData();
        var defaultIMG = "../source/img/profile-photos/1.png";

        var xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function() {
            if (xhr.readyState == 4 && xhr.status == 200) {
                document.getElementById('side_nav').innerHTML = xhr.responseText;
                $('#name_nav').text(staffData.firstname + " " + staffData.lastname)
                $('#position_nav').text(staffData.position)
                if (staffData._id && staffData.img_profile) {
                    document.getElementById('img_nav').setAttribute('src', staffData.img_profile)
                } else if (staffData._id && !staffData.img_profile) {
                    document.getElementById('img_nav').setAttribute('src', defaultIMG)
                }
                callback(true);
            }
        }
        xhr.open('GET', '../source/html/side_nav.html', true);
        xhr.send();
    } else {
        logout();
    }
}

function footer(callback) {
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && xhr.status == 200) {
            document.getElementById('footer').innerHTML = xhr.responseText;
            document.querySelector('#footer > p').innerHTML = `&#0169; ${new Date().getFullYear()}, Game Wave Technology Co., Ltd`
            callback(true);
        }
    }
    xhr.open('GET', '../source/html/footer.html', true);
    xhr.send();
}

/**###########################################################################################################################
#                                                 Initail Plugins Component                                                  #
############################################################################################################################*/
initial();

function initial() {
    initial_component();
    initial_datamask();
}

function initial_component() {
    if ($('.datatable').length) {
        $('.datatable').DataTable({
            bDestroy: true,
            responsive: true,
            language: {
                paginate: {
                    previous: '<i class="demo-psi-arrow-left"></i>',
                    next: '<i class="demo-psi-arrow-right"></i>'
                }
            }
        });
    }
    if ($('.datetime').length) {
        $('.datetime').datetimepicker({
            format: 'YYYY-MM-DD HH:mm'
        });
        $('.datetime.date-to').datetimepicker({
            useCurrent: false //Important! See issue #1075
        });
        $(".datetime.date-from").on("dp.change", function(e) {
            $('.datetime.date-to').data("DateTimePicker").minDate(e.date);
        });
        $(".datetime.date-to").on("dp.change", function(e) {
            $('.datetime.date-from').data("DateTimePicker").maxDate(e.date);
        });
    }
}

function initial_datamask() {
    if ($('.phone_mask').length) {
        $('.phone_mask').mask('999-999-9999');
    }
}

/**###########################################################################################################################
#                                                  Operate Plugins Function                                                  #
############################################################################################################################*/

/**
 * description : showing alert popup message.
 * @param {'success', 'warning','danger'} type 
 * @param {'text message'} msg 
 * create by : Moscow
 * create date : 2019/01/17
 * udpate by : -
 * update date : -
 */
function alert_msg(type, msg) {
    if (type && msg) {
        var a = '';
        if (type.toLowerCase() === 'danger') {
            a = 'Danger';
        }
        if (type.toLowerCase() === 'warnning') {
            a = 'Warnning';
        }
        if (type.toLowerCase() === 'success') {
            a = 'Success';
        }
        $.niftyNoty({
            type: type.toLowerCase(),
            container: 'floating',
            html: '<strong>' + a + '!</strong> ' + msg,
            closeBtn: true,
            floating: {
                position: 'top-right',
                animationIn: 'jellyIn',
                animationOut: 'fadeOut'
            },
            focus: true,
            timer: false ? 0 : 2500
        });
    }
}
/**
 * End function.
 */

/**
 * description : clear all input field to default value.
 * @param {'html field that you want to clear'} field_name 
 * create by : Moscow
 * create date : 2019/01/17
 * udpate by : -
 * update date : -
 */
function clear(field_name) {
    if ($('#' + field_name + ' input').length) {
        $('#' + field_name + ' input').val('');
    }
    if ($('#' + field_name + ' select').length) {
        $('#' + field_name + ' select').each(function() {
            $('#' + $(this).attr('id')).val($('#' + $(this).attr('id') + ' > option[selected]').val());
        });
    }
    if ($('#' + field_name + ' textarea').length) {
        $('#' + field_name + ' textarea').val('');
    }
    if ($('.ast_required').length) {
        $('#' + field_name).bootstrapValidator('destroy');
    }
}
/**
 * End function.
 */

/**
 * description : clear all input field.
 * @param {'html field that you want to validate'} field_name 
 * create by : Moscow
 * create date : 2019/01/17
 * udpate by : -
 * update date : -
 */
function field_validation(field_name, fields) {
    var faIcon = {
            // valid: 'fa fa-check-circle fa-lg text-success',
            // invalid: 'fa fa-times-circle fa-lg',
            validating: 'fa fa-refresh'
        }
        // FORM VARIOUS VALIDATION
        // =================================================================
    $('#' + field_name).bootstrapValidator({
        excluded: ':disabled',
        message: 'This value is not valid',
        feedbackIcons: faIcon,
        fields: fields
    }).on('status.field.bv', function(e, data) {
        e.preventDefault();
        var $parent = data.element.parents('.form-group');
        // Remove the has-success class
        $parent.removeClass('has-success');
    });
    $('#' + field_name).bootstrapValidator('validate');
    if ($('.has-error').length == 0) {
        return true;
    } else {
        return false;
    }
}

/**###########################################################################################################################
#                                                  Authentication Checking                                                   #
############################################################################################################################*/

function authen_token() {
    var api_su = 'http://52.139.159.116:29000'
    var xhr = new XMLHttpRequest();
    xhr.open('POST', api_su + '/authen_token', false);
    xhr.setRequestHeader('Content-Type', 'application/json');
    xhr.setRequestHeader('authorization', 'Bearer ' + sessionStorage.getItem('token'));
    xhr.send(JSON.stringify({
        'path': window.location.pathname
    }));
    var response = JSON.parse(xhr.responseText);
    if (response.status === '200') {
        sessionStorage.setItem('token', response.token)
    } else {
        window.location.href = '../auth_login/login.html';
    }
}


function parseJwt(token) {
    var base64Url = token.split('.')[1];
    var base64 = base64Url.replace('-', '+').replace('_', '/');
    return JSON.parse(window.atob(base64));
};


/* function menu(callback) {
    var api_su = 'http://52.139.159.116 :29000'
    var xhr = new XMLHttpRequest();
    xhr.open('POST', api_su + '/menu', false);
    xhr.setRequestHeader('Content-Type', 'application/json');
    xhr.setRequestHeader('authorization', 'Bearer ' + sessionStorage.getItem('token'));
    xhr.send();
    var response = JSON.parse(xhr.responseText);
    if (response.status === '200') {
        response.data.forEach(element => {
            var option = '';
            if (Object.keys(element.main_menu).length > 0) {
                if (Object.keys(element.sub_menu[0]).length > 0) {
                    option = option + '<li id="' + element.main_menu.id + '" >' +
                        '<a href="#">' +
                        '<i class="demo-pli-file-html"></i>' +
                        '<span class="menu-title">' + element.main_menu.name + '</span>' +
                        '<i class="arrow"></i>' +
                        '</a>' +
                        '<ul class="collapse">';
                    element.sub_menu.forEach(data => {
                        option = option + '<li id="' + data.id + '" path="' + data.path + '" lv="level_2" class=""><a href="' + data.path + '">' + data.name + '</a></li>';
                    });
                    option += '</ul></li>'
                } else {
                    option = '<li id="' + element.main_menu.id + '" path="' + element.main_menu.path + '" lv="level_1">' +
                        '<a href="' + element.main_menu.path + '">' +
                        '<i class="demo-pli-file-html"></i>' +
                        '<span class="menu-title">' + element.main_menu.name + '</span>' +
                        '</a>' +
                        '</li>'
                }
            }
            $('#mainnav-menu').append(option);
            localStorage.setItem('prog', $('[path="..' + window.location.pathname + '"]').attr('id'));
        });
        callback(true)
    } else {
        callback(true)
    }
} */

function menu(callback) {
    var api_su = 'http://52.139.159.116:29000'
    var xhr = new XMLHttpRequest();
    xhr.timeout = 3000;
    xhr.ontimeout = function() {
        callback(false)
    };
    xhr.open('POST', api_su + '/menu', true);
    xhr.setRequestHeader('Content-Type', 'application/json');
    xhr.setRequestHeader('authorization', 'Bearer ' + sessionStorage.getItem('token'));
    xhr.send();

    xhr.onload = function() {
        if (xhr.readyState === 4) {
            if (xhr.status === 200) {
                var response = JSON.parse(xhr.responseText);
                if (response.status === '200') {
                    response.data.forEach(element => {
                        var option = '';
                        if (Object.keys(element.main_menu).length > 0) {
                            if (Object.keys(element.sub_menu[0]).length > 0) {
                                option = option + '<li id="' + element.main_menu.id + '" >' +
                                    '<a href="#">' +
                                    '<i class="demo-pli-file-html"></i>' +
                                    '<span class="menu-title">' + element.main_menu.name + '</span>' +
                                    '<i class="arrow"></i>' +
                                    '</a>' +
                                    '<ul class="collapse">';
                                element.sub_menu.forEach(data => {
                                    option = option + '<li id="' + data.id + '" path="' + data.path + '" lv="level_2" class=""><a href="' + data.path + '">' + data.name + '</a></li>';
                                });
                                option += '</ul></li>'
                            } else {
                                option = '<li id="' + element.main_menu.id + '" path="' + element.main_menu.path + '" lv="level_1">' +
                                    '<a href="' + element.main_menu.path + '">' +
                                    '<i class="demo-pli-file-html"></i>' +
                                    '<span class="menu-title">' + element.main_menu.name + '</span>' +
                                    '</a>' +
                                    '</li>'
                            }
                        }
                        $('#mainnav-menu').append(option);
                        localStorage.setItem('prog', $('[path="..' + window.location.pathname + '"]').attr('id'));
                    });
                    callback(true)
                } else {
                    callback(false)
                }
            } else {
                callback(false)
            }
        }
    };

}

$(document).on('click', '.btn-logout', function() {
    logout();
});

$(document).on('click', '#btnNormalLogout', function() {
    sessionStorage.clear();
    window.location.href = '/index.html';
});

$(document).on('click', '#btnShiftSwap', function() {
    window.open('../dashboard/shiftingout.html', '_self')
})


function parseJwt(token) {
    var base64Url = token.split('.')[1];
    var base64 = base64Url.replace('-', '+').replace('_', '/');
    return JSON.parse(window.atob(base64));
};

function getStaffData() {
    var action = "forNav"
    var params = JSON.stringify({
        action: action
    });
    var api_su = 'http://52.139.159.116:29000'
    var xhr = new XMLHttpRequest();
    xhr.open('POST', api_su + '/profileData', false);
    xhr.setRequestHeader('Content-Type', 'application/json');
    xhr.setRequestHeader('authorization', 'Bearer ' + sessionStorage.getItem('token'));
    xhr.send(params);
    var res = JSON.parse(xhr.responseText);
    return res.data[0];
}

function logout() {
    localStorage.clear();
    sessionStorage.clear();
    window.location.href = '/index.html';
}