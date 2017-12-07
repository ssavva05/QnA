$(document).ready(function () {
    "use strict";
    $("#submit").click(function () {

        var myenrollkey = $("#myenrollkey").val();
//alert (myenrollkey);
        if ((myenrollkey === "")) {
            $("#message").html("<div class=\"alert alert-danger alert-dismissable\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>Please enter an enrolment key</div>");
        } else {
            $.ajax({
                type: "POST",
                url: "checkenroll.php",
                data: "myenrollkey=" + myenrollkey,
                dataType: 'JSON',
                success: function (html) {
                    //console.log(html.response + ' ' + html.myenrollkey);
                    if (html.response === 'true') {
                        //location.assign("../index.php");
                       location.reload();
                        return html.myenrollkey;
                    } else {
                        $("#message").html(html.response);
                    }
                },
                error: function (textStatus, errorThrown) {
                    console.log(textStatus);
                    console.log(errorThrown);
                },
                beforeSend: function () {
                    $("#message").html("<p class='text-center'><img src='images/ajax-loader.gif'></p>");
                }
            });
        }
        return false;
    });
});
