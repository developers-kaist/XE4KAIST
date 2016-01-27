<?php
function sign($return)
{
    $salt = "";

    $oContext = &Context::getInstance();
    $oContext->init();

    $oModuleModel = &getModel('module');
    $oModuleModel->loadModuleExtends();

    $oMemberModel = &getModel('member');
    $oMemberController = &getController('member');

    $return->user_id = split('@', $return->mail)[0];
    $return->user_pw = md5($salt.$return->mail);

    if($oMemberModel->getMemberInfoByUserID($return->user_id))
    {
        $result = $oMemberController->procMemberLogin($user_id = $return->user_id, $password = $return->user_pw, $keep_signed = null);

        header("Location: /");
    }
    else
    {
        $oMemberController->insertMember(formatPortalDataIntoMemberInfo($return));
        $result = $oMemberController->procMemberLogin($user_id = $return->user_id, $password = $return->user_pw, $keep_signed = null);

        header("Location: /");
    }

    return $result;
}

function formatPortalDataIntoMemberInfo($return) {
    if($return->ku_kname)
    {
        $user_name = $return->ku_kname;
    }
    else
    {
        $user_name = $return->displayname;
    }

    $info = new stdClass();
    $info->user_id = $return->user_id;
    $info->email_address = $return->mail;
    $info->password = $return->user_pw;
    $info->email_id = $return->user_id;
    $info->email_host = split('@', $return->mail)[1];
    $info->user_name = $user_name;
    $info->nick_name = $return->user_id;
    $info->student_id = $return->ku_std_no;
    $info->gender = $return->ku_sex;
    $info->department = $return->ku_acad_name;
    $info->degree = $return->ku_acad_prog;
    $info->cellphone = $return->mobile;
    if($return->ku_person_type_kor == '학생')
    {
        $info->is_student = 1;  
    }
    else
    {
        $info->is_student = 0;
    }

    return $info;
}
?>
