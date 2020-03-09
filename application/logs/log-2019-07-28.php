<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2019-07-28 11:49:24 --> Severity: Notice --> Undefined index: order /home/codeldzi/public_html/php/adminlite/application/libraries/Datatable.php 44
ERROR - 2019-07-28 11:49:24 --> Severity: Notice --> Undefined index: columns /home/codeldzi/public_html/php/adminlite/application/libraries/Datatable.php 44
ERROR - 2019-07-28 11:49:24 --> Severity: Notice --> Undefined index: order /home/codeldzi/public_html/php/adminlite/application/libraries/Datatable.php 45
ERROR - 2019-07-28 11:49:24 --> Severity: Notice --> Undefined index: length /home/codeldzi/public_html/php/adminlite/application/libraries/Datatable.php 46
ERROR - 2019-07-28 11:49:24 --> Severity: Notice --> Undefined index: start /home/codeldzi/public_html/php/adminlite/application/libraries/Datatable.php 46
ERROR - 2019-07-28 11:49:24 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near 'LIMIT  OFFSET' at line 13 - Invalid query: Select
					ci_payments.id,
					ci_payments.invoice_no,
					ci_payments.grand_total,
					ci_payments.currency,
					ci_payments.created_date,
					ci_users.username as client_name,
					ci_users.email as client_email,
					ci_users.mobile_no as client_mobile_no

				    FROM ci_payments 

				    left JOIN ci_users ON ci_payments.user_id = ci_users.id WHERE (1) ORDER BY   LIMIT  OFFSET  
ERROR - 2019-07-28 23:59:16 --> 404 Page Not Found: admin/Mailbox/read-mail.html
ERROR - 2019-07-28 23:59:29 --> 404 Page Not Found: admin/Mailbox/read-mail.html
ERROR - 2019-07-28 23:59:54 --> 404 Page Not Found: Permission_denied/index
