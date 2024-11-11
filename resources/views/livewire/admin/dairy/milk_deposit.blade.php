@extends('livewire.admin.layouts.master')

@section('content')
    <div class="col-12 col-sm-12 mb-4 mb-lg-0 col-lg-4 py-3" style="background-color: #32705f;height:100vh">
        <div class="row">
            <div class="col-12">
                <div class="mx-3 d-flex align-items-center " style=" column-gap: 30px;">
                    <div class="form-group">
                        <label for="milk_type" class="form-label h4 font-weight-bold">दूधको प्रकार</label>
                        <select class="form-control" wire:model.live="milk_type" id="milk_type">
                            <option value="मिश्रित">मिश्रित दूध</option>
                            <option value="गाईको">गाईको दूध</option>
                            <option value="भैंसीको">भैंसीको दूध</option>
                            <option value="बाख्राको">बाख्राको दूध</option>
                            <option value="भेडाको">भेडाको दूध</option>
                        </select>
                        @error('milk_type')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="milk_deposit_date" class="form-label h4 font-weight-bold">दूध सङ्कलन मिति</label>
                        <input type="text" name="date" id="milk_deposit_date" class="py-1"
                            wire:model.live="milk_deposit_date">
                        <br>
                        @error('milk_deposit_date')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="milk_deposit_time" class="form-label h4 font-weight-bold">प्रहर</label>
                        <select class="form-control" wire:model.live="milk_deposit_time" id="milk_deposit_time">
                            <option value="बिहान">बिहान</option>
                            <option value="साझ">साझ</option>
                        </select>
                        @error('milk_deposit_time')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-6">
                <div class="ml-3 ">
                    <div class="form-group">
                        <label for="farmernumber" class="form-label h4 font-weight-bold">कृषक नम्बर</label>
                        <input type="text" class="form-control translate-nepali" id="farmernumber"
                            wire:model.live.debounce.300ms="farmernumber" placeholder="कृषकको नम्बर लेख्नुहोस्" autofocus>
                        @if ($errors->has('farmernumber'))
                            <span class="text-danger">{{ $errors->first('farmernumber') }}</span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="milkQuantity" class="form-label h4 font-weight-bold">दुध (लि.)</label>
                        <input type="number" class="form-control" id="milkQuantity" wire:model.live="milkQuantity"
                            placeholder="दुधको मात्रा लेख्नुहोस्">
                        @if ($errors->has('milkQuantity'))
                            <span class="text-danger">{{ $errors->first('milkQuantity') }}</span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="milk_fat" class="form-label h4 font-weight-bold">फ्याट</label>
                        <input type="number" class="form-control" id="milk_fat" wire:model.live="milk_fat"
                            placeholder="दुधको फ्याट लेख्नुहोस्">
                        @if ($errors->has('milk_fat'))
                            <span class="text-danger">{{ $errors->first('milk_fat') }}</span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="milk_snf" class="form-label h4 font-weight-bold">एस.एन.एफ</label>
                        <input type="number" class="form-control " id="milk_snf" wire:model.live="milk_snf"
                            placeholder="दुधको एस.एन.एफ लेख्नुहोस्">
                        @if ($errors->has('milk_snf'))
                            <span class="text-danger">{{ $errors->first('milk_snf') }}</span>
                        @endif
                    </div>
                </div>
            </div>

            <div class="col-12 col-lg-6">
                <div class="form-group">
                    <label for="owner_name" class="form-label h4 font-weight-bold">सदस्यको नाम</label>
                    <input type="text" class="form-control translate-nepali" id="owner_name" wire:model="owner_name"
                        disabled>
                    @error('owner_name')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="location" class="form-label h4 font-weight-bold">सदस्यको ठेगाना</label>
                    <input type="text" class="form-control translate-nepali" id="location" wire:model="location"
                        disabled>
                    @error('location')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="phone_number" class="form-label h4 font-weight-bold">सदस्यको फोन नम्बर</label>
                    <input type="text" class="form-control translate-nepali" id="phone_number" wire:model="phone_number"
                        disabled>
                    @error('phone_number')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

            </div>
            <div class="col-12">
                <div class="d-flex align-items-center mx-3" style="column-gap: 20px">
                    <div class="form-group">
                        <label for="per_litre_commission" class="form-label h4 font-weight-bold">प्र.लि.
                            कमिशन</label>
                        <input type="number" class="form-control" id="per_litre_commission"
                            wire:model.live="per_litre_commission">
                        @error('per_litre_commission')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="per_litre_price" class="form-label h4 font-weight-bold">प्रति लि.(रु.)</label>
                        <input type="number" class="form-control" id="per_litre_price" wire:model="per_litre_price"
                            disabled>
                        @error('per_litre_price')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="total_milk_price" class="form-label h4 font-weight-bold">कुल रकम(रु.)</label>
                        <input type="number" class="form-control " id="total_milk_price" wire:model="total_milk_price"
                            disabled>
                        @error('total_milk_price')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="mx-3">
                    <button class="btn btn-success mr-2" wire:click.prevent="register" style="font-size: 19px">पेश
                        गर्नुहोस्</button>
                    <button class="btn btn-secondary " style="font-size: 19px">हटाउनुहोस्</button>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12 col-lg-8" style="background-color: #eee;">
        <div class="custom-overflow-x" style=" max-width: 100%;">
            {{-- <div class="mx-4 py-2 d-flex align-items-center justify-content-end" style="column-gap: 5px">
                <span class="font-weight-bold">Export:</span>
                <button type="button" class="btn btn-secondary px-3 radius-30 btn-flex" style="border-radius: 30px;">PDF</button>
                <button type="button" class="btn btn-secondary px-3 btn-flex" style="border-radius: 30px;">Excel</button>
            </div> --}}
            <div class="d-md-flex justify-content-between align-items-center mx-4 py-2">
                <div>
                    <label>प्रदर्शन गर्नुहोस्
                        <select name="withdraw-request-list_length" aria-controls="withdraw-request-list"
                            class="form-select form-select-sm" wire:model.live.debounce.500ms="entries">
                            <option value="10">१०</option>
                            <option value="25">२५</option>
                            <option value="50">५०</option>
                            <option value="100">१००</option>
                            <option value="all">सबै</option>
                        </select>
                        डेटा
                    </label>

                </div>
                <div class="d-flex align-items-center" style="column-gap: 20px">
                    <input type="search" class="form-control form-control-sm translate-nepali"
                        placeholder="खोज्नुहोस्..." aria-controls="withdraw-request-list"
                        wire:model.live.debounce.500ms="search">
                    <div class="d-flex align-items-center" style="column-gap: 5px">
                        <button type="button" class="btn btn-secondary px-3 radius-30 btn-flex"
                            style="border-radius: 30px;" wire:click="exportMilkDepositsToPdf">PDF</button>
                        {{-- <button type="button" class="btn btn-secondary px-3 btn-flex" style="border-radius: 30px;" wire:click="exportToExcel">Excel</button> --}}
                    </div>
                </div>

            </div>
            <table class="table table-bordered table-hover ml-4" style="font-size: 20px; min-width: 800px; width: 100%;">
                <thead>
                    <tr class="table-secondary">
                        {{-- <th scope="col" style="font-size: 20px; white-space: nowrap;">मिति</th> --}}
                        <th scope="col" style="font-size: 20px; white-space: nowrap;">कृ.न.</th>
                        <th scope="col" style="font-size: 20px; white-space: nowrap;">कृषक नाम</th>
                        <th scope="col" style="font-size: 20px; white-space: nowrap;">प्रकार</th>
                        <th scope="col" style="font-size: 20px; white-space: nowrap;">दूध लि.</th>
                        <th scope="col" style="font-size: 20px; white-space: nowrap;">FAT</th>
                        <th scope="col" style="font-size: 20px; white-space: nowrap;">SNF</th>
                        {{-- <th scope="col" style="font-size: 20px; white-space: nowrap;">मूल्य</th> --}}
                        {{-- <th scope="col" style="font-size: 20px; white-space: nowrap;">कुल कमिशन</th> --}}
                        <th scope="col" style="font-size: 20px; white-space: nowrap;">प्र.लि</th>
                        <th scope="col" style="font-size: 20px; white-space: nowrap;">जम्मा</th>
                    </tr>
                </thead>
                <tbody>
                    @if (count($milkDeposits) > 0)
                        @foreach ($milkDeposits as $key => $deposit)
                            <tr wire:key="{{ $key }}">
                                {{-- <td>{{$deposit->milk_deposit_date}}</td> --}}
                                <td>{{ $deposit->user->farmer_number }}</td>
                                <td>{{ $deposit->user->owner_name }}</td>
                                <td>{{ $deposit->milk_type }}</td>
                                <td>{{ $deposit->milk_quantity }}</td>
                                <td>{{ $deposit->milk_fat }}</td>
                                <td>{{ $deposit->milk_snf }}</td>
                                {{-- <td>{{$deposit->milk_price_per_ltr}}</td> --}}
                                {{-- <td>{{$deposit->per_ltr_commission}}</td> --}}
                                <td>{{ $deposit->milk_per_ltr_price_with_commission }}</td>
                                <td><span class="badge badge-success">{{ $deposit->milk_total_price }}</span></td>
                            </tr>
                        @endforeach
                    @endif
                    @if (count($milkDeposits) <= 0)
                        <tr class="text-center">
                            <td colspan="20">दूध सङ्कलन देखाउनको लागि कुनै डेटा छैन..</td>
                        </tr>
                    @endif
                </tbody>
            </table>
            <div class="ml-4">
                {{ $entries != 'all' ? $milkDeposits->links() : '' }}
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script src="//unpkg.com/nepali-date-picker@2.0.2/dist/nepaliDatePicker.min.js"></script>
    <link rel="stylesheet" href="//unpkg.com/nepali-date-picker@2.0.2/dist/nepaliDatePicker.min.css">

    <script>
        $(document).ready(function() {
            // =======Get current Nepali date=======
            var currentDate = new Date();
            var currentNepaliDate = calendarFunctions.getBsDateByAdDate(currentDate.getFullYear(), currentDate
                .getMonth() + 1, currentDate.getDate());
            var formattedNepaliDate = calendarFunctions.bsDateFormat("%y-%m-%d", currentNepaliDate.bsYear,
                currentNepaliDate.bsMonth, currentNepaliDate.bsDate);
            @this.set('milk_deposit_date', formattedNepaliDate);

            // Initialize the date picker with the current date
            $("#milk_deposit_date").val(formattedNepaliDate).nepaliDatePicker({
                dateFormat: "%y-%m-%d",
                closeOnDateSelect: true,
            });
        });
        // ======date picker=========
        $("#milk_deposit_date").nepaliDatePicker({
            dateFormat: "%y-%m-%d",
            closeOnDateSelect: true
        });
        // ======testing========
        $("#milk_deposit_date").on("dateChange", function(event) {
            var datePickerData = event.datePickerData;
            @this.set('milk_deposit_date', datePickerData.formattedDate);
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const inputs = [
                document.getElementById('farmernumber'),
                document.getElementById('milkQuantity'),
                document.getElementById('milk_fat'),
                document.getElementById('milk_snf'),
                document.getElementById('per_litre_commission')
            ];

            inputs.forEach((input, index) => {
                input.addEventListener('keydown', function(event) {
                    if (event.key === 'Enter') {
                        event.preventDefault(); // Prevent the form from submitting

                        // Move to the next input or trigger the submit button
                        if (index < inputs.length - 1) {
                            inputs[index + 1].focus();
                        } else {
                            // Trigger Livewire method by simulating a click event on the button
                            document.querySelector('button[wire\\:click\\.prevent="register"]')
                                .click();
                            document.getElementById('farmernumber').focus();
                        }
                    }
                });
            });
        });
    </script>
@endpush
