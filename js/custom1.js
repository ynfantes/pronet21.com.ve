// Navigation Menu
$('ul.mainmenucontain li').hover(
        function() {
            $(this).children('div').css('display', 'table')
        },
        function() {
            $(this).children('div').css('display', 'none')
        }
);

// Main Menu mobile
$("<select />").appendTo(".menurelative");

// Create default option "Go to..."
$("<option />", {
    "selected": "selected",
    "value": "",
    "text": "Ir a..."
}).appendTo("nav.subnav select");

// Populate dropdown with menu items
$("nav.subnav a[href]").each(function() {
    var el = $(this);
    $("<option />", {
        "value": el.attr("href"),
        "text": el.text()
    }).appendTo("nav.subnav select");
});

// To make dropdown actually work
$("nav.subnav select").change(function() {
    window.location = $(this).find("option:selected").val();
});
// Twitter
$("#twitter").tweet({
    join_text: "auto",
    username: "pronet21", //replace this with your username
    modpath: '../twitter/',
    avatar_size: 32,
    count: 3,
    auto_join_text_default: "dijimos,",
    auto_join_text_ed: "nosotros",
    auto_join_text_ing: "estabamos",
    auto_join_text_reply: "respondimos",
    auto_join_text_url: "chequea,",
    loading_text: "cargando tuits..."
});