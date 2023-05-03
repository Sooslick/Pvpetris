var jumpFinal = 20
for (var i=0; i<4; i++) {
  // search max possible jump for entire figure
  var jumpTemp = 0
  while (++jumpTemp <= 20) {
    if fh[i]+currH + jumpTemp < 0
      continue
    if fh[i]+currH + jumpTemp >= 20 || arr[fh[i]+currH + jumpTemp, fx[i]+currX] != 0 {
      if (--jumpTemp < jumpFinal)
        jumpFinal = jumpTemp
      break
    }
  }
}
dropped+= jumpFinal
currH+= jumpFinal
if adapter != -1 {
  buffer_seek(global.buffer, buffer_seek_start, 0);
  buffer_write(global.buffer, buffer_s8, 12)
  buffer_write(global.buffer, buffer_s8, currH)
  network_send_packet(global.botnet, global.buffer, buffer_tell(global.buffer));
}
oGlassGravity()
