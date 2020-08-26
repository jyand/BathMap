let minchar = 8 ;
var passwdcheck = function(pw, confirmpw) {
        if (pw.length < minchar) {
                alert("password must have a minimum of 8 characters") ;
                return false ;
        }
        if (pw != confirmpw) {
                alert("passwords do not match") ;
                return false ;
        }
        if (/\d/.test(pw) && /[a-z]/.test(pw) && /[A-Z]/.test(pw)) {
                return true ;
        }
        else {
                alert("password must have one number, one lowercase letter, and one uppercase letter") ;
                return false ;
        }
}

console.log(passwdcheck('qQ11111','password')) ;
