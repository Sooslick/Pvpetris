dropped = 0
var delta;
if argument0 < 0
  delta = -1
else
  delta = 1
  
var free = true
//check walls
for (var i=0; i<4; i++)
  if (fx[i]+currX+delta < 0 || fx[i]+currX+delta >= 10) {
    free = false;
    break
    }
//check place exists
if free {
  for (var i=0; i<4; i++) {
    if fh[i]+currH >= 0
      if arr[fh[i]+currH, fx[i]+currX+delta] != 0 {
        free = false
        break
        }
    }
  }
if free {
  currX+= delta
  if adapter != -1 {
    buffer_seek(global.buffer, buffer_seek_start, 0);
    buffer_write(global.buffer, buffer_s8, 11)
    buffer_write(global.buffer, buffer_s8, currX)
    network_send_packet( global.botnet, global.buffer, buffer_tell(global.buffer) );
    }
  return true
  }
return false
