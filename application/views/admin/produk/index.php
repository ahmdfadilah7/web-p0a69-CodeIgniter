<div class="card">
    <div class="card-body">
        <h5 class="card-title fw-semibold mb-4">Produk</h5>
        <?php
            if ($this->session->flashdata('berhasil')) {
        ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <p><?= $this->session->flashdata('berhasil') ?></p>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php
            } elseif ($this->session->flashdata('gagal')) {
        ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <?php
                    foreach ($this->session->flashdata('gagal') as $row) {
                ?>
                    <p><?= $row ?></p>
                <?php
                    }
                ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php
            }
        ?>

        <a href="<?= site_url('admin/produk/add') ?>" class="btn btn-primary"><i class="ti ti-plus"></i></a>
        <div class="table-responsive mt-4">
            <table class="table" id="myTable">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Harga</th>
                        <th>Foto</th>
                        <th>Cabang</th>
                        <th>Deskripsi</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $no = 1;
                        foreach ($produk->result() as $row) {
                    ?>
                        <tr>
                            <td><?= $no ?></td>
                            <td><?= $row->nama ?></td>
                            <td><?= rupiah($row->harga) ?></td>
                            <td>
                                <img src="<?= base_url($row->foto) ?>" width="60">
                            </td>
                            <td><?= $row->cabang ?></td>
                            <td>
                                <?php
                                    if (strlen($row->deskripsi) > 50) {
                                        echo substr($row->deskripsi, 0, 50).'...';
                                    } else {
                                        echo $row->deskripsi;
                                    }
                                ?>
                            </td>
                            <td>
                                <a href="<?=base_url('admin/produk/edit/'.$row->id)?>" class="btn btn-primary btn-sm"><i class="ti ti-edit"></i></a>
                                <a href="<?=base_url('admin/produk/delete/'.$row->id)?>" class="btn btn-danger btn-sm"><i class="ti ti-trash"></i></a>
                            </td>
                        </tr>
                    <?php
                        $no++;
                        }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>