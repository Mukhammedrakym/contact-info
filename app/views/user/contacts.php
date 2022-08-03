<style>
    .star {
        font-size: 25px;
        color:gold;
    }
</style>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
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
                                    <th>Add to favourite</th>
                                </tr>
                                <?php foreach ($aContacts as $aContact): ?>
                                    <tr>
                                        <td><?php echo htmlspecialchars($aContact['name'], ENT_QUOTES); ?></td>
                                        <td><?php echo htmlspecialchars($aContact['email'], ENT_QUOTES); ?></td>
                                        <td><?php echo htmlspecialchars($aContact['phone'], ENT_QUOTES); ?></td>
                                        <td>
<!--                                                <button type="button" class="btn-outline-danger"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-heart text-white" viewBox="0 0 16 16">-->
<!--                                                        <path d="m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01L8 2.748zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143c.06.055.119.112.176.171a3.12 3.12 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15z"/>-->
<!--                                                    </svg>-->
                                                <button id="contact_id_<?php echo $_SESSION['auth']['user_id'] . '_' . $aContact['id'] ?>" class="btn btn-outline-success"></button>
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