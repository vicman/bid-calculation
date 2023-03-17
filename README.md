
# Bid Calculation 

## Objetive

The objective of this exercise is to evaluate a programmer's ability to develop a minimum viable product. The software should allow a person to calculate their maximum bid at a car auction based on their budget and various fees that are calculated on the original bid amount. The solution will be evaluated based on interface ergonomics, algorithm, code clarity, code simplicity, and calculation results.  

## Software Description 🚀  
The software must allow the user to enter their budget amount and calculate the maximum amount they can bid on a vehicle, taking into account the following costs: 

- Basic user fee: 10% of the price of the vehicle, minimum $10, and maximum $50.
- Seller's special fee: 2% of the vehicle price.
- Added costs for the association based on the price of the vehicle:
  - $5 for an amount between $1 and $500
  - $10 for an amount greater than $500 up to $1000
  - $15 for an amount greater than $1000 up to $3000
  - $20 for an amount over $3000
- Fixed storage fee of $100.

All fees must be configurable and not pre-calculated.

## Requirements 🔥  
For a budget of $1000, the maximum vehicle amount is $823.53, calculated as follows:

- Basic fee: $50 (10%, min: $10, max. $50)
- Special fee: $16.47 (2%)
- Association fee: $10
- Storage fee: $100

Budget = $1000 = 823.53 + 50 + 16.47 + 10 + 100

## RUN 🔥  
Copy the files to a web server with php version 8.0+ open in the browser the file front/index.php

## Test Case ✨  

|    Budget   | Maximum vehicle amount | Basic Fee | Special Fee | Association Fee | Storage Fee |
| ----------- | --------------------- | ---------| -----------| --------------- | ----------- |
| 1,000.00    | 823.53                | 50.00    | 16.47      | 10.00           | 100.00      |
| 670.00      | 500.00                | 50.00    | 10.00      | 5.00            | 100.00      |
| 670.01      | 500.01                | 50.00    | 10.00      | 10.00           | 100.00      |
| 110.00      | 0.00                  | 0.00     | 0.00       | 0.00            | 0           |
| 111.00      | 0.98                  | 10.00    | 0.02       | 0.00            | 100.00      |






