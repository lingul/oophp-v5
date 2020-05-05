<?php
if (!$resultset) {
    return;
}
$defaultRoute = "?route=show-all-sort&"
?>

<table>
    <tr class="first">
        <th>Rad</th>
        <th>Id <?= orderby("id", $defaultRoute) ?></th>
        <th>Bild <?= orderby("image", $defaultRoute) ?></th>
        <th>Titel <?= orderby("title", $defaultRoute) ?></th>
        <th>År <?= orderby("year", $defaultRoute) ?></th>
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
