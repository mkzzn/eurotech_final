<!DOCTYPE html>

<?php
   include 'db/config.php';
   include 'db/open_db.php';
   $active_page = "products";
?>

<html>
  <head>

    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <meta name="keywords" content="Euro Tech, PG 1000" />
    <meta name="description" content="PG 1000 Cutting Tool Inspection System by Euro Tech" />
    <meta name="author" content="PG 1000" />
    <meta name="copyright" content="Copyright © 2012" />
    <meta http-equiv="Pragma" content="no-cache" />
    <meta http-equiv="Expires" content="-1" />
    <meta name="rating" content="general" />
    <meta name="expires" content="never" />
    <meta name="distribution" content="global" /><meta name="robots" content="index,follow" /><meta name="revisit-after" content="15 days" />

    <script type="text/javascript" src="js/Uize.js"></script>
    
    <title>PG 1000 Cutting Tool Inspection System by Euro-Tech | View Product</title>
    
    <link rel="stylesheet" type="text/css" media="all" href="css/primary.css" />

	  <link rel="stylesheet" href="css/page.css"/>

    <link href='http://fonts.googleapis.com/css?family=Droid+Sans|Cabin|Ubuntu|Cantarell|Open+Sans|Nobile|Telex' rel='stylesheet' type='text/css'>

	<style type="text/css">
		.rotationViewer {
			position:relative;
			width:640px;
			height:378px;
			border-style:solid;
			border-width:1px;
			margin:auto;
			margin-bottom:10px;
			cursor:pointer;
		}
		.rotationViewer img {
			position:absolute;
			visibility:hidden;
			left:0;
			top:0;
			width:100%;
			height:100%;
		}
	</style>

  </head>

  <body>
    <div id="container">
      <div id="header">
        <img id="pg1000_logo" src="images/pg1000_logo_small.png" />
        <img id="eurotech_logo" src="images/euro_tech_logo_large.png" height="160" />
        <div class="clear"></div>
      </div>
      <div class="clear"></div>

      <?php include "app/views/_nav.php"; ?>

<?php
   $result = mysql_query("select * from products where id = {$_GET['id']}") or die('Query failed. ' . mysql_error());

    // put all of the offics into an array
    $products = array();
    while($product = mysql_fetch_assoc($result)) {
      $products[] = $product;
    }
    $product = $products[0];
?>


      <div id="content">
        <h1>EuroTech <?php echo $product["product_name"]; ?></h1>
        <br /><br />

	<div id="page_rotationViewer" class="rotationViewer insetBorderColor"></div>

	<div style="text-align:center;">
		<a href="javascript://" class="linkedJs buttonLink" title="spin (360,2700,Uize.Curve.easeInOutPow (4))">360 clockwise</a><a href="javascript://" class="linkedJs buttonLink" title="spin (-360,2700,Uize.Curve.easeInOutPow (4))">360 counter-clockwise</a><a href="javascript://" class="linkedJs buttonLink" title="spin (1080,4000,Uize.Curve.easeInOutPow (4))">3 spins</a><a href="javascript://" class="linkedJs buttonLink" title="spin (360,2700,Uize.Curve.Rubber.easeOutBounce (5,-2,1.5))">spin with bounce</a><a href="javascript://" class="linkedJs buttonLink" title="spin (360,4000,Uize.Curve.Mod.bend (Uize.Curve.Rubber.easeOutElastic (.1),3))">spin with elasticity</a>
	</div>

      </div>



      <?php include 'app/views/_footer.php'; ?>

      <div class="clear"></div>
	  </div>

<script type="text/javascript">

Uize.module ({
	required:[
		'UizeDotCom.Page.Example.library',
		'UizeDotCom.Page.Example',
		'Uize.Widget.Drag',
		'Uize.Fade.xFactory',
		'Uize.Curve.Rubber',
		'Uize.Curve.Mod'
	],
	builder:function () {
		/*** create the example page widget ***/
			var page = window.page = UizeDotCom.Page.Example ({evaluator:function (code) {eval (code)}});

		/*** configuration variables ***/
			var
      totalFrames = <?php echo $product['image_quantity']; ?>,
				frameUrlTemplate =
					"/images/360/<?php echo $product['images_directory']; ?>/<?php echo $product['image_name']; ?>_[#frame].jpg"
			;

		/*** state variables ***/
			var
				rotation = 0,
				lastFrameNo = -1,
				dragStartRotation
			;

		/*** create the Uize.Widget.Drag instance ***/
			var rotationViewer = page.addChild (
				'rotationViewer',
				Uize.Widget.Drag,
				{
					cancelFade:{duration:5000,curve:Uize.Curve.Rubber.easeOutBounce ()},
					releaseTravel:function (speed) {
						var
							deceleration = 5000, // measured in pixels/s/s
							duration = speed / deceleration
						;
						return {
							duration:duration,
							distance:Math.round (speed * duration / 2),
							curve:function (_value) {return 1 - (_value = 1 - _value) * _value}
						};
					},
					html:function (input) {
						var
							htmlChunks = [],
							frameNodeIdPrefix = input.idPrefix + '-frame'
						;
						for (var frameNo = 0; ++frameNo <= totalFrames;) {
							htmlChunks.push (
								'<img' +
									' id="' + frameNodeIdPrefix + frameNo + '"' +
									' src="' + Uize.substituteInto (frameUrlTemplate,{frame:(frameNo < 10 ? '0' : '') + frameNo}) +'"' +
								'/>'
							);
						}
						return htmlChunks.join ('');
					},
					built:false
				}
			);

		/*** wire up the drag widget with events for updating rotation degree ***/
			function updateRotation (newRotation) {
				rotation = ((newRotation % 360) + 360) % 360;
				var frameNo = 1 + Math.round (rotation / 360 * (totalFrames - 1));
				if (frameNo != lastFrameNo) {
					rotationViewer.showNode ('frame'+ lastFrameNo,false);
					rotationViewer.showNode ('frame'+ (lastFrameNo = frameNo));
				}
			}
			rotationViewer.wire ({
				'Drag Start':function () {dragStartRotation = rotation},
				'Drag Update':function (e) {updateRotation (dragStartRotation - e.source.eventDeltaPos [0] / 2.5)}
			});

		/*** function for animating spin ***/
			function spin (degrees,duration,curve) {
				Uize.Fade.fade (updateRotation,rotation,rotation + degrees,duration,{quantization:1,curve:curve});
			}

		/*** initialization ***/
			Uize.Node.wire (window,'load',function () {spin (360,2700,Uize.Curve.easeInOutPow (4))});

		/*** wire up the page widget ***/
			page.wireUi ();
	}
});

</script>


  </body>
</html>
