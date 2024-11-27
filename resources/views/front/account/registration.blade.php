@extends('front.layouts.app')

@section('main')
<section class="section-5">
    <div class="container my-5">
        <div class="py-lg-2">&nbsp;</div>
        <div class="row d-flex justify-content-center">
            <div class="col-md-5">
                <div class="card shadow border-0 p-5">
                    <h1 class="h3">Register</h1>
                    <form action="" name="registrationForm" id="registrationForm">
                        <div class="mb-3">
                            <label for="" class="mb-2">Name*</label>
                            <input type="text" name="name" id="name" class="form-control" placeholder="Enter Name">
                            <p></p>
                        </div> 
                        <div class="mb-3">
                            <label for="" class="mb-2">Email*</label>
                            <input type="text" name="email" id="email" class="form-control" placeholder="Enter Email">
                            <p></p>

                        </div> 
                        <div class="mb-3">
                            <label for="" class="mb-2">Password*</label>
                            <input type="password" name="password" id="name" class="form-control" placeholder="Enter Password">
                            <p></p>

                        </div> 
                        <div class="mb-3">
                            <label for="" class="mb-2">Confirm Password*</label>
                            <input type="password" name="confirm_password" id="name" class="form-control" placeholder="Confirm Password">
                            <p></p>

                        </div> 
                        <button class="btn btn-primary mt-2">Register</button>
                    </form>                    
                </div>
                <div class="mt-4 text-center">
                    <p>Have an account? <a  href="{{ route('account.login') }}">Login</a></p>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('customJs')
<script>
    $("#registrationForm").submit(function(e){
        e.preventDefault();
        var name = $("#name").val();
        var email = $("#email").val();
        var password = $("#password").val();
        var confirm_password = $("#confirm_password").val();
        if(name == ''){
            alert('Name is required');
            return false;
        }
        if(email == ''){
            alert('Email is required');
            return false;
        }
        if(password == ''){
            alert('Password is required');
            return false;
        }
        if(confirm_password == ''){
            alert('Confirm Password is required');
            return false;
        }
        if(password != confirm_password){
            alert('Password and Confirm Password does not match');
            return false;
        }
        $.ajax({
            url: "{{ route('account.processRegistration') }}",
            type: "POST",
            data: $("#registrationForm").serializeArray(),
            dataType: "json",
            success: function(response){
                var errors=response.errors;
                if(errors){
                    if(errors.name){
                        $("#name").addClass('is-invalid').siblings('p').addClass('invalid-feedback').text(errors.name);
                    }else{
                        $("#name").removeClass('is-invalid').siblings('p').removeClass('invalid-feedback').text('');
                    }
                    if(errors.email){
                        $("#email").addClass('is-invalid').siblings('p').addClass('invalid-feedback').text(errors.email);
                    }else{
                        $("#email").removeClass('is-invalid').siblings('p').removeClass('invalid-feedback').text('');
                    }
                    if(errors.password){
                        $("#password").addClass('is-invalid').siblings('p').addClass('invalid-feedback').text(errors.password);
                    }else{
                        $("#password").removeClass('is-invalid').siblings('p').removeClass('invalid-feedback').text('');
                    }
                    if(errors.confirm_password){
                        $("#confirm_password").addClass('is-invalid').siblings('p').addClass('invalid-feedback').text(errors.confirm_password);
                    }else{
                        $("#confirm_password").removeClass('is-invalid').siblings('p').removeClass('invalid-feedback').text('');
                        window.location.href = "{{ route('account.login') }}";

                    
                }
            }else{

            }
        }
    });
    });
</script>
@endsection