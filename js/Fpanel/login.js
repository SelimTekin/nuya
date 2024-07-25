function loginCookie(){
    var incomingName = $("#Fname").val();
    var incomingPass = $("#Fpassword").val();
    document.cookie = "loginCookieName=" + incomingName + "; expires=Thu";
    document.cookie = "loginCookiePass=" + incomingPass + "; expires=Thu";
    $("form").submit();
}