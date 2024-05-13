<div class="container">
  <div class="card">
    <div class="card-header">
      Edit Brand
    </div>
    <div class="card-body">
      <?php
      if ($this->session->flashdata('success')) {
        echo '<div class="alert alert-success">' . $this->session->flashdata('success') . '</div>';
      } elseif ($this->session->flashdata('error')) {
        echo '<div class="alert alert-danger">' . $this->session->flashdata('error') . '</div>';
      }
      ?>
      <form action="<?php echo base_url('brand/update/' . $brand->id); ?>" method="POST" enctype="multipart/form-data">
        <!-- enctype="multipart/form-data": chia nho anh upload server -->
        <div class=" mb-3">
          <label for="exampleInputEmail1" class="form-label">Title</label>
          <input type="text" name="title" value="<?php echo $brand->title ?>" class="form-control"
            id="exampleInputEmail1" aria-describedby="emailHelp">
          <?php echo '<span class="text text-danger">' . form_error('title') . '</span>'; ?>
        </div>
        <div class=" mb-3">
          <label for="exampleInputEmail1" class="form-label">Slug</label>
          <input type="text" name="slug" value="<?php echo $brand->slug ?>" class="form-control" id="exampleInputEmail1"
            aria-describedby="emailHelp">
          <?php echo '<span class="text text-danger">' . form_error('slug') . '</span>'; ?>
        </div>
        <div class="mb-3">
          <label for="exampleInputPassword1" class="form-label">Description</label>
          <input type="text" name="description" value="<?php echo $brand->description ?>" class="form-control"
            id="exampleInputPassword1">
          <?php echo '<span class="text text-danger">' . form_error('description') . '</span>'; ?>
        </div>
        <div class="mb-3">
          <label for="exampleInputPassword1" class="form-label">Image</label>
          <input type="file" name="image" class="form-control-file" id="exampleInputPassword1">
          <img src="<?php echo base_url('uploads/brand/' . $brand->image) ?>" width="150" height="150">
          <small><?php if (isset($error)) {
            echo $error;
          } ?></small>
        </div>
        <div class="mb-3">
          <div class="form-group">
            <label for="exampleFormControlSelect1" class="form-label">Status</label>
            <select class="form-control" name="status" id="exampleFormControlSelect1">
              <?php if ($brand->status == 1) {
                ?>
                <option selected value="1">Active</option>
                <option value="0">Inactive</option>
                <?php
              } else {
                ?>
                <option value="1">Active</option>
                <option selected value="0">Inactive</option>
                <?php
              }
              ?>
            </select>
          </div>
        </div>
        <div class="mb-3">
          <button type="submit" class="btn btn-primary">Update</button>
        </div>
      </form>
    </div>
  </div>
</div>