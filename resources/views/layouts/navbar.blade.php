<!-- resources/views/layouts/navbar.blade.php -->
<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container">
        <a class="navbar-brand" href="/dashboard">SPK-VIKOR</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a class="nav-link active" href="/dashboard">Dashboard</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/kriteria">Kriteria</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/alternatif">Alternatif</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/penilaian">Penilaian</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/perhitungan">Perhitungan VIKOR</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/hasil">Hasil</a>
                </li>
            </ul>
            <form action="{{ route('logout') }}" method="POST" class="d-flex">
                @csrf
                <button type="submit" class="btn btn-danger btn-outline-light">Logout</button>
            </form>
        </div>
    </div>
</nav>
