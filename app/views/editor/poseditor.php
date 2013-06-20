<?php
  $num_img = count($property_img);
?>
<html>
	<head>
		<meta http-equiv="Content-type" content="text/html; charset=utf-8">
		<title>Recorte de Imagens</title>
		<link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl;?>/css/rendereditor/poseditor/exemplo.css" type="text/css" />
		<link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl;?>/css/rendereditor/poseditor/jquery.Jcrop.css" type="text/css" />
                               
                <script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/poseditor/jquery.min.js"></script>
                <script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/poseditor/jquery.Jcrop.js"></script>
         
	</head>
	<body>
		
		<h1>Recorte de Imagens</h1>
		
		<?php if( $property_img[0]['tem_crop'] === true ){ 
                         for($i = 0; $i < $num_img; $i++) {   
                    ?>
                   
                <!-- 2° Parte -->
			<h2 id="tit-jcrop<?php echo $i ; ?>" class="tit-jcrop">Recorte a imagem: <?php echo $property_img[$i]['name_img']; ?></h2>
			<div id="div-jcrop<?php echo $i ; ?>">
				
				<div id="div-preview<?php echo $i ; ?>">
					<?php echo $property_img[$i]['preview']; ?>
				</div>
				
				<?php echo $property_img[$i]['img']; ?>
				
				<input type="button" value="Salvar" id="btn-crop<?php echo $i ; ?>" />
			</div>
			<div id="debug<?php echo $i ; ?>">
				<p><strong>X</strong> <input type="text" id="x<?php echo $i ; ?>" size="5" disabled /> x <input type="text" id="x2<?php echo $i ; ?>" size="5" disabled /> </p>
				<p><strong>Y</strong> <input type="text" id="y<?php echo $i ; ?>" size="5" disabled /> x <input type="text" id="y2<?php echo $i ; ?>" size="5" disabled /> </p>
				<p><strong>Dimensões</strong> <input type="text" id="h<?php echo $i ; ?>" size="5" disabled /> x <input type="text" id="w<?php echo $i ; ?>" size="5" disabled /></p>
			</div>
			<script type="text/javascript">
				var img = '<?php echo $property_img[$i]['newDir']; ?>';
                                var img_url = '<?php echo $property_img[$i]['newUrl']; ?>'
                                 window.alert(img);
				$(function(){                                    
					$('#jcrop<?php echo $i ; ?>').Jcrop({
						onChange: exibePreview,
						onSelect: exibePreview,
						aspectRatio: 1
					});
					$('#btn-crop<?php echo $i ; ?>').click(function(){
						$.post( 'poseditor', {
							img:img, 
							x: $('#x<?php echo $i ; ?>').val(), 
							y: $('#y<?php echo $i ; ?>').val(), 
							w: $('#w<?php echo $i ; ?>').val(), 
							h: $('#h<?php echo $i ; ?>').val()
						}, function(){
							$('#div-jcrop<?php echo $i ; ?>').html( '<img src="' + img_url + '?' + Math.random() + '" width="'+$('#w').val()+'" height="'+$('#h').val()+'" />' );
							$('#debug<?php echo $i ; ?>').hide();
							$('#tit-jcrop<?php echo $i ; ?>').html('Feito!<br /><a href="poseditor">enviar outra imagem</a>'); // see-> 'retirar'
						});
						return false;
					});
				});
				
				function exibePreview(c)
				{
					var rx = 100 / c.w;
					var ry = 100 / c.h;
				
					$('#preview<?php echo $i ; ?>').css({
						width: Math.round(rx * <?php echo $property_img[$i]['imagesize'][0]; ?>) + 'px',
						height: Math.round(ry * <?php echo $property_img[$i]['imagesize'][1]; ?>) + 'px',
						marginLeft: '-' + Math.round(rx * c.x) + 'px',
						marginTop: '-' + Math.round(ry * c.y) + 'px'
					});
					
					$('#x<?php echo $i ; ?>').val(c.x);
					$('#y<?php echo $i ; ?>').val(c.y);
					$('#x2<?php echo $i ; ?>').val(c.x2);
					$('#y2<?php echo $i ; ?>').val(c.y2);
					$('#w<?php echo $i ; ?>').val(c.w);
					$('#h<?php echo $i ; ?>').val(c.h);
					
				};
			</script>
		<?php
                
                         }
                }?>
		
	</body>
</html>