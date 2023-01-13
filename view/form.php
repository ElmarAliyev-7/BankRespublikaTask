<?php
    if(isset($_POST['submit'])){
        if(isset($_POST['desc']) && $_FILES['image']['size'] !== 0){
            try {
                $message = create('blogs', ['image', 'description'], [$_FILES['image']['name'], $_POST['desc']]);
                uploadImage('images/blogs/', $_FILES['image']['name'],$_FILES['image']['tmp_name'], $_FILES["image"]["size"]);
            } catch(PDOException $e) {
                $message= $e->getMessage();
            }
        }else{
            $message = alert('warning','Image and Description is required !');
        }
    }
?>

<form method="post" action="" class="container mt-5" enctype="multipart/form-data">
    <div class="form-group pt-2">
        <?php if(isset($message)): ?>
            <?=$message;?>
        <?php endif;?>
    </div>
    <div class="form-group pt-2">
        <label for="image">Şəkili daxil edin</label>
        <input type="file" name="image" class="form-control" id="image">
    </div>
    <div class="form-group pt-2">
        <label for="desc">Açıqlama</label>
        <textarea name="desc" class="form-control" id="desc" rows="5"></textarea>
    </div>
    <div class="form-group pt-2">
        <button name="submit" type="submit" class="btn btn-success">Göndər</button>
    </div>
</form>
