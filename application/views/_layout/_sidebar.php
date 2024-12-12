<aside class="main-sidebar">
    <section class="sidebar">
        <ul class="sidebar-menu">
            <li class="header">MENU</li>
            <li><a href="<?= base_url('home'); ?>"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>
            <li class="treeview">
                <a href="#"><i class="glyphicon glyphicon-th-list"></i> <span>Master Data</span><i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                    <li><a href="<?= base_url('kategori'); ?>"><i class="fa fa-circle-o"></i> Data Kategori</a></li>
                    <li><a href="<?= base_url('satuan'); ?>"><i class="fa fa-circle-o"></i> Data Satuan</a></li>
                </ul>
            </li>
            <li><a href="<?= base_url('produk') ?>"><i class="fa fa-cube"></i> <span>Produk</span></a></li>
            <li class="treeview">
                <a href="#"><i class="glyphicon glyphicon-th-list"></i> <span>Pembelian Barang</span><i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                    <li><a href="<?= base_url('supplier'); ?>"><i class="fa fa-circle-o"></i> Data Supplier</a></li>
                    <li><a href="<?= base_url('pembelian/tambah'); ?>"><i class="fa fa-circle-o"></i> Pembelian Baru</a></li>
                    <li><a href="<?= base_url('pembelian'); ?>"><i class="fa fa-circle-o"></i> Data Pembelian</a></li>
                </ul>
            </li>
            <li><a href="<?= base_url('users'); ?>"><i class="fa fa-user"></i> <span>Users</span></a></li>
            <li><a href="<?= base_url('home/logout'); ?>"><i class="fa fa-sign-out"></i> <span>Logout</span></a></li>
        </ul>
    </section>
</aside>