drop table if exists users;

create table users (
	id int not null auto_increment primary key,
	username varchar(40) not null,
	password varchar(40) not null,
	email varchar(255) not null,
	first_name varchar(40) not null,
	last_name varchar(40) not null,
	created datetime not null,
	modified datetime not null,
	
    unique user_email_unique (username, email),
	key email (email)
) type = myisam;
