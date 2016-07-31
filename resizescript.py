#!/usr/bin/env python
import sys
import os
from PIL import Image
from resizeimage import resizeimage
import subprocess

patho = os.path.join("uploads/"+sys.argv[1]+"/"+sys.argv[2])
fd_img = open(patho, 'r')
img = Image.open(fd_img)
img = resizeimage.resize_width(img, 500)
img.save("uploads/"+sys.argv[1]+"/re-"+sys.argv[2], img.format)
fd_img.close()
cmd = "python chainer-fast-neuralstyle-master/generate.py"+" uploads/"+sys.argv[1]+"/"+"re-"+sys.argv[2]+" -m"+" chainer-fast-neuralstyle-master/models/"+sys.argv[3]+".model -o"+" processed/"+sys.argv[1]+"/"+sys.argv[3]+sys.argv[2]
subprocess.call(str(cmd), shell=True)

