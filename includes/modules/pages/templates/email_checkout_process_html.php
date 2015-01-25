<!DOCTYPE html>
<html <?php echo HTML_PARAMS; ?>>
<head>
<title><?php echo STORE_NAME; ?></title>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo CHARSET; ?>" />
</head>
<body>

<div class="content">
<div>
<?php echo EMAIL_TEXT_ORDER_NUMBER . ' ' . $insert_id . "<br />" .
       EMAIL_TEXT_INVOICE_URL . '<a href="' . tep_href_link(FILENAME_ACCOUNT_HISTORY_INFO, 'order_id=' . $insert_id, 'SSL', false) . '">' . tep_href_link(FILENAME_ACCOUNT_HISTORY_INFO, 'order_id=' . $insert_id, 'SSL', false) . "</a><br />" .
       EMAIL_TEXT_DATE_ORDERED . ' ' . strftime(DATE_FORMAT_LONG); ?>
</div>
<div class="comments">
<?php
  if ($order->info['comments']) {
    echo tep_db_output($order->info['comments']);
  }
?>
</div>

<div class="products">
<h2><?php echo EMAIL_TEXT_PRODUCTS; ?></h2>
<table align="right" class="table">
<thead>
<tr><td><?php echo TABLE_HEADING_QUANTITY; ?></td><td><?php echo TABLE_HEADING_PRODUCTS; ?></td><td></td></tr>
</thead>
<tbody>
<?php
  $products = explode("\n", $products_ordered);

  foreach ($products as $key => $value) {
    $columns1 = explode(" x ", $value);
    if (isset($columns1[1])) {
      $columns2 = explode(" = ", $columns1[1]);
    }
    if (isset($products[$key+1]) && preg_match("/\t/", $products[$key+1])) {
      echo '<tr><td align="center">' . $columns1[0] . '&nbsp;x&nbsp;</td><td>' . $columns2[0] . '<br /> - ' . $products[$key+1] . '</td><td align="right">' . $columns2[1] . '</td></tr>' . "\n";
    } elseif (!preg_match("/\t/", $value) && !empty($value)) {
      echo '<tr><td align="center">' . $columns1[0] . '&nbsp;x&nbsp;</td><td>' . $columns2[0] . '</td><td align="right">' . $columns2[1] . '</td></tr>' . "\n";
    }
  }
?>
</tbody>
<tfoot>
<?php
  for ($i=0, $n=sizeof($order_totals); $i<$n; $i++) { ?>
    <tr><td colspan="2" align="right"><?php echo strip_tags($order_totals[$i]['title']); ?></td><td align="right"><?php echo strip_tags($order_totals[$i]['text']); ?></td></tr>
<?php
  }
?>
</tfoot>
</table>
</div>

<div style="clear:both"></div>

<div class="address">
<?php
  if ($order->content_type != 'virtual') {
?>
  <h2><?php echo EMAIL_TEXT_DELIVERY_ADDRESS; ?></h2>
  <hr>
<?php
    echo tep_address_label($customer_id, $sendto, 0, '', "<br />");
  }
?>
  <h2><?php echo EMAIL_TEXT_BILLING_ADDRESS; ?></h2>
  <hr>
<?php
    echo tep_address_label($customer_id, $billto, 0, '', "<br />");
?>
</div>

<?php
  if (is_object($$payment)) {
    $payment_class = $$payment;
?>
<div class="paymentfooter">
  <h2><?php echo EMAIL_TEXT_PAYMENT_METHOD; ?></h2>
  <hr>
<?php
    echo $order->info['payment_method'] . '<br />';
    if (isset($payment_class->email_footer)) {
      echo $payment_class->email_footer . '<br />';
    }
?>
</div>
<?php
  }
?>

</div>

</body>
</html>
