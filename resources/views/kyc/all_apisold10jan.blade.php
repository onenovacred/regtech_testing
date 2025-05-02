@extends('adminlte::page')

@section('title', 'All APIs')

@section('content_header')
    <!-- <h1 class="m-0 text-dark">Scheme Details</h1> -->
@stop

@section('content')
<div class = "container">
    <div id = "accordion">
        <div class = "card">
            <div class = "card-header">
                <a class = "card-link" data-toggle = "collapse" href = "#Aadhaar">Aadhaar APIs</a>
            </div>
        <div id = "Aadhaar" class = "collapse" data-parent = "#accordion">
        <div class = "card-body">
            <div class = "row">
            <div class = "col-md-4">
                <span class = "badge badge-dark"><h3>Aadhaar APIs</h3></span>
            </div>
            <div class = "col-md-6">
                <span class = "badge badge-warning"><h4><u>Aadhaar Validation</u></h4></span><br>
                <p><b> Hitting URL : </b> http://regtechapi.in/api/aadhaar_validation</p>
                <b>Request Method : POST </b><br>
                <b>Header : </b><br>
                {<br>   
                "AccessToken":"xxxxxxxxxxxxx"<br>
                }<br>
                <b>Request Body : </b><br>
                {<br>   
                "aadhaar_number":"868889041183"<br>
                }<br>

                <p><b>Success Response : </b><br>
                    [<br>
                        &nbsp;&nbsp;{<br>
                        &nbsp;&nbsp;"aadhaar_validation": { "data": {<br>
                        &nbsp;&nbsp;"client_id": "aadhaar_validation_aIqubluqVsnmhWcebctf", "age_range": "&nbsp;&nbsp;30-40",<br>
                        &nbsp;&nbsp;"aadhaar_number": "868889041183", "state": "Maharashtra",<br>
                        &nbsp;&nbsp;"gender": "M", "last_digits": "693", "is_mobile": true, "less_info": false<br>
                        &nbsp;&nbsp;},<br>
                        &nbsp;&nbsp;"status_code": 200, "success": true, "message": null,<br>
                        &nbsp;&nbsp;"message_code": "success"<br>
                        &nbsp;&nbsp;},<br>
                        &nbsp;&nbsp;"statusCode": null<br>
                        &nbsp;&nbsp;}<br>
                    ]<br>
                </p>


                    <!-- Aadhaar OTP Generate -->
                    <span class = "badge badge-warning"><h4><u>Aadhaar OTP generate</u></h4></span><br>
                    <p><b> Hitting URL : </b> http://regtechapi.in/api/aadhaar_otp_genrate</p>
                    <b>Request Method : GET </b><br>
                    <b>Header : </b><br>
                    {<br>   
                    "AccessToken":"xxxxxxxxxxxxx"<br>
                    }<br>
                    <b>Request Body : </b><br>
                    {<br>   
                    "aadhaar_number":"868889041183"<br>
                    }<br>
                    <b>Success Response : </b><br>
                    {<br>
                    "message_code": "success",<br>
                    "success": true,<br>
                    "status_code": 200,<br>
                    "data": {<br>
                    "otp_sent": true,<br>
                    "if_number": true,<br>
                    "client_id": "aadhaar_v2_UaMdUBdfmrSplknRSsep",<br>
                    "valid_aadhaar": true<br>
                    },<br>
                    "message": "OTP Sent."<br>
                    }<br>
             
                    <!-- Aadhaar OTP Submit -->
                    <span class = "badge badge-warning"><h4><u>Aadhaar OTP Submit</u></h4></span>
                    <p><b> Hitting URL : </b> http://regtechapi.in/api/aadhaar_otp_submit</p>
                    <b>Request Method : POST</b>
                    <b>Request Body :</b><br>
                    {<br>

                    "clientid": "@{{clientid}}",<br>
                    "otp": "@{{otp}}"<br>

                    }<br>
                    <b>Success Response : </b><br>
                    {<br>    "message": null,<br>
                    "success": true,<br>
                    "status_code": 200,<br>
                    "data": {<br>
                    "full_name": "Mohd.Asif Nazimuddin Sayyed",<br>
                    "has_image": true,<br>
                    "dob": "1995-10-04",<br>
                    "raw_xml": "https://aadhaar-api-docs.s3.amazonaws.com/docboyz/aadhaar_xml/474820200725131929442/474820200725131929442-2020-07-25-074929.xml?X-Amz-Algorithm=AWS4-HMAC-SHA256&X-Amz-Expires=432000&X-Amz-SignedHeaders=host&X-Amz-Credential=AKIARVQSU3FJ26BNVN6C%2F20200725%2Fap-south-1%2Fs3%2Faws4_request&X-Amz-Date=20200725T074929Z&X-Amz-Signature=b9e307b9511ae2b8ac3f5a9df2eba39f7e2fe9e24eb4225c641fb5549e8123cb",<br>
                    "address": {<br>
                        "loc": "kondhwa khurd",<br>
                        "vtc": "Pune City",<br>
                        "street": "S.N.54 Bhagyoday Nagar",<br>
                        "dist": "Pune",<br>
                        "landmark": "jamatul salehat madrsha",<br>
                        "po": "N I B M",<br>
                        "house": "Flat n.9 Basera Complex",<br>
                        "subdist": "Pune City",<br>
                        "country": "India",<br>
                        "state": "Maharashtra"<br>
                    },<br>
                    "zip_data": "https://aadhaar-api-docs.s3.amazonaws.com/docboyz/aadhaar_xml/474820200725131929442/474820200725131929442-2020-07-25-074928.zip?X-Amz-Algorithm=AWS4-HMAC-SHA256&X-Amz-Expires=432000&X-Amz-SignedHeaders=host&X-Amz-Credential=AKIARVQSU3FJ26BNVN6C%2F20200725%2Fap-south-1%2Fs3%2Faws4_request&X-Amz-Date=20200725T074929Z&X-Amz-Signature=17669310952ee6b20b4371da6c69f20f2e97b8a922394cad095b2435d5a01e61",<br>
                    "share_code": "5929",<br>
                    "care_of": "",<br>
                    "zip": "411048",<br>
                    "face_status": false,<br>
                    "aadhaar_number": "592154824748",<br>
                    "profile_image": "/9j/4AAQSkZJRgABAgAAAQABAAD/2wBDAAgGBgcGBQgHBwcJCQgKDBQNDAsLDBkSEw8UHRofHh0aHBwgJC4nICIsIxwcKDcpLDAxNDQ0Hyc5PTgyPC4zNDL/2wBDAQkJCQwLDBgNDRgyIRwhMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjL/wAARCADIAKADASIAAhEBAxEB/8QAHwAAAQUBAQEBAQEAAAAAAAAAAAECAwQFBgcICQoL/8QAtRAAAgEDAwIEAwUFBAQAAAF9AQIDAAQRBRIhMUEGE1FhByJxFDKBkaEII0KxwRVS0fAkM2JyggkKFhcYGRolJicoKSo0NTY3ODk6Q0RFRkdISUpTVFVWV1hZWmNkZWZnaGlqc3R1dnd4eXqDhIWGh4iJipKTlJWWl5iZmqKjpKWmp6ipqrKztLW2t7i5usLDxMXGx8jJytLT1NXW19jZ2uHi4+Tl5ufo6erx8vP09fb3+Pn6/8QAHwEAAwEBAQEBAQEBAQAAAAAAAAECAwQFBgcICQoL/8QAtREAAgECBAQDBAcFBAQAAQJ3AAECAxEEBSExBhJBUQdhcRMiMoEIFEKRobHBCSMzUvAVYnLRChYkNOEl8RcYGRomJygpKjU2Nzg5OkNERUZHSElKU1RVVldYWVpjZGVmZ2hpanN0dXZ3eHl6goOEhYaHiImKkpOUlZaXmJmaoqOkpaanqKmqsrO0tba3uLm6wsPExcbHyMnK0tPU1dbX2Nna4uPk5ebn6Onq8vP09fb3+Pn6/9oADAMBAAIRAxEAPwDW701hzTu9DdqgsZSp3pDQvWkDHc0g+8acaQdTQAtTx9agqePtQBDef61PpSx0Xv8ArI/pSRmhATUgpaKLCClFNNPWhjHdjTQOaeelNHNIQlMkHFSGo5OlAFvGIo/90fypnepgP3Ef+4P5VFjmgCh3obpQfvUNyKoYw0L3oNKtIY6kXvS0goEOqaPnpzWVfapBYWrzyHgZwO5xXmmqa/eancGSeTdGGOyPGUX6Dp+PWmlcTdj1i+kBePDA8dqZFIpYoCCwGSO4FeQT66wtVghaVSMhm81sEem3OB+A9OnOcwXuDxz71SpibPe92OD1ozXill4hv7GRXt7qRADnZn5D9R0Ndzpfju3uY4kuIz55+UpEpJZuwUfl370nBrYFI7POKetYkHiGzmlMUgltpR1jmA3fU4JwPc4rZidWRWUgqRkEdxUjJe1MB4pxI2mmDtSAUmmOePant0qNqBmgv/HvH/uCou9Sp/x7R/7oqPvQIzj1oI4o70N92qKGHmlWkpV70hEV1P5MDuo3OFJVfU1Wt9UguIRIrDk4OeAD6E9Aabql0tvCwCs0hHCqM4HqfauBu9cS1vDPEUZiMSRqDtYehBH4/j3HFNK4FrxPdtLbqScKBgD8ef1rjjNtLEkYUfnV3U9WjvIxtJB7qe309q52aUnjPFaRRLsTTsevrSIwyBVZpCT1oDkEmqJJpLhvMPseBUsdx0zVAnLZqRG570AdFp+qNCER2lMK9FV9uPpkEfpXUeHfFkunOkVwxktT99ccoe5X19x35PU88BHJ82Op96vRynICtz65pNJhc9+SRJbcSRsGR1DKynIIPQiha5jwPqH2vw+bd2PnWzlME5O08qf1I/4DXTx9awejLTuh7dDUTVKelRnpR0GaCD/Rov8AdFR45qZP+PaL/dH8qYaBGUetIx+WlJ4prEbaooaDSg4zTc1HMHaCQRttcqQrehxwaQHn3ibV3u53jhlIhPJw3BxnH+fWuNuHwflP41u6+jQ6pdxtwBKxA9icj9MVzkvJ69K1S0IbK0jHNREM3RTVyG1MpBK96vpYLwCKUppFRhcxBA7DOKd9mkx0rd+yKvG2gW4/uiodVmnsUYJgcdjTMFTjBrovswPG2g6aHGdvNL21twdHsYSNt68VZhkbd3FS3enlPm2morZNr4PStVJPUylG256D8P7tYb+aJslrlQgAHdQzZJ/MfjXpUdeR+ELmO21+1MuAjNsU5PDMCo/U4/GvW46znuKOxI3SojnFSHkVGelT0KRqKP8ARYv9wfypmOKev/HrF/uD+VNoEYwPApG6VHG2eM1Ix+WqKGZ9qXsaSjtSYHlXiqZZ9cvWHZyn4qNp/UVzghLsAOpOK2NVlE17cSJyrSMRn3JNO0ey+03ygjhBmtdkQldl230oQWiMV+YjJqCRQrEACujvGihg2ySKgH944rnJ7y2LkLKpP1rCSudUbJFd+pOaQAE0vmRueCD9Kco9KhmiHKox0q3CuR0xVdBz1q1G6IMs6g+hNQxjpbZJUxtBOK52/sWtZsgfKa6RLq3yFEq5z0pmqxCS0LAdKuDcWZTSkjFs5GQgo21xyrZxtPrXuFu/mwpJgDcobAIOM+44NeHRZTHHFeqeDZp5NBi8xcIpIjPqM/45/wA5xvPY5Vozo801sAU/IxyKbIBjiouUaYGLeMd9g/lTcVIB+6X6CoyaBHPRnpUrY21EgqQniqLENJ2pSaT+GkI8g1C2Flfz2y52wyNGuepAOAfyFanh/McFxcBcnO0f5/GovEtpJDrd1uQhXcupPcHmr+iw7dHZgMbmJ/p/StG/dCC1MfVI5JGLzyck85NYU1vzw5HsRXSy21wZ2mMiKufvDl8d9ueAcd65++t0FyfKdjGe7dalX7ltFWLcrYD1qW8jSEdTVFLcyTZjU7Txg810dvpwtYo933261nORpTiZN7HcKRhtq1mbpWfHmfrXTarZ+ZFuQEnGPpXOtbHYFGRIDzmlTldCqRdy9Z2ZkI/eDPoa3baGUQvbSnchU4PpWfbWLR2MZScySk5dNp2gfUjr9P8A69bunK5iAkGCOmTmibZMUcpExLBD1FeqeCIpYvD6tI2VklZox/dXgY/MMfxrzh7VhqM0cSMzGQhFUZJOeAK9g0y0+wadb2pIZoowrMvAZu5H1Oa1b0MbWZeAqOTgZFSA8UyUZXFQM15KhPeppf61FigRgKMClPSjHHcUHJ9KoobQfu0p9xSE8UCOH8V5l1VkXJ2Q/Nnp6/1qxpkK/wBlxKDjKA/mM0niO2Zb2aRefMjBH4df5Ulg5NjDg9FApX0NktjP1CAKzLnNYklsN2SK6W9A64HvWDcNh+BkE1m27mySsWdItElldgoxHyWPCr9TV26KC5CB1dR0I6GsgC4msWtI2ZFLl8g45wB/Sq8Xm2ZEcsrykHkk9PpStcd7M6SW2/dhuCD1AOcVlSWsUjZ2iktYrm3vPta3rPExz5TZOPz4qWPcHO7pntUONth7j7W32HbitSC2KYOaZbIDgkZq8p+bGKLslpGfYRP/AMJMsUQwXlRiw6gAAnFekKK4bw9H53iR5sfd3jP0AFd2orZHLMPahBukRT0JAzTulEfzXMX++P50yTSfqQajOM1KxBBqHvQIwzwKQ9Kc1NIplBxSEcdaMUpoEc/4kika3R1UYTPzelYumHbaEEY2sRiu5A655rK1e1At1eNQqr8pAGOvSlsaRlpY528/eLxWPOiRcuea12baDk5xXN6gZJpSFOFzjNTY1vbYszXEcKKxfBI4Ucms9nWZyQ2Cf7wqTybOCL5meSXHLMf6VD/o5BwcH/eptFRV9zStpFdVjEnPYHjNXgmSAetZVvBC/GSD25q1AJ4Z/nl8xSeD6VDSB6G1bqAnXirAYAFvQVViOUHNa2k2IvrlY5VzEAWf3Hp+eP1qbakydkN8LIUvslWOVIyegPXP6V2gBqtaafa2AKW8RQEd3LfqSat4rVeZzzab0Ex606H5rmIf7QP5UAU+2H+mp+P8jTJLknJ5qIg+9PfqaZnmgRitTT2pzHJphPNMsKU0g7U40CADg02WNZImRxlWGCKcvSlJ4pAcDefuppIieVYr+VY0tuXY88d61tZ41C5I/wCer/8AoRrIa52Eg8ikbplOa3O4/MMVClpG8mGOafPPz7VXE2HBB6UtSro04LFo2yjZHvVyNXHBqjBe5wuavRzBsAClr1FdGparwua73SbJbSzXPLv8zH+n0rgrLLOCecV6VGAqhR0HFNKxnUbYN96nCmt96n98VRkKOlPtBm5z6KajqSz/AOPlz/sH+YoAnY80w9ac55NN4NMRiMeaaTzSk5ppPNBQqnmnGmKeacTSAcDwKyr7X7W0neHZJKY1zI6bdiHsGJI9D0z0PoadrF4bWzf5igwd7A4I7YHufb9DiuL1Q3H/AAjltNtKK5MjbemS5VR+CqB+NK40gvbgXksk65CysXAPbJzWTKvNXIyBbR7TkBQKqSnkmpb1OlLQoSqQKjSMk8mrMpBGTTYeuKdwsTQw9OorSt4gMZqtEyqMsQPrTm1CKI/L8x/SpuxcqRvW8iQp5j/dHOMV6Las0lujPnd0b6jg/qK8s8OxzazrkCvzFGwYjsMd/wAK9bVGW2iLQGEkFmQ9VYnLD8GJ+tNaOxjN3Iv46d3pO5pQaozFqSz+9MemAB/P/ComOAafZZxKfUgfzpgTMeabmhjSDrQBhbueKQtzUMSu8zRhssqqxAGeGJA9j0PemXl3HbSR28Z3XBcqwPXAyBj8Sv50nJIonMyIVBOS2MADPU4HSrcEe5d7K2OuFBJ9se9UrGweO1hEgVp1QCacDq2BuAPHGRz0yR2P3Z7u8e3geNCqlU2L5h4MjY4IGOBxnHYnHQ1LbegjB8SL5iFd67Edk+XoxH3m+g+6PTB68VWktop9JWxlVkWMM8npgKMjP1kB/wCA1pSpG1qrJ+9jjKRw8ltxBx94e5GT/sn3pkdufsbQyOsomK2+1uFkPPmEY7kF/wAV/Gs09Srnnz+dp8nkS9MZH0pjuGWuz1fQl1K3kePKztIzR7xjkYUjPvtz75zXCEOjFGVlZThlYYII7Edqtaq7NoS6COeo7UwMVHFOY+1RnNBoKzluCSadBG1xPHCjKGkcICxwMk45NMC9/Suq8HWYia61mRAy2kZWMOMgysAF+vU544yDTvbVmc2bPhqyli12C2tMolqcSbWyJW5DE8dCTjpwoHpXoV08yptYsYmjlZ5gAdjblVDt9MZP/Ae/WuZ8GWoOnXN1kjfN5R2D944ChtinPBOck8cD6MutqV9GqWsYKBrlsQiM5URqvJH+z/CMDGCT0fFZuT3ZzPcxpb+S3uJNl00u1lxk53AtgH2DHvjoDj21YNSgmcJvIfds5GPmxkdzjj1/rWNe24aYrF8q3MAUTjr93K4Hf7zH8DUNr5t1KvkoFEr27lcfNy4DEj/dA/KhSaYzqnYYIBBxxwalsz/ozf8AXQ/yFY9tdM0dxaBVSWKSfyy33SBKRz9dwP51Zg1GONfL4Kkbw4cHdnuPbg8/lmtFNBY0mOfpSA81HuJUNjg9D2NN381RJznnyxR3d5DsV/ISLk/ckBfB+nzAj1zWFJrLWF086RrNeyBdnmDKwqe+O7EfgBg85IrXlTd4bvHaJzNITGWHAJQEo2O3zAj8hXPx2wm1BvMQIFkCkL04QN/LrWTaNEV59U1bUZHlN3MMKSPKbYAvb7uOD159B6VnTQMrOCMEED9M12FvpyQ3E6bc4t4h+OXFZ2pWP+iXk6oT5E+Tj08tTn8zSUm7AZvh2WC21SOa4+QFPvhckE5x0/L8a66C4QQwTlkKQW7zzxRAEq7YY4x34lGM965aG2zdBVH91foQC38qliM0F+jQSsmRIflPBIdcZpPULHXvGYIoYGO8QwqrzYGPlGDuHv1z2/Q8f4p0kI326MEZwJATnPQA5/L/APXmtDTddOIp9QLCZlDm4jADYx0IAwRyfX6Z5rYuIUuLMRBI2BGCin5WUj7yZ6cdV7e+PmObXQa908taPvimlcmtG/szaXLR8lMnaxHUZx+BB4PuKqhOc1VzoTugtrWS5mjgiTfJIwRFHdicAV6Hf6V9h0yx0yIh41wrMg4ZsMWf1GcvjkjlfWsvwhp3lJLrEgUFMw2vmZwZG+XJ9ssFyO7e1dBeXKwmQqzSTxqIYyxyys+CzEnhuNh6fwn1qJO7SMJy1MK21e50r7ZHbsyxSI643FSrFdocYPXKg9+ABXRxX9t4geK9hWRJ4ZlhljYdFKsVPBxjJbB749q5+PThcCfLeRDEASwGcRrz0/Bh+FdBbadFoeWeRo5zAsUsiAEM8jBflzyMFQcd8rzxSfvJkMjmnU6fYWsfLxwwK/rwisAfzz+NGhGW3vJgI2djFcSeYf4Sj8L/AOP/APjtMiSW61qeTH37rLc9vJH9cVctvNsLW7R4mZwLrIBGeZTsGP8AaAOPpVLf+uwmZct0bbUCqNhWkdmJ7jeMj8cmh70C7EUSfuUuSuCM5Bj3nPr8xPFUNXJFtcsGO9IZD+ef8KkmVg20cEyRtn/gQH8h+tJafgUbGiSedcOs08iRR28U0pxjk7snjrnaOK6BHSVwg+WYjeY8ZCL05YcAk9u/OM7Sa5myuvsbzExGR5It2MZ+5KoX9XHPata3VXilE8iGEDfeytgKRjOwZ4C4656L7tuq4vRW3IZh3Ja30y2jdmfaiAMv3XE0m7keq4H/AH1VZbGSRL4xFSJo5QjZ+7IEVP8AGiil9q39bFPQkvLz7LNqcmD8lkjKR6jzT/hTlT7Tb3ETsoW4L793HyIg3Y+haP8AAmiipb0XzGUvsLQalODnAnGP+/YqK2Qbhv8AvtNKo/76Y/8AstFFHX5girFbbZ7WIgYW3cH2wUFS6TqE1vbIWDSW80Qk8oHay9yVPY8j8u3WiilZNa+YyXU7aHU4ARKpYt+6nxj5uPlcDoTwM4x09geZt7Oee/SyRMXDv5YUjOD747DqT6UUVUHdalJ2R6TIYtPs7K1iIEMQLnI4IA4LdwSx3D/dNZk0Tyxo0rMkxJcMxyUd8gD0ONxH5UUVHX7jM1mMNq8kseCXMFq6nkY3+nuJcVXkSa9ub0H7qX8HHtiEmiitLb+qJNWBU+0mS2lTeJJJPLbjeETyyP8AvvFUL8ebEYYmysUqkg8nCLkDPsQGoopPr8wOceYrdyzSBljW3ikZSOQNzkgj6DFWYty3cjOAIzMpwe42AD/x7H5UUUrdPQs09OzJbXXlsnnP5sUZYdMShz9cCPP4VpwtGlsqgf6JA27HBaeTPGO33vXq3PGMsUU1otCep//Z",<br>
                    "face_score": -1,<br>
                    "mobile_verified": false,<br>
                    "gender": "M",<br>
                    "client_id": "aadhaar_v2_UaMdUBdfmrSplknRSsep"<br>
                    },<br>
                    "message_code": "success"<br>
                }<br>
            </div>
            </div>
        </div>
        </div>
        </div>

        <!--PAN APIs-->
        <div class = "card">
            <div class = "card-header">
                <a class = "card-link" data-toggle = "collapse" href = "#PAN">PAN APIs</a>
            </div>
            <div id = "PAN" class = "collapse" data-parent = "#accordion">
                <div class = "card-body">
                     <div class="row">
                        <div class = "col-md-4">
                        <span class = "badge badge-dark"><h3>Pan Card APIs</h3></span>
                        </div>
              <div class = "col-md-6">
                <span class = "badge badge-warning"><h4><u>PAN Verification</u></h4></span><br>
                <p><b> Hitting URL : </b> http://regtechapi.in/api/pancard</p>
                <b>Header : </b><br>
                {<br>   
                "AccessToken":"xxxxxxxxxxxxx"<br>
                }<br>
                <b>Request Body : </b><br>
                {<br>   
                "pan_number":"ARTPB4748P"<br>
                }<br>

                <p><b>Success Response : </b><br>
                    [<br>
                        &nbsp;&nbsp;{<br>
                        &nbsp;&nbsp;"pancard":  {<br>
                        &nbsp;&nbsp;"data": {<br>
                        &nbsp;&nbsp;"client_id":"pan_WkNzvNBotdVtlscFqbur", "pan_number":"ARTPB4748P",<br> &nbsp;&nbsp;"full_name":"DEVANAND PANNALAL SHARMA",<br>
                        &nbsp;&nbsp;"category":"person"<br>
                        &nbsp;&nbsp;&nbsp;&nbsp;}<br>
                        &nbsp;&nbsp;"status_code":200, "success":TRUE, "message":NULL, "message_code":"success"<br>
                        &nbsp;&nbsp;}<br>,
                        "statusCode":NULL<br>



                        &nbsp;&nbsp;}<br>
                    ]<br>
                </p>


                <!-- PAN Upload -->
                <span class = "badge badge-warning"><h4><u>Pancard Upload</u></h4></span><br>
                <p><b> Hitting URL : </b>http://regtechapi.in/api/panupload</p>
                <b>Request form-data : </b><br>
                file – pancard image file<br>
                <br>
                <b>Success Response :</b>
                <br>
                <p>
                    "{\"data\":  {\"client_id\":  \"pan_photo_dfndubtlyasFUMojgfbw\",  \"pan_number\":  \"ARTPB4748P\",  \ "dob\":  \"04/07/1991\",  \"father_name\":  \"Hiralal  Chavan\",  \"full_name\":  \"Devanand Pannalal Sharma\",  \"strict_status\":  false,  \"strict_check\":  false,  \"individual_pan\":  true,  \"pan_confiden ce\":  99.0,  \"signature_confidence\":  0.0,  \"information_mismatch\":  [],  \"valid_pan\":  true},  \" status_code\":  200,  \"success\":  true,  \"message\":  null,  \"message_code\":  \"success\"}\n"
                </p>

                <!-- PAN INFO--->

                <span class = "badge badge-warning"><h4><u>PAN Info</u></h4></span><br>
                    <p><b> Hitting URL : </b> http://regtechapi.in/api/pancard_details</p>
                    <b>Header : </b><br>
                    {<br>   
                    "AccessToken":"xxxxxxxxxxxxx"<br>
                    }<br>
                    <b>Request Body : </b><br>
                    {<br>   
                    "pan_number":"BPZPM1894M"<br>
                    }<br>

                    <p><b>Success Response : </b><br>
                        [<br>
                            &nbsp;&nbsp;{<br>
                            &nbsp;&nbsp;"pancard":  {<br>
                            &nbsp;&nbsp;"data": {<br>
                            &nbsp;&nbsp;"panNumber":"BPZPM1894M",<br> &nbsp;&nbsp;"fullName":"PRITESH LAXMAN MEHETRE",<br> &nbsp;&nbsp;"isValid":"true",<br> &nbsp;&nbsp;"firstName":"PRITESH",<br> &nbsp;&nbsp;"middleName":"LAXMAN",<br> &nbsp;&nbsp;"lastName":"MEHETRE",<br> &nbsp;&nbsp;"title":"Shri",<br> &nbsp;&nbsp;"panStatusCode":"E",<br> &nbsp;&nbsp;"panStatus":"Valid",<br> &nbsp;&nbsp;"aadhaarSeedingStatus":"Aadhaar seeding is Successful",<br> &nbsp;&nbsp;"aadhaarSeedingStatusCode":"Y",<br> &nbsp;&nbsp;"lastUpdatedOn":"18/08/2017",<br>
                            &nbsp;&nbsp;&nbsp;&nbsp;}<br>
                            &nbsp;&nbsp;"status_code":200<br>
                            &nbsp;&nbsp;}<br>



                            &nbsp;&nbsp;}<br>
                        ]<br>
                    </p>

                    <span class = "badge badge-warning"><h4><u>PAN Details</u></h4></span><br>
                    <p><b> Hitting URL : </b> http://regtechapi.in/api/pan_details_check</p>
                    <b>Header : </b><br>
                    {<br>   
                    "AccessToken":"xxxxxxxxxxxxx"<br>
                    }<br>
                    <b>Request Body : </b><br>
                    {<br>   
                    "pan_number":"BPZPM1894M"<br>
                    }<br>

                    <p><b>Success Response : </b><br>
                        [<br>
                            &nbsp;&nbsp;{<br>
                            &nbsp;&nbsp;"pancard":  {<br>
                            &nbsp;&nbsp;"data": {<br>
                            &nbsp;&nbsp; "client_id": null,
                            "transactionId": "ZrRGcfiABRAK91NPE5ibBnqb",
                            "panNumber": "BPZPM1894M",
                            "maskedAadhar": "XXXXXXXX3390",
                            "lastFourDigitAadhar": "3390",
                            "typeOfHolder": "Individual or Person",
                            "name": "PRITESH LAXMAN MEHETRE",
                            "firstName": "PRITESH",
                            "middleName": "LAXMAN",
                            "lastName": "MEHETRE",
                            "gender": "M",
                            "dob": "18/04/1993",
                            "address": "Flat No. 3,Nilgiri nest - Pimple Gurav Pune - 411061 Maharashtra",
                            "city": "-",
                            "state": "Maharashtra",
                            "country": "INDIA",
                            "pincode": "411061",
                            "mobile_no": "9665189633",
                            "email": "priteshmehetre11@gmail.com",
                            "isValid": true,
                            "aadhaarSeedingStatus": true,
                            "serviceCode": "1",<br>
                            &nbsp;&nbsp;&nbsp;&nbsp;}<br>
                            &nbsp;&nbsp;"status_code":200,  "success": true,
                             "message_code": "success"<br>
                            &nbsp;&nbsp;}<br>



                            &nbsp;&nbsp;}<br>
                        ]<br>
                    </p>
              </div>
                
                </div>
                </div>
            </div>
        </div>
    </div>

    <!--VOTER ID APIS-->
    <div class = "card">
        <div class = "card-header">
            <a class = "card-link" href = "#Voter" data-toggle="collapse">Ecredit</a>
        </div>
        <div id = "Voter" class = "collapse" data-parent="#accordion">
            <div class = "card-body">
                <div class="row">
                    <div class = "col-md-4">
                        <span class = "badge badge-dark"><h3>Ecredit APIs</h3></span>
                    </div>
                    <div class = "col-md-6">
                         <!-- VOTER ID UPLOAD -->
                         <span class = "badge badge-warning"><h4><u>Ecredit OTP</u></h4></span><br>
                        <p><b> Hitting URL : </b>http://regtechapi.in/api/ecreditsendOTP</p>
                        <b>Request Body : </b><br>
                        {<br>   
                        "phone_number":""<br>
                        }<br>
                        <b>Success Response :</b>
                        <br>
                        <p>
                        "{"success":  "OTP sent successfully"}\n"

                        </p>
                        <span class = "badge badge-warning"><h4><u>Ecredit_Report</u></h4></span><br>
                        <p><b> Hitting URL : </b>http://regtechapi.in/api/ecrediturl</p>
                        <b>Header : </b><br>
                        {<br>   
                        "AccessToken":"xxxxxxxxxxxxx"<br>
                        }<br>
                        <b>Request Body : </b><br>
                        {<br>   
                        "fname":""<br>
                        "lname":""<br>
                        "phone_number":""<br>
                        "pan_num":""<br>
                        "dob":""<br>
                        "otp":""<br>
                        }<br>
                        <b>Success Response :</b><br>
                        {<br>
                       {
                        "Equifax_Report": {
                            "InquiryResponseHeader": {
                                "ClientID": "027FP27964",
                                "CustRefField": "DB-NIPL22110267",
                                "ReportOrderNO": "562166154",
                                "ProductCode": [
                                    "PCRLT"
                                ],
                                "SuccessCode": "1",
                                "Date": "2022-11-07",
                                "Time": "16:06:15"
                            },
                            "InquiryRequestInfo": {
                                "InquiryPurpose": "16",
                                "FirstName": "Tester",
                                "LastName": "tesr",
                                "InquiryPhones": [
                                    {
                                        "seq": "1",
                                        "PhoneType": [
                                            "M"
                                        ],
                                        "Number": "7776998208"
                                    }
                                ],
                                "IDDetails": [
                                    {
                                        "seq": "1",
                                        "IDType": "t",
                                        "IDValue": "BPZPM1894M",
                                        "Source": "Inquiry"
                                    }
                                ]
                            },
                            "Score": [
                                {
                                    "Type": "ERS",
                                    "Version": "3.1"
                                }
                            ],
                            "CCRResponse": {
                                "Status": "1",
                                "CIRReportDataLst": [
                                    {
                                        "InquiryResponseHeader": {
                                            "CustomerCode": "AFIB",
                                            "CustRefField": "DB-NIPL22110267",
                                            "ReportOrderNO": "562166154",
                                            "TranID": "4072023724",
                                            "ProductCode": [
                                                "PCRLT"
                                            ],
                                            "SuccessCode": "1",
                                            "Date": "2022-11-07",
                                            "Time": "16:06:14",
                                            "HitCode": "00"
                                        },
                                        "InquiryRequestInfo": {
                                            "InquiryPurpose": "Fleet Card",
                                            "FirstName": "Tester",
                                            "LastName": "tesr",
                                            "InquiryPhones": [
                                                {
                                                    "seq": "1",
                                                    "PhoneType": [
                                                        "M"
                                                    ],
                                                    "Number": "7776998208"
                                                }
                                            ],
                                            "IDDetails": [
                                                {
                                                    "seq": "1",
                                                    "IDType": "t",
                                                    "IDValue": "BPZPM1894M",
                                                    "Source": "Inquiry"
                                                }
                                            ],
                                            "CustomFields": [
                                                {
                                                    "key": "INQUERY_PRODUCT_CODE",
                                                    "value": "PCRLT"
                                                }
                                            ]
                                        },
                                        "Error": {
                                            "ErrorCode": "00",
                                            "ErrorDesc": "Consumer not found in bureau"
                                        }
                                    }
                                ]
                            }
                        },
                        "statusCode": "200"
                        }
                        }<br>

                

                            <!-- VOTER ID UPLOAD -->
                                <!-- <span class = "badge badge-warning"><h4><u>Voter ID Upload</u></h4></span><br>
                                <p><b> Hitting URL : </b>http://regtechapi.in/api/voter_upload</p>
                                <b>Request form-data : </b><br>
                                file – voter id image file<br>
                                <br>-
                                <b>Success Response :</b>
                                <br>
                                <p>
                                "{\"data\":  {\"client_id\":  \"ocr_voter_JJqCfxggzTMswegksvdp\",  \"ocr_fields\":  [{\"document_type
                                \":  \"voterid_front\",  \"full_name\":  {\"value\":  \"Rajesh\",  \"confidence\":  92.0},  \"age\":  {\" value\":  \"26\",  \"confidence\":  78.0},  \"care_of\":  {\"value\":  \"Saradaval\",  \"confidence\":  9 6.0},  \"dob\":  {\"value\":  \"1800-01-01\",  \"confidence\":  0.0},  \"doc\":  {\"value\":  \"2003-01- 01\",  \"confidence\":  95.0},  \"gender\":  {\"value\":  \"M\",  \"confidence\":  95.0},  \"epic_number\ ":  {\"value\":  \"MTG1947852\",  \"confidence\":  92.0}}]},  \"status_code\":  200,  \"success\":  true,
                                \"message\":  null,  \"message_code\":  \"success\"}\n"

                                </p> -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!----Enach------->
    <div class = "card">
        <div class = "card-header">
            <a class = "card-link" href = "#Enach" data-toggle="collapse">Enach</a>
        </div>
        <div id = "Enach" class = "collapse" data-parent="#accordion">
            <div class = "card-body">
                <div class="row">
                    <div class = "col-md-4">
                        <span class = "badge badge-dark"><h3>Enach APIs</h3></span>
                    </div>
                    <div class = "col-md-6">
                         <!-- VOTER ID UPLOAD -->
                         <span class = "badge badge-warning"><h4><u>Seameless API</u></h4></span><br>
                        <p><b> Hitting URL : </b>http://regtechapi.in/api/search</p>
                        <b>Request Body : </b><br>
                        {<br>   
                        "seamlesstoken":""<br>
                        }<br>
                        <b>Success Response :</b>
                        <br>
                        <p>
                        "{
                        "statusCode": 200,
                        "Link": "https://regtechapi.in/enach_payment_seameless/7XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXf"
                    }\n"

                        </p>
                        <span class = "badge badge-warning"><h4><u>Non-seameless API</u></h4></span><br>
                        <p><b> Hitting URL : </b>http://regtechapi.in/api/search</p>
                        <b>Request Body : </b><br>
                        {<br>   
                        "accesstoken":""<br>
                        }<br>
                        <b>Success Response :</b>
                        <br>
                        <p>
                        "{
                        "statusCode": 200,
                        "Link": "https://regtechapi.in/e-nach-initiate-payments/7XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXf"
                    }\n"

                        </p>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!------Payment------------->
    <!----Enach------->
    <div class = "card">
        <div class = "card-header">
            <a class = "card-link" href = "#Payment" data-toggle="collapse">Payment Gateway</a>
        </div>
        <div id = "Payment" class = "collapse" data-parent="#accordion">
            <div class = "card-body">
                <div class="row">
                    <div class = "col-md-4">
                        <span class = "badge badge-dark"><h3>Payment Gateway APIs</h3></span>
                    </div>
                    <div class = "col-md-6">
                         <!-- VOTER ID UPLOAD -->
                         <span class = "badge badge-warning"><h4><u>Seameless API</u></h4></span><br>
                        <p><b> Hitting URL : </b>http://regtechapi.in/api/search</p>
                        <b>Request Body : </b><br>
                        {<br>   
                        "paymenttoken":""<br>
                        }<br>
                        <b>Success Response :</b>
                        <br>
                        <p>
                        "{
                        "statusCode": 200,
                        "Link": "https://regtechapi.in/initiate-payment-integrations/7XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXf"
                    }\n"

                        </p>
                       
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--Equifax--->
    <!--Equifax Score Api Start--> 
 <div class = "card">
    <div class="card-header">
        <a class = "card-link" href = "#equifaxscore" data-toggle="collapse">CreditScoreOnly APIs</a>
    </div>
    <div id="equifaxscore" class = "collapse" data-parent="#equifaxscore">
        <div class = "card-body">
            <div class="row">
                <div class = "col-md-4">
                    <span class = "badge badge-dark"><h3>CreditScoreOnly APIs</h3></span>
                </div>
                <div class = "col-md-6">
                    <span class = "badge badge-warning"><h4><u>CreditScoreOnly APIs</u></h4></span><br>
                    <p><b> Hitting URL : </b>http://regtechapi.in/api/creditscoreonly</p>
                    <b>Header : </b><br>
                    {<br>   
                    "AccessToken":"xxxxxxxxxxxxx"<br>
                    }<br>
                    <b>Request Body : </b><br>
                    {<br>   
                    "FirstName":""<br>
                    "LastName":""<br>
                    "MobileNumber":""<br>
                    "IdValue":""<br>
                    "DOB":""<br>
                    
                    }<br>
                    <b>Success Response :</b><br>
                     {
                      "statusCode": 200,
                      "success": true,
                      "ScoreValue ": "497"
                     }
                    <br>

            

                <!-- VOTER ID UPLOAD -->
                    <!-- <span class = "badge badge-warning"><h4><u>Voter ID Upload</u></h4></span><br>
                    <p><b> Hitting URL : </b>http://regtechapi.in/api/voter_upload</p>
                    <b>Request form-data : </b><br>
                    file – voter id image file<br>
                    <br>-
                    <b>Success Response :</b>
                    <br>
                    <p>
                    "{\"data\":  {\"client_id\":  \"ocr_voter_JJqCfxggzTMswegksvdp\",  \"ocr_fields\":  [{\"document_type
                    \":  \"voterid_front\",  \"full_name\":  {\"value\":  \"Rajesh\",  \"confidence\":  92.0},  \"age\":  {\" value\":  \"26\",  \"confidence\":  78.0},  \"care_of\":  {\"value\":  \"Saradaval\",  \"confidence\":  9 6.0},  \"dob\":  {\"value\":  \"1800-01-01\",  \"confidence\":  0.0},  \"doc\":  {\"value\":  \"2003-01- 01\",  \"confidence\":  95.0},  \"gender\":  {\"value\":  \"M\",  \"confidence\":  95.0},  \"epic_number\ ":  {\"value\":  \"MTG1947852\",  \"confidence\":  92.0}}]},  \"status_code\":  200,  \"success\":  true,
                    \"message\":  null,  \"message_code\":  \"success\"}\n"

                    </p> -->
                </div>
            </div>
        </div>
    </div>
</div>
     <!---Equifax withou otp------->
    <div class = "card">
        <div class = "card-header">
            <a class = "card-link" href = "#telecom" data-toggle="collapse">Ecredit Without Otp</a>
        </div>
        <div id = "telecom" class = "collapse" data-parent="#accordion">
            <div class = "card-body">
                <div class="row">
                    <div class = "col-md-4">
                        <span class = "badge badge-dark"><h3>Ecredit Without OTP APIs</h3></span>
                    </div>
                    <div class = "col-md-6">
                        <span class = "badge badge-warning"><h4><u>Ecredit_Report</u></h4></span><br>
                        <p><b> Hitting URL : </b>http://regtechapi.in/api/ecredit</p>
                        <b>Header : </b><br>
                        {<br>   
                        "AccessToken":"xxxxxxxxxxxxx"<br>
                        }<br>
                        <b>Request Body : </b><br>
                        {<br>   
                        "fname":""<br>
                        "lname":""<br>
                        "phone_number":""<br>
                        "pan_num":""<br>
                        "dob":""<br>
                        
                        }<br>
                        <b>Success Response :</b><br>
                        {<br>
                       {
    "Equifax_Report": {
        "InquiryResponseHeader": {
            "ClientID": "027FP27964",
            "CustRefField": "DB-NIPL22110267",
            "ReportOrderNO": "562166154",
            "ProductCode": [
                "PCRLT"
            ],
            "SuccessCode": "1",
            "Date": "2022-11-07",
            "Time": "16:06:15"
        },
        "InquiryRequestInfo": {
            "InquiryPurpose": "16",
            "FirstName": "Tester",
            "LastName": "tesr",
            "InquiryPhones": [
                {
                    "seq": "1",
                    "PhoneType": [
                        "M"
                    ],
                    "Number": "7776998208"
                }
            ],
            "IDDetails": [
                {
                    "seq": "1",
                    "IDType": "t",
                    "IDValue": "BPZPM1894M",
                    "Source": "Inquiry"
                }
            ]
        },
        "Score": [
            {
                "Type": "ERS",
                "Version": "3.1"
            }
        ],
        "CCRResponse": {
            "Status": "1",
            "CIRReportDataLst": [
                {
                    "InquiryResponseHeader": {
                        "CustomerCode": "AFIB",
                        "CustRefField": "DB-NIPL22110267",
                        "ReportOrderNO": "562166154",
                        "TranID": "4072023724",
                        "ProductCode": [
                            "PCRLT"
                        ],
                        "SuccessCode": "1",
                        "Date": "2022-11-07",
                        "Time": "16:06:14",
                        "HitCode": "00"
                    },
                    "InquiryRequestInfo": {
                        "InquiryPurpose": "Fleet Card",
                        "FirstName": "Tester",
                        "LastName": "tesr",
                        "InquiryPhones": [
                            {
                                "seq": "1",
                                "PhoneType": [
                                    "M"
                                ],
                                "Number": "7776998208"
                            }
                        ],
                        "IDDetails": [
                            {
                                "seq": "1",
                                "IDType": "t",
                                "IDValue": "BPZPM1894M",
                                "Source": "Inquiry"
                            }
                        ],
                        "CustomFields": [
                            {
                                "key": "INQUERY_PRODUCT_CODE",
                                "value": "PCRLT"
                            }
                        ]
                    },
                    "Error": {
                        "ErrorCode": "00",
                        "ErrorDesc": "Consumer not found in bureau"
                    }
                }
            ]
        }
    },
    "statusCode": "200"
}
                        }<br>

                

                    <!-- VOTER ID UPLOAD -->
                        <!-- <span class = "badge badge-warning"><h4><u>Voter ID Upload</u></h4></span><br>
                        <p><b> Hitting URL : </b>http://regtechapi.in/api/voter_upload</p>
                        <b>Request form-data : </b><br>
                        file – voter id image file<br>
                        <br>-
                        <b>Success Response :</b>
                        <br>
                        <p>
                        "{\"data\":  {\"client_id\":  \"ocr_voter_JJqCfxggzTMswegksvdp\",  \"ocr_fields\":  [{\"document_type
                        \":  \"voterid_front\",  \"full_name\":  {\"value\":  \"Rajesh\",  \"confidence\":  92.0},  \"age\":  {\" value\":  \"26\",  \"confidence\":  78.0},  \"care_of\":  {\"value\":  \"Saradaval\",  \"confidence\":  9 6.0},  \"dob\":  {\"value\":  \"1800-01-01\",  \"confidence\":  0.0},  \"doc\":  {\"value\":  \"2003-01- 01\",  \"confidence\":  95.0},  \"gender\":  {\"value\":  \"M\",  \"confidence\":  95.0},  \"epic_number\ ":  {\"value\":  \"MTG1947852\",  \"confidence\":  92.0}}]},  \"status_code\":  200,  \"success\":  true,
                        \"message\":  null,  \"message_code\":  \"success\"}\n"

                        </p> -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!---Equifax without otp end--->
    <!---Equifax score only--->
    <div class = "card">
        <div class = "card-header">
            <a class = "card-link" href = "#telecomee" data-toggle="collapse">Ecredit Score</a>
        </div>
        <div id = "telecomee" class = "collapse" data-parent="#accordion">
            <div class = "card-body">
                <div class="row">
                    <div class = "col-md-4">
                        <span class = "badge badge-dark"><h3>Ecredit Score</h3></span>
                    </div>
                    <div class = "col-md-6">
                        <span class = "badge badge-warning"><h4><u>Ecredit Score</u></h4></span><br>
                        <p><b> Hitting URL : </b>http://regtechapi.in/api/ecredit_score</p>
                        <b>Header : </b><br>
                        {<br>   
                        "AccessToken":"xxxxxxxxxxxxx"<br>
                        }<br>
                        <b>Request Body : </b><br>
                        {<br>   
                        "fname":""<br>
                        "lname":""<br>
                        "phone_number":""<br>
                        "pan_num":""<br>
                        "dob":""<br>
                        
                        }<br>
                        <b>Success Response :</b><br>
                        {<br>
                       {
                            "Score": {
                            "data": {
                                "Name": "PRITESHMEHETRE",
                                "ScoreDetails": "790"
                            }
                        },
                        "statusCode": "200"
   
                        }<br>}

                

                    <!-- VOTER ID UPLOAD -->
                        <!-- <span class = "badge badge-warning"><h4><u>Voter ID Upload</u></h4></span><br>
                        <p><b> Hitting URL : </b>http://regtechapi.in/api/voter_upload</p>
                        <b>Request form-data : </b><br>
                        file – voter id image file<br>
                        <br>-
                        <b>Success Response :</b>
                        <br>
                        <p>
                        "{\"data\":  {\"client_id\":  \"ocr_voter_JJqCfxggzTMswegksvdp\",  \"ocr_fields\":  [{\"document_type
                        \":  \"voterid_front\",  \"full_name\":  {\"value\":  \"Rajesh\",  \"confidence\":  92.0},  \"age\":  {\" value\":  \"26\",  \"confidence\":  78.0},  \"care_of\":  {\"value\":  \"Saradaval\",  \"confidence\":  9 6.0},  \"dob\":  {\"value\":  \"1800-01-01\",  \"confidence\":  0.0},  \"doc\":  {\"value\":  \"2003-01- 01\",  \"confidence\":  95.0},  \"gender\":  {\"value\":  \"M\",  \"confidence\":  95.0},  \"epic_number\ ":  {\"value\":  \"MTG1947852\",  \"confidence\":  92.0}}]},  \"status_code\":  200,  \"success\":  true,
                        \"message\":  null,  \"message_code\":  \"success\"}\n"

                        </p> -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    



    <div class = "card">
        <div class = "card-header">
            <a class = "card-link" href = "#Voter" data-toggle="collapse">Voter ID APIs</a>
        </div>
        <div id = "Voter" class = "collapse" data-parent="#accordion">
            <div class = "card-body">
                <div class="row">
                    <div class = "col-md-4">
                        <span class = "badge badge-dark"><h3>Voter ID APIs</h3></span>
                    </div>
                    <div class = "col-md-6">
                        <span class = "badge badge-warning"><h4><u>Voter ID Verification</u></h4></span><br>
                        <p><b> Hitting URL : </b>http://regtechapi.in/api/voter_validation</p>
                        <b>Header : </b><br>
                        {<br>   
                        "AccessToken":"xxxxxxxxxxxxx"<br>
                        }<br>
                        <b>Request Body : </b><br>
                        {<br>   
                        "voter_number":""<br>
                        }<br>
                        <b>Success Response :</b><br>
                        {<br>
                        "data": {<br>
                        "relation_type": "F",<br>
                        "gender": "M",<br>
                        "age": "29",<br>
                        "epic_no": "NLN2089555",<br>
                        "client_id": "bkpkzGyssQ",<br>
                        "dob": "1990-08-31",<br>
                        "relation_name": "KALEEN BHAIYA",<br>
                        "name": "MUNNA BHAIYA",<br>
                        "area": "Mirzapur",<br>
                        "state": "Uttar Pradesh",<br>
                        "house_no": "Tripathi Haveli"<br>
                        },<br>
                        "status_code": 200,<br>
                        "message": "",<br>
                        "success": true<br>
                        }<br>

                

                    <!-- VOTER ID UPLOAD -->
                        <span class = "badge badge-warning"><h4><u>Voter ID Upload</u></h4></span><br>
                        <p><b> Hitting URL : </b>http://regtechapi.in/api/voter_upload</p>
                        <b>Request form-data : </b><br>
                        file – voter id image file<br>
                        <br>-
                        <b>Success Response :</b>
                        <br>
                        <p>
                        "{\"data\":  {\"client_id\":  \"ocr_voter_JJqCfxggzTMswegksvdp\",  \"ocr_fields\":  [{\"document_type
                        \":  \"voterid_front\",  \"full_name\":  {\"value\":  \"Rajesh\",  \"confidence\":  92.0},  \"age\":  {\" value\":  \"26\",  \"confidence\":  78.0},  \"care_of\":  {\"value\":  \"Saradaval\",  \"confidence\":  9 6.0},  \"dob\":  {\"value\":  \"1800-01-01\",  \"confidence\":  0.0},  \"doc\":  {\"value\":  \"2003-01- 01\",  \"confidence\":  95.0},  \"gender\":  {\"value\":  \"M\",  \"confidence\":  95.0},  \"epic_number\ ":  {\"value\":  \"MTG1947852\",  \"confidence\":  92.0}}]},  \"status_code\":  200,  \"success\":  true,
                        \"message\":  null,  \"message_code\":  \"success\"}\n"

                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--DL APIS-->
    <div class = "card">
        <div class = "card-header">
            <a class = "card-link" href = "#DL" data-toggle = "collapse">Driving License APIs</a>
        </div>
        <div id = "DL" class = "collapse" data-parent="#accordion">
            <div class = "card-body">
                <div class="row">
                  <div class = "col-md-4">
                    <span class = "badge badge-dark"><h3>Driving License APIs</h3></span>
                  </div>
                  <div class = "col-md-6">
                    <span class = "badge badge-warning"><h4><u>DL Verification</u></h4></span><br>
                    <p><b> Hitting URL : </b> http://regtechapi.in/api/license_validation</p>
                    <b>Header : </b><br>
                    {<br>   
                    "AccessToken":"xxxxxxxxxxxxx"<br>
                    }<br>
                    <b>Request Body : </b><br>
                    {<br>   
                    "license_number":"UP20 20150000000"<br>
                    "dob":"DD/MM/YYYY"<br>
                    }<br>
                    <b>Success Response : </b><br>
                        {<br>
                    "data": {<br>
                    "temporary_address": "TRIPATHI HAVELI, MIRZAPUR",<br>
                    "father_or_husband_name": "KALEEN BHAIYA",<br>
                    "doe": "2032-07-23",<br>
                    "temporary_zip": "231001",<br>
                    "permanent_address": "TRIPATHI HAVELI, MIRZAPUR",<br>
                    "doi": "2012-07-24",<br>
                    "client_id": "dIysSjHnIG",<br>
                    "citizenship": "IND",<br>
                    "dob": "1990-08-31",<br>
                    "permanent_zip": "231001",<br>
                    "gender": "Male",<br>
                    "license_number": "UP20 20150000000",<br>
                    "name": "MUNNA BHAIYA",<br>
                    "state": "UP",<br>
                    "ola_name": "DISTRICT TRANSPORT OFFICE, MIRZAPUR",<br>
                    "ola_code": "UP20"<br>
                    },<br>
                    "status_code": 200,<br>
                    "message": "",<br>
                    "success": true<br>
                    }<br>
                    


                    <!-- DL Upload -->
                    <span class = "badge badge-warning"><h4><u>DL Upload</u></h4></span><br>
                    <p><b> Hitting URL : </b>http://regtechapi.in/api/driving_upload</p>
                    <br>
                    <b>Header : </b><br>
                    {<br>   
                    "AccessToken":"xxxxxxxxxxxxx"<br>
                    }<br>
                    <b>Request form-data : </b><br>
                    front – driving license front image file<br>
                    back - driving license back image file<br>
                    <br>
                    <b>Success Response :</b>
                    <br>
                    <p>
                        "{\"data\":  {\"document_type\":  null,  \"license_number\":  {\"value\":  \"MH13  20100006214\",  \"con fidence\":  80.0},  \"dob\":  {\"value\":  \"1991-07-
                        04\",  \"confidence\":  90.0},  \"image_url\":  null},  \"status_code\":  200,  \"success\":  true,  \"mes sage\":  null,  \"message_code\":  \"success\"}\n"
                    </p>
                   </div>
                </div>
            </div>
        </div>
    </div>

    <!--RC APIS-->
    <div class = "card">
        <div class = "card-header">
            <a class = "card-link" href = "#RC" data-toggle = "collapse">RC APIs</a>
        </div>
        <div id = "RC" class = "collapse" data-parent = "#accordion">
            <div class = "card-body">
                <div class="row">
                  <div class = "col-md-4">
                    <span class = "badge badge-dark"><h3>RC APIs</h3></span>
                  </div>
                  <div class = "col-md-6">
                    <span class = "badge badge-warning"><h4><u>RC Verification</u></h4></span><br>
                    <p><b> Hitting URL : </b> http://regtechapi.in/api/rc_validation</p>
                    <b>Header : </b><br>
                    {<br>   
                    "AccessToken":"xxxxxxxxxxxxx"<br>
                    }<br>
                    <b>Request Body : </b><br>
                    {<br>   
                    "rc_number":"mh11at9556"<br>
                    }<br>
                    <p><b>Success Response : </b><br>
                        [<br>
                            
                        &nbsp;&nbsp;&nbsp;{<br>
                        &nbsp;&nbsp;&nbsp;"rc_validation": {<br> &nbsp;&nbsp;&nbsp;"data": {<br>
                        &nbsp;&nbsp;&nbsp;"client_id": "rc_szGFosDXfTUuoejqRwLt", <br>
                        &nbsp;&nbsp;&nbsp;"rc_number": "mh11at9556",<br>
                        &nbsp;&nbsp;&nbsp;"registration_date": "2010-03-22",<br>
                        &nbsp;&nbsp;&nbsp;"owner_name": "BHARAT BHALKE",<br>
                        &nbsp;&nbsp;&nbsp;"present_address": "",<br>
                        &nbsp;&nbsp;&nbsp;"permanent_address": "",<br>
                        &nbsp;&nbsp;&nbsp;"mobile_number": "",<br>
                        &nbsp;&nbsp;&nbsp;"vehicle_category": "",<br>
                        &nbsp;&nbsp;&nbsp;"vehicle_chasi_number": "ME121C021A20XXXXX",<br> 
                        &nbsp;&nbsp;&nbsp;"vehicle_engine_number": "21C20XXXXX",<br> 
                        &nbsp;&nbsp;&nbsp;"maker_description": "",<br>
                        &nbsp;&nbsp;&nbsp;"maker_model": "INDIA YAMAHA MOTOR PVT LTD / YAMAHA FZ S",
                        <br>
                        &nbsp;&nbsp;&nbsp;"body_type": "", <br>
                        &nbsp;&nbsp;&nbsp;"fuel_type": "PETROL",<br>
                        &nbsp;&nbsp;&nbsp;"color": "",<br>
                        &nbsp;&nbsp;&nbsp;"norms_type": "NOT AVAILABLE",<br>
                        &nbsp;&nbsp;&nbsp;"fit_up_to": "2025-03-21",<br>
                        &nbsp;&nbsp;&nbsp;"financer": "",<br>
                        &nbsp;&nbsp;&nbsp;"insurance_company": "",<br> 
                        &nbsp;&nbsp;&nbsp;"insurance_policy_number": "",<br>
                        &nbsp;&nbsp;&nbsp;"insurance_upto": "2020-10-04",<br> 
                        &nbsp;&nbsp;&nbsp;"manufacturing_date": "",<br>
                        &nbsp;&nbsp;&nbsp;"registered_at": "SATARA, MAHARASHTRA", "latest_by": null,<br>
                        &nbsp;&nbsp;&nbsp;"less_info": true, "tax_upto": "1800-01-01",<br> 
                        &nbsp;&nbsp;&nbsp;"cubic_capacity": null,<br>
                        &nbsp;&nbsp;&nbsp;"vehicle_gross_weight": null,<br>
                         
                        &nbsp;&nbsp;&nbsp;"no_cylinders": null,<br>
                        &nbsp;&nbsp;&nbsp;"seat_capacity": null,<br>
                        &nbsp;&nbsp;&nbsp;"sleeper_capacity": null,<br>
                        &nbsp;&nbsp;&nbsp;"standing_capacity": null,<br>
                        &nbsp;&nbsp;&nbsp;"wheelbase": null,<br> 
                        &nbsp;&nbsp;&nbsp;"unladen_weight": null,<br>
                        &nbsp;&nbsp;&nbsp;"vehicle_category_description": null,<br>
                        &nbsp;&nbsp;&nbsp;"pucc_number": null,<br>
                        &nbsp;&nbsp;&nbsp;"pucc_upto": null,<br>
                        &nbsp;&nbsp;&nbsp;"masked_name": false<br>
                        &nbsp;&nbsp;&nbsp;},<br>
                        &nbsp;&nbsp;&nbsp;"status_code": 200, "success": true, "message": null,<br>
                        &nbsp;&nbsp;&nbsp;"message_code": "success"<br>
                        &nbsp;&nbsp;&nbsp;},<br>
                        &nbsp;&nbsp;&nbsp;"statusCode": null<br>
                        &nbsp;&nbsp;&nbsp;}<br>
                        &nbsp;&nbsp;]<br>
                    </p>
                    <!-- <span class = "badge badge-warning"><h4><u>RC Full</u></h4></span><br>
                    <p><b> Hitting URL : </b> http://regtechapi.in/api/</p>
                    <b>Request Body : </b><br>
                    {<br>   
                    "rc_number":"mh11at9556"<br>
                    }<br>
                    <p><b>Success Response : </b><br>
                        [<br>
                            
                        &nbsp;&nbsp;&nbsp;{<br>
                        &nbsp;&nbsp;&nbsp;"rc_validation": {<br> &nbsp;&nbsp;&nbsp;"data": {<br>
                        &nbsp;&nbsp;&nbsp;"client_id": "rc_szGFosDXfTUuoejqRwLt", <br>
                        &nbsp;&nbsp;&nbsp;"rc_number": "mh11at9556",<br>
                        &nbsp;&nbsp;&nbsp;"registration_date": "2010-03-22",<br>
                        &nbsp;&nbsp;&nbsp;"owner_name": "BHARAT BHALKE",<br>
                        &nbsp;&nbsp;&nbsp;"present_address": "",<br>
                        &nbsp;&nbsp;&nbsp;"permanent_address": "",<br>
                        &nbsp;&nbsp;&nbsp;"mobile_number": "",<br>
                        &nbsp;&nbsp;&nbsp;"vehicle_category": "",<br>
                        &nbsp;&nbsp;&nbsp;"vehicle_chasi_number": "ME121C021A20XXXXX",<br> 
                        &nbsp;&nbsp;&nbsp;"vehicle_engine_number": "21C20XXXXX",<br> 
                        &nbsp;&nbsp;&nbsp;"maker_description": "",<br>
                        &nbsp;&nbsp;&nbsp;"maker_model": "INDIA YAMAHA MOTOR PVT LTD / YAMAHA FZ S",
                        <br>
                        &nbsp;&nbsp;&nbsp;"body_type": "", <br>
                        &nbsp;&nbsp;&nbsp;"fuel_type": "PETROL",<br>
                        &nbsp;&nbsp;&nbsp;"color": "",<br>
                        &nbsp;&nbsp;&nbsp;"norms_type": "NOT AVAILABLE",<br>
                        &nbsp;&nbsp;&nbsp;"fit_up_to": "2025-03-21",<br>
                        &nbsp;&nbsp;&nbsp;"financer": "",<br>
                        &nbsp;&nbsp;&nbsp;"insurance_company": "",<br> 
                        &nbsp;&nbsp;&nbsp;"insurance_policy_number": "",<br>
                        &nbsp;&nbsp;&nbsp;"insurance_upto": "2020-10-04",<br> 
                        &nbsp;&nbsp;&nbsp;"manufacturing_date": "",<br>
                        &nbsp;&nbsp;&nbsp;"registered_at": "SATARA, MAHARASHTRA", "latest_by": null,<br>
                        &nbsp;&nbsp;&nbsp;"less_info": true, "tax_upto": "1800-01-01",<br> 
                        &nbsp;&nbsp;&nbsp;"cubic_capacity": null,<br>
                        &nbsp;&nbsp;&nbsp;"vehicle_gross_weight": null,<br>
                        &nbsp;&nbsp;&nbsp;"Tag": "VC4",<br>
                        &nbsp;&nbsp;&nbsp;"no_cylinders": null,<br>
                        &nbsp;&nbsp;&nbsp;"seat_capacity": null,<br>
                        &nbsp;&nbsp;&nbsp;"sleeper_capacity": null,<br>
                        &nbsp;&nbsp;&nbsp;"standing_capacity": null,<br>
                        &nbsp;&nbsp;&nbsp;"wheelbase": null,<br> 
                        &nbsp;&nbsp;&nbsp;"unladen_weight": null,<br>
                        &nbsp;&nbsp;&nbsp;"vehicle_category_description": null,<br>
                        &nbsp;&nbsp;&nbsp;"pucc_number": null,<br>
                        &nbsp;&nbsp;&nbsp;"pucc_upto": null,<br>
                        &nbsp;&nbsp;&nbsp;"masked_name": false<br>
                        &nbsp;&nbsp;&nbsp;},<br>
                        &nbsp;&nbsp;&nbsp;"status_code": 200, "success": true, "message": null,<br>
                        &nbsp;&nbsp;&nbsp;"message_code": "success"<br>
                        &nbsp;&nbsp;&nbsp;},<br>
                        &nbsp;&nbsp;&nbsp;"statusCode": null<br>
                        &nbsp;&nbsp;&nbsp;}<br>
                        &nbsp;&nbsp;]<br>
                    </p> -->
                  </div>
                </div>
            </div>
        </div>
    </div>


    <!--CORPORATE APIS-->
    <div class = "card">
        <div class = "card-header">
            <a class = "card-link" href = "#CIN" data-toggle = "collapse">CIN APIs</a>
        </div>

        <div id = "CIN" class = "collapse" data-parent = "#accordion">
        <div class = "card-body">
            <div class="row">
              <div class = "col-md-4">
                <span class = "badge badge-dark"><h3>Corporate CIN APIs</h3></span>
              </div>
              <div class = "col-md-6">
                <span class = "badge badge-warning"><h4><u>CIN</u></h4></span><br>
                <p><b> Hitting URL : </b> http://regtechapi.in/api/corporate_cin</p>
                <b>Header : </b><br>
                {<br>   
                "AccessToken":"xxxxxxxxxxxxx"<br>
                }<br>
                <b>Request Body : </b><br>
                {<br>   
                "corporate_cin":"U72900PN2018PTC180125"<br>
                }<br>
                <p><b>Success Response : </b><br>
                    [<br>
                        
                    &nbsp;&nbsp;&nbsp;{<br>
                    &nbsp;&nbsp;&nbsp;"corporate_cin": {<br> 
                    &nbsp;&nbsp;&nbsp;"data": {<br>
                    &nbsp;&nbsp;&nbsp;"client_id": "corporate_cin_wdDJojPsekbnkswTGxYk", <br>
                    &nbsp;&nbsp;&nbsp;"cin_number": "U72900PN2018PTC180125",<br>
                    &nbsp;&nbsp;&nbsp;"company_name": "ZAPFIN TEKNOLOGIES PRIVATE LIMITED",<br>
                    &nbsp;&nbsp;&nbsp;"incorporation_date": "2018-11-09",<br>
                    &nbsp;&nbsp;&nbsp;"phone_number": "+918470067555",<br>
                    &nbsp;&nbsp;&nbsp;"company_address": "11B, Aditya Business Center$SN-1A,Kondhwa,                &nbsp;&nbsp;&nbsp;&nbsp;Khurd$PUNE$Pune$Maharashtra$411048$India$",<br>    
                    &nbsp;&nbsp;&nbsp;"email": "ashokonly@gmail.com",<br>
                    &nbsp;&nbsp;&nbsp;"company_class": "PRIV",<br>
                    &nbsp;&nbsp;&nbsp;"zip": "411048",<br>
                    &nbsp;&nbsp;&nbsp;"directors": [<br>
                    &nbsp;&nbsp;&nbsp;&nbsp;{<br>
                    &nbsp;&nbsp;&nbsp;&nbsp;"din_number": "00517254",<br>
                    &nbsp;&nbsp;&nbsp;&nbsp;"director_name": "ASHOK KUMAR"<br>
                    &nbsp;&nbsp;&nbsp;&nbsp;},<br>
                    &nbsp;&nbsp;&nbsp;&nbsp;{<br>
                    &nbsp;&nbsp;&nbsp;&nbsp;"din_number": "08862561",<br> 
                    &nbsp;&nbsp;&nbsp;&nbsp;"director_name": "PRASHANT KUMAR"<br>
                    &nbsp;&nbsp;&nbsp;&nbsp;}<br>
                    ],<br>
                    "authorized_capital": "2500000",<br>
                    "paid_up_capital": "1628370",<br>
                    "last_agm_date": "2019-09-30",<br>
                    "last_bs_date": "2019-03-31", <br>"company_status": "Active", <br>"listed_status": "Unlisted"<br>
                    },<br>
                    "status_code": 200,<br> "success": true,<br> "message": null,<br>
                    "message_code": "success"<br>
                    },<br>
                    "statusCode": null<br>

                    &nbsp;&nbsp;&nbsp;}<br>
                    ]<br>
                    </p>                
                </div>
                </div>
            </div>
        </div>
    </div>


    <div class = "card">
        <div class = "card-header">
            <a class = "card-link" href = "#DIN" data-toggle = "collapse">DIN APIs</a>
        </div>
        <div id = "DIN" class = "collapse" data-parent = "#accordion">
            <div class = "card-body">
                <div class="row">
                    <div class = "col-md-4">
                        <span class = "badge badge-dark"><h3>Corporate DIN APIs</h3></span>
                    </div>
                    <div class = "col-md-6">
                        <span class = "badge badge-warning"><h4><u>DIN</u></h4></span><br>
                        <p><b> Hitting URL : </b> http://regtechapi.in/api/corporate_din</p>
                        <b>Request Method : POST</b><br>
                        <b>Header : </b><br>
                        {<br>   
                        "AccessToken":"xxxxxxxxxxxxx"<br>
                        }<br>
                        <b>Request Body : </b><br>
                        {<br>   
                        "id_number":"@{{din_number}}"<br>
                        }<br>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class = "card">
        <div class = "card-header">
            <a class = "card-link" href = "#GSTIN" data-toggle = "collapse">GSTIN APIs</a>
        </div>
        <div id = "GSTIN" class = "collapse" data-parent = "#accordion">
            <div class = "card-body">
                <div class="row">
                    <div class = "col-md-4">
                        <span class = "badge badge-dark"><h3>Corporate GSTIN APIs</h3></span>
                    </div>
                    <div class = "col-md-6">
                        <span class = "badge badge-warning"><h4><u>GSTIN</u></h4></span><br>
                        <p><b> Hitting URL : </b> http://regtechapi.in/corporate_gstin</p>
                        <!-- <b>Request Method : POST</b><br> -->
                        <b>Header : </b><br>
                        {<br>   
                        "AccessToken":"xxxxxxxxxxxxx"<br>
                        }<br>
                        <b>Request Body : </b><br>
                        {<br>   
                        "corporate_gstin":"27AABCZ2858B1ZC"<br>
                        }<br>
                        <b>Success Response : </b><br>
                        [
                            {
                                "corporate_gstin": { 
                                "code": "200",
                                "status": "success",  
                                "response": {
                                    "gstin": "{{@gstin_number}}",
                                    "legal_name": "{{@legal_name}}",
                                    "jurisdiction": "{{@jurisdiction}}", "reg_date": "{{@reg_date}}",
                                    "taxpayer_type": "{{@taxpayer_type}}",
                                    "status": "{{@status}}",
                                    "address": "{{@address}}",
                                    "business_type": "{{@business_type}}",
                                    "nature" : "{{@nature}}",
                                    "last_update": "{{@last_update}}",
                                    "state_code": "{{@state_code}}"
                                },
                            
                            }
                            "statusCode": "200"
                        }
                        ]
                    </div>               
                </div>
            </div>
        </div>
    </div>

    <div class = "card">
        <div class = "card-header">
            <a class = "card-link" href = "#GSTINCONF" data-toggle = "collapse">GSTIN With Confidence APIs</a>
        </div>
        <div id = "GSTINCONF" class = "collapse" data-parent = "#accordion">
            <div class = "card-body">
                <div class="row">
                    <div class = "col-md-4">
                        <span class = "badge badge-dark"><h3>GSTIN With Confidence APIs</h3></span>
                    </div>
                    <div class = "col-md-6">
                        <span class = "badge badge-warning"><h4><u>GSTIN With Confidence</u></h4></span><br>
                        <p><b> Hitting URL : </b> http://regtechapi.in/api/gstin_pan_confidence</p>
                        <!-- <b>Request Method : POST</b><br> -->
                        <b>Header : </b><br>
                        {<br>   
                        "AccessToken":"xxxxxxxxxxxxx"<br>
                        }<br>
                        <b>Request Body : </b><br>
                        {<br>   
                            "corporate_gstin":"{{@gstin_number}}",<br>
                            "name":"{{@name}}",<br>
                            "mobile_number":"{{@mobile_number}}",<br>
                            "address":"{{@address}}",<br>
                            "state":"{{@state}}",<br>
                            "city":"{{@city}}",<br>
                            "pincode":"{{@pincode}}",<br>
                        }<br>
                        <b>Success Response : </b><br>
                        [
                            {
                                "corporate_gstin": { 
                                "code": "200",
                                "status": "success",  
                                "response": {
                                    "gstin": "{{@gstin_number}}",
                                    "legal_name": "{{@legal_name}}",
                                    "jurisdiction": "{{@jurisdiction}}", "reg_date": "{{@reg_date}}",
                                    "taxpayer_type": "{{@taxpayer_type}}",
                                    "status": "{{@status}}",
                                    "address": "{{@address}}",
                                    "business_type": "{{@business_type}}",
                                    "nature" : "{{@nature}}",
                                    "last_update": "{{@last_update}}",
                                    "state_code": "{{@state_code}}"
                                },                            
                            }
                            "confidence": "100%",
                            "statusCode": "200"
                        }
                        ]
                    </div>               
                </div>
            </div>
        </div>
    </div>


    <div class = "card">
        <div class = "card-header">
            <a class = "card-link" href = "#passport" data-toggle = "collapse">Passport APIs</a>
        </div>
        <div id = "passport" class = "collapse" data-parent = "#accordion">
            <div class = "card-body">
                <div class="row">
                    <div class = "col-md-4">
                        <span class = "badge badge-dark"><h3>Passport APIs</h3></span>
                    </div>
                    <div class = "col-md-6">
                        <!-- <span class = "badge badge-warning"><h4><u>Passport Create Client</u></h4></span><br>
                        <p><b> Hitting URL : </b>http://regtechapi.in/api/</p>
                        <b>Request Method : POST </b><br>
                        <p><b>Success Response : </b><br>
                        &nbsp;&nbsp;{<br>
                        &nbsp;&nbsp;"data": {<br>
                        &nbsp;&nbsp;"client_id": "takdTqhCxo"<br>
                        &nbsp;&nbsp;},<br>
                        &nbsp;&nbsp;"status_code": 201,<br>
                        &nbsp;&nbsp;"message": "",<br>
                        &nbsp;&nbsp;"success": true<br>
                        &nbsp;&nbsp;}    <br>         
                        </p> -->


                        <span class = "badge badge-warning"><h4><u>Passport Upload</u></h4></span><br>
                        <p><b> Hitting URL : </b> http://regtechapi.in/api/passport_upload</p>
                        <b>Request Method : POST </b><br>
                        <b>Header : </b><br>
                        {<br>   
                        "AccessToken":"xxxxxxxxxxxxx"<br>
                        }<br>
                        <b>Request Body : </b><br>
                        {<br>   
                        file – passport image file,<br>
                        }<br>
                        <b>Success Response : </b>
                        <p>
                        {<br>
                        "data": {<br>
                        "doe": "2020-09-15",<br>
                        "dob": "1990-08-31",<br>
                        "father": "KALEEN BHAIYA",<br>
                        "given_name": "MUNNA BHAIYA",<br>
                        "mrz_line_1": "PPINDBHAIYA&lt;&lt;MUNNA&lt;&lt;&lt;&lt;&lt;&lt;&lt;&lt;&lt;&lt;&lt;&lt;&lt;&lt;&lt;&lt;&lt;&lt;&lt;&lt;&lt;&lt;&lt;&lt;&lt;&lt;&lt;",<br>
                        "old_passport_num": "F0233736",<br>
                        "file_num": "UPHM00597710",<br>
                        "client_id": "TTJmMxbZQi",<br>
                        "place_of_issue": "MIRZAPUR",<br>
                        "spouse": "",<br>
                        "country_code": "IND",<br>
                        "address": "TRIPATHI HAVELI, MIRZAPUR",<br>
                        "surname": "BAGGA",<br>
                        "mrz_line_2": "J0933933<1IND9008319M2009155<<<<<<<<<<<<<<04",<br>
                        "passport_num": "J0933836",<br>
                        "doi": "2010-10-15",<br>
                        "old_doi": "2005-10-15",<br>
                        "gender": "MALE",<br>
                        "nationality": "INDIAN",<br>
                        "place_of_birth": " MIRZAPUR",<br>
                        "mother": "BEENA TRIPATHI",<br>
                        "old_place_of_issue": "MIRZAPUR",<br>
                        "pin": "231001",<br>
                        "verified": null<br>
                        },<br>
                        "status_code": 200,<br>
                        "message": "",<br>
                        "success": true<br>
                        }<br></p>
                 
                        <!-- <span class = "badge badge-warning"><h4><u>Verify Passport</u></h4></span><br>
                        <p><b> Hitting URL : </b> http://regtechapi.in/api/passport_verification</p>
                        <b>Request Method : POST </b><br>
                        {<br>   
                        "client_id": "@{{client_id}}",<br>
                        }<br>
                        
                        <p><b>Success Response : </b><br>
                         {<br>
                        "data": {<br>
                        "doe": "2020-09-15",<br>
                        "dob": "1990-08-31",<br>
                        "father": "KALEEN BHAIYA",<br>
                        "given_name": "MUNNA BHAIYA",<br>
                        "mrz_line_1": "PPINDBHAIYA&lt;&lt;MUNNA&lt;&lt;&lt;&lt;&lt;&lt;&lt;&lt;&lt;&lt;&lt;&lt;&lt;&lt;&lt;&lt;&lt;&lt;&lt;&lt;&lt;&lt;&lt;&lt;&lt;&lt;&lt;",<br>
                        "old_passport_num": "F0233736",<br>
                        "file_num": "UPHM00597710",<br>
                        "client_id": "TTJmMxbZQi",<br>
                        "place_of_issue": "MIRZAPUR",<br>
                        "spouse": "",<br>
                        "country_code": "IND",<br>
                        "address": "TRIPATHI HAVELI, MIRZAPUR",<br>
                        "surname": "BAGGA",<br>
                        "mrz_line_2": "J0933933<1IND9008319M2009155<<<<<<<<<<<<<<04",<br>
                        "passport_num": "J0933836",<br>
                        "doi": "2010-10-15",<br>
                        "old_doi": "2005-10-15",<br>
                        "gender": "MALE",<br>
                        "nationality": "INDIAN",<br>
                        "place_of_birth": " MIRZAPUR",<br>
                        "mother": "BEENA TRIPATHI",<br>
                        "old_place_of_issue": "MIRZAPUR",<br>
                        "pin": "231001",<br>
                        "passport_validity": true<br>
                            },<br>
                            "status_code": 200,<br>
                            "message": "Passport Verified.",<br>
                            "success": true<br>
                        }       
                        </p> -->

                        <span class = "badge badge-warning"><h4><u>Passport Verification</u></h4></span><br>
                        <p><b> Hitting URL : </b> http://regtechapi.in/api/passport_verification</p>
                        <b>Request Method : POST </b><br>
                        <b>Header : </b><br>
                        {<br>   
                        "AccessToken":"xxxxxxxxxxxxx"<br>
                        }<br>
                        {<br>   
                        "id_number": "PN1067476812641",<br>
                        "dob": "1991-07-04",<br>
                        }<br>
                        
                        <p><b>Success Response : </b><br>
                        {<br>
                        "data": {<br>
                        "client_id": "passport_ZsjzNvqEbyFoehLmDgne",<br>
                        "passport_number": "L8060347",<br>
                        "full_name": "DOMINIC D'COSTA ANTHONY",<br>
                        "dob": "1991-07-04",<br>
                        "date_of_application": "2014-01-04",<br>
                        "file_number": "PN1067476812641"<br>
                    },<br>
                    "status_code": 200,<br>
                    "success": true,<br>
                    "message": null,<br>
                    "message_code": "success"<br>
                    }<br>
                   </div>               
                </div>     
            </div>   
        </div>
    </div>

    <div class = "card">
        <div class = "card-header">
            <a class = "card-link" href = "#credit" data-toggle = "collapse">Credit Report API</a>
        </div>
        <div class = "collapse" id = "credit" data-parent = "#accordion">
            <div class = "card-body">
                <div class="row">
                      <div class = "col-md-4">
                        <span class = "badge badge-dark"><h3>Credit Report APIs</h3></span>
                      </div>
                      <div class = "col-md-6">
                        <span class = "badge badge-warning"><h4><u>Credit Report 1 - CRIF</u></h4></span><br>
                        <p><b> Hitting URL : </b> http://regtechapi.in/api/crif</p>
                        <b>Request Method : POST </b><br>
                        <b>Header : </b><br>
                        {<br>   
                        "AccessToken":"xxxxxxxxxxxxx"<br>
                        }<br>
                        <b>Request Body : </b><br>
                        {<br>   
                        "fullname":""<br>
                        "pancard_no":""<br>
                        "otp":""<br>
                        "phone":""<br>
                        "dob":""<br>
                        }<br>

                        <p><b>Success Response : </b><br>
                            {<br>
                            "status": "success",<br>
                            "unique_id": "EXT17012464996663408657403",<br>
                            "data": {<br>
                            "request_meta": {<br>
                            "gender": "male",<br>
                            "dob": "XXXX-XX-XX",<br>
                            "pan_card": "XXXXXXXXXX",<br>
                            "mobile_number": "XXXXXXXXXX",<br>
                            "full_name": "XXXXX XXX",<br>
                            "home": {<br>
                                "zipcode": "175024",<br>
                                "address": {<br>
                                    "line2": "Address line 2",<br>
                                    "line1": "Address line 1"<br>
                                },<br>
                                "city": "hyderabad"<br>
                                },<br>
                            "allowed_for_awesomeui": "yes"<br>
                            },<br>
                            "crif_report_id": "",<br>
                            "file": {<br>
                            "response_xml": "",<br>
                            "html_report": ""<br>
                            },<br>
                            "credit_account": {<br>
                            "enquiry": "",<br>
                            "account": ""<br>
                            }<br>
                        }<br>
                        }<br>
                        </p>  

                        <span class = "badge badge-warning"><h4><u>Credit Report 2 - Equifax</u></h4></span><br>
                        <p><b> Hitting URL : </b> http://regtechapi.in/api/equifax</p>
                        <b>Request Method : POST </b><br>
                        <b>Header : </b><br>
                        {<br>   
                        "AccessToken":"xxxxxxxxxxxxx"<br>
                        }<br>
                        <b>Request Body : </b><br>
                        {<br>   
                        "FirstName":""<br>
                        "LastName":""<br>
                        "ContactNo":""<br>
                        "IDValue":""<br>
                        }<br>

                        <p><b>Success Response : </b><br>
                        {<br>
                            "Equifax_Report":{<br>
                                "InquiryResponseHeader": {<br>
                                    "ClientID": "@{{ClientID}}",<br>
                                    "CustRefField": "@{{CustRefField}}",<br>
                                    "ReportOrderNO": "@{{ReportOrderNO}}",<br>
                                    "ProductCode": [<br>
                                        "@{{ProductCode}}"<br>
                                    ],<br>
                                    "SuccessCode": "1",<br>
                                    "Date": "@{{Date}}",<br>
                                    "Time": "@{{Time}}"<br> 
                                }<br>
                                "InquiryRequestInfo": {<br>
                                    "InquiryPurpose": "00",<br>
                                    "FirstName": "@{{FirstName}}",<br>
                                    "InquiryPhones": [<br>
                                        {<br>
                                            "seq": "1",<br>
                                            "PhoneType": [<br>
                                                "M"<br>
                                            ],<br>
                                            "Number": "@{{Number}}"<br>
                                        }<br>
                                    ],<br>
                                    "IDDetails": [<br>
                                        {<br>
                                            "seq": "1",<br>
                                            "IDType": "T",<br>
                                            "IDValue": "@{{IDValue}}",<br>
                                            "Source": "@{{Source}}"<br>
                                        }<br>
                                    ]<br>
                                },<br>
                                "Score": [<br>
                                    {<br>
                                        "Type": "ERS",<br>
                                        "Version": "3.1"<br>
                                    }<br>
                                ],<br>
                                "CCRResponse": {<br>
                                    "Status": "1",<br>
                                    "CIRReportDataLst": [<br>
                                        {<br>
                                            "InquiryResponseHeader": {<br>
                                                "CustomerCode": "@{{CustomerCode}}",<br>
                                                "CustRefField": "@{{CustRefField}}",<br>
                                                "ReportOrderNO": "@{{ReportOrderNO}}",<br>
                                                "ProductCode": [<br>
                                                    "@{{ProductCode}}"<br>
                                                ],<br>
                                                "SuccessCode": "1",<br>
                                                "Date": "@{{Date}}",<br>
                                                "Time": "@{{Time}}",<br>
                                                "HitCode": "@{{HitCode}}",<br>
                                                "CustomerName": "@{{CustomerName}}"<br>
                                            },<br>
                                            "InquiryRequestInfo": {<br>
                                                "InquiryPurpose": "@{{InquiryPurpose}}",<br>
                                                "FirstName": "@{{FirstName}}",<br>
                                                "InquiryPhones": [<br>
                                                    {<br>
                                                        "seq": "1",<br>
                                                        "PhoneType": [<br>
                                                            "M"<br>
                                                        ],<br>
                                                        "Number": "@{{Number}}"<br>
                                                    }<br>
                                                ],<br>
                                                "IDDetails": [<br>
                                                    {<br>
                                                        "seq": "1",<br>
                                                        "IDType": "T",<br>
                                                        "IDValue": "@{{IDValue}}",<br>
                                                        "Source": "@{{Source}}"<br>
                                                    }<br>
                                                ],<br>
                                                "CustomFields": [<br>
                                                    {
                                                        "key": "@{{key}}",<br>
                                                        "value": "@{{value}}"<br>
                                                    }<br>
                                                ]<br>
                                            },<br>
                                            "Score": [<br>
                                                {<br>
                                                    "Type": "ERS",<br>
                                                    "Version": "3.1"<br>
                                                }<br>
                                            ],<br>
                                            "CIRReportData": {<br>
                                                "IDAndContactInfo": {<br>
                                                    "PersonalInfo": {<br>
                                                        "Name": {<br>
                                                            "FullName": "@{{FullName}}"<br>
                                                        },<br>
                                                        " AliasName": {},<br>
                                                        "DateOfBirth": "@{{DateOfBirth}}",<br>
                                                        "Gender": "@{{Gender}}",<br>
                                                        "Age": {<br>
                                                            "Age": "@{{Age}}"<br>
                                                        },<br>
                                                        "PlaceOfBirthInfo": {}<br>
                                                    },<br>
                                                    "IdentityInfo": {<br>
                                                        "PANId": [<br>
                                                            {<br>
                                                                "seq": "1",<br>
                                                                "ReportedDate": "@{{ReportedDate}}",<br>
                                                                "IdNumber": "@{{IdNumber}}"<br>
                                                            }<br>
                                                        ],<br>
                                                        "VoterID": [<br>
                                                            {<br>
                                                                "seq": "1",<br>
                                                                "ReportedDate": "@{{ReportedDate}}",<br>
                                                                "IdNumber": "@{{IdNumber}}"<br>
                                                            }<br>
                                                        ],<br>
                                                        "NationalIDCard": [<br>
                                                            {<br>
                                                                "seq": "1",<br>
                                                                "ReportedDate": "@{{ReportedDate}}",<br>
                                                                "IdNumber": "@{{IdNumber}}"<br>
                                                            }<br>
                                                        ]<br>
                                                    },<br>
                                                    "AddressInfo": [<br>
                                                        {<br>
                                                            "Seq": "1",<br>
                                                            "ReportedDate": "@{{ReportedDate}}",<br>
                                                            "Address": "@{{Address}}",<br>
                                                            "State": "@{{State}}",<br>
                                                            "Postal": "@{{Postal}}"<br>
                                                        }<br>
                                                    ],<br>
                                                    "PhoneInfo": [<br>
                                                        {<br>
                                                            "seq": "1",<br>
                                                            "typeCode": "M",<br>
                                                            "ReportedDate": "@{{ReportedDate}}",<br>
                                                            "Number": "@{{Number}}"<br>
                                                        }<br>
                                                    ]<br>
                                                },<br>
                                                "RetailAccountDetails": [<br>
                                                    {<br>
                                                        "seq": "1",<br>
                                                        "AccountNumber": "@{{AccountNumber}}",<br>
                                                        "Institution": "@{{Institution}}",<br>
                                                        "AccountType": "@{{AccountType}}",<br>
                                                        "OwnershipType": "@{{OwnershipType}}",<br>
                                                        "Balance": "@{{Balance}}",<br>
                                                        "PastDueAmount": "@{{PastDueAmount}}",<br>
                                                        "Open": "Yes",<br>
                                                        "SanctionAmount": "@{{SanctionAmount}}",<br>
                                                        "DateReported": "@{{DateReported}}",<br>
                                                        "DateOpened": "@{{DateOpened}}",<br>
                                                        "InterestRate": "@{{InterestRate}}",<br>
                                                        "CollateralValue": "@{{CollateralValue}}",<br>
                                                        "AccountStatus": "@{{AccountStatus}}",<br>
                                                        "AssetClassification": "@{{AssetClassification}}",<br>
                                                        "source": "@{{source}}",<br>
                                                        "History48Months": [<br>
                                                            {<br>
                                                                "key": "@{{key}}",<br>
                                                                "PaymentStatus": "NEW",
                                                                "SuitFiledStatus": "*",
                                                                "AssetClassificationStatus": "@{{AssetClassificationStatus}}"<br>
                                                            }<br>
                                                        ]<br>
                                                    }<br>
                                                ],<br>
                                                "RetailAccountsSummary": {<br>
                                                    "NoOfAccounts": "2",<br>
                                                    "NoOfActiveAccounts": "1",<br>
                                                    "NoOfWriteOffs": "0",<br>
                                                    "TotalPastDue": "0.00",<br>
                                                    "SingleHighestCredit": "0.00",<br>
                                                    "SingleHighestSanctionAmount": "@{{SingleHighestSanctionAmount}}",<br>
                                                    "TotalHighCredit": "0.00",<br>
                                                    "AverageOpenBalance": "@{{AverageOpenBalance}}",<br>
                                                    "SingleHighestBalance": "@{{SingleHighestBalance}}",<br>
                                                    "NoOfPastDueAccounts": "@{{NoOfPastDueAccounts}}",<br>
                                                    "NoOfZeroBalanceAccounts": "@{{NoOfZeroBalanceAccounts}}",<br>
                                                    "RecentAccount": "@{{RecentAccount}}",<br>
                                                    "OldestAccount": "@{{OldestAccount}}",<br>
                                                    "TotalBalanceAmount": "@{{TotalBalanceAmount}}",<br>
                                                    "TotalSanctionAmount": "TotalSanctionAmount",<br>
                                                    "TotalCreditLimit": "@{{TotalCreditLimit}}",<br>
                                                    "TotalMonthlyPaymentAmount": "@{{TotalMonthlyPaymentAmount}}"<br>
                                                },<br>
                                                "ScoreDetails": [<br>
                                                    {<br>
                                                        "Type": "ERS",<br>
                                                        "Version": "3.1",<br>
                                                        "Name": "@{{Name}}",<br>
                                                        "Value": "@{{Value}}",<br>
                                                        "ScoringElements": [<br>
                                                            {<br>
                                                                "type": "RES",<br>
                                                                "seq": "1",<br>
                                                                "Description": "@{{Description}}"<br>
                                                            }<br>
                                                        ]<br>
                                                    }<br>
                                                ],<br>
                                                "Enquiries": [<br>
                                                    {<br>
                                                        "seq": "0",<br>
                                                        "Institution": "@{{Institution}}",<br>
                                                        "Date": "@{{Date}}",<br>
                                                        "Time": "@{{Time}}",<br>
                                                        "RequestPurpose": "@{{RequestPurpose}}",<br>
                                                        "Amount": "@{{Amount}}"<br>
                                                    }<br>
                                                ],<br>
                                                "EnquirySummary": {<br>
                                                    "Purpose": "@{{Purpose}}",<br>
                                                    "Total": "@{{Total}}",<br>
                                                    "Past30Days": "@{{Past30Days}}",<br>
                                                    "Past12Months": "@{{Past12Months}}",<br>
                                                    "Past24Months": "@{{Past24Months}}",<br>
                                                    "Recent": "@{{Recent}}"<br>
                                                },<br>
                                                "OtherKeyInd": {<br>
                                                    "AgeOfOldestTrade": "@{{AgeOfOldestTrade}}",<br>
                                                    "NumberOfOpenTrades": "0",<br>
                                                    "AllLinesEVERWritten": "0.00",<br>
                                                    "AllLinesEVERWrittenIn9Months": "0",<br>
                                                    "AllLinesEVERWrittenIn6Months": "0"<br>
                                                },<br>
                                                "RecentActivities": {<br>
                                                    "AccountsDeliquent": "0",<br>
                                                    "AccountsOpened": "0",<br>
                                                    "TotalInquiries": "7",<br>
                                                    "AccountsUpdated": "0"<br>
                                                }<br>
                                            }<br>
                                        }<br>
                                    ]<br>
                                }<br>
                            },<br>
                            "statusCode": "200"<br>
                        }<br>
                        </p>  
                        
                        <span class = "badge badge-warning"><h4><u>Generate OTP</u></h4></span><br>
                        <p><b> Hitting URL : </b> http://regtechapi.in/api/generate-otp</p>
                        <b>Request Method : POST </b><br>
                        <b>Header : </b><br>
                        {<br>   
                        "AccessToken":"xxxxxxxxxxxxx"<br>
                        }<br>
                        <b>Request Body : </b><br>
                        {<br>   
                        "phone": @{{phone}}<br>
                        }<br>
                        <p><b>Success Response : </b><br>
                            
                        &nbsp;&nbsp;{<br>
                        &nbsp;&nbsp;"data": { <br>
                        &nbsp;&nbsp;"client_id": @{{client_id}},<br>
                        &nbsp;&nbsp;"operator": @{{operator}},<br>
                        &nbsp;&nbsp;"otp_sent": "true"<br>
                        &nbsp;&nbsp;"if_number": "true"<br>
                        &nbsp;&nbsp;},<br>
                        &nbsp;&nbsp;"status_code": 200,<br> 
                        &nbsp;&nbsp;"message_code": success,<br> 
                        &nbsp;&nbsp;"message": "OTP generated",<br>
                        &nbsp;&nbsp;"success": "true"<br>
                        &nbsp;&nbsp;}<br>
                        </p>

                      </div>
                </div>
            </div>
        </div>
    </div>

     <!--Udyam APIS-->
     <div class = "card">
        <div class = "card-header">
            <a class = "card-link" href = "#udyam" data-toggle = "collapse">Udyam </a>
        </div>
        <div id = "udyam" class = "collapse" data-parent="#accordion">
            <div class = "card-body">
                <div class="row">
                  <div class = "col-md-4">
                    <span class = "badge badge-dark"><h3>Udyam Registration Details</h3></span>
                  </div>
                  <div class = "col-md-6">
                  <span class = "badge badge-warning"><h4><u>Udyam Search</u></h4></span><br>
        <p><b> Hitting URL : </b> http://regtechapi.in/api/udyamsearch</p>
        <b>Header : </b><br>
        {<br>   
        "AccessToken":"xxxxxxxxxxxxx"<br>
        }<br>
        <b>Request Body : </b><br>
        {<br>   
        "udyamNumber":"UDYAM-MH-26-01944567"<br>
        }<br>

        <p><b>Success Response : </b><br>
            [<br>
                &nbsp;&nbsp;{<br>
                    "status_code":200<br>
                &nbsp;&nbsp;"response":  {<br>
                &nbsp;&nbsp;"essentials": {<br>
                &nbsp;&nbsp;"udyamNumber":"UDYAM-MH-26-01944567"<br>
                &nbsp;&nbsp;&nbsp;&nbsp;}<br>
                &nbsp;&nbsp;"essentials": {<br>
                &nbsp;&nbsp;"result": {
            "generalInfo": {
                "udyamRegistrationNumber": "UDYAM-MH-26-0194830",
                "nameOfEnterprise": "M/S ZAPFIN TEKNOLOGIES PRIVATE LIMITED",
                "majorActivity": "TRADING[For availing benefits of Priority Sector Lending(PSL) ONLY]",
                "organisationType": "Private Limited Company",
                "socialCategory": "General",
                "dateOfIncorporation": "09/11/2018",
                "dateOfCommencementOfProductionBusiness": "09/11/2018",
                "dic": "PUNE",
                "msmedi": "MUMBAI",
                "dateOfUdyamRegistration": "14/12/2021",
                "typeOfEnterprise": "Micro"
            },
            "enterpriseType": [
                {
                    "dataYear": "2021-22",
                    "classificationYear": "2023-24",
                    "enterpriseType": "Micro",
                    "classificationDate": "09/05/2023"
                },
                {
                    "dataYear": "2020-21",
                    "classificationYear": "2022-23",
                    "enterpriseType": "Micro",
                    "classificationDate": "26/06/2022"
                },
                {
                    "dataYear": "2019-20",
                    "classificationYear": "2021-22",
                    "enterpriseType": "Micro",
                    "classificationDate": "14/12/2021"
                }
            ],
            "unitsDetails": [],
            "officialAddressOfEnterprise": {
                "flatDoorBlockNo": "105",
                "nameOfPremisesBuilding": "Hermes wave Central Avenue Road",
                "villageTown": "Kalyani Nagar",
                "block": "Kalyani Nagar",
                "roadStreetLane": "Kalyani Nagar Pune",
                "city": "pune",
                "state": "MAHARASHTRA",
                "pin": "411014",
                "district": "PUNE,",
                "mobile": "84*****555",
                "email": "ashokonly@gmail.com"
            },
            "nationalIndustryClassificationCodes": [
                {
                    "nic2Digit": "66 - Other financial activities",
                    "nic4Digit": "6619 - Activities auxiliary to financial service activities n.e.c.",
                    "nic5Digit": "66190 - Activities auxiliary to financial service activities n.e.c.",
                    "activity": "Services",
                    "date": "14/12/2021"
                }
            ],
            "pdfUrl": "https://persist.signzy.tech/api/files/565734329/download/d4f351fcab044ccd9c233d948eef392e106ecab1653a45faa1c5a249cad18eb9.pdf"
        }"<br>
                &nbsp;&nbsp;&nbsp;&nbsp;}<br>
              



                &nbsp;&nbsp;}<br>
            ]<br>
        </p>
                    


                   
                   </div>
                </div>
            </div>
        </div>
    </div>

     <!--Udyog APIS-->
     <div class = "card">
        <div class = "card-header">
            <a class = "card-link" href = "#udyog" data-toggle = "collapse">Udyog Aadhaar</a>
        </div>
        <div id = "udyog" class = "collapse" data-parent="#accordion">
            <div class = "card-body">
                <div class="row">
                  <div class = "col-md-4">
                    <span class = "badge badge-dark"><h3>Udhyog Aadhar APIs</h3></span>
                  </div>
                  <div class = "col-md-6">
                  <span class = "badge badge-warning"><h4><u>Udhyog Aadhar</u></h4></span><br>
        <p><b> Hitting URL : </b> http://regtechapi.in/api/udyogaadhaars</p>
        <b>Header : </b><br>
        {<br>   
        "AccessToken":"xxxxxxxxxxxxx"<br>
        }<br>
        <b>Request Body : </b><br>
        {<br>   
        "uamnumber":"MH26E0170657"<br>
        }<br>

        <p><b>Success Response : </b><br>
            [<br>
                &nbsp;&nbsp;{<br>
                    "status_code":200<br>
                &nbsp;&nbsp;"response":  {<br>
                &nbsp;&nbsp;"essentials": {<br>
                &nbsp;&nbsp;"uamNumber":"MH26E0170657"<br>
                &nbsp;&nbsp;&nbsp;&nbsp;}<br>
                &nbsp;&nbsp;"essentials": {<br>
                &nbsp;&nbsp;"result": {
                    "uamNumber": "MH26E0170657",
            "nameofEnterprise": "ZAPFIN TEKNOLOGIES PRIVATE LIMITED",
            "majorActivity": "SERVICES",
            "socialCategory": "GENERAL",
            "enterpriseType": "SMALL",
            "dateofCommencement": "09/11/2018",
            "dicName": "PUNE",
            "state": "MAHARASHTRA",
            "appliedDate": "18/09/2019",
            "modifiedDate": "N/A",
            "validTillDate": "30/06/2022.",
            "nic2Digit": "66-OTHER FINANCIAL ACTIVITIES",
            "nic4Digit": "6619-ACTIVITIES AUXILIARY TO FINANCIAL SERVICE ACTIVITIES N.E.C.",
            "nic5DigitCode": "66190-ACTIVITIES AUXILIARY TO FINANCIAL SERVICE ACTIVITIES N.E.C.",
            "status": "ACTIVE"
        }"<br>
                &nbsp;&nbsp;&nbsp;&nbsp;}<br>
              



                &nbsp;&nbsp;}<br>
            ]<br>
        </p>
                    


                   
                   </div>
                </div>
            </div>
        </div>
    </div>

    <div class = "card">
        <div class = "card-header">
            <a class = "card-link" href = "#bank_verification" data-toggle = "collapse">Bank's APIs</a>
        </div>
        <div class = "collapse" id = "bank_verification" data-parent = "#accordion">
            <div class = "card-body">
                <div class="row">
                    <div class = "col-md-4">
                        <span class = "badge badge-dark"><h3>Bank Verification APIs</h3></span>
                    </div>
                <div class = "col-md-6">
                    <span class = "badge badge-warning"><h4><u>Bank Verification</u></h4></span><br>
                    <p><b> Hitting URL : </b> http://regtechapi.in/api/bank_verification</p>
                    <b>Request Method : POST </b><br>
                    <b>Header : </b><br>
                        {<br>   
                        "AccessToken":"xxxxxxxxxxxxx"<br>
                        }<br>
                    <b>Request Body : </b><br>
                    {<br>
                    "id_number": "589402010002932",<br>
                    "ifsc": "UBIN0558940"<br>
                    }<br>
                    <p><b>Success Response : </b><br>
                     &nbsp;&nbsp;{<br>
                     &nbsp;&nbsp;"data": {<br>
                     &nbsp;&nbsp;"account_number": "01234567890",<br>
                     &nbsp;&nbsp;"full_name": "MUNNA BHAIYA",<br>
                     &nbsp;&nbsp;"client_id": "takdTqhCxo",<br>
                     &nbsp;&nbsp;"amount_deposited": 1.00,<br>
                     &nbsp;&nbsp;"account_exists": true<br>
                     &nbsp;&nbsp;},<br>
                     &nbsp;&nbsp;"status_code": 200,<br>
                     &nbsp;&nbsp;"message": "",<br>
                     &nbsp;&nbsp;"success": true<br>
                     &nbsp;&nbsp;}<br>
                    </p>
                </div>
        </div>
        <div class = "card-header">
            <a class = "card-link" href = "#bank_verification" data-toggle = "collapse">Bank Statement APIs</a>
        </div>
        <div class = "collapse" id = "bank_verification" data-parent = "#accordion">
            <div class = "card-body">
                <div class="row">
                    <div class = "col-md-4">
                        <span class = "badge badge-dark"><h3>Bank Statement APIs</h3></span>
                    </div>
                <div class = "col-md-6">
                    <span class = "badge badge-warning"><h4><u>Bank Statement</u></h4></span><br>
                    <p><b> Hitting URL : </b> http://regtechapi.in/api/bank_details</p>
                    <b>Request Method : POST </b><br>
                    <b>Header : </b><br>
                        {<br>   
                        "AccessToken":"xxxxxxxxxxxxx"<br>
                        }<br>
                    <b>Request Body : </b><br>
                    {<br>
                    "file": "bank_statement-hdfc.pdf",<br>
                    "bank": "HDFC"<br>
                    "accounttype": "SAVING",<br>
                    "password": "******"<br>
                    }<br>
                    <p><b>Success Response : </b><br>
                     &nbsp;&nbsp;{<br>
                     &nbsp;&nbsp;"response": {<br>
                     &nbsp;&nbsp;"amount": "73569.78",<br>
                     &nbsp;&nbsp;"balanceAfterTransaction": "73569.78",<br>
                     &nbsp;&nbsp;"bank": "SBI_8771610002382",<br>
                     &nbsp;&nbsp;"batchID": null,<br>
                     &nbsp;&nbsp;"category": "OPENING_BALANCE",<br>
                     &nbsp;&nbsp;"dateTime": "01/01/2017",<br>
                     &nbsp;&nbsp;"description":"OPENING BALANCE",<br>
                     &nbsp;&nbsp;"remark": ""<br>
                     &nbsp;&nbsp;"transactionId": ""<br>
                     &nbsp;&nbsp;"transactionNumber": ""<br>
                     &nbsp;&nbsp;"type": "CREDIT"<br>
                     &nbsp;&nbsp;"valueDate": ""<br>
                     &nbsp;&nbsp;},<br>
                     &nbsp;&nbsp;"status_code": 200,<br>
                     &nbsp;&nbsp;"message": "",<br>
                     &nbsp;&nbsp;"success": true<br>
                     &nbsp;&nbsp;}<br>
                    </p>
                </div>
        </div>
        <div class = "card-header">
            <a class = "card-link" href = "#bank_verification" data-toggle = "collapse">Bank Analyser APIs</a>
        </div>
        <div class = "collapse" id = "bank_verification" data-parent = "#accordion">
            <div class = "card-body">
                <div class="row">
                    <div class = "col-md-4">
                        <span class = "badge badge-dark"><h3>Bank Analyser APIs</h3></span>
                    </div>
                <div class = "col-md-6">
                    <span class = "badge badge-warning"><h4><u>Bank Analyser For India</u></h4></span><br>
                    <p><b> Hitting URL : </b> http://regtechapi.in/api/bank_anlyser</p>
                    <b>Request Method : POST </b><br>
                    <b>Header : </b><br>
                        {<br>   
                        "AccessToken":"xxxxxxxxxxxxx"<br>
                        }<br>
                    <b>Request Body : </b><br>
                    {<br>
                    "file": "bank_statement-hdfc.pdf",<br>
                    "bank": "HDFC"<br>
                    "accounttype": "SAVING",<br>
                    "password": "******"<br>
                    "country": "INDIA"<br>
                    }<br>
                    <p><b>Success Response : </b><br>
                     &nbsp;&nbsp;{<br>
                     &nbsp;&nbsp;"response": {<br>
                     &nbsp;&nbsp;"atm_withdrawls": "[]",<br>
                     &nbsp;&nbsp;"averageMonthlyBalance": "[{",<br>
                     &nbsp;&nbsp;"netAverageBalance": "28935.33",<br>
                     &nbsp;&nbsp;"monthAndYear": "Jan 2017",<br>
                     &nbsp;&nbsp;"dayBalanceMap": "{",<br>
                     &nbsp;&nbsp;"1": "74869.78",<br>
                     &nbsp;&nbsp;"5":"52734.78",<br>
                     &nbsp;&nbsp;"10": "35900.6"<br>
                     &nbsp;&nbsp;"15": "35150.6"<br>
                     &nbsp;&nbsp;"20": "35144.85"<br>
                     &nbsp;&nbsp;"25": "144.85"<br>
                     &nbsp;&nbsp;"30": "14.85"<br>
                     &nbsp;&nbsp;},<br>
                     &nbsp;&nbsp;},<br>
                     &nbsp;&nbsp;],<br>
                     &nbsp;&nbsp;"averageMonthlyBalance": "[{",<br>
                     &nbsp;&nbsp;"netAverageBalance": "28935.33",<br>
                     &nbsp;&nbsp;"monthAndYear": "Jan 2017",<br>
                     &nbsp;&nbsp;},<br>
                     &nbsp;&nbsp;],<br>
                     &nbsp;&nbsp;"cash_deposits": "[]",<br>
                     &nbsp;&nbsp;"expenses": "[{",<br>
                     &nbsp;&nbsp;"amount": "6500.33",<br>
                     &nbsp;&nbsp;"bank": "",<br>
                     &nbsp;&nbsp;"category": "CREDIT_CARD_PAYMENT",<br>
                     &nbsp;&nbsp;"date": "2017-01-04T00:00:00Z",<br>
                     &nbsp;&nbsp;"description": "50100013343731 -TPT-CREDIT CARD MONEY",<br>
                     &nbsp;&nbsp;"merchantType": "",<br>
                     &nbsp;&nbsp;"mode": "INTERNET_FUND_TRANSFER",<br>
                     &nbsp;&nbsp;"monthAndYear": "",<br>
                     &nbsp;&nbsp;"partyName": "xyz",<br>
                     &nbsp;&nbsp;"purpose": "CREDIT_CARD_PAYMENT",<br>
                     &nbsp;&nbsp;"total": " ",<br>
                     &nbsp;&nbsp;},<br>
                     &nbsp;&nbsp;],<br>
                     &nbsp;&nbsp;"high_value_transactions": "[{",<br>
                     &nbsp;&nbsp;"amount": "35000",<br>
                     &nbsp;&nbsp;"balanceAfterTranscation": "144.85",<br>
                     &nbsp;&nbsp;"bank": "",<br>
                     &nbsp;&nbsp;"date": "2017-01-04T00:00:00Z",<br>
                     &nbsp;&nbsp;"description": "50100013343731 -TPT-CREDIT CARD MONEY",<br>
                     &nbsp;&nbsp;"category": "OTHER",<br>
                     &nbsp;&nbsp;"type": "DEBIT",<br>
                     &nbsp;&nbsp;},<br>
                     &nbsp;&nbsp;],<br>
                     &nbsp;&nbsp;"incomes": "[{",<br>
                     &nbsp;&nbsp;"amount": "6500.33",<br>
                     &nbsp;&nbsp;"balanceAfterTransaction": "32786.85",<br>
                     &nbsp;&nbsp;"bank": "",<br>
                     &nbsp;&nbsp;"category": "SALARY",<br>
                     &nbsp;&nbsp;"date": "2017-01-04T00:00:00Z",<br>
                     &nbsp;&nbsp;"description": "50100013343731 -TPT-CREDIT CARD MONEY",<br>
                     &nbsp;&nbsp;"isSalary": "true",<br>
                     &nbsp;&nbsp;"isSalaryCheck": "true",<br>
                     &nbsp;&nbsp;"mode": "SALARY",<br>
                     &nbsp;&nbsp;"monthAndYear": "",<br>
                     &nbsp;&nbsp;"partyName": "",<br>
                     &nbsp;&nbsp;"purpose": "SALARY",<br>
                     &nbsp;&nbsp;"total": " ",<br>
                     &nbsp;&nbsp;"transactionType": "CREDIT",<br>
                     &nbsp;&nbsp;},<br>
                     &nbsp;&nbsp;],<br>
                     &nbsp;&nbsp;"internalTransactionList": "[]",<br>
                     &nbsp;&nbsp;"investments": "[]",<br>
                     &nbsp;&nbsp;"minimum_balances": "[{",<br>
                     &nbsp;&nbsp;"amount": "35000",<br>
                     &nbsp;&nbsp;"balanceAfterTranscation": "144.85",<br>
                     &nbsp;&nbsp;"bank": "",<br>
                     &nbsp;&nbsp;"date": "2017-01-04T00:00:00Z",<br>
                     &nbsp;&nbsp;"description": "6680614962/PAYTM",<br>
                     &nbsp;&nbsp;"category": "TRANSFER_TO_WALLET",<br>
                     &nbsp;&nbsp;"transactionType": "DEBIT",<br>
                     &nbsp;&nbsp;},<br>
                     &nbsp;&nbsp;],<br>
                     &nbsp;&nbsp;"missingMonths": "[]",<br>
                     &nbsp;&nbsp;"money_received_transactions": "[{",<br>
                     &nbsp;&nbsp;"amount": "1300",<br>
                     &nbsp;&nbsp;"balanceAfterTranscation": "74869.78",<br>
                     &nbsp;&nbsp;"bank": "",<br>
                     &nbsp;&nbsp;"date": "2017-01-04T00:00:00Z",<br>
                     &nbsp;&nbsp;"description": "6680614962/PAYTM",<br>
                     &nbsp;&nbsp;"category": "IMPS",<br>
                     &nbsp;&nbsp;"monthAndYear": "",<br>
                     &nbsp;&nbsp;"total": "",<br>
                     &nbsp;&nbsp;"transactionType": "DEBIT",<br>
                     &nbsp;&nbsp;},<br>
                     &nbsp;&nbsp;],<br>
                     &nbsp;&nbsp;},<br>
                     &nbsp;&nbsp;"status_code": 200,<br>
                     &nbsp;&nbsp;"message": "",<br>
                     &nbsp;&nbsp;"success": true<br>
                     &nbsp;&nbsp;}<br>
                    </p>
                </div></br>
                <div class = "col-md-6">
                    <span class = "badge badge-warning"><h4><u>Bank Analyser For Philippines</u></h4></span><br>
                    <p><b> Hitting URL : </b> http://regtechapi.in/api/bank_anlyser_psd</p>
                    <b>Request Method : POST </b><br>
                    <b>Header : </b><br>
                        {<br>   
                        "AccessToken":"xxxxxxxxxxxxx"<br>
                        }<br>
                    <b>Request Body : </b><br>
                    {<br>
                    "file": "bank_statement.pdf",<br>
                    "bank": "SECURITY BANK"<br>
                    "accounttype": "SAVING",<br>
                    "password": "******"<br>
                    "country": "Philippines"<br>
                    }<br>
                    <p><b>Success Response : </b><br>
                     &nbsp;&nbsp;{<br>
                     &nbsp;&nbsp;"response": {<br>
                     &nbsp;&nbsp;"atm_withdrawls": "[]",<br>
                     &nbsp;&nbsp;"averageMonthlyBalance": "[{",<br>
                     &nbsp;&nbsp;"netAverageBalance": "28935.33",<br>
                     &nbsp;&nbsp;"monthAndYear": "Jan 2017",<br>
                     &nbsp;&nbsp;"dayBalanceMap": "{",<br>
                     &nbsp;&nbsp;"1": "74869.78",<br>
                     &nbsp;&nbsp;"5":"52734.78",<br>
                     &nbsp;&nbsp;"10": "35900.6"<br>
                     &nbsp;&nbsp;"15": "35150.6"<br>
                     &nbsp;&nbsp;"20": "35144.85"<br>
                     &nbsp;&nbsp;"25": "144.85"<br>
                     &nbsp;&nbsp;"30": "14.85"<br>
                     &nbsp;&nbsp;},<br>
                     &nbsp;&nbsp;},<br>
                     &nbsp;&nbsp;],<br>
                     &nbsp;&nbsp;"averageMonthlyBalance": "[{",<br>
                     &nbsp;&nbsp;"netAverageBalance": "28935.33",<br>
                     &nbsp;&nbsp;"monthAndYear": "Jan 2017",<br>
                     &nbsp;&nbsp;},<br>
                     &nbsp;&nbsp;],<br>
                     &nbsp;&nbsp;"cash_deposits": "[]",<br>
                     &nbsp;&nbsp;"expenses": "[{",<br>
                     &nbsp;&nbsp;"amount": "6500.33",<br>
                     &nbsp;&nbsp;"bank": "",<br>
                     &nbsp;&nbsp;"category": "CREDIT_CARD_PAYMENT",<br>
                     &nbsp;&nbsp;"date": "2017-01-04T00:00:00Z",<br>
                     &nbsp;&nbsp;"description": "50100013343731 -TPT-CREDIT CARD MONEY",<br>
                     &nbsp;&nbsp;"merchantType": "",<br>
                     &nbsp;&nbsp;"mode": "INTERNET_FUND_TRANSFER",<br>
                     &nbsp;&nbsp;"monthAndYear": "",<br>
                     &nbsp;&nbsp;"partyName": "xyz",<br>
                     &nbsp;&nbsp;"purpose": "CREDIT_CARD_PAYMENT",<br>
                     &nbsp;&nbsp;"total": " ",<br>
                     &nbsp;&nbsp;},<br>
                     &nbsp;&nbsp;],<br>
                     &nbsp;&nbsp;"high_value_transactions": "[{",<br>
                     &nbsp;&nbsp;"amount": "35000",<br>
                     &nbsp;&nbsp;"balanceAfterTranscation": "144.85",<br>
                     &nbsp;&nbsp;"bank": "",<br>
                     &nbsp;&nbsp;"date": "2017-01-04T00:00:00Z",<br>
                     &nbsp;&nbsp;"description": "50100013343731 -TPT-CREDIT CARD MONEY",<br>
                     &nbsp;&nbsp;"category": "OTHER",<br>
                     &nbsp;&nbsp;"type": "DEBIT",<br>
                     &nbsp;&nbsp;},<br>
                     &nbsp;&nbsp;],<br>
                     &nbsp;&nbsp;"incomes": "[{",<br>
                     &nbsp;&nbsp;"amount": "6500.33",<br>
                     &nbsp;&nbsp;"balanceAfterTransaction": "32786.85",<br>
                     &nbsp;&nbsp;"bank": "",<br>
                     &nbsp;&nbsp;"category": "SALARY",<br>
                     &nbsp;&nbsp;"date": "2017-01-04T00:00:00Z",<br>
                     &nbsp;&nbsp;"description": "50100013343731 -TPT-CREDIT CARD MONEY",<br>
                     &nbsp;&nbsp;"isSalary": "true",<br>
                     &nbsp;&nbsp;"isSalaryCheck": "true",<br>
                     &nbsp;&nbsp;"mode": "SALARY",<br>
                     &nbsp;&nbsp;"monthAndYear": "",<br>
                     &nbsp;&nbsp;"partyName": "",<br>
                     &nbsp;&nbsp;"purpose": "SALARY",<br>
                     &nbsp;&nbsp;"total": " ",<br>
                     &nbsp;&nbsp;"transactionType": "CREDIT",<br>
                     &nbsp;&nbsp;},<br>
                     &nbsp;&nbsp;],<br>
                     &nbsp;&nbsp;"internalTransactionList": "[]",<br>
                     &nbsp;&nbsp;"investments": "[]",<br>
                     &nbsp;&nbsp;"minimum_balances": "[{",<br>
                     &nbsp;&nbsp;"amount": "35000",<br>
                     &nbsp;&nbsp;"balanceAfterTranscation": "144.85",<br>
                     &nbsp;&nbsp;"bank": "",<br>
                     &nbsp;&nbsp;"date": "2017-01-04T00:00:00Z",<br>
                     &nbsp;&nbsp;"description": "6680614962/PAYTM",<br>
                     &nbsp;&nbsp;"category": "TRANSFER_TO_WALLET",<br>
                     &nbsp;&nbsp;"transactionType": "DEBIT",<br>
                     &nbsp;&nbsp;},<br>
                     &nbsp;&nbsp;],<br>
                     &nbsp;&nbsp;"missingMonths": "[]",<br>
                     &nbsp;&nbsp;"money_received_transactions": "[{",<br>
                     &nbsp;&nbsp;"amount": "1300",<br>
                     &nbsp;&nbsp;"balanceAfterTranscation": "74869.78",<br>
                     &nbsp;&nbsp;"bank": "",<br>
                     &nbsp;&nbsp;"date": "2017-01-04T00:00:00Z",<br>
                     &nbsp;&nbsp;"description": "6680614962/PAYTM",<br>
                     &nbsp;&nbsp;"category": "IMPS",<br>
                     &nbsp;&nbsp;"monthAndYear": "",<br>
                     &nbsp;&nbsp;"total": "",<br>
                     &nbsp;&nbsp;"transactionType": "DEBIT",<br>
                     &nbsp;&nbsp;},<br>
                     &nbsp;&nbsp;],<br>
                     &nbsp;&nbsp;},<br>
                     &nbsp;&nbsp;"status_code": 200,<br>
                     &nbsp;&nbsp;"message": "",<br>
                     &nbsp;&nbsp;"success": true<br>
                     &nbsp;&nbsp;}<br>
                    </p>
                </div>
        </div>
            </div>
        </div>
    </div>

    <div class = "card">
        <div class = "card-header">
            <a class = "card-link" href = "#face_match" data-toggle = "collapse">Face Match APIs</a>
        </div>
        <div class = "collapse" id = "face_match" data-parent = "#accordion">
            <div class = "card-body">
                <div class="row">
                    <div class = "col-md-4">
                        <span class = "badge badge-dark"><h3>Face Match API</h3></span>
                    </div>
                <div class = "col-md-6">
                    <span class = "badge badge-warning"><h4><u>Face Match</u></h4></span><br>
                    <p><b> Hitting URL : </b> http://regtechapi.in/api/face_match</p>
                    <b>Request Method : POST </b><br>
                    <b>Header : </b><br>
                        {<br>   
                        "AccessToken":"xxxxxxxxxxxxx"<br>
                        }<br>
                    <b>Request Body : </b><br>
                    {<br>
                    "doc_img": "{{@doc_img}}",<br>
                    "selfie": "{{@selfie}}"<br>
                    }<br>
                    <p><b>Success Response : </b><br>
                     &nbsp;&nbsp;{<br>
                     &nbsp;&nbsp;"code": 200<br>
                     &nbsp;&nbsp;"status": "success"<br>
                     &nbsp;&nbsp;"response": {<br>
                     &nbsp;&nbsp;"confidence": "100%",<br>
                     &nbsp;&nbsp;},<br>
                     &nbsp;&nbsp;"status_code": 200,<br>
                     &nbsp;&nbsp;}<br>
                    </p>
                </div>
        </div>
            </div>
        </div>
    </div>



    <div class = "card">
        <div class = "card-header">
            <a class = "card-link" href = "#telecom" data-toggle = "collapse">Telecom APIs</a>
        </div>
        <div class = "collapse" id = "telecom" data-parent = "#accordion">
            <div class = "card-body">
                <div class="row">
                    <div class = "col-md-4">
                        <span class = "badge badge-dark"><h3>Telecom APIs</h3></span>
                    </div>
                <div class = "col-md-6">
                    <span class = "badge badge-warning"><h4><u>Telecom Generate OTP</u></h4></span><br>
                    <p><b> Hitting URL : </b> http://regtechapi.in/api/telecom/generate-otp</p>
                    <b>Request Method : POST </b><br>
                    <b>Header : </b><br>
                        {<br>   
                        "AccessToken":"xxxxxxxxxxxxx"<br>
                        }<br>
                    <b>Request Body : </b><br>
                    {<br>   
                    "id_number": "9840115789"<br>
                    }<br>
                    <p><b>Success Response : </b><br>
                        
                    &nbsp;&nbsp;{<br>
                    &nbsp;&nbsp;"data": { <br>
                    &nbsp;&nbsp;"client_id": "telecom_FSuewlwSuVZzfBAiEgqq",<br>
                    &nbsp;&nbsp;"operator": "vi",<br>
                    &nbsp;&nbsp;"otp_sent": "true"<br>
                    &nbsp;&nbsp;"if_number": "true"<br>
                    &nbsp;&nbsp;},<br>
                    &nbsp;&nbsp;"status_code": 200,<br> 
                    &nbsp;&nbsp;"message_code": success,<br> 
                    &nbsp;&nbsp;"message": "OTP generated",<br>
                    &nbsp;&nbsp;"success": "true"<br>
                    &nbsp;&nbsp;}<br>
                    </p>


                    <span class = "badge badge-warning"><h4><u>Telecom OTP Submit</u></h4></span><br>
                    <p><b> Hitting URL : </b> http://regtechapi.in/api/telecom/submit-otp</p>
                    <b>Request Method : POST </b><br>
                    <b>Header : </b><br>
                        {<br>   
                        "AccessToken":"xxxxxxxxxxxxx"<br>
                        }<br>
                    <b>Request Body : </b><br>
                    {<br>   
                    "client_id": "@{{client_id}}",<br>
                    "otp": "@{{otp}}"<br>
                    }<br>
                    <b>Success Response : </b>
                    <p class = "px-2">{<br>
                        "data": {<br>
                        "client_id": "telecom_vKTrdfluunadpDzxocIH",<br>
                        "mobile_number": "9404758963",<br>
                        "address": "SAPTASUR A-404, D.S.K. VISHWA  TALUKA HAWELI,Vadgaon Budruk,PUNE, DHAYARI, Maharashtra, 411041",<br>
                        "city": "DHAYARI",<br>
                        "state": "Maharashtra",<br>
                        "pin_code": "411041",<br>
                        "full_name": "DEVANAND KUMAR",<br>
                        "dob": "1966-11-02",<br>
                        "parsed_dob": "1966-11-02",<br>
                        "user_email": null,<br>
                        "operator": "vi",<br>
                        "billing_type": "prepaid",<br>
                        "alternate_phone": "8745125987",<br>
                        "extra_fields": null<br>
                        },
                        "status_code": 200,<br>
                        "success": true,<br>
                        "message": "Success",<br>
                        "message_code": "success"<br>
                        }</p>    
                        <br>

                        <span class = "badge badge-warning"><h4><u>Telecom EPFO Without OTP Details</u></h4></span><br>
                        <p><b> Hitting URL : </b> http://regtechapi.in/api/epfo</p>
                        <b>Request Method : POST </b><br>
                        <b>Header : </b><br>
                        {<br>   
                        "AccessToken":"xxxxxxxxxxxxx"<br>
                        }<br>
                        <b>Request Body : </b><br>
                        {<br>   
                        "name": "@{{name}}",<br>
                        "company": "@{{company}}"<br>
                        }<br>
                        <b>Success Response : </b>
                        <p class = "px-2">{<br>
                            "data": {<br>
                                "search_data": [<br>
                                    {<br>    
                                        "confidence": "@{{confidence}}"",<br>
                                        "name": "@{{name}}",<br>
                                        "company": "@{{company}}",<br>
                                        "company_code": "@{{company_code}}",<br>
                                        "unique": "@{{unique}}",<br>
                                        "filing_data": [,<br>
                                            {<br>
                                                "month": "@{{month}}"",<br>
                                                "trrn": "@{{trrn}}",<br>
                                                "date": "@{{date}}"<br>
                                            },<br> 
                                        ],<br>
                                    },<br>    
                                ],<br>  
                            },<br/>
                            "status_code": 200,<br>
                            "success": true,<br>
                            "message": "Success",<br>
                            "message_code": "success"<br>
                            }
                        </p>    
                        <br>

                        <span class = "badge badge-warning"><h4><u>Telecom UAN Details</u></h4></span><br>
                        <p><b> Hitting URL : </b> http://regtechapi.in/api/uan</p>
                        <b>Request Method : POST </b><br>
                        <b>Header : </b><br>
                        {<br>   
                        "AccessToken":"xxxxxxxxxxxxx"<br>
                        }<br>
                        <b>Request Body : </b><br>
                        {<br>   
                        "mobile_number": "@{{mobile_number}}"<br>
                        }<br>
                        <b>Success Response : </b>
                        <p class = "px-2">{<br>
                            "data": {<br>
                            "pf_uan": "@{{pf_uan}}"",<br>
                            "client_id": "@{{client_id}}"<br>
                            },<br/>
                            "status_code": 200,<br>
                            "success": true,<br>
                            "message": "Success",<br>
                            "message_code": "success"<br>
                            }
                        </p>    
                        <br>

                        <span class = "badge badge-warning"><h4><u>Telecom Company Search</u></h4></span><br>
                        <p><b> Hitting URL : </b> http://regtechapi.in/api/company_search</p>
                        <b>Request Method : POST </b><br>
                        <b>Header : </b><br>
                        {<br>   
                        "AccessToken":"xxxxxxxxxxxxx"<br>
                        }<br>
                        <b>Request Body : </b><br>
                        {<br>   
                        "company": "@{{company}}",<br>
                        "search_size": "@{{search_size}}"<br>
                        }<br>
                        <b>Success Response : </b>
                        <p class = "px-2">{<br>
                            "data": {<br>
                                "search_data": [<br>
                                    {<br>    
                                        "confidence": "@{{confidence}}"",<br>
                                        "company": "@{{company}}",<br>
                                        "company_code": "@{{company_code}}",<br>
                                        "addres": "@{{addres}}",<br>
                                        "office": "@{{office}}",<br>
                                    }<br>
                                ]<br>  
                            },<br/>
                            "status_code": 200,<br>
                            "success": true,<br>
                            "message": "Success",<br>
                            "message_code": "success"<br>
                            }
                        </p>    
                        <br>

                        <span class = "badge badge-warning"><h4><u>Telecom Company Details</u></h4></span><br>
                        <p><b> Hitting URL : </b> http://regtechapi.in/api/company_details</p>
                        <b>Request Method : POST </b><br>
                        <b>Header : </b><br>
                        {<br>   
                        "AccessToken":"xxxxxxxxxxxxx"<br>
                        }<br>
                        <b>Request Body : </b><br>
                        {<br>   
                        "company_code": "@{{company_code}}",<br>
                        "filing_data_size": "@{{filing_data_size}}"<br>
                        }<br>
                        <b>Success Response : </b>
                        <p class = "px-2">{<br>
                            "data": {<br>
                                "search_data": [<br>
                                    {<br>    
                                        "company": "@{{company}}",<br>
                                        "company_code": "@{{company_code}}",<br>
                                        "addres": "@{{addres}}",<br>
                                        "office": "@{{office}}",<br>
                                        "name_as_per_pan": "@{{name_as_per_pan}}",<br>
                                        "pan_status": "@{{pan_status}}",<br>
                                        "section_applicable": "@{{section_applicable}}",<br>
                                        "primary_business_activity": "@{{primary_business_activity}}",<br>
                                        "esic_code": "@{{esic_code}}",<br>
                                        "cin": "@{{cin}}",<br>
                                        "lin": "@{{lin}}",<br>
                                        "ownership_type": "@{{ownership_type}}",<br>
                                        "date_of_setup_of_establishment": "@{{date_of_setup_of_establishment}}",<br>
                                        "pin_code": "@{{pin_code}}",<br>
                                        "city": "@{{city}}",<br>
                                        "district": "@{{district}}",<br>
                                        "state": "@{{state}}",<br>
                                        "country": "@{{country}}",<br>
                                        "epfo_office_name": "@{{epfo_office_name}}",<br>
                                        "epfo_office_address": "@{{epfo_office_address}}",<br>
                                        "zone": "@{{zone}}",<br>
                                        "region": "@{{region}}",<br>
                                        "filing_data": [,<br>
                                            {<br>
                                                "date": "@{{date}}"",<br>
                                                "amount": "@{{amount}}",<br>
                                                "month": "@{{month}}",<br>
                                                "wage_month": "@{{wage_month}}"",<br>
                                                "no_of_employees": "@{{no_of_employees}}",<br>
                                                "ecr": "@{{ecr}}"<br>
                                            },<br> 
                                        ],<br>    
                                    }<br>
                                ]<br>  
                            },<br/>
                            "status_code": 200,<br>
                            "success": true,<br>
                            "message": "Success",<br>
                            "message_code": "success"<br>
                            }
                        </p>    
                        <br>
                </div>
        </div>
            </div>
        </div>
    </div>

    






</div>      
@stop


@section('custom_js')
@stop