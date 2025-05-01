<ol class="breadcrumb">
    <li><a href="<?php echo base_url('dashboard') ?>">Home</a></li>
    <li class="active">View Role</li>
</ol>

<div class="panel panel-primary">
    <div class="panel-heading">
        Update Role
    </div>
    <div class="panel-body">
        <div id="messages"></div>
            <div class="col-10">
                <fieldset>
                    <div class="form-group">
                        <label for="roleName" class="col-sm-2 control-label">Role Name : </label>
                        <div class="col-sm-8">
                         <?=$role['name']?>
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
                                    <th>Name</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach ($permissions as $key => $value) { ?>
                                    <tr>
                                        <td><?= $value['clear_name'] ?></td>
                                    </tr>
                                <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </fieldset>
            </div>
    </div>
</div>
