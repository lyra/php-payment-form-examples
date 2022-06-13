# Lyra PHP payment form example

## Introduction

The code presented here is an example of the implementation of the Lyra payment gateway form integration in PHP. It aims to ease its use and learning.

## Contents

This project main contents are:
* `lib/locale`: contains the different translation files for French, English, German and Spanish languages.
* `lib/lyra-payment-form-sdk`: core files that contains the Lyra payment SDK logic.
* `lib/tools`: the core file, defining an utilitary class encapsulating all the Lyra logics of the examples.
* `config/Config.php`: a centralized configuration and initialization file.
* `example/`: contains the logic implementation of the different payment examples.
* `example/return-payment.php`: the file for the return URL at the end of the payment.
* Some other resources for styling pages.

## The first use

1. Copy the content of this project to your PHP web server.
2. In `config/Config.php`, replace the occurrence of the token `[***CHANGE-ME***]` by the actual return url and configure all settings with the actual values from your gateway Back Office.
3. Access the `index.php` page from your browser.
4. Follow the indications to perform a payment

## The next steps

You will also find here the instructions on how to plug the toolbox logging process to your own logging mechanism, how
to override the IPN and RETURN URL defined for your gateway Back Office. And finally, you can change the `TEST` parameter
to `PRODUCTION` to switch to real payment mode, with *all* the caution this decision expects.

## Note

* The documentation used to write this code was [Guide d'implementation formulaire de paiement, v3.4](https://payzen.io)
