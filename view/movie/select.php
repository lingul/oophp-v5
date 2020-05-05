<?php

namespace Anax\View;

?>

<form method="POST">
    <fieldset>
    <legend>Select Movie</legend>
    <p> För att lägga till en film klicka på Lägg till. </p>
    <p>För att redigera en film, välj en film i listan och sen klicka på Redigera.</p>
    <p>För att ta bort en film, välj en film i listan och klicka sedan på Ta bort.</p>
    <p>
        <label>Movie:<br>
        <select name="movieId">
            <option value="">Select movie...</option>
            <?php foreach ($resultset as $movie) : ?>
            <option value="<?= $movie->id ?>"><?= $movie->title ?></option>
            <?php endforeach; ?>
        </select>
    </label>
    </p>

    <input type="submit" name="doAdd" value="Lägg till">
    <input type="submit" name="doEdit" value="Redigera">
    <input type="submit" name="doDelete" value="Ta bort">
    <p><a href="<?= url("movie") ?>">Show all</a></p>
    </fieldset>
</form>
