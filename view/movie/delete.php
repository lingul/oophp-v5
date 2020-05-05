<?php
namespace Anax\View;

?>

<form method="post">
    <?php foreach ($resultset as $row) : ?>
    <fieldset>
    <legend>Edit</legend>
    <p>
        <label>Id:<br>
        <input type="text" name="movieId" value="<?= $row->id ?>" readonly/>
        </label>
    </p>

    <p>
        <label>Title:<br>
        <input type="text" name="movieTitle" value="<?= $row->title ?>" readonly/>
        </label>
    </p>

    <p>
        <label>Year:<br>
        <input type="number" name="movieYear" value="<?= $row->year ?>" readonly/>
    </p>

    <p>
        <label>Image:<br>
        <input type="text" name="movieImage" value="<?= $row->image ?>" readonly/>
        </label>
    </p>

    <p>
        <input type="submit" name="delete" value="Ta bort film">
    </p>
    <p>
        <a href="<?= url("movie/select") ?>">Select movie</a> |
        <a href="<?= url("movie") ?>">Show all</a>
    </p>
    </fieldset>
    <?php endforeach; ?>
</form>
