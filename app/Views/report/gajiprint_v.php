<?php
echo $this->include("template/headersaja_v");
function terbilang($angka)
{
    $angka = abs($angka);
    $huruf = ["", "Satu", "Dua", "Tiga", "Empat", "Lima", "Enam", "Tujuh", "Delapan", "Sembilan", "Sepuluh", "Sebelas"];

    if ($angka < 12) {
        return $huruf[$angka];
    } elseif ($angka < 20) {
        return $huruf[$angka - 10] . " Belas";
    } elseif ($angka < 100) {
        return $huruf[floor($angka / 10)] . " Puluh " . terbilang($angka % 10);
    } elseif ($angka < 200) {
        return "Seratus " . terbilang($angka - 100);
    } elseif ($angka < 1000) {
        return $huruf[floor($angka / 100)] . " Ratus " . terbilang($angka % 100);
    } elseif ($angka < 2000) {
        return "Seribu " . terbilang($angka - 1000);
    } elseif ($angka < 1000000) {
        return terbilang(floor($angka / 1000)) . " Ribu " . terbilang($angka % 1000);
    } elseif ($angka < 1000000000) {
        return terbilang(floor($angka / 1000000)) . " Juta " . terbilang($angka % 1000000);
    } else {
        return "Angka Terlalu Besar";
    }
}


?>
<style>
    .resumeg {
        background-color: aqua !important;
        color: white !important;
    }

    .resumer {
        background-color: indianred !important;
        color: white !important;
    }

    .resumey {
        background-color: beige !important;
        color: white !important;
    }

    .resumebl {
        background-color: aquamarine !important;
        color: white !important;
    }

    .resumeb {
        background-color: darkgrey !important;
        color: white !important;
    }

    td {
        line-height: 20px !important;
        padding: 10px !important;
    }

    .garis {
        height: 0px;
        border-bottom: rgba(57, 56, 56, 0.16) solid 1px;
        margin: 0px 20px 0px -10px !important;
    }


    .scroll-table {
        overflow: hidden;
        cursor: grab;
    }

    .scroll-table:active {
        cursor: grabbing;
    }

    .table-wrapper {
        overflow: auto;
        white-space: nowrap;
    }

    table {
        min-width: 500px;
    }

    .row1 {
        display: -ms-flexbox;
        display: flex;
        -ms-flex-wrap: wrap;
        flex-wrap: wrap;
        margin-right: 0px;
        margin-left: 0px;
    }

    @media (min-width: 768px) {
        .col10 {
            -ms-flex: 0 0 83.333333%;
            flex: 0 0 83.333333%;
            max-width: 83.333333%;
        }

        .col2 {
            -ms-flex: 0 0 16.666667%;
            flex: 0 0 16.666667%;
            max-width: 16.666667%;
        }
    }

    @media (max-width: 767px) {
        .header {
            position: relative;
            width: 100%;
        }
    }

    @media print {
        .col10 {
            display: inline-block;
            width: 83.333333%;
        }

        .col2 {
            display: inline-block;
            width: 16.666667%;
        }

        .row1 {
            display: flex;
            flex-wrap: wrap;
        }

        body,
        td,
        span,
        div {
            font-size: 16px !important;
        }
    }

    #logotop {
        width: auto;
        height: 100px;
    }

    #perusahaan {
        font-size: 28px;
        font-weight: bold;
    }

    #tagline {
        font-size: 20px;
        font-weight: bold;
        color: grey;
    }

    .uang {
        display: flex;
        justify-content: space-between;
        align-items: center;
        width: 100%;
        text-align: left;
    }

    .border-bottom {
        border-bottom: black solid 1px;
        padding-bottom: 30px;
    }

    .judul {
        font-size: 25px;
        font-weight: bold;
        margin-bottom: 15px;
    }

    .atas {
        height: 3.5cm;
    }

    .tengah {
        padding: 10px 50px 20px 50px;
    }

    table,
    thead,
    tbody,
    tr {
        border-color: black !important;
    }

    .table td,
    .table th {
        border-top: 1px solid rgb(0, 0, 0);
    }

    .kotak {
        width: 100px;
        height: 100px;
        background-color: lightblue;
        border: 1px solid #000;
    }

    .wraptext {
        white-space: normal;
        word-wrap: break-word;
    }

    .bt {
        border-top: rgba(0, 0, 0, 0.3) solid 1px;
        margin-top: 5px;
        padding-top: 5px;
    }
</style>

<div class='container-fluid'>
    <div class='row'>
        <!-- <div class='col-12 border-bottom atas'>
            <div class="row">
                <div class='col-4 text-right'>
                    <?php
                    // $identitypicture=session()->get("identity_logo");
                    $identity_name = session()->get("identity_name");
                    $identity = $this->db->table("identity")->get()->getRow();
                    $identitypicture = $identity->identity_logo;
                    $identity_company = $identity->identity_company;
                    if ($identitypicture != "") {
                        $user_image = "images/identity_logo/" . $identitypicture . "?" . time();
                    } else {
                        $user_image = "images/identity_logo/no_image.png";
                    } ?>
                    <img id="logotop" src="<?= base_url($user_image); ?>" alt="homepage" class="dark-logo" />
                </div>
                <div class='col-8 text-left'>
                    <div id="perusahaan"><?= ($identity_company != "") ? $identity_company : "PT. Nevan Kirana Logistik"; ?></div>
                    <div id="tagline">PROJECT CARGO - INLAND TRUCK - CARGO MOOVING - CONTAINERIZED</div>
                </div>
            </div>
        </div> -->
        <div class='col-12 tengah'>
            <div class="row">

                <?php
                $table1 = "user";
                $dari = date("Y-m-d");
                $ke = date("Y-m-d");

                if (isset($_GET["dari"])) {
                    $dari = $_GET["dari"];
                }
                if (isset($_GET["ke"])) {
                    $ke = $_GET["ke"];
                }
                $table = "user";
                $build = $this->db->table($table);
                $build->select("*,user.user_id");
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


                $build->where("$table1.user_id !=", "10");
                if (empty($_GET)) {
                    $build->where("$table1.position_id", "0");
                } else {
                    if (isset($_GET["departemen_id"]) && $_GET["departemen_id"] != "" && $_GET["departemen_id"] != "all") {
                        $departemen_id = $_GET["departemen_id"];
                        $build->where("$table1.departemen_id", $departemen_id);
                    }
                    if (isset($_GET["position_id"]) && $_GET["position_id"] != "" && $_GET["position_id"] != "all") {
                        $position_id = $_GET["position_id"];
                        $build->where("$table1.position_id", $position_id);
                    }
                    if (isset($_GET["user_nama"]) && $_GET["user_nama"] != "" && $_GET["user_nama"] != "all") {
                        $user_nama = $_GET["user_nama"];
                        $build->like("$table1.user_nama", $user_nama, "both");
                    }
                    if (isset($_GET["user_nik"]) && $_GET["user_nik"] != "" && $_GET["user_nik"] != "all") {
                        $user_nik = $_GET["user_nik"];
                        $build->like("$table1.user_nik", $user_nik, "both");
                    }
                    if (isset($_GET["user_id"]) && $_GET["user_id"] != "" && $_GET["user_id"] != "all") {
                        $user_id = $_GET["user_id"];
                        $build->where("$table1.user_id", $user_id, "both");
                    }
                    if ((isset($_GET["departemen_id"]) && $_GET["departemen_id"] == "") && (isset($_GET["position_id"]) && $_GET["position_id"] == "") && (isset($_GET["user_nama"]) && $_GET["user_nama"] == "") && (isset($_GET["user_nik"]) && $_GET["user_nik"] == "")) {
                        $build->where("$table1.position_id", "0");
                    }
                }

                $usr = $build->orderBy("departemen.departemen_name", "ASC")
                    ->orderBy("position.position_name", "ASC")
                    ->orderBy("user.user_nama", "ASC")
                    ->get();
                // echo $this->db->getLastquery();die;
                $no = 1;
                $aktif = ["Tidak Aktif", "Aktif"];
                $absen = ["Tidak", "Perjam", "Insentif"];
                foreach ($usr->getResult() as $usr) {
                    $harigaji = $usr->jmlhari * $usr->user_gajiharian;
                    $setengahgaji = $usr->jmlsetengah / 2 * $usr->user_gajiharian;
                    $lemburgaji = $usr->jmllembur * $usr->user_lemburharian;
                ?>
                    <div class="col-4 p-1">
                        <div class="border p-1">
                            <div id="areaCetak" class="row">
                                <div class="col-12 judul text-center">SLIP GAJI</div>
                                <div class="col-12  text-center">
                                    Periode : <?= date("d/m/Y", strtotime($_GET["dari"])); ?> - <?= date("d/m/Y", strtotime($_GET["ke"])); ?>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="row">
                                    <div class="col-4">Departemen</div>
                                    <div class="col-8">: <?= $usr->departemen_name; ?></div>
                                    <div class="col-4">Posisi</div>
                                    <div class="col-8">: <?= $usr->position_name; ?></div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="row">
                                    <div class="col-4">NIK</div>
                                    <div class="col-8">: <?= $usr->user_nik; ?></div>
                                    <div class="col-4">Name</div>
                                    <div class="col-8">: <?= $usr->user_nama; ?></div>
                                </div>
                            </div>
                            <div class="col-12 bt">
                                <div class="row">
                                    <div class="col-6">Full Masuk</div>
                                    <div class="col-6">: <?= $usr->jmlhari; ?> hari</div>
                                    <div class="col-6">Setengah Hari</div>
                                    <div class="col-6">: <?= $usr->jmlsetengah; ?> hari</div>
                                    <div class="col-6">Gaji Kotor</div>
                                    <div class="col-6">: <?= number_format($harigaji + $setengahgaji, 0, ",", "."); ?></div>
                                    <div class="col-6">Lembur</div>
                                    <div class="col-6">: <?= number_format($lemburgaji, 0, ",", "."); ?></div>
                                    <div class="col-6">Kasbon</div>
                                    <div class="col-6">: <?= number_format($usr->kasbon, 0, ",", "."); ?></div>
                                    <div class="col-6">Gaji Bersih</div>
                                    <div class="col-6">: <?= number_format($harigaji + $setengahgaji + $lemburgaji - $usr->kasbon, 0, ",", "."); ?></div>
                                </div>
                            </div>

                            <script>
                                $(document).ready(function() {

                                });
                            </script>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>
</div>
<!-- <div class=" col-12 bg-primary p-3 text-center" style="border-radius:5px; border-top:grey solid 1px;"><div style="font-size:25px; font-weight:bold;"><?= $identity->identity_company; ?></div><?= $identity->identity_address; ?></div> -->


<?php echo $this->include("template/footersaja_v"); ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>

<script type="text/javascript">
    function cetakPDF() {
        $('#titlepdf').show();
        $('#btncetakpdf').hide();
        $('.dataTables_filter').hide();
        const element = document.getElementById('areaCetak');
        html2pdf()
            .set({
                margin: 0.5,
                filename: 'export.pdf',
                image: {
                    type: 'jpeg',
                    quality: 0.98
                },
                html2canvas: {
                    scale: 2
                },
                jsPDF: {
                    unit: 'in',
                    format: 'a4',
                    orientation: 'portrait'
                }
            })
            .from(element)
            .save()
            .then(() => {
                // Tampilkan kembali search
                $('#titlepdf').hide();
                $('.dataTables_filter').show();
                $('#btncetakpdf').show();
            });
    }

    $(document).ready(function() {
        $('#titlepdf').hide();
        $('#example2310').DataTable({
            paging: false, // tidak ada pagination
            info: false, // tidak ada info "Showing 1 to 10 of ..."
            lengthChange: false, // tidak ada dropdown jumlah baris
            searching: true
        });
    });
    print();
</script>