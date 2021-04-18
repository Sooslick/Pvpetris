with argument0 {
    //selected X
    switch selected {
      case 0: case 1: case 2: case 3:
        sX1 = 0
        sX2 = 640
        break
      case 4: case 5: case 6: case 7: case 8:
        sX1 = 640
        sX2 = 1280
        break
      case 9:
        sX1 = 640
        sX2 = 960
        break
      case 10:
        sX1 = 960
        sX2 = 1280
      }
    //selected Y
    switch selected {
      case 0:
        sY1 = 0
        sY2 = 100
        break
      case 1: case 9: case 10:
        sY1 = 120
        sY2 = 200
        break
      case 2: case 4: case 7:
        sY1 = 200
        sY2 = 280
        break
      case 3: case 5: case 8:
        sY1 = 280
        sY2 = 360
        break
      case 6:
        sY1 = 360
        sY2 = 440
      }
      
    //hovered X
    switch hovered {
      case 0: case 1: case 2: case 3:
        hX1 = 5
        hX2 = 635
        break
      case 4: case 5: case 6: case 7: case 8:
        hX1 = 645
        hX2 = 1275
        break
      case 9:
        hX1 = 645
        hX2 = 955
        break
      case 10:
        hX1 = 965
        hX2 = 1275
      }
    //hovered Y
    switch hovered {
      case 0:
        hY1 = 5
        hY2 = 95
        break
      case 1: case 9: case 10:
        hY1 = 125
        hY2 = 195
        break
      case 2: case 4: case 7:
        hY1 = 205
        hY2 = 275
        break
      case 3: case 5: case 8:
        hY1 = 285
        hY2 = 355
        break
      case 6:
        hY1 = 365
        hY2 = 435
      }
    }
