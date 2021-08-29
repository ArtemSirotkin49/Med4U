$(document).ready(function() {
    var pageNum = 1;
    $("#showMoreBtn").on("click", function() {
        pageNum += 1;
        $.ajax({
            type: "POST",
            url: "",
            data: {PAGE_NUM: pageNum},
            success: function(data) {
                var html = $(data);
                $("#container").append(html.find(".child")[0]);
            }
        })
    });
});