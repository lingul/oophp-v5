<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title><?=$title?></title>
</head>
<body>
<div class="container content">
<div class="section">
    <h3><?=$title?></h3>
    <form method="<?=$method?>">
        <input type="hidden" name="number" value=<?=$game->number()?>>
        <input type="hidden" name="tries" value=<?=$game->tries()?>>
            <div class="field">
                <label class="label">Make a guess between 1-100</label>
                <input class="input" type="number" id="guess" name="guess">
                <p><?=$game->tries()?> tries left</p>
                <p><?=$cheat?></p>

                <input type="submit" name="doGuess" class="button is-primary" value="make a guess">
                <input type="submit" name="doCheat" class="button is-primary" value="cheat">
                <input type="submit" name="reset" class="button is-primary" value="reset">
                <?=$method === "POST" ? '<input type="submit" name="destroy" class="button is-danger" value="destroy session">' : ""?>
            </div>
    </form>
    <div class="content section">
         <h2><?=$res?></h2>
    </div>
</div>

</div>
</body>
</html>
