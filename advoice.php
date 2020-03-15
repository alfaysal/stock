<?php 

  include("server.php");
  include('session_security.php');

  function numberTowords($num)
  {

        $ones = array(
            0 =>"ZERO",
            1 => "ONE",
            2 => "TWO",
            3 => "THREE",
            4 => "FOUR",
            5 => "FIVE",
            6 => "SIX",
            7 => "SEVEN",
            8 => "EIGHT",
            9 => "NINE",
            10 => "TEN",
            11 => "ELEVEN",
            12 => "TWELVE",
            13 => "THIRTEEN",
            14 => "FOURTEEN",
            15 => "FIFTEEN",
            16 => "SIXTEEN",
            17 => "SEVENTEEN",
            18 => "EIGHTEEN",
            19 => "NINETEEN",
            "014" => "FOURTEEN"
        );
        $tens = array( 
            0 => "ZERO",
            1 => "TEN",
            2 => "TWENTY",
            3 => "THIRTY", 
            4 => "FORTY", 
            5 => "FIFTY", 
            6 => "SIXTY", 
            7 => "SEVENTY", 
            8 => "EIGHTY", 
            9 => "NINETY" 
        ); 
        $hundreds = array(    
          "HUNDRED", 
          "THOUSAND", 
          "MILLION", 
          "BILLION", 
          "TRILLION", 
          "QUARDRILLION" 
        ); /*limit t quadrillion */
        $num = number_format($num,2,".",","); 
        $num_arr = explode(".",$num); 
        $wholenum = $num_arr[0]; 
        $decnum = $num_arr[1]; 
        $whole_arr = array_reverse(explode(",",$wholenum)); 
        krsort($whole_arr,1); 
        $rettxt = ""; 
        foreach($whole_arr as $key => $i){
          
        while(substr($i,0,1)=="0")
            $i=substr($i,1,5);
        if($i < 20){ 
        /* echo "getting:".$i; */
        $rettxt .= $ones[$i]; 
        }elseif($i < 100){ 
        if(substr($i,0,1)!="0")  $rettxt .= $tens[substr($i,0,1)]; 
        if(substr($i,1,1)!="0") $rettxt .= " ".$ones[substr($i,1,1)]; 
        }else{ 
        if(substr($i,0,1)!="0") $rettxt .= $ones[substr($i,0,1)]." ".$hundreds[0]; 
        if(substr($i,1,1)!="0")$rettxt .= " ".$tens[substr($i,1,1)]; 
        if(substr($i,2,1)!="0")$rettxt .= " ".$ones[substr($i,2,1)]; 
        } 
        if($key > 0){ 
        $rettxt .= " ".$hundreds[$key]." "; 
        }
        } 
        if($decnum > 0){
        $rettxt .= " and ";
        if($decnum < 20){
        $rettxt .= $ones[$decnum];
        }elseif($decnum < 100){
        $rettxt .= $tens[substr($decnum,0,1)];
        $rettxt .= " ".$ones[substr($decnum,1,1)];
        }
        }
        return $rettxt;
}

 ?>



<!DOCTYPE html>
<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>advoice</title>
	<link rel="stylesheet" type="text/css" href="styleadvoice.css">
	<style type="text/css">
		
	@font-face { font-family: kalpurush; src: url('fonts/kalpurush.ttf'); } 
      body {
         font-family: kalpurush;
         font-size: 14px;
      }

*{
	margin:0px;
	padding:0px;
}

.container{
	width:595px;
	height: 842px;
	padding:10px;
	margin-left: auto;
	margin-right: auto;
	background:#f58297;
}
.container2{
	width:595px;
	height: 842px;
	padding:10px;
	margin-left: auto;
	margin-right: auto;
	background:#f5ef82;
}

.container3{
  width:595px;
  height: 842px;
  padding:10px;
  margin-left: auto;
  margin-right: auto;
  background:#37dbde;
}
.innerfirst{
	display: inline-block;
}
.second{
	width:595px;
	height: 110px;
}
.left{
	float: left;
	margin-right: 20px;
}

.what{
	margin-left: 30px;
	float: right;
}
.middle{
	height: 230px;
	width:550px;
}
	</style>
</head>
<body>


  <?php
        $sql="SELECT chalan from pro_given where pro_giv_id=(select max(pro_giv_id) from pro_given where zone_code='".$_SESSION["zone_code"]."')";
        $run=mysqli_query($db_con,$sql);
        $result = mysqli_fetch_assoc($run);
        $chalan = $result["chalan"];

        $sql2="SELECT bi.brance_name,pg.give_date,pg.emp_id,pg.advice from pro_given pg inner join brance_info bi
               where pg.brance_code=bi.brance_code  
               and pg.chalan='$chalan'";

        $sqlemp="SELECT e.emp_name from emp_table e where e.emp_id 
in (select distinct(pg1.emp_id) from pro_given pg1 where pg1.chalan='$chalan')";

        $run2=mysqli_query($db_con,$sql2);
        $result2 = mysqli_fetch_assoc($run2);
        $brance_code = $result2["brance_name"];
        $give_date = $result2["give_date"];
        $advice = $result2["advice"];

        $runemp=mysqli_query($db_con,$sqlemp);
        $resultemp = mysqli_fetch_assoc($runemp);
        $emp_id = $resultemp["emp_name"];
        
    ?>



	<div class="container">
        		<div class="firstline">
        				<p style="float: left; margin-right: 150px;">অ:ফ: 180</p>
        				<div class="innerfirst">
        					<label>ট্রান্স কোড:</label>
        					<table border="1px solid" >
        						<td width="60px" height="25px">

        						</td>
        						<td  width="60px" height="25px">
        						</td>
        					</table>
        				</div>
        					<h2 style="float: right; margin-left:150px; ">অফিস কপি</h2>
        		</div>
            <div>
              <h1 style="text-align: center">রুপালি ব্যাংক লিঃ</h1>
            </div>
            <div class="second">
                <div class="left">
                  <label>প্রারক:................<?php echo $brance_code  ?>........................শাখা</label><br><br>
                  <label>প্রাপক:........................................শাখা</label><br>
                  
                </div>
                   <div class="what">
                      <label>এডভাইস নং: <?php echo $advice ?></label><br>
                      <label>প্রসঙ্গ নং:</label><br>
                      <label>তারিখ: </label>
                      <table border="1px solid" >
                                <?php echo $give_date; ?>
                          </table>
                    </div>
                      <div class="center">
                    <table border="1px solid" >
                        <td width="40px" height="25px">
                          
                        </td>
                        <td  width="40px" height="25px">
                        </td>

                        <td  width="40px" height="25px">
                        </td>

                        <td  width="40px" height="25px">
                        </td>
                      </table>
                      <table border="1px solid" >
                        <td width="40px" height="25px">

                        </td>
                        <td  width="40px" height="25px">
                        </td>

                        <td  width="40px" height="25px">
                        </td>

                        <td  width="40px" height="25px">
                        </td>
                      </table>
                    
                  </div>

                </div>
                <hr>
                <hr>

                 <?php
                  $sql4="SELECT sum(lot*quantity)as total2 from pro_given where chalan='$chalan'";
             $run4 = mysqli_query($db_con,$sql4);
             $result4 = mysqli_fetch_assoc($run4);
             $num = $result4["total2"];
             ?>

                <div class="middle">
                  <p style="margin-top: 8px;">আমার অদ্য প্রধান কারযালয়ের হিসাব হইতে : 
                    
                    <?php echo $num; ?>
                    </p>
                  <p style="margin-top: 8px;">(
                    <?php echo numberTowords("$num") ?>
                  টাকা_______________________________________________________________________________________</p>
                  <p>খরচ দেখাইয়াছি তার পূর্ণ বিবরন দেয়া হল :</p>
                  <p style="float: right; margin-top: 110px; margin-right: 60px;">স্বাক্ষর
                  </p>
                  <p style="text-align: center; margin-top:110px;">প্রতিস্বাক্ষর</p>
                </div>
                <hr>
            <div>
              <p style="float:right;">তারিখ:_______________</p>
              <p style="margin-top: 3px;">ডা নং:________________________</p>
              <p style="margin-top: 3px;">লে ফ:________________________</p>
              <h4 style="margin: 6px 0 6px 0;">খরচ প্রধান কার্যালয়ের হিসাব</h4>
              <p>টাকার পরিমান_______________________________________________উপরের বর্ণনানুযায়ী</p>
              <p style="margin-top: 5px;">বিপরীত হিসাব:.............................</p><br><br>
                  <p style="float: right;margin-right: 80px">স্বাক্ষর</p>
                  <p style="text-align: center;">প্রতিস্বাক্ষর</p>
            </div>
                
	</div>
  <br>
  <br>
  <br>
  <br>
<br>
  <br>


  <div class="container2">
            <div class="firstline">
                <p style="float: left; margin-right: 150px;">অ:ফ: 180</p>
                <div class="innerfirst">
                  <label>ট্রান্স কোড:</label>
                  <table border="1px solid" >
                    <td width="60px" height="25px">

                    </td>
                    <td  width="60px" height="25px">
                    </td>
                  </table>
                </div>
                  <h2 style="float: right; margin-left:150px; ">অফিস কপি</h2>
            </div>
            <div>
              <h1 style="text-align: center">রুপালি ব্যাংক লিঃ</h1>
            </div>
            <div class="second">
                <div class="left">
                  <label>প্রারক:..................<?php echo $brance_code  ?>.................শাখা</label><br><br>
                  <label>প্রাপক:........................................শাখা</label><br>
                  
                </div>
                   <div class="what">
                      <label>এডভাইস নং: <?php echo $advice ?></label><br>
                      <label>প্রসঙ্গ নং:</label><br>
                      <label>তারিখ: </label>
                      <table border="1px solid" >
                                <?php echo $give_date; ?>
                          </table>
                    </div>
                      <div class="center">
                    <table border="1px solid" >
                        <td width="40px" height="25px">
                         
                        </td>
                        <td  width="40px" height="25px">
                        </td>

                        <td  width="40px" height="25px">
                        </td>

                        <td  width="40px" height="25px">
                        </td>
                      </table>
                      <table border="1px solid" >
                        <td width="40px" height="25px">

                        </td>
                        <td  width="40px" height="25px">
                        </td>

                        <td  width="40px" height="25px">
                        </td>

                        <td  width="40px" height="25px">
                        </td>
                      </table>
                    
                  </div>

                </div>
                <hr>
                <hr>

                 <?php
                  $sql4="SELECT sum(lot*quantity)as total2 from pro_given where chalan='$chalan'";
             $run4 = mysqli_query($db_con,$sql4);
             $result4 = mysqli_fetch_assoc($run4);
             $num = $result4["total2"];
             ?>

                <div class="middle">
                  <p style="margin-top: 8px;">আমার অদ্য প্রধান কারযালয়ের হিসাব হইতে : 
                  <u><?php echo $num; ?> </u> </p>
                  <p style="margin-top: 8px;">(
                    <?php echo numberTowords("$num") ?>
                  টাকা_______________________________________________________________________________________</p>
                  <p>খরচ দেখাইয়াছি তার পূর্ণ বিবরন দেয়া হল :</p>
                  <p style="float: right; margin-top: 110px; margin-right: 60px;">স্বাক্ষর
                  </p>
                  <p style="text-align: center; margin-top:110px;">প্রতিস্বাক্ষর</p>
                </div>
                <hr>
            <div>
              <p style="float:right;">তারিখ:_______________</p>
              <p style="margin-top: 3px;">ডা নং:________________________</p>
              <p style="margin-top: 3px;">লে ফ:________________________</p>
              <h4 style="margin: 6px 0 6px 0;">খরচ প্রধান কার্যালয়ের হিসাব</h4>
              <p>টাকার পরিমান_______________________________________________উপরের বর্ণনানুযায়ী</p>
              <p style="margin-top: 5px;">বিপরীত হিসাব:.............................</p><br><br>
                  <p style="float: right;margin-right: 80px">স্বাক্ষর</p>
                  <p style="text-align: center;">প্রতিস্বাক্ষর</p>
            </div>
                
  </div>
  <br>
  <br>
    <br>
  <br>
  <br>
  <br>


  <div class="container3">
            <div class="firstline">
                <p style="float: left; margin-right: 150px;">অ:ফ: 180</p>
                <div class="innerfirst">
                  <label>ট্রান্স কোড:</label>
                  <table border="1px solid" >
                    <td width="60px" height="25px">

                    </td>
                    <td  width="60px" height="25px">
                    </td>
                  </table>
                </div>
                  <h2 style="float: right; margin-left:150px; ">অফিস কপি</h2>
            </div>
            <div>
              <h1 style="text-align: center">রুপালি ব্যাংক লিঃ</h1>
            </div>
            <div class="second">
                <div class="left">
                  <label>প্রারক:................<?php echo $brance_code  ?>................শাখা</label><br><br>
                  <label>প্রাপক:........................................শাখা</label><br>
                  
                </div>
                   <div class="what">
                      <label>এডভাইস নং: <?php echo $advice ?></label><br>
                      <label>প্রসঙ্গ নং:</label><br>
                      <label>তারিখ: </label>
                     <table border="1px solid" >
                                <?php echo $give_date; ?>
                          </table>
                    </div>
                      <div class="center">
                    <table border="1px solid" >
                        <td width="40px" height="25px">
                            <?php echo $brance_code  ?>
                        </td>
                        <td  width="40px" height="25px">
                        </td>

                        <td  width="40px" height="25px">
                        </td>

                        <td  width="40px" height="25px">
                        </td>
                      </table>
                      <table border="1px solid" >
                        <td width="40px" height="25px">

                        </td>
                        <td  width="40px" height="25px">
                        </td>

                        <td  width="40px" height="25px">
                        </td>

                        <td  width="40px" height="25px">
                        </td>
                      </table>
                    
                  </div>

                </div>
                <hr>
                <hr>

                 <?php
                  $sql4="SELECT sum(lot*quantity)as total2 from pro_given where chalan='$chalan'";
             $run4 = mysqli_query($db_con,$sql4);
             $result4 = mysqli_fetch_assoc($run4);
             $num = $result4["total2"];
             ?>

                <div class="middle">
                  <p style="margin-top: 8px;">আমার অদ্য প্রধান কারযালয়ের হিসাব হইতে : 
                  <u><?php echo $num; ?> </u> </p>
                  <p style="margin-top: 8px;">(
                    <?php echo numberTowords("$num") ?>
                  টাকা_______________________________________________________________________________________</p>
                  <p>খরচ দেখাইয়াছি তার পূর্ণ বিবরন দেয়া হল :</p>
                  <p style="float: right; margin-top: 110px; margin-right: 60px;">স্বাক্ষর
                  </p>
                  <p style="text-align: center; margin-top:110px;">প্রতিস্বাক্ষর</p>
                </div>
                <hr>
            <div>
              <p style="float:right;">তারিখ:_______________</p>
              <p style="margin-top: 3px;">ডা নং:________________________</p>
              <p style="margin-top: 3px;">লে ফ:________________________</p>
              <h4 style="margin: 6px 0 6px 0;">খরচ প্রধান কার্যালয়ের হিসাব</h4>
              <p>টাকার পরিমান_______________________________________________উপরের বর্ণনানুযায়ী</p>
              <p style="margin-top: 5px;">বিপরীত হিসাব:.............................</p><br><br>
                  <p style="float: right;margin-right: 80px">স্বাক্ষর</p>
                  <p style="text-align: center;">প্রতিস্বাক্ষর</p>
            </div>
                
  </div>




</body>
</html>