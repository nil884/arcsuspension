project="/home/mysurun/public_html/surun.co/eyesecrets"
chown -R mysurun:mysurun $project

#---------------------------------------- Delete Images -------------------------------------#
#Product Images Folder
rm -rf $project/img/productimg/*.*
rm -rf $project/img/productimg/thumb1/*.*
rm -rf $project/img/productimg/thumb2/*.*
rm -rf $project/img/productimg/thumb3/*.*

# Standard Image Folder
rm -rf $project/img/blogimg/*.*
rm -rf $project/img/brand/*.*
rm -rf $project/img/buyer_profile/*.*
rm -rf $project/img/categoryimage/*.*
#rm -rf $project/favicon/*.*
rm -rf $project/img/mainslider/*.*
rm -rf $project/img/offer/*.*
rm -rf $project/img/order_img/*.*
rm -rf $project/img/pushnotification/*.*
rm -rf $project/img/slider1/*.*
rm -rf $project/img/slider2/*.*
rm -rf $project/img/slider3/*.*
rm -rf $project/img/support_tkt_comments/*.*
rm -rf $project/img/testimonials/*.*
rm -rf $project/img/vendordocs_images/*.*
rm -rf $project/img/wishlist_quotation/*.*

#Cron job folder
rm -rf $project/cronjob/cronfiles/*.*

#Delete APK File
rm -rf $project/img/projectimage/*.apk

#Project Specific Folders - Eye Secrets
#rm -rf $project/img/prescription/*.*

#-------------------------------------- Copy Standard Files -----------------------------------#

cp .htaccess $project
cp variables.php $project/includes/

#----------------------------------------------------------------------------------------------#
chown -R mysurun:mysurun $project
