@extends('admin.dashboard')

@section('admin')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    <div class="page-content">

        <div class="row profile-body">
            <!-- left wrapper start -->
            <div class="d-none d-md-block col-md-4 col-xl-4 left-wrapper">
                <div class="card rounded">
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between mb-2">
                            <h6 class="card-title mb-0">Update Admin Profile: {{ $data->username}}</h6>
                            <div>
                                <img class="wd-100 rounded-circle" alt="profile"
                                     src="{{ (!empty($data->photo)) ? url('upload/admin_images/'.$data->photo) : url('upload/no_image.jpg') }}" >
                                <span class="h4 ms-3">{{ $data->username}}</span>
                            </div>
                        </div>
                        <div class="mt-3">
                            <label class="tx-11 fw-bolder mb-0 text-uppercase">User Name:</label>
                            <p class="text-muted">{{ $data->name}}</p>
                        </div>
                        <div class="mt-3">
                            <label class="tx-11 fw-bolder mb-0 text-uppercase">Email:</label>
                            <p class="text-muted">{{ $data->email}}</p>
                        </div>
                        <div class="mt-3">
                            <label class="tx-11 fw-bolder mb-0 text-uppercase">Phone:</label>
                            <p class="text-muted">{{ $data->phone}}</p>
                        </div>
                        <div class="mt-3">
                            <label class="tx-11 fw-bolder mb-0 text-uppercase">Address:</label>
                            <p class="text-muted">{{ $data->address}}</p>
                        </div>
                        <div class="mt-3 d-flex social-links">
                            <a href="javascript:;" class="btn btn-icon border btn-xs me-2">
                                <i data-feather="github"></i>
                            </a>
                            <a href="javascript:;" class="btn btn-icon border btn-xs me-2">
                                <i data-feather="twitter"></i>
                            </a>
                            <a href="javascript:;" class="btn btn-icon border btn-xs me-2">
                                <i data-feather="instagram"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- left wrapper end -->
            <!-- middle wrapper start -->
            <div class="col-md-8 col-xl-8 middle-wrapper">
                <div class="row">
                    <div class="card">
                        <div class="card-body">

                            <h6 class="card-title">Update Admin Profile</h6>

                            <form class="forms-sample" method="post" action="{{ route('admin.update') }}" enctype="multipart/form-data">
                                @csrf
                                <div class="mb-3">
                                    <label for="username" class="form-label">Username</label>
                                    <input type="text" class="form-control" id="username" name="username" value="{{ $data->username }}" placeholder="Username">
                                </div>
                                <div class="mb-3">
                                    <label for="name" class="form-label">Name</label>
                                    <input type="text" class="form-control" id="name" name="name" value="{{ $data->name }}" placeholder="Name">
                                </div>
                                <div class="mb-3">
                                    <label for="address" class="form-label">Address</label>
                                    <input type="text" class="form-control" id="address" name="address" value="{{ $data->address }}" placeholder="Address">
                                </div>
                                <div class="mb-3">
                                    <label for="phone" class="form-label">Phone</label>
                                    <input type="text" class="form-control" id="phone" name="phone" value="{{ $data->phone }}" placeholder="Phone">
                                </div>
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email address</label>
                                    <input type="email" class="form-control" id="email" name="email" value="{{ $data->email }}" placeholder="Email">
                                </div>
                                <div class="mb-3">
                                    <label for="photo" class="formFile">Photo</label>
                                    <input type="file" class="form-control" id="photo" name="photo" value="{{ $data->photo }}" placeholder="Photo">
                                </div>
                                <div class="mb-3">
                                    <label for="showImage" class="formFile"> </label>
                                    <img class="wd-100 rounded-circle" alt="profile" id="showImage"
                                         src="{{ (!empty($data->photo)) ? url('upload/admin_images/'.$data->photo) : url('upload/no_image.jpg') }}">
                                </div>
{{--                                <div class="mb-3">--}}
{{--                                    <label for="password" class="form-label">Password</label>--}}
{{--                                    <input type="password" class="form-control" id="password" name="password" value="{{ $data->password }}" placeholder="Password">--}}
{{--                                </div>--}}
                                <button type="submit" class="btn btn-primary me-2">Save Changes</button>
                            </form>

                        </div>
                    </div>


                    <div class="col-md-12">

                    </div>
                </div>
            </div>
            <!-- middle wrapper end -->
            <!-- right wrapper start -->

            <!-- right wrapper end -->
        </div>

    </div>

    <script type="text/javascript">
        $(document).ready(function () {
            $('#photo').change(function (e) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $('#showImage').attr('src', e.target.result);
                }
                reader.readAsDataURL(e.target.files['0']);
            });
        });
    </script>

@endsection
