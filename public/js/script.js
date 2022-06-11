//show receiver bank info
$(function () {
    $(".btnReceiverInfo").on("click", function () {
        const id = $(this).data("id");
        $.ajax({
            url: "http://hobisedekah.herokuapp.com/payment/getReceiverInfo",
            data: { id: id },
            method: "get",
            dataType: "json",
            success: function (data) {
                $("#showBankName").val(data.bank_name);
                $("#showBankAccount").val(data.bank_account);
                $("#showAlias").val(data.alias);
            },
        });
    });
});
//show payment bank info
$(function () {
    $(".btnPaymentInfo").on("click", function () {
        const id = $(this).data("id");
        $.ajax({
            url: "http://hobisedekah.herokuapp.com/payment/getPaymentInfo",
            data: { id: id },
            method: "get",
            dataType: "json",
            success: function (data) {
                $("#receiptPreview").attr(
                    "src",
                    "http://hobisedekah.herokuapp.com/storage/" + data.receipt
                );
                $("#receiptShow").attr(
                    "href",
                    "http://hobisedekah.herokuapp.com/storage/" + data.receipt
                );
            },
        });
    });
});
//edit login info
$(function () {
    $(".editLoginInfo").on("click", function () {
        const id = $(this).data("id");
        $.ajax({
            url: "http://hobisedekah.herokuapp.com/user-data/getLoginInfo",
            data: { id: id },
            method: "get",
            dataType: "json",
            success: function (data) {
                $("#editName").val(data.name);
                $("#editEmail").val(data.email);
                $("#editPhone").val(data.phone);
            },
        });
    });
});
//edit profile info
$(function () {
    $(".editProfileInfo").on("click", function () {
        const id = $(this).data("id");
        $.ajax({
            url: "http://hobisedekah.herokuapp.com/user-data/getProfileInfo",
            data: { id: id },
            method: "get",
            dataType: "json",
            success: function (data) {
                $("#editAddress").val(data.address);
                $("#editPhoto").val(
                    "http://hobisedekah.herokuapp.com/storage/" + data.photo
                );
            },
        });
    });
});
//edit company info
$(function () {
    $(".editCompanyInfo").on("click", function () {
        const id = $(this).data("id");
        $.ajax({
            url: "http://hobisedekah.herokuapp.com/user-data/getCompanyInfo",
            data: { id: id },
            method: "get",
            dataType: "json",
            success: function (data) {
                $("#editCompanyName").val(data.company_name);
                $("#editJobTitle").val(data.job_title);
            },
        });
    });
});

//show caption info
$(function () {
    $(".btnCaptionInfo").on("click", function () {
        const id = $(this).data("id");
        $.ajax({
            url: "http://hobisedekah.herokuapp.com/campaign/getCampaignInfo",
            data: { id: id },
            method: "get",
            dataType: "json",
            success: function (data) {
                $("#showCaption").val(data.caption);
            },
        });
    });
});
//show description info
$(function () {
    $(".btnWdDesc").on("click", function () {
        const id = $(this).data("id");
        $.ajax({
            url:
                "http://hobisedekah.herokuapp.com/user-data/withdraw/getWithdrawInfo",
            data: { id: id },
            method: "get",
            dataType: "json",
            success: function (data) {
                $("#showDescriptionWd").val(data.description);
            },
        });
    });
});

//show customer service info
$(function () {
    $(".btnDeleteCS").on("click", function () {
        const id = $(this).data("id");
        $.ajax({
            url: "http://hobisedekah.herokuapp.com/customer-service/getCSInfo",
            data: { id: id },
            method: "get",
            dataType: "json",
            success: function (data) {
                $("#formDeleteCS").attr(
                    "action",
                    "/admin/customer-service/" + data.id
                );
                $("#deleteCSId").attr(
                    "href",
                    "/admin/customer-service/" + data.id
                );
            },
        });
    });
});
