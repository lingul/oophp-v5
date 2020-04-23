<?php

namespace ligm19\Dice;

use Anax\Commons\AppInjectableInterface;
use Anax\Commons\AppInjectableTrait;

// use Anax\Route\Exception\ForbiddenException;
// use Anax\Route\Exception\NotFoundException;
// use Anax\Route\Exception\InternalErrorException;

/**
 * A sample controller to show how a controller class can be implemented.
 * The controller will be injected with $app if implementing the interface
 * AppInjectableInterface, like this sample class does.
 * The controller is mounted on a particular route and can then handle all
 * requests for that mount point.
 *
 * @SuppressWarnings(PHPMD.TooManyPublicMethods)
 */
class DiceController implements AppInjectableInterface
{
    use AppInjectableTrait;


    /**
     * This is the index method action, it handles:
     * ANY METHOD mountpoint
     * ANY METHOD mountpoint/
     * ANY METHOD mountpoint/index
     *
     * @return string
     */
    public function indexAction() : object
    {
        // Deal with the action and return a response.
        $title = "Dice game";
        $page = $this->app->page;

        $page->add("dice/landing");

        return $page->render([
            "title" => $title,
        ]);
    }



    /**
     * This is the index method action, it handles:
     * ANY METHOD mountpoint
     * ANY METHOD mountpoint/
     * ANY METHOD mountpoint/index
     *
     * @return string
     */
    public function newAction() : object
    {
        $this->app->session->set('dice', new DiceGame(2, 2));

        return $this->app->response->redirect("dice/game");
    }


    /**
     * This is the index method action, it handles:
     * ANY METHOD mountpoint
     * ANY METHOD mountpoint/
     * ANY METHOD mountpoint/index
     *
     * @return string
     */
    public function gameAction() : object
    {
        $title = "Dice game";
        $page = $this->app->page;
        $game = $this->app->session->get('dice');

        if (!$game) {
            return $this->app->response->redirect("dice");
        }

        $this->app->session->set('dice', $game);
        $page->add("dice/game", [$game]);
        // $app->page->add("dice/debug", [$game]);

        return $page->render([
            "title" => $title,
        ]);
    }


    /**
     * This is the index method action, it handles:
     * ANY METHOD mountpoint
     * ANY METHOD mountpoint/
     * ANY METHOD mountpoint/index
     *
     * @return string
     */
    public function doaiAction() : object
    {
        $game = $this->app->session->get('dice');

        if (!$game) {
            return $this->app->response->redirect("dice");
        }

        $score = $game->getScore(1);
        $playerScore = $game->getScore(0);
        $turnScore = $game->getTurnScore();

        if ($turnScore + $score >= 100) {
            $game->endTurn(1);
        }

        if ($turnScore < 10
            || $playerScore > 85
            || ($playerScore > 75 && $score + $turnScore > 85)
            || ($score + $turnScore < $playerScore && $turnScore < 25)) {
            $game->doRoll(1);
        } else {
            $game->endTurn(1);
        }

        return $this->app->response->redirect("dice/game");
    }


    /**
     * This is the index method action, it handles:
     * ANY METHOD mountpoint
     * ANY METHOD mountpoint/
     * ANY METHOD mountpoint/index
     *
     * @return string
     */
    public function rollAction() : object
    {
        $game = $this->app->session->get('dice');

        if (!$game) {
            return $this->app->response->redirect("dice");
        }

        $game->doRoll(0);

        return $this->app->response->redirect("dice/game");
    }


    /**
     * This is the index method action, it handles:
     * ANY METHOD mountpoint
     * ANY METHOD mountpoint/
     * ANY METHOD mountpoint/index
     *
     * @return string
     */
    public function passAction() : object
    {
        $game = $this->app->session->get('dice');

        if (!$game) {
            return $this->app->response->redirect("dice");
        }

        $game->endTurn(0);

        return $this->app->response->redirect("dice/game");
    }
}
