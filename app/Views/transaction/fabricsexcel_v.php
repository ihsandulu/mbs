<?php echo $this->include("template/headersaja_v"); ?>
<!-- DataTables & Buttons CSS -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.3.6/css/buttons.dataTables.min.css">

<!-- jQuery & DataTables JS -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.3.6/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.html5.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
<style>
    .text-left {
        text-align: left !important;
    }
</style>
<div class='container-fluid'>
    <div class='row'>
        <div class='col-12'>
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive m-t-1">
                        <?php

                        $dari = date("Y-m-d");
                        $ke = date("Y-m-d");
                        if (isset($_GET["dari"])) {
                            $dari = $_GET["dari"];
                        }
                        if (isset($_GET["ke"])) {
                            $ke = $_GET["ke"];
                        }

                        $build = $this->db
                            ->table("fabricsd")
                            ->join("fabrics", "fabricsd.fabrics_id=fabrics.fabrics_id", "left");
                        if (isset($_GET["buyer_id"])) {
                            $build->where("buyer_id", $_GET["buyer_id"]);
                        }
                        if (isset($_GET["fileno"])) {
                            $build->where("fabrics_fileno", $_GET["fileno"]);
                        }
                        if (isset($_GET["dari"]) && isset($_GET["ke"])) {
                            $build->where("fabrics_date >=", $dari)
                                ->where("fabrics_date <=", $ke);
                        }
                        $usr = $build
                            ->groupBy("fabricsd_date")
                            ->orderBy("fabricsd_date ASC")
                            ->get();
                        // echo $this->db->getLastquery();
                        // die;
                        $no = 1;
                        $ardate = array();
                        foreach ($usr->getResult() as $usr) {
                            $ardate[] = $usr->fabricsd_date;
                        } ?>
                        <?php
                        $build = $this->db->table("fabricsd")
                            ->join("fabrics", "fabrics.fabrics_id=fabricsd.fabrics_id", "left");
                        if (isset($_GET["buyer_id"])) {
                            $build->where("buyer_id", $_GET["buyer_id"]);
                        }
                        if (isset($_GET["fileno"])) {
                            $build->where("fabrics_fileno", $_GET["fileno"]);
                        }
                        if (isset($_GET["dari"]) && isset($_GET["ke"])) {
                            $build->where("fabrics_date >=", $dari)
                                ->where("fabrics_date <=", $ke);
                        }
                        $fabricsd = $build->get();
                        /* echo $this->db->getLastQuery();
                        die; */
                        $totalinyard = 0;
                        $totalinbale = 0;
                        $totaloutyard = 0;
                        $totaloutbale = 0;
                        $arinyard = array();
                        $arinbale = array();
                        $aroutyard = array();
                        $aroutbale = array();
                        $artinyard = array();
                        $artinbale = array();
                        $artoutyard = array();
                        $artoutbale = array();
                        $fabricsid = 0;
                        foreach ($fabricsd->getResult() as $fabricsd) {
                            if ($fabricsid != $fabricsd->fabrics_id) {
                                $totalinyard = 0;
                                $totalinbale = 0;
                                $totaloutyard = 0;
                                $totaloutbale = 0;
                            }
                            if ($fabricsd->fabricsd_type == "IN") {
                                $arinyard[$fabricsd->fabrics_id][$fabricsd->fabricsd_date] = $fabricsd->fabricsd_yard;
                                $arinbale[$fabricsd->fabrics_id][$fabricsd->fabricsd_date] = $fabricsd->fabricsd_bale;
                                if (!isset($aroutyard[$fabricsd->fabrics_id][$fabricsd->fabricsd_date])) {
                                    $aroutyard[$fabricsd->fabrics_id][$fabricsd->fabricsd_date] = "";
                                }
                                if (!isset($aroutbale[$fabricsd->fabrics_id][$fabricsd->fabricsd_date])) {
                                    $aroutbale[$fabricsd->fabrics_id][$fabricsd->fabricsd_date] = "";
                                }

                                $totalinyard += $fabricsd->fabricsd_yard;
                                $totalinbale += $fabricsd->fabricsd_bale;
                            } else {
                                if (!isset($arinyard[$fabricsd->fabrics_id][$fabricsd->fabricsd_date])) {
                                    $arinyard[$fabricsd->fabrics_id][$fabricsd->fabricsd_date] = "";
                                }
                                if (!isset($arinbale[$fabricsd->fabrics_id][$fabricsd->fabricsd_date])) {
                                    $arinbale[$fabricsd->fabrics_id][$fabricsd->fabricsd_date] = "";
                                }
                                $aroutyard[$fabricsd->fabrics_id][$fabricsd->fabricsd_date] = $fabricsd->fabricsd_yard;
                                $aroutbale[$fabricsd->fabrics_id][$fabricsd->fabricsd_date] = $fabricsd->fabricsd_bale;

                                $totaloutyard += $fabricsd->fabricsd_yard;
                                $totaloutbale += $fabricsd->fabricsd_bale;
                            }

                            $artinyard[$fabricsd->fabrics_id] = $totalinyard;
                            $artinbale[$fabricsd->fabrics_id] = $totalinbale;
                            $artoutyard[$fabricsd->fabrics_id] = $totaloutyard;
                            $artoutbale[$fabricsd->fabrics_id] = $totaloutbale;

                            $fabricsid = $fabricsd->fabrics_id;
                        } ?>
                        <table id="tabelku" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                            <!-- <table id="dataTable" class="table table-condensed table-hover w-auto dtable"> -->
                            <thead class="">
                                <tr>
                                    <!-- <th>No.</th> -->
                                    <th rowspan="3">File No.</th>
                                    <th rowspan="3">Fabrication</th>
                                    <th rowspan="3">Cad</th>
                                    <th rowspan="3">Color</th>
                                    <th rowspan="3">Part</th>
                                    <th rowspan="3">Qty</th>
                                    <th rowspan="3">YDS</th>
                                    <th rowspan="3">LBS</th>
                                    <th rowspan="3">Remark</th>
                                    <?php foreach ($ardate as $ardat) { ?>
                                        <th class="text-center" colspan="4"><?= $ardat; ?></th>
                                    <?php } ?>
                                    <th class="text-center" colspan="6">Current Stock</th>
                                </tr>
                                <tr>
                                    <?php foreach ($ardate as $ardat) { ?>
                                        <th class="text-center" colspan="2">IN</th>
                                        <th class="text-center" colspan="2">OUT</th>
                                    <?php } ?>
                                    <th class="text-center" colspan="2">TOTAL IN</th>
                                    <th class="text-center" rowspan="2">BALANCE RECEIVE</th>
                                    <th class="text-center" colspan="2">TOTAL OUT</th>
                                    <th class="text-center" rowspan="2">BALANCE LOADING</th>
                                </tr>
                                <tr>
                                    <?php foreach ($ardate as $ardat) { ?>
                                        <th class="text-center">Yard</th>
                                        <th class="text-center">Bale</th>
                                        <th class="text-center">Yard</th>
                                        <th class="text-center">Bale</th>
                                    <?php } ?>

                                    <th class="text-center">Yard</th>
                                    <th class="text-center">Bale</th>
                                    <th class="text-center">Yard</th>
                                    <th class="text-center">Bale</th>
                                </tr>
                            </thead>
                            <tbody><?php

                                    $build = $this->db
                                        ->table("fabrics");
                                    if (isset($_GET["buyer_id"])) {
                                        $build->where("buyer_id", $_GET["buyer_id"]);
                                    }
                                    if (isset($_GET["fileno"])) {
                                        $build->where("fabrics_fileno", $_GET["fileno"]);
                                    }
                                    if (isset($_GET["dari"]) && isset($_GET["ke"])) {
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
                                        <!-- <td><?= $no++; ?></td> -->
                                        <!-- di hide -->
                                        <td class="text-left"><?= $usr->fabrics_fileno; ?></td>
                                        <td class=""><?= $usr->fabrics_name; ?></td>
                                        <td class="">
                                            <?php if ($usr->fabrics_cad != "") {
                                                $user_image = "images/fabrics_cad/" . $usr->fabrics_cad;
                                            } else {
                                                $user_image = "images/fabrics_cad/no_image.png";
                                            } ?>
                                            <img id="fabrics_cad_image<?= $usr->fabrics_id; ?>" width="100" height="100" src="<?= base_url($user_image); ?>" data-bs-toggle="modal" data-bs-target="#imageModal" onclick="setModalImage('<?= base_url($user_image); ?>')" />
                                        </td>
                                        <td class=""><?= $usr->fabrics_color; ?></td>
                                        <td class=""><?= $usr->fabrics_part; ?></td>
                                        <td class=""><?= $usr->fabrics_qty; ?></td>
                                        <td class=""><?= $usr->fabrics_yds; ?></td>
                                        <td class=""><?= $usr->fabrics_lbs; ?></td>
                                        <td class=""><?= $usr->fabrics_remark; ?></td>
                                        <?php foreach ($ardate as $ardat) { ?>
                                            <td class=""><?= (isset($arinyard[$usr->fabrics_id][$ardat])) ? $arinyard[$usr->fabrics_id][$ardat] : ""; ?></td>
                                            <td class=""><?= (isset($arinbale[$usr->fabrics_id][$ardat])) ? $arinbale[$usr->fabrics_id][$ardat] : ""; ?></td>
                                            <td class=""><?= (isset($aroutyard[$usr->fabrics_id][$ardat])) ? $aroutyard[$usr->fabrics_id][$ardat] : ""; ?></td>
                                            <td class=""><?= (isset($aroutbale[$usr->fabrics_id][$ardat])) ? $aroutbale[$usr->fabrics_id][$ardat] : ""; ?></td>
                                        <?php } ?>
                                        <td class=""><?= (isset($artinyard[$usr->fabrics_id])) ? $artinyard[$usr->fabrics_id] : ""; ?></td>
                                        <td class=""><?= (isset($artinbale[$usr->fabrics_id])) ? $artinbale[$usr->fabrics_id] : ""; ?></td>
                                        <td class="">
                                            <?php
                                            if (isset($artinyard[$usr->fabrics_id])) {
                                                $iartinyard = $artinyard[$usr->fabrics_id];
                                            } else {
                                                $iartinyard = 0;
                                            }
                                            $breceive = $iartinyard - $usr->fabrics_yds;
                                            echo $breceive;
                                            ?>
                                        </td>
                                        <td class="">
                                            <?php
                                            if (isset($artoutyard[$usr->fabrics_id])) {
                                                $iartoutyard = $artoutyard[$usr->fabrics_id];
                                            } else {
                                                $iartoutyard = 0;
                                            }
                                            ?>
                                            <?= $iartoutyard; ?></td>
                                        <td class=""><?= (isset($artoutbale[$usr->fabrics_id])) ? $artoutbale[$usr->fabrics_id] : ""; ?></td>
                                        <td class=""><?= $iartoutyard - $iartinyard; ?></td>
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
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        let table = $('#tabelku').DataTable({
            dom: 'Bfrtip',
            /* buttons: [{
                extend: 'excelHtml5',
                title: 'Data Export',
                autoFilter: true,
                exportOptions: {
                    columns: ':visible',
                    format: {
                        body: function(data, row, column, node) {
                            // Kolom ke-2 adalah gambar (index 2)
                            if (column === 2) {
                                let img = $('img', node);
                                if (img.length > 0) {
                                    return img.attr('src'); // jadikan link ke gambar
                                }
                            }
                            return data; // untuk kolom lain, biarkan biasa
                        }
                    }
                }
            }],
            initComplete: function() {
                let dt = this.api();
                dt.button('.buttons-excel').trigger();
            } */
        });
    });
</script>


<?php echo  $this->include("template/footersaja_v"); ?>