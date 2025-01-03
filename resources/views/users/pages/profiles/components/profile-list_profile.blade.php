@extends('users.pages.profiles.profile-index')
@section('main-profile')
    <main class="custom-main-content">
        <h1 class="custom-h1">Thông Tin</h1>
        @foreach ($users as $user)
            <section class="custom-section">
                <h2 class="custom-h2">Thông tin cơ bản</h2>
                <table class="custom-info-table">
                    <tr>
                        <td>Tên</td>
                        <td>{{ $user->userName }}</td>
                        <td>
                            <button class="custom-btn custom-btn-primary" onclick="window.location.href='{{route('client.profile-info-edit')}}'">Đổi
                            </button>
                        </td>
                    </tr>
                    <tr>
                        <td>Email</td>
                        <td>{{ $user->email }}</td>
                        <td>
                        </td>
                    </tr>
                </table>
            </section>
        @endforeach
    </main>
@endsection
