<?php defined('SYSPATH') OR die('No direct access allowed.'); ?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:fb="http://www.facebook.com/2008/fbml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
		<title>IFrame Base Facebook Application Development</title>

		<script type="text/javascript">
			var fbUtils = { 
			    iframeSize : function(width,height) {
	                var obj    = new Object;
	                obj.width  = width;
	                obj.height = height;
	                FB.Canvas.setSize(obj);
	            },
            	autoSize : function() {
	            	FB.Canvas.setAutoResize();
	            }
            }
		</script>
	</head>
	<body>
		<div id="fb-root"></div>
		<script type="text/javascript" src="http://connect.facebook.net/<?=FB::$config['lang']?>/all.js"></script>
		<script type="text/javascript">
			FB.init({
				appId  : '<?=FB::$config['appId']?>',
				status : <?=FB::$config['status']?>,
				cookie : <?=FB::$config['cookie']?>,
				xfbml  : <?=FB::$config['xfbml']?>
			});
		</script>
		
		<div id="canvas">
			<?=$canvas?>
		</div>	
		
		<script type="text/javascript">
			fbUtils.autoSize();
		</script>	
	</body>
</html>