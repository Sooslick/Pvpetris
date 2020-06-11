dropped = 0
var nSt;
if argument0 < 0
  nSt = currRot-1
else 
  nSt = currRot+1
if nSt > 3
  nSt = 0
else if nSt < 0
  nSt = 3
  
//remap figure
var nfx;
var nfh;
switch currFig {
  case "I":
    switch nSt {
      case 0:
      case 2:
      nfh[0] = 2 -2
      nfx[0] = 0 -2
      nfh[1] = 2 -2
      nfx[1] = 1 -2
      nfh[2] = 2 -2
      nfx[2] = 2 -2
      nfh[3] = 2 -2
      nfx[3] = 3 -2
      break
      case 1:
      case 3:
      nfh[0] = 0 -2
      nfx[0] = 2 -2
      nfh[1] = 1 -2
      nfx[1] = 2 -2
      nfh[2] = 2 -2
      nfx[2] = 2 -2
      nfh[3] = 3 -2
      nfx[3] = 2 -2
      }
    break
  case "S":
    switch nSt {
      case 0:
      case 2:
      nfh[0] = 3 -2
      nfx[0] = 1 -2
      nfh[1] = 3 -2
      nfx[1] = 2 -2
      nfh[2] = 2 -2
      nfx[2] = 2 -2
      nfh[3] = 2 -2
      nfx[3] = 3 -2
      break
      case 1:
      case 3:
      nfh[0] = 1 -2
      nfx[0] = 2 -2
      nfh[1] = 2 -2
      nfx[1] = 2 -2
      nfh[2] = 2 -2
      nfx[2] = 3 -2
      nfh[3] = 3 -2
      nfx[3] = 3 -2
      }
    break
  case "Z":
    switch nSt {
      case 0:
      case 2:
      nfh[0] = 2 -2
      nfx[0] = 1 -2
      nfh[1] = 2 -2
      nfx[1] = 2 -2
      nfh[2] = 3 -2
      nfx[2] = 2 -2
      nfh[3] = 3 -2
      nfx[3] = 3 -2
      break
      case 1:
      case 3:
      nfh[0] = 1 -2
      nfx[0] = 3 -2
      nfh[1] = 2 -2
      nfx[1] = 3 -2
      nfh[2] = 2 -2
      nfx[2] = 2 -2
      nfh[3] = 3 -2
      nfx[3] = 2 -2
      }
    break
  case "O":
    nfh[0] = 2 -2
    nfx[0] = 1 -2
    nfh[1] = 2 -2
    nfx[1] = 2 -2
    nfh[2] = 3 -2
    nfx[2] = 1 -2
    nfh[3] = 3 -2
    nfx[3] = 2 -2
    break
  case "T":
    switch nSt {
      case 0:
      nfh[0] = 2 -2
      nfx[0] = 1 -2
      nfh[1] = 2 -2
      nfx[1] = 2 -2
      nfh[2] = 2 -2
      nfx[2] = 3 -2
      nfh[3] = 3 -2
      nfx[3] = 2 -2
      break
      case 1:
      nfh[0] = 2 -2
      nfx[0] = 1 -2
      nfh[1] = 2 -2
      nfx[1] = 2 -2
      nfh[2] = 1 -2
      nfx[2] = 2 -2
      nfh[3] = 3 -2
      nfx[3] = 2 -2
      break
      case 2:
      nfh[0] = 2 -2
      nfx[0] = 1 -2
      nfh[1] = 2 -2
      nfx[1] = 2 -2
      nfh[2] = 2 -2
      nfx[2] = 3 -2
      nfh[3] = 1 -2
      nfx[3] = 2 -2
      break
      case 3:
      nfh[0] = 3 -2
      nfx[0] = 2 -2
      nfh[1] = 2 -2
      nfx[1] = 2 -2
      nfh[2] = 2 -2
      nfx[2] = 3 -2
      nfh[3] = 1 -2
      nfx[3] = 2 -2
      }
    break
  case "L":
    switch nSt {
      case 0:
      nfh[0] = 3 -2
      nfx[0] = 1 -2
      nfh[1] = 2 -2
      nfx[1] = 1 -2
      nfh[2] = 2 -2
      nfx[2] = 2 -2
      nfh[3] = 2 -2
      nfx[3] = 3 -2
      break
      case 1:
      nfh[0] = 1 -2
      nfx[0] = 1 -2
      nfh[1] = 1 -2
      nfx[1] = 2 -2
      nfh[2] = 2 -2
      nfx[2] = 2 -2
      nfh[3] = 3 -2
      nfx[3] = 2 -2
      break
      case 2:
      nfh[0] = 1 -2
      nfx[0] = 3 -2
      nfh[1] = 2 -2
      nfx[1] = 1 -2
      nfh[2] = 2 -2
      nfx[2] = 2 -2
      nfh[3] = 2 -2
      nfx[3] = 3 -2
      break
      case 3:
      nfh[0] = 3 -2
      nfx[0] = 3 -2
      nfh[1] = 1 -2
      nfx[1] = 2 -2
      nfh[2] = 2 -2
      nfx[2] = 2 -2
      nfh[3] = 3 -2
      nfx[3] = 2 -2
      }
    break
  case "J":
    switch nSt {
      case 0:
      nfh[0] = 2 -2
      nfx[0] = 1 -2
      nfh[1] = 2 -2
      nfx[1] = 2 -2
      nfh[2] = 2 -2
      nfx[2] = 3 -2
      nfh[3] = 3 -2
      nfx[3] = 3 -2
      break
      case 1:
      nfh[0] = 1 -2
      nfx[0] = 2 -2
      nfh[1] = 2 -2
      nfx[1] = 2 -2
      nfh[2] = 3 -2
      nfx[2] = 2 -2
      nfh[3] = 3 -2
      nfx[3] = 1 -2
      break
      case 2:
      nfh[0] = 2 -2
      nfx[0] = 1 -2
      nfh[1] = 2 -2
      nfx[1] = 2 -2
      nfh[2] = 2 -2
      nfx[2] = 3 -2
      nfh[3] = 1 -2
      nfx[3] = 1 -2
      break
      case 3:
      nfh[0] = 1 -2
      nfx[0] = 3 -2
      nfh[1] = 1 -2
      nfx[1] = 2 -2
      nfh[2] = 2 -2
      nfx[2] = 2 -2
      nfh[3] = 3 -2
      nfx[3] = 2 -2
    }
  }
  
var free = true
//check walls
for (var i=0; i<4; i++)
  if (nfx[i]+currX < 0 || nfx[i]+currX >= 10) {
    free = false;
    break
    }
//check bottom
for (var i=0; i<4; i++)
  if (nfh[i]+currH >= 20) {
    free = false;
    break
    }
//check place exists
if free {
  for (var i=0; i<4; i++) {
    if nfh[i]+currH >= 0
      if arr[nfh[i]+currH, nfx[i]+currX] != 0 {
        free = false
        break
        }
    }
  }
if free {
  fx = nfx
  fh = nfh
  currRot = nSt
  if adapter != -1 {
    buffer_seek(global.buffer, buffer_seek_start, 0);
    buffer_write(global.buffer, buffer_s8, 13)
    buffer_write(global.buffer, buffer_s8, fx[0])
    buffer_write(global.buffer, buffer_s8, fx[1])
    buffer_write(global.buffer, buffer_s8, fx[2])
    buffer_write(global.buffer, buffer_s8, fx[3])
    buffer_write(global.buffer, buffer_s8, fh[0])
    buffer_write(global.buffer, buffer_s8, fh[1])
    buffer_write(global.buffer, buffer_s8, fh[2])
    buffer_write(global.buffer, buffer_s8, fh[3])
    network_send_packet( global.botnet, global.buffer, buffer_tell(global.buffer) );
    }
  }
