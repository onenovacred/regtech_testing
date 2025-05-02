<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
   
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta2/dist/css/bootstrap-select.min.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.css">

    <style>
        .dashboard {
            width: 115%;
            padding: 20px;
            box-sizing: border-box;
        }
        body{
            width: 100% !important;
          
        }
       .input-row {
            display: flex;
            align-items: center;
            gap: 85px;
            margin-bottom: 20px;
        }

        .input-box {
            width: 150px;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
    /*Table Css*/
    .table_data{
        max-width: 100%;
    }
    table {
     /* width: 100%;
     border-collapse: collapse; */
    
      border-collapse: collapse !important;
    }
     td {
      border: 1px solid rgb(182, 181, 181) !important;
      padding: 15px !important;
      width: 13px !important; 
      text-overflow: ellipsis !important;
    }
   th {
      background-color: #42067e !important;
      color:white !important;
      border: 1px solid rgb(182, 181, 181) !important;
      padding:10px !important;
      font-weight: 600 !important;
      font-style: initial !important;
   }
   thead{
          width: 50% !important;
   }
   
   .content-width {
      width: 150px !important;/* Set your desired content width */
      overflow: hidden;
      white-space: nowrap; /* Prevent wrapping */
      text-overflow: ellipsis !important; /* Add ellipsis for overflowed content */
    }
    /*dropdown*/
    .bootstrap-select.btn-group .dropdown-menu li a {
            cursor: pointer;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
        }

        .dropdown-menu>.active>a,
        .dropdown-menu>.active>a:hover,
        .dropdown-menu>.active>a:focus {
            color: #fff;
            text-decoration: none;
            background-color: #428bca;
            outline: 0;
        }

        .dropdown-menu>li>a {
            display: block;
            padding: 3px 20px;
            clear: both;
            font-weight: 400;
            line-height: 1.42857143;
            color: #333;
            white-space: nowrap;
        }

        .multiselect,
        .bs-select-all,
        .bs-deselect-all {
            border: 1px solid #ced4da !important;
        }
        .justify-text {
         text-align: justify;
         }
         .small{
            display:none;
         }
    
   
    
</style>

 

    

</head>

<body>
    <div class="container">
        <div class="dashboard">
            <div class="row">
                <div class="col-8">
                    <div class="form-group">
                        <select  name="search_option" id="search_option" class="form-control w-25 selectpicker multiselect"
                        data-actions-box="true"  data-actions-box="true" data-placeholder="Select Search/Export Option.">
                          <option value="mobile_number">Mobile Number</option>
                          <option value="state">State</option>
                          <option value="District">District</option>
                          <option value="Name">Name</option>
                          <option value="Pincode">Pin Code</option>
                        </select>
                    </div>
                </div>   
                <div class="col-4">
                    <form action="{{route('search.download.excel')}}" method="post">
                        @csrf
                    <div class="form-group" id="mobile_number" style="display:none;">
                        <label class="text-muted" for="mobile_number"><b>Mobile No</b></label>
                        <input type="text"  name="mobile_no" class="searchall input-box w-50"
                                placeholder="Search By Mobile Number"/>       
                    </div>
                    <div class="form-group" id="state" style="display:none;">
                        <label class="text-muted" for="searchall"><b>State</b></label>
                        <input type="text" name="state" class="searchall input-box w-50"
                                placeholder="Search By State" />
                    </div>
                    <div class="form-group" id="district" style="display:none;">
                        <label class="text-muted" ><b>District</b></label>
                        <input type="text"  name="district" class="searchall input-box w-50"
                                placeholder="Search By Distract" />
                    </div>
                    <div class="form-group" id="name" style="display:none;">
                        <label class="text-muted" for="searchall"><b>Name</b></label>
                        <input type="text" name="b_name" class="searchall input-box w-50"
                                placeholder="Search By  Name" />
                    </div>
                    <div class="form-group" id="pincode" style="display:none;">
                        <label class="text-muted" for="searchall"><b>Pin code</b></label>
                        <input type="text" name="pincode" class="searchall input-box w-50"
                                placeholder="Search By Pin code" />
                    </div>
                     <div class="mt-2"  style="float:right;">
                         <button type="submit" class="btn btn-success"  style="color:#fff !importent;border-color:#6965b2;background-color: #6965b2;margin-right:316px;">Export</button>
                     </div>
                  </form>
                </div>
               </div>
            </div>
            @if(session('message'))
                <script>
                     var message = "{{ session('message') }}";
                    alert(message);
                </script>
            @endif
        <div class="table_data">
            <table class="table table-striped table-bordered">
              <thead>
                <tr>
                  <th>Name</th>
                  <th>Mobile No</th>
                  <th>Pin code</th>
                  <th>State</th>
                  <th>District</th>
                </tr>
              </thead>
              <tbody id="adav_data">
                   @foreach ($cheackdata as $item)
                        <tr>
                             <td>{{$item->BCName}}</td>
                             <td>{{$item->MobileNo}}</td>
                             <td>{{$item->Pincode}}</td>
                             <td>{{$item->State}}</td>
                             <td>{{$item->District}}</td>
                        </tr>    
                   @endforeach
              </tbody>
            </table>
            <ul class="pagination justify-content-center">
                {{ $cheackdata->links("pagination::bootstrap-5")}}
             </ul>
          </div>
         
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta2/dist/js/bootstrap-select.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.js"></script>
    <script>
         $(document).ready(function () {
          
            $('.searchall').on('keyup', function () {
                var query = $(this).val();
                $.ajax({
                    url: `{{url('search_all') }}`,
                    type: 'POST',
                    headers: {'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')},
                    data: {
                        query: query,
                    },
                    success: function (response) {
                        let advRecords = response.results.data;
                        let pagination = response.pagination;
                        let RowTable = '';
                        $('#adav_data').html('');
                        advRecords.forEach(function (result) {
                            RowTable += `<tr> 
                                <td>${result.BCName}</td>
                                <td>${result.MobileNo}</td>
                                <td>${result.Pincode}</td>
                                <td>${result.State}</td>
                                <td>${result.District}</td>
                                </tr>`;
                        });
                        $('#adav_data').html(RowTable);
                        $('.pagination').html(pagination);
                     }
                });
            });
            //pagination
            $(document).on('click','.pagination a',function(e){
                e.preventDefault();
                let page = $(this).attr('href').split('page=')[1];
                adwChunkData(page);

            })
            function adwChunkData(page){
               $.ajax({
                  url:"/search_all/pagination?page="+page,
                  type:'POST',
                  headers: {'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')},
                  success:function(response){
                   let advRecords= response.results.data;
                   let RowTable = '';
                        $('#adav_data').html('');
                        advRecords.forEach(function (result) {
                            RowTable += `<tr> 
                                <td>${result.BCName}</td>
                                <td>${result.MobileNo}</td>
                                <td>${result.Pincode}</td>
                                <td>${result.State}</td>
                                <td>${result.District}</td>
                                </tr>`;
                        });
                        $('#adav_data').html(RowTable);
                       }
               });
            }

           
        });
            $('#search_option').change(function(){
                 let searchOtpion = $(this).val();
                 let MobileNumber = document.getElementById('mobile_number');
                  MobileNumber.style.display ='none';
                 let state = document.getElementById('state');
                  state.style.display ='none';
                  let district = document.getElementById('district');
                  district.style.display ='none';
                  let Name = document.getElementById('name');
                  Name.style.display ='none';
                  let Pincode = document.getElementById('pincode');
                  Pincode.style.display ='none';
                  if(searchOtpion==='mobile_number'){
                    MobileNumber.style.display="block";
                 }
                 if(searchOtpion==='state'){
                    state.style.display="block";
                 }
                 if(searchOtpion==='Name'){
                    Name.style.display="block";
                 }
                 if(searchOtpion==='District'){
                    district.style.display="block";
                 }
                 if(searchOtpion==='Pincode'){
                    Pincode.style.display="block";
                 }
                 else{
                   // searchInput.style.display="none"; 
                 }
                
            })
      
            
        
    </script>
</body>

</html>
