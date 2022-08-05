
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<div class="content-wrapper">
    <div class="container-fluid">
        <div class="card mb-3">
            <div class="card-header">Contacts</div>
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-4">
                        <?php if (empty($aContacts)) { ?>
                            <p>Empty list of contacts</p>
                        <?php } else { ?>
                            <table class="table">
                                <tr>
                                    <th>Username</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Add to favourite</th>
                                </tr>
                                <?php
                                    if (!empty($aFavourites)) {
                                        foreach ($aContacts as $aContact) {
                                            $sButtonClass = 'btn btn-outline-success';
                                            foreach ($aFavourites as $aFavourite) {
                                                if ($aContact['id'] == $aFavourite['id']) {
                                                    $sButtonClass = 'btn btn-success';
                                                } }?>
                                            <tr>
                                                <td><?= htmlspecialchars($aContact['name'], ENT_QUOTES); ?></td>
                                                <td><?php echo htmlspecialchars($aContact['email'], ENT_QUOTES); ?></td>
                                                <td><?php echo htmlspecialchars($aContact['phone'], ENT_QUOTES); ?></td>
                                                <td>
                                                    <button id="contact_id_<?php echo $_SESSION['auth']['user_id'] . '_' . $aContact['id'] ?>" class="<?php echo $sButtonClass; ?>"></button>
                                                    </button>
                                                </td>
                                            </tr>
                                <?php }

                                } else {
                                        foreach ($aContacts as $aContact) {
                                            $sButtonClass = 'btn btn-outline-success'; ?>
                                            <tr>
                                                <td><?php echo htmlspecialchars($aContact['name'], ENT_QUOTES); ?></td>
                                                <td><?php echo htmlspecialchars($aContact['email'], ENT_QUOTES); ?></td>
                                                <td><?php echo htmlspecialchars($aContact['phone'], ENT_QUOTES); ?></td>
                                                <td>
                                                    <button id="contact_id_<?php echo $_SESSION['auth']['user_id'] . '_' . $aContact['id'] ?>" class="<?php echo $sButtonClass; ?>"></button>
                                                    </button>
                                                </td>
                                            </tr>
                                       <?php }
                                   }?>


                            </table>
                            <?php echo $pagination; ?>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    var aData = {};
    $('[id^=contact_id]').click(function() {
        var sButtonClassFavourite = 'btn btn-success';
        var sButtonClassNotFavourite = 'btn btn-outline-success'
        var sUserAndContactId = $(this).attr('id');
        var sUserId = sUserAndContactId.split('_')[2];
        var sContactId = sUserAndContactId.split('_')[3];
        aData = {'user_id': sUserId, 'contact_id': sContactId};
        var sButtonClass = $(this).attr('class');
        if (sButtonClass == sButtonClassNotFavourite) {
            saveContactToFavourites(aData);
            $(this).attr('class', sButtonClassFavourite);
            alert('Contact added to favourites');
        } else {
            deleteContactFromFavourites(aData);
            $(this).attr('class', sButtonClassNotFavourite);
            alert('Contact deleted from favourites');
        }
    })

    function saveContactToFavourites(aData) {
        $.ajax({
            url: '/user/save-contact-to-favourites',
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