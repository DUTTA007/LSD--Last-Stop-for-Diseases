function login(){

    var uemail = document.getElementById(email_).value;
    var upass = document.getElementById(password_).value;

    firebase.auth().signInWithEmailAndPassword(uemail, upass).catch(function(error) {
        console.log(error.code);
        console.log(error.message);
        console.log(uemail);
        console.log(upass);
     });

}