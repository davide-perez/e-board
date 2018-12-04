/* Table whose tuples represent an user */
CREATE TABLE standard_user (
	user_id SERIAL, /* autoincremented id */
	name varchar(20) NOT NULL, /* name of the user */
	surname varchar(20) NOT NULL, /* surname of the user */
	username varchar(30) NOT NULL UNIQUE, /* username of the user, which must be unique */ 
	password varchar(30) NOT NULL,
	PRIMARY KEY (user_id)
);

/* Table whose tuples represent the special moderator user (may be more than one) */
CREATE TABLE moderator (
	moderator_id SERIAL, /* autoincremented id */
	username varchar(30) NOT NULL UNIQUE, /* username of the moderator, which must be unique */ 
	password varchar(30) NOT NULL,
	PRIMARY KEY (moderator_id)
);

/* Table whose tuples represent mail contact */
CREATE TABLE email (
	email varchar (40) NOT NULL CHECK (email ~* '^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+[.][A-Za-z]+$'), /*mail address. Constraints check the string against a regex matching: one or more alphanumeric characters or special symbols, followed by an “at”, followed by one or more alphanumeric character, followed by a point and one or more alphanumeric characters. The regex expresses the usual structure of a mail, in the form “username@domainname.topleveldomain*/ 
	user_id integer NOT NULL,
	PRIMARY KEY(email),
	FOREIGN KEY(user_id) REFERENCES standard_user (user_id) ON DELETE CASCADE ON UPDATE CASCADE
);

/* Table whose tuples represent phone contact */
CREATE TABLE phone (
	phone_number varchar (25) NOT NULL, /* string representing a phone number. Cannot be an integer for two main reasons: first some numbers have a 0 as prefix that would be dropped, and second many numbers would correspond to integers that are too large and would cause an overflow */ 
	user_id integer NOT NULL,
	PRIMARY KEY(phone_number),
	FOREIGN KEY(user_id) REFERENCES standard_user (user_id) ON DELETE CASCADE ON UPDATE CASCADE
);

/* Table whose tuples represent an ad (published or requested) */
CREATE TABLE ad (
	ad_id SERIAL, /* autoincremented id */
	title varchar(50) NOT NULL, /* title of the ad */
	category varchar(30) NOT NULL, /* category of the ad */
	ad_text varchar(5000), /* text of the ad, can be null if the ad is describd only by an image */
	status integer NOT NULL CHECK (status > 0 and status < 5), /* 1 = approved, 2 = rejected, 3 = pending, 4 = out of date */
	date_published date, /* date when an ad is pushlished */
	date_until date, /* date until an ad is valid */
	email varchar(40),
	phone_number varchar(25),
	PRIMARY KEY (ad_id),
	FOREIGN KEY (email) REFERENCES email (email) ON DELETE SET NULL ON UPDATE CASCADE,
	FOREIGN KEY (phone_number) REFERENCES phone (phone_number) ON DELETE SET NULL ON UPDATE CASCADE
);

/* Table whose tuple represent image */
CREATE TABLE image (
	link varchar(100) NOT NULL,
	image_only integer NOT NULL CHECK (image_only = 0 or image_only = 1), /* integer acting as boolean variable: 0 = support image, such images that describe ad together with text; 1 = only image, such that the text description is not present and is substituted by the image */
	ad_id integer NOT NULL,
	PRIMARY KEY (link),
	FOREIGN KEY (ad_id) REFERENCES ad (ad_id) ON DELETE CASCADE ON UPDATE CASCADE
);



