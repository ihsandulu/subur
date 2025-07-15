<?php echo $this->include("template/header_v"); ?>
<style>
    th,
    td {
        padding: 5px !important;
    }
</style>
<div class='container-fluid'>
    <div class='row'>
        <div class='col-12'>
            <div class="card">
                <div class="card-body">


                    <div class="row">
                        <?php if (!isset($_GET['user_id']) && !isset($_POST['new']) && !isset($_POST['edit'])) {
                            $coltitle = "col-md-10";
                        } else {
                            $coltitle = "col-md-8";
                        } ?>
                        <div class="<?= $coltitle; ?>">
                            <h4 class="card-title"></h4>
                            <!-- <h6 class="card-subtitle">Export data to Copy, CSV, Excel, PDF & Print</h6> -->
                        </div>
                        <?php if (!isset($_POST['new']) && !isset($_POST['edit']) && !isset($_GET['report'])) { ?>
                            <?php if (isset($_GET["user_id"])) { ?>
                                <form action="<?= base_url("user"); ?>" method="get" class="col-md-2">
                                    <h1 class="page-header col-md-12">
                                        <button class="btn btn-warning btn-block btn-lg" value="OK" style="">Back</button>
                                    </h1>
                                </form>
                            <?php } ?>
                            <form method="post" class="col-md-2">
                                <h1 class="page-header col-md-12">
                                    <button name="new" class="btn btn-info btn-block btn-lg" value="OK" style="">New</button>
                                    <input type="hidden" name="user_id" />
                                </h1>
                            </form>
                        <?php } ?>
                    </div>

                    <?php if (isset($_POST['new']) || isset($_POST['edit'])) { ?>
                        <div class="">
                            <?php if (isset($_POST['edit'])) {
                                $user_namabutton = 'name="change"';
                                $judul = "Update Karyawan";
                                $ketuser_password = "Kosongkan jika tidak ingin merubah user_password!";
                            } else {
                                $user_namabutton = 'name="create"';
                                $judul = "Tambah Karyawan";
                                $ketuser_password = "Jangan dikosongkan!";
                            } ?>
                            <div class="lead">
                                <h3><?= $judul; ?></h3>
                            </div>
                            <form class="form-horizontal" method="post" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label class="control-label col-sm-2" for="user_status">Status:</label>
                                    <div class="col-sm-10">
                                        <select class="form-control" id="user_status" name="user_status">
                                            <option value="1" <?= ($user_status == 1) ? "selected" : ""; ?>>Aktif</option>
                                            <option value="0" <?= ($user_status == 0) ? "selected" : ""; ?>>Tidak Aktif</option>
                                        </select>

                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-2" for="position_id">Departemen:</label>
                                    <div class="col-sm-10">
                                        <?php
                                        $departemen = $this->db->table("departemen")->orderBy("departemen_name", "ASC")
                                            ->get();
                                        //echo $this->db->getLastQuery();
                                        ?>
                                        <select autofocus required class="form-control select" id="departemen_id" name="departemen_id">
                                            <option value="" <?= ($departemen_id == "") ? "selected" : ""; ?>>Pilih Departemen</option>
                                            <?php
                                            foreach ($departemen->getResult() as $departemen) { ?>
                                                <option value="<?= $departemen->departemen_id; ?>" <?= ($departemen_id == $departemen->departemen_id) ? "selected" : ""; ?>><?= $departemen->departemen_name; ?></option>
                                            <?php } ?>
                                        </select>

                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-2" for="position_id">Jabatan:</label>
                                    <div class="col-sm-10">
                                        <?php
                                        $base = $this->db->table("position");
                                        if (session()->get("position_id") != "1") {
                                            $base->where("position_id!=", "1");
                                        }
                                        $position = $base->orderBy("position_name", "ASC")
                                            ->get();
                                        //echo $this->db->getLastQuery();
                                        ?>
                                        <select required class="form-control select" id="position_id" name="position_id">
                                            <option value="" <?= ($position_id == "") ? "selected" : ""; ?>>Pilih Jabatan</option>
                                            <?php
                                            foreach ($position->getResult() as $position) { ?>
                                                <option value="<?= $position->position_id; ?>" <?= ($position_id == $position->position_id) ? "selected" : ""; ?>><?= $position->position_name; ?></option>
                                            <?php } ?>
                                        </select>

                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-sm-2" for="user_nama">Nama Lengkap:</label>
                                    <div class="col-sm-10">
                                        <input required type="text" class="form-control" id="user_nama" name="user_nama" placeholder="" value="<?= $user_nama; ?>">

                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-sm-2" for="user_nik">NIK:</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="user_nik" name="user_nik" placeholder="" value="<?= $user_nik; ?>">

                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-sm-2" for="user_password">Password:</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="user_password" name="user_password" placeholder="<?= $ketuser_password; ?>" value="<?= $user_password; ?>">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-sm-2" for="user_masuk">Tgl Masuk:</label>
                                    <div class="col-sm-10">
                                        <input type="date" class="form-control" id="user_masuk" name="user_masuk" placeholder="" value="<?= $user_masuk; ?>">

                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-sm-2" for="user_keluar">Tgl Keluar:</label>
                                    <div class="col-sm-10">
                                        <input type="date" class="form-control" id="user_keluar" name="user_keluar" placeholder="" value="<?= $user_keluar; ?>">

                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-sm-2" for="user_email">Email:</label>
                                    <div class="col-sm-10">
                                        <input type="email" class="form-control" id="user_email" name="user_email" placeholder="" value="<?= $user_email; ?>">

                                    </div>
                                </div>



                                <div class="form-group">
                                    <label class="control-label col-sm-2" for="user_wa">Whatsapp/Phone:</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="user_wa" name="user_wa" placeholder="" value="<?= $user_wa; ?>">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-sm-2" for="user_npwp">NPWP:</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="user_npwp" name="user_npwp" placeholder="" value="<?= $user_npwp; ?>">

                                    </div>
                                </div>




                                <div class="form-group">
                                    <label class="control-label col-sm-2" for="user_address">Alamat:</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="user_address" name="user_address" placeholder="" value="<?= $user_address; ?>">

                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-sm-2" for="user_gajiharian">Gaji Harian:</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="user_gajiharian" name="user_gajiharian" placeholder="" value="<?= $user_gajiharian; ?>">

                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-2" for="user_lemburharian">Lembur Harian:</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="user_lemburharian" name="user_lemburharian" placeholder="" value="<?= $user_lemburharian; ?>">

                                    </div>
                                </div>



                                <div class="form-group">
                                    <label class="control-label col-sm-2" for="user_pendidikan">Pendidikan:</label>
                                    <div class="col-sm-10">
                                        <select class="form-control" id="user_pendidikan" name="user_pendidikan">
                                            <option value="SD" <?= ($user_pendidikan == "SD") ? "selected" : ""; ?>>SD</option>
                                            <option value="SMP" <?= ($user_pendidikan == "SMP") ? "selected" : ""; ?>>SMP</option>
                                            <option value="SMA" <?= ($user_pendidikan == "SMA") ? "selected" : ""; ?>>SMA</option>
                                            <option value="D1" <?= ($user_pendidikan == "D1") ? "selected" : ""; ?>>D1</option>
                                            <option value="D2" <?= ($user_pendidikan == "D2") ? "selected" : ""; ?>>D2</option>
                                            <option value="D3" <?= ($user_pendidikan == "D3") ? "selected" : ""; ?>>D3</option>
                                            <option value="S1" <?= ($user_pendidikan == "S1") ? "selected" : ""; ?>>S1</option>
                                            <option value="S2" <?= ($user_pendidikan == "S2") ? "selected" : ""; ?>>S2</option>
                                            <option value="S3" <?= ($user_pendidikan == "S3") ? "selected" : ""; ?>>S3</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-sm-2" for="user_borndate">Tgl Lahir:</label>
                                    <div class="col-sm-10">
                                        <input type="date" class="form-control" id="user_borndate" name="user_borndate" placeholder="" value="<?= $user_borndate; ?>">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-sm-2" for="user_borncity">Tempat Lahir:</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="user_borncity" name="user_borncity" placeholder="" value="<?= $user_borncity; ?>">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-sm-2" for="user_gender">L/P:</label>
                                    <div class="col-sm-10">
                                        <select class="form-control" id="user_gender" name="user_gender">
                                            <option value="" <?= ($user_gender == "") ? "selected" : ""; ?>>Pilih Gender</option>
                                            <option value="L" <?= ($user_gender == "L") ? "selected" : ""; ?>>L</option>
                                            <option value="P" <?= ($user_gender == "P") ? "selected" : ""; ?>>P</option>
                                        </select>
                                    </div>
                                </div>



                                <input type="hidden" name="user_id" value="<?= $user_id; ?>" />
                                <div class="form-group">
                                    <div class="col-sm-offset-2 col-sm-10">
                                        <button type="submit" id="submit" class="btn btn-primary col-md-5" <?= $user_namabutton; ?> value="OK">Submit</button>
                                        <a class="btn btn-warning col-md-offset-1 col-md-5" href="<?= base_url("muser"); ?>">Back</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    <?php } else { ?>
                        <?php if ($message != "") { ?>
                            <div class="alert alert-info alert-dismissable">
                                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                <strong><?= $message; ?></strong>
                            </div>
                        <?php } ?>

                        <div class="table-responsive m-t-40">
                            <table id="tabelk" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                                <thead class="">
                                    <tr>
                                        <?php if (!isset($_GET["report"])) { ?>
                                            <th>&nbsp;&nbsp;&nbsp;Action&nbsp;&nbsp;&nbsp;</th>
                                        <?php } ?>
                                        <th>No.</th>
                                        <th>Departemen</th>
                                        <th>Posisi</th>
                                        <th>NIK</th>
                                        <th>Nama</th>
                                        <th>Alamat</th>
                                        <th>Email</th>
                                        <th>Whatsapp</th>
                                        <th>NPWP</th>
                                        <th>Pendidikan</th>
                                        <th>&nbsp;&nbsp;&nbsp;Tgl&nbsp;Lahir&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                        <th>Tempat Lahir</th>
                                        <th>L/P</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $usr = $this->db
                                        ->table("user")
                                        ->join("position", "position.position_id=user.position_id", "left")
                                        ->join("departemen", "departemen.departemen_id=user.departemen_id", "left")
                                        ->where("position.position_id !=", "1")
                                        ->orderBy("departemen_name", "asc")
                                        ->orderBy("position_name", "asc")
                                        ->orderBy("user_nama", "asc")
                                        ->orderBy("user_nik", "asc")
                                        ->get();
                                    //echo $this->db->getLastquery();
                                    $no = 1;
                                    $aktif = ["Tidak Aktif", "Aktif"];
                                    $lembur = ["Tidak", "Perjam", "Insentif"];
                                    foreach ($usr->getResult() as $usr) { ?>
                                        <tr>
                                            <?php if (!isset($_GET["report"])) { ?>
                                                <td style="padding-left:0px; padding-right:0px;">
                                                    <!-- <?php
                                                            if (
                                                                (
                                                                    isset(session()->get("position_id")[0][0])
                                                                    && (
                                                                        session()->get("position_id") == "1"
                                                                        || session()->get("position_id") == "2"
                                                                    )
                                                                ) ||
                                                                (
                                                                    isset(session()->get("halaman")['5']['act_read'])
                                                                    && session()->get("halaman")['5']['act_read'] == "1"
                                                                )
                                                            ) { ?>
                                                    <form method="get" class="btn-action" style="" action="<?= base_url("muserposition"); ?>">
                                                        <button class="btn btn-sm btn-primary "><span class="fa fa-users" style="color:white;"></span> </button>
                                                        <input type="hidden" name="user_id" value="<?= $usr->user_id; ?>" />
                                                    </form>
                                                    <?php } ?> -->

                                                    <?php
                                                    if (
                                                        (
                                                            isset(session()->get("position_id")[0][0])
                                                            && (
                                                                session()->get("position_id") == "1"
                                                                || session()->get("position_id") == "2"
                                                            )
                                                        ) ||
                                                        (
                                                            isset(session()->get("halaman")['5']['act_update'])
                                                            && session()->get("halaman")['5']['act_update'] == "1"
                                                        )
                                                    ) { ?>
                                                        <form method="post" class="btn-action" style="">
                                                            <button class="btn btn-sm btn-warning " name="edit" value="OK"><span class="fa fa-edit" style="color:white;"></span> </button>
                                                            <input type="hidden" name="user_id" value="<?= $usr->user_id; ?>" />
                                                        </form>
                                                    <?php } ?>

                                                    <?php
                                                    if (
                                                        (
                                                            isset(session()->get("position_id")[0][0])
                                                            && (
                                                                session()->get("position_id") == "1"
                                                                || session()->get("position_id") == "2"
                                                            )
                                                        ) ||
                                                        (
                                                            isset(session()->get("halaman")['5']['act_delete'])
                                                            && session()->get("halaman")['5']['act_delete'] == "1"
                                                        )
                                                    ) { ?>
                                                        <form method="post" class="btn-action" style="">
                                                            <button class="btn btn-sm btn-danger delete" onclick="return confirm(' you want to delete?');" name="delete" value="OK"><span class="fa fa-close" style="color:white;"></span> </button>
                                                            <input type="hidden" name="user_id" value="<?= $usr->user_id; ?>" />
                                                        </form>
                                                    <?php } ?>
                                                </td>
                                            <?php } ?>
                                            <td><?= $no++; ?></td>
                                            <td><?= $usr->departemen_name; ?></td>
                                            <td><?= $usr->position_name; ?></td>
                                            <td><?= $usr->user_nik; ?></td>
                                            <td class="text-left"><?= $usr->user_nama; ?></td>
                                            <td><?= $usr->user_address; ?></td>
                                            <td><?= $usr->user_email; ?></td>
                                            <td><?= $usr->user_wa; ?></td>
                                            <td><?= $usr->user_npwp; ?></td>
                                            <td><?= $usr->user_pendidikan; ?></td>
                                            <td><?= $usr->user_borndate; ?></td>
                                            <td><?= $usr->user_borncity; ?></td>
                                            <td><?= $usr->user_gender; ?></td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $('.select').select2();
    var title = "Master Karyawan";
    $("title").text(title);
    $(".card-title").text(title);
    $("#page-title").text(title);
    $("#page-title-link").text(title);
    $(document).ready(function() {
        $('#tabelk').DataTable({
            dom: 'Blfrtip', // <- tambahkan 'l' di sini
            buttons: [{
                    extend: 'print',
                    exportOptions: {
                        columns: ':not(:first-child)'
                    }
                },
                {
                    extend: 'pdf',
                    exportOptions: {
                        columns: ':not(:first-child)'
                    }
                },
                {
                    extend: 'excel',
                    exportOptions: {
                        columns: ':not(:first-child)'
                    }
                }
            ],
            ordering: false,
            lengthMenu: [
                [10, 25, 50, -1],
                [10, 25, 50, "Semua"]
            ],
            pageLength: 10
        });
    });
</script>

<?php echo  $this->include("template/footer_v"); ?>