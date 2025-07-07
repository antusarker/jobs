<section>
    <div class="row">
            <div class="col-xl-6 col-xxl-12">
                @include('common.message')
            </div>
            <div class="col-xl-6 col-xxl-12">
                <div class="card">
                    <div class="card-text">
                        <h3 class="py-3 px-3 mb-0">Update Password</h3>
                    </div>
                    <div class="card-body">
                        <div class="basic-form">
                            <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6">
                                @csrf
                                @method('put')
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label>Current Password</label>
                                        <input type="password" class="form-control" name="current_password" value="" placeholder="">
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label>New Password</label>
                                        <input type="password" class="form-control" name="password" value="" placeholder="">
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label>Confirm Password</label>
                                        <input type="password" class="form-control" name="password_confirmation" value="" placeholder="">
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary">Save</button>
                                <div class="flex items-center gap-4">
                                    @if (session('status') === 'password-updated')
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

