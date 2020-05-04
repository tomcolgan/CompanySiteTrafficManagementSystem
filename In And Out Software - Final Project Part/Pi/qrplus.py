#importing all the imports which are needed
import time
import threading
import configparser
import aiohttp
import asyncio
import requests
import time
import schedule
import subprocess
from imutils.video import VideoStream
from pyzbar import pyzbar
import argparse
import datetime
import imutils
import cv2

def loadConfig(type):
                # Load the configuration files
				config = configparser.ConfigParser()
				config.sections()
				config.read('config.ini')
				if type==1 :
					return config['qrplus']['host']
				elif type==2 :
					return config['qrplus']['data']
				else :
					return config['qrplus']['state']
#pushing data using aiohttp				
async def pushData(d,murl):
				async with aiohttp.ClientSession() as session:
					url = 'http://'+loadConfig(1)+murl
					async with  session.post(url, data =d) as response:
						data = await response.text()
						print (data)

#when application is run it will show messages, system start and also the server IP (xampp server IP)
def main():
				print("[INFO] Starting System...")
				print("[INFO] Connection to server at %s..." % loadConfig(1))
				iAmAlive()
				# initialize the video stream and allow the camera sensor to warm up
				vs = VideoStream(usePiCamera=True).start()
				time.sleep(2.0)
				while True:
						# grab the frame from the threaded video stream and resize it to
						# have a maximum width of 400 pixels
						frame = vs.read()
						frame = imutils.resize(frame, width=400)

						# find the barcodes in the frame and decode each of the barcodes
						barcodes = pyzbar.decode(frame)

						# loop over the detected barcodes
						for barcode in barcodes:
								# extract the bounding box location of the barcode and draw
								# the bounding box surrounding the barcode on the image
								# modified from https://www.programcreek.com/python/example/89445/cv2.rectangle
								(x, y, w, h) = barcode.rect
								cv2.rectangle(frame, (x, y), (x + w, y + h), (0, 0, 255), 2)

								# the barcode data is a bytes object so if we want to draw it
								# on our output image we need to convert it to a string first
								# then message is displayed about a QR code being detected
								# the information from QR code is then sent to the xampp server
								barcodeData = barcode.data.decode("utf-8")
								barcodeType = barcode.type
								myobj = {'data': barcodeData}
								print("[INFO] %s Detected!" % barcodeType)
								print("[INFO] Sending Data to Server...")
								asyncio.run(pushData(myobj,loadConfig(2)))
								time.sleep(10.0)

					
					
#once appliocation is still running, it will keep looking for a QR code 
#error control implemented if camera is not found					
def iAmAlive(): 
		print ("[INFO] Run Self Check...")
		# do your stuff
		result = subprocess.run(['vcgencmd', 'get_camera'], stdout=subprocess.PIPE)
		s=result.stdout.decode('utf-8')
		sb="supported=1 detected=1"
		if (sb in s):
				#camera detected
				myobj = {'R': 'ON','C': 'ON'}
		else:
				#camera not detected
				print ("[FATAL] Camera not found check the cable or enable it via raspi-config...")
				myobj = {'R': 'ON','C': 'OFF'}
#		asyncio.run(pushData(myobj,loadConfig(3)))


class mainThread (threading.Thread):
   def __init__(self, threadID, name):
        threading.Thread.__init__(self)
        self.threadID = threadID
        self.name = name
   def run(self):
        main()

class controlThread (threading.Thread):
   def __init__(self, threadID, name):
        threading.Thread.__init__(self)
        self.threadID = threadID
        self.name = name
   def run(self):
        schedule.every().minute.at(":17").do(iAmAlive)
        while True:
            schedule.run_pending()
            time.sleep(1)


 
if __name__ == "__main__":
				# Create new threads
				thread1 = mainThread(1, "mainThread-1")
				thread2 = controlThread(2, "controlThread-2")

				# Start new Threads
				thread1.start()
				thread2.start()
				
