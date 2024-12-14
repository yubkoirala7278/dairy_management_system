@extends('livewire.admin.layouts.master')

@section('content')
    <div class="col-12 py-3">
        <div class="px-3 ">
            <div class="form-group">
                <label for="fixed_interest_rate" class="form-label h4 font-weight-bold text-dark">स्थिर ब्याज दर</label>
                <input type="number" class="form-control" id="fixed_interest_rate" wire:model.live.debounce.300ms="fixed_interest_rate"
                    placeholder="स्थिर ब्याज दर लेख्नुहोस्">
                @if ($errors->has('fixed_interest_rate'))
                    <span class="text-danger">{{ $errors->first('fixed_interest_rate') }}</span>
                @endif
            </div>
            <div class="form-group">
                <label for="compound_interest_rate" class="form-label h4 font-weight-bold text-dark">चक्रवृद्धि ब्याज दर</label>
                <input type="number" class="form-control" id="compound_interest_rate" wire:model.live.debounce.300ms="compound_interest_rate"
                    placeholder="चक्रवृद्धि ब्याज दर लेख्नुहोस्">
                @if ($errors->has('compound_interest_rate'))
                    <span class="text-danger">{{ $errors->first('compound_interest_rate') }}</span>
                @endif
            </div>
            <div class="form-group">
                <label for="tax_deduction_rate" class="form-label h4 font-weight-bold text-dark">कर कटौती दर</label>
                <input type="number" class="form-control" id="tax_deduction_rate" wire:model.live.debounce.300ms="tax_deduction_rate"
                    placeholder="कर कटौती दर लेख्नुहोस्">
                @if ($errors->has('tax_deduction_rate'))
                    <span class="text-danger">{{ $errors->first('tax_deduction_rate') }}</span>
                @endif
            </div>
            <button class="btn btn-success" wire:click="register">पेश
                गर्नुहोस्</button>
        </div>
    </div>
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
