# PayZen VADS payment exemple - PHP

[![Build Status](https://travis-ci.org/lyra/php-payment-form-examples.svg?branch=master)](https://travis-ci.org/lyra/php-payment-form-examples)

## Introduction
The code presented here is a demonstration of the implementation of the VADS PayZen payment system, aimed to ease its use and learning.


## Contents
* payzenFormToolBox.php, the core file, defining an utility class encapsulating all the PayZen logics of this example

## Example
* `config/config.php`, a centralized configuration and initialisation file
* `return/form-return.php`, the file for the return URL after payment
* `return/ipn-return.php`, a minimal implementation of the IPN callback (notification must be turned on in the back-office with the correct URL)

## The first use
1. Place the files on the same directory, under the root of your web-server
2. In `config/config.php`, replace the occurences of `[***CHANGE-ME***]` by the actual values of your PayZen account
3. Access `index.html` from your browser.
4. Follow the PayZen indications to perform the payment


## The next steps

You will also find here the instructions on how to plug the toolbox logging process to your own logging mechanism, how to override the IPN and RETURN URL defined for your PayZen account, and finally, you can change the `TEST` parameter to `PRODUCTION` to switch to _real_ payment mode, with *all* the caution this decision expects.



## Note
* The documentation used to write this code was [Guide d'implementation formulaire de paiement, v3.4](https://payzen.io)


