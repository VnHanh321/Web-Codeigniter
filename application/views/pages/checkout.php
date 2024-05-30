<section id="cart_items">
  <div class="container">
    <div class="breadcrumbs">
      <ol class="breadcrumb">
        <li><a href="#">Home</a></li>
        <li class="active">Shopping Cart</li>
      </ol>
    </div>
    <div class=" table-responsive cart_info">
      <?php
      if ($this->cart->contents()) {
        ?>
        <table class="table table-condensed">
          <thead>
            <tr class="cart_menu">
              <td class="">Image</td>
              <td class="">Item</td>
              <td class="">Price</td>
              <td class="">Quantity</td>
              <td class="">In stock</td>
              <td class="">Total</td>
              <td></td>
            </tr>
          </thead>
          <tbody>
            <?php
            $subtotal = 0;
            $total = 0;
            foreach ($this->cart->contents() as $items) {
              $subtotal = $items['qty'] * $items['price'];
              $total += $subtotal;
              ?>
              <tr>
                <div class="d-flex align-items-center">
                  <td class="">
                    <a href=""><img src="<?php echo base_url('uploads/product/' . $items['options']['image']) ?>"
                        width="80px" height="80px" alt="<?php echo $items['name'] ?>"></a>
                  </td>
                </div>
                <td class="fw-bold mb-1 align-items-center">
                  <p href=""><?php echo $items['name'] ?></p>
                </td>
                <td class="fw-bold mb-1 align-items-center">
                  <p><?php echo number_format($items['price'], 0, ',', '.') ?> VND</p>
                </td>
                <td>
                  <form action="<?php echo base_url('update-cart-item') ?>" method="POST">
                    <div class="quantity">
                      <input type="hidden" name="rowid" value="<?php echo $items['rowid'] ?>">
                      <?php
                      if ($items['qty'] > $items['options']['in_stock']) {
                        ?>
                        <input class="" type="number" min="1" name="quantity"
                          value="<?php echo $items['options']['in_stock'] ?>" autocomplete="off" size="1">
                        <?php
                      } else {
                        ?>
                        <input class="" type="number" min="1" name="quantity" value="<?php echo $items['qty'] ?>"
                          autocomplete="off" size="1">
                      <?php } ?>
                      <input type="submit" value="Update" name="capnhat" class="btn btn-primary  btn-rounded">
                    </div>
                  </form>
                </td>
                <td>
                  <p href=""><?php echo $items['options']['in_stock'] ?></p>
                </td>
                <td>
                  <p class=""><?php echo number_format($subtotal, 0, ',', '.') ?> VND</p>
                </td>
                <td>
                  <a class="cart_quantity_delete" href="<?php echo base_url('delete-item-cart/' . $items['rowid']) ?>"><i
                      class="fa fa-times"></i></a>
                </td>
              </tr>
            <?php } ?>
            <tr>
              <td colspan="5">
                <p style="font-weight: bold;font-size: 20px;">Total</p>
                <p class="cart_total_price"><?php echo number_format($total, 0, ',', '.') ?> VND</p>
              </td>
            </tr>
          </tbody>
        </table>
      <?php } else {
        echo '<span class="text text-danger">add product</span>';
      } ?>
    </div>

    <section><!--form-->
      <div class="container">
        <div class="row">
          <div class="col-sm-10 col-sm-offset-1" style="margin: 0 80px;">
            <div class="login-form">
              <?php
              if ($this->session->flashdata('success')) {
                echo '<div class="alert alert-success">' . $this->session->flashdata('success') . '</div>';
              } elseif ($this->session->flashdata('error')) {
                echo '<div class="alert alert-danger">' . $this->session->flashdata('error') . '</div>';
              }
              ?>
              <div class="d-flex fw-bold mb-1 align-items-center">
                <p style="display: flex; justify-content: center; font-weight: bold;font-size:30px;">Fill in payment
                  information</p>
              </div>
              <form action="<?php echo base_url('online-checkout') ?>" method="POST">
                <div class="" style="margin: 20px">
                  <label for="" class="form-label">Name</label>
                  <input type="text" name="name" placeholder="Name" />
                  <?php echo form_error('name'); ?>
                </div>
                <div class="" style="margin: 20px">
                  <label for="" class="form-label">Address</label>
                  <input type="text" name="address" placeholder="Address" />
                  <?php echo form_error('address'); ?>
                </div>
                <div class="" style="margin: 20px">
                  <label for="" class="form-label">Phone</label>
                  <input type="text" name="phone" placeholder="Phone" />
                  <?php echo form_error('phone'); ?>
                </div>
                <div class="" style="margin: 20px">
                  <label for="" class="form-label">Email Address</label>
                  <input type="email" name="email" placeholder="Email Address" />
                  <?php echo form_error('email'); ?>
                </div>
                <div class=" d-flex justify-content-center" style="margin: 20px">
                  <label for="" class="form-label">Payment</label>
                  <!-- <select name="shipping_method" id="">
                    <option value="cod">COD</option>
                    <option value="momo">MOMO</option>
                  </select> -->
                  <div class="" style="display: flex; justify-content: center;margin: 20px">
                    <button type="submit" name="cod_payments" class="btn btn-default" style="margin: 20px">COD</button>
                    <button type="submit" name="payUrl" class="btn btn-default" style="margin: 20px">MoMo</button>
                  </div>
                </div>
                <!-- <div class="" style="display: flex; justify-content: center;">
                  <button type="submit" class="btn btn-default add-to-cart" style="padding: 10px 50px;">Cofirm</button>
                </div> -->
              </form>
            </div>
          </div>

        </div>
      </div>
    </section><!--/form-->
  </div>
</section> <!--/#cart_items-->