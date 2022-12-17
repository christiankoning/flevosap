<?php
require 'views/partials/admin/adminhead.partial.php'
?>

<div class="container-fluid">
    <div class="row mb-3">
        <div class="col-2"></div>
        <div class="col-8">
            <div class="card changeaccount">
                <h2 class="card-title ms-1">Producten</h2>
                <div class="card-body">
                    <div class="card-text">
                        <span>Nieuw Product</span>
                        <form action="<?=Request::buildUri("/admin/producten/toevoegen")?>" method="post">
                            <button class="fa fa-plus" type="submit" value="Voeg product toe">
                        </form>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-striped text-nowrap">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">naam</th>
                                <th scope="col">prijs</th>
                                <th scope="col">omschrijving</th>
                                <th scope="col">afbeelding</th>
                                <th scope="col">categorie</th>
                                <th scope="col">aanbevolen</th>
                                <th scope="col">voorraad</th>
                                <th scope="col"></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            foreach ($stmt as $row) {
                                require 'views/partials/admin/viewProducts.partial.php';
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

<!-- Modal confirm delete product -->
<div class="modal fade" id="modalDeleteForm" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content modalCrudPopup">
            <div class="modal-header">
                <h5 class="modal-title">Product verwijderen</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="<?=Request::buildUri("/admin/producten")?>" method="post">
                    <input type="hidden" name="productStatus" value="delete" />
                    <input type="hidden" id="productDeleteId" name="id" />
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
<!-- End modal confirm delete product  -->

<script>
    $('.deleteProduct').submit(function (event){

        event.preventDefault();

        var $form = $(this);
        var serializedData = $form.serialize();

        $.ajax({
            type:"POST",
            url:"<?=Request::buildUri("/admin/producten/verwijderen")?>",
            dataType:"json",
            data: serializedData,
            success:function (response) {
                //console.log(response);
                $("#productDeleteId").val(response['id'])
                $('#deleteText').empty();
                $('#deleteText').append("Wilt u het product "+ response['name'] +" verwijderen?")
            }
        });
    });
</script>

<?php
require 'views/partials/foot.partial.php'
?>
