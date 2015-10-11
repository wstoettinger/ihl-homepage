<?php if(!defined('IN_INDEX')) die('Hacking attempt');
global $page;

$page->title = "Der Ich Helfe Laufend Spendenlauf"; 

ob_start(); 
?>
<div class="jumbotron">
  <div class="container">
    <h1 class="title">Datenschutz</h1>
    <h3 class="subtitle"></h3>
  </div>
</div>
<div class="container">
  <div class="row">
    <div class="col-xs-12">
      <div class="card">
        <div class="card-block">
          <h2 class="card-title">Datenschutzerklärung</h2>
          <p>Die Angabe persönlicher oder geschäftlicher Daten (Name, Anschrift, Telefonnummer, Emailadresse, etc.) erfolgt ausdrücklich auf freiwilliger Basis. Alle im Rahmen des Anmeldeprozesses erhobenen personenbezogenen Daten werden entsprechend den jeweils geltenden Vorschriften zum Schutz personenbezogener Daten nur zu den genannten Zwecken und in dem zur Erreichung dieser Zwecke erforderlichen Umfang genutzt. Personenbezogene Daten werden außer in gesetzlich verpflichtenden Fällen nicht an Dritte weitergegeben. Dritte im Sinne dieser Datenschutzerklärung sind nicht die Dienstleister des Betreibers, welche die Internet-Seiten hosten oder im zweckgebundenen Auftrag verarbeiten. Des weiteren sind die MaxFun GmbH und das Organisations-Team von WienLäuft für die genannten Zwecke ausgenommen. Unsere Dienstleister sind dazu verpflichtet Daten nur auftragsgemäß zu verarbeiten und alle Datenschutzbestimmungen einzuhalten.</p>
          <p>Durch die Anmeldung erklärt sich der Teilnehmer ausdrücklich damit einverstanden, dass der Veranstalter die erforderlichen Daten über den Zeitraum der Veranstaltung hinaus für zukünftige Informationszwecke (zB Wiederholung der Veranstaltung) speichert und verwendet. Es steht der Person jederzeit frei, per Widerruf die Einwilligung aufzuheben und somit von der Teilnahme zurückzutreten.</p>
          <p>Durch die Teilnahme an einem Gewinnspiel erklärt sich der Teilnehmer ausdrücklich damit einverstande, dass die von ihm übermittelten Daten für die Durchführung und Abwicklung des Gewinnspiels erhoben und verarbeitet werden. Der Teilnehmer erklärt sich außerdem damit einverstanden, dass er auf die von ihm hinterlegte E-Mail-Adresse Nachrichten im Zusammenhang mit dem Gewinnspiel von Ich Helfe Laufend erhalten darf. Im Falle eines Widerrufs wird der Teilnehmer vom Gewinnspiel ausgeschlossen.</p>
          <h3>Datenschutz-Hinweis zu Google Analytics</h3>
          <p>Diese Website benutzt Google Analytics, einen Webanalysedienst der Google Inc. („Google“). Google Analytics verwendet sog. „Cookies“, Textdateien, die auf Ihrem Computer gespeichert werden und die eine Analyse der Benutzung der Website durch Sie ermöglichen. Die durch den Cookie erzeugten Informationen über Ihre Benutzung dieser Website (einschließlich Ihrer IP-Adresse) wird an einen Server von Google in den USA übertragen und dort gespeichert. Google wird diese Informationen benutzen, um Ihre Nutzung der Website auszuwerten, um Reports über die Websiteaktivitäten für die Websitebetreiber zusammenzustellen und um weitere mit der Websitenutzung und der Internetnutzung verbundene Dienstleistungen zu erbringen.</p>
          <p>Auch wird Google diese Informationen gegebenenfalls an Dritte übertragen, sofern dies gesetzlich vorgeschrieben oder soweit Dritte diese Daten im Auftrag von Google verarbeiten. Google wird in keinem Fall Ihre IP-Adresse mit anderen Daten von Google in Verbindung bringen. Sie können die Installation der Cookies durch eine entsprechende Einstellung Ihrer Browser Software verhindern; wir weisen Sie jedoch darauf hin, dass Sie in diesem Fall gegebenenfalls nicht sämtliche Funktionen dieser Website vollumfänglich nutzen können.</p>
          <p>Durch die Nutzung dieser Website erklären Sie sich mit der Bearbeitung der über Sie erhobenen Daten durch Google in der zuvor beschriebenen Art und Weise und zu dem zuvor benannten Zweck einverstanden.</p>
        </div>
      </div>
    </div>
  </div>
</div>
<?php
$page->content = ob_get_clean();

?>
