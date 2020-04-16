<?php

namespace Anax\View;

use ligm19\Guess\Guess;

/**
 * Render content within an article.
 */

// Show incoming variables and view helper functions
// echo showEnvironment(get_defined_vars(), get_defined_functions());


?><h1>Guess the number</h1>

<p>Guess a number between
<?= Guess::GUESS_MIN ?>
 and
<?= Guess::GUESS_MAX ?>
, you have
<?= $tries ?>
 tries left.</p>

<form method="post">
    <label for="number">Guess the number: </label>
    <input name="number" id="number" type="number"
           min="<?= Guess::GUESS_MIN ?>"
           max="<?= Guess::GUESS_MAX ?>"
           value="<?= $recent ? $recent : Guess::GUESS_MIN ?>">
    <input type="submit" value="Make Guess" <?= !$tries ? 'disabled="disabled"' : '' ?>>
    <input type="hidden" name="csrf" value="<?= $guess->gameId(); ?>">
</form>

<p>
<?php if ($recent) : ?>
Your guess
    <?= $recent ?>
 is

<?php endif;

switch ($guess->state()) {
    case "INITIATED":
        echo "Make a guess.";
        break;
    case "LOW_GUESS":
        echo "too low. Try again.";
        break;
    case "HIGH_GUESS":
        echo "too high. Try again.";
        break;
    case "CORRECT_GUESS":
        echo "correct. You won!";
        break;
    case "NO_TRIES":
        echo "incorrect. You lost. Try again?";
        break;
}
?>
</p>
<?php if (isset($_SESSION["cheat"])) : ?>
    <p>The correct number is <?= $guess->number() ?>, cheater.</p>
    <?php unset($_SESSION["cheat"]);
endif; ?>

<a href="new"><input type="submit" value="New game"></a>
<a href="cheat"><input type="submit" value="Cheat"></a>

</p>
