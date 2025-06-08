<?php echo $this->include("template/header_v"); ?>

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
                        </div>
                        <div class="col-2 ">
                            <a href="<?= base_url("apk/104.apk"); ?>" class="btn btn-success btn-xs btn-block float-right">
                                <i class="fa fa-download"></i> Download APK
                            </a>
                        </div>

                        <?php if (!isset($_POST['new']) && !isset($_POST['edit']) && !isset($_GET['report'])) { ?>
                            <?php if (isset($_GET["user_id"])) { ?>
                                <form action="<?= base_url("user"); ?>" method="get" class="col-md-2">
                                    <h1 class="page-header col-md-12">
                                        <button class="btn btn-warning btn-block btn-lg" value="OK" style="">Back</button>
                                    </h1>
                                </form>
                            <?php } ?>
                            <!-- <?php
                                    if (
                                        (
                                            isset(session()->get("position_administrator")[0][0])
                                            && (
                                                session()->get("position_administrator") == "1"
                                                || session()->get("position_administrator") == "2"
                                            )
                                        ) ||
                                        (
                                            isset(session()->get("halaman")['97']['act_create'])
                                            && session()->get("halaman")['97']['act_create'] == "1"
                                        )
                                    ) { ?>
                                <form method="post" class="col-md-2">
                                    <h1 class="page-header col-md-12">
                                        <button name="new" class="btn btn-info btn-block btn-lg" value="OK" style="">New</button>
                                        <input type="hidden" name="target_id" />
                                    </h1>
                                </form>
                            <?php } ?> -->
                        <?php } ?>
                    </div>

                    <?php if (isset($_POST['new']) || isset($_POST['edit'])) { ?>
                        <div class="">
                            <?php if (isset($_POST['edit'])) {
                                $namabutton = 'name="change"';
                                $judul = "Update Packing Target";
                            } else {
                                $namabutton = 'name="create"';
                                $judul = "Tambah Packing Target";
                            } ?>
                            <div class="lead">
                                <h3><?= $judul; ?></h3>
                            </div>
                            <form class="form-horizontal" method="post" enctype="multipart/form-data">

                                <div class="form-group ">
                                    <label class="control-label col-sm-2" for="target_date">Tanggal:</label>
                                    <div class="col-sm-10">
                                        <input type="date" class="form-control " id="target_date" name="target_date" placeholder="" value="<?= $target_date; ?>">
                                    </div>
                                </div>

                                <div class="form-group ">
                                    <label class="control-label col-sm-2" for="target_po">PO:</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control " id="target_po" name="target_po" placeholder="" value="<?= $target_po; ?>">
                                    </div>
                                </div>

                                <div class="form-group ">
                                    <label class="control-label col-sm-2" for="target_dpci">DPCI:</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control " id="target_dpci" name="target_dpci" placeholder="" value="<?= $target_dpci; ?>">
                                    </div>
                                </div>



                                <div class="form-group ">
                                    <label class="control-label col-sm-2" for="size_id">Size:</label>
                                    <div class="col-sm-10">
                                        <select class="form-control " id="size_id" name="size_id">
                                            <option value="">--Pilih Size--</option>
                                            <?php
                                            $size = $this->db->table("size")->get();
                                            foreach ($size->getResult() as $row) { ?>
                                                <option value="<?= $row->size_id; ?>" <?= ($row->size_id == $size_id) ? "selected" : ""; ?>><?= $row->size_name; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>


                                <div class="form-group ">
                                    <label class="control-label col-sm-2" for="target_ctns">CTNS:</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control " id="target_ctns" name="target_ctns" placeholder="" value="<?= $target_ctns; ?>">
                                    </div>
                                </div>



                                <input type="hidden" name="target_id" value="<?= $target_id; ?>" />
                                <div class="form-group">
                                    <div class="col-sm-offset-2 col-sm-10">
                                        <button type="submit" id="submit" class="btn btn-primary col-md-5" <?= $namabutton; ?> value="OK">Submit</button>
                                        <a class="btn btn-warning col-md-offset-1 col-md-5" href="<?= base_url("target"); ?>">Back</a>
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
                        <div class="alert alert-dark">
                            <form id="formku" class="form-horizontal row" method="post" enctype="multipart/form-data">
                                <div class="form-group col-2">
                                    <div class="col-sm-12">
                                        <input type="date" class="form-control " id="itarget_date" name="target_date" placeholder="Tanggal" value="">
                                    </div>
                                </div>

                                <div class="form-group col-2">
                                    <div class="col-sm-12">
                                        <input type="text" class="form-control " id="itarget_po" name="target_po" placeholder="PO" value="">
                                    </div>
                                </div>

                                <div class="form-group col-2">
                                    <div class="col-sm-12">
                                        <input type="text" class="form-control " id="itarget_dpci" name="target_dpci" placeholder="DPCI" value="">
                                    </div>
                                </div>

                                <div class="form-group col-2">
                                    <div class="col-sm-12">
                                        <input type="text" class="form-control " id="itarget_upc" name="target_upc" placeholder="UPC" value="">
                                    </div>
                                </div>



                                <div class="form-group col-2">
                                    <div class="col-sm-12">
                                        <select class="form-control " id="isize_id" name="size_id">
                                            <option value="">--Pilih Size--</option>
                                            <?php
                                            $size = $this->db->table("size")->get();
                                            foreach ($size->getResult() as $row) { ?>
                                                <option value="<?= $row->size_id; ?>"><?= $row->size_name; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>


                                <div class="form-group col-2">
                                    <div class="col-sm-12">
                                        <input type="text" class="form-control " id="itarget_ctns" name="target_ctns" placeholder="CTNS" value="">
                                    </div>
                                </div>



                                <div class="form-group  col-4 row">
                                    <div class="col-sm-6">
                                        <button onclick="clearForm()" type="button" id="submit" class="btn btn-success btn-block" name="create" value="OK">Clear</button>
                                    </div>
                                    <div class="col-sm-6">
                                        <button type="submit" id="submit" class="btn btn-primary  btn-block" name="create" value="OK">Submit</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="alert alert-white">
                            <div class="row">
                                <div class="col-4 row mb-2">
                                    <div class="col-3">
                                        <label class="text-dark">Cari :</label>
                                    </div>
                                    <?php
                                    if (isset($_GET["po"])) {
                                        $filtern = "po";
                                    } else if (isset($_GET["tgl"])) {
                                        $filtern = "tgl";
                                    } else {
                                        $filtern = "";
                                    }
                                    ?>
                                    <div class="col-9">
                                        <select id="filtern" onchange="pilihfilter()" class="form-control">
                                            <option value="tgl" <?= ($filtern == "tgl") ? "selected" : ""; ?>>Tgl Export</option>
                                            <option value="po" <?= ($filtern == "po") ? "selected" : ""; ?>>PO Number</option>
                                        </select>
                                    </div>
                                </div>
                                <form method="get" class="col-8 row mb-2" id="tgl">
                                    <?php
                                    $dari = date("Y-m-d");
                                    $ke = date("Y-m-d");
                                    if (isset($_GET["dari"])) {
                                        $dari = $_GET["dari"];
                                    }
                                    if (isset($_GET["ke"])) {
                                        $ke = $_GET["ke"];
                                    }
                                    ?>
                                    <div class="col-4 row mb-2">
                                        <div class="col-4">
                                            <label class="text-dark">Dari :</label>
                                        </div>
                                        <div class="col-8">
                                            <input type="date" class="form-control" placeholder="Dari" name="dari" value="<?= $dari; ?>">
                                        </div>
                                    </div>
                                    <div class="col-4 row mb-2">
                                        <div class="col-4">
                                            <label class="text-dark">Ke :</label>
                                        </div>
                                        <div class="col-8">
                                            <input type="date" class="form-control" placeholder="Ke" name="ke" value="<?= $ke; ?>">
                                        </div>
                                    </div>
                                    <div class="col-4 row mb-2">
                                        <div class="col-12">
                                            <button type="submit" class="btn btn-block btn-primary">Search</button>
                                        </div>
                                    </div>
                                </form>
                                <form method="get" class="col-8 row mb-2" id="po">
                                    <?php
                                    $ipo = "";
                                    if (isset($_GET["po"])) {
                                        $ipo = $_GET["po"];
                                    }
                                    ?>
                                    <div class="col-4 row mb-2">
                                        <div class="col-4">
                                            <label class="text-dark">PO :</label>
                                        </div>
                                        <div class="col-8">
                                            <input type="text" class="form-control" placeholder="Isi nomor PO" name="po" value="<?= $ipo; ?>">
                                        </div>
                                    </div>
                                    <div class="col-4 row mb-2">
                                        <div class="col-12">
                                            <button type="submit" class="btn btn-block btn-primary">Search</button>
                                        </div>
                                    </div>
                                </form>
                                <script>
                                    function pilihfilter() {
                                        var filter = $("#filtern").val();
                                        if (filter == "tgl") {
                                            $("#tgl").show();
                                            $("#po").hide();
                                        } else {
                                            $("#tgl").hide();
                                            $("#po").show();
                                        }
                                    }
                                    pilihfilter();
                                </script>
                            </div>
                        </div>
                        <div class="table-responsive m-t-1">
                            <table id="example23" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                                <!-- <table id="dataTable" class="table table-condensed table-hover w-auto dtable"> -->
                                <thead class="">
                                    <tr>
                                        <?php if (!isset($_GET["report"])) { ?>
                                            <th>Action</th>
                                        <?php } ?>
                                        <!-- <th>No.</th> -->
                                        <th>Tanggal</th>
                                        <th>PO</th>
                                        <th>DPCI</th>
                                        <th>UPC</th>
                                        <th>Size</th>
                                        <th>CTNS</th>
                                        <th>Scanned</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $build = $this->db
                                        ->table("target")
                                        ->join("size", "size.size_id=target.size_id", "left");
                                    if (isset($_GET["po"])) {
                                        $build->where("target_po", $_GET["po"]);
                                    }
                                    if (isset($_GET["dari"]) && isset($_GET["ke"])) {
                                        $build->where("target_date >=", $dari)
                                            ->where("target_date <=", $ke);
                                    }
                                    $usr = $build->orderBy("target_date DESC")
                                        ->get();
                                    //echo $this->db->getLastquery();
                                    $no = 1;
                                    foreach ($usr->getResult() as $usr) {
                                    ?>
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
                                                            isset(session()->get("halaman")['97']['act_update'])
                                                            && session()->get("halaman")['97']['act_update'] == "1"
                                                        )
                                                    ) { ?>
                                                        <form method="post" class="isin btn-action">
                                                            <button type="button" onclick="editkolom(<?= $usr->target_id; ?>)" class="btn btn-sm btn-warning " name="edit" value="OK"><span class="fa fa-edit" style="color:white;"></span> </button>
                                                            <input type="hidden" name="target_id" value="<?= $usr->target_id; ?>" />
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
                                                            isset(session()->get("halaman")['97']['act_delete'])
                                                            && session()->get("halaman")['97']['act_delete'] == "1"
                                                        )
                                                    ) { ?>
                                                        <form method="post" class="isin btn-action">
                                                            <button class="btn btn-sm btn-danger delete" onclick="return confirm(' you want to delete?');" name="delete" value="OK"><span class="fa fa-close" style="color:white;"></span> </button>
                                                            <input type="hidden" name="target_id" value="<?= $usr->target_id; ?>" />
                                                        </form>

                                                        <form method="post" class="isin btn-action">
                                                            <button type="button" class="btn btn-sm btn-warning" onclick="clone(<?= $usr->target_id; ?>)" name="create" value="OK"><span class="fa fa-clone" style="color:white;"></span> </button>
                                                        </form>
                                                    <?php } ?>
                                                </td>
                                            <?php } ?>
                                            <!-- <td><?= $no++; ?></td> -->

                                            <form class="form-horizontal row" method="post" enctype="multipart/form-data">
                                                <td class="">
                                                    <input type="date" class="form-control inputn inputn<?= $usr->target_id; ?> " id="target_date<?= $usr->target_id; ?>" name="target_date" placeholder="Tanggal" value="<?= $usr->target_date; ?>">
                                                    <span class="isin<?= $usr->target_id; ?>"><?= $usr->target_date; ?></span>
                                                </td>
                                                <td class="">
                                                    <input type="text" class="form-control inputn inputn<?= $usr->target_id; ?> " id="target_po<?= $usr->target_id; ?>" name="target_po" placeholder="PO" value="<?= $usr->target_po; ?>">
                                                    <span class="isin<?= $usr->target_id; ?>"><?= $usr->target_po; ?></span>
                                                </td>
                                                <td class="">
                                                    <input type="text" class="form-control inputn inputn<?= $usr->target_id; ?> " id="target_dpci<?= $usr->target_id; ?>" name="target_dpci" placeholder="DPCI" value="<?= $usr->target_dpci; ?>">
                                                    <span class="isin<?= $usr->target_id; ?>"><?= $usr->target_dpci; ?></span>
                                                </td>
                                                <td class="">
                                                    <input type="text" class="form-control inputn inputn<?= $usr->target_id; ?> " id="target_upc<?= $usr->target_id; ?>" name="target_upc" placeholder="UPC" value="<?= $usr->target_upc; ?>">
                                                    <span class="isin<?= $usr->target_id; ?>"><?= $usr->target_upc; ?></span>
                                                </td>
                                                <td class="">
                                                    <select class="form-control inputn inputn<?= $usr->target_id; ?> " id="size_id<?= $usr->target_id; ?>" name="size_id">
                                                        <option value="">--Pilih Size--</option>
                                                        <?php
                                                        $size = $this->db->table("size")->get();
                                                        foreach ($size->getResult() as $row) { ?>
                                                            <option value="<?= $row->size_id; ?>" <?= ($row->size_name == $usr->size_name) ? "selected" : ""; ?>><?= $row->size_name; ?></option>
                                                        <?php } ?>
                                                    </select>
                                                    <span class="isin<?= $usr->target_id; ?>"><?= $usr->size_name; ?></span>
                                                </td>
                                                <td class="">
                                                    <input type="text" class="form-control inputn inputn<?= $usr->target_id; ?>" id="target_ctns<?= $usr->target_id; ?>" name="target_ctns" placeholder="CTNS" value="<?= $usr->target_ctns; ?>">
                                                    <span class="isin<?= $usr->target_id; ?>"><?= $usr->target_ctns; ?></span>
                                                </td>
                                                <td class="">
                                                    <div class="inputn inputn<?= $usr->target_id; ?>">
                                                        <input type="text" class="form-control inputn inputn<?= $usr->target_id; ?>" id="target_scan<?= $usr->target_id; ?>" name="target_scan" placeholder="Scanned" value="<?= $usr->target_scan; ?>">
                                                        <input type="hidden" name="target_id" value="<?= $usr->target_id; ?>" />
                                                        <button type="submit" id="submit" class="btn btn-success btn-block" name="change" value="OK">Save</button>
                                                    </div>
                                                    <span class="isin<?= $usr->target_id; ?>"><?= $usr->target_scan; ?></span>
                                                </td>
                                            </form>
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
    var title = "Packing Target";
    $("title").text(title);
    $(".card-title").text(title);
    $("#page-title").text(title);
    $("#page-title-link").text(title);
    $(document).ready(function() {
        $(".inputn").hide();
    });

    function editkolom(id) {
        $(".inputn" + id).show();
        $(".isin" + id).hide();
    }

    function clone(id) {
        var target_date = $("#target_date" + id).val();
        var target_po = $("#target_po" + id).val();
        var target_dpci = $("#target_dpci" + id).val();
        var target_upc = $("#target_upc" + id).val();
        var size_id = $("#size_id" + id).val();
        var target_ctns = $("#target_ctns" + id).val();
        $("#itarget_date").val(target_date);
        $("#itarget_po").val(target_po);
        $("#itarget_dpci").val(target_dpci);
        $("#itarget_upc").val(target_upc);
        $("#isize_id").val(size_id);
        $("#itarget_ctns").val(target_ctns);
    }

    function clearForm() {
        document.getElementById("formku").reset();
    }
</script>

<?php echo  $this->include("template/footer_v"); ?>