var currentLang = $("html").attr("lang");

$(".lang-group input[input-lang=" + currentLang + "]").attr("type", "text");
$(".lang-group div[input-lang=" + currentLang + "]").css("display", "");
$(".lang-group span[input-lang=" + currentLang + "]").css("display", "");
$(".dropdown-menu button[data-lang=" + currentLang + "]").addClass("active");

function setLang(lang = null) {
    lang = lang === null ? currentLang : lang;
    $(".lang-group input[input-lang=" + currentLang + "]").attr(
        "type",
        "hidden"
    );
    $(".lang-group input[input-lang=" + lang + "]").attr("type", "text");
    $(".lang-group div[input-lang=" + currentLang + "]").css("display", "none");
    $(".lang-group div[input-lang=" + lang + "]").css("display", "");
    $(".lang-group span[input-lang=" + currentLang + "]").css(
        "display",
        "none"
    );
    $(".lang-group span[input-lang=" + lang + "]").css("display", "");
    $(".dropdown-menu button[data-lang=" + currentLang + "]").removeClass(
        "active"
    );
    currentLang = lang;
}

$(function () {
    $(".dropdown-menu button").click(function () {
        $(this).addClass("active");
        $(".lang-toggle i").removeClass();
        $(".lang-toggle i").addClass(
            "flag-icon flag-icon-" + $(this).data("flag")
        );
        setLang($(this).data("lang"));
    });
});
