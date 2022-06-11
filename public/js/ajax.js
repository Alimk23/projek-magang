$(function () {
    $(".btnDelCS").on("click", function () {
        const id = $(this).data("id");
        $.ajax({
            url: "http://hobisedekah.herokuapp.com/customer-service/getCSInfo",
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
