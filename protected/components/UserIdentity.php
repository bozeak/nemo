<?php
class UserIdentity extends CUserIdentity
{
    private $id;

    public function authenticate()
    {
        $record=Users::model()->findByAttributes(array('login'=>$this->username));
        if($record===null)
            $this->errorCode=self::ERROR_USERNAME_INVALID;
        else if($record->password!==md5($this->password))
            $this->errorCode=self::ERROR_PASSWORD_INVALID;
        else
        {
            $this->id=$record->uid;
            $this->setState('rid', $record->rid);
            $this->setState('subdiv', $record->subdiv);
            $this->errorCode=self::ERROR_NONE;
        }
        return !$this->errorCode;
    }

    public function getId(){
        return $this->id;
    }
}