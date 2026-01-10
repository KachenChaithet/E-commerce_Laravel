<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Product Detail | GIFTOS</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="shortcut icon" href="front_end/images/favicon.png" type="image/x-icon">

    <title>
        Giftos
    </title>
    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" />

    <!-- bootstrap core css -->
    <link rel="stylesheet" type="text/css" href="front_end/css/bootstrap.css" />

    <!-- Custom styles for this template -->
    <link href="front_end/css/style.css" rel="stylesheet" />
    <!-- responsive style -->
    <link href="front_end/css/responsive.css" rel="stylesheet" />
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css" />

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
</head>

<body class="bg-gray-50 text-gray-800 min-h-screen  flex flex-col">

    <!-- Header -->


    <main class="flex-grow">
        @yield('product_details')
        @yield('all_products')
        @yield('viewcart_products')
        @yield('stripe_view')
    </main>

    <!-- Footer -->
    <footer class="bg-neutral-800 text-gray-300 mt-16 py-10">
        <div class="max-w-6xl mx-auto grid grid-cols-1 md:grid-cols-4 gap-8 text-sm">
            <div>
                <h4 class="font-semibold text-white mb-3">ABOUT US</h4>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
            </div>
            <div>
                <h4 class="font-semibold text-white mb-3">NEWSLETTER</h4>
                <input type="email" placeholder="Enter your email" class="w-full px-3 py-2 rounded text-black mb-2">
                <button class="bg-pink-500 w-full py-2 rounded text-white">Subscribe</button>
            </div>
            <div>
                <h4 class="font-semibold text-white mb-3">NEED HELP</h4>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
            </div>
            <div>
                <h4 class="font-semibold text-white mb-3">CONTACT US</h4>
                <p>Gb road 123 london Uk</p>
                <p>+01 234567890</p>
                <p>demo@gmail.com</p>
            </div>
        </div>
        <p class="text-center text-xs mt-10">© 2026 All Rights Reserved By Web Tech Knowledge</p>
    </footer>
    <!-- JavaScript files-->

    <script src="front_end/js/jquery-3.4.1.min.js"></script>
    <script src="front_end/js/bootstrap.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
    <script src="front_end/js/custom.js"></script>

    <script type="text/javascript" src="https://js.stripe.com/v2/"></script>



    <script type="text/javascript">
        $(function() {






            $('form.require-validation').on('submit', function(e) {
                e.preventDefault();

                var $form = $(this);


                inputSelector = ['input[type=email]', 'input[type=password]',

                        'input[type=text]', 'input[type=file]',

                        'textarea'
                    ].join(', '),

                    $inputs = $form.find('.required').find(inputSelector),

                    $errorMessage = $form.find('div.error'),

                    valid = true;

                $errorMessage.addClass('hide');



                $('.has-error').removeClass('has-error');

                $inputs.each(function(i, el) {

                    var $input = $(el);

                    if ($input.val() === '') {

                        $input.parent().addClass('has-error');

                        $errorMessage.removeClass('hide');

                        e.preventDefault();

                    }

                });



                if (!$form.data('cc-on-file')) {

                    e.preventDefault();

                    Stripe.setPublishableKey($form.data('stripe-publishable-key'));

                    Stripe.card.createToken({
                        number: $form.find('.card-number').val(),
                        cvc: $form.find('.card-cvc').val(),
                        exp_month: $form.find('.card-expiry-month').val(),
                        exp_year: $form.find('.card-expiry-year').val()
                    }, stripeResponseHandler);

                }



            });



            /*------------------------------------------

            --------------------------------------------

            Stripe Response Handler

            --------------------------------------------

            --------------------------------------------*/

            function stripeResponseHandler(status, response) {

                if (response.error) {

                    $('.error')

                        .removeClass('hide')

                        .find('.alert')

                        .text(response.error.message);

                } else {

                    /* token contains id, last4, and card type */

                    var token = response['id'];



                    $form.find('input[type=text]').empty();

                    Stripe.card.createToken({
                        ...
                    }, function(status, response) {
                        if (response.error) {
                            alert(response.error.message);
                        } else {
                            $form.append(
                                "<input type='hidden' name='stripeToken' value='" + response.id + "'/>"
                            );
                            $form.get(0).submit();
                        }
                    });


                }

            }



        });
    </script>
</body>

</html>
