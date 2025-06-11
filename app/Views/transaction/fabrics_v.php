<?php echo $this->include("template/header_v"); ?>
<style>
    .text-left {
        text-align: left !important;
    }

    .btn-export-hijau {
        background-color:rgb(71, 207, 103) !important;
        /* Warna hijau */
        color: white !important;
        border: none;
        padding: 6px 12px;
        border-radius: 4px;
        font-weight: bold;
        cursor: pointer;
    }

    .btn-export-hijau:hover {
        background-color:rgb(59, 163, 82) !important;
        /* Warna hijau lebih gelap saat hover */
    }

    .btn-export-excel {
        background-color: #28a745 !important;
        /* Warna hijau */
        color: white !important;
        border: none;
        padding: 6px 12px;
        border-radius: 4px;
        font-weight: bold;
        cursor: pointer;
    }

    .btn-export-excel:hover {
        background-color: #218838 !important;
        /* Warna hijau lebih gelap saat hover */
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
                        </div>
                        <div class="col-2 ">
                            <!-- <a href="<?= base_url("apk/104.apk"); ?>" class="btn btn-success btn-xs btn-block float-right">
                                <i class="fa fa-download"></i> Download APK
                            </a> -->
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
                                        <input type="hidden" name="fabrics_id" />
                                    </h1>
                                </form>
                            <?php } ?> -->
                        <?php } ?>
                    </div>

                    <?php if (isset($_POST['new']) || isset($_POST['edit'])) { ?>
                        <div class="">
                            <?php if (isset($_POST['edit'])) {
                                $namabutton = 'name="change"';
                                $judul = "Update Packing fabrics";
                            } else {
                                $namabutton = 'name="create"';
                                $judul = "Tambah Packing fabrics";
                            } ?>
                            <div class="lead">
                                <h3><?= $judul; ?></h3>
                            </div>
                            <form class="form-horizontal" method="post" enctype="multipart/form-data">

                                <div class="form-group ">
                                    <label class="control-label col-sm-2" for="fabrics_date">Tanggal:</label>
                                    <div class="col-sm-10">
                                        <input type="date" class="form-control " id="fabrics_date" name="fabrics_date" placeholder="" value="<?= $fabrics_date; ?>">
                                    </div>
                                </div>

                                <div class="form-group ">
                                    <label class="control-label col-sm-2" for="fabrics_name">Fabrication:</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control " id="fabrics_name" name="fabrics_name" placeholder="" value="<?= $fabrics_name; ?>">
                                    </div>
                                </div>

                                <div class="form-group ">
                                    <label class="control-label col-sm-2" for="fabrics_color">Color:</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control " id="fabrics_color" name="fabrics_color" placeholder="" value="<?= $fabrics_color; ?>">
                                    </div>
                                </div>


                                <div class="form-group ">
                                    <label class="control-label col-sm-2" for="fabrics_cad">Cad:</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control " id="fabrics_cad" name="fabrics_cad" placeholder="" value="<?= $fabrics_cad; ?>">
                                    </div>
                                </div>



                                <input type="hidden" name="fabrics_id" value="<?= $fabrics_id; ?>" />
                                <div class="form-group">
                                    <div class="col-sm-offset-2 col-sm-10">
                                        <button type="submit" id="submit" class="btn btn-primary col-md-5" <?= $namabutton; ?> value="OK">Submit</button>
                                        <a class="btn btn-warning col-md-offset-1 col-md-5" href="<?= base_url("fabrics"); ?>">Back</a>
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
                                        <input type="date" class="form-control " id="ifabrics_date" name="fabrics_date" placeholder="Tanggal" value="">
                                    </div>
                                </div>

                                <div class="form-group col-2">
                                    <div class="col-sm-12">
                                        <input type="text" class="form-control " id="ifabrics_name" name="fabrics_name" placeholder="Fabrication" value="">
                                    </div>
                                </div>

                                <div class="form-group col-2">
                                    <div class="col-sm-12">
                                        <input type="text" class="form-control " id="ifabrics_color" name="fabrics_color" placeholder="Color" value="">
                                    </div>
                                </div>

                                <div class="form-group col-2">
                                    <div class="col-sm-12">
                                        <input type="file" class="form-control " id="ifabrics_cad" name="fabrics_cad" placeholder="File" value="">
                                    </div>
                                </div>



                                <div class="form-group col-2">
                                    <div class="col-sm-12">
                                        <input type="text" class="form-control " id="ifabrics_fileno" name="fabrics_fileno" placeholder="File No." value="">
                                    </div>
                                </div>



                                <div class="form-group col-2">
                                    <div class="col-sm-12">
                                        <input type="text" class="form-control " id="ifabrics_part" name="fabrics_part" placeholder="Part" value="">
                                    </div>
                                </div>



                                <div class="form-group col-2">
                                    <div class="col-sm-12">
                                        <input type="text" class="form-control " id="ifabrics_qty" name="fabrics_qty" placeholder="Qty" value="">
                                    </div>
                                </div>



                                <div class="form-group col-2">
                                    <div class="col-sm-12">
                                        <input type="text" class="form-control " id="ifabrics_yds" name="fabrics_yds" placeholder="YDS" value="">
                                    </div>
                                </div>



                                <div class="form-group col-2">
                                    <div class="col-sm-12">
                                        <input type="text" class="form-control " id="ifabrics_lbs" name="fabrics_lbs" placeholder="LBS" value="">
                                    </div>
                                </div>



                                <div class="form-group col-2">
                                    <div class="col-sm-12">
                                        <input type="text" class="form-control " id="ifabrics_remark" name="fabrics_remark" placeholder="Remarks" value="">
                                    </div>
                                </div>

                                <input type="hidden" id="ibuyer_id" name="buyer_id" value="<?= $buyer; ?>">

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
                                    if (isset($_GET["filtern"])) {
                                        $filtern = $_GET["filtern"];
                                    } else {
                                        $filtern = "";
                                    }
                                    ?>
                                    <div class="col-9">
                                        <select id="mfiltern" onchange="pilihfilter()" class="form-control">
                                            <option value="tgl" <?= ($filtern == "tgl") ? "selected" : ""; ?>>Tgl Awal Masuk</option>
                                            <option value="fileno" <?= ($filtern == "fileno") ? "selected" : ""; ?>>File No.</option>
                                        </select>
                                    </div>
                                </div>
                                <form method="get" class="col-8 row mb-2" id="tgl">
                                    <?php
                                    $dari = date("Y-m-d");
                                    $ke = date("Y-m-d");
                                    if (isset($_GET["dari"])) {
                                        $dari = $_GET["dari"];
                                    } else {
                                        $dari = date("Y-m-d", strtotime("-5 days"));
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
                                            <input type="date" class="form-control" placeholder="Dari" id="mdari" name="dari" value="<?= $dari; ?>">
                                        </div>
                                    </div>
                                    <div class="col-4 row mb-2">
                                        <div class="col-4">
                                            <label class="text-dark">Ke :</label>
                                        </div>
                                        <div class="col-8">
                                            <input type="date" class="form-control" placeholder="Ke" id="mke" name="ke" value="<?= $ke; ?>">
                                        </div>
                                    </div>
                                    <div class="col-4 row mb-2">
                                        <div class="col-12">
                                            <input type="hidden" class="filtern" name="filtern" />
                                            <button type="submit" class="btn btn-block btn-primary">Search</button>
                                        </div>
                                    </div>
                                </form>
                                <form method="get" class="col-8 row mb-2" id="fileno">
                                    <?php
                                    $ifileno = "";
                                    if (isset($_GET["fileno"])) {
                                        $ifileno = $_GET["fileno"];
                                    }
                                    ?>
                                    <div class="col-8 row mb-2">
                                        <div class="col-3">
                                            <label class="text-dark">File No. :</label>
                                        </div>
                                        <div class="col-9">
                                            <input type="text" class="form-control" placeholder="" id="mfileno" name="fileno" value="<?= $ifileno; ?>">
                                        </div>
                                    </div>
                                    <div class="col-4 row mb-2">
                                        <div class="col-12">
                                            <input type="hidden" class="filtern" name="filtern" />
                                            <button type="submit" class="btn btn-block btn-primary">Search</button>
                                        </div>
                                    </div>
                                </form>
                                <script>
                                    function pilihfilter() {
                                        var filter = $("#mfiltern").val();
                                        if (filter == "tgl") {
                                            $("#tgl").show();
                                            $("#fileno").hide();
                                            $(".filtern").val("tgl");
                                        } else {
                                            $("#tgl").hide();
                                            $("#fileno").show();
                                            $(".filtern").val("fileno");
                                        }
                                    }
                                    pilihfilter();
                                </script>
                            </div>
                        </div>
                        <div class="table-responsive m-t-1">
                            <table id="gad" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                                <!-- <table id="dataTable" class="table table-condensed table-hover w-auto dtable"> -->
                                <thead class="">
                                    <tr>
                                        <?php if (!isset($_GET["report"])) { ?>
                                            <th>Action</th>
                                        <?php } ?>
                                        <!-- <th>No.</th> -->
                                        <th>Tanggal</th>
                                        <th>Fabrication</th>
                                        <th>Color</th>
                                        <th>Cad</th>
                                        <th>Save</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $build = $this->db
                                        ->table("fabrics")
                                        ->where("buyer_id", $buyer);
                                    if (isset($_GET["fileno"])) {
                                        $build->where("fabrics_fileno", $_GET["fileno"]);
                                    }
                                    /* if (isset($_GET["dari"]) && isset($_GET["ke"])) {
                                        $build->where("fabrics_date >=", $dari)
                                            ->where("fabrics_date <=", $ke);
                                    } */
                                    if (!isset($_GET["fileno"])) {
                                        $build->where("fabrics_date >=", $dari)
                                            ->where("fabrics_date <=", $ke);
                                    }
                                    $usr = $build->orderBy("fabrics_date DESC")
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
                                                        <form method="get" class="isin btn-action" action="<?= base_url("fabricsd"); ?>">
                                                            <button type="submit" class="btn btn-sm btn-info " name="detail" value="OK"><span class="fa fa-cubes" style="color:white;"></span> </button>
                                                            <input type="hidden" name="fabrics_id" value="<?= $usr->fabrics_id; ?>" />
                                                            <input type="hidden" name="title" value="<?= $title; ?>" />
                                                        </form>
                                                        <form method="post" class="isin btn-action">
                                                            <button type="button" onclick="editkolom(<?= $usr->fabrics_id; ?>)" class="btn btn-sm btn-warning " name="edit" value="OK"><span class="fa fa-edit" style="color:white;"></span> </button>
                                                            <input type="hidden" name="fabrics_id" value="<?= $usr->fabrics_id; ?>" />
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
                                                            <input type="hidden" name="fabrics_id" value="<?= $usr->fabrics_id; ?>" />
                                                        </form>

                                                        <!-- <form method="post" class="isin btn-action">
                                                            <button type="button" class="btn btn-sm btn-warning" onclick="clone(<?= $usr->fabrics_id; ?>)" name="create" value="OK"><span class="fa fa-clone" style="color:white;"></span> </button>
                                                        </form> -->
                                                    <?php } ?>
                                                </td>
                                            <?php } ?>
                                            <!-- <td><?= $no++; ?></td> -->

                                            <form class="form-horizontal row" method="post" enctype="multipart/form-data">
                                                <td class="">
                                                    <input type="date" class="form-control inputn inputn<?= $usr->fabrics_id; ?> " id="fabrics_date<?= $usr->fabrics_id; ?>" name="fabrics_date" placeholder="Tanggal" value="<?= $usr->fabrics_date; ?>">
                                                    <span class="isin<?= $usr->fabrics_id; ?>"><?= $usr->fabrics_date; ?><br /></span>

                                                    <input type="text" class="form-control inputn inputn<?= $usr->fabrics_id; ?> " id="fabrics_name<?= $usr->fabrics_id; ?>" name="fabrics_name" placeholder="PO" value="<?= $usr->fabrics_name; ?>">
                                                    <span class="isin<?= $usr->fabrics_id; ?>">Fabric: <?= $usr->fabrics_name; ?></br></span>


                                                    <input type="text" class="form-control inputn inputn<?= $usr->fabrics_id; ?> " id="fabrics_remark<?= $usr->fabrics_id; ?>" name="fabrics_remark" placeholder="Remarks" value="<?= $usr->fabrics_remark; ?>">
                                                    <span class="isin<?= $usr->fabrics_id; ?>">Remarks: <?= $usr->fabrics_remark; ?></span>
                                                </td>
                                                <td class="text-left">
                                                    <input type="text" class="form-control inputn inputn<?= $usr->fabrics_id; ?> " id="fabrics_fileno<?= $usr->fabrics_id; ?>" name="fabrics_fileno" placeholder="Tanggal" value="<?= $usr->fabrics_fileno; ?>">
                                                    <span class="isin<?= $usr->fabrics_id; ?>">File No: <?= $usr->fabrics_fileno; ?></br></span>




                                                    <input type="text" class="form-control inputn inputn<?= $usr->fabrics_id; ?> " id="fabrics_part<?= $usr->fabrics_id; ?>" name="fabrics_part" placeholder="PO" value="<?= $usr->fabrics_part; ?>">
                                                    <span class="isin<?= $usr->fabrics_id; ?>">Part: <?= $usr->fabrics_part; ?></br></span>


                                                    <input type="text" class="form-control inputn inputn<?= $usr->fabrics_id; ?> " id="fabrics_qty<?= $usr->fabrics_id; ?>" name="fabrics_qty" placeholder="PO" value="<?= $usr->fabrics_qty; ?>">
                                                    <span class="isin<?= $usr->fabrics_id; ?>">Qty: <?= $usr->fabrics_qty; ?></span>
                                                </td>
                                                <td class="">
                                                    <input type="text" class="form-control inputn inputn<?= $usr->fabrics_id; ?> " id="fabrics_color<?= $usr->fabrics_id; ?>" name="fabrics_color" placeholder="Color" value="<?= $usr->fabrics_color; ?>">
                                                    <span class="isin<?= $usr->fabrics_id; ?>">Color: <?= $usr->fabrics_color; ?></br></span>


                                                    <input type="text" class="form-control inputn inputn<?= $usr->fabrics_id; ?> " id="fabrics_yds<?= $usr->fabrics_id; ?>" name="fabrics_yds" placeholder="YDS" value="<?= $usr->fabrics_yds; ?>">
                                                    <span class="isin<?= $usr->fabrics_id; ?>">YDS: <?= $usr->fabrics_yds; ?></br></span>


                                                    <input type="text" class="form-control inputn inputn<?= $usr->fabrics_id; ?> " id="fabrics_lbs<?= $usr->fabrics_id; ?>" name="fabrics_lbs" placeholder="LBS" value="<?= $usr->fabrics_lbs; ?>">
                                                    <span class="isin<?= $usr->fabrics_id; ?>">LBS: <?= $usr->fabrics_lbs; ?></br></span>
                                                </td>

                                                <td class="">
                                                    <input type="file" class="form-control inputn inputn<?= $usr->fabrics_id; ?>" id="fabrics_cad<?= $usr->fabrics_id; ?>" name="fabrics_cad" placeholder="CTNS" value="<?= $usr->fabrics_cad; ?>">

                                                    <?php if ($usr->fabrics_cad != "") {
                                                        $user_image = "images/fabrics_cad/" . $usr->fabrics_cad;
                                                    } else {
                                                        $user_image = "images/fabrics_cad/no_image.png";
                                                    } ?>
                                                    <img id="fabrics_cad_image<?= $usr->fabrics_id; ?>" width="100" height="100" src="<?= base_url($user_image); ?>" data-bs-toggle="modal" data-bs-target="#imageModal" onclick="setModalImage('<?= base_url($user_image); ?>')" />
                                                    <script>
                                                        $("#fabrics_cad<?= $usr->fabrics_id; ?>").change(function() {
                                                            readURL(this, <?= $usr->fabrics_id; ?>);
                                                        });
                                                    </script>
                                                </td>
                                                <td class="">
                                                    <div class="inputn inputn<?= $usr->fabrics_id; ?>">
                                                        <input type="hidden" name="fabrics_id" value="<?= $usr->fabrics_id; ?>" />
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
    $(document).ready(function() {

        let mfiltern = $("#mfiltern").val();
        let mdari = $("#mdari").val();
        let mke = $("#mke").val();
        let mfileno = $("#mfileno").val();
        let url = "<?= base_url("fabricssimulasi"); ?>?buyer_id=<?= strtolower($buyer); ?>";
        let urle = "<?= base_url("fabricsexcel"); ?>?buyer_id=<?= strtolower($buyer); ?>";
        if (mfiltern == "tgl") {
            url += "&dari=" + mdari + "&ke=" + mke;
            urle += "&dari=" + mdari + "&ke=" + mke;
        } else {
            url += "&fileno=" + mfileno;
            urle += "&fileno=" + mfileno;
        }

        $('#gad').DataTable({
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
                    text: 'Simulasi',
                    className: 'btn-export-hijau',
                    action: function(e, dt, node, config) {
                        window.location.href = url;
                    }
                },
                {
                    text: 'Export Excel',
                    className: 'btn-export-excel',
                    action: function(e, dt, node, config) {
                        window.location.href = urle;
                    }
                }
            ],
            ordering: false
        });
    });


    function setModalImage(src) {
        document.getElementById('modalImage').src = src;
    }

    function readURL(input, fabrics_id) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
                $('#fabrics_cad_image' + fabrics_id).attr('src', e.target.result);
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
        var fabrics_date = $("#fabrics_date" + id).val();
        var fabrics_name = $("#fabrics_name" + id).val();
        var fabrics_color = $("#fabrics_color" + id).val();
        var fabrics_cad = $("#fabrics_cad" + id).val();
        $("#ifabrics_date").val(fabrics_date);
        $("#ifabrics_name").val(fabrics_name);
        $("#ifabrics_color").val(fabrics_color);
        $("#ifabrics_cad").val(fabrics_cad);
    }

    function clearForm() {
        document.getElementById("formku").reset();
    }
</script>

<?php echo  $this->include("template/footer_v"); ?>