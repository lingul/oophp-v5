<?php

namespace Anax\BlogPost;

use Anax\Commons\AppInjectableInterface;
use Anax\Commons\AppInjectableTrait;

// use Anax\Route\Exception\ForbiddenException;
// use Anax\Route\Exception\NotFoundException;
// use Anax\Route\Exception\InternalErrorException;
/**
* @SuppressWarnings(PHPMD.TooManyPublicMethods)
*/
class BlogPostController implements AppInjectableInterface
{
    use AppInjectableTrait;

    public function indexAction()
    {
        return "Index";
    }

    public function head()
    {
        $this->app->page->add("blog/header");
    }

    public function showallAction()
    {
        $title = "Show all content";
        $this->head();
        $this->app->db->connect();
        $sql = "SELECT id, title, published, created, updated, deleted, type, path, slug FROM content;";
        $res = $this->app->db->executeFetchAll($sql);
        // $this->app->page->add("movie/movie_first");
        $this->app->page->add("blog/show-all", [
            "resultset" => $res,
        ]);
        return $this->app->page->render([
            "title" => $title,
        ]);
    }

    public function adminAction()
    {
        if (($this->app->session->has('userid'))) {
            $title = "Admin";
            $this->head();
            $this->app->db->connect();
            $sql = "SELECT id, title, published, created, updated, deleted, type, path, slug FROM content;";
            $res = $this->app->db->executeFetchAll($sql);
            $this->app->page->add("blog/admin", [
                "resultset" => $res,
            ]);
            return $this->app->page->render([
                "title" => $title,
            ]);
        } else {
            $this->app->response->redirect('blog/login');
        }
    }

    public function slugCount($slug, $id)
    {
        $db = $this->app->db;
        $db->connect();
        if ($id > 0) {
            $sql = "SELECT COUNT(id) AS count FROM content WHERE slug LIKE ? AND id != ?;";
            $res = $db->executeFetchAll($sql, [$slug, $id]);
        } else {
            $sql = "SELECT COUNT(id) AS count FROM content WHERE slug LIKE ?;";
            $res = $db->executeFetchAll($sql, [$slug]);
        }
        return $res[0]->count;
    }

    public function addActionPost()
    {
        $req = $this->app->request;
        $db = $this->app->db;
        $title = $req->getPost("contentTitle");
        $path = $req->getPost("contentPath");
        // $pathCheck = $this->pathCount($path, 0);
        $slug = $req->getPost("contentSlug");
        $slugCheck = $this->slugCount($slug, 0);
        $data = $req->getPost("contentData");
        $type = $req->getPost("contentType");
        $filter = $req->getPost("contentFilter");
        if ($path == "") {
            $path = null;
        }
        $db->connect();
        if ($slugCheck == 0) {
            $sql = "INSERT INTO content (title, path, slug, data, type, filter)
                    VALUES (?, ?, ?, ?, ?, ?);";
            $db->executeFetchAll($sql, [$title, $path, $slug, $data, $type, $filter]);
            $this->app->response->redirect("blog/show-all");
        } else {
            $this->head();
            $this->app->page->add("blog/add", [
                "error" => "Slug already exists"
            ]);
            return $this->app->page->render([
                "title" => "Create Blog Post",
            ]);
        }
    }

    public function addActionGet()
    {
        if (($this->app->session->has('userid'))) {
            $title = "Create Blog post";
            $this->head();
            $this->app->page->add("blog/add");
            return $this->app->page->render([
                "title" => $title,
            ]);
        } else {
            $this->app->response->redirect("blog/login");
        }
    }


    public function editActionGet($id)
    {
        $title = "Edit Blog Post";
        $this->head();
        $db = $this->app->db;
        $db->connect();
        $sql = "SELECT * FROM content WHERE id = ?";
        $res = $db->executeFetchAll($sql, [$id]);
        $this->app->page->add("blog/edit", [
            "content" => $res[0]
        ]);
        return $this->app->page->render([
            "title" => $title,
        ]);
    }


    public function editActionPost($id)
    {
        $db = $this->app->db;
        $db->connect();
        $id = $this->app->request->getPost("contentId") ?: $this->app->request->getGet("contentId");
        $contentTitle = $this->app->request->getPost("contentTitle");
        $contentPath  = $this->app->request->getPost("contenPath");
        $contentSlug = $this->app->request->getPost("contentSlug");
        $slugCheck = $this->slugCount($contentSlug, 0);
        $contentData = $this->app->request->getPost("contentData");
        $contentType = $this->app->request->getPost("contentType");
        $contentFilter = $this->app->request->getPost("contentFilter");
        if ($contentPath == "") {
            $contentPath = null;
        }

        if ($slugCheck == 0) {
            $sql = "UPDATE content SET title = ?, path = ?, slug = ?, data = ?, type = ?, filter = ?, updated = NOW() WHERE id = ?";
            $this->app->db->execute($sql, [$contentTitle, $contentPath, $contentSlug, $contentData, $contentType, $contentFilter, $id]);
            $this->app->response->redirect("blog/admin");
        } else {
            $this->app->page->add("blog/edit", [
                "error" => "Slug already exists",
                $this->head(),
                "content" => (object)["id"=>$id, "title"=>$contentTitle, "path"=>$contentPath, "slug"=>$contentSlug, "data"=>$contentData, "type"=>$contentType, "filter"=>$contentFilter]
            ]);
            return $this->app->page->render([
                   "title" => "Edit Blog Post",
               ]);
        }
    }


    public function deleteActionGet($id)
    {
        $title = "Delete Post";
        $this->head();
        $this->app->db->connect();
        $sql = "SELECT * FROM content WHERE id = ?";
        $res = $this->app->db->executeFetchAll($sql, [$id]);
        $this->app->page->add("blog/delete", [
            "content" => $res[0]
        ]);
        return $this->app->page->render([
            "title" => $title,
        ]);
    }

    public function deleteActionPost($id)
    {
        $this->app->db->connect();
        $id = $this->app->request->getPost("contentId");
        $sql = "UPDATE content SET deleted=NOW() WHERE id=?;";
        $this->app->db->executeFetchAll($sql, [$id]);
        $this->app->response->redirect("blog/admin");
    }

    public function pagesAction()
    {
        $title = "Show Pages";
        $this->head();
        $this->app->db->connect();
        $db = $this->app->db;
        $sql = <<<EOD
        SELECT
            *,
            CASE
                WHEN (deleted <= NOW()) THEN "isDeleted"
                WHEN (published <= NOW()) THEN "isPublished"
                ELSE "notPublished"
            END AS status
        FROM content
        WHERE type= 'page'
        ;
EOD;
        $res = $db->executeFetchAll($sql);
        $this->app->page->add("blog/pages", [
            "resultset" => $res,
        ]);
        return $this->app->page->render([
            "title" => $title,
        ]);
    }

    public function filtersText($text, $filterType)
    {
        $Filter = new \Anax\Textfilter\MyTextFilter();
        $filterArray = explode(",", $filterType);
        foreach ($filterArray as $filter) {
            $text = $Filter->parse($text, $filter);
        }
        return $text;
    }

    public function pageAction($id)
    {
        $title = "Show Page";
        $this->head();
        $this->app->db->connect();
        $db = $this->app->db;
        $sql = "SELECT * FROM content WHERE id = ?";
        $res = $db->executeFetchAll($sql, [$id]);
        $res[0]->data =  $this->filtersText($res[0]->data, $res[0]->filter);
        // $res[1]->data =  $this->filtersText($res[1]->data, $res[1]->filter);
        $this->app->page->add("blog/page", [
            "content" => $res[0],
        ]);
        return $this->app->page->render([
            "title" => $title,
        ]);
    }

    public function postAction($slug)
    {
        $title = $slug;
        $this->head();
        $this->app->db->connect();
        $db = $this->app->db;
        $sql = "SELECT * FROM content WHERE slug = ?";
        $res = $db->executeFetchAll($sql, [$slug]);
        $res[0]->data =  $this->filtersText($res[0]->data, $res[0]->filter);
        // $res[1]->data =  $this->filtersText($res[1]->data, $res[1]->filter);
        $this->app->page->add("blog/post", [
            "content" => $res[0],
        ]);
        return $this->app->page->render([
            "title" => $title,
        ]);
    }

    public function postsAction()
    {
        $title = "Show Posts";
        $this->head();
        $this->app->db->connect();
        $db = $this->app->db;
        $sql = <<<EOD
        SELECT
            *,
            DATE_FORMAT(COALESCE(updated, published), '%Y-%m-%dT%TZ') AS published_iso8601,
            DATE_FORMAT(COALESCE(updated, published), '%Y-%m-%d') AS published
        FROM content
        WHERE type= 'post'
        ORDER BY published DESC
        ;
EOD;
        $res = $db->executeFetchAll($sql);
        foreach ($res as $post) {
            $post->data = $this->filtersText($post->data, $post->filter);
        }
        $this->app->page->add("blog/blogpost", [
            "resultset" => $res,
        ]);
        return $this->app->page->render([
            "title" => $title,
        ]);
    }

    public function loginActionGet()
    {

        if ($this->app->session->has('userid')) {
            $data = [
                'title' => 'Logout',
                'message2' => ''
            ];
            $this->head();
            $data['message2'] = "You are already logged in!";
            $this->app->page->add("blog/login", $data);
            return $this->app->page->render($data);
        } else {
            $title = "Login";
            $this->head();
            $this->app->page->add("blog/login");
            return $this->app->page->render([
                "title" => $title,
            ]);
        }
    }
    public function verifyLogin(string $user, string $password)
    {
        $this->app->db->connect();
        $db = $this->app->db;
        if ($user && $password) {
            $sql = "SELECT * FROM customer WHERE name = ? AND password = ?;";
            $res = $db->executeFetchAll($sql, [$user, $password]);
        }
        return !$res? false : true;
    }
       /**
        * Login.
        */
    public function loginActionPost()
    {
        $isLoggedIn = $this->app->session->has('userid');
        $data = [
            'title' => "Logga in",
            'isLoggedIn' => $isLoggedIn,
            'message' => ""
        ];
        if ($this->app->request->getPost('login')) {
            $user = $this->app->request->getPost('name');
            $password = $this->app->request->getPost('password');
            $res = $this->verifyLogin($user, $password);
            if ($res) {
                $this->app->session->set('userid', $user);
                $this->app->response->redirect('blog/welcome');
            } else {
                $data['message'] = "Fel användarnamn eller lösen";
            }
        }
        $this->app->view->add('blog/login', $data);
        return $this->app->page->render($data);
    }

    public function welcomeAction()
    {
        $this->head();
        $title = "Welcome";
        $this->app->db->connect();
        $name = $this->app->session->get('userid');
        $this->app->page->add("blog/welcome", [
            "name" => $name
        ]);
        return $this->app->page->render([
            "title" => $title,
        ]);
    }

    public function logoutAction()
    {
        $isLoggedIn = $this->app->session->has('userid');
        $data = [
            'title' => "Logout",
            'isLoggedIn' => $isLoggedIn,
            'message' => ""
        ];
        $title = "Logout";
        $respond = (($this->app->session->has('userid')));
        if (($this->app->session->has('userid'))) {
            $this->head();
            $this->app->session->destroy();
            $this->app->page->add("blog/logout");
            return $this->app->page->render([
                "title" => $title,
                "respond" => $respond,
            ]);
        } else {
            $this->head();
            $data['message'] = "No user is logged in";
            $this->app->page->add("blog/logout", $data);
            return $this->app->page->render($data);
        }
    }
}
