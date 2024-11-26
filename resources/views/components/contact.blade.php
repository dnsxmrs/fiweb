<form id="contactForm" method="POST" action="{{ route('contact.save') }}">
    @csrf <!-- Laravel CSRF Token -->

    <div id="errorSummary" class="error-summary" style="color: red;">
        @if ($errors->any())
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        @endif
    </div>

    <div>
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" value="{{ old('name') }}" required>
        @error('name')
            <small class="error-message">{{ $message }}</small>
        @enderror
    </div>

    <div>
        <label for="phone">Phone Number:</label>
        <input type="text" id="phone" name="phone" value="{{ old('phone') }}" required>
        @error('phone')
            <small class="error-message">{{ $message }}</small>
        @enderror
    </div>

    <div>
        <label for="region">Region:</label>
        <select id="region" name="region" required>
            <option value="">Select Region</option>
        </select>
        @error('region')
            <small class="error-message">{{ $message }}</small>
        @enderror
    </div>

    <div>
        <label for="province">Province:</label>
        <select id="province" name="province" required>
            <option value="">Select Province</option>
        </select>
        @error('province')
            <small class="error-message">{{ $message }}</small>
        @enderror
    </div>

    <div>
        <label for="municipality">Municipality:</label>
        <select id="municipality" name="municipality" required>
            <option value="">Select Municipality</option>
        </select>
        @error('municipality')
            <small class="error-message">{{ $message }}</small>
        @enderror
    </div>

    <div>
        <label for="barangay">Barangay:</label>
        <select id="barangay" name="barangay" required>
            <option value="">Select Barangay</option>
        </select>
        @error('barangay')
            <small class="error-message">{{ $message }}</small>
        @enderror
    </div>

    <div>
        <label for="postalCode">Postal Code:</label>
        <input type="text" id="postalCode" name="postalCode" value="{{ old('postalCode') }}" required>
        @error('postalCode')
            <small class="error-message">{{ $message }}</small>
        @enderror
    </div>

    <button type="submit">Proceed to Checkout</button>
</form>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Fetch Regions
        fetch('https://psgc.gitlab.io/api/regions/')
            .then(response => response.json())
            .then(data => {
                const regionSelect = document.getElementById('region');
                data.forEach(region => {
                    regionSelect.innerHTML +=
                        `<option value="${region.code}">${region.name}</option>`;
                });
            });

        // Fetch Provinces on Region Change
        document.getElementById('region').addEventListener('change', function() {
            const regionCode = this.value;
            fetch(`https://psgc.gitlab.io/api/regions/${regionCode}/provinces/`)
                .then(response => response.json())
                .then(data => {
                    const provinceSelect = document.getElementById('province');
                    provinceSelect.innerHTML = '<option value="">Select Province</option>';
                    data.forEach(province => {
                        provinceSelect.innerHTML +=
                            `<option value="${province.code}">${province.name}</option>`;
                    });
                });
        });

        // Fetch Municipalities on Province Change
        document.getElementById('province').addEventListener('change', function() {
            const provinceCode = this.value;
            fetch(`https://psgc.gitlab.io/api/provinces/${provinceCode}/municipalities/`)
                .then(response => response.json())
                .then(data => {
                    const municipalitySelect = document.getElementById('municipality');
                    municipalitySelect.innerHTML = '<option value="">Select Municipality</option>';
                    data.forEach(municipality => {
                        municipalitySelect.innerHTML +=
                            `<option value="${municipality.code}">${municipality.name}</option>`;
                    });
                });
        });

        // Fetch Barangays on Municipality Change
        document.getElementById('municipality').addEventListener('change', function() {
            const municipalityCode = this.value;
            fetch(`https://psgc.gitlab.io/api/municipalities/${municipalityCode}/barangays/`)
                .then(response => response.json())
                .then(data => {
                    const barangaySelect = document.getElementById('barangay');
                    barangaySelect.innerHTML = '<option value="">Select Barangay</option>';
                    data.forEach(barangay => {
                        barangaySelect.innerHTML +=
                            `<option value="${barangay.code}">${barangay.name}</option>`;
                    });
                });
        });
    });
</script>
