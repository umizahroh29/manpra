<?php
$practicum_data = $_SESSION['practicum_data'];
?>

<?php include "views/layout/sidebar.php" ?>

    <div class="pt-3 pl-3 pr-3 pb-0">
        <h5>Import Praktikan</h5>
    </div>
    <hr>
    <div class="container">
        <form action="import-save" method="POST" enctype="multipart/form-data">
            <div class="row justify-content-md-center">
                <div class="col-sm-6">
                    <div id="accordion">
                        <div class="card">
                            <div class="card-header" id="practicum">
                                <button class="btn" data-toggle="collapse" data-target="#collapsePracticum"
                                        aria-expanded="true" aria-controls="collapsePracticum">
                                    Data Praktikum
                                </button>
                            </div>
                            <div id="collapsePracticum" class="collapse show" aria-labelledby="practicum"
                                 data-parent="#accordion">
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="practicum_id">Nama Praktikum</label>
                                        <select class="form-control form-control-sm" name="practicum_id"
                                                id="practicum_id">
                                            <option value="">Pilih Praktikum</option>
                                            <?php foreach ($practicum_data as $datum) { ?>
                                                <option value="<?= $datum['id'] ?>"><?= $datum['name'] ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="file">Upload File</label>
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="file" name="file">
                                            <label class="custom-file-label" for="customFile">Choose file</label>
                                            <small class="form-text text-muted">* Format : .xls</small>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 text-center pt-4">
                                        <a href="assets/files/Template Import ManPra.xlxs" download>Download Format File Upload</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group mt-4">
                <div class="col-sm-12 text-center">
                    <button type="submit" class="btn btn-fill btn-sm">Save</button>
                    <button type="button" class="btn btn-outline-secondary btn-sm"
                            onclick="history.back()">Cancel
                    </button>
                </div>
            </div>
        </form>
    </div>

    <script>
        $(function () {
            $('#sidebar ul li#import a').parent().parent().toggle('show');
            $('#sidebar ul li#import a').addClass('active');
        });
    </script>
<?php include "views/layout/footer.php" ?>