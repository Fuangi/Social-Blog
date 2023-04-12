<?php
//the include here, imports the file and treats it as part of this file
include "database-connection.php";
// Creating a database if it doesn't exist
// the -> is used for accessing object methods and properties like (.) in JS. here (.) is used for concatenation
$create_db = "create database if not exists social_blog";

$query = $conn->query($create_db);

if(!$query){
    die("Database not created");
}
else{
    echo "<h1> Database created </h1>";
}


// creating tables sql in an array

$create_tables = array(
        "CREATE TABLE IF NOT EXISTS `Social_blog`.`users` (
        `user_id` VARCHAR(20) NOT NULL COMMENT 'the idis a variable character and will be in the format: sb110320230000000001. The sb stands for \"social blog\", the 11032023 stands for the date of creation and the last 10 digits are for the person\'s serial number.this has a length of 20 characters... ',
        `user_name` VARCHAR(45) NOT NULL,
        `user_email` VARCHAR(45) NOT NULL,
        `user_passowrd` VARCHAR(45) NOT NULL COMMENT 'A minimum of eight characters( a concatenation of alpha numeric and special characters)',
        `user_dob` DATE NOT NULL,
        `user_contact` VARCHAR(45) NOT NULL,
        `user_gender` VARCHAR(6) NOT NULL,
        `user_status` VARCHAR(8) NOT NULL,
        PRIMARY KEY (`user_id`),
        UNIQUE INDEX `user_id_UNIQUE` (`user_id` ASC) ,
        UNIQUE INDEX `user_email_UNIQUE` (`user_email` ASC) ,
        UNIQUE INDEX `user_contact_UNIQUE` (`user_contact` ASC) )
    ENGINE = InnoDB;", 
    "CREATE TABLE IF NOT EXISTS `Social_blog`.`posts` (
    `post_id` VARCHAR(11) NOT NULL COMMENT 'The post id is a hash value of 11 characters',
    `post_title` VARCHAR(45) NOT NULL,
    `post_data` DATE NOT NULL,
    `post_content` LONGTEXT NOT NULL,
    `post_likes` INT NOT NULL DEFAULT 0,
    `post_dislikes` INT NOT NULL DEFAULT 0,
    `post_engagements` INT NOT NULL COMMENT 'Its value is boolean (',
    `post_commenting_state` TINYINT NOT NULL COMMENT 'This describes weather or not comments are allowed for the post.\n 0 for not allowed and 1 for comments allowed.',
    `users_user_id` VARCHAR(20) NOT NULL,
    PRIMARY KEY (`post_id`),
    UNIQUE INDEX `post_id_UNIQUE` (`post_id` ASC) ,
    INDEX `fk_posts_users_idx` (`users_user_id` ASC) ,
    CONSTRAINT `fk_posts_users`
        FOREIGN KEY (`users_user_id`)
        REFERENCES `Social_blog`.`users` (`user_id`)
        ON DELETE NO ACTION
        ON UPDATE NO ACTION)
        ENGINE = InnoDB;", 
    "CREATE TABLE IF NOT EXISTS `Social_blog`.`Comments` (
    `comment_id` VARCHAR(15) NOT NULL COMMENT 'A combination of the post id plus an interger(this interger is an increamentation). This would ensure that every comment is uniquely identified.',
    `comment_content` LONGTEXT NULL,
    `comment_date` DATE NULL,
    `comment_likes` INT NULL DEFAULT 0,
    `comment_dislikes` INT NULL DEFAULT 0,
    `users_user_id` VARCHAR(20) NOT NULL,
    `posts_post_id` VARCHAR(11) NOT NULL,
    PRIMARY KEY (`comment_id`),
    INDEX `fk_Comments_users1_idx` (`users_user_id` ASC) ,
    INDEX `fk_Comments_posts1_idx` (`posts_post_id` ASC) ,
    CONSTRAINT `fk_Comments_users1`
        FOREIGN KEY (`users_user_id`)
        REFERENCES `Social_blog`.`users` (`user_id`)
        ON DELETE NO ACTION
        ON UPDATE NO ACTION,
    CONSTRAINT `fk_Comments_posts1`
        FOREIGN KEY (`posts_post_id`)
        REFERENCES `Social_blog`.`posts` (`post_id`)
        ON DELETE NO ACTION
        ON UPDATE NO ACTION)
    ENGINE = InnoDB;", 
    "CREATE TABLE IF NOT EXISTS `Social_blog`.`comment_replies` (
        `reply_id` VARCHAR(20) NOT NULL,
        `comment_id` VARCHAR(15) NOT NULL,
        `Comments_comment_id` VARCHAR(15) NOT NULL,
        PRIMARY KEY (`reply_id`),
        UNIQUE INDEX `reply_id_UNIQUE` (`reply_id` ASC) ,
        INDEX `fk_comment_replies_Comments1_idx` (`Comments_comment_id` ASC) ,
        CONSTRAINT `fk_comment_replies_Comments1`
        FOREIGN KEY (`Comments_comment_id`)
        REFERENCES `Social_blog`.`Comments` (`comment_id`)
        ON DELETE NO ACTION
        ON UPDATE NO ACTION)
    ENGINE = InnoDB;
    ", "CREATE TABLE IF NOT EXISTS `Social_blog`.`address` (
    `address_id` INT NOT NULL,
    `address_house_no` INT NULL,
    `address_street_name` VARCHAR(45) NULL,
    `address_city` VARCHAR(45) NULL,
    `address_region` VARCHAR(45) NOT NULL,
    `address_country` VARCHAR(45) NOT NULL,
    `address_zipcode` VARCHAR(0) NULL,
    `users_user_id` VARCHAR(20) NOT NULL,
    PRIMARY KEY (`address_id`, `address_region`, `address_country`, `users_user_id`),
    UNIQUE INDEX `address_id_UNIQUE` (`address_id` ASC) ,
    INDEX `fk_address_users1_idx` (`users_user_id` ASC) ,
    CONSTRAINT `fk_address_users1`
        FOREIGN KEY (`users_user_id`)
        REFERENCES `Social_blog`.`users` (`user_id`)
        ON DELETE NO ACTION
        ON UPDATE NO ACTION)
    ENGINE = InnoDB;
    ", "CREATE TABLE IF NOT EXISTS `Social_blog`.`files` (
        `file_id` INT NOT NULL COMMENT 'It is a hash interger value of 15 characters. ',
        `file_url` VARCHAR(200) NULL,
        `file_for` VARCHAR(200) NULL COMMENT 'Describes the utilization of the file. Is it for a post, a comment or a picture.',
        PRIMARY KEY (`file_id`),
        UNIQUE INDEX `file_url_UNIQUE` (`file_url` ASC) ,
        UNIQUE INDEX `file_id_UNIQUE` (`file_id` ASC) )
    ENGINE = InnoDB;", "CREATE TABLE IF NOT EXISTS `Social_blog`.`users_has_files` (
    `users_user_id` VARCHAR(20) NOT NULL,
    `files_file_id` INT NOT NULL,
    PRIMARY KEY (`users_user_id`, `files_file_id`),
    INDEX `fk_users_has_files_files1_idx` (`files_file_id` ASC) ,
    INDEX `fk_users_has_files_users1_idx` (`users_user_id` ASC) ,
    CONSTRAINT `fk_users_has_files_users1`
        FOREIGN KEY (`users_user_id`)
        REFERENCES `Social_blog`.`users` (`user_id`)
        ON DELETE NO ACTION
        ON UPDATE NO ACTION,
    CONSTRAINT `fk_users_has_files_files1`
        FOREIGN KEY (`files_file_id`)
        REFERENCES `Social_blog`.`files` (`file_id`)
        ON DELETE NO ACTION
        ON UPDATE NO ACTION)
    ENGINE = InnoDB;", "CREATE TABLE IF NOT EXISTS `Social_blog`.`Comments_has_files` (
    `Comments_comment_id` VARCHAR(15) NOT NULL,
    `files_file_id` INT NOT NULL,
    PRIMARY KEY (`Comments_comment_id`, `files_file_id`),
    INDEX `fk_Comments_has_files_files1_idx` (`files_file_id` ASC) ,
    INDEX `fk_Comments_has_files_Comments1_idx` (`Comments_comment_id` ASC) ,
    CONSTRAINT `fk_Comments_has_files_Comments1`
        FOREIGN KEY (`Comments_comment_id`)
        REFERENCES `Social_blog`.`Comments` (`comment_id`)
        ON DELETE NO ACTION
        ON UPDATE NO ACTION,
    CONSTRAINT `fk_Comments_has_files_files1`
        FOREIGN KEY (`files_file_id`)
        REFERENCES `Social_blog`.`files` (`file_id`)
        ON DELETE NO ACTION
        ON UPDATE NO ACTION)
    ENGINE = InnoDB;", 
    "CREATE TABLE IF NOT EXISTS `Social_blog`.`posts_has_files` (
    `posts_post_id` VARCHAR(11) NOT NULL,
    `files_file_id` INT NOT NULL,
    PRIMARY KEY (`posts_post_id`, `files_file_id`),
    INDEX `fk_posts_has_files_files1_idx` (`files_file_id` ASC),
    INDEX `fk_posts_has_files_posts1_idx` (`posts_post_id` ASC),
    CONSTRAINT `fk_posts_has_files_posts1`
        FOREIGN KEY (`posts_post_id`)
        REFERENCES `Social_blog`.`posts` (`post_id`)
        ON DELETE NO ACTION
        ON UPDATE NO ACTION,
    CONSTRAINT `fk_posts_has_files_files1`
        FOREIGN KEY (`files_file_id`)
        REFERENCES `Social_blog`.`files` (`file_id`)
        ON DELETE NO ACTION
        ON UPDATE NO ACTION)
    ENGINE = InnoDB;" 
);

$arrlength = count($create_tables);

for($i = 0; $i < $arrlength; $i++){
    $query = $create_tables[$i];
    $conn->query($query);
    //checking if the table has been created
    if(!$query){
        echo "<h2>Table not created!</h2>";
    }
/*     else{
        echo "<h2>Table created!</h2>";
    } */
}
?>