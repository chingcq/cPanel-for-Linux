<?php
/*
##########################################################################
#                                                                        #
# 		WWW		 	   WWW EEEEEEEEEE BBBBBBBB             AAA			 #
#		 WWW	WW	  WWW  EEE		  BB    BB            AAAAA			 #
#         WWW  WWWW  WWW   EEEEEE     BBBBBBB   -----    AA   AA		 #
#          WWWWWWWWWWWW    EEE        BB    BB          AAAAAAAAA		 #
#			WWWW  WWWW     EEEEEEEEEE BBBBBBBB         AAA     AAA		 #
#   Copyright 2008-current date by web-a.org.uk, Web-Assistants          #
#                                                                        #
#   visit web-a.org, to find out more about our services                 #
#   - Script runs under the GNU GENERAL PUBLIC LICENSE                   #
#   - It's NOT allowed to remove this copyright-tag                      #
#   -- http://www.fsf.org/licensing/licenses/gpl.html                    #
#                                                                        #
#   Far Development by Development Team - web-a.org.uk                   #
#                                                                        #
#   visit web-a.org.uk                                                   #
#                                                                        #
##########################################################################
*/
/*
    This page will submit the order information to paypal website.
    After the customer completed the payment she will return to this site
*/

if (!isset($orderId)) {
    exit;
}
require_once SRV_ROOT . 'library/config.php';
require_once SRV_ROOT . 'include/paypal/paypal.inc.php';

$paypal['item_name'] = "Hosting";
$paypal['invoice']   = $_SESSION['orderID'];
$paypal['amount']    = $_SESSION['orderAmount'];
?>
<html>
<head>
<title><?php echo $pageTitle; ?></title>
<meta http-equiv=Content-Type content="text/html; charset=windows-1251" />
</head>
<body>
<center>
    <p>&nbsp;</p>
    <p><font face="Verdana, Arial, Helvetica, sans-serif" size="2" color="333333">Loading  . . . </font></p>
</center>
<form action="<?php echo $paypal['url']; ?>" method="post" name="frmPaypal" id="frmPaypal">
<input type="hidden" name="amount" value="<?php echo $paypal['amount']; ?>">
<input type="hidden" name="invoice" value="<?php echo $paypal['invoice']; ?>">
<input type="hidden" name="item_name" value="<?php echo $paypal['item_name']; ?>">
<input type="hidden" name="business" value="<?php echo $paypal['business']; ?>">
<input type="hidden" name="cmd" value="<?php echo $paypal['cmd']; ?>">
<input type="hidden" name="return" value="<?php echo  $paypal['site_url'] . $paypal['success_url']; ?>">
<input type="hidden" name="cancel_return" value="<?php echo $paypal['site_url'] . $paypal['cancel_url']; ?>">
<input type="hidden" name="notify_url" value="<?php echo  $paypal['site_url'] . $paypal['notify_url']; ?>">

<input type="hidden" name="rm" value="<?php echo $paypal['return_method']; ?>">
<input type="hidden" name="currency_code" value="<?php echo $paypal['currency_code']; ?>">
<input type="hidden" name="lc" value="<?php echo $paypal['lc']; ?>">
<input type="hidden" name="bn" value="<?php echo $paypal['bn']; ?>">
<input type="hidden" name="no_shipping" value="<?php echo $paypal['display_shipping_address']; ?>">


</form>
<script language="JavaScript" type="text/javascript">
window.onload=function() {
    window.document.frmPaypal.submit();
}
</script>
</body></html>