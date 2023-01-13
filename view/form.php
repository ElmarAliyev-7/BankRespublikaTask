<?php
try {
    $messages = [];
    if( isset($_POST['submit'])):
        if(empty($_POST['desc'])):
            array_push($messages, alert('warning', 'Description required!'));
        elseif(empty($_FILES['image']['name'])):
            array_push($messages, alert('warning', 'Image required!'));
        else:
            $create_blog = create('blogs',['image', 'description'],[$_FILES['image']['name'], $_POST['desc']]);
            array_push($messages, $create_blog);

            $upload_image = uploadImage('images/blogs/',$_FILES['image']['name'],
                $_FILES['image']['tmp_name'],$_FILES["image"]["size"]);
            array_push($messages, $upload_image);
        endif;
    endif;
} catch(PDOException $e) {
    $message= $e->getMessage();
}
?>

<form method="post" action="" class="container mt-5" enctype="multipart/form-data">
    <div class="form-group pt-2">
        <?php foreach ($messages as $message):?>
            <?=$message;?>
        <?php endforeach;?>
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
