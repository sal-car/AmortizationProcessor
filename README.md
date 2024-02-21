## Overview  
This is an amortization viewer and a payment processor made in TypeScript, VueJS, Tailwind, PHP & Laravel. 
The two parts, `/client` and `/part1` are very unrelated, but could be connected with an API call in the future!   

You can check out the deployed amortization viewer [HERE](https://incandescent-clafoutis-d82bdf.netlify.app). 
It's a very simple list which can be sorted by earliest date and the amortization state.  


## Getting started  

### Running client  
From root dir, go to the client folder:  
`cd client`  

Install all necessary dependencies:  
`npm install`  

Run the server:  
`npm run dev` 

Now you can head to http://localhost:8080/ to see the list!  


### Run the payment processor  
From root dir, go to the part1 folder:  
`cd part1`  

Install all necessary dependencies:  
`composer install`  

Run the server:  
`php artisan serve`  

To test out the payment processor, send an empty POST request to http://localhost:8000/paymentgateway. You will get a response
with an email list containing a promoter and some profiles, and a list of paid amortizations.  

## Notes  
-You can go to `app/Http/PaymentController.php` to see some more comments about the payment processor code,
including some admittedly slow and complex operations which definitely could have been made better.  
-The controller assumes that there is a project with amortizations. It goes through the amortizations to check their state and scheduled date - then it 
proceeds to pay them (given that the wallet has enough balance).  
-Instead of setting up a database with schemas and models, I opted to mock these using basic classes with some regular setters and getters. To have a 
look at these, go to `app/Models`.   
-In order to test the processor function, I created a small factory which can be found in `database/factories`.  
-As time was against me on this one, **the payment processor does not send an email to the promoters nor the profiles**. This will be a future implementation!
