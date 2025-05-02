@extends('layouts.app')

@section('title', 'Careers')


@section('content')

    @include('home.services.elements.header_img', [
        'image' => 'images/web_image6.jpg',
        // 'image' => 'Images/careers.jpg',
        'caption' => 'Careers'
    ])

    <div class="container pl-5 pr-5 pt-3 pb-4">

        <div class="row pl-sm-0 pl-md-5 pr-sm-0 pr-md-5">

            <div class="col-sm-12 col-lg-6">

                <p>
                    <h2 class="font-weight-bold"><span class="text-dark">Be a Part of </span> <span class="text-danger">RegTech family</span></h2>
                </p>
                <p class="text-justify lead">
                    <span class="font-weight-bold">RegTech</span> started its journey in 2018 to create a new wave in Fintech logistics sector.
                    A highly fragmented sector scatterd across India, were dominated by smaller local agencies.
                    Our vision to organise this sector and equip them with technology has started the process of democratising the collection services of <strong>Banks & NBFCs</strong>
                    Our Phygital platform is using technology in the forefront and human network in the core.
                    We are proud that our modern way of handling document collection, customer verification and Debt recovery has started
                    disrupting traditional way of decision making process in Fintech logistics. This serves our mission to defragment this segment.
                </p>
                <p class="text-justify lead">
                    We Welcome members with appetite to take challenges and explore the untapped territory.
                    The journey of start-up gives ample insigt of an entrepreneurial exposure to the team member.
                </p>

            </div>
            <div class="col-sm-12 col-lg-6">
                <img src="{{asset('images/5.jpg')}}" width="100%" height="100%">
            </div>

        </div>

    </div>

    <div class="container pl-5 pr-5 pb-4">

        <div class="row pl-sm-0 pl-md-5 pr-sm-0 pr-md-5">

            <div class="col-sm-12 col-lg-6">
                <h2 class="font-weight-bold">Latest Job Openings</h2>
                    <br>
                <h4 class="font-weight-bold">1. Fintech Correspondents</h4>

                <p class="lead text-justify">We are looking for Fintech Correspondent in Hyderabad, Telegana <br>
                    <span class="font-weight-bold">Job Description: </span> Document and collection and verification for Banks and NBFC
                </p>


            </div>

            <div class="col-sm-12 col-lg-6">

                <h3 class="font-weight-bold">Apply Here</h3>

                    <div class="card lead" >
                        <div class="card-body">

                            <form action="{{ url('/forms/application') }}" method="POST" enctype="multipart/form-data">
                                @csrf

                                <div class="form-group">
                                    <label for="Name">Full Name<span class="text-danger">*</span></label>
                                    <input type="text" style="background-color: lightgrey" class="form-control" name="full_name" id="name" placeholder="Name">
                                </div>
                                <div class="form-group">
                                    <label for="Email">Email ID<span class="text-danger">*</span></label>
                                    <input type="email" style="background-color: lightgrey" class="form-control" name="email_id" id="Email" placeholder="Email">
                                </div>
                                <div class="form-group">
                                    <label for="phone">Phone<span class="text-danger">*</span></label>
                                    <input type="number" style="background-color: lightgrey" class="form-control" name="phone" id="phone" placeholder="Phone">
                                </div>
                                <div class="form-group">
                                    <label for="dob">D.O.B<span class="text-danger">*</span></label>
                                    <input type="date" style="background-color: lightgrey" class="form-control" name="dob" id="date" placeholder="Date of Birth">
                                </div>
                                <div class="form-group">
                                    <label for="qualification">Qualification</label>
                                    <input type="text" style="background-color: lightgrey" class="form-control" name="qualification" id="qualification" placeholder="qualification">
                                </div>
                                <div class="form-group">
                                    <label for="resume">Attach Resume Here<span class="text-danger">*</span></label>
                                    <input type="file" class="form-control-file" name="resume" id="resume" placeholder="qualification">
                                </div>
                                <button type="submit" class="btn btn-danger">Submit Here</button>
                            </form>
                        </div>
                    </div>
            </div>

        </div>

    </div>

@endsection
