<section>
    <div class="row">
            <div class="col-xl-6 col-xxl-12">
                <div class="card">
                    <div class="card-text">
                        <h3 class="py-3 px-3 mb-0">Verify your Account</h3>
                         <p class="text-warning px-3 mb-3">
                            <i class="mdi mdi-alert me-2"></i>
                            Unverified accounts will be automatically terminated within 7 days.
                        </p>
                    </div>
                    <div class="card-body">
                        <div class="basic-form">
                            @if(empty(auth()->user()->email_verified_at) && empty(auth()->user()->otp_code))
                            <form method="post" action="{{ route('send.otp') }}" class="mt-6 space-y-6">
                                @csrf
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label>Your Email</label>
                                        <input type="text" class="form-control" name="email" value="{{auth()->user()->email}}" readonly>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary">Send OTP</button>
                            </form>
                            @endif 
                            @if(empty(auth()->user()->email_verified_at) && !empty(auth()->user()->otp_code))
                            <form method="post" action="{{ route('verify.otp') }}" class="mt-6 space-y-6">
                                @csrf
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label>Your Email</label>
                                        <input type="text" class="form-control" name="email" value="{{auth()->user()->email}}" readonly>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>OTP Code <strong>*</strong></label>
                                        <input type="text" class="form-control" name="otp" value="">
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary">Verify OTP</button>
                            </form>
                            @endif 
                        </div>
                    </div>
                </div>
            </div>
        </div>
</section>

