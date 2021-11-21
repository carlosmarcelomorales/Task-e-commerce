#HOW TO USE

##INSTALLATION

For installing the project correctly use this command from the root of the project: 

> make init

Now, the project docker of the project is already running and ready to use. You can use 
>docker-compose ps

Once the project is started, we need to execute composer to install al the dependencies. For this, we will need to go to 
the app folder:

>cd app && composer install

Now that the project is already running, we need to execute the migrations. Also, we will need to run this on the app folder.

> php bin/console doctrine:migrations:migrate

This will create all the tables inside of our database shop. Now the project is ready to use!

## USAGE

For using correctly the project, I prepared a POSTMAN collection with the requests that we will use during the process.

The collection is called Shop. Let's start creating our User.

##Create user
We need to use the request **Shop\User\Add**. If we click send directly, it will create a user called Carlos.

##Create seller

After the user, we will create the Seller. We will use the request **Shop\Seller\Add**. This will create a seller called
FirstSeller. 

##Create products for sellers

Now that we have a Seller, let's create a couple of products. We will use the request: **Shop\Product\Add**. If we use
it directly, it will create a Product named ExpensiveProduct with a value of 300 that belongs to the Seller 1 ( the one
that we just created). If you want, you can modify the attribute price and name on the request to add another product.

##Adding Products to the cart

Once we have our database full of products and seller, it's time to start preparing our cart! We have the user that we 
created at first (by default with id = 1) so we will use this user for start buying. Let's call the request: 
**Shop\Cart\Add**. Let's call it 3 times, and we will get the same response. Now if we call it one more time, we should
have an error. This is because the product that we are trying to add it's already out of stock.

If you want, you can change the productId from the request. In case you don't we continue with the example, and at the 
moment we have 3 products ExpensiveProduct, and everyone costs 300.

Let's check the price now.

## Check the price in our cart.

For checkint the price of the total amount that we have in our cart, we will need to use the request: 
**Shop\Cart\GetAmount**. If we didn't add other products to the car, now we should have a price of 900 on the response.

Now let's imagine that we want to add another ExpensiveProduct in our cart.

## Increase number of products in stock.

We will need to call the request: **Shop\Product\ModifyAmount**. If we run it, we will be adding 2 more units to the
ExpensiveProduct. If we want to decrease the number of the selected product, we will need to send the attribute
increase = 0 ( by default it's 1 because we want to increase it).

Now we can add again more products, so if we run again the **Shop\Cart\Add** we will stop having the error.

Now we have already many products, so we will confirm the cart.

## Confirm the cart.

For confirming the cart and create the final order, we need to use the request: **Shop\Cart\Confirm**. Like always, by 
default we will be using the user with id = 1. So, if now we execute it we will get a message saying that our order
is created. Now if we check the table order we can see that we have one order linked to the cart that we had and also
with the final price. 


# Testing

For testing the application, we need to use the next command:

> cd app && php bin/phpunit

I added a few test, should be good to add more.
