<div id="mainPage" class="main">
    <?php
$this->breadcrumbs=array(
	'Act Scripts'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

    $title=Yii::t('default', 'Update ActScript: ');
    $contextDesc = Yii::t('default', 'Available actions that may be taken on ActScript.');
    $this->menu=array(
    array('label'=> Yii::t('default', 'Create a new ActScript'), 'url'=>array('create'),'description' => Yii::t('default', 'This action create a new ActScript')),
    array('label'=> Yii::t('default', 'List ActScript'), 'url'=>array('index'),'description' => Yii::t('default', 'This action list all Act Scripts, you can search, delete and update')),
    );  
    ?>

    <div class="twoColumn">
        <div class="columnone" style="padding-right: 1em">
            <?php echo $this->renderPartial('_form', array('model'=>$model,'title'=>$title,'contentsin'=>$contentsin,'contentsout'=>$contentsout)); ?>        </div>
        <div class="columntwo">
            <?php echo $this->renderPartial('////common/defaultcontext', array('contextDesc'=>$contextDesc)); ?>        </div>
    </div>
</div>