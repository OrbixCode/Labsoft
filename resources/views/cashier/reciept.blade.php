<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<style>
    /* TODO: optimize */

@font-face {
  /* 
    This won't work on CodePen :-( 
    Stupid Cross Site yadda yadda!
  */
  font-family: 'Equestria';
  src: url("https://www.dropbox.com/s/x04iih58ob04d56/Equestria.otf?raw=1");
}

body {
  font-family: 'Roboto', sans-serif;
  margin: 0px;
  padding: 0px;
}

.receipt {
    padding: 3mm;
    width: 80mm;
    border: 1px solid black;
    margin: auto!important;
    color:#000!important;
}
.orderNo {
  width: 100%;
  text-align: right;
  padding-bottom: 1mm;
  font-size: 8pt;
  font-weight: bold;
  color:#000!important;
}

.orderNo:empty {
  display: none;
}

.headerSubTitle {
  text-align: center;
  font-size: 12pt;
  color:#000!important;
}

.headerTitle {
  text-align: center;
  font-size: 24pt;
  font-weight: bold;
  color:#000!important;
}

#patient_section {
  margin-top: 3pt;
  text-align: left;
  font-size: 10pt;
  font-weight: bold;
  color:#000!important;
}
.patient_section_inner{
  margin:0px;
  padding:0px;
}

#date {
  margin: 5pt 0px;
  text-align: center;
  font-size: 8pt;
  color:#000!important;
}

#barcode {
  display: block;
  margin: 0px auto;
  color:#000!important;
}

#barcode:empty {
  display: none;
}

.watermark {
   position: absolute;
   left: 7mm;
   top: 60mm;
   width: 75mm;
   opacity: 0.1;
}

.keepIt {
  text-align: center;
  font-size: 12pt;
  font-weight: bold;
  color:#000!important;
}

.keepItBody {
  text-align: justify;
  font-size: 8pt;
  color:#000!important;
  line-height: 1;
}

.item {
  margin-bottom: 1mm;
  color:#000!important;
}

.itemRow {
  display: flex;
  font-size: 8pt;
  align-items: baseline;
  color:#000!important;
}

.itemRow > div {
  align-items: baseline;
}

.itemName {
  font-weight: bold;
  color:#000!important;
}

.itemPrice {
  text-align: right;
  flex-grow: 1;
  color:#000!important;
}

/* .itemColor {
  width: 10px;
  height: 100%;
  background: yellow;
  margin: 0px 2px;
  padding: 0px;
} */

.itemColor:before {
  content: "\00a0";
}


.itemData2 {
  text-align: right;
  flex-grow: 1;
  color:#000!important;
}

.itemData3 {
  width: 15mm;
  text-align: right;
  color:#000!important;
}

.itemQuantity:before {
  content: "x";
  color:#000!important;
}



.flex {
  display: flex;
  justify-content: center;
  color:#000!important;
}

#qrcode {
  align-self: center;
  flex: 0 0 100px
}

.totals {
  flex-grow: 1;
  align-self: center;
  font-size: 10pt;
    font-weight: bold;
}

.totals .row {
  display: flex;
  text-align: right;
  color:#000!important;
}

.totals .section {
  padding-top: 2mm;
  color:#000!important;
  line-height: 1;
}

.totalRow > div, .total > div {
  text-align: right;
  align-items: baseline;
  font-size: 8pt;
  color:#000!important;
}

.totals .col1 {
  text-align: right;
  flex-grow: 1;
  color:#000!important;
}

.totals .col2 {
   width: 22mm; 
   color:#000!important;
}

.totals .col2:empty {
  display: none;
  color:#000!important;
}

.totals .col3 {
  width: 15mm;  
  color:#000!important;
}

.footer {
  overflow: hidden;
  margin-top: 5mm;
  border-radius: 7px;
  width: 100%;
  background: black;
  color: white;
  text-align: center;
  font-weight: bold;
  text-transform: uppercase;
}

.footer:empty {
    display: none;
}

.eta {
  padding: 1mm 0px;
  font-size:9px;
}

.eta:empty {
    display: none;
}

.eta:before {
    content: ;
  font-size: 8pt;
  display: block;
}

.etaLabel {
  font-size: 8pt;
  color:#000!important;
}

.printType {
  padding: 1mm 0px;
  width: 100%;
  background: grey;
  color: white;
  text-align: center;
  font-weight: bold;
  text-transform: uppercase;
}

.about {
  font-size: 12pt;
  overflow: hidden;
  background: #FCEC52;
  color: #3A5743;
  border-radius: 7px;
  padding: 0px;
  position: absolute;
  width: 500px;
  text-align: center;
  left: 50%;
  margin-top: 50px;
  margin-left: -250px;
}

/* .arrow_box h3, ul {
  margin: 5px;
} */

.about li {
  text-align: left;
  color:#000!important;
}

.reciept-img{
  width:70%!important;
}

</style>

<body>
    
<!-- <div class="arrow_box">
  This is a sample receipt for the new web driven POS system.
  <hr>
  <h3>Roadmap</h3>
  <ul>
    <li>Once fully implemented, a customer can use the QR code to get a live ETA for the order completion.</li>
    <li>Progressive Web Application with Push Notifications that can alert user when order is ready.</li>
    <li>And much more!</li>
</div> -->

<!-- START RECEIPT -->
  

                        
<div class="receipt">


                        @php
                            $generator = new Picqer\Barcode\BarcodeGeneratorHTML();
                        @endphp
  <div class="orderNo">
    Reciept# <span id="Order #">{{$reports->id}}</span>: <span id="Order Name">Jet Set</span>
  </div>
  <div class="headerSubTitle">
    Thank you for supporting the
  </div>
  <div class="headerTitle">
  <img src="{{asset('website/assets/img/billlogo.png')}}" alt="" class="reciept-img">
  </div>
  <div class="headerSubTitle">
  {!! $generator->getBarcode('$reports->id', $generator::TYPE_CODE_128) !!}
  </div>
  <div id="patient_section">
   <p class="patient_section_inner">Patient Name:{{$reports->patient_name}}</p>
   <p class="patient_section_inner">Patient Gender:{{$reports->gender->gender_name}}</p>
   <p class="patient_section_inner">Patient Age:{{$reports->patient_age}}</p>
   <p class="patient_section_inner">Laboratory Location:{{$reports->branch->branch_address}}</p>
   <p class="patient_section_inner">Laboratory Contact:{{$reports->branch->branch_phone}}</p>
  </div>
  <div id="date">
  {{$currentTime}}
  </div>
  <svg id="barcode"></svg>
  <div class="keepIt">
    Keep your receipt!
  </div>
  <div class="keepItBody">
    This original receipt is required to pick up any OnDemand items* or for Returns. Undamaged merchandise can be returned for a refund within 24 hours. Faulty goods can be exchanged anytime during this convention while the vendor hall is open. No returns are allowed for OnDemand items except at the discretion of BronyHouse staff. *Unclaimed on-demand items can be claimed without receipt in the final hours of the convention by describing the order in detail.
  </div>
  <hr>

  <!-- Items Purchased -->
  <div class="items">
    @foreach($testreportitem as $item)
   

    <div class="item">
      <div class="itemRow">
      <div class="itemColor"></div>
        <div class="itemName">{{$item->testsetup->test_name }}</div>
        <div class="itemPrice itemTaxable">Rs.{{$item->testsetup->test_charge }}.00</div>
      </div>
</div>



      @endforeach
      <!-- <div class="itemRow">
        <div class="itemColor"></div>
        <div class="itemData1">DNC-P01</div>
        <div class="itemData2">DaniCojo</div>
        <div class="itemData3 itemQuantity">10</div>
      </div>
      <div class="itemRow">
        <div class="itemColor"></div>
        <div class="itemData1">Print</div>
        <div class="itemData2">Reg(WS) 11x17 Bordered</div>
        <div class="itemData3">$20.00</div>
      </div>
    </div>
    <div class="item">
      <div class="itemRow">
        <div class="itemName">Miraculous Ladybug & Cat Noir</div>
        <div class="itemPrice itemTaxable">$1.25</div>
      </div>
      <div class="itemRow">
        <div class="itemColor"></div>
        <div class="itemData1">DNC-P03</div>
        <div class="itemData2">DaniCojo</div>
        <div class="itemData3 itemQuantity">10</div>
      </div>
      <div class="itemRow">
        <div class="itemColor"></div>
        <div class="itemData1">Print</div>
        <div class="itemData2">Reg(WS) 8.5x11 Borderless</div>
        <div class="itemData3">$12.25</div>
      </div>
    </div>
  </div> -->



  <!-- Totals -->
  <hr>
<div class="flex">
    <div id="qrcode"></div>
    <div class="totals">
      <div class="section">
        <div class="row">
          <div class="col1"></div>
          <div class="col2">Total</div>
          <div class="col3">{{$payment_recepit}}.00</div>
        </div>
        <!-- <div class="row">
          <div class="col1">0.00%</div>
          <div class="col2">Subtotal</div>
          <div class="col3">$61.25</div>
        </div>
        <div class="row">
          <div class="col1">2.75%</div>
          <div class="col2">Credit Card Fee</div>
          <div class="col3">$1.68</div>
        </div> -->
      </div>

    </div>
  </div>
  
  <div class="footer">
  <div class="eta">{{$reports->branch->branch_address}}</div>
    <div class="eta">Software By OrbixCode.com</div>
  </div>


</div>

</body>
</html>