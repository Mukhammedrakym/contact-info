<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<div class="content-wrapper">
    <div class="container-fluid">
        <div class="card mb-3">
            <div class="card-header">Favourite contacts</div>
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-4">
                        <?php if (empty($aFavourites)): ?>
                            <p>Empty list of favourite contacts</p>
                        <?php else: ?>
                            <table class="table">
                                <tr>
                                    <th>Username</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Delete</th>
                                </tr>
                                <?php foreach ($aFavourites as $aFavourite): ?>
                                    <tr>
                                        <td><?php echo htmlspecialchars($aFavourite['name'], ENT_QUOTES); ?></td>
                                        <td><?php echo htmlspecialchars($aFavourite['email'], ENT_QUOTES); ?></td>
                                        <td><?php echo htmlspecialchars($aFavourite['phone'], ENT_QUOTES); ?></td>
                                        <td>
                                            <button id="contact_id_<?php echo $_SESSION['auth']['user_id'] . '_' . $aFavourite['id'] ?>" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this item?');">Delete from Favourites</button>
                                            </button>
                                        </td>
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
<script>
    var aData = {};
    $('[id^=contact_id').click(function() {
        var sUserAndContactId = $(this).attr('id');

        var sUserId = sUserAndContactId.split('_')[2];
        var sContactId = sUserAndContactId.split('_')[3];
        aData = {'user_id': sUserId, 'contact_id': sContactId};
        deleteContactFromFavourites(aData);
        window.location.reload();
    })

    function deleteContactFromFavourites(aData) {
        $.ajax({
            url: '/user/delete-contact-from-favourites',
            type: 'POST',
            data: aData,
            async: false,
            success: function (data) {

            },
            error: function (msgError) {
                console.log(msgError);
            }
        })
    }
</script>