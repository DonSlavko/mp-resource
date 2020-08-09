@extends('layouts.auth')

@section('content')
    <v-container>
        <v-btn href="/" text class="text--secondary">Back</v-btn>

        <h2>Datenschutzerklärung der Medical Pharma Resource GmbH</h2>

        <h3 class="my-4">1) Information über die Erhebung personenbezogener Daten und Kontaktdaten des Verantwortlichen</h3>

        <p>1.1 Wir freuen uns, dass Sie unsere Website besuchen und bedanken uns für Ihr Interesse. Im Folgenden informieren
            wir Sie über den Umgang mit Ihren personenbezogenen Daten bei der Nutzung unserer Website. Personenbezogene Daten sind
            hierbei alle Daten, mit denen Sie persönlich identifiziert werden können.</p>

        <p>1.2 Verantwortlicher für die Datenverarbeitung auf dieser Website im Sinne der Datenschutz-Grundverordnung (DSGVO)
            ist Medical Pharma Resource GmbH, Marktplatz 1, 40764 Langenfeld, Deutschland, Tel.: +49 (2173) 940 9591,
            Fax: +49 (2173) 940 9599, E-Mail: info@mp-resource.shop. Der für die Verarbeitung von personenbezogenen Daten
            Verantwortliche ist diejenige natürliche oder juristische Person, die allein oder gemeinsam mit anderen über die Zwecke
            und Mittel der Verarbeitung von personenbezogenen Daten entscheidet.</p>

        <p>1.3 Diese Website nutzt aus Sicherheitsgründen und zum Schutz der Übertragung personenbezogener Daten und anderer
            vertraulicher Inhalte (z.B. Bestellungen oder Anfragen an den Verantwortlichen) eine SSL-bzw. TLS-Verschlüsselung.
            Sie können eine verschlüsselte Verbindung an der Zeichenfolge „https://“ und dem Schloss-Symbol in Ihrer Browserzeile erkennen.</p>

        <h3 class="my-4">2) Datenerfassung beim Besuch unserer Website</h3>

        <p>Bei der bloß informatorischen Nutzung unserer Website, also wenn Sie sich nicht registrieren oder uns anderweitig
            Informationen übermitteln, erheben wir nur solche Daten, die Ihr Browser an unseren Server übermittelt (sog. „Server-Logfiles“).
            Wenn Sie unsere Website aufrufen, erheben wir die folgenden Daten, die für uns technisch erforderlich sind, um Ihnen die Website
            anzuzeigen:</p>

        <ul>
            <li>Unsere besuchte Website</li>
            <li>Datum und Uhrzeit zum Zeitpunkt des Zugriffes</li>
            <li>Menge der gesendeten Daten in Byte</li>
            <li>Quelle/Verweis, von welchem Sie auf die Seite gelangten</li>
            <li>Verwendeter Browser</li>
            <li>Verwendetes Betriebssystem</li>
            <li>Verwendete IP-Adresse (ggf.: in anonymisierter Form)</li>
        </ul>

        <p>Die Verarbeitung erfolgt gemäß Art. 6 Abs. 1 lit. f DSGVO auf Basis unseres berechtigten Interesses an der Verbesserung der
            Stabilität und Funktionalität unserer Website. Eine Weitergabe oder anderweitige Verwendung der Daten findet nicht
            statt. Wir behalten uns allerdings vor, die Server-Logfiles nachträglich zu überprüfen, sollten konkrete Anhaltspunkte
            auf eine rechtswidrige Nutzung hinweisen.</p>

        <h3>3) Content-Delivery-Network</h3>

        <p>Cloudflare
            Auf unserer Website verwenden wir ein sog. Content Delivery Network (“CDN”) des Technologiedienstleisters Cloudflare Inc., 101
            Townsend St. San Francisco, CA 94107, USA (“Cloudflare”). Bei einem Content Delivery Network handelt es sich um einen
            Online-Dienst, mit dessen Hilfe insbesondere große Mediendateien (wie z.B. Grafiken, Seiteninhalte oder Skripte) durch
            ein Netz regional verteilter und über das Internet verbundener Server ausgeliefert werden. Der Einsatz des Content Delivery
            Network von Cloudflare hilft uns bei der Optimierung der Ladegeschwindigkeiten unserer Website.
            Die Verarbeitung erfolgt gemäß Art. 6 Abs. 1 lit. f DSGVO auf Basis unseres berechtigten Interesses an einer sicheren und
            effizienten Bereitstellung, sowie Verbesserung der Stabilität und Funktionalität unserer Website.
            Cloudflare mit Sitz in den USA ist für das us-europäische Datenschutzübereinkommen „Privacy Shield“ zertifiziert, welches die
            Einhaltung des in der EU geltenden Datenschutzniveaus gewährleistet.
            Weitere Informationen finden Sie in der Datenschutzerklärung von Cloudflare unter: https://www.cloudflare.com/privacypolicy/</p>

        <h3 class="my-4">4) Kontaktaufnahme</h3>

        <p>Im Rahmen der Kontaktaufnahme mit uns (z.B. per Kontaktformular oder E-Mail) werden personenbezogene Daten erhoben. Welche Daten
            im Falle eines Kontaktformulars erhoben werden, ist aus dem jeweiligen Kontaktformular ersichtlich. Diese Daten werden
            ausschließlich zum Zweck der Beantwortung Ihres Anliegens bzw. für die Kontaktaufnahme und die damit verbundene technische
            Administration gespeichert und verwendet. Rechtsgrundlage für die Verarbeitung dieser Daten ist unser berechtigtes Interesse
            an der Beantwortung Ihres Anliegens gemäß Art. 6 Abs. 1 lit. f DSGVO. Zielt Ihre Kontaktierung auf den Abschluss eines
            Vertrages ab, so ist zusätzliche Rechtsgrundlage für die Verarbeitung Art. 6 Abs. 1 lit. b DSGVO. Ihre Daten werden nach
            abschließender Bearbeitung Ihrer Anfrage gelöscht. Dies ist der Fall, wenn sich aus den Umständen entnehmen lässt, dass
            der betroffene Sachverhalt abschließend geklärt ist und sofern keine gesetzlichen Aufbewahrungspflichten entgegenstehen.</p>

        <h3 class="my-4">5) Online-Terminvereinbarung (Rückrufservice)</h3>

        <p>Wir verarbeiten Ihre personenbezogenen Daten im Rahmen der zur Verfügung gestellten Online-Terminvereinbarung. Welche Daten wir
            zur Online-Terminvereinbarung erheben, können Sie aus dem jeweiligen Eingabeformular bzw. der Terminabfrage zur
            Terminvereinbarung ersehen. Sofern gewisse Daten notwendig sind, um eine Online-Terminvereinbarung durchführen zu
            können, machen wir diese im Eingabeformular bzw. bei der Terminabfrage entsprechend kenntlich. Sofern wir Ihnen ein
            Freitextfeld beim Eingabeformular zur Verfügung stellen, können Sie dort Ihr Anliegen näher beschreiben. Sie können
            dann auch selbst steuern, welche Daten Sie zusätzlich eintragen möchten.</p>

        <p>Ihre mitgeteilten Daten werden ausschließlich zum Zweck der Terminvereinbarung gespeichert und verwendet. Bei der
            Verarbeitung von personenbezogenen Daten, die zur Erfüllung eines Vertrages mit Ihnen erforderlich sind
            (dies gilt auch für Verarbeitungsvorgänge, die zur Durchführung vorvertraglicher Maßnahmen erforderlich sind),
            dient Art. 6 Abs. 1 lit. b DSGVO als Rechtsgrundlage. Haben Sie uns eine Einwilligung für die Verarbeitung Ihrer
            Daten erteilt, erfolgt die Verarbeitung auf Grundlage des Art. 6 Abs. 1 lit. a DSGVO. Eine erteilte Einwilligung
            kann jederzeit durch eine Nachricht an den zu Beginn dieser Erklärung genannten Verantwortlichen widerrufen werden.</p>

        <h3 class="my-4">6) Datenverarbeitung bei Eröffnung eines Kundenkontos und zur Vertragsabwicklung</h3>

        <p>Gemäß Art. 6 Abs. 1 lit. b DSGVO werden personenbezogene Daten weiterhin erhoben und verarbeitet, wenn Sie uns diese zur
            Durchführung eines Vertrages oder bei der Eröffnung eines Kundenkontos mitteilen. Welche Daten erhoben werden,
            ist aus den jeweiligen Eingabeformularen ersichtlich. Eine Löschung Ihres Kundenkontos ist jederzeit möglich und
            kann durch eine Nachricht an die o.g. Adresse des Verantwortlichen erfolgen. Wir speichern und verwenden die von
            Ihnen mitgeteilten Daten zur Vertragsabwicklung. Nach vollständiger Abwicklung des Vertrages oder Löschung Ihres
            Kundenkontos werden Ihre Daten mit Rücksicht auf steuer- und handelsrechtliche Aufbewahrungsfristen gesperrt und
            nach Ablauf dieser Fristen gelöscht, sofern Sie nicht ausdrücklich in eine weitere Nutzung Ihrer Daten eingewilligt
            haben oder eine gesetzlich erlaubte weitere Datenverwendung von unserer Seite vorbehalten wurde.</p>

        <h3 class="my-4">7) Nutzung Ihrer Daten zur Direktwerbung</h3>

        <p>7.1 Anmeldung zu unserem E-Mail-Newsletter</p>

        <p>Wenn Sie sich zu unserem E-Mail Newsletter anmelden, übersenden wir Ihnen regelmäßig Informationen zu unseren Angeboten.
            Pflichtangabe für die Übersendung des Newsletters ist allein Ihre E-Mailadresse. Die Angabe weiterer Daten ist
            freiwillig und wird verwendet, um Sie persönlich ansprechen zu können. Für den Versand des Newsletters verwenden
            wir das sog. Double Opt-in Verfahren. Dies bedeutet, dass wir Ihnen erst dann einen E-Mail Newsletter übermitteln
            werden, wenn Sie uns ausdrücklich bestätigt haben, dass Sie in den Empfang von Newsletter einwilligen. Wir schicken
            Ihnen dann eine Bestätigungs-E-Mail, mit der Sie gebeten werden durch Anklicken eines entsprechenden Links zu bestätigen,
            dass Sie künftig den Newsletter erhalten wollen.</p>

        <p>Mit der Aktivierung des Bestätigungslinks erteilen Sie uns Ihre Einwilligung für die Nutzung Ihrer personenbezogenen Daten gemäß
            Art. 6 Abs. 1 lit. a DSGVO. Bei der Anmeldung zum Newsletter speichern wir Ihre vom Internet Service-Provider (ISP)
            eingetragene IP-Adresse sowie das Datum und die Uhrzeit der Anmeldung, um einen möglichen Missbrauch Ihrer E-Mail-
            Adresse zu einem späteren Zeitpunkt nachvollziehen zu können. Die von uns bei der Anmeldung zum Newsletter erhobenen
            Daten werden ausschließlich für Zwecke der werblichen Ansprache im Wege des Newsletters benutzt. Sie können den Newsletter
            jederzeit über den dafür vorgesehenen Link im Newsletter oder durch entsprechende Nachricht an den eingangs genannten
            Verantwortlichen abbestellen. Nach erfolgter Abmeldung wird Ihre E-Mailadresse unverzüglich in unserem Newsletter-Verteiler
            gelöscht, soweit Sie nicht ausdrücklich in eine weitere Nutzung Ihrer Daten eingewilligt haben oder wir uns eine
            darüberhinausgehende Datenverwendung vorbehalten, die gesetzlich erlaubt ist und über die wir Sie in dieser Erklärung informieren.</p>

        <p>7.2 Newsletterversand via CleverReach</p>

        <p>Der Versand unserer E-Mail-Newsletter erfolgt über den technischen Dienstleister CleverReach GmbH & Co. KG, Mühlenstr. 43, 26180
            Rastede („CleverReach“), an die wir Ihre bei der Newsletteranmeldung bereitgestellten Daten weitergeben. Diese Weitergabe
            erfolgt gemäß Art. 6 Abs. 1 lit. f DSGVO und dient unserem berechtigten Interesse an der Verwendung eines werbewirksamen,
            sicheren und nutzerfreundlichen Newslettersystems. Die von Ihnen zwecks Newsletterbezugs eingegebenen Daten (z.B. E-Mail-Adresse)
            werden auf den Servern von CleverReach in Deutschland bzw. Irland gespeichert.</p>

        <p>CleverReach verwendet diese Informationen zum Versand und zur statistischen Auswertung der Newsletter in unserem Auftrag.
            Für die Auswertung beinhalten die per E-Mail versendeten Newsletter sog. Web-Beacons bzw. Trackings-Pixel,
            die Ein-Pixel-Bilddateien darstellen, die auf unserer Website gespeichert sind. So kann festgestellt werden,
            ob eine Newsletter-Nachricht geöffnet wurde und welche Links ggf. angeklickt wurden. Mit Hilfe des sog.
            Conversion-Trackings kann außerdem analysiert werden, ob nach Anklicken solcher Links eine vorab definierte
            Aktion (z.B. Kauf eines Produkts auf unserer Website) erfolgt ist. Außerdem werden technische Informationen
            erfasst (z.B. Zeitpunkt des Abrufs, IP-Adresse, Browsertyp und Betriebssystem). Die Daten werden ausschließlich
            pseudonymisiert erhoben und werden nicht mir Ihren weiteren persönlichen Daten verknüpft, eine direkte Personenbeziehbarkeit
            wird ausgeschlossen. Diese Daten dienen ausschließlich der statistischen Analyse von Newsletterkampagnen. Die Ergebnisse
            dieser Analysen können genutzt werden, um künftige Newsletter besser an die Interessen der Empfänger anzupassen.</p>

        <p>Wenn Sie der Datenanalyse zu statistischen Auswertungszwecken widersprechen möchten, müssen Sie den Newsletterbezug abbestellen.</p>

        <p>Wir haben mit CleverReach einen Auftragsverarbeitungsvertrag abgeschlossen, mit dem wir CleverReach verpflichten, die Daten unserer
            Kunden zu schützen und sie nicht an Dritte weiterzugeben.</p>

        <p>Weitere Informationen zur Datenanalyse von CleverReach können Sie hier nachlesen:
            https://www.cleverreach.com/de/funktionen/reporting-und-tracking/
            Die Datenschutzerklärung von CleverReach können Sie hier einsehen:
            https://www.cleverreach.com/de/datenschutz/.</p>

        <p>7.3 Werbung per Briefpost</p>

        <p>Auf Grundlage unseres berechtigten Interesses an personalisierter Direktwerbung behalten wir uns vor, Ihren Vor- und Nachnamen,
            Ihre Postanschrift und – soweit wir diese zusätzlichen Angaben im Rahmen der Vertragsbeziehung von Ihnen erhalten
            haben – Ihren Titel, akademischen Grad, Ihr Geburtsjahr und Ihre Berufs-, Branchen- oder Geschäftsbezeichnung gemäß
            Art. 6 Abs. 1 lit. f DSGVO zu speichern und für die Zusendung von interessanten Angeboten und Informationen zu unseren
            Produkten per Briefpost zu nutzen.</p>

        <p>Sie können der Speicherung und Nutzung Ihrer Daten zu diesem Zweck jederzeit durch eine entsprechende Nachricht an den
            Verantwortlichen widersprechen.</p>

        <p>7.4 Warenverfügbarkeitsbenachrichtigung per E-Mail</p>

        <p>Sofern wir in unserem Online-Shop für ausgewählte, vorübergehend nicht verfügbare Artikel die Möglichkeit anbieten, Sie per
            E-Mail über den Zeitpunkt der Verfügbarkeit zu informieren, können Sie sich zu unserem E-Mail-Benachrichtigungsdienst
            zur Warenverfügbarkeit anmelden. Wenn Sie sich zu unserem E-Mail-Benachrichtigungsdienst zur Warenverfügbarkeit anmelden,
            übersenden wir Ihnen per E-Mail einmalig eine Nachricht über die Verfügbarkeit des jeweils von Ihnen ausgewählten Artikels.
            Pflichtangabe für die Übersendung dieser Benachrichtigung ist allein Ihre E-Mailadresse. Die Angabe weiterer Daten ist
            freiwillig und wird ggf. verwendet, um Sie persönlich ansprechen zu können. Für den Versand dieser Benachrichtigung
            verwenden wir das sog. Double Opt-in Verfahren. Dies bedeutet, dass wir Ihnen erst dann eine entsprechende Benachrichtigung
            übermitteln werden, wenn Sie uns ausdrücklich bestätigt haben, dass Sie in den Empfang einer solchen Nachricht einwilligen.
            Wir schicken Ihnen dann eine Bestätigungs-E-Mail, mit der Sie gebeten werden durch Anklicken eines entsprechenden Links zu
            bestätigen, dass Sie eine solche Benachrichtigung erhalten wollen.</p>

        <p>Mit der Aktivierung des Bestätigungslinks erteilen Sie uns Ihre Einwilligung für die Nutzung Ihrer personenbezogenen Daten gemäß
            Art. 6 Abs. 1 lit. a DSGVO. Bei der Anmeldung zu unserem E-Mail-Benachrichtigungsdienst zur Warenverfügbarkeit speichern
            wir Ihre vom Internet Service-Provider (ISP) eingetragene IP-Adresse sowie das Datum und die Uhrzeit der Anmeldung, um
            einen möglichen Missbrauch Ihrer E-Mail- Adresse zu einem späteren Zeitpunkt nachvollziehen zu können. Die von uns bei
            der Anmeldung zu unserem E-Mail-Benachrichtigungsdienst zur Warenverfügbarkeit erhobenen Daten werden ausschließlich für
            den Zweck benutzt, Sie über die Verfügbarkeit eines bestimmten Artikels in unserem Online-Shop zu informieren. Sie können
            den E-Mail-Benachrichtigungsdienst zur Warenverfügbarkeit jederzeit durch entsprechende Nachricht an den eingangs genannten
            Verantwortlichen abbestellen. Nach erfolgter Abmeldung wird Ihre E-Mailadresse unverzüglich aus unserem hierfür eingerichteten
            Verteiler gelöscht, soweit Sie nicht ausdrücklich in eine weitere Nutzung Ihrer Daten eingewilligt haben oder wir uns eine
            darüber hinausgehende Datenverwendung vorbehalten, die gesetzlich erlaubt ist und über die wir Sie in dieser Erklärung informieren.</p>

            <h3 class="my-4">8) Datenverarbeitung zur Bestellabwicklung</h3>

        <p>8.1 Zur Abwicklung Ihrer Bestellung arbeiten wir mit dem / den nachstehenden Dienstleistern zusammen, die uns ganz oder
            teilweise bei der Durchführung geschlossener Verträge unterstützen. An diese Dienstleister werden nach Maßgabe der
            folgenden Informationen gewisse personenbezogene Daten übermittelt.</p>

        <p>Die von uns erhobenen personenbezogenen Daten werden im Rahmen der Vertragsabwicklung an das mit der Lieferung beauftragte
            Transportunternehmen weitergegeben, soweit dies zur Lieferung der Ware erforderlich ist. Ihre Zahlungsdaten geben
            wir im Rahmen der Zahlungsabwicklung an das beauftragte Kreditinstitut weiter, sofern dies für die Zahlungsabwicklung
            erforderlich ist. Sofern Zahlungsdienstleister eingesetzt werden, informieren wir Sie hierüber nachstehend explizit.
            Rechtsgrundlage für die Weitergabe der Daten ist Art. 6 Abs. 1 lit. b DSGVO.</p>

        <p>8.2 Zur Erfüllung unserer vertraglichen Pflichten unseren Kunden gegenüber arbeiten wir mit externen Versandpartnern zusammen.
            Wir geben Ihren Namen sowie Ihre Lieferadresse und, soweit für die Lieferung erforderlich Ihre Telefonnummer, ausschließlich
            zu Zwecken der Warenlieferung Art. 6 Abs. 1 lit. b DSGVO an einen von uns ausgewählten Versandpartner weiter.</p>

        <h3 class="my-4">9) Rechte des Betroffenen</h3>

        <p>9.1 Das geltende Datenschutzrecht gewährt Ihnen gegenüber dem Verantwortlichen hinsichtlich der Verarbeitung Ihrer
            personenbezogenen Daten umfassende Betroffenenrechte (Auskunfts- und Interventionsrechte), über die wir Sie
            nachstehend informieren:</p>

        <ul>
            <li>Auskunftsrecht gemäß Art. 15 DSGVO: Sie haben insbesondere ein Recht auf Auskunft über Ihre von uns verarbeiteten personenbezogenen Daten,
                die Verarbeitungszwecke, die Kategorien der verarbeiteten personenbezogenen Daten, die Empfänger oder Kategorien von
                Empfängern, gegenüber denen Ihre Daten offengelegt wurden oder werden, die geplante Speicherdauer bzw. die Kriterien
                für die Festlegung der Speicherdauer, das Bestehen eines Rechts auf Berichtigung, Löschung, Einschränkung der Verarbeitung,
                Widerspruch gegen die Verarbeitung, Beschwerde bei einer Aufsichtsbehörde, die Herkunft Ihrer Daten, wenn diese nicht durch
                uns bei Ihnen erhoben wurden, das Bestehen einer automatisierten Entscheidungsfindung einschließlich Profiling und ggf.
                aussagekräftige Informationen über die involvierte Logik und die Sie betreffende Tragweite und die angestrebten Auswirkungen
                einer solchen Verarbeitung, sowie Ihr Recht auf Unterrichtung, welche Garantien gemäß Art. 46 DSGVO bei Weiterleitung Ihrer
                Daten in Drittländer bestehen;</li>
            <li>Recht auf Berichtigung gemäß Art. 16 DSGVO: Sie haben ein Recht auf unverzügliche Berichtigung Sie betreffender unrichtiger Daten und/oder
                Vervollständigung Ihrer bei uns gespeicherten unvollständigen Daten;</li>
            <li>Recht auf Löschung gemäß Art. 17 DSGVO: Sie haben das Recht, die Löschung Ihrer personenbezogenen Daten bei Vorliegen der Voraussetzungen
                des Art. 17 Abs. 1 DSGVO zu verlangen. Dieses Recht besteht jedoch insbesondere dann nicht, wenn die Verarbeitung zur Ausübung
                des Rechts auf freie Meinungsäußerung und Information, zur Erfüllung einer rechtlichen Verpflichtung, aus Gründen des öffentlichen
                Interesses oder zur Geltendmachung, Ausübung oder Verteidigung von Rechtsansprüchen erforderlich ist;</li>
            <li>Recht auf Einschränkung der Verarbeitung gemäß Art. 18 DSGVO: Sie haben das Recht, die Einschränkung der Verarbeitung Ihrer
                personenbezogenen Daten zu verlangen, solange die von Ihnen bestrittene Richtigkeit Ihrer Daten überprüft wird, wenn
                Sie eine Löschung Ihrer Daten wegen unzulässiger Datenverarbeitung ablehnen und stattdessen die Einschränkung der
                Verarbeitung Ihrer Daten verlangen, wenn Sie Ihre Daten zur Geltendmachung, Ausübung oder Verteidigung von Rechtsansprüchen
                benötigen, nachdem wir diese Daten nach Zweckerreichung nicht mehr benötigen oder wenn Sie Widerspruch aus Gründen Ihrer
                besonderen Situation eingelegt haben, solange noch nicht feststeht, ob unsere berechtigten Gründe überwiegen;</li>
            <li>Recht auf Unterrichtung gemäß Art. 19 DSGVO: Haben Sie das Recht auf Berichtigung, Löschung oder Einschränkung der Verarbeitung
                gegenüber dem Verantwortlichen geltend gemacht, ist dieser verpflichtet, allen Empfängern, denen die Sie betreffenden
                personenbezogenen Daten offengelegt wurden, diese Berichtigung oder Löschung der Daten oder Einschränkung der Verarbeitung
                mitzuteilen, es sei denn, dies erweist sich als unmöglich oder ist mit einem unverhältnismäßigen Aufwand verbunden.
                Ihnen steht das Recht zu, über diese Empfänger unterrichtet zu werden.</li>
            <li>Recht auf Datenübertragbarkeit gemäß Art. 20 DSGVO: Sie haben das Recht, Ihre personenbezogenen Daten, die Sie uns bereitgestellt haben,
                in einem strukturierten, gängigen und maschinenlesebaren Format zu erhalten oder die Übermittlung an einen anderen Verantwortlichen
                zu verlangen, soweit dies technisch machbar ist;</li>
            <li>Recht auf Widerruf erteilter Einwilligungen gemäß Art. 7 Abs. 3 DSGVO: Sie haben das Recht, eine einmal erteilte Einwilligung in die
                Verarbeitung von Daten jederzeit mit Wirkung für die Zukunft zu widerrufen. Im Falle des Widerrufs werden wir die betroffenen
                Daten unverzüglich löschen, sofern eine weitere Verarbeitung nicht auf eine Rechtsgrundlage zur einwilligungslosen Verarbeitung
                gestützt werden kann. Durch den Widerruf der Einwilligung wird die Rechtmäßigkeit der aufgrund der Einwilligung bis zum Widerruf
                erfolgten Verarbeitung nicht berührt;</li>
            <li>Recht auf Beschwerde gemäß Art. 77 DSGVO: Wenn Sie der Ansicht sind, dass die Verarbeitung der Sie betreffenden personenbezogenen Daten
                gegen die DSGVO verstößt, haben Sie – unbeschadet eines anderweitigen verwaltungsrechtlichen oder gerichtlichen Rechtsbehelfs –
                das Recht auf Beschwerde bei einer Aufsichtsbehörde, insbesondere in dem Mitgliedstaat Ihres Aufenthaltsortes, Ihres Arbeitsplatzes
                oder des Ortes des mutmaßlichen Verstoßes.</li>
        </ul>

        <p>9.2 WIDERSPRUCHSRECHT</p>

        <p>WENN WIR IM RAHMEN EINER INTERESSENABWÄGUNG IHRE PERSONENBEZOGENEN DATEN AUFGRUND UNSERES ÜBERWIEGENDEN BERECHTIGTEN INTERESSES VERARBEITEN,
            HABEN SIE DAS JEDERZEITIGE RECHT, AUS GRÜNDEN, DIE SICH AUS IHRER BESONDEREN SITUATION ERGEBEN, GEGEN DIESE VERARBEITUNG WIDERSPRUCH
            MIT WIRKUNG FÜR DIE ZUKUNFT EINZULEGEN.</p>

        <p>MACHEN SIE VON IHREM WIDERSPRUCHSRECHT GEBRAUCH, BEENDEN WIR DIE VERARBEITUNG DER BETROFFENEN DATEN. EINE WEITERVERARBEITUNG BLEIBT
            ABER VORBEHALTEN, WENN WIR ZWINGENDE SCHUTZWÜRDIGE GRÜNDE FÜR DIE VERARBEITUNG NACHWEISEN KÖNNEN, DIE IHRE INTERESSEN,
            GRUNDRECHTE UND GRUNDFREIHEITEN ÜBERWIEGEN, ODER WENN DIE VERARBEITUNG DER GELTENDMACHUNG, AUSÜBUNG ODER VERTEIDIGUNG VON
            RECHTSANSPRÜCHEN DIENT.</p>

        <p>WERDEN IHRE PERSONENBEZOGENEN DATEN VON UNS VERARBEITET, UM DIREKTWERBUNG ZU BETREIBEN, HABEN SIE DAS RECHT, JEDERZEIT WIDERSPRUCH
            GEGEN DIE VERARBEITUNG SIE BETREFFENDER PERSONENBEZOGENER DATEN ZUM ZWECKE DERARTIGER WERBUNG EINZULEGEN. SIE KÖNNEN DEN
            WIDERSPRUCH WIE OBEN BESCHRIEBEN AUSÜBEN.</p>

        <p>MACHEN SIE VON IHREM WIDERSPRUCHSRECHT GEBRAUCH, BEENDEN WIR DIE VERARBEITUNG DER BETROFFENEN DATEN ZU DIREKTWERBEZWECKEN.</p>

        <h3 class="my-4">10) Dauer der Speicherung personenbezogener Daten</h3>

        <p>Die Dauer der Speicherung von personenbezogenen Daten bemisst sich anhand der jeweiligen Rechtsgrundlage, am Verarbeitungszweck und –
            sofern einschlägig – zusätzlich anhand der jeweiligen gesetzlichen Aufbewahrungsfrist (z.B. handels- und steuerrechtliche
            Aufbewahrungsfristen).</p>

        <p>Bei der Verarbeitung von personenbezogenen Daten auf Grundlage einer ausdrücklichen Einwilligung gemäß Art. 6 Abs. 1 lit. a DSGVO
            werden diese Daten so lange gespeichert, bis der Betroffene seine Einwilligung widerruft.</p>

        <p>Existieren gesetzliche Aufbewahrungsfristen für Daten, die im Rahmen rechtsgeschäftlicher bzw. rechtsgeschäftsähnlicher
            Verpflichtungen auf der Grundlage von Art. 6 Abs. 1 lit. b DSGVO verarbeitet werden, werden diese Daten nach
            Ablauf der Aufbewahrungsfristen routinemäßig gelöscht, sofern sie nicht mehr zur Vertragserfüllung oder
            Vertragsanbahnung erforderlich sind und/oder unsererseits kein berechtigtes Interesse an der Weiterspeicherung fortbesteht.</p>

        <p>Bei der Verarbeitung von personenbezogenen Daten auf Grundlage von Art. 6 Abs. 1 lit. f DSGVO werden diese Daten so lange gespeichert,
            bis der Betroffene sein Widerspruchsrecht nach Art. 21 Abs. 1 DSGVO ausübt, es sei denn, wir können zwingende schutzwürdige
            Gründe für die Verarbeitung nachweisen, die die Interessen, Rechte und Freiheiten der betroffenen Person überwiegen, oder die
            Verarbeitung dient der Geltendmachung, Ausübung oder Verteidigung von Rechtsansprüchen.</p>

        <p>Bei der Verarbeitung von personenbezogenen Daten zum Zwecke der Direktwerbung auf Grundlage von Art. 6 Abs. 1 lit. f DSGVO werden diese
            Daten so lange gespeichert, bis der Betroffene sein Widerspruchsrecht nach Art. 21 Abs. 2 DSGVO ausübt.</p>

        <p>Sofern sich aus den sonstigen Informationen dieser Erklärung über spezifische Verarbeitungssituationen nichts anderes ergibt, werden
            gespeicherte personenbezogene Daten im Übrigen dann gelöscht, wenn sie für die Zwecke, für die sie erhoben oder auf sonstige
            Weise verarbeitet wurden, nicht mehr notwendig sind.</p>

        <p>Vertreten durch die IT-Recht Kanzlei</p>

        <p>Datenschutzerklärung herunterladen oder drucken</p>
    </v-container>
@endsection
