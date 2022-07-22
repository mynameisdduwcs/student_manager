@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row gutters">
            <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12">
                <div class="card h-100">
                    <div class="card-body">
                        <div class="account-settings">
                            <div class="user-profile">
                                <div class="user-avatar">
                                    <img src="{{asset($student->avatar)}}" alt="Maxwell Admin">

                                </div>
                                <h5 class="user-name">{{$student->name}}</h5>
                                <h6 class="user-email">{{$student->email}}</h6>
                            </div>
                            <div class="about">
                                <h5>Description</h5>
                                <p>{{$student->description}}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-9 col-lg-9 col-md-12 col-sm-12 col-12">
                <div class="card h-100">
                    <div class="card-body">


                        <div class="row gutters">
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                <h6 class="mb-2 text-primary">Personal Details</h6>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                <div class="form-group">
                                    <label for="fullName">Full Name</label>
                                    {!! Form::label('name', $student->name , ['class' => 'form-control', 'placeholder' => 'Enter your phone']) !!}
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                <div class="form-group">
                                    <label for="eMail">Gender</label>
                                    {!! Form::label('gender', $student->gender===1 ? "Nam" : "Nữ", ['class' => 'form-control', 'placeholder' => 'Enter your phone']) !!}
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                <div class="form-group">
                                    <label for="phone">Birthday</label>
                                    {!! Form::label('birthdate', $student->birthdate , ['class' => 'form-control', 'placeholder' => 'Enter your phone']) !!}
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                <div class="form-group">
                                    <label for="website">Phone</label>
                                    {!! Form::label('phone', $student->phone , ['class' => 'form-control', 'placeholder' => 'Enter your phone']) !!}
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                <div class="form-group">
                                    <label for="Street">Email</label>
                                    {!! Form::label('email', $student->email , ['class' => 'form-control', 'placeholder' => 'Enter your phone']) !!}
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                <div class="form-group">
                                    <label for="ciTy">Faculty</label>
                                    {!! Form::label('faculty', $student->faculty_id , ['class' => 'form-control', 'placeholder' => 'Enter your phone']) !!}
                                </div>
                            </div>

                        </div>

                        <div class="row gutters">
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                <div class="text-right">
                                    <button type="button" id="submit" name="submit" class="btn btn-secondary">Back
                                    </button>
                                    <button type="button" id="submit" name="submit" class="btn btn-primary">Update
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

        <style type="text/css">
            body {
                margin: 0;

                color: #2e323c;
                background: #f5f6fa;
                position: relative;
                height: 100%;
            }

            .account-settings .user-profile {
                margin: 0 0 1rem 0;
                padding-bottom: 1rem;
                text-align: center;
            }

            .account-settings .user-profile .user-avatar {
                margin: 0 0 1rem 0;
            }

            .account-settings .user-profile .user-avatar img {
                width: 90px;
                height: 90px;
                -webkit-border-radius: 100px;
                -moz-border-radius: 100px;
                border-radius: 100px;
            }

            .account-settings .user-profile h5.user-name {
                margin: 0 0 0.5rem 0;
            }

            .account-settings .user-profile h6.user-email {
                margin: 0;
                font-size: 0.8rem;
                font-weight: 400;
                color: #9fa8b9;
            }

            .account-settings .about {
                margin: 2rem 0 0 0;
                text-align: center;
            }

            .account-settings .about h5 {
                margin: 0 0 15px 0;
                color: #007ae1;
            }

            .account-settings .about p {
                font-size: 0.825rem;
            }

            .form-control {
                border: 1px solid #cfd1d8;
                -webkit-border-radius: 2px;
                -moz-border-radius: 2px;
                border-radius: 2px;
                font-size: .825rem;
                background: #ffffff;
                color: #2e323c;
            }

            .card {
                background: #ffffff;
                -webkit-border-radius: 5px;
                -moz-border-radius: 5px;
                border-radius: 5px;
                border: 0;
                margin-bottom: 1rem;
            }
        </style>

    <script type="text/javascript">
    </script>
@endsection

