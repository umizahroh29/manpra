<?php
$data = $_SESSION['unconfirmed_data'];
?>

<?php include "views/layout/sidebar.php" ?>

    <div class="pt-3 pl-3 pr-3 pb-0">
        <h5>Konfirmasi Akun Asisten</h5>
    </div>
    <hr>

    <div class="container">
        <div class="col-sm-12">
            <div class="row justify-content-sm-center">
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th scope="col" style="vertical-align: middle; text-align: center">No</th>
                        <th scope="col" style="vertical-align: middle; text-align: center">NIM</th>
                        <th scope="col" style="vertical-align: middle; text-align: center">Nama Asisten</th>
                        <th scope="col" style="vertical-align: middle; text-align: center">Kode Asisten</th>
                        <th scope="col" style="vertical-align: middle; text-align: center">Kelas</th>
                        <th scope="col" style="vertical-align: middle; text-align: center">Email</th>
                        <th scope="col" style="vertical-align: middle; text-align: center" colspan="2">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php if ($data != null) {
                        foreach ($data as $row) { ?>
                            <tr>
                            <td class="text-center"><?= $row['no'] ?></td>
                            <td class="text-center"><?= $row['nim'] ?></td>
                            <td class="text-center"><?= $row['name'] ?></td>
                            <td class="text-center"><?= $row['code'] ?></td>
                            <td class="text-center"><?= $row['class'] ?></td>
                            <td class="text-center"><?= $row['email'] ?></td>
                            <?php if ($row['status'] == 'Unconfirmed') { ?>
                                <td class="text-center">
                                    <form action="confirmation-process" method="post" style="margin: 0">
                                        <input type="hidden" name="user_id" value="<?= $row['id'] ?>">
                                        <input type="hidden" name="status" value="Confirmed">
                                        <button class="btn btn-outline btn-sm" type="submit">Approve</button>
                                    </form>
                                </td>
                                <td class="text-center">
                                    <form action="confirmation-process" method="post" style="margin: 0">
                                        <input type="hidden" name="user_id" value="<?= $row['id'] ?>">
                                        <input type="hidden" name="status" value="Rejected">
                                        <button class="btn btn-outline-danger btn-sm" type="submit">Decline</button>
                                    </form>
                                </td>
                            <?php } else { ?>
                                <td class="text-center" colspan="2"><?= $row['status'] ?></td>
                            <?php } ?>
                        <?php } ?>
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
        $(function () {
            $('#sidebar ul li#confirmation-account a').parent().parent().toggle('show');
            $('#sidebar ul li#confirmation-account a').addClass('active');
        });
    </script>

<?php include "views/layout/footer.php" ?>