// module.exports = con = {
//     host: "localhost",
//     user: "sql_4uclub_com",
//     password: "bkZkGGHFBEfmBbdM",
//     database: "sql_4uclub_com"
// };


module.exports = con = {
    host: process.env.HOST_DB,
    user: process.env.USER_DB,
    password: process.env.PASS_DB,
    database: process.env.NAME_DB
};