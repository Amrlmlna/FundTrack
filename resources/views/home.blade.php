@extends('layouts.app')
@section('title', 'Home')
@section('content')

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
</head>

<style>
    body {
        background: linear-gradient(135deg, #f5f7fa 0%, #e4e8f0 100%);
        font-family: 'Poppins', sans-serif;
        color: #334155;
    }

    .dashboard-container {
        padding: 2rem 1rem;
    }

    .info-section {
        background: rgba(255, 255, 255, 0.9);
        backdrop-filter: blur(10px);
        border-radius: 16px;
        padding: 1.5rem;
        margin-bottom: 2rem;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
        text-align: center;
        transition: transform 0.3s ease;
    }

    .info-section:hover {
        transform: translateY(-5px);
    }

    .date-container {
        font-size: 1.2rem;
        font-weight: 600;
        color: #3b82f6;
        margin-bottom: 0.5rem;
    }

    .temperature-container {
        font-size: 1.5rem;
        font-weight: 700;
        color: #ef4444;
        margin-bottom: 0.5rem;
    }

    .location-container {
        font-size: 1.2rem;
        font-weight: 500;
        color: #10b981;
    }

    .card-container {
        background: rgba(255, 255, 255, 0.9);
        backdrop-filter: blur(10px);
        border-radius: 16px;
        padding: 1.5rem;
        margin-bottom: 1.5rem;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
        height: 100%;
        transition: all 0.3s ease;
    }

    .card-container:hover {
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    }

    .card-title {
        font-size: 1.25rem;
        font-weight: 600;
        color: #3b82f6;
        margin-bottom: 1.5rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .card-title i {
        font-size: 1.5rem;
    }

    .form-control, .form-select {
        border-radius: 10px;
        padding: 0.75rem 1rem;
        border: 1px solid #e2e8f0;
        background-color: #f8fafc;
        transition: all 0.3s ease;
    }

    .form-control:focus, .form-select:focus {
        border-color: #3b82f6;
        box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.25);
    }

    .btn {
        border-radius: 10px;
        padding: 0.75rem 1.5rem;
        font-weight: 500;
        transition: all 0.3s ease;
    }

    .btn-primary {
        background-color: #3b82f6;
        border-color: #3b82f6;
    }

    .btn-primary:hover {
        background-color: #2563eb;
        border-color: #2563eb;
        transform: translateY(-2px);
    }

    .btn-secondary {
        background-color: #64748b;
        border-color: #64748b;
    }

    .btn-secondary:hover {
        background-color: #475569;
        border-color: #475569;
        transform: translateY(-2px);
    }

    .btn-success {
        background-color: #10b981;
        border-color: #10b981;
    }

    .btn-success:hover {
        background-color: #059669;
        border-color: #059669;
    }

    .btn-warning {
        background-color: #f59e0b;
        border-color: #f59e0b;
    }

    .btn-warning:hover {
        background-color: #d97706;
        border-color: #d97706;
    }

    .btn-info {
        background-color: #0ea5e9;
        border-color: #0ea5e9;
        color: white;
    }

    .btn-info:hover {
        background-color: #0284c7;
        border-color: #0284c7;
        color: white;
    }

    .btn-light {
        background-color: #f1f5f9;
        border-color: #e2e8f0;
        color: #334155;
    }

    .btn-light:hover {
        background-color: #e2e8f0;
        border-color: #cbd5e1;
    }

    .calculator-screen {
        background-color: #f8fafc;
        border-radius: 10px;
        padding: 1rem;
        font-size: 1.5rem;
        text-align: right;
        margin-bottom: 1rem;
        border: 1px solid #e2e8f0;
    }

    .calculator-buttons .btn {
        width: 100%;
        height: 3.5rem;
        font-size: 1.25rem;
        margin-bottom: 0.5rem;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .carousel-item img {
        border-radius: 10px;
        height: 250px;
        object-fit: cover;
    }

    .carousel-control-prev, .carousel-control-next {
        width: 10%;
        opacity: 0.8;
    }

    .carousel-control-prev-icon, .carousel-control-next-icon {
        background-color: rgba(0, 0, 0, 0.5);
        border-radius: 50%;
        padding: 1.5rem;
    }

    .converted-result {
        background-color: #f0f9ff;
        border: 1px solid #bae6fd;
        border-radius: 10px;
        padding: 1rem;
        margin-top: 1rem;
        text-align: center;
        font-weight: 500;
        color: #0284c7;
    }

    @media screen and (max-width: 768px) {
        .dashboard-container {
            padding: 1rem 0.5rem;
        }
        
        .card-container {
            padding: 1rem;
        }
        
        .calculator-buttons .btn {
            height: 3rem;
            font-size: 1rem;
        }
    }
</style>

<body>
    @if (session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: '{{ session('success') }}',
                showConfirmButton: false,
                timer: 3000
            });
        </script>
    @endif
    
    <div class="dashboard-container">
        <!-- Info Section -->
        <div class="info-section">
            <div class="date-container" id="current-date">
                <i class="bi bi-calendar-date me-2"></i>
                <span>Memuat tanggal...</span>
            </div>
            <div class="temperature-container" id="current-temperature">
                <i class="bi bi-thermometer-half me-2"></i>
                <span>Memuat suhu...</span>
            </div>
            <div class="location-container" id="current-location">
                <i class="bi bi-geo-alt me-2"></i>
                <span>Memuat lokasi...</span>
            </div>
        </div>

        <!-- Grid Layout -->
        <div class="row g-4">
            <!-- Currency Conversion Section -->
            <div class="col-12 col-md-6 col-lg-4">
                <div class="card-container h-100">
                    <h4 class="card-title">
                        <i class="bi bi-currency-exchange"></i>
                        Currency Converter
                    </h4>
                
                    <!-- Pilihan Konversi Mata Uang -->
                    <div class="mb-3">
                        <label for="currency" class="form-label">Choose Currency:</label>
                        <input type="text" id="currency-input" class="form-control" placeholder="Type to search currency..." autocomplete="off">
                        <select id="currency-select" class="form-select mt-2" size="5" style="display: none;"></select>
                    </div>
                
                    <!-- Masukan Jumlah yang Ingin Dikonversi -->
                    <div class="mb-3">
                        <label for="amount" class="form-label">Amount:</label>
                        <input type="number" id="amount" class="form-control" placeholder="Enter amount" min="0">
                    </div>
                
                    <!-- Tombol Tukar Mata Uang -->
                    <div class="text-center mb-3">
                        <button id="swap-button" class="btn btn-secondary w-100">
                            <i class="bi bi-arrow-down-up me-2"></i>
                            Swap Currencies
                        </button>
                    </div>
                
                    <!-- Tombol Konversi -->
                    <button id="convert-button" class="btn btn-primary w-100">
                        <i class="bi bi-calculator me-2"></i>
                        Convert
                    </button>
                
                    <!-- Hasil Konversi -->
                    <div class="mt-3 converted-result" id="converted-result" style="display: none;"></div>
                </div>
            </div>
            

            <!-- Calculator Section -->
            <div class="col-12 col-md-6 col-lg-4">
                <div class="card-container h-100">
                    <h4 class="card-title">
                        <i class="bi bi-calculator"></i>
                        Enhanced Calculator
                    </h4>
                    <div class="calculator-body">
                        <div class="calculator-screen">
                            <input type="text" id="calc-screen" class="form-control text-end border-0 bg-transparent p-0" disabled>
                        </div>
                
                        <div class="calculator-buttons">
                            <div class="row g-2">
                                <div class="col-3">
                                    <button class="btn btn-light" onclick="appendNumber(7)">7</button>
                                </div>
                                <div class="col-3">
                                    <button class="btn btn-light" onclick="appendNumber(8)">8</button>
                                </div>
                                <div class="col-3">
                                    <button class="btn btn-light" onclick="appendNumber(9)">9</button>
                                </div>
                                <div class="col-3">
                                    <button class="btn btn-warning" onclick="chooseOperation('divide')">÷</button>
                                </div>
                            </div>
                            <div class="row g-2">
                                <div class="col-3">
                                    <button class="btn btn-light" onclick="appendNumber(4)">4</button>
                                </div>
                                <div class="col-3">
                                    <button class="btn btn-light" onclick="appendNumber(5)">5</button>
                                </div>
                                <div class="col-3">
                                    <button class="btn btn-light" onclick="appendNumber(6)">6</button>
                                </div>
                                <div class="col-3">
                                    <button class="btn btn-warning" onclick="chooseOperation('multiply')">×</button>
                                </div>
                            </div>
                            <div class="row g-2">
                                <div class="col-3">
                                    <button class="btn btn-light" onclick="appendNumber(1)">1</button>
                                </div>
                                <div class="col-3">
                                    <button class="btn btn-light" onclick="appendNumber(2)">2</button>
                                </div>
                                <div class="col-3">
                                    <button class="btn btn-light" onclick="appendNumber(3)">3</button>
                                </div>
                                <div class="col-3">
                                    <button class="btn btn-warning" onclick="chooseOperation('subtract')">−</button>
                                </div>
                            </div>
                            <div class="row g-2">
                                <div class="col-3">
                                    <button class="btn btn-light" onclick="appendNumber(0)">0</button>
                                </div>
                                <div class="col-3">
                                    <button class="btn btn-light" onclick="clearScreen()">C</button>
                                </div>
                                <div class="col-3">
                                    <button class="btn btn-success" onclick="calculate()">=</button>
                                </div>
                                <div class="col-3">
                                    <button class="btn btn-warning" onclick="chooseOperation('add')">+</button>
                                </div>
                            </div>
                            <div class="row g-2">
                                <div class="col-3">
                                    <button class="btn btn-info" onclick="calculatePercentage()">%</button>
                                </div>
                                <div class="col-3">
                                    <button class="btn btn-info" onclick="squareNumber()">x²</button>
                                </div>
                                <div class="col-3">
                                    <button class="btn btn-info" onclick="squareRoot()">√</button>
                                </div>
                                <div class="col-3">
                                    <button class="btn btn-info" onclick="clearEntry()">CE</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Image Upload Section -->
            <div class="col-12 col-md-6 col-lg-4">
                <div class="card-container h-100">
                    <h4 class="card-title">
                        <i class="bi bi-image"></i>
                        Travel Moments
                    </h4>
                    <form action="{{ route('upload.image') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <div class="upload-area p-4 text-center border border-dashed rounded-3 bg-light mb-3">
                                <i class="bi bi-cloud-arrow-up display-4 text-primary mb-2"></i>
                                <p class="mb-2">Drag & drop your image here or click to browse</p>
                                <input type="file" name="image" class="form-control" id="image" required hidden>
                                <label for="image" class="btn btn-outline-primary">Choose File</label>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">
                            <i class="bi bi-upload me-2"></i>
                            Upload Image
                        </button>
                    </form>

                    <!-- Carousel untuk menampilkan gambar -->
                    @if($images->isNotEmpty())
                        <div id="imageCarousel" class="carousel slide mt-4" data-bs-ride="carousel">
                            <div class="carousel-inner">
                                @foreach($images as $index => $image)
                                    <div class="carousel-item @if ($index === 0) active @endif">
                                        <img src="{{ asset('storage/' . $image->filename) }}" class="d-block w-100" alt="Uploaded Image {{ $index + 1 }}">
                                    </div>
                                @endforeach
                            </div>
                            <button class="carousel-control-prev" type="button" data-bs-target="#imageCarousel" data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Previous</span>
                            </button>
                            <button class="carousel-control-next" type="button" data-bs-target="#imageCarousel" data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Next</span>
                            </button>
                        </div>
                    @else
                        <div class="text-center mt-4 p-4 bg-light rounded-3">
                            <i class="bi bi-images display-4 text-muted"></i>
                            <p class="mt-2 text-muted">No images uploaded yet.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Fungsi untuk mendapatkan dan menampilkan waktu saat ini
            function updateTimeAndDate() {
                const dateContainer = document.getElementById('current-date');
                const now = new Date();
                const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric', hour: '2-digit', minute: '2-digit', second: '2-digit' };
                const currentDate = now.toLocaleDateString('id-ID', options); // Format Indonesia
        
                dateContainer.innerHTML = `<i class="bi bi-calendar-date me-2"></i>${currentDate}`;
            }
        
            // Fungsi untuk mendapatkan lokasi dan suhu
            function getLocationAndTemperature() {
                const locationContainer = document.getElementById('current-location');
                const temperatureContainer = document.getElementById('current-temperature');
        
                if (navigator.geolocation) {
                    navigator.geolocation.getCurrentPosition(async function(position) {
                        const lat = position.coords.latitude;
                        const lon = position.coords.longitude;
        
                        // Mendapatkan lokasi berdasarkan latitude dan longitude
                        const locationResponse = await fetch(`https://nominatim.openstreetmap.org/reverse?format=json&lat=${lat}&lon=${lon}`);
                        const locationData = await locationResponse.json();
                        const city = locationData.address.city || locationData.address.village || "Lokasi tidak diketahui";
        
                        locationContainer.innerHTML = `<i class="bi bi-geo-alt me-2"></i>${city}`;
        
                        // Mendapatkan suhu berdasarkan lokasi
                        const apiKey = '26984e5bdf4c78381f738f1d0402a944'; // Ganti dengan API Key Anda
                        const weatherResponse = await fetch(`https://api.openweathermap.org/data/2.5/weather?lat=${lat}&lon=${lon}&units=metric&appid=${apiKey}`);
                        const weatherData = await weatherResponse.json();
                        const temperature = weatherData.main.temp;
        
                        temperatureContainer.innerHTML = `<i class="bi bi-thermometer-half me-2"></i>${temperature.toFixed(1)}°C`;
                    }, function(error) {
                        locationContainer.innerHTML = "<i class='bi bi-geo-alt me-2'></i>Tidak dapat mendapatkan lokasi";
                        temperatureContainer.innerHTML = "<i class='bi bi-thermometer-half me-2'></i>Suhu tidak tersedia";
                    });
                } else {
                    locationContainer.innerHTML = "<i class='bi bi-geo-alt me-2'></i>Geolokasi tidak didukung oleh browser";
                    temperatureContainer.innerHTML = "<i class='bi bi-thermometer-half me-2'></i>Suhu tidak tersedia";
                }
            }
        
            // Panggil fungsi untuk memperbarui waktu dan tanggal
            updateTimeAndDate();
            setInterval(updateTimeAndDate, 1000); // Update setiap detik
        
            // Panggil fungsi untuk mendapatkan lokasi dan suhu
            getLocationAndTemperature();

            // File upload preview
            const fileInput = document.getElementById('image');
            const uploadArea = document.querySelector('.upload-area');

            if (fileInput && uploadArea) {
                uploadArea.addEventListener('click', function() {
                    fileInput.click();
                });

                fileInput.addEventListener('change', function() {
                    if (fileInput.files.length > 0) {
                        const fileName = fileInput.files[0].name;
                        uploadArea.innerHTML = `<i class="bi bi-file-earmark-check display-4 text-success mb-2"></i><p>${fileName}</p>`;
                    }
                });
            }
        });
        </script>
        
    <script>
        let currencies = []; // Menyimpan daftar mata uang
        let fromCurrency = 'IDR'; // Mata uang awal (default: Rupiah)
        let toCurrency = ''; // Mata uang tujuan

        // Fungsi untuk memuat daftar mata uang dari API
        async function loadCurrencies() {
            const apiKey = 'e392b4b9e1131b7ff29da55c'; // Kunci API
            const apiUrl = `https://v6.exchangerate-api.com/v6/${apiKey}/codes`;

            try {
                const response = await fetch(apiUrl);
                const data = await response.json();

                if (data && data.supported_codes) {
                    currencies = data.supported_codes;
                    updateCurrencySelect(''); // Perbarui dropdown
                } else {
                    console.error('Unable to load currencies.');
                }
            } catch (error) {
                console.error('Error fetching currency codes:', error);
            }
        }

        // Fungsi untuk memperbarui dropdown pilihan mata uang
        function updateCurrencySelect(input) {
            const currencySelect = document.getElementById('currency-select');
            currencySelect.innerHTML = '';

            currencies.forEach(code => {
                if (code[0].toLowerCase().includes(input.toLowerCase()) || code[1].toLowerCase().includes(input.toLowerCase())) {
                    const option = document.createElement('option');
                    option.value = code[0];
                    option.textContent = `${code[0]} - ${code[1]}`;
                    currencySelect.appendChild(option);
                }
            });

            currencySelect.style.display = currencySelect.options.length ? 'block' : 'none';
        }

        // Fungsi untuk mengonversi mata uang
        async function convertCurrency() {
            const amount = document.getElementById('amount').value;
            const resultElement = document.getElementById('converted-result');

            // Validasi input
            if (!amount || amount <= 0) {
                alert('Please enter a valid amount.');
                return;
            }

            const apiKey = 'e392b4b9e1131b7ff29da55c';
            const apiUrl = `https://v6.exchangerate-api.com/v6/${apiKey}/latest/${fromCurrency}`;

            try {
                resultElement.innerHTML = '<i class="bi bi-hourglass-split me-2"></i>Converting...';
                resultElement.style.display = 'block';
                
                const response = await fetch(apiUrl);
                const data = await response.json();

                if (data && data.conversion_rates && data.conversion_rates[toCurrency]) {
                    const rate = data.conversion_rates[toCurrency];
                    const convertedAmount = amount * rate;

                    // Format mata uang
                    const formattedAmountFrom = new Intl.NumberFormat('en-US', { style: 'currency', currency: fromCurrency }).format(amount);
                    const formattedConvertedAmount = new Intl.NumberFormat('en-US', { style: 'currency', currency: toCurrency }).format(convertedAmount);

                    resultElement.innerHTML = `${formattedAmountFrom} = ${formattedConvertedAmount}`;
                } else {
                    resultElement.innerHTML = '<i class="bi bi-exclamation-triangle me-2"></i>Unable to retrieve conversion rates.';
                }
            } catch (error) {
                console.error('Error fetching conversion rates:', error);
                resultElement.innerHTML = '<i class="bi bi-exclamation-triangle me-2"></i>An error occurred while fetching conversion rates.';
            }
        }

        // Fungsi untuk menukar mata uang (swap)
        function swapCurrencies() {
            const currencyInput = document.getElementById('currency-input');
            const tempCurrency = fromCurrency;

            fromCurrency = toCurrency ? toCurrency : 'IDR';
            toCurrency = tempCurrency;

            // Perbarui input berdasarkan hasil swap
            currencyInput.value = toCurrency;
            document.getElementById('converted-result').style.display = 'none'; // Reset hasil konversi
        }

        // Panggil fungsi untuk memuat mata uang saat halaman dimuat
        window.onload = () => {
            loadCurrencies();
            document.getElementById('convert-button').addEventListener('click', convertCurrency);
            document.getElementById('swap-button').addEventListener('click', swapCurrencies);

            // Input untuk mata uang
            document.getElementById('currency-input').addEventListener('input', function() {
                const inputValue = this.value;
                updateCurrencySelect(inputValue);
            });

            // Pilihan mata uang dari dropdown
            document.getElementById('currency-select').addEventListener('change', function() {
                toCurrency = this.value;
                document.getElementById('currency-input').value = toCurrency;
                this.style.display = 'none';
            });

            // Sembunyikan dropdown ketika klik di luar
            document.addEventListener('click', function(event) {
                if (!document.getElementById('currency-input').contains(event.target) && 
                    !document.getElementById('currency-select').contains(event.target)) {
                    document.getElementById('currency-select').style.display = 'none';
                }
            });
        };


        // Simple calculator logic
        let currentOperand = '';
        let previousOperand = '';
        let operation = undefined;

        // Appends a number to the current operand
        function appendNumber(number) {
            currentOperand += number;
            updateDisplay();
        }

        // Sets the operation (add, subtract, multiply, divide)
        function chooseOperation(selectedOperation) {
            if (currentOperand === '') return;
            if (previousOperand !== '') {
                calculate();
            }
            operation = selectedOperation;
            previousOperand = currentOperand;
            currentOperand = '';
        }

        // Calculates based on the selected operation
        function calculate() {
            let result;
            const prev = parseFloat(previousOperand);
            const current = parseFloat(currentOperand);

            if (isNaN(prev) || isNaN(current)) return;

            switch (operation) {
                case 'add':
                    result = prev + current;
                    break;
                case 'subtract':
                    result = prev - current;
                    break;
                case 'multiply':
                    result = prev * current;
                    break;
                case 'divide':
                    result = prev / current;
                    break;
                default:
                    return;
            }

            currentOperand = result;
            operation = undefined;
            previousOperand = '';
            updateDisplay();
        }

        // Clears the entire calculator screen
        function clearScreen() {
            currentOperand = '';
            previousOperand = '';
            operation = undefined;
            updateDisplay();
        }

        // Clears the last entry
        function clearEntry() {
            currentOperand = '';
            updateDisplay();
        }

        // Calculates percentage of the current operand
        function calculatePercentage() {
            if (currentOperand === '') return;
            currentOperand = parseFloat(currentOperand) / 100;
            updateDisplay();
        }

        // Squares the current operand
        function squareNumber() {
            if (currentOperand === '') return;
            currentOperand = Math.pow(parseFloat(currentOperand), 2);
            updateDisplay();
        }

        // Calculates the square root of the current operand
        function squareRoot() {
            if (currentOperand === '') return;
            currentOperand = Math.sqrt(parseFloat(currentOperand));
            updateDisplay();
        }

        // Updates the calculator screen display
        function updateDisplay() {
            document.getElementById('calc-screen').value = currentOperand;
        }
    </script>
</body>
@endsection