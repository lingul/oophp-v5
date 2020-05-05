<?php

namespace Anax\View;

if (!$resultset) {
    return;
}
?>

<table class ="movie-table">
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
        <td><img class="thumb" src="../<?= htmlentities($row->image) ?>"></td>
        <td><?= htmlentities($row->title) ?></td>
        <td><?= htmlentities($row->year) ?></td>
    </tr>
<?php endforeach; ?>
</table>
