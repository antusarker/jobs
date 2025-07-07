<section>
    <div class="row">
            <div class="col-xl-6 col-xxl-12">
                @include('common.message')
            </div>
            <div class="col-xl-6 col-xxl-12">
                <div class="card">
                    <div class="card-text">
                        <h3 class="py-3 px-3 mb-0">Profile Information</h3>
                    </div>
                    <div class="card-body">
                        <div class="basic-form">
                            <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
                                @csrf
                                @method('patch')
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label>Name</label>
                                        <input type="text" class="form-control" name="name" value="{{ $user->name }}" placeholder="">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>Email</label>
                                        <input type="email" class="form-control" name="email" value="{{ $user->email }}" placeholder="">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>Phone Number</label>
                                        <input type="text" class="form-control" name="phone" value="{{ $user->phone }}" placeholder="">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>Linkedin</label>
                                        <input type="text" class="form-control" name="linkedin" value="{{ $user->linkedin }}" placeholder="">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>Website</label>
                                        <input type="text" class="form-control" name="website" value="{{ $user->website }}" placeholder="">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>Location</label>
                                        <select class="form-control" name="location">
                                            <option selected>Choose...</option>
                                            @foreach (job_locations() as $key => $value)
                                                <option value="{{ $key }}" {{ $user->location == $key ? 'selected' : '' }}>{{ $value }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @if($user->role_id == 3)
                                    <div class="form-group col-md-6">
                                        <label>Expected Salary</label>
                                        <input type="text" class="form-control number-only" name="expected_salary" value="{{ $user->expected_salary }}">
                                    </div>
                                    @endif
                                </div>
                                <button type="submit" class="btn btn-primary">Save</button>
                                <div class="flex items-center gap-4">
                                    @if (session('status') === 'profile-updated')
                                        <p
                                            x-data="{ show: true }"
                                            x-show="show"
                                            x-transition
                                            x-init="setTimeout(() => show = false, 2000)"
                                            class="text-sm text-gray-600"
                                        >{{ __('Saved.') }}</p>
                                    @endif
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</section>
