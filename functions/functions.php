<?php

//Add Menu Item
add_action('admin_menu', 'wp_creditcard_validation_setup_menu');
function wp_creditcard_validation_setup_menu(){
        add_menu_page( 'WP Card Validator', 'WP Card Validator', 'manage_options', 'wp-credicard-validation', 'wp_creditcard_validation',  plugin_dir_url( __FILE__ ) .'../includes/assets/images/icons.png' , 21);
}
//Validate Card Function
function wp_creditcard_validation(){
        ?>
<div class="container ccpanel">
  <div class="col-md-8 col-md-offset-2" style="margin-top:60px">
    <div class="panel panel-default">
      <div class="panel-heading" style="border:1px solid #ccc">
        <h2 class="text-center">Validate the Credit Card</h2>
        <p class="text-center">TYPE THE CREDIT CARD TO VALIDATE IT</p>
      </div>
      <div class="panel-body" style="overflow:hidden;">
        <div class="col-md-8 col-md-offset-2" >
          <div class="jp-card jp-card-unknown effect2">
            <div class="jp-card-front">
              <div class="jp-card-shiny"></div>
              <div id="info"></div>
              <div class="jp-card-lower">
                <div class="jp-card-number jp-card-display jp-card-invalid">
                  <input type="text" class="form-control" placeholder="0000 0000 0000 0000" id="cc" class="" />
                </div>
                <div class="jp-card-name jp-card-display"></div>
                <div class="jp-card-expiry jp-card-display" data-before="month/year" data-after="valid-thru"></div>
              </div>
            </div>
          </div>
           <button class="btn btn-flat btn-primary vbtn pull-left mt-20" id="submit">Validate</button> <button class="btn btn-flat btn-danger vbtn pull-right mt-20" id="clear">Clear</button>
        </div>
      </div>
    </div>
  </div>

  <p class="col-md-12 cpr">Developed by Moises Machillanda - <a href="https://scygeek.com/">ScyGeek</a></p>
</div>
<script>
  jQuery(function($) {
    $('#cc').mask('0000 0000 0000 0000');


    $('#submit').on('click', function(){
      var ccval = $('#cc').val();
        if( ccval == ''){
          $('#cc').focus();
          $('#info').text('Type the Card Number');
          $('#info').addClass('err');
        }

    });
    
     $('#clear').on('click', function(){
	 	$('#info').text('');
         $('#cc').val('');
          $('#cc').focus();
          

    });
  // Take the value of the input and validate
  function valid_credit_card(value) {

  // accept only digits, dashes or spaces
    if (/[^0-9-\s]+/.test(value)) return false;
    if (value.length === 0) return false;
      var nCheck = 0,
      nDigit = 0,
      fCheck = 0,
      bEven = false;
      value = value.replace(/\D/g, "");

    for (var n = value.length - 1; n >= 0; n--) {
      var cDigit = value.charAt(n),
      nDigit = parseInt(cDigit, 10);
        if (bEven) {
          if ((nDigit *= 2) > 9) nDigit -= 9;
        }
      nCheck += nDigit;
      bEven = !bEven;
      }
        return (nCheck % 10) == 0;
     }
     //Conditons and Notifications
    function get_credit_card_info(value) {
      var visaimg = '<?php echo '<img src="'. plugin_dir_url( __FILE__ ) .'../includes/assets/images/visaimg.png" alt=""/>'; ?>';
      var expressimg = '<?php echo '<img src="'. plugin_dir_url( __FILE__ ) .'../includes/assets/images/expressimg.png" alt=""/>'; ?>';
      var masterimg = '<?php echo '<img src="'. plugin_dir_url( __FILE__ ) .'../includes/assets/images/masterimg.png" alt=""/>'; ?>';
      var discoverimg = '<?php echo '<img src="'. plugin_dir_url( __FILE__ ) .'../includes/assets/images/discoverimg.png" alt=""/>'; ?>';
      var dinersimg = '<?php echo '<img src="'. plugin_dir_url( __FILE__ ) .'../includes/assets/images/dinnersimg.png" alt=""/>'; ?>';

      var info = '';
      var validtxt = 'Valid: ';
      //Check the Card Type
      var industry = value.charAt(0);
      if (industry == 1 || industry == 2) {
        info = info + validtxt + 'Airline';
      }
      else if (industry == 3) {
        if (value.charAt(1) == 4) {
          info = info + validtxt + expressimg;
        }
        else if (value.charAt(1) == 7) {
          info = info + validtxt + expressimg;
        }
        else {
          info = info + validtxt + dinersimg;
        }
      }
      else if (industry == 4) {
        info = info + validtxt + visaimg;
      }
      else if (industry == 5) {
        if (value.charAt(1) == 1 || value.charAt(1) == 2 || value.charAt(1) == 3 || value.charAt(1) == 4 || value.charAt(1) == 5) {
          info = info + validtxt + masterimg ;
        }
        else {
          info = info + validtxt + 'Commercial';
        }
      }
      else if (industry == 6) {
        if (value.charAt(1) == 0 && value.charAt(2) == 1 && value.charAt(2) == 1) {
          info = info + validtxt + discoverimg;
        }
        else if (value.charAt(1) == 4 && value.charAt(2) == 4) {
          info = info + validtxt + discoverimg;
        }
        else if (value.charAt(1) == 5) {
          info = info + validtxt + discoverimg;
        }
        else {
          info = info + validtxt + 'Store';
        }
      }
      else if (industry == 7) {
        info = info + 'Oil';
      }
      else if (industry == 8) {
        info = info + 'Telecom';
      }
      else if (industry == 9) {
        info = info + 'Other';
      }
      return info;
    }
    //Notificaciones
    $('#cc').change(function() {
      $this = $(this);
        if (valid_credit_card($this.val())) {
          $('#info').addClass('valid');
          $('#info').removeClass('err');
          $('.jp-card-number input').removeClass('dclerr');
          $('').addClass('cardact');
          $('#info').html(get_credit_card_info($this.val()));
        }
        else {
          $('#info').removeClass('valid');
          $('.jp-card-number input').addClass('dclerr');
          $('.jp-card-number input').focus();
          $('#info').addClass('err');
          $('#info').text('Invalid Card');
        }
      });
    });
</script>
      <?php }
