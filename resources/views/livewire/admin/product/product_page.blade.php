@extends('livewire.admin.layouts.master')
@section('content')
    <div class="col-12 py-3 px-5" style="background-color: #eee;">
        <div class="d-md-flex justify-content-between align-items-center  py-2 ">
            <div>
                <label>प्रदर्शन गर्नुहोस्
                    <select name="withdraw-request-list_length" aria-controls="withdraw-request-list"
                        class="form-select form-select-sm" wire:model.live.debounce.500ms="entries">
                        <option value="10">१०</option>
                        <option value="25">२५</option>
                        <option value="50">५०</option>
                        <option value="100">१००</option>
                        <option value="200">२००</option>
                        <option value="500">५००</option>
                    </select>
                    डेटा
                </label>

            </div>
            <div class="d-flex align-items-center" style="column-gap: 20px">
                <input type="search" class="form-control form-control-sm translate-nepali" placeholder="खोज्नुहोस्..."
                    aria-controls="withdraw-request-list" wire:model.live.debounce.500ms="search">
                <button type="button" class="btn btn-success px-3" data-toggle="modal" data-target="#createProduct"
                    style="border-radius: 30px;min-width:100px">
                    नयाँ प्रोडक्ट
                </button>
            </div>

        </div>
        <table class="table table-bordered table-hover" style="font-size: 20px; min-width: 800px; width: 100%;">
            <thead>
                <tr class="table-secondary">
                    <th scope="col" style="font-size: 20px; white-space: nowrap;">क्र.सं.</th>
                    <th scope="col" style="font-size: 20px; white-space: nowrap;">प्रोडक्टको नाम</th>
                    <th scope="col" style="font-size: 20px; white-space: nowrap;">मूल्य प्रति किलो(रु)</th>
                    <th scope="col" style="font-size: 20px; white-space: nowrap;">मात्रा</th>
                    <th scope="col" style="font-size: 20px; white-space: nowrap;">स्थिति</th>
                    <th scope="col" style="font-size: 20px; white-space: nowrap;">प्रोडक्टको फोटो</th>
                    <th scope="col" style="font-size: 20px; white-space: nowrap;">कार्य</th>
                </tr>
            </thead>
            <tbody>
                @if (count($products) > 0)
                    @foreach ($products as $key => $product)
                        <tr wire:key="{{ $key }}">
                            <td>{{ $product->nepali_count }}</td>
                            <td>{{ $product->name }}</td>
                            <td>{{ $product->price_per_kg }}</td>
                            <td>{{ $product->product_qty ?? '-' }}</td>
                            <td>{{ $product->status ? 'चालू' : 'बन्द' }}</td>
                            <td>
                                <img src="{{ asset('storage/' . $product->image) }}" alt="Product Image"
                                    style="height: 20px; cursor: pointer;"
                                    onclick="openImageModal('{{ asset('storage/' . $product->image) }}')">
                            </td>
                            <td>
                                <button class="btn btn-sm btn-transparent py-0 px-1" data-toggle="tooltip"
                                    data-placement="top" title="सुधार्नुहोस्" wire:click="edit({{ $product->id }})">
                                    <i class="fa-solid fa-pencil h5 text-warning"></i>
                                </button>

                                <button class="btn btn-sm btn-transparent py-0 px-1"
                                    onclick="confirmDelete({{ $product->id }})" data-toggle="tooltip" data-placement="top"
                                    title="मेटाउनुहोस्">
                                    <i class="fa-solid fa-trash h5 text-danger"></i>
                                </button>
                            </td>
                        </tr>
                    @endforeach
                @endif
                @if (count($products) <= 0)
                    <tr class="text-center">
                        <td colspan="20">प्रदर्शन गर्न कुनै प्रोडक्ट छैन..</td>
                    </tr>
                @endif
            </tbody>
        </table>
        <div class="ml-4">
            {{ $products->links() }}
        </div>
    </div>
@endsection

@section('modal')
    <!-- create product Modal-->
    <div class="modal fade" id="createProduct" wire:ignore.self data-backdrop="static" tabindex="-1" role="dialog"
        aria-labelledby="createProductLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title font-weight-bold" id="createProductLabel">नयाँ प्रोडक्ट थप्नुहोस्</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" wire:click="resetFields">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="">
                        <div class="form-group">
                            <label for="name">प्रोडक्टको नाम</label>
                            <input type="text" class="form-control translate-nepali" id="name"
                                placeholder="प्रोडक्टको नाम लेख्नुहोस्" wire:model="name">
                            @if ($errors->has('name'))
                                <span class="text-danger">{{ $errors->first('name') }}</span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="price_per_kg">प्रति किलो मूल्य</label>
                            <input type="number" class="form-control" id="price_per_kg"
                                placeholder="प्रति किलो मूल्य लेख्नुहोस्" wire:model="price_per_kg">
                            @if ($errors->has('price_per_kg'))
                                <span class="text-danger">{{ $errors->first('price_per_kg') }}</span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="image">प्रोडक्टको फोटो</label>
                            <input type="file" class="form-control" id="image" wire:model="image">
                            @if ($errors->has('image'))
                                <span class="text-danger">{{ $errors->first('image') }}</span>
                            @endif
                        </div>
                        <div class="form-group">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="track_qty"
                                    onclick="toggleProductQty(this)" wire:model="track_qty">
                                <label class="form-check-label" for="track_qty">प्रोडक्टको अनुगमन</label>
                                @if ($errors->has('track_qty'))
                                    <span class="text-danger">{{ $errors->first('track_qty') }}</span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="product_qty">प्रोडक्टको मात्रा</label>
                            <input type="number" class="form-control" id="product_qty"
                                placeholder="प्रोडक्टको मात्रा लेख्नुहोस्" wire:model="product_qty" disabled>
                            @if ($errors->has('product_qty'))
                                <span class="text-danger">{{ $errors->first('product_qty') }}</span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="status">अवस्था</label>
                            <select class="form-control" wire:model="status" id="status">
                                <option value="1">चालू</option>
                                <option value="0">बन्द</option>
                            </select>
                            @error('status')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" wire:click="resetFields">रद्द
                        गर्नुहोस्</button>
                    <button type="button" class="btn btn-success" wire:click="createProduct">पेश गर्नुहोस्</button>
                </div>
            </div>
        </div>
    </div>

    <!-- update product Modal-->
    <div class="modal fade" id="updateProduct" wire:ignore.self data-backdrop="static" tabindex="-1" role="dialog"
        aria-labelledby="updateProductLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title font-weight-bold" id="updateProductLabel">प्रोडक्ट अपडेट गर्नुहोस्</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"
                        wire:click="resetFields">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="">
                        <div class="form-group">
                            <label for="name">प्रोडक्टको नाम</label>
                            <input type="text" class="form-control translate-nepali" id="name"
                                placeholder="प्रोडक्टको नाम लेख्नुहोस्" wire:model="name">
                            @if ($errors->has('name'))
                                <span class="text-danger">{{ $errors->first('name') }}</span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="price_per_kg">प्रति किलो मूल्य</label>
                            <input type="number" class="form-control" id="price_per_kg"
                                placeholder="प्रति किलो मूल्य लेख्नुहोस्" wire:model="price_per_kg">
                            @if ($errors->has('price_per_kg'))
                                <span class="text-danger">{{ $errors->first('price_per_kg') }}</span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="image">प्रोडक्टको फोटो</label>
                            <input type="file" class="form-control" id="image" wire:model="image">
                            @if ($errors->has('image'))
                                <span class="text-danger">{{ $errors->first('image') }}</span>
                            @endif
                        </div>
                        <div class="form-group">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="track_qty_update"
                                    onclick="toggleProductQtyForUpdate(this)" wire:model="track_qty">
                                <label class="form-check-label" for="track_qty_update">प्रोडक्टको अनुगमन</label>
                                @if ($errors->has('track_qty'))
                                    <span class="text-danger">{{ $errors->first('track_qty') }}</span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="product_qty_update">प्रोडक्टको मात्रा</label>
                            <input type="number" class="form-control" id="product_qty_update"
                                placeholder="प्रोडक्टको मात्रा लेख्नुहोस्" wire:model="product_qty" disabled>
                            @if ($errors->has('product_qty'))
                                <span class="text-danger">{{ $errors->first('product_qty') }}</span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="status">अवस्था</label>
                            <select class="form-control" wire:model="status" id="status">
                                <option value="1">चालू</option>
                                <option value="0">बन्द</option>
                            </select>
                            @error('status')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" wire:click="resetFields">रद्द
                        गर्नुहोस्</button>
                    <button type="button" class="btn btn-success" wire:click="updateProduct">अपडेट गर्नुहोस्</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal for displaying the image -->
    <div id="imageModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="imageModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="imageModalLabel">प्रोडक्टको फोटो</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body text-center">
                    <img id="modalImage" src="" alt="Product Image" class="img-fluid"
                        style="max-height: 500px;">
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // ========success message============
            Livewire.on('success', (event) => {
                $('#createProduct').modal('hide');
                $('#updateProduct').modal('hide');
                $('.modal-backdrop').remove();
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

            Livewire.on('editModal', (event) => {
                $('#updateProduct').modal('show');
            });
        });
    </script>
    <script>
        function toggleProductQty() {
            var checkbox = document.getElementById("track_qty");
            var productQtyInput = document.getElementById("product_qty");

            // Enable or disable the product_qty input based on checkbox state
            if (checkbox.checked) {
                productQtyInput.disabled = false;
            } else {
                productQtyInput.disabled = true;
            }
        }

        function toggleProductQtyForUpdate() {
            var checkbox = document.getElementById("track_qty_update");
            var productQtyInput = document.getElementById("product_qty_update");

            // Enable or disable the product_qty input based on checkbox state
            if (checkbox.checked) {
                productQtyInput.disabled = false;
            } else {
                productQtyInput.disabled = true;
            }
        }
    </script>
    <script>
        function confirmDelete(productId) {
            Swal.fire({
                title: "के तपाईं पक्का हुनुहुन्छ?",
                text: "यो क्रिया पुनः फर्काउन सकिने छैन!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "हो, यसलाई मेटाउनुहोस्!",
                cancelButtonText: "रद्द गर्नुहोस्"
            }).then((result) => {
                if (result.isConfirmed) {
                    @this.call('delete', productId);
                }
            });

        }
    </script>
    <script>
        // Function to open the image modal and display the clicked image
        function openImageModal(imagePath) {
            // Set the source of the image in the modal
            document.getElementById('modalImage').src = imagePath;
            
            // Show the modal
            $('#imageModal').modal('show');
        }
    </script>
@endpush
