<?php
namespace Anax\View;

?>

<form method="POST">
    <?php foreach ($resultset as $row) : ?>
    <fieldset>
    <legend>Edit</legend>
    <input type="hidden" name="movieId" value="<?= $row->id ?>"/>

    <p>
        <label>Title:<br>
        <input type="text" name="movieTitle" value="<?= $row->title ?>"/>
        </label>
    </p>

    <p>
        <label>Year:<br>
        <input type="number" name="movieYear" value="<?= $row->year ?>"/>
    </p>

    <p>
        <label>Image:<br>
        <input type="text" name="movieImage" value="<?= $row->image ?>"/>
        </label>
    </p>

    <p>
        <input type="submit" name="doSave" value="Save">
    </p>
    <p>
        <a href="<?= url("movie/select") ?>">Select movie</a> |
        <a href="<?= url("movie") ?>">Show all</a>
    </p>
    </fieldset>
    <?php endforeach; ?>
</form>
