<?php
class Schedule {
	
	public static function updateSeeders()
	{		
		//собираем модель с найденными раздачами, у которых есть все указанные тэги
		$criteria = new CDbCriteria;
		$criteria->select = 'info_hash, sum(case when state=1 then 1 else 0) as seeders, sum(case when state=0 then 1 else 0) as leechers';		
		$criteria->group='info_hash';
		$peers = Peers::model()->findAll($criteria);
		
		$torrent = Torrent::model();
		foreach ($peers as $key => $value) {
			$torrent->findByAttribute('info_hash', 'info_hash=:info_hash', array(':info_hash'=>$peers[$key]->info_hash));
			$torrent->seeders = $peers[$key]->seeders;
			$torrent->peers = $peers[$key]->peers;
		}
		
	}	
}
