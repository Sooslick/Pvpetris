var nik = global.plleft
var nikparam = "name="
var points = string(pp)
var pointsparam = "score="
var burn = string(lines)
var burnparam = "burn="
var start = global.level
var startparam = "startlevel="
var ttrl = string(ttrlines)
var ttrlparam = "ttr="
var hash = sha1_string_utf8(nik+points+"BOOM!! Tetris for Jeff!")
var hashparam = "hash="
nik = string_replace_all(nik, "&", "%26")
nik = string_replace_all(nik, "?", "%3F")
var domain = global.domain + "pvpetris/rest.php"
var request = "?" + nikparam + nik
            + "&" + pointsparam + points
            + "&" + burnparam + burn
            + "&" + startparam + start
            + "&" + ttrlparam + ttrl
            + "&" + hashparam + hash
http_get(domain+request)
