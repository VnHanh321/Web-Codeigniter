<footer id="footer"><!--Footer-->
  <div class="footer-top">
    <div class="container">
      <div class="row">
        <div class="col-sm-8" style="display:flex; justify-content:center;">
          <div class="companyinfo">
            <h2><span>e</span>-shopper</h2>
            <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Est quidem odio tempore, nisi labore quaerat
              facere, veniam nam ex sed reprehenderit! Rerum nostrum, ratione distinctio ea odit neque ipsam id!</p>
          </div>
        </div>
      </div>
    </div>

    <div class="footer-widget">
      <div class="container">
        <div class="row">
          <div class="col-sm-2">
            <div class="single-widget">
              <h2>Service</h2>
              <ul class="nav nav-pills nav-stacked">
                <li><a href="<?php echo base_url('contact'); ?>">Contact Us</a></li>
                <li><a href="#">Order Status</a></li>
                <li><a href="#">FAQ’s</a></li>
              </ul>
            </div>
          </div>
          <div class="col-sm-2">
            <div class="single-widget">
              <h2>Quick Shop</h2>
              <ul class="nav nav-pills nav-stacked">
                <?php
                foreach ($category as $key => $cate) {
                  ?>
                  <li><a href="<?php echo base_url('danh-muc/' . $cate->id) ?>">
                      <?php echo $cate->title ?>
                    </a></li>
                <?php }
                ?>
              </ul>
              </ul>
            </div>
          </div>
          <div class="col-sm-2">
            <div class="single-widget">
              <h2>About Shopper</h2>
              <ul class="nav nav-pills nav-stacked">
                <li><a href="#">Company Information</a></li>
                <li><a href="#">Careers</a></li>
                <li><a href="#">Store Location</a></li>
                <li><a href="#">Affillate Program</a></li>
                <li><a href="#">Copyright</a></li>
              </ul>
            </div>
          </div>
          <div class="col-sm-3 col-sm-offset-1">
            <div class="single-widget">
              <h2>About Shopper</h2>
              <form action="#" class="searchform">
                <input type="text" placeholder="Your email address" />
                <button type="submit" class="btn btn-default"><i class="fa fa-arrow-circle-o-right"></i></button>
                <p>Get the most recent updates from <br />our site and be updated your self...</p>
              </form>
            </div>
          </div>

        </div>
      </div>
    </div>

    <div class="footer-bottom">
      <div class="container">
        <div class="row">
          <p class="pull-left">Copyright E-SHOPPER Inc. All rights reserved.</p>
          </p>
        </div>
      </div>
    </div>

</footer><!--/Footer-->



<script src="<?php echo base_url('frontend/js/jquery.js') ?>"></script>
<script src="<?php echo base_url('frontend/js/bootstrap.min.js') ?>"></script>
<script src="<?php echo base_url('frontend/js/jquery.scrollUp.min.js') ?>"></script>
<script src="<?php echo base_url('frontend/js/price-range.js') ?>"></script>
<script src="<?php echo base_url('frontend/js/jquery.prettyPhoto.js') ?>"></script>
<script src="<?php echo base_url('frontend/js/main.js') ?>"></script>

<script>
  $(document).ready(function () {
    $(".write-comment").click(function () {

      var name_comment = $(".name_comment").val();
      var email_comment = $(".email_comment").val();
      var comment = $(".comment").val();
      var product_id_comment = $(".product_id_comment").val();
      var star_rating_value = $(".star_rating_value").val();

      if (name_comment == '' || email_comment == '' || comment == '') {
        alert('Please fill in all required fields (Name, Email, and Comment)');
      } else {
        $.ajax({
          method: 'POST',
          url: '/comment/send',
          data: { name_comment: name_comment, email_comment: email_comment, comment: comment, product_id_comment: product_id_comment, star_rating_value: star_rating_value },
          success: function () {
            $(".name_comment").val("");
            $(".email_comment").val("");
            $(".comment").val("");
            $(".star_rating_value").val("");
            // alert("Comment submitted successfully! It will be reviewed before being displayed.");
          },
        });
      }
    });
  });
</script>
<script>
  $(document).ready(function () {

    /* 1. Visualizing things on Hover - See next part for action on click */
    $('#stars li').on('mouseover', function () {
      var onStar = parseInt($(this).data('value'), 10); // The star currently mouse on
      var selectedRating = $('.star_rating_value').val();

      // Now highlight all the stars that's not after the current hovered star
      $(this).parent().children('li.star').each(function (e) {
        if (e < onStar) {
          $(this).addClass('hover');
        }
        else {
          $(this).removeClass('hover');
        }
      });

    }).on('mouseout', function () {
      $(this).parent().children('li.star').each(function (e) {
        $(this).removeClass('hover');
      });
    });

    /* 2. Action to perform on click */
    $('#stars li').on('click', function () {
      var onStar = parseInt($(this).data('value'), 10); // The star currently selected
      var stars = $(this).parent().children('li.star');

      for (i = 0; i < stars.length; i++) {
        $(stars[i]).removeClass('selected');
      }

      for (i = 0; i < onStar; i++) {
        $(stars[i]).addClass('selected');
      }

      // Update hidden input with the clicked star value
      $('.star_rating_value').val(onStar);
    });

  });
</script>
</body>

</html>