<section id="cart_items">
  <div class="container">
    <?php
    if ($this->session->flashdata('success')) {
      echo '<div class="alert alert-success">' . $this->session->flashdata('success') . '</div>';
    } elseif ($this->session->flashdata('error')) {
      echo '<div class="alert alert-danger">' . $this->session->flashdata('error') . '</div>';
    }
    ?>
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
              <td colspan="5">Total
                <p class="cart_total_price"><?php echo number_format($total, 0, ',', '.') ?> VND</p>
              </td>
              <td>
                <a href="<?php echo base_url('delete-all-cart') ?>" class="btn btn-danger">Delete All</a>
                <a href="<?php echo base_url('checkout') ?>" class="btn btn-success">Order</a>
              </td>
            </tr>
          </tbody>
        </table>
      <?php } else {
        echo '<span class="text text-danger">add product</span>';
      } ?>
    </div>
  </div>
</section> <!--/#cart_items-->