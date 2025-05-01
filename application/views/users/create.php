<ol class="breadcrumb">
    <li><a href="<?php echo base_url('dashboard') ?>">Home</a></li>
    <li class="active">Add User</li>
</ol>

<div class="panel panel-primary">
    <div class="panel-heading">
        Add User
    </div>
    <div class="panel-body">
        <div id="messages"></div>
        <form class="form-horizontal" method="post" id="createUserForm"
              action="<?php echo base_url() . 'users/create' ?>">
            <div class="col-10">
                <div id="add-user-messages"></div>
                <fieldset>
                    <div class="form-group">
                        <label for="username" class="col-sm-2 control-label">Username : </label>
                        <div class="col-sm-8">
                            <input type="text" id="username" name="username" class="form-control"
                                   placeholder="Username">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="fname" class="col-sm-2 control-label">First Name : </label>
                        <div class="col-sm-8">
                            <input type="text" id="fname" name="fname" class="form-control" placeholder="First Name">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="lname" class="col-sm-2 control-label">Last Name : </label>
                        <div class="col-sm-8">
                            <input type="text" id="lname" name="lname" class="form-control" placeholder="Last Name">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="email"  class="col-sm-2 control-label">Email : </label>
                        <div class="col-sm-8">
                            <input type="email" id="email" name="email" class="form-control" placeholder="Email">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="email" class="col-sm-2 control-label">Password : </label>
                        <div class="col-sm-8">
                            <input type="text" id="password" name="password" class="form-control" placeholder="Password">
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
                                    <th>#</th>
                                    <th>Name</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach ($roles as $key => $value) { ?>
                                    <tr>
                                        <td><input id="roles" type="checkbox" name="roles[]" value="<?= $value['id'] ?>"
                                                   class="form-control"/></td>
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
<script type="text/javascript" src="<?php echo base_url('custom/js/user.js') ?>"></script>
