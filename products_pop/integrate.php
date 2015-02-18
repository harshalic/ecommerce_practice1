<?php
    if($_POST["submit"]=="Calculate for microsoft"){
        @$start=$_POST["start"];
        $temp=$start;
        $start_date = date_create($start);
        $temp_start=  date_create($temp);
        $datee=$start_date->format('Y-m-d H:i:s');

        $end_date_cal=$datee[8].$datee[9];
        $end_date_cal=(int)$end_date_cal;
        //var_dump($end_date_cal);
        $current_month=date("m");
        $current_month_days = cal_days_in_month(CAL_GREGORIAN, $current_month, 2015); // 31
        $lastdayofcurrentmonth=new DateTime('last day of this month'); 
        $interval = date_diff($temp_start, $lastdayofcurrentmonth);
        $value_current_month=round((100*$interval->days/$current_month_days),2);
        $total=0;

        $last_month_days=cal_days_in_month(CAL_GREGORIAN, $current_month, 2016);
        $value_last_month=round((100*$end_date_cal/$last_month_days),2);

        $total=$value_current_month +(100*10)+$value_last_month;
        $micro_price=$total;
        //echo $value_last_month;
        $month_distribution=array("feb"=>100,"march"=>100,"april"=>100,"may"=>100,"june"=>100,"july"=>100,"aug"=>100,"sept"=>100,"oct"=>100,"nov"=>100,"dec"=>100,"jan16"=>100,"feb16"=>100);
        $feb=$value_current_month;
        $feb16=$value_last_month;
        
        $month_distribution["feb"]=$feb;
        $month_distribution["feb16"]=$feb16;
        echo '<div id="distribution">';
        
            echo "Total Amount Payable : Rs. $total";
            echo '<table id="microsoft_distribution">';
            foreach($month_distribution as $month=>$amount) 
            {
                echo '<tr><th>'.$month.'</th><th>'.$amount.'</th></tr>';
            }

        echo '</table>';
        echo '</div>';
    
    }

    else if($_POST["submit"]=="order microsoft"){
    //$item = $_POST["submit"];
            //echo "micro price=".$micro_price;
            $name=$_POST["name"];
            $address=$_POST["address"];
            $price=$_POST["price"];
            //echo "$item : $price :$name :$address";
            $con=mysql_connect("localhost","root","");
            $sql="CREATE DATABASE customer";
            @mysql_query($sql,$con);
            
            mysql_select_db("customer");
            $sql1="CREATE TABLE customer_details(name CHAR(30),address CHAR(30),product_buy CHAR(30),status CHAR(30),price CHAR(30))";
            @mysql_query($sql1,$con);
            
            echo "Hello $name"."<br><br>";
            $sql3="INSERT INTO customer_details (name,address ,product_buy,status,price) VALUES ('$name','$address','microsoft','ordered','$price')";
                mysql_query($sql3,$con);
                echo "Thank You for the Ordering product of microsoft";
}

    else if($_POST["submit"]=="Calculate for mcafee"){
        @$feb=$_POST["feb"];
        @$march=$_POST["march"];
        @$april=$_POST["april"];
        @$may=$_POST["may"];
        @$june=$_POST["june"];
        @$july=$_POST["july"];
        @$aug=$_POST["aug"];
        @$sept=$_POST["sept"];
        @$oct=$_POST["oct"];
        @$nov=$_POST["nov"];
        @$dec=$_POST["dec"];
        $array_of_month=array("feb"=>$feb,"march"=>$march,"april"=>$april,"may"=>$may,"june"=>$june,"july"=>$july,"aug"=>$aug,"sept"=>$sept,"oct"=>$oct,"nov"=>$nov,"dec"=>$dec);

        @$jan16=$_POST["jan16"];
        @$feb16=$_POST["feb16"];
        $array_new_yr=array("jan16"=>$jan16,"feb16"=>$feb16);
        
        @$start=$_POST["start"];
        $temp=$start;
        $start_date = date_create($start);
        $temp_start=  date_create($temp);
        $end_date=date_add($start_date, date_interval_create_from_date_string('1 year'));

        $no_of_days_in_month=array();
        $current_month=date("m");
        $current_month_days = cal_days_in_month(CAL_GREGORIAN, $current_month, 2015);

        for ($i=$current_month;$i<=12;$i++){
            $no_of_days_in_month[$i]=cal_days_in_month(CAL_GREGORIAN, $i, 2015);  
        }

        for ($i=1;$i<=$current_month;$i++){
            $no_of_days_in_month_new_yr[$i]=cal_days_in_month(CAL_GREGORIAN, $i, 2016);
        }

        $month_distribution=array();
        $total=0;
        $x=$current_month;
        foreach($array_of_month as $key=>$value){
            $month=round((150*$value/$no_of_days_in_month[$x]),2);
            $total=$total+$month;
            $month_distribution[$key]=$month;
            $x++;
        }

        $x=1;
        $y=$current_month;
        foreach($array_new_yr as $key=>$value){
            if($x<=$y){
                $month=round((150*$value/$no_of_days_in_month_new_yr[$x]),2);
                $total=$total+$month;   
                //echo "hi";
                $month_distribution[$key]=$month;
                $x++;    
            }
        }
        $total=  round(($total),2);
        
        echo '<div id="distribution">';
        echo "Total Amount Payable : Rs. $total";

        //var_dump($month_distribution);
        echo '<table id="mcafee_distribution">';
        foreach($month_distribution as $month=>$amount)
        {
            echo '<tr><th>'.$month.'</th><th>'.$amount.'</th></tr>';
        }      
echo '</table>';
echo '</div>';
}
elseif ($_POST["submit"]=="order mcafee") {
            $name=$_POST["name"];
            $address=$_POST["address"];
            $price=$_POST["price"];
            //echo "$item : $price :$name :$address";
            $con=mysql_connect("localhost","root","");
            $sql="CREATE DATABASE customer";
            @mysql_query($sql,$con);
            
            mysql_select_db("customer");
            $sql1="CREATE TABLE customer_details(name CHAR(30),address CHAR(30),product_buy CHAR(30),status CHAR(30),price CHAR(30))";
            @mysql_query($sql1,$con);
            
            echo "Hello $name"."<br><br>";
            $sql3="INSERT INTO customer_details (name,address ,product_buy,status,price) VALUES ('$name','$address','mcafee','ordered','$price')";
                mysql_query($sql3,$con);
                echo "Thank You for the Ordering product of mcafee";

}