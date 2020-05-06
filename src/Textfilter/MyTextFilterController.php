<?php
 namespace Anax\Textfilter;

use Anax\Commons\AppInjectableInterface;
use Anax\Commons\AppInjectableTrait;

class MyTextFilterController implements AppInjectableInterface
{
    use AppInjectableTrait;
    public function indexAction()
    {
        $myText = new MyTextFilter();
        $title = "Textfilter";

        $bbOrginal = "En [b]Fet[/b] bil.";
        $bbText = $myText->parse($bbOrginal, 'bbcode');

        $linkOrginal = "http://dbwebb.se";
        $linkText = $myText->parse($linkOrginal, 'link');

        $nl2brOrginal = "En\r\nfet\n\rbil";
        $nl2brText = $myText->parse($nl2brOrginal, 'nl2br');

        $markOrginal = "[link to dbwebb.se](http://dbwebb.se).";
        $markText = $myText->parse($markOrginal, 'markdown');

        $this->app->page->add("textfilter/index", [
            "bbText" => $bbText,
            "bbOrginal" => $bbOrginal,
            "linkOrginal" => $linkOrginal,
            "linkText" => $linkText,
            "nl2brOrginal" => $nl2brOrginal,
            "nl2brText" => $nl2brText,
            "markOrginal" => $markOrginal,
            "markText" => $markText


        ]);
        return $this->app->page->render([
            "title" => $title,
        ]);
    }
}
