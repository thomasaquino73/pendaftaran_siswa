<section>
    @if (session('status') === 'password-updated')
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Success!</strong> {{ __('Saved Successfully.') }}.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
    </div>
    @endif
    <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('put')

        <div>
            <div class="form-group">
                <label for="update_password_current_password">{{ __('Current Password') }}</label>
                <input id="update_password_current_password" name="current_password" type="password" class="form-control"
                    value="" required autofocus autocomplete="current-password">
            </div>
            <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
        </div>

        <div>
            <div class="form-group">
                <label for="update_password_password">{{ __('New Password') }}</label>
                <input id="update_password_password" name="password" type="password" class="form-control" value=""
                    required autofocus autocomplete="new-password">
            </div>
            <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
        </div>

        <div>
            <div class="form-group">
                <label for="update_password_password_confirmation">{{ __('Confirm Password') }}</label>
                <input id="update_password_password_confirmation" name="password_confirmation" type="password"
                    class="form-control" value="" autocomplete="new-password">
            </div>
            <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center gap-4">
            <button class="btn btn-block btn-primary">{{ __('Save') }}</button>


        </div>
    </form>
</section>
