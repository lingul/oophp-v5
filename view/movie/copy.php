<?php

namespace Anax\View;

?>

<form method="POST">
    <fieldset>
    <legend>Select Movie</legend>

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

    <input type="submit" name="doAdd" value="Add">
    <input type="submit" name="doEdit" value="Edit">
    <input type="submit" name="doDelete" value="Delete">
    <p><a href="<?= url("movie") ?>">Show all</a></p>
    </fieldset>
</form>
