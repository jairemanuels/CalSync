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
                        <form class="multisteps-form__form" style="height: 463px;">

                            <div class="card multisteps-form__panel p-3 border-radius-xl bg-white js-active" data-animation="FadeIn">
                                <div class="row text-center">
                                    <div class="col-12 mx-auto">
                                        <h5 class="font-weight-normal">Let's start with the basic information</h5>
                                        <p>Let us know your name and email address. Use an address you don't mind other users contacting you at</p>
                                    </div>
                                </div>
                                <div class="multisteps-form__content">
                                    <div class="row mt-3">
                                        <div class="col-12 col-sm-4">
                                            <div class="avatar avatar-xxl position-relative">
                                                <img src="https://demos.creative-tim.com/test/soft-ui-dashboard-pro/assets/img/team-2.jpg" class="border-radius-md">
                                                <a href="javascript:;" class="btn btn-sm btn-icon-only bg-gradient-light position-absolute bottom-0 end-0 mb-n2 me-n2">
                                                    <i class="fa fa-pen top-0" data-bs-toggle="tooltip" data-bs-placement="top" title="" aria-hidden="true" data-bs-original-title="Edit Image" aria-label="Edit Image"></i><span class="sr-only">Edit Image</span>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-8 mt-4 mt-sm-0 text-start">
                                            <label>First Name</label>
                                            <input class="multisteps-form__input form-control mb-3" type="text" placeholder="Eg. Michael">
                                            <label>Last Name</label>
                                            <input class="multisteps-form__input form-control mb-3" type="text" placeholder="Eg. Tomson">
                                            <label>Email Address</label>
                                            <input class="multisteps-form__input form-control" type="email" placeholder="Eg. soft@dashboard.com">
                                        </div>
                                    </div>
                                    <div class="button-row d-flex mt-4">
                                        <button class="btn bg-gradient-dark ms-auto mb-0 js-btn-next" type="button" title="Next">Next</button>
                                    </div>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
