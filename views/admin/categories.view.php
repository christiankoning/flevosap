<?php
require 'views/partials/admin/adminhead.partial.php'
?>

<div class="container-fluid">
    <div class="row mb-3">
        <div class="col-2"></div>
        <div class="col-8">
            <div class="card changeaccount">
                <h2 class="card-title ms-1">Categorieën</h2>
                <div class="card-body">
                    <div class="card-text">
                        <span>Nieuwe Categorie</span>
                        <form>
                            <button type="button" class="fa fa-plus" data-bs-toggle="modal" data-bs-target="#modalCreateForm" value="Voeg categorie toe">
                        </form>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-striped text-nowrap">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Naam</th>
                                <th scope="col"></th>
                            </tr>
                            </thead>
                            <tbody>
                                <?php
                                    foreach ($stmt as $row) {
                                        require 'views/partials/admin/categoryView.partial.php';
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

<!-- Modal add category -->
<div class="modal fade" id="modalCreateForm" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content modalCrudPopup">
            <div class="modal-header">
                <h5 class="modal-title">Categorie aanmaken</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="<?=Request::buildUri("/admin/categorieen")?>" method="post">
                    <input type="hidden" name="categoryStatus" value="create" />
                    <div class="mb-3">
                        <label class="form-label">Naam*</label>
                        <input type="text" class="form-control" name="categoryName" placeholder="Naam categorie" required/>
                    </div>
                    <div class="modal-footer d-block">
                        <button type="submit" class="btn btn-warning float-end">Categorie toevoegen</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- End modal add category  -->

<!-- Modal edit category -->
<div class="modal fade" id="modalEditForm" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content modalCrudPopup">
            <div class="modal-header">
                <h5 class="modal-title">Categorie bewerken</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="<?=Request::buildUri("/admin/categorieen")?>" method="post">
                    <input type="hidden" name="categoryStatus" value="edit" />
                    <input type="hidden" id="categoryId" name="categoryId" />
                    <div class="mb-3">
                        <label class="form-label">Naam*</label>

                        <input type="text" class="form-control" id="editName" name="categoryName" value="" placeholder="Naam categorie" required/>
                    </div>
                    <div class="modal-footer d-block">
                        <button type="submit" class="btn btn-warning float-end">Bewerk categorie</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- End modal edit category  -->

<!-- Modal confirm delete category -->
<div class="modal fade" id="modalDeleteForm" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content modalCrudPopup">
            <div class="modal-header">
                <h5 class="modal-title">Categorie verwijderen</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="<?=Request::buildUri("/admin/categorieen")?>" method="post">
                    <input type="hidden" name="categoryStatus" value="delete" />
                    <input type="hidden" id="categoryDeleteId" name="categoryId" />
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
<!-- End modal confirm delete category  -->

<script>
    $('.editCategory').submit(function (event){

        event.preventDefault();

        var $form = $(this);
        var serializedData = $form.serialize();

        $.ajax({
            type:"POST",
            url:"<?=Request::buildUri("/admin/categorieen/bewerken")?>",
            dataType:"json",
            data: serializedData,
            success:function (response) {
                //console.log(response);
                $("#editName").val(response['name']);
                $("#categoryId").val(response['id'])
            }
        });
    });

    $('.deleteCategory').submit(function (event){

        event.preventDefault();

        var $form = $(this);
        var serializedData = $form.serialize();

        $.ajax({
            type:"POST",
            url:"<?=Request::buildUri("/admin/categorieen/verwijderen")?>",
            dataType:"json",
            data: serializedData,
            success:function (response) {
                //console.log(response);
                $("#categoryDeleteId").val(response['id'])
                $('#deleteText').empty();
                $('#deleteText').append("Wilt u de categorie "+ response['name'] +" verwijderen?")
            }
        });
    });
</script>

<?php
require 'views/partials/foot.partial.php'
?>