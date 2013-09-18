
<!DOCTYPE html>
<!--[if IE 7]>
<html class="ie ie7" lang="en-US">
<![endif]-->
<!--[if IE 8]>
<html class="ie ie8" lang="en-US">
<![endif]-->
<!--[if !(IE 7) | !(IE 8)  ]><!-->
<html lang="en-US">
<!--<![endif]-->
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width" />
<title>Order Form</title>
<link rel="stylesheet/css" type="text/css" href="/styles/style.css">
<!--[if lt IE 9]>
<script src="/js/html5.js" type="text/javascript"></script>
<![endif]-->
<script type='text/javascript' src='http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js'></script>
<script>
  jQuery(document).ready(function() {
    var select = jQuery('#distributor');
    var details = jQuery('#other_details');
    
    if(select.val() == 12 ){
      <?php echo isset($_SESSION['other_details']) ? 'details.val("'.$_SESSION['other_details'].'");' : ''; ?>
      details.css({'display' : 'inline'});
    }

    select.change(function(){
      if(select.val() == 12 ){
        details.css({'display' : 'inline'});
      }else {
        details.val('');
        details.css({'display' : 'none'});
      }
      jQuery('#update_form').click();

    });
    jQuery('#order_form input').blur(function() {
      jQuery('#update_form').click();
    });
  });
</script>
</head>

<body>
  <header class="secondary">
    <div class="center">
      <img alt="Company" src="/images/header.jpg" width="1200" height="100" />
    </div>
  </header>
  <section class="secondary clearfix">
    <div class="content order-form">