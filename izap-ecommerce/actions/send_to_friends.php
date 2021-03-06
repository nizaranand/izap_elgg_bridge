<?php
/**************************************************
* PluginLotto.com                                 *
* Copyrights (c) 2005-2010. iZAP                  *
* All rights reserved                             *
***************************************************
* @author iZAP Team "<support@izap.in>"
* @link http://www.izap.in/
* @version 1.0
* Under this agreement, No one has rights to sell this script further.
* For more information. Contact "Tarun Jangra<tarun@izap.in>"
* For discussion about corresponding plugins, visit http://www.pluginlotto.com/pg/forums/
* Follow us on http://facebook.com/PluginLotto and http://twitter.com/PluginLotto
*/

global $CONFIG;
$attribs = IzapBase::getPostedAttributes();
if (IzapBase::hasFormError()) {
  register_error(elgg_echo("izap_elgg_bridge:error_empty_input_fields"));
  forward($_SERVER['HTTP_REFERER']);
}

if(!filter_var($attribs['send_email'], FILTER_VALIDATE_EMAIL) || !filter_var($attribs['email'], FILTER_VALIDATE_EMAIL)) {
  register_error(elgg_echo('izap-ecommerce:not_valid_email'));
  forward($_SERVER['HTTP_REFERER']);
}

$entity = get_entity($attribs['guid']);
if (!$entity) {
  register_error(elgg_echo('izap-ecommerce:not_valid_entity'));
  forward($_SERVER['HTTP_REFERER']);
}

$params=array();
$params['to']=$attribs['send_email'];
$params['from']=$attribs['email'];
$params['from_username']=$attribs['name'];
$params['subject']="Offer: {$entity->title}";
$params['msg']="
  Hello, {$attribs['send_name']} \n
  I like this post, {$entity->getURL()} & please go through that once.\n
  <p>{$attribs['msg']}</p>
  From:\n
    {$attribs['name']},
    {$attribs['email']}.
  ";
//func_printarray_byizap($params);
$success=IzapBase::sendMail($params);
// send email

// Success message
if($success) {
  system_message(elgg_echo('izap-ecommerce:success_send_to_friend'));
  unset ($_SESSION['postArray']);
} else {
  register_error(elgg_echo('izap-ecommerce:error_send_to_friend'));
}forward($entity->getURL());
