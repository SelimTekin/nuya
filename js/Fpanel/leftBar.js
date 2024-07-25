$(document).ready(function(){
    $(".rightMenu").click(function () {
        var zaman = new Date();
        var openLeft;
        zaman.setMonth(zaman.getMonth + 1);

        if ($(this).attr("name") == "none") {
            openLeft = "false";
            $(this).attr("name", "false");

            $(".leftMenu").children("a.rightMenuA").children("span").css("display", "inline-block");
            $(".leftOwner").attr("style", "display:block; width:0px !important");
            
            $(this).children(".rightMenuSpan").children("i").css("transform", 'rotate(0deg)');
            
            $(".leftOwner").attr("class", "leftOwner");
            
            $(".centerOwner").attr("class", "col-7 col-md-9 col-lg-10 centerOwner");
            $(".leftMenu").attr("style", "")
            $(".onlyPCjs").attr("style","display:block;");
            $(".onlyPCjsArea").attr("style", "width:auto")

            setTimeout(function () {            
                $(".leftArea").css("width", "110%");
                $(".leftOwner").attr("style", "display:block; width:auto !important");
            }, 400);

        } else if ($(this).attr("name") == "true") {
            openLeft = "none";
            
            $(".leftArea").css("width", "0px");
            $(".rightMenu").attr("name", "none");
            $(this).children(".rightMenuSpan").children("i").css("transform", 'rotate(-90deg)');
            $(".onlyPCjs").attr("style","display:none");
            $(".onlyPCjsArea").attr("style", "")

            setTimeout(function () {
                $(".leftOwner").attr("class", "col-0 leftOwner");
                $(".leftOwner").attr("style", "display: none;width:0%");
                $(".centerOwner").attr("class", "col-12 centerOwner");
                $(".leftMenu").attr("style", "")
                $(".leftMenu").children("a.rightMenuA").children("span").css("display", "none");
            }, 400);

        } else {
            openLeft = "true";

            $(".leftArea").css("width", "75px");
            $(".rightMenu").attr("name", "true");
            $(".onlyPCjs").attr("style","display:none");
            $(".onlyPCjsArea").attr("style", "")

            $(this).children(".rightMenuSpan").children("i").css("transform", 'rotate(180deg)');
            setTimeout(function () {
                $(".leftOwner").attr("class", "col-2 col-lg-1 leftOwner");
                $(".leftOwner").attr("style", "display: block");
                $(".centerOwner").attr("class", "col-10 col-lg-11 centerOwner");
                $(".leftMenu").attr("style", "text-align:center")
                $(".leftMenu").children("a.rightMenuA").children("span").css("display", "none");
            }, 200);

        }

        document.cookie = "openLeft=" + openLeft + ";expires=" + zaman.toGMTString();
    });
});
