<ol class="breadcrumb">
    <li><a href="<?php echo base_url('dashboard') ?>">Home</a></li>
    <li class="active">Update User</li>
</ol>

<div class="panel panel-primary">
    <div class="panel-heading">
        Update User
    </div>
    <div class="panel-body">
        <div id="messages"></div>
        <form class="form-horizontal" method="post" id="updateRoleForm"
              action="<?php echo base_url() . 'users/update/'.$user['user_id'] ?>">
            <div class="col-10">
                <div id="edit-role-message"></div>
                <fieldset>
                    <div class="form-group">
                        <label for="username" class="col-sm-2 control-label">User Name : </label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="username" name="username"
                                  value="<?=$user['username']?>" placeholder="User Name">
                            <input type="hidden" name="roleId" value="<?=$user['user_id']?>">
                        </div>
                    </div>
                </fieldset>
                <fieldset>
                    <div class="form-group">
                        <label for="fname" class="col-sm-2 control-label">First Name : </label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="fname" name="fname"
                                   value="<?=$user['fname']?>" placeholder="First Name">
                        </div>
                    </div>
                </fieldset>
                <fieldset>
                    <div class="form-group">
                        <label for="lname" class="col-sm-2 control-label">Last Name : </label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="lname" name="lname"
                                   value="<?=$user['lname']?>" placeholder="Last Name">
                        </div>
                    </div>
                </fieldset>
                <fieldset>
                    <div class="form-group">
                        <label for="email" class="col-sm-2 control-label">Email : </label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="email" name="email"
                                   value="<?=$user['email']?>" placeholder="Email">
                        </div>
                    </div>
                </fieldset>
                <fieldset>
                    <div class="form-group">
                        <label for="password" class="col-sm-2 control-label">Password : </label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="password" name="password"
                                   placeholder="Password">
                        </div>
                    </div>
                </fieldset>
                <fieldset>
                    <div class="form-group">
                        <label for="permissions" class="col-sm-2 control-label">Roles : </label>
                        <div class="col-sm-8" style="height:300px; overflow:auto;">
                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach ($roles as $key => $value) { ?>
                                    <tr>
                                        <td>
                                            <input id="permissions" type="checkbox" name="roles[]" value="<?= $value['id'] ?>"
                                                <?php if(in_array($value['id'], $user_roles)) echo "checked"?>
                                                   class="form-control"/>
                                        </td>
                                        <td><?= $value['name'] ?></td>
                                    </tr>
                                <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </fieldset>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Save changes</button>
            </div>
        </form>
    </div>
</div>
<script type="text/javascript" src="<?php echo base_url('custom/js/role.js') ?>"></script>
