@extends('layouts.admin')

@section('content')
<div class="limiter">
        <div class="container-login100">
            <div class="wrap-login100-r">
                <div class="login100-pic js-tilt" data-tilt>
                    <div class="d-flex justify-content-center">
                        <div class="circulo bg-degra p-2 text-center">
    
                            <div class=" circulo-01 v-centro ">
                                    <img src="images/login-01.png" class="w-100" alt="">
                            </div>              
                        </div>
                    </div>
                </div>
                <form class="login100-form validate-form" method="POST" action="/register" novalidate>
                    {{ csrf_field() }}
                    <span class="login100-form-title f-360  sise-t-30 cook-color">
                        Registro de Usuario
                    </span>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="wrap-input100 validate-input" data-validate = "Se requiere un correo electrónico válido: ex@abc.xyz">
                                <input class="input100" type="text" name="email" placeholder="E-mail" value="{{ old('email') }}">
                                <span class="focus-input100"></span>
                                <span class="symbol-input100">
                                    <i class="fa fa-envelope" aria-hidden="true"></i>
                                </span>
                            </div>
                            <div class="wrap-input100 validate-input" data-validate = "Se requiere Nombre de Usuario">
                                <input class="input100" type="text"  id="username" name="username" placeholder="Nombre de Usuario" value="{{ old('username') }}">
                                <span class="focus-input100"></span>
                                <span class="symbol-input100">
                                    <i class="fa fa-envelope" aria-hidden="true"></i>
                                </span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="wrap-input100 validate-input" data-validate = "Contraseña es requerido">
                                <input class="input100" type="password" placeholder="Contraseña" id="password"
                                name="password">
                                <span class="focus-input100"></span>
                                <span class="symbol-input100">
                                    <i class="fa fa-lock" aria-hidden="true"></i>
                                </span>
                            </div>
                            <div class="wrap-input100 validate-input" data-validate = "Contraseña es requerido">
                                <input class="input100" type="password" placeholder="Confirmar Contraseña" id="password_confirmation"
                                name="password_confirmation">
                                <span class="focus-input100"></span>
                                <span class="symbol-input100">
                                    <i class="fa fa-lock" aria-hidden="true"></i>
                                </span>
                            </div>
                            
                            <div class="container-login100-form-btn">
                                <button class="login100-form-btn">
                                        {{ __("Registrarme") }}
                                </button>
                            </div>
                        </div>
                    </div>
                    
    
                    <div class="row mt-2">
                           <!--Validacion -->
                            @if ($errors->any())
                            <div class="text-center">
                                <div class="alerta-d-r  content-02 p-2" >
                                    @foreach ($errors->all() as $error)
                                        <div class="alert alert-danger" role="alert">
                                                <i class="fas fa-exclamation-triangle mr-2"></i>   {{ $error }}
                                        </div>
                                    @endforeach 
                                </div> 
                            </div>
                            @endif
                            <!--Validacion -->
                    </div>
                </form>
            </div>
        </div>
    </div> 


@endsection