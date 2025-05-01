<ol class="breadcrumb">
    <li><a href="<?php echo base_url('dashboard') ?>">Home</a></li>
    <li class="active">Add Role</li>
</ol>

<div class="panel panel-primary">
    <div class="panel-heading">
        Add Role
    </div>
    <div class="panel-body">
        <div id="messages"></div>
        <form class="form-horizontal" method="post" id="createRoleForm"
              action="<?php echo base_url() . 'roles/create' ?>">
            <div class="col-10">
                <div id="add-role-messages"></div>
                <fieldset>
                    <div class="form-group">
                        <label for="roleName" class="col-sm-2 control-label">Role Name : </label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="roleName" name="roleName"
                                   placeholder="Role Name">
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
                                        <td><input id="permissions" type="checkbox" name="permissions[]" value="<?= $value['id'] ?>"
                                                   class="form-control"/></td>
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
