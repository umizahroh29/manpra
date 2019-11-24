<?php
$data = $_SESSION['schedule_data'];
$role = $_SESSION['user_role'];
?>

<?php include "views/layout/sidebar.php" ?>

<div class="pt-3 pl-3 pr-3 pb-0">
    <h5>Data Jadwal Praktikum</h5>
</div>
<hr>

<div class="container">
    <?php if ($role == 'Admin') { ?>
        <div class="col-sm-12 text-right" style="margin: 20px 0px 20px">
            <a href="schedule-add" class="btn btn-fill btn-sm">+Tambah Jadwal Praktikum</a>
        </div>
    <?php } ?>
    <div class="col-sm-12">
        <div class="row justify-content-sm-center">
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th scope="col" style="vertical-align: middle; text-align: center">No</th>
                    <th scope="col" style="vertical-align: middle; text-align: center">Nama Praktikum</th>
                    <th scope="col" style="vertical-align: middle; text-align: center">Hari</th>
                    <th scope="col" style="vertical-align: middle; text-align: center">Jam</th>
                    <th scope="col" style="vertical-align: middle; text-align: center">Durasi</th>
                    <th scope="col" style="vertical-align: middle; text-align: center">Ruangan</th>
                    <?php if ($role == 'Admin') { ?>
                        <th scope="col" style="vertical-align: middle; text-align: center" colspan="2">Action</th>
                    <?php } ?>
                </tr>
                </thead>
                <tbody>
                <?php if ($data != null) { ?>
                    <?php foreach ($data as $row) { ?>
                        <tr>
                            <td class="text-center"><?= $row['no'] ?></td>
                            <td class="text-center"><?= $row['practicum_name'] ?></td>
                            <td class="text-center"><?= $row['day'] ?></td>
                            <td class="text-center"><?= $row['time'] ?></td>
                            <td class="text-center"><?= $row['duration'] ?> Menit</td>
                            <td class="text-center"><?= $row['room'] ?></td>
                            <?php if ($role == 'Admin') { ?>
                                <td class="text-center">
                                    <form action="schedule-edit" method="post" style="margin: 0">
                                        <input type="hidden" name="schedule_id" value="<?= $row['id'] ?>">
                                        <input type="hidden" name="status" value="Confirmed">
                                        <button class="btn btn-outline btn-sm" type="submit">Ubah</button>
                                    </form>
                                </td>
                                <td class="text-center">
                                    <form action="schedule-delete" method="post" style="margin: 0">
                                        <input type="hidden" name="schedule_id" value="<?= $row['id'] ?>">
                                        <input type="hidden" name="status" value="Rejected">
                                        <button class="btn btn-outline-danger btn-sm" type="submit">Hapus</button>
                                    </form>
                                </td>
                            <?php } ?>
                        </tr>
                    <?php } ?>
                <?php } else { ?>
                    <tr>
                        <td colspan="8" class="text-center">No Data</td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    $(function () {
        $('#sidebar ul li#schedule a').parent().parent().toggle('show');
        $('#sidebar ul li#schedule a').addClass('active');
    });
</script>

<?php include "views/layout/footer.php" ?>
