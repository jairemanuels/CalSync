@extends('platform::setup.app', [

])

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12 text-center">
            <h3 class="mt-5">Lets build your business</h3>
            <h5 class="text-secondary font-weight-normal">This information will let us know more about you.</h5>
            <div class="multisteps-form mb-5">

                <div class="row">
                    <div class="col-12 col-lg-8 mx-auto my-5">
                        <div class="multisteps-form__progress">
                            <button class="multisteps-form__progress-btn js-active" type="button" title="User Info">
                                <span>About</span>
                            </button>
                            <button class="multisteps-form__progress-btn" type="button" title="Address">
                                <span>Account</span>
                            </button>
                            <button class="multisteps-form__progress-btn" type="button" title="Order Info">
                                <span>Address</span>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-lg-8 m-auto">
                        <div class="row text-center">
                            <div class="col-12 mx-auto">
                                <h5 class="font-weight-normal">Let's start with the basic information</h5>
                                <p>Let us know your name and email address. Use an address you don't mind other users contacting you at</p>
                            </div>
                            <div class="card">
                                <div class="card-body text-start">
                                    <div class="form-group">
                                        <label for="exampleFormControlInput1">Business Name</label>
                                        <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Business Name">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleFormControlSelect1">Country</label>
                                        <select class="form-control" id="exampleFormControlSelect1">
                                            <option>Netherlands</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleFormControlSelect1">Language</label>
                                        <select class="form-control" id="exampleFormControlSelect1">
                                            <option>Dutch / Nederlands</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleFormControlSelect1">Timezone</label>
                                        <select class="form-control" id="exampleFormControlSelect1">
                                            <option>Europe/Amsterdam</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="card-footer text-end">
                                    <button class="btn bg-gradient-dark">Next</button>
                                </div>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
