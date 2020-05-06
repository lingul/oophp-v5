<?php
// Include config
namespace Anax\View;

if (isset($message)) {
    echo('<p class="error">' . $message . '</p>');
} else {
    echo "<h1>You are now logged out!</h1>";
}
