<?php

namespace Anax\View;

$stylesheets[] = 'css/dice.css';

/**
 * Render content within an article.
 */

// Show incoming variables and view helper functions
// echo showEnvironment(get_defined_vars(), get_defined_functions());
$finished = $data[0]->getStatus();

if ($data[0]->getTurn() === 1 && !$finished) {
    header("refresh:2; url=doai");
}
?>

<h1>100 Dice Game</h1>

<?php if ($finished) : ?>
<h2><?= $data[0]->getTurn() !== 0 ? "Player" : "Computer" ?> wins!</h2>
<?php endif; ?>

<table style="width: 100%;">
    <tr>
        <th style="width: 50%;">Player</th>
        <th style="width: 50%;">Computer</th>
    </tr>
    <tr>
        <th>
<?php foreach ($data[0]->getDice(0)["graphics"] as $die) : ?>
<i class="die-sprite <?= $die ?>"></i>
<?php endforeach; ?>
        </th>
        <th>
<?php foreach ($data[0]->getDice(1)["graphics"] as $die) : ?>
<i class="die-sprite <?= $die ?>"></i>
<?php endforeach; ?>
        </th>
    </tr>
    <tr>
        <td><?= $data[0]->getTurn() === 0 ? "Turn Score: " . $data[0]->getTurnScore(0) : "" ?></th>
        <td><?= $data[0]->getTurn() === 1 ? "Turn Score: " . $data[0]->getTurnScore(1) : "" ?></th>
    </tr>
    <tr>
        <td>Total Score: <?= $data[0]->getScore(0) ?></th>
        <td>Total Score: <?= $data[0]->getScore(1) ?></th>
    </tr>
    <tr>
        <td>Histogram</th>
        <td>Histogram</th>
    </tr>
    <tr>
        <td><pre><?= $data[0]->getHistogram(0) ?></pre></th>
        <td><pre><?= $data[0]->getHistogram(1) ?></pre></th>
    </tr>
</table>








<form action="roll">
<input type="submit" value="Roll dice" <?= $data[0]->getTurn() !== 0 || $finished ? "disabled" : "" ?> >
</form>
<br>
<form action="pass">
<input type="submit" value="End turn" <?= $data[0]->getTurn() !== 0 || $finished ? "disabled" : "" ?> >
</form>
<br>
<a href="new"><input type="submit" value="New game"></a>
