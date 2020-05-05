<?php
/**
 * Create routes using $app programming style.
 */
//var_dump(array_keys(get_defined_vars()));
$app->router->get("100", function () use ($app) {
    $game = new \Anax\Hundra\Game();
    $app->session->set("Game100", $game);

    $title = [
        "title" => "Spela 100",
    ];

    $data["game"] = $game;

    $app->view->add("hundra/index", $data);
    return $app->page->render($title);
});

// $app->router->any(["GET", "POST"], "100/reset", function () use ($app) {
//     $game = new \Anax\Hundra\Game();
//     $app->session->set("Game100", $game);
//
//     $app->response->redirect("100/spela");
// });

$app->router->any(["GET", "POST"], "100/spela", function () use ($app) {
    $title = [
        "title" => "Spela 100 spelet",
    ];

    $data["player"] = 0;
    $data["comp"] = 0;

    $game = $app->session->get("Game100");

    if ($app->request->getPost("restart")) {
        $game = new \Anax\Hundra\Game();
        $app->session->set("Game100", $game);
    } elseif ($app->request->getPost("rulla")) {
        $game = $app->session->get("Game100");
        $game->throwDice();
        $game->getScore();
    } elseif ($app->request->getPost("sluta")) {
        $game = $app->session->get("Game100");
        $game->saveScore();
    } elseif ($app->request->getPost("start")) {
        $game = $app->session->get("Game100");
        $game->getStarter();
    }

    $data["game"] = $game;

    $app->view->add("hundra/spela", $data);
    return $app->page->render($title);
});
