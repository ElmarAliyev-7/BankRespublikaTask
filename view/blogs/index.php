<?php $blogs = select('blogs');?>
<div class="container">
    <div class="row">
        <div class="col-12"><?php include "create.php";?></div>
        <div class="col-12">
            <h3 class="text-center">Blogs Table</h3>
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
                    <?php $key++;?>
                    <tr>
                        <th><?=$key;?></th>
                        <td>#<?=$blog['id'];?></td>
                        <td><img src="<?=$blog['image'];?>" width="120px" height="100px"/></td>
                        <td><?=$blog['description'];?></td>
                        <td>Edit | Delete</td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="container">
    <div class="row">
        <?php foreach ($blogs as $key => $blog): ?>
            <div class="col-4">
                <?php echo card($blog['image'], '', '', $blog['description'], ''); ?>
            </div>
        <?php endforeach; ?>
    </div>
</div>
