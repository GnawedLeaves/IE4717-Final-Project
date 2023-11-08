# IE4717-Final-Project

## Steps to start Project:

### Step 1: Install XAMPP

Change all the ports and shit according to the notes (will add more details next time)

### Step 2: Setting Up Database

2.1 Once XAMPP is up and running with the apache, mysql and mercury servers running, go to localhost:8000 or localhost:8000/IE4717 to check if its working
2.2 Go localhost:8000/phpmyadmin to access database
2.3 Click on create new database and name it 'chrispizza'
2.4 Click into the database and click on import and select the file called ultimateseed.sql and import it

    2.4.1 If that doesnt work or got some errors, then import the other files manually one by one in this order: menu.sql, customers.sql, ordersummary.sql, orders.sql,feedback.sql, seed.sql

2.5 Databse set up is completed

### Step 3: Features of the website

3.1 Go to localhost:8000/IE4717 or whatever the folder name is the files that are using XAMPP should all be placed within the application files htdocs --> IE4717 in the C drive btw
3.2 Dead links: Support , Offers, the rest all work but there is nothing other than pizza the rest of the links all lead to pizza
3.3 Add to cart and buy whatever and when done click on the cart icon and go to the checkout
3.4 Payment details are left unrequired because we skipping that part then click pay
3.5 Arrive at track order page and if you go to order summary, you can see all the user's orders etc whether in progress or completed. This will change according to the user so if you put your name in when sending the order all your orders will appear, its based on the email you input
