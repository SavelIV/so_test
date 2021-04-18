<?php

/* @var $this yii\web\View */
/* @var $day backend\models\Schedule */

?>
<hr>
  <h4 class="organization"><?= $day->organization->name ?> работает: <?= $day->getDayOfWeek() ?> с: <?= $day->open ?> по: <?= $day->close ?></h4>
  <h5 class="organization">До открытия: <?= $day->getTimeToOpen() ?></h5>

<hr>