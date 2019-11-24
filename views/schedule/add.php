<?php
$practicum_data = $_SESSION['practicum_data'];
?>

<?php include "views/layout/sidebar.php" ?>

    <div class="pt-3 pl-3 pr-3 pb-0">
        <h5>Tambah Jadwal Praktikum</h5>
    </div>
    <hr>
    <div class="container">
        <form action="schedule-save" method="POST">
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
                                        <label for="practicum_id">Nama Praktikum</label>
                                        <select class="form-control form-control-sm" name="practicum_id"
                                                id="practicum_id">
                                            <option value="">Pilih Praktikum</option>
                                            <?php foreach ($practicum_data as $datum) { ?>
                                                <option value="<?= $datum['id'] ?>"><?= $datum['name'] ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="form row">
                                        <div class="form-group col-sm-6">
                                            <label for="day">Hari</label>
                                            <select class="form-control form-control-sm" name="day" id="day">
                                                <option value="">Pilih Hari</option>
                                                <option value="Senin">Senin</option>
                                                <option value="Selasa">Selasa</option>
                                                <option value="Rabu">Rabu</option>
                                                <option value="Kamis">Kamis</option>
                                                <option value="Jumat">Jumat</option>
                                                <option value="Sabtu">Sabtu</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-sm-6">
                                            <label for="time">Jam Mulai</label>
                                            <select class="form-control form-control-sm" name="time" id="time">
                                                <option value="">Pilih Jam</option>
                                                <option value="06.30">06.30</option>
                                                <option value="08.30">08.30</option>
                                                <option value="10.30">10.30</option>
                                                <option value="12.30">12.30</option>
                                                <option value="14.30">14.30</option>
                                                <option value="16.30">16.30</option>
                                                <option value="18.30">18.30</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form row">
                                        <div class="form-group col-sm-6">
                                            <label for="duration">Durasi (Menit)</label>
                                            <input type="number" class="form-control form-control-sm"
                                                   name="duration" id="duration">
                                        </div>
                                        <div class="form-group col-sm-6">
                                            <label for="room">Ruangan</label>
                                            <select class="form-control form-control-sm" name="room" id="room">
                                                <option value="">Pilih Ruangan</option>
                                                <option value="L1">L1</option>
                                                <option value="L2">L2</option>
                                                <option value="L5">L5</option>
                                                <option value="C1">C1</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group mt-2">
                                        <div class="col-sm-12 text-center">
                                            <button type="button" name="button" id="btnAdd" class="btn btn-fill btn-sm">
                                                Tambah Jadwal
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
                    <table class="table table-bordered" id="scheduleTable">
                        <thead>
                        <tr>
                            <th scope="col" style="vertical-align: middle; text-align: center">No</th>
                            <th scope="col" style="vertical-align: middle; text-align: center">Nama Praktikum</th>
                            <th scope="col" style="vertical-align: middle; text-align: center">Hari</th>
                            <th scope="col" style="vertical-align: middle; text-align: center">Jam</th>
                            <th scope="col" style="vertical-align: middle; text-align: center">Durasi</th>
                            <th scope="col" style="vertical-align: middle; text-align: center">Ruangan</th>
                            <th scope="col" style="vertical-align: middle; text-align: center" colspan="2">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="form-group mt-4">
                <div class="col-sm-12 text-center">
                    <button type="button" class="btn btn-fill btn-sm" onclick="check();">Save</button>
                    <button type="button" class="btn btn-outline-secondary btn-sm"
                            onclick="history.back()">Cancel
                    </button>
                </div>
            </div>
        </form>
    </div>

    <script>
        $(function () {
            $('#sidebar ul li#schedule-add a').parent().parent().toggle('show');
            $('#sidebar ul li#schedule-add a').addClass('active');
        });

        $(function () {
            $('#btnAdd').click(function () {
                if ($('#practicum_id').val() == '') {
                    Swal.fire('Invalid Value', 'Praktikum Harus Diisi!', 'warning');
                    return false;
                }

                if ($('#day').val() == '') {
                    Swal.fire('Invalid Value', 'Hari Harus Diisi!', 'warning');
                    $('#day').focus();
                    return false;
                }

                if ($('#time').val() == '') {
                    Swal.fire('Invalid Value', 'Jam Mulai Harus Diisi!', 'warning');
                    $('#time').focus();
                    return false;
                }

                if ($('#duration').val() == '') {
                    Swal.fire('Invalid Value', 'Durasi Harus Diisi!', 'warning');
                    $('#duration').focus();
                    return false;
                }

                if ($('#room').val() == '') {
                    Swal.fire('Invalid Value', 'Ruangan Harus Diisi!', 'warning');
                    $('#room').focus();
                    return false;
                }

                var practicum_id = $('#practicum_id option:selected').val();
                var practicum_name = $('#practicum_id option:selected').html();
                var day = $('#day option:selected').val();
                var time = $('#time option:selected').val();
                var duration = $('#duration').val();
                var room = $('#room option:selected').val();

                var i = $('#scheduleTable tbody tr').length;
                var newRow = '';
                newRow = newRow.concat('<tr>');
                newRow = newRow.concat('<td class="text-center">' + (i + 1) + '</td>');
                newRow = newRow.concat('<td class="text-center"><input type="hidden" name="practicum[]" value="' + practicum_id + '">' + practicum_name + '</td>');
                newRow = newRow.concat('<td class="text-center"><input type="hidden" name="day[]" value="' + day + '">' + day + '</td>');
                newRow = newRow.concat('<td class="text-center"><input type="hidden" name="time[]" value="' + time + '">' + time + '</td>');
                newRow = newRow.concat('<td class="text-center"><input type="hidden" name="duration[]" value="' + duration + '">' + duration + '</td>');
                newRow = newRow.concat('<td class="text-center"><input type="hidden" name="room[]" value="' + room + '">' + room + '</td>');
                newRow = newRow.concat('<td class="text-center"><button class="btn btn-danger delete" type="button"><i class="fa fa-times"></button></td>');
                newRow = newRow.concat('</tr>');

                $('#scheduleTable tbody').append(newRow);
            });

            $('#scheduleTable').on('click', '.delete', function () {
                $(this).closest('tr').remove();
            });
        });

        function check() {
            var countSchedule = $('#scheduleTable tbody tr').length;

            if (countSchedule < 1) {
                Swal.fire('Invalid Valur', 'Silakan Tambah Jadwal Terlebih Dahulu!', 'warning');
                return false;
            }

            $('form').submit();
        }
    </script>

<?php include "views/layout/footer.php" ?>