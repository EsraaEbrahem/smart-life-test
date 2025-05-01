<ol class="breadcrumb">
    <li><a href="<?php echo base_url('dashboard') ?>">Home</a></li>
    <li class="active">Update Role</li>
</ol>

<div class="panel panel-primary">
    <div class="panel-heading">
        Update Role
    </div>
    <div class="panel-body">
        <div id="messages"></div>
        <form class="form-horizontal" method="post" id="updateRoleForm"
              action="<?php echo base_url() . 'roles/update/'.$role['id'] ?>">
            <div class="col-10">
                <div id="edit-role-message"></div>
                <fieldset>
                    <div class="form-group">
                        <label for="roleName" class="col-sm-2 control-label">Role Name : </label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="roleName" name="roleName"
                                  value="<?=$role['name']?>" placeholder="Role Name">
                            <input type="hidden" name="roleId" value="<?=$role['id']?>">
                        </div>
                    </div>
                </fieldset>
                <fieldset>
                    <div class="form-group">
                        <label for="permissions" class="col-sm-2 control-label">Permissions : </label>
                        <div class="col-sm-8" style="height:300px; overflow:auto;">
                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach ($permissions as $key => $value) { ?>
                                    <tr>
                                        <td>
                                            <input id="permissions" type="checkbox" name="permissions[]" value="<?= $value['id'] ?>"
                                                <?php if(in_array($value['id'], $role_permissions)) echo "checked"?>
                                                   class="form-control"/>
                                        </td>
                                        <td><?= $value['clear_name'] ?></td>
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
