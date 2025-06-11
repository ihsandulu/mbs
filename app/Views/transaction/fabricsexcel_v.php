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
                                        <td class="text-left">
                                            <span class="isin<?= $usr->fabrics_id; ?>"><?= $usr->fabrics_fileno; ?></span>
                                        </td>
                                        <td class="">
                                            <span class="isin<?= $usr->fabrics_id; ?>"><?= $usr->fabrics_name; ?></span>
                                        </td>
                                        <td class="">
                                            <?php if ($usr->fabrics_cad != "") {
                                                $user_image = "images/fabrics_cad/" . $usr->fabrics_cad;
                                            } else {
                                                $user_image = "images/fabrics_cad/no_image.png";
                                            } ?>
                                            <img id="fabrics_cad_image<?= $usr->fabrics_id; ?>" width="100" height="100" src="<?= base_url($user_image); ?>" data-bs-toggle="modal" data-bs-target="#imageModal" onclick="setModalImage('<?= base_url($user_image); ?>')" />
                                        </td>
                                        <td class="">
                                            <span class="isin<?= $usr->fabrics_id; ?>"><?= $usr->fabrics_color; ?></span>
                                        </td>
                                        <td class="">
                                            <span class="isin<?= $usr->fabrics_id; ?>"><?= $usr->fabrics_part; ?></span>
                                        </td>
                                        <td class="">
                                            <span class="isin<?= $usr->fabrics_id; ?>"><?= $usr->fabrics_qty; ?></span>
                                        </td>
                                        <td class="">
                                            <span class="isin<?= $usr->fabrics_id; ?>"><?= $usr->fabrics_yds; ?></span>
                                        </td>
                                        <td class="">
                                            <span class="isin<?= $usr->fabrics_id; ?>"><?= $usr->fabrics_lbs; ?></span>
                                        </td>
                                        <td class="">
                                            <span class="isin<?= $usr->fabrics_id; ?>"><?= $usr->fabrics_remark; ?></span>
                                        </td>
                                        <?php
                                        $fabricsd = $this->db->table("fabricsd")->where("fabrics_id", $usr->fabrics_id)->get();
                                        $totalinyard = 0;
                                        $totalinbale = 0;
                                        $totaloutyard = 0;
                                        $totaloutbale = 0;
                                        foreach ($fabricsd->getResult() as $fabricsd) {
                                            if ($fabricsd->fabricsd_type == "IN") {
                                                $totalinyard += $fabricsd->fabricsd_yard;
                                                $totalinbale += $fabricsd->fabricsd_bale; ?>
                                                <td class="">
                                                    <span class="isin<?= $usr->fabrics_id; ?>"><?= $fabricsd->fabricsd_yard; ?></span>
                                                </td>
                                                <td class="">
                                                    <span class="isin<?= $usr->fabrics_id; ?>"><?= $fabricsd->fabricsd_bale; ?></span>
                                                </td>
                                                <td class=""></td>
                                                <td class=""></td>
                                            <?php } else {
                                                $totaloutyard += $fabricsd->fabricsd_yard;
                                                $totaloutbale += $fabricsd->fabricsd_bale; ?>
                                                <td class=""></td>
                                                <td class=""></td>
                                                <td class="">
                                                    <span class="isin<?= $usr->fabrics_id; ?>"><?= $fabricsd->fabricsd_yard; ?></span>
                                                </td>
                                                <td class="">
                                                    <span class="isin<?= $usr->fabrics_id; ?>"><?= $fabricsd->fabricsd_bale; ?></span>
                                                </td>
                                        <?php }
                                        } ?>
                                        <td class=""><?=$totalinyard;?></td>
                                        <td class=""><?=$totalinbale;?></td>
                                        <td class=""><?=$breceive=$totalinyard-$usr->fabrics_yds;?></td>
                                        <td class=""><?=$totaloutyard;?></td>
                                        <td class=""><?=$totaloutbale;?></td>
                                        <td class=""><?=$totaloutyard-$totalinyard;?></td>
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
            buttons: [{
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
            }
        });
    });
</script>


<?php echo  $this->include("template/footersaja_v"); ?>