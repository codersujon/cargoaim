<h1>Dashboard</h1>

<form  action="{{ route('user.logout') }}" method="POST">
    @csrf
    <button type="submit">Logout</button>
</form>