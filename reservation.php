<!DOCTYPE html>
<html>
<head>
<?php 
include('header.php'); 
// Start the session
session_start();
// Cek Login Apakah Sudah Login atau Belum
if (!isset($_SESSION['ID'])){
// Jika Tidak Arahkan Kembali ke Halaman Login
  header("location: login.php");
} 

?>

</head>

<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">
  <?php include('head.php') ?>
  <!-- Left side column. contains the logo and sidebar -->
  <?php include('sidebar.php') ?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
      <!-- Main row -->
      <div class="row">
        <!-- Left col -->
        <section class="col-lg-12 connectedSortable">
          <!-- quick email widget -->
          <div class="box box-info" style="border-top-color: #ffffff;">
            <div class="box-header">
              <i class="fa fa-calendar"></i>
              <h3 class="box-title">Reservation</h3>
            </div>
            <div class="box-body">
              <form action="#" method="post">
                <div class="form-group">
                  <label>Keberangkatan</label>
                    <?php
                    date_default_timezone_set("Asia/Jakarta");
                    if (date("H:i:s")>="01:00:00" && date("H:i:s")<"10:00:00") {
                       echo '<input type="text" value="Intercon" class="form-control" name="keberangkatan" id="keberangkatan" style="width: 60%;" disabled="disabled"/>';
                    }
                    else{
                       echo '<input type="text" value="Tekno" class="form-control" name="keberangkatan" id="keberangkatan" style="width: 60%;" disabled="disabled"/>';
                    }
                    ?>
                </div>
                <div class="form-group">
                  <label>Tujuan</label>
                    <?php
                    date_default_timezone_set("Asia/Jakarta");
                    if (date("H:i:s")>="10:00:00" && date("H:i:s")<"21:00:00") {
                       echo ' <input type="text" value="Intercon" class="form-control" name="tujuan" id="tujuan" style="width: 60%;" disabled="disabled" />';
                    }
                    else{
                       echo '<input type="text" value="Tekno" class="form-control" name="tujuan" id="tujuan" style="width: 60%;" disabled="disabled" />';
                    }
                    ?>
                </div>
                <div class="form-group" style="width: 60%;">
                  <label>Elf ke-</label>
                  <select class="form-control" id="no_elf">
                    <option style="text-align: center;">--- Pilih ---</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                  </select>
                </div>
              </form>
            </div>
            <div class="box-footer clearfix">
              <button type="button" class="pull-right btn btn-default" id="search">Search  
              <i class="fa fa-arrow-circle-right"></i></button>
              <?php
              if ($_SESSION['role']=='user') {
               ?>
              <a type="button" class="pull-right btn btn-default" href="myrsvp.php">My Reservation</a>
              <?php 
                }
              ?>
            </div>
          </div>
        </section>
        <section class="col-lg-12 connectedSortable" id="seat1" style="display: block;">
          <!-- quick email widget -->
          <div class="box box-info" style="border-top-color: #ffffff;">
            <div class="main">
              <?php
              if ($_SESSION['role']=='user') {
               ?>
              <h2>Book Your Seat Now?</h2>
              <?php 
                }else{
                  echo "<h2>Check Booking Seat</h2>";
                }
              ?>
              <div class="wrapper">
                <div id="seat-map">
                  <div class="front-indicator"><h3>Front</h3></div>
                </div>
                
                <div class="booking-details">
                     
                      <div id="legend"></div>
                      
                      <?php
                      if ($_SESSION['role']=='user') {
                       ?>
                       <h3> Selected Seats (<span id="counter">0</span>):</h3>
                        <button class="checkout-button" id="book">Book Now</button>   
                         <?php 
                        }
                      ?>
                </div>
               
                <div class="clear"></div>
              </div>
              <script>
                  var firstSeatLabel = 1;
                
                  $(document).ready(function() {
                    var $cart = $('#selected-seats'),
                      $counter = $('#counter'),
                      $total = $('#total'),
                      sc = $('#seat-map').seatCharts({
                      map: [
                        'ee_f',
                        '_eee',
                        'e_ee',
                        'e_ee',
                        'eeee'
                      ],
                      seats: {
                        f: {
                          price   : 100,
                          classes : 'first-class', //your custom CSS class
                          category: ' First Class'
                        },
                        e: {
                          price   : 40,
                          classes : 'economy-class', //your custom CSS class
                          category: 'Economy Class'
                        }         
                      
                      },
                      naming : {
                        top : false,
                        getLabel : function (character, row, column) {
                          return firstSeatLabel++;
                        },
                      },
                      legend : {
                        node : $('#legend'),
                        items : [
                          [ 'f', 'unavailable',   'Driver' ],
                          [ 'e', 'available',   'Available'],
                          [ 'e', 'unavailable', 'Already Booked']
                        ]         
                      },
                      click: function () {
                        if (this.status() == 'available') {
                          //let's create a new <li> which we'll add to the cart items
                          $('<li>'+this.data().category+' : Seat no '+this.settings.label+': <b>$'+this.data().price+'</b> <a href="#" class="cancel-cart-item">[cancel]</a></li>')
                            .attr('id', 'cart-item-'+this.settings.id)
                            .data('seatId', this.settings.id)
                            .appendTo($cart);
                          
                          /*
                           * Lets update the counter and total
                           *
                           * .find function will not find the current seat, because it will change its stauts only after return
                           * 'selected'. This is why we have to add 1 to the length and the current seat price to the total.
                           */
                          $counter.text(sc.find('selected').length+1);
                          $total.text(recalculateTotal(sc)+this.data().price);
                          
                          return 'selected';
                        } else if (this.status() == 'selected') {
                          //update the counter
                          $counter.text(sc.find('selected').length-1);
                          //and total
                          $total.text(recalculateTotal(sc)-this.data().price);
                        
                          //remove the item from our cart
                          $('#cart-item-'+this.settings.id).remove();
                        
                          //seat has been vacated
                          return 'available';
                        } else if (this.status() == 'unavailable') {
                          //seat has been already booked
                          return 'unavailable';
                        } else {
                          return this.style();
                        }
                      }
                    });

                    //this will handle "[cancel]" link clicks
                    $('#selected-seats').on('click', '.cancel-cart-item', function () {
                      //let's just trigger Click event on the appropriate seat, so we don't have to repeat the logic here
                      sc.get($(this).parents('li:first').data('seatId')).click();
                    });

                    $('#search').click(function(event){
                      //document.getElementById("1_1").reset();
                      var keberangkatan = document.getElementById('keberangkatan');
                      var tujuan = document.getElementById('tujuan').value;
                      
                      var f = document.getElementById('no_elf');
                      var no_elf = f.options[f.selectedIndex].value;  
                      //clear seat
                      sc.get(["1_1", "1_2", "2_2", "2_3", "2_4", "3_1", "3_3", "3_4", "4_1", "4_3", "4_4", "5_1", "5_2", "5_3", "5_4"]).status('available');
                      sc.get(["1_4"]).status('unavailable');
                      $.ajax({
                      type : "POST",
                      dataType: "json",
                      url : "load/list_it1.php",
                      data : "no_elf="+no_elf+"&tujuan="+tujuan,
                      success : function(result){
                        var hasilDtt = JSON.stringify(result);    
                        //console.log(hasilDtt);
                        //list seat yg sudah di booking
                        //sc.get().status('unavailable');
                        sc.get(JSON.parse(hasilDtt)).status('unavailable');
                        }
                      });
                    });

                    $("#book").click(function(event){
                      if (confirm('Apakah anda yakin memilih kursi ini ?')){
                        var keberangkatan = document.getElementById('keberangkatan').value;
                        var tujuan = document.getElementById('tujuan').value;
                        
                        var f = document.getElementById('no_elf');
                        var no_elf = f.options[f.selectedIndex].value;

                        var seat = [], item;
                        $.each($('.seatCharts-row div.selected'), function(index, value){
                          item = $(this).attr('id');
                          seat.push(item);
                        });
                        //alert(seat);
                        $.ajax({
                            type: "POST",
                            dataType:"text",
                            url: "proses/reservation_proses.php",
                            data: "seat="+seat+"&no_elf="+no_elf+"&keberangkatan="+keberangkatan+"&tujuan="+tujuan,
                            complete: function () {
                              },
                            success: function (msg) {      
                                alert("Silahkan Lihat Menu My Reservation untuk melihat Hasil Booking");
                                document.location="myrsvp.php";
                              },
                          });   
                        } 
                    });
                
                });

                function recalculateTotal(sc) {
                  var total = 0;
                
                  //basically find every selected seat and sum its price
                  sc.find('selected').each(function () {
                    total += this.data().price;
                  });
                  
                  return total;
                }
              </script>
            </div>
          </div>
        </section>
        <section class="col-lg-12 connectedSortable" id="seat2" style="display: none;">
          <!-- quick email widget -->
          <div class="box box-info" style="border-top-color: #ffffff;">
            SEAT 2
          </div>
        </section>
        <!-- /.Left col -->
        <!-- right col (We are only adding the ID to make the widgets sortable)-->
        <!-- right col -->
      </div>
      <!-- /.row (main row) -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <?php include('footer.php'); ?>
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->
<?php include('tracking.php'); ?>
<script src="assets/js/jquery.nicescroll.js"></script>
<script src="assets/js/scripts.js"></script>

</body>
</html>
