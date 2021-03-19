<?php

namespace DingTalk\User;

use DingTalk\Kernel\BaseClient;

class Client extends BaseClient
{

    /**
     * 获取用户详情
     */
    public function get($userid, $lang = null)
    {
        return $this->client->httpAuthGet('user/get', ['userid' => $userid, "lang" => $lang]);
    }

    /**
     * 获取部门用户userid列表
     */
    public function getDeptMember($deptId, $lang = null)
    {
        return $this->client->httpAuthGet('user/getDeptMember', ['deptId' => $deptId, "lang" => $lang]);
    }

    /**
     * 获取部门用户详情
     */
    public function listbypage($department_id, $offset = 0, $size = 100, $order = null, $lang = null)
    {
        return $this->client->httpAuthGet('user/listbypage', ['department_id' => $department_id, "offset" => $offset, "size" => $size, "lang" => $lang]);
    }
}
