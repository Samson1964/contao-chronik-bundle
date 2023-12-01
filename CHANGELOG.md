# Schachchronik Changelog

## Version 1.1.1 (2023-12-01)

* Fix: Warning: Undefined array key "chronik_seite" in Helper:17 -> Ausgabe einer Fehlermeldung, wenn Chronikseite nicht eingestellt ist
* Delete: tl_module.jumpTo entfernt, da die Chronikseite global festgelegt wird
* Fix: Anpassungen PHP 8 wegen undefinierter Variablen
* Delete: ALIAS_CHRONIK und Array mit den vordefinierten Zeiträumen
* Change: style.css für das Backend verbessert

## Version 1.1.0 (2023-11-30)

* Add: Übersetzungen im Backend
* Add: Einstellungen FE-Modul Chronik -> Ausgabe des Jahresmenüs jetzt optional mit Möglichkeit der Begrenzung des Zeitraums.
* Change: FE-Modul Chronik von Classes nach Modules verschoben
* Add: Abhängigkeit codefog/contao-haste
* Change: Toggle-Funktion durch Haste-Toggler ersetzt
* Add: Freigabe für PHP 8
* Change: Bildeinbindung erneuert mit overwriteMeta
* Change: tl_chronik.getSpieler ersetzt durch Funktionsaufruf Spielerregister
* Change: Template chronik_list -> mod_chronik
* Add: tl_settings mit der Seite, auf der das Chronikmodul eingebunden ist
* Change: ALIAS_CHRONIK ersetzt durch tl_settings

## Version 1.0.2 (2019-09-28)

* Fix: tl_chronik Helper-Links
* Fix: Feld imageUrl verlinkt defekteFunktion pagePicker in Vereinsregister-Klasse
* Fix: FE-Ausgabe deaktiviert. Muß komplett aumgebaut werden.

## Version 1.0.1 (2019-06-28)

* Fix: Bereich BE_MOD geändert von dsb auf content

## Version 1.0.0 (2019-06-28)

* Übernahme Version 1.0.1 von Contao 3 als Contao-4-Bundle
