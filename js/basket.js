$(document).ready(function () {
  const baseurl = $("base").attr("href");

  $("[name='incCount']").on("click", function () {
    var productId = $(this).data("product-id");
    $.ajax({
      url: baseurl + "/" + "basket/decreaseProductCount",
      type: "POST",
      data: {
        productId: productId,
      },
      success: function (response) {
        if (response.success) {
          var newCount = response.new_count;
          var newPrice = response.new_price;
          var newTotalPrice = response.new_total_price;
          var newTotalProductCount = response.new_total_product_count;

          $(".product-count-" + productId).text(newCount);
          $(".total-product-price-" + productId).text(newCount * newPrice);
          $(".total-all-product-price").text(newTotalPrice);
          $(".total-all-product-count").text(newTotalProductCount);
        } else {
          alert(response.message);
        }
      },
      error: function () {
        alert("Error updating count.");
      },
    });
  });

  $("[name='decCount']").on("click", function () {
    var productId = $(this).data("product-id");
    $.ajax({
      url: baseurl + "/" + "basket/increaseProductCount",
      type: "POST",
      data: {
        productId: productId,
      },
      success: function (response) {
        var newTotalPrice = response.new_total_price;
        var newTotalProductCount = response.new_total_product_count;

        if (response.success) {
          var newCount = response.new_count;
          var newPrice = response.new_price;

          $(".product-count-" + productId).text(newCount);
          $(".total-product-price-" + productId).text(newCount * newPrice);
          $(".total-all-product-price").text(newTotalPrice);
          $(".total-all-product-count").text(newTotalProductCount);
        } else {
          $(".row-" + productId).remove();

          if (newTotalProductCount == 0) {
            ourPackages = baseurl + "/ourPackages";
            $(".table-responsive").remove();
            $(".basket-container").append(
              '<div class="alert alert-info"><strong>Sepetinizde ürün bulunmamaktadır. Eklemek için <a href="' +
                ourPackages +
                '">tıklayınız.</a></strong></div>'
            );
          }

          $(".total-all-product-price").text(newTotalPrice);
          $(".total-all-product-count").text(newTotalProductCount);
        }
      },
      error: function () {
        alert("Error updating count.");
      },
    });
  });

  $("[name='remove']").on("click", function () {
    var productId = $(this).data("product-id");
    $.ajax({
      url: baseurl + "/" + "basket/deleteProductFromBasket",
      type: "POST",
      data: {
        productId: productId,
      },
      success: function (response) {
        if (response.success) {
          $(".row-" + productId).remove();

          var newTotalProductCount = response.new_total_product_count;
          if (newTotalProductCount == 0) {
            ourPackages = baseurl + "/ourPackages";
            $(".table-responsive").remove();
            $(".basket-container").append(
              '<div class="alert alert-info"><strong>Sepetinizde ürün bulunmamaktadır. Eklemek için <a href="' +
                ourPackages +
                '">tıklayınız.</a></strong></div>'
            );
          }

          var newTotalPrice = response.new_total_price;

          $(".total-all-product-price").text(newTotalPrice);
          $(".total-all-product-count").text(newTotalProductCount);

          console.log("deleted successfully!");
        } else {
          console.log("Failed to update");
        }
      },
      error: function () {
        alert("Error updating count.");
      },
    });
  });

  $("[id='continue-shopping']").on("click", function () {
    window.location.href = baseurl + "/ourPackages";
  });

});