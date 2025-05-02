<html>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<body class="lead">

<div class="w3-sidebar w3-bar-block fixed-top w3-card w3-animate-left list-unstyled" style="display:none" id="mySidebar">
  <button class="w3-bar-item w3-button w3-large"
  onclick="w3_close()">Close &times;</button>

    <li><a class="w3-bar-item w3-button" onclick="w3_close()" href="#customer_verification">Customer Verification</a></li>
    <li><a class="w3-bar-item w3-button" onclick="w3_close()" href="#bank">Bank Account Verification</a></li>
    <li><a class="w3-bar-item w3-button" onclick="w3_close()" href="#e_kyc">E-Kyc</a></li>
    <li><a class="w3-bar-item w3-button" onclick="w3_close()" href="#video_kyc">Video-Kyc</a></li>
    <li><a class="w3-bar-item w3-button" onclick="w3_close()" href="#e_sign">E-sign</a></li>
    <li><a class="w3-bar-item w3-button" onclick="w3_close()" href="#offline_aadhar">Offline Aadhar</a></li>
    <li><a class="w3-bar-item w3-button" onclick="w3_close()" href="#aadhar_masking">Aadhar Masking</a></li>
    <li><a class="w3-bar-item w3-button" onclick="w3_close()" href="#db_fmatch">DB Fmatch</a></li>
    <li><a class="w3-bar-item w3-button" onclick="w3_close()" href="#enach">e-NACH/e-Mandate</a></li>
    <li><a class="w3-bar-item w3-button" onclick="w3_close()" href="#customer_acquisition">Verified Customer Acquisition</a></li>
    <li><a class="w3-bar-item w3-button" onclick="w3_close()" href="#vehicle_verification">Vehicle Verification</a></li>

</div>

<div id="main">

	<div class="bg-danger">
      <button id="openNav" class="w3-button w3-xlarge" onclick="w3_open()" style="color:white">&#9776;</button>
        <span class="font-weight-bold" style="font-size: 25px; color: white !important"><span>RegTech APIs</span></span>
    </div>

</div>

<script>
function w3_open() {
  document.getElementById("main").style.marginLeft = "25%";
  document.getElementById("mySidebar").style.width = "25%";
  document.getElementById("mySidebar").style.display = "block";
  document.getElementById("openNav").style.display = 'none';
}
function w3_close() {
  document.getElementById("main").style.marginLeft = "0%";
  document.getElementById("mySidebar").style.display = "none";
  document.getElementById("openNav").style.display = "inline-block";
}
</script>

</body>
</html>
