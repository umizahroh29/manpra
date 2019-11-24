<?php
$practicum_data = $_SESSION['practicum_data'];
$schedule_data = $_SESSION['schedule_data'];
?>

<?php include "views/layout/sidebar.php" ?>

    <div class="pt-3 pl-3 pr-3 pb-0">
        <h5>Ubah Jadwal Praktikum</h5>
    </div>
    <hr>
    <div class="container">
        <form action="schedule-update" method="POST">
            <input type="hidden" name="id" id="id" value="">
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
                            onclick="window.location = 'practicum'">Cancel
                    </button>
                </div>
            </div>
        </form>
    </div>

    <script>
        $(function () {
            var data = '<?php echo json_encode($schedule_data) ?>';
            data = JSON.parse(data);

            $('#id').val(data.id);
            $('#practicum_id').val(data.practicum_id);
            $('#day').val(data.day);
            $('#time').val(data.time);
            $('#duration').val(data.duration);
            $('#room').val(data.room);

            $('#practicum_id option:not(:selected)').attr('disabled', true);

            $('#sidebar ul li#schedule-add a').parent().parent().toggle('show');
            $('#sidebar ul li#schedule-add a').addClass('active');
        });
    </script>

<?php include "views/layout/footer.php" ?>