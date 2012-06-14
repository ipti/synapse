<?php

class ActGoalController extends Controller {

    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout = 'fullmenu';

    /**
     * @return array action filters
     */
    public function filters() {
        return array(
            'accessControl', // perform access control for CRUD operations
        );
    }

    /**
     * Specifies the access control rules.
     * This method is used by the 'accessControl' filter.
     * @return array access control rules
     */
    public function accessRules() {
        return array(
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions' => array('index', 'view', 'create', 'update', 'loadcontent'),
                'users' => array('@'),
            ),
            array('allow', // allow admin user to perform 'admin' and 'delete' actions
                'actions' => array('admin', 'delete'),
                'users' => array('admin'),
            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }

    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionView($id) {
        $this->render('view', array(
            'model' => $this->loadModel($id),
        ));
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate() {
        $model = new ActGoal;
        Yii::app()->clientScript->registerScriptFile(Yii::app()->createUrl('/assets/js/',array('file'=>'common.js')),CClientScript::POS_END); 
        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['ActGoal'])) {
            $model->attributes = $_POST['ActGoal'];
            if ($model->save()) {
                Yii::app()->user->setFlash('success', Yii::t('default', 'ActGoal Created Successful:'));
                foreach ($_POST['ActGoalModality'] as $m) {
                    $modality = new ActGoalModality();
                    $modality->modalityID = (int) $m;
                    $modality->goalID = (int) $model->ID;
                    $modality->save();
                }
                foreach ($_POST['ActGoalSkill'] as $s) {
                    $skill = new ActGoalSkill();
                    $skill->skillID = (int) $s;
                    $skill->goalID = (int) $model->ID;
                    $skill->save();
                }
                foreach ($_POST['ActGoalContent'] as $c) {
                    $content = new ActGoalContent();
                    $content->contentID = (int) $c;
                    $content->goalID = (int) $model->ID;
                    $content->save();
                }
                $this->redirect(array('index'));
            }
        }

        $this->render('create', array(
            'model' => $model,
        ));
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate($id) {
        Yii::app()->clientScript->registerScriptFile(Yii::app()->createUrl('/assets/js/',array('file'=>'common.js')),CClientScript::POS_END);
        $model = $this->loadModel($id);
        $modalities = ActGoalModality::model()->findAllByAttributes(array('goalID' => $id));
        $skills = ActGoalSkill::model()->findAllByAttributes(array('goalID' => $id));
        $contents = ActGoalContent::model()->findAllByAttributes(array('goalID' => $id));

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['ActGoal'])) {
            $model->attributes = $_POST['ActGoal'];
            if ($model->save()) {
                $imodalities = $iskills = $icontents = array();
                foreach ($modalities as $modality) {
                    $imodalities[] = $modality->modalityID;
                }
                foreach ($skills as $skill) {
                    $iskills[] = $skill->skillID;
                }
                foreach ($contents as $content) {
                    $icontents[] = $content->contentID;
                }
                if (isset($_POST['ActGoalModality'])) {
                    $removed = array_diff($imodalities, $_POST['ActGoalModality']);
                    ActGoalModality::model()->deleteAllByAttributes(array('goalID' => $model->ID, 'modalityID' => array_values($removed)));
                    $insert = array_diff($_POST['ActGoalModality'], $imodalities);
                    if (isset($insert)) {
                        foreach ($insert as $in) {
                            $d = new ActGoalModality();
                            $d->goalID = $model->ID;
                            $d->modalityID = $in;
                            $d->save();
                        }
                    }
                } else {
                    ActGoalModality::model()->deleteAllByAttributes(array('goalID' => $model->ID));
                }
                if (isset($_POST['ActGoalSkill'])) {
                    $removed = array_diff($iskills, $_POST['ActGoalSkill']);
                    ActGoalSkill::model()->deleteAllByAttributes(array('goalID' => $model->ID, 'skillID' => array_values($removed)));
                    $insert = array_diff($_POST['ActGoalSkill'], $iskills);
                    if (isset($insert)) {
                        foreach ($insert as $in) {
                            $d = new ActGoalSkill();
                            $d->goalID = $model->ID;
                            $d->skillID = $in;
                            $d->save();
                        }
                    }
                } else {
                    ActGoalSkill::model()->deleteAllByAttributes(array('goalID' => $model->ID));
                }
                 if (isset($_POST['ActGoalContent'])) {
                    $removed = array_diff($icontents, $_POST['ActGoalContent']);
                    ActGoalContent::model()->deleteAllByAttributes(array('goalID' => $model->ID, 'contentID' => array_values($removed)));
                    $insert = array_diff($_POST['ActGoalContent'], $icontents);
                    if (isset($insert)) {
                        foreach ($insert as $in) {
                            $d = new ActGoalContent();
                            $d->goalID = $model->ID;
                            $d->contentID = $in;
                            $d->save();
                        }
                    }
                } else {
                    ActGoalContent::model()->deleteAllByAttributes(array('goalID' => $model->ID));
                }    




               // $this->redirect(array('view', 'id' => $model->ID));
            }
        }
        $modalities = ActGoalModality::model()->findAllByAttributes(array('goalID' => $id));
        $skills = ActGoalSkill::model()->findAllByAttributes(array('goalID' => $id));
        $contents = ActGoalContent::model()->findAllByAttributes(array('goalID' => $id));
        Yii::app()->clientScript->registerScript('updateSelect',"updateLoad('actGoal');",CClientScript::POS_LOAD);
        $this->render('update', array(
            'model' => $model,
            'modalities' => $modalities,
            'skills' => $skills,
            'contents' => $contents
        ));
    }

    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'admin' page.
     * @param integer $id the ID of the model to be deleted
     */
    public function actionDelete($id) {
        if (Yii::app()->request->isPostRequest) {
            // we only allow deletion via POST request
            $this->loadModel($id)->delete();

            // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
            if (!isset($_GET['ajax']))
                $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
        }
        else
            throw new CHttpException(400, 'Invalid request. Please do not repeat this request again.');
    }

    /**
     * Lists all models.
     */
    public function actionIndex() {
        $dataProvider = new CActiveDataProvider('ActGoal',
                        array('pagination' => array(
                                'pageSize' => 12,
                        )));
        $this->render('index', array(
            'dataProvider' => $dataProvider,
        ));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin() {
        $model = new ActGoal('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['ActGoal']))
            $model->attributes = $_GET['ActGoal'];

        $this->render('admin', array(
            'model' => $model,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer the ID of the model to be loaded
     */
    public function loadModel($id) {
        $model = ActGoal::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param CModel the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'act-goal-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    public function actionLoadContent() {
        $model = new ActGoal;
        $model->attributes = $_POST['ActGoal'];
        $data = ActContent::model()->findAllByAttributes(array('disciplineID' => $model->disciplineID));
        $data = CHtml::listData($data, 'ID', 'description');
        foreach ($data as $value => $name) {
            echo CHtml::tag('option', array('value' => $value), CHtml::encode($name), true);
        }
    }

}
