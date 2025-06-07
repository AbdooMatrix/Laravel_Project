<!-- This view should contain the form for adding a new user. -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Registeration</title>
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
                @if (session('Success'))
                    <div class="alert alert-success" style="padding: 10px; background-color: #d4edda; color: #155724; border-radius: 5px; margin-bottom: 15px;">
                        {{ session('Success') }}
                    </div>
                @endif
                <form action="{{ route('users.store') }}" id="registrationForm" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="fullName"><i class="fas fa-user"></i> Full Name</label>
                        <input type="text" id="fullName" name="fullName" value="{{ old('fullName') }}" required>
                        @error('fullName') <div style="color:red;">{{ $message }}</div> @enderror
                    </div>

                    <div class="form-group">
                        <label for="username"><i class="fas fa-user-circle"></i> Username</label>
                        <input type="text" id="username" name="username" value="{{ old('username') }}" required onkeyup="checkUsername()">
                        <span id="username-status"></span>
                        @error('username') <div style="color:red;">{{ $message }}</div> @enderror
                    </div>

                    <div class="form-group">
                        <label for="phone"><i class="fas fa-phone"></i> Phone</label>
                        <input type="text" id="phone" name="phone" value="{{ old('phone') }}" required pattern="\d{7,15}" title="Enter a valid phone number">
                        @error('phone') <div style="color:red;">{{ $message }}</div> @enderror
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
                            <input type="text" id="whatsAppNumber" name="whatsAppNumber" value="{{ old('whatsAppNumber') }}" required pattern="\d{7,15}" title="Enter a valid WhatsApp number">
                            <button type="button" id="validateWhatsApp">Validate</button>
                        </div>
                        <p id="whatsappValidationResult"></p>
                        @error('whatsAppNumber') <div style="color:red;">{{ $message }}</div> @enderror
                    </div>

                    <div class="form-group">
                        <label for="address"><i class="fas fa-map-marker-alt"></i> Address</label>
                        <input type="text" id="address" name="address" value="{{ old('address') }}" required>
                        @error('address') <div style="color:red;">{{ $message }}</div> @enderror
                    </div>

                    <div class="form-group">
                        <label for="password"><i class="fas fa-lock"></i> Password</label>
                        <input type="password" id="password" name="password" required>
                        @error('password') <div style="color:red;">{{ $message }}</div> @enderror
                    </div>

                    <div class="form-group">
                        <label for="confirmPassword"><i class="fas fa-lock"></i> Confirm Password</label>
                        <input type="password" id="password_confirmation" name="password_confirmation" required>
                        @error('password_confirmation') <div style="color:red;">{{ $message }}</div> @enderror
                    </div>

                    <div class="form-group">
                        <label for="email"><i class="fas fa-envelope"></i> Email</label>
                        <input type="email" id="email" name="email" value="{{ old('email') }}" required>
                        @error('email') <div style="color:red;">{{ $message }}</div> @enderror
                    </div>

                    <div class="form-group">
                        <label for="image"><i class="fas fa-image"></i> Upload Profile Picture</label>
                        <input type="file" id="image" name="image" accept=".jpg,.jpeg,.png,.gif" required>
                        @error('image') <div style="color:red;">{{ $message }}</div> @enderror
                    </div>

                    <button type="submit" class="register-btn">Register</button>
                </form>
            </div>
        </main>
    </div>
    <script src="{{ asset('js/whatsapp-verification.js') }}"></script>
    <script src="{{ asset('js/create.js') }}"></script>
    @include('partials.footer') <!-- This includes footer.blade.php -->
</body>
</html>