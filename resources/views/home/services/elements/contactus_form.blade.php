{{-- contact us form
     this is included in all 4 services --}}

<div class="container p-5">

    <div class="row">

        <div class="col-xs-12 col-sm-12 col-md-5 col-lg-6">

            <h2 class="font-weight-bold">Contact Us Now</h2>

            <p class="text-justify lead">Feel free to get in touch with us, our team will be happy to assist</p>

        </div>

        <div class="col-xs-12 col-sm-12 col-md-7 col-lg-6">

            <div class="card">
                <div class="card-body">
                  <h3 class="card-title font-weight-light">Enter your details below to get started</h3>
                  <h5 class="card-subtitle mb-sm-2 text-muted">Fill out the form below to get in Touch with us.
                      Don't worry, we never share your information or use it to spam you</h5>

                      <form class="lead" action="{{ url('/forms/contactus') }}" method="POST">
                        @csrf

                        <div class="form-row">
                            <div class="form-group col-sm-6">
                                <label for="firstName">First Name</label>
                                <input type="text" class="form-control" name="first_name" id="firstName">
                            </div>
                            <div class="form-group col-sm-6">
                                <label for="lastName">Last Name</label>
                                <input type="text" class="form-control" name="last_name" id="lastName">
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-sm-6">
                                <label for="mobile">Mobile Number</label>
                                <input type="number" class="form-control" name="mobile_no" id="mobileNumber">
                            </div>
                            <div class="form-group col-sm-6">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" name="email" id="email">
                            </div>
                        </div>

                        <div class="form-group">
                          <label for="message">Message Here</label>
                          <textarea class="form-control" name="message" id="message" rows="1"></textarea>
                        </div>

                        <button type="submit" class="btn btn-danger font-weight-bold">Contact Us</button>
                    </form>

                </div>
              </div>

        </div>

    </div>

</div>
