<?php
    $arr = explode('?',$_SERVER['REQUEST_URI'],2);
?>

@if($articles == "" && count($arr) > 1)
    <div class="search__result__table">
        <p>No search results</p>
    </div>
@endif
