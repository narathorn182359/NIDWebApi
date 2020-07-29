$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
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
            cancelButtonText: "ยกเลิก",
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    type: "POST",
                    data: {
                        name: name,
                        assessor:assessor,
                        assessed:assessed
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
            cancelButtonText: "ยกเลิก",
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    type: "POST",
                    data: {
                        name: name,
                        assessor:assessor,
                        assessed:assessed
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




})