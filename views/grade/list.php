<?php
$grade_data = $_SESSION['grade_data'];
$practicum_data = $_SESSION['practicum_data'];
?>

<?php include "views/layout/sidebar.php" ?>

    <div class="pt-3 pl-3 pr-3 pb-0">
        <h5>Data Nilai Praktikan</h5>
    </div>
    <hr>

    <div class="container">
        <div class="col-sm-12 text-right" style="margin: 20px 0px 20px">
            <a href="" data-toggle="modal" data-target="#export-modal" class="btn btn-fill btn-sm">Eksport Nilai</a>
        </div>
        <div class="col-sm-12">
            <div class="row justify-content-sm-center">
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th scope="col" style="vertical-align: middle; text-align: center">No</th>
                        <th scope="col" style="vertical-align: middle; text-align: center">NIM Praktikan</th>
                        <th scope="col" style="vertical-align: middle; text-align: center">Nama Praktikan</th>
                        <th scope="col" style="vertical-align: middle; text-align: center">Modul</th>
                        <th scope="col" style="vertical-align: middle; text-align: center">Tes Awal</th>
                        <th scope="col" style="vertical-align: middle; text-align: center">Jurnal</th>
                        <th scope="col" style="vertical-align: middle; text-align: center">Tes Akhir</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php if ($grade_data != null) {
                        foreach ($grade_data as $datum) { ?>
                            <tr>
                                <td class="text-center"><?= $datum['no'] ?></td>
                                <td class="text-center nim"><?= $datum['nim'] ?></td>
                                <td class="text-center name"><?= $datum['name'] ?></td>
                                <td class="text-center module"><input type="hidden" class="modul_id"
                                                                      value="<?= $datum['modul_id'] ?>"><?= $datum['modul_name'] ?>
                                </td>
                                <td class="text-center pretest"><?= $datum['pretest_score'] ?></td>
                                <td class="text-center journal"><?= $datum['journal_score'] ?></td>
                                <td class="text-center posttest"><?= $datum['posttest_score'] ?></td>
                            </tr>
                        <?php }
                    } ?>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="modal fade" id="export-modal" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Eksport Nilai</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="grade-export" method="POST" target="_blank">
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="student">Praktikan</label>
                                <select class="form-control form-control-sm" name="practicum_id"
                                        id="practicum_id" required>
                                    <option value=""></option>
                                    <?php foreach ($practicum_data as $datum) { ?>
                                        <option value="<?= $datum['id'] ?>"><?= $datum['name'] ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="module">Modul</label>
                                <select class="form-control form-control-sm" name="module"
                                        id="module">
                                    <option value=""></option>
                                    <?php foreach ($module_data as $datum) { ?>
                                        <option value="<?= $datum['id'] ?>"><?= $datum['name'] ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-fill btn-sm" id="btnExport">Eksport</button>
                            <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(function () {
            $('#practicum_id').change(function () {
                var id = $(this).val();

                $.ajax({
                    type: 'POST',
                    url: 'get-module',
                    data: {id: id},
                    dataType: 'json',
                    success: function (response) {
                        $('#module option').remove();
                        $('#module').append('<option></option>');

                        $(response).each(function (i) {
                            $('#module').append('<option value="' + response[i].id + '">' + response[i].name + '</option>');
                        });
                    }
                });
            });

            // $('#btnExport').click(function () {
            //     var id = $('#practicum_id').val();
            //     var module = $('#module').val();
            //
            //     $.ajax({
            //         type: 'POST',
            //         url: 'grade-export',
            //         data: {id: id, module: module},
            //         dataType: 'json',
            //         // success: function (response) {
            //         //
            //         // }
            //     });
            // });

            $('#sidebar ul li#grade a').parent().parent().toggle('show');
            $('#sidebar ul li#grade a').addClass('active');
        });
    </script>

<?php include "views/layout/footer.php" ?>