<div>
    <div class="col-12 text-center">
        <h3 class="mt-5">Lets setup your business</h3>
        <h5 class="text-secondary font-weight-normal">This information will let us know more about you.</h5>
        <div class="multisteps-form mb-5">

            <div class="row">
                <div class="col-12 col-lg-8 m-auto">
                    <div class="row text-center">
                        <form action="">
                        <div class="card">
                            <div class="card-body text-start">
                                <div class="form-group">
                                    <label for="name">Business Name</label>
                                    <input type="text" wire:model="name" class="form-control" oninput="generateSubdomainSuggestion(this)" id="name" placeholder="Business Name">
                                    @error('name')
                                        <p class="text-sm text-danger mb-2">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="domain">Subdomain</label>
                                    <input type="text" wire:model.live="domain" class="form-control" id="domain" placeholder="example.trimy.nl">
                                    @error('domain')
                                        <p class="text-sm text-danger mb-2">{{ $message }}</p>
                                    @enderror
                                </div>
                                <hr>
                                <div class="form-group">
                                    <label for="languages-selection">Language</label>
                                    <select class="form-control" wire:model="language" id="languages-selection">
                                        @foreach(\App\Facades\World::languages() as $key => $language)
                                            <option value="{{ $key }}" @if ('en' == $key) selected @endif>{{ $language }}</option>
                                        @endforeach
                                    </select>
                                    @error('language')
                                    <p class="text-sm text-danger mb-2">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="timezone-selection">Timezone</label>
                                    <select class="form-control" wire:model="timezone" id="timezone-selection">
                                        @foreach(\App\Facades\World::timezones() as $key => $timezone)
                                            <option value="{{ $timezone }}" @if($timezone == 'Europe/Amsterdam') selected @endif>{{ $timezone }}</option>
                                        @endforeach
                                    </select>
                                    @error('timezone')
                                    <p class="text-sm text-danger mb-2">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="clock-selection">Clock</label>
                                    <select class="form-control" wire:model="clock" id="clock-selection">
                                        <option value="12" selected>12-hour clock</option>
                                        <option value="24" selected>24-hour clock</option>
                                    </select>
                                    @error('clock')
                                    <p class="text-sm text-danger mb-2">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="country-selection">Country</label>
                                    <select class="form-control" wire:model="country" id="country-selection">
                                        @foreach(\App\Facades\World::countries() as $key => $country)
                                            <option value="{{ $key }}" @if(request()->header('cf-ipcountry', 'NL') == $key) selected @endif>{{ $country }}</option>
                                        @endforeach
                                    </select>
                                    @error('country')
                                    <p class="text-sm text-danger mb-2">{{ $message }}</p>
                                    @enderror
                                </div>
                                <hr>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="address">Address</label>
                                        <input type="text" wire:model="address" class="form-control" id="address" placeholder="Address">
                                        @error('address')
                                        <p class="text-sm text-danger mb-2">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="address2">Address 2</label>
                                        <input type="text" wire:model="address2" class="form-control" id="address2" placeholder="Address 2">
                                        @error('address2')
                                        <p class="text-sm text-danger mb-2">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12 col-md-4">
                                        <div class="form-group">
                                            <label for="region">Province / State / Region</label>
                                            <input type="text" wire:model="region" class="form-control" id="region" placeholder="Province / State / Region">
                                            @error('region')
                                            <p class="text-sm text-danger mb-2">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-4">
                                        <div class="form-group">
                                            <label for="city">City</label>
                                            <input type="text" wire:model="city" class="form-control" id="city" placeholder="City">
                                            @error('city')
                                            <p class="text-sm text-danger mb-2">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-4">
                                        <div class="form-group">
                                            <label for="zip_code">Zip Code</label>
                                            <input type="text" wire:model="zip_code" class="form-control" id="zip_code" placeholder="Zip Code">
                                            @error('zip_code')
                                            <p class="text-sm text-danger mb-2">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                            </div>
                            <div class="card-footer text-end">
                                <button type="button" wire:click="createTenant" class="btn bg-gradient-dark">Get Started</button>
                            </div>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        function generateSubdomainSuggestion(element) {
            // let name = element.value;
            // let domain = document.getElementById('domain');
            // var subdomain = '.trimy.nl';
            // let suggestion = name.replace(/\s+/g, '-').replace(/[^a-zA-Z0-9-]/g, '').toLowerCase() + subdomain;
            // domain.value = suggestion;
        }
    </script>
    <script src="/assets/js/plugins/choices.min.js"></script>
    <script type="text/javascript">
        if (document.getElementById('languages-selection')) {
            var Languageelement = document.getElementById('languages-selection');
            const languageSelection = new Choices(Languageelement, {});
        }

        if (document.getElementById('country-selection')) {
            var countryelement = document.getElementById('country-selection');
            const countrySelection = new Choices(countryelement, {});
        }

        if (document.getElementById('timezone-selection')) {
            var timezonelement = document.getElementById('timezone-selection');
            const timezoneSelection = new Choices(timezonelement, {});
        }

        if (document.getElementById('clock-selection')) {
            var clockelement = document.getElementById('clock-selection');
            const clockSelection = new Choices(clockelement, {});
        }
    </script>
</div>
