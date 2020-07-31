$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });

    $("#get_data_user_6090").DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: "/get_data_username_6090",
            dataType: "json",
            type: "POST",
            data: { _token: $("#token").val() },
        },
        columns: [
            { data: "Code_Staff" },
            { data: "Name_Thai" },
            { data: "Position" },
            { data: "Department" },
            { data: "options" },
        ],
    });


    $("#get_data_userset_6090").DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: "/get_data_userset_6090",
            dataType: "json",
            type: "POST",
            data: { _token: $("#token").val() },
        },
        columns: [
            { data: "assessor" },
            { data: "assessed" },
            { data: "option_eva" },
            { data: "status_eva" },
            { data: "options" },
        ],
    });

    $("body").on("click", ".addusername", function () {
        var assessor = $(this).data("id");
        $("#form-addusername").trigger("reset");
        $("#assessor").val(assessor);
        $("#modal-set6090").modal("show");
     
    });

    $("#form-addusername").submit(function (e) {
        e.preventDefault();
        $.ajax({
            type: "POST",
            data: $("#form-addusername").serialize(),
            url: "save_datasetevalu6090",
            success: function (data) {
              if(data == "200"){
                Swal.fire(
                    "บันทึกสำเร็จสำเร็จ!",
                    "",
                    "success"
                ).then(function () {
                    $('#get_data_userset_6090').DataTable().draw();
                    $("#modal-set6090").modal('toggle'); 
                });
              }else{
                Swal.fire(
                    "[บันทึกซ้ำค่ะ]!",
                    "",
                    "warning"
                )
              }
                
            },
            error: function (data) {
                Swal.fire({
                    icon: "error",
                    title: "ผิดพลาด",
                    text: "ไม่สามารถบันทึกได้",
                    confirmButtonText: "ตกลง",
                });
            },
        });
    });

    $("body").on("click", ".Edituser", function () {
        var id = $(this).data("id");
        $("#id").val(id);
        $.getJSON("/get_uername", { id: id }, function (data) {
            $("#modal-username").modal("show");
            $("#headText").html("แก้ไขผู้ใช้");
            $("#usernameText").val(data.Card_Staff);
            $("#nameText").val(data.Name_Thai);
            $("#factionText").val(data.Faction);
            $("#departmentText").val(data.Department);
            $("#positionText").val(data.Position);
            $("#companyText").val(data.Company);

            console.log(data);
        });
    });
});





$("body").on("click", ".deleteEva", function () {
    var id = $(this).data("id");
    //confirm("Are You sure want to delete !");
    Swal.fire({
        title: "ยืนยันการการต่อทดลองงานใหม่",
        text: "กรุณาตรวจสอบก่อนยืนยัน!",
        icon: "info",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "ตกลง",
        cancelButtonText: "ยกเลิก",
    }).then((result) => {
        if (result.value) {
            $.ajax({
                type: "POST",
                data: {
                    id: id,
                },
                url: "/delete_userset_6090",
                success: function (data) {
                    Swal.fire(
                        "สำเร็จ!",
                        "หากสงสัยข้อมูลกรุณาติดต่อทีมพัฒนา",
                        "success"
                    ).then(function () {
                        $('#get_data_userset_6090').DataTable().draw();
                      
                    });
                },
                error: function (data) {
                    Swal.fire({
                        icon: "error",
                        title: "ผิดพลาด",
                        text: "ไม่สามารถลบได้กรุณาติดต่อทีมพัฒนา",
                        confirmButtonText: "ตกลง",
                    });
                },
            });
        }
    });
});

$("body").on("click", ".save_eva90", function () {
    var assessor60 = $(this).data("assessor60");
    var assessed60 = $(this).data("assessed60");
    $("#assessor60").val(assessor60);
    $("#assessed60").val(assessed60);
    $("#form-add90").trigger("reset");
    $("#modal-set90").modal("show");
 
});


$("#form-add90").submit(function (e) {
    e.preventDefault();
    var  assessor60 = document.querySelector("input[name=assessor60]").value;
    var  assessed60 = document.querySelector("input[name=assessed60]").value;
    var  assessor90 = document.querySelector("select[name=assessor90]").value;
    $.ajax({
        type: "POST",
        data:  {
            assessor60:assessor60,
            assessed60:assessed60,
            assessor90:assessor90

        },
        url: "save_eva90",
        success: function (data) {
            Swal.fire({
                icon: "success",
                title: "สำเร็จ",
                text: "บันทึกสำเร็จ",
                confirmButtonText: "ตกลง",
            });
            $("#modal-set90").modal('toggle'); 
        },
        error: function (data) {
            Swal.fire({
                icon: "error",
                title: "ผิดพลาด",
                text: "ไม่สามารถบันทึกได้",
                confirmButtonText: "ตกลง",
            });
        },
    });
});


$("body").on("click", ".s0", function () {
    var name = $(this).data("name");
    var assessor60 = $(this).data("assessor60");
    var assessed90 = $(this).data("assessed90");
    //confirm("Are You sure want to delete !");
    Swal.fire({
        title: "ยืนยันการกำหนดข้อมูลแบบตัวเลือก",
        text: "กรุณาตรวจสอบก่อนยืนยัน!",
        icon: "info",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "ตกลง",
        cancelButtonText: "ยกเลิก",
    }).then((result) => {
        if (result.value) {
            $.ajax({
                type: "POST",
                data: {
                    assessor:assessor60,
                    assessed:assessed90
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
                        confirmButtonText: "ตกลง",
                    });
                },
            });
        }
    });
});




$("body").on("click", ".enable90", function () {
    var id = $(this).data("id");
    
    //confirm("Are You sure want to delete !");
    Swal.fire({
        title: "ยืนยันการประเมินเปิดประเมิน",
        text: "กรุณาตรวจสอบก่อนยืนยัน!",
        icon: "info",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "ตกลง",
        cancelButtonText: "ยกเลิก",
    }).then((result) => {
        if (result.value) {
            $.ajax({
                type: "POST",
                data: {
                    id: id,
                },
                url: "/enable90",
                success: function (data) {
                    Swal.fire(
                        "สำเร็จ!",
                        "ระบบได้ทำการแจ้งเตื่อนให้แก่ผู้ประเมินแล้ว",
                        "success"
                    ).then(function () {
                        $('#get_data_userset_6090').DataTable().draw();
                      
                    });
                },
                error: function (data) {
                    Swal.fire({
                        icon: "error",
                        title: "ผิดพลาด",
                        text: "ระบบขัดข้อง",
                        confirmButtonText: "ตกลง",
                    });
                },
            });
        }
    });
  });