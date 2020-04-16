<?php

namespace Anax\View;

/**
 * Render content within an article.
 */

// Show incoming variables and view helper functions
// echo showEnvironment(get_defined_vars(), get_defined_functions());


?><h1>Guess the Number</h1>
<a href="guess/new"><input type="submit" value="New game"></a>
<?php if (isset($_SESSION["guess"])) : ?>
<a href="guess/game"><input type="submit" value="Continue game"></a>
<?php endif;
