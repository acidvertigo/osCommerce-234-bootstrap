<?php
/*
  $Id$

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2015 osCommerce

  Released under the GNU General Public License
*/

  class tp_email_create_account {
    var $group = 'email_create_account';
    var $template = '';

    function prepare() {
      global $lastname, $firstname;

      if (ACCOUNT_GENDER == 'true') {
         if ($gender == 'm') {
           $email_text = sprintf(EMAIL_GREET_MR, $lastname);
         } else {
           $email_text = sprintf(EMAIL_GREET_MS, $lastname);
         }
      } else {
        $email_text = sprintf(EMAIL_GREET_NONE, $firstname);
      }

      ob_start();

      if (EMAIL_USE_HTML == 'false') {
        include(DIR_WS_MODULES . 'pages/templates/email_create_account_text.php');
      } else {
        include(DIR_WS_MODULES . 'pages/templates/email_create_account_html.php');
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
