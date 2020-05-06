<?php
namespace Anax\View;

?>

<h1>Textfilter Tests</h1>
<h4>BBcode Source</h4>
<p><?=$bbOrginal?></p>

<h4>BBcode filtered code</h4>
<p><?=wordwrap(htmlentities($bbText))?></p>
<p><?=($bbText)?></p>


<h4> Link Source </h4>

<p><?=$linkOrginal?></p>

<h4> Link filtered </h4>

<p><?=wordwrap(htmlentities($linkText))?></p>
<p>clickable link</p>
<p><?=($linkText)?></p>

<h4> Nl2br Source </h4>

<p><?=$nl2brOrginal?></p>

<h4> Nl2br filtered </h4>

<p><?=wordwrap(htmlentities($nl2brText))?></p>
<p><?=($nl2brText)?></p>


<h4> Markdown Source </h4>

<p><?=$markOrginal?></p>

<h4> Markdown filtered </h4>

<p><?=wordwrap(htmlentities($markText))?></p>
<p><?=($markText)?></p>
