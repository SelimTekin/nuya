const baseurl = $("base").attr("href");

$(document).ready(function () {
    $(".IKalert").show();
    setTimeout(function () {
        $('#loading').hide();
    }, 700);
    setTimeout(function () {
        $(".IKalert").css("right", "10px");
        $(".IKalert").css("bottom", "30px");
        setTimeout(function () {
            $(".IKalert").css("right", "-300px");
            $(".IKalert").css("bottom", "-300px");
            setTimeout(function () {
                $(".IKalert").hide();
            }, 400)
        }, 2000);
    }, 300);
    $(".goLink").click(function () {
        var goLink = $(this).attr("name");
        window.location.href = goLink;
    });
    $(".goInLink").click(function () {
        var goLink = $(this).attr("name");
        window.location.href = baseurl + "/" + goLink;
    });
    $(".goInLinkLoad").click(function () {
        var goLink = $(this).attr("name");
        alertTopBarShow("Gönderiliyor", "primary");
        window.location.href = baseurl + "/" + goLink;
    });
    $(".goInDeleteComplete").click(function () {
        var text = `
        Sayın kullanıcı, yapacağınız işlemin bir geri dönüşü olmayacaktır.
            Yapacağınız işleme devam etmek istediğinize emin misiniz ?`;
        if (confirm(text) == true) {
            var incomingLink = $(this).attr("name");
            window.location.href = baseurl + "/" + incomingLink;
        }
    });
    $(".goButton").click(function () {
        var goLink = $(this).attr("href");
        window.location.href = goLink;
    })
});
function goInLinkFuc(node) {
    var goLink = $(node).attr("name");
    window.location.href = baseurl + "/" + goLink;
}

/* Alert */

function alertShow(text) {
    $(".IKalert").remove();
    var data = `
        <div class="bg-success text-light IKalert">
            ` + text + `
        </div>
    `;
    $("body").append(data);
    $(".IKalert").show();
    setTimeout(function () {
        $(".IKalert").css("right", "10px");
        $(".IKalert").css("bottom", "30px");
        setTimeout(function () {
            $(".IKalert").css("right", "-300px");
            $(".IKalert").css("bottom", "-300px");
            setTimeout(function () {
                $(".IKalert").hide();
            }, 400)
        }, 3000);
    }, 500);
}
function alertShowPlus(text, colorTextBS5) {
    $(".IKalert").remove();
    var data = `
        <div class="bg-` + colorTextBS5 + ` text-light IKalert">
            ` + text + `
        </div>
    `;
    $("body").append(data);
    $(".IKalert").show();
    setTimeout(function () {
        $(".IKalert").css("right", "10px");
        $(".IKalert").css("bottom", "30px");
        setTimeout(function () {
            $(".IKalert").css("right", "-300px");
            $(".IKalert").css("bottom", "-300px");
            setTimeout(function () {
                $(".IKalert").hide();
            }, 400)
        }, 3000);
    }, 500);
}

function alertTopBarShow(text, colorTextBS5){
    $(".IKalertTopBar").remove();
    var data = `
        <div class="bg-` + colorTextBS5 + ` text-light text-center IKalertTopBar">
            ` + text + `
        </div>
    `;
    $("body").append(data);
    $(".IKalertTopBar").show();
    setTimeout(function () {
        $(".IKalertTopBar").css("top", "150px");
        setTimeout(function () {
            $(".IKalertTopBar").css("top", "-100px");
            setTimeout(function () {
                $(".IKalertTopBar").hide();
            }, 400)
        }, 2500);
    }, 100);
}
/* Extra Button */

function extraButtonActive(node) {
    var lastName, lastPrice, lastDetails;
    var newName = $(node).attr("name");
    var newEPrice = newName.split(",")[2];
    var product = $(node).parent().parent().siblings(".mainContentCartPriceArea").children(".mainContentCartPriceInArea").children(".mainContentCartPrice");
    var oldPrice = product.text();

    if ($(node).attr("key") == "selected") {
        $(node).css("background-color", "initial");
        $(node).css("color", "initial");
        $(node).attr("key", "none");
        var newPrice = parseInt(oldPrice) - parseInt(newEPrice);

    } else {
        if ($(node).siblings(".extraButton[key='selected']").first().length) {
            lastDetails = $(node).siblings(".extraButton[key='selected']").first();
            $(lastDetails).css("background-color", "initial");
            $(lastDetails).css("color", "initial");
            $(lastDetails).attr("key", "none");
            lastName = $(lastDetails).attr("name");
            lastPrice = lastName.split(",")[2];
        } else {
            lastPrice = 0;
        }
        $(node).css("background-color", "#276c2b");
        $(node).css("color", "white");
        $(node).attr("key", "selected");
        var newPrice = parseInt(newEPrice) + parseInt(oldPrice) - parseInt(lastPrice);
    }
    product.text(newPrice);
}

function extraButtonActiveProduct(node) {
    var newName = $(node).attr("name");
    var newEPrice = newName.split(",")[2];
    var product = $(".mainContentCartPrice");
    var oldPrice = product.text();

    if ($(node).attr("key") == "selected") {
        $(node).css("background-color", "initial");
        $(node).css("color", "initial");
        $(node).attr("key", "none");
        var newPrice = parseInt(oldPrice) - parseInt(newEPrice);

    } else {

        if ($(node).siblings(".extraButton[key='selected']").first().length) {
            lastDetails = $(node).siblings(".extraButton[key='selected']").first();
            $(lastDetails).css("background-color", "initial");
            $(lastDetails).css("color", "initial");
            $(lastDetails).attr("key", "none");
            lastName = $(lastDetails).attr("name");
            lastPrice = lastName.split(",")[2];
        } else {
            lastPrice = 0;
        }
        $(node).css("background-color", "#276c2b");
        $(node).css("color", "white");
        $(node).attr("key", "selected");
        var newPrice = parseInt(newEPrice) + parseInt(oldPrice) - parseInt(lastPrice);
    }
    product.text(newPrice);
}
// Language Change
function languageChange(incomingLanguage) {
    document.cookie = "language=" + incomingLanguage + "; expires=Thu";
    var text = "Dil ayarları değiştiriliyor. Lütfen bekleyiniz...";
    var colorTextBS5 = "primary";
    alertShowPlus(text, colorTextBS5);
    location.reload();
}
function detectedLanguage() {
    var newX, x, splitX;
    var language = "tr";
    var x = document.cookie;
    var splitX = x.split(";");
    $.each(splitX, function (indexInArray, valueOfElement) {
        newX = valueOfElement.trim().split("=");
        if (newX[0] == "language") {
            language = newX[1];
        }
    });
    return language;
}