<?php

/* @var $this yii\web\View */
/* @var $day backend\models\Schedule */

?>
<hr>
  <h4 class="organization"><?= $day->organization->name ?> работает с: <?= $day->open ?> по: <?= $day->close ?></h4>
  <h5 class="organization">Осталось до закрытия: <?= $day->getTimeToClose() ?></h5>

<hr>