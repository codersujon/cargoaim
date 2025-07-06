<!DOCTYPE html>
<html lang="zxx">

<head>

    @php
        $profile = \Modules\Auth\Models\Profile::first();
        $sliders = \Modules\Auth\Models\LoginPageSlider::where('status', 'A')->orderBy('id', 'asc')->get();
    @endphp

    <title>{{ $profile ? $profile->name : '' }}</title>

    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta charset="UTF-8" />
    <!-- External CSS libraries -->
    <link rel="shortcut icon" href="{{ asset('upload/' . ($profile->logo ?? 'default.png')) }}" type="image/x-icon" />

    <link type="text/css" rel="stylesheet" href="{{ asset('login') }}/assets/css/bootstrap.min.css" />
    <link type="text/css" rel="stylesheet"
        href="{{ asset('login') }}/assets/fonts/font-awesome/css/font-awesome.min.css" />
    <link type="text/css" rel="stylesheet" href="{{ asset('login') }}/assets/fonts/flaticon/font/flaticon.css" />
    <!-- Google fonts -->
    <link rel="stylesheet" type="text/css"
        href="https://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700,800%7CPoppins:400,500,700,800,900%7CRoboto:100,300,400,400i,500,700" />
    <link href="https://fonts.googleapis.com/css2?family=Jost:wght@300;400;500;600;700;800;900&amp;display=swap"
        rel="stylesheet" />
    <link type="text/css" rel="stylesheet" href="{{ asset('login') }}/assets/css/style.css" />
    <link rel="stylesheet" type="text/css" id="style_sheet"
        href="{{ asset('login') }}/assets/css/skins/default.css" />

    <!-- fontwasome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css"
        integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="stylesheet" type="text/css" id="style_sheet" href="{{ asset('login') }}/style.css" />

</head>

<body id="top">
    <div class="page_loader"></div>
    <div class="login-13">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-6 col-md-12 bg-img">
                    <div class="bg-img-inner">

                        @foreach ($sliders as $slider)
                            <div class="info">
                                <div class="center">
                                    <h1>{{ $slider->title }}</h1>
                                </div>
                                <p>{{ $slider->description }}</p>
                            </div>
                        @endforeach

                    </div>
                </div>

                <div class="col-lg-6 col-md-12 form-info">
                    <div class="form-section">
                        <div class="form-section-innner">
                            <div class="logo clearfix">
                                <a href="login-13.html">
                                    <img src="{{ asset('upload/' . ($profile->fav_icon ?? 'default.png')) }}" alt="logo" />
                                </a>
                            </div>
                            <h3>Sign Into Your Account</h3>
                            {{-- <div class="btn-section clearfix">
                                <a href="login-13.html" class="link-btn active btn-1 default-bg">Login</a>
                            </div> --}}
                            <div class="login-inner-form">

                                <form action="{{ route('user.login.store') }}" method="post">
                                    @csrf
                                    <div class="form-group form-box clearfix">
                                        <input name="userId" type="text" class="form-control"
                                            placeholder="Username" aria-label="Username" autocomplete="off"/>
                                            <i class="flaticon-mail-2"></i>
                                        @error('userId')
                                            <div style="color:red; text-align: left;">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group form-box clearfix">
                                        <input name="password" type="password" class="form-control" autocomplete="off"
                                            placeholder="Password" aria-label="Password" />
                                            <i class="flaticon-password"></i>
                                            @error('password')
                                                <div style="color:red; text-align: left;">{{ $message }}</div>
                                            @enderror
                                    </div>
                                    <div class="checkbox form-group clearfix">
                                        <div class="form-check float-start">
                                            <input class="form-check-input" type="checkbox" id="rememberme" />
                                            <label class="form-check-label" for="rememberme"> Remember me </label>
                                        </div>
                                        <a href="forgot-password-13.html"
                                            class="link-light float-end forgot-password">Forgot password?</a>
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary btn-lg btn-theme">Login</button>
                                    </div>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <button type="button" class="settings-button" id="settingsButton">
        <i class="fa-solid fa-gear"></i>
    </button>

    <div class="popup" id="colorPickerPopup">
        <div class="popup-header">
            Customize Colors
            <button class="btn btn-primary" id="resetButton" style="float: right">Default</button>
        </div>
        <div class="row">
            <div class="col-6">
                <label class="color-picker-label">Start Color</label>
                <input type="color" id="startColorPicker" class="color-picker" />
            </div>
            <div class="col-6">
                <label class="color-picker-label">End Color</label>
                <input type="color" id="endColorPicker" class="color-picker" />
            </div>
        </div>
        <br />

        <h6>Background Color</h6>
        <div class="row">
            <div class="col-6">
                <label class="color-picker-label">Start Color</label>
                <input type="color" id="startColorPickerBG" class="color-picker" />
            </div>
            <div class="col-6">
                <label class="color-picker-label">Middle Color</label>
                <input type="color" id="middleColorPicker" class="color-picker" />
            </div>
            <div class="col-12">
                <label class="color-picker-label">End Color</label>
                <input type="color" id="endColorPickerBG" class="color-picker" />
            </div>
        </div>
        <br />

        <h6>Login Button Color</h6>
        <div class="row">
            <div class="col-6">
                <label class="color-picker-label">Start Color</label>
                <input type="color" id="startColorPickerLG" class="color-picker" />
            </div>
            <div class="col-6">
                <label class="color-picker-label">End Color</label>
                <input type="color" id="endColorPickerLG" class="color-picker" />
            </div>
        </div>
        <br />
        <h6>Text Color</h6>
        <div class="row">
            <div class="col-6">
                <label class="color-picker-label"> Color</label>
                <input type="color" id="textColorPicker" class="color-picker" />
            </div>
        </div>
    </div>

    <script src="{{ asset('login') }}/assets/js/jquery.min.js"></script>
    <script src="{{ asset('login') }}/assets/js/popper.min.js"></script>
    <script src="{{ asset('login') }}/assets/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            let currentIndex = 0;
            let items = $(".info");

            // Initially hide all items and show the first item with active class
            items.removeClass("active").css({
                opacity: 0,
                transform: "translateX(100%)", // Start off-screen
                transition: "transform 0.6s ease, opacity 0.6s ease", // Smoother transition for opacity and transform
            });
            items.eq(currentIndex).addClass("active").css({
                opacity: 1,
                transform: "translateX(0)", // Move to original position
                transition: "transform 0.6s ease, opacity 0.6s ease",
            });

            function slideShow() {
                // Remove active class and reset transition on current item
                items.eq(currentIndex).removeClass("active").css({
                    opacity: 0,
                    transform: "translateX(-100%)", // Slide out smoothly to the left
                    transition: "transform 0.6s ease, opacity 0.6s ease",
                });

                // Move to the next item and add active class to it
                currentIndex = (currentIndex + 1) % items.length;

                // Add active class to the next item
                items.eq(currentIndex).addClass("active").css({
                    opacity: 0,
                    transform: "translateX(100%)", // Start off-screen from the right
                    transition: "transform 0.6s ease, opacity 0.6s ease",
                });

                // Adding a delay for the item to slide in
                setTimeout(() => {
                    items.eq(currentIndex).css({
                        opacity: 1,
                        transform: "translateX(0)", // Slide to its final position smoothly
                    });
                }, 200); // Shortened the delay to make it feel quicker
            }

            // Set interval to switch slides every 5 seconds
            setInterval(slideShow, 5000); // 5 seconds interval between slides

            //Slider End

            $("#settingsButton").click(function(event) {
                event.preventDefault();
                $(".popup").toggleClass("open"); // Toggle the popup visibility
                $(this).toggleClass("popup-open"); // Move settings button to the left side of the popup
            });

            $("#popupCloseButton").click(function() {
                $(".popup").removeClass("open"); // Close popup when close button is clicked
                $("#settingsButton").removeClass("popup-open"); // Reset settings button position
            });

            // Popup er bahire click korle close hobe
            $(document).on("click", function(event) {
                if (!$(event.target).closest(".popup, #settingsButton").length) {
                    $(".popup").removeClass("open");
                    $("#settingsButton").removeClass("popup-open");
                }
            });

            let startColor = localStorage.getItem("start_color") || "#ffb400";
            let endColor = localStorage.getItem("end_color") || "#ff8a00";

            // Set color picker inputs with stored values
            $("#startColorPicker").val(startColor);
            $("#endColorPicker").val(endColor);

            // Apply gradients initially
            updateBackgrounds(startColor, endColor);

            // Listen for color picker changes
            $("#startColorPicker").on("input", function() {
                let newStartColor = $(this).val();
                localStorage.setItem("start_color", newStartColor);
                updateBackgrounds(newStartColor, $("#endColorPicker").val());
            });

            $("#endColorPicker").on("input", function() {
                let newEndColor = $(this).val();
                localStorage.setItem("end_color", newEndColor);
                updateBackgrounds($("#startColorPicker").val(), newEndColor);
            });

            // Update both .default-bg and ::before / ::after backgrounds
            function updateBackgrounds(start, end) {
                // For normal element
                $(".default-bg").css("background-image", `linear-gradient(to bottom, ${start}, ${end})`);

                // For pseudo-elements
                let styleTag = $("#bg-gradient-style");

                if (!styleTag.length) {
                    styleTag = $("<style id='bg-gradient-style'></style>");
                    $("head").append(styleTag);
                }

                styleTag.html(
                    `.bg-img-inner::before, .bg-img-inner::after { background-image: linear-gradient(to bottom, ${start}, ${end}) !important; } `
                );
            }

            // Background Color
            let startColorBG = localStorage.getItem("start_color_bg") || "#FC415A";
            let middleColorBG = localStorage.getItem("middle_color_bg") || "#591BC5";
            let endColorBG = localStorage.getItem("end_color_bg") || "#212335";

            // Set color picker inputs with stored values
            $("#startColorPickerBG").val(startColorBG);
            $("#middleColorPicker").val(middleColorBG);
            $("#endColorPickerBG").val(endColorBG);

            // Apply gradients initially
            updateBackgroundsBG(startColorBG, middleColorBG, endColorBG);

            // Listen for color picker changes
            $("#startColorPickerBG").on("input", function() {
                let newStartColorBG = $(this).val();
                localStorage.setItem("start_color_bg", newStartColorBG);
                updateBackgroundsBG(newStartColorBG, $("#middleColorPicker").val(), $("#endColorPickerBG")
                    .val());
            });

            $("#middleColorPicker").on("input", function() {
                let newMiddleColorBG = $(this).val();
                localStorage.setItem("middle_color_bg", newMiddleColorBG);
                updateBackgroundsBG($("#startColorPickerBG").val(), newMiddleColorBG, $("#endColorPickerBG")
                    .val());
            });

            $("#endColorPickerBG").on("input", function() {
                let newEndColorBG = $(this).val();
                localStorage.setItem("end_color_bg", newEndColorBG);
                updateBackgroundsBG($("#startColorPickerBG").val(), $("#middleColorPicker").val(),
                    newEndColorBG);
            });

            // Update both .default-bg and ::before / ::after backgrounds
            function updateBackgroundsBG(startbg, middlebg, endbg) {
                let styleTagBG = $("#bg-gradient-styleBG");

                if (!styleTagBG.length) {
                    styleTagBG = $("<style id='bg-gradient-styleBG'></style>");
                    $("head").append(styleTagBG);
                }

                styleTagBG.html(
                    `.login-13 { background: linear-gradient(132deg, ${startbg}, ${middlebg}, ${endbg}); background-size: 400% 400%; animation: Gradient 15s ease infinite;} @keyframes Gradient {0% {background-position: 0% 50%;} 50% {background-position: 100% 50%; } 100% { background-position: 0% 50%;} .login-13 .btn-theme:hover { filter: brightness(1.1); transform: scale(1.02);}}`
                );
            }

            // Get colors from localStorage or use defaults
            let startColorLG = localStorage.getItem("start_color_lg") || "#ffb400";
            let endColorLG = localStorage.getItem("end_color_lg") || "#ff8a00";

            // Set color picker inputs with stored values
            $("#startColorPickerLG").val(startColorLG);
            $("#endColorPickerLG").val(endColorLG);

            // Apply gradients initially
            updateBackgroundsLG(startColorLG, endColorLG);

            // Listen for color picker changes
            $("#startColorPickerLG").on("input", function() {
                let newStartColorLG = $(this).val();
                localStorage.setItem("start_color_lg", newStartColorLG);
                updateBackgroundsLG(newStartColorLG, $("#endColorPickerLG").val());
            });

            $("#endColorPickerLG").on("input", function() {
                let newEndColorLG = $(this).val();
                localStorage.setItem("end_color_lg", newEndColorLG);
                updateBackgroundsLG($("#startColorPickerLG").val(), newEndColorLG);
            });

            // Function to apply gradient to .btn-theme (not .btn-primary anymore)
            function updateBackgroundsLG(startlg, endlg) {
                let styleTagLG = $("#bg-gradient-stylelg");

                if (!styleTagLG.length) {
                    styleTagLG = $("<style id='bg-gradient-stylelg'></style>");
                    $("head").append(styleTagLG);
                }

                styleTagLG.html(
                    `.login-13 .btn-theme { background-image: linear-gradient(to bottom, ${startlg}, ${endlg}) !important; border: none !important; color: #fff !important; } } `
                );
            }

            // Get colors from localStorage or use defaults text color
            let textColor = localStorage.getItem("text_color") || "#ffffff";
            $("#textColorPicker").val(textColor); // Set the color picker value

            // Apply gradients and text color initially
            updateBackgroundsText(textColor);

            // Listen for color picker changes
            $("#textColorPicker").on("input", function() {
                let newTextColor = $(this).val();
                localStorage.setItem("text_color", newTextColor); // Save color in localStorage
                updateBackgroundsText(newTextColor); // Update text color
            });

            // Function to update text color dynamically
            function updateBackgroundsText(colortext) {
                let styleTagText = $("#texts-color");

                // If the style tag doesn't exist, create it
                if (!styleTagText.length) {
                    styleTagText = $("<style id='texts-color'></style>");
                    $("head").append(styleTagText);
                }

                // Update the style tag with the new text color
                styleTagText.html(
                    `.login-13 .form-section h3, .login-13 .login-inner-form .form-check-label, .login-13 .login-inner-form .checkbox a { color: ${colortext} !important;}`
                );
            }

            $("#resetButton").click(function() {
                // Reset colors to default values
                let defaultStartColor = "#ffb400";
                let defaultEndColor = "#ff8a00";
                let defaultStartColorBG = "#FC415A";
                let defaultMiddleColorBG = "#591BC5";
                let defaultEndColorBG = "#212335";
                let defaultStartColorLG = "#ffb400";
                let defaultEndColorLG = "#ff8a00";
                let defaultTextColor = "#ffffff";

                // Set color picker inputs to default values
                $("#startColorPicker").val(defaultStartColor);
                $("#endColorPicker").val(defaultEndColor);
                $("#startColorPickerBG").val(defaultStartColorBG);
                $("#middleColorPicker").val(defaultMiddleColorBG);
                $("#endColorPickerBG").val(defaultEndColorBG);
                $("#startColorPickerLG").val(defaultStartColorLG);
                $("#endColorPickerLG").val(defaultEndColorLG);
                $("#textColorPicker").val(defaultTextColor);

                // Apply default background gradients and text colors
                updateBackgrounds(defaultStartColor, defaultEndColor);
                updateBackgroundsBG(defaultStartColorBG, defaultMiddleColorBG, defaultEndColorBG);
                updateBackgroundsLG(defaultStartColorLG, defaultEndColorLG);
                updateBackgroundsText(defaultTextColor);

                // Clear the localStorage for color settings
                localStorage.removeItem("start_color");
                localStorage.removeItem("end_color");
                localStorage.removeItem("start_color_bg");
                localStorage.removeItem("middle_color_bg");
                localStorage.removeItem("end_color_bg");
                localStorage.removeItem("start_color_lg");
                localStorage.removeItem("end_color_lg");
                localStorage.removeItem("text_color");
            });
        });
    </script>
</body>

</html>