# Change the socket file to the corresponding socket folder (the following socket directory is for Macbook using XAMPP, check my.cnf file for socket directory)
# To run the script:
#   1. Go to comp353/config
#   2. Type: sudo sh ./dataDump.sh
#   3. When asked for password (Enter password:), just press the Enter/return on the keyboard
mysqldump -u root -p rr_comp353_2 --socket=/Applications/XAMPP/xamppfiles/var/mysql/mysql.sock --column-statistics=0 --single-transaction --quick --lock-tables=false > rr_comp353_2-backup-$(date +%F).sql
