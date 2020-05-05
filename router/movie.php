
<?php

// Get essentials
// require "../src/function.php";

/**
* Show all movies.
*/
$app->router->get("movie", function () use ($app) {
  $title = "Movie database | oophp";

  $app->db->connect();
  $sql = "SELECT * FROM movie;";
  $resultset = $app->db->executeFetchAll($sql);

  $app->page->add("movie/index", [
      "resultset" => $resultset,
  ]);

  return $app->page->render([
      "title" => $title,
  ]);
});

/**
* Search movies based on title
*/
$app->router->get("movie/search-title", function () use ($app) {
  $title = "Sök efter film (titel)";
  $resultset = [];

  $app->db->connect();
  $sql = "SELECT * WHERE title";
  $searchTitle = $app->request->getGet("searchTitle");
  if ($app->request->getGet("doSearch")) {
      $sql = "SELECT * FROM movie WHERE title LIKE ?;";
      $resultset = $app->db->executeFetchAll($sql, [$searchTitle]);
  }

  $app->page->add("movie/search-title", [
      "resultset" => $resultset,
  ]);

  return $app->page->render([
      "title" => $title,
  ]);
});

/**
* Search movies based on title
*/
$app->router->get("movie/search-year", function () use ($app) {
  $title = "Sök efter film (år)";
  $resultset = [];
  $year1 = $app->request->getGet("year1");
  $year2 = $app->request->getGet("year2");

  $app->db->connect();
  $sql = "SELECT * WHERE title";
  if ($app->request->getGet("doSearch")) {
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
  };

  $app->page->add("movie/search-year", [
      "resultset" => $resultset,
  ]);

  return $app->page->render([
      "title" => $title,
  ]);
});

$app->router->any(["GET", "POST"], "movie/select", function () use ($app) {
  $title = "Välj film";
  $app->db->connect();
  $resultset = [];
  $movieId = $app->request->getPost("movieId");
  if ($app->request->getPost("doDelete")) {
      header("Location: movie-delete/$movieId");
      exit;
  } elseif ($app->request->getPost("doEdit")) {
      header("Location: movie-edit/$movieId");
      exit;
  } elseif ($app->request->getPost("doAdd")) {
      header("Location: movie-add");
      exit;
  }

  $sql = "SELECT * FROM movie";
  $resultset = $app->db->executeFetchAll($sql);

  $app->page->add("movie/select", [
      "resultset" => $resultset,
  ]);

  return $app->page->render([
      "title" => $title,
  ]);
});

$app->router->any(["GET", "POST"], "movie/edit/{id:digit}", function (int $id) use ($app) {
  $title = "Ändra film";

  $app->db->connect();
  $sql = "SELECT * FROM movie WHERE id = ?";
  $resultset = $app->db->executeFetchAll($sql, [$id]);

  $movieTitle = $app->request->getPost("movieTitle");
  $movieYear = $app->request->getPost("movieYear");
  $movieImage = $app->request->getPost("movieImage");
  if ($app->request->getPost("doSave")) {
      $sql = "UPDATE movie SET title = ?, year = ?, image = ? WHERE id = ?";
      $app->db->execute($sql, [$movieTitle, $movieYear, $movieImage, $id]);
  }

  $app->page->add("movie/edit", [
      "resultset" => $resultset,
  ]);

  return $app->page->render([
      "title" => $title,
  ]);
});

$app->router->any(["GET", "POST"], "movie/delete/{id:digit}", function (int $id) use ($app) {
  $title = "Ta bort film";

  $app->db->connect();
  $sql = "SELECT * FROM movie WHERE id = ?";
  $resultset = $app->db->executeFetchAll($sql, [$id]);

  if ($app->request->getPost("delete")) {
      $sql = "DELETE FROM movie WHERE id = ?";
      $app->db->execute($sql, [$id]);
  }

  $app->page->add("movie/delete", [
      "resultset" => $resultset,
  ]);

  return $app->page->render([
      "title" => $title,
  ]);
});

$app->router->any(["GET", "POST"], "movie/add", function () use ($app) {
  $title = "Lägg till film";

  $app->db->connect();
  $sql = "SELECT id FROM movie";
  $resultset = $app->db->executeFetchAll($sql);
  $movieTitle = $app->request->getPost("movieTitle");
  $movieYear = $app->request->getPost("movieYear");
  $movieImage = $app->request->getPost("movieImage");

  if ($app->request->getPost("add")) {
      $sql = "INSERT INTO movie (title, year, image) VALUES (?, ?, ?);";
      $app->db->execute($sql, [$movieTitle, $movieYear, $movieImage]);
  }

  $app->page->add("movie/add", [
      "resultset" => $resultset,
  ]);

  return $app->page->render([
      "title" => $title,
  ]);
});
