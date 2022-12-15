# Continuation of building blog using PHP and Postgres - Workshop 4

Build your own website with our one-day workshop on understanding PHP, Postgres and CRUD operations. Learn how to,
   - Ability to create new blog and delete blog.
   - Creating login form and validation.
   - Creating Signup form and validation.
   - Ajax calls.

## Prerequisites
 - Machine/VM with linux
 - Docker  ( https://docs.docker.com/engine/install/ubuntu/#install-using-the-convenience-script )
 - Git     ( https://www.atlassian.com/git/tutorials/install-git#linux )
   - Create github account (https://github.com/signup)
   - Setting up SSH key with GitHub for Ubuntu
 (https://medium.com/featurepreneur/setting-up-ssh-key-with-github-for-ubuntu-cd8f2fabf25b)
 - VS code IDE ( https://linuxize.com/post/how-to-install-visual-studio-code-on-ubuntu-20-04/ )
 - Internet Connection and Chrome browser.

## Workshop environment setup 
 - Check if Git, Docker, and Docker Compose are installed in on the system. Open the terminal and run the following command
   ```
   mis@mispl-lap-31:~$ git --version
   git version 2.25.1

   mis@mispl-lap-31:~$ docker --version
   Docker version 20.10.17, build 100c701

   mis@mispl-lap-31:~$ docker compose version
   Docker Compose version v2.6.0

   ```
 - Open terminal and run following command to create a folder called workshop
    ```
    mkdir workshop
    ```
 - Navigate to the folder workshop and clone the from your personal repo using git
    ```
    cd workshop
    ```
 - First fork the repo and clone Website-Workshop4 repo & go inside Webiste-Workshop4 folder
    ``` 
    git clone https://github.com/{yourName}/Website-Workshop4.git
    cd Website-Workshop4
    ```
 - To open folder in VS code editor
    ```
    cd ~/workshop/Website-Workshop4
    code .
    ```
 - Bring up the Simple Blog Container
   ```
   sudo docker-compose -f simple-blog/docker-compose.yaml up

                           or
   
   sudo docker compose -f simple-blog/docker-compose.yaml up

   ```

 - open up http://localhost:8080/ in your browse

## What will you learn by the end of this workshop?
- By the end of this workshop, you will learn CRUD operations and Form Validations.
- You will learn how to build website using PHP and Postgres with the knowledge of HTML and CSS from previous workshop.
- You will learn how to design and create a web application.
- You will learn how to work with postgres database.

## Schedule

| Time          | Topics
|---------------|-------
| 09:30 - 10:00 |  [`Recap - Workshop 3`]
| 10:00 - 10:30 |  [`Introdction to Workshop 4`](./readme_workshop4/index_readme.md)
| 10:00 - 11:00 |  [`Login Creation`](./readme_workshop4/login_creation.md)
| 11:00 - 11:15 |  [`Break`]
| 11:15 - 11:30 |  [`Logout Creation`](./readme_workshop4/logout_creation.md)
| 11:30 - 01:00 |  [`Signup Creation`](./readme_workshop4/signup_creation.md)
| 01:00 - 02:00 |  [`Break`]
| 02:00 - 05:00 |  [`Blog Operations`](./readme_workshop4/blog_creation.md)
| 05:00 - 05:15 |  [`Q & A`]
| 05:15 - 05:30 |  [`Wrapping Up`]
