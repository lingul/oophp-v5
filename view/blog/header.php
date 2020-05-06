<?php
namespace Anax\View;

// $req = new \Anax\Request\Request();
// echo("Site " . $req->getSiteUrl());
// echo("Base " . $req->getBaseUrl());
// echo("Current " . $req->getCurrentUrl());
// echo("Script " . $req->getScriptName());
?>
<table>
    <div class="movieNav">
        <tr>
            <th><a href="<?=url('blog/show-all')?>">Show all content </a></th>
            <th><a href="<?=url('blog/admin')?>">Admin </a></th>
            <th><a href="<?=url('blog/add')?>">Create </a></th>
            <th><a href="<?=url('blog/pages')?>">View pages </a></th>
            <th><a href="<?=url('blog/posts')?>">View blog </a></th>
        </tr>
    </div>
</table>
    <!-- <a href="<?=url('blog/logout')?>">Logout |</a>
    <a href="<?=url('blog/login')?>">Login </a> -->
