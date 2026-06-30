#----------------------------------------------------------------------------------
# Sitemap Generator Cron
# SMS Records Update Cron
# Vendor Plan Check Cron
# Recurring Payment Cron 
#----------------------------------------------------------------------------------
wget -O - https://arcsuspension.in/cronjob/sitemap.php > /dev/null 2>&1 &
wget -O - https://arcsuspension.in/cronjob/vendorplan.php > /dev/null 2>&1 &
wget -O - https://arcsuspension.in/cronjob/google_merchant.php > /dev/null 2>&1 &
#----------------------------------------------------------------------------------