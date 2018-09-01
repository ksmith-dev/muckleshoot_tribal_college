$(document).ready(function()
{
    $("#all-tab").click(function()
    {
        $(this).addClass("active");

        $("#list-tab").removeClass("active");
        $("#paragraph-tab").removeClass("active");
        $("#contact-tab").removeClass("active");
        $("#img-tab").removeClass("active");

        $(".list-tool").removeClass("no-display");
        $(".paragraph").removeClass("no-display");
        $(".contact").removeClass("no-display");
        $(".img").removeClass("no-display");
    });

    $("#paragraph-tab").click(function()
    {
        $(this).addClass("active");

        $("#list-tab").removeClass("active");
        $("#contact-tab").removeClass("active");
        $("#img-tab").removeClass("active");

        $(".paragraph").removeClass("no-display");
        $(".list-tool").addClass("no-display");
        $(".contact").addClass("no-display");
        $(".img").addClass("no-display");
    });

    $("#list-tab").click(function()
    {
        $(this).addClass("active");

        $("#paragraph-tab").removeClass("active");
        $("#contact-tab").removeClass("active");
        $("#img-tab").removeClass("active");
        $("#all-tab").removeClass("active");

        $(".paragraph").addClass("no-display");
        $(".list-tool").removeClass("no-display");
        $(".contact").addClass("no-display");
        $(".img").addClass("no-display");
    });

    $("#contact-tab").click(function()
    {
        $(this).addClass("active");

        $("#list-tab").removeClass("active");
        $("#paragraph-tab").removeClass("active");
        $("#img-tab").removeClass("active");
        $("#all-tab").removeClass("active");

        $(".paragraph").addClass("no-display");
        $(".list-tool").addClass("no-display");
        $(".contact").removeClass("no-display");
        $(".img").addClass("no-display");
    });

    $("#img-tab").click(function()
    {
        $(this).addClass("active");

        $("#list-tab").removeClass("active");
        $("#paragraph-tab").removeClass("active");
        $("#contact-tab").removeClass("active");
        $("#all-tab").removeClass("active");

        $(".paragraph").addClass("no-display");
        $(".list-tool").addClass("no-display");
        $(".contact").addClass("no-display");
        $(".img").removeClass("no-display");
    });

    $('#super-user-modal').on('shown.bs.modal', function () {
        $('#super-user-info').onclick()
    })

    $('#program-example').on('shown.bs.modal', function () {
        $('#show-program-example').onclick()
    })
});
