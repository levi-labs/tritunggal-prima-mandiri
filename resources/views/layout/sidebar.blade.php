<nav id="sidebar">
    <div class="sidebar_blog_1">
        <div class="sidebar-header">
            {{-- <div class="logo_section">
                <a href="{{ route('dashboard') }}"><img class="logo_icon img-responsive"
                        src="{{ asset('assets/logo.webp') }}" alt="logo" /></a>
            </div> --}}
        </div>
        <div class="sidebar_user_info">
            <div class="icon_setting"></div>
            <div class="user_profle_side">

                <div class="user_info">
                    <h6>{{ Auth::user()->nama }}</h6>
                    <p><span class="online_animation"></span> {{ Auth::user()->role }}</p>
                </div>
            </div>
        </div>
    </div>
    <div class="sidebar_blog_2">
        <h4>General</h4>
        <ul class="list-unstyled components">

            <li class="active"><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard yellow_color"></i>
                    <span>Dashboard</span></li>

            @if (Auth::user()->role == 'administrator')
                <li>
                    <a href="{{ route('kategori.index') }}"><i
                            class="fa fa-folder-open orange_color"></i><span>Kategori</span></a>
                </li>
                <li>
                    <a href="{{ route('supplier.index') }}"><i
                            class="fa fa-truck orange_color"></i><span>Supplier</span></a>
                </li>
            @endif

            @if (Auth::user()->role == 'administrator' || Auth::user()->role == 'gudang')
                <li>
                    <a href="{{ route('gudang.index') }}"><i class="fa fa-building orange_color"></i>
                        <span>Gudang</span></a>
                </li>
            @endif

            @if (Auth::user()->role == 'administrator' || Auth::user()->role == 'pembelian')
                <li>
                    <a href="{{ route('pembelian.index') }}"><i class="fa fa-calculator green_color"></i>
                        <span>Pembelian</span></a>
                </li>
            @endif

            @if (Auth::user()->role == 'administrator' || Auth::user()->role == 'gudang')
                <li>
                    <a href="{{ route('pembelian.index.gudang') }}"><i class="fa fa-calculator green_color"></i>
                        <span>Daftar Item Gudang</span></a>
                </li>
            @endif


            @if (Auth::user()->role == 'administrator' || Auth::user()->role == 'penjualan')
                <li>
                    <a href="{{ route('penjualan.index') }}"><i class="fa fa-shopping-cart blue2_color"></i>
                        <span>Penjualan</span></a>
                </li>
            @endif

            @if (Auth::user()->role == 'administrator' || Auth::user()->role == 'pembelian' || Auth::user()->role == 'penjualan')
                <li class="active">
                    <a href="#additional_page" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><i
                            class="fa fa-clone red_color"></i> <span>Report</span></a>
                    <ul class="collapse list-unstyled" id="additional_page">
                        @if (Auth::user()->role == 'pembelian' || Auth::user()->role == 'administrator')
                            <li>
                                <a href="{{ route('report.pembelian') }}">> <span>Report Pembelian</span></a>
                            </li>
                        @endif
                        @if (Auth::user()->role == 'penjualan' || Auth::user()->role == 'administrator')
                            <li>
                                <a href="{{ route('report.penjualan') }}">> <span>Report Penjualan</span></a>
                            </li>
                        @endif
                    </ul>
                </li>
            @endif

            @if (Auth::user()->role == 'administrator')
                <li><a href="{{ route('user.index') }}"><i class="fa fa-cog yellow_color"></i> <span>User
                            Management</span></a>
                </li>
            @endif

            <li><a href="{{ route('user.change-password') }}"><i class="fa fa-lock yellow_color"></i> <span>Ubah
                        Password</span></a>
            </li>


        </ul>
    </div>
</nav>
