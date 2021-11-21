#NOTES

- At first I started planning the relationship between Product & Seller as a Many-To-Many, but then I simplified
  because I thought that it would have more sense to control de stock if the product belongs only to one seller.

- If there is some error with the mysql container, add 127.0.0.1 mysql to the /etc/hosts

- At first I decided to add a column Amount on the table cart_product to controll how many of the same product are on the
  cart, but at the end I decided to remove it and I will control it by the numbers of rows. So, if there are 2 of the same product,
  the row will be duplicated. If I have more time I will improve this part.

- When I delete something, I put the attribute valid = 0 (softDelete).

- I didn't have enough time for everything, there are things that I still need to improve. So at so moment I decided that 
it's better to have the most of the parts and prepare correctly the workflow and the environment so that it's easy to use.

Things to improve: 

- All the tables has the column valid, which means if it's deleted or not. If I had more time, i would add this filter to
every query, so that we can only use valid and working elements.

For using it correctly, please read the HOWTOUSE.md.

