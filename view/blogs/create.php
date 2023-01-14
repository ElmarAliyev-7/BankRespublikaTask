<?php
try {
    $messages = [];
    if( isset($_POST['submit'])):
        if(empty($_POST['desc'])):
            array_push($messages, alert('warning', 'Description required!'));
        elseif(empty($_FILES['image']['name'])):
            array_push($messages, alert('warning', 'Image required!'));
        else:
            $upload_image = uploadImage('images/blogs/',$_FILES['image']['name'],
                $_FILES['image']['tmp_name'],$_FILES["image"]["size"]);

            if($upload_image['uploadOk'] == 1):
                $create_blog = create('blogs',['image', 'description'],
                    ['images/blogs/'.$_FILES['image']['name'], $_POST['desc']]);
                array_push($messages, $create_blog);
            else:
                array_push($messages, $upload_image['message']);
            endif;
        endif;
    endif;
} catch(PDOException $e) {
    $message= $e->getMessage();
}
?>

<h3 class="text-center">Create Blog</h3>
<form method="post" action="" enctype="multipart/form-data">
    <div class="form-group">
        <?php foreach ($messages as $message):?>
            <?=$message;?>
        <?php endforeach;?>
    </div>
    <div class="form-group px-2 py-2">
        <label for="image">Upload Image</label>
        <input type="file" name="image" class="form-control" id="image">
    </div>
    <div class="form-group px-2 py-2">
        <label for="desc">Enter Description</label>
        <textarea name="desc" class="form-control" id="desc" rows="5"></textarea>
    </div>
    <div class="form-group px-1 py-2">
        <button name="submit" type="submit" class="btn btn-success">Submit</button>
    </div>
</form>
