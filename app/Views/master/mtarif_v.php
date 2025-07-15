<?php echo $this->include("template/header_v"); ?>

<div class='container-fluid'>
    <div class='row'>
        <div class='col-12'>
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <?php if (!isset($_GET['user_id']) && !isset($_POST['new']) && !isset($_POST['edit'])) {
                            $coltitle = "col-md-8";
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
                            <?php 
                            if (
                                (
                                    isset(session()->get("position_administrator")[0][0]) 
                                    && (
                                        session()->get("position_administrator") == "1" 
                                        || session()->get("position_administrator") == "2"
                                    )
                                ) ||
                                (
                                    isset(session()->get("halaman")['105']['act_create']) 
                                    && session()->get("halaman")['105']['act_create'] == "1"
                                )
                            ) { ?>
                            <form method="post" target="_blank" class="col-md-2" action="<?= base_url("rtarif"); ?>">
                                <h1 class="page-header col-md-12">
                                    <button class="btn btn-warning btn-block btn-lg" value="OK" style="">Catalog</button>
                                    <input type="hidden" name="tarif_id" />
                                </h1>
                            </form>
                            <form method="post" class="col-md-2">
                                <h1 class="page-header col-md-12">
                                    <button name="new" class="btn btn-info btn-block btn-lg" value="OK" style="">New</button>
                                    <input type="hidden" name="tarif_id" />
                                </h1>
                            </form>
                            <?php } ?>
                        <?php } ?>
                    </div>

                    <?php if (isset($_POST['new']) || isset($_POST['edit'])) { ?>
                        <div class="">
                            <?php if (isset($_POST['edit'])) {
                                $namabutton = 'name="change"';
                                $judul = "Update Tarif";
                            } else {
                                $namabutton = 'name="create"';
                                $judul = "Tambah Tarif";
                            } ?>
                            <div class="lead">
                                <h3><?= $judul; ?></h3>
                            </div>
                            <form class="form-horizontal" method="post" enctype="multipart/form-data">                                                     
                                <div class="form-group">
                                    <label class="control-label col-sm-2" for="origin_id">Asal:</label>
                                    <div class="col-sm-10">
                                        <select required  autofocus class="form-control select" id="origin_id" name="origin_id">
                                            <option value="">Pilih Asal</option>
                                            <?php
                                            $origin = $this->db->table("origin")->orderBy("origin_name", "ASC")->get();
                                            foreach ($origin->getResult() as $row) {?>
                                                <option <?=($row->origin_id == $origin_id)?"selected":"";?> value="<?= $row->origin_id;?>"><?=$row->origin_name ;?></option>
                                            <?php }?>
                                        </select>
                                    </div>
                                </div>                                                       
                                <div class="form-group">
                                    <label class="control-label col-sm-2" for="destination_id">Tujuan:</label>
                                    <div class="col-sm-10">
                                    <select required  autofocus class="form-control select" id="destination_id" name="destination_id">
                                            <option value="">Pilih Tujuan</option>
                                            <?php
                                            $destination = $this->db->table("destination")->orderBy("destination_name", "ASC")->get();
                                            foreach ($destination->getResult() as $row) {?>
                                                <option <?=($row->destination_id == $destination_id)?"selected":"";?> value="<?= $row->destination_id;?>"><?=$row->destination_name ;?></option>
                                            <?php }?>
                                        </select>
                                    </div>
                                </div>                                                       
                                <div class="form-group">
                                    <label class="control-label col-sm-2" for="tarif_price">Tarif:</label>
                                    <div class="col-sm-10">
                                        <input required type="number"  class="form-control" id="tarif_price" name="tarif_price" placeholder="" value="<?= $tarif_price; ?>">
                                    </div>
                                </div>                                                       
                                <div class="form-group">
                                    <label class="control-label col-sm-2" for="satuantarif_id">Berat:</label>
                                    <div class="col-sm-10">
                                    <select required  autofocus class="form-control select" id="satuantarif_id" name="satuantarif_id">
                                            <option value="">Pilih Tujuan</option>
                                            <?php
                                            $satuantarif = $this->db->table("satuantarif")->orderBy("satuantarif_name", "ASC")->get();
                                            foreach ($satuantarif->getResult() as $row) {?>
                                                <option <?=($row->satuantarif_id == $satuantarif_id)?"selected":"";?> value="<?= $row->satuantarif_id;?>"><?=$row->satuantarif_name ;?></option>
                                            <?php }?>
                                        </select>
                                    </div>
                                </div>    

                                <input type="hidden" name="tarif_id" value="<?= $tarif_id; ?>" />
                                <div class="form-group">
                                    <div class="col-sm-offset-2 col-sm-10">
                                        <button type="submit" id="submit" class="btn btn-primary col-md-5" <?= $namabutton; ?> value="OK">Submit</button>
                                        <a class="btn btn-warning col-md-offset-1 col-md-5" href="<?= base_url("mtarif"); ?>">Back</a>
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
                            <table id="example23" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                                <!-- <table id="dataTable" class="table table-condensed table-hover w-auto dtable"> -->
                                <thead class="">
                                    <tr>
                                        <?php if (!isset($_GET["report"])) { ?>
                                            <th>Action</th>
                                        <?php } ?>
                                        <!-- <th>No.</th> -->
                                        <th>Asal</th>
                                        <th>Tujuan</th>
                                        <th>Satuan</th>
                                        <th>Harga</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $usr = $this->db
                                        ->table("tarif")
                                        ->join("satuantarif", "satuantarif.satuantarif_id = tarif.satuantarif_id")
                                        ->join("origin", "origin.origin_id = tarif.origin_id")
                                        ->join("destination", "destination.destination_id = tarif.destination_id")
                                        ->orderBy("tarif_id", "DESC")
                                        ->get();
                                    //echo $this->db->getLastquery();
                                    $no = 1;
                                    foreach ($usr->getResult() as $usr) { ?>
                                        <tr>
                                            <?php if (!isset($_GET["report"])) { ?>
                                                <td style="padding-left:0px; padding-right:0px;">
                                                    <?php 
                                                    if (
                                                        (
                                                            isset(session()->get("position_administrator")[0][0]) 
                                                            && (
                                                                session()->get("position_administrator") == "1" 
                                                                || session()->get("position_administrator") == "2"
                                                            )
                                                        ) ||
                                                        (
                                                            isset(session()->get("halaman")['105']['act_update']) 
                                                            && session()->get("halaman")['105']['act_update'] == "1"
                                                        )
                                                    ) { ?>
                                                    <form method="post" class="btn-action" style="">
                                                        <button class="btn btn-sm btn-warning " name="edit" value="OK"><span class="fa fa-edit" style="color:white;"></span> </button>
                                                        <input type="hidden" name="tarif_id" value="<?= $usr->tarif_id; ?>" />
                                                    </form>
                                                    <?php }?>
                                                    
                                                    <?php 
                                                    if (
                                                        (
                                                            isset(session()->get("position_administrator")[0][0]) 
                                                            && (
                                                                session()->get("position_administrator") == "1" 
                                                                || session()->get("position_administrator") == "2"
                                                            )
                                                        ) ||
                                                        (
                                                            isset(session()->get("halaman")['105']['act_delete']) 
                                                            && session()->get("halaman")['105']['act_delete'] == "1"
                                                        )
                                                    ) { ?>
                                                    <form method="post" class="btn-action" style="">
                                                        <button class="btn btn-sm btn-danger delete" onclick="return confirm(' you want to delete?');" name="delete" value="OK"><span class="fa fa-close" style="color:white;"></span> </button>
                                                        <input type="hidden" name="tarif_id" value="<?= $usr->tarif_id; ?>" />
                                                    </form>
                                                    <?php }?>
                                                </td>
                                            <?php } ?>
                                            <!-- <td><?= $no++; ?></td> -->
                                            <td class="text-left"><?= $usr->origin_name; ?></td>
                                            <td class="text-left"><?= $usr->destination_name; ?></td>
                                            <td class="text-left"><?= $usr->satuantarif_name; ?></td>
                                            <td class="text-left"><?= number_format($usr->tarif_price,0,",","."); ?></td>
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
    var title = "Master Tarif <?= $this->session->get("identity_name"); ?>";
    $("title").text(title);
    $(".card-title").text(title);
    $("#page-title").text(title);
    $("#page-title-link").text(title);
</script>

<?php echo  $this->include("template/footer_v"); ?>