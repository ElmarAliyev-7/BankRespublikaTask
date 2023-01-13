<?php
try {
    $blogs = select('blogs');
    $messages = [];
    if( isset($_POST['submit'])):
        if(empty($_POST['desc'])):
            array_push($messages, alert('warning', 'Description required!'));
        elseif(empty($_FILES['image']['name'])):
            array_push($messages, alert('warning', 'Image required!'));
        else:
            $create_blog = create('blogs',['image', 'description'],
                ['images/blogs/'.$_FILES['image']['name'], $_POST['desc']]);
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

<div class="container">
    <div class="rows">
        <div class="col-12">
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
        </div>
        <div class="col-12">
            <h3 class="text-center">Blogs</h3>
            <table class="table table-dark">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">id</th>
                    <th scope="col">Image</th>
                    <th scope="col">Description</th>
                    <th scope="col">Actions</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($blogs as $key => $blog): ?>
                    <tr>
                        <th><?=$key;?></th>
                        <td>#<?=$blog['id'];?></td>
                        <td><img src="<?=$blog['image'];?>" width="120px" height="100px"/></td>
                        <td><?=$blog['description'];?></td>
                        <td>sil</td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

