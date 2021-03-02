<?php
    $isLastPage = $vm['isLastPage'];
    $pageId = $vm['pageId'];
    $prevPage = $pageId - 1;
    $nextPage = $pageId + 1;

    $currentUrl = $vm['currentUrl'];
?>

<div id="page-switch">

    <?php if ($prevPage > 0): ?>
        <p id="page-switch--previous">
            <a href=<?php echo "{$currentUrl}?p={$prevPage}"; ?> >前の9件</a>
        </p>
    <?php endif; ?>
    
    <?php if ($isLastPage == FALSE): ?>
        <p id="page-switch--next">
            <a href=<?php echo "{$currentUrl}?p={$nextPage}"; ?> >次の9件</a>
        </p>
    <?php endif; ?>

</div>
