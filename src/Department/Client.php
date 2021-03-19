<?php

namespace DingTalk\Department;

use DingTalk\Kernel\BaseClient;

class Client extends BaseClient
{
    /**
     * 获取子部门 ID 列表
     * @param string $id 部门ID
     * @return mixed
     */
    public function getSubDepartmentIds($id)
    {
        return $this->client->get('department/list_ids', compact('id'));
    }

    /**
     * 获取部门列表
     *
     * @param bool $isFetchChild
     * @param string $id
     * @param string $lang
     *
     * @return mixed
     */
    public function list(bool $isFetchChild = false, $parentId = null, $lang = null)
    {
        return $this->client->httpAuthGet('department/list', [
            'id' => $parentId, 'lang' => $lang, 'fetch_child' => $isFetchChild ? 'true' : 'false',
        ]);
    }

    /**
     * 获取部门详情
     *
     * @param string $id
     * @param string $lang
     *
     * @return mixed
     */
    public function get($id, $lang = null)
    {
        return $this->client->get('department/get', compact('id', 'lang'));
    }

    /**
     * 查询部门的所有上级父部门路径
     *
     * @param string $id
     *
     * @return mixed
     */
    public function getParentsById($id)
    {
        return $this->client->get('department/list_parent_depts_by_dept', compact('id'));
    }

    /**
     * 查询指定用户的所有上级父部门路径
     *
     * @param string $userId
     *
     * @return mixed
     */
    public function getParentsByUserId($userId)
    {
        return $this->client->get('department/list_parent_depts', compact('userId'));
    }

    /**
     * 创建部门
     *
     * @param array $params
     *
     * @return mixed
     */
    public function create(array $params)
    {
        return $this->client->postJson('department/create', $params);
    }

    /**
     * 更新部门
     *
     * @param string $id
     * @param array $params
     *
     * @return mixed
     */
    public function update($id, array $params)
    {
        return $this->client->postJson('department/update', compact('id') + $params);
    }

    /**
     * 删除部门
     *
     * @param string $id
     *
     * @return mixed
     */
    public function delete($id)
    {
        return $this->client->get('department/delete', compact('id'));
    }
}
