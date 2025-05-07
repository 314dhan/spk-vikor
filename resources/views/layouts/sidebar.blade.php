<!-- resources/views/layouts/sidebar.blade.php -->
<div class="card">
    <div class="card-header bg-white">
        <h5>Menu SPK</h5>
    </div>
    <div class="list-group list-group-flush">
        <a href="/dashboard" class="list-group-item list-group-item-action {{ request()->is('dashboard') ? 'active' : '' }}">
            <i class="fas fa-tachometer-alt me-2"></i> Dashboard
        </a>
        <a href="/kriteria" class="list-group-item list-group-item-action {{ request()->is('kriteria*') ? 'active' : '' }}">
            <i class="fas fa-list-ol me-2"></i> Kriteria
        </a>
        <a href="/alternatif" class="list-group-item list-group-item-action {{ request()->is('alternatif*') ? 'active' : '' }}">
            <i class="fas fa-users me-2"></i> Alternatif
        </a>
        <a href="/penilaian" class="list-group-item list-group-item-action {{ request()->is('penilaian*') ? 'active' : '' }}">
            <i class="fas fa-edit me-2"></i> Penilaian
        </a>
        <a href="/perhitungan" class="list-group-item list-group-item-action {{ request()->is('perhitungan*') ? 'active' : '' }}">
            <i class="fas fa-calculator me-2"></i> Perhitungan VIKOR
        </a>
    </div>
</div>
