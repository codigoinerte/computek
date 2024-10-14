<?php
require "../../admin/funciones/conecta.general.php";	
include URL_ROOT_ADMIN."funciones/constantes.php";
include URL_ROOT."librerias/mod_seo/clases/class.seo.php";
include URL_ROOT."librerias/mod_registros/mod.config.registro.php";
include URL_ROOT."librerias/mod_registros/panel.funciones.php";
?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="utf-8">
<!--[if IE]>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<![endif]-->
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<?php  include URL_ROOT."librerias/mod_seo/seo.php" ;  ?>
<!-- Mobile Specific -->
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

<!-- CSS Style -->
<link rel="stylesheet" type="text/css" href="<?php echo URL_WEB; ?>css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="<?php echo URL_WEB; ?>css/font-awesome.min.css" media="all">
<link rel="stylesheet" type="text/css" href="<?php echo URL_WEB; ?>css/simple-line-icons.css" media="all">
<link rel="stylesheet" type="text/css" href="<?php echo URL_WEB; ?>css/style.css" media="all">
<link rel="stylesheet" type="text/css" href="<?php echo URL_WEB; ?>css/revslider.css" >
<link rel="stylesheet" type="text/css" href="<?php echo URL_WEB; ?>css/owl.carousel.css">
<link rel="stylesheet" type="text/css" href="<?php echo URL_WEB; ?>css/owl.theme.css">
<link rel="stylesheet" type="text/css" href="<?php echo URL_WEB; ?>css/flexslider.css">
<link rel="stylesheet" type="text/css" href="<?php echo URL_WEB; ?>css/jquery.mobile-menu.css">
<link rel="stylesheet" type="text/css" href="<?php echo URL_WEB; ?>css/fancybox.css">

<!-- Google Fonts -->
<link href='https://fonts.googleapis.com/css?family=Open+Sans:700,600,800,400' rel='stylesheet' type='text/css'>
<link href='https://fonts.googleapis.com/css?family=Poppins:400,300,500,600,700' rel='stylesheet' type='text/css'>
</head>
<body class="cms-index-index">
  
<div class="container">
	<div class="row">
		<div class="col-xs-12">
			<div class="product-view">
			<div class="product-essential">
				
			  <div class="product-img-box col-lg-5 col-sm-5 col-xs-12">
				<div class="new-label new-top-left"> New </div>
				<div class="product-image">
				  <div class="product-full"> <img id="product-zoom" src="products-images/product1.jpg" data-zoom-image="products-images/product1.jpg" alt="product-image"/> </div>
				  <div class="more-views">
					<div class="slider-items-products">
					  <div id="gallery_01" class="product-flexslider hidden-buttons product-img-thumb">
						<div class="slider-items slider-width-col4 block-content">
						  <div class="more-views-items"> <a href="#" data-image="products-images/product2.jpg" data-zoom-image="products-images/product2.jpg"> <img id="product-zoom"  src="products-images/product2.jpg" alt="product-image"/> </a></div>
						  <div class="more-views-items"> <a href="#" data-image="products-images/product3.jpg" data-zoom-image="products-images/product3.jpg"> <img id="product-zoom"  src="products-images/product3.jpg" alt="product-image"/> </a></div>
						  <div class="more-views-items"> <a href="#" data-image="products-images/product4.jpg" data-zoom-image="products-images/product4.jpg"> <img id="product-zoom"  src="products-images/product4.jpg" alt="product-image"/> </a></div>
						  <div class="more-views-items"> <a href="#" data-image="products-images/product5.jpg" data-zoom-image="products-images/product5.jpg"> <img id="product-zoom"  src="products-images/product5.jpg" alt="product-image"/> </a> </div>
						  <div class="more-views-items"> <a href="#" data-image="products-images/product6.jpg" data-zoom-image="products-images/product6.jpg"> <img id="product-zoom"  src="products-images/product6.jpg" alt="product-image" /> </a></div>
						</div>
					  </div>
					</div>
				  </div>
				</div>
				<!-- end: more-images --> 
			  </div>
			  <div class="product-shop col-lg-7 col-sm-7 col-xs-12">
				<div class="product-name">
				  <h1>Wholesale Charming Blouse</h1>
				</div>
				<div class="ratings">
				  <div class="rating-box">
					<div style="width:60%" class="rating"></div>
				  </div>
				  <p class="rating-links"> <a href="#">1 Review(s)</a> <span class="separator">|</span> <a href="#">Add Your Review</a> </p>
				</div>
				<div class="price-block">
				  <div class="price-box">
					<p class="special-price"> <span class="price-label">Special Price</span> <span id="product-price-48" class="price"> $309.99 </span> </p>
					<p class="old-price"> <span class="price-label">Regular Price:</span> <span class="price"> $315.99 </span> </p>
					<p class="availability in-stock pull-right"><span>In Stock</span></p>
				  </div>
				</div>
				<div class="short-description">
				  <h2>Quick Overview</h2>
				  <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam fringilla augue nec est tristique auctor. Donec non est at libero vulputate rutrum. Morbi ornare lectus quis justo gravida semper. Nulla tellus mi, vulputate adipiscing cursus eu, suscipit id nulla. Donec a neque libero. Pellentesque aliquet, sem eget laoreet ultrices, ipsum metus feugiat sem, quis fermentum turpis eros eget velit. Donec ac tempus ante. </p>
				</div>
				<div class="add-to-box">
				  <div class="add-to-cart">
					<div class="pull-left">
					  <div class="custom pull-left">
						<button onClick="var result = document.getElementById('qty'); var qty = result.value; if( !isNaN( qty ) &amp;&amp; qty &gt; 0 ) result.value--;return false;" class="reduced items-count" type="button"><i class="fa fa-minus">&nbsp;</i></button>
						<input type="text" class="input-text qty" title="Qty" value="1" maxlength="12" id="qty" name="qty">
						<button onClick="var result = document.getElementById('qty'); var qty = result.value; if( !isNaN( qty )) result.value++;return false;" class="increase items-count" type="button"><i class="fa fa-plus">&nbsp;</i></button>
					  </div>
					</div>
					<button onClick="productAddToCartForm.submit(this)" class="button btn-cart" title="Add to Cart" type="button">Add to Cart</span></button>
				  </div>
				  <div class="email-addto-box">
					<ul class="add-to-links">
					  <li> <a class="link-wishlist" href="wishlist.html"><span>Add to Wishlist</span></a></li>
					  <li><span class="separator">|</span> <a class="link-compare" href="compare.html"><span>Add to Compare</span></a></li>
					</ul>
					<p class="email-friend"><a href="#" class=""><span>Email to a Friend</span></a></p>
				  </div>
				</div>
			  </div>
			
			</div>
			</div>		
		</div>
	</div>	
</div>     

<!--product-view--> 

<!-- JavaScript --> 
<script src="<?php echo URL_WEB; ?>js/jquery.min.js"></script> 
<script src="<?php echo URL_WEB; ?>js/bootstrap.min.js"></script> 
<script src="<?php echo URL_WEB; ?>js/common.js"></script> 
<script src="<?php echo URL_WEB; ?>js/jquery.flexslider.js"></script> 
<script src="<?php echo URL_WEB; ?>js/owl.carousel.min.js"></script> 
<script src="<?php echo URL_WEB; ?>js/jquery.mobile-menu.min.js"></script> 
<script src="<?php echo URL_WEB; ?>js/cloud-zoom.js"></script>

</body>
</html>