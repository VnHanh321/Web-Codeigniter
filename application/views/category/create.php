<div class="container">
  <div class="card">
    <div class="card-header">
      Create category
    </div>
    <div class="card-body">
      <a href="<?php echo base_url('category/list') ?>" class="btn btn-primary">List category</a>
      <?php
      if ($this->session->flashdata('success')) {
        echo '<div class="alert alert-success">' . $this->session->flashdata('success') . '</div>';
      } elseif ($this->session->flashdata('error')) {
        echo '<div class="alert alert-danger">' . $this->session->flashdata('error') . '</div>';
      }
      ?>
      <form action="<?php echo base_url('category/store') ?>" method="POST" enctype="multipart/form-data">
        <!-- enctype="multipart/form-data": chia nho anh upload server -->
        <div class=" mb-3">
          <label for="exampleInputEmail1" class="form-label">Title</label>
          <input type="text" name="title" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
          <?php echo '<span class="text text-danger">' . form_error('title') . '</span>'; ?>
        </div>
        <div class=" mb-3">
          <label for="exampleInputEmail1" class="form-label">Slug</label>
          <input type="text" name="slug" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
          <?php echo '<span class="text text-danger">' . form_error('slug') . '</span>'; ?>
        </div>
        <div class="mb-3">
          <label for="exampleInputPassword1" class="form-label">Description</label>
          <input type="text" name="description" class="form-control" id="exampleInputPassword1">
          <?php echo '<span class="text text-danger">' . form_error('description') . '</span>'; ?>
        </div>
        <div class="mb-3">
          <label for="exampleInputPassword1" class="form-label">Image</label>
          <input type="file" name="image" class="form-control-file" id="exampleInputPassword1">
          <small><?php if (isset($error)) {
            echo $error;
          } ?></small>
        </div>
        <div class="mb-3">
          <div class="form-group">
            <label for="exampleFormControlSelect1">Status</label>
            <select class="form-control" name="status" id="exampleFormControlSelect1">
              <option value="1">Active</option>
              <option value="0">Inactive</option>
            </select>
          </div>
        </div>
        <div class="mb-3">
          <button type="submit" class="btn btn-primary">Submit</button>
        </div>
      </form>
    </div>
  </div>
</div>