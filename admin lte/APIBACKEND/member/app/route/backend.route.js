const controllerMember = require('../controllers/backend.controller');
const controllerAuto = require('../controllers/auto.controller');
module.exports = (app) => {
    app.get('/Logs', controllerMember.testLogs);
    app.post('/gitpull', controllerMember.gitpull);
    app.get('/pm2restart', controllerMember.pm2restart);
    app.post('/testToken', controllerMember.testToken);
    app.post('/Login', controllerMember.Login);
    app.post('/createSite', controllerMember.createSite);
    app.post('/ApiChangePass', controllerMember.ApiChangePass);
    app.post('/ApiUpdateDeviceScb', controllerMember.ApiUpdateDeviceScb);
    app.post('/ApiUpdateUfaAcc', controllerMember.ApiUpdateUfaAcc);

    //######################################## NAV BAR ########################################
    app.post('/Apinav', controllerMember.Apinav);
    //######################################## NAV BAR ########################################


    //######################################## Dashboard ########################################
    app.post('/Apidashboard', controllerMember.Apidashboard);
    app.post('/ApiSettingDashboard', controllerMember.ApiSettingDashboard);
    app.post('/ApiupdateGeneralSetting', controllerMember.ApiupdateGeneralSetting);
    app.post('/ApiupdateAutoSetting', controllerMember.ApiupdateAutoSetting);
    app.post('/ApiupdateNotifySetting', controllerMember.ApiupdateNotifySetting);
    //######################################## Dashboard ########################################


    //######################################## Member ########################################
    app.post('/Apiquerymember', controllerMember.Apiquerymember);
    app.post('/ApiquerymemberUFA', controllerMember.ApiquerymemberUFA);
    app.post('/ApideleteMember', controllerMember.ApideleteMember);
    app.post('/ApiqueryeMember', controllerMember.ApiqueryeMember);
    app.post('/ApiupdateMember', controllerMember.ApiupdateMember);
    app.post('/ApiupdatePlayPowyingshup', controllerMember.ApiupdatePlayPowyingshup);
    app.post('/ApiviewCreditUserUFA', controllerMember.ApiviewCreditUserUFA);
    app.post('/ApimanageCredit', controllerMember.ApimanageCredit);
    app.post('/ApiaddCredit', controllerMember.ApiaddCredit);
    app.post('/ApiminusCredit', controllerMember.ApiminusCredit);
    app.post('/ApiregisterMemberManual', controllerMember.ApiregisterMemberManual);
    //######################################## Member ########################################


    //######################################## Promotion ########################################
    app.post('/ApiqueryePromotion', controllerMember.ApiqueryePromotion);
    app.post('/ApiupdatePromotion', controllerMember.ApiupdatePromotion);
    app.post('/ApiqueryePromotionHistory', controllerMember.ApiqueryePromotionHistory);
    //######################################## Promotion ########################################


    //######################################## Deposit History ########################################
    app.post('/ApiqueryeDepositHistory', controllerMember.ApiqueryeDepositHistory);
    //######################################## Deposit History ########################################




    //######################################## Withdraw History ########################################
    app.post('/ApiqueryeWithdrawHistory', controllerMember.ApiqueryeWithdrawHistory);
    //######################################## Withdraw History ########################################





    //######################################## Withdraw ########################################
    app.post('/ApiwithdrawUserAuto', controllerMember.ApiwithdrawUserAuto);
    app.post('/ApiupdateStatusWithdraw', controllerMember.ApiupdateStatusWithdraw);
    app.post('/ApiupdateUnStatusWithdraw', controllerMember.ApiupdateUnStatusWithdraw);
    app.post('/ApiqueryWithdrawSuccess', controllerMember.ApiqueryWithdrawSuccess);
    app.post('/ApiqueryWithdrawUnSuccess', controllerMember.ApiqueryWithdrawUnSuccess);
    app.post('/ApicheckStatusSCB', controllerMember.ApicheckStatusSCB);

    //######################################## Withdraw ########################################


    //######################################## Result ########################################
    app.post('/ApiqueryResult', controllerMember.ApiqueryResult);
    //######################################## Result ########################################




    //######################################## Report Withdraw ########################################
    app.post('/ApiqueryWithdrawReport', controllerMember.ApiqueryWithdrawReport);
    app.post('/ApiqueryWithdrawAutoReport', controllerMember.ApiqueryWithdrawAutoReport);
    //######################################## Report Withdraw ########################################


    //######################################## Report Deposit ########################################
    app.post('/ApiqueryDepositReport', controllerMember.ApiqueryDepositReport);
    //######################################## Report Deposit ########################################


    //######################################## Report Finance ########################################
    app.post('/ApiqueryFinanceReport', controllerMember.ApiqueryFinanceReport);
    //######################################## Report Finance ########################################



    //######################################## Transaction Manual ########################################
    app.post('/ApiqueryTransactionManual', controllerMember.ApiqueryTransactionManual);
    //######################################## Transaction Manual ########################################




    //######################################## STAFF ########################################
    app.post('/ApiqueryStaff', controllerMember.ApiqueryStaff);
    app.post('/ApiaddStaff', controllerMember.ApiaddStaff);
    app.post('/ApideleteStaff', controllerMember.ApideleteStaff);
    app.post('/ApiqueryStaffByID', controllerMember.ApiqueryStaffByID);
    app.post('/ApiupdateStaff', controllerMember.ApiupdateStaff);

    //######################################## STAFF ########################################


    //######################################## STAFF HISTORY ########################################
    app.post('/ApiqueryeStaffHistory', controllerMember.ApiqueryeStaffHistory);
    //######################################## STAFF HISTORY ########################################



    //######################################## SETTING WHEE HISTORY ########################################
    app.post('/ApiqueryeSettingWheel', controllerMember.ApiqueryeSettingWheel);
    app.post('/ApiupdateSetting_w', controllerMember.ApiupdateSetting_w);
    app.post('/ApiupdateSettingWheel', controllerMember.ApiupdateSettingWheel);
    //######################################## SETTING WHEE HISTORY ########################################


    //######################################## Report Wheel ########################################
    app.post('/ApiqueryWheelReport', controllerMember.ApiqueryWheelReport);
    //######################################## Report Wheel ########################################


    //######################################## SETTING POWYINGSHUP ########################################
    app.post('/ApiquerySettingPowYingShup', controllerMember.ApiquerySettingPowYingShup);
    app.post('/ApiupdatePowYingShup', controllerMember.ApiupdatePowYingShup);
    //######################################## SETTING POWYINGSHUP ########################################

    //######################################## Report POWYINGSHUP ########################################
    app.post('/ApiqueryPowYingShupReport', controllerMember.ApiqueryPowYingShupReport);
    //######################################## Report POWYINGSHUP ########################################


    //######################################## Report POWYINGSHUP ########################################
    app.post('/testSCB', controllerMember.testSCB);
    //######################################## Report POWYINGSHUP ########################################
 

    //######################################## Alliance ########################################
    app.post('/ApiaddAlliance', controllerMember.ApiaddAlliance);
    app.post('/ApiqueryAlliance', controllerMember.ApiqueryAlliance);
    app.post('/ApiqueryDetailAlliance', controllerMember.ApiqueryDetailAlliance);
    app.post('/ApiaddAllianceLog', controllerMember.ApiaddAllianceLog);
    app.post('/ApiqueryAllianceLog', controllerMember.ApiqueryAllianceLog);
    app.post('/ApiqueryAllianceByID', controllerMember.ApiqueryAllianceByID);
    app.post('/ApideleteMemberAlliance', controllerMember.ApideleteMemberAlliance);
    app.post('/ApiupdateMemberAlliance', controllerMember.ApiupdateMemberAlliance);


    //######################################## Alliance ########################################
    app.post('/ApiqueryTurnover', controllerMember.ApiqueryTurnover);

    //######################################## Auto withdarw ########################################
    app.post('/auto_deposit', controllerAuto.auto_deposit);
}