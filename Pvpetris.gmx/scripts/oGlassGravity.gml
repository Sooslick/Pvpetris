var free = true
//check bottom
for (var i=0; i<4; i++)
  if fh[i]+currH+1 == 20 {
    free = false;
    break
    }
//check place exists
if free {
  for (var i=0; i<4; i++) {
    if fh[i]+currH+1 >= 0
      if arr[fh[i]+currH+1, fx[i]+currX] != 0 {
        free = false
        break
        }
    }
  }
  
if free {
  currH++
  if softdrop
    dropped++
  if adapter != -1 {
    buffer_seek(global.buffer, buffer_seek_start, 0);
    buffer_write(global.buffer, buffer_s8, 12)
    buffer_write(global.buffer, buffer_s8, currH)
    network_send_packet( global.botnet, global.buffer, buffer_tell(global.buffer) );
    }
  }
else {
  //samy pizdaty debug-costyl ever чтобы не было индехоф боундс ехептиона
  var costyl = -1
  for (var i=0; i<4; i++)
    if fh[i] + currH >= 0 {
      costyl = i
      break
      }
  for (var i=0; i<4; i++)
    if fh[i] + currH < 0 {
      fh[i] = fh[costyl]
      fx[i] = fx[costyl]
      }
  //lock current figure
  for (var i=0; i<4; i++)
    arr[fh[i]+currH, fx[i]+currX] = currClr
  //check lines to burn
  burn = 0
  burnList = 0
  for (var i=0; i<4; i++) {
    var add = true
    for (var j=0; j<burn; j++) {
      if fh[i]+currH == burnList[j] {
        add = false
        break
        }
      }
    if add {
      var verify = true
      for (var j=0; j<10; j++)
        if arr[fh[i]+currH,j] == 0 {    //todo bugfix
          verify = false
          break
          }
      if verify {
        burnList[burn] = fh[i]+currH
        burn++
        }
      }
    }
  currH = -2
  //sort droplines
  if burn > 1 {
    for (var j=0; j<3; j++)
      for (var i=0; i<burn-1; i++)
        if burnList[i] > burnList[i+1] {
          var ext = burnList[i];
          burnList[i] = burnList[i+1]
          burnList[i+1] = ext
          }
    }
  //recalc control before burn  
  if (lines + ttrlines + pp != control)
    game_end()
  //count pointes for dropped tiles
  pp+= dropped + level
  //burn lines
  if burn > 0 {
    lines+= burn
    if burn == 4 {
      tetrisanim = true
      ttrlines+= 4
      }
    ttrpercent = floor(ttrlines / lines * 100)
    if lines >= (level+1)*10 {
      level++
      period = 1000/level
      clmod = level*8
      }
    pp+= floor(burn*burn*100*(level+1))
    lineanim = true
    }
  else {
    nextrequest = true
    delay = 200
    }
  softdrop = false
  dropped = 0
  //recalc control
  control = lines + ttrlines + pp
  //send events
  if adapter != -1 {
    buffer_seek(global.buffer, buffer_seek_start, 0);
    buffer_write(global.buffer, buffer_s8, 15)
    buffer_write(global.buffer, buffer_s32, pp)
    buffer_write(global.buffer, buffer_s16, lines)
    buffer_write(global.buffer, buffer_s8, ttrpercent)
    buffer_write(global.buffer, buffer_s8, level)
    network_send_packet( global.botnet, global.buffer, buffer_tell(global.buffer) );
    }
  }

