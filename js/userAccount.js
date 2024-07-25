document
  .getElementById("userInformationForm")
  .addEventListener("submit", function (event) {
    event.preventDefault();
    // Formdaki verileri al
    var formData = new FormData(document.getElementById("userInformationForm"));
    $.ajax({
      type: "POST",
      url:  baseurl + "/save-user-data",
      data: formData,
      processData: false, // veriyi işlemek için jQuery'ye izin ver
      contentType: false, // gönderim veri tipi belirtilmediğinde jQuery tarafından otomatik olarak ayarlanır
      success: function (response) {
        // console.log(response);
      },
      error: function (xhr, status, error) {
        // console.error(xhr.responseText);
      },
    });
  });

// Tüm formları seçiyoruz
var forms = document.querySelectorAll("[id^='userAddressForm-']");

// Her bir forma tıklama olayı ekliyoruz
forms.forEach(function (form) {
  form.addEventListener("submit", function (event) {
    event.preventDefault();
    var formId = this.id;

    // Formun ID'sini '-' karakterinden böleriz ve sağdaki değeri alırız
    var addressId = formId.split("-")[1];
    // Formdaki verileri al
    var formData = new FormData(this);
    $.ajax({
      type: "POST",
      url: "save-user-address-data/" + addressId,
      data: formData,
      processData: false, // veriyi işlemek için jQuery'ye izin ver
      contentType: false, // gönderim veri tipi belirtilmediğinde jQuery tarafından otomatik olarak ayarlanır
      success: function (response) {
        console.log(response);
      },
      error: function (xhr, status, error) {
        console.error(xhr.responseText);
      },
    });
  });
});
