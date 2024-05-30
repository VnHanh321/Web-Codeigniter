<section>
  <style>
    .clearfix {
      clear: both;
    }

    .text-center {
      text-align: center;
    }

    a {
      color: tomato;
      text-decoration: none;
    }

    a:hover {
      color: #2196f3;
    }


    /* Rating Star Widgets Style */
    .rating-stars ul {
      list-style-type: none;
      padding: 0;

      -moz-user-select: none;
      -webkit-user-select: none;
    }

    .rating-stars ul>li.star {
      display: inline-block;

    }

    /* Idle State of the stars */
    .rating-stars ul>li.star>i.fa {
      font-size: 2.5em;
      /* Change the size of the stars */
      color: #ccc;
      /* Color on idle state */
    }

    /* Hover state of the stars */
    .rating-stars ul>li.star.hover>i.fa {
      color: #FFCC36;
    }

    /* Selected state of the stars */
    .rating-stars ul>li.star.selected>i.fa {
      color: #FF912C;
    }
  </style>
  <div class="container">
    <div class="row">
      <div class="col-sm-3">
        <div class="left-sidebar">
          <h2>Category</h2>
          <div class="panel-group category-products" id="accordian"><!--category-productsr-->
            <?php
            foreach ($category as $key => $cate) {
              ?>
              <div class="panel panel-default">
                <div class="panel-heading">
                  <h4 class="panel-title">
                    <a href="<?php echo base_url('danh-muc/' . $cate->id) ?>">
                      <?php echo $cate->title ?>
                    </a>
                  </h4>
                </div>
              </div>
            <?php } ?>
          </div><!--/category-products-->

          <div class="brands_products"><!--brands_products-->
            <h2>Brands</h2>
            <div class="brands-name">
              <ul class="nav nav-pills nav-stacked">
                <?php
                foreach ($brand as $key => $bra) {
                  ?>
                  <li>
                    <a href="<?php echo base_url('thuong-hieu/' . $cate->id) ?>">
                      <?php echo $bra->title ?>
                    </a>
                  </li>
                <?php } ?>
              </ul>
            </div>
          </div><!--/brands_products-->
        </div>
      </div>

      <div class="col-sm-9 padding-right">
        <?php foreach ($product_details as $key => $pro) { ?>
          <div class="product-details"><!--product-details-->
            <div class="col-sm-5">
              <div class="view-product">
                <img src="<?php echo base_url('uploads/product/' . $pro->image) ?>" alt="<?php echo $pro->title ?>" />
              </div>

            </div>
            <form action="<?php echo base_url('add-to-cart') ?>" method="POST">
              <div class="col-sm-7">
                <?php
                if ($this->session->flashdata('success')) {
                  echo '<div class="alert alert-success">' . $this->session->flashdata('success') . '</div>';
                } elseif ($this->session->flashdata('error')) {
                  echo '<div class="alert alert-danger">' . $this->session->flashdata('error') . '</div>';
                }
                ?>
                <div class="product-information"><!--/product-information-->
                  <img src="images/product-details/new.jpg" class="newarrival" alt="" />
                  <h2><?php echo $pro->title ?></h2>
                  <input type="hidden" value="<?php echo $pro->id ?>" name="product_id">
                  <span>
                    <span><?php echo number_format($pro->price, 0, ',', '.') ?> VND</span><br>
                    <label>Quantity: <?php echo $pro->quantity ?></label>
                    <input type="number" min="1" value="1" name="quantity" />
                    <button type="submit" class="btn btn-default add-to-cart">
                      <i class="fa fa-shopping-cart"></i>
                      Add to cart
                    </button>
                  </span>
                  <p><b>Availability:</b> In Stock</p>
                  <p><b>Condition:</b> New</p>
                  <p><b>Brand:</b> <?php echo $pro->tenthuonghieu ?></p>
                  <p><b>Brand:</b> <?php echo $pro->tendanhmuc ?></p>
                  <a href=""><img src="images/product-details/share.png" class="share img-responsive" alt="" /></a>
                </div><!--/product-information-->
              </div>
            </form>
          </div><!--/product-details-->
        <?php } ?>

        <div class="category-tab shop-details-tab"><!--category-tab-->
          <div class="col-sm-12">
            <ul class="nav nav-tabs">
              <li><a href="#details" data-toggle="tab">Details</a></li>
              <li><a href="#companyprofile" data-toggle="tab">Company Profile</a></li>
              <li><a href="#tag" data-toggle="tab">Tag</a></li>
              <li class="active"><a href="#reviews" data-toggle="tab">Reviews (5)</a></li>
            </ul>
          </div>
          <div class="tab-content">
            <div class="tab-pane fade" id="details">
              <div class="col-sm-3">
                <div class="product-image-wrapper">
                  <div class="single-products">
                    <div class="productinfo text-center">
                      <img src="images/home/gallery1.jpg" alt="" />
                      <h2>$56</h2>
                      <p>Easy Polo Black Edition</p>
                      <button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add
                        to cart</button>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-sm-3">
                <div class="product-image-wrapper">
                  <div class="single-products">
                    <div class="productinfo text-center">
                      <img src="images/home/gallery2.jpg" alt="" />
                      <h2>$56</h2>
                      <p>Easy Polo Black Edition</p>
                      <button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add
                        to cart</button>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-sm-3">
                <div class="product-image-wrapper">
                  <div class="single-products">
                    <div class="productinfo text-center">
                      <img src="images/home/gallery3.jpg" alt="" />
                      <h2>$56</h2>
                      <p>Easy Polo Black Edition</p>
                      <button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add
                        to cart</button>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-sm-3">
                <div class="product-image-wrapper">
                  <div class="single-products">
                    <div class="productinfo text-center">
                      <img src="images/home/gallery4.jpg" alt="" />
                      <h2>$56</h2>
                      <p>Easy Polo Black Edition</p>
                      <button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add
                        to cart</button>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="tab-pane fade" id="companyprofile">
              <div class="col-sm-3">
                <div class="product-image-wrapper">
                  <div class="single-products">
                    <div class="productinfo text-center">
                      <img src="images/home/gallery1.jpg" alt="" />
                      <h2>$56</h2>
                      <p>Easy Polo Black Edition</p>
                      <button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add
                        to cart</button>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-sm-3">
                <div class="product-image-wrapper">
                  <div class="single-products">
                    <div class="productinfo text-center">
                      <img src="images/home/gallery3.jpg" alt="" />
                      <h2>$56</h2>
                      <p>Easy Polo Black Edition</p>
                      <button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add
                        to cart</button>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-sm-3">
                <div class="product-image-wrapper">
                  <div class="single-products">
                    <div class="productinfo text-center">
                      <img src="images/home/gallery2.jpg" alt="" />
                      <h2>$56</h2>
                      <p>Easy Polo Black Edition</p>
                      <button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add
                        to cart</button>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-sm-3">
                <div class="product-image-wrapper">
                  <div class="single-products">
                    <div class="productinfo text-center">
                      <img src="images/home/gallery4.jpg" alt="" />
                      <h2>$56</h2>
                      <p>Easy Polo Black Edition</p>
                      <button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add
                        to cart</button>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="tab-pane fade" id="tag">
              <div class="col-sm-3">
                <div class="product-image-wrapper">
                  <div class="single-products">
                    <div class="productinfo text-center">
                      <img src="images/home/gallery1.jpg" alt="" />
                      <h2>$56</h2>
                      <p>Easy Polo Black Edition</p>
                      <button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add
                        to cart</button>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-sm-3">
                <div class="product-image-wrapper">
                  <div class="single-products">
                    <div class="productinfo text-center">
                      <img src="images/home/gallery2.jpg" alt="" />
                      <h2>$56</h2>
                      <p>Easy Polo Black Edition</p>
                      <button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add
                        to cart</button>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-sm-3">
                <div class="product-image-wrapper">
                  <div class="single-products">
                    <div class="productinfo text-center">
                      <img src="images/home/gallery3.jpg" alt="" />
                      <h2>$56</h2>
                      <p>Easy Polo Black Edition</p>
                      <button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add
                        to cart</button>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-sm-3">
                <div class="product-image-wrapper">
                  <div class="single-products">
                    <div class="productinfo text-center">
                      <img src="images/home/gallery4.jpg" alt="" />
                      <h2>$56</h2>
                      <p>Easy Polo Black Edition</p>
                      <button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add
                        to cart</button>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="tab-pane fade active in" id="reviews">
              <div class="col-sm-12">
                <?php foreach ($list_comments as $key => $comments) {
                  ?>
                  <ul>
                    <li><a href="#"><i class="fa fa-user"></i><?php echo $comments->name ?></a></li>
                    <li><a href="#"><i class="fa fa-clock-o"></i><?php echo $comments->date ?></a></li>
                    <li><a href="#"><i class="fa fa-star"></i><?php echo $comments->star ?></a></li>
                  </ul>
                  <p><?php echo $comments->comment ?></p>
                <?php } ?>
                <p><b>Write Your Review and Rating</b></p>
                <section class='rating-widget'>
                  <!-- Rating Stars Box -->
                  <div class='rating-stars text-center'>
                    <input type="hidden" class="star_rating_value">
                    <ul id='stars'>
                      <li class='star' title='Poor' data-value='1'>
                        <i class='fa fa-star fa-fw'></i>
                      </li>
                      <li class='star' title='Fair' data-value='2'>
                        <i class='fa fa-star fa-fw'></i>
                      </li>
                      <li class='star' title='Good' data-value='3'>
                        <i class='fa fa-star fa-fw'></i>
                      </li>
                      <li class='star' title='Excellent' data-value='4'>
                        <i class='fa fa-star fa-fw'></i>
                      </li>
                      <li class='star' title='WOW!!!' data-value='5'>
                        <i class='fa fa-star fa-fw'></i>
                      </li>
                    </ul>
                  </div>
                  <form action="#">
                    <span>
                      <input type="hidden" class="product_id_comment" value="<?php echo $pro->id ?>" />
                      <input type="text" class="name_comment" placeholder="Your Name" />
                      <input type="email" class="email_comment" placeholder="Email Address" />
                    </span>
                    <textarea name="" class="comment"></textarea>
                    <button type="button" class="btn btn-default pull-right write-comment">
                      Submit
                    </button>
                  </form>
              </div>
            </div>

          </div>
        </div><!--/category-tab-->

        <div class="recommended_items"><!--recommended_items-->
          <h2 class="title text-center">Recommended items</h2>

          <div id="recommended-item-carousel" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
              <?php
              foreach ($product_related as $key => $pro) {
                ?>
                <div class="item active">
                  <div class="col-sm-4">
                    <div class="product-image-wrapper">
                      <form action="<?php echo base_url('add-to-cart') ?>" method="POST">
                        <div class="single-products">
                          <div class="productinfo text-center">
                            <input type="hidden" value="<?php echo $pro->id ?>" name="product_id">
                            <input type="hidden" value="1" name="quantity">
                            <div
                              style="width: 200px;height: 200px;object-fit: cover;margin: 0px 0px 20px 27px;padding-top: 15px;">
                              <img src="<?php echo base_url('uploads/product/' . $pro->image) ?>"
                                alt="<?php echo $pro->title ?>" />
                            </div>
                            <h2><?php echo number_format($pro->price, 0, ',', '.') ?>VND</h2>
                            <p><?php echo $pro->title ?></p>
                            <a href="<?php echo base_url('san-pham/' . $pro->id) ?>"
                              class="btn btn-default add-to-cart"><i class="fa fa-eye"></i>Details</a>
                          </div>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
              <?php } ?>
              <a class="left recommended-item-control" href="#recommended-item-carousel" data-slide="prev">
                <i class="fa fa-angle-left"></i>
              </a>
              <a class="right recommended-item-control" href="#recommended-item-carousel" data-slide="next">
                <i class="fa fa-angle-right"></i>
              </a>
            </div>
          </div><!--/recommended_items-->

        </div>
      </div>
    </div>
</section>