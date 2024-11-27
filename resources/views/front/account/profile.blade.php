@extends('front.layouts.app')

@section('main')
<section class="section-5 bg-2">
    <div class="container py-5">
        <div class="row">
            <div class="col">
                <nav aria-label="breadcrumb" class=" rounded-3 p-3 mb-4">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Account Settings</li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-3">
                @include('front.account.sidebar')
            </div>
            <div class="col-lg-9">
                @include('front.message')
                <div class="card border-0 shadow mb-4">
                    <form action="{{ route('account.updateProfile') }}" method="POST" id="userForm" name="userForm">
                        @csrf
                        @method('PUT')
                     <div class="card-body  p-4">
                        <h3 class="fs-4 mb-1">My Profile</h3>
                        <div class="mb-4">
                            <label for="" class="mb-2">Name*</label>
                            <input name="name" type="text" placeholder="Enter Name" class="form-control" value="{{ $user->name }}" id="name">
                            <p></p>
                        </div>
                        <div class="mb-4">
                            <label for="" class="mb-2">Email*</label>
                            <input type="text" placeholder="Enter Email" class="form-control" name="email" id="email" value="{{ $user->email }}">
                            <p></p>
                        </div>
                        <div class="mb-4">
                            <label for="" class="mb-2">Designation*</label>
                            <input type="text" placeholder="Designation" class="form-control" name="designation" id="designation" value="{{ $user->designation }}">
                            <p></p>
                        </div>
                        <div class="mb-4">
                            <label for="" class="mb-2">Mobile*</label>
                            <input type="text" placeholder="Mobile" class="form-control" name="mobile" id="mobile" value="{{ $user->mobile }}">
                            <p></p>
                        </div>                        
                    </div>
                    <div class="card-footer  p-4">
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>   
                    </form>
                    
                </div>

                <div class="card border-0 shadow mb-4">
                    <div class="card-body p-4">
                        <h3 class="fs-4 mb-1">Change Password</h3>
                        <div class="mb-4">
                            <label for="" class="mb-2">Old Password*</label>
                            <input type="password" placeholder="Old Password" class="form-control">
                        </div>
                        <div class="mb-4">
                            <label for="" class="mb-2">New Password*</label>
                            <input type="password" placeholder="New Password" class="form-control">
                        </div>
                        <div class="mb-4">
                            <label for="" class="mb-2">Confirm Password*</label>
                            <input type="password" placeholder="Confirm Password" class="form-control">
                        </div>                        
                    </div>
                    <div class="card-footer  p-4">
                        <button type="button" class="btn btn-primary">Update</button>
                    </div>
                </div>                
            </div>
        </div>
    </div>
</section>
@endsection

@section('customJs')
<script type="text/javascript">
$('#userForm').submit(function (e) {
    e.preventDefault(); // Prevent default form submission

    $.ajax({
        url: "{{ route('account.updateProfile') }}", // Ensure the route is correct
        type: "PUT", // Ensure the method matches the form submission
        data: $(this).serialize(), // Serialize form data
        success: function (response) {
            if (response.status === true) {
                // Redirect to the profile page on success
                window.location.href = "{{ route('account.profile') }}";
            } else {
                // Handle validation errors
                let errors = response.errors;

                if (errors.name) {
                    $("#name").addClass('is-invalid').siblings('p').text(errors.name);
                } else {
                    $("#name").removeClass('is-invalid').siblings('p').text('');
                }

                if (errors.email) {
                    $("#email").addClass('is-invalid').siblings('p').text(errors.email);
                } else {
                    $("#email").removeClass('is-invalid').siblings('p').text('');
                }

                // Repeat for other fields if necessary
            }
        },
        error: function (xhr, status, error) {
            alert("An error occurred. Please try again.");
        },
    });
});

        // $('#userForm').submit(function(e){
        //     e.preventDefault();
        //     var name = $('#name').val();
        //     var email = $('#email').val();
        //     var designation = $('#designation').val();
        //     var mobile = $('#mobile').val();
        //     $.ajax({
        //         url: "{{ route('account.updateProfile') }}",
        //         type: "put",
        //         dataType: "json",
        //         data: $(#userForm).serializeArray(),
        //         success: function(response){

        //             if(response.status == true){
        //                 $("#name").removeClass('is-invalid').siblings('p').removeClass('invalid-feedback').text('');
        //                 $("#email").removeClass('is-invalid').siblings('p').removeClass('invalid-feedback').text('');

        //                 window.location.href = "{{ route('account.profile') }}";
        //             }
        //             else{
        //                 var errors= response.errors;

        //             }
        //             if(errors.name){
        //                 $("#name").addClass('is-invalid').siblings('p').addClass('invalid-feedback').text(errors.name);
        //             }else{
        //                 $("#name").removeClass('is-invalid').siblings('p').removeClass('invalid-feedback').text('');
        //             }
        //             if(errors.email){
        //                 $("#email").addClass('is-invalid').siblings('p').addClass('invalid-feedback').text(errors.email);
        //             }else{
        //                 $("#email").removeClass('is-invalid').siblings('p').removeClass('invalid-feedback').text('');
        //             }
        //         }
        //     });
        // });
    
</script>
@endsection