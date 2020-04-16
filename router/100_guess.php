<?php
/**
 * Guess the number game.
 */

/**
 * Landing page.
 */
$app->router->get("guess", function () use ($app) {
    $title = "Guess the number";

    $app->page->add("guess/landing");
    // $app->page->add("guess/debug");

    return $app->page->render([
        "title" => $title,
    ]);
});

/**
 * Start new game.
 */
$app->router->get("guess/new", function () use ($app) {
    $_SESSION['guess'] = new ligm19\Guess\Guess();

    return $app->response->redirect("guess/game");
});

/**
 * Play game.
 */
$app->router->get("guess/game", function () use ($app) {
    if (!isset($_SESSION["guess"])) {
        return $app->response->redirect("guess");
    }

    $title = "Guess the number";

    $data = [
        "guess"  => $_SESSION["guess"],
        "tries"  => $_SESSION["guess"]->tries(),
        "recent" => $_SESSION["guess"]->recent()
    ];

    $app->page->add("guess/game", $data);
    // $app->page->add("guess/debug");

    return $app->page->render([
        "title" => $title,
    ]);
});

/**
 * Post route to make guess.
 */
$app->router->post("guess/game", function () use ($app) {
    if (!isset($_SESSION["guess"])) {
        return $app->response->redirect("guess");
    }

    if (isset($_POST["csrf"]) && ($_SESSION["guess"]->gameId() === $_POST["csrf"])) {
        $guess = $_SESSION["guess"];

        if (isset($_POST["number"])) {
            try {
                $guess->makeGuess((int)$_POST["number"]);
            } catch (Exception $e) {
                console.log("Exception {$e} caught.");
            }
        }
    } else {
        unset($_SESSION["guess"]);

        return $app->response->redirect("guess");
    }

    return $app->response->redirect("guess/game");
});

/**
 * Enable cheat.
 */
$app->router->get("guess/cheat", function () use ($app) {
    if (!isset($_SESSION["guess"])) {
        return $app->response->redirect("guess");
    }

    $_SESSION["cheat"] = true;

    return $app->response->redirect("guess/game");
});
