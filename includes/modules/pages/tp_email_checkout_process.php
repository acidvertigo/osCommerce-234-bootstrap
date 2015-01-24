<?php
/*
  $Id$

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2015 osCommerce

  Released under the GNU General Public License
*/

  class tp_email_checkout_process {
    var $group = 'email_checkout_process';
    var $template = '';

    function prepare() {
      global $order, $payment, $products_ordered, $insert_id, $order_totals, $customer_id, $sendto, $billto;

      ob_start();

      if (EMAIL_USE_HTML == 'false') {
        include(DIR_WS_MODULES . 'pages/templates/email_checkout_process_text.php');
      } else {
        include(DIR_WS_MODULES . 'pages/templates/email_checkout_process_html.php');
      }

      $this->template = ob_get_clean();

      if (EMAIL_USE_HTML == 'true') {
        $this->template = tep_convert_linefeeds(array("\r\n", "\n", "\r"), '', $this->template);
      }
    }

    function build() {
      global $oscTemplate;

      $oscTemplate->addContent($this->template, $this->group);
    }
  }
?>
