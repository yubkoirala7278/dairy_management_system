@extends('livewire.frontend.layouts.master')
@section('content')

    <!-- Page Header Start -->
    <div class="container-fluid page-header py-5 mb-5 wow fadeIn" data-wow-delay="0.1s">
        <div class="container text-center py-5">
            <h1 class="display-3 text-white mb-4 animated slideInDown">हाम्रो बारेमा</h1>
            <nav aria-label="breadcrumb animated slideInDown">
                <ol class="breadcrumb justify-content-center mb-0">
                    <li class="breadcrumb-item"><a href="#">होम पेज
                    </a></li>
                    <li class="breadcrumb-item"><a href="#">पेजहरू</a></li>
                    <li class="breadcrumb-item active" aria-current="page">हाम्रो बारेमा</li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- Page Header End -->


    <!-- About Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="row g-5 align-items-end">
                <div class="col-lg-6">
                    <div class="row g-2">
                        <div class="col-6 position-relative wow fadeIn" data-wow-delay="0.7s">
                            <div class="about-experience bg-secondary rounded">
                                <h1 class="display-1 mb-0">२५</h1>
<small class="fs-5 fw-bold">वर्षको अनुभव</small>
                            </div>
                        </div>
                        <div class="col-6 wow fadeIn" data-wow-delay="0.1s">
                            <img class="img-fluid rounded" src="{{asset('frontend_assets/img/service-1.jpg')}}">
                        </div>
                        <div class="col-6 wow fadeIn" data-wow-delay="0.3s">
                            <img class="img-fluid rounded" src="{{asset('frontend_assets/img/service-2.jpg')}}">
                        </div>
                        <div class="col-6 wow fadeIn" data-wow-delay="0.5s">
                            <img class="img-fluid rounded" src="{{asset('frontend_assets/img/service-3.jpg')}}">
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 wow fadeIn" data-wow-delay="0.5s">
                    <p class="section-title bg-white text-start text-primary pe-3">हाम्रो बारेमा</p>
                    <h1 class="mb-4">हाम्रो डेरी फार्म र इतिहासको बारेमा जान्नुहोस्</h1>
                    <p class="mb-4">समय बित्दै गएको छ। दुख र खुशीको अनगिन्ती अनुभवले हामीलाई अझ बलियो बनाएको छ। हाम्रो डेरी फार्मले परिश्रम र सच्चाइका साथ उन्नति गर्दै आएको छ, र हामी निरन्तर आफ्नो परंपरा र इतिहासमा गर्व गर्छौं।</p>                    
                    <div class="row g-5 pt-2 mb-5">
                        <div class="col-sm-6">
                            <img class="img-fluid mb-4" src="{{asset('frontend_assets/img/service.png')}}" alt="">
                            <h5 class="mb-3">समर्पित सेवा</h5>
                            <span>हाम्रो सेवा साँचो समर्पण र कसमसँग भरिएको छ, जसले तपाईंलाई उत्कृष्टता र विश्वासको अनुभव दिन्छ।</span>
                            
                        </div>
                        <div class="col-sm-6">
                            <img class="img-fluid mb-4" src="{{asset('frontend_assets/img/product.png')}}" alt="">
                            <h5 class="mb-3">कार्गिक उत्पादनहरू</h5>
                            <span>हाम्रो उत्पादनहरू 100% प्राकृतिक र स्वास्थ्यको लागि उपयुक्त छन्, जुन तपाईंको जीवनशैलीलाई स्वच्छ र सस्तो बनाउँछन्।</span>
                            
                        </div>
                    </div>
                    <a class="btn btn-secondary rounded-pill py-3 px-5" href="">अधिक हेर्नुहोस्</a>

                </div>
            </div>
        </div>
    </div>
    <!-- About End -->


    <!-- Banner Start -->
    <div class="container-fluid banner my-5 py-5" data-parallax="scroll" data-image-src="{{asset('frontend_assets/img/banner.jpg')}}">
        <div class="container py-5">
            <div class="row g-5">
                <div class="col-lg-6 wow fadeIn" data-wow-delay="0.3s">
                    <div class="row g-4 align-items-center">
                        <div class="col-sm-4">
                            <img class="img-fluid rounded" src="{{asset('frontend_assets/img/banner-1.jpg')}}" alt="">
                        </div>
                        <div class="col-sm-8">
                            <h2 class="text-white mb-3">हामी सर्वोत्तम डेरी उत्पादनहरू बेच्दछौं</h2>
                            <p class="text-white mb-4">हाम्रो उत्पादनहरूमा उच्च गुणस्तर र स्वादको संगम छ, जुन तपाईंको स्वास्थ्यको लागि लाभकारी छ।</p>
                            <a class="btn btn-secondary rounded-pill py-2 px-4" href="">अधिक पढ्नुहोस्</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 wow fadeIn" data-wow-delay="0.5s">
                    <div class="row g-4 align-items-center">
                        <div class="col-sm-4">
                            <img class="img-fluid rounded" src="{{asset('frontend_assets/img/banner-2.jpg')}}" alt="">
                        </div>
                        <div class="col-sm-8">
                            <h2 class="text-white mb-3">हामी विश्वभर ताजे दूध पुर्याउँछौं</h2>
                            <p class="text-white mb-4">हाम्रो दूध सधैं ताजै र गुणस्तरीय हुन्छ, जसले तपाईंको स्वास्थ्यलाई लाभ पुर्याउँछ।</p>
                            <a class="btn btn-secondary rounded-pill py-2 px-4" href="">अधिक पढ्नुहोस्</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Banner End -->


    <!-- Team Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="text-center mx-auto wow fadeInUp" data-wow-delay="0.1s" style="max-width: 500px;">
                <p class="section-title bg-white text-center text-primary px-3">अनुभवी सदस्यहरू</p>
                <h1 class="mb-5">अनुभवी टिम सदस्यहरू</h1>
            </div>
            <div class="row g-4">
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="team-item rounded p-4">
                        <img class="img-fluid rounded mb-4" src="{{asset('frontend_assets/img/team-1.jpg')}}" alt="">
                        <h5>राम प्रसाद श्रेष्ठ</h5>
                        <p class="text-primary">संस्थापक</p>
                        <div class="d-flex justify-content-center">
                            <a class="btn btn-square btn-outline-secondary rounded-circle mx-1" href=""><i
                                    class="fab fa-facebook-f"></i></a>
                            <a class="btn btn-square btn-outline-secondary rounded-circle mx-1" href=""><i
                                    class="fab fa-twitter"></i></a>
                            <a class="btn btn-square btn-outline-secondary rounded-circle mx-1" href=""><i
                                    class="fab fa-instagram"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.3s">
                    <div class="team-item rounded p-4">
                        <img class="img-fluid rounded mb-4" src="{{asset('frontend_assets/img/team-2.jpg')}}" alt="">
                        <h5>दोरीस जोर्डन</h5>
                        <p class="text-primary">पशु चिकित्सक</p>
                        <div class="d-flex justify-content-center">
                            <a class="btn btn-square btn-outline-secondary rounded-circle mx-1" href=""><i
                                    class="fab fa-facebook-f"></i></a>
                            <a class="btn btn-square btn-outline-secondary rounded-circle mx-1" href=""><i
                                    class="fab fa-twitter"></i></a>
                            <a class="btn btn-square btn-outline-secondary rounded-circle mx-1" href=""><i
                                    class="fab fa-instagram"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.5s">
                    <div class="team-item rounded p-4">
                        <img class="img-fluid rounded mb-4" src="{{asset('frontend_assets/img/team-3.jpg')}}" alt="">
                        <h5>ज्याक डावसन</h5>
<p class="text-primary">किसान</p>

                        <div class="d-flex justify-content-center">
                            <a class="btn btn-square btn-outline-secondary rounded-circle mx-1" href=""><i
                                    class="fab fa-facebook-f"></i></a>
                            <a class="btn btn-square btn-outline-secondary rounded-circle mx-1" href=""><i
                                    class="fab fa-twitter"></i></a>
                            <a class="btn btn-square btn-outline-secondary rounded-circle mx-1" href=""><i
                                    class="fab fa-instagram"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Team End -->


    @endsection