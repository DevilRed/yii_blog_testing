DROP DATABASE IF EXISTS `yii2_blog`;
CREATE DATABASE yii2_blog;
USE yii2_blog;
SOURCE /db/database.sql;

CREATE USER blog_user identified BY "blog_db";
GRANT ALL PRIVILEGES  ON yii2_blog.* TO blog_user@'%';