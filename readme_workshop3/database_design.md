# Database

## 1. Basic information  

## 1.1 What?

- PostgreSQL is a powerful, open source object-relational database system. It has more than 15 years of active development phase and a proven architecture that has earned it a strong reputation for reliability, data integrity, and correctness.

## 1.2 Why?

- Store and retrive data easily which are required for the website / application.

## 1.3 How?

- By using queries. There are different type or queries which are used for different operations

## 1.4 Operations

- CRUD operations :  CREATE, READ, UPDATE, DELETE.

### 1.5 Examples

`CREATE` : You create your account in facebook, Your information gets saved into the Database.

`READ` : When you search your friends it will show you their posts and details by reading it from the database.

`UPDATE` : When you get married you go back to your account and update the maratial status to "Married", this will update your information in Database.

`DELETE` : You have posted some pics in your account few yeas back and now you realise how bad it is and you delete it, So it gets deleted from the database.

-----------------------------------------------------------------------------------------------

## 2. Database Planning  

### 2.1 How many tables do we need?  

- `Users` Table to store user information
- `Blogs` Table to store the blogs which uses submit.

### 2.2 What information do we keep in users table?  

- User Id, First Name, Last Name, Password, Username, Profession, Created On, Active, Profile Pic.
- Username should be unique
- User Id should be Primary key

### 2.3 What information do we keep in blogs table ?  

- Blog Id, Blog Title, Blog Content, Created On, Created By, Modifies On, Image Path.
- Blog Id should be primary key.
- Created by is a foreign key which references `users` table.

-----------------------------------------------------------------------------------------------

## 3 PgAdmin

- Its a tool to access database.
- It provies User Interface to easily view and make changes to our database.
- There are many such tools are available you can use any tool.
- If you dont want to use any such tools then you can directly connect to database from terminal.
- This service will be added in the docker-compose.yaml file

-----------------------------------------------------------------------------------------------

## 4. Creating Database Schema  

### 4.1 Schema to Create Users Table

```sql

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

```

### 4.2 Schema to Create Blogs Table

```sql

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

```

-----------------------------------------------------------------------------------------------  

## 5. Data Inserting

### 5.1 Insert few users into users table  

```sql

INSERT INTO users (first_name, last_name, user_password, username, profession, profile_pic) VALUES ('Harshith', 'Cariappa', '5e884898da28047151d0e56f8dc6292773603d0d6aabbdd62a11ef721d1542d8', 'HarshithCariappa', 'Senior Software Engineer II', '/images/harshith.jpg');


INSERT INTO users (first_name, last_name, user_password, username, profession, profile_pic) VALUES ('Vivek', 'Texeira', '5e884898da28047151d0e56f8dc6292773603d0d6aabbdd62a11ef721d1542d8', 'VivekTexeira', 'Technical Lead', '/images/vivek.jpg');


INSERT INTO users (first_name, last_name, user_password, username, profession, profile_pic) VALUES ('Amitha', 'Moily', '5e884898da28047151d0e56f8dc6292773603d0d6aabbdd62a11ef721d1542d8', 'AmithaMoily', 'Team Manager', '/images/amitha.jpg');


INSERT INTO users (first_name, last_name, user_password, username, profession, profile_pic) VALUES ('Rameez', 'Raza', '5e884898da28047151d0e56f8dc6292773603d0d6aabbdd62a11ef721d1542d8', 'RameezRaza', 'Senior Software Engineer II', '/images/rameez.jpg');

```

### 5.2 Insert blogs data into blogs table  

```sql

INSERT INTO blogs (blog_title, blog_content, created_by, modified_on, image_path) VALUES ('Workshop 1 at SDIT', 'This blog is about the first workshop conducted in SDIT. Topics covered : Docker, docker compose and linux commands. Github url : https://github.com/Unicourt/Website-Workshop1 All the details of the workshop are in this repository', 2, NOW(), '/images/workshop1.jpg');


INSERT INTO blogs (blog_title, blog_content, created_by, modified_on, image_path) VALUES ('Workshop 2 at SDIT','This blog is about the second workshop conducted in SDIT. Topics covered : HTML and CSS  Github url : https://github.com/Unicourt/Website-Workshop2 All the details of the workshop are in this repository', 4, NOW(), '/images/workshop2.jpg');


INSERT INTO blogs (blog_title, blog_content, created_by, modified_on, image_path) VALUES ('Workshop 3 at SDIT','This blog is about the third workshop conducted in SDIT. Topics covered : PHP and Postgres  Github url : https://github.com/Unicourt/Website-Workshop3 All the details of the workshop are in this repository', 1, NOW(), '/images/workshop3.jpg');


INSERT INTO blogs (blog_title, blog_content, created_by, modified_on, image_path) VALUES ('Feedback from team Manager', 'Imaging something good here. With great power comes great responsibility. Darr ke aage jeet hain. Kabhi kushi Kabhi gum, WAKANDA FOREVER. #RCB #ESALACUPNAMDE ', 3, NOW(), '/images/manager.jpg');


INSERT INTO blogs (blog_title, blog_content, created_by, modified_on, image_path) VALUES ('Things learnt in Mangalore', ' Dada ya, Dala ijji, Vanas aanda, Barpe, StateBank is a bus stop name, Ammer is not mom ??? and Appe is not Dad?? WHYYYYYY????  . Bangude , Buthai are types of fish. You go to beach in one color and come out as if someone changed your contrast. Last but not the least - Bashe Barodilla ninge? (I dont even know how to react to this)', 1, NOW(), '/images/mangalore.jpg');

```
