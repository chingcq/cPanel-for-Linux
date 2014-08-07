<?php

// this page only process a POST from paypal website
// so make sure that the one requesting this page comes
// from paypal. we can do this by checking the remote address
// the IP must begin with 66.135.197.
if (strpos($_SERVER['REMOTE_ADDR'], '66.135.197.') === false) {
    exit;
}

require_once SRV_ROOT . 'library/config.php';
require_once SRV_ROOT . 'include/paypal/paypal.inc.php';

// repost the variables we get to paypal site
// for validation purpose
$result = fsockPost($paypal['url'], $_POST);

//check the ipn result received back from paypal
if (eregi("VERIFIED", $result)) {

        require_once '../../index.php';

        // check that the invoice has not been previously processed
        $sql = "SELECT *
                FROM tbl_order
                WHERE order_id = {$_SESSION['invoice']}";

		$stmt = $this->registry['conn']->query($sql);
		$numrows = $stmt->rowCount();
        // if no invoice with such number is found, exit
        if ($numrows == 0) {
            exit;
        } else {

            $result = $stmt->fetch(PDO::FETCH_OBJ);

            // process this order only if the status is still 'New'
            if ($result->order_status !== 'New') {
                exit;
            } else {
                    $invoice = $_POST['invoice'];
                    $memo    = $_POST['memo'];
                    if (!get_magic_quotes_gpc()) {
                        $memo = addslashes($memo);
                    }

                    // ok, so this order looks perfectly okay
                    // now we can update the order status to 'Paid'
                    // update the memo too
                    $sql = "UPDATE tbl_order
                            SET order_status = 'Payed', order_memo = '$memo', order_last_update = NOW()
                            WHERE order_id = $invoice";
                    $result = dbQuery($sql);
                }
            }
        }

} else {
    exit;
}


?>
