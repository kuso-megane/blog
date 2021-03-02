<?php
    $isLastPage = $vm['isLastPage'];
    $pageId = $vm['pageId'];
    $prevPage = $pageId - 1;
    $nextPage = $pageId + 1;

    $currentUrl = $vm['currentUrl'];

    $given_word = $vm['given_word'];
    $wordQuery = ($given_word != NULL) ? "&w={$given_word}" : '';
?>

<div id="page-switch">

    <?php if ($prevPage > 0): ?>
        <p id="page-switch--previous">
            <a href=<?php echo "{$currentUrl}?p={$prevPage}{$wordQuery}"; ?> >前の9件</a>
        </p>
    <?php endif; ?>
    
    <?php if ($isLastPage == FALSE): ?>
        <p id="page-switch--next">
            <a href=<?php echo "{$currentUrl}?p={$nextPage}{$wordQuery}"; ?> >次の9件</a>
        </p>
    <?php endif; ?>

</div>
