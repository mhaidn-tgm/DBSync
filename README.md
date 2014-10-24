DBSync
======

Synchronisation von heterogenen Datenbanken.
Eine Übung aus dem Unterricht Dezentrale Systeme, 5A HIT / TGM.

Aufgabenstellung
----------------

Dokumentieren Sie Ihren Versuch zwei heterogene Datenbanksysteme (MySQL, Postgresql) zu synchronisieren. Verwenden Sie dabei unterschiedliche Schemata (verschiedene Tabellenstruktur) und zeigen Sie auf, welche Schwierigkeiten bei den unterschiedlichen Heterogenitätsgraden auftreten können (wie im Unterricht besprochen) [2Pkt].

Implementieren Sie eigenständig eine geeignete Middleware [8Pkt]. Testen Sie Ihr gewähltes System mit mehr als einer Tabelle [4Pkt] (Synchronisation bei Einfügen, Ändern und Löschen von Einträgen) und dokumentieren Sie die Funktionsweise, sowie auch die Problematiken bzw. nicht abgedeckte Fälle [2Pkt].

Das PDF soll ausführlich beschreiben, welche Annahmen getroffen wurden. Der Source-Code muss den allgemeinen Richtlinien entsprechen und ebenfalls abgegeben werden.

Gruppengröße: 2
Gesamtpunkte: 16 [Aufteilung in eckigen Klammern ersichtlich]

Punkte
------

Dokumentation der Synchronisation [2Pkt]

Implementierung der Middleware [8Pkt]
- Zeittrigger bzw. Listener für Synchronisation bzw. DBMS Logs
- Konfiguration bez. Mapping der Tabellen und Attribute
- Konfliktlösung bei Zeitüberschneidung bzw. Datenproblemen (Log)
- LostUpdate-Problem


Test mit mehr als einer Tabelle und mindestens 10 Datensätze pro Tabelle [4Pkt]
- Uni- und Bidirektionale Änderungen mehrerer Tabellen
- Einfügen, Ändern und Löschen


Dokumenation der Funktionsweise, Problematiken und Problemfälle [2Pkt]
- Designdokumentation (Code + DB)
- Synchronisationsverhalten
- unbehandelte Problemfälle


Protokoll und Sourcecodedokumentation [0..-6Pkt]
