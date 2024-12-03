@extends('livewire.frontend.layouts.master')
@section('content')
    <!-- Page Header Start -->
    <div class="container-fluid page-header py-5 mb-5 wow fadeIn" data-wow-delay="0.1s">
        <div class="container text-center py-5">
            <h1 class="display-3 text-white mb-4 animated slideInDown">किसान प्रोफाइल</h1>
            <nav aria-label="breadcrumb animated slideInDown">
                <ol class="breadcrumb justify-content-center mb-0">
                    <li class="breadcrumb-item"><a href="#">होम पेज</a></li>
                    <li class="breadcrumb-item"><a href="#">प्रोफाइल</a></li>
                    <li class="breadcrumb-item active" aria-current="page">किसान प्रोफाइल</li>
                </ol>
            </nav>
        </div>
    </div>

    <!-- Page Header End -->

    <!-- Product Start -->
    <div class="container-xxl py-5" wire:ignore.self>
        <div class="container">
            <div class="text-center mx-auto wow fadeInUp" data-wow-delay="0.1s" style="max-width: 500px;">
                <p class="section-title bg-white text-center text-primary px-3">हाम्रो उत्पादनहरू</p>
                <h1 class="mb-5">स्वस्थ जीवनको लागि हाम्रा डेरी र अन्य उत्पादनहरू</h1>
            </div>
            <div class="row gx-4" style="row-gap: 20px">
                <div class="col wow fadeInUp" data-wow-delay="0.1s">
                    {{-- profile --}}
                    <!-- Breadcrumb -->
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">होम पृष्ठ</a></li>
                <li class="breadcrumb-item"><a href="#">प्रोफाइल</a></li>
                <li class="breadcrumb-item active" aria-current="page">माझो प्रोफाइल</li>
            </ol>
        </nav>

        <!-- Tab Navigation -->
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
                <a class="nav-link active" id="profile-tab" data-bs-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="true">माझो प्रोफाइल</a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link" id="orders-tab" data-bs-toggle="tab" href="#orders" role="tab" aria-controls="orders" aria-selected="false">मेरो अर्डर</a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link" id="password-tab" data-bs-toggle="tab" href="#password" role="tab" aria-controls="password" aria-selected="false">पासवर्ड परिवर्तन</a>
            </li>
        </ul>

        <!-- Tab Content -->
        <div class="tab-content mt-4" id="myTabContent">
            <!-- My Profile Tab -->
            <div class="tab-pane fade show active" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                <div class="card">
                    <div class="card-header">
                        <h5>माझो प्रोफाइल</h5>
                    </div>
                    <div class="card-body">
                        <form>
                            <div class="mb-3">
                                <label for="name" class="form-label">नाम</label>
                                <input type="text" class="form-control" id="name" value="जन डो" readonly>
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">इमेल</label>
                                <input type="email" class="form-control" id="email" value="john.doe@example.com" readonly>
                            </div>
                            <div class="mb-3">
                                <label for="phone" class="form-label">फोन नम्बर</label>
                                <input type="text" class="form-control" id="phone" value="+977 9800000000" readonly>
                            </div>
                            <div class="mb-3">
                                <label for="address" class="form-label">ठेगाना</label>
                                <input type="text" class="form-control" id="address" value="काठमाडौं, नेपाल" readonly>
                            </div>
                            <div class="mb-3">
                                <label for="balance" class="form-label">हालको ब्यालेन्स</label>
                                <input type="text" class="form-control" id="balance" value="रु. 5000" readonly>
                            </div>
                            <div class="mb-3">
                                <label for="due" class="form-label">बाकी रकम</label>
                                <input type="text" class="form-control" id="due" value="रु. 1000" readonly>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- My Orders Tab -->
            <div class="tab-pane fade" id="orders" role="tabpanel" aria-labelledby="orders-tab">
                <div class="card">
                    <div class="card-header">
                        <h5>मेरो अर्डर</h5>
                    </div>
                    <div class="card-body">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>अर्डर नम्बर</th>
                                    <th>किनिएको मिति</th>
                                    <th>स्थिति</th>
                                    <th>कुल रकम</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>#12345</td>
                                    <td>2024-12-01</td>
                                    <td>पठाइएको</td>
                                    <td>रु. 2000</td>
                                </tr>
                                <tr>
                                    <td>#12346</td>
                                    <td>2024-11-25</td>
                                    <td>वितरित</td>
                                    <td>रु. 1500</td>
                                </tr>
                                <tr>
                                    <td>#12347</td>
                                    <td>2024-11-20</td>
                                    <td>पेंडिङ</td>
                                    <td>रु. 750</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Change Password Tab -->
            <div class="tab-pane fade" id="password" role="tabpanel" aria-labelledby="password-tab">
                <div class="card">
                    <div class="card-header">
                        <h5>पासवर्ड परिवर्तन</h5>
                    </div>
                    <div class="card-body">
                        <form>
                            <div class="mb-3">
                                <label for="new-password" class="form-label">नयाँ पासवर्ड</label>
                                <input type="password" class="form-control" id="new-password" placeholder="नयाँ पासवर्ड राख्नुहोस्">
                            </div>
                            <div class="mb-3">
                                <label for="confirm-password" class="form-label">नयाँ पासवर्ड पुष्टिकरण</label>
                                <input type="password" class="form-control" id="confirm-password" placeholder="पासवर्ड पुन: राख्नुहोस्">
                            </div>
                            <button type="submit" class="btn btn-primary">पासवर्ड परिवर्तन गर्नुहोस्</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
                    {{-- end profile --}}
                </div>
            </div>
        </div>
    </div>
@endsection

@section('custom-style')
<style>
     .nav-tabs .nav-link {
            border: 1px solid #ccc;
            border-radius: 25px;
            margin-right: 10px;
            padding: 15px 20px;
            font-size: 18px;
            font-weight: 600;
            color: #007bff;
            transition: all 0.3s ease;
        }

        .nav-tabs .nav-link.active {
            background-color: #007bff;
            color: #fff;
            border-radius: 25px;
        }

        .tab-content {
            padding: 30px;
            background: #fff;
            border-radius: 15px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            margin-top: 30px;
        }

        .card-header {
            background-color: #007bff;
            color: white;
            font-size: 20px;
            font-weight: bold;
            padding: 15px;
            border-radius: 10px 10px 0 0;
        }

        .form-control, .btn {
            border-radius: 10px;
            padding: 12px;
            font-size: 16px;
        }

        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
            color: white;
            font-weight: bold;
        }

        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #0056b3;
        }

        /* Responsive Styles */
        @media (max-width: 767px) {
            .nav-tabs .nav-link {
                font-size: 16px;
                padding: 12px;
            }

            .tab-content {
                padding: 20px;
            }
        }

        .breadcrumb {
            background-color: transparent;
            margin-bottom: 0;
        }

        /* Table Styling */
        .table th, .table td {
            vertical-align: middle;
            font-size: 16px;
            text-align: center;
        }

        .table th {
            background-color: #f2f2f2;
        }
</style>
@endsection
