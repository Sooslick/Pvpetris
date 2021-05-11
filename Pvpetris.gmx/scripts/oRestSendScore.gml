if (control != lines + ttrlines + pp + controlAdd)
    exit

var saltp1 = "SlightlyLoosened"
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
var hash = sha1_string_utf8(nik+points+saltp1+string(global.vlong)+"BOOM!! Tetris for Jeff!")
var hashparam = "hash="
nik = string_replace_all(nik, "&", "%26")
nik = string_replace_all(nik, "?", "%3F")
var domain = global.domain + global.restScore
var request = "?" + nikparam + nik
            + "&" + pointsparam + points
            + "&" + burnparam + burn
            + "&" + startparam + start
            + "&" + ttrlparam + ttrl
            + "&" + hashparam + hash
http_get(domain+request)
