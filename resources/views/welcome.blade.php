<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://unpkg.com/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <title>Phone Number Verification</title>
    <style>
        .card {
            border-radius: 10px;
        }
        .card-body {
            padding: 2rem;
        }
        .alert {
            margin-bottom: 1rem;
        }
        #recaptcha-container {
            margin-top: 1rem;
        }
    </style>
</head>
<body>
    <section class="d-flex align-items-center justify-content-center" style="min-height: 100vh;">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-sm-10 col-md-8 col-lg-6 col-xl-5 col-xxl-4">
                    <div class="card shadow-sm">
                        <div class="card-body p-4">
                            <div class="text-center mb-4">
                                <a href="#!">
                                    <img src="{{asset('images/1.png')}}"  alt="Logo" width="160" height="100">
                                </a>
                            </div>

                            <!-- Display Success or Error Messages -->
                            <div id="alerts">
                                <div id="error" class="alert alert-danger" style="display: none;"></div>
                                <div id="sentMessage" class="alert alert-success" style="display: none;"></div>
                                <div id="m" class="alert alert-success" style="display: none;"></div>
                            </div>
                            
                            <!-- reCAPTCHA Container -->
                            <div id="recaptcha-container"></div>

                            <!-- Combined Phone Number and OTP Verification Forms -->
                            <div id="form-section">
                                <!-- Phone Number Input -->
                                <div id="phone-section" class="form-section">
                                    <h2 class="fs-5 fw-bold text-center text-dark mb-4">Enter your phone number</h2>
                                    <form id="phone-form">
                                        <div class="mb-3">
                                            <div class="form-floating">
                                                <input type="text" class="form-control" id="number" placeholder="Enter phone number" required>
                                                <label for="number" class="form-label">Phone Number</label>
                                            </div>
                                        </div>
                                    </form>
                                </div>

                                <!-- OTP Verification Input -->
                                <div id="verify-section" class="form-section">
                                    <h2 class="fs-5 fw-bold text-center text-dark mb-4">Enter the verification code</h2>
                                    <form id="verify-form">
                                        <div class="mb-3">
                                            <div class="form-floating">
                                                <input type="text" class="form-control" id="verificationCode" placeholder="Enter verification code" required>
                                                <label for="verificationCode" class="form-label">Verification Code</label>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                
                                <!-- Buttons for Sending and Verifying OTP -->
                                <div class="d-grid my-4">
                                    <button type="button" class="btn btn-primary btn-lg" id="send_code" onclick="sendOTP()">Send Code</button>
                                    <button type="button" class="btn btn-primary btn-lg mt-3" onclick="verifyOTP()">Verify Code</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Include Firebase JavaScript SDK -->
    <script src="https://www.gstatic.com/firebasejs/6.0.2/firebase.js"></script>
    
    <script>
        // Firebase configuration
        var firebaseConfig = {
            apiKey: "AIzaSyA8IbFXpHdPHBi0nyafZC_vEEMwNCDylOs",
            authDomain: "hello-5eb98.firebaseapp.com",
            projectId: "hello-5eb98",
            storageBucket: "hello-5eb98.appspot.com",
            messagingSenderId: "700073859199",
            appId: "1:700073859199:web:3b918fbba9fe54ad28874a",
            measurementId: "G-TQCJZ0KG5S"
        };

        // Initialize Firebase
        firebase.initializeApp(firebaseConfig);

        window.onload = function() {
            render();
        };

        function render() {
            window.recaptchaVerifier = new firebase.auth.RecaptchaVerifier('recaptcha-container');
            recaptchaVerifier.render();
        }

        function sendOTP() {
            var number = $("#number").val();
            if (!number.startsWith('+') || number.length < 10) {
                $("#error").text("Please enter a valid phone number with the country code.");
                $("#error").show();
                return;
            }

            firebase.auth().signInWithPhoneNumber(number, window.recaptchaVerifier)
                .then(function(confirmationResult) {
                    window.confirmationResult = confirmationResult;
                    $("#sentMessage").text("Verification code sent!");
                    $("#sentMessage").show();
                })
                .catch(function(error) {
                    $("#error").text("Error during sending OTP: " + error.message);
                    $("#error").show();
                });
        }

        function verifyOTP() {
            var code = $('#verificationCode').val();
            window.confirmationResult.confirm(code).then(function(result) {
                var user = result.user;
                $("#m").text("Verification code verified!");
                $("#m").show();

                // Store user data after verification
                storeUserData($("#number").val());
            }).catch(function(error) {
                $("#error").text("Error during verification OTP: " + error.message);
                $("#error").show();
            });
        }

        function storeUserData(phoneNumber) {
            var visitCount = 1; // Default visit count
            var lastVisitDate = new Date().toISOString().split('T')[0]; // Current date in 'Y-m-d' format

            fetch('/store-user-data', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({
                    phone_number: phoneNumber,
                    visit_count: visitCount,
                    last_visit_date: lastVisitDate
                })
            })
            .then(response => response.json())
            .then(data => {
                console.log('Success:', data);
                window.location.href = `/user/${encodeURIComponent(phoneNumber)}`;
            })
            .catch((error) => {
                console.error('Error:', error);
            });
        }
    </script>
</body>
</html>
