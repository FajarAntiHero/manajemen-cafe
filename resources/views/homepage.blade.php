<div>
    <!-- Smile, breathe, and go slowly. - Thich Nhat Hanh -->
    halo user!

    <a href="{{ route('login') }}">Login</a>
    <form method="POST" action="{{ route('logout') }}">
    @csrf
    <button type="submit">Logout</button>
</form>
</div>
