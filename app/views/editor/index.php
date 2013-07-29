 <?php
    if (isset($_POST['commonType']) && isset($_POST['cobjectTemplate']) 
        && isset($_POST['cobjectTheme']) && isset($_POST['actGoal'])){
        $commonType = $_POST['commonType'];
        $cobjectTemplate =  $_POST['cobjectTemplate'];
        $cobjectTheme =  $_POST['cobjectTheme'];
        $actGoal = $_POST['actGoal'];
        $mode = 'new';
     }
     elseif(isset($_GET['cID'])){
         $cobjectID = $_GET['cID'];
         $mode = 'edit';
     }elseif (isset($_POST['cobjectID'])) {
         $cobjectID = $_POST['cobjectID'];
         $mode = 'edit';
     }
     else{ 
          throw new Exception('ERROR: RQEUEST Inválido');
     }
$this->breadcrumbs=array(
	'Editor', 
);?>
<script language ="javascript" type="text/javascript">
<?php 
   if($mode == 'new'){
       echo "newEditor.COtypeID = $commonType ; \n" ; 
       echo "newEditor.COthemeID = $cobjectTheme; \n" ;
       echo "newEditor.COtemplateType = $cobjectTemplate; \n"; 
       echo "newEditor.COgoalID = $actGoal; \n"; 
   }
   else{
       echo "newEditor.CObjectID = $cobjectID; \n";
   }
   echo "newEditor.mode = '$mode'; \n";
?>
</script>

<header>
    <hgroup>
        <h1>TAG</h1>
        <ul>
            <li class="new"><?php echo Yii::t('default', 'New'); ?></li>
            <li class="save"><?php echo Yii::t('default', 'Save'); ?></li>
        </ul>
        <span class="clear"></span>
    </hgroup>
</header>
<div id="toolbar" class="toolbar">
    <h2><?php echo Yii::t('default', 'Add'); ?></h2>
    <ul class="tools">
        <li id="addPieceSet"><?php echo Yii::t('default', 'Add PieceSet'); ?></li>
    </ul>
</div>
<div class="canvas">
    <button class="themebutton" id="addScreen"><?php echo Yii::t('default', 'Add Screen'); ?></button>
    <ul class="navscreen"></ul>
    <button class="themebutton" id="delScreen"><?php echo Yii::t('default', 'Remove Screen'); ?></button>
    <span class="clear"></span>
    <div class="content">
        <div class="screen" id="sc0">
        </div>
    </div>
</div>
