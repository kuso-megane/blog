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

    if ($artcl_id == NULL) {
        $artcl_id = '';
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width,initial-scale=1.0">
        <title><?php ViewsConfig::TITLE; ?></title>
        <link rel="stylesheet" type="text/css" href=<?php echo ViewsConfig::STYLE_SHEET_URL. "backyard/article.css"; ?>>
    </head>
    <body>
        <h2>記事BY</h2>
        <p><a href="/backyard/article">記事BYトップページへ</a></p>
        <form id="form" method="post" action=<?php echo "/backyard/article/post/{$artcl_id}"; ?> >
            <p id="input-c_id">
                カテゴリ:
                <select name="c_id" id="c_idSelect" required>

                    <?php foreach($categoryList as $category): ?>

                    <option value="<?php echo $category['id']; ?>" <?php if ($oldC_id == $category['id']){ echo 'selected'; } ?>>
                        <?php echo $category['name']; ?>
                    </option>

                    <?php endforeach; ?>

                </select>
            </p>
            <p id="input-subc_id">
                サブカテゴリ:
                <select name="subc_id" id="subc_idSelect" required>

                    <?php foreach($subCategoryList[$oldC_id] as $subCategory): ?>

                    <option value="<?php echo $subCategory['id']; ?>" <?php if ($oldSubc_id == $subCategory['id']){ echo 'selected'; } ?> >
                        <?php echo $subCategory['name']; ?>
                    </option>

                    <?php endforeach; ?>
                    
                </select>
            </p>
            <p id="input-title">
                title (30文字以内、必須):
                <input type="text" name="title" placeholder="新しいタイトルを記入" value="<?php echo htmlspecialchars($titleValue, ENT_QUOTES); ?>" minlength="1" maxlength="30" required>
            </p>
            <p id="input-content">
                content:<br>
                <p id="input-content--note">note: スクリプトはサーバーで自動的に削除されます。</p>
                <textarea id="editor" name="content" cols="20" rows="8"><?php echo htmlspecialchars($contentValue, ENT_QUOTES); ?></textarea>
            </p>

            <button id="submit-button" type="submit">投稿</button>
            <button id="reset-button" type="reset">リセット</button>
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

        <!--サブカテゴリ選択肢の動的形成-->
        <script>
            {
                const c_idSelect = document.getElementById("c_idSelect");

                const selectedSubCategoryList = function(selectedC_id) {

                    <?php foreach($subCategoryList as $c_id => $subCategories): ?>

                        if (selectedC_id == <?php echo $c_id; ?>) {
                            let ans = [];
                            
                            <?php foreach($subCategories as $subCategory): ?>

                                ans.push([
                                    <?php echo $subCategory['id']; ?>,
                                    "<?php echo $subCategory['name']; ?>"
                                ]);

                            <?php endforeach; ?>

                            return ans;
                        }

                    <?php endforeach; ?>
                    
                }


                const initSubcOption = () => {
                    let select = document.getElementById("subc_idSelect");

                    //既存の選択肢を削除
                    while (select.firstChild) {
                        select.removeChild(select.firstChild);
                    }

                    let selectedC_id = c_idSelect.value;
                
                    for (const subc of selectedSubCategoryList(selectedC_id)) {
                        let option = document.createElement("option");
                        option.value = subc[0];
                        option.text = subc[1];
                        select.appendChild(option);
                    }
                }

                window.addEventListener("DOMContentLoaded", initSubcOption);
                c_idSelect.addEventListener("change", initSubcOption);
            }
        </script>

        <!--editorの内容のリセット-->
        <script>
            {
                const  $form = document.getElementById("form");

                const resetEditor = (e) => {
                    const oldContent =
                    `<?php 
                        $contentValue_ = str_replace("\\", "\\\\", $contentValue);
                        echo str_replace("`", "\`", $contentValue_); 
                    ?>`;
                    const editor = document.getElementById("editor");
                    
                    simplemde.value(oldContent);     
                }

                const reset  = (e) => {
                    e.preventDefault();
                    if (window.confirm("リセットしますか")) {
                        resetEditor();
                        $form.reset();
                    }
                    else {
                        return
                    }
                }

                const $resetButton = document.getElementById("reset-button");
                $resetButton.addEventListener("click", reset);
            }
        </script>

        <!--vaidation-->
        <script>
            {
                const $form = document.getElementById("form");
                const $submitButton = document.getElementById("submit-button");

                const submit = (e) => {
                    e.preventDefault();
                    if (window.confirm("本当に投稿しますか")) {
                        $form.submit();
                    }
                    else {
                        return;
                    }
                    
                }

                const validate = (e) => {
                    const $isValid = $form.checkValidity();

                    if ($isValid) {
                        $submitButton.disabled = false;
                        return;
                    }
                    else {
                        $submitButton.disabled = true;
                        return;
                    }
                }

                $form.addEventListener("change", validate);
                $form.addEventListener("input", validate);
                $submitButton.addEventListener("click", submit);
            }
        </script>
    </body>
</html>
