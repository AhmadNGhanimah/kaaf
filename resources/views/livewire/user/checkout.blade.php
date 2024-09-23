<div>
    <div class="py-3 py-md-4 checkout">
        <div class="container">
            <h4>Checkout</h4>
            <hr>

            <div class="row">
                <div class="col-md-12 mb-4">
                    <div class="shadow bg-white p-3">
                        <h4 class="text-primary">
                            Item Total Amount :
                            <span class="float-end">${{ $total }}</span>
                        </h4>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="shadow bg-white p-3">
                        <h4 class="text-primary">
                            Basic Information
                        </h4>
                        <hr>

                        <form wire:submit.prevent="placeOrder">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label>Full Name</label>
                                    <input type="text" wire:model="fullname" class="form-control text-capitalize"
                                        placeholder="Enter Full Name" />
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label>Phone Number</label>
                                    <input type="number" wire:model="phone" class="form-control "
                                        placeholder="Enter Phone Number" required />
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label>Email Address</label>
                                    <input type="email" wire:model="email" class="form-control "
                                        value="{{ auth()->user()->email }}" placeholder="Enter Email Address"
                                        required />
                                </div>
                                <div class="col-md-12 mb-3">
                                    <label>Full Address</label>
                                    <textarea wire:model="address" class="form-control text-capitalize" rows="2" required></textarea>
                                </div>
                                <div>
                                    <button type="submit" class="btn btn-primary">Place Order (Cash on
                                        Delivery)</button>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
