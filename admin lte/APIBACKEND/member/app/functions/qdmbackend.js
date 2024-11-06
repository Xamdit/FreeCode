const model = require('../models/utility.model');
const httpCode = require('../../constants/httpStatusCodes');

module.exports.deleteWhiteListInDatabase = async(req) => {
    const sql = "DELETE FROM azael_dc_whitelisted WHERE identifier = '" + req.body.steamHex + "'"
    try {
        const result = await model.queryOne(sql)
        return { status: true, statusCode: httpCode.Success.ok.codeText, result: result };
    } catch (error) {
        console.log('deleteWhiteListInDatabase have error :', error);
    }
}










module.exports.queryDataLogin = async(req) => {
    const sql = `SELECT * FROM admin WHERE username = '${req.body.username}'`
    try {
        const result = await model.queryOne(sql)
        return { status: true, statusCode: httpCode.Success.ok.codeText, result: result };
    } catch (error) {
        console.log('queryDataLogin have error :', error);
    }
}

module.exports.insertTokenTodatabase = async(req) => {
    const sql = "INSERT INTO log_token (id,token,ip_address) VALUES (null, '" + req.token + "','" + req.ip + "')"
    try {
        const result = await model.insertOne(sql)
        return { status: true, statusCode: httpCode.Success.ok.codeText, result: result };
    } catch (error) {
        console.log('insertData have error :', error);
    }
}

//######################################## NAV BAR //########################################

module.exports.count_withdraw = async() => {
    const sql = "SELECT count(*) AS count FROM `member` INNER JOIN `transaction` on member.username = transaction.member_username LEFT JOIN bank on bank.bank_id = member.bank WHERE transaction.stats = 1";
    try {
        const result = await model.queryOne(sql)
        return { status: true, statusCode: httpCode.Success.ok.codeText, result: result };
    } catch (error) {
        console.log('count_withdraw have error :', error);
    }
}

module.exports.withdraw_managelast = async() => {
    const sql = "SELECT *,transaction.id as tid FROM `member` INNER JOIN `transaction` on member.username = transaction.member_username LEFT JOIN bank on bank.bank_id = member.bank WHERE transaction.stats = 1 and transaction.type = 0 limit 5";
    try {
        const result = await model.queryOne(sql)
        return { status: true, statusCode: httpCode.Success.ok.codeText, result: result };
    } catch (error) {
        console.log('withdraw_managelast have error :', error);
    }
}

module.exports.deleteLogToken = async(id) => {
    const sql = "DELETE FROM log_token WHERE id = " + id
    try {
        const result = await model.queryOne(sql)
        return { status: true, statusCode: httpCode.Success.ok.codeText, result: result };
    } catch (error) {
        console.log('deleteLogToken have error :', error);
    }
}




//######################################## NAV BAR //########################################




//######################################## DASHBOARD ########################################

module.exports.queryLogToken = async(token) => {
    const sql = "SELECT * FROM log_token WHERE token = '" + token + "'"
    try {
        const result = await model.queryOne(sql)
        return { status: true, statusCode: httpCode.Success.ok.codeText, result: result };
    } catch (error) {
        console.log('queryLogToken have error :', error);
    }
}

module.exports.queryTransactionDepositAll = async() => {
    const sql = "SELECT SUM(amount) AS deposit FROM transaction WHERE type = 1 AND stats = 0"
    try {
        const result = await model.queryOne(sql)
        return { status: true, statusCode: httpCode.Success.ok.codeText, result: result };
    } catch (error) {
        console.log('queryTransactionDepositAll have error :', error);
    }
}

module.exports.queryTransactionManualDepositAll = async() => {
    const sql = "SELECT SUM(credit) AS deposit FROM transaction_manual WHERE module = 'Deposit'"
    try {
        const result = await model.queryOne(sql)
        return { status: true, statusCode: httpCode.Success.ok.codeText, result: result };
    } catch (error) {
        console.log('queryTransactionManualDepositAll have error :', error);
    }
}

module.exports.queryTransactionWithdrawAll = async() => {
    const sql = "SELECT SUM(amount) AS withdraw FROM transaction WHERE type = 0 AND stats = 0 OR stats = 3"
    try {
        const result = await model.queryOne(sql)
        return { status: true, statusCode: httpCode.Success.ok.codeText, result: result };
    } catch (error) {
        console.log('queryLogToken have error :', error);
    }
}

module.exports.queryTransactionManualWithdrawAll = async() => {
    const sql = "SELECT SUM(credit) AS withdraw FROM transaction_manual WHERE module = 'Withdraw'"
    try {
        const result = await model.queryOne(sql)
        return { status: true, statusCode: httpCode.Success.ok.codeText, result: result };
    } catch (error) {
        console.log('queryLogToken have error :', error);
    }
}

module.exports.querySettingSystem = async() => {
    const sql = "SELECT * FROM seting"
    try {
        const result = await model.queryOne(sql)
        return { status: true, statusCode: httpCode.Success.ok.codeText, result: result };
    } catch (error) {
        console.log('querySettingSystem have error :', error);
    }
}

module.exports.updatePasswordAdmin = async(req) => {
    const sql = `UPDATE admin SET password = '${req.newpass}' WHERE id =${req.id}`;
    try {
        const result = await model.insertOne(sql)
        return { status: true, statusCode: httpCode.Success.ok.codeText, result: result };
    } catch (error) {
        console.log('updateGeneralSetting have error :', error);
    }
}

module.exports.updateDeviceScb = async(req) => {
    const sql = `UPDATE account_bank SET username = '${req.deviceId}',password = '${req.acc_pin}',name = '${req.acc_name}',accnum = '${req.acc_num}' WHERE id =1`;
    try {
        const result = await model.insertOne(sql)
        return { status: true, statusCode: httpCode.Success.ok.codeText, result: result };
    } catch (error) {
        console.log('updateGeneralSetting have error :', error);
    }
}

module.exports.updateUfaAcc = async(req) => {
    const sql = `UPDATE seting SET acc_ufa = '${req.acc_ufa}',ufa_pass = '${req.ufa_pass}' WHERE id =1`;
    try {
        const result = await model.insertOne(sql)
        return { status: true, statusCode: httpCode.Success.ok.codeText, result: result };
    } catch (error) {
        console.log('updateGeneralSetting have error :', error);
    }
}


module.exports.querySettingSystemAuto = async() => {
    const sql = "SELECT * FROM setting_auto_withdraw"
    try {
        const result = await model.queryOne(sql)
        return { status: true, statusCode: httpCode.Success.ok.codeText, result: result };
    } catch (error) {
        console.log('querySettingSystemAuto have error :', error);
    }
}

module.exports.updateGeneralSetting = async(req) => {
    const sql = "UPDATE seting SET line = '" + req.body.line + "', name_web = '" + req.body.name_web + "', d_limit = " + req.body.d_limit + ", w_limit = " + req.body.w_limit + ", aff_d = " + req.body.aff_d + ", aff_m = " + req.body.aff_m + " WHERE id = 1";
    try {
        const result = await model.insertOne(sql)
        return { status: true, statusCode: httpCode.Success.ok.codeText, result: result };
    } catch (error) {
        console.log('updateGeneralSetting have error :', error);
    }
}

module.exports.updateAutoSetting = async(req) => {
    const sql = "UPDATE setting_auto_withdraw SET credit_min = " + req.body.credit_min + ", credit_max = " + req.body.credit_max + ", credit_limit = " + req.body.credit_limit + ", status = " + req.body.status + " WHERE id = 1";
    try {
        const result = await model.insertOne(sql)
        return { status: true, statusCode: httpCode.Success.ok.codeText, result: result };
    } catch (error) {
        console.log('updateAutoSetting have error :', error);
    }
}

module.exports.updateNotifySetting = async(req) => {
    const sql = "UPDATE seting SET token_line = '" + req.body.token_line + "', token_line_game = '" + req.body.token_line_game + "', token_line_depo = '" + req.body.token_line_depo + "', token_line_with = '" + req.body.token_line_with + "' WHERE id = 1";
    try {
        const result = await model.insertOne(sql)
        return { status: true, statusCode: httpCode.Success.ok.codeText, result: result };
    } catch (error) {
        console.log('updateNotifySetting have error :', error);
    }
}


//######################################## DASHBOARD ########################################



//######################################## MEMBER ########################################

module.exports.queryAllMember = async() => {
    const sql = "SELECT *,member.id FROM `member` LEFT JOIN bank on bank.bank_id = member.bank ORDER BY member.id DESC"
    try {
        const result = await model.queryOne(sql)
        return { status: true, statusCode: httpCode.Success.ok.codeText, result: result };
    } catch (error) {
        console.log('queryAllMember have error :', error);
    }
}

module.exports.queryAllMemberUFA = async() => {
    const sql = "SELECT * FROM ufa_acc"
    try {
        const result = await model.queryOne(sql)
        return { status: true, statusCode: httpCode.Success.ok.codeText, result: result };
    } catch (error) {
        console.log('queryAllMemberUFA have error :', error);
    }
}


module.exports.deleteMember = async(req) => {
    const sql = "DELETE FROM member WHERE id = " + req.body.id
    try {
        const result = await model.insertOne(sql)
        return { status: true, statusCode: httpCode.Success.ok.codeText, result: result };
    } catch (error) {
        console.log('deleteMember have error :', error);
    }
}

module.exports.deleteMemberUFA = async(req) => {
    const sql = "DELETE FROM ufa_acc WHERE member_username = '" + req.body.username + "'"
    try {
        const result = await model.insertOne(sql)
        return { status: true, statusCode: httpCode.Success.ok.codeText, result: result };
    } catch (error) {
        console.log('deleteMemberUFA have error :', error);
    }
}

module.exports.queryMember = async(req) => {
    const sql = "SELECT * FROM member WHERE id = " + req.body.id
    try {
        const result = await model.queryOne(sql)
        return { status: true, statusCode: httpCode.Success.ok.codeText, result: result };
    } catch (error) {
        console.log('queryMember have error :', error);
    }
}

module.exports.queryMemberCheck = async(req) => {
    const sql = "SELECT * FROM member WHERE name = '" + req.body.name + "' OR username = '" + req.body.username + "'"
    try {
        const result = await model.queryOne(sql)
        return { status: true, statusCode: httpCode.Success.ok.codeText, result: result };
    } catch (error) {
        console.log('queryMemberCheck have error :', error);
    }
}

module.exports.queryBank = async(req) => {
    const sql = "SELECT * FROM bank";
    try {
        const result = await model.queryOne(sql)
        return { status: true, statusCode: httpCode.Success.ok.codeText, result: result };
    } catch (error) {
        console.log('queryBank have error :', error);
    }
}


module.exports.updateMember = async(req) => {
    const sql = "UPDATE member SET username = '" + req.body.username + "', password = '" + req.body.password + "', name = '" + req.body.name + "', accnum = '" + req.body.accnum + "', bank = '" + req.body.bank + "' WHERE id = " + req.body.id;
    try {
        const result = await model.insertOne(sql)
        return { status: true, statusCode: httpCode.Success.ok.codeText, result: result };
    } catch (error) {
        console.log('updateMember have error :', error);
    }
}

module.exports.updatePlayPowyingshup = async(req) => {
    const sql = "UPDATE member SET powyingshup = '" + req.body.total + "' WHERE id = '" + req.body.id + "'";
    try {
        const result = await model.insertOne(sql)
        return { status: true, statusCode: httpCode.Success.ok.codeText, result: result };
    } catch (error) {
        console.log('updatePlayPowyingshup have error :', error);
    }
}
module.exports.queryTurnoverMember = async(req) => {
    const sql = "SELECT * FROM history_turnover WHERE username = '" + req.body.username + "'"
    try {
        const result = await model.queryOne(sql)
        return { status: true, statusCode: httpCode.Success.ok.codeText, result: result };
    } catch (error) {
        console.log('queryTurnoverMember have error :', error);
    }
}

//######################################## MEMBER ########################################



//######################################## PROMOTION ########################################
module.exports.queryPromotion = async() => {
    const sql = "SELECT * FROM promotion "
    try {
        const result = await model.queryOne(sql)
        return { status: true, statusCode: httpCode.Success.ok.codeText, result: result };
    } catch (error) {
        console.log('queryPromotion have error :', error);
    }
}

module.exports.updatePromotion = async(req) => {
    const sql = "UPDATE promotion SET img_name = '" + req.body.url_img + "', name =  '" + req.body.name + "', percen = " + req.body.percen + ", x = " + req.body.x + ", limit_d = " + req.body.limit + ", text = '" + req.body.text + "', turn = " + req.body.turn + ", stats = " + req.body.stats + " WHERE id = " + req.body.id_pro;
    try {
        const result = await model.insertOne(sql)
        return { status: true, statusCode: httpCode.Success.ok.codeText, result: result };
    } catch (error) {
        console.log('updatePromotion have error :', error);
    }
}

module.exports.queryPromotionHistory = async() => {
    const sql = "SELECT *,promotion.id FROM `promotion` INNER JOIN pro_log on pro_log.pro_id = promotion.id ORDER BY promotion.id DESC"
    try {
        const result = await model.queryOne(sql)
        return { status: true, statusCode: httpCode.Success.ok.codeText, result: result };
    } catch (error) {
        console.log('queryPromotionHistory have error :', error);
    }
}

module.exports.queryDepositHistory = async() => {
    const sql = "SELECT *,transaction.id as tid FROM `member` INNER JOIN `transaction` on member.username = transaction.member_username LEFT JOIN bank on bank.bank_id = member.bank WHERE   transaction.type = 1 and transaction.stats = 0 ORDER BY transaction.id DESC"
    try {
        const result = await model.queryOne(sql)
        return { status: true, statusCode: httpCode.Success.ok.codeText, result: result };
    } catch (error) {
        console.log('queryDepositHistory have error :', error);
    }
}

//######################################## PROMOTION ########################################






//######################################## DEPOSIT HISTORY ########################################

module.exports.queryDepositHistory = async() => {
    const sql = "SELECT *,transaction.id as tid FROM `member` INNER JOIN `transaction` on member.username = transaction.member_username LEFT JOIN bank on bank.bank_id = member.bank WHERE   transaction.type = 1 and transaction.stats = 0 ORDER BY transaction.id DESC"
    try {
        const result = await model.queryOne(sql)
        return { status: true, statusCode: httpCode.Success.ok.codeText, result: result };
    } catch (error) {
        console.log('queryDepositHistory have error :', error);
    }
}

//######################################## DEPOSIT HISTORY ########################################




//######################################## WITHDRAW HISTORY ########################################

module.exports.queryWithdrawHistory = async() => {
    const sql = "SELECT *,transaction.id as tid FROM `member` INNER JOIN `transaction` on member.username = transaction.member_username LEFT JOIN bank on bank.bank_id = member.bank  WHERE transaction.stats = 1 and transaction.type = 0"
    try {
        const result = await model.queryOne(sql)
        return { status: true, statusCode: httpCode.Success.ok.codeText, result: result };
    } catch (error) {
        console.log('queryWithdrawHistory have error :', error);
    }
}

//######################################## WITHDRAW HISTORY ########################################






//######################################## WITHDRAW ########################################

module.exports.queryWithdrawUser = async(req) => {
    const sql = "SELECT *,transaction.id as tid, ufa_acc.username as usernameUFA FROM `member` INNER JOIN `transaction` on member.username = transaction.member_username LEFT JOIN bank on bank.bank_id = member.bank LEFT JOIN ufa_acc on ufa_acc.member_username = member.username WHERE transaction.id = " + req.body.id
    try {
        const result = await model.queryOne(sql)
        return { status: true, statusCode: httpCode.Success.ok.codeText, result: result };
    } catch (error) {
        console.log('queryWithdrawUser have error :', error);
    }
}

module.exports.updateStatusWithdraw = async(req) => {
    const sql = "UPDATE transaction SET stats = 0 WHERE id = " + req.body.id;
    try {
        const result = await model.insertOne(sql)
        return { status: true, statusCode: httpCode.Success.ok.codeText, result: result };
    } catch (error) {
        console.log('updateStatusWithdraw have error :', error);
    }
}

module.exports.updateUnStatusWithdraw = async(req) => {
    const sql = "UPDATE transaction SET stats = 2 WHERE id = " + req.body.id;
    try {
        const result = await model.insertOne(sql)
        return { status: true, statusCode: httpCode.Success.ok.codeText, result: result };
    } catch (error) {
        console.log('updateUnStatusWithdraw have error :', error);
    }
}

module.exports.queryWithdrawSuccess = async() => {
    const sql = "SELECT *,transaction.id as tid FROM `member` INNER JOIN `transaction` on member.username = transaction.member_username LEFT JOIN bank on bank.bank_id = member.bank WHERE   transaction.type = 0 and transaction.stats = 0 ORDER BY transaction.id DESC"
    try {
        const result = await model.queryOne(sql)
        return { status: true, statusCode: httpCode.Success.ok.codeText, result: result };
    } catch (error) {
        console.log('queryWithdrawSuccess have error :', error);
    }
}

module.exports.queryWithdrawUnSuccess = async() => {
    const sql = "SELECT *,transaction.id as tid FROM `member` INNER JOIN `transaction` on member.username = transaction.member_username LEFT JOIN bank on bank.bank_id = member.bank WHERE   transaction.type = 0 and transaction.stats = 2 ORDER BY transaction.id DESC"
    try {
        const result = await model.queryOne(sql)
        return { status: true, statusCode: httpCode.Success.ok.codeText, result: result };
    } catch (error) {
        console.log('queryWithdrawUnSuccess have error :', error);
    }
}

module.exports.queryCheckBankSCBDetail = async(req) => {
    const sql = "SELECT * FROM account_bank"
    try {
        const result = await model.queryOne(sql)
        return { status: true, statusCode: httpCode.Success.ok.codeText, result: result };
    } catch (error) {
        console.log('queryCheckBankSCBDetail have error :', error);
    }
}

//######################################## WITHDRAW ########################################


//######################################## RESULT ########################################
module.exports.queryResults = async(req) => {
    const sql = "SELECT SUM(amount) as amount FROM `transaction` WHERE type = " + req.body.type + " and date BETWEEN '" + req.body.date_start + "' and '" + req.body.date_end + "' and stats = 0"
    try {
        const result = await model.queryOne(sql)
        return { status: true, statusCode: httpCode.Success.ok.codeText, result: result };
    } catch (error) {
        console.log('queryResults have error :', error);
    }
}

module.exports.queryResultsManual = async(req) => {
    const sql = "SELECT SUM(credit) as amount FROM `transaction_manual` WHERE module = '" + req.body.type + "' and date BETWEEN '" + req.body.date_start + "' and '" + req.body.date_end + "'"
    try {
        const result = await model.queryOne(sql)
        return { status: true, statusCode: httpCode.Success.ok.codeText, result: result };
    } catch (error) {
        console.log('queryResults have error :', error);
    }
}

module.exports.queryResultsMonth = async(req) => {
    const sql = "SELECT SUM(amount) as amount FROM `transaction` WHERE type = " + req.body.type + " and date LIKE '" + req.body.date + "%' and stats = 0"
    try {
        const result = await model.queryOne(sql)
        return { status: true, statusCode: httpCode.Success.ok.codeText, result: result };
    } catch (error) {
        console.log('queryResultsMonth have error :', error);
    }
}

module.exports.queryResultsManualMonth = async(req) => {
    const sql = "SELECT SUM(credit) as amount FROM `transaction_manual` WHERE module = '" + req.body.type + "' and date LIKE '" + req.body.date + "%'"
    try {
        const result = await model.queryOne(sql)
        return { status: true, statusCode: httpCode.Success.ok.codeText, result: result };
    } catch (error) {
        console.log('queryResultsMonth have error :', error);
    }
}

module.exports.queryLastDeposit = async() => {
    const sql = "SELECT * FROM `transaction` WHERE type = 1 AND stats = 0 ORDER BY id DESC limit 5"
    try {
        const result = await model.queryOne(sql)
        return { status: true, statusCode: httpCode.Success.ok.codeText, result: result };
    } catch (error) {
        console.log('queryLastDeposit have error :', error);
    }
}

module.exports.queryTopDeposit = async() => {
    const sql = "SELECT member_username,SUM(amount) as amount FROM `transaction` WHERE `type` = 1 GROUP BY member_username ORDER BY `amount` DESC LIMIT 5"
    try {
        const result = await model.queryOne(sql)
        return { status: true, statusCode: httpCode.Success.ok.codeText, result: result };
    } catch (error) {
        console.log('queryTopDeposit have error :', error);
    }
}

module.exports.queryTopWithdraw = async() => {
    const sql = "SELECT member_username,SUM(amount) as amount FROM `transaction` WHERE `type` = 0 and stats = 0 GROUP BY member_username ORDER BY `amount` DESC limit 5"
    try {
        const result = await model.queryOne(sql)
        return { status: true, statusCode: httpCode.Success.ok.codeText, result: result };
    } catch (error) {
        console.log('queryTopWithdraw have error :', error);
    }
}


//######################################## RESULT ########################################




//######################################## REPORT WITHDRAW ########################################


module.exports.queryReportWithdraw = async(req) => {
    const sql = "SELECT *,transaction.id as tid FROM `member` INNER JOIN `transaction` on member.username = transaction.member_username INNER JOIN bank on bank.bank_id = member.bank WHERE transaction.type = 0 and transaction.stats = 0 AND `date` BETWEEN '" + req.body.start_date + "' AND '" + req.body.end_date + "'"
    try {
        const result = await model.queryOne(sql)
        return { status: true, statusCode: httpCode.Success.ok.codeText, result: result };
    } catch (error) {
        console.log('queryReportWithdraw have error :', error);
    }
}

module.exports.queryReportWithdrawAuto = async(req) => {
    const sql = "SELECT * FROM `auto_withdraw` WHERE `date` BETWEEN '" + req.body.start_date + "' AND '" + req.body.end_date + "'"
    try {
        const result = await model.queryOne(sql)
        return { status: true, statusCode: httpCode.Success.ok.codeText, result: result };
    } catch (error) {
        console.log('queryReportWithdrawAuto have error :', error);
    }
}

//######################################## REPORT WITHDRAW ########################################


//######################################## REPORT DEPOSIT ########################################
module.exports.queryReportDeposit = async(req) => {
        const sql = "SELECT *,transaction.id as tid FROM `member` INNER JOIN `transaction` on member.username = transaction.member_username INNER JOIN bank on bank.bank_id = member.bank WHERE transaction.type = 1 and transaction.stats = 0 AND `date` BETWEEN '" + req.body.start_date + "' AND '" + req.body.end_date + "'"
        try {
            const result = await model.queryOne(sql)
            return { status: true, statusCode: httpCode.Success.ok.codeText, result: result };
        } catch (error) {
            console.log('queryReportDeposit have error :', error);
        }
    }
    //######################################## REPORT DEPOSIT ########################################


//######################################## REPORT FINANCE ########################################

module.exports.queryDepositSummary = async(start, end) => {
    const sql = "SELECT SUM(amount) AS total FROM `member`  INNER JOIN `transaction` on member.username = transaction.member_username INNER JOIN bank on bank.bank_id = member.bank WHERE transaction.type = 1 and transaction.stats = 0 AND `date` BETWEEN '" + start + "' AND '" + end + "'"
    try {
        const result = await model.queryOne(sql)
        return { status: true, statusCode: httpCode.Success.ok.codeText, result: result };
    } catch (error) {
        console.log('queryDepositSummary have error :', error);
    }
}

module.exports.queryDepositManualSummary = async(start, end) => {
    const sql = "SELECT SUM(credit) AS total FROM `transaction_manual` WHERE transaction_manual.module = 'Deposit' AND `date` BETWEEN '" + start + "' AND '" + end + "'"
    try {
        const result = await model.queryOne(sql)
        return { status: true, statusCode: httpCode.Success.ok.codeText, result: result };
    } catch (error) {
        console.log('queryDepositManualSummary have error :', error);
    }
}

module.exports.queryWithdrawSummary = async(start, end) => {
    const sql = "SELECT SUM(amount) AS total FROM `member`  INNER JOIN `transaction` on member.username = transaction.member_username INNER JOIN bank on bank.bank_id = member.bank WHERE transaction.type = 0 and transaction.stats = 0 AND `date` BETWEEN '" + start + "' AND '" + end + "'"
    try {
        const result = await model.queryOne(sql)
        return { status: true, statusCode: httpCode.Success.ok.codeText, result: result };
    } catch (error) {
        console.log('queryWithdrawSummary have error :', error);
    }
}

module.exports.queryWithdrawManualSummary = async(start, end) => {
        const sql = "SELECT SUM(credit) AS total FROM `transaction_manual` WHERE transaction_manual.module = 'Withdraw' AND `date` BETWEEN '" + start + "' AND '" + end + "'"
        try {
            const result = await model.queryOne(sql)
            return { status: true, statusCode: httpCode.Success.ok.codeText, result: result };
        } catch (error) {
            console.log('querWithdrawManualSummary have error :', error);
        }
    }
    //######################################## REPORT FINANCE ########################################





//######################################## REPORT TRANSACTION MANUAL ########################################

module.exports.queryTransactionManual = async(req) => {
    const sql = "SELECT * FROM transaction_manual WHERE `date` BETWEEN '" + req.body.start_date + "' AND '" + req.body.end_date + "'"
    try {
        const result = await model.queryOne(sql)
        return { status: true, statusCode: httpCode.Success.ok.codeText, result: result };
    } catch (error) {
        console.log('queryTransactionManual have error :', error);
    }
}

//######################################## REPORT TRANSACTION MANUAL ########################################





//######################################## STAFF ########################################
module.exports.queryAllStaffByID = async(req) => {
    const sql = "SELECT * FROM admin  WHERE id = " + req.body.id
    try {
        const result = await model.queryOne(sql)
        return { status: true, statusCode: httpCode.Success.ok.codeText, result: result };
    } catch (error) {
        console.log('queryAllStaffByID have error :', error);
    }
}

module.exports.queryAllStaff = async() => {
    const sql = "SELECT * FROM admin  WHERE stats = 0"
    try {
        const result = await model.queryOne(sql)
        return { status: true, statusCode: httpCode.Success.ok.codeText, result: result };
    } catch (error) {
        console.log('queryAllStaff have error :', error);
    }
}

module.exports.insertStaff = async(req) => {
    const sql = "INSERT INTO admin (id,username,password,stats,category,secert_code) VALUES (null, '" + req.body.username + "','" + req.body.password + "',0,'" + req.body.category + "','')"
    try {
        const result = await model.insertOne(sql)
        return { status: true, statusCode: httpCode.Success.ok.codeText, result: result };
    } catch (error) {
        console.log('insertStaff have error :', error);
    }
}


module.exports.deleteStaff = async(req) => {
    const sql = "DELETE FROM admin WHERE id = " + req.body.id
    try {
        const result = await model.insertOne(sql)
        return { status: true, statusCode: httpCode.Success.ok.codeText, result: result };
    } catch (error) {
        console.log('deleteStaff have error :', error);
    }
}

module.exports.updateStaff = async(req) => {
        const sql = "UPDATE admin SET username = '" + req.body.username + "', password = '" + req.body.password + "', category = '" + req.body.category + "'  WHERE id = " + req.body.id;
        try {
            const result = await model.insertOne(sql)
            return { status: true, statusCode: httpCode.Success.ok.codeText, result: result };
        } catch (error) {
            console.log('updateStaff have error :', error);
        }
    }
    //######################################## STAFF ########################################






//######################################## STAFF HISTORY ########################################
module.exports.queryStaffHistory = async() => {
        const sql = "SELECT * FROM staff_history ORDER BY id DESC"
        try {
            const result = await model.queryOne(sql)
            return { status: true, statusCode: httpCode.Success.ok.codeText, result: result };
        } catch (error) {
            console.log('queryStaffHistory have error :', error);
        }
    }
    //######################################## STAFF HISTORY ########################################



//######################################## SETTING WHEEL HISTORY ########################################
module.exports.querySettingWheel = async() => {
    const sql = "SELECT * FROM setting_wheel"
    try {
        const result = await model.queryOne(sql)
        return { status: true, statusCode: httpCode.Success.ok.codeText, result: result };
    } catch (error) {
        console.log('querySettingWheel have error :', error);
    }
}

module.exports.updateSetting_w = async(req) => {
    const sql = "UPDATE setting_wheel SET offset_text = " + req.body.offset_text + ", text_color = '" + req.body.text_color + "', text_size = " + req.body.text_size + ", text_type = '" + req.body.text_type + "', line_color = '" + req.body.line_color + "', inner_color = '" + req.body.inner_color + "', outer_color = '" + req.body.outer_color + "', center_color = '" + req.body.center_color + "', center_img = '" + req.body.center_img + "', lowcredit = '" + req.body.lowcredit + "', status = " + req.body.status + " WHERE id = 1";
    try {
        const result = await model.insertOne(sql)
        return { status: true, statusCode: httpCode.Success.ok.codeText, result: result };
    } catch (error) {
        console.log('updateSetting_w have error :', error);
    }
}

module.exports.updateSettingWheel = async(req) => {
        const sql = "UPDATE setting_wheel SET description = '" + req.description + "', value = '" + req.value + "', color = '" + req.color + "'  WHERE id = " + req.tid;
        try {
            const result = await model.insertOne(sql)
            return { status: true, statusCode: httpCode.Success.ok.codeText, result: result };
        } catch (error) {
            console.log('updateSettingWheel have error :', error);
        }
    }
    //######################################## SETTING WHEEL HISTORY ########################################



//######################################## REPORT WHEEL ########################################


module.exports.queryWheelReport = async(req) => {
    const sql = "SELECT * ,wheel.id as wid FROM `wheel` WHERE  `create_date` BETWEEN '" + req.body.start_date + "' AND '" + req.body.end_date + "'"
    try {
        const result = await model.queryOne(sql)
        return { status: true, statusCode: httpCode.Success.ok.codeText, result: result };
    } catch (error) {
        console.log('queryWheelReport have error :', error);
    }
}


//######################################## REPORT WHEEL ########################################


//######################################## SETTING POWYINGSHUP ########################################


module.exports.querySettingPowYingShup = async(req) => {
    const sql = "SELECT * FROM setting_powyingshup"
    try {
        const result = await model.queryOne(sql)
        return { status: true, statusCode: httpCode.Success.ok.codeText, result: result };
    } catch (error) {
        console.log('querySettingPowYingShup have error :', error);
    }
}

module.exports.updatePowYingShup = async(req) => {
    const sql = "UPDATE setting_powyingshup SET credit_low = " + req.body.credit_low + ", credit_high = " + req.body.credit_high + ", credit_prize = " + req.body.credit_prize + ", round = " + req.body.round + ", deposit = " + req.body.deposit + ", play = " + req.body.play + ", day = " + req.body.day + ", status = " + req.body.status + " WHERE id = 1";
    try {
        const result = await model.insertOne(sql)
        return { status: true, statusCode: httpCode.Success.ok.codeText, result: result };
    } catch (error) {
        console.log('updatePowYingShup have error :', error);
    }
}

//######################################## SETTING POWYINGSHUP ########################################



//######################################## REPORT POWYINGSHUP ########################################
module.exports.queryPowYingShupReport = async(req) => {
        const sql = "SELECT * ,powyingshup_log.id as wid FROM `powyingshup_log` WHERE  `date` BETWEEN '" + req.body.start_date + "' AND '" + req.body.end_date + "'"
        try {
            const result = await model.queryOne(sql)
            return { status: true, statusCode: httpCode.Success.ok.codeText, result: result };
        } catch (error) {
            console.log('queryPowYingShupReport have error :', error);
        }
    }
    //######################################## REPORT POWYINGSHUP ########################################






//######################################## ALLIANCE ########################################
module.exports.insertAlliance = async(req) => {
    const sql = "INSERT INTO alliance (id,username,name,accnum,bank_name,percent,code,stats,date) VALUES (null, '" + req.body.username + "','" + req.body.name + "','" + req.body.accnum + "','" + req.body.bankname + "'," + req.body.percent + ",'" + req.body.code + "',1, '" + req.body.date + "')";
    try {
        const result = await model.insertOne(sql)
        return { status: true, statusCode: httpCode.Success.ok.codeText, result: result };
    } catch (error) {
        console.log('insertAlliance have error :', error);
    }
}

module.exports.queryAlliance = async(req) => {
    const sql = "SELECT *, alliance.id AS aid, alliance.code AS code FROM alliance LEFT JOIN bank ON  bank.bank_id = alliance.bank_name";
    try {
        const result = await model.queryOne(sql)
        return { status: true, statusCode: httpCode.Success.ok.codeText, result: result };
    } catch (error) {
        console.log('queryAlliance have error :', error);
    }
}

module.exports.queryAllianceMember = async(code) => {
    const sql = "SELECT member.username , ufa_acc.username AS usernameUFA FROM member LEFT JOIN ufa_acc ON  ufa_acc.member_username = member.username WHERE alliance = '" + code + "'";
    try {
        const result = await model.queryOne(sql)
        return { status: true, statusCode: httpCode.Success.ok.codeText, result: result };
    } catch (error) {
        console.log('queryAllianceMember have error :', error);
    }
}

module.exports.queryCheckDepositAuto = async(username) => {
    const sql = "SELECT SUM(amount) AS deposit FROM transaction WHERE member_username = '" + username + "' AND type = 1 AND stats = 0";
    try {
        const result = await model.queryOne(sql)
        return { status: true, statusCode: httpCode.Success.ok.codeText, result: result };
    } catch (error) {
        console.log('queryCheckDepositAuto have error :', error);
    }
}

module.exports.queryCheckDepositManual = async(usernameUFA) => {
    const sql = "SELECT SUM(credit) AS deposit FROM transaction_manual WHERE member_username = '" + usernameUFA + "' AND module = 'Deposit'";
    try {
        const result = await model.queryOne(sql)
        return { status: true, statusCode: httpCode.Success.ok.codeText, result: result };
    } catch (error) {
        console.log('queryCheckDepositManual have error :', error);
    }
}

module.exports.queryCheckWithdrawAuto = async(username) => {
    const sql = "SELECT SUM(amount) AS deposit FROM transaction WHERE member_username = '" + username + "' AND type = 0 AND stats = 0 OR stats = 3";
    try {
        const result = await model.queryOne(sql)
        return { status: true, statusCode: httpCode.Success.ok.codeText, result: result };
    } catch (error) {
        console.log('queryCheckWithdrawAuto have error :', error);
    }
}

module.exports.queryCheckWithdrawManual = async(usernameUFA) => {
    const sql = "SELECT SUM(credit) AS deposit FROM transaction_manual WHERE member_username = '" + usernameUFA + "' AND module = 'Withdraw'";
    try {
        const result = await model.queryOne(sql)
        return { status: true, statusCode: httpCode.Success.ok.codeText, result: result };
    } catch (error) {
        console.log('queryCheckWithdrawManual have error :', error);
    }
}

module.exports.queryAlliance1 = async(req) => {
    const sql = "SELECT *, alliance.id AS aid, alliance.code AS code FROM alliance LEFT JOIN bank ON  bank.bank_id = alliance.bank_name WHERE code = '" + req.body.code + "'";
    try {
        const result = await model.queryOne(sql)
        return { status: true, statusCode: httpCode.Success.ok.codeText, result: result };
    } catch (error) {
        console.log('queryAlliance1 have error :', error);
    }
}

module.exports.queryCheckDepositAuto1 = async(req) => {
    const sql = "SELECT SUM(amount) AS deposit FROM transaction WHERE member_username = '" + req.body.username + "' AND type = 1 AND stats = 0  AND `date` BETWEEN '" + req.body.start_date + "' AND '" + req.body.end_date + "'";
    try {
        const result = await model.queryOne(sql)
        return { status: true, statusCode: httpCode.Success.ok.codeText, result: result };
    } catch (error) {
        console.log('queryCheckDepositAuto1 have error :', error);
    }
}

module.exports.queryCheckDepositManual1 = async(req) => {
    const sql = "SELECT SUM(credit) AS deposit FROM transaction_manual WHERE member_username = '" + req.body.usernameUFA + "' AND module = 'Deposit'  AND `date` BETWEEN '" + req.body.start_date + "' AND '" + req.body.end_date + "'";
    try {
        const result = await model.queryOne(sql)
        return { status: true, statusCode: httpCode.Success.ok.codeText, result: result };
    } catch (error) {
        console.log('queryCheckDepositManual1 have error :', error);
    }
}

module.exports.queryCheckWithdrawAuto1 = async(req) => {
    const sql = "SELECT SUM(amount) AS deposit FROM transaction WHERE member_username = '" + req.body.username + "' AND type = 0  AND `date` BETWEEN '" + req.body.start_date + "' AND '" + req.body.end_date + "' AND stats = 0";
    try {
        const result = await model.queryOne(sql)
        return { status: true, statusCode: httpCode.Success.ok.codeText, result: result };
    } catch (error) {
        console.log('queryCheckWithdrawAuto1 have error :', error);
    }
}

module.exports.queryCheckWithdrawAuto1_1 = async(req) => {
    const sql = "SELECT SUM(amount) AS deposit FROM transaction WHERE member_username = '" + req.body.username + "' AND type = 0  AND `date` BETWEEN '" + req.body.start_date + "' AND '" + req.body.end_date + "' AND stats = 3";
    try {
        const result = await model.queryOne(sql)
        return { status: true, statusCode: httpCode.Success.ok.codeText, result: result };
    } catch (error) {
        console.log('queryCheckWithdrawAuto1 have error :', error);
    }
}

module.exports.queryCheckWithdrawManual1 = async(req) => {
    const sql = "SELECT SUM(credit) AS deposit FROM transaction_manual WHERE member_username = '" + req.body.usernameUFA + "' AND module = 'Withdraw'  AND `date` BETWEEN '" + req.body.start_date + "' AND '" + req.body.end_date + "'";
    try {
        const result = await model.queryOne(sql)
        return { status: true, statusCode: httpCode.Success.ok.codeText, result: result };
    } catch (error) {
        console.log('queryCheckWithdrawManual1 have error :', error);
    }
}

module.exports.deleteMemberAlliance = async(req) => {
    const sql = "DELETE FROM alliance WHERE id = '" + req.body.id + "'"
    try {
        const result = await model.insertOne(sql)
        return { status: true, statusCode: httpCode.Success.ok.codeText, result: result };
    } catch (error) {
        console.log('deleteMemberAlliance have error :', error);
    }
}

module.exports.insertAllianceLog = async(req) => {
    const sql = "INSERT INTO alliance_log (id,member_username,amount,date) VALUES (null, '" + req.body.username + "'," + req.body.amount + ",'" + req.body.date + "')";
    try {
        const result = await model.insertOne(sql)
        return { status: true, statusCode: httpCode.Success.ok.codeText, result: result };
    } catch (error) {
        console.log('insertAllianceLog have error :', error);
    }
}

module.exports.queryAllianceLog = async(req) => {
    const sql = "SELECT *  FROM `alliance_log` WHERE  `member_username` = '" + req.body.username + "'";
    try {
        const result = await model.queryOne(sql)
        return { status: true, statusCode: httpCode.Success.ok.codeText, result: result };
    } catch (error) {
        console.log('queryAllianceLog have error :', error);
    }
}

module.exports.queryAllianceByID = async(req) => {
    const sql = "SELECT * FROM alliance WHERE id  = " + req.body.id
    try {
        const result = await model.queryOne(sql)
        return { status: true, statusCode: httpCode.Success.ok.codeText, result: result };
    } catch (error) {
        console.log('queryAllianceByID have error :', error);
    }
}

module.exports.deleteMemberAlliance = async(req) => {
    const sql = "DELETE FROM allian WHERE id = " + req.body.id + ""
    try {
        const result = await model.insertOne(sql)
        return { status: true, statusCode: httpCode.Success.ok.codeText, result: result };
    } catch (error) {
        console.log('deleteMemberAllian have error :', error);
    }
}

module.exports.updateAllianceMember = async(req) => {
        const sql = "UPDATE alliance SET username = '" + req.body.username + "', name = '" + req.body.name + "', accnum = '" + req.body.accnum + "', bank_name = '" + req.body.bank + "', percent = " + req.body.percent + ", code = '" + req.body.code + "' WHERE id = " + req.body.id;
        try {
            const result = await model.insertOne(sql)
            return { status: true, statusCode: httpCode.Success.ok.codeText, result: result };
        } catch (error) {
            console.log('updateAllianceMember have error :', error);
        }
    }
    //######################################## ALLIANCE ########################################



module.exports.queryTurnover = async(req) => {
    const sql = "SELECT * FROM history_turnover WHERE username  = '" + req.body.username + "' AND date BETWEEN '" + req.body.start + "' AND '" + req.body.end + "'";
    try {
        const result = await model.queryOne(sql)
        return { status: true, statusCode: httpCode.Success.ok.codeText, result: result };
    } catch (error) {
        console.log('queryTurnover have error :', error);
    }
}
























































































module.exports.insertStaffHistory = async(req) => {
    const sql = "INSERT INTO staff_history (id,username,type,detail,date) VALUES (null, '" + req.body.username + "',0,'" + req.body.detail + "','" + req.body.date + "')"
    try {
        const result = await model.insertOne(sql)
        return { status: true, statusCode: httpCode.Success.ok.codeText, result: result };
    } catch (error) {
        console.log('insertStaffHistory have error :', error);
    }
}


module.exports.insertReportActivity = async(req) => {
    const sql = "INSERT INTO report_activity (id,user,detail,module,ip_address,create_date) VALUES (null, '" + req.body.username + "','" + req.body.detail + "','" + req.body.module + "','" + req.body.ip + "','" + req.body.date + "')"
    try {
        const result = await model.insertOne(sql)
        return { status: true, statusCode: httpCode.Success.ok.codeText, result: result };
    } catch (error) {
        console.log('insertReportActivity have error :', error);
    }
}



module.exports.queryMemberWithdraw = async(req) => {
    const sql = "SELECT *,transaction.id AS tid FROM transaction LEFT JOIN member ON transaction.member_username = member.username LEFT JOIN bank ON member.bank = bank.bank_id WHERE type = 0  AND stats = 1 AND amount >= " + req.min + "  AND amount <= " + req.max + ""
    try {
        const result = await model.queryOne(sql)
        if (result && result.length) {
            return { status: true, statusCode: httpCode.Success.ok.codeText, result: result };
        } else {
            return { status: true, statusCode: httpCode.Success.noContent.codeText, result: result }
        }
    } catch (error) {
        console.log('queryMemberWithdraw have error :', error);
        return { status: false, statusCode: httpCode.Fail.serviceUnavailable.codeText, result: [] }
    }
}

module.exports.querySettingLine = async(req) => {
    const sql = "SELECT * FROM seting "
    try {
        const result = await model.queryOne(sql)
        if (result && result.length) {
            return { status: true, statusCode: httpCode.Success.ok.codeText, result: result };
        } else {
            return { status: true, statusCode: httpCode.Success.noContent.codeText, result: result }
        }
    } catch (error) {
        console.log('querySettingLine have error :', error);
        return { status: false, statusCode: httpCode.Fail.serviceUnavailable.codeText, result: [] }
    }
}

module.exports.querySetting = async(req) => {
    const sql = "SELECT * FROM setting_auto_withdraw "
    try {
        const result = await model.queryOne(sql)
        if (result && result.length) {
            return { status: true, statusCode: httpCode.Success.ok.codeText, result: result };
        } else {
            return { status: true, statusCode: httpCode.Success.noContent.codeText, result: result }
        }
    } catch (error) {
        console.log('queryMemberWithdraw have error :', error);
        return { status: false, statusCode: httpCode.Fail.serviceUnavailable.codeText, result: [] }
    }
}
module.exports.insertLogAutoWithdraw = async(req) => {
    const sql = "INSERT INTO `auto_withdraw`(`id`, `member_username`, `bank_name`, `bank_acc`, `name`, `amount`, `date`,`date_new`)" +
        "VALUES (null,'" + req.username + "','" + req.bank + "','" + req.bankacc + "','" + req.name + "'," + req.amount + ",'" + req.date + "','" + req.date_new + "')"
    try {
        const result = await model.insertOne(sql)
        return { status: true, statusCode: httpCode.Success.ok.codeText, result: result };
    } catch (error) {
        console.log('insertLogAutoWithdraw have error :', error);
    }
}

module.exports.updateTransaction = async(id) => {
    const sql = "UPDATE transaction SET stats = 3 WHERE id = " + id
    try {
        const result = await model.insertOne(sql)
        return { status: true, statusCode: httpCode.Success.ok.codeText, result: result };
    } catch (error) {
        console.log('updateTransaction have error :', error);
    }
}

module.exports.queryAmountToday = async(req) => {
    const sql = "SELECT SUM(amount) AS amount FROM auto_withdraw WHERE date_new = '" + req.date + "'"
    try {
        const result = await model.queryOne(sql)
        if (result && result.length) {
            return { status: true, statusCode: httpCode.Success.ok.codeText, result: result };
        } else {
            return { status: true, statusCode: httpCode.Success.noContent.codeText, result: result }
        }
    } catch (error) {
        console.log('queryMemberWithdraw have error :', error);
        return { status: false, statusCode: httpCode.Fail.serviceUnavailable.codeText, result: [] }
    }
}

module.exports.insertLogTurnover = async(req) => {
    // const sql = "INSERT INTO `history_turnover`(`id`, `username`, `turnover`, `winloss`, `date`)" +
    // "VALUES (null,'" + req.username + "','" + req.turnover + "','" + req.winloss + "','" + req.date + "')"
    const sql = `INSERT INTO history_turnover (keybyday,username, turnover, winloss, date)  VALUES ? 
ON DUPLICATE KEY UPDATE keybyday = values(keybyday)
, username = values(username)
, turnover = values(turnover)
, winloss = values(winloss)
, date = values(date)`;

    try {
        const result = await model.insertMany(sql, [req])
        return { status: true, statusCode: httpCode.Success.ok.codeText, result: result };
    } catch (error) {
        console.log('insertLogTurnover have error :', error);
    }
}
module.exports.updateSettingGameAuto = async(req) => {
    const sql = `UPDATE setting_game SET VIEWSTATEGENERATOR = '${req.__VIEWSTATEGENERATOR}',VIEWSTATE = '${req.__VIEWSTATE}',EVENTVALIDATION = '${req.__EVENTVALIDATION}' WHERE id = 1`;
    try {
        const result = await model.insertOne(sql);
        return {
            status: true,
            statusCode: httpCode.Success.ok.codeText,
            result: result,
        };
    } catch (error) {
        console.log("updateSettingGame have error :", error);
    }
};