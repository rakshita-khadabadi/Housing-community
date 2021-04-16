@extends('city-view.home')

@section('title', 'Sign Up')

@section('content')
<div class="topnav">
    City View
    <a href="./login.php">Login</a>
    <a class="active" href="./sign-up.php">SignUp</a>
    <a href="./contact_us.php">Contact Us</a>
    <a href="/blog">Forum</a>
    <a href="./about.php">About Us</a>
    <a href="../index.php">Home</a>
</div>
<div class="container">
    <h2 class="sign" align="center" style="color:#4F4846;">Sign up</h2> <br>
    <div>

        @if (session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <!-- <form  class="ContactUsForm" action="mailto:user@yahoomail.com" method="POST"> -->
        <form class="ContactUsForm" method="POST">
            @csrf
            <div>
                <div>
                    <label for="fname"></label>
                    <input type="text" id="fname" name="firstName" value="" required placeholder="First Name"> &nbsp
                    <label for="lname"></label>
                    <input type="text" id="lname" name="lastName" value="" required placeholder="Last Name"> <br><br>
                    <label for="email"></label>
                    <input type="email" id="email" name="email" value="" required placeholder="Email"> <br><br>
                    <label for="password"></label>
                    <input type="password" id="password" name="password" pattern="[A-Za-z0-9]{8,12}" title="Password should be within 8-12 charaters" value="" required placeholder="Password"> <br><br>
                    <label for="repassword"></label>
                    <input type="password" id="repassword" name="retypePassword" pattern="[A-Za-z0-9]{8,12}" title="Password should be within 8-12 charaters" value="" required placeholder="Retype Password"> <br><br>
                </div>
                <div>
                    <label for="address1" style="color:#4F4846;">User's Address:</label> <br>
                    <input type="text" id="address1" name="addressStreet1" value="" required placeholder="Street 1"><br><br>
                    <label for="address2"></label>
                    <input type="text" id="address2" name="addressStreet2" value="" placeholder="Street 2"><br><br>
                    <label for="city"></label>
                    <input type="text" id="city" name="userCity" value="" required placeholder="City"><br><br>
                    <label for="state"></label>
                    <input type="text" id="state" name="userState" value="" required placeholder="State"> <br><br>
                    <label for="zip"> </label>
                    <input type="text" id="zip" name="userZipCode" value="" required placeholder="Zip Code"> <br><br>
                    <label for="phno"> </label>
                    <label for="country"></label>
                    <input type="text" id="country" name="userCountry" required value="" placeholder="Country"><br><br>
                    <input type="tel" id="phno" name="userPhoneNumber" required value="" pattern="[0-9]{7,10}" title="Phone number must be between 7-10 numbers" placeholder="Phone Number"><br><br>
                </div>
            </div>

            <div>

                <label for="rname">Responsible Contact Details</label>
                <input type="text" id="rname" name="rcName" value="" required placeholder="Name"> <br><br>

                <label for="raddress"></label> <br>
                <input type="text" id="raddress" name="rcAddress" value="" required placeholder="Address"><br><br>

                <label for="rcity"></label>
                <input type="text" id="rcity" name="rcCity" value="" required placeholder="City"><br><br>
                <label for="rcountry"></label>
                <input type="text" id="rcountry" name="rcCountry" value="" required placeholder="Country"><br><br>

                <label for="rzip"> </label>
                <input type="text" id="rzip" name="rcZipCode" value="" required placeholder="Zip Code"> <br><br>
                <label for="rphno"> </label>
                <input type="tel" id="rphno" name="rcPhoneNumber" value="" required pattern="[0-9]{7,10}" title="Phone number must be between 7-10 numbers" placeholder="Phone Number"> <br><br>
            </div>
            <div>

                <label for="role">Role:</label>
                <select name="roleId" id="role" onchange="getRoleDropdownValue()">
                    <?php foreach ($rolesList as $role): ?>
                    <option value="<?= htmlspecialchars($role->id); ?>"><?= htmlspecialchars($role->role_name); ?></option>
                    <?php endforeach; ?>

                </select><br><br>

                <label for="subdivision">Choose Subdivision:</label>
                <select name="subdivisionId" id="subdivision" onchange="getSubdivisionDropdownValue()" onclick="getSubdivisionDropdownValue()">
                    <?php foreach ($subdivisionsList as $subdivision): ?>
                    <option value="<?= htmlspecialchars($subdivision->id); ?>"><?= htmlspecialchars($subdivision->subdivision_name); ?></option>
                    <?php endforeach; ?>

                </select>
                <br><br>


                <div id="building-dropdown" class="building-dropdown-list">
                    <label for="building">Choose Building:</label>
                    <select name="buildingId" id="building" onchange="getBuildingDropdownValue()" onclick="getBuildingDropdownValue()">
                        <?php foreach ($buildingsList as $building): ?>

                        <div>

                            <option class="building-dropdown-option building-subdivision-<?= htmlspecialchars($building->subdivisions_id); ?>" value="<?= htmlspecialchars($building->id); ?>">
                                <?= htmlspecialchars($building->building_name); ?>
                            </option>
                        </div>

                        <?php endforeach; ?>
                    </select>

                </div>

                <div id="apartment-dropdown" class="apartment-dropdown-list">
                    <label for="apartment">Choose Apartment:</label>

                    <select name="apartmentId" id="apartment">
                        <?php foreach ($apartmentsList as $apartment): ?>
                        <div>
                            <option class="apartment-dropdown-option apartment-building-<?= htmlspecialchars($apartment->buildings_id); ?>" value="<?= htmlspecialchars($apartment->id); ?>">
                                <?= htmlspecialchars($apartment->apartment_number); ?>
                            </option>
                        </div>
                        <?php endforeach; ?>
                    </select>
                    <br><br>

                    <p>Choose Service Provider for Utilities:</p><br>
                    <p>Electricity</p>
                    <input type="radio" name="electricityServiceProvider" value="subdivision services">
                    <label for="">Subdivision Services</label><br>
                    <input type="radio" name="electricityServiceProvider" value="self-service">
                    <label for="">Self-Service</label>

                    <br><br>

                    <p>Gas</p>
                    <input type="radio" name="gasServiceProvider" value="subdivision services">
                    <label for="">Subdivision Services</label><br>
                    <input type="radio" name="gasServiceProvider" value="self-service">
                    <label for="">Self-Service</label>

                    <br><br>

                    <p>Water</p>
                    <input type="radio" name="waterServiceProvider" value="subdivision services">
                    <label for="">Subdivision Services</label><br>
                    <input type="radio" name="waterServiceProvider" value="self-service">
                    <label for="">Self-Service</label>

                    <br><br>

                    <p>Internet is mandatory self-service </p>
                    <input type="radio" name="internetServiceProvider" value="self-service">
                    <label for="">Self-Service</label>

                </div>
                <br>
                <br>





            </div>
            <div class="SignUpFormButtons" style="text-align: center;">
                <input id="btnSubmit" type="submit" value="Submit"> &nbsp;&nbsp;
                <input type="reset">
            </div>

        </form>
    </div>
</div>



<footer>
    <p align="center" class="footer">
        <span style="float: left;">All Rights Reserved</span>
        <a href="https://www.instagram.com"><i class="fab fa-instagram"></i></a> &nbsp;&nbsp;
        <a href="https://facebook.com"><i class="fab fa-facebook"></i></a>&nbsp;&nbsp;
        <a href="https://youtube.com"><i class="fab fa-youtube"></i></a>&nbsp;&nbsp;
        <span style="float: right;">www.cityview.com</span>
    </p>
</footer>

<script src="{{ asset('js/sign-up.js') }}"> </script>

@endsection
