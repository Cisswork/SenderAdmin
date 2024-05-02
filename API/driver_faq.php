
<?php include('config.php'); ?>
<body style="background-color: FAFAFA;">
<title>FAQ </title>

<!-- // Header Begin -->
    <?php include('header.php'); ?>
<!-- // Header End -->


<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css">
<style>
.click{
  background:#efefef;
  height:auto;
  cursor:pointer;
  margin-top:10px;
  padding:10px;
}

.click i{
     color: #b7acac;
    font-size: 12px;
    margin-top: 5px;
}
.col-lg-12 {
    font-size: 30px;
}
.content{
  display:none
}

.rotate {
    transform: rotate(-180deg);
    /*transform: rotate(180deg);*/
    transition: .3s;
}
.rotate-reset {
    transform: rotate(0deg);
    transition: .3s;
}
p.click.col-lg-12 {
    background-color: #F15928;
    color: #fff;
}
    
p i{
  float:right
}
</style>

<!-- // Header Image Begin -->

<!-- // Header Image Begin -->

<!-- // Single Product Description Begin -->
<section class="ftco-section" >
    <div class="container">
        <div class="row">
            <?php 
               $sql=mysqli_query($con,"SELECT * FROM driver_faq WHERE type='Admin'");
                $num=mysqli_num_rows($sql);
                while($row=mysqli_fetch_assoc($sql)){
        $f_id  = $row['f_id '];
            ?>
            <div class="col-lg-12">
              <p class="click col-lg-12"> <?php echo $row['ques']; ?>
             <i class="fa fa-arrow-down rotate-reset arrow"></i>
              </p>
              <div class="content"><?php echo $row['answer']; ?></div>
            </div>
             <?php } ?>
           

        </div>
    </div>
</section>

<!-- // Footer Begin -->
    <?php include('footer.php'); ?>
<!-- // Footer End -->

<!-- Tab Script -->
<script>

$(document).ready(function(){
  $(".click").click(function () {
    $(this).next("div.content").slideToggle("fast");
     $(this).find(".arrow").toggleClass('rotate');
      $(this).find(".arrow").toggleClass('rotate-reset');
    
  });
});</script>
<!-- Tab Script -->

</body>
</html>
