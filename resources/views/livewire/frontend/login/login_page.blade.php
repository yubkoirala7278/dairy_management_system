@extends('livewire.frontend.layouts.master')
@section('content')
    <!-- Page Header Start -->
    <div class="container-fluid page-header py-5 mb-5 wow fadeIn" data-wow-delay="0.1s" wire:ignore>
        <div class="container text-center py-5">
            <h1 class="display-3 text-white mb-4 animated slideInDown">लगिन</h1>
            <nav aria-label="breadcrumb animated slideInDown">
                <ol class="breadcrumb justify-content-center mb-0">
                    <li class="breadcrumb-item"><a href="#">होम पेज
                        </a></li>
                    <li class="breadcrumb-item"><a href="#">लगिन</a></li>
                    <li class="breadcrumb-item active" aria-current="page">लगिन</li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- Page Header End -->



    <!-- Product Start -->
    <div class="container-xxl py-5" wire:ignore.self>
        <div class="container">
            <div class="text-center mx-auto wow fadeInUp" data-wow-delay="0.1s" style="max-width: 500px;">
                <h3 class="section-title bg-white text-center text-primary px-3">लगिन</h3>
                <p class="mb-5">कृपया आफ्नो विवरण सही रूपमा प्रविष्ट गर्नुहोस्।</p>
            </div>
            <div class="row justify-content-center mt-4">
                <div class="col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="card shadow-sm border-0">
                        <div class="card-body p-4">
                            <form>
                                <div class="mb-4">
                                    <label for="farmer_number" class="form-label text-primary fw-bold">किसान नम्बर</label>
                                    <input type="text" class="form-control form-control-lg translate-nepali" id="farmer_number" wire:model="farmer_number" placeholder="किसान नम्बर लेख्नुहोस्">
                                    @if ($errors->has('farmer_number'))
                                        <span class="text-danger small">{{ $errors->first('farmer_number') }}</span>
                                    @endif
                                </div>
                                <div class="mb-4">
                                    <label for="password" class="form-label text-primary fw-bold">पासवर्ड</label>
                                    <input type="password" class="form-control form-control-lg" id="password" wire:model="password" placeholder="पासवर्ड लेख्नुहोस्">
                                    @if ($errors->has('password'))
                                        <span class="text-danger small">{{ $errors->first('password') }}</span>
                                    @endif
                                </div>
                                <div class="d-grid">
                                    <button type="button" class="btn btn-success btn-lg fw-bold" wire:click="login">पेश गर्नुहोस्</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    {{-- <p class="text-center mt-3">
                        <a href="#" class="text-primary text-decoration-none">पासवर्ड भुल्नुभयो?</a>
                    </p> --}}
                </div>
            </div>
        </div>
        
    </div>
    <!-- Product End -->
@endsection

@section('modal')
@endsection

@push('script')
<script>
    document.addEventListener('livewire:init', () => {
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
            });

        });
    });
</script>
@endpush
