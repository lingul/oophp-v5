<?php
namespace Anax\View;

?>

<!DOCTYPE html>
<h1>Alla filmer</h1>
<table>
    <tr>
        <th><a href="movie/search-title">Sök efter film (titel)</a></th>
        <th><a href="movie/search-year">Sök efter film (årtal)</a></th>
        <th><a href="movie/select">CRUD för filmer</a></th>
    </tr>
</table>
<?php
if (!$resultset) {
    return;
}
?>

<table>
    <tr class="first">
        <th>Rad</th>
        <th>Id</th>
        <th>Bild</th>
        <th>Titel</th>
        <th>År</th>
    </tr>
<?php $id = -1; foreach ($resultset as $row) :
    $id++; ?>
    <tr>
        <td><?= htmlentities($id) ?></td>
        <td><?= htmlentities($row->id) ?></td>
        <td><img class="thumb" src="../htdocs/<?= htmlentities ($row->image) ?>"></td>
        <td><?= htmlentities($row->title) ?></td>
        <td><?= htmlentities($row->year) ?></td>
    </tr>
<?php endforeach; ?>
</table>
