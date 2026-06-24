<div>
    <!-- The only way to do great work is to love what you do. - Steve Jobs -->
    <form method="POST" action="{{ route('login') }}">
    @csrf

    <label>Email</label>
    <input type="email" name="email" value="{{ old('email') }}" required>
    @error('email') <p>{{ $message }}</p> @enderror

    <label>Password</label>
    <input type="password" name="password" required>

    <button type="submit">Login</button>
</form>
</div>
