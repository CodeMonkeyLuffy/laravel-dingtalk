<?php

namespace DingTalk\Message;

use DingTalk\Kernel\BaseClient;

class Client extends BaseClient
{
    /**
     * 发送工作通知
     * @param string $agent_id 应用agentId
     * @param string $msg 消息内容 https://ding-doc.dingtalk.com/doc#/serverapi2/ye8tup
     * @param string $userid_list 接收者的企业内部用户的userid列表，最大用户列表长度：100
     * @param string $dept_id_list 接收者的部门id列表
     */
    public function asyncsend_v2($agent_id, $msg, $to_all_user = false, $dept_id_list = null, $userid_list = null)
    {
        if (!empty($userid_list)) {
            $data["userid_list"] = $userid_list;
        }

        if (!empty($dept_id_list)) {
            $data["dept_id_list"] = $dept_id_list;
        }
        if (!empty($to_all_user)) {
            $data["to_all_user"] = $to_all_user;
        }
        $data["agent_id"] = $agent_id;
        $data["msg"] = json_encode($msg);
        return $this->client->httpAuthGet('topapi/message/corpconversation/asyncsend_v2', $data);
    }
}
