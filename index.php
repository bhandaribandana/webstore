
<?php require_once('common/header.php'); ?>
    <!-- Page Content -->
    <div id="myCarousel" class="carousel slide" data-ride="carousel">
      <!-- Indicators -->
      <ol class="carousel-indicators">
        <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
        <li data-target="#myCarousel" data-slide-to="1"></li>
        <li data-target="#myCarousel" data-slide-to="2"></li>
      </ol>
      <!-- Wrapper for slides -->
      <div class="carousel-inner" role="listbox">
        <div class="item active">
          <img src="<?=ASSETS?>img/slide1.jpg" alt="...">
        </div>
        <div class="item">
          <img src="<?=ASSETS?>img/slide3.jpg" alt="...">
        </div>

        <div class="item">
          <img src="<?=ASSETS?>img/slide2.jpg" alt="...">
        </div>
      </div>
      <!-- Left and right controls -->
      <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
        <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
      </a>
      <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
        <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
      </a>
    </div>

    <div class="container">

        <div class="row">

            <!-- Blog Post Content Column -->
           <div class="col-xs-12 col-sm-12">
              <p class="pull-right visible-xs">
                <button type="button" class="btn btn-primary btn-xs" data-toggle="offcanvas">Toggle nav</button>
              </p>
              <div class="row">
                <?php
                $sql = "SELECT * FROM tbl_article WHERE status=1 ORDER BY id DESC";
                $result = mysqli_query($conn, $sql);

                if (mysqli_num_rows($result) > 0) {
                    // output data of each row
                  $i=1;
                    while($row = mysqli_fetch_assoc($result)) {
                        ?>
                         <div class="col-xs-6 col-lg-6 ">
                          <h2><?=$row['title']?></h2>
                          <?php                                           
                                $desc = $row['content'];
                                $stringCut = substr($desc,0,250);
                                $string = substr($stringCut, 0, strrpos($stringCut, ' ')).'...';
                          ?>
                          <p><?=strip_tags($string);?> </p>
                          <p><a class="btn btn-default" href="viewDetail.php?id=<?=$row['id']?>" role="button">View details »</a></p>
                        </div>
                        <?php if($i%2==0){?><div class="clearfix"></div><?php } $i++;?>
                        <?php
                    }
                } else { ?>
                    <div class="col-xs-12">
                          <br/><div class="alert alert-info text-center">No Article Available.</div>
                        </div>
                    <?php
                }?>
              </div><!--/row-->
            </div>
        </div>
        <!-- /.row -->

        <hr>

       
    <!-- /.container -->
<?php require_once('common/footer.php'); ?>