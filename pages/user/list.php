<?php
    if(isset($_GET['status'])){
        if($_GET['status'] == 1){
            ?>
                <script>
                    alert("Deleted successfully!")
                </script>
            <?php
        }elseif($_GET['status']==0){
            ?>
                <script>
                    alert("Deleted failed!")
                </script>
            <?php
        }
    }
?>  


<div class="container mt-5">
    <div class="d-flex justify-content-between" style="position: sticky; top: 10px;">
        <h3>User list</h3>
        <a href="./?page=user/create" role="button" class="btn btn-success" >Create New</a>
    </div>
    <div class="table-responsive mt-5 " style="height: 500px;">
        <table class="table table-info table-hover table-striped text-center align-middle">
            <thead>
                <tr style="position: sticky; top: 0px;">
                    <th>
                        #
                    </th>
                    <th>Photo</th>
                    <th>Name</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                    $user = getUsers();
                    if($user){
                        while($row = $user->fetch_object()){
                            ?>
                                <tr>
                                    <td><?= $row->UserID ?></td>
                                    <td><img src="<?php echo $row->image ?? './assets/uploads/emptyuser.png'?>" class="rounded img-thumbnail" style="max-width: 100px;"></td>
                                    <td><?= $row->Name ?></td>
                                    <td>
                                        <a href="./?page=user/update&id=<?php echo $row->UserID ?>" role="button" class="btn btn-primary">Edit</a>
                                        <a href="./?page=user/delete&id=<?php echo $row->UserID ?>" role="button" class="btn btn-danger">Delete</a>
                                    </td>
                                </tr>
                            <?php
                        }
                    }

                ?>

            </tbody>
            <tfoot>

            </tfoot>
        </table>
    </div>

</div>