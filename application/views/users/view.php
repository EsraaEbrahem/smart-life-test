<ol class="breadcrumb">
    <li><a href="<?php echo base_url('dashboard') ?>">Home</a></li>
    <li class="active">View User</li>
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
                        <label class="col-sm-2 control-label">User Name : </label>
                        <div class="col-sm-8">
                         <?=$user['username']?>
                        </div>
                    </div>
                </fieldset>
                <fieldset>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">First Name : </label>
                        <div class="col-sm-8">
                         <?=$user['fname']?>
                        </div>
                    </div>
                </fieldset>
                <fieldset>
                    <div class="form-group">
                        <label  class="col-sm-2 control-label">Last Name : </label>
                        <div class="col-sm-8">
                         <?=$user['lname']?>
                        </div>
                    </div>
                </fieldset>
                <fieldset>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Email : </label>
                        <div class="col-sm-8">
                         <?=$user['email']?>
                        </div>
                    </div>
                </fieldset>
                <fieldset>
                    <div class="form-group">
                        <label for="roles" class="col-sm-2 control-label">Roles : </label>
                        <div class="col-sm-8" style="height:300px; overflow:auto;">
                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th>Name</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach ($roles as $key => $value) { ?>
                                    <tr>
                                        <td><?= $value['name'] ?></td>
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
