#Student Tom Colgan X16102461
#Adding the imports to run the file
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

#Loading the config.ini into this file which has the IP of the laptop running xampp
def loadConfig(type):
                # Load the configuration file
				config = configparser.ConfigParser()
				config.sections()
				config.read('config.ini')
				if type==1 :
					return config['qrplus']['host']
				elif type==2 :
					return config['qrplus']['data']
				else :
					return config['qrplus']['state']

#Modified ClientSession from a website
""" Title: <Getting Started/client example>
Author: <author(s) names>
Date: <14-03-2020>
Availability: <https://docs.aiohttp.org/_/downloads/en/v2.1.0/pdf/> """				
async def pushData(d,murl):
				async with aiohttp.ClientSession() as session:
					url = 'http://'+loadConfig(1)+murl
					async with  session.post(url, data =d) as response:
						data = await response.text()
						print (data)

 
def main():
	#When the file runs print out the text to show the user its working
				print("[INFO] Starting System...")
				print("[INFO] Connection to server at %s..." % loadConfig(1))
				iAmAlive()
				# initialize the video stream and allow the camera sensor to warm up
				# modified code from the following website
				""" Title: <Unifying picamera and cv2.VideoCapture into a single class with OpenCV>
				Author: <Adrian Rosebrock>
				Date: <18-03-2020>
				Availability: <https://www.pyimagesearch.com/2016/01/04/unifying-picamera-and-cv2-videocapture-into-a-single-class-with-opencv/> """
				vs = VideoStream(usePiCamera=True).start()
				time.sleep(2.0)
				while True:
						# grab the frame from the threaded video stream and resize it to
						# have a maximum width of 400 pixels
						frame = vs.read()
						frame = imutils.resize(frame, width=400)

						# find the barcodes in the frame and decode each of the barcodes
						""" Title: <An OpenCV barcode and QR code scanner with ZBar>
						Author: <Adrian Rosebrock>
						Date: <19-03-2020>
						Availability: <https://www.pyimagesearch.com/2018/05/21/an-opencv-barcode-and-qr-code-scanner-with-zbar/> """
						barcodes = pyzbar.decode(frame)

						# loop over the detected barcodes
						""" Title: <An OpenCV barcode and QR code scanner with ZBar>
						Author: <Adrian Rosebrock>
						Date: <19-03-2020>
						Availability: <https://www.pyimagesearch.com/2018/05/21/an-opencv-barcode-and-qr-code-scanner-with-zbar/> """
						for barcode in barcodes:
								# extract the bounding box location of the barcode and draw
								# the bounding box surrounding the barcode on the image
								""" Title: <An OpenCV barcode and QR code scanner with ZBar>
						Author: <Adrian Rosebrock>
						Date: <19-03-2020>
						Availability: <https://www.pyimagesearch.com/2018/05/21/an-opencv-barcode-and-qr-code-scanner-with-zbar/> """
								(x, y, w, h) = barcode.rect
								cv2.rectangle(frame, (x, y), (x + w, y + h), (0, 0, 255), 2)

								# the barcode data is a bytes object so if we want to draw it
								# on our output image we need to convert it to a string first
								""" Title: <An OpenCV barcode and QR code scanner with ZBar>
								Author: <Adrian Rosebrock>
								Date: <19-03-2020>
								Availability: <https://www.pyimagesearch.com/2018/05/21/an-opencv-barcode-and-qr-code-scanner-with-zbar/> """
								barcodeData = barcode.data.decode("utf-8")
								barcodeType = barcode.type
								myobj = {'data': barcodeData}
								#When a barcode is detected send the data to the xampp server
								print("[INFO] %s Detected!" % barcodeType)
								print("[INFO] Sending Data to Server...")
								asyncio.run(pushData(myobj,loadConfig(2)))
								time.sleep(10.0)

					
					
					
def iAmAlive(): 
		print ("[INFO] Run Self Check...")
		# Run the processes
		result = subprocess.run(['vcgencmd', 'get_camera'], stdout=subprocess.PIPE)
		s=result.stdout.decode('utf-8')
		sb="supported=1 detected=1"
		if (sb in s):
				#camera detected
				myobj = {'R': 'ON','C': 'ON'}
		else:
				#camera not detected then display the error message
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
				
