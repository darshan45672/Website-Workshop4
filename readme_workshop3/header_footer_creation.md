# Header and Footer Creation

- If you see the final application which we are building we will see that all the pager have same header and footer (menu items, logo, footer links etc)
- Since its common lets separate ot to a file and import it in all pages so that we dont have to write it again.

## 1. Header

- Lets create a header.php which will contain the common header code which will be used in all pages.
- In index.php the code within the `<header>` tag is common so lets copy that and paste it in `header.php` file within view folder. (the code to copy is below)

```html

<header>
    <nav id="main-nav" class="navbar">
        <div class="container">
            <div class="navbar-brand">
                <a class="navbar-item" href="/index.php">
                    <img src="./images/logo.png" alt="UniCourt">
                </a>
                <div class="navbar-burger burger" id="nav-toggle">
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
            </div>

            <div id="navbar-example" class="navbar-menu">
                <div class="navbar-end">
                    <a class="navbar-item is-active" href="index.php">Blog</a>
                </div>
            </div>
        </div>
    </nav>
</header>

```

## 2. Footer

- Lets create a footer.php which will contain the common footer code which will be used in all pages.
- In index.php the code within the `<footer>` tag is common so lets copy that and paste it in `footer.php` file within view folder. (the code to copy is below).

```html

<footer>
    <div class="container">
        <div>
            <nav class="hide-on-signup">
                <a href="#">Footer link</a>
                <a href="#">Footer link</a>
                <a href="#">Footer link</a>
            </nav>
        </div>
        <div class="is-hidden-mobile">
            <p>
                © 2022 mysite.com
            </p>
        </div>
    </div>
</footer>

```

## 3. How to import header and footer

### 3.1 Import Header

- In `index.php` replace the `<header>` section with below code to import it.

```php

    <?php 
        include './header.php';
        // Paste blogs code below this.
    ?>

```

### 3.2 Import Footer

- In `index.php` replace the `<footer>` section with below code to import it.

```php

    <?php 
        include './footer.php';
    ?>

```

#### 4 Create the blog section in the index.php Refer point 2. [Fetching the blogs to display](./index_code.md)
