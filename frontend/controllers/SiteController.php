<?php

namespace frontend\controllers;

use backend\models\Schedule;
use yii\web\Controller;

/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        $dateToday = Schedule::getWeekDayRus() . ', ' . date('Y-m-d H:i');
        $schedule = Schedule::find()->all();
//        $openOrganizationsList = Schedule::getOpenOrganisationsList();
//        $closedOrganizationsList = Schedule::getClosedOrganisationsList();
        return $this->render('index', [
            'schedule' => $schedule,
            'dateToday' => $dateToday,
//            'openOrganizationsList' => $openOrganizationsList,
//            'closedOrganizationsList' => $closedOrganizationsList,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return mixed
     */
    public function actionAbout()
    {
        return $this->render('about');
    }
}
