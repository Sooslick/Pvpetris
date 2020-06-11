//write header
buffer_seek(global.buffer, buffer_seek_start, 0);
buffer_write(global.buffer, buffer_s8, 17)

with glass {
  for (var i=0; i<20; i++)
    for (var j=0; j<10; j++) {
      var cl = arr[i,j];
      if cl == 0
        continue
      var r = (cl div 65536 div 32) << 5;
      var g = (cl mod 65536 div 256 div 64) << 3;
      var b = cl mod 256 div 32;
      cl = r | g | b
      buffer_write(global.buffer, buffer_u8, i)
      buffer_write(global.buffer, buffer_u8, j)
      buffer_write(global.buffer, buffer_u8, cl)
      }
  }

//write tail
buffer_write(global.buffer, buffer_u8, 255)
network_send_packet( global.botnet, global.buffer, buffer_tell(global.buffer) );
