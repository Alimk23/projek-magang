$(function () {
    $(".btnDelCS").on("click", function () {
        const id = $(this).data("id");
        $.ajax({
            url: "http://localhost:8000/customer-service/getCSInfo",
            data: { id: id },
            method: "get",
            dataType: "json",
            success: function (data) {
                $("#formDelCS").attr(
                    "action",
                    "/admin/customer-service/" + data.id
                );
            },
        });
    });
});
