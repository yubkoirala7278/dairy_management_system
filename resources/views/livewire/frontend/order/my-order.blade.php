@extends('livewire.frontend.layouts.master')
@section('custom-style')
@endsection
@section('content')
    <!-- Profile Section -->
    <div class="container pt-5" wire:ignore.self>
        <div class="row">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr style="vertical-align: middle">
                            <th scope="col" style="font-size: 16px; white-space: nowrap;" style="white-space: nowrap;">
                                अर्डर नम्बर</th>
                            <th scope="col" style="font-size: 16px; white-space: nowrap;" style="white-space: nowrap;">
                                स्थिति
                            </th>
                            <th scope="col" style="font-size: 16px; white-space: nowrap;" style="white-space: nowrap;">
                                उपकुल(रु)</th>
                            <th scope="col" style="font-size: 16px; white-space: nowrap;" style="white-space: nowrap;">
                                ढुवानी
                                शुल्क(रु)</th>
                            <th scope="col" style="font-size: 16px; white-space: nowrap;" style="white-space: nowrap;">
                                कुल(रु)</th>
                            <th scope="col" style="font-size: 16px; white-space: nowrap;" style="white-space: nowrap;">
                                मिति
                            </th>
                            <th scope="col" style="font-size: 16px; white-space: nowrap;" style="white-space: nowrap;">
                                उत्पादन विवरण</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (count($orders) > 0)
                            @foreach ($orders as $key => $order)
                                <tr wire:key="{{ $key }}" style="vertical-align: middle">
                                    <td style="white-space: nowrap;min-width:150px">{{ $order->nepali_count }}</td>
                                    <td style="white-space: nowrap;min-width:150px">
                                        @if ($order->status == 'pending')
                                            <span class="badge bg-warning text-dark py-2">विचाराधीन</span>
                                        @elseif($order->status == 'delivered')
                                            <span class="badge bg-success py-2 text-white">पुर्याइएको</span>
                                        @elseif($order->status == 'cancelled')
                                            <span class="badge bg-danger py-2 text-white">रद्द गरिएको</span>
                                        @endif
                                    </td>
                                    <td style="white-space: nowrap;min-width:150px">{{ $order->sub_total_nepali }}</td>
                                    <td style="white-space: nowrap;min-width:150px">{{ $order->shipping_charge_nepali }}
                                    </td>
                                    <td style="white-space: nowrap;min-width:150px">{{ $order->total_charge_nepali }}</td>
                                    @php
                                        $year = $order->created_at->format('Y');
                                        $month = $order->created_at->format('m');
                                        $day = $order->created_at->format('d');
                                        $date = Bsdate::eng_to_nep($year, $month, $day);
                                    @endphp
                                    <td style="white-space: nowrap;min-width:200px">
                                        {{ html_entity_decode($date['date']) . ' ' . html_entity_decode($date['nmonth']) . ' ' . html_entity_decode($date['year']) . ', ' . $date['day'] }}
                                    </td>
                                    <td>
                                        <a class="btn btn-success rounded-pill btn-sm"
                                            href="{{ route('frontend.my-order-details', $order->slug) }}">अर्डर विवरण</a>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                        @if (count($orders) <= 0)
                            <tr class="text-center">
                                <td colspan="20">प्रदर्शन गर्न कुनै अर्डर छैन..</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
                {{ $orders->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>
@endsection
