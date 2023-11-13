if controlSequence != sequence
  game_end()

nextrequest = false
sequencePosition++
if sequencePosition == sequenceLength-1 {
  //fix first fig at next seq
  sequence = string_char_at(sequence, sequencePosition) + nextSequence
  sequencePosition = 0
  controlSequence = sequence
  //regen next seq
  for (i=0; i<sequenceLength; i++)
    nextSequence+= string_char_at(allowedFigures, irandom(string_length(allowedFigures)))
  }
  
//generate figure
currRot = 0
currX = 5
if period < 150
    currH = -1
else
    currH = 0
currFig = string_char_at(sequence, sequencePosition)
nextFig = string_char_at(sequence, sequencePosition+1)
delay = period
usedSpareDelay = false
ts = current_time
switch currFig {
  case "I":
    dry = 0
    currH = 0
    currClr = c_white
      fh[0] = 2 -2
      fx[0] = 0 -2
      fh[1] = 2 -2
      fx[1] = 1 -2
      fh[2] = 2 -2
      fx[2] = 2 -2
      fh[3] = 2 -2
      fx[3] = 3 -2
    break
  case "S":
    dry++
    currClr = make_color_hsv(42+clmod,255,255)
      fh[0] = 3 -2
      fx[0] = 1 -2
      fh[1] = 3 -2
      fx[1] = 2 -2
      fh[2] = 2 -2
      fx[2] = 2 -2
      fh[3] = 2 -2
      fx[3] = 3 -2
    break
  case "Z":
    dry++
    currClr = make_color_hsv(213+clmod,255,255)
      fh[0] = 2 -2
      fx[0] = 1 -2
      fh[1] = 2 -2
      fx[1] = 2 -2
      fh[2] = 3 -2
      fx[2] = 2 -2
      fh[3] = 3 -2
      fx[3] = 3 -2
    break
  case "O":
    dry++
    currClr = make_color_hsv(128+clmod,255,255)
    fh[0] = 2 -2
    fx[0] = 1 -2
    fh[1] = 2 -2
    fx[1] = 2 -2
    fh[2] = 3 -2
    fx[2] = 1 -2
    fh[3] = 3 -2
    fx[3] = 2 -2
    break
  case "T":
    dry++
    currClr = make_color_hsv(clmod, 255,255)
      fh[0] = 2 -2
      fx[0] = 1 -2
      fh[1] = 2 -2
      fx[1] = 2 -2
      fh[2] = 2 -2
      fx[2] = 3 -2
      fh[3] = 3 -2
      fx[3] = 2 -2
    break
  case "L":
    dry++
    currClr = make_color_hsv(85+clmod, 255,255)
      fh[0] = 3 -2
      fx[0] = 1 -2
      fh[1] = 2 -2
      fx[1] = 1 -2
      fh[2] = 2 -2
      fx[2] = 2 -2
      fh[3] = 2 -2
      fx[3] = 3 -2
    break
  case "J":
    dry++
    currClr = make_color_hsv(170+clmod,255,255)
      fh[0] = 2 -2
      fx[0] = 1 -2
      fh[1] = 2 -2
      fx[1] = 2 -2
      fh[2] = 2 -2
      fx[2] = 3 -2
      fh[3] = 3 -2
      fx[3] = 3 -2
  }
if dry > maxdry
  maxdry = dry
  
//check gameover state
for (var i=0; i<4; i++) {
  if fh[i]+currH >= 0
    if arr[fh[i]+currH, fx[i]+currX] != 0 {
      oGlassGameover()
      break
      }
  }
  
softdrop = false

if adapter != -1 {
  if firstFigureTrigger {
    firstFigureTrigger = false
    exit
    }
  buffer_seek(global.buffer, buffer_seek_start, 0);
  buffer_write(global.buffer, buffer_s8, 14)
  buffer_write(global.buffer, buffer_s8, currX)
  buffer_write(global.buffer, buffer_s8, currH)
  buffer_write(global.buffer, buffer_s8, fx[0])
  buffer_write(global.buffer, buffer_s8, fx[1])
  buffer_write(global.buffer, buffer_s8, fx[2])
  buffer_write(global.buffer, buffer_s8, fx[3])
  buffer_write(global.buffer, buffer_s8, fh[0])
  buffer_write(global.buffer, buffer_s8, fh[1])
  buffer_write(global.buffer, buffer_s8, fh[2])
  buffer_write(global.buffer, buffer_s8, fh[3])
  buffer_write(global.buffer, buffer_u32, currClr)
  buffer_write(global.buffer, buffer_bool, gameover)
  network_send_packet( global.botnet, global.buffer, buffer_tell(global.buffer) );
  }
