    /* Admin Panel */

    function deleteStartAllOver() {
        var text = `
        Sayın kullanıcı, yapacağınız işlemin bir geri dönüşü olmayacaktır.
            Yapacağınız işleme devam etmek istediğinize emin misiniz ?`;
        if (confirm(text) == true) {
            $("form").attr("action", baseurl + "/Fpanel/Desk/allOverAdd_result");
            $("form").submit();
        }
    }
    function activeCategory(node){
        $("select[name='ProductID']").children("option").remove();
        var CategoryID = $(node).val();
        var html, productDetails;
        
        $.post(baseurl + "/SoftPHP/getProductsForCategory", { CategoryID: CategoryID }, function (data) {
            $.each(data, function (key, val) {
                productDetails = val.productDetails;
                html = `
                    <option value="` + productDetails.productId + `" >` + productDetails.productName + `</option>
                `;
                $("select[name='ProductID']").append(html);
            });
        });
    }
    function selectedCategoryPrice(node){
        var CategoryID   = $(node).attr("name");
        var CategoryName = $(node).text();
    
        $(".allDataArea").children().remove();
    
        var htmlX = "";
        var myHTML = `
            <h5> Ürünler </h5>
        `;
        $(".allDataArea").append(myHTML);
        
        if(CategoryID == "all"){
            var myLink = "getProducts";
        }else{
            var myLink = "getProductsForCategory";
        }
    
        $.post(baseurl + "/SoftPHP/" + myLink, { CategoryID: CategoryID }, function (data) {
            $.each(data, function (key, val) {
                productDetails = val.productDetails;
                htmlX = `
                    <div class="d-flex my-1">
                        <div class="mr-auto"><span class="text-muted">[ ` + CategoryName + ` ]</span> ` + productDetails.productName + `</div>
                        <div style="margin-left:auto">
                            <input type="text" name="product-`+ productDetails.productId + `" value="` + productDetails.productPrice + `">
                            <span> Tl</span>
                        </div>
                    </div>
                `;
                $(".allDataArea").append(htmlX);
            });
        });
    }
    
    function selectedProductPrice(node){
        var ProductID   = $(node).attr("name");
        var ProductName = $(node).text();
    
        $(".allDataArea").children().remove();
    
        var htmlX = "";
        var myHTML = `
            <h5> Ek Ürünler </h5>
        `;
        $(".allDataArea").append(myHTML);
        
        if(ProductID == "all"){
            var myLink = "getEProducts";
        }else{
            var myLink = "getEProductsForProduct";
        }
    
        $.post(baseurl + "/SoftPHP/" + myLink, { ProductID: ProductID }, function (data) {
            console.log(data);
            $.each(data, function (key, val) {
                eProductDetails = val.eProductDetails;
                htmlX = `
                    <div class="d-flex my-1">
                        <div class="mr-auto"><span class="text-muted">[ ` + ProductName + ` ]</span> ` + eProductDetails.eProductName + `</div>
                        <div style="margin-left:auto">
                            <input type="text" name="eProduct-`+ eProductDetails.eProductID + `" value="` + eProductDetails.eProductPrice + `">
                            <span> Tl</span>
                        </div>
                    </div>
                `;
                $(".allDataArea").append(htmlX);
            });
        });
    }