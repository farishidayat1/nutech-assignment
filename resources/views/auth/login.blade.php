<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>Sims Web App</title>

        <link href="{{ asset('template-asset/css/auth.css') }}" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    </head>
    <body>
        <div class="gradient-form">
            <div class="card rounded-3 text-black">
                <div class="row gradient-form">
                    <div class="col-lg-6">
                        <div class="table">
                            <div class="table-cell">
                                <div class="card-body d-flex justify-content-center">
                                    <div class="col-md-8">
                                        <div class="text-center">
                                            <div class="d-flex justify-content-center">
                                                <img class="mt-2" src="{{ asset('cms-assets/Handbag.png')}}" style="width: 25px; height: 25px; background: #F13B2F;" alt="logo">
                                                <h4 class="ml-2 mt-1 mb-5 pb-1">SIMS Web App</h4>
                                            </div>
                                            <h4 class="mt-1 mb-5 pb-1" style="font-size: 30px; font-weight: bolder;">Masuk atau buat akun <br/> untuk memulai</h4>
                                        </div>
        
                                        @if(session()->has('success_message'))
                                            <div class="alert alert-success">
                                                {{ session()->get('success_message') }}
                                            </div>
                                        @endif
                                        @if(session()->has('error_message'))
                                            <div class="alert alert-error">
                                                {{ session()->get('error_message') }}
                                            </div>
                                        @endif
                                            
                                        <div class="form-group">
                                            <form class="user" action="{{ route('login') }}" method="POST">
                                                @csrf
                                                <div data-mdb-input-init class="form-outline mb-4">
                                                    <input type="email" name="email" id="form2Example11" class="form-control form-custom" placeholder="masukan email anda" />
                                                </div>
                                
                                                <div data-mdb-input-init class="form-outline mb-4">
                                                    <input type="password" name="password" id="form2Example22" class="form-control form-custom" placeholder="masukan password anda" />
                                                </div>
                                
                                                <div class="text-center pt-1 mt-5 mb-5 pb-1">
                                                    <button data-mdb-button-init data-mdb-ripple-init class="form-custom btn btn-block fa-lg mb-3" style="background: #F13B2F; color: white !important;" type="submit">
                                                        Masuk
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 d-flex align-items-center gradient-custom-2"></div>
                </div>
            </div>
        </div>
    </body>
</html>
