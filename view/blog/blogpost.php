<?php
namespace Anax\View;

?><article><?php
foreach ($resultset as $content) :
    if (!isset($content->deleted)) :
        ?>
        <section>
            <header>
                <h1><a href="post/<?= esc($content->slug) ?>"><?= esc($content->title)?></a></h1>
            </header>
            <i>Published: <?=$content->created?></i>
            <p><?=$content->data?></p>
        </section>
        <?php
    endif;
endforeach; ?>
</article>
