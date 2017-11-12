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

CREATE TABLE comment (
        id int(11) NOT NULL AUTO_INCREMENT,
    	news_id int(11),
    	comment_user_id int(11),
        text text NOT NULL,
        PRIMARY KEY (id),
    	FOREIGN KEY (comment_user_id) REFERENCES users (id) ON DELETE CASCADE,
    	FOREIGN KEY (news_id) REFERENCES news (id) ON DELETE CASCADE
);