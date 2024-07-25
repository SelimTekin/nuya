<!DOCTYPE html>
<html lang="en">
   <head>

<?php include 'includes/header.php'; ?>
<!-- IK CSS -->
<!-- IK JS -->

   </head>
   <!-- body -->
   <body class="main-layout">
	<!-- header section start -->
	<div class="header_section header_main">
		<?php
			require "includes/navbar.php";
		?>
	</div>
	<!-- new collection section start -->
  <div class="collection_text">Koleksiyon</div>
    <div class="layout_padding collection_section">
    	<div class="container">
    	    <h1 class="new_text"><strong>Yeni Koleksiyon</strong></h1>
    	    <p class="consectetur_text">consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation</p>
    	    <div class="collection_section_2">
    	    	<div class="row">
    	    		<div class="col-md-6">
    	    			<div class="about-img">
    	    				<button class="new_bt">Yeni</button>
    	    				<div class="shoes-img"><img src="<?=base_url("images/shoes-img1.png")?>"></div>
    	    				<p class="sport_text">Erkek Spor Ayakkabı</p>
    	    				<div class="dolar_text">$<strong style="color: #f12a47;">90</strong> </div>
    	    				<div class="star_icon">
    	    					<ul>
    	    						<li><a href="#"><img src="<?= base_url("images/star-icon.png")?>"></a></li>
    	    						<li><a href="#"><img src="<?= base_url("images/star-icon.png")?>"></a></li>
    	    						<li><a href="#"><img src="<?= base_url("images/star-icon.png")?>"></a></li>
    	    						<li><a href="#"><img src="<?= base_url("images/star-icon.png")?>"></a></li>
    	    						<li><a href="#"><img src="<?= base_url("images/star-icon.png")?>"></a></li>
    	    					</ul>
    	    				</div>
    	    			</div>
    	    			<button class="seemore_bt">Daha Fazlası</button>
    	    		</div>
    	    		<div class="col-md-6">
    	    			<div class="about-img2">
    	    				<div class="shoes-img2"><img src="<?=base_url("images/shoes-img2.png")?>"></div>
    	    				<p class="sport_text">Erkek Spor Ayakkabı</p>
    	    				<div class="dolar_text">$<strong style="color: #f12a47;">90</strong> </div>
    	    				<div class="star_icon">
    	    					<ul>
    	    						<li><a href="#"><img src="<?= base_url("images/star-icon.png")?>"></a></li>
    	    						<li><a href="#"><img src="<?= base_url("images/star-icon.png")?>"></a></li>
    	    						<li><a href="#"><img src="<?= base_url("images/star-icon.png")?>"></a></li>
    	    						<li><a href="#"><img src="<?= base_url("images/star-icon.png")?>"></a></li>
    	    						<li><a href="#"><img src="<?= base_url("images/star-icon.png")?>"></a></li>
    	    					</ul>
    	    				</div>
    	    			</div>
    	    		</div>
    	    	</div>
    	    </div>
    	</div>
    </div>

	<?php
			require "includes/footer.php";
		?>

   </body>
</html>
