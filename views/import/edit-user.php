<?php
$user_data = $_SESSION['user_data'];
?>

<?php include "views/layout/sidebar.php" ?>

    <div class="pt-3 pl-3 pr-3 pb-0">
        <h5>Ubah Data User Praktikum</h5>
    </div>
    <hr>
    <div class="container">
        <form action="user-update" method="POST">
            <input type="hidden" name="id" id="id" value="<?= $user_data['id'] ?>">
            <div class="row justify-content-md-center">
                <div class="col-sm-6">
                    <div id="accordion">
                        <div class="card">
                            <div class="card-header" id="practicum">
                                <button class="btn" data-toggle="collapse" data-target="#collapsePracticum"
                                        aria-expanded="true" aria-controls="collapsePracticum">
                                    Data User
                                </button>
                            </div>
                            <div id="collapsePracticum" class="collapse show" aria-labelledby="practicum"
                                 data-parent="#accordion">
                                <div class="card-body pb-0">
                                    <div class="form-group">
                                        <label for="nim">NIM</label>
                                        <input class="form-control form-control-sm" type="text" name="nim" id="nim" value="<?= $user_data['nim'] ?>" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="name">Nama</label>
                                        <input class="form-control form-control-sm" type="text" name="name" id="name" value="<?= $user_data['name'] ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="class">Kelas</label>
                                        <input class="form-control form-control-sm" type="text" name="class" id="class" value="<?= $user_data['class'] ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="practicum">Praktikum</label>
                                        <input class="form-control form-control-sm" type="text" name="practicum" id="practicum" value="<?= $user_data['practicum_name'] ?>" readonly>
                                    </div>
                                    <?php if ($user_data['role'] == 'Assistant') { ?>
                                        <div class="form-group">
                                            <label for="code">Kode Asisten</label>
                                            <input class="form-control form-control-sm" type="text" name="code" id="code" value="<?= $user_data['code'] ?>" readonly>
                                        </div>
                                    <?php } ?>
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
            $('#sidebar ul li#import-list a').parent().parent().toggle('show');
            $('#sidebar ul li#import-list a').addClass('active');
        });
    </script>

<?php include "views/layout/footer.php" ?>