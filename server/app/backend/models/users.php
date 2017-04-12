<?php

	/**
	 * @var array EAuth attributes
	 */
	public $profile;

	public static function findIdentity($id) {
		if (Yii::$app->getSession()->has('user-'.$id)) {
			return new self(Yii::$app->getSession()->get('user-'.$id));
		}
		else {
			return isset(self::$users[$id]) ? new self(self::$users[$id]) : null;
		}
	}

	/**
	 * @param \nodge\eauth\ServiceBase $service
	 * @return User
	 * @throws ErrorException
	 */
	public static function findByEAuth($service) {
		if (!$service->getIsAuthenticated()) {
			throw new ErrorException('EAuth user should be authenticated before creating identity.');
		}

		$id = $service->getServiceName().'-'.$service->getId();
		$attributes = [
			'id' => $id,
			'username' => $service->getAttribute('name'),
			'authKey' => md5($id),
			'profile' => $service->getAttributes(),
		];
		$attributes['profile']['service'] = $service->getServiceName();
		Yii::$app->getSession()->set('user-'.$id, $attributes);
		return new self($attributes);
	}