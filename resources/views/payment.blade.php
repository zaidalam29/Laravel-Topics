
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <!-- CSRF Token -->
      <meta name="csrf-token" content="{{ csrf_token() }}">
      <title>Laravel 8 - Razorpay Payment Gateway Integration</title>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" crossorigin="anonymous"></script>
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
   </head>
   <body>
      <div id="app">
         <main class="py-4">
            <div class="container">
               <div class="row">
                  <div class="col-md-6 offset-3 col-md-offset-6">
                     @if($message = Session::get('error'))
                     <div class="alert alert-danger alert-dismissible fade in" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                        </button>
                        <strong>Error!</strong> {{ $message }}
                     </div>
                     @endif
                     @if($message = Session::get('success'))
                     <div class="alert alert-success alert-dismissible fade {{ Session::has('success') ? 'show' : 'in' }}" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                        </button>
                        <strong>Success!</strong> {{ $message }}
                     </div>
                     @endif
                     <div class="card card-default">
                        <div class="card-header">
                           Zaid Alam Laravel Razor Pay
                        </div>
                        <div class="card-body text-center">
                           <form action="/payments" method="POST" >
                              @csrf
                              <script src="https://checkout.razorpay.com/v1/checkout.js"
                                 data-key="rzp_test_OQfrXJGuDl0Qpk"
                                 data-amount="50001"
                                 data-currency="INR"
                                 data-buttontext="Pay 500 INR"
                                 data-name="Zaid Razor"
                                 data-description="Rozerpay"
                                 data-image="data:image/jpeg;base64,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"
                                 data-prefill.name="Zaid alam"
                                 data-prefill.email="bsk.badshahkhan@gmail.com"
                                 data-theme.color="#F37254"></script>
                           </form>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </main>
      </div>
   </body>
</html>
