# -----------------------------------------------------------------------------------------
# Bulkimport cron run after every 15 min
# Product sell cron run after every 15 min
# Remove blocked products after every 15 min
# Refund cancel order after every 15 min
# Order Tracking order after every 15 min
# -----------------------------------------------------------------------------------------
wget -O - https://arcsuspension.in/cronjob/cronbulkimport.php > /dev/null 2>&1 &
wget -O - https://arcsuspension.in/cronjob/prodcut_sale.php > /dev/null 2>&1 &
wget -O - https://arcsuspension.in/cronjob/remove_blocks.php > /dev/null 2>&1 &
wget -O - https://arcsuspension.in/cronjob/refund_payment.php > /dev/null 2>&1 &
wget -O - https://arcsuspension.in/cronjob/order_status.php > /dev/null 2>&1 &
wget -O - https://arcsuspension.in/cronjob/check_refund_status.php > /dev/null 2>&1 &
wget -O - https://arcsuspension.in/cronjob/payment_status.php > /dev/null 2>&1 &
#wget -O - https://arcsuspension.in/cronjob/merchant_center_product_statuses.php >/dev/null 2>&1
# -----------------------------------------------------------------------------------------

