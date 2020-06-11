var str = environment_get_variable("APPDATA"); 
var a;
var aind = 0;
var s = ''
for (var i=1; i<= string_length(str); i++) {
  if (string_char_at(str,i) == "/") || (string_char_at(str,i) == "\") {
    a[aind] = s;
    aind++
    s = ''
    }
  else
    s+= string_char_at(str,i)
  }
if string_length(s) > 0 {
  a[aind] = s
  aind++
  }
if aind <= 2
  return "Guy"
if a[2] == ''
  return "Guy"
  
var user = a[2]
var value = ''
var minchar = 66666
var maxchar = 0
for (var i=1; i<=string_length(user); i++) {
  var c = ord(string_char_at(user, i))
  if c > maxchar
    maxchar = c
  if c < minchar
    minchar = c
  }
  
var range = maxchar - minchar
if maxchar < 256 {
  return user
  }
else if (range <= 64) && (minchar > 127) {
  //shift
  var shift = minchar - 65
  for (var i=1; i<=string_length(user); i++) {
    value+= chr(ord(string_char_at(user, i)) - shift)
    }
  }
else {
  //normalize
  for (var i=1; i<=string_length(user); i++) {
    var c = ord(string_char_at(user, i))
    if (c > 32) && (c < 256) {
      value+= chr(c)
      }
    else if (c <= 32) {
      value+= '?'
      }
    else {
      value+= chr((c mod 64) + 65)
      }
    }
  }

return value
