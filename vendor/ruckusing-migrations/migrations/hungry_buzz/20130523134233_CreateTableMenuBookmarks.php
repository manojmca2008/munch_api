<?php

class CreateTableMenuBookmarks extends Ruckusing_Migration_Base
{
    public function up()
    {
    	$this->execute("
    		CREATE  TABLE `menu_bookmarks` (
			  `id` INT NOT NULL AUTO_INCREMENT ,
			  `menu_id` INT NOT NULL ,
			  `user_id` INT NOT NULL ,
			  `date_time` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP() ,
			  `type` VARCHAR(255) NOT NULL ,
			  PRIMARY KEY (`id`))
    		");
    }//up()

    public function down()
    {
    }//down()
}
