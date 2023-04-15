## Use Case 1 Search Product

Primary Actor: Customer, Clerk, Seller

Description: Customer or clerk is able to find an item from catalog online. Once the item is found, they can write or read the comments.

Pre-Condition: Enter one of the usual information(name, brand, category, etc.)

Post-Condition: Show the items that match the best with the key words

Main Scenario:

1. Enter keywords
2. Choose the item that customer or clerk actually want

Extension:

1.1 Invalid Keywords

    1.1.1 The keywords do not match with any of the item on market place.

## Use Case 2 Maintenance

Primary Actor: Clerk, Seller

Description: Clerk is responsible for maintaining the system and managing the orders. Seller is responsible for their own products

Pre-Condition: Verify clerk's or seller's identification

Post-Condition: The system/selling product is organized and updated.

Main Scenario:

1. Add and delete items from the system
2. Update item information
3. Manage pending orders(clerk only)

Extension:

1.1 Clerk makes mistakes

    1.1.1 Clerk or seller accidentally deletes an item or a comment which should not be deleted or add an unreasonable amount to one item.

2.1 Update Issue

    2.1.1 Clerk or seller updates the item by using wrong information

## Use Case 3 Cancel the Orders

Primary Actor: Customer

Description: Customer is able to cancel any order before it has been sent

Pre-Condition: Order must be successfully placed and it is not shipped

Post-Condition: Order does not exist anymore

Main Scenario:

1. Customer sends the request of cancellation
2. Clerk sends a message to notify the seller
3. Once the seller confirmed, Clerk sends the cancel order instruction to customer

Extension:

2.1 Shipped Order

    2.1.1 If the order has already shipped by the seller, cancellation is no longer allowed

3.1 Cancel Instruction Issue

    3.1.1 The cancel order instruction is not filled correctly by customer
    3.1.2 If seller refuses to cancel the order, clerk needs to negotiate with customer

## Use Case 4 Return

Primary Actor: Customer

Description: Customer is able to return items to seller

Pre-Condition: The items in their order need to be shipped

Post-Condition: The returning items are back to seller

Main Scenario:

1. Customer sends the request of returning
2. Clerk check if the order is placed
3. Return is succeed
4. Seller checks the condition of items
5. Money goes back to customer

Extension:

2.1 Order Issue

    2.1.1 If the order is places more than a week before and the item's condition is good, return fails

4.1 Item Condition Issue

    4.1.1 If the item is broken or has a poor condition, return fails

5.1 Banking Issue

    5.1.1 If the amount of money returned is incorrect or the money does not come through to customer's account, return fails

## Use case 5 Pay

Primary Actor: Customer

Description: Allow customer to pay for their order by different method

Pre-Condition: Customer must have a pending order

Post-Condition: Money is paid successfully and the order is placed

Main Scenario:

1. Customer can choose by cards, checks or gift card
2. Enter payment information (card number, name, expire date etc.)correctly

Extension:

2.1 Incorrect information

    2.1.1 If customer is paying by card and their card information does not match with bank file, an error message is shown

    2.1.2 If for some reason check or gift card is invalid, an email will be sent to the customer as a warning

## Use Case 6 Sign Up

Primary Actor: Customer

Description: Allow customer to create their own account

Pre-Condition: Customer's email has not been used before

Post-Condition: Account information is recorded

Main Scenario:

1. Customer enters basic information(name, email etc)
2. Customer creates password and confirms it
3. Sign up completes

Extension:

1.1 Invalid information

    1.1.1 Email format is incorrect, ask for re-entering

2.1 Password Issue

    2.1.1 Password is too simple, ask for re-entering
    2.1.2 Confirmed password does not match with the initial password

## Use Case 7 Log in

Primary Actor: Customer

Description: Allow customers to log in with their account

Pre-Condition: Email needs to match with site database and its password

Post-Condition: Customers are logged in successfully

Main Scenario:

1. Customer enters email and password
2. Log in successfully

Extension:

1.1 Invalid Information

    1.1.1 Email format is incorrect, ask for re-entering
    1.1.2 Password incorrect, ask for re-entering

## Use Case 8 Shopping Cart

Primary User: Customer

Description: Allow customer to save and keep products they want together

Pre-Condition: Customer must log in and the products they selected exist

Post-Condition: Products are placed in shopping cart

Main Scenario:

1. Customer found the wanted product(Use Case 1)
2. Customer add the product to shopping cart by clicking a button
3. Product is placed in cart successfully

Extension:

3.1 Product Issue

    3.1.1 The product is out of stock
    3.1.2 The product is deleted or no longer available 

## Use Case 9 Add comment

Primary User: Customer

Description: Customers are able to add comments to products they purchased

Pre-Condition: Customer must be logged in and they must have purchased this item

Post-Condition: Comments are shown under the product

Main Scenario:

1. Customer find the product in their order page
2. Customer writes the comments and rate the product
3. Comments are posted and rate is shown

Extension:

1.1 Order Issue

    1.1.1 Order is canceled
    1.1.2 The product in order is not available anymore

2.1 Comments Requirement

    2.1.1 Comments letters exceeds the limit
    2.1.2 Comments contain swear words/discrimination

## Use Case 10 Post/Edit Products

Primary User: Seller

Description: Sellers are able to post/edit items they want to sale

Pre-Condition: Sellers need to be verified and the products are appropriate

Post-Condition: Products are up in the market with basic info and prices

Main Scenario:

1. Seller enters/edits basic info and prices for the product they sells
2. The products are available in the market

Extension:

1.1 Invalid info

    1.1.1 The name contains swear words/discrimination

## Use Case 11 Track status

Primary User: Customer, Seller, Clerk

Description: Customer, seller and clerk are able to track order status

Pre-Condition: Order needs to be placed

Post-Condition: Get and know the order status

Main Scenario:

1. Order needs to be placed and paid successfully
2. Customer is able to view the current order status, as well as seller and clerk

Extension:

1.1 Order Issue

    1.1.1 If order is placed but not has been paid yet, order status would only mark as unpaid
