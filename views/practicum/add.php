<?php
$lecturer_data = $_SESSION['lecturer_data'];
?>

<?php include "views/layout/sidebar.php" ?>

<div class="pt-3 pl-3 pr-3 pb-0">
    <h5>Tambah Praktikum</h5>
</div>
<hr>
<div class="container">
    <form action="practicum-save" method="POST">
        <div class="row">
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
                                    <label for="name">Nama Praktikum</label>
                                    <input type="text" class="form-control form-control-sm" id="name" name="name"
                                           required>
                                </div>
                                <div class="form-group">
                                    <label for="lecturer">Dosen Pengampu</label>
                                    <select name="lecturer" id="lecturer" class="form-control form-control-sm">
                                        <option value="">Pilih Dosen Pengampu</option>
                                        <?php foreach ($lecturer_data as $datum) { ?>
                                        <option value="<?= $datum['code'] ?>"> <?= $datum['name'] ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="year">Tahun</label>
                                    <input type="text" class="form-control form-control-sm" id="year" name="year"
                                           required>
                                </div>
                                <div class="form-group">
                                    <label for="lecturer">Metode Praktikum</label>
                                    <select name="type" id="type" class="form-control form-control-sm">
                                        <option value="">Pilih Metode Praktikum</option>
                                        <option value="Mentoring">Mentoring</option>
                                        <option value="Class Lab">Class Lab</option>
                                    </select>
                                </div>
                                <div class="form row">
                                    <div class="form-group col-sm-6">
                                        <label for="pretest_pct">Persentase Tes Awal</label>
                                        <input type="text" class="form-control form-control-sm" id="pretest_pct"
                                               name="pretest_pct"
                                               required>
                                    </div>
                                    <div class="form-group col-sm-6">
                                        <label for="pretest_duration">Durasi Tes Awal</label>
                                        <input type="text" class="form-control form-control-sm" id="pretest_duration"
                                               name="pretest_duration"
                                               required>
                                    </div>
                                </div>
                                <div class="form row">
                                    <div class="form-group col-sm-6">
                                        <label for="journal_pct">Persentase Jurnal</label>
                                        <input type="text" class="form-control form-control-sm" id="journal_pct"
                                               name="journal_pct"
                                               required>
                                    </div>
                                    <div class="form-group col-sm-6">
                                        <label for="journal_duration">Durasi Jurnal</label>
                                        <input type="text" class="form-control form-control-sm" id="journal_duration"
                                               name="journal_duration"
                                               required>
                                    </div>
                                </div>
                                <div class="form row">
                                    <div class="form-group col-sm-6">
                                        <label for="posttest_pct">Persentase Tes Akhir</label>
                                        <input type="text" class="form-control form-control-sm" id="posttest_pct"
                                               name="posttest_pct"
                                               required>
                                    </div>
                                    <div class="form-group col-sm-6">
                                        <label for="posttest_duration">Durasi Tes Akhir</label>
                                        <input type="text" class="form-control form-control-sm" id="posttest_duration"
                                               name="posttest_duration"
                                               required>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div id="accordion">
                    <div class="card">
                        <div class="card-header" id="practicum-modul">
                            <button class="btn" data-toggle="collapse" data-target="#collapseModul"
                                    aria-expanded="true" aria-controls="collapseModul">
                                Data Modul
                            </button>
                        </div>
                        <div id="collapseModul" class="collapse show" aria-labelledby="practicum-modul"
                             data-parent="#accordion">
                            <div class="card-body">
                                <div class="module">
                                    <div class="form-group">
                                        <label for="module1">Modul 1</label>
                                        <input type="text" class="form-control form-control-sm" id="module1"
                                               name="module[]"
                                               required>
                                    </div>
                                    <div class="form-group">
                                        <label for="module2">Modul 2</label>
                                        <input type="text" class="form-control form-control-sm" id="module2"
                                               name="module[]"
                                               required>
                                    </div>
                                    <div class="form-group">
                                        <label for="module3">Modul 3</label>
                                        <input type="text" class="form-control form-control-sm" id="module3"
                                               name="module[]"
                                               required>
                                    </div>
                                    <div class="form-group">
                                        <label for="module4">Modul 4</label>
                                        <input type="text" class="form-control form-control-sm" id="module4"
                                               name="module[]"
                                               required>
                                    </div>
                                    <div class="form-group">
                                        <label for="module5">Modul 5</label>
                                        <input type="text" class="form-control form-control-sm" id="module5"
                                               name="module[]"
                                               required>
                                    </div>
                                </div>
                                <div class="form-group text-center mt-4">
                                    <button class="btn btn-outline btn-sm" type="button" id="addModule">Tambah Modul</button>
                                    <button class="btn btn-outline-danger btn-sm" type="button" id="removeModule">Hapus Modul</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="form-group mt-4">
            <div class="col-sm-12 text-center">
                <button type="submit" name="submit" class="btn btn-fill btn-sm">Save</button>
                <button type="button" class="btn btn-outline-secondary btn-sm"
                        onclick="window.location = 'practicum'">Cancel
                </button>
            </div>
        </div>
    </form>
</div>
<hr>

<script>
    $(function () {
        $('#sidebar ul li#practicum-add a').parent().parent().toggle('show');
        $('#sidebar ul li#practicum-add a').addClass('active');
    });

    $(function () {
        $('#addModule').click(function () {
            var i = $('input[name="module[]"]').length;
            var newRow = '';

            newRow = newRow.concat('<div class="form-group">');
            newRow = newRow.concat('<label for="module' + (i + 1) + '">Modul ' + (i + 1) + '</label>');
            newRow = newRow.concat('<input type="text" class="form-control form-control-sm" id="module' + (i + 1) + '" name="module[]">');
            newRow = newRow.concat('</div>');

            $('.module').append(newRow);
        });

        $('#removeModule').click(function () {
            var i = $('input[name="module[]"]').length;

            $('#module' + i).parent().remove();
        })
    })
</script>

<?php include "views/layout/footer.php" ?>
