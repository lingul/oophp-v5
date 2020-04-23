<?php

/**
 * Route for GET version of Guess game
 */
$app->router->get("gissa/get", function () use ($app) {
    $data = [
        "title" => "Guess the number (GET)",
        "method" => "GET",
    ];

    // Set incoming if exists
    $number = $_GET["number"] ?? -1;
    $tries = $_GET["tries"] ?? 6;
    $guess = $_GET["guess"] ?? null;

    // Initiate a new game
    $game = new Anax\Guess\Guess($number, $tries);

    // Make a guess
    $res = null;
    if (isset($_GET["doGuess"])) {
        $res = $game->makeGuess($guess);
    }

    // Reset game
    if (isset($_GET["reset"])) {
        $game->random();
    }

    $cheat = null;
    // Reveal the right answer AKA cheat
    if (isset($_GET["doCheat"])) {
        $cheat = "the right number is: " . $game->number();
    }

    $data["number"] = $number;
    $data["tries"] = $tries;
    $data["guess"] = $guess;
    $data["res"] = $res;
    $data["game"] = $game;
    $data["cheat"] = $cheat;

    $app->page->add("guess/game-get-post", $data);

    return $app->page->render($data);
});

/**
 * Route for POST version of Guess game
 */
$app->router->get("gissa/post", function () use ($app) {
    $data = [
        "title" => "Guess the number (SESSION)",
        "method" => "POST",
    ];

    // Initiate a new game
    $game = $_SESSION["game"] ?? null;
    if (!$game) {
        $game = new Anax\Guess\Guess();
        $_SESSION["game"] = $game;
    }

    $data["guess"] = null;
    $data["res"] = null;
    $data["game"] = $game;
    $data["cheat"] = null;

    $app->page->add("guess/game-get-post", $data);

    return $app->page->render($data);
});

/**
 * Route for POST version of Guess game
 */
$app->router->post("gissa/post", function () use ($app) {
    $data = [
        "title" => "Guess the number (SESSION)",
        "method" => "POST",
    ];

    // Set incoming if exists
    $number = $_POST["number"] ?? -1;
    $tries = $_POST["tries"] ?? 6;
    $guess = $_POST["guess"] ?? null;

    // Initiate a new game
    $game = new Anax\Guess\Guess($number, $tries);

    // Make a guess
    $res = null;
    if (isset($_POST["doGuess"])) {
        $res = $game->makeGuess($guess);
    }

    // Reset game
    if (isset($_POST["reset"])) {
        $game->random();
    }

    $cheat = null;
    // Reveal the right answer AKA cheat
    if (isset($_POST["doCheat"])) {
        $cheat = "the right number is: " . $game->number();
    }

    $data["guess"] = $guess;
    $data["res"] = $res;
    $data["game"] = $game;
    $data["cheat"] = $cheat;

    $app->page->add("guess/game-get-post", $data);

    return $app->page->render($data);
});

/**
 * Route for SESSION version of Guess game
 */
$app->router->get("gissa/session", function () use ($app) {
    $data = [
        "title" => "Guess the number (SESSION)",
        "method" => "POST",
    ];

    // Initiate a new game
    $game = $_SESSION["game"] ?? null;
    if (!$game) {
        $game = new Anax\Guess\Guess();
        $_SESSION["game"] = $game;
    }

    $data["guess"] = null;
    $data["res"] = null;
    $data["game"] = $game;
    $data["cheat"] = null;

    $app->page->add("guess/game-get-post", $data);

    return $app->page->render($data);
});

/**
 * Route for SESSION version of Guess game
 */
$app->router->post("gissa/session", function () use ($app) {
    $data = [
        "title" => "Guess the number (SESSION)",
        "method" => "POST",
    ];

    // Set incoming if exists
    $guess = $_POST["guess"] ?? null;

    // Initiate a new game
    $game = $_SESSION["game"] ?? null;
    if (!$game) {
        $game = new Anax\Guess\Guess();
        $_SESSION["game"] = $game;
    }

    if (isset($_POST["destroy"])) {
        // Unset all of the session variables.
        $_SESSION = [];

        if (ini_get("session.use_cookies")) {
            $params = session_get_cookie_params();
            setcookie(
                session_name(),
                '',
                time() - 42000,
                $params["path"],
                $params["domain"],
                $params["secure"],
                $params["httponly"]
            );
        }

        session_destroy();
        echo "The session is destroyd";
    }

    // Make a guess
    $res = null;
    if (isset($_POST["doGuess"])) {
        $res = $game->makeGuess($guess);
    }

    // Reset game
    if (isset($_POST["reset"])) {
        $game->random();
    }

    $cheat = null;
    // Reveal the right answer AKA cheat
    if (isset($_POST["doCheat"])) {
        $cheat = "the right number is: " . $game->number();
    }

    $data["guess"] = $guess;
    $data["res"] = $res;
    $data["game"] = $game;
    $data["cheat"] = $cheat;

    $app->page->add("guess/game-get-post", $data);

    return $app->page->render($data);
});
