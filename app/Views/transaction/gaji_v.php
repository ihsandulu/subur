<?php echo $this->include("template/header_v"); ?>
<link rel="stylesheet" href="<?= base_url("css/flatpickr.min.css"); ?>">
<script src="<?= base_url("js/flatpickr"); ?>"></script>

<style>
    .tdata {
        background-color: black;
        color: white !important;
        padding: 5px 5px 0 5px;
        margin-bottom: 5px;
        border-radius: 5px;
    }

    .float-left {
        float: left;
    }

    .w50 {
        width: 50px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .w70 {
        width: 70px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .w100 {
        width: 100px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .w150 {
        width: 150px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .w200 {
        width: 200px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .w220 {
        width: 220px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }


    input,
    select {
        border: none;
    }

    .bg-second {
        background-color: rgba(73, 72, 72, 0.17);
    }

    .bg-yellow {
        background-color: rgba(234, 234, 182, 0.73);
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
                    </div>

                    <?php if ($message != "") { ?>
                        <div class="alert alert-info alert-dismissable">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            <strong><?= $message; ?></strong>
                        </div>
                    <?php } ?>

                    <div class="accordion" id="faqAccordion">
                        <form method="post" action="<?= base_url("gaji"); ?>">
                            <?php
                            if (isset($_POST["departemen_id"])) {
                                $idepartemen = $_POST["departemen_id"];
                            } else {
                                $idepartemen = "";
                            }
                            if (isset($_POST["position_id"])) {
                                $iposition = $_POST["position_id"];
                            } else {
                                $iposition = "";
                            }
                            if (isset($_POST["user_nama"])) {
                                $iuser_nama = $_POST["user_nama"];
                            } else {
                                $iuser_nama = "";
                            }
                            if (isset($_POST["user_nik"])) {
                                $iuser_nik = $_POST["user_nik"];
                            } else {
                                $iuser_nik = "";
                            }
                            if (isset($_POST["dari"])) {
                                $idari = $_POST["dari"];
                            } else {
                                $idari = date("Y-m-d");
                            }
                            if (isset($_POST["ke"])) {
                                $ike = $_POST["ke"];
                            } else {
                                $ike = date("Y-m-d");
                            }
                            ?>
                            <input data-bs-toggle="tooltip" title="dari" type="date" class=" " id="dari" name="dari" value="<?= $idari; ?>">
                            <input data-bs-toggle="tooltip" title="ke" type="date" class=" " id="ke" name="ke" value="<?= $ike; ?>">
                            <select class=" " id="departemen_id" name="departemen_id">
                                <option value="" <?= ($idepartemen == "") ? "selected" : ""; ?>>Pilih Dept.</option>
                                <option value="all" <?= ($idepartemen == "all") ? "selected" : ""; ?>>All</option>
                                <?php $departemen = $this->db->table("departemen")->orderBy("departemen_name")->get();
                                foreach ($departemen->getResult() as $departemen) { ?>
                                    <option value="<?= $departemen->departemen_id; ?>" <?= ($idepartemen == $departemen->departemen_id) ? "selected" : ""; ?>><?= $departemen->departemen_name; ?></option>
                                <?php } ?>
                            </select>
                            <select class=" " id="position_id" name="position_id">
                                <option value="" <?= ($iposition == "") ? "selected" : ""; ?>>Pilih Posisi</option>
                                <option value="all" <?= ($iposition == "all") ? "selected" : ""; ?>>All</option>
                                <?php $position = $this->db->table("position")->orderBy("position_name")->get();
                                foreach ($position->getResult() as $position) { ?>
                                    <option value="<?= $position->position_id; ?>" <?= ($iposition == $position->position_id) ? "selected" : ""; ?>><?= $position->position_name; ?></option>
                                <?php } ?>
                            </select>
                            <input type="text" class=" " style="width:150px;" id="user_nama" name="user_nama" value="<?= $iuser_nama; ?>" placeholder="Nama">
                            <input type="text" class="" style="width:100px;" id="user_nik" name="user_nik" value="<?= $iuser_nik; ?>" placeholder="NIK">
                            <button type="submit" name="submit" value="search" class="btn btn-xs btn-primary">Search</button>
                            <button type="submit" name="submit" value="generate" class="btn btn-xs btn-warning">Generate</button>
                            <button type="button" onclick="printgaji()" class="btn btn-xs btn-success"><i class="fa fa-print"></i></button>
                        </form>
                        <div class="pesan alert alert-info alert-dismissable" style="display:none; position:fixed; left:50%; top:50%; transform:translate(-50%,-50%);">
                            <strong id="pesan"></strong>
                        </div>
                        <table id="e23" class="display nowrap mt-2" cellspacing="0" border="1" width="100%">
                            <thead class="">
                                <tr>
                                    <th>Action</th>
                                    <th>Departemen</th>
                                    <th>Posisi</th>
                                    <th>NIK</th>
                                    <th>Name</th>
                                    <th>Hari Masuk</th>
                                    <th>Gaji Kotor</th>
                                    <th>Lembur</th>
                                    <th>Kasbon</th>
                                    <th>Gaji Bersih</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $table1 = "user";
                                $dari = date("Y-m-d");
                                $ke = date("Y-m-d");
                                if (isset($_POST["submit"])) {
                                    $dari = $_POST["dari"];
                                    $ke = $_POST["ke"];
                                    $table = "user";
                                    $build = $this->db->table($table);
                                    $build->select("*,user.user_id as user_id,user.user_nik as user_nik");
                                    $build->join(
                                        "(SELECT user_id, 
                                                SUM(absen_setengah) AS jmlsetengah, 
                                                SUM(absen_hadir) AS jmlhari, 
                                                SUM(absen_lembur) AS jmllembur, 
                                                absen_date 
                                        FROM absen 
                                        GROUP BY user_id) absen",
                                        "absen.user_id = user.user_id AND absen.absen_date >= '" . $dari . "' AND absen.absen_date <= '" . $ke . "'",
                                        "left"
                                    );

                                    // Subquery untuk kas
                                    $build->join(
                                        "(SELECT user_id, 
                                                SUM(kas_total) AS kasbon, 
                                                kas_date 
                                        FROM kas 
                                        GROUP BY user_id) kas",
                                        "kas.user_id = user.user_id AND kas.kas_date >= '" . $dari . "' AND absen.absen_date <= '" . $ke . "'",
                                        "left"
                                    )
                                        ->join("position", "position.position_id=$table1.position_id", "left")
                                        ->join("departemen", "departemen.departemen_id=$table1.departemen_id", "left");
                                } else {
                                    $table = "user";
                                    $build = $this->db->table($table);
                                    $build->select("*,user.user_id");
                                    $build->join("absen", "absen.user_id=$table.user_id AND absen.absen_date ='" . date("Y-m-d") . "'", "left")
                                        ->join("position", "position.position_id=$table1.position_id", "left")
                                        ->join("departemen", "departemen.departemen_id=$table1.departemen_id", "left");
                                }

                                $build->where("$table1.user_id !=", "10");
                                if (empty($_POST)) {
                                    $build->where("$table1.position_id", "0");
                                } else {
                                    if (isset($_POST["departemen_id"]) && $_POST["departemen_id"] != "" && $_POST["departemen_id"] != "all") {
                                        $departemen_id = $_POST["departemen_id"];
                                        $build->where("$table1.departemen_id", $departemen_id);
                                    }
                                    if (isset($_POST["position_id"]) && $_POST["position_id"] != "" && $_POST["position_id"] != "all") {
                                        $position_id = $_POST["position_id"];
                                        $build->where("$table1.position_id", $position_id);
                                    }
                                    if (isset($_POST["user_nama"]) && $_POST["user_nama"] != "" && $_POST["user_nama"] != "all") {
                                        $user_nama = $_POST["user_nama"];
                                        $build->like("$table1.user_nama", $user_nama, "both");
                                    }
                                    if (isset($_POST["user_nik"]) && $_POST["user_nik"] != "" && $_POST["user_nik"] != "all") {
                                        $user_nik = $_POST["user_nik"];
                                        $build->like("$table1.user_nik", $user_nik, "both");
                                    }
                                    if ((isset($_POST["departemen_id"]) && $_POST["departemen_id"] == "") && (isset($_POST["position_id"]) && $_POST["position_id"] == "") && (isset($_POST["user_nama"]) && $_POST["user_nama"] == "") && (isset($_POST["user_nik"]) && $_POST["user_nik"] == "")) {
                                        $build->where("$table1.position_id", "0");
                                    }
                                }

                                $usr = $build->orderBy("departemen.departemen_name", "ASC")
                                    ->orderBy("position.position_name", "ASC")
                                    ->orderBy("user.user_nama", "ASC")
                                    ->get();
                                // echo $this->db->getLastquery();
                                $no = 1;
                                $aktif = ["Tidak Aktif", "Aktif"];
                                $absen = ["Tidak", "Perjam", "Insentif"];
                                foreach ($usr->getResult() as $usr) {
                                    $harigaji = $usr->jmlhari * $usr->user_gajiharian;
                                    $setengahgaji = $usr->jmlsetengah/2 * $usr->user_gajiharian;
                                    $lemburgaji = $usr->jmllembur * $usr->user_lemburharian;
                                ?>
                                    <tr>
                                        <td class="w100  text-center pl-1"><a target="_blank" href="<?= base_url("gajiprint?user_id=" . $usr->user_id."&dari=".$_POST["dari"]."&ke=".$_POST["ke"]."&user_id=".$usr->user_id); ?>" class="fa fa-print"></a></td>
                                        <td class="w100 bg-second text-left pl-1"><?= $usr->departemen_name; ?></td>
                                        <td class="w100 bg-second text-left pl-1"><?= $usr->position_name; ?></td>
                                        <td class="w100 bg-second text-center"><?= $usr->user_nik; ?></td>
                                        <td class="w150 text-left pl-1 bg-second"><?= $usr->user_nama; ?></td>
                                        <td class="w50">
                                            <?= $usr->jmlhari + ($usr->jmlsetengah/2); ?>
                                        </td>
                                        <td class="w50">
                                            <?= number_format($harigaji + $setengahgaji, 0, ",", "."); ?>
                                        </td>
                                        <td class="w50">
                                            <?= number_format($lemburgaji, 0, ",", "."); ?>
                                        </td>
                                        <td class="w50">
                                            <?= number_format($usr->kasbon, 0, ",", "."); ?>
                                        </td>
                                        <td class="w50">
                                            <?= number_format($harigaji + $setengahgaji + $lemburgaji - $usr->kasbon, 0, ",", "."); ?>
                                        </td>
                                    </tr>
                                    <script>
                                        $(document).ready(function() {

                                        });
                                    </script>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<div id="test"></div>
<script>
    function pesannya(isi) {
        $("#pesan").html(isi);
        $(".pesan").fadeIn();
        setTimeout(function() {
            $(".pesan").fadeOut();
        }, 2000);
    }

    function hadir(id, notif, absen_date) {
        let absen_hadir = $("#absen_hadir" + id).is(":checked") ? 1 : 0;
        let absen_lembur = $("#absen_lembur" + id).is(":checked") ? 1 : 0;
        $("#test").html("<?= base_url("api/inputabsenhadir"); ?>?absen_date=" + absen_date + "&absen_hadir=" + absen_hadir + "&absen_lembur=" + absen_lembur + "&user_id=" + id);
        $.get("<?= base_url("api/inputabsenhadir"); ?>", {
                absen_hadir: absen_hadir,
                absen_lembur: absen_lembur,
                absen_date: absen_date,
                user_id: id
            })
            .done(function(data) {
                if (notif == 1) {
                    pesannya(data);
                }
            });
    }


    $('.select').select2();
    var title = "<?= $title; ?>";
    $("title").text(title);
    $(".card-title").text(title);
    $("#page-title").text(title);
    $("#page-title-link").text(title);
</script>
<script>
    $(document).ready(function() {
        flatpickr(".jam", {
            enableTime: true,
            noCalendar: true,
            dateFormat: "H:i",
            time_24hr: true
        });

        $('#e23').DataTable({
            dom: 'Blfrtip',
            autoWidth: false,
            lengthMenu: [
                [50, 100, -1],
                [50, 100, "All"]
            ],
            buttons: [{
                    extend: 'print',
                    exportOptions: {
                        columns: ':not(:first-child)'
                    },
                    customize: function(win) {
                        // Tambahkan CSS langsung ke dokumen cetak
                        var css = `
                            .screen-only { display: none !important; }
                            .print-only { display: inline !important; }
                        `;
                        $(win.document.head).append('<style>' + css + '</style>');
                        $(win.document.body)
                            .find('td.text-left')
                            .css('text-align', 'left');
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
            ordering: false // Mencegah DataTables mengatur order by
        });
    });

    function printgaji() {
        let dari = $("#dari").val();
        let ke = $("#ke").val();
        let departemen_id = $("#departemen_id").val();
        let position_id = $("#position_id").val();
        let user_nama = $("#user_nama").val();
        let user_nik = $("#user_nik").val();

        // Encode komponen URL agar aman
        let params = new URLSearchParams({
            dari: dari,
            ke: ke,
            departemen_id: departemen_id,
            position_id: position_id,
            user_nama: user_nama,
            user_nik: user_nik
        });

        // Buka di tab baru
        window.open("<?= base_url('gajiprint'); ?>?" + params.toString(), "_blank");
    }
</script>

<?php echo  $this->include("template/footer_v"); ?>