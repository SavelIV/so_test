<?php

/* @var $this yii\web\View */
/* @var $schedule backend\models\Schedule */
/* @var $dateToday string */

$this->title = 'SO test';
?>
<div class="site-index">

    <div class="jumbotron">
        <h1>Сегодня <?= $dateToday ?></h1>
    </div>

    <div class="body-content">

        <div class="row">
            <div class="col-lg-6">
                <h2>Открыты:</h2>

                <?php
                foreach ($schedule as $day): ?>
                    <?php if ($day->getIsOpenNow()): ?>
                        <?= $this->render('_item_open', ['day' => $day]); ?>
                    <?php endif; ?>
                <?php
                endforeach; ?>

            </div>
            <div class="col-lg-6">
                <h2>Закрыты:</h2>

                <?php
                foreach ($schedule as $day): ?>
                    <?php if (in_array($day->organization_id, \backend\models\Schedule::getOpenTodayOrganisationsList()) && $day->day_of_week == date('w')): ?>
                        <?= $this->render('_item_close', ['day' => $day]); ?>
                    <?php endif; ?>
                <?php
                endforeach; ?>

                <?php
                foreach ($schedule as $day): ?>
                    <?php if (in_array($day->organization_id, \backend\models\Schedule::getClosedTodayOrganisationsList()) ): ?>
                        <?= $this->render('_item_close', ['day' => $day]); ?>
                    <?php endif; ?>
                <?php
                endforeach; ?>
            </div>
        </div>

    </div>
</div>
