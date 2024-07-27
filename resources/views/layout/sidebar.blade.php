<nav id="sidebar">
    <div class="sidebar_blog_1">
        <div class="sidebar-header">
            <div class="logo_section">
                <a href="index.html"><img class="logo_icon img-responsive" src="images/logo/logo_icon.png"
                        alt="#" /></a>
            </div>
        </div>
        <div class="sidebar_user_info">
            <div class="icon_setting"></div>
            <div class="user_profle_side">
                <div class="user_img"><img class="img-responsive" src="images/layout_img/user_img.jpg" alt="#" />
                </div>
                <div class="user_info">
                    <h6>John David</h6>
                    <p><span class="online_animation"></span> Online</p>
                </div>
            </div>
        </div>
    </div>
    <div class="sidebar_blog_2">
        <h4>General</h4>
        <ul class="list-unstyled components">

            <li class="active"><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard yellow_color"></i>
                    <span>Dashboard</span></li>
            <li>
                <a href="{{ route('kategori.index') }}"><i
                        class="fa fa-folder-open orange_color"></i><span>Kategori</span></a>
            </li>
            <li>
                <a href="{{ route('supplier.index') }}"><i
                        class="fa fa-truck orange_color"></i><span>Supplier</span></a>
            </li>
            <li>
                <a href="{{ route('gudang.index') }}"><i class="fa fa-building orange_color"></i>
                    <span>Gudang</span></a>
            </li>
            <li>
                <a href="{{ route('pembelian.index') }}"><i class="fa fa-calculator green_color"></i>
                    <span>Pembelian</span></a>
            </li>
            <li>
                <a href="{{ route('penjualan.index') }}"><i class="fa fa-shopping-cart blue2_color"></i>
                    <span>Penjualan</span></a>
            </li>

            <li class="active">
                <a href="#additional_page" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><i
                        class="fa fa-clone red_color"></i> <span>Report</span></a>
                <ul class="collapse list-unstyled" id="additional_page">
                    <li>
                        <a href="{{ route('report.pembelian') }}">> <span>Report Pembelian</span></a>
                    </li>
                    <li>
                        <a href="{{ route('report.penjualan') }}">> <span>Report Penjualan</span></a>
                    </li>
                </ul>
            </li>

            <li><a href="settings.html"><i class="fa fa-cog yellow_color"></i> <span>User Management</span></a>
            </li>
        </ul>
    </div>
</nav>
