<?php

use backend\models\Organization;
use janisto\timepicker\TimePicker;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Schedule */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="schedule-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'organization_id')->dropDownList(Organization::asDropDown()) ?>

    <?= $form->field($model, 'day_of_week')->dropDownList($model::getDaysOfWeek(), [
        'multiple' => false,
//        'prompt' => 'Выберите',
    ]) ?>

    <?= $form->field($model, 'open')->widget(
        TimePicker::class,
        [
            'mode' => 'time',
            'clientOptions' => [
//                'dateFormat' => 'yy-mm-dd',
                'timeFormat' => 'HH:mm',
                'showSecond' => false,
            ]
        ]
    ) ?>


    <?= $form->field($model, 'close')->widget(
        TimePicker::class,
        [
            'mode' => 'time',
            'clientOptions' => [
//                'dateFormat' => 'yy-mm-dd',
                'timeFormat' => 'HH:mm',
                'showSecond' => false,
            ]
        ]
    ) ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
