<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title><?= $settings->nama_website ?></title>

    <!-- icon -->
    <link rel="icon" href="<?= base_url($settings->logo) ?>" />

    <!-- font awesome -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

    <!-- css -->
    <link rel="stylesheet" href="<?=base_url('assets')?>/css/style.css" />
</head>

<body>
    <!-- header start -->
    <header class="navbar">
        <div class="brand"><a href="<?=base_url()?>" style="text-decoration: none; color: white;"><?= $settings->nama_website ?></a></div>
        <div class="search">
            <form action="<?= site_url('home/pencarian') ?>" method="get">
                <input type="text" name="keyword" placeholder="Pencarian" />
                <i class="fas fa-search fa-xl" style="color: #7a7a7a"></i>
            </form>
        </div>
        <nav>
            <ul>
                <li><a href="<?= site_url() ?>" id="home-link">Home</a></li>
                <li><a href="<?= site_url('pesanan') ?>" id="pesanan-link">Pesanan</a></li>
                <li><a href="<?= site_url('keranjang') ?>" id="keranjang-link">Keranjang</a></li>
                <?php
                    if ($this->session->userdata('status_pelanggan') <> 'login') {
                ?>
                    <li id="login-link"><a href="<?= site_url('auth/login') ?>">Login</a></li>
                <?php
                    } else {
                ?>
                    <li><a href="<?= site_url('auth/logout/'.$this->session->userdata('role_pelanggan')) ?>">Logout</a></li>
                <?php
                    }
                ?>
            </ul>
        </nav>
        <i class="fa-solid fa-bars" style="color: #667793"></i>
        <div class="navbar-popup"></div>
    </header>
    <!-- header end -->
    <!-- content start -->
    <?php
        $this->load->view($view);
    ?>
    <!-- content end -->
    <?php
        if ($this->uri->segment(1) <> 'auth') {
    ?>
    <!-- footer start -->
    <footer>
        <div class="row">
            <div class="col-md-4 col-sm-12">
                <div class="contact-text">Contact Us</div>
                <div class="mt-4">
                    <?= $settings->alamat ?>
                    <p class="mt-4"><i class="fa fa-envelope"></i> <?= $settings->email ?></p>
                    <p class="mt-4"><i class="fa fa-phone"></i> <?= $settings->no_telp ?></p>
                </div>
                <div class="social-icons">
                    <!-- Ganti link "your-social-media" dengan link sosial media Anda -->
                    <a href="<?= $settings->facebook ?>" target="_blank"><i class="fab fa-facebook social-icon"></i></a>
                    <a href="<?= $settings->twitter ?>" target="_blank"><i class="fab fa-twitter social-icon"></i></a>
                    <a href="<?= $settings->instagram ?>" target="_blank"><i class="fab fa-instagram social-icon"></i></a>
                    <a href="<?= $settings->youtube ?>" target="_blank"><i class="fab fa-youtube social-icon"></i></a>
                </div>
            </div>
            <div class="col-md-8 col-sm-12">
                <div class="contact-text">Google Map</div>
                <div class="mt-4">
                    <embed width="100%" height="200px" src="<?= $settings->google_map ?>">
                </div>
            </div>
        </div>
        <div class="copyright">&copy; <?= $settings->nama_website ?> 2023</div>
    </footer>
    <!-- footer end -->
    <?php
        }
    ?>

    <!-- Modal -->
    <div class="modal fade" id="addcartModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Tambah Keranjang</h1>
                    <button type="button" id="modalClose" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="<?= site_url('keranjang/store') ?>" method="post">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-4">
                                    <label for="" class="form-label pb-1">Nama</label>
                                    <input type="hidden" name="produk_id" id="produkId">
                                    <input type="text" name="nama_produk" class="form-control" id="namaProduk" readonly>
                                </div>
                                <div class="mb-4">
                                    <label for="" class="form-label pb-1">Harga (Rp)</label>
                                    <div class="input-group">
                                        <span class="input-group-text" id="basic-addon1">Rp</span>
                                        <input type="number" name="harga_produk" class="form-control" id="hargaProduk" aria-describedby="basic-addon1" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-12">
                                <div class="mb-4">
                                    <label for="" class="form-label pb-1">Jumlah</label>
                                    <div class="input-group quantity mx-auto">
                                        <div class="input-group-btn">
                                            <button type="button" class="btn btn-sm btn-primary btn-minus" >
                                            <i class="fa fa-minus"></i>
                                            </button>
                                        </div>
                                        <input type="text" name="jumlah" id="jumlah" class="form-control form-control-sm border-0 text-center" value="0">
                                        <div class="input-group-btn">
                                            <button type="button" class="btn btn-sm btn-primary btn-plus">
                                                <i class="fa fa-plus"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-8 col-sm-12">
                                <div class="mb-4">
                                    <label for="" class="form-label pb-1">Total (Rp)</label>
                                    <div class="input-group">
                                        <span class="input-group-text" id="basic-addon1">Rp</span>
                                        <input type="number" name="total" class="form-control" id="totalProduk" aria-describedby="basic-addon1" readonly>
                                    </div>
                                </div>
                            </div>
                        </div>                    
                </div>
                <div class="modal-footer">
                        <button type="button" id="modalClose1" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Tambah Keranjang</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="pembayaranModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Pembayaran</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="<?= site_url('keranjang/proses_pembayaran') ?>" method="post" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-4">
                                    <label for="" class="form-label pb-1">Kode Invoice</label>
                                    <input type="hidden" name="invoice_id" class="form-control" id="invoiceId" readonly>
                                    <input type="text" name="kode_invoice" class="form-control" id="kodeInvoice" readonly>
                                </div>
                                <div class="mb-2">
                                    <label for="" class="form-label">Pengiriman</label>
                                    <select name="pengiriman" id="pengiriman" class="form-select" onchange="myPengiriman()">
                                        <option value="0">- Pilih -</option>
                                        <?php
                                            foreach ($ongkir->result() as $row) {
                                        ?>
                                            <option value="<?= $row->id ?>"><?= $row->kurir.' - '.$row->layanan.' - '.rupiah($row->ongkos) ?></option>
                                        <?php
                                            }
                                        ?>
                                    </select>
                                </div>
                                <div class="mb-4">
                                    <label for="" class="form-label pb-1">Total (Rp)</label>
                                    <div class="input-group">
                                        <span class="input-group-text" id="basic-addon1">Rp</span>
                                        <input type="number" name="total" class="form-control" id="totalInvoice" aria-describedby="basic-addon1" readonly>
                                    </div>
                                </div>
                                <div class="mb-4">
                                    <label for="" class="form-label">Metode Pembayaran</label>
                                    <select name="metode_pembayaran" id="pembayaran" onchange="metodePembayaran()" class="form-select">
                                        <option value="">- Pilih Metode Pembayaran -</option>
                                        <option value="COD">COD</option>
                                        <?php
                                            foreach ($rekening->result() as $row) {
                                        ?>
                                            <option value="<?= $row->bank.' - '.$row->nama_rekening.' - '.$row->no_rekening ?>"><?= $row->bank.' - '.$row->nama_rekening.' - '.$row->no_rekening ?></option>
                                        <?php
                                            }
                                        ?>
                                    </select>
                                </div>
                                <div class="mb-4" id="buktiPembayaran" style="display:none;">
                                    <label for="" class="form-label">Bukti Pembayaran</label>
                                    <div class="input-group">
                                        <input type="file" name="bukti_pembayaran" class="form-control" id="inputGroupFile02">
                                    </div>
                                </div>
                            </div>
                            
                        </div>                    
                </div>
                <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Proses</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <script>
    <?php
        if ($this->session->flashdata('berhasil')) {
    ?>
    toastr.options =
    {
        "closeButton" : true,
        "progressBar" : true,
        "positionClass": "toast-bottom-right",
    }
    toastr.success("<?= $this->session->flashdata('berhasil') ?>");
    <?php
        }
    ?>

<?php
        if ($this->session->flashdata('warning')) {
    ?>
    toastr.options =
    {
        "closeButton" : true,
        "progressBar" : true,
        "positionClass": "toast-bottom-right",
    }
    toastr.warning("<?= $this->session->flashdata('warning') ?>");
    <?php
        }
    ?>
    
    <?php
        if ($this->session->flashdata('gagal')) {
    ?>
    toastr.options =
        {
            "closeButton" : true,
            "progressBar" : true,
            "positionClass": "toast-bottom-right",
        }
    <?php
        foreach ($this->session->flashdata('gagal') as $row) {
    ?>
        toastr.error("<?= $row ?>");
    <?php
        }
        }
    ?>

    function myPengiriman() {
        var id = document.getElementById('pengiriman').value;
        var id2 = document.getElementById('invoiceId').value;
        var url = "<?= base_url('keranjang/pengiriman/') ?>"+id+'/'+id2;
        $.ajax({
            url: url,
            type: 'GET',
            dataType: 'json',
            success: function(data) {
                    $('#totalInvoice').val(data.total);
            }
        });
    }

    function get_order(id) {
        var url = "<?=base_url('home/get_produk/')?>"+id
        $.ajax({
            url: url,
            type: 'GET',
            dataType: 'json',
            success: function(data) {
                $('#addcartModal').modal('show')
                $('#produkId').val(data.id)
                $('#namaProduk').val(data.nama)
                $('#hargaProduk').val(data.harga)
            }
        });
    };

    function metodePembayaran() {
        var metode = document.getElementById('pembayaran').value;
        if (metode != 'COD' && metode != '') {
            document.getElementById('buktiPembayaran').style.display = 'block';
        } else {
            document.getElementById('buktiPembayaran').style.display = 'none';
        }
    };

    function pembayaran(id) {
        var url = "<?= base_url('keranjang/pembayaran/') ?>"+id
        $.ajax({
            url: url,
            type: 'GET',
            dataType: 'json',
            success: function (data) {
                $('#pembayaranModal').modal('show')
                $('#invoiceId').val(data.invoice_id)
                $('#kodeInvoice').val(data.kode_invoice)
                $('#totalInvoice').val(data.total)
            }
        });
    };

    $('.quantity button').on('click', function () {
        var button = $(this);
        var oldValue = button.parent().parent().find('input').val();
        if (button.hasClass('btn-plus')) {
            var plus = parseFloat(oldValue) + 1;
            var newVal = plus
        } else {
            if (oldValue > 0) {
                var newVal = parseFloat(oldValue) - 1;
            } else {
                newVal = 0;
            }
        }
        var price = $('#hargaProduk').val();
        var quantity = newVal;
        var total = parseInt(price)*parseInt(quantity);
        $('#totalProduk').val(total);
        button.parent().parent().find('input').val(newVal);
    });

    document.getElementById("modalClose").addEventListener("click", function(){
        $('#jumlah').val(0);
        $('#totalProduk').val(0);
    });

    document.getElementById("modalClose1").addEventListener("click", function(){
        $('#jumlah').val(0);
        $('#totalProduk').val(0);
    });


    // handle menu start
    let menuIcon = document.querySelector(".fa-bars");
    let menuContainer = document.querySelector(".navbar-popup");
    let searchContainer = document.querySelector(".search");
    let searchInput = document.querySelector(".search input[type='text']");
    let searchIcon = document.querySelector(".search i");
    let navList = document.querySelector("nav ul");
    let visible = false;

    menuIcon.addEventListener("click", () => {
        if (visible) {
            menuContainer.classList.remove("show");
            visible = false;
            searchContainer.style.display = "none";
            searchInput.style.display = "none";
            searchIcon.style.display = "none";
            navList.style.display = "none";
        } else {
            visible = true;
            menuContainer.classList.add("show");
            searchContainer.style.display = "flex";
            searchInput.style.display = "flex";
            searchIcon.style.display = "block";
            navList.style.display = "block";
        }
    });
    // handle menu end

    
    </script>
</body>

</html>