<?php

namespace Anax\View;

if (isset($message)) {
    echo('<p class="error">' . $message . '</p>');
}

if (isset($message2)) {
    echo('<p class="error">' . $message2 . '</p>');



    ?>

<form method="post">
    <fieldset>
    <legend>Ange användarnamn och lösenord</legend>

    <p>
        <label>Användarnamn:<br>
        <input type="text" name="name" required autofocus readonly>
        </label>
    </p>

    <p>
        <label>Lösenord:<br>
        <input type="password" name="password" required readonly>
        </label>
    </p>

    <p>
        <input type="submit" name="login" value="Logga in"><br><br>
    </p>
    </fieldset>
</form>

<?php } else { ?>
<form method="post">
    <fieldset>
    <legend>Ange användarnamn och lösenord</legend>

    <p>
        <label>Användarnamn:<br>
        <input type="text" name="name" required autofocus>
        </label>
    </p>

    <p>
        <label>Lösenord:<br>
        <input type="password" name="password" required>
        </label>
    </p>

    <p>
        <input type="submit" name="login" value="Logga in"><br><br>
    </p>
    </fieldset>
</form>

<?php } ?>
