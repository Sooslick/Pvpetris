var i;
var j;
var clb;
var r;
var g;
var b;
i = buffer_read(msg_buff, buffer_u8)
while(i != 255) {
  j = buffer_read(msg_buff, buffer_u8)
  clb = buffer_read(msg_buff, buffer_u8)
  r = ((clb >> 5) & $07) * 32 + 31
  g = ((clb >> 3) & $03) * 64 + 63
  b = (clb & $07) * 32 + 31
  arr[i,j] = make_color_rgb(r, g, b)
  i = buffer_read(msg_buff, buffer_u8)
  }

