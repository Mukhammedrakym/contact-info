<div class="content-wrapper">
    <div class="container-fluid">
        <div class="card mb-3">
            <div class="card-header"><?php echo $sTitle; ?></div>
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-4">
                        <form action="/admin/contacts/edit/<?php echo $aData['id']; ?>" method="post" >
                            <div class="form-group">
                                <label>Username</label>
                                <input class="form-control" type="text" value="<?php echo htmlspecialchars($aData['name'], ENT_QUOTES); ?>" name="name">
                            </div>
                            <div class="form-group">
                                <label>Email</label>
                                <input class="form-control" type="text" value="<?php echo htmlspecialchars($aData['email'], ENT_QUOTES); ?>" name="email">
                            </div>
                            <div class="form-group">
                                <label>Phone</label>
                                <input class="form-control" rows="3" value="<?php echo htmlspecialchars($aData['phone'], ENT_QUOTES); ?> "name="phone">
                            </div>
                            <button type="submit" class="btn btn-primary btn-block">Save</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
