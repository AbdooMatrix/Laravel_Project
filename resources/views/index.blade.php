

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ٌRegisteration</title>
    <link rel="stylesheet" href="{{ asset('css/index.css') }}">
</head>
<body>
    @include('partials.header') <!-- This includes header.blade.php -->
    <div class="container">
        <main>
            <section class="hero">
                <h1>Join Us Today</h1>
                <p>Register now to enjoy all the features of our platform.</p>
            </section>
            
            <div class="form-container">
                <form id="registrationForm" method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="fullName"><i class="fas fa-user"></i> Full Name</label>
                        <input type="text" id="fullName" name="fullName" required>
                    </div>

                    <div class="form-group">
                        <label for="username"><i class="fas fa-user-circle"></i> Username</label>
                        <input type="text" id="username" name="username" required onkeyup="checkUsername()">
                        <span id="username-status"></span>
                    </div>

                    <div class="form-group">
                        <label for="phone"><i class="fas fa-phone"></i> Phone</label>
                        <input type="text" id="phone" name="phone" required>
                    </div>

                    <div class="form-group">
                        <label for="whatsAppNumber"><i class="fab fa-whatsapp"></i> WhatsApp Number</label>
                        <div class="whatsapp-group">
                            <select id="countryCode" name="countryCode">
                                <option value="1">+1 (USA)</option>
                                <option value="44">+44 (UK)</option>
                                <option value="91">+91 (India)</option>
                                <option value="20">+20 (Egypt)</option>
                                <option value="61">+61 (Australia)</option>
                            </select>
                            <input type="text" id="whatsAppNumber" name="whatsAppNumber" required>
                            <button type="button" id="validateWhatsApp">Validate</button>
                        </div>
                        <p id="whatsappValidationResult"></p>
                    </div>

                    <div class="form-group">
                        <label for="address"><i class="fas fa-map-marker-alt"></i> Address</label>
                        <input type="text" id="address" name="address" required>
                    </div>

                    <div class="form-group">
                        <label for="password"><i class="fas fa-lock"></i> Password</label>
                        <input type="password" id="password" name="password" required>
                    </div>

                    <div class="form-group">
                        <label for="confirmPassword"><i class="fas fa-lock"></i> Confirm Password</label>
                        <input type="password" id="confirmPassword" name="confirmPassword" required>
                    </div>

                    <div class="form-group">
                        <label for="email"><i class="fas fa-envelope"></i> Email</label>
                        <input type="email" id="email" name="email" required>
                    </div>

                    <div class="form-group">
                        <label for="image"><i class="fas fa-image"></i> Upload Profile Picture</label>
                        <input type="file" id="image" name="image" accept="image/*" required>
                    </div>

                    <button type="submit" class="register-btn">Register</button>
                </form>
            </div>
        </main>
    </div>
    <script src="{{asset('js/index.js')}}"></script>
    @include('partials.footer') <!-- This includes footer.blade.php -->
</body>
</html>


<?php
    {{-- include 'Upload.php'; --}}
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $full_name = $_POST['fullName'];
        $user_name = $_POST['username'];
        $phone = $_POST['phone'];
        $whatsapp_number = '+' . $_POST['countryCode'] . $_POST['whatsAppNumber'];
        $address = $_POST['address'];
        $email = $_POST['email'];
        $password = $_POST['password'];

        if (check_if_exists("user_name", $user_name)) {
            echo "<script>alert('Username already exists!');</script>";
        } elseif (check_if_exists("email", $email)) {
            echo "<script>alert('Email already exists!');</script>";
        } elseif (check_if_exists("phone", $phone)) {
            echo "<script>alert('Phone number already exists!');</script>";
        } elseif (check_if_exists("whatsapp_number", $whatsapp_number)) {
            echo "<script>alert('WhatsApp number already exists!');</script>";
        } else {
            if (insert_user($full_name, $user_name, $phone, $whatsapp_number, $address, $email, $password)) {
                if (upload_image($user_name)) {
                    echo "<script>alert('Registration successful!');</script>";
                }
            } else {
                echo "<script>alert('Registration failed.');</script>";
            }
        }
    }
?>
