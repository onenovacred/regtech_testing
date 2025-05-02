<html>
  <head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
  </head>
    <style>
      body {
        text-align: center;
        padding: 40px 0;
        background: #EBF0F5;
       }
        h1 {
          color: #521807;
          font-family: "Nunito Sans", "Helvetica Neue", sans-serif;
          font-weight: 900;
          font-size: 30px;
          margin-bottom: 10px;
        }
        p {
          color: #404F5E;
          font-family: "Nunito Sans", "Helvetica Neue", sans-serif;
          font-size:18px;
          margin: 0;
        }
      i {
        color: #79161d;
        font-size: 100px;
        line-height: 200px;
        margin-left:-15px;
      }
      .card {
        background: white;
        padding: 60px;
        border-radius: 4px;
        box-shadow: 0 2px 3px #C8D0D8;
        display: inline-block;
        margin: 0 auto;
      }
     .transaction_amount {
       font-family: "Nunito Sans", "Helvetica Neue", sans-serif;
       font-weight: 600;
       font-size: 13px;
       margin-bottom: 13px;
      }
      .fa-xmark {
        font-weight: 900;
        font-size: 100px;
        margin: 45px;
    }
    
    </style>
    <body>
      <div class="card">
      <div style="border-radius:200px; height:200px; width:200px; background: #F8FAF5; margin:0 auto;">
        <i class="fa-solid fa-xmark"></i>
      </div>
        <h1>Failed</h1> 
         <p style="margin-bottom:5px;">Your Transaction  Failed.</p>
        <span class="transaction_amount"><strong>Error Message</strong>:&nbsp;&nbsp;{{$error_Message}}</span>
        <br/>
        <span class="transaction_amount"><strong>Name</strong>:&nbsp;&nbsp;{{$name_on_card}}</span>
      </div>
    </body>
</html>
