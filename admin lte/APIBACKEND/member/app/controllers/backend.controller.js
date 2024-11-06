const queryMember = require('../functions/qdmbackend');
const stt = require('../../constants/statusText');
let crypto = require('crypto');
let request = require('request');
let querystring = require('querystring');
const jwt = require('jsonwebtoken');
const util = require('util');
const jwtVerifyAsync = util.promisify(jwt.verify);
const site = require('../../constants/urlsite');
const { hashSync, genSaltSync, compareSync } = require("bcrypt");
const { base64encode, base64decode } = require('nodejs-base64');
const axios = require("axios");

const httpStatusCodes = require('../../constants/httpStatusCodes');
const { database } = require('../../constants/dbCon');
const logs = require('../functions/logs');

const exec = util.promisify(require('child_process').exec);


// ###########################  Unity Function #########################################
function aes256(password) {
    return new Promise((resolve, reject) => {
        let genpw = password;
        let fp1 = genpw;
        let key = 'aPjr2QDDfjmb72Vs';
        let cipher = crypto.createCipher('aes256', key);
        let fp2 = cipher.update(fp1, 'base64', 'base64') + cipher.final('base64');
        resolve({ genpw: genpw, fp2: fp2 });
    });
}

function formatMoneyNotDecimal(n, c, d, t) {
    var c = isNaN(c = Math.abs(c)) ? 2 : c,
        d = d == undefined ? "." : d,
        t = t == undefined ? "," : t,
        s = n < 0 ? "-" : "",
        i = String(parseInt(n = Math.abs(Number(n) || 0).toFixed(c))),
        j = (j = i.length) > 3 ? j % 3 : 0;
    return s + (j ? i.substr(0, j) + t : "") + i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + t);
}

function formatTime(d) {
    let date = new Date(d);
    let hh = date.getHours();
    let mm = date.getMinutes();
    let ss = date.getSeconds();
    if (hh < 10) {
        hh = '0' + hh;
    }
    if (mm < 10) {
        mm = '0' + mm;
    }
    if (ss < 10) {
        ss = '0' + ss;
    }
    let result = hh + ":" + mm + ":" + ss;
    return result;
}

function formatDate(d) {
    let date = new Date(d);
    let dd = date.getDate();
    let mmm = date.getMonth() + 1;
    let yy = date.getFullYear();
    if (mmm < 10) {
        mmm = '0' + mmm;
    }
    if (dd < 10) {
        dd = '0' + dd;
    }
    let result = yy + "/" + mmm + "/" + dd;
    return result;
}

function formatDate1(d) {
    let date = new Date(d);
    let dd = date.getDate();
    let mmm = date.getMonth() + 1;
    let yy = date.getFullYear();
    if (mmm < 10) {
        mmm = '0' + mmm;
    }
    if (dd < 10) {
        dd = '0' + dd;
    }
    let result = yy + "-" + mmm + "-" + dd;
    return result;
}
sendMessageLineNotify


function sendMessageLineNotify(token, messageBody) {
    request({
        method: 'POST',
        uri: 'https://notify-api.line.me/api/notify',
        headers: {
            'Content-Type': 'application/json'
        },
        auth: {
            'bearer': token
        },
        form: {
            message: messageBody
        }
    });
}

async function authenParse(token) {
    try {
        let split = token;
        let parseToken = split.split('Bearer ');
        let result = await parseJwt(parseToken[1]);
        console.log(parseToken[0]);
        console.log(parseToken[1]);
        return result;
    } catch (e) {
        return false;
    }

}

function generateAccessToken(params) {
    return new Promise((resolve, reject) => {
        let payload = params;
        let secret = 'eyJhbGciOiJIUzI1N';
        var token = jwt.sign(payload, secret, {
            expiresIn: '2h'
        });
        resolve(token);
    });
}

function parseJwt(token) {
    var base64Payload = token.split('.')[1];
    var payload = Buffer.from(base64Payload, 'base64');
    return JSON.parse(payload.toString());
}

function validateJsonWebhook(request) {

    // calculate the signature
    const expectedSignature = "sha1=" +
        crypto.createHmac("sha1", `mskids`)
        .update(JSON.stringify(request.body))
        .digest("hex");

    return expectedSignature
}



module.exports.gitpull = async(req, res) => {

    var expected = req.headers['x-hub-signature'];
    var calculated = validateJsonWebhook(req);

    if (expected !== calculated) {
        res.status(400).send(`Invalid signature!`);
    } else {
        const { stdout, stderr } = exec('git stash && git pull && pm2 restart all');
        res.send(`Valid signature!`);
    }
}

module.exports.pm2restart = async(req, res) => {
    const { stdout, stderr } = await exec('pm2 restart all');
    console.log('Logs:', stdout);
    console.log('Error:', stderr);
    res.send({ "Logs": stdout, "Error": stderr });
}


module.exports.testLogs = async(req, res) => {
    // console.log(logs);
    let rll = []
    for (const rr of logs) {
        // console.log(rr, '\n');
        rll.push(rr)
    }
    res.send(`<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="refresh" content="300">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test Logs Pm2</title>
    <style>pre{font-size: 14px}a{text-decoration: none}h4{color:#697f22;}</style>
</head>
<body>
    <pre>${rll.reverse().join("\n")}</pre>
</body>
</html>`);

}

module.exports.testToken = async(req, res) => {
    // let responeData = {};
    // res.setHeader('Content-Type', 'application/json');
    // if (!req.body.token) {
    //     let token = await generateAccessToken({ username: 'Bevennes' });
    //     // let parse = await parseJwt(token);
    //     res.send({ token: token });

    // } else {
    //     var isExpiredToken = false;
    //     let txt = 'ยังไม่หมดเวลาToken';
    //     let dateNow = new Date();
    //     let decodedToken = await parseJwt(req.body.token);
    //     if (decodedToken.exp < dateNow.getTime() / 1000) {
    //         isExpiredToken = true;
    //         txt = 'หมดเวลา Token แล้ว';
    //     }
    //     res.send({ msg: isExpiredToken, txt: txt, data: decodedToken });
    // }
    console.log(req.body);
    console.log(res.headers);
}
module.exports.createSite = async(req, res) => {
    let responeData = {};
    res.setHeader('Content-Type', 'application/json');
    data = await queryMember.querySettingSystem(req);
    let message = "\nWeb =>" + data.result[0].name_web + "\nIP => " + req.body.ipAddress + "\nCity => " + req.body.city + ',' + req.body.stateProv + '\nCountry => ' + req.body.countryName + '\nDate => ' + formatDate(new Date()) + ' ' + formatTime(new Date());

    res.send({});

}

module.exports.autoTokenUfa = async() => {
    let res = await axios.get(`https://ufalogin.mskids.me/api/ufa/viewstate/rab023.com`);
    console.log(`Update Token Ufa Success`)
    await queryMember.updateSettingGameAuto(res.data.data);
}

module.exports.ApiChangePass = async(req, res) => {
    let responeData = {};
    const body = req.body;
    res.setHeader('Content-Type', 'application/json');
    const salt = genSaltSync(10);
    body.newpass = hashSync(body.newpass, salt);

    const data = await queryMember.updatePasswordAdmin(body);
    if (data.status) {
        responeData.statusCode = httpStatusCodes.Success.ok.code;
        responeData.statusCodeText = httpStatusCodes.Success.ok.codeText;
        responeData.data = 'Change Password Success!';
    } else {
        responeData.statusCode = httpStatusCodes.Fail.fail.code;
        responeData.statusCodeText = httpStatusCodes.Fail.fail.codeText;
        responeData.data = 'Change Password Error! Try again.';
    }
    res.send(responeData);

}
module.exports.ApiUpdateDeviceScb = async(req, res) => {
    let responeData = {};
    const body = req.body;
    res.setHeader('Content-Type', 'application/json');
    body.deviceId = base64encode(`eyJhb.${body.deviceId}`);
    let cutcode = body.deviceId.substr(0, 10);
    body.deviceId = body.deviceId.substr(10)
    body.deviceId = `${cutcode}MsKIDs${body.deviceId}`;

    const data = await queryMember.updateDeviceScb(body);
    if (data.status) {
        responeData.statusCode = httpStatusCodes.Success.ok.code;
        responeData.statusCodeText = httpStatusCodes.Success.ok.codeText;
        responeData.data = 'Update DeviceID. Success!';
    } else {
        responeData.statusCode = httpStatusCodes.Fail.fail.code;
        responeData.statusCodeText = httpStatusCodes.Fail.fail.codeText;
        responeData.data = 'Update DeviceID. Error! Try again.';
    }
    res.send(responeData);

}
module.exports.ApiUpdateUfaAcc = async(req, res) => {
    let responeData = {};
    const body = req.body;
    res.setHeader('Content-Type', 'application/json');

    const data = await queryMember.updateUfaAcc(body);
    if (data.status) {
        responeData.statusCode = httpStatusCodes.Success.ok.code;
        responeData.statusCodeText = httpStatusCodes.Success.ok.codeText;
        responeData.data = 'Update User Pass. Success!';
    } else {
        responeData.statusCode = httpStatusCodes.Fail.fail.code;
        responeData.statusCodeText = httpStatusCodes.Fail.fail.codeText;
        responeData.data = 'Update Error! Try again.';
    }
    res.send(responeData);

}


async function checkAuth(token_o) {
    let result = {};
    let split_auth = token_o.split(' ');
    let token = split_auth[1];
    let data = await queryMember.queryLogToken(token);
    if (data.status && data.result.length > 0) {
        let decodedToken = await parseJwt(token);
        var isExpiredToken = false;
        let dateNow = new Date();
        if (decodedToken.exp < dateNow.getTime() / 1000) {
            isExpiredToken = true;
        }
        if (!isExpiredToken) {
            result.status = true;
            result.txt = token;
        } else {
            let id = data.result[0].id;
            result.status = false;
            result.msg = 'Token Expired';
            await queryMember.deleteLogToken(id);
        }
    } else {
        result.status = false;
        result.msg = stt.tokenFail.description;
    }
    return result;
}

module.exports.Login = async(req, res) => {
    let responeData = {};
    res.setHeader('Content-Type', 'application/json');
    let data = await queryMember.queryDataLogin(req);
    if (data.status && data.result.length > 0) {
        const result = compareSync(req.body.password, data.result[0].password);
        if (result) {
            if (data.result[0].stats == 99 || data.result[0].stats == 109) {
                if (data.result[0].secert_code == req.body.secert) {
                    let dataR = {
                        id: data.result[0].id,
                        username: data.result[0].username,
                        stats: data.result[0].stats,
                        ip: req.body.ip
                    };
                    let resultJwtData = await generateAccessToken(dataR);
                    responeData.token = resultJwtData;
                    responeData.statusCode = httpStatusCodes.Success.ok.code;
                    responeData.statusCodeText = httpStatusCodes.Success.ok.codeText;
                    responeData.description = 'Login Success!';
                    let data_ins = {
                        token: resultJwtData,
                        ip: req.body.ip.ipAddress
                    }
                    data = await queryMember.querySettingSystem(req);
                    let message = "\nWeb =>" + data.result[0].name_web + "\nสมาชิก => " + req.body.username + '[ ' + req.body.secert + ' ]\nระบบ => Login Page Success\nIP => ' + req.body.ip.ipAddress + '\nCountry => ' + req.body.ip.countryName + '\nCity => ' + req.body.ip.city + ',' + req.body.ip.stateProv + '\nDate => ' + formatDate(new Date()) + ' ' + formatTime(new Date());

                    await queryMember.insertTokenTodatabase(data_ins);
                } else {
                    responeData.statusCode = httpStatusCodes.Fail.fail.code;
                    responeData.statusCodeText = httpStatusCodes.Fail.fail.codeText;
                    responeData.description = 'Secert Code Wrong!';
                    data = await queryMember.querySettingSystem(req);
                    let message = "\nWeb =>" + data.result[0].name_web + "\nสมาชิก => " + req.body.username + '[ ' + req.body.secert + ' ]\nระบบ => Secert Wrong\nIP => ' + req.body.ip.ipAddress + '\nCountry => ' + req.body.ip.countryName + '\nCity => ' + req.body.ip.city + ',' + req.body.ip.stateProv + '\nDate => ' + formatDate(new Date()) + ' ' + formatTime(new Date());

                }
            } else {
                let dataR = {
                    id: data.result[0].id,
                    username: data.result[0].username,
                    stats: data.result[0].stats,
                    category: data.result[0].category,
                    ip: req.body.ip,
                };
                let resultJwtData = await generateAccessToken(dataR);
                responeData.token = resultJwtData;
                responeData.statusCode = httpStatusCodes.Success.ok.code;
                responeData.statusCodeText = httpStatusCodes.Success.ok.codeText;
                responeData.category = data.result[0].category;
                responeData.description = 'Login Success!';
                data = await queryMember.querySettingSystem(req);
                let message = "\nWeb =>" + data.result[0].name_web + "\nสมาชิก => " + req.body.username + '[ ' + req.body.secert + ' ]\nระบบ => Login Page Success\nIP => ' + req.body.ip.ipAddress + '\nCountry => ' + req.body.countryName + '\nDate => ' + formatDate(new Date()) + ' ' + formatTime(new Date());

                let data_ins = {
                    token: resultJwtData,
                    ip: req.body.ip.ipAddress
                }
                await queryMember.insertTokenTodatabase(data_ins);
            }
        } else {
            responeData.statusCode = httpStatusCodes.Fail.fail.code;
            responeData.statusCodeText = httpStatusCodes.Fail.fail.codeText;
            responeData.description = 'Username or Password Wrong!';
        }

    } else {
        responeData.statusCode = httpStatusCodes.Fail.fail.code;
        responeData.statusCodeText = httpStatusCodes.Fail.fail.codeText;
        responeData.description = 'Username or Password Wrong!';
    }
    res.send(responeData)
}

module.exports.Apinav = async(req, res) => {
    let responeData = {};
    res.setHeader('Content-Type', 'application/json');
    try {
        let auth = await checkAuth(req.headers.authorization);
        if (auth.status) {
            let data = await queryMember.count_withdraw();
            let datawithdraw_managelast = await queryMember.withdraw_managelast();
            responeData.count = data.result[0].count;
            responeData.withdraw_managelast = datawithdraw_managelast.result;
            responeData.statusCode = httpStatusCodes.Success.ok.code;
            responeData.statusCodeText = httpStatusCodes.Success.ok.codeText;
        } else {
            responeData.statusCode = httpStatusCodes.ClientErrors.unauthorized.code;
            responeData.statusCodeText = httpStatusCodes.ClientErrors.unauthorized.codeText
            responeData.description = auth.msg;
        }
        res.send(responeData);
    } catch (e) {
        responeData.statusCode = httpStatusCodes.Fail.fail.code;
        responeData.statusCodeText = httpStatusCodes.Fail.fail.codeText;
        res.send(responeData);
    }

}

module.exports.Apidashboard = async(req, res) => {
    let responeData = {};
    res.setHeader('Content-Type', 'application/json');
    try {
        let auth = await checkAuth(req.headers.authorization);
        if (auth.status) {
            var options = {
                'method': 'POST',
                'url': site.url + '/apibackend/agent_info',
                'headers': {
                    'Authorization': 'Bearer ' + auth.txt
                }
            };
            try {
                request(options, async function(error, response) {
                    if (error) throw new Error(error);
                    let result = await JSON.parse(response.body);
                    if (result.status) {
                        let deposit = 0;
                        let withdraw = 0;
                        let data_deposit = await queryMember.queryTransactionDepositAll();
                        if (data_deposit.result[0].deposit) {
                            deposit += parseInt(data_deposit.result[0].deposit);
                        }
                        data_deposit = await queryMember.queryTransactionManualDepositAll();
                        if (data_deposit.result[0].deposit) {
                            deposit += parseInt(data_deposit.result[0].deposit);
                        }
                        let data_withdraw = await queryMember.queryTransactionWithdrawAll();
                        if (data_withdraw.result[0].withdraw) {
                            withdraw += parseInt(data_withdraw.result[0].withdraw);
                        }
                        data_withdraw = await queryMember.queryTransactionManualWithdrawAll();
                        if (data_withdraw.result[0].withdraw) {
                            withdraw += parseInt(data_withdraw.result[0].withdraw);
                        }

                        let token = await parseJwt(auth.txt);
                        req.body.username = token.username;
                        req.body.ip = token.ip.ipAddress;
                        req.body.detail = 'เปิดหน้า Dashboard';
                        req.body.module = 'Admin Page';
                        req.body.date = formatDate(new Date()) + ' ' + formatTime(new Date());
                        await queryMember.insertReportActivity(req);

                        responeData.statusCode = httpStatusCodes.Success.ok.code;
                        responeData.statusCodeText = httpStatusCodes.Success.ok.codeText;
                        responeData.data = result.data;
                        responeData.depositall = deposit;
                        responeData.withdrawall = withdraw;
                    } else {
                        responeData.statusCode = httpStatusCodes.ClientErrors.unauthorized.code;
                        responeData.statusCodeText = httpStatusCodes.ClientErrors.unauthorized.codeText
                        responeData.description = result.msg;
                    }
                    res.send(responeData);
                });
            } catch (error) {
                console.log(error)
            }

        } else {
            responeData.statusCode = httpStatusCodes.ClientErrors.unauthorized.code;
            responeData.statusCodeText = httpStatusCodes.ClientErrors.unauthorized.codeText
            responeData.description = auth.msg;
            res.send(responeData);
        }
    } catch (e) {
        responeData.statusCode = httpStatusCodes.Fail.fail.code;
        responeData.statusCodeText = httpStatusCodes.Fail.fail.codeText;
        res.send(responeData);
    }
}

module.exports.ApiSettingDashboard = async(req, res) => {
    let responeData = {};
    res.setHeader('Content-Type', 'application/json');
    try {
        let auth = await checkAuth(req.headers.authorization);
        if (auth.status) {
            let data = await queryMember.querySettingSystem();
            if (data.status && data.result.length > 0) {
                responeData.token_line = data.result[0].token_line;
                responeData.token_line_game = data.result[0].token_line_game;
                responeData.token_line_depo = data.result[0].token_line_depo;
                responeData.token_line_with = data.result[0].token_line_with;
                responeData.line = data.result[0].line;
                responeData.name_web = data.result[0].name_web;
                responeData.d_limit = data.result[0].d_limit;
                responeData.w_limit = data.result[0].w_limit;
                responeData.aff_d = data.result[0].aff_d;
                responeData.aff_m = data.result[0].aff_m;
                responeData.user_ufa = data.result[0].acc_ufa;
                responeData.pass_ufa = data.result[0].ufa_pass;
            }
            data = await queryMember.querySettingSystemAuto();
            if (data.status && data.result.length > 0) {
                responeData.credit_min = data.result[0].credit_min;
                responeData.credit_max = data.result[0].credit_max;
                responeData.credit_limit = data.result[0].credit_limit;
                responeData.auto_status = data.result[0].status;
            }
            responeData.statusCode = httpStatusCodes.Success.ok.code;
            responeData.statusCodeText = httpStatusCodes.Success.ok.codeText;

        } else {
            responeData.statusCode = httpStatusCodes.ClientErrors.unauthorized.code;
            responeData.statusCodeText = httpStatusCodes.ClientErrors.unauthorized.codeText
            responeData.description = auth.msg;
        }
    } catch (e) {
        responeData.statusCode = httpStatusCodes.Fail.fail.code;
        responeData.statusCodeText = httpStatusCodes.Fail.fail.codeText;
    }
    res.send(responeData);
}

module.exports.Apiquerymember = async(req, res) => {
    let responeData = {};
    res.setHeader('Content-Type', 'application/json');
    try {
        let auth = await checkAuth(req.headers.authorization);
        if (auth.status) {
            let data = await queryMember.queryAllMember();
            if (data.status && data.result.length > 0) {
                let token = await parseJwt(auth.txt);
                req.body.username = token.username;
                req.body.ip = token.ip.ipAddress;
                req.body.detail = 'เปิดหน้า Member';
                req.body.module = 'Admin Page';
                req.body.date = formatDate(new Date()) + ' ' + formatTime(new Date());
                await queryMember.insertReportActivity(req);
                responeData.statusCode = httpStatusCodes.Success.ok.code;
                responeData.statusCodeText = httpStatusCodes.Success.ok.codeText;
                responeData.data = data.result;
            } else {
                responeData.statusCode = httpStatusCodes.Fail.fail.code;
                responeData.statusCodeText = httpStatusCodes.Fail.fail.codeText;
            }
        } else {
            responeData.statusCode = httpStatusCodes.ClientErrors.unauthorized.code;
            responeData.statusCodeText = httpStatusCodes.ClientErrors.unauthorized.codeText
            responeData.description = auth.msg;
        }
    } catch (e) {
        responeData.statusCode = httpStatusCodes.Fail.fail.code;
        responeData.statusCodeText = httpStatusCodes.Fail.fail.codeText;
    }
    res.send(responeData);
}


module.exports.ApiquerymemberUFA = async(req, res) => {
    let responeData = {};
    res.setHeader('Content-Type', 'application/json');
    try {
        let auth = await checkAuth(req.headers.authorization);
        if (auth.status) {
            let data = await queryMember.queryAllMemberUFA();
            if (data.status && data.result.length > 0) {
                responeData.statusCode = httpStatusCodes.Success.ok.code;
                responeData.statusCodeText = httpStatusCodes.Success.ok.codeText;
                responeData.data = data.result;
            } else {
                responeData.statusCode = httpStatusCodes.Fail.fail.code;
                responeData.statusCodeText = httpStatusCodes.Fail.fail.codeText;
            }
        } else {
            responeData.statusCode = httpStatusCodes.ClientErrors.unauthorized.code;
            responeData.statusCodeText = httpStatusCodes.ClientErrors.unauthorized.codeText
            responeData.description = auth.msg;
        }
    } catch (e) {
        responeData.statusCode = httpStatusCodes.Fail.fail.code;
        responeData.statusCodeText = httpStatusCodes.Fail.fail.codeText;
    }
    res.send(responeData);
}


module.exports.ApiupdateGeneralSetting = async(req, res) => {
    let responeData = {};
    res.setHeader('Content-Type', 'application/json');
    try {
        let auth = await checkAuth(req.headers.authorization);
        if (auth.status) {
            let data = await queryMember.updateGeneralSetting(req);
            if (data.status) {
                responeData.statusCode = httpStatusCodes.Success.ok.code;
                responeData.statusCodeText = httpStatusCodes.Success.ok.codeText;
            } else {
                responeData.statusCode = httpStatusCodes.Fail.fail.code;
                responeData.statusCodeText = httpStatusCodes.Fail.fail.codeText;
            }
        } else {
            responeData.statusCode = httpStatusCodes.ClientErrors.unauthorized.code;
            responeData.statusCodeText = httpStatusCodes.ClientErrors.unauthorized.codeText
            responeData.description = auth.msg;
        }
    } catch (e) {
        responeData.statusCode = httpStatusCodes.Fail.fail.code;
        responeData.statusCodeText = httpStatusCodes.Fail.fail.codeText;
    }
    res.send(responeData);
}

module.exports.ApiupdateAutoSetting = async(req, res) => {
    let responeData = {};
    res.setHeader('Content-Type', 'application/json');
    try {
        let auth = await checkAuth(req.headers.authorization);
        if (auth.status) {
            let data = await queryMember.updateAutoSetting(req);
            if (data.status) {
                responeData.statusCode = httpStatusCodes.Success.ok.code;
                responeData.statusCodeText = httpStatusCodes.Success.ok.codeText;
            } else {
                responeData.statusCode = httpStatusCodes.Fail.fail.code;
                responeData.statusCodeText = httpStatusCodes.Fail.fail.codeText;
            }
        } else {
            responeData.statusCode = httpStatusCodes.ClientErrors.unauthorized.code;
            responeData.statusCodeText = httpStatusCodes.ClientErrors.unauthorized.codeText
            responeData.description = auth.msg;
        }
    } catch (e) {
        responeData.statusCode = httpStatusCodes.Fail.fail.code;
        responeData.statusCodeText = httpStatusCodes.Fail.fail.codeText;
    }
    res.send(responeData);
}


module.exports.ApiupdateNotifySetting = async(req, res) => {
    let responeData = {};
    res.setHeader('Content-Type', 'application/json');
    try {
        let auth = await checkAuth(req.headers.authorization);
        if (auth.status) {
            let data = await queryMember.updateNotifySetting(req);
            if (data.status) {
                responeData.statusCode = httpStatusCodes.Success.ok.code;
                responeData.statusCodeText = httpStatusCodes.Success.ok.codeText;
            } else {
                responeData.statusCode = httpStatusCodes.Fail.fail.code;
                responeData.statusCodeText = httpStatusCodes.Fail.fail.codeText;
            }
        } else {
            responeData.statusCode = httpStatusCodes.ClientErrors.unauthorized.code;
            responeData.statusCodeText = httpStatusCodes.ClientErrors.unauthorized.codeText
            responeData.description = auth.msg;
        }
    } catch (e) {
        responeData.statusCode = httpStatusCodes.Fail.fail.code;
        responeData.statusCodeText = httpStatusCodes.Fail.fail.codeText;
    }
    res.send(responeData);
}

module.exports.ApideleteMember = async(req, res) => {
    let responeData = {};
    res.setHeader('Content-Type', 'application/json');
    try {
        let auth = await checkAuth(req.headers.authorization);
        if (auth.status) {
            await queryMember.deleteMember(req);
            let data = await queryMember.deleteMemberUFA(req);
            if (data.status) {
                responeData.statusCode = httpStatusCodes.Success.ok.code;
                responeData.statusCodeText = httpStatusCodes.Success.ok.codeText;
            } else {
                responeData.statusCode = httpStatusCodes.Fail.fail.code;
                responeData.statusCodeText = httpStatusCodes.Fail.fail.codeText;
            }
        } else {
            responeData.statusCode = httpStatusCodes.ClientErrors.unauthorized.code;
            responeData.statusCodeText = httpStatusCodes.ClientErrors.unauthorized.codeText
            responeData.description = auth.msg;
        }
    } catch (e) {
        responeData.statusCode = httpStatusCodes.Fail.fail.code;
        responeData.statusCodeText = httpStatusCodes.Fail.fail.codeText;
    }
    res.send(responeData);
}

module.exports.ApiqueryeMember = async(req, res) => {
    let responeData = {};
    res.setHeader('Content-Type', 'application/json');
    try {
        let auth = await checkAuth(req.headers.authorization);
        if (auth.status) {
            let data = await queryMember.queryMember(req);
            if (data.status && data.result.length > 0) {
                responeData.statusCode = httpStatusCodes.Success.ok.code;
                responeData.statusCodeText = httpStatusCodes.Success.ok.codeText;
                responeData.data = data.result;
                data = await queryMember.queryBank();
                responeData.bank = data.result;
            } else {
                responeData.statusCode = httpStatusCodes.Fail.fail.code;
                responeData.statusCodeText = httpStatusCodes.Fail.fail.codeText;
            }
        } else {
            responeData.statusCode = httpStatusCodes.ClientErrors.unauthorized.code;
            responeData.statusCodeText = httpStatusCodes.ClientErrors.unauthorized.codeText
            responeData.description = auth.msg;
        }
    } catch (e) {
        responeData.statusCode = httpStatusCodes.Fail.fail.code;
        responeData.statusCodeText = httpStatusCodes.Fail.fail.codeText;
    }
    res.send(responeData);
}

module.exports.ApiupdateMember = async(req, res) => {
    let responeData = {};
    res.setHeader('Content-Type', 'application/json');
    try {
        let auth = await checkAuth(req.headers.authorization);
        if (auth.status) {
            let data = await queryMember.updateMember(req);
            if (data.status) {
                let token = await parseJwt(auth.txt);
                req.body.username = token.username;
                req.body.detail = 'แก้ไขข้อมูลของ คุณ' + req.body.name;
                req.body.date = formatDate(new Date()) + ' ' + formatTime(new Date());
                await queryMember.insertStaffHistory(req);
                responeData.statusCode = httpStatusCodes.Success.ok.code;
                responeData.statusCodeText = httpStatusCodes.Success.ok.codeText;
            } else {
                responeData.statusCode = httpStatusCodes.Fail.fail.code;
                responeData.statusCodeText = httpStatusCodes.Fail.fail.codeText;
            }
        } else {
            responeData.statusCode = httpStatusCodes.ClientErrors.unauthorized.code;
            responeData.statusCodeText = httpStatusCodes.ClientErrors.unauthorized.codeText
            responeData.description = auth.msg;
        }
    } catch (e) {
        responeData.statusCode = httpStatusCodes.Fail.fail.code;
        responeData.statusCodeText = httpStatusCodes.Fail.fail.codeText;
    }
    res.send(responeData);
}

module.exports.ApiregisterMemberManual = async(req, res) => {
    let responeData = {};
    res.setHeader('Content-Type', 'application/json');
    try {
        let auth = await checkAuth(req.headers.authorization);
        if (auth.status) {
            let data = await queryMember.queryMemberCheck(req);
            if (!(data.status && data.result.length > 0)) {
                let token = await parseJwt(auth.txt);
                var options = {
                    'method': 'POST',
                    'url': site.url + '/apibackend/register_manual',
                    'headers': {
                        'Authorization': 'Bearer ' + auth.txt
                    },
                    form: {
                        'username': req.body.username,
                        'password': req.body.password,
                        'bank_number': req.body.accnum,
                        'fname': req.body.name,
                        'line': req.body.line,
                        'bank_name': req.body.bank,
                        'admin': token.username
                    }
                };
                request(options, async function(error, response) {
                    if (error) throw new Error(error);
                    let result = await JSON.parse(response.body);
                    if (result.status) {
                        responeData.statusCode = httpStatusCodes.Success.ok.code;
                        responeData.statusCodeText = httpStatusCodes.Success.ok.codeText;
                        responeData.description = result.msg;
                    } else {
                        responeData.statusCode = httpStatusCodes.ClientErrors.unauthorized.code;
                        responeData.statusCodeText = httpStatusCodes.ClientErrors.unauthorized.codeText
                        responeData.description = result.msg;
                    }
                    res.send(responeData);
                });
            } else {
                responeData.statusCode = httpStatusCodes.Fail.fail.code;
                responeData.statusCodeText = httpStatusCodes.Fail.fail.codeText;
                responeData.description = 'ชื่อ หรือ ผู้ใช้นี้ ถูกใช้งานแล้ว'
                res.send(responeData);
            }
        } else {
            responeData.statusCode = httpStatusCodes.ClientErrors.unauthorized.code;
            responeData.statusCodeText = httpStatusCodes.ClientErrors.unauthorized.codeText
            responeData.description = auth.msg;
            res.send(responeData);
        }
    } catch (e) {
        responeData.statusCode = httpStatusCodes.Fail.fail.code;
        responeData.statusCodeText = httpStatusCodes.Fail.fail.codeText;
        res.send(responeData);
    }

}







module.exports.ApiupdatePlayPowyingshup = async(req, res) => {
    let responeData = {};
    res.setHeader('Content-Type', 'application/json');
    try {
        let auth = await checkAuth(req.headers.authorization);
        if (auth.status) {
            let data = await queryMember.updatePlayPowyingshup(req);
            if (data.status) {
                let token = await parseJwt(auth.txt);
                req.body.username = token.username;
                req.body.detail = 'เติมรอบการเล่นเป่ายิ้งฉุบให้ ' + req.body.powyingshup_id + ' , จำนวน ' + req.body.amount_play + ' รอบ ,ก่อนหน้า ' + req.body.powyingshup_play + ' เพิ่มเป็น ' + req.body.total + ' || ประเภท : Manual';
                req.body.date = formatDate(new Date()) + ' ' + formatTime(new Date());
                await queryMember.insertStaffHistory(req);
                responeData.statusCode = httpStatusCodes.Success.ok.code;
                responeData.statusCodeText = httpStatusCodes.Success.ok.codeText;
            } else {
                responeData.statusCode = httpStatusCodes.Fail.fail.code;
                responeData.statusCodeText = httpStatusCodes.Fail.fail.codeText;
            }
        } else {
            responeData.statusCode = httpStatusCodes.ClientErrors.unauthorized.code;
            responeData.statusCodeText = httpStatusCodes.ClientErrors.unauthorized.codeText
            responeData.description = auth.msg;
        }
    } catch (e) {
        responeData.statusCode = httpStatusCodes.Fail.fail.code;
        responeData.statusCodeText = httpStatusCodes.Fail.fail.codeText;
    }
    res.send(responeData);
}


module.exports.ApiviewCreditUserUFA = async(req, res) => {
    let responeData = {};
    res.setHeader('Content-Type', 'application/json');
    try {
        let auth = await checkAuth(req.headers.authorization);
        if (auth.status) {
            var options = {
                'method': 'GET',
                'url': site.url + '/apibackend/view_credit/' + req.body.username,
                'headers': {
                    'Authorization': 'Bearer ' + auth.txt
                }
            };
            request(options, async function(error, response) {
                if (error) throw new Error(error);
                let result = await JSON.parse(response.body);
                if (result.status) {
                    let username = req.body.username;
                    let token = await parseJwt(auth.txt);
                    req.body.username = token.username;
                    req.body.detail = 'ดูเครดิต UFA ให้กับ ' + username;
                    req.body.date = formatDate(new Date()) + ' ' + formatTime(new Date());
                    await queryMember.insertStaffHistory(req);

                    responeData.statusCode = httpStatusCodes.Success.ok.code;
                    responeData.statusCodeText = httpStatusCodes.Success.ok.codeText;
                    responeData.credit = result.data.balance;
                } else {
                    responeData.statusCode = httpStatusCodes.ClientErrors.unauthorized.code;
                    responeData.statusCodeText = httpStatusCodes.ClientErrors.unauthorized.codeText
                    responeData.description = result.msg;
                }
                res.send(responeData);
            });
        } else {
            responeData.statusCode = httpStatusCodes.ClientErrors.unauthorized.code;
            responeData.statusCodeText = httpStatusCodes.ClientErrors.unauthorized.codeText
            responeData.description = auth.msg;
            res.send(responeData);
        }

    } catch (e) {
        responeData.statusCode = httpStatusCodes.Fail.fail.code;
        responeData.statusCodeText = httpStatusCodes.Fail.fail.codeText;
        res.send(responeData);
    }
}


module.exports.ApimanageCredit = async(req, res) => {
    let responeData = {};
    res.setHeader('Content-Type', 'application/json');
    try {
        let auth = await checkAuth(req.headers.authorization);
        if (auth.status) {
            var options = {
                'method': 'GET',
                'url': site.url + '/apibackend/view_Turnover/' + req.body.username,
                'headers': {
                    'Authorization': 'Bearer ' + auth.txt
                }
            };
            request(options, async function(error, response) {
                if (error) throw new Error(error);
                let result = await JSON.parse(response.body);
                if (result.status) {
                    responeData.statusCode = httpStatusCodes.Success.ok.code;
                    responeData.statusCodeText = httpStatusCodes.Success.ok.codeText;
                    if (result.data) {
                        responeData.turnover = result.data.turnover;
                    } else {
                        responeData.turnover = 0;
                    }
                    let data = await queryMember.queryTurnoverMember(req);
                    if (data.status && data.result.length > 0) {
                        responeData.historyturnover = data.result;
                    }
                } else {
                    responeData.statusCode = httpStatusCodes.ClientErrors.unauthorized.code;
                    responeData.statusCodeText = httpStatusCodes.ClientErrors.unauthorized.codeText
                    responeData.description = result.msg;
                }
                res.send(responeData);
            });
        } else {
            responeData.statusCode = httpStatusCodes.ClientErrors.unauthorized.code;
            responeData.statusCodeText = httpStatusCodes.ClientErrors.unauthorized.codeText
            responeData.description = auth.msg;
            res.send(responeData);
        }

    } catch (e) {
        responeData.statusCode = httpStatusCodes.Fail.fail.code;
        responeData.statusCodeText = httpStatusCodes.Fail.fail.codeText;
        res.send(responeData);
    }
}

module.exports.ApiaddCredit = async(req, res) => {
    let responeData = {};
    res.setHeader('Content-Type', 'application/json');
    try {
        let auth = await checkAuth(req.headers.authorization);
        if (auth.status) {
            let token = await parseJwt(auth.txt);
            var options = {
                'method': 'POST',
                'url': site.url + '/apibackend/add_credit',
                'headers': {
                    'Authorization': 'Bearer ' + auth.txt
                },
                form: {
                    'username': req.body.usernameUFA,
                    'amount': req.body.amount,
                    'admin': token.username,
                    'ip': token.ip.ipAddress
                }
            };
            request(options, async function(error, response) {
                if (error) throw new Error(error);
                let result = await JSON.parse(response.body);
                if (result.status) {
                    responeData.statusCode = httpStatusCodes.Success.ok.code;
                    responeData.statusCodeText = httpStatusCodes.Success.ok.codeText;
                } else {
                    responeData.statusCode = httpStatusCodes.ClientErrors.unauthorized.code;
                    responeData.statusCodeText = httpStatusCodes.ClientErrors.unauthorized.codeText
                    responeData.description = result.msg;
                }
                res.send(responeData);
            });
        } else {
            responeData.statusCode = httpStatusCodes.ClientErrors.unauthorized.code;
            responeData.statusCodeText = httpStatusCodes.ClientErrors.unauthorized.codeText
            responeData.description = auth.msg;
            res.send(responeData);
        }

    } catch (e) {
        responeData.statusCode = httpStatusCodes.Fail.fail.code;
        responeData.statusCodeText = httpStatusCodes.Fail.fail.codeText;
        res.send(responeData);
    }
}

module.exports.ApiminusCredit = async(req, res) => {
    let responeData = {};
    res.setHeader('Content-Type', 'application/json');
    try {
        let auth = await checkAuth(req.headers.authorization);
        if (auth.status) {
            let token = await parseJwt(auth.txt);
            var options = {
                'method': 'POST',
                'url': site.url + '/apibackend/minus_credit',
                'headers': {
                    'Authorization': 'Bearer ' + auth.txt
                },
                form: {
                    'username': req.body.usernameUFA,
                    'amount': req.body.amount,
                    'admin': token.username,
                    'ip': token.ip.ipAddress
                }
            };
            request(options, async function(error, response) {
                if (error) throw new Error(error);
                let result = await JSON.parse(response.body);
                if (result.status) {
                    responeData.statusCode = httpStatusCodes.Success.ok.code;
                    responeData.statusCodeText = httpStatusCodes.Success.ok.codeText;
                } else {
                    responeData.statusCode = httpStatusCodes.ClientErrors.unauthorized.code;
                    responeData.statusCodeText = httpStatusCodes.ClientErrors.unauthorized.codeText
                    responeData.description = result.msg;
                }
                res.send(responeData);
            });
        } else {
            responeData.statusCode = httpStatusCodes.ClientErrors.unauthorized.code;
            responeData.statusCodeText = httpStatusCodes.ClientErrors.unauthorized.codeText
            responeData.description = auth.msg;
            res.send(responeData);
        }

    } catch (e) {
        responeData.statusCode = httpStatusCodes.Fail.fail.code;
        responeData.statusCodeText = httpStatusCodes.Fail.fail.codeText;
        res.send(responeData);
    }
}

module.exports.ApiqueryePromotion = async(req, res) => {
    let responeData = {};
    res.setHeader('Content-Type', 'application/json');
    try {
        let auth = await checkAuth(req.headers.authorization);
        if (auth.status) {
            let data = await queryMember.queryPromotion(req);
            if (data.status && data.result.length > 0) {
                responeData.statusCode = httpStatusCodes.Success.ok.code;
                responeData.statusCodeText = httpStatusCodes.Success.ok.codeText;
                responeData.data = data.result;
            } else {
                responeData.statusCode = httpStatusCodes.Fail.fail.code;
                responeData.statusCodeText = httpStatusCodes.Fail.fail.codeText;
            }
        } else {
            responeData.statusCode = httpStatusCodes.ClientErrors.unauthorized.code;
            responeData.statusCodeText = httpStatusCodes.ClientErrors.unauthorized.codeText
            responeData.description = auth.msg;
        }
    } catch (e) {
        responeData.statusCode = httpStatusCodes.Fail.fail.code;
        responeData.statusCodeText = httpStatusCodes.Fail.fail.codeText;
    }
    res.send(responeData);
}


module.exports.ApiupdatePromotion = async(req, res) => {
    let responeData = {};
    res.setHeader('Content-Type', 'application/json');
    try {
        let auth = await checkAuth(req.headers.authorization);
        if (auth.status) {
            let data = await queryMember.updatePromotion(req);
            if (data.status) {
                responeData.statusCode = httpStatusCodes.Success.ok.code;
                responeData.statusCodeText = httpStatusCodes.Success.ok.codeText;
            } else {
                responeData.statusCode = httpStatusCodes.Fail.fail.code;
                responeData.statusCodeText = httpStatusCodes.Fail.fail.codeText;
            }
        } else {
            responeData.statusCode = httpStatusCodes.ClientErrors.unauthorized.code;
            responeData.statusCodeText = httpStatusCodes.ClientErrors.unauthorized.codeText
            responeData.description = auth.msg;
        }
    } catch (e) {
        responeData.statusCode = httpStatusCodes.Fail.fail.code;
        responeData.statusCodeText = httpStatusCodes.Fail.fail.codeText;
    }
    res.send(responeData);
}


module.exports.ApiqueryePromotionHistory = async(req, res) => {
    let responeData = {};
    res.setHeader('Content-Type', 'application/json');
    try {
        let auth = await checkAuth(req.headers.authorization);
        if (auth.status) {
            let data = await queryMember.queryPromotionHistory(req);
            if (data.status && data.result.length > 0) {
                responeData.statusCode = httpStatusCodes.Success.ok.code;
                responeData.statusCodeText = httpStatusCodes.Success.ok.codeText;
                responeData.data = data.result;
            } else {
                responeData.statusCode = httpStatusCodes.Fail.fail.code;
                responeData.statusCodeText = httpStatusCodes.Fail.fail.codeText;
            }
        } else {
            responeData.statusCode = httpStatusCodes.ClientErrors.unauthorized.code;
            responeData.statusCodeText = httpStatusCodes.ClientErrors.unauthorized.codeText
            responeData.description = auth.msg;
        }
    } catch (e) {
        responeData.statusCode = httpStatusCodes.Fail.fail.code;
        responeData.statusCodeText = httpStatusCodes.Fail.fail.codeText;
    }
    res.send(responeData);
}


module.exports.ApiqueryeDepositHistory = async(req, res) => {
    let responeData = {};
    res.setHeader('Content-Type', 'application/json');
    try {
        let auth = await checkAuth(req.headers.authorization);
        if (auth.status) {
            let data = await queryMember.queryDepositHistory(req);
            if (data.status && data.result.length > 0) {
                responeData.statusCode = httpStatusCodes.Success.ok.code;
                responeData.statusCodeText = httpStatusCodes.Success.ok.codeText;
                responeData.data = data.result;
            } else {
                responeData.statusCode = httpStatusCodes.Fail.fail.code;
                responeData.statusCodeText = httpStatusCodes.Fail.fail.codeText;
            }
        } else {
            responeData.statusCode = httpStatusCodes.ClientErrors.unauthorized.code;
            responeData.statusCodeText = httpStatusCodes.ClientErrors.unauthorized.codeText
            responeData.description = auth.msg;
        }
    } catch (e) {
        responeData.statusCode = httpStatusCodes.Fail.fail.code;
        responeData.statusCodeText = httpStatusCodes.Fail.fail.codeText;
    }
    res.send(responeData);
}



module.exports.ApiqueryeWithdrawHistory = async(req, res) => {
    let responeData = {};
    res.setHeader('Content-Type', 'application/json');
    try {
        let auth = await checkAuth(req.headers.authorization);
        if (auth.status) {
            let data = await queryMember.queryWithdrawHistory(req);
            if (data.status && data.result.length > 0) {
                responeData.statusCode = httpStatusCodes.Success.ok.code;
                responeData.statusCodeText = httpStatusCodes.Success.ok.codeText;
                responeData.withdraw = data.result;
            } else {
                responeData.statusCode = httpStatusCodes.Fail.fail.code;
                responeData.statusCodeText = httpStatusCodes.Fail.fail.codeText;
            }
        } else {
            responeData.statusCode = httpStatusCodes.ClientErrors.unauthorized.code;
            responeData.statusCodeText = httpStatusCodes.ClientErrors.unauthorized.codeText
            responeData.description = auth.msg;
        }
    } catch (e) {
        responeData.statusCode = httpStatusCodes.Fail.fail.code;
        responeData.statusCodeText = httpStatusCodes.Fail.fail.codeText;
    }
    res.send(responeData);
}


module.exports.ApiwithdrawUserAuto = async(req, res) => {
    let responeData = {};
    res.setHeader('Content-Type', 'application/json');
    try {
        let auth = await checkAuth(req.headers.authorization);
        if (auth.status) {
            let data = await queryMember.queryWithdrawUser(req);
            if (data.status && data.result.length > 0) {
                let token = await parseJwt(auth.txt);
                let accnum = data.result[0].accnum;
                let bank = data.result[0].code;
                let amount = data.result[0].amount;
                let id = data.result[0].tid;
                let admin = token.username;
                let username = data.result[0].member_username;
                let usernameUFA = data.result[0].usernameUFA;
                let bank_name = data.result[0].bank;
                let secert = 'CUfL4levur';
                let ip = token.ip.ipAddress;
                var options = {
                    'method': 'POST',
                    'url': site.url + '/apibackend/transfer_scb',
                    'headers': {
                        'Authorization': 'Bearer ' + auth.txt,
                        'Content-Type': 'application/x-www-form-urlencoded'
                    },
                    form: {
                        'accnum': accnum,
                        'bank': bank,
                        'amount': amount,
                        'id': id,
                        'admin': admin,
                        'username': username,
                        'usernameUFA': usernameUFA,
                        'bank_name': bank_name,
                        'secert': secert,
                        'ip': ip
                    }
                };
                request(options, async function(error, response) {
                    if (error) throw new Error(error);
                    let result = await JSON.parse(response.body);
                    if (result.status) {
                        responeData.statusCode = httpStatusCodes.Success.ok.code;
                        responeData.statusCodeText = httpStatusCodes.Success.ok.codeText;
                        responeData.username = username;
                    } else {
                        responeData.statusCode = httpStatusCodes.Fail.fail.code;
                        responeData.statusCodeText = httpStatusCodes.Fail.fail.codeText;
                        responeData.description = result.msg;
                    }
                    res.send(responeData);
                });
            } else {
                responeData.statusCode = httpStatusCodes.Fail.fail.code;
                responeData.statusCodeText = httpStatusCodes.Fail.fail.codeText;
                responeData.description = "Can't Find Data";
            }
        } else {
            responeData.statusCode = httpStatusCodes.ClientErrors.unauthorized.code;
            responeData.statusCodeText = httpStatusCodes.ClientErrors.unauthorized.codeText
            responeData.description = auth.msg;
            res.send(responeData);
        }
    } catch (e) {
        responeData.statusCode = httpStatusCodes.Fail.fail.code;
        responeData.statusCodeText = httpStatusCodes.Fail.fail.codeText;
        res.send(responeData);
    }
}

module.exports.ApiupdateStatusWithdraw = async(req, res) => {
    let responeData = {};
    res.setHeader('Content-Type', 'application/json');
    try {
        let auth = await checkAuth(req.headers.authorization);
        if (auth.status) {
            let data = await queryMember.updateStatusWithdraw(req);
            if (data.status) {
                data = await queryMember.queryWithdrawUser(req);
                let token = await parseJwt(auth.txt);
                let ip = token.ip.ipAddress
                let accnum = data.result[0].accnum;
                let bank = data.result[0].code;
                let amount = data.result[0].amount;
                let id = data.result[0].tid;
                let admin = token.username;
                let username = data.result[0].member_username;
                let usernameUFA = data.result[0].usernameUFA;
                let bank_name = data.result[0].bank;
                let detail = "อนุมัติการถอนเงินให้ " + data.result[0].username + " จำนวน " + data.result[0].amount + " บาท"
                req.body.detail = detail;
                req.body.username = token.username;
                req.body.date = formatDate(new Date()) + ' ' + formatTime(new Date());
                await queryMember.insertStaffHistory(req);
                let message = "\nแจ้งเตือนอนุมัติโอนเงิน(ถอนมือ) \nUsername : " + usernameUFA + "\nเลขบัญชี : " + accnum + "\nธนาคาร : " + bank_name + "\nจำนวน : " + amount + " บาท\nโดย : " + admin + "\nIP => " + ip;
                data = await queryMember.querySettingSystem(req);
                sendMessageLineNotify(data.result[0].token_line_with, message);
                responeData.username = username;
                responeData.statusCode = httpStatusCodes.Success.ok.code;
                responeData.statusCodeText = httpStatusCodes.Success.ok.codeText;
            } else {
                responeData.statusCode = httpStatusCodes.Fail.fail.code;
                responeData.statusCodeText = httpStatusCodes.Fail.fail.codeText;
            }
        } else {
            responeData.statusCode = httpStatusCodes.ClientErrors.unauthorized.code;
            responeData.statusCodeText = httpStatusCodes.ClientErrors.unauthorized.codeText
            responeData.description = auth.msg;
        }
    } catch (e) {
        responeData.statusCode = httpStatusCodes.Fail.fail.code;
        responeData.statusCodeText = httpStatusCodes.Fail.fail.codeText;
    }
    res.send(responeData);
}

module.exports.ApiupdateUnStatusWithdraw = async(req, res) => {
    let responeData = {};
    res.setHeader('Content-Type', 'application/json');
    try {
        let auth = await checkAuth(req.headers.authorization);
        if (auth.status) {
            let data = await queryMember.updateUnStatusWithdraw(req);
            if (data.status) {
                data = await queryMember.queryWithdrawUser(req);
                let token = await parseJwt(auth.txt);
                let ip = token.ip.ipAddress
                let accnum = data.result[0].accnum;
                let bank = data.result[0].code;
                let amount = data.result[0].amount;
                let id = data.result[0].tid;
                let admin = token.username;
                let username = data.result[0].member_username;
                let usernameUFA = data.result[0].usernameUFA;
                let bank_name = data.result[0].bank;
                var options = {
                    'method': 'POST',
                    'url': site.url + '/apibackend/add_credit_inject',
                    'headers': {
                        'Authorization': 'Bearer ' + auth.txt
                    },
                    form: {
                        'username': usernameUFA,
                        'amount': amount,
                        'admin': token.username,
                        'ip': token.ip.ipAddress
                    }
                };
                request(options, async function(error, response) {
                    if (error) throw new Error(error);

                });
                let detail = "ไม่อนุมัติการถอนเงินให้ " + data.result[0].username + " จำนวน " + data.result[0].amount + " บาท"
                req.body.detail = detail;
                req.body.username = token.username;
                req.body.date = formatDate(new Date()) + ' ' + formatTime(new Date());
                await queryMember.insertStaffHistory(req);
                let message = "\n❌แจ้งเตือนยกเลิกโอนเงินให้❌\n \nUsername : " + usernameUFA + "\nเลขบัญชี : " + accnum + "\nธนาคาร : " + bank_name + "\nจำนวน : " + amount + " บาท\nโดย : " + admin + "\nIP => " + ip;
                data = await queryMember.querySettingSystem(req);
                sendMessageLineNotify(data.result[0].token_line_with, message);
                responeData.username = username;
                responeData.statusCode = httpStatusCodes.Success.ok.code;
                responeData.statusCodeText = httpStatusCodes.Success.ok.codeText;
            } else {
                responeData.statusCode = httpStatusCodes.Fail.fail.code;
                responeData.statusCodeText = httpStatusCodes.Fail.fail.codeText;
            }
        } else {
            responeData.statusCode = httpStatusCodes.ClientErrors.unauthorized.code;
            responeData.statusCodeText = httpStatusCodes.ClientErrors.unauthorized.codeText
            responeData.description = auth.msg;
        }
    } catch (e) {
        responeData.statusCode = httpStatusCodes.Fail.fail.code;
        responeData.statusCodeText = httpStatusCodes.Fail.fail.codeText;
    }
    res.send(responeData);
}

module.exports.ApiqueryWithdrawSuccess = async(req, res) => {
    let responeData = {};
    res.setHeader('Content-Type', 'application/json');
    try {
        let auth = await checkAuth(req.headers.authorization);
        if (auth.status) {
            let data = await queryMember.queryWithdrawSuccess(req);
            if (data.status && data.result.length > 0) {
                responeData.statusCode = httpStatusCodes.Success.ok.code;
                responeData.statusCodeText = httpStatusCodes.Success.ok.codeText;
                responeData.withdraw = data.result;
            } else {
                responeData.statusCode = httpStatusCodes.Fail.fail.code;
                responeData.statusCodeText = httpStatusCodes.Fail.fail.codeText;
            }
        } else {
            responeData.statusCode = httpStatusCodes.ClientErrors.unauthorized.code;
            responeData.statusCodeText = httpStatusCodes.ClientErrors.unauthorized.codeText
            responeData.description = auth.msg;
        }
    } catch (e) {
        responeData.statusCode = httpStatusCodes.Fail.fail.code;
        responeData.statusCodeText = httpStatusCodes.Fail.fail.codeText;
    }
    res.send(responeData);
}


module.exports.ApiqueryWithdrawUnSuccess = async(req, res) => {
    let responeData = {};
    res.setHeader('Content-Type', 'application/json');
    try {
        let auth = await checkAuth(req.headers.authorization);
        if (auth.status) {
            let data = await queryMember.queryWithdrawUnSuccess(req);
            if (data.status && data.result.length > 0) {
                responeData.statusCode = httpStatusCodes.Success.ok.code;
                responeData.statusCodeText = httpStatusCodes.Success.ok.codeText;
                responeData.withdraw = data.result;
            } else {
                responeData.statusCode = httpStatusCodes.Fail.fail.code;
                responeData.statusCodeText = httpStatusCodes.Fail.fail.codeText;
            }
        } else {
            responeData.statusCode = httpStatusCodes.ClientErrors.unauthorized.code;
            responeData.statusCodeText = httpStatusCodes.ClientErrors.unauthorized.codeText
            responeData.description = auth.msg;
        }
    } catch (e) {
        responeData.statusCode = httpStatusCodes.Fail.fail.code;
        responeData.statusCodeText = httpStatusCodes.Fail.fail.codeText;
    }
    res.send(responeData);
}

function formatDate2(d) {
    let date = new Date(d);
    let dd = date.getDate();
    let mmm = date.getMonth() + 1;
    let yy = date.getFullYear();
    if (mmm < 10) {
        mmm = '0' + mmm;
    }
    if (dd < 10) {
        dd = '0' + dd;
    }
    let result = yy + "-" + mmm;
    return result;
}

function formatDate3(d) {
    let date = new Date(d);
    let dd = date.getDate();
    let mmm = date.getMonth() + 1;
    let yy = date.getFullYear();
    if (mmm < 10) {
        mmm = '0' + mmm;
    }
    if (dd < 10) {
        dd = '0' + dd;
    }
    let result = yy;
    return result;
}

module.exports.ApiqueryResult = async(req, res) => {
    let responeData = {};
    res.setHeader('Content-Type', 'application/json');
    try {
        let auth = await checkAuth(req.headers.authorization);
        if (auth.status) {
            let date_start = new Date();
            let date_end = new Date();
            date_start.setHours(0);
            date_start.setMinutes(0);
            date_start.setSeconds(0);
            date_end.setHours(23);
            date_end.setMinutes(59);
            date_end.setSeconds(59);
            date_end.setDate(date_end.getDate() + 1);
            responeData.statusCode = httpStatusCodes.Success.ok.code;
            responeData.statusCodeText = httpStatusCodes.Success.ok.codeText;
            req.body.date_start = formatDate1(date_start) + ' ' + formatTime(date_start);
            req.body.date_end = formatDate1(date_end) + ' ' + formatTime(date_end);
            req.body.type = 1;
            let data = await queryMember.queryResults(req);
            responeData.deposit_today = 0;
            responeData.withdraw_today = 0;
            if (data.result[0].amount) {
                responeData.deposit_today += data.result[0].amount;
            } else {
                responeData.deposit_today += 0;
            }
            req.body.type = 'Deposit';
            data = await queryMember.queryResultsManual(req);
            if (data.result[0].amount) {
                responeData.deposit_today += data.result[0].amount;
            } else {
                responeData.deposit_today += 0;
            }
            req.body.type = 0;
            data = await queryMember.queryResults(req);
            if (data.result[0].amount) {
                responeData.withdraw_today += data.result[0].amount;
            } else {
                responeData.withdraw_today += 0;
            }
            req.body.type = 'Withdraw';
            data = await queryMember.queryResultsManual(req);
            if (data.result[0].amount) {
                responeData.withdraw_today += data.result[0].amount;
            } else {
                responeData.withdraw_today += 0;
            }
            responeData.total_today = responeData.deposit_today - responeData.withdraw_today;
            responeData.deposit_month = 0;
            responeData.withdraw_month = 0;
            let date = formatDate2(new Date());
            req.body.date = date;
            req.body.type = 1;
            data = await queryMember.queryResultsMonth(req);
            if (data.result[0].amount) {
                responeData.deposit_month += data.result[0].amount;
            } else {
                responeData.deposit_month += 0;
            }
            req.body.type = 'Deposit';
            data = await queryMember.queryResultsManualMonth(req);
            if (data.result[0].amount) {
                responeData.deposit_month += data.result[0].amount;
            } else {
                responeData.deposit_month += 0;
            }


            req.body.type = 0;
            data = await queryMember.queryResultsMonth(req);
            if (data.result[0].amount) {
                responeData.withdraw_month = data.result[0].amount;
            } else {
                responeData.withdraw_month = 0;
            }

            req.body.type = 'Withdraw';
            data = await queryMember.queryResultsManualMonth(req);
            if (data.result[0].amount) {
                responeData.withdraw_month += data.result[0].amount;
            } else {
                responeData.withdraw_month += 0;
            }
            responeData.total_month = responeData.deposit_month - responeData.withdraw_month;

            responeData.deposit_year = 0;
            responeData.withdraw_year = 0;
            date = formatDate3(new Date());
            req.body.date = date;
            req.body.type = 1;
            data = await queryMember.queryResultsMonth(req);
            if (data.result[0].amount) {
                responeData.deposit_year = data.result[0].amount;
            } else {
                responeData.deposit_year = 0;
            }
            req.body.type = 'Deposit';
            data = await queryMember.queryResultsManualMonth(req);
            if (data.result[0].amount) {
                responeData.deposit_year += data.result[0].amount;
            } else {
                responeData.deposit_year += 0;
            }
            req.body.type = 0;
            data = await queryMember.queryResultsMonth(req);
            if (data.result[0].amount) {
                responeData.withdraw_year = data.result[0].amount;
            } else {
                responeData.withdraw_year = 0;
            }

            req.body.type = 'Withdraw';
            data = await queryMember.queryResultsManualMonth(req);
            if (data.result[0].amount) {
                responeData.withdraw_year += data.result[0].amount;
            } else {
                responeData.withdraw_year += 0;
            }
            responeData.total_year = responeData.deposit_year - responeData.withdraw_year;

            data = await queryMember.queryLastDeposit(req);
            if (data.result.length > 0) {
                responeData.last_deposit = data.result;
            } else {
                responeData.last_deposit = [];
            }

            data = await queryMember.queryTopDeposit(req);
            if (data.result.length > 0) {
                responeData.top_deposit = data.result;
            } else {
                responeData.top_deposit = [];
            }

            data = await queryMember.queryTopWithdraw(req);
            if (data.result.length > 0) {
                responeData.top_withdraw = data.result;
            } else {
                responeData.top_withdraw = [];
            }



        } else {
            responeData.statusCode = httpStatusCodes.ClientErrors.unauthorized.code;
            responeData.statusCodeText = httpStatusCodes.ClientErrors.unauthorized.codeText
            responeData.description = auth.msg;
        }
    } catch (e) {
        responeData.statusCode = httpStatusCodes.Fail.fail.code;
        responeData.statusCodeText = httpStatusCodes.Fail.fail.codeText;
    }
    res.send(responeData);
}

module.exports.ApiqueryWithdrawReport = async(req, res) => {
    let responeData = {};
    res.setHeader('Content-Type', 'application/json');
    try {
        let auth = await checkAuth(req.headers.authorization);
        if (auth.status) {
            let data = await queryMember.queryReportWithdraw(req);
            if (data.status && data.result.length > 0) {
                responeData.statusCode = httpStatusCodes.Success.ok.code;
                responeData.statusCodeText = httpStatusCodes.Success.ok.codeText;
                responeData.withdraw = data.result;
            } else {
                responeData.statusCode = httpStatusCodes.Fail.fail.code;
                responeData.statusCodeText = httpStatusCodes.Fail.fail.codeText;
            }
        } else {
            responeData.statusCode = httpStatusCodes.ClientErrors.unauthorized.code;
            responeData.statusCodeText = httpStatusCodes.ClientErrors.unauthorized.codeText
            responeData.description = auth.msg;
        }
    } catch (e) {
        responeData.statusCode = httpStatusCodes.Fail.fail.code;
        responeData.statusCodeText = httpStatusCodes.Fail.fail.codeText;
    }
    res.send(responeData);
}

module.exports.ApiqueryWithdrawAutoReport = async(req, res) => {
    let responeData = {};
    res.setHeader('Content-Type', 'application/json');
    try {
        let auth = await checkAuth(req.headers.authorization);
        if (auth.status) {
            let data = await queryMember.queryReportWithdrawAuto(req);
            if (data.status && data.result.length > 0) {
                responeData.statusCode = httpStatusCodes.Success.ok.code;
                responeData.statusCodeText = httpStatusCodes.Success.ok.codeText;
                responeData.withdraw = data.result;
            } else {
                responeData.statusCode = httpStatusCodes.Fail.fail.code;
                responeData.statusCodeText = httpStatusCodes.Fail.fail.codeText;
            }
        } else {
            responeData.statusCode = httpStatusCodes.ClientErrors.unauthorized.code;
            responeData.statusCodeText = httpStatusCodes.ClientErrors.unauthorized.codeText
            responeData.description = auth.msg;
        }
    } catch (e) {
        responeData.statusCode = httpStatusCodes.Fail.fail.code;
        responeData.statusCodeText = httpStatusCodes.Fail.fail.codeText;
    }
    res.send(responeData);
}


module.exports.ApiqueryDepositReport = async(req, res) => {
    let responeData = {};
    res.setHeader('Content-Type', 'application/json');
    try {
        let auth = await checkAuth(req.headers.authorization);
        if (auth.status) {
            let data = await queryMember.queryReportDeposit(req);
            if (data.status && data.result.length > 0) {
                responeData.statusCode = httpStatusCodes.Success.ok.code;
                responeData.statusCodeText = httpStatusCodes.Success.ok.codeText;
                responeData.withdraw = data.result;
            } else {
                responeData.statusCode = httpStatusCodes.Fail.fail.code;
                responeData.statusCodeText = httpStatusCodes.Fail.fail.codeText;
            }
        } else {
            responeData.statusCode = httpStatusCodes.ClientErrors.unauthorized.code;
            responeData.statusCodeText = httpStatusCodes.ClientErrors.unauthorized.codeText
            responeData.description = auth.msg;
        }
    } catch (e) {
        responeData.statusCode = httpStatusCodes.Fail.fail.code;
        responeData.statusCodeText = httpStatusCodes.Fail.fail.codeText;
    }
    res.send(responeData);
}

function getDaysInMonth(year, month) {
    return new Date(year, month, 0).getDate();
}

module.exports.ApiqueryFinanceReport = async(req, res) => {
    let responeData = {};
    res.setHeader('Content-Type', 'application/json');
    try {
        let auth = await checkAuth(req.headers.authorization);
        if (auth.status) {
            let getLastDay = await getDaysInMonth(req.body.year, req.body.month);
            let month = req.body.month;
            let year = req.body.year;
            let start_date = '';
            let end_date = '';

            if (month < 10) {
                month = '0' + month;
            }

            let total = [];
            for (let i = 0; i < getLastDay; i++) {
                let total_deposit = 0;
                let total_withdraw = 0;
                if (i < 9) {
                    start_date = year + '-' + month + '-' + '0' + (i + 1) + ' ' + '00:00:00';
                    end_date = year + '-' + month + '-' + '0' + (i + 1) + ' ' + '23:59:59';
                } else {
                    start_date = year + '-' + month + '-' + (i + 1) + ' ' + '00:00:00';
                    end_date = year + '-' + month + '-' + (i + 1) + ' ' + '23:59:59';
                }

                let deposit = await queryMember.queryDepositSummary(start_date, end_date);
                let deposit_manual = await queryMember.queryDepositManualSummary(start_date, end_date);
                let withdraw = await queryMember.queryWithdrawSummary(start_date, end_date);
                let withdraw_manual = await queryMember.queryWithdrawManualSummary(start_date, end_date);
                if (deposit.result[0].total) {
                    total_deposit += deposit.result[0].total;
                }

                if (deposit_manual.result[0].total) {
                    total_deposit += deposit_manual.result[0].total;
                }

                if (withdraw.result[0].total) {
                    total_withdraw += withdraw.result[0].total;
                }

                if (withdraw_manual.result[0].total) {
                    total_withdraw += withdraw_manual.result[0].total;
                }

                total.push({
                    'deposit': total_deposit ? total_deposit : 0,
                    'withdraw': total_withdraw ? total_withdraw : 0
                });
            }

            responeData.statusCode = httpStatusCodes.Success.ok.code;
            responeData.statusCodeText = httpStatusCodes.Success.ok.codeText;
            responeData.finance = total;

        } else {
            responeData.statusCode = httpStatusCodes.ClientErrors.unauthorized.code;
            responeData.statusCodeText = httpStatusCodes.ClientErrors.unauthorized.codeText
            responeData.description = auth.msg;
        }
    } catch (e) {
        responeData.statusCode = httpStatusCodes.Fail.fail.code;
        responeData.statusCodeText = httpStatusCodes.Fail.fail.codeText;
    }
    res.send(responeData);
}

module.exports.ApiqueryTransactionManual = async(req, res) => {
    let responeData = {};
    res.setHeader('Content-Type', 'application/json');
    try {
        let auth = await checkAuth(req.headers.authorization);
        if (auth.status) {
            let data = await queryMember.queryTransactionManual(req);
            if (data.status && data.result.length > 0) {
                responeData.statusCode = httpStatusCodes.Success.ok.code;
                responeData.statusCodeText = httpStatusCodes.Success.ok.codeText;
                responeData.withdraw = data.result;
            } else {
                responeData.statusCode = httpStatusCodes.Fail.fail.code;
                responeData.statusCodeText = httpStatusCodes.Fail.fail.codeText;
            }
        } else {
            responeData.statusCode = httpStatusCodes.ClientErrors.unauthorized.code;
            responeData.statusCodeText = httpStatusCodes.ClientErrors.unauthorized.codeText
            responeData.description = auth.msg;
        }
    } catch (e) {
        responeData.statusCode = httpStatusCodes.Fail.fail.code;
        responeData.statusCodeText = httpStatusCodes.Fail.fail.codeText;
    }
    res.send(responeData);
}


module.exports.ApiqueryStaff = async(req, res) => {
    let responeData = {};
    res.setHeader('Content-Type', 'application/json');
    try {
        let auth = await checkAuth(req.headers.authorization);
        if (auth.status) {
            let data = await queryMember.queryAllStaff();
            if (data.status && data.result.length > 0) {
                let token = await parseJwt(auth.txt);
                req.body.username = token.username;
                req.body.ip = token.ip.ipAddress;
                req.body.detail = 'เปิดหน้า STAFF';
                req.body.module = 'Admin Page';
                req.body.date = formatDate(new Date()) + ' ' + formatTime(new Date());
                await queryMember.insertReportActivity(req);
                responeData.statusCode = httpStatusCodes.Success.ok.code;
                responeData.statusCodeText = httpStatusCodes.Success.ok.codeText;
                responeData.data = data.result;
            } else {
                responeData.statusCode = httpStatusCodes.Fail.fail.code;
                responeData.statusCodeText = httpStatusCodes.Fail.fail.codeText;
            }
        } else {
            responeData.statusCode = httpStatusCodes.ClientErrors.unauthorized.code;
            responeData.statusCodeText = httpStatusCodes.ClientErrors.unauthorized.codeText
            responeData.description = auth.msg;
        }
    } catch (e) {
        responeData.statusCode = httpStatusCodes.Fail.fail.code;
        responeData.statusCodeText = httpStatusCodes.Fail.fail.codeText;
    }
    res.send(responeData);
}

module.exports.ApiqueryStaffByID = async(req, res) => {
    let responeData = {};
    res.setHeader('Content-Type', 'application/json');
    try {
        let auth = await checkAuth(req.headers.authorization);
        if (auth.status) {
            let data = await queryMember.queryAllStaffByID(req);
            if (data.status && data.result.length > 0) {
                responeData.statusCode = httpStatusCodes.Success.ok.code;
                responeData.statusCodeText = httpStatusCodes.Success.ok.codeText;
                responeData.data = data.result;
            } else {
                responeData.statusCode = httpStatusCodes.Fail.fail.code;
                responeData.statusCodeText = httpStatusCodes.Fail.fail.codeText;
            }
        } else {
            responeData.statusCode = httpStatusCodes.ClientErrors.unauthorized.code;
            responeData.statusCodeText = httpStatusCodes.ClientErrors.unauthorized.codeText
            responeData.description = auth.msg;
        }
    } catch (e) {
        responeData.statusCode = httpStatusCodes.Fail.fail.code;
        responeData.statusCodeText = httpStatusCodes.Fail.fail.codeText;
    }
    res.send(responeData);
}


module.exports.ApiaddStaff = async(req, res) => {
    let responeData = {};
    res.setHeader('Content-Type', 'application/json');
    try {
        let auth = await checkAuth(req.headers.authorization);
        if (auth.status) {
            const salt = genSaltSync(10);
            req.body.password = hashSync(req.body.password, salt);
            let data = await queryMember.insertStaff(req);
            if (data.status) {
                let token = await parseJwt(auth.txt);
                let username = req.body.username;
                req.body.username = token.username;
                req.body.ip = token.ip.ipAddress;
                req.body.detail = 'เพิ่ม STAFF ||' + username;
                req.body.module = 'Admin Page';
                req.body.date = formatDate(new Date()) + ' ' + formatTime(new Date());
                await queryMember.insertReportActivity(req);
                responeData.statusCode = httpStatusCodes.Success.ok.code;
                responeData.statusCodeText = httpStatusCodes.Success.ok.codeText;
                responeData.data = data.result;
            } else {
                responeData.statusCode = httpStatusCodes.Fail.fail.code;
                responeData.statusCodeText = httpStatusCodes.Fail.fail.codeText;
            }
        } else {
            responeData.statusCode = httpStatusCodes.ClientErrors.unauthorized.code;
            responeData.statusCodeText = httpStatusCodes.ClientErrors.unauthorized.codeText
            responeData.description = auth.msg;
        }
    } catch (e) {
        responeData.statusCode = httpStatusCodes.Fail.fail.code;
        responeData.statusCodeText = httpStatusCodes.Fail.fail.codeText;
    }
    res.send(responeData);
}


module.exports.ApideleteStaff = async(req, res) => {
    let responeData = {};
    res.setHeader('Content-Type', 'application/json');
    try {
        let auth = await checkAuth(req.headers.authorization);
        if (auth.status) {
            let data = await queryMember.deleteStaff(req);
            if (data.status) {
                responeData.statusCode = httpStatusCodes.Success.ok.code;
                responeData.statusCodeText = httpStatusCodes.Success.ok.codeText;
            } else {
                responeData.statusCode = httpStatusCodes.Fail.fail.code;
                responeData.statusCodeText = httpStatusCodes.Fail.fail.codeText;
            }
        } else {
            responeData.statusCode = httpStatusCodes.ClientErrors.unauthorized.code;
            responeData.statusCodeText = httpStatusCodes.ClientErrors.unauthorized.codeText
            responeData.description = auth.msg;
        }
    } catch (e) {
        responeData.statusCode = httpStatusCodes.Fail.fail.code;
        responeData.statusCodeText = httpStatusCodes.Fail.fail.codeText;
    }
    res.send(responeData);
}

module.exports.ApiupdateStaff = async(req, res) => {
    let responeData = {};
    res.setHeader('Content-Type', 'application/json');
    try {
        let auth = await checkAuth(req.headers.authorization);
        if (auth.status) {
            let data = await queryMember.updateStaff(req);
            if (data.status) {
                responeData.statusCode = httpStatusCodes.Success.ok.code;
                responeData.statusCodeText = httpStatusCodes.Success.ok.codeText;
            } else {
                responeData.statusCode = httpStatusCodes.Fail.fail.code;
                responeData.statusCodeText = httpStatusCodes.Fail.fail.codeText;
            }
        } else {
            responeData.statusCode = httpStatusCodes.ClientErrors.unauthorized.code;
            responeData.statusCodeText = httpStatusCodes.ClientErrors.unauthorized.codeText
            responeData.description = auth.msg;
        }
    } catch (e) {
        responeData.statusCode = httpStatusCodes.Fail.fail.code;
        responeData.statusCodeText = httpStatusCodes.Fail.fail.codeText;
    }
    res.send(responeData);
}

module.exports.ApiqueryeStaffHistory = async(req, res) => {
    let responeData = {};
    res.setHeader('Content-Type', 'application/json');
    try {
        let auth = await checkAuth(req.headers.authorization);
        if (auth.status) {
            let data = await queryMember.queryStaffHistory(req);
            if (data.status && data.result.length > 0) {
                responeData.statusCode = httpStatusCodes.Success.ok.code;
                responeData.statusCodeText = httpStatusCodes.Success.ok.codeText;
                responeData.data = data.result;
            } else {
                responeData.statusCode = httpStatusCodes.Fail.fail.code;
                responeData.statusCodeText = httpStatusCodes.Fail.fail.codeText;
            }
        } else {
            responeData.statusCode = httpStatusCodes.ClientErrors.unauthorized.code;
            responeData.statusCodeText = httpStatusCodes.ClientErrors.unauthorized.codeText
            responeData.description = auth.msg;
        }
    } catch (e) {
        responeData.statusCode = httpStatusCodes.Fail.fail.code;
        responeData.statusCodeText = httpStatusCodes.Fail.fail.codeText;
    }
    res.send(responeData);
}


module.exports.ApiqueryeSettingWheel = async(req, res) => {
    let responeData = {};
    res.setHeader('Content-Type', 'application/json');
    try {
        let auth = await checkAuth(req.headers.authorization);
        if (auth.status) {
            let data = await queryMember.querySettingWheel(req);
            if (data.status && data.result.length > 0) {
                responeData.statusCode = httpStatusCodes.Success.ok.code;
                responeData.statusCodeText = httpStatusCodes.Success.ok.codeText;
                responeData.data = data.result;
            } else {
                responeData.statusCode = httpStatusCodes.Fail.fail.code;
                responeData.statusCodeText = httpStatusCodes.Fail.fail.codeText;
            }
        } else {
            responeData.statusCode = httpStatusCodes.ClientErrors.unauthorized.code;
            responeData.statusCodeText = httpStatusCodes.ClientErrors.unauthorized.codeText
            responeData.description = auth.msg;
        }
    } catch (e) {
        responeData.statusCode = httpStatusCodes.Fail.fail.code;
        responeData.statusCodeText = httpStatusCodes.Fail.fail.codeText;
    }
    res.send(responeData);
}

module.exports.ApiupdateSetting_w = async(req, res) => {
    let responeData = {};
    res.setHeader('Content-Type', 'application/json');
    try {
        let auth = await checkAuth(req.headers.authorization);
        if (auth.status) {
            let data = await queryMember.updateSetting_w(req);
            if (data.status) {
                responeData.statusCode = httpStatusCodes.Success.ok.code;
                responeData.statusCodeText = httpStatusCodes.Success.ok.codeText;
            } else {
                responeData.statusCode = httpStatusCodes.Fail.fail.code;
                responeData.statusCodeText = httpStatusCodes.Fail.fail.codeText;
            }
        } else {
            responeData.statusCode = httpStatusCodes.ClientErrors.unauthorized.code;
            responeData.statusCodeText = httpStatusCodes.ClientErrors.unauthorized.codeText
            responeData.description = auth.msg;
        }
    } catch (e) {
        responeData.statusCode = httpStatusCodes.Fail.fail.code;
        responeData.statusCodeText = httpStatusCodes.Fail.fail.codeText;
    }
    res.send(responeData);
}
module.exports.ApiupdateSettingWheel = async(req, res) => {
    let responeData = {};
    res.setHeader('Content-Type', 'application/json');
    try {
        let auth = await checkAuth(req.headers.authorization);
        if (auth.status) {
            for (let i = 0; i < req.body.arr.length; i++) {
                await queryMember.updateSettingWheel(req.body.arr[i]);
            }
            responeData.statusCode = httpStatusCodes.Success.ok.code;
            responeData.statusCodeText = httpStatusCodes.Success.ok.codeText;

        } else {
            responeData.statusCode = httpStatusCodes.ClientErrors.unauthorized.code;
            responeData.statusCodeText = httpStatusCodes.ClientErrors.unauthorized.codeText
            responeData.description = auth.msg;
        }
    } catch (e) {
        responeData.statusCode = httpStatusCodes.Fail.fail.code;
        responeData.statusCodeText = httpStatusCodes.Fail.fail.codeText;
    }
    res.send(responeData);
}


module.exports.ApiqueryWheelReport = async(req, res) => {
    let responeData = {};
    res.setHeader('Content-Type', 'application/json');
    try {
        let auth = await checkAuth(req.headers.authorization);
        if (auth.status) {
            let data = await queryMember.queryWheelReport(req);
            if (data.status && data.result.length > 0) {
                responeData.statusCode = httpStatusCodes.Success.ok.code;
                responeData.statusCodeText = httpStatusCodes.Success.ok.codeText;
                responeData.withdraw = data.result;
            } else {
                responeData.statusCode = httpStatusCodes.Fail.fail.code;
                responeData.statusCodeText = httpStatusCodes.Fail.fail.codeText;
            }
        } else {
            responeData.statusCode = httpStatusCodes.ClientErrors.unauthorized.code;
            responeData.statusCodeText = httpStatusCodes.ClientErrors.unauthorized.codeText
            responeData.description = auth.msg;
        }
    } catch (e) {
        responeData.statusCode = httpStatusCodes.Fail.fail.code;
        responeData.statusCodeText = httpStatusCodes.Fail.fail.codeText;
    }
    res.send(responeData);
}

module.exports.ApiquerySettingPowYingShup = async(req, res) => {
    let responeData = {};
    res.setHeader('Content-Type', 'application/json');
    try {
        let auth = await checkAuth(req.headers.authorization);
        if (auth.status) {
            let data = await queryMember.querySettingPowYingShup(req);
            if (data.status && data.result.length > 0) {
                responeData.statusCode = httpStatusCodes.Success.ok.code;
                responeData.statusCodeText = httpStatusCodes.Success.ok.codeText;
                responeData.data = data.result;
            } else {
                responeData.statusCode = httpStatusCodes.Fail.fail.code;
                responeData.statusCodeText = httpStatusCodes.Fail.fail.codeText;
            }
        } else {
            responeData.statusCode = httpStatusCodes.ClientErrors.unauthorized.code;
            responeData.statusCodeText = httpStatusCodes.ClientErrors.unauthorized.codeText
            responeData.description = auth.msg;
        }
    } catch (e) {
        responeData.statusCode = httpStatusCodes.Fail.fail.code;
        responeData.statusCodeText = httpStatusCodes.Fail.fail.codeText;
    }
    res.send(responeData);
}

module.exports.ApiupdatePowYingShup = async(req, res) => {
    let responeData = {};
    res.setHeader('Content-Type', 'application/json');
    try {
        let auth = await checkAuth(req.headers.authorization);
        if (auth.status) {
            let data = await queryMember.updatePowYingShup(req);
            if (data.status) {
                responeData.statusCode = httpStatusCodes.Success.ok.code;
                responeData.statusCodeText = httpStatusCodes.Success.ok.codeText;
            } else {
                responeData.statusCode = httpStatusCodes.Fail.fail.code;
                responeData.statusCodeText = httpStatusCodes.Fail.fail.codeText;
            }
        } else {
            responeData.statusCode = httpStatusCodes.ClientErrors.unauthorized.code;
            responeData.statusCodeText = httpStatusCodes.ClientErrors.unauthorized.codeText
            responeData.description = auth.msg;
        }
    } catch (e) {
        responeData.statusCode = httpStatusCodes.Fail.fail.code;
        responeData.statusCodeText = httpStatusCodes.Fail.fail.codeText;
    }
    res.send(responeData);
}

module.exports.ApiqueryPowYingShupReport = async(req, res) => {
    let responeData = {};
    res.setHeader('Content-Type', 'application/json');
    try {
        let auth = await checkAuth(req.headers.authorization);
        if (auth.status) {
            let data = await queryMember.queryPowYingShupReport(req);
            if (data.status && data.result.length > 0) {
                responeData.statusCode = httpStatusCodes.Success.ok.code;
                responeData.statusCodeText = httpStatusCodes.Success.ok.codeText;
                responeData.withdraw = data.result;
            } else {
                responeData.statusCode = httpStatusCodes.Fail.fail.code;
                responeData.statusCodeText = httpStatusCodes.Fail.fail.codeText;
            }
        } else {
            responeData.statusCode = httpStatusCodes.ClientErrors.unauthorized.code;
            responeData.statusCodeText = httpStatusCodes.ClientErrors.unauthorized.codeText
            responeData.description = auth.msg;
        }
    } catch (e) {
        responeData.statusCode = httpStatusCodes.Fail.fail.code;
        responeData.statusCodeText = httpStatusCodes.Fail.fail.codeText;
    }
    res.send(responeData);
}


module.exports.ApicheckStatusSCB = async(req, res) => {
    let responeData = {};
    res.setHeader('Content-Type', 'application/json');
    try {
        let auth = await checkAuth(req.headers.authorization);
        if (auth.status) {
            let data = await queryMember.queryCheckBankSCBDetail(req);
            if (data.status && data.result.length > 0) {
                responeData.accnum = data.result[0].accnum;
                responeData.name = data.result[0].name;
            }
            var options = {
                'method': 'POST',
                'url': site.url + '/apibackend/check_scb',
                'headers': {
                    'Authorization': 'Bearer ' + auth.txt
                }
            };
            request(options, async function(error, response) {
                if (error) throw new Error(error);
                let result = await JSON.parse(response.body);
                if (result.status != 500) {
                    responeData.statusCode = httpStatusCodes.Success.ok.code;
                    responeData.statusCodeText = httpStatusCodes.Success.ok.codeText;
                    responeData.credit = JSON.parse(result.data).result;

                } else {
                    responeData.statusCode = httpStatusCodes.Fail.fail.code;
                    responeData.statusCodeText = httpStatusCodes.Fail.fail.codeText;
                    responeData.description = result.message;
                }
                res.send(responeData);
            });
        } else {
            responeData.statusCode = httpStatusCodes.ClientErrors.unauthorized.code;
            responeData.statusCodeText = httpStatusCodes.ClientErrors.unauthorized.codeText
            responeData.description = auth.msg;
            res.send(responeData);
        }
    } catch (e) {
        responeData.statusCode = httpStatusCodes.Fail.fail.code;
        responeData.statusCodeText = httpStatusCodes.Fail.fail.codeText;
        res.send(responeData);
    }
}

module.exports.ApiaddAlliance = async(req, res) => {
    let responeData = {};
    res.setHeader('Content-Type', 'application/json');
    try {
        let auth = await checkAuth(req.headers.authorization);
        if (auth.status) {
            req.body.date = formatDate1(new Date()) + ' ' + formatTime(new Date());
            let data = await queryMember.insertAlliance(req);
            if (data.status) {
                responeData.statusCode = httpStatusCodes.Success.ok.code;
                responeData.statusCodeText = httpStatusCodes.Success.ok.codeText;
                responeData.data = data.result;
            } else {
                responeData.statusCode = httpStatusCodes.Fail.fail.code;
                responeData.statusCodeText = httpStatusCodes.Fail.fail.codeText;
                responeData.description = 'Insert Error';
            }
        } else {
            responeData.statusCode = httpStatusCodes.ClientErrors.unauthorized.code;
            responeData.statusCodeText = httpStatusCodes.ClientErrors.unauthorized.codeText
            responeData.description = auth.msg;
        }
    } catch (e) {
        responeData.statusCode = httpStatusCodes.Fail.fail.code;
        responeData.statusCodeText = httpStatusCodes.Fail.fail.codeText;
        responeData.description = 'Server Error';
    }
    res.send(responeData);
}

module.exports.ApiqueryAlliance = async(req, res) => {
    let responeData = {};
    res.setHeader('Content-Type', 'application/json');
    try {
        let auth = await checkAuth(req.headers.authorization);
        if (auth.status) {
            let data = await queryMember.queryAlliance(req);
            if (data.status && data.result.length > 0) {
                responeData.data = data.result;
                let data_url = await queryMember.querySettingSystem();
                if (data_url.status && data_url.result.length > 0) {
                    responeData.name_web = data_url.result[0].name_web;
                }
                for (let i = 0; i < data.result.length; i++) {
                    let code = data.result[i].code;
                    let deposit = 0;
                    let withdraw = 0;
                    let check_member = await queryMember.queryAllianceMember(code);
                    responeData.data[i].member = check_member.result;
                    responeData.data[i].countmember = check_member.result.length
                    for (let j = 0; j < check_member.result.length; j++) {
                        let check_deposit_auto = await queryMember.queryCheckDepositAuto(check_member.result[j].username);
                        if (check_deposit_auto.result[0].deposit) {
                            deposit += check_deposit_auto.result[0].deposit;
                        }
                        let check_deposit_manual = await queryMember.queryCheckDepositManual(check_member.result[j].usernameUFA);
                        if (check_deposit_manual.result[0].deposit) {
                            deposit += check_deposit_manual.result[0].deposit;
                        }

                        let check_withdraw_auto = await queryMember.queryCheckWithdrawAuto(check_member.result[j].username);
                        if (check_withdraw_auto.result[0].deposit) {
                            withdraw += check_withdraw_auto.result[0].deposit;
                        }
                        let check_withdraw_manual = await queryMember.queryCheckWithdrawManual(check_member.result[j].usernameUFA);
                        if (check_withdraw_manual.result[0].deposit) {
                            withdraw += check_withdraw_manual.result[0].deposit;
                        }
                    }
                    responeData.data[i].deposit = deposit;
                    responeData.data[i].withdraw = withdraw;
                    responeData.data[i].total = deposit - withdraw;
                    let receive = ((deposit - withdraw) * data.result[i].percent) / 100;
                    responeData.data[i].receive = receive;
                }

                responeData.statusCode = httpStatusCodes.Success.ok.code;
                responeData.statusCodeText = httpStatusCodes.Success.ok.codeText;
            } else {
                responeData.statusCode = httpStatusCodes.Fail.fail.code;
                responeData.statusCodeText = httpStatusCodes.Fail.fail.codeText;
            }
            res.send(responeData);
        } else {
            responeData.statusCode = httpStatusCodes.ClientErrors.unauthorized.code;
            responeData.statusCodeText = httpStatusCodes.ClientErrors.unauthorized.codeText
            responeData.description = auth.msg;
            res.send(responeData);
        }
    } catch (e) {
        responeData.statusCode = httpStatusCodes.Fail.fail.code;
        responeData.statusCodeText = httpStatusCodes.Fail.fail.codeText;
        res.send(responeData);
    }
}

module.exports.ApideleteMemberAlliance = async(req, res) => {
    let responeData = {};
    res.setHeader('Content-Type', 'application/json');
    try {
        let auth = await checkAuth(req.headers.authorization);
        if (auth.status) {
            let data = await queryMember.deleteMemberAlliance(req);
            if (data.status) {
                responeData.statusCode = httpStatusCodes.Success.ok.code;
                responeData.statusCodeText = httpStatusCodes.Success.ok.codeText;
            } else {
                responeData.statusCode = httpStatusCodes.Fail.fail.code;
                responeData.statusCodeText = httpStatusCodes.Fail.fail.codeText;
            }
        } else {
            responeData.statusCode = httpStatusCodes.ClientErrors.unauthorized.code;
            responeData.statusCodeText = httpStatusCodes.ClientErrors.unauthorized.codeText
            responeData.description = auth.msg;
        }
    } catch (e) {
        responeData.statusCode = httpStatusCodes.Fail.fail.code;
        responeData.statusCodeText = httpStatusCodes.Fail.fail.codeText;
    }
    res.send(responeData);
}

module.exports.ApiqueryDetailAlliance = async(req, res) => {
    let responeData = {};
    res.setHeader('Content-Type', 'application/json');
    try {
        let auth = await checkAuth(req.headers.authorization);
        if (auth.status) {
            let code = req.body.code;
            let data = await queryMember.queryAlliance(req);
            let check_member = await queryMember.queryAllianceMember(code);
            let deposit = 0;
            let withdraw = 0;
            if (check_member.status && check_member.result.length > 0) {
                responeData.data = check_member.result;
                for (let j = 0; j < check_member.result.length; j++) {
                    req.body.username = check_member.result[j].username;
                    req.body.usernameUFA = check_member.result[j].usernameUFA;
                    responeData.data[j].deposit = 0;
                    responeData.data[j].withdraw = 0;

                    let check_deposit_auto = await queryMember.queryCheckDepositAuto1(req);
                    if (check_deposit_auto.result[0].deposit) {
                        deposit += check_deposit_auto.result[0].deposit;
                        responeData.data[j].deposit += check_deposit_auto.result[0].deposit;
                    }
                    let check_deposit_manual = await queryMember.queryCheckDepositManual1(req);
                    if (check_deposit_manual.result[0].deposit) {
                        deposit += check_deposit_manual.result[0].deposit;
                        responeData.data[j].deposit += check_deposit_manual.result[0].deposit;
                    }

                    let check_withdraw_auto = await queryMember.queryCheckWithdrawAuto1(req);
                    if (check_withdraw_auto.result[0].deposit) {
                        withdraw += check_withdraw_auto.result[0].deposit;
                        responeData.data[j].withdraw += check_withdraw_auto.result[0].deposit;
                    }

                    let check_withdraw_auto_1 = await queryMember.queryCheckWithdrawAuto1_1(req);
                    if (check_withdraw_auto_1.result[0].deposit) {
                        withdraw += check_withdraw_auto_1.result[0].deposit;
                        responeData.data[j].withdraw += check_withdraw_auto_1.result[0].deposit;
                    }
                    let check_withdraw_manual = await queryMember.queryCheckWithdrawManual1(req);
                    if (check_withdraw_manual.result[0].deposit) {
                        withdraw += check_withdraw_manual.result[0].deposit;
                        responeData.data[j].withdraw += check_withdraw_manual.result[0].deposit;
                    }
                }
            }
            responeData.deposit = deposit;
            responeData.username = data.result[0].username;
            responeData.withdraw = withdraw;
            responeData.total = deposit - withdraw;
            let receive = ((deposit - withdraw) * data.result[0].percent) / 100;
            responeData.receive = receive;
            responeData.statusCode = httpStatusCodes.Success.ok.code;
            responeData.statusCodeText = httpStatusCodes.Success.ok.codeText;
            res.send(responeData);
        } else {
            responeData.statusCode = httpStatusCodes.ClientErrors.unauthorized.code;
            responeData.statusCodeText = httpStatusCodes.ClientErrors.unauthorized.codeText
            responeData.description = auth.msg;
            res.send(responeData);
        }
    } catch (e) {
        responeData.statusCode = httpStatusCodes.Fail.fail.code;
        responeData.statusCodeText = httpStatusCodes.Fail.fail.codeText;
        res.send(responeData);
    }
}

module.exports.ApiaddAllianceLog = async(req, res) => {
    let responeData = {};
    res.setHeader('Content-Type', 'application/json');
    try {
        let auth = await checkAuth(req.headers.authorization);
        if (auth.status) {
            req.body.date = formatDate1(new Date()) + ' ' + formatTime(new Date());
            let data = await queryMember.insertAllianceLog(req);
            if (data.status) {
                responeData.statusCode = httpStatusCodes.Success.ok.code;
                responeData.statusCodeText = httpStatusCodes.Success.ok.codeText;
                responeData.data = data.result;
            } else {
                responeData.statusCode = httpStatusCodes.Fail.fail.code;
                responeData.statusCodeText = httpStatusCodes.Fail.fail.codeText;
                responeData.description = 'Insert Error';
            }
        } else {
            responeData.statusCode = httpStatusCodes.ClientErrors.unauthorized.code;
            responeData.statusCodeText = httpStatusCodes.ClientErrors.unauthorized.codeText
            responeData.description = auth.msg;
        }
    } catch (e) {
        responeData.statusCode = httpStatusCodes.Fail.fail.code;
        responeData.statusCodeText = httpStatusCodes.Fail.fail.codeText;
        responeData.description = 'Server Error';
    }
    res.send(responeData);
}

module.exports.ApiqueryAllianceLog = async(req, res) => {
    let responeData = {};
    res.setHeader('Content-Type', 'application/json');
    try {
        let auth = await checkAuth(req.headers.authorization);
        if (auth.status) {
            let data = await queryMember.queryAllianceLog(req);
            if (data.status && data.result.length > 0) {
                responeData.statusCode = httpStatusCodes.Success.ok.code;
                responeData.statusCodeText = httpStatusCodes.Success.ok.codeText;
                responeData.data = data.result;
            } else {
                responeData.statusCode = httpStatusCodes.Fail.fail.code;
                responeData.statusCodeText = httpStatusCodes.Fail.fail.codeText;
            }
        } else {
            responeData.statusCode = httpStatusCodes.ClientErrors.unauthorized.code;
            responeData.statusCodeText = httpStatusCodes.ClientErrors.unauthorized.codeText
            responeData.description = auth.msg;
        }
    } catch (e) {
        responeData.statusCode = httpStatusCodes.Fail.fail.code;
        responeData.statusCodeText = httpStatusCodes.Fail.fail.codeText;
    }
    res.send(responeData);
}

module.exports.ApiqueryAllianceByID = async(req, res) => {
    let responeData = {};
    res.setHeader('Content-Type', 'application/json');
    try {
        let auth = await checkAuth(req.headers.authorization);
        if (auth.status) {
            let data = await queryMember.queryAllianceByID(req);
            if (data.status && data.result.length > 0) {
                responeData.statusCode = httpStatusCodes.Success.ok.code;
                responeData.statusCodeText = httpStatusCodes.Success.ok.codeText;
                responeData.data = data.result;
            } else {
                responeData.statusCode = httpStatusCodes.Fail.fail.code;
                responeData.statusCodeText = httpStatusCodes.Fail.fail.codeText;
            }
        } else {
            responeData.statusCode = httpStatusCodes.ClientErrors.unauthorized.code;
            responeData.statusCodeText = httpStatusCodes.ClientErrors.unauthorized.codeText
            responeData.description = auth.msg;
        }
    } catch (e) {
        responeData.statusCode = httpStatusCodes.Fail.fail.code;
        responeData.statusCodeText = httpStatusCodes.Fail.fail.codeText;
    }
    res.send(responeData);
}

module.exports.ApideleteMemberAlliance = async(req, res) => {
    let responeData = {};
    res.setHeader('Content-Type', 'application/json');
    try {
        let auth = await checkAuth(req.headers.authorization);
        if (auth.status) {
            await queryMember.deleteMember(req);
            let data = await queryMember.deleteMemberAlliance(req);
            if (data.status) {
                responeData.statusCode = httpStatusCodes.Success.ok.code;
                responeData.statusCodeText = httpStatusCodes.Success.ok.codeText;
            } else {
                responeData.statusCode = httpStatusCodes.Fail.fail.code;
                responeData.statusCodeText = httpStatusCodes.Fail.fail.codeText;
            }
        } else {
            responeData.statusCode = httpStatusCodes.ClientErrors.unauthorized.code;
            responeData.statusCodeText = httpStatusCodes.ClientErrors.unauthorized.codeText
            responeData.description = auth.msg;
        }
    } catch (e) {
        responeData.statusCode = httpStatusCodes.Fail.fail.code;
        responeData.statusCodeText = httpStatusCodes.Fail.fail.codeText;
    }
    res.send(responeData);
}

module.exports.ApiupdateMemberAlliance = async(req, res) => {
    let responeData = {};
    res.setHeader('Content-Type', 'application/json');
    try {
        let auth = await checkAuth(req.headers.authorization);
        if (auth.status) {
            let data = await queryMember.updateAllianceMember(req);
            if (data.status) {
                let token = await parseJwt(auth.txt);
                responeData.statusCode = httpStatusCodes.Success.ok.code;
                responeData.statusCodeText = httpStatusCodes.Success.ok.codeText;
            } else {
                responeData.statusCode = httpStatusCodes.Fail.fail.code;
                responeData.statusCodeText = httpStatusCodes.Fail.fail.codeText;
            }
        } else {
            responeData.statusCode = httpStatusCodes.ClientErrors.unauthorized.code;
            responeData.statusCodeText = httpStatusCodes.ClientErrors.unauthorized.codeText
            responeData.description = auth.msg;
        }
    } catch (e) {
        responeData.statusCode = httpStatusCodes.Fail.fail.code;
        responeData.statusCodeText = httpStatusCodes.Fail.fail.codeText;
    }
    res.send(responeData);
}



module.exports.ApiqueryTurnover = async(req, res) => {
    let responeData = {};
    res.setHeader('Content-Type', 'application/json');
    try {
        let auth = await checkAuth(req.headers.authorization);
        if (auth.status) {
            let data = await queryMember.queryTurnover(req);
            if (data.status && data.result.length > 0) {
                responeData.statusCode = httpStatusCodes.Success.ok.code;
                responeData.statusCodeText = httpStatusCodes.Success.ok.codeText;
                responeData.data = data.result;
                let total = 0;
                for (let i = 0; i < data.result.length; i++) {
                    total += parseFloat(data.result[i].turnover);
                }
                responeData.turnover = total;
            } else {
                responeData.statusCode = httpStatusCodes.Fail.fail.code;
                responeData.statusCodeText = httpStatusCodes.Fail.fail.codeText;
                responeData.turnover = 0;
            }
        } else {
            responeData.statusCode = httpStatusCodes.ClientErrors.unauthorized.code;
            responeData.statusCodeText = httpStatusCodes.ClientErrors.unauthorized.codeText
            responeData.description = auth.msg;
        }
    } catch (e) {
        responeData.statusCode = httpStatusCodes.Fail.fail.code;
        responeData.statusCodeText = httpStatusCodes.Fail.fail.codeText;
    }
    res.send(responeData);
}






















 




 
module.exports.testSCB = async(req, res) => {
    res.setHeader('Content-Type', 'application/json');
    SCBLogin().then(token => {
        console.log(token);
    })
}

async function SCBLogin() {
    var options = {
        'method': 'POST',
        'url': 'https://fasteasy.scbeasy.com:8443/v3/login/preloadandresumecheck',
        'headers': {
            'Accept-Language': 'th',
            'scb-channel': 'APP',
            'user-agent': 'Android/11;FastEasy/3.53.0/5618',
            'Content-Type': 'application/json; charset=UTF-8',
            'Hos': 'fasteasy.scbeasy.com:8443',
            'Connection': 'close',
        },
        body: '{"deviceId": "3273e64b-b329-42f4-9427-f6b176db8d04" ,"jailbreak": "0","tilesVersion": "39","userMode": "INDIVIDUAL"}'

    };

    request(options, async function(error, response) {
        if (error) throw new Error(error);

        let result = await JSON.parse(response.body);
        if (result.status.code == 1000) {
            let auth = response.headers['api-auth'];
            var options = {
                'method': 'POST',
                'url': 'https://fasteasy.scbeasy.com/isprint/soap/preAuth',
                'headers': {
                    'Api-Auth': auth,
                    'Content-Type': 'application/json',
                    // 'Cookie': 'f5avraaaaaaaaaaaaaaaa_session_=CPMDKGABHOENIMIPAPFKIMCMNHOIEDLHJPKPMNFBNKFAPPHANPFPNBBKHEMHHCHLOBODLBGCKCEFHLDNFBEACLBAGDMBNHKGIBPEPEFMOKMNKDACEFACGCMOGIFOLNEE'
                },
                body: JSON.stringify({
                    "loginModuleId": "PseudoFE"
                })

            };
            request(options, async function(error, response) {
                if (error) throw new Error(error);
                let result = await JSON.parse(response.body);
                if (result.status.statusdesc == 'success') {
                    let hashType = result.e2ee.pseudoOaepHashAlgo;
                    let Sid = result.e2ee.pseudoSid;
                    let ServerRandom = result.e2ee.pseudoRandom;
                    let pubKey = result.e2ee.pseudoPubKey;

                    var options = {
                        'method': 'POST',
                        'url': 'https://scb.mskids.me/pin/encrypt',
                        'headers': {
                            'Content-Type': 'application/x-www-form-urlencoded'
                        },
                        form: {
                            'Sid': Sid,
                            'ServerRandom': ServerRandom,
                            'pubKey': pubKey,
                            'pin': '125000',
                            'hashType': hashType
                        }
                    };
                    request(options, async function(error, response) {
                        if (error) throw new Error(error);
                        let pseudoPin = response.body;
                        var options = {
                            'method': 'POST',
                            'url': 'https://fasteasy.scbeasy.com/v1/fasteasy-login?&=&=&=',
                            'headers': {
                                'Api-Auth': auth,
                                'user-agent': 'Android/11;FastEasy/3.53.0/5618',
                                'Host': 'fasteasy.scbeasy.com',
                                'Content-Type': 'application/json'
                            },
                            body: JSON.stringify({
                                "deviceId": "3273e64b-b329-42f4-9427-f6b176db8d04",
                                "pseudoPin": pseudoPin,
                                "pseudoSid": Sid
                            })

                        };
                        request(options, async function(error, response) {
                            if (error) throw new Error(error);
                            let result = await JSON.parse(response.body);
                            return response.headers['api-auth'];
                        });
                    });

                }
            });
        }
    });
}