<?php

/**
 * This is the model class for table "a_peers".
 *
 * The followings are the available columns in table 'a_peers':
 * @property string $info_hash
 * @property integer $port
 * @property string $peer_id
 * @property string $state
 * @property string $compact
 * @property string $ip
 * @property string $updated
 */
class Peers extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Peers the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'a_peers';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('info_hash, port, peer_id', 'required'),
			array('port', 'numerical', 'integerOnly'=>true),
			array('state, compact, ip, updated', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('info_hash, port, peer_id, state, compact, ip, updated', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'info_hash' => 'Info Hash',
			'port' => 'Port',
			'peer_id' => 'Peer',
			'state' => 'State',
			'compact' => 'Compact',
			'ip' => 'Ip',
			'updated' => 'Updated',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('info_hash',$this->info_hash,true);
		$criteria->compare('port',$this->port);
		$criteria->compare('peer_id',$this->peer_id,true);
		$criteria->compare('state',$this->state,true);
		$criteria->compare('compact',$this->compact,true);
		$criteria->compare('ip',$this->ip,true);
		$criteria->compare('updated',$this->updated,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}