<div class="row">
    <div class="col-md-6">
        <form action="{{ route('profile.saveaddress') }}" method="POST">
            @csrf
            @method('POST')

            <div class="mb-3">
                <label for="address" class="form-label">Address</label>
                <input type="text" class="form-control" id="address" name="address" required>
            </div>

            <div class="mb-3">
                <label for="city" class="form-label">City</label>
                <input type="text" class="form-control" id="city" name="city" required>
            </div>

            <div class="mb-3">
                <label for="postalCode" class="form-label">Postal Code</label>
                <input type="text" class="form-control" id="postalCode" name="postalCode" required>
            </div>

            <div class="mb-3">
                <label for="country" class="form-label">Country</label>
                <input type="text" class="form-control" id="country" name="country" required>
            </div>

            <button type="submit" class="btn btn-primary">Add Address</button>
        </form>
    </div>
</div>

<div class="row mt-3">
    <div class="col-md-6">
        <h2>Your Addresses</h2>
        @if ($user->addresses)
            <h2>Addresses:</h2>
            <ul>
                @foreach ($user->addresses as $address)
                    <form action="{{ route('profile.updateaddress', $address->id) }}" method="POST" class="mb-2">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="address" class="form-label">Address</label>
                            <input type="text" class="form-control" name="address"
                                value="{{ $address->address }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="city" class="form-label">City</label>
                            <input type="text" class="form-control" name="city" value="{{ $address->city }}"
                                required>
                        </div>

                        <div class="mb-3">
                            <label for="postalCode" class="form-label">Postal Code</label>
                            <input type="text" class="form-control" name="postalCode"
                                value="{{ $address->postalCode }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="country" class="form-label">Country</label>
                            <input type="text" class="form-control" name="country"
                                value="{{ $address->country }}" required>
                        </div>

                        <button type="submit" class="btn btn-warning">Edit</button>
                    </form>

                    <form action="{{ route('profile.deleteaddress', $address->id) }}" method="POST">
                        @csrf
                        @method('DELETE')

                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                @endforeach
            </ul>
        @else
            <p>No addresses available.</p>
        @endif

    </div>
</div>
</div>