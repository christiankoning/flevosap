<?php
require 'views/partials/admin/adminhead.partial.php'
?>

<div class="container-fluid">
    <div class="row mb-3">
        <div class="col-2"></div>
        <div class="col-8">
            <div class="card changeaccount">
                <h2 class="card-title ms-1">Gebruikers</h2>
                <div class="card-body">
                    <div class="card-text">
                        <span>Nieuwe Gebruiker</span>
                        <form action="<?=Request::buildUri("/admin/gebruikers/aanmaken")?>" method="post">
                            <button class="fa fa-plus" type="submit" value="Voeg User toe">
                        </form>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-striped text-nowrap">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">email</th>
                                <th scope="col">isAdmin</th>
                                <th scope="col">Type</th>
                                <th scope="col">Active</th>
                                <th scope="col">createdAt</th>
                                <th scope="col">updateAt</th>
                                <th scope="col"></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            foreach ($stmt as $row) {
                                require 'views/partials/admin/UsersView.partial.php';
                            }
                            ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-2"></div>
    </div>
</div>

<!-- Modal edit user -->
<div class="modal fade" id="modalEditForm" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content modalCrudPopup">
            <div class="modal-header">
                <h5 class="modal-title">Gebruiker bewerken</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="<?=Request::buildUri("/admin/gebruikers")?>" method="post">
                    <input type="hidden" name="userStatus" value="edit" />
                    <input type="hidden" id="userId" name="userId" />
                    <div class="mb-3">
                        <label>E-mail: </label>
                        <span id="userEmail"></span>
                        <br />
                        <br />
                        <label>Rol: </label>
                        <select name="isAdmin">
                           <option id="isUser" value="0" >Gebruiker</option>
                            <option id="isAdmin" value="1" >Beheerder</option>
                        </select>
                    </div>
                    <div class="modal-footer d-block">
                        <button type="submit" class="btn btn-warning float-end">Bewerk gebruiker</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- End modal edit user  -->

<!-- Modal confirm delete user -->
<div class="modal fade" id="modalDeleteForm" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content modalCrudPopup">
            <div class="modal-header">
                <h5 class="modal-title">Gebruiker verwijderen</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="<?=Request::buildUri("/admin/gebruikers")?>" method="post">
                    <input type="hidden" name="userStatus" value="delete" />
                    <input type="hidden" id="userDeleteId" name="categoryId" />
                    <input type="hidden" name="confirmDelete" value="1" />
                    <div class="mb-3">
                        <label id="deleteText" class="form-label"></label>
                    </div>
                    <div class="modal-footer d-block">
                        <button type="button" class="btn btn-warning" data-bs-dismiss="modal" aria-label="Close">Annuleren</button>
                        <button type="submit" class="btn btn-warning float-end">Verwijderen</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- End modal confirm delete user  -->

<script>
    $('.editUser').submit(function (event){

        event.preventDefault();

        var $form = $(this);
        var serializedData = $form.serialize();

        $.ajax({
            type:"POST",
            url:"<?=Request::buildUri("/admin/gebruikers/bewerken")?>",
            dataType:"json",
            data: serializedData,
            success:function (response) {
                console.log(response);

                if (response['isAdmin'] === "0")
                {
                    $("#isAdmin").prop('selected', false);
                    $("#isUser").prop('selected', true)
                } else if(response['isAdmin'] === "1")
                {
                    $("#isUser").prop('selected', false);
                    $("#isAdmin").prop('selected', true);
                }

                $("#userEmail").empty();
                $("#userEmail").append(response['email']);
                $("#userId").val(response['id'])
            }
        });
    });
    $('.deleteUser').submit(function (event){

        event.preventDefault();

        var $form = $(this);
        var serializedData = $form.serialize();

        $.ajax({
            type:"POST",
            url:"<?=Request::buildUri("/admin/gebruikers/verwijderen")?>",
            dataType:"json",
            data: serializedData,
            success:function (response) {
                //console.log(response);
                $("#userDeleteId").val(response['id'])
                $('#deleteText').empty();
                $('#deleteText').append("Wilt u de gebruiker "+ response['email'] +" verwijderen?")
            }
        });
    });
</script>

<?php
require 'views/partials/foot.partial.php'
?>