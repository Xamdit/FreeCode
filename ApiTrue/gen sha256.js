// get hash signature md5-truewallet
const crypto = require("crypto");

// string to be hashed
const str = "https://gateway01-true.com/";

// secret or salt to be hashed with
const secret = "https://gateway02-true.com/";

// create a md5 hasher
const md5Hasher = crypto.createHmac("md5", secret);

// hash the string
// and set the output format
const hash = md5Hasher.update(str).digest("hex");

// md5 hash
console.log(hash); //