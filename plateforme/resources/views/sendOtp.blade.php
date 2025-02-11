<form method="POST" action="{{ route('sendOtp') }}">
    @csrf
    <button type="submit">Envoyer OTP</button>
</form>

@if (session('status'))
    <div>{{ session('status') }}</div>
@endif
