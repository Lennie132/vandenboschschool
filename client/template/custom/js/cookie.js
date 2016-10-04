$(document).ready(function() {
    var link = $('#cookie_link').val();
    if (link !== undefined) {
        printCookie(link);
    }
})
function printCookie(link) {
    $('body').append(
            '<div style="position: fixed;z-index: 999999;background: rgba(0, 0, 0, 0.67);width: 400px;bottom: 20px;left: 50%;margin-left: -200px;border-radius: 5px;-moz-border-radius: 5px;-webkit-border-radius: 5px;">\n\
                            <div style="padding: 15px;color: #FFF;" class="cookie_melding">Wij gebruiken \n\
                                <a style="color: #FFF;text-decoration: underline;" class="link" href="' + link + '">cookies</a> \n\
                                <a style="color: #FFF;background: #399023;border-radius: 5px;-moz-border-radius: 5px;-webkit-border-radius: 5px;padding: 8px;cursor: pointer;position: absolute;right: 6px;top: 6px;" class="sluitCookie" onclick="sluitCookie()">OK, Melding sluiten</a>\n\
                            </div>\n\
                        </div>');
}

function sluitCookie() {
    datum = new Date();
    datum.setFullYear(datum.getFullYear() + 10);
    console.log(datum);
    document.cookie = "sluitCookie=true; expires=" + datum + "; path=/";
    window.location.href = $(location).attr('href');
}