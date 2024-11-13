@extends('livewire.frontend.layouts.master')
@section('content')
    <!-- Page Header Start -->
    <div class="container-fluid page-header py-5 mb-5 wow fadeIn" data-wow-delay="0.1s">
        <div class="container text-center py-5">
            <h1 class="display-3 text-white mb-4 animated slideInDown">विशेषताहरू</h1>
            <nav aria-label="breadcrumb animated slideInDown">
                <ol class="breadcrumb justify-content-center mb-0">
                    <li class="breadcrumb-item"><a href="#">होम पेज
                    </a></li>
                    <li class="breadcrumb-item"><a href="#">पेजहरू</a></li>
                    <li class="breadcrumb-item active" aria-current="page">विशेषताहरू</li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- Page Header End -->


    <!-- Features Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="row g-5 align-items-center">
                <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.1s">
                    <p class="section-title bg-white text-start text-primary pe-3">हाम्रो विशेषता!</p>
                    <h1 class="mb-4">केही कारणहरू किन मानिसहरू हामीलाई रोज्छन्!</h1>
                    <p class="mb-4">हाम्रो डेरी फार्मले ताजा, स्वस्थ र प्राकृतिक उत्पादनहरू उपलब्ध गराउँछ। हामी उच्च गुणस्तरीय सेवा र ग्राहक सन्तुष्टिलाई पहिलो प्राथमिकता दिन्छौं। हाम्रो टोलीले स्वास्थ्यकर, स्वादिष्ट र पूर्ण रूपमा शुद्ध दूध उत्पादन गर्न समर्पित छ।</p>
                    <p><i class="fa fa-check text-primary me-3"></i>पूर्ण रूपमा ताजा र प्राकृतिक उत्पादनहरू</p>
                    <p><i class="fa fa-check text-primary me-3"></i>स्वस्थ र उच्च गुणस्तरको दूध उत्पादन</p>
                    <p><i class="fa fa-check text-primary me-3"></i>पर्यावरणमैत्री र सुरक्षित उत्पादन प्रक्रिया</p>
                    <a class="btn btn-secondary rounded-pill py-3 px-5 mt-3" href="">थप पढ्नुहोस्</a>
                </div>
                
                <div class="col-lg-6">
                    <div class="rounded overflow-hidden">
                        <div class="row g-0">
                            <div class="col-sm-6 wow fadeIn" data-wow-delay="0.1s">
                                <div class="text-center bg-primary py-5 px-4">
                                    <img class="img-fluid mb-4" src="{{ asset('frontend_assets/img/experience.png') }}"
                                        alt="">
                                    <h1 class="display-6 text-white" data-toggle="counter-up">25</h1>
                                    <span class="fs-5 fw-semi-bold text-secondary">वर्षको अनुभव</span>
                                </div>
                            </div>
                            <div class="col-sm-6 wow fadeIn" data-wow-delay="0.3s">
                                <div class="text-center bg-secondary py-5 px-4">
                                    <img class="img-fluid mb-4" src="{{ asset('frontend_assets/img/award.png') }}"
                                        alt="">
                                    <h1 class="display-6" data-toggle="counter-up">183</h1>
                                    <span class="fs-5 fw-semi-bold text-primary">पुरस्कार विजेता</span>
                                </div>
                            </div>
                            <div class="col-sm-6 wow fadeIn" data-wow-delay="0.5s">
                                <div class="text-center bg-secondary py-5 px-4">
                                    <img class="img-fluid mb-4" src="{{ asset('frontend_assets/img/animal.png') }}"
                                        alt="">
                                    <h1 class="display-6" data-toggle="counter-up">2619</h1>
                                    <span class="fs-5 fw-semi-bold text-primary">कुल जनावरहरू</span>
                                </div>
                            </div>
                            <div class="col-sm-6 wow fadeIn" data-wow-delay="0.7s">
                                <div class="text-center bg-primary py-5 px-4">
                                    <img class="img-fluid mb-4" src="{{ asset('frontend_assets/img/client.png') }}"
                                        alt="">
                                    <h1 class="display-6 text-white" data-toggle="counter-up">51940</h1>
                                    <span class="fs-5 fw-semi-bold text-secondary">सन्तुष्ट ग्राहकहरू</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Features End -->
@endsection
