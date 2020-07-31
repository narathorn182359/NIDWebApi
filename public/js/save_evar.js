$(document).ready(function () {
  $.ajaxSetup({
    headers: {
      "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
    }
  });

  $("#form-saveevar").submit(function (e) {
    e.preventDefault();
    $("#overlay").show();
    var cartscore = [];
    var scores = document.querySelectorAll(
      "#form-saveevar input[type=radio]:checked"
    );
    for (var j = 0, score; (score = scores[j++]); ) {
      var getvaluescore = {};
      var number_s = $(this).data();
      getvaluescore.score = score.value;
      getvaluescore.number = score.getAttribute("name");
      cartscore.push(getvaluescore);
    }
    var remark = document.querySelector("textarea[name=remark]").value;
    var assessor = document.querySelector("input[name=assessor]").value;
    var assessed = document.querySelector("input[name=assessed]").value;
    var pass = document.querySelector("input[name=pass]").value;
    var degree   = document.querySelector("input[name=degree]").value;
    $.ajax({
      type: "POST",
      data: {
        evar: cartscore,
        remark: remark,
        assessor:assessor,
        assessed:assessed,
        pass:pass,
        degree:degree
      },
      url: "/save_evar6090",
      success: function (data) {
     
        Swal.fire({
            icon: "success",
            title: "บันทึกสำเร็จ่ะ",
            text: "หากสงสัยกรุณาติดต่อฝ่ายบุคคล",
            confirmButtonText: "ตกลง"
          }).then(function () {
            window.location.href = "/index_userassessor/"+assessor;
          
        });
        
      },
      error: function (data) {
        Swal.fire({
          icon: "error",
          title: "ผิดพลาด",
          text: "ไม่สามารถบันทึกได้",
          confirmButtonText: "ตกลง"
        });
      }
    });
  });
});



