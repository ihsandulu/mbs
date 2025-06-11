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
                            <h4 class="card-title mr-3" style="float:left;"></h4>
                            <a href="<?= base_url(strtolower($_GET["title"])); ?>" class="btn btn-warning btn-xs">
                                <i class="fa fa-forward"></i> Back
                            </a>
                        </div>
                        <div class="col-2 ">
                            
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
                                        <input type="hidden" name="fabricsd_id" />
                                    </h1>
                                </form>
                            <?php } ?> -->
                        <?php } ?>
                    </div>

                    <?php if (isset($_POST['new']) || isset($_POST['edit'])) { ?>
                        <div class="">
                            <?php if (isset($_POST['edit'])) {
                                $namabutton = 'name="change"';
                                $judul = "Update Packing fabricsd";
                            } else {
                                $namabutton = 'name="create"';
                                $judul = "Tambah Packing fabricsd";
                            } ?>
                            <div class="lead">
                                <h3><?= $judul; ?></h3>
                            </div>
                            <form class="form-horizontal" method="post" enctype="multipart/form-data">

                                <div class="form-group ">
                                    <label class="control-label col-sm-2" for="fabricsd_date">Tanggal:</label>
                                    <div class="col-sm-10">
                                        <input type="date" class="form-control " id="fabricsd_date" name="fabricsd_date" placeholder="" value="<?= $fabricsd_date; ?>">
                                    </div>
                                </div>

                                <div class="form-group ">
                                    <label class="control-label col-sm-2" for="fabrics_id">Fabrication:</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control " id="fabrics_id" name="fabrics_id" placeholder="" value="<?= $fabrics_id; ?>">
                                    </div>
                                </div>

                                <div class="form-group ">
                                    <label class="control-label col-sm-2" for="fabricsd_type">Color:</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control " id="fabricsd_type" name="fabricsd_type" placeholder="" value="<?= $fabricsd_type; ?>">
                                    </div>
                                </div>


                                <div class="form-group ">
                                    <label class="control-label col-sm-2" for="fabricsd_yard">Cad:</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control " id="fabricsd_yard" name="fabricsd_yard" placeholder="" value="<?= $fabricsd_yard; ?>">
                                    </div>
                                </div>



                                <input type="hidden" name="fabricsd_id" value="<?= $fabricsd_id; ?>" />
                                <div class="form-group">
                                    <div class="col-sm-offset-2 col-sm-10">
                                        <button type="submit" id="submit" class="btn btn-primary col-md-5" <?= $namabutton; ?> value="OK">Submit</button>
                                        <a class="btn btn-warning col-md-offset-1 col-md-5" href="<?= base_url("fabricsd"); ?>">Back</a>
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
                                        <select required class="form-control " id="ifabricsd_type" name="fabricsd_type">
                                            <option value="">Pilih IN/OUT</option>
                                            <option value="IN">IN</option>
                                            <option value="OUT">OUT</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group col-2">
                                    <div class="col-sm-12">
                                        <input type="date" class="form-control " id="ifabricsd_date" name="fabricsd_date" placeholder="Tanggal" value="">
                                    </div>
                                </div>

                                <div class="form-group col-2">
                                    <div class="col-sm-12">
                                        <input type="text" class="form-control " id="ifabricsd_yard" name="fabricsd_yard" placeholder="Yard" value="">
                                    </div>
                                </div>

                                <div class="form-group col-2">
                                    <div class="col-sm-12">
                                        <input type="text" class="form-control " id="ifabricsd_bale" name="fabricsd_bale" placeholder="Bale" value="">
                                    </div>
                                </div>
                                <input type="hidden" id="fabrics_id" name="fabrics_id" value="<?= $_GET["fabrics_id"]; ?>" />

                                <div class="form-group  col-4 row">
                                    <div class="col-sm-6">
                                        <button type="submit" id="submit" class="btn btn-primary  btn-block" name="create" value="OK">Submit</button>
                                    </div>
                                    <div class="col-sm-6">
                                        <button onclick="clearForm()" type="button" id="submit" class="btn btn-success btn-block" name="create" value="OK">Clear</button>
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
                                    if (isset($_GET["tipe"])) {
                                        $filtern = "tipe";
                                    } else if (isset($_GET["tgl"])) {
                                        $filtern = "tgl";
                                    } else {
                                        $filtern = "";
                                    }
                                    ?>
                                    <div class="col-9">
                                        <select id="filtern" onchange="pilihfilter()" class="form-control">
                                            <option value="tgl" <?= ($filtern == "tgl") ? "selected" : ""; ?>>Tgl Awal Masuk</option>
                                            <option value="tipe" <?= ($filtern == "tipe") ? "selected" : ""; ?>>Type IN/OUT</option>
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
                                    <input type="hidden" name="fabrics_id" value="<?=$_GET["fabrics_id"];?>"/>
                                    <div class="col-4 row mb-2">
                                        <div class="col-12">
                                            <button type="submit" class="btn btn-block btn-primary">Search</button>
                                        </div>
                                    </div>
                                </form>
                                <form method="get" class="col-8 row mb-2" id="tipe">
                                    <?php
                                    $tipe = "";
                                    if (isset($_GET["tipe"])) {
                                        $tipe = $_GET["tipe"];
                                    }
                                    ?>
                                    <div class="col-8 row mb-2">
                                        <div class="col-3">
                                            <label class="text-dark">Type :</label>
                                        </div>
                                        <div class="col-9">
                                            <select required class="form-control" name="tipe">
                                                <option value="" <?= ($tipe == "") ? "selected" : ""; ?>>Pilih IN/OUT</option>
                                                <option value="IN" <?= ($tipe == "IN") ? "selected" : ""; ?>>IN</option>
                                                <option value="OUT" <?= ($tipe == "OUT") ? "selected" : ""; ?>>OUT</option>
                                            </select>
                                        </div>
                                    </div>
                                    <input type="hidden" name="fabrics_id" value="<?=$_GET["fabrics_id"];?>"/>
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
                                            $("#tipe").hide();
                                        } else {
                                            $("#tgl").hide();
                                            $("#tipe").show();
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
                                        <th>Type</th>
                                        <th>Yard</th>
                                        <th>Bale</th>
                                        <th>Save</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $build = $this->db
                                        ->table("fabricsd");
                                    if (isset($_GET["fabrics_id"])) {
                                        $build->where("fabrics_id", $_GET["fabrics_id"]);
                                    }
                                    if (isset($_GET["dari"]) && isset($_GET["ke"])) {
                                        $build->where("fabricsd_date >=", $dari)
                                            ->where("fabricsd_date <=", $ke);
                                    }
                                    if (isset($_GET["tipe"])) {
                                        $build->where("fabricsd_type", $tipe);
                                    }
                                    $usr = $build
                                    ->orderBy("fabricsd_date DESC")
                                    ->orderBy("fabricsd_type DESC")
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
                                                            <button type="button" onclick="editkolom(<?= $usr->fabricsd_id; ?>)" class="btn btn-sm btn-warning " name="edit" value="OK"><span class="fa fa-edit" style="color:white;"></span> </button>
                                                            <input type="hidden" name="fabricsd_id" value="<?= $usr->fabricsd_id; ?>" />
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
                                                            <input type="hidden" name="fabricsd_id" value="<?= $usr->fabricsd_id; ?>" />
                                                        </form>

                                                        <!-- <form method="post" class="isin btn-action">
                                                            <button type="button" class="btn btn-sm btn-warning" onclick="clone(<?= $usr->fabricsd_id; ?>)" name="create" value="OK"><span class="fa fa-clone" style="color:white;"></span> </button>
                                                        </form> -->
                                                    <?php } ?>
                                                </td>
                                            <?php } ?>
                                            <!-- <td><?= $no++; ?></td> -->

                                            <form class="form-horizontal row" method="post" enctype="multipart/form-data">
                                                <td class="">
                                                    <input type="date" class="form-control inputn inputn<?= $usr->fabricsd_id; ?> " id="fabricsd_date<?= $usr->fabricsd_id; ?>" name="fabricsd_date" placeholder="Tanggal" value="<?= $usr->fabricsd_date; ?>">
                                                    <span class="isin<?= $usr->fabricsd_id; ?>"><?= $usr->fabricsd_date; ?></span>
                                                </td>
                                                <td class="">
                                                    <select required class="form-control inputn inputn<?= $usr->fabricsd_id; ?> " id="fabricsd_type<?= $usr->fabricsd_id; ?>" name="fabricsd_type">
                                                        <option value="" <?= ($usr->fabricsd_type == "") ? "selected" : ""; ?>>Pilih IN/OUT</option>
                                                        <option value="IN" <?= ($usr->fabricsd_type == "IN") ? "selected" : ""; ?>>IN</option>
                                                        <option value="OUT" <?= ($usr->fabricsd_type == "OUT") ? "selected" : ""; ?>>OUT</option>
                                                    </select>
                                                    <span class="isin<?= $usr->fabricsd_id; ?>"><?= $usr->fabricsd_type; ?></span>
                                                </td>
                                                <td class="">
                                                    <input type="text" class="form-control inputn inputn<?= $usr->fabricsd_id; ?> " id="fabricsd_yard<?= $usr->fabricsd_id; ?>" name="fabricsd_yard" placeholder="Yard" value="<?= $usr->fabricsd_yard; ?>">
                                                    <span class="isin<?= $usr->fabricsd_id; ?>"><?= $usr->fabricsd_yard; ?></span>
                                                </td>
                                                <td class="">
                                                    <input type="text" class="form-control inputn inputn<?= $usr->fabricsd_id; ?> " id="fabricsd_bale<?= $usr->fabricsd_id; ?>" name="fabricsd_bale" placeholder="Bale" value="<?= $usr->fabricsd_bale; ?>">
                                                    <span class="isin<?= $usr->fabricsd_id; ?>"><?= $usr->fabricsd_bale; ?></span>
                                                </td>


                                                <td class="">
                                                    <div class="inputn inputn<?= $usr->fabricsd_id; ?>">
                                                        <input type="hidden" name="fabricsd_id" value="<?= $usr->fabricsd_id; ?>" />
                                                        <button type="submit" id="submit" class="btn btn-success btn-block" name="change" value="OK">Save</button>
                                                    </div>
                                                </td>
                                            </form>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                            <div class="modal fade" id="imageModal" tabindex="-1">
                                <div class="modal-dialog modal-dialog-centered modal-lg">
                                    <div class="modal-content bg-dark">
                                        <div class="modal-body text-center p-0">
                                            <img id="modalImage" class="img-fluid" alt="Gambar besar">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function setModalImage(src) {
        document.getElementById('modalImage').src = src;
    }

    function readURL(input, fabricsd_id) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
                $('#fabricsd_yard_image' + fabricsd_id).attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
        }
    }
    $('.select').select2();
    var title = "<?= $title; ?>";
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
        var fabricsd_type = $("#fabricsd_type" + id).val();
        var fabricsd_date = $("#fabricsd_date" + id).val();
        var fabrics_id = $("#fabrics_id" + id).val();
        var fabricsd_type = $("#fabricsd_type" + id).val();
        var fabricsd_yard = $("#fabricsd_yard" + id).val();
        $("#ifabricsd_type").val(fabricsd_type);
        $("#ifabricsd_date").val(fabricsd_date);
        $("#ifabrics_id").val(fabrics_id);
        $("#ifabricsd_type").val(fabricsd_type);
        $("#ifabricsd_yard").val(fabricsd_yard);
    }

    function clearForm() {
        document.getElementById("formku").reset();
    }
</script>

<?php echo  $this->include("template/footer_v"); ?>