<?php
$i18n = array();
$i18n['starterkit'] = 'A starter kit with your PayZen Payment Form';
/*
 * Languages
 */
$i18n["lang_fr"] = "Französisch";
$i18n["lang_de"] = "Deutsch";
$i18n["lang_en"] = "Englisch";
$i18n["lang_es"] = "Spanisch";
/*
 * Requirements
 */
$i18n['lang'] = 'Sprache';
$i18n['contactus'] = 'Kontakt';
$i18n['shopid'] = 'Shop ID';
$i18n['requirements'] = 'Bedarf';
$i18n['in'] = 'Im';
$i18n['certtestprod'] = 'Schlüssel im Testbetrieb oder im Produktivbetrieb';
$i18n['modetestprod'] = 'Modus (Kontextmodus dieses Moduls TEST oder PRODUKTION.)';
$i18n['platformurl'] = 'Platform URL : Link zur Bezahlungsplattform.';
$i18n['debugdesc'] = 'Um direkt zur Zahlungsseite umgeleitet zu werden, ohne diese Seite anzuzeigen, übergeben Sie den Wert von <code> debug </ code> von <code> config.php </ code> an <code> false </ code>.';

/*
 * Order and chechout data
 */
$i18n['formexamples'] = 'Form Beispiele';
$i18n['checkouttitle'] = 'Überprüfen Sie Ihre Bestellung und schließen Sie die Kaufabwicklung ab';
$i18n['orderdetails'] = 'Bestellübersicht ';
$i18n['total'] = 'Gesamt';
$i18n['item1'] = 'Artikel 1.';
$i18n['item2'] = 'Artikel 2.';
$i18n['amount1'] = 'Precio 1.';
$i18n['amount2'] = 'Precio 2.';
$i18n['payment'] = 'Zahlung';
$i18n['stdpayment'] = 'Standardzahlung.';
$i18n['cbpayment'] = 'Standardzahlung mit vorgewählter Karte.';
$i18n['x2payment'] = 'Zahlung in 2 Raten.';
$i18n['x4payment'] = 'Zahlung in 4 Raten.';
$i18n['ecv'] = 'Zahlung mit e-Chèques-Vacances.';
$i18n['redirect_message_defaut'] = 'Weiterleitung zum Shop in Kürze...';

/**
 * Example Form fields description
 */
$i18n['payzensolution'] = 'PAYZEN PAYMENT SOLUTION UMSETZUNGSBEISPIEL';
$i18n['info'] = 'INFORMATIONEN';
$i18n['usesform'] = 'Bei der Zahlung wird ein Zahlungsformular an die PAYZEN Payment Gateway URL gesendet.';
$i18n['file'] = 'Datei';
$i18n['htmlformuse'] = 'Die Datei <code> html-form.php </ code> sendet diese Zahlungsfelder an die Datei <code> form-tunnel.php </ code>, die diese Felder abruft, um die Zahlungsanforderung zu erstellen. </ p> <p> Die Felder sind mit Beispielen gefüllt. Es liegt an Ihnen, sie je nach Kontext und Konfiguration auszufüllen. </ p> <p> <b> Einige andere Felder sind verfügbar. Der PAYZEN-Support empfiehlt, die Dokumentation zum Zahlungsformular zu lesen. </ b> <a href="https://payzen.io"> Lesen Sie die Dokumentation.</a>';
$i18n['beforefirstuse'] = 'Vor der ersten Verwendung müssen Sie die <code> shopID </ code>, <code> certTest </ code>, <code> platform </ code> und <code> ctxMode </ code> der <code> -Konfiguration eingeben /Config.php</code>.e. Diese Datei enthält sichere Daten. <b> Diese Datensicherung liegt in Ihrer Verantwortung. </ b>';
$i18n['transsettings'] = 'TRANSAKTION EINSTELLUNGEN';
$i18n['clientssettings'] = 'Persönliche Daten des Kunden';
$i18n['amountdesc'] = 'Bestellbetrag in der kleinsten Währungseinheit. Cent für EURO. Bsp .: 1000 für 10 Euro';
$i18n['orderdesc'] = 'Bestellnummer. Optionale Einstellung. Feldlänge: max. 32 Zeichen - Alphanumerischer Typ';
$i18n['custid'] = 'Kundennummer. Optionale Einstellung. Feldlänge: max. 32 Zeichen - Alphanumerischer Typ';
$i18n['custfirstname'] = 'Vorname des Kunden. Optionale Einstellung. Feldlänge: maximal 127 Zeichen - Alphanumerischer Typ';
$i18n['custlastname'] = 'Nachname des Kunden. Optionale Einstellung. Feldlänge: maximal 127 Zeichen - Alphanumerischer Typ';
$i18n['custaddress'] = 'Kundenadresse. Optionale Einstellung. Feldlänge: max. 255 Zeichen - Alphanumerischer Typ';
$i18n['custzip'] = 'Postleitzahl des Kunden. Optionale Einstellung. Feldlänge: max. 32 Zeichen - Alphanumerischer Typ';
$i18n['custcity'] = 'Kundenstadt. Optionale Einstellung. Feldlänge: max. 63 Zeichen - Alphanumerischer Typ';
$i18n['custcountry'] = 'Kundenland. Ländercode des Kunden gemäß der Norm ISO 3166. Optionale Einstellung. Feldlänge: max. 2 Zeichen - Alphanumerischer Typ';
$i18n['custphone'] = 'Kundentelefonnummer. Optionale Einstellung. Feldlänge: max. 32 Zeichen - Alphanumerischer Typ';
$i18n['custemail'] = 'Kunden-eMail. Optionale Einstellung.';
$i18n['urlreturndesc'] = 'Standard-URL, an die der Käufer weitergeleitet wird. Wenn dieses Feld nicht übertragen wurde, wird die Backoffice-Konfiguration berücksichtigt.';
$i18n['redirect'] = 'Verzögerung in Sekunden, bevor eine automatische Weiterleitung zur Händler-Website am Ende einer akzeptierten Zahlung erfolgt.';
$i18n['sendform'] = 'PAY => Sende die Parameter an die Zahlungsplattform';

/*
 * Payment analysis
 */
$i18n['paymentanalysis']= 'Zahlungsanalyse';
$i18n['ipn']= 'Benachrichtigung-URL';
$i18n['ipndesc']= 'Nach Abschluss der Zahlung gibt die Zahlungsplattform im POST-Modus Parameter an die Server-URL zurück, die die Zahlungsergebnisse analysieren muss. In einem ersten Schritt muss die empfangene Unterschrift überprüft werden. Wenn dies korrekt ist, können Sie die Parameter berücksichtigen, die sich auf die Zahlung selbst beziehen.';
$i18n['returnurl']= 'URL zum Shop zurücksenden.';
$i18n['clientcomesback']= 'Wenn der Benutzer über eine der Rückgabe-URLs zum Geschäft zurückkehrt, werden die Zahlungsparameter basierend auf der in der Datei conf.txt definierten Variablen vads_return_mode zurückgegeben. Je nach vads_return_mode werden die Parameter im POST / GET-Modus oder gar nicht zurückgegeben.';
$i18n['formreturndesc']= 'In diesem Paket steuert die Datei form-return.php die Signatur und analysiert die Ergebnisse der Zahlung. Der Code ist als Beispiel angegeben. Das Skript prüft zunächst die Signatur und analysiert die Hauptfelder. Es liegt an Ihnen, den Code an Ihren Kontext anzupassen.';
$i18n['findhelp']= 'Hilfe finden';
$i18n['supportrecommends']= 'Der PayZen-Support empfiehlt dringend, die Dokumentation zu lesen';
/**
 * Debug mode
 */
$i18n['price'] = 'Preis';
$i18n['pay'] = 'Zahlen';
$i18n['displayrealprice'] = 'Nur den zu zahlenden Preis anzeigen';
$i18n['paymentform'] = 'Zahlungsformular';

/**
 * form-return.php
 */
$i18n['formexampleresponse'] = 'Beispielantwort';
$i18n['paymentresponseanalysis'] = 'Analyse der Antwort';
$i18n['responsessettings'] = 'Parameter der Antwort';

$i18n['paymentstatus'] = 'Zahlungsstatus';

$i18n['validsign'] = "Unterschrift gültig";
$i18n['invalidsigndesc'] = "Signatur ungültig - das Ergebnis dieser Zahlung nicht berücksichtigen";

$i18n['status'] = "Status";
$i18n['abandonned'] = "Die Zahlung wurde vom Kunden abgebrochen. Die Transaktion wurde nicht auf der Zahlungsplattform erstellt und ist daher im Händler-Backoffice nicht sichtbar.";
$i18n['authorised'] = "Die Zahlung wurde akzeptiert und ist eine ausstehende Bankeinzahlung.";
$i18n['refused'] = "Die Zahlung wurde abgelehnt.";
$i18n['tovalidate'] = "Die Transaktion wurde akzeptiert, die manuelle Validierung steht jedoch noch aus. Es liegt in der Verantwortung des Händlers, die Transaktion zu validieren, um die Bank beim Backoffice-Händler anzufordern oder einen Webservice anzufordern. Die Transaktion kann validiert werden, solange die Erfassungszeit nicht überschritten wurde. Wird diese Zeit überschritten, wechselt die Zahlung in den Status Abgelaufen. Dieser abgelaufene Status ist endgültig.";
$i18n['toauthorise'] = "Die Transaktion steht noch aus. Beim Bezahlen wurde nur ein Eindruck hinterlassen, da die Einzahlungszeit strikt länger als 7 Tage ist. Standardmäßig erfolgt die Autorisierungsanforderung für den Gesamtbetrag am zweiten Tag vor dem Bankdatum.";
$i18n['expired'] = "Die Transaktion ist abgelaufen. Dieser Status ist endgültig, die Transaktion kann nicht mehr in der Bank gespeichert werden. Eine Transaktion verfällt im Falle einer Transaktion, die bei der manuellen Validierung erstellt wurde oder wenn die Erfassungsverzögerung abgelaufen ist.";
$i18n['cancelled'] = "Die Transaktion wurde über das Händler-Backoffice oder über eine Webservice-Anfrage storniert. Dieser Status ist endgültig. Die Transaktion wird niemals als Banküberweisung abgerechnet.";
$i18n['tovalidate'] = 'Die Transaktion muss noch autorisiert werden und wartet auf die manuelle Validierung. Während der Zahlung wurde nur ein Eindruck hinterlassen, da die Bankzeit mehr als 7 Tage beträgt und die Art der angeforderten Validierung "manuelle Validierung" ist. Diese Zahlung kann nur nach Bestätigung des Händlers durch das Händler-Backoffice oder durch einen angeforderten Webdienst per Banküberweisung erfolgen.';
$i18n['captured'] = "Die Transaktion wurde abgebucht. Dieser Status ist endgültig.";

$i18n['result'] = "Ergebnis";
$i18n['00'] = "Zahlung erfolgreich geleistet.";
$i18n['02'] = "Der Händler muss sich an die Bank des Inhabers wenden.";
$i18n['05'] = "Zahlung abgelehnt.";
$i18n['05'] = "Zahlung vom Kunden storniert.";
$i18n['30'] = "Abfrageformatfehler. In Beziehung setzen mit der Valorisierung des Feldes vads_extra_result.";
$i18n['96'] = "Technischer Fehler bei der Bezahlung.";

