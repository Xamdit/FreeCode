// $(document).ready(function () {
//     ddlBank();
// });

function ddlBank() {
    var action = "ddlBank"
    var dataForSent = { "action": action };
    // request
    var xhr = new XMLHttpRequest();
    xhr.open('POST', ipay_ddl_master + '/ddlbankfnc', false);
    xhr.setRequestHeader('Content-Type', 'application/json');
    xhr.setRequestHeader('authorization', 'Bearer ' + sessionStorage.getItem('token'));
    xhr.send(JSON.stringify(dataForSent));
    // response
    var res = JSON.parse(xhr.responseText);
    if (res.status == 200) {
        if (res.data.length > 0) {
            // load callCenter member
            var options = '<option value="">Choose Bank</option>';
            $(res.data).each(function (index, objData) {
                options += '<option bankabb="' + objData.bank_abb + '" bankname="' + objData.bank_name + '" value="' + objData._id + '" ' + '>' + objData.bank_name + ' (' + objData.bank_abb + ')' + '</option>';
                // options += '<option value="' + objData._id + '" ' + '>' + objData.bank_name + ' (' + objData.bank_abb + ')' + '</option>';
                $("select#ddlFromBank_modal").html(options);
            })
        } else {
            var options = '<option value="">ไม่ข้อมูลในระบบ</option>';
            $("select#ddlFromBank_modal").html(options);
        }

    } else {
        var options = '<option value="">ไม่ข้อมูลในระบบ</option>';
        $("select#ddlFromBank_modal").html(options);
    }
}

function ddlAccount(bank_id, toForm) {
    var action = "ddlAccount"
    var dataForSent = { "data": { "bank_id": bank_id }, "action": action };
    // request
    var xhr = new XMLHttpRequest();
    xhr.open('POST', ipay_ddl_master + '/ddlaccountfnc', false);
    xhr.setRequestHeader('Content-Type', 'application/json');
    xhr.setRequestHeader('authorization', 'Bearer ' + sessionStorage.getItem('token'));
    xhr.send(JSON.stringify(dataForSent));
    // response
    var res = JSON.parse(xhr.responseText);

    if (res.status == 200) {
        if (res.data.length > 0) {
            // load callCenter member
            var options = '<option value="">Choose Account</option>';
            $(res.data).each(function (index, objData) {
                options += '<option accno="' + objData.account_no + '" accname="' + objData.account_name + '" value="' + objData._id + '" ' + '>' + objData.account_no + ' (' + objData.account_name + ')' + '</option>';
                $("select" + "#" + toForm).html(options);
            })
        } else {
            var options = '<option value="">ไม่ข้อมูลในระบบ</option>';
            $("select" + "#" + toForm).html(options);
        }
    } else {
        var options = '<option value="">ไม่ข้อมูลในระบบ</option>';
        $("select" + "#" + toForm).html(options);
    }
}

function ddlAccountno(bank_id, acc_type, toForm) {
    var action = "ddlAccountno"
    var dataForSent = { "data": { "bank_id": bank_id, "account_type": acc_type }, "action": action };
    // request
    var xhr = new XMLHttpRequest();
    xhr.open('POST', ipay_ddl_master + '/ddlaccountfnc', false);
    xhr.setRequestHeader('Content-Type', 'application/json');
    xhr.setRequestHeader('authorization', 'Bearer ' + sessionStorage.getItem('token'));
    xhr.send(JSON.stringify(dataForSent));
    // response
    var res = JSON.parse(xhr.responseText);

    if (res.status == 200) {
        if (res.data.length > 0) {
            // load callCenter member
            var options = '<option value="">Choose Account</option>';
            $(res.data).each(function (index, objData) {
                options += '<option accno="' + objData.account_no + '" accname="' + objData.account_name + '" value="' + objData._id + '" ' + '>' + objData.account_no + ' (' + objData.account_name + ')' + '</option>';
                $("select" + "#" + toForm).html(options);
            })
        } else {
            var options = '<option value="">ไม่ข้อมูลในระบบ</option>';
            $("select" + "#" + toForm).html(options);
        }
    } else {
        var options = '<option value="">ไม่ข้อมูลในระบบ</option>';
        $("select" + "#" + toForm).html(options);
    }
}

function ddlAccounttype(toForm) {
    var action = "ddlAccounttype"
    var dataForSent = { "action": action };
    // request
    var xhr = new XMLHttpRequest();
    xhr.open('POST', ipay_ddl_master + '/ddlparameterfnc', false);
    xhr.setRequestHeader('Content-Type', 'application/json');
    xhr.setRequestHeader('authorization', 'Bearer ' + sessionStorage.getItem('token'));
    xhr.send(JSON.stringify(dataForSent));
    // response
    var res = JSON.parse(xhr.responseText);

    if (res.status == 200) {
        if (res.data.length > 0) {
            // load callCenter member
            var options;
            $(res.data).each(function (index, objData) {
                options += '<option value="' + objData._id + '" ' + '>' + objData.param_desc + '</option>';
                $("select" + "#" + toForm).html(options);
            })
            if (toForm == "ddlToAccountType_modal") {
                var bank_id = $("#ddlToBank_modal").val();
                var acc_type = $("#ddlToAccountType_modal").val();
                var toForm = "toAccount_modal";
                ddlAccountno(bank_id, acc_type, toForm);
                $('#' + toForm).attr('disabled', false);
            } else if (toForm == "ddlFromAccountType_modal") {
                var bank_id = $("#ddlFromBank_modal").val();
                var acc_type = $("#ddlFromAccountType_modal").val();
                var toForm = "fromAccount_modal";
                ddlAccountno(bank_id, acc_type, toForm);
                $('#' + toForm).attr('disabled', false);
            }

        } else {
            var options = '<option value="">ไม่ข้อมูลในระบบ</option>';
            $("select" + "#" + toForm).html(options);
        }
    } else {
        var options = '<option value="">ไม่ข้อมูลในระบบ</option>';
        $("select" + "#" + toForm).html(options);
    }
}

function ddlStatus(type) {
    var action = "ddlStatus"
    var dataForSent = { "action": action, "data": type };
    // request
    var xhr = new XMLHttpRequest();
    xhr.open('POST', ipay_ddl_master + '/ddlparameterfnc', false);
    xhr.setRequestHeader('Content-Type', 'application/json');
    xhr.setRequestHeader('authorization', 'Bearer ' + sessionStorage.getItem('token'));
    xhr.send(JSON.stringify(dataForSent));
    // response
    var res = JSON.parse(xhr.responseText);
    if (res.status == 200) {
        // load callCenter member
        var options = '<option value="">Choose Status</option>';
        $(res.data).each(function (index, objData) {
            options += '<option value="' + objData._id + '" ' + '>' + objData.param_desc + '</option>';
            $("select.ddlStatus").html(options);
        })
    } else {
        var options = '<option value="">ไม่ข้อมูลในระบบ</option>';
        $("select.ddlStatus").html(options);
    }
}


function ddlBankDf() {
    var action = "ddlBankDf"
    var dataForSent = { "action": action };
    // request
    var xhr = new XMLHttpRequest();
    xhr.open('POST', ipay_ddl_master + '/ddlbankfnc', false);
    xhr.setRequestHeader('Content-Type', 'application/json');
    xhr.setRequestHeader('authorization', 'Bearer ' + sessionStorage.getItem('token'));
    xhr.send(JSON.stringify(dataForSent));
    // response
    var res = JSON.parse(xhr.responseText);
    if (res.status == 200) {
        // load callCenter member
        var options = '<option value="">Choose Bank</option>';
        $(res.data).each(function (index, objData) {
            options += '<option bankabb="' + objData.bank_abb + '" bankname="' + objData.bank_name + '" value="' + objData._id + '" ' + '>' + objData.bank_name + ' (' + objData.bank_abb + ')' + '</option>';
            $("select.ddlBank").html(options);
        })
    } else {
        var options = '<option value="">ไม่ข้อมูลในระบบ</option>';
        $("select.ddlBank").html(options);
    }
}

function getDdlDefault() {
    ddlAccountnoDf();
    ddlAccounttypeDf();
    ddlBankDf();
    ddlAdjust();
}

function ddlAccountnoDf() {
    var action = "ddlAccountnoDf"
    var dataForSent = { "action": action };
    // request
    var xhr = new XMLHttpRequest();
    xhr.open('POST', ipay_ddl_master + '/ddldefaultfnc', false);
    xhr.setRequestHeader('Content-Type', 'application/json');
    xhr.setRequestHeader('authorization', 'Bearer ' + sessionStorage.getItem('token'));
    xhr.send(JSON.stringify(dataForSent));
    // response
    var res = JSON.parse(xhr.responseText);

    if (res.status == 200) {
        if (res.data.length > 0) {
            // load callCenter member
            var options = '<option value="">Choose Account</option>';
            $(res.data).each(function (index, objData) {
                options += '<option accno="' + objData.account_no + '" accname="' + objData.account_name + '" value="' + objData._id + '" ' + '>' + objData.account_no + ' (' + objData.account_name + ')' + '</option>';
                $("select.ddlAccount").html(options);
            })
        } else {
            var options = '<option value="">ไม่ข้อมูลในระบบ</option>';
            $("select.ddlAccount").html(options);
        }
    } else {
        var options = '<option value="">ไม่ข้อมูลในระบบ</option>';
        $("select.ddlAccount").html(options);
    }
}

function ddlAccounttypeDf() {

    // load callCenter member
    var options = '<option value="">Choose Account type</option>';
    $("select.ddlAccountType").html(options);

}

function ddlAdjust() {
    var action = "getParamAdjust"
    var dataForSent = { "action": action };
    // request
    var xhr = new XMLHttpRequest();
    xhr.open('POST', ipay_ddl_master + '/parameterfnc', false);
    xhr.setRequestHeader('Content-Type', 'application/json');
    xhr.setRequestHeader('authorization', 'Bearer ' + sessionStorage.getItem('token'));
    xhr.send(JSON.stringify(dataForSent));
    // response
    var res = JSON.parse(xhr.responseText);

    if (res.status == 200) {
        if (res.data.length > 0) {
            // load callCenter member
            var options = '<option value="">Choose Adjust Type</option>';
            $(res.data).each(function (index, objData) {
                options += '<option value="' + objData._id + '" ' + '>' + objData.param_desc + '</option>';
                $("select.ddlAdjustType").html(options);
            })
        } else {
            var options = '<option value="">ไม่ข้อมูลในระบบ</option>';
            $("select.ddlAdjustType").html(options);
        }
    } else {
        var options = '<option value="">ไม่ข้อมูลในระบบ</option>';
        $("select.ddlAdjustType").html(options);
    }
}

function ddlMainDocType(type) {
    var action = "getMainDocType";
    var objData = { "main_doc_type_abb": type };
    var dataForSent = { "data": objData, "action": action };
    // request
    var xhr = new XMLHttpRequest();
    xhr.open('POST', ipay_ddl_master + '/parameterfnc', false);
    xhr.setRequestHeader('Content-Type', 'application/json');
    xhr.setRequestHeader('authorization', 'Bearer ' + sessionStorage.getItem('token'));
    xhr.send(JSON.stringify(dataForSent));
    // response
    var res = JSON.parse(xhr.responseText);

    if (res.status == 200) {
        main_doc_type_id = res.data[0]._id;
        main_doc_type_abb = res.data[0].main_doc_type_abb;
    }
}

function ddlSubDocType(type) {
    var action = "getSubDocType";
    var objData = { "main_doc_type_id": type };
    var dataForSent = { "data": objData, "action": action };
    // request
    var xhr = new XMLHttpRequest();
    xhr.open('POST', ipay_ddl_master + '/parameterfnc', false);
    xhr.setRequestHeader('Content-Type', 'application/json');
    xhr.setRequestHeader('authorization', 'Bearer ' + sessionStorage.getItem('token'));
    xhr.send(JSON.stringify(dataForSent));
    // response
    var res = JSON.parse(xhr.responseText);

    if (res.status == 200) {
        if (res.data.length > 0) {
            // load callCenter member
            var options = '<option value="">Choose Sub Doc Type</option>';
            $(res.data).each(function (index, objData) {
                options += '<option value="' + objData.sub_doc_type_abb + '" ' + '>' + objData.sub_doc_type_name + '</option>';
                $("select.ddlSubDocType").html(options);
            })
        } else {
            var options = '<option value="">ไม่ข้อมูลในระบบ</option>';
            $("select.ddlSubDocType").html(options);
        }
    } else {
        var options = '<option value="">ไม่ข้อมูลในระบบ</option>';
        $("select.ddlSubDocType").html(options);
    }
}