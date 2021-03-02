<?php
    $given_category = $vm['given_category'];
    $given_c_id = $given_category['id'];
    $given_c_name = $given_category['name'];

    $given_subCategory = $vm['given_subCategory'];
    $given_subc_id = $given_subCategory['id'];
    $given_subc_name = $given_subCategory['name'];
?>

<div id="breadcrumb">
    <p>
        <a href="/index" class="breadcrumb-items">top</a>

        <?php if ($given_category != NULL):?>
        &gt; 
        <a href=<?php echo"/search/{$given_c_id}"; ?> class="breadcrumb-items">
            <?php echo $given_c_name; ?>
        </a>
        <?php endif; ?>

        <?php if ($given_subCategory != NULL):?>
        &gt; 
        <a href=<?php echo "/search/{$given_c_id}/{$given_subc_id}"; ?> class="breadcrumb-items">
            <?php echo $given_subc_name; ?>
        </a>
        <?php endif; ?>

    </p>
</div>