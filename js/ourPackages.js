$(document).ready(function () {
  setInterval(function () {
    var topCategoryLeft = parseInt($(".topCategoryInArea").scrollLeft());
    var categoryWidth = parseInt($(".topCategoryMenuArea").width());

    if (topCategoryLeft >= $(".topCategoryInArea").width()) {
      $(".topCategoryInArea").stop().animate({ scrollLeft: 0 }, 1000, 'swing');
    } else {
      $(".topCategoryInArea").stop().animate({ scrollLeft: topCategoryLeft + categoryWidth }, 500, 'swing');
    }
  }, 4000);
});
var time = 0;
/* We see Menu * json*/

function lookup(inputString) {
  var html, htmlX, otherPart;
  var Language = detectedLanguage();
  time += 1;
  var myTime = time;
  console.log(inputString);
  $.post(baseurl + "/SoftPHP", { queryString: inputString, Language:Language }, function (data) {
    if (time == myTime) {
      if (data.length > 0) {
        $(".mainProductArea").children("div").remove();

        $.each(data, function (key, val) {
          dataSplitThree = key;
          productDetails = val.productDetails;
          productImg     = productDetails.productImg;
          dateFormat = new Date(parseInt(productDetails.productCreateDate) * 1000);
          fullYear   = dateFormat.getFullYear();
          fullMonth  = dateFormat.getMonth()+1;
          fullDay    = dateFormat.getDate();
          if(productImg != ""){
            htmlX = `
              <div class="col-3 p-2 mainProductsImgArea" onclick="goInLinkFuc(this)" name="`+ productDetails.productLink + `">
                <img class="mainProductsImg" src="`+ baseurl + `/img/productImg/` + productDetails.productImg + `">
              </div>
            `;
            otherPart = "col-9";
            
          }else{
            htmlX = "";
            otherPart = "col-12";
          }
          html = `
                <div class="d-flex mainProducts">
                ` + htmlX + `
                  <div class="` + otherPart + ` mainContentProductsDetailsArea">
                      <div class="d-flex mainContentTitle">
                          <span onclick="goInLinkFuc(this)" name="`+ productDetails.productLink + `">` + productDetails.productName + `</span>
                      </div>
                      <div class="mainContentText" onclick="goInLinkFuc(this)" name="`+ productDetails.productLink + `">` + productDetails.productText + `</div>
                    <div class="d-flex text-muted">
                      <div style="font-size:20px;">` +  productDetails.productPrice +` ₺</div>
                      <div class="ml-auto">` + fullDay + "-" + fullMonth + "-" + fullYear + `</div>
                    </div>
                  </div>
              </div>
            `;
          $(".mainProductArea").append(html);

        });
      }
    }
  });
}
function menuActive(node) {

  var Language = detectedLanguage();
  var html, otherPart, htmlX;
  var dateFormat, fullDay, fullMonth, fullYear;
  var CategoryID = $(node).attr("name");
  $.post(baseurl + "/SoftPHP/getProductsForCategory", { CategoryID: CategoryID,  Language: Language}, function (data) {
    console.log(data);
    $(".mainProductArea").children("div").remove();
    if ((data.length > 0) && (data != "Not Found")) {
      $.each(data, function (key, val) {
        dataSplitThree = key;
        productDetails = val.productDetails;
        productImg     = productDetails.productImg;
        if(productImg != ""){
          htmlX = `
            <div class="col-3 p-2 mainProductsImgArea" onclick="goInLinkFuc(this)" name="`+ productDetails.productLink + `">
              <img class="mainProductsImg" src="`+ baseurl + `/img/productImg/` + productDetails.productImg + `">
            </div>
          `;
          otherPart = "col-9";
          
        }else{
          htmlX = "";
          otherPart = "col-12";
        }
        dateFormat = new Date(parseInt(productDetails.productCreateDate) * 1000);
        fullYear   = dateFormat.getFullYear();
        fullMonth  = dateFormat.getMonth()+1;
        fullDay    = dateFormat.getDate();

        if(fullMonth < 10){
          fullMonth = "0" + fullMonth;
        }
        if(fullDay < 10){
          fullDay = "0" + fullDay;
        }
        html = `
              <div class="d-flex mainProducts">
              ` + htmlX + `
                <div class="` + otherPart + ` mainContentProductsDetailsArea">
                    <div class="d-flex mainContentTitle">
                        <span onclick="goInLinkFuc(this)" name="`+ productDetails.productLink + `">` + productDetails.productName + `</span>
                    </div>
                    <div class="mainContentText" onclick="goInLinkFuc(this)" name="`+ productDetails.productLink + `">` + productDetails.productText + `</div>
                    <div class="d-flex text-muted">
                      <div style="font-size:20px;">` +  productDetails.productPrice +` ₺</div>
                      <div class="ml-auto">` + fullDay + "-" + fullMonth + "-" + fullYear + `</div>
                    </div>
                </div>
            </div>
          `;
        $(".mainProductArea").append(html);

      });
    }else{
      html = `
        <div class="d-flex mainProducts">
            <span class="mx-auto" style="font-size: 25px;">Ürün Bulunamadı</span>
        </div>
      `;
      $(".mainProductArea").append(html);
    }
  });
}
/* Carousel */

function leftGoCarousel() {
  var topCategoryLeft = parseInt($(".topCategoryInArea").scrollLeft());
  var categoryWidth = parseInt($(".topCategoryMenuArea").width());
  $(".topCategoryInArea").stop().animate({ scrollLeft: topCategoryLeft - categoryWidth }, 500, 'swing');

}
function rightGoCarousel() {
  var topCategoryLeft = parseInt($(".topCategoryInArea").scrollLeft());
  var categoryWidth = parseInt($(".topCategoryMenuArea").width());
  $(".topCategoryInArea").stop().animate({ scrollLeft: topCategoryLeft + categoryWidth }, 500, 'swing');
}