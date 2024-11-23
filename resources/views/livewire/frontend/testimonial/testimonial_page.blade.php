@extends('livewire.frontend.layouts.master')
@section('content')
    <!-- Page Header Start -->
    <div class="container-fluid page-header py-5 mb-5 wow fadeIn" data-wow-delay="0.1s">
        <div class="container text-center py-5">
            <h1 class="display-3 text-white mb-4 animated slideInDown">प्रशंसा पत्र</h1>
            <nav aria-label="breadcrumb animated slideInDown">
                <ol class="breadcrumb justify-content-center mb-0">
                    <li class="breadcrumb-item"><a href="#">होम पेज
                        </a></li>
                    <li class="breadcrumb-item"><a href="#">पेजहरू</a></li>
                    <li class="breadcrumb-item active" aria-current="page">प्रशंसा पत्र</li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- Page Header End -->


    <!-- Testimonial Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="text-center mx-auto wow fadeInUp" data-wow-delay="0.1s" style="max-width: 500px;">
                <p class="section-title bg-white text-center text-primary px-3">प्रशंसा पत्र</p>
                <h1 class="mb-5">हाम्रो डेरी फार्मको बारेमा मानिसहरूले के भन्छन्</h1>
            </div>
            <div class="row g-5 align-items-center">
                <div class="col-lg-5 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="testimonial-img">
                        <img class="img-fluid animated pulse infinite"
                            src="{{ asset('frontend_assets/img/testimonial-1.jpg') }}" alt="" loading="lazy">
                        <img class="img-fluid animated pulse infinite"
                            src="{{ asset('frontend_assets/img/testimonial-2.jpg') }}" alt="" loading="lazy">
                        <img class="img-fluid animated pulse infinite"
                            src="{{ asset('frontend_assets/img/testimonial-3.jpg') }}" alt="" loading="lazy">
                        <img class="img-fluid animated pulse infinite"
                            src="{{ asset('frontend_assets/img/testimonial-4.jpg') }}" alt="" loading="lazy">
                    </div>
                </div>
                <div class="col-lg-7 wow fadeInUp" data-wow-delay="0.5s">
                    <div class="owl-carousel testimonial-carousel">
                        <div class="testimonial-item">
                            <img class="img-fluid mb-3" src="{{ asset('frontend_assets/img/testimonial-1.jpg') }}" alt="" loading="lazy">
                            <p class="fs-5">हाम्रो डेरी फार्मको सेवाले हाम्रो व्यवसायलाई धेरै सहयोग पुर्यायो। यहाँको दुग्ध उत्पादन र हर्षित ग्राहकहरूको सन्तुष्टिले हामीलाई हर्षित बनायो। टीमको समर्पण र कडा परिश्रम स्पष्ट देखिन्छ र यसले हाम्रो विश्वासलाई थप मजबुत बनायो।</p>
                            <h5>राम बहादुर</h5>
                            <span class="text-primary">कृषक</span>
                        </div>
                        
                        <div class="testimonial-item">
                            <img class="img-fluid mb-3" src="{{ asset('frontend_assets/img/testimonial-2.jpg') }}" alt="" loading="lazy">
                            <p class="fs-5">हामीले यस डेरी फार्मसँगको सहयोगमा उच्च गुणस्तरको दुग्ध उत्पादन प्राप्त गरेका छौं। यहाँको ग्राहक सेवा अत्यधिक उत्कृष्ट छ र उत्पादकत्वमा लगातार सुधार भइरहेको छ। यस टीमको पेशेवर र समर्पित कार्यशैलीले हाम्रो व्यवसायमा ठूलो फरक पारेको छ।</p>
                            <h5>गीता कुमारी</h5>
                            <span class="text-primary">व्यवसायी</span>
                        </div>
                        
                        <div class="testimonial-item">
                            <img class="img-fluid mb-3" src="{{ asset('frontend_assets/img/testimonial-3.jpg') }}" alt="" loading="lazy">
                            <p class="fs-5">हामीले यस डेरी फार्मबाट अत्यधिक उच्च गुणस्तरको दूध प्राप्त गरेका छौं। यहाँको सेवालाई म धेरै मूल्यांकन गर्छु र सधैं यो टीमसँग काम गर्न चाहन्छु। त्यसको साथ, यस डेरी फार्मले हाम्रो समुदायमा सकारात्मक प्रभाव पारेको छ।</p>
                            <h5>रामकृष्ण शर्मा</h5>
                            <span class="text-primary">विक्रेत</span>
                        </div>
                        
                        <div class="testimonial-item">
                            <img class="img-fluid mb-3" src="{{ asset('frontend_assets/img/testimonial-4.jpg') }}" alt="" loading="lazy">
                            <p class="fs-5">यस डेरी फार्मसँगको अनुभव अत्यधिक सकारात्मक छ। यहाँको दूध उच्च गुणस्तरको छ र टीमले सधैं राम्रो ग्राहक सेवा प्रदान गर्छ। म सधैं यहाँको उत्पादन प्रयोग गर्न चाहन्छु र यो सबैलाई सिफारिस गर्दछु।</p>
                            <h5>स्मिता तामाङ</h5>
                            <span class="text-primary">खरीदार</span>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Testimonial End -->
@endsection
