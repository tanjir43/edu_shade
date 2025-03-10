<h4 class="mb-3">Two Factor Authentication</h4>
<p>Add additional security to your account using two-factor authentication.</p>

@if (auth()->user()->two_factor_secret)
    <div class="alert alert-success">
        Two-factor authentication is enabled.
    </div>

    <p>Scan the QR Code below with your authentication app:</p>

    <div>
        {!! auth()->user()->twoFactorQrCodeSvg() !!}
    </div>

    <p>Save these recovery codes somewhere safe:</p>
    <ul>
        @foreach (auth()->user()->recoveryCodes() as $code)
            <li>{{ $code }}</li>
        @endforeach
    </ul>

    <form method="POST" action="{{ url('user/two-factor-authentication') }}">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger">Disable Two-Factor Authentication</button>
    </form>
@else
    <form method="POST" action="{{ url('user/two-factor-authentication') }}">
        @csrf
        <button type="submit" class="btn btn-secondary">Enable Two-Factor Authentication</button>
    </form>
@endif
