<?php

namespace Anax\View;

/**
 * Render content within an article.
 */

// Show incoming variables and view helper functions
//echo showEnvironment(get_defined_vars(), get_defined_functions());

?><main>
    <h1>Guess my number</h1>
    <p>Guess a number between 1 and 100, you have <?= $object->tries() ?> left.</p>

    <form class="guess" method="post">
        <?php if ($object->tries() > 0) : ?>
            <input type="number" name="guess"><br>
            <input class="buttons_input" type="submit" name="doGuess" value="Make a guess">
            <input class="buttons_input" type="submit" name="doInit" value="Start from beginning">
            <input class="buttons_input" type="submit" name="doCheat" value="Cheat">
        <?php endif; ?>

    </form>
    <?php if ($doGuess) : ?>
        <p>Your guess <?= $guess ?> is <b><?= $res ?></b></p>
    <?php endif; ?>

    <?php if ($doCheat) : ?>
        <p>CHEAT: Current number is <b><?= $object->number() ?></b></p>
    <?php endif; ?>
</main>
