<?php
/**
 * Show all movies.
 */
$app->router->get("movie", function () use ($app) {
    $data = [
        "title"  => "Movie database | oophp",
    ];

    $app->db->connect();

    $sql = "SELECT * FROM movie;";
    $res = $app->db->executeFetchAll($sql);

    $data["resultset"] = $res;

    $app->view->add("movie/index", $data);
    $app->page->render($data);
});

/**
 * Search on movie title.
 */
$app->router->get("movie/search-title", function () use ($app) {
    $data = [
        "title"  => "Movie database | oophp",
    ];

    $app->db->connect();

    $sql = null;
    $resultset = null;

    $searchTitle = getGet("searchTitle");
    if ($searchTitle) {
        $sql = "SELECT * FROM movie WHERE title LIKE ?;";
        $resultset = $app->db->executeFetchAll($sql, [$searchTitle]);
    }

    $data["resultset"] = $resultset;
    $data["searchTitle"] = $searchTitle;

    $app->view->add("movie/search-title", $data);
    $app->view->add("movie/index", $data);
    $app->page->render($data);
});

/**
 * Search on movie release year.
 */
$app->router->get("movie/search-year", function () use ($app) {
    $data = [
        "title"  => "Movie database | oophp",
    ];

    $app->db->connect();

    $sql = null;
    $resultset = null;

    $year1 = getGet("year1");
    $year2 = getGet("year2");
    if ($year1 && $year2) {
        $sql = "SELECT * FROM movie WHERE year >= ? AND year <= ?;";
        $resultset = $app->db->executeFetchAll($sql, [$year1, $year2]);
    } elseif ($year1) {
        $sql = "SELECT * FROM movie WHERE year >= ?;";
        $resultset = $app->db->executeFetchAll($sql, [$year1]);
    } elseif ($year2) {
        $sql = "SELECT * FROM movie WHERE year <= ?;";
        $resultset = $app->db->executeFetchAll($sql, [$year2]);
    }

    $data["resultset"] = $resultset;
    $data["year1"] = $year1;
    $data["year2"] = $year2;

    $app->view->add("movie/search-year", $data);
    $app->view->add("movie/index", $data);
    $app->page->render($data);
});

/**
 * CRUD for movie db
 */
$app->router->any(["GET", "POST"], "movie/crud", function () use ($app) {
    $data = [
        "title"  => "Movie database | oophp",
    ];

    $app->db->connect();

    $sql = null;

    $movieId = getPost("movieId");
    $movieTitle = getPost("movieTitle");
    $movieYear  = getPost("movieYear");
    $movieImage = getPost("movieImage");

    if (getPost("doSave")) {
        $sql = "UPDATE movie SET title = ?, year = ?, image = ? WHERE id = ?;";
        $app->db->execute($sql, [$movieTitle, $movieYear, $movieImage, $movieId]);
    } elseif (getPost("doDelete")) {
        $sql = "DELETE FROM movie WHERE id = ?;";
        $app->db->execute($sql, [$movieId]);
    } elseif (getPost("doAdd")) {
        $sql = "INSERT INTO movie (title, year, image) VALUES (?, ?, ?);";
        $app->db->execute($sql, ["A title", 2017, "img/noimage.png"]);
        $movieId = $app->db->lastInsertId();
        $sql = "SELECT * FROM movie WHERE id = ?;";
        $movie = $app->db->executeFetchAll($sql, [$movieId]);
        $data["movie"] = $movie[0];

        $app->view->add("movie/crud-edit", $data);
        $app->page->render($data);
    } elseif (getPost("doEdit") && is_numeric($movieId)) {
        $sql = "SELECT * FROM movie WHERE id = ?;";
        $movie = $app->db->executeFetchAll($sql, [$movieId]);
        $data["movie"] = $movie[0];

        $app->view->add("movie/crud-edit", $data);
        $app->page->render($data);
        exit;
    }

    $sql = "SELECT id, title FROM movie;";
    $movies = $app->db->executeFetchAll($sql);

    $data["movies"] = $movies;

    $app->view->add("movie/crud", $data);
    $app->page->render($data);
});
