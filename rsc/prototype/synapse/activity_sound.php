<?php
session_start();
$SQLim = "SELECT extension FROM sound WHERE id=".$linhae['element_id']."";
$resim = pg_query($SQLim);
$linhaim = pg_fetch_array($resim);
$sound = "activity/sound/".$linhae['element_id'].".".$linhaim['extension'];		
?>
<div id="<?php echo $i; ?>" class="div<?php echo $i; ?>" onmousemove="LayerEvents(event, <?php echo $i; ?>)" onmousedown="LayerEvents(event, <?php echo $i; ?>)" onmouseup="LayerEvents(event, <?php echo $i; ?>)" style="width: <?php echo $divwidth; ?>; height: <?php echo $divheight; ?>; left: <?php echo $divleft ?>; top: <?php echo $divtop; ?>;">
	<div style="position:absolute; left:0px; top:0px; width:<?php echo $divwidth1; ?>px; height:<?php echo $divheight; ?>px;" onMouseOver="MM_showHideLayers('cursor<?php echo $i; ?>','','show');MM_showHideLayers('delete<?php echo $i; ?>','','show');MM_showHideLayers('resize<?php echo $i; ?>','','show')" onMouseOut="MM_showHideLayers('cursor<?php echo $i; ?>','','hide');MM_showHideLayers('delete<?php echo $i; ?>','','hide');MM_showHideLayers('resize<?php echo $i; ?>','','hide')">
		<div style="position:absolute; left:0px; top:0px; width:16px; height:16px; background-image: url(images/cursor.gif); visibility:hidden;" id="cursor<?php echo $i; ?>"></div>
		<?php
		echo "<a href='activity.php?acao=editar";
if(isset($blockname_varchar) && $blockname_varchar!=""){echo "&blockname_varchar=".$blockname_varchar;}
if(isset($block_content) && $block_content!=""){echo "&block_content=".$block_content;}
if(isset($discipline) && $discipline!=""){echo "&discipline=".$discipline;}
if(isset($semantic_id) && $semantic_id!=""){echo "&semantic_id=".$semantic_id;}
if(isset($semanticname) && $semanticname!=""){echo "&semanticname=".$semanticname;}
if(isset($screen) && $screen!=""){echo "&screen=".$screen;}
if(isset($totalscreen) && $totalscreen!=""){echo "&totalscreen=".$totalscreen;}
if(isset($goal_id) && $goal_id!=""){echo "&goal_id=".$goal_id;}
if(isset($activity_id) && $activity_id!=""){echo "&activity_id=".$activity_id;}
if(isset($activitytype_id) && $activitytype_id!=""){echo "&activitytype_id=".$activitytype_id;}
		echo "&piece_id=".$linhae['piece_id'];
		echo "&piecename=".$linhae['piecename'];
		echo "&piece_element=".$linhae['piece_element_id'];
		echo "&element_id=".$linhae['element_id'];
		echo "&elementtype_id=".$linhae['elementtype_id'];
		echo "&typename=".$linhae['typename'];
		echo "&layertype_id=".$linhae['layertype_id'];
		echo "&layer_property_id=".$linhae['layer_property_id'];
		echo "' style='text-decoration:none;'>";
			echo "<img src='images/sound.gif' border='0'>";//onClick='PlaySound(".$sound.")'
		echo "</a>"; ?>
		<div style="position:absolute; left: <?php echo $divleft1; ?>; top: 0; width:16px; height:16px; visibility: hidden;" id="delete<?php echo $i; ?>" onMouseOver="MM_showHideLayers('resize<?php echo $i; ?>','','show')" onMouseOut="MM_showHideLayers('resize<?php echo $i; ?>','','hide')"><?php
			echo "<a href='activity.php?";
			echo "acao=excluir&";
			echo "screen=".$screen."&";
			echo "totalscreen=".$totalscreen."&";
			echo "activity_id=".$activity_id."&";
			echo "piece_element=".$linhae['piece_element_id']."&";
			echo "piece_id=".$linhae['piece_id']."&";
			echo "semanticname=".$semanticname."&";
			echo "goal_id=".$goal_id."&";
			echo "peseq=".$peseq."&";
			echo "piecename=".$piecename."&";
			echo "activitytype_id=".$activitytype_id;
			echo "'>"; ?>
				<img src="images/delete.png" border="0">
			</a>
		</div>
		<div style="position:absolute; left: <?php echo $divleft1; ?>; top: <?php echo $divtop1; ?>; width:16px; height:16px; background-image: url(images/cursor.gif); visibility: hidden;" id="resize<?php echo $i; ?>"></div>
	</div>
</div>