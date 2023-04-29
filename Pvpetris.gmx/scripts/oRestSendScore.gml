if (control != lines + ttrlines + pp + controlAdd)
    exit

var nick = global.plleft
var points = string(pp)
var burn = string(lines)
var start = global.level
var ttrl = string(ttrlines)
// todo
var hash = sha1_string_utf8(
  nick + points + hashPrivate + string(global.vlong) + hashPublic)
nick = string_replace_all(nick, "&", "%26")
nick = string_replace_all(nick, "?", "%3F")
http_get(domain + global.restScore
            + "?name=" + nik
            + "&score=" + points
            + "&burn=" + burn
            + "&startlevel=" + start
            + "&ttr=" + ttrl
            + "&hash=" + hash
)
