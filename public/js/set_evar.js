$(document).ready(function () {
  $.ajaxSetup({
    headers: {
      "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
    }
  });

  $("body").on("click", ".select_1", function () {
    var name = $(this).data("name");
    var assessor = $(this).data("assessor");
    var assessed = $(this).data("assessed");
    //confirm("Are You sure want to delete !");
    Swal.fire({
      title: "ยืนยันการกำหนดข้อมูลแบบตัวเลือก",
      text: "กรุณาตรวจสอบก่อนยืนยัน!",
      icon: "info",
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonColor: "#d33",
      confirmButtonText: "ตกลง",
      cancelButtonText: "ยกเลิก"
    }).then(result => {
      if (result.value) {
        $.ajax({
          type: "POST",
          data: {
            name: name,
            assessor: assessor,
            assessed: assessed
          },
          url: "/save_select",
          success: function (data) {
            Swal.fire(
              "สำเร็จ!",
              "หากสงสัยข้อมูลกรุณาติดต่อทีมพัฒนา",
              "success"
            ).then(function () {
              location.reload();
            });
          },
          error: function (data) {
            Swal.fire({
              icon: "error",
              title: "ผิดพลาด",
              text: "ไม่สามารถลบได้กรุณาติดต่อทีมพัฒนา",
              confirmButtonText: "ตกลง"
            });
          }
        });
      }
    });
  });

  $("body").on("click", ".select_2", function () {
    var name = $(this).data("name");
    var assessor = $(this).data("assessor");
    var assessed = $(this).data("assessed");
    //confirm("Are You sure want to delete !");
    Swal.fire({
      title: "ยืนยันการกำหนดข้อมูลแบบกำหนดเอง",
      text: "กรุณาตรวจสอบก่อนยืนยัน!",
      icon: "info",
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonColor: "#d33",
      confirmButtonText: "ตกลง",
      cancelButtonText: "ยกเลิก"
    }).then(result => {
      if (result.value) {
        $.ajax({
          type: "POST",
          data: {
            name: name,
            assessor: assessor,
            assessed: assessed
          },
          url: "/save_select",
          success: function (data) {
            Swal.fire(
              "สำเร็จ!",
              "หากสงสัยข้อมูลกรุณาติดต่อทีมพัฒนา",
              "success"
            ).then(function () {
              location.reload();
            });
          },
          error: function (data) {
            Swal.fire({
              icon: "error",
              title: "ผิดพลาด",
              text: "ไม่สามารถลบได้กรุณาติดต่อทีมพัฒนา",
              confirmButtonText: "ตกลง"
            });
          }
        });
      }
    });
  });
});

$(document).ready(function () {
  var max_fields = 10;
  var wrapper = $(".container1");
  var add_button = $(".add_form_field");

  var x = 1;
  $(add_button).click(function (e) {
    e.preventDefault();
    if (x < max_fields) {
      x++;
      $(wrapper).append(
        '<div class="card card-danger"> <div class="card-header"> <h3 class="card-title">เป้าหมาย</h3> <div class="card-tools"> <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i> </div> </div> <div class="card-body"> <div class="row"> <div class="col-md-6"> <div class="form-group"> <label>ชื่อ KPI:</label> <input type="text" name="KPI[]" class="form-control" required placeholder="เช่น ยอดขาย"> </div> </div> <div class="col-md-6"> <div class="form-group"> <label>ลักษณะตัวชี้วัดผลงาน เพื่อใช้ในการคำนวณ:</label> <input type="text" name="performance_indicators[]" class="form-control" required placeholder="เช่น วัดยอดขาย , 3 Project "> </div> </div> </div> <div class="row"> <div class="col-md-6"> <div class="form-group"> <label>หน่วยนับ:</label> <select class="form-control" name="unit[]" required> <option value="">เลือก</option> <option value="%">%</option> <option value="N">N (หน่วย)</option> <option value="B">B (บาท)</option> </select> </div> </div> <div class="col-md-6"> <div class="form-group"> <label>น้ำหนัก (%):</label> <input type="number" name="weight[]" class="form-control" required> </div> </div> </div> <div class="row"> <div class="col-md-6"> <div class="form-group"> <label>เป้าหมาย 60 วัน:</label> <input type="number" name="target_60[]" class="form-control" required> </div> </div> <div class="col-md-6"> <div class="form-group"> <label>ทำได้:</label> <input type="number" name="seccess_60[]" class="form-control" required> </div> </div> </div> <hr> </div> <div class="card-footer"> </div> </div>'
      ); //add input box
    } else {
      alert("You Reached the limits");
    }
  });

  $(wrapper).on("click", ".delete", function (e) {
    e.preventDefault();
    $(this).parent("div").remove();
    x--;
  });
});

$("#form-kpi-manual").submit(function (e) {
  e.preventDefault();
  $("#overlay").show();
  var KPI = document.getElementsByName("KPI[]");
  var performance_indicators = document.getElementsByName(
    "performance_indicators[]"
  );
  var unit = document.getElementsByName("unit[]");
  var weight = document.getElementsByName("weight[]");
  var target_60 = document.getElementsByName("target_60[]");
  var seccess_60 = document.getElementsByName("seccess_60[]");

  var cartscore = [];
  for (var i = 0; i < KPI.length; i++) {
    var getvaluescore = {};
    getvaluescore.kpi = KPI[i].value;
    getvaluescore.performance_indicators = performance_indicators[i].value;
    getvaluescore.unit = unit[i].value;
    getvaluescore.weight = weight[i].value;
    getvaluescore.target_60 = target_60[i].value;
    getvaluescore.seccess_60 = seccess_60[i].value;
    cartscore.push(getvaluescore);
  }
  console.log(cartscore);

  $.ajax({
    type: "POST",
    data: {
      data: cartscore
    },
    url: "/kpi_manual",
    success: function (data) {
    
      Swal.fire({
        icon: "success",
        title: "ระบบได้รับข้อมูลแล้ว",
        text: "หากสงสัยกรุณาติดต่อฝ่ายบุคคล",
        confirmButtonText: "ตกลง"
      }).then(function () {
        $("#overlay").hide();


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

$(document).ready(function () {
  var maxField = 10; //Input fields increment limitation
  var addButton = $(".add_button"); //Add button selector
  var wrapper = $(".field_wrapper"); //Input field wrapper
  var fieldHTML =
    '<div><div class="card card-secondary"> <div class="card-header"> <h3 class="card-title">เป้าหมาย</h3> </div> <div class="card-body"> <div class="row"> <div class="col-md-6"> <div class="form-group"> <label>ชื่อ KPI:</label> <input type="text" name="KPI[]" class="form-control" required placeholder="เช่น ยอดขาย"> </div> </div> <div class="col-md-6"> <div class="form-group"> <label>ลักษณะตัวชี้วัดผลงาน เพื่อใช้ในการคำนวณ:</label> <input type="text" name="performance_indicators[]" class="form-control" required placeholder="เช่น วัดยอดขาย , 3 Project "> </div> </div> </div> <div class="row"> <div class="col-md-6"> <div class="form-group"> <label>หน่วยนับ:</label> <select class="form-control" name="unit[]" required> <option value="">เลือก</option> <option value="%">%</option> <option value="N">N (หน่วย)</option> <option value="B">B (บาท)</option> </select> </div> </div> <div class="col-md-6"> <div class="form-group"> <label>น้ำหนัก (%):</label> <input type="number" name="weight[]" class="form-control" required> </div> </div> </div> <div class="row"> <div class="col-md-6"> <div class="form-group"> <label>เป้าหมาย 60 วัน:</label> <input type="number" name="target_60[]" class="form-control" required> </div> </div> <div class="col-md-6"> <div class="form-group"> <label>ทำได้:</label> <input type="number" name="seccess_60[]" class="form-control" required> </div> </div> </div> <hr> </div> <a href="javascript:void(0);" class="remove_button btn btn-danger">ลบ</a></div></div>'; //New input field html
  var x = 1; //Initial field counter is 1

  //Once add button is clicked
  $(addButton).click(function () {
    //Check maximum number of input fields
    if (x < maxField) {
      x++; //Increment field counter
      $(wrapper).append(fieldHTML); //Add field html
    }else{
      Swal.fire(
        'หมายเหตุ!',
        'จำกัดสูงสุดได้แค่ 10 เป้าหมายต่อครั้งค่ะ',
        'warning'
      )
 
    }
  });

  //Once remove button is clicked
  $(wrapper).on("click", ".remove_button", function (e) {
    e.preventDefault();
    $(this).parent("div").remove(); //Remove field html
    x--; //Decrement field counter
  });
});
