CREATE TABLE IF NOT EXISTS users (
  user_id bigserial NOT NULL PRIMARY KEY, 
  first_name character varying(250) NOT NULL,
  last_name character varying(250) NOT NULL,
  user_password character varying(250) NOT NULL,
  username character varying(250) NOT NULL,
  profession character varying(250) NOT NULL,
  created_on timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  active smallint NOT NULL DEFAULT 1,
  profile_pic character varying(250),
  CONSTRAINT username_users_uk UNIQUE (username)
);

CREATE TABLE IF NOT EXISTS blogs (
  blog_id bigserial NOT NULL PRIMARY KEY, 
  blog_title character varying(200) NOT NULL,
  blog_content text NOT NULL,
  created_on timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  created_by bigint NOT NULL,
  modified_on timestamp NOT NULL,
  image_path character varying(250),
  CONSTRAINT fk_blogs_created_by FOREIGN KEY (created_by) REFERENCES users (user_id)
);