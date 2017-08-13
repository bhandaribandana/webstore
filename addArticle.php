<?php require_once('includes/configs.php'); ?>
<?php require_once('common/header.php'); ?>
<?php
if(isset($_POST['add']) && $_POST['add']=='ADD')
  {
    $uid=$_SESSION['user'];
    $title=trim($_POST['title']);
    $content=$_POST['content'];

    if(isset($_FILES['pic'])){
      $target_dir = "uploads/";
      $msg='';
      $target_file = $target_dir . basename($_FILES["pic"]["name"]);
      $uploadOk = 1;
      $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
      $target_file = $target_dir .date('YmdHis').'_'.$uid.'.'.$imageFileType;

      // Check file size
      if ($_FILES["pic"]["size"] > 500000) {
          $msg.="Sorry, your file is too large.";
          $stat=0;
          $uploadOk = 0;
      }
      // Allow certain file formats
      if($imageFileType != "jpg" && $imageFileType != "jpeg") {
          $uploadOk = 0;
          $msg.=" Sorry, only JPG, JPEG files are allowed.";
          $stat=0;
      }
      // Check if $uploadOk is set to 0 by an error
      if ($uploadOk == 0) {
          $msg.=" Sorry, your file was not uploaded.";
          $stat=0;
      // if everything is ok, try to upload file
      } else {
          if (move_uploaded_file($_FILES["pic"]["tmp_name"], $target_file)) 
          {
              $sql = "INSERT INTO tbl_article ( title, content, uid, image, status)
              VALUES ('$title', '$content', '$uid','$target_file' ,0)";

              if (mysqli_query($conn, $sql)) {
                  $msg="Article Uploaded successfully";
                  $stat=1;
              } else {
                  $msg="Error: " . $sql . "<br>" . mysqli_error($conn);
                  $stat=0;
              }
          } else {
            $msg="Sorry, there was an error uploading your file.";
            $stat=0;
          }
      }
    }
    
  }
  ?>
<div class="jumbotron">
	<div class="container">
	  	<h1>Add Article</h1>
	  </div>
</div>
<div class="container">

    <div class="row">
	    <div class="col-sm-12">
        <?php if(isset($msg) && $stat===1){ ?>
            <div class='alert alert-success'> 
            <?=$msg?>
            </div>
          <?php } else if(isset($msg) && $stat===0){ ?>
            <div class='alert alert-danger'>
              <?=$msg?>
            </div>
          <?php } ?>
          <form class="form-horizontal" method="post" enctype="multipart/form-data">
              <section class="panel panel-default">
                  <div class="panel-body">
                      <div class="form-group">
                          <label class="col-sm-3 control-label">Title:</label>
                          <div class="col-sm-3">
                              <input type="text" required name="title" class="form-control" placeholder="First Name"> </div>
                      </div>
                      <div class="form-group">
                          <label class="col-sm-3 control-label">Content:</label>
                          <div class="col-sm-7">
                              <textarea class="form-control ckeditor" required name="content" placeholder="Last Name" rows="5"  > </textarea>
                      	</div>
                  	</div>
                      <div class="form-group">
                          <label class="col-sm-3 control-label">Picture:</label>
                          <div class="col-sm-3">
                              <input type="file" name="pic" required class="input-file" accept="image/*" > </div>
                      </div>
                  </div>
                  <footer class="panel-footer text-left bg-light lter">
                      <button type="submit" name="add" value="ADD" class="btn btn-success btn-s-xs">Submit</button>
                      <button type="reset" class="btn btn-danger btn-s-xs">Cancel</button>
                  </footer>
              </section>
          </form>
      </div>
    </div>

<?php require_once('common/footer.php'); ?>
<script src="//cdn.ckeditor.com/4.5.11/standard/ckeditor.js"></script>
