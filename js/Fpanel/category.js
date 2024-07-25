function treeModel(node, owner = 0) { // owner (top element request)
    var topNode = $(node).parent().parent();
    var incomingName = $(node).attr("name");
    var incomingSplit = incomingName.split("-");
    var incomingN = incomingSplit[0];
    var siblings = $(topNode).siblings();
    var status = $(node).attr("status");

    $.each(siblings, function (key, valTop) {
        var val = $(valTop).children(".categoryMenuArea").children(".categoryMenuBottomArea");

        var valName = $(val).attr("name");
        var valSplit = valName.split("-");
        var valNone = valSplit[0];
        var valNtwo = valSplit[1];

        // document.write(valN + " - " + incomingN + "<br>");
        if (incomingN == valNtwo) {
            $(valTop).css("display", "none");

            if (status == "1" || owner == "1") {
                $(node).attr("status", "0");
                $(node).children(".categorySelectIcon").children("i").css("transform", "rotate(0deg)");
                $(valTop).attr("style", "display:none!important");

                if (!(valNone == "X")) {
                    treeModel(val, 1); // owner closed so all closed
                }
            } else {
                $(node).attr("status", "1");
                $(node).children(".categorySelectIcon").children("i").css("transform", "rotate(90deg)");
                $(valTop).attr("style", "display:flex!important");

                if (!(valNone == "X")) {
                    treeModel(val);
                }
            }
        }
    })
}

function addCategoryProduct(node){
    var incomingCategory = $(node).attr("name");
    var text = `
        <form method="POST" action="` + baseurl + "/Fpanel/Product/Add" + `" id="myFormForCategoryProduct">
            <input type="hidden" name="selectProduct" value="` + incomingCategory + `">
        </form>
    `;
    $("body").append(text);
    $("#myFormForCategoryProduct").submit();
}

/* Category For Category */

function menuIndexChange(CategoryID) {
    var Language = detectedLanguage();

    $.post(baseurl + "/SoftPHP/getCategoryForCategory", { CategoryID: CategoryID, Language:Language }, function (data) {
        if (data.length > 0) {
            $("#myModalCategory").modal("show"); 
            $(".modal-body-category").children("div").remove();
            if(!(data == "Not Found")){
                $(".modal-quantity-category").text(data.length);
                var html;
                $.each(data, function (key, val) {
                    categoryDetails = val.categoryDetails;
                    html = `
                  <div class="d-flex indexMenuArea m-3" key='` + key + `' keyId='` + categoryDetails.categoryId + `' lastKeyId='` + categoryDetails.categoryId + `'>
                    <div class='col-2' onclick='menuModalIndexChangeUp(this)'>   
                        <i class="fa-solid fa-circle-up"></i>
                    </div>
                    <div class='col-8 menuIndexCategoryName'>   
                        ` + categoryDetails.categoryName + `
                    </div>
                    <div class='col-2' onclick='menuModalIndexChangeDown(this)'>   
                        <i class="fa-regular fa-circle-down"></i>   
                    </div>
                </div>
              `;
                    $(".modal-body-category").append(html);
    
                });
            }else{
                $(".modal-quantity-category").text(0);

            }
        }
    });
}

function menuModalIndexChangeUp(node) {
    var key = $(node).parent().attr("key");
    var keyId = $(node).parent().attr("keyId");
    var productName = $(node).siblings(".menuIndexCategoryName").text();

    if (key != "0") {
        otherNode = $(".indexMenuArea[key=" + (key - 1) + "]");

        otherKeyId = otherNode.attr("keyId");
        otherProductName = otherNode.children(".menuIndexCategoryName").text();

        otherNode.attr("keyId", keyId);
        $(node).parent().attr("keyId", (otherKeyId));

        otherNode.children(".menuIndexCategoryName").text(productName);
        $(node).siblings(".menuIndexCategoryName").text(otherProductName);
    }
}

function menuModalIndexChangeDown(node) {
    var key = $(node).parent().attr("key");
    var keyId = $(node).parent().attr("keyId");
    var productName = $(node).siblings(".menuIndexCategoryName").text();

    if (key != (parseInt($(".modal-quantity-category").text()))-1) {
        otherNode = $(".indexMenuArea[key=" + (parseInt(key) + 1) + "]");

        otherKeyId = otherNode.attr("keyId");
        otherProductName = otherNode.children(".menuIndexCategoryName").text();

        otherNode.attr("keyId", keyId);
        $(node).parent().attr("keyId", (otherKeyId));

        otherNode.children(".menuIndexCategoryName").text(productName);
        $(node).siblings(".menuIndexCategoryName").text(otherProductName);
    }
}
function menuModelComplateIndex(){
    var keyid, lastkeyid;
    newArray = {};

    for($i = 0;$i < parseInt($(".modal-quantity-category").text());$i++){
        keyid = $(".indexMenuArea[key=" + $i +"]").attr("keyid");
        lastkeyid = $(".indexMenuArea[key=" + $i +"]").attr("lastkeyid");
        newArray[keyid] = {lastkeyid};
    }
    $.post(baseurl + "/Fpanel/Category/menuIndexChange", { newArray: newArray }, function (data) {
        if(data.length > 0){
            location.reload();
        }
    });
}
/* Category For In Category */

function menuIndexMenuChange(CategoryID) {
    var Language = detectedLanguage();

    $.post(baseurl + "/SoftPHP/getCategoryForCategory", { CategoryID: CategoryID, Language:Language }, function (data) {
        if (data.length > 0) {
            $("#myModalInCategory").modal("show"); 
            $(".modal-body-in-category").children("div").remove();
            if(!(data == "Not Found")){
                $(".modal-quantity-in-category").text(data.length);
                var html;
                $.each(data, function (key, val) {
                    categoryDetails = val.categoryDetails;
                    html = `
                  <div class="d-flex indexInMenuArea m-3" key='` + key + `' keyId='` + categoryDetails.categoryId + `' lastKeyId='` + categoryDetails.categoryId + `'>
                    <div class='col-2' onclick='menuModalMenuIndexChangeUp(this)'>   
                        <i class="fa-solid fa-circle-up"></i>
                    </div>
                    <div class='col-8 menuInIndexCategoryName'>   
                        ` + categoryDetails.categoryName + `
                    </div>
                    <div class='col-2' onclick='menuModalMenuIndexChangeDown(this)'>   
                        <i class="fa-regular fa-circle-down"></i>   
                    </div>
                </div>
              `;
                    $(".modal-body-in-category").append(html);
    
                });
            }else{
                $(".modal-quantity-in-category").text(0);

            }
        }
    });
}

function menuModalMenuIndexChangeUp(node) {
    var key = $(node).parent().attr("key");
    var keyId = $(node).parent().attr("keyId");
    var productName = $(node).siblings(".menuInIndexCategoryName").text();

    if (key != "0") {
        otherNode = $(".indexInMenuArea[key=" + (key - 1) + "]");

        otherKeyId = otherNode.attr("keyId");
        otherProductName = otherNode.children(".menuInIndexCategoryName").text();

        otherNode.attr("keyId", keyId);
        $(node).parent().attr("keyId", (otherKeyId));

        otherNode.children(".menuInIndexCategoryName").text(productName);
        $(node).siblings(".menuInIndexCategoryName").text(otherProductName);
    }
}

function menuModalMenuIndexChangeDown(node) {
    var key = $(node).parent().attr("key");
    var keyId = $(node).parent().attr("keyId");
    var productName = $(node).siblings(".menuInIndexCategoryName").text();

    if (key != (parseInt($(".modal-quantity-in-category").text()))-1) {
        otherNode = $(".indexInMenuArea[key=" + (parseInt(key) + 1) + "]");

        otherKeyId = otherNode.attr("keyId");
        otherProductName = otherNode.children(".menuInIndexCategoryName").text();

        otherNode.attr("keyId", keyId);
        $(node).parent().attr("keyId", (otherKeyId));

        otherNode.children(".menuInIndexCategoryName").text(productName);
        $(node).siblings(".menuInIndexCategoryName").text(otherProductName);
    }
}
function menuModelMenuComplateIndex(){
    var keyid, lastkeyid;
    newArray = {};

    for($i = 0;$i < parseInt($(".modal-quantity-in-category").text());$i++){
        keyid = $(".indexInMenuArea[key=" + $i +"]").attr("keyid");
        lastkeyid = $(".indexInMenuArea[key=" + $i +"]").attr("lastkeyid");
        newArray[keyid] = {lastkeyid};
    } 
    $.post(baseurl + "/Fpanel/Category/menuIndexMenuChange", { newArray: newArray }, function (data) {
        if(data.length > 0){
            location.reload();
        }
    });
}


 /* Product For Category */

function categoryIndexChange(CategoryID) {
    var Language = detectedLanguage();

    $.post(baseurl + "/SoftPHP/getProductsForCategory", { CategoryID: CategoryID, Language:Language }, function (data) {
        if (data.length > 0) {
            $("#myModal").modal("show"); 
            $(".modal-body-product").children("div").remove();
            if(!(data == "Not Found")){
                $(".modal-quantity-product").text(data.length);
                var html;
    
                $.each(data, function (key, val) {
                    productDetails = val.productDetails;
                    productExtra = val.productExtra;
                    html = `
                  <div class="d-flex indexProductArea m-3" key='` + key + `' keyId='` + productDetails.productId + `' lastKeyId='` + productDetails.productId + `'>
                    <div class='col-2' onclick='categoryModalIndexChangeUp(this)'>   
                        <i class="fa-solid fa-circle-up"></i>
                    </div>
                    <div class='col-8 categoryIndexProductName'>   
                        ` + productDetails.productName + `
                    </div>
                    <div class='col-2' onclick='categoryModalIndexChangeDown(this)'>   
                        <i class="fa-regular fa-circle-down"></i>   
                    </div>
                </div>
              `;
                    $(".modal-body-product").append(html);
    
                });
            }else{
                $(".modal-quantity-product").text(0);

            }
        }
    });
}
function categoryModalIndexChangeUp(node) {
    var key = $(node).parent().attr("key");
    var keyId = $(node).parent().attr("keyId");
    var productName = $(node).siblings(".categoryIndexProductName").text();

    if (key != "0") {
        otherNode = $(".indexProductArea[key=" + (key - 1) + "]");

        otherKeyId = otherNode.attr("keyId");
        otherProductName = otherNode.children(".categoryIndexProductName").text();

        otherNode.attr("keyId", keyId);
        $(node).parent().attr("keyId", (otherKeyId));

        otherNode.children(".categoryIndexProductName").text(productName);
        $(node).siblings(".categoryIndexProductName").text(otherProductName);
    }
}
function categoryModalIndexChangeDown(node) {
    var key = $(node).parent().attr("key");
    var keyId = $(node).parent().attr("keyId");
    var productName = $(node).siblings(".categoryIndexProductName").text();

    if (key != (parseInt($(".modal-quantity-product").text()))-1) {
        otherNode = $(".indexProductArea[key=" + (parseInt(key) + 1) + "]");

        otherKeyId = otherNode.attr("keyId");
        otherProductName = otherNode.children(".categoryIndexProductName").text();

        otherNode.attr("keyId", keyId);
        $(node).parent().attr("keyId", (otherKeyId));

        otherNode.children(".categoryIndexProductName").text(productName);
        $(node).siblings(".categoryIndexProductName").text(otherProductName);
    }

}
function categoryModelComplateIndex(){
    var keyid, lastkeyid;
    newArray = {};

    for($i = 0;$i < parseInt($(".modal-quantity-product").text());$i++){
        keyid = $(".indexProductArea[key=" + $i +"]").attr("keyid");
        lastkeyid = $(".indexProductArea[key=" + $i +"]").attr("lastkeyid");
        newArray[keyid] = {lastkeyid};
    }
    $.post(baseurl + "/Fpanel/Category/categoryIndexChange", { newArray: newArray }, function (data) {
        if(data.length > 0){
            location.reload();
        }
    });
}
