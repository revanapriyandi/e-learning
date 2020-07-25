<div class="menu">
    <div class="main-menu">
        <div class="scroll">
            <ul class="list-unstyled">
                <li class="{{ set_active('home') }}">
                    <a href="{{ route('home') }}">
                        <i class="iconsminds-shop-4"></i>
                        <span>Dashboards</span>
                    </a>
                </li>
                @if (auth()->user()->role == 'guru')
                <li class="{{ set_active(['guru.index','guru.create','guru.show','siswa.index','siswa.create','siswa.show','kelas.index','kelas.show','semester.index','mapel.index','mapel.edit']) }}">
                    <a href="#datamaster">
                        <i class="iconsminds-digital-drawing"></i>
                        <span>Data Master</span>
                    </a>
                </li>
                <li class="{{ set_active(['registrasi.siswa']) }}">
                    <a href="{{ route('registrasi.siswa') }}">
                        <i class="simple-icon-user"></i>
                        <span>Registrasi Siswa</span>
                    </a>
                </li>
                <li class="{{ set_active(['absensi.index','absensi.harian']) }}">
                    <a href="{{ route('absensi.index') }}">
                        <i class="simple-icon-book-open"></i>
                        <span>Presensi</span>
                    </a>
                </li>
                @endif
                
                <li class="{{ set_active(['modul.index','modul.create','modul.show','modul.edit']) }}">
                    <a href="{{ route('modul.index') }}">
                        <i class="simple-icon-credit-card"></i>
                        <span>Modul Pembelajaran</span>
                    </a>
                </li>
                @if (auth()->user()->role == 'siswa')
                <li class="{{ set_active('absen.absen') }}">
                    <a href="{{ route('absen.absen') }}">
                        <i class="simple-icon-check"></i>
                        <span>Absen</span>
                    </a>
                </li>
                {{--  <li class="{{ set_active(['quiz.siswa.index']) }}">
                    <a href="{{ route('quiz.siswa.index') }}">
                        <i class="simple-icon-link"></i>
                        <span>Manajement Quiz</span>
                    </a>
                </li>  --}}
                @endif
                @if (auth()->user()->role == 'guru')
                <li class="{{ set_active(['tugas.masuk.index']) }}">
                    <a href="{{ route('tugas.masuk.index') }}">
                        <i class="simple-icon-layers"></i>
                        <span>Tugas Masuk</span>
                    </a>
                </li>
                {{--  <li class="{{ set_active(['quiz.index']) }}">
                    <a href="{{ route('quiz.index') }}">
                        <i class="simple-icon-link"></i>
                        <span>Manajement Quiz</span>
                    </a>
                </li>  --}}
                @endif
            </ul>
        </div>
    </div>
    <div class="sub-menu">
        <div class="scroll">
            <ul class="list-unstyled" data-link="datamaster">
                <li>
                    <a href="{{ route('guru.index') }}">
                        <i class="iconsminds-user"></i>
                        <span>Data Guru</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('siswa.index') }}">
                        <i class="simple-icon-people"></i>
                        <span>Data Siswa</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('kelas.index') }}">
                        <i class="iconsminds-pantone"></i>
                        <span>Data Kelas</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('mapel.index') }}">
                        <i class="simple-icon-notebook"></i>
                        <span>Data Mapel</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('semester.index') }}">
                        <i class="iconsminds-three-arrow-fork"></i>
                        <span>Data Semester</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>