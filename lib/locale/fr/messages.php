<?php
$i18n = array();
$i18n['starterkit']= 'Un kit de démarrage pour la paiement en ligne par formulaire';
$i18n['lang']= 'Langue';
$i18n['contactus']= 'Nous contacter';
$i18n['shopid']= 'Votre identifiant boutique';
$i18n['requirements']= 'Configuration nécessaire';
$i18n['in']= 'Dans';
$i18n['certtestprod']= 'Votre certificat (TEST ou PRODUCTION)';
$i18n['modetestprod']= 'Mode (TEST or PRODUCTION)';
$i18n['platformurl']= 'Url de la plateforme';
$i18n['formexamples']= 'Exemples de formulaires';
$i18n['htmlform']= 'Formulaire HTML avec les informations client et l\'URL de retour boutique';
$i18n['simpleform']= 'Formulaire simple';
$i18n['simpleformextended']= 'Formulaire simple avec carte pre-selectionnée et retour à la boutique';
$i18n['installment']= 'Paiement en plusieurs fois';
$i18n['deferred']= 'Paiement comptant différé';
$i18n['monthsub']= 'Abonnement au mois';
$i18n['authwithoutcapt'] = 'Demande d\'autorisation';
$i18n['sepa']= 'Sepa';
$i18n['ecv']= 'E-chèques vacances';
$i18n['simpleformboots']= 'Formulaire simple avec la librairie Bootstrap';
$i18n['paymentanalysis']= 'Analyse du paiement';
$i18n['ipn']= 'URL de notification instantanée (IPN)';
$i18n['ipndesc']= 'Lorsque le paiement est terminé, la plateforme de paiement renvoie des paramètres en mode POST vers l\'URL serveur qui doit analyser les résultats du paiement. Dans un premier temps il convient de vérifier la signature reçue. Si celle-ci est correcte alors vous pourrez prendre en considération les paramètres liés au paiement proprement dit.';
$i18n['returnurl']= 'URL de retour';
$i18n['clientcomesback']= 'Lorsque l\'internaute revient à la boutique via l\'une des url de retour, les paramètres liés au paiement sont renvoyés en fonction de la variable vads_return_mode définie dans le fichier conf.txt. En fonction du vads_return_mode les paramètres sont renvoyés en mode POST / GET ou pas du tout.';
$i18n['formreturndesc']= 'Dans ce pack, c\'est le fichier form-return.php qui controle la signature et analyse les résultats du paiement. Le code est donné à titre d\'exemple. Dans un premier temps le script vérifie la signature puis analyse les principaux champs. A vous d\'adapter le code à votre contexte.';
$i18n['findhelp']= 'Trouver de l\'aide';
$i18n['supportrecommends']= 'Le support de PayZen recommande fortement de lire la documentation';

/**
 * html form
 */
$i18n['payzensolution'] = 'EXEMPLE D\'IMPLEMENTATION DE LA SOLUTION DE PAIEMENT PAYZEN';
$i18n['info'] = 'INFORMATIONS';
$i18n['usesform'] = 'Le paiement s\'appuie sur l\'envoi d\'un formulaire de paiement en https vers l\'URL de la plateforme de paiement PAYZEN.';
$i18n['file'] = 'Fichier ';
$i18n['htmlformuse'] = '<p>Le fichier <code>html-form.php</code> envoie l\'ensemble des champs liés au paiement vers le fichier <code>form-tunnel.php</code> qui récupère l\'ensemble des ces champs pour construire la requête de paiement.</p><p>Les champs sont renseignés à titre d\'exemple, à votre charge de les valoriser en fonction de votre contexte.</p><p><b>D\'autres champs sont disponibles, le support PAYZEN vous invite à lire la documentation liée au formulaire de paiement</b> <a href="https://payzen.io">Consulter la documentation.</a></p>';
$i18n['beforefirstuse'] = 'Avant la première utilisation vous devez impérativement renseigner les champs <code>shopID</code>, <code>certTest</code>, <code>platform</code> et <code>ctxMode</code> du fichier <code>config/config.php</code>. Ce fichier comporte des données sensibles. <b>La sécurisation de ces données est de votre responsabilité.</b>';
$i18n['transsettings'] = 'PARAMETRES DE LA TRANSACTION';
$i18n['clientssettings'] = 'PARAMETRES CLIENT';
$i18n['amountdesc'] = 'Montant de la commande exprimé dans la plus petite unité de la devise. Centimes pour EURO. Ex : 1000 pour 10 euros';
$i18n['orderdesc'] = 'Numéro de commande. Paramètre facultatif. Longueur du champ: 32 caractères maximum - Type Alphanumérique';
$i18n['custid'] = 'Numéro client. Paramètre facultatif. Longueur du champ: 32 caractères maximum - Type Alphanumérique';
$i18n['custname'] = 'Nom du client. Paramètre facultatif. Longueur du champ: 127 caractères maximum - Type Alphanumérique';
$i18n['custaddress'] = 'Adresse du client. Paramètre facultatif. Longueur du champ: 255 caractères maximum - Type Alphanumérique';
$i18n['custzip'] = 'Code Postal du client. Paramètre facultatif. Longueur du champ: 32 caractères maximum - Type Alphanumérique';
$i18n['custcity'] = 'Ville du client. Paramètre facultatif. Longueur du champ: 63 caractères maximum - Type Alphanumérique';
$i18n['custcountry'] = 'Pays du client. Code pays du client à la norme ISO 3166. Paramètre facultatif. Longueur du champ: 2 caractères maximum - Type Alphanumérique';
$i18n['custphone'] = 'Téléphone du client. Paramètre facultatif. Longueur du champ: 32 caractères maximum - Type Alphanumérique';
$i18n['custemail'] = 'Email du client. Paramètre facultatif.';
$i18n['urlreturndesc'] = 'URL où sera redirigé par défaut l’acheteur après un appui sur le bouton Retourner à la boutique, si les URL vads_url_error, vads_url_refused, vads_url_success ou vads_url_cancel ne sont pas renseignées.';
$i18n['redirect'] = 'Permet de définir un délai en secondes avant redirection automatique vers le site marchand à la fin d’un paiement accepté.';
$i18n['sendform'] = 'Valider et envoyer les paramètres  <br>en mode POST vers le fichier';

/**
 * bootrstrap simple form
 */
$i18n['price'] = 'Prix';
$i18n['pay'] = 'Payer';
$i18n['displayrealprice'] = 'Afficher uniquement le prix à payer';
$i18n['paymentform'] = 'Formulaire de paiement';

/**
 * form-return.php
 */
$i18n['datawithdoclinks'] = 'Données reçues avec liens vers la documentation. :';
$i18n['rawdata'] = 'Données reçues :';
$i18n['paymentstatus'] = 'Statut du paiement';
$i18n['invalidsign'] = 'SIGNATURE INVALIDE';

/**
 * form-tunnel.php
 */
$i18n['datasent'] = 'POUR INFORMATION VOICI LES CHAMPS QUI SERONT ENVOYES A LA PLATEFORME';
$i18n['note'] = 'REMARQUE:';
$i18n['debugdesc'] = 'Pour etre redirigé directement sur la page de paiement sans afficher cette page, veuillez passer la valeur debug à <code>false</code> dans le fichier <code>config.php</code>';
$i18n['nopostdata'] = 'Aucune donnée POST envoyée';
