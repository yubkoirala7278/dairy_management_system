<!DOCTYPE html>
<html lang="ne">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>
        आदर्श डेरी
        </title>

    <!-- vendor css -->
    <link href="{{ asset('backend_assets/lib/fontawesome-free/css/all.min.css') }}" rel="stylesheet">
    <link href="{{ asset('backend_assets/lib/ionicons/css/ionicons.min.css') }}" rel="stylesheet">
    <link href="{{ asset('backend_assets/lib/typicons.font/typicons.css') }}" rel="stylesheet">
    <link href="{{ asset('backend_assets/lib/flag-icon-css/css/flag-icon.min.css') }}" rel="stylesheet">
    <!-- azia CSS -->
    <link rel="stylesheet" href="{{ asset('backend_assets/css/azia.css') }}">
    <link rel="stylesheet" href="{{ asset('backend_assets/css/style.css') }}">
    {{-- sweet alert --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://unpkg.com/nepalify"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
        integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    @toastifyCss
    <style>
        body {
            /* background-color: #FFF2D7; */
            /* background-color: #E4EA8C; */
            background-color: #eee;
        }
    </style>

</head>

<body>

    <div class="az-header" wire:ignore>
        <div class="container">
            <div class="az-header-left">
                <a href="" class="az-logo"><span style="color: #32705f">आदर्श डेरी</span> 
                    
                    </a>
                <a href="" id="azMenuShow" class="az-header-menu-icon d-lg-none"><span></span></a>
            </div><!-- az-header-left -->
            <div class="az-header-menu">
                <div class="az-header-menu-header">
                    <a href="" class="az-logo"><span></span> <img
                            src="{{ asset('backend_assets/img/logo.png') }}" alt="" height="35"></a>
                    <a href="" class="close">&times;</a>
                </div><!-- az-header-menu-header -->
                <ul class="nav">
                    <li class="nav-item {{ $page == 'dashboard' ? 'active' : '' }}">
                        <a href="{{ route('admin.home') }}" class="nav-link" id="dashboard-link">
                            <i class="typcn typcn-chart-area-outline"></i>
                            ड्यासबोर्ड
                        </a>
                    </li>
                    <li class="nav-item {{ $page == 'farmer' ? 'active' : '' }}">
                        <a href="" class="nav-link with-sub" id="farmer-link">
                            <i class="typcn typcn-document"></i> किसान
                        </a>
                        <nav class="az-menu-sub">
                            <a href="{{ route('admin.farmer.milk.deposit') }}" class="nav-link"
                                id="deposit-milk-link">दूध संकलन</a>
                            <a href="{{ route('admin.farmer.create') }}" class="nav-link"
                                id="create-farmer-link">कृषक दर्ता</a>
                                <a href="{{ route('admin.setup') }}" class="nav-link"
                                id="setup-link">सेटअप</a>
                                <a href="{{ route('admin.setup') }}" class="nav-link"
                                id="setup-link">दूध संकलन रिपोर्ट</a>
                        </nav>
                    </li>
                </ul>
            </div><!-- az-header-menu -->
            <div class="az-header-right">
                <a href="https://www.bootstrapdash.com/demo/azia-free/docs/documentation.html" target="_blank"
                    class="az-header-search-link"><i class="far fa-file-alt"></i></a>
                <a href="" class="az-header-search-link"><i class="fas fa-search"></i></a>
                <div class="az-header-message">
                    <a href="#"><i class="typcn typcn-messages"></i></a>
                </div><!-- az-header-message -->
                <div class="dropdown az-header-notification">
                    <a href="" class="new"><i class="typcn typcn-bell"></i></a>
                    <div class="dropdown-menu">
                        <div class="az-dropdown-header mg-b-20 d-sm-none">
                            <a href="" class="az-header-arrow"><i class="icon ion-md-arrow-back"></i></a>
                        </div>
                        <h6 class="az-notification-title">Notifications</h6>
                        <p class="az-notification-text">You have 2 unread notification</p>
                        <div class="az-notification-list">
                            <div class="media new">
                                <div class="az-img-user"><img src="{{ asset('backend_assets/img/faces/face2.jpg') }}"
                                        alt=""></div>
                                <div class="media-body">
                                    <p>Congratulate <strong>Socrates Itumay</strong> for work anniversaries</p>
                                    <span>Mar 15 12:32pm</span>
                                </div><!-- media-body -->
                            </div><!-- media -->
                            <div class="media new">
                                <div class="az-img-user online"><img
                                        src="{{ asset('backend_assets/img/faces/face3.jpg') }}" alt="">
                                </div>
                                <div class="media-body">
                                    <p><strong>Joyce Chua</strong> just created a new blog post</p>
                                    <span>Mar 13 04:16am</span>
                                </div><!-- media-body -->
                            </div><!-- media -->
                            <div class="media">
                                <div class="az-img-user"><img src="{{ asset('backend_assets/img/faces/face4.jpg') }}"
                                        alt=""></div>
                                <div class="media-body">
                                    <p><strong>Althea Cabardo</strong> just created a new blog post</p>
                                    <span>Mar 13 02:56am</span>
                                </div><!-- media-body -->
                            </div><!-- media -->
                            <div class="media">
                                <div class="az-img-user"><img src="{{ asset('backend_assets/img/faces/face5.jpg') }}"
                                        alt=""></div>
                                <div class="media-body">
                                    <p><strong>Adrian Monino</strong> added new comment on your photo</p>
                                    <span>Mar 12 10:40pm</span>
                                </div><!-- media-body -->
                            </div><!-- media -->
                        </div><!-- az-notification-list -->
                        <div class="dropdown-footer"><a href="">View All Notifications</a></div>
                    </div><!-- dropdown-menu -->
                </div><!-- az-header-notification -->
               
                <div class="dropdown az-profile-menu">
                    <a href="" class="az-img-user"><img
                            src="{{ asset('backend_assets/img/faces/face5.jpg') }}" alt=""></a>
                    <div class="dropdown-menu">
                        <div class="az-dropdown-header d-sm-none">
                            <a href="" class="az-header-arrow"><i class="icon ion-md-arrow-back"></i></a>
                        </div>
                        <div class="az-header-profile">
                            <div class="az-img-user">
                                <img src="{{ asset('backend_assets/img/faces/face5.jpg') }}" alt="">
                            </div><!-- az-img-user -->
                            <h6>Aziana Pechon</h6>
                            <span>Premium Member</span>
                        </div><!-- az-header-profile -->

                        <a href="" class="dropdown-item"><i class="typcn typcn-user-outline"></i> My
                            Profile</a>
                        <a href="" class="dropdown-item"><i class="typcn typcn-edit"></i> Edit Profile</a>
                        <a href="" class="dropdown-item"><i class="typcn typcn-time"></i> Activity
                            Logs</a>
                        <a href="" class="dropdown-item"><i class="typcn typcn-cog-outline"></i> Account
                            Settings</a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST"
                            style="display: none;">
                            @csrf
                        </form>

                        <a href="#" class="dropdown-item"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class="typcn typcn-power-outline"></i> Sign Out
                        </a>

                    </div><!-- dropdown-menu -->
                </div>
            </div><!-- az-header-right -->
        </div><!-- container -->
    </div><!-- az-header -->

    <div class="az-content az-content-dashboard pt-0 pb-0">
        <div class="az-content-body " style="overflow-x:hidden">
            <div class="row ">
                @yield('content')
            </div><!-- row -->
        </div><!-- az-content-body -->
    </div><!-- az-content -->

    <div wire:ignore>

    <script src="{{ asset('backend_assets/lib/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('backend_assets/lib/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('backend_assets/lib/ionicons/ionicons.js') }}"></script>
    <script src="{{ asset('backend_assets/lib/jquery.flot/jquery.flot.js') }}"></script>
    <script src="{{ asset('backend_assets/lib/jquery.flot/jquery.flot.resize.js') }}"></script>
    <script src="{{ asset('backend_assets/lib/chart.js/Chart.bundle.min.js') }}"></script>
    <script src="{{ asset('backend_assets/lib/peity/jquery.peity.min.js') }}"></script>

    <script src="{{ asset('backend_assets/js/azia.js') }}"></script>
    <script src="{{ asset('backend_assets/js/chart.flot.sampledata.js') }}"></script>
    <script src="{{ asset('backend_assets/js/dashboard.sampledata.js') }}"></script>
    <script src="{{ asset('backend_assets/lib/jquery-steps/lib/jquery.cookie-1.3.1.js') }}" type="text/javascript">
    </script>

    @stack('script')

    {{-- language switcher --}}
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const inputs = document.querySelectorAll('.translate-nepali');

        inputs.forEach(input => {
            input.addEventListener('input', function(event) {
                translateToNepali(this);
            });
        });
    });

    function translateToNepali(input) {
        const options = {
            layout: "traditional",
        };

        // Preserve the decimal point in the value
        let translatedValue = '';
        for (let char of input.value) {
            if (char === '.') {
                translatedValue += char; // Keep the decimal point as is
            } else {
                translatedValue += nepalify.format(char, options); // Convert other characters to Nepali
            }
        }

        // Update the input with the translated value
        input.value = translatedValue;
    }
</script>
</div>
<script>
    document.addEventListener('livewire:init', () => {
        // ========success message============
            Livewire.on('success', (event) => {
                Swal.fire({
                    title: "जानकारी",
                    text: event.title,
                    icon: "success",
                    iconColor: "#28a745", // Use a green color to match success theme
                    background: "#f9f9f9",
                    color: "#333", // Darker text color for readability
                    showConfirmButton: true,
                    confirmButtonColor: "#4CAF50", // Custom green button
                    confirmButtonText: "ठीक छ",
                    customClass: {
                        popup: "swal-custom-popup",
                        title: "swal-custom-title",
                        confirmButton: "swal-custom-button"
                    },
                    didOpen: () => {
                        // Adding a custom animation for the icon
                        document.querySelector('.swal2-icon.swal2-success').classList.add(
                            'swal-animate-icon');
                    }
                }).then(() => {
                    document.getElementById('farmernumber').focus();
                });

            });
            // =============error message=============
            Livewire.on('error', (event) => {
                toastify().error(event.title);
            });
            // =========warning message============
            Livewire.on('warningMessage', (event) => {
                Swal.fire({
                    title: "<span style='color: #c0392b; font-weight: bold;'>⚠️ चेतावनी!</span>",
                    html: `<strong style='font-size: 18px; color: #4a4a4a;'>${event.title}</strong>`,
                    icon: "warning",
                    iconColor: "#c0392b", 
                    background: "#fff7e6",
                    showCloseButton: true,
                    confirmButtonText: "<span style='font-weight: bold; font-size: 16px;'>ठीक छ</span>",
                    buttonsStyling: false,
                    customClass: {
                        confirmButton: "custom-confirm-button"
                    }
                });
            });
        });
</script>


    @toastifyJs


</body>

</html>
