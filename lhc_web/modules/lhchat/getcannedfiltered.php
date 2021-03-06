<?php
$chat = erLhcoreClassChat::getSession()->load('erLhcoreClassModelChat', $Params['user_parameters']['chat_id']);

if (erLhcoreClassChat::hasAccessToRead($chat)) {
    $nameSupport = (string) erLhcoreClassUser::instance()->getUserData(true)->name_support;

    $grouped = erLhcoreClassModelCannedMsg::groupItems(erLhcoreClassModelCannedMsg::getCannedMessages($chat->dep_id, erLhcoreClassUser::instance()->getUserID(), array(
        'q' => (isset($_GET['q']) ? $_GET['q'] : '')
    )), $chat, $nameSupport);

    $tpl = erLhcoreClassTemplate::getInstance('lhchat/part/canned_messages_options.tpl.php');
    $tpl->set('canned_options',$grouped);

    echo json_encode(array(
        'error' => false,
        'result' => $tpl->fetch()
    ));

} else {
    echo json_encode(array(
        'error' => true,
        'result' => 'no permission'
    ));
}

exit();

?>