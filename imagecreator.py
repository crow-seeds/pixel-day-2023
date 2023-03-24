from PIL import Image
import numpy as np
import mysql.connector
import time
import datetime
import random


mydb = mysql.connector.connect(
  host="",
  user="",
  password="",
  database=""
)

path = "C:/xampp/htdocs/PIXEL/Images/"
mycursor = mydb.cursor()
current_frame = 330
mean_time = 14400
rand_diff = 600


def startUp():
    mycursor.execute("UPDATE info SET current_frame = 0 AND frame_time = now()")
    mycursor.execute("UPDATE grid SET color = 1")
    mycursor.execute("UPDATE grid SET author = 'crow-seeds'")
    mycursor.execute("DELETE FROM frames")
    mycursor.execute("ALTER TABLE frames AUTO_INCREMENT = 0")
    mydb.commit()
    mycursor.execute("INSERT INTO frames (current_frame, frame_time) VALUES (NULL, current_timestamp())")
    mydb.commit()
    print("Starting!!!!")


def createImage():
    mycursor.execute("SELECT color FROM grid ORDER BY id ASC")
    myresult = mycursor.fetchall()

    colors = [(0,0,0),(255,255,255),(255,105,97),(255,180,128),(248,243,141),(162,255,81),(89,173,246),(157,148,255),(255,166,201),(146,103,73),(66,214,148),(199,128,232),(8,202,209),(72,255,255),(128,128,128)]
    grid = []


    for x in myresult:
        grid.append(colors[x[0]])

    formattedgrid = np.reshape(grid, (24, 24, 3))
    array = np.array(formattedgrid, dtype=np.uint8)
    new_image = Image.fromarray(array)
    global current_frame
    new_image.save(path + str(current_frame) + '.png')
    current_frame = current_frame + 1
    mycursor.execute("UPDATE info SET current_frame = current_frame + 1")
    mycursor.execute("INSERT INTO frames (current_frame, frame_time) VALUES (NULL, current_timestamp())")
    mydb.commit()
    #print("Next Stage!")

#startUp()

while True:
    createImage()
    randTime = mean_time - random.randrange(0,rand_diff)
    time.sleep(randTime)
    