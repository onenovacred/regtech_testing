{{-- modal start --}}
<!-- Button trigger modal -->
<button type="button" class="btn btn-danger text-sm-center font-weight-bold" data-toggle="modal" data-target="#myModal">
    Download Now
</button>

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body text-justify lead">

                <form action="{{ url('/forms/brouchure_req') }}" method="POST">
                    @csrf

                    <div class="form-group">
                        <label for="name">Full Name*</label>
                        <input type="text" class="form-control" name="full_name" id="name">
                        </div>
                    <div class="form-group">
                        <label for="Email">Email ID*</label>
                        <input type="email" class="form-control" name="email_id" id="Email">
                    </div>
                    <div class="form-group">
                        <label for="contact">Contact No.*</label>
                        <input type="tel" class="form-control" name="contact_no" id="contact">
                    </div>
                    <button type="submit" class="btn btn-outline-primary">Submit</button>
                    <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Close</button>
                </form>
            </div>
        </div>
    </div>
</div>
{{-- modal end --}}
