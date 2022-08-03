<div class="content-wrapper">
    <div class="container-fluid">
        <div class="card mb-3">
            <div class="card-header"><?php echo $sTitle; ?></div>
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-4">
                        <form action="/admin/contacts/create" method="post">
                            <div class="form-group">
                                <label>Username</label>
                                <input class="form-control" type="text" name="name">
                            </div>
                            <div class="form-group">
                                <label>Email</label>
                                <input class="form-control" type="text" name="email">
                            </div>
                            <div class="form-group">
                                <label>Phone</label>
                                <input class="form-control" rows="3" name="phone">
                            </div>
<!--                            <div class="form-group">-->
<!--                                <label>Изображение</label>-->
<!--                                <input class="form-control" type="file" name="img">-->
<!--                            </div>-->
                            <button type="submit" class="btn btn-primary btn-block">Create</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>