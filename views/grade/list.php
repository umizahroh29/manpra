<?php
$student_data = $_SESSION['student_data'];
$module_data = $_SESSION['module_data'];
$grade_data = $_SESSION['grade_data'];
$role = $_SESSION['user_role'];
?>

<?php include "views/layout/sidebar.php" ?>

    <div class="pt-3 pl-3 pr-3 pb-0">
        <h5>Input Nilai</h5>
    </div>
    <hr>

    <div class="container">
        <form action="grade-save" method="POST">
            <div class="row justify-content-md-center">
                <div class="col-sm-6">
                    <div id="accordion">
                        <div class="card">
                            <div class="card-header" id="practicum">
                                <button class="btn" data-toggle="collapse" data-target="#collapsePracticum"
                                        aria-expanded="true" aria-controls="collapsePracticum">
                                    Data Jadwal
                                </button>
                            </div>
                            <div id="collapsePracticum" class="collapse show" aria-labelledby="practicum"
                                 data-parent="#accordion">
                                <div class="card-body pb-0">
                                    <div class="form-group">
                                        <label for="student">Praktikan</label>
                                        <select class="form-control form-control-sm selectpicker" name="student"
                                                id="student" data-live-search="true">
                                            <option value=""></option>
                                            <?php foreach ($student_data as $datum) { ?>
                                                <option value="<?= $datum['nim'] ?>"
                                                        data-tokens="<?= $datum['nim'] . ' ' . $datum['name'] ?>"
                                                        data-name="<?php $datum['name'] ?>"><?= $datum['nim'] . ' - ' . $datum['name'] ?></option>
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
                                    <div class="form row">
                                        <div class="form-group col-sm-4">
                                            <label for="pretest">Tes Awal</label>
                                            <input type="number" class="form-control form-control-sm"
                                                   name="pretest" id="pretest">
                                        </div>
                                        <div class="form-group col-sm-4">
                                            <label for="journal">Jurnal</label>
                                            <input type="number" class="form-control form-control-sm"
                                                   name="journal" id="journal">
                                        </div>
                                        <div class="form-group col-sm-4">
                                            <label for="posttest">Tes Akhir</label>
                                            <input type="number" class="form-control form-control-sm"
                                                   name="posttest" id="posttest">
                                        </div>
                                    </div>
                                    <div class="form-group mt-4">
                                        <div class="col-sm-12 text-center">
                                            <button type="button" class="btn btn-fill btn-sm" id="addGrade">Save
                                            </button>
                                            <button type="button" class="btn btn-outline-secondary btn-sm"
                                                    onclick="history.back()">Cancel
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row justify-content-md-center mt-4">
                <div class="col-sm-12">
                    <table class="table table-bordered" id="gradeTable">
                        <thead>
                        <tr>
                            <th scope="col" style="vertical-align: middle; text-align: center">No</th>
                            <th scope="col" style="vertical-align: middle; text-align: center">NIM Praktikan</th>
                            <th scope="col" style="vertical-align: middle; text-align: center">Nama Praktikan</th>
                            <th scope="col" style="vertical-align: middle; text-align: center">Modul</th>
                            <th scope="col" style="vertical-align: middle; text-align: center">Tes Awal</th>
                            <th scope="col" style="vertical-align: middle; text-align: center">Jurnal</th>
                            <th scope="col" style="vertical-align: middle; text-align: center">Tes Akhir</th>
                            <th scope="col" style="vertical-align: middle; text-align: center" colspan="2">Action</th>
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
                                    <td class="text-center">
                                        <button class="btn btn-outline btn-sm btnEdit" type="button">Ubah</button>
                                    </td>
<!--                                    <td class="text-center">-->
<!--                                        <button class="btn btn-outline-danger btn-sm btnDelete" type="button">Hapus-->
<!--                                        </button>-->
<!--                                    </td>-->
                                </tr>
                            <?php }
                        } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </form>
    </div>

    <script>
        $(function () {
            $('.selectpicker').selectpicker();

            $('#addGrade').click(function () {
                var nim = $('#student').val();
                var module = $('#module').val();
                var pretest = $('#pretest').val();
                var journal = $('#journal').val();
                var posttest = $('#posttest').val();

                $.ajax({
                    type: 'POST',
                    url: 'grade-save',
                    data: {nim: nim, pretest: pretest, journal: journal, posttest: posttest, module: module},
                    dataType: 'json',
                    success: function (response) {
                        var status, msg, type;
                        if (!response.status) {
                            status = 'Failed';
                            msg = 'Gagal Input Nilai';
                            type = 'error';
                        } else {
                            status = 'Success';
                            msg = 'Berhasil Input Nilai';
                            type = 'success';
                        }

                        Swal.fire(status, msg, type);

                        $('#gradeTable tbody tr').remove();

                        var data = response.data;
                        var newRow = '';
                        $(data).each(function (i) {
                            newRow = newRow.concat('<tr>');
                            newRow = newRow.concat('<td class="text-center">' + (i + 1) + '</td>');
                            newRow = newRow.concat('<td class="text-center nim">' + data[i].nim + '</td>');
                            newRow = newRow.concat('<td class="text-center name">' + data[i].name + '</td>');
                            newRow = newRow.concat('<td class="text-center module"><input type="hidden" class="modul_id" value="' + data[i].modul_id + '">' + data[i].modul_name + '</td>');
                            newRow = newRow.concat('<td class="text-center pretest">' + data[i].pretest_score + '</td>');
                            newRow = newRow.concat('<td class="text-center journal">' + data[i].journal_score + '</td>');
                            newRow = newRow.concat('<td class="text-center posttest">' + data[i].posttest_score + '</td>');
                            newRow = newRow.concat('<td class="text-center"><button class="btn btn-outline btn-sm btnEdit" type="button">Ubah</button></td>');
                            // newRow = newRow.concat('<td class="text-center"><button class="btn btn-outline-danger btn-sm btnDelete" type="button">Hapus</button></td>');
                            newRow = newRow.concat('</tr>');
                        });

                        $('#gradeTable tbody').append(newRow);
                    }
                });
            });

            $('.btnEdit').click(function () {
                var nim = $(this).parent().parent().find('.nim').html();
                var module = $(this).parent().parent().find('.modul_id').val();
                var pretest = $(this).parent().parent().find('.pretest').html();
                var journal = $(this).parent().parent().find('.journal').html();
                var posttest = $(this).parent().parent().find('.posttest').html();

                $('#student').val(nim).trigger('change');
                $('#module').val(module);
                $('#pretest').val(pretest);
                $('#journal').val(journal);
                $('#posttest').val(posttest);
            });

            $('.btnDelete').click(function () {

            });

            $('#sidebar ul li#grade a').parent().parent().toggle('show');
            $('#sidebar ul li#grade a').addClass('active');
        });
    </script>

<?php include "views/layout/footer.php" ?>