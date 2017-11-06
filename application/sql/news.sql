for news sql:

CREATE TABLE news (
        id int(11) NOT NULL AUTO_INCREMENT,
    	news_user_id int(11),
        title varchar(128) NOT NULL,
        slug varchar(128) NOT NULL,
        text text NOT NULL,
        PRIMARY KEY (id),
        KEY slug (slug),
    	FOREIGN KEY (news_user_id) REFERENCES users (id) ON DELETE CASCADE
);