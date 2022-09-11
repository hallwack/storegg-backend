@extends('layouts.contentLayoutMaster')

@section('title', 'Account')

@section('vendor-style')
<!-- vendor css files -->
<link rel='stylesheet' href="{{ asset('vendors/css/forms/select/select2.min.css') }}">
<link rel='stylesheet' href="{{ asset('vendors/css/animate/animate.min.css') }}">
<link rel='stylesheet' href="{{ asset('vendors/css/extensions/sweetalert2.min.css') }}">
@endsection
@section('page-style')
<!-- Page css files -->
<link rel="stylesheet" href="{{ asset('css/base/plugins/extensions/ext-component-sweet-alerts.css') }}">
<link rel="stylesheet" href="{{ asset('css/base/plugins/forms/form-validation.css') }}">
@endsection

@section('content')
<div class="row">
    <div class="col-12">

        <ul class="nav nav-pills mb-2">
            <!-- Account -->
            <li class="nav-item">
                <a class="nav-link active" href="{{asset('page/account-settings-account')}}">
                    <i data-feather="user" class="font-medium-3 me-50"></i>
                    <span class="fw-bold">Account</span>
                </a>
            </li>
            <!-- security -->
            <li class="nav-item">
                <a class="nav-link" href="{{asset('page/account-settings-security')}}">
                    <i data-feather="lock" class="font-medium-3 me-50"></i>
                    <span class="fw-bold">Security</span>
                </a>
            </li>
        </ul>

        <!-- security -->

        <!-- profile -->
        <div class="card">
            <div class="card-header border-bottom">
                <h4 class="card-title">Profile Details</h4>
            </div>
            <div class="card-body py-2 my-25">

                <!-- form -->
                <form class="validate-form mt-2 pt-50" id="form" action="{{ route('profile.update') }}" method="POST">
                    <!-- header section -->
                    <div class="d-flex">
                        <a href="#" class="me-25">
                            <img src="{{ $user->profile->profile_picture }}" id="account-upload-img"
                                class="uploadedAvatar rounded me-50" alt="profile image" height="100" width="100" />
                        </a>
                        <!-- upload and reset button -->
                        <div class="d-flex align-items-end mt-75 ms-1">
                            <div>
                                <label for="account-upload" class="btn btn-sm btn-primary mb-75 me-75">Upload</label>
                                <input type="file" id="account-upload" name="photo" hidden accept="image/*" />
                                <button type="button" id="account-reset"
                                    class="btn btn-sm btn-outline-secondary mb-75">Reset</button>
                                <p class="mb-0">Allowed file types: png, jpg, jpeg.</p>
                            </div>
                        </div>
                        <!--/ upload and reset button -->
                    </div>
                    <!--/ header section -->
                    <div class="row">
                        <div class="col-12 col-sm-6 mb-1">
                            <label class="form-label" for="accountFirstName">First Name</label>
                            <input type="text" class="form-control" id="accountFirstName" name="first_name"
                                placeholder="John" value="{{ $user->profile->first_name }}"
                                data-msg="Please enter first name" />
                        </div>
                        <div class="col-12 col-sm-6 mb-1">
                            <label class="form-label" for="accountLastName">Last Name</label>
                            <input type="text" class="form-control" id="accountLastName" name="last_name" placeholder=""
                                value="{{ $user->profile->last_name }}" data-msg="Please enter last name" />
                        </div>
                        <div class="col-12 col-sm-6 mb-1">
                            <label class="form-label" for="accountEmail">Email</label>
                            <input type="email" class="form-control" id="accountEmail" name="email" placeholder="Email"
                                value="{{ $user->email }}" readonly />
                        </div>
                        <div class="col-12 col-sm-6 mb-1">
                            <label class="form-label" for="accountAddress">Address</label>
                            <input type="text" class="form-control" id="accountAddress" name="address"
                                value="{{ $user->profile->address }}" placeholder="Your Address" />
                        </div>
                        <div class="col-12">
                            <button type="submit" id="btn_submit" class="btn btn-primary mt-1 me-1">Save changes</button>
                            <button type="reset" class="btn btn-outline-secondary mt-1">Discard</button>
                        </div>
                    </div>
                </form>
                <!--/ form -->
            </div>
        </div>

        <!-- deactivate account  -->
        <div class="card">
            <div class="card-header border-bottom">
                <h4 class="card-title">Delete Account</h4>
            </div>
            <div class="card-body py-2 my-25">
                <div class="alert alert-warning">
                    <h4 class="alert-heading">Are you sure you want to delete your account?</h4>
                    <div class="alert-body fw-normal">
                        Once you delete your account, there is no going back. Please be certain.
                    </div>
                </div>

                <form id="formAccountDeactivation" class="validate-form" onsubmit="return false">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="accountActivation" id="accountActivation"
                            data-msg="Please confirm you want to delete account" />
                        <label class="form-check-label font-small-3" for="accountActivation">
                            I confirm my account deactivation
                        </label>
                    </div>
                    <div>
                        <button type="submit" class="btn btn-danger deactivate-account mt-1">Deactivate Account</button>
                    </div>
                </form>
            </div>
        </div>
        <!--/ profile -->
    </div>
</div>
@endsection

@section('vendor-script')
<!-- vendor files -->
<script src="{{ asset('vendors/js/forms/select/select2.full.min.js') }}"></script>
<script src="{{ asset('vendors/js/extensions/sweetalert2.all.min.js') }}"></script>
<script src="{{ asset('vendors/js/forms/validation/jquery.validate.min.js') }}"></script>
@endsection
@section('page-script')
<!-- Page js files -->
<script src="{{ asset('js/pages/user-profile.js') }}"></script>
@endsection
