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
    $startTime = $_POST['startTime'];
    $endTime = $_POST['endTime'];
    $capacityDemand = $_POST['capacityRoom'];

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

        $selectSQL_reservation =  $wpdb->get_results( "SELECT * FROM $rooms_reservation_table WHERE groupId = '$groupID' AND roomId = '$roomID' AND startTime = '$startTime' AND endTime = '$endTime'" );

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