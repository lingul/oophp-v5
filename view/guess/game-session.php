<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title><?=$title?></title>
     <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0-rc.2/js/materialize.min.js"></script>
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0-rc.2/css/materialize.min.css">
</head>
<body>
<div class="container">
<div class="row">
    <h3><?=$title?></h3>
    <form class="col s12" method="<?=$method?>">
        <div class="row">
            <div class="input-field col s8">
                <input type="number" id="guess" name="guess">
                <label for="guess">Make a guess between 1-100</label>
                <span class="helper-text"><?=$game->tries()?> tries left</span>
                <span class="helper-text"><?=$cheat?></span>

                <input type="submit" name="doGuess" class="btn" value="make a guess">
                <input type="submit" name="doCheat" class="btn" value="cheat">
                <input type="submit" name="reset" class="btn" value="reset">
                <input type="submit" name="destroy" class="btn" value="destroy session">
            </div>
        </div>

    </form>
    <h2><?=$res?></h2>
</div>

</div>
</body>
</html>
