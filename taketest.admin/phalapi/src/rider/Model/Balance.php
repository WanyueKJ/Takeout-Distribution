<?php
namespace Rider\Model;

use PhalApi\Model\NotORMModel as NotORM;

class Balance extends NotORM {
	
	public function getList($where,$p=0,$nums=0) {
	    $start=0;
		if($p>0){
		    if($nums==0){
		        $nums=20;
            }
            $start=($p-1)*$nums;
        }
		$list=\PhalApi\DI()->notorm->rider_balance
                ->select('*')
				->where($where)
                ->order('id desc');

		if($nums>0){
            $list->limit($start,$nums);
        }

		return $list->fetchAll();
	}
    
    public function getInfo($where,$field='*') {
		
		$info=\PhalApi\DI()->notorm->rider_balance
                ->select($field)
				->where($where)
				->fetchOne();

		return $info;
	}

	public function getSum($where,$field='*') {

		$info=\PhalApi\DI()->notorm->rider_balance
				->where($where)
				->sum($field);
		if(!$info){
		    return '0.00';
        }

		return $info;
	}
    
    public function add($data) {
		
		$rs=\PhalApi\DI()->notorm->rider_balance
				->insert($data);

		return $rs;
	}
    
    public function up($where,$data) {
		
		$rs=\PhalApi\DI()->notorm->rider_balance
                ->where($where)
				->update($data);

		return $rs;
	}
    
    public function del($where) {
		
		$rs=\PhalApi\DI()->notorm->rider_balance
                ->where($where)
				->delete();

		return $rs;
	}
	
	
}
