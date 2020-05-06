<?php
namespace Anax\View;

if (isset($error)) {
    echo('<p class="error">' . $error . '</p>');
}?>
<form method="post">
    <fieldset>
    <legend>Create</legend>

    <p>
        <label>Title:<br>
        <input type="text" name="contentTitle"/>
        </label>
    </p>

    <p>
        <label>Path:<br>
        <input type="text" name="contentPath"/>
    </p>

    <p>
        <label>Slug:<br>
        <input type="text" name="contentSlug"/>
    </p>

    <p>
        <label>Text:<br>
        <textarea name="contentData"></textarea>
     </p>

     <p>
         <label>Type:<br>
         <input type="text" name="contentType"/>
     </p>

     <p>
         <label>Filter:<br>
         <input type="text" name="contentFilter"/>
     </p>

    <p>
        <button type="submit" name="doSave"><i class="fa fa-plus" aria-hidden="true"></i> Create</button>
    </p>
    </fieldset>
</form>
