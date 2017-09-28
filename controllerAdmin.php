<?php
class controllerAdmin{
    public function userlist(){
        $users = new user();
        $users->getUserList(5,0);
    }

    public function edit($new){

    }

    public function delete($id){

    }
}