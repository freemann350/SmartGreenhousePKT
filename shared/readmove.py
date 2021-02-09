import time
import cv2 as cv

def get_image(id):
    fullpath = "..\cv2_captures\webcam"+id+".jpg"
    camera = cv.VideoCapture(0)
    ret, image = camera.read()
    grayFrame = cv.cvtColor(image, cv.COLOR_BGR2GRAY)
    cv.imshow('video gray', grayFrame)
    cv.imwrite(fullpath, grayFrame)
    camera.release()
    cv.destroyAllWindows()
    time.sleep(2)

try:
    while (1):
        with open("move", "r") as f: 
            move = f.read() #MOVE IS STRING, NOT INT
        
        if (move=="1"):
            with open("lid", "r") as f:
                lid = f.read()
            
            print("INTRUDER ALERT")
            get_image(lid)
        #else:
        #    print("ALL OK")

        time.sleep(2)
except KeyboardInterrupt:
    print("Interrupção")