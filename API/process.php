 <?php
include('function.php');
if(isset($_REQUEST['action']) && $_REQUEST['action']=='user_login')
{
 $obj = new Sender();
 $obj->user_login();
}
elseif(isset($_REQUEST['action']) && $_REQUEST['action']=='user_logout')
{
 $obj = new Sender();
 $obj->user_logout();
}
elseif(isset($_REQUEST['action']) && $_REQUEST['action']=='user_signup')
{
 $obj = new Sender();
 $obj->user_signup();
}
elseif(isset($_REQUEST['action']) && $_REQUEST['action']=='update_userdevice_id')
{
 $obj = new Sender();
 $obj->update_userdevice_id();
}
elseif(isset($_REQUEST['action']) && $_REQUEST['action']=='update_user_password')
{
 $obj = new Sender();
 $obj->update_user_password();
}
elseif(isset($_REQUEST['action']) && $_REQUEST['action']=='fetch_vehicle_type_list')
{
 $obj = new Sender();
 $obj->fetch_vehicle_type_list();
}
elseif(isset($_REQUEST['action']) && $_REQUEST['action']=='fetch_package_price')
{
 $obj = new Sender();
 $obj->fetch_package_price();
}
elseif(isset($_REQUEST['action']) && $_REQUEST['action']=='fetch_coupon_list')
{
 $obj = new Sender();
 $obj->fetch_coupon_list();
}
elseif(isset($_REQUEST['action']) && $_REQUEST['action']=='coupon_validation')
{
 $obj = new Sender();
 $obj->coupon_validation();
}
elseif(isset($_REQUEST['action']) && $_REQUEST['action']=='user_booking')
{
 $obj = new Sender();
 $obj->user_booking();
}
elseif(isset($_REQUEST['action']) && $_REQUEST['action']=='fetch_user_ride_now_list')
{
 $obj = new Sender();
 $obj->fetch_user_ride_now_list();
}
elseif(isset($_REQUEST['action']) && $_REQUEST['action']=='fetch_user_ride_later_list')
{
 $obj = new Sender();
 $obj->fetch_user_ride_later_list();
}
elseif(isset($_REQUEST['action']) && $_REQUEST['action']=='user_cancel_booking')
{
 $obj = new Sender();
 $obj->user_cancel_booking();
}
elseif(isset($_REQUEST['action']) && $_REQUEST['action']=='fetch_user_booking_history_list')
{
 $obj = new Sender();
 $obj->fetch_user_booking_history_list();
}
elseif(isset($_REQUEST['action']) && $_REQUEST['action']=='insert_driver_rating')
{
    $obj = new Sender();
    $obj->insert_driver_rating();
}
elseif(isset($_REQUEST['action']) && $_REQUEST['action']=='fetch_user_notification_list')
{
 $obj = new Sender();
 $obj->fetch_user_notification_list();
}
elseif(isset($_REQUEST['action']) && $_REQUEST['action']=='delete_user_notification')
{
 $obj = new Sender();
 $obj->delete_user_notification();
}
elseif(isset($_REQUEST['action']) && $_REQUEST['action']=='fetch_user_detail')
{
 $obj = new Sender();
 $obj->fetch_user_detail();
}
elseif(isset($_REQUEST['action']) && $_REQUEST['action']=='update_user_profile')
{
 $obj = new Sender();
 $obj->update_user_profile();
}
elseif(isset($_REQUEST['action']) && $_REQUEST['action']=='update_user_profile_image')
{
 $obj = new Sender();
 $obj->update_user_profile_image();
}
elseif(isset($_REQUEST['action']) && $_REQUEST['action']=='fetch_user_send_msg')
{
    $obj = new Sender();
    $obj->fetch_user_send_msg();
}
elseif(isset($_REQUEST['action']) && $_REQUEST['action']=='user_send_msg')
{
    $obj = new Sender();
    $obj->user_send_msg();
}
elseif(isset($_REQUEST['action']) && $_REQUEST['action']=='fetch_user_chat_list')
{
    $obj = new Sender();
    $obj->fetch_user_chat_list();
}
elseif(isset($_REQUEST['action']) && $_REQUEST['action']=='user_write_support')
{
 $obj = new Sender();
 $obj->user_write_support();
}
elseif(isset($_REQUEST['action']) && $_REQUEST['action']=='delete_user')
{
 $obj = new Sender();
 $obj->delete_user();
}
elseif(isset($_REQUEST['action']) && $_REQUEST['action']=='add_user_complain')
{
 $obj = new Sender();
 $obj->add_user_complain();
}
elseif(isset($_REQUEST['action']) && $_REQUEST['action']=='update_userlatlong')
{
 $obj = new Sender();
 $obj->update_userlatlong();
}



////////////////////////DRIVER API DATA///////////////////////

elseif(isset($_REQUEST['action']) && $_REQUEST['action']=='fetch_pincode_list')
{
 $obj = new Sender();
 $obj->fetch_pincode_list();
}
elseif(isset($_REQUEST['action']) && $_REQUEST['action']=='driver_login')
{
 $obj = new Sender();
 $obj->driver_login();
}
elseif(isset($_REQUEST['action']) && $_REQUEST['action']=='change_driver_password')
{
 $obj = new Sender();
 $obj->change_driver_password();
}
elseif(isset($_REQUEST['action']) && $_REQUEST['action']=='driver_logout')
{
 $obj = new Sender();
 $obj->driver_logout();
}
elseif(isset($_REQUEST['action']) && $_REQUEST['action']=='driver_login_recheck')
{
    $obj = new Sender();
    $obj->driver_login_recheck();
}
elseif(isset($_REQUEST['action']) && $_REQUEST['action']=='delete_driver')
{
 $obj = new Sender();
 $obj->delete_driver();
}
elseif(isset($_REQUEST['action']) && $_REQUEST['action']=='driver_fetch_all_ride_now_booking')
{
 $obj = new Sender();
 $obj->driver_fetch_all_ride_now_booking();
}
elseif(isset($_REQUEST['action']) && $_REQUEST['action']=='driver_fetch_all_ride_later_booking')
{
 $obj = new Sender();
 $obj->driver_fetch_all_ride_later_booking();
}
elseif(isset($_REQUEST['action']) && $_REQUEST['action']=='update_driver_route_list')
{
    $obj = new Sender();
    $obj->update_driver_route_list();
}
elseif(isset($_REQUEST['action']) && $_REQUEST['action']=='update_driverdevice_id')
{
 $obj = new Sender();
 $obj->update_driverdevice_id();
}
elseif(isset($_REQUEST['action']) && $_REQUEST['action']=='update_driver_latlong')
{
 $obj = new Sender();
 $obj->update_driver_latlong();
}
elseif(isset($_REQUEST['action']) && $_REQUEST['action']=='fetch_driver_detail')
{
 $obj = new Sender();
 $obj->fetch_driver_detail();
}
elseif(isset($_REQUEST['action']) && $_REQUEST['action']=='update_driver_profile')
{
 $obj = new Sender();
 $obj->update_driver_profile();
}
elseif(isset($_REQUEST['action']) && $_REQUEST['action']=='update_driver_profile_image')
{
 $obj = new Sender();
 $obj->update_driver_profile_image();
}
elseif(isset($_REQUEST['action']) && $_REQUEST['action']=='fetch_driver_notification_list')
{
 $obj = new Sender();
 $obj->fetch_driver_notification_list();
}
elseif(isset($_REQUEST['action']) && $_REQUEST['action']=='delete_driver_notification')
{
 $obj = new Sender();
 $obj->delete_driver_notification();
}
elseif(isset($_REQUEST['action']) && $_REQUEST['action']=='driver_completed_booking_data')
{
 $obj = new Sender();
 $obj->driver_completed_booking_data();
}
elseif(isset($_REQUEST['action']) && $_REQUEST['action']=='fetch_driver_booking_history_list')
{
 $obj = new Sender();
 $obj->fetch_driver_booking_history_list();
}
elseif(isset($_REQUEST['action']) && $_REQUEST['action']=='fetch_driver_ride_now_list')
{
 $obj = new Sender();
 $obj->fetch_driver_ride_now_list();
}
elseif(isset($_REQUEST['action']) && $_REQUEST['action']=='fetch_driver_ride_later_list')
{
 $obj = new Sender();
 $obj->fetch_driver_ride_later_list();
}

elseif(isset($_REQUEST['action']) && $_REQUEST['action']=='driver_intrested_booking_status')
{
 $obj = new Sender();
 $obj->driver_intrested_booking_status();
}
elseif(isset($_REQUEST['action']) && $_REQUEST['action']=='driver_cancel_booking_status')
{
 $obj = new Sender();
 $obj->driver_cancel_booking_status();
}
elseif(isset($_REQUEST['action']) && $_REQUEST['action']=='update_driverlatlong')
{
 $obj = new Sender();
 $obj->update_driverlatlong();
}
elseif(isset($_REQUEST['action']) && $_REQUEST['action']=='driver_update_booking_status')
{
 $obj = new Sender();
 $obj->driver_update_booking_status();
}
elseif(isset($_REQUEST['action']) && $_REQUEST['action']=='driver_fetch_booking_details')
{
 $obj = new Sender();
 $obj->driver_fetch_booking_details();
}
elseif(isset($_REQUEST['action']) && $_REQUEST['action']=='driver_start_booking')
{
 $obj = new Sender();
 $obj->driver_start_booking();
}
elseif(isset($_REQUEST['action']) && $_REQUEST['action']=='driver_cancel_booking')
{
 $obj = new Sender();
 $obj->driver_cancel_booking();
}
elseif(isset($_REQUEST['action']) && $_REQUEST['action']=='driver_fetch_cancelled_booking_list')
{
 $obj = new Sender();
 $obj->driver_fetch_cancelled_booking_list();
}
elseif(isset($_REQUEST['action']) && $_REQUEST['action']=='fetch_driver_rating_list')
{
 $obj = new Sender();
 $obj->fetch_driver_rating_list();
}
elseif(isset($_REQUEST['action']) && $_REQUEST['action']=='driver_write_support')
{
 $obj = new Sender();
 $obj->driver_write_support();
}
elseif(isset($_REQUEST['action']) && $_REQUEST['action']=='add_driver_complain')
{
 $obj = new Sender();
 $obj->add_driver_complain();
}
elseif(isset($_REQUEST['action']) && $_REQUEST['action']=='fetch_driver_chat_list')
{
    $obj = new Sender();
    $obj->fetch_driver_chat_list();
}
elseif(isset($_REQUEST['action']) && $_REQUEST['action']=='driver_send_msg')
{
    $obj = new Sender();
    $obj->driver_send_msg();
}

elseif(isset($_REQUEST['action']) && $_REQUEST['action']=='fetch_driver_send_msg')
{
    $obj = new Sender();
    $obj->fetch_driver_send_msg();
}

?>