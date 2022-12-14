@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row profile">
		<div class="col-md-3">
			<div class="profile-sidebar">
				<!-- SIDEBAR USERPIC -->
				<div class="profile-userpic">
					<img img="uu333" src="{{ $urlImg  }}" class="img-responsive" alt="">
				</div>
				<!-- END SIDEBAR USERPIC -->
				<!-- SIDEBAR USER TITLE -->
				<div class="profile-usertitle">
					<div class="profile-usertitle-name">
                    {{ Auth::user()->name }}
					</div>
					<div class="profile-usertitle-job">
						Developer
					</div>
				</div>

			</div>
		</div>
		<div class="col-md-9">
            <div class="card">
                <div class="card-header">{{ __('Update Profile') }}  </div>
                @if(Session::has('success'))
                    <div class="alert alert-success">
                        {{Session::get('success')}}
                    </div>
                @endif

                <div class="card-body">
                    <form method="POST" action="{{ url('profile/' ) }}" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" value="{{ Auth::user()->id }}" name="id" >
                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ Auth::user()->name }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ Auth::user()->email }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="favoriteColor" class="col-md-4 col-form-label text-md-end">Favorite Color</label>
                            <div class="col-md-6">
                            <input id="favoriteColor" value="{{ Auth::user()->favoritecolor }}" type="text" class="form-control @error('favoritecolor') is-invalid @enderror" name="favoritecolor"  placeholder="Enter favorite color">
                            <span class="text-danger">@error('favoritecolor'){{ $message }}@enderror</span>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="favoriteColor" class="col-md-4 col-form-label text-md-end">Upload File</label>
                            <div class="col-md-6">
                                <input id="picture" type="file" class="form-control @error('picture_file') is-invalid @enderror" name="picture_file"  >
                                <span class="text-danger">@error('picture_file'){{ $message }}@enderror</span>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" value="{{ Auth::user()->password }}" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>


                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Update') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
		</div>
	</div>
</div>
@endsection
