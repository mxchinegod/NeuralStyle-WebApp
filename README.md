# NeuralStyle-WebApp
A web app that takes any user-submitted image and runs the algorithm from "Neural Algorithms for Artistic Style" using a chainer implementation I found.

https://github.com/yusuketomoto/chainer-fast-neuralstyle/blob/master/generate.py

If you plan on exporting new models from images like I explain in "Setup" then you should do this:

`~$: python /var/www/html/chainer-fast-neuralstyle/train.py -s <style_image_path> -d /var/www/html/chainer-fast-neuralstyle/vgg16.model -g 0`


# Setup:
  
  A GPU-based machine for CUDA rendering of new models from images (optional).
  A memory-based machine for rendering higher-quality images (optional).
  Ubuntu 14+ 
  
# Requirements:
  
  You need python2.7 (could probably work with 3 if you change some things): `sudo apt-get install python2.7`
  You need chainer: `sudo pip install chainer`
  You need apache2 & PHP: `sudo apt-get install apache2 && sudo apt-get install php5 libapache2-mod-php5 php5-mcrypt`
  
# Installation:

  Simply copy all of the files into `/var/www/html` and make sure that the server has all permissions by doing `sudo chown -R www-data:www-data /var/www/html/*`
  
# Final & Future Thoughts:

  Lots of updating to do, there are PHP specific issues if I'm not mistaken when it comes to multiple users at the same time. I'll make a changelog over time.
  
  So far, calculations for smaller (500px wide) images only take about 1 second on my 6700K 4.7Ghz, this is of course very fast or what you'd expect from a powerful CPU however an AWS EC2 instance with only a 8-12 core CPU does it in about 4.7 seconds which isn't bad at all.
  
  If you want better models, head over to the link at the top because that's where I got the implementation. There are theories as to how to tune parameters and use certain arguments to get better results at the expense of more graphics memory. 



