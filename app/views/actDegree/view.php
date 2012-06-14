<?php
$this->breadcrumbs = array(
    'Act Degrees' => array('index'),
    $model->name,
);
$contextDesc = Yii::t('default', 'Available actions that may be taken on ActDegree.');
$this->menu = array(
    array('label' => Yii::t('default', 'Create a new ActDegree'), 'url' => array('create'), 'description' => Yii::t('default', 'This action create a new ActDegree')),
    array('label' => Yii::t('default', 'List ActDegree'), 'url' => array('index'), 'description' => Yii::t('default', 'This action list all Act Degrees, you can search, delete and update')),
);
?>
<div id="mainPage" class="main">
    <div class="twoColumn">
        <div class="columnone" style="padding-right: 1em">
            <div class="panelGroup form">
                <div class="panelGroupHeader"><div class=""><?php echo Yii::t('default', 'View ActDegree # ' . $model->ID . ' :') ?></div></div>
                <div class="panelGroupBody">
                    <?php
                    $this->widget('zii.widgets.CDetailView', array(
                        'data' => $model,
                        'attributes' => array(
                            'ID',
                            'name',
                            'stage',
                            'year',
                            'grade',
                            array(
                                'name' => 'degreeParent',
                                'value' => (isset($model->degreeParent0) ? $model->degreeParent0->name : "N/A"),
                            ),
                        ),
                    ));
                    ?>
                </div>   
            </div>
        </div>
        <div class="columntwo">
            <?php echo $this->renderPartial('////common/defaultcontext', array('contextDesc' => $contextDesc)); ?>        </div>
    </div>
</div>