<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $settings->nama_website ?> - ADMIN</title>
    <?php    
        if ($settings->favicon <> '') {
    ?>
    <link rel="shortcut icon" type="image/png" href="<?= base_url($settings->favicon) ?>" />
    <?php
        }
    ?>

    <!-- CSS -->
    <link rel="stylesheet" href="<?= base_url('assets/sistem/css/styles.min.css'); ?>" />
    <link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.css" />
    <!-- END CSS -->
    <style>
    .text-right {
        text-align: right !important;
    }
    </style>
</head>

<body>
    <!--  Body Wrapper -->
    <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
        data-sidebar-position="fixed" data-header-position="fixed">
        <!-- Sidebar Start -->
        <aside class="left-sidebar">
            <!-- Sidebar scroll-->
            <div>
                <div class="brand-logo d-flex align-items-center justify-content-between">
                    <a href="<?= site_url('admin/dashboard') ?>" class="text-nowrap logo-img">
                        <?php
                            if ($settings->logo <> '') {
                        ?>
                        <img src="<?= base_url($settings->logo) ?>" width="70" />
                        <?php
                            }
                        ?>
                    </a>
                    <div class="close-btn d-xl-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
                        <i class="ti ti-x fs-8"></i>
                    </div>
                </div>

                <!-- Sidebar Navigasi -->
                <?php include('partials/sidebar.php') ?>
                <!-- Sidebar Navigasi -->

            </div>
            <!-- End Sidebar scroll-->
        </aside>
        <!--  Sidebar End -->
        <!--  Main wrapper -->
        <div class="body-wrapper">
            <!--  Header Start -->
            <header class="app-header">
                <nav class="navbar navbar-expand-lg navbar-light">
                    <ul class="navbar-nav">
                        <li class="nav-item d-block d-xl-none">
                            <a class="nav-link sidebartoggler nav-icon-hover" id="headerCollapse"
                                href="javascript:void(0)">
                                <i class="ti ti-menu-2"></i>
                            </a>
                        </li>
                    </ul>
                    <div class="navbar-collapse justify-content-end px-0" id="navbarNav">
                        <ul class="navbar-nav flex-row ms-auto align-items-center justify-content-end">
                            <li class="nav-item dropdown">
                                <a class="nav-link " href="javascript:void(0)" id="drop2" data-bs-toggle="dropdown"
                                    aria-expanded="false">
                                    <span class="fs-4 fw-bold" style="margin-right: 10px">
                                        <?= $this->session->userdata('username') ?>
                                    </span>
                                    <?php
                                        if ($this->session->userdata('foto') <> '') {
                                    ?>
                                    <img src="<?= base_url($this->session->userdata('foto')) ?>" width="35" height="35"
                                        class="rounded-circle">
                                    <?php
                                        } else {
                                    ?>
                                    <img src="<?= base_url('assets/images/user-1.jpg') ?>" width="35" height="35"
                                        class="rounded-circle">
                                    <?php
                                        }
                                    ?>
                                </a>
                                <div class="dropdown-menu dropdown-menu-end dropdown-menu-animate-up"
                                    aria-labelledby="drop2">
                                    <div class="message-body">
                                        <a href="<?= site_url('auth/logout/'.$this->session->userdata('role')) ?>"
                                            class="btn btn-outline-primary mx-3 mt-2 d-block">Logout</a>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </nav>
            </header>
            <!--  Header End -->
            <div class="container-fluid">

                <!-- Content -->
                <?php $this->load->view($view) ?>
                <!-- END Content -->

            </div>
        </div>
    </div>

    <!-- Javascript -->
    <script src="<?= base_url('assets/sistem/libs/jquery/dist/jquery.min.js') ?>"></script>
    <script src="<?= base_url('assets/sistem/libs/bootstrap/dist/js/bootstrap.bundle.min.js') ?>"></script>
    <script src="<?= base_url('assets/sistem/js/sidebarmenu.js') ?>"></script>
    <script src="<?= base_url('assets/sistem/js/app.min.js') ?>"></script>
    <script src="<?= base_url('assets/sistem/libs/apexcharts/dist/apexcharts.min.js') ?>"></script>
    <script src="<?= base_url('assets/sistem/libs/simplebar/dist/simplebar.js') ?>"></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/38.1.1/classic/ckeditor.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <script src="<?= base_url('assets/sistem/js/dashboard.js') ?>"></script> 
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.js"></script>

    <!-- Javascript -->
    <script>
    <?php
        if ($this->session->flashdata('berhasil')) {
    ?>
    toastr.options = {
        "closeButton": true,
        "progressBar": true
    }
    toastr.success("<?= $this->session->flashdata('berhasil') ?>");
    <?php
        }
    ?>

    <?php
        if ($this->session->flashdata('gagal')) {
    ?>
    toastr.options = {
        "closeButton": true,
        "progressBar": true
    }
    <?php
        foreach ($this->session->flashdata('gagal') as $row) {
    ?>
    toastr.error("<?= $row ?>");
    <?php
        }
        }
    ?>
    
    ClassicEditor
        .create(document.querySelector('#editor'))
        .catch(error => {
            console.error(error);
        });

    let table = new DataTable('#myTable');
    
    <?php
        if ($this->uri->segment(2) == 'dashboard') {
    ?>
    var chart = {
        series: [
            {
                name: "Total Diproses",
                data: [
                    <?php
                        $tanggal = $this->db->query("SELECT * FROM invoice GROUP BY tanggal ORDER BY tanggal DESC LIMIT 5");
                        foreach ($tanggal->result() as $row) {
                            $jumlah_diproses = $this->db->query("SELECT * FROM invoice WHERE status = '1' AND tanggal = '$row->tanggal'")->num_rows();
                            echo $jumlah_diproses.',';
                        }    
                    ?>
                ]
            },
            {
                name: "Total Dikirim",
                data: [
                    <?php
                        foreach ($tanggal->result() as $row) {
                            $jumlah_dikirim = $this->db->query("SELECT * FROM invoice WHERE status = '2' AND tanggal = '$row->tanggal'")->num_rows();
                            echo $jumlah_dikirim.',';
                        }    
                    ?>
                ]
            },
            {
                name: "Total Selesai",
                data: [
                    <?php
                        foreach ($tanggal->result() as $row) {
                            $jumlah_selesai = $this->db->query("SELECT * FROM invoice WHERE status = '3' AND tanggal = '$row->tanggal'")->num_rows();
                            echo $jumlah_selesai.',';
                        }    
                    ?>
                ]
            },
        ],

        chart: {
            type: "bar",
            height: 345,
            offsetX: -15,
            toolbar: {
                show: false
            },
            foreColor: "#adb0bb",
            fontFamily: 'inherit',
            sparkline: {
                enabled: false
            },
        },


        colors: ["#5D87FF", "#ffae1f", "#53a336"],


        plotOptions: {
            bar: {
                horizontal: false,
                columnWidth: "35%",
                borderRadius: [6],
                borderRadiusApplication: 'end',
                borderRadiusWhenStacked: 'all'
            },
        },
        markers: {
            size: 0
        },

        dataLabels: {
            enabled: false,
        },


        legend: {
            show: false,
        },


        grid: {
            borderColor: "rgba(0,0,0,0.1)",
            strokeDashArray: 3,
            xaxis: {
                lines: {
                    show: false,
                },
            },
        },

        xaxis: {
            type: "category",
            categories: [
                <?php
                    foreach ($tanggal->result() as $row) {
                ?>
                "<?= $row->tanggal ?>",
                <?php
                    }
                ?>
            ],
            labels: {
                style: {
                    cssClass: "grey--text lighten-2--text fill-color"
                },
            },
        },


        yaxis: {
            show: true,
            min: 0,
            max: 30,
            tickAmount: 3,
            labels: {
                style: {
                    cssClass: "grey--text lighten-2--text fill-color",
                },
            },
        },
        stroke: {
            show: true,
            width: 3,
            lineCap: "butt",
            colors: ["transparent"],
        },


        tooltip: {
            theme: "light"
        },

        responsive: [{
            breakpoint: 600,
            options: {
                plotOptions: {
                    bar: {
                        borderRadius: 3,
                    }
                },
            }
        }]


    };

    var chart = new ApexCharts(document.querySelector("#chart"), chart);
    chart.render();

    var chart1 = {
        series: [
            {
                name: "Total Diproses",
                data: [
                    <?php
                        foreach ($cabang->result() as $row) {
                            $jumlah_diproses_cabang = $this->db->query("SELECT * FROM invoice JOIN transaksi ON transaksi.invoice_id=invoice.id JOIN produk ON transaksi.produk_id=produk.id WHERE invoice.status = '1' AND produk.cabang_id = '$row->id'")->num_rows();
                            echo $jumlah_diproses_cabang.',';
                        }    
                    ?>
                ]
            },
            {
                name: "Total Dikirim",
                data: [
                    <?php
                        foreach ($cabang->result() as $row) {
                            $jumlah_dikirim_cabang = $this->db->query("SELECT * FROM invoice JOIN transaksi ON transaksi.invoice_id=invoice.id JOIN produk ON transaksi.produk_id=produk.id WHERE invoice.status = '2' AND produk.cabang_id = '$row->id'")->num_rows();
                            echo $jumlah_dikirim_cabang.',';
                        }    
                    ?>
                ]
            },
            {
                name: "Total Selesai",
                data: [
                    <?php
                        foreach ($cabang->result() as $row) {
                            $jumlah_selesai_cabang = $this->db->query("SELECT * FROM invoice JOIN transaksi ON transaksi.invoice_id=invoice.id JOIN produk ON transaksi.produk_id=produk.id WHERE invoice.status = '3' AND produk.cabang_id = '$row->id'")->num_rows();
                            echo $jumlah_selesai_cabang.',';
                        }    
                    ?>
                ]
            },
        ],

        chart: {
            type: "bar",
            height: 345,
            offsetX: -15,
            toolbar: {
                show: false
            },
            foreColor: "#adb0bb",
            fontFamily: 'inherit',
            sparkline: {
                enabled: false
            },
        },


        colors: ["#5D87FF", "#ffae1f", "#53a336"],


        plotOptions: {
            bar: {
                horizontal: false,
                columnWidth: "35%",
                borderRadius: [6],
                borderRadiusApplication: 'end',
                borderRadiusWhenStacked: 'all'
            },
        },
        markers: {
            size: 0
        },

        dataLabels: {
            enabled: false,
        },


        legend: {
            show: false,
        },


        grid: {
            borderColor: "rgba(0,0,0,0.1)",
            strokeDashArray: 3,
            xaxis: {
                lines: {
                    show: false,
                },
            },
        },

        xaxis: {
            type: "category",
            categories: [
                <?php
                    foreach ($cabang->result() as $row) {
                ?>
                "<?= $row->nama ?>",
                <?php
                    }
                ?>
            ],
            labels: {
                style: {
                    cssClass: "grey--text lighten-2--text fill-color"
                },
            },
        },


        yaxis: {
            show: true,
            min: 0,
            max: 30,
            tickAmount: 3,
            labels: {
                style: {
                    cssClass: "grey--text lighten-2--text fill-color",
                },
            },
        },
        stroke: {
            show: true,
            width: 3,
            lineCap: "butt",
            colors: ["transparent"],
        },


        tooltip: {
            theme: "light"
        },

        responsive: [{
            breakpoint: 600,
            options: {
                plotOptions: {
                    bar: {
                        borderRadius: 3,
                    }
                },
            }
        }]


    };

    var chart1 = new ApexCharts(document.querySelector("#chart1"), chart1);
    chart1.render();

    <?php
        }
    ?>
    </script>
</body>

</html>