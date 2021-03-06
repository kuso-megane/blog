<?php
    $searched_c_id = $searched_category['id'];
    $searched_c_name = $searched_category['name'];

    $searched_subc_id = $searched_subCategory['id'];
    $searched_subc_name = $searched_subCategory['name'];
?>

<div id="breadcrumb">
    <p>
        <a href="/index" class="breadcrumb-items">top</a>

        <?php if ($searched_category != NULL):?>
        &gt; 
        <a href=<?php echo"/search/{$searched_c_id}"; ?> class="breadcrumb-items">
            <?php echo $searched_c_name; ?>
        </a>
        <?php endif; ?>

        <?php if ($searched_subCategory != NULL):?>
        &gt; 
        <a href=<?php echo "/search/{$searched_c_id}/{$searched_subc_id}"; ?> class="breadcrumb-items">
            <?php echo $searched_subc_name; ?>
        </a>
        <?php endif; ?>

    </p>
</div>