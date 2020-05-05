<?php
namespace Anax\View;

?>

<form method="POST">
    <fieldset>
    <legend>Edit</legend>
    <input type="hidden" name="movieId" value=""/>

    <p>
        <label>Title:<br>
        <input type="text" name="movieTitle" value=""/>
        </label>
    </p>

    <p>
        <label>Year:<br>
        <input type="number" name="movieYear" value=""/>
    </p>

    <p>
        <label>Image:<br>
        <input type="text" name="movieImage" value=""/>
        </label>
    </p>

    <p>
        <input type="submit" name="add" value="Lägg till film">
    </p>
    <p>
        <a href="<?= url("movie/select") ?>">Select movie</a> |
        <a href="<?= url("movie") ?>">Show all</a>
    </p>
    </fieldset>
</form>
