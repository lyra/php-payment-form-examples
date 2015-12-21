# PayZen VADS payment exemple - PHP

## Introduction
The code presented here is a demonstration of the implementation of the VADS PayZen payment system, aimed to ease its use and learning.



## Contents
This code(/lib) is divided in 3 files:
* payzenBootstrap.php, a centralized configuration and initialisation file
* payzenFormIpn.php, a minimal implementation of the IPN callback, the second step in the VADS payment process
* payzenFormToolBox.php, the core file, defining an utility class encapsulating all the PayZen logics of this example


## The first use
1. Place the files on the same directory, under the root of your web-server
2. In `payzenBootstrap.php`, replace the occurences of `[***CHANGE-ME***]` by the actual values of your PayZen account
3. Access `index.php` from your browser, optionnaly change the values of the form being displayed, and validate-it
4. Follow the PayZen indications to perform the payment


## The next steps
You can follow the on-file documentation in `example/form.php` to change the properties of the payment you want to initiate, like the amount or the informations of the customer payment card.

You will also find here the instructions on how to plug the toolbox logging process to your own logging mechanism, how to override the IPN and RETURN URL defined for your PayZen account, and finally, you can change the `TEST` parameter to `PRODUCTION` to switch to _real_ payment mode, with *all* the caution this decision expects.



## Note
* The documentation used to write this code was [Guide d'implementation formulaire de paiement, v3.4](https://payzen.io)


