<?php
/**
 * Created by IntelliJ IDEA.
 * User: rsaado
 * Date: 6/13/2016
 * Time: 14:07
 */

//include WP content
$parse_uri = explode( 'wp-content', $_SERVER['SCRIPT_FILENAME'] );
require_once( $parse_uri[0] . 'wp-load.php' );

global $wpdb;

//get rooms table
$rooms_options_table = $wpdb->prefix . "bookme_rooms_options";

//get the table name we want to work with
$rooms_reservation_table = $wpdb->prefix . "bookme_room_reservation";


if($_POST[searchByServices] == true)
{
    $servicesArray = $_POST['servicesArray'];
    $groupID = $_POST['groupId'];
    $dateString = $_POST['dateString'];
    $startTimeDouble = $_POST['startTimeDouble'];
    $endTimeDouble = $_POST['endTimeDouble'];
    $capacityDemand = $_POST['capacityRoom'];
    $reservationDay = $_POST['day'];

    $roomsMatchedByServices = array();
    //get rooms
    $selectSQL_rooms =  $wpdb->get_results( "SELECT * FROM $rooms_options_table WHERE groupId = '$groupID'" );

    foreach($selectSQL_rooms as $value)
    {
        $roomID = $value -> roomId;
        $roomName = $value -> roomName;
        $roomCapacitiy = $value -> capacity;

        if($capacityDemand > $roomCapacitiy)
            continue;


        $roomActiveDays = unserialize($value -> activeDays);
        if($roomActiveDays[$reservationDay] != 1)
           continue;

        $selectSQL_reservation =  $wpdb->get_results( "SELECT * FROM $rooms_reservation_table WHERE groupId = '$groupID' 
                        AND roomId = '$roomID' AND resDate ='$dateString' AND ((startDoubleTime <= '$startTimeDouble' AND endDoubleTime >= '$endTimeDouble')
                        OR (startDoubleTime > '$startTimeDouble' AND endDoubleTime < '$endTimeDouble') 
                        OR (startDoubleTime > '$startTimeDouble' AND endDoubleTime >= '$endTimeDouble' AND startDoubleTime < '$endTimeDouble')
                        OR (endDoubleTime < '$endTimeDouble' AND startDoubleTime <= '$startTimeDouble' AND endDoubleTime > '$startTimeDouble'))" );


        if(sizeof($selectSQL_reservation) > 0)
            continue;
        
        $servicesOfRoom = unserialize($value -> services);

        $isRoomMatched = true;
        for($i =0; $i < sizeof($servicesArray); $i++)
        {
            if($servicesOfRoom[$servicesArray[$i]] != 1)
                $isRoomMatched = false;
        }
        if($isRoomMatched == true)
        {
            array_push($roomsMatchedByServices, $roomName);
        }


    }
    echo json_encode($roomsMatchedByServices);
}