<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>E-Sign</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</head>

<body>
    <div class="xml_response">
    </div>
    <!--- New Form -->
    <form id="URL" name="URL" class="mt-1" method="POST" enctype="multipart/form-data" action="https://pregw.esign.egov-nsdl.com/nsdl-esp/authenticate/esign-doc/">
        <label>Please confirm</label><br/>
        <input type="hidden" name="msg" value="{{$request_xml}}" />
        <input type="Submit" class="btn btn-sm btn-primary" value="Submit" id="countButton" />
    </form>
</body>

</html>
