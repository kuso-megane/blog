<?php 
    use myapp\config\ViewsConfig;

    if ($isNew == TRUE) {
        $titleValue = '';
        $contentValue = '';
    }
    elseif ($isNew == FALSE) {
        $titleValue = $oldTitle;
        $contentValue = $oldContent;
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width,initial-scale=1.0">
        <title><?php ViewsConfig::TITLE; ?></title>
        <link rel="stylesheet" type="text/css" href=<?php echo ViewsConfig::STYLE_SHEET_URL. "backyard/article.css"; ?>>
        <!--サブカテゴリ選択肢の動的形成-->
        <script type="text/javascript">
            function selectedSubCategoryList(selectedC_id) {

                <?php foreach($subCategoryList as $c_id => $subCategories): ?>

                    if (selectedC_id === <?php echo $c_id; ?>) {
                        ans = [];
                        
                        <?php foreach($subCategories as $subCategory): ?>

                            subc_id = <?php echo $subCategory['id']; ?>;
                            name = <?php echo $subCategory['name']; ?>;
                            ans.push([subc_id, name]);

                        <?php endforeach; ?>

                        return ans;
                    }

                <?php endforeach; ?>
            }


            function initSubcOption(){
                let select = document.getElementById("subc_idSelect");

                //既存の選択肢を削除
                while (select.firstChild) {
                    select.removeChild(select.firstChild);
                }

                let selectedC_id = document.getElementById("c_idSelect").value;
                
                let selectedSubCategoryList = selectedSubCategoryList(selectedC_id);

                let option = document.createElement("option");
                for (let subc of selectedSubCategoryList) {
                    option.value = subc[0];
                    option.text = subc[1];
                    select.appendChild(option);
                }
            }
        </script>
    </head>
    <body>
        <h2>記事BY</h2>
        <p><a href="/backyard/article">記事BYトップページへ</a></p>
        <form action="/backyard/article/post" action="post">
            <p id="input-c_id">
                カテゴリ:
                <select name="c_id" id="c_idSelect" onchange="initSubcOption()">

                    <?php foreach($categoryList as $category): ?>

                    <option value=<?php echo $category['id']; ?> <?php if ($oldC_id == $category['id']){ echo 'selected'; } ?>>
                        <?php echo $category['name']; ?>
                    </option>

                    <?php endforeach; ?>

                </select>
            </p>
            <p id="input-subc_id">
                サブカテゴリ:
                <select name="subc_id" id="subc_idSelect"></select>
            </p>
            <p id="input-title">
                title: <input type="text" name="title" placeholder="新しいタイトルを記入" value=<?php echo $titleValue; ?>>
            </p>
            <p id="input-content">
                content:<br>
                <textarea id="editor" name="content" cols="20" rows="8" placeholder="新しい内容を記入">
                    <?php echo $contentValue; ?>
                </textarea>
            </p>
            <input type="submit" value="投稿">
        </form>

        <!--import simpleMDE-->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/simplemde/latest/simplemde.min.css">
        <script src="https://cdn.jsdelivr.net/simplemde/latest/simplemde.min.js"></script>
        <script>
            var simplemde = new SimpleMDE({
                element: document.getElementById("editor"),
                forceSync: true,
                spellChecker: false
            });
        </script>
    </body>
</html>
