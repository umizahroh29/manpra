<?php
$data = $_SESSION['practicum_data'];
?>

<?php include "views/layout/sidebar.php" ?>

<div class="pt-3 pl-3 pr-3 pb-0">
    <h5>Data Praktikum</h5>
</div>
<hr>

<div class="container">
    <div class="col-sm-12 text-right" style="margin: 20px 0px 20px">
        <a href="practicum-add" class="btn btn-fill btn-sm">+Tambah Praktikum</a>
    </div>
    <div class="col-sm-12">
        <div class="row justify-content-sm-center">
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th scope="col" style="vertical-align: middle; text-align: center">No</th>
                    <th scope="col" style="vertical-align: middle; text-align: center">Nama Praktikum</th>
                    <th scope="col" style="vertical-align: middle; text-align: center">Dosen Pengampu</th>
                    <th scope="col" style="vertical-align: middle; text-align: center">Tahun</th>
                    <th scope="col" style="vertical-align: middle; text-align: center">Jenis Praktikum</th>
                    <th scope="col" style="vertical-align: middle; text-align: center">Status</th>
                    <th scope="col" style="vertical-align: middle; text-align: center" colspan="2">Action</th>
                </tr>
                </thead>
                <tbody>
                <?php if ($data != null) {
                    foreach ($data as $row) { ?>
                        <tr>
                        <td class="text-center"><?= $row['no'] ?></td>
                        <td class="text-center"><?= $row['name'] ?></td>
                        <td class="text-center"><?= $row['lecturer_name'] ?></td>
                        <td class="text-center"><?= $row['year'] ?></td>
                        <td class="text-center"><?= $row['type'] ?></td>
                        <td class="text-center"><?= $row['status'] ?></td>
                        <?php if ($row['status'] == 'Aktif') { ?>
                            <td class="text-center">
                                <form action="confirmation-process" method="post" style="margin: 0">
                                    <input type="hidden" name="user_id" value="<?= $row['id'] ?>">
                                    <input type="hidden" name="status" value="Confirmed">
                                    <button class="btn btn-outline btn-sm" type="submit">Ubah</button>
                                </form>
                            </td>
                            <td class="text-center">
                                <form action="confirmation-process" method="post" style="margin: 0">
                                    <input type="hidden" name="user_id" value="<?= $row['id'] ?>">
                                    <input type="hidden" name="status" value="Rejected">
                                    <button class="btn btn-outline-danger btn-sm" type="submit">Non Aktif</button>
                                </form>
                            </td>
                        <?php } else { ?>
                            <td class="text-center" colspan="2"><?= $row['status'] ?></td>
                        <?php } ?>
                    <?php } ?>
                    </tr>
                <?php } else { ?>
                    <tr>
                        <td class="text-center" colspan="8">No Data</td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    $(function () {
        $('#sidebar ul li#practicum a').parent().parent().toggle('show');
        $('#sidebar ul li#practicum a').addClass('active');
    });
</script>

<?php include "views/layout/footer.php" ?>
