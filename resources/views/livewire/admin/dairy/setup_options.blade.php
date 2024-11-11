@extends('livewire.admin.layouts.master')

@section('content')
<div class="col-12 py-3">
    <div class="px-3 ">
            <div class="form-group">
                <label for="gov_snf" class="form-label h4 font-weight-bold text-dark">सरकार द्वारा दूधको एस.एन.एफ</label>
                <input type="number" class="form-control" id="gov_snf"
                    wire:model.live.debounce.300ms="gov_snf" placeholder="सरकार द्वारा दूधको एस.एन.एफ लेख्नुहोस्">
                @if ($errors->has('gov_snf'))
                    <span class="text-danger">{{ $errors->first('gov_snf') }}</span>
                @endif
            </div>
            <div class="form-group">
                <label for="gov_fat" class="form-label h4 font-weight-bold text-dark">सरकार द्वारा दूधको फ्याट</label>
                <input type="number" class="form-control" id="gov_fat"
                    wire:model.live.debounce.300ms="gov_fat" placeholder="सरकार द्वारा दूधको फ्याट लेख्नुहोस्">
                @if ($errors->has('gov_fat'))
                    <span class="text-danger">{{ $errors->first('gov_fat') }}</span>
                @endif
            </div>
            <button class="btn btn-success" wire:click="register">पेश
                गर्नुहोस्</button>
    </div>
</div>
@endsection
@push('script')

@endpush
