# Carlos Marcelo


# Challenge_
Promofarma Code Challenge
Promofarma Shopping Cart & Orders
Promofarma is a marketplace that operates with different sellers that offer their products to be sold from Promofarma. 
This implies that a product can be sold by one or several sellers at different prices. 
Therefore, in our system we have to trace the selection of the product-seller once the user adds a product to the Shopping Cart and once the transaction ends.
## Implement Shopping Cart API:
- Add/Delete Seller
- Add/Delete Products linked to Seller
- Add/Delete products  to cart
- Get the total amount of the cart.
- Increase / Decrease the number of units of a product (0 means deleted).
- Remove a product from the cart
- Delete the entire cart
- Confirm Cart -> commit to buy.
## Example Workflow:
Elaborate a working set of example requests to fulfill a full buying process. User is Unique.
Do not forget Readme with a working example and environment setup.
Take care along the developing process (commits).
## Delivery
Right here!!!
Estimated completion time: 2 day.
The implementation of the exercise is free.
The details of implementation and the approach taken will be evaluated.
It is not necessary to develop a graphical interface.
The test will be discussed together in the offices of Promofarma
Enjoy Coding!
When you are done pls ping me here: daniel.vaquero@promocionesfarma.com


NOTES:

- At first I started planning the relationship between Product & Seller as a Many-To-Many, but then I simplified
because I thought that it would have more sense to control de stock if the product belongs only to one seller.

- If there is some error with the mysql container, add 127.0.0.1 mysql to the /etc/hosts

- At first I decided to add a column Amount on the table cart_product to controll how many of the same product are on the
cart, but at the end I decided to remove it and I will control it by the numbers of rows. So, if there are 2 of the same product,
  the row will be duplicated. If I have more time I will improve this part.
  

