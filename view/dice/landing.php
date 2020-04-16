<?php

namespace Anax\View;

/**
 * Render content within an article.
 */

// Show incoming variables and view helper functions
// echo showEnvironment(get_defined_vars(), get_defined_functions());


?><h1>100 Dice game</h1>
<p>
Play a round of the 100 Dice game against the computer played with 2 dice.<br>
Rules:
<ul>
    <li>Each player rolls 1 die to determine turn order, highest roll starts.</li>
    <li>A round is started by throwing all dice.</li>
    <li>If any die rolls a 1, the turn is forfeit and all points are lost.</li>
    <li>Every die with value 2-6 is added to the total for the current round.</li>
    <li>The player can then decide to roll again or end their turn, adding all collected points to the total.</li>
    <li>The player can reroll as many times as they want, unless a 1 is rolled, in which case the turn is forfeit and all points earned in the round are lost.</li>
</ul>
</p>
<a href="dice/new"><input type="submit" value="New game"></a>
<?php if ($app->session->get('dice')) : ?>
<a href="dice/game"><input type="submit" value="Continue game"></a>
<?php endif; ?>
