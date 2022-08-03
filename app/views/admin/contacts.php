<div class="content-wrapper">
    <div class="container-fluid">
        <div class="card mb-3">
            <div class="card-header">Contacts</div>
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-4">
                        <?php if (empty($aContacts)): ?>
                            <p>Empty list of contacts</p>
                        <?php else: ?>
                            <table class="table">
                                <tr>
                                    <th>Username</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Edit</th>
                                    <th>Delete</th>
                                </tr>
                                <?php foreach ($aContacts as $aContact): ?>
                                    <tr>
                                        <td><?php echo htmlspecialchars($aContact['name'], ENT_QUOTES); ?></td>
                                        <td><?php echo htmlspecialchars($aContact['email'], ENT_QUOTES); ?></td>
                                        <td><?php echo htmlspecialchars($aContact['phone'], ENT_QUOTES); ?></td>
                                        <td><a href="/admin/contacts/edit/<?php echo $aContact['id']; ?>" class="btn btn-primary">Edit</a></td>
                                        <td><a href="/admin/contacts/delete/<?php echo $aContact['id']; ?>" class="btn btn-danger"  onclick="return confirm('Are you sure you want to delete this item?');">Delete</a></td>
                                    </tr>
                                <?php endforeach; ?>
                            </table>
                            <?php echo $pagination; ?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>