{{-- fc form  --}}
<!-- Button trigger modal -->
{{-- <button type="button" class="btn btn-danger text-sm-center font-weight-bold" data-toggle="modal" data-target="#myModal">
    Download Now
</button> --}}

<a class="text-dark" data-toggle="modal" data-target="#myModal2" href="#"><h3 class="font-weight-bold" style="text-decoration-line: underline; ">Become a Client<span><svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-arrow-right font-weight-bold" viewBox="0 0 16 16">
    <path fill-rule="evenodd" d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8z"/>
  </svg></span></h3></a>

<!-- Modal -->
<div class="modal fade" id="myModal2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body text-justify lead">

                <form action="{{ url('/forms/client_reg') }}" method="POST">
                    @csrf

                    <div class="form-group">
                        <label for="name">Full Name*</label>
                        <input type="text" class="form-control" name="full_name" id="name">
                    </div>

                    <div class="form-group">
                        <label for="email">Email ID*</label>
                        <input type="email" class="form-control" name="email" id="email">
                    </div>

                    <div class="form-group">
                        <label for="contact">Contact No.*</label>
                        <input type="tel" class="form-control" name="contact_no" id="contact">
                    </div>

                    <div class="form-group">
                        <label for="pan">PAN *</label>
                        <input type="text" class="form-control" name="pan" id="pan">
                    </div>
                    <button type="submit" class="btn btn-outline-primary">Submit</button>
                    <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Close</button>
                </form>
            </div>
        </div>
    </div>
</div>
{{-- modal end --}}
