# NeuralStyle-WebApp
-A web app that takes any user-submitted image and runs the algorithm from "Neural Algorithms for Artistic Style" using a chainer implementation I found. It's very specific (logos, etc.) because this is actually for a client and it's copyrighted as a result. However, I know a lot of people want to know how they can do this and people told my client that it couldn't be done without a 10K budget which was lame. 

That being said, it was very possible and we don't mind it being here for certain people to gaze upon.


-https://github.com/yusuketomoto/chainer-fast-neuralstyle/blob/master/train.py


-If you plan on exporting new models from images like I explain in "Setup" then you should do this:


`~$: sudo python /var/www/html/chainer-fast-neuralstyle/train.py -s <style_image_path> -d /var/www/html/chainer-fast-neuralstyle/vgg16.model -g 0 --image_size 512`

# Structure & Info

  -This uses an ambitious PHP & python configuration to hand commands to a machine learning algorithm on the server and output the results into a very simple folder hierarchy based on a UI principle you'll see after deployment (or if you check out the variables in the upload.php code). This allows the files to be easily retrieved by each user with their email as a key, and provides a database-free way to do this simple task. 
  
  -The CSS & whatnot is all Bootstrap
  
  -The python chainer implementation was not by me, I just jerry-rigged it with python to the PHP/apache interface.

# Setup:
  
  -A GPU-based machine for CUDA rendering of new models from images (optional).
  
  -A memory-based machine for rendering higher-quality images (optional).
 
  -Ubuntu 14+ or similar or at least be prepared to install apache, python, and replace `apt-get` with `yum`.
  
# Requirements:
  
  -You need python27 (could probably work with 3 if you change some things). This comes with Ubuntu but if you don't have it: `sudo apt-get build-essential checkinstall`
  
  -You need chainer: `sudo pip install chainer`
  
  -You need apache2 & PHP: `sudo apt-get install apache2 && sudo apt-get install php5 libapache2-mod-php5 php5-mcrypt`
  
  -You need resizeimage: `sudo pip install resizeimage`
  
# Installation:

  -Simply copy all of the files into `/var/www/html` and make sure that the server has all permissions by doing `sudo chown -R www-data:www-data /var/www/html/*`
  
  
# Final Thoughts:

  -So far, calculations for smaller (500px wide) images only take about 1 second on my 6700K 4.7Ghz, this is of course very fast or what you'd expect from a powerful CPU however an AWS EC2 instance with only a 8-12 core CPU does it in about 4.7 seconds which isn't bad at all.
  
  
  -If you want better models, head over to the link at the top because that's where I got the implementation. There are theories as to how to tune parameters and use certain arguments to get better results at the expense of more graphics memory. 

  -I'm also looking forward to making new models, so I'll continue to update this repo in that regard too.


