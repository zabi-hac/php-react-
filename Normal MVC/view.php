<?php
include './model/db.php';
$db  = new Db();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Zonifo | Home</title>
    <!-- Google Font: Source Sans Pro -->
    <!-- <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback"> -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300&display=swap" rel="stylesheet">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="./assets/lte/plugins/fontawesome-free/css/all.min.css">
    <!-- IonIcons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="./assets/lte/dist/css/adminlte.min.css">
    <link rel="stylesheet" href="./assets/css/bootstrap.min.css">
    <link rel="shortcut icon" href="./favicon.ico" type="image/x-icon">

    <!-- DataTables -->
    <link rel="stylesheet" href="./assets/lte/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="./assets/lte/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="./assets/lte/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
    <link rel="stylesheet" href="./assets/css/aos.css">
    <link rel="stylesheet" href="./assets/lte/plugins/toastr/toastr.min.css">

    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
</head>
<style>
    * {
        font-family: 'Roboto', sans-serif;

    }

    body {
        background: url('./assets/img/bg (1).jpg');
        background-size: cover;
    }
</style>

<body class="bg-light">
    <!-- style=" background-color: #0d6efda6!important;" -->
    <nav class="">
        <span class="navbar-brand mx-2 text-info " style="font-family:timesnewroman;">
            <i class="text-info  fas fa-location-arrow"></i> zonifo
        </span>
        <a href="about.php" class="me-4 mt-2 text-info fs-6" style="float: right; text-decoration: none;">
            About
        </a>
        <h3 class="text-center "> ZONE EXPLORER</h3>
    </nav>
    <div class="p-5">

        <form id="find_form">
            <input type="hidden" name="for" value="find">
            <div class="d-flex">
                <!-- <label class="form-label" for="z_dis">District</label> -->
                <select class="form-select rounded-0 me-2 " aria-label="select" name="z_dis" id="z_dis">
                    <option selected hidden disabled>select your district</option>
                    <?php $z = $db->get_column('zones', 'district', true);
                    foreach ($z as $k) : ?>
                        <option value="<?= $k['district'] ?>"><?= $k['district'] ?></option>
                    <?php endforeach; ?>
                </select>
                <!-- <label class="form-label" for="z_dis">Village</label> -->
                <select class="form-select rounded-0 me-2" aria-label="select" name="z_vil" id="z_vil">
                    <option selected hidden disabled>village</option>

                </select>
                <!-- <label class="form-label" for="z_dis">Panchayat</label> -->
                <select class="form-select rounded-0 me-2" aria-label="select" name="z_pan" id="z_pan">
                    <option selected hidden disabled>panchayat</option>
                    <?php $z = $db->get_column('zones', 'panchayat', true);
                    foreach ($z as $k) : ?>
                        <option value="<?= $k['panchayat'] ?>"><?= $k['panchayat'] ?></option>
                    <?php endforeach; ?>
                </select>
                <!-- <label class="form-label" for="z_dis">Ward no.</label> -->
                <select class="form-select rounded-0 me-2" aria-label="select" name="z_war" id="z_war">
                    <option selected hidden disabled> ward no.</option>
                    <?php $z = $db->get_column('zones', 'ward_no', true);
                    foreach ($z as $k) : ?>
                        <option value="<?= $k['ward_no'] ?>"><?= $k['ward_no'] ?></option>
                    <?php endforeach; ?>
                </select>

                <!-- <button class="btn btn-primary" type="submit">Find</button> -->
            </div>
        </form>


        <!-- next sec -->
        <div class="mt-3 mb-5">


            <div class="row mt-5 mb-5">
                <div class="col-md-3 col-sm-6 col-12">
                    <div class="info-box bg-primary rounded-0">
                        <span class="info-box-icon"><i class="fas fa-user-injured"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Cases</span>
                            <span class="info-box-number" id="cas"> </span>

                            <!-- <div class="progress">
                                <div class="progress-bar" style="width: 70%"></div>
                            </div>
                            <span class="progress-description">
                                70% Increase in 30 Days
                            </span> -->
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->
                <div class="col-md-3 col-sm-6 col-12">
                    <div class="info-box bg-success rounded-0">
                        <span class="info-box-icon"><i class="far fa-thumbs-up"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Recovered</span>
                            <span class="info-box-number" id="rec"></span>

                            <!-- <div class="progress">
                                <div class="progress-bar" style="width: 70%"></div>
                            </div>
                            <span class="progress-description">
                                70% Increase in 30 Days
                            </span> -->
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->
                <div class="col-md-3 col-sm-6 col-12">
                    <div class="info-box bg-danger rounded-0">
                        <span class="info-box-icon "><i class="fas fa-procedures"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Critical</span>
                            <span class="info-box-number" id="cri"></span>

                            <!-- <div class="progress">
                                <div class="progress-bar" style="width: 70%"></div>
                            </div>
                            <span class="progress-description">
                                70% Increase in 30 Days
                            </span> -->
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->
                <div class="col-md-3 col-sm-6 col-12">
                    <div class="info-box bg-info  rounded-0">
                        <span class="info-box-icon"><i class="fas fa-thumbs-up"></i></span>

                        <div class="info-box-content ">
                            <span class="info-box-text">cases - recovered</span>
                            <span class="info-box-number" id="cas-rec"></span>

                            <!-- <div class="progress">
                                <div class="progress-bar" style="width: 70%"></div>
                            </div>
                            <span class="progress-description">
                                70% Increase in 30 Days
                            </span> -->
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->



            <div id="hos" class="p-5 mb-3 border " style="background-color: #065199b3!important;color:#fff;" data-aos="fade-right">
                <h4 class=" "> <i class="p-2 border fas  fa-clinic-medical"></i> Hospitals</h4>
                <table class="table table-hover   " style="display: none;" id="hos_table">
                    <thead>
                        <tr>
                            <th>SL no.</th>
                            <th>Name</th>
                            <th>Contact no.</th>
                            <th>Vacant Beds</th>
                            <th>Ventilators</th>
                            <th>Oxygen Cylinders</th>
                        </tr>
                    </thead>
                    <tbody id="hos_tbody">

                    </tbody>

                </table>
                <p class="text-center" id="no_data_hos"></p>
            </div>
            <div id="tes" class="p-5 mb-3 border " style="background-color: #065199b3!important;color:#fff;" data-aos="fade-left">
                <h4 class=" "> <i class="p-2 border fas fa-vials"></i> Testing centers</h4>
                <table class="table table-hover  " style="display: none;" id="tes_table">
                    <thead>
                        <tr>
                            <th>SL no.</th>
                            <th>Name</th>
                            <th>Contact no.</th>
                            <th>Kits</th>
                        </tr>
                    </thead>
                    <tbody id="tes_tbody">

                    </tbody>

                </table>

                <p class="text-center" id="no_data_tes"></p>
            </div>
            <div id="vac" class="p-5 mb-3 border " style="background-color: #065199b3!important;color:#fff;" data-aos="flip-right">
                <h4 class=" "> <i class="p-2 border  fas fa-syringe"></i> Vaccine centers</h4>
                <table class="table table-hover  " style="display: none;" id="vac_table">
                    <thead>
                        <tr>
                            <th>SL no.</th>
                            <th>Name</th>
                            <th>Contact no.</th>
                            <th>Vaccines left</th>
                        </tr>
                    </thead>
                    <tbody id="vac_tbody">

                    </tbody>

                </table>
                <p class="text-center" id="no_data_vac"></p>
            </div>
            <div id="mshops" class="p-5 mb-3 border " style="background-color: #065199b3!important;color:#fff;" data-aos="flip-left">
                <h4 class=" "> <i class="p-2 border fas fa-pills"></i> Medical Shops</h4>
                <table class="table table-hover  " style="display: none;" id="mshop_table">
                    <thead>
                        <tr>
                            <th>SL no.</th>
                            <th>Name</th>
                            <th>Contact no.</th>
                        </tr>
                    </thead>
                    <tbody id="mshop_tbody">

                    </tbody>

                </table>
                <p class="text-center" id="no_data_mshop"></p>
            </div>
            <!--<div id="info" class="p-4" style="background-color: cyan;color:#fff;"  data-aos="fade-right"></div> -->
            <div id="ambu" class="p-5 mb-3 border " style="background-color: #065199b3!important;color:#fff;" data-aos="fade-left">
                <h4 class=" "> <i class="p-2 border  fas fa-truck-moving"></i> Ambulances</h4>
                <table class="table table-hover  " style="display: none;" id="ambu_table">
                    <thead>
                        <tr>
                            <th>SL no.</th>
                            <th>Driver</th>
                            <th>Contact no.</th>
                        </tr>
                    </thead>
                    <tbody id="ambu_tbody">

                    </tbody>

                </table>
                <p class="text-center" id="no_data_ambu"></p>

            </div>

        </div>

        <table id="tester" class="table">

        </table>

    </div>
    <footer class="footer mt-auto py-3 ">
        <div class="container">
            <h6>MCA IGNOU <?= date('Y') ?>&copy; ZONIFO PROJECT </h6>
            <h6 class="text-muted">MOHAMMED SHABEER K</h6>
            <h6 class="text-muted">RUBAILA</h6>
        </div>
    </footer>
    <!-- jQuery -->
    <script src=" ./assets/lte/plugins/jquery/jquery.min.js">
    </script>
    <!-- Bootstrap -->
    <script src="./assets/lte/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- DataTables  & Plugins -->
    <script src="./assets/lte/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="./assets/lte/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="./assets/lte/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="./assets/lte/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
    <script src="./assets/lte/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
    <script src="./assets/lte/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>

    <script src="./assets/lte/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
    <script src="./assets/lte/plugins/datatables-buttons/js/buttons.print.min.js"></script>
    <script src="./assets/lte/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
    <script src="./assets/lte/plugins/toastr/toastr.min.js"></script>
    <!-- AdminLTE -->
    <!-- <script src="./assets/lte/dist/js/adminlte.js"></script> -->
    <!-- validate -->
    <script src="./assets/js/validator.js"></script>
    <script src="./assets/js/aos.js"></script>
    <script>
        AOS.init();
    </script>

    <script>
        toastr.options = {
            "closeButton": false,
            "debug": false,
            "newestOnTop": false,
            "progressBar": true,
            "positionClass": "toast-top-right",
            "preventDuplicates": false,
            "onclick": null,
            "showDuration": "300",
            "hideDuration": "1000",
            "timeOut": "5000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        }
        $(document).ready(function() {

            $("#z_vil").attr('disabled', true)
            $("#z_pan").attr('disabled', true)
            $("#z_war").attr('disabled', true)


        })
        // district
        $("#z_dis").on('change', (e) => {
            let dis = $("#z_dis").val()
            $.get({
                url: './controller/User.php',
                data: {
                    for: 'vil_data',
                    dist: dis
                },
                dataType: 'json',
                success: (r) => {
                    let str_out = `<option  selected hidden disabled >select villages of ${dis}  </option>`
                    r.dat.forEach((e, i) => {
                        str_out += `<option value="${e.village}">${e.village}</option>`
                    })

                    data_puller(r);

                    // $("#hos").html(`<h6>Hospitals</h6>${JSON.stringify(r.hos)}`)
                    // $("#tes").html(`<h6>Testing Centers</h6>${JSON.stringify(r.tcent)}`)
                    // $("#vac").html(`<h6>Vaccine Centers</h6>${JSON.stringify(r.vcent)}`)
                    // $("#mshops").html(`<h6>Medical shops </h6>${JSON.stringify(r.mshop)}`)
                    // $("#ambu").html(`<h6>Ambulances</h6>${JSON.stringify(r.ambu)}`)


                    $("#z_vil").attr('disabled', false)
                    $("#z_vil").html(str_out)
                },
                error: (r) => {
                    console.log('connection error');
                },

            })
        })
        //village
        $("#z_vil").on('change', (e) => {
            let vill = $("#z_vil").val()
            $.get({
                url: './controller/User.php',
                data: {
                    for: 'pan_data',
                    dist: $("#z_dis").val(),
                    vil: vill
                },
                dataType: 'json',
                success: (r) => {
                    let str_out = `<option  selected hidden disabled >select panchayats  of ${vill}  </option>`
                    r.dat.forEach((e, i) => {
                        str_out += `<option value="${e.panchayat}">${e.panchayat}</option>`
                    })


                    data_puller(r);

                    $("#z_pan").attr('disabled', false)
                    $("#z_pan").html(str_out)
                },
                error: (r) => {
                    console.log('connection error');
                },

            })
        })

        // panchayat
        $("#z_pan").on('change', (e) => {
            let pann = $("#z_pan").val()
            $.get({
                url: './controller/User.php',
                data: {
                    for: 'ward_data',
                    dist: $("#z_dis").val(),
                    vil: $("#z_vil").val(),
                    pan: pann
                },
                dataType: 'json',
                success: (r) => {
                    // console.log(r);
                    let str_out = `<option  selected hidden disabled >select wards of ${pann}  </option>`
                    r.dat.forEach((e, i) => {
                        str_out += `<option value="${e.ward_no}">${e.ward_no}</option>`
                    })


                    data_puller(r);

                    $("#z_war").attr('disabled', false)
                    $("#z_war").html(str_out)
                },
                error: (r) => {
                    console.log('connection error');
                },

            })
        })

        // ward_no
        $("#z_war").on('change', (e) => {
            let war_no = $("#z_war").val()
            $.get({
                url: './controller/User.php',
                data: {
                    for: 'final_data',
                    dist: $("#z_dis").val(),
                    vil: $("#z_vil").val(),
                    pan: $("#z_pan").val(),
                    war: war_no
                },
                dataType: 'json',
                success: (r) => {


                    data_puller(r);

                },
                error: (r) => {
                    console.log('connection error');
                },

            })
        })






        function data_puller(r) {
            $("#cas").text(r.cas)
            $("#rec").text(r.rec)
            $("#cri").text(r.cri)
            $("#cas-rec").text(Number(r.cas) - Number(r.rec))


            $("#hos_table").css('display', 'none')
            $("#tes_table").css('display', 'none')
            $("#vac_table").css('display', 'none')
            $("#mshop_table").css('display', 'none')
            $("#ambu_table").css('display', 'none')

            $("#no_data_hos").text('')
            $("#no_data_tes").text('')
            $("#no_data_vac").text('')
            $("#no_data_mshop").text('')
            $("#no_data_ambu").text('')

            if (typeof r.hos === 'object') {
                let hos_tbody = '';
                r.hos.forEach((e, i) => {
                    hos_tbody += ` 
                                <tr>
                                    <td>${i+1}</td>
                                    <td>${e.name}</td>
                                    <td>${e.contact_no}</td>
                                    <td>${e.vacant_beds}</td>
                                    <td>${e.ventilators}</td>
                                    <td>${e.oxygen_cylinders}</td>
                                </tr>
                             `;
                })


                $("#hos_tbody").html(hos_tbody)
                $("#hos_table").css('display', '')

            } else {
                $("#no_data_hos").text(`No Data `)
            }

            if (typeof r.tcent === 'object') {
                //tes
                let tes_tbody = '';
                r.tcent.forEach((e, i) => {
                    tes_tbody += ` 
                            <tr>
                                <td>${i+1}</td>
                                <td>${e.name}</td>
                                <td>${e.contact_no}</td>
                                <td>${e.kits}</td>
                            </tr>
                            `;
                })
                $("#tes_tbody").html(tes_tbody)
                $("#tes_table").css('display', '')
            } else {
                $("#no_data_tes").text(`No Data `)

            }
            if (typeof r.vcent === 'object') {
                //vac
                let vac_tbody = '';
                r.vcent.forEach((e, i) => {
                    vac_tbody += ` 
                        <tr>
                            <td>${i+1}</td>
                            <td>${e.name}</td>
                            <td>${e.contact_no}</td>
                            <td>${e.count}</td>
                        </tr>
                             `;
                })
                $("#vac_tbody").html(vac_tbody)
                $("#vac_table").css('display', '')
            } else {
                $("#no_data_vac").text(`No Data `)

            }

            if (typeof r.mshop === 'object') {
                // mshops
                let mshop_tbody = '';
                r.mshop.forEach((e, i) => {
                    mshop_tbody += ` 
                            <tr>
                                <td>${i+1}</td>
                                <td>${e.name}</td>
                                <td>${e.contact_no}</td>
                            </tr>
                        `;
                })
                $("#mshop_tbody").html(mshop_tbody)
                $("#mshop_table").css('display', '')
            } else {
                $("#no_data_mshop").text(`No Data `)

            }

            if (typeof r.ambu === 'object') {
                // ambs
                let ambu_tbody = '';
                r.ambu.forEach((e, i) => {
                    ambu_tbody += ` 
                            <tr>
                                    <td>${i+1}</td>
                                    <td>${e.driver}</td>
                                    <td>${e.mobile_no}</td>
                                </tr>
                            `;
                })

                $("#ambu_tbody").html(ambu_tbody)
                $("#ambu_table").css('display', '')

            } else {
                $("#no_data_ambu").text(`No Data `)

            }

            if (typeof r.info != 'undefined') {
                if (typeof r.info[0].infos != 'undefined') {
                    toastr.error(`${r.info[0].infos} untill ${r.info[0].date}`)
                }
            }

        }
    </script>
</body>

</html>