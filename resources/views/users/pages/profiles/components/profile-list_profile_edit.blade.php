@extends('users.pages.profiles.profile-index')
@section('main-profile')
    <main class="custom-main-content">
        <h1 class="custom-h1">Chỉnh Sửa Thông Tin</h1>
        @foreach ($users as $user)
            <div class="row">
                <form method="POST" action="{{route('client.profile-info-updateedit')}}">
                    @csrf
                    <div class="col-md-7">
                        <div class="billing-details">
                            <div class="section-title">
                                <h3 class="title">Họ và tên</h3>
                            </div>
                            <div class="form-group">
                                <input class="input" type="text" name="userName" value="{{ $user->userName }}">
                            </div>
                            <div class="form-group">
                                <button class="custom-btn custom-btn-success" type="submit">Thay Đổi</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        @endforeach
    </main>
@endsection
