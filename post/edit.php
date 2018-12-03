<?php

define("baseLoaded", 1);

require "../lib/config.php";
require_once $_SERVER['SERVER_PATH'] . "lib/auth.php";
require_once $_SERVER['SERVER_PATH'] . "lib/process.php";

if ($_SESSION['update'] != 1)
{
    exit();
}

if (!empty($_GET))
{
    $action = filter_input(INPUT_GET, "action", FILTER_SANITIZE_SPECIAL_CHARS);
    $id = filter_input(INPUT_GET, "id", FILTER_SANITIZE_NUMBER_INT);

    global $postID;

    $post = pullPost($id);
    $_SESSION["status_code"] = validatePostPermissions($post);
    
    if($_SESSION["status_code"] == POST_FOUND)
    {
        $postID = $post['ID'];
    }

    if((!empty($_POST) && isset($postID)))
    {
        updatePost($postID, $_POST['title'], $_POST['content'], $_POST['category']);
        $post = pullPost($id);
    }
}

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" href="<?=$_SERVER['CLIENT_PATH']?>/assets/img/icons/favicon.ico" type="image/x-icon">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="<?=$_SERVER['CLIENT_PATH']?>/assets/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    <link rel="stylesheet" href="<?=$_SERVER['CLIENT_PATH']?>/assets/css/main.css">
    <title>Create New Post</title>
</head>
<body>

<?php
    include $_SERVER['SERVER_PATH'] . "/header.php";
?>
<?php if (isset($postID)) : ?>
    <div class="container-fluid">
    <h1>Edit Existing Post</h1>
    <hr/>
<!--Serverside validation only atm-->
<form action="#" method="post">
    <div class="form-group">
        <label for="inputUser">Title:</label>
        <input type="text" class="form-control" name="title" id="inputTitle" aria-describedby="Title" placeholder="Title" value="<?=$post['Title']?>">
    </div>
    <div class="form-group">
        <label for="inputContent">Content:</label>
        <textarea class="form-control" name="content" id="inputContent" rows="5"><?=$post['Content']?></textarea>
    </div>
    <div class="form-group">
        <label for="selectCategory">Category:</label>
        <select class="form-control" name="category" id="selectCategory">
        <?php foreach (getCategories()[1] as $category) : ?>
            <option 
            <?php if ($category[0] == $post['CategoryID']):?>
            selected 
            <?php endif?>
            value=<?=$category[0]?>><?=$category[1]?></option>
        <?php endforeach ?>
        </select>
    </div>
  <button type="submit" class="btn btn-primary">Submit</button>
  <a type="submit" class="btn btn-danger" name="command" value="Delete" href="<?=$_SERVER['CLIENT_PATH']?>/post/delete.php?id=<?=$id?>"/>Delete</a>
</form>

</div>
<?php endif ?>

<?php
    include $_SERVER['SERVER_PATH'] . "/footer.php";
?>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="<?=$_SERVER['CLIENT_PATH']?>/assets/js/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="<?=$_SERVER['CLIENT_PATH']?>/assets/js/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="<?=$_SERVER['CLIENT_PATH']?>/assets/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <script src="<?=$_SERVER['CLIENT_PATH']?>/vendor/tinymce/tinymce/tinymce.min.js"></script>
    <script>
  tinymce.init({
    selector: '#inputContent'
  });
  </script>
</body>
</html>