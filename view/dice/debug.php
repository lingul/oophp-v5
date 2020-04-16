<?php

namespace Anax\View;

/**
 * Render content within an article.
 */

// Show incoming variables and view helper functions
// echo showEnvironment(get_defined_vars(), get_defined_functions());


?><hr>
<pre>
<?= var_dump($data) ?>
<?= var_dump($data[0]->getDice()) ?>
</pre>
<hr>
