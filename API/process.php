 <?php
include('function.php');
if(isset($_REQUEST['action']) && $_REQUEST['action']=='user_signup')
{
 $obj = new Cerber_taxi();
 $obj->user_signup();
}
elseif(isset($_REQUEST['action']) && $_REQUEST['action']=='fetch_pincode_list')
{
 $obj = new Cerber_taxi();
 $obj->fetch_pincode_list();
}
elseif(isset($_REQUEST['action']) && $_REQUEST['action']=='fetch_package_list')
{
 $obj = new Cerber_taxi();
 $obj->fetch_package_list();
}
elseif(isset($_REQUEST['action']) && $_REQUEST['action']=='fetch_vehicle_list')
{
 $obj = new Cerber_taxi();
 $obj->fetch_vehicle_list();
}
elseif(isset($_REQUEST['action']) && $_REQUEST['action']=='driver_add_vehicle')
{
 $obj = new Cerber_taxi();
 $obj->driver_add_vehicle();
}
elseif(isset($_REQUEST['action']) && $_REQUEST['action']=='driver_add_bank_details')
{
 $obj = new Cerber_taxi();
 $obj->driver_add_bank_details();
}
elseif(isset($_REQUEST['action']) && $_REQUEST['action']=='driver_login')
{
 $obj = new Cerber_taxi();
 $obj->driver_login();
}
elseif(isset($_REQUEST['action']) && $_REQUEST['action']=='driver_logout')
{
 $obj = new Cerber_taxi();
 $obj->driver_logout();
}
elseif(isset($_REQUEST['action']) && $_REQUEST['action']=='user_login')
{
 $obj = new Cerber_taxi();
 $obj->user_login();
}
elseif(isset($_REQUEST['action']) && $_REQUEST['action']=='user_logout')
{
 $obj = new Cerber_taxi();
 $obj->user_logout();
}
elseif(isset($_REQUEST['action']) && $_REQUEST['action']=='send_driver_otp')
{
 $obj = new Cerber_taxi();
 $obj->send_driver_otp();
}
elseif(isset($_REQUEST['action']) && $_REQUEST['action']=='driver_otp_verification')
{
 $obj = new Cerber_taxi();
 $obj->driver_otp_verification();
}
elseif(isset($_REQUEST['action']) && $_REQUEST['action']=='change_driver_password')
{
 $obj = new Cerber_taxi();
 $obj->change_driver_password();
}
elseif(isset($_REQUEST['action']) && $_REQUEST['action']=='update_user_password')
{
 $obj = new Cerber_taxi();
 $obj->update_user_password();
}
elseif(isset($_REQUEST['action']) && $_REQUEST['action']=='fetch_driver_detail')
{
 $obj = new Cerber_taxi();
 $obj->fetch_driver_detail();
}
elseif(isset($_REQUEST['action']) && $_REQUEST['action']=='update_driver_profile')
{
 $obj = new Cerber_taxi();
 $obj->update_driver_profile();
}
elseif(isset($_REQUEST['action']) && $_REQUEST['action']=='update_driver_profile_image')
{
 $obj = new Cerber_taxi();
 $obj->update_driver_profile_image();
}
elseif(isset($_REQUEST['action']) && $_REQUEST['action']=='fetch_user_detail')
{
 $obj = new Cerber_taxi();
 $obj->fetch_user_detail();
}
elseif(isset($_REQUEST['action']) && $_REQUEST['action']=='update_userdevice_id')
{
 $obj = new Cerber_taxi();
 $obj->update_userdevice_id();
}
elseif(isset($_REQUEST['action']) && $_REQUEST['action']=='update_user_profile')
{
 $obj = new Cerber_taxi();
 $obj->update_user_profile();
}
elseif(isset($_REQUEST['action']) && $_REQUEST['action']=='update_user_profile_image')
{
 $obj = new Cerber_taxi();
 $obj->update_user_profile_image();
}
elseif(isset($_REQUEST['action']) && $_REQUEST['action']=='fetch_vehicle_type_list')
{
 $obj = new Cerber_taxi();
 $obj->fetch_vehicle_type_list();
}
elseif(isset($_REQUEST['action']) && $_REQUEST['action']=='fetch_user_wallet')
{
 $obj = new Cerber_taxi();
 $obj->fetch_user_wallet();
}
elseif(isset($_REQUEST['action']) && $_REQUEST['action']=='fetch_driver_wallet')
{
 $obj = new Cerber_taxi();
 $obj->fetch_driver_wallet();
}
elseif(isset($_REQUEST['action']) && $_REQUEST['action']=='fetch_driver_wallet_transaction_history')
{
 $obj = new Cerber_taxi();
 $obj->fetch_driver_wallet_transaction_history();
}
elseif(isset($_REQUEST['action']) && $_REQUEST['action']=='fetch_online_driver_list')
{
 $obj = new Cerber_taxi();
 $obj->fetch_online_driver_list();
}
elseif(isset($_REQUEST['action']) && $_REQUEST['action']=='fetch_online_driver_list1')
{
 $obj = new Cerber_taxi();
 $obj->fetch_online_driver_list1();
}
elseif(isset($_REQUEST['action']) && $_REQUEST['action']=='fetch_coupon_list')
{
 $obj = new Cerber_taxi();
 $obj->fetch_coupon_list();
}
elseif(isset($_REQUEST['action']) && $_REQUEST['action']=='fetch_user_notification_list')
{
 $obj = new Cerber_taxi();
 $obj->fetch_user_notification_list();
}
elseif(isset($_REQUEST['action']) && $_REQUEST['action']=='delete_user_notification')
{
 $obj = new Cerber_taxi();
 $obj->delete_user_notification();
}
elseif(isset($_REQUEST['action']) && $_REQUEST['action']=='update_driverdevice_id')
{
 $obj = new Cerber_taxi();
 $obj->update_driverdevice_id();
}
elseif(isset($_REQUEST['action']) && $_REQUEST['action']=='update_driver_latlong')
{
 $obj = new Cerber_taxi();
 $obj->update_driver_latlong();
}
elseif(isset($_REQUEST['action']) && $_REQUEST['action']=='user_write_support')
{
 $obj = new Cerber_taxi();
 $obj->user_write_support();
}
elseif(isset($_REQUEST['action']) && $_REQUEST['action']=='fetch_driver_notification_list')
{
 $obj = new Cerber_taxi();
 $obj->fetch_driver_notification_list();
}
elseif(isset($_REQUEST['action']) && $_REQUEST['action']=='delete_driver_notification')
{
 $obj = new Cerber_taxi();
 $obj->delete_driver_notification();
}
elseif(isset($_REQUEST['action']) && $_REQUEST['action']=='add_user_card')
{
 $obj = new Cerber_taxi();
 $obj->add_user_card();
}elseif(isset($_REQUEST['action']) && $_REQUEST['action']=='fetch_user_card')
{
 $obj = new Cerber_taxi();
 $obj->fetch_user_card();
}
elseif(isset($_REQUEST['action']) && $_REQUEST['action']=='delete_user_card')
{
 $obj = new Cerber_taxi();
 $obj->delete_user_card();
}
elseif(isset($_REQUEST['action']) && $_REQUEST['action']=='add_driver_card')
{
 $obj = new Cerber_taxi();
 $obj->add_driver_card();
}
elseif(isset($_REQUEST['action']) && $_REQUEST['action']=='fetch_driver_card')
{
 $obj = new Cerber_taxi();
 $obj->fetch_driver_card();
}
elseif(isset($_REQUEST['action']) && $_REQUEST['action']=='delete_driver_card')
{
 $obj = new Cerber_taxi();
 $obj->delete_driver_card();
}
elseif(isset($_REQUEST['action']) && $_REQUEST['action']=='fetch_user_preffered_company_list')
{
 $obj = new Cerber_taxi();
 $obj->fetch_user_preffered_company_list();
}
elseif(isset($_REQUEST['action']) && $_REQUEST['action']=='fetch_driver_ride_now_list')
{
 $obj = new Cerber_taxi();
 $obj->fetch_driver_ride_now_list();
}
elseif(isset($_REQUEST['action']) && $_REQUEST['action']=='fetch_driver_ride_later_list')
{
 $obj = new Cerber_taxi();
 $obj->fetch_driver_ride_later_list();
}
elseif(isset($_REQUEST['action']) && $_REQUEST['action']=='fetch_user_ride_now_list')
{
 $obj = new Cerber_taxi();
 $obj->fetch_user_ride_now_list();
}
elseif(isset($_REQUEST['action']) && $_REQUEST['action']=='fetch_user_ride_later_list')
{
 $obj = new Cerber_taxi();
 $obj->fetch_user_ride_later_list();
}
elseif(isset($_REQUEST['action']) && $_REQUEST['action']=='driver_intrested_booking_status')
{
 $obj = new Cerber_taxi();
 $obj->driver_intrested_booking_status();
}
elseif(isset($_REQUEST['action']) && $_REQUEST['action']=='driver_cancel_booking_status')
{
 $obj = new Cerber_taxi();
 $obj->driver_cancel_booking_status();
}
elseif(isset($_REQUEST['action']) && $_REQUEST['action']=='user_end_driver_accepted_bid_list')
{
 $obj = new Cerber_taxi();
 $obj->user_end_driver_accepted_bid_list();
}
elseif(isset($_REQUEST['action']) && $_REQUEST['action']=='user_end_driver_accepted_bid_list1')
{
 $obj = new Cerber_taxi();
 $obj->user_end_driver_accepted_bid_list1();
}
elseif(isset($_REQUEST['action']) && $_REQUEST['action']=='user_reject_driver_bid_status')
{
 $obj = new Cerber_taxi();
 $obj->user_reject_driver_bid_status();
}
elseif(isset($_REQUEST['action']) && $_REQUEST['action']=='user_accept_driver_bid_status')
{
 $obj = new Cerber_taxi();
 $obj->user_accept_driver_bid_status();
}
elseif(isset($_REQUEST['action']) && $_REQUEST['action']=='fetch_user_confirm_booking_driver_details')
{
 $obj = new Cerber_taxi();
 $obj->fetch_user_confirm_booking_driver_details();
}
elseif(isset($_REQUEST['action']) && $_REQUEST['action']=='driver_fetch_confirm_booking_user_details')
{
 $obj = new Cerber_taxi();
 $obj->driver_fetch_confirm_booking_user_details();
}
elseif(isset($_REQUEST['action']) && $_REQUEST['action']=='user_cancel_booking')
{
 $obj = new Cerber_taxi();
 $obj->user_cancel_booking();
}
elseif(isset($_REQUEST['action']) && $_REQUEST['action']=='driver_cancel_booking')
{
 $obj = new Cerber_taxi();
 $obj->driver_cancel_booking();
}
elseif(isset($_REQUEST['action']) && $_REQUEST['action']=='driver_update_booking_status')
{
 $obj = new Cerber_taxi();
 $obj->driver_update_booking_status();
}
elseif(isset($_REQUEST['action']) && $_REQUEST['action']=='driver_completed_booking_data')
{
 $obj = new Cerber_taxi();
 $obj->driver_completed_booking_data();
}
elseif(isset($_REQUEST['action']) && $_REQUEST['action']=='fetch_driver_booking_history_list')
{
 $obj = new Cerber_taxi();
 $obj->fetch_driver_booking_history_list();
}
elseif(isset($_REQUEST['action']) && $_REQUEST['action']=='driver_fetch_booking_details')
{
 $obj = new Cerber_taxi();
 $obj->driver_fetch_booking_details();
}
elseif(isset($_REQUEST['action']) && $_REQUEST['action']=='fetch_user_booking_history_list')
{
 $obj = new Cerber_taxi();
 $obj->fetch_user_booking_history_list();
}
elseif(isset($_REQUEST['action']) && $_REQUEST['action']=='fetch_driver_Ride_later_booking_list')
{
 $obj = new Cerber_taxi();
 $obj->fetch_driver_Ride_later_booking_list();
}
elseif(isset($_REQUEST['action']) && $_REQUEST['action']=='driver_start_booking')
{
 $obj = new Cerber_taxi();
 $obj->driver_start_booking();
}
elseif(isset($_REQUEST['action']) && $_REQUEST['action']=='filter_driver_bid_list')
{
 $obj = new Cerber_taxi();
 $obj->filter_driver_bid_list();
}elseif(isset($_REQUEST['action']) && $_REQUEST['action']=='fetch_driver_rating_list')
{
 $obj = new Cerber_taxi();
 $obj->fetch_driver_rating_list();
}
elseif(isset($_REQUEST['action']) && $_REQUEST['action']=='add_driver_complain')
{
 $obj = new Cerber_taxi();
 $obj->add_driver_complain();
}
elseif(isset($_REQUEST['action']) && $_REQUEST['action']=='add_user_complain')
{
 $obj = new Cerber_taxi();
 $obj->add_user_complain();
}
elseif(isset($_REQUEST['action']) && $_REQUEST['action']=='add_driver_panic_notification')
{
 $obj = new Cerber_taxi();
 $obj->add_driver_panic_notification();
}
elseif(isset($_REQUEST['action']) && $_REQUEST['action']=='add_user_panic_notification')
{
 $obj = new Cerber_taxi();
 $obj->add_user_panic_notification();
}
elseif(isset($_REQUEST['action']) && $_REQUEST['action']=='fetch_user_chat_list')
{
    $obj = new Cerber_taxi();
    $obj->fetch_user_chat_list();
}
elseif(isset($_REQUEST['action']) && $_REQUEST['action']=='fetch_driver_chat_list')
{
    $obj = new Cerber_taxi();
    $obj->fetch_driver_chat_list();
}
elseif(isset($_REQUEST['action']) && $_REQUEST['action']=='driver_send_msg')
{
    $obj = new Cerber_taxi();
    $obj->driver_send_msg();
}
elseif(isset($_REQUEST['action']) && $_REQUEST['action']=='user_send_msg')
{
    $obj = new Cerber_taxi();
    $obj->user_send_msg();
}
elseif(isset($_REQUEST['action']) && $_REQUEST['action']=='fetch_driver_send_msg')
{
    $obj = new Cerber_taxi();
    $obj->fetch_driver_send_msg();
}
elseif(isset($_REQUEST['action']) && $_REQUEST['action']=='fetch_user_send_msg')
{
    $obj = new Cerber_taxi();
    $obj->fetch_user_send_msg();
}
elseif(isset($_REQUEST['action']) && $_REQUEST['action']=='insert_driver_rating')
{
    $obj = new Cerber_taxi();
    $obj->insert_driver_rating();
}
elseif(isset($_REQUEST['action']) && $_REQUEST['action']=='add_user_amount')
{
    $obj = new Cerber_taxi();
    $obj->add_user_amount();
}
elseif(isset($_REQUEST['action']) && $_REQUEST['action']=='fetch_user_amount_transaction_list')
{
    $obj = new Cerber_taxi();
    $obj->fetch_user_amount_transaction_list();
}
elseif(isset($_REQUEST['action']) && $_REQUEST['action']=='driver_login_recheck')
{
    $obj = new Cerber_taxi();
    $obj->driver_login_recheck();
}
elseif(isset($_REQUEST['action']) && $_REQUEST['action']=='driver_signup_recheck')
{
    $obj = new Cerber_taxi();
    $obj->driver_signup_recheck();
}
elseif(isset($_REQUEST['action']) && $_REQUEST['action']=='driver_write_support')
{
 $obj = new Cerber_taxi();
 $obj->driver_write_support();
}
elseif(isset($_REQUEST['action']) && $_REQUEST['action']=='coupon_validation')
{
 $obj = new Cerber_taxi();
 $obj->coupon_validation();
}
elseif(isset($_REQUEST['action']) && $_REQUEST['action']=='update_userlatlong')
{
 $obj = new Cerber_taxi();
 $obj->update_userlatlong();
}
elseif(isset($_REQUEST['action']) && $_REQUEST['action']=='update_driverlatlong')
{
 $obj = new Cerber_taxi();
 $obj->update_driverlatlong();
}
elseif(isset($_REQUEST['action']) && $_REQUEST['action']=='tantative_booking_price')
{
 $obj = new Cerber_taxi();
 $obj->tantative_booking_price();
}
elseif(isset($_REQUEST['action']) && $_REQUEST['action']=='delete_user')
{
 $obj = new Cerber_taxi();
 $obj->delete_user();
}
elseif(isset($_REQUEST['action']) && $_REQUEST['action']=='delete_driver')
{
 $obj = new Cerber_taxi();
 $obj->delete_driver();
}
elseif(isset($_REQUEST['action']) && $_REQUEST['action']=='social_login_fb_gmail')
{
 $obj = new Cerber_taxi();
 $obj->social_login_fb_gmail();
}
elseif(isset($_REQUEST['action']) && $_REQUEST['action']=='fetch_package_price')
{
 $obj = new Cerber_taxi();
 $obj->fetch_package_price();
}
elseif(isset($_REQUEST['action']) && $_REQUEST['action']=='user_booking')
{
 $obj = new Cerber_taxi();
 $obj->user_booking();
}
?>