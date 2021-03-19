<?php

namespace DingTalk\Attendance;

use DingTalk\Kernel\BaseClient;

class Client extends BaseClient
{

    /**
     * 获取打卡结果
     */
    public function list($workDateFrom, $workDateTo, $userIdList, $offset = 0, $limit = 30, $isI18n = false)
    {
        return $this->client->httpAuthPost('attendance/list', [
            'workDateFrom' => $workDateFrom, "workDateTo" => $workDateTo, "userIdList" => $userIdList, "offset" => $offset, "limit" => $limit, "isI18n" => $isI18n
        ]);
    }

    /**
     * 查询成员排班信息
     */
    public function schedule_listbyday($op_user_id, $user_id, $date_time)
    {
        return $this->client->httpAuthPost('topapi/attendance/schedule/listbyday', [
            'op_user_id' => $op_user_id, "user_id" => $user_id, "date_time" => $date_time
        ]);
    }
}
