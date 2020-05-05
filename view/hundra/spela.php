<?php

namespace Anax\view;

?>

<!DOCTYPE html>
<head>
    <h1>Spela tärningsspelet 100</h1>
    <h3>Klicka på slå för att slå tärning om vem som börjar, den med högst värde börjar.</h3>
    <?php if ($game->activePlayer[0] == 0 && $game->activePlayer[1] == 0) { ?>
        <h4>Klicka på Börja spela för att slå en tärning om vem som börjar. Den med högst värde börjar.</h4>
        <form method="POST">
            <input type="submit" name="start" value="Börja spela">
        </form>
    <?php } ?>
    <p>Spelare 1 startpoäng: <?= $game->turn[0] ?></p>
    <p>Spelare 2 startpoäng: <?= $game->turn[1] ?></p>
    <p> Spelare 1 poäng: <?= $game->playerScore[0] ?></p>
    <p> Spelare 2 poäng: <?= $game->playerScore[1] ?></p>
    <p>Spelare 1 sparad poäng: <?= $game->savedScore[0] ?></p>
    <p>Spelare 2 sparad poäng: <?= $game->savedScore[1] ?></p>
    <form method="POST">
        <input type="submit" name="rulla" value="Slå">
        <input type="submit" name="sluta" value="Avsluta">
        <input type="submit" name="restart" value="Starta om">
    </form>

    <p><?= $game->diceValue() ?></p>
    <?php if ($game->savedScore[0] >= 100) { ?>
        <p>Du vann spelet, grattis! Klicka på Starta om för att spela igen.</p>
    <?php } elseif ($game->savedScore[1] >= 100) { ?>
        <p>Datorn vann spelet! Klicka på starta om för att spela igen.</p>
    <?php } ?>
</head>
